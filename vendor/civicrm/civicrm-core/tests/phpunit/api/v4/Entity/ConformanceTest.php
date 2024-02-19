<?php

/*
 +--------------------------------------------------------------------+
 | Copyright CiviCRM LLC. All rights reserved.                        |
 |                                                                    |
 | This work is published under the GNU AGPLv3 license with some      |
 | permitted exceptions and without any warranty. For full license    |
 | and copyright information, see https://civicrm.org/licensing       |
 +--------------------------------------------------------------------+
 */

/**
 *
 * @package CRM
 * @copyright CiviCRM LLC https://civicrm.org/licensing
 */

namespace api\v4\Entity;

use api\v4\Traits\CheckAccessTrait;
use api\v4\Traits\TableDropperTrait;
use Civi\API\Exception\UnauthorizedException;
use Civi\Api4\CustomField;
use Civi\Api4\CustomGroup;
use Civi\Api4\Entity;
use api\v4\Api4TestBase;
use Civi\Api4\Event\ValidateValuesEvent;
use Civi\Api4\Provider\ActionObjectProvider;
use Civi\Api4\Service\Spec\CustomFieldSpec;
use Civi\Api4\Service\Spec\FieldSpec;
use Civi\Api4\Utils\CoreUtil;
use Civi\Core\Event\PostEvent;
use Civi\Core\Event\PreEvent;
use Civi\Test;
use Civi\Test\CiviEnvBuilder;
use Civi\Test\HookInterface;

/**
 * @group headless
 */
class ConformanceTest extends Api4TestBase implements HookInterface {

  use CheckAccessTrait;
  use TableDropperTrait;

  /**
   * Set up baseline for testing
   *
   * @throws \CRM_Core_Exception
   */
  public function setUp(): void {
    // Enable all components
    \CRM_Core_BAO_ConfigSetting::enableAllComponents();
    parent::setUp();
    $this->resetCheckAccess();
  }

  public function setUpHeadless(): CiviEnvBuilder {
    // Install all core extensions that provide APIs
    return Test::headless()->install([
      'org.civicrm.search_kit',
      'civigrant',
    ])->apply();
  }

  /**
   * @throws \CRM_Core_Exception
   * @throws \Civi\API\Exception\UnauthorizedException
   */
  public function tearDown(): void {
    CustomField::delete()->addWhere('id', '>', 0)->execute();
    CustomGroup::delete()->addWhere('id', '>', 0)->execute();
    $tablesToTruncate = [
      'civicrm_case_type',
      'civicrm_group',
      'civicrm_event',
      'civicrm_participant',
      'civicrm_batch',
      'civicrm_product',
      'civicrm_translation',
    ];
    $this->cleanup(['tablesToTruncate' => $tablesToTruncate]);
    parent::tearDown();
  }

  /**
   * Get entities to test.
   *
   * This is the hi-tech list as generated via Civi's runtime services. It
   * is canonical, but relies on services that may not be available during
   * early parts of PHPUnit lifecycle.
   *
   * @return array
   *
   * @throws \CRM_Core_Exception
   */
  public function getEntitiesHitech(): array {
    return $this->toDataProviderArray(Entity::get(FALSE)->execute()->column('name'));
  }

  /**
   * Get entities to test.
   *
   * This method uses file-scanning only and doesn't include dynamic entities (e.g. from multi-record custom fields)
   * But it may be summoned at any time during PHPUnit lifecycle.
   *
   * @return array
   */
  public function getEntitiesLotech(): array {
    $provider = new ActionObjectProvider();
    $entityNames = [];
    foreach ($provider->getAllApiClasses() as $className) {
      $entityNames[] = $className::getEntityName();
    }
    return $this->toDataProviderArray($entityNames);
  }

  /**
   * Ensure that "getEntitiesLotech()" (which is the 'dataProvider') is up to date
   * with "getEntitiesHitech()" (which is a live feed available entities).
   */
  public function testEntitiesProvider(): void {
    $this->assertEquals($this->getEntitiesHitech(), $this->getEntitiesLotech(), "The lo-tech list of entities does not match the hi-tech list. You probably need to update getEntitiesLotech().");
  }

  /**
   * @param string $entityName
   *   Ex: 'Contact'
   *
   * @dataProvider getEntitiesLotech
   *
   * @throws \CRM_Core_Exception
   */
  public function testConformance(string $entityName): void {
    $entityClass = CoreUtil::getApiClass($entityName);

    $this->checkEntityInfo($entityClass);
    $actions = $this->checkActions($entityClass);

    // Go no further if it's not a CRUD entity
    if (array_diff(['get', 'create', 'update', 'delete'], array_keys($actions))) {
      $this->markTestSkipped("The API \"$entityName\" does not implement CRUD actions");
    }

    $this->checkFields($entityClass, $entityName);
    $this->checkCreationDenied($entityName, $entityClass);
    $id = $this->checkCreation($entityName, $entityClass);
    $getResult = $this->checkGet($entityName, $id);
    $this->checkGetAllowed($entityClass, $id, $entityName);
    $this->checkGetCount($entityClass, $id, $entityName);
    $this->checkUpdateFailsFromCreate($entityClass, $id);
    $this->checkUpdate($entityName, $getResult);
    $this->checkWrongParamType($entityClass);
    $this->checkDeleteWithNoId($entityClass);
    $this->checkDeletionDenied($entityClass, $id, $entityName);
    $this->checkDeletionAllowed($entityClass, $id, $entityName);
    $this->checkPostDelete($entityClass, $id, $entityName);
  }

  /**
   * @param \Civi\Api4\Generic\AbstractEntity|string $entityClass
   */
  protected function checkEntityInfo($entityClass): void {
    $info = $entityClass::getInfo();
    $this->assertNotEmpty($info['name']);
    $this->assertNotEmpty($info['title']);
    $this->assertNotEmpty($info['title_plural']);
    $this->assertNotEmpty($info['type']);
    $this->assertNotEmpty($info['description']);
    $this->assertIsArray($info['primary_key']);
    $this->assertMatchesRegularExpression(';^\d\.\d+$;', $info['since']);
    $this->assertContains($info['searchable'], ['primary', 'secondary', 'bridge', 'none']);
  }

  /**
   * @param \Civi\Api4\Generic\AbstractEntity|string $entityClass
   * @param string $entity
   *
   * @throws \CRM_Core_Exception
   */
  protected function checkFields($entityClass, $entity) {
    $fields = $entityClass::getFields(FALSE)
      ->addWhere('type', '=', 'Field')
      ->execute()
      ->indexBy('name');

    $idField = CoreUtil::getIdFieldName($entity);

    $errMsg = sprintf('%s getfields is missing primary key field', $entity);

    $this->assertArrayHasKey($idField, $fields, $errMsg);
    $this->assertEquals('Integer', $fields[$idField]['data_type']);

    // Ensure that the getFields (FieldSpec) format is generally consistent.
    foreach ($fields as $field) {
      $isNotNull = function($v) {
        return $v !== NULL;
      };
      $class = empty($field['custom_field_id']) ? FieldSpec::class : CustomFieldSpec::class;
      $spec = (new $class($field['name'], $field['entity']))->loadArray($field, TRUE);
      $this->assertEquals(
        array_filter($field, $isNotNull),
        array_filter($spec->toArray(), $isNotNull)
      );
    }
  }

  /**
   * @param \Civi\Api4\Generic\AbstractEntity|string $entityClass
   *
   * @return array
   *
   * @throws \CRM_Core_Exception
   */
  protected function checkActions($entityClass): array {
    $actions = $entityClass::getActions(FALSE)
      ->execute()
      ->indexBy('name');

    $this->assertNotEmpty($actions);
    return (array) $actions;
  }

  /**
   * @param string $entity
   * @param \Civi\Api4\Generic\AbstractEntity|string $entityClass
   *
   * @return mixed
   */
  protected function checkCreation($entity, $entityClass) {
    $isReadOnly = $this->isReadOnly($entityClass);

    $hookLog = [];
    $onValidate = function(ValidateValuesEvent $e) use (&$hookLog) {
      $hookLog[$e->getEntityName()][$e->getActionName()] = 1 + ($hookLog[$e->getEntityName()][$e->getActionName()] ?? 0);
    };
    \Civi::dispatcher()->addListener('civi.api4.validate', $onValidate);
    \Civi::dispatcher()->addListener('civi.api4.validate::' . $entity, $onValidate);

    $this->setCheckAccessGrants(["{$entity}::create" => TRUE]);
    $this->assertEquals(0, $this->checkAccessCounts["{$entity}::create"]);

    $requiredParams = $this->getRequiredValuesToCreate($entity);
    $createResult = $entityClass::create()
      ->setValues($requiredParams)
      ->setCheckPermissions(!$isReadOnly)
      ->execute()
      ->first();

    $idField = CoreUtil::getIdFieldName($entity);

    $this->assertArrayHasKey($idField, $createResult, "create missing ID");
    $id = $createResult[$idField];
    $this->assertGreaterThanOrEqual(1, $id, "$entity ID not positive");
    if (!$isReadOnly) {
      $this->assertEquals(1, $this->checkAccessCounts["{$entity}::create"]);
    }
    $this->resetCheckAccess();

    $this->assertEquals(2, $hookLog[$entity]['create']);
    \Civi::dispatcher()->removeListener('civi.api4.validate', $onValidate);
    \Civi::dispatcher()->removeListener('civi.api4.validate::' . $entity, $onValidate);

    return $id;
  }

  /**
   * @param string $entity
   * @param \Civi\Api4\Generic\AbstractEntity|string $entityClass
   */
  protected function checkCreationDenied(string $entity, $entityClass): void {
    $this->setCheckAccessGrants(["{$entity}::create" => FALSE]);
    $this->assertEquals(0, $this->checkAccessCounts["{$entity}::create"]);

    $requiredParams = $this->getRequiredValuesToCreate($entity);

    try {
      $entityClass::create()
        ->setValues($requiredParams)
        ->setCheckPermissions(TRUE)
        ->execute()
        ->first();
      $this->fail("{$entityClass}::create() should throw an authorization failure.");
    }
    catch (UnauthorizedException $e) {
      // OK, expected exception
    }
    if (!$this->isReadOnly($entityClass)) {
      $this->assertEquals(1, $this->checkAccessCounts["{$entity}::create"]);
    }
    $this->resetCheckAccess();
  }

  /**
   * @param \Civi\Api4\Generic\AbstractEntity|string $entityClass
   * @param int $id
   */
  protected function checkUpdateFailsFromCreate($entityClass, int $id): void {
    $exceptionThrown = '';
    try {
      $entityClass::create(FALSE)
        ->addValue('id', $id)
        ->execute();
    }
    catch (\CRM_Core_Exception $e) {
      $exceptionThrown = $e->getMessage();
    }
    $this->assertStringContainsString('id', $exceptionThrown);
  }

  /**
   * @param string $entityName
   * @param int $id
   */
  protected function checkGet(string $entityName, int $id): array {
    $idField = CoreUtil::getIdFieldName($entityName);
    $getResult = civicrm_api4($entityName, 'get', [
      'checkPermissions' => FALSE,
      'where' => [[$idField, '=', $id]],
    ]);
    $errMsg = sprintf('Failed to fetch a %s after creation', $entityName);
    $this->assertEquals($id, $getResult->first()[$idField], $errMsg);
    return $getResult->single();
  }

  /**
   * Ensure updating an entity does not alter it
   *
   * @param string $entityName
   * @param array $getResult
   * @throws \CRM_Core_Exception
   */
  protected function checkUpdate(string $entityName, array $getResult): void {
    $idField = CoreUtil::getIdFieldName($entityName);
    civicrm_api4($entityName, 'update', [
      'checkPermissions' => FALSE,
      'where' => [[$idField, '=', $getResult[$idField]]],
      'values' => [$idField, $getResult[$idField]],
    ]);
    $getResult2 = civicrm_api4($entityName, 'get', [
      'checkPermissions' => FALSE,
      'where' => [[$idField, '=', $getResult[$idField]]],
    ]);
    $this->assertEquals($getResult, $getResult2->single());
  }

  /**
   * Use a permissioned request for `get()`, with access grnted
   * via checkAccess event.
   *
   * @param \Civi\Api4\Generic\AbstractEntity|string $entityClass
   * @param int $id
   * @param string $entity
   */
  protected function checkGetAllowed($entityClass, $id, $entity) {
    $this->setCheckAccessGrants(["{$entity}::get" => TRUE]);
    $getResult = $entityClass::get()
      ->addWhere('id', '=', $id)
      ->execute();

    $errMsg = sprintf('Failed to fetch a %s after creation', $entity);
    $idField = CoreUtil::getIdFieldName($entity);
    $this->assertEquals($id, $getResult->first()[$idField], $errMsg);
    $this->assertEquals(1, $getResult->count(), $errMsg);
    $this->resetCheckAccess();
  }

  /**
   * @param \Civi\Api4\Generic\AbstractEntity|string $entityClass
   * @param int $id
   * @param string $entity
   */
  protected function checkGetCount($entityClass, $id, $entity): void {
    $idField = CoreUtil::getIdFieldName($entity);
    $getResult = $entityClass::get(FALSE)
      ->addWhere($idField, '=', $id)
      ->selectRowCount()
      ->execute();
    $errMsg = sprintf('%s getCount failed', $entity);
    $this->assertEquals(1, $getResult->count(), $errMsg);

    $getResult = $entityClass::get(FALSE)
      ->selectRowCount()
      ->execute();
    $this->assertGreaterThanOrEqual(1, $getResult->count(), $errMsg);
  }

  /**
   * @param \Civi\Api4\Generic\AbstractEntity|string $entityClass
   */
  protected function checkDeleteWithNoId($entityClass) {
    try {
      $entityClass::delete()
        ->execute();
      $this->fail("$entityClass should require ID to delete.");
    }
    catch (\CRM_Core_Exception $e) {
      // OK
    }
  }

  /**
   * @param \Civi\Api4\Generic\AbstractEntity|string $entityClass
   */
  protected function checkWrongParamType($entityClass) {
    $exceptionThrown = '';
    try {
      $entityClass::get()
        ->setDebug('not a bool')
        ->execute();
    }
    catch (\CRM_Core_Exception $e) {
      $exceptionThrown = $e->getMessage();
    }
    $this->assertStringContainsString('debug', $exceptionThrown);
    $this->assertStringContainsString('type', $exceptionThrown);
  }

  /**
   * Delete an entity - while having a targeted grant (hook_civirm_checkAccess).
   *
   * @param \Civi\Api4\Generic\AbstractEntity|string $entityClass
   * @param int $id
   * @param string $entity
   */
  protected function checkDeletionAllowed($entityClass, $id, $entity) {
    $this->setCheckAccessGrants(["{$entity}::delete" => TRUE]);
    $this->assertEquals(0, $this->checkAccessCounts["{$entity}::delete"]);
    $isReadOnly = $this->isReadOnly($entityClass);

    $idField = CoreUtil::getIdFieldName($entity);
    $deleteAction = $entityClass::delete()
      ->setCheckPermissions(!$isReadOnly)
      ->addWhere($idField, '=', $id);

    if (property_exists($deleteAction, 'useTrash')) {
      $deleteAction->setUseTrash(FALSE);
    }

    $log = $this->withPrePostLogging(function() use (&$deleteAction, &$deleteResult) {
      $deleteResult = $deleteAction->execute();
    });

    if (in_array('DAOEntity', CoreUtil::getInfoItem($entity, 'type'))) {
      // We should have emitted an event.
      $hookEntity = ($entity === 'Contact') ? 'Individual' : $entity;/* ooph */
      $this->assertContains("pre.{$hookEntity}.delete", $log, "$entity should emit hook_civicrm_pre() for deletions");
      $this->assertContains("post.{$hookEntity}.delete", $log, "$entity should emit hook_civicrm_post() for deletions");

      // should get back an array of deleted id
      $this->assertEquals([['id' => $id]], (array) $deleteResult);
      if (!$isReadOnly) {
        $this->assertEquals(1, $this->checkAccessCounts["{$entity}::delete"]);
      }
    }
    $this->resetCheckAccess();
  }

  /**
   * Attempt to delete an entity while having explicitly denied permission (hook_civicrm_checkAccess).
   *
   * @param \Civi\Api4\Generic\AbstractEntity|string $entityClass
   * @param int $id
   * @param string $entity
   */
  protected function checkDeletionDenied($entityClass, $id, $entity) {
    $this->setCheckAccessGrants(["{$entity}::delete" => FALSE]);
    $this->assertEquals(0, $this->checkAccessCounts["{$entity}::delete"]);

    try {
      $entityClass::delete()
        ->addWhere('id', '=', $id)
        ->execute();
      $this->fail("{$entity}::delete should throw an authorization failure.");
    }
    catch (UnauthorizedException $e) {
      // OK
    }

    if (!$this->isReadOnly($entityClass)) {
      $this->assertEquals(1, $this->checkAccessCounts["{$entity}::delete"]);
    }
    $this->resetCheckAccess();
  }

  /**
   * @param \Civi\Api4\Generic\AbstractEntity|string $entityClass
   * @param int $id
   * @param string $entity
   */
  protected function checkPostDelete($entityClass, $id, $entity) {
    $getDeletedResult = $entityClass::get(FALSE)
      ->addWhere('id', '=', $id)
      ->execute();

    $errMsg = sprintf('Entity "%s" was not deleted', $entity);
    $this->assertEquals(0, count($getDeletedResult), $errMsg);
  }

  /**
   * @param array $names
   *   List of entity names.
   *   Ex: ['Foo', 'Bar']
   * @return array
   *   List of data-provider arguments, one for each entity-name.
   *   Ex: ['Foo' => ['Foo'], 'Bar' => ['Bar']]
   */
  protected function toDataProviderArray($names) {
    sort($names);

    $result = [];
    foreach ($names as $name) {
      $result[$name] = [$name];
    }
    return $result;
  }

  /**
   * @param \Civi\Api4\Generic\AbstractEntity|string $entityClass
   * @return bool
   */
  protected function isReadOnly($entityClass) {
    return in_array('ReadOnlyEntity', $entityClass::getInfo()['type'], TRUE);
  }

  /**
   * Temporarily enable logging for `hook_civicrm_pre` and `hook_civicrm_post`.
   *
   * @param callable $callable
   *   Run this function. Create a log while running this function.
   * @return array
   *   Log; list of times the hooks were called.
   *   Ex: ['pre.Event.delete', 'post.Event.delete']
   */
  protected function withPrePostLogging($callable): array {
    $log = [];

    $listen = function ($e) use (&$log) {
      if ($e instanceof PreEvent) {
        $log[] = "pre.{$e->entity}.{$e->action}";
      }
      elseif ($e instanceof PostEvent) {
        $log[] = "post.{$e->entity}.{$e->action}";
      }
    };

    try {
      \Civi::dispatcher()->addListener('hook_civicrm_pre', $listen);
      \Civi::dispatcher()->addListener('hook_civicrm_post', $listen);
      $callable();
    }
    finally {
      \Civi::dispatcher()->removeListener('hook_civicrm_pre', $listen);
      \Civi::dispatcher()->removeListener('hook_civicrm_post', $listen);
    }

    return $log;
  }

}