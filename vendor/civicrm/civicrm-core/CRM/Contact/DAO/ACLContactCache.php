<?php

/**
 * @package CRM
 * @copyright CiviCRM LLC https://civicrm.org/licensing
 *
 * Generated from xml/schema/CRM/Contact/ACLContactCache.xml
 * DO NOT EDIT.  Generated by CRM_Core_CodeGen
 * (GenCodeChecksum:4c2e841e02a874dc937ee986f0346baa)
 */

/**
 * Database access object for the ACLContactCache entity.
 */
class CRM_Contact_DAO_ACLContactCache extends CRM_Core_DAO {
  const EXT = 'civicrm';
  const TABLE_ADDED = '3.1';

  /**
   * Static instance to hold the table name.
   *
   * @var string
   */
  public static $_tableName = 'civicrm_acl_contact_cache';

  /**
   * Should CiviCRM log any modifications to this table in the civicrm_log table.
   *
   * @var bool
   */
  public static $_log = FALSE;

  /**
   * primary key
   *
   * @var int|string|null
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $id;

  /**
   * FK to civicrm_contact (could be null for anon user)
   *
   * @var int|string|null
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $user_id;

  /**
   * FK to civicrm_contact
   *
   * @var int|string
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $contact_id;

  /**
   * What operation does this user have permission on?
   *
   * @var string
   *   (SQL type: varchar(8))
   *   Note that values will be retrieved from the database as a string.
   */
  public $operation;

  /**
   * Class constructor.
   */
  public function __construct() {
    $this->__table = 'civicrm_acl_contact_cache';
    parent::__construct();
  }

  /**
   * Returns localized title of this entity.
   *
   * @param bool $plural
   *   Whether to return the plural version of the title.
   */
  public static function getEntityTitle($plural = FALSE) {
    return $plural ? ts('ACLContact Caches') : ts('ACLContact Cache');
  }

  /**
   * Returns all the column names of this table
   *
   * @return array
   */
  public static function &fields() {
    if (!isset(Civi::$statics[__CLASS__]['fields'])) {
      Civi::$statics[__CLASS__]['fields'] = [
        'id' => [
          'name' => 'id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('ACL Contact Cache ID'),
          'description' => ts('primary key'),
          'required' => TRUE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_acl_contact_cache.id',
          'table_name' => 'civicrm_acl_contact_cache',
          'entity' => 'ACLContactCache',
          'bao' => 'CRM_Contact_DAO_ACLContactCache',
          'localizable' => 0,
          'html' => [
            'type' => 'Number',
          ],
          'readonly' => TRUE,
          'add' => '3.1',
        ],
        'user_id' => [
          'name' => 'user_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Contact ID'),
          'description' => ts('FK to civicrm_contact (could be null for anon user)'),
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_acl_contact_cache.user_id',
          'table_name' => 'civicrm_acl_contact_cache',
          'entity' => 'ACLContactCache',
          'bao' => 'CRM_Contact_DAO_ACLContactCache',
          'localizable' => 0,
          'add' => '3.1',
        ],
        'contact_id' => [
          'name' => 'contact_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Contact ID'),
          'description' => ts('FK to civicrm_contact'),
          'required' => TRUE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_acl_contact_cache.contact_id',
          'table_name' => 'civicrm_acl_contact_cache',
          'entity' => 'ACLContactCache',
          'bao' => 'CRM_Contact_DAO_ACLContactCache',
          'localizable' => 0,
          'html' => [
            'label' => ts("Contact"),
          ],
          'add' => '3.1',
        ],
        'operation' => [
          'name' => 'operation',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Operation'),
          'description' => ts('What operation does this user have permission on?'),
          'required' => TRUE,
          'maxlength' => 8,
          'size' => CRM_Utils_Type::EIGHT,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_acl_contact_cache.operation',
          'table_name' => 'civicrm_acl_contact_cache',
          'entity' => 'ACLContactCache',
          'bao' => 'CRM_Contact_DAO_ACLContactCache',
          'localizable' => 0,
          'html' => [
            'type' => 'Select',
          ],
          'pseudoconstant' => [
            'callback' => 'CRM_ACL_BAO_ACL::operation',
          ],
          'add' => '1.6',
        ],
      ];
      CRM_Core_DAO_AllCoreTables::invoke(__CLASS__, 'fields_callback', Civi::$statics[__CLASS__]['fields']);
    }
    return Civi::$statics[__CLASS__]['fields'];
  }

  /**
   * Return a mapping from field-name to the corresponding key (as used in fields()).
   *
   * @return array
   *   Array(string $name => string $uniqueName).
   */
  public static function &fieldKeys() {
    if (!isset(Civi::$statics[__CLASS__]['fieldKeys'])) {
      Civi::$statics[__CLASS__]['fieldKeys'] = array_flip(CRM_Utils_Array::collect('name', self::fields()));
    }
    return Civi::$statics[__CLASS__]['fieldKeys'];
  }

  /**
   * Returns the names of this table
   *
   * @return string
   */
  public static function getTableName() {
    return self::$_tableName;
  }

  /**
   * Returns if this table needs to be logged
   *
   * @return bool
   */
  public function getLog() {
    return self::$_log;
  }

  /**
   * Returns the list of fields that can be imported
   *
   * @param bool $prefix
   *
   * @return array
   */
  public static function &import($prefix = FALSE) {
    $r = CRM_Core_DAO_AllCoreTables::getImports(__CLASS__, 'acl_contact_cache', $prefix, []);
    return $r;
  }

  /**
   * Returns the list of fields that can be exported
   *
   * @param bool $prefix
   *
   * @return array
   */
  public static function &export($prefix = FALSE) {
    $r = CRM_Core_DAO_AllCoreTables::getExports(__CLASS__, 'acl_contact_cache', $prefix, []);
    return $r;
  }

  /**
   * Returns the list of indices
   *
   * @param bool $localize
   *
   * @return array
   */
  public static function indices($localize = TRUE) {
    $indices = [
      'UI_user_contact_operation' => [
        'name' => 'UI_user_contact_operation',
        'field' => [
          0 => 'user_id',
          1 => 'contact_id',
          2 => 'operation',
        ],
        'localizable' => FALSE,
        'unique' => TRUE,
        'sig' => 'civicrm_acl_contact_cache::1::user_id::contact_id::operation',
      ],
    ];
    return ($localize && !empty($indices)) ? CRM_Core_DAO_AllCoreTables::multilingualize(__CLASS__, $indices) : $indices;
  }

}
