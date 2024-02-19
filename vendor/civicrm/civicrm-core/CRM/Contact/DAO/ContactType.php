<?php

/**
 * @package CRM
 * @copyright CiviCRM LLC https://civicrm.org/licensing
 *
 * Generated from xml/schema/CRM/Contact/ContactType.xml
 * DO NOT EDIT.  Generated by CRM_Core_CodeGen
 * (GenCodeChecksum:e4773f83a587c49fc7efc7a507b06fb8)
 */

/**
 * Database access object for the ContactType entity.
 */
class CRM_Contact_DAO_ContactType extends CRM_Core_DAO {
  const EXT = 'civicrm';
  const TABLE_ADDED = '3.1';

  /**
   * Static instance to hold the table name.
   *
   * @var string
   */
  public static $_tableName = 'civicrm_contact_type';

  /**
   * Field to show when displaying a record.
   *
   * @var string
   */
  public static $_labelField = 'label';

  /**
   * Should CiviCRM log any modifications to this table in the civicrm_log table.
   *
   * @var bool
   */
  public static $_log = FALSE;

  /**
   * Paths for accessing this entity in the UI.
   *
   * @var string[]
   */
  protected static $_paths = [
    'add' => 'civicrm/admin/options/subtype/edit?action=add&reset=1',
    'update' => 'civicrm/admin/options/subtype/edit?action=update&id=[id]&reset=1',
    'delete' => 'civicrm/admin/options/subtype/edit?action=delete&id=[id]&reset=1',
    'browse' => 'civicrm/admin/options/subtype',
  ];

  /**
   * Contact Type ID
   *
   * @var int|string|null
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $id;

  /**
   * Internal name of Contact Type (or Subtype).
   *
   * @var string
   *   (SQL type: varchar(64))
   *   Note that values will be retrieved from the database as a string.
   */
  public $name;

  /**
   * localized Name of Contact Type.
   *
   * @var string|null
   *   (SQL type: varchar(64))
   *   Note that values will be retrieved from the database as a string.
   */
  public $label;

  /**
   * localized Optional verbose description of the type.
   *
   * @var string|null
   *   (SQL type: text)
   *   Note that values will be retrieved from the database as a string.
   */
  public $description;

  /**
   * URL of image if any.
   *
   * @var string|null
   *   (SQL type: varchar(255))
   *   Note that values will be retrieved from the database as a string.
   */
  public $image_URL;

  /**
   * crm-i icon class representing this contact type
   *
   * @var string|null
   *   (SQL type: varchar(255))
   *   Note that values will be retrieved from the database as a string.
   */
  public $icon;

  /**
   * Optional FK to parent contact type.
   *
   * @var int|string|null
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $parent_id;

  /**
   * Is this entry active?
   *
   * @var bool|string
   *   (SQL type: tinyint)
   *   Note that values will be retrieved from the database as a string.
   */
  public $is_active;

  /**
   * Is this contact type a predefined system type
   *
   * @var bool|string
   *   (SQL type: tinyint)
   *   Note that values will be retrieved from the database as a string.
   */
  public $is_reserved;

  /**
   * Class constructor.
   */
  public function __construct() {
    $this->__table = 'civicrm_contact_type';
    parent::__construct();
  }

  /**
   * Returns localized title of this entity.
   *
   * @param bool $plural
   *   Whether to return the plural version of the title.
   */
  public static function getEntityTitle($plural = FALSE) {
    return $plural ? ts('Contact Types') : ts('Contact Type');
  }

  /**
   * Returns foreign keys and entity references.
   *
   * @return array
   *   [CRM_Core_Reference_Interface]
   */
  public static function getReferenceColumns() {
    if (!isset(Civi::$statics[__CLASS__]['links'])) {
      Civi::$statics[__CLASS__]['links'] = static::createReferenceColumns(__CLASS__);
      Civi::$statics[__CLASS__]['links'][] = new CRM_Core_Reference_Basic(self::getTableName(), 'parent_id', 'civicrm_contact_type', 'id');
      CRM_Core_DAO_AllCoreTables::invoke(__CLASS__, 'links_callback', Civi::$statics[__CLASS__]['links']);
    }
    return Civi::$statics[__CLASS__]['links'];
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
          'title' => ts('Contact Type ID'),
          'description' => ts('Contact Type ID'),
          'required' => TRUE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_contact_type.id',
          'table_name' => 'civicrm_contact_type',
          'entity' => 'ContactType',
          'bao' => 'CRM_Contact_BAO_ContactType',
          'localizable' => 0,
          'html' => [
            'type' => 'Number',
          ],
          'readonly' => TRUE,
          'add' => '1.1',
        ],
        'name' => [
          'name' => 'name',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Name'),
          'description' => ts('Internal name of Contact Type (or Subtype).'),
          'required' => TRUE,
          'maxlength' => 64,
          'size' => CRM_Utils_Type::BIG,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_contact_type.name',
          'table_name' => 'civicrm_contact_type',
          'entity' => 'ContactType',
          'bao' => 'CRM_Contact_BAO_ContactType',
          'localizable' => 0,
          'html' => [
            'type' => 'Text',
            'label' => ts("Name"),
          ],
          'add' => '3.1',
        ],
        'label' => [
          'name' => 'label',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Contact Type Label'),
          'description' => ts('localized Name of Contact Type.'),
          'maxlength' => 64,
          'size' => CRM_Utils_Type::BIG,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_contact_type.label',
          'table_name' => 'civicrm_contact_type',
          'entity' => 'ContactType',
          'bao' => 'CRM_Contact_BAO_ContactType',
          'localizable' => 1,
          'html' => [
            'type' => 'Text',
            'label' => ts("Label"),
          ],
          'add' => '3.1',
        ],
        'description' => [
          'name' => 'description',
          'type' => CRM_Utils_Type::T_TEXT,
          'title' => ts('Contact Type Description'),
          'description' => ts('localized Optional verbose description of the type.'),
          'rows' => 2,
          'cols' => 60,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_contact_type.description',
          'table_name' => 'civicrm_contact_type',
          'entity' => 'ContactType',
          'bao' => 'CRM_Contact_BAO_ContactType',
          'localizable' => 1,
          'html' => [
            'type' => 'TextArea',
          ],
          'add' => '3.1',
        ],
        'image_URL' => [
          'name' => 'image_URL',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Contact Type Image URL'),
          'description' => ts('URL of image if any.'),
          'maxlength' => 255,
          'size' => CRM_Utils_Type::HUGE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_contact_type.image_URL',
          'table_name' => 'civicrm_contact_type',
          'entity' => 'ContactType',
          'bao' => 'CRM_Contact_BAO_ContactType',
          'localizable' => 0,
          'add' => '3.1',
        ],
        'icon' => [
          'name' => 'icon',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Icon'),
          'description' => ts('crm-i icon class representing this contact type'),
          'maxlength' => 255,
          'size' => CRM_Utils_Type::HUGE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_contact_type.icon',
          'default' => NULL,
          'table_name' => 'civicrm_contact_type',
          'entity' => 'ContactType',
          'bao' => 'CRM_Contact_BAO_ContactType',
          'localizable' => 0,
          'add' => '5.49',
        ],
        'parent_id' => [
          'name' => 'parent_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Parent ID'),
          'description' => ts('Optional FK to parent contact type.'),
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_contact_type.parent_id',
          'table_name' => 'civicrm_contact_type',
          'entity' => 'ContactType',
          'bao' => 'CRM_Contact_BAO_ContactType',
          'localizable' => 0,
          'FKClassName' => 'CRM_Contact_DAO_ContactType',
          'html' => [
            'type' => 'Select',
            'label' => ts("Parent"),
          ],
          'pseudoconstant' => [
            'table' => 'civicrm_contact_type',
            'keyColumn' => 'id',
            'labelColumn' => 'label',
            'condition' => 'parent_id IS NULL',
          ],
          'add' => '3.1',
        ],
        'is_active' => [
          'name' => 'is_active',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'title' => ts('Contact Type Enabled'),
          'description' => ts('Is this entry active?'),
          'required' => TRUE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_contact_type.is_active',
          'default' => '1',
          'table_name' => 'civicrm_contact_type',
          'entity' => 'ContactType',
          'bao' => 'CRM_Contact_BAO_ContactType',
          'localizable' => 0,
          'html' => [
            'type' => 'CheckBox',
            'label' => ts("Enabled"),
          ],
          'add' => '3.1',
        ],
        'is_reserved' => [
          'name' => 'is_reserved',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'title' => ts('Contact Type is Reserved'),
          'description' => ts('Is this contact type a predefined system type'),
          'required' => TRUE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_contact_type.is_reserved',
          'default' => '0',
          'table_name' => 'civicrm_contact_type',
          'entity' => 'ContactType',
          'bao' => 'CRM_Contact_BAO_ContactType',
          'localizable' => 0,
          'add' => '3.1',
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
    return CRM_Core_DAO::getLocaleTableName(self::$_tableName);
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
    $r = CRM_Core_DAO_AllCoreTables::getImports(__CLASS__, 'contact_type', $prefix, []);
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
    $r = CRM_Core_DAO_AllCoreTables::getExports(__CLASS__, 'contact_type', $prefix, []);
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
      'contact_type' => [
        'name' => 'contact_type',
        'field' => [
          0 => 'name',
        ],
        'localizable' => FALSE,
        'unique' => TRUE,
        'sig' => 'civicrm_contact_type::1::name',
      ],
    ];
    return ($localize && !empty($indices)) ? CRM_Core_DAO_AllCoreTables::multilingualize(__CLASS__, $indices) : $indices;
  }

}
