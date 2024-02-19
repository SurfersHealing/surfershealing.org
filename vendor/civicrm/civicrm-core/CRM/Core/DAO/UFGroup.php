<?php

/**
 * @package CRM
 * @copyright CiviCRM LLC https://civicrm.org/licensing
 *
 * Generated from xml/schema/CRM/Core/UFGroup.xml
 * DO NOT EDIT.  Generated by CRM_Core_CodeGen
 * (GenCodeChecksum:0b3f7d95cc8abdec20fb926e2edb2fbd)
 */

/**
 * Database access object for the UFGroup entity.
 */
class CRM_Core_DAO_UFGroup extends CRM_Core_DAO {
  const EXT = 'civicrm';
  const TABLE_ADDED = '1.1';

  /**
   * Static instance to hold the table name.
   *
   * @var string
   */
  public static $_tableName = 'civicrm_uf_group';

  /**
   * Field to show when displaying a record.
   *
   * @var string
   */
  public static $_labelField = 'title';

  /**
   * Should CiviCRM log any modifications to this table in the civicrm_log table.
   *
   * @var bool
   */
  public static $_log = TRUE;

  /**
   * Paths for accessing this entity in the UI.
   *
   * @var string[]
   */
  protected static $_paths = [
    'add' => 'civicrm/admin/uf/group/add?action=add&reset=1',
    'preview' => 'civicrm/admin/uf/group/preview?reset=1&gid=[id]',
    'update' => 'civicrm/admin/uf/group/update?action=update&reset=1&id=[id]',
    'delete' => 'civicrm/admin/uf/group/update?action=delete&reset=1&id=[id]',
    'browse' => 'civicrm/admin/uf/group',
  ];

  /**
   * Unique table ID
   *
   * @var int|string|null
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $id;

  /**
   * Is this profile currently active? If false, hide all related fields for all sharing contexts.
   *
   * @var bool|string
   *   (SQL type: tinyint)
   *   Note that values will be retrieved from the database as a string.
   */
  public $is_active;

  /**
   * Comma separated list of the type(s) of profile fields.
   *
   * @var string|null
   *   (SQL type: varchar(255))
   *   Note that values will be retrieved from the database as a string.
   */
  public $group_type;

  /**
   * Form title.
   *
   * @var string
   *   (SQL type: varchar(64))
   *   Note that values will be retrieved from the database as a string.
   */
  public $title;

  /**
   * Profile Form Public title
   *
   * @var string|null
   *   (SQL type: varchar(64))
   *   Note that values will be retrieved from the database as a string.
   */
  public $frontend_title;

  /**
   * Optional verbose description of the profile.
   *
   * @var string|null
   *   (SQL type: text)
   *   Note that values will be retrieved from the database as a string.
   */
  public $description;

  /**
   * Description and/or help text to display before fields in form.
   *
   * @var string|null
   *   (SQL type: text)
   *   Note that values will be retrieved from the database as a string.
   */
  public $help_pre;

  /**
   * Description and/or help text to display after fields in form.
   *
   * @var string|null
   *   (SQL type: text)
   *   Note that values will be retrieved from the database as a string.
   */
  public $help_post;

  /**
   * Group id, foreign key from civicrm_group
   *
   * @var int|string|null
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $limit_listings_group_id;

  /**
   * Redirect to URL on submit.
   *
   * @var string|null
   *   (SQL type: varchar(255))
   *   Note that values will be retrieved from the database as a string.
   */
  public $post_url;

  /**
   * foreign key to civicrm_group_id
   *
   * @var int|string|null
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $add_to_group_id;

  /**
   * Should a CAPTCHA widget be included this Profile form.
   *
   * @var bool|string
   *   (SQL type: tinyint)
   *   Note that values will be retrieved from the database as a string.
   */
  public $add_captcha;

  /**
   * Do we want to map results from this profile.
   *
   * @var bool|string
   *   (SQL type: tinyint)
   *   Note that values will be retrieved from the database as a string.
   */
  public $is_map;

  /**
   * Should edit link display in profile selector
   *
   * @var bool|string
   *   (SQL type: tinyint)
   *   Note that values will be retrieved from the database as a string.
   */
  public $is_edit_link;

  /**
   * Should we display a link to the website profile in profile selector
   *
   * @var bool|string
   *   (SQL type: tinyint)
   *   Note that values will be retrieved from the database as a string.
   */
  public $is_uf_link;

  /**
   * Should we update the contact record if we find a duplicate
   *
   * @var bool|string
   *   (SQL type: tinyint)
   *   Note that values will be retrieved from the database as a string.
   */
  public $is_update_dupe;

  /**
   * Redirect to URL when Cancel button clicked.
   *
   * @var string|null
   *   (SQL type: varchar(255))
   *   Note that values will be retrieved from the database as a string.
   */
  public $cancel_url;

  /**
   * Should we create a cms user for this profile
   *
   * @var bool|string
   *   (SQL type: tinyint)
   *   Note that values will be retrieved from the database as a string.
   */
  public $is_cms_user;

  /**
   * @var string|null
   *   (SQL type: text)
   *   Note that values will be retrieved from the database as a string.
   */
  public $notify;

  /**
   * Is this group reserved for use by some other CiviCRM functionality?
   *
   * @var bool|string
   *   (SQL type: tinyint)
   *   Note that values will be retrieved from the database as a string.
   */
  public $is_reserved;

  /**
   * Name of the UF group for directly addressing it in the codebase
   *
   * @var string|null
   *   (SQL type: varchar(64))
   *   Note that values will be retrieved from the database as a string.
   */
  public $name;

  /**
   * FK to civicrm_contact, who created this UF group
   *
   * @var int|string|null
   *   (SQL type: int unsigned)
   *   Note that values will be retrieved from the database as a string.
   */
  public $created_id;

  /**
   * Date and time this UF group was created.
   *
   * @var string|null
   *   (SQL type: datetime)
   *   Note that values will be retrieved from the database as a string.
   */
  public $created_date;

  /**
   * Should we include proximity search feature in this profile search form?
   *
   * @var bool|string
   *   (SQL type: tinyint)
   *   Note that values will be retrieved from the database as a string.
   */
  public $is_proximity_search;

  /**
   * Custom Text to display on the Cancel button when used in create or edit mode
   *
   * @var string|null
   *   (SQL type: varchar(64))
   *   Note that values will be retrieved from the database as a string.
   */
  public $cancel_button_text;

  /**
   * Custom Text to display on the submit button on profile edit/create screens
   *
   * @var string|null
   *   (SQL type: varchar(64))
   *   Note that values will be retrieved from the database as a string.
   */
  public $submit_button_text;

  /**
   * Should a Cancel button be included in this Profile form.
   *
   * @var bool|string
   *   (SQL type: tinyint)
   *   Note that values will be retrieved from the database as a string.
   */
  public $add_cancel_button;

  /**
   * Class constructor.
   */
  public function __construct() {
    $this->__table = 'civicrm_uf_group';
    parent::__construct();
  }

  /**
   * Returns localized title of this entity.
   *
   * @param bool $plural
   *   Whether to return the plural version of the title.
   */
  public static function getEntityTitle($plural = FALSE) {
    return $plural ? ts('Profiles') : ts('Profile');
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
      Civi::$statics[__CLASS__]['links'][] = new CRM_Core_Reference_Basic(self::getTableName(), 'limit_listings_group_id', 'civicrm_group', 'id');
      Civi::$statics[__CLASS__]['links'][] = new CRM_Core_Reference_Basic(self::getTableName(), 'add_to_group_id', 'civicrm_group', 'id');
      Civi::$statics[__CLASS__]['links'][] = new CRM_Core_Reference_Basic(self::getTableName(), 'created_id', 'civicrm_contact', 'id');
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
          'title' => ts('Profile ID'),
          'description' => ts('Unique table ID'),
          'required' => TRUE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_uf_group.id',
          'table_name' => 'civicrm_uf_group',
          'entity' => 'UFGroup',
          'bao' => 'CRM_Core_BAO_UFGroup',
          'localizable' => 0,
          'html' => [
            'type' => 'Number',
          ],
          'readonly' => TRUE,
          'add' => '1.1',
        ],
        'is_active' => [
          'name' => 'is_active',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'title' => ts('Profile Is Active'),
          'description' => ts('Is this profile currently active? If false, hide all related fields for all sharing contexts.'),
          'required' => TRUE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_uf_group.is_active',
          'default' => '1',
          'table_name' => 'civicrm_uf_group',
          'entity' => 'UFGroup',
          'bao' => 'CRM_Core_BAO_UFGroup',
          'localizable' => 0,
          'html' => [
            'type' => 'CheckBox',
            'label' => ts("Enabled"),
          ],
          'add' => '1.1',
        ],
        'group_type' => [
          'name' => 'group_type',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Profile Group Type'),
          'description' => ts('Comma separated list of the type(s) of profile fields.'),
          'maxlength' => 255,
          'size' => CRM_Utils_Type::HUGE,
          'usage' => [
            'import' => TRUE,
            'export' => TRUE,
            'duplicate_matching' => TRUE,
            'token' => FALSE,
          ],
          'import' => TRUE,
          'where' => 'civicrm_uf_group.group_type',
          'export' => TRUE,
          'table_name' => 'civicrm_uf_group',
          'entity' => 'UFGroup',
          'bao' => 'CRM_Core_BAO_UFGroup',
          'localizable' => 0,
          'serialize' => self::SERIALIZE_COMMA,
          'add' => '2.1',
        ],
        'title' => [
          'name' => 'title',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Profile Name'),
          'description' => ts('Form title.'),
          'required' => TRUE,
          'maxlength' => 64,
          'size' => CRM_Utils_Type::BIG,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_uf_group.title',
          'table_name' => 'civicrm_uf_group',
          'entity' => 'UFGroup',
          'bao' => 'CRM_Core_BAO_UFGroup',
          'localizable' => 1,
          'html' => [
            'type' => 'Text',
          ],
          'add' => '1.1',
        ],
        'frontend_title' => [
          'name' => 'frontend_title',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Public Title'),
          'description' => ts('Profile Form Public title'),
          'maxlength' => 64,
          'size' => CRM_Utils_Type::BIG,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_uf_group.frontend_title',
          'table_name' => 'civicrm_uf_group',
          'entity' => 'UFGroup',
          'bao' => 'CRM_Core_BAO_UFGroup',
          'localizable' => 1,
          'html' => [
            'type' => 'Text',
          ],
          'add' => '4.7',
        ],
        'description' => [
          'name' => 'description',
          'type' => CRM_Utils_Type::T_TEXT,
          'title' => ts('Profile Description'),
          'description' => ts('Optional verbose description of the profile.'),
          'rows' => 2,
          'cols' => 60,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_uf_group.description',
          'table_name' => 'civicrm_uf_group',
          'entity' => 'UFGroup',
          'bao' => 'CRM_Core_BAO_UFGroup',
          'localizable' => 0,
          'html' => [
            'type' => 'TextArea',
          ],
          'add' => '4.4',
        ],
        'help_pre' => [
          'name' => 'help_pre',
          'type' => CRM_Utils_Type::T_TEXT,
          'title' => ts('Help Pre'),
          'description' => ts('Description and/or help text to display before fields in form.'),
          'rows' => 4,
          'cols' => 80,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_uf_group.help_pre',
          'table_name' => 'civicrm_uf_group',
          'entity' => 'UFGroup',
          'bao' => 'CRM_Core_BAO_UFGroup',
          'localizable' => 1,
          'html' => [
            'type' => 'TextArea',
            'label' => ts("Pre Help"),
          ],
          'add' => '1.2',
        ],
        'help_post' => [
          'name' => 'help_post',
          'type' => CRM_Utils_Type::T_TEXT,
          'title' => ts('Profile Post Text'),
          'description' => ts('Description and/or help text to display after fields in form.'),
          'rows' => 4,
          'cols' => 80,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_uf_group.help_post',
          'table_name' => 'civicrm_uf_group',
          'entity' => 'UFGroup',
          'bao' => 'CRM_Core_BAO_UFGroup',
          'localizable' => 1,
          'html' => [
            'type' => 'TextArea',
          ],
          'add' => '1.2',
        ],
        'limit_listings_group_id' => [
          'name' => 'limit_listings_group_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Search Limit Group ID'),
          'description' => ts('Group id, foreign key from civicrm_group'),
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_uf_group.limit_listings_group_id',
          'table_name' => 'civicrm_uf_group',
          'entity' => 'UFGroup',
          'bao' => 'CRM_Core_BAO_UFGroup',
          'localizable' => 0,
          'FKClassName' => 'CRM_Contact_DAO_Group',
          'html' => [
            'label' => ts("Search Limit Group"),
          ],
          'add' => '1.4',
        ],
        'post_url' => [
          'name' => 'post_url',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Post Url'),
          'description' => ts('Redirect to URL on submit.'),
          'maxlength' => 255,
          'size' => CRM_Utils_Type::HUGE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_uf_group.post_url',
          'table_name' => 'civicrm_uf_group',
          'entity' => 'UFGroup',
          'bao' => 'CRM_Core_BAO_UFGroup',
          'localizable' => 0,
          'html' => [
            'label' => ts("Post URL"),
          ],
          'add' => '1.4',
        ],
        'add_to_group_id' => [
          'name' => 'add_to_group_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Add Contact To Group ID'),
          'description' => ts('foreign key to civicrm_group_id'),
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_uf_group.add_to_group_id',
          'table_name' => 'civicrm_uf_group',
          'entity' => 'UFGroup',
          'bao' => 'CRM_Core_BAO_UFGroup',
          'localizable' => 0,
          'FKClassName' => 'CRM_Contact_DAO_Group',
          'html' => [
            'label' => ts("Add Contact To Group"),
          ],
          'add' => NULL,
        ],
        'add_captcha' => [
          'name' => 'add_captcha',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'title' => ts('Show Captcha On Profile'),
          'description' => ts('Should a CAPTCHA widget be included this Profile form.'),
          'required' => TRUE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_uf_group.add_captcha',
          'default' => '0',
          'table_name' => 'civicrm_uf_group',
          'entity' => 'UFGroup',
          'bao' => 'CRM_Core_BAO_UFGroup',
          'localizable' => 0,
          'add' => '1.1',
        ],
        'is_map' => [
          'name' => 'is_map',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'title' => ts('Map Profile'),
          'description' => ts('Do we want to map results from this profile.'),
          'required' => TRUE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_uf_group.is_map',
          'default' => '0',
          'table_name' => 'civicrm_uf_group',
          'entity' => 'UFGroup',
          'bao' => 'CRM_Core_BAO_UFGroup',
          'localizable' => 0,
          'add' => '1.5',
        ],
        'is_edit_link' => [
          'name' => 'is_edit_link',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'title' => ts('Show Edit Link?'),
          'description' => ts('Should edit link display in profile selector'),
          'required' => TRUE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_uf_group.is_edit_link',
          'default' => '0',
          'table_name' => 'civicrm_uf_group',
          'entity' => 'UFGroup',
          'bao' => 'CRM_Core_BAO_UFGroup',
          'localizable' => 0,
          'add' => '1.6',
        ],
        'is_uf_link' => [
          'name' => 'is_uf_link',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'title' => ts('Show Link to CMS User'),
          'description' => ts('Should we display a link to the website profile in profile selector'),
          'required' => TRUE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_uf_group.is_uf_link',
          'default' => '0',
          'table_name' => 'civicrm_uf_group',
          'entity' => 'UFGroup',
          'bao' => 'CRM_Core_BAO_UFGroup',
          'localizable' => 0,
          'add' => '1.7',
        ],
        'is_update_dupe' => [
          'name' => 'is_update_dupe',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'title' => ts('Update on Duplicate'),
          'description' => ts('Should we update the contact record if we find a duplicate'),
          'required' => TRUE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_uf_group.is_update_dupe',
          'default' => '0',
          'table_name' => 'civicrm_uf_group',
          'entity' => 'UFGroup',
          'bao' => 'CRM_Core_BAO_UFGroup',
          'localizable' => 0,
          'add' => '1.7',
        ],
        'cancel_url' => [
          'name' => 'cancel_url',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Profile Cancel URL'),
          'description' => ts('Redirect to URL when Cancel button clicked.'),
          'maxlength' => 255,
          'size' => CRM_Utils_Type::HUGE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_uf_group.cancel_url',
          'table_name' => 'civicrm_uf_group',
          'entity' => 'UFGroup',
          'bao' => 'CRM_Core_BAO_UFGroup',
          'localizable' => 0,
          'html' => [
            'label' => ts("Cancel URL"),
          ],
          'add' => '1.4',
        ],
        'is_cms_user' => [
          'name' => 'is_cms_user',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'title' => ts('Create CMS User?'),
          'description' => ts('Should we create a cms user for this profile '),
          'required' => TRUE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_uf_group.is_cms_user',
          'default' => '0',
          'table_name' => 'civicrm_uf_group',
          'entity' => 'UFGroup',
          'bao' => 'CRM_Core_BAO_UFGroup',
          'localizable' => 0,
          'add' => '1.8',
        ],
        'notify' => [
          'name' => 'notify',
          'type' => CRM_Utils_Type::T_TEXT,
          'title' => ts('Notify on Profile Submit'),
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_uf_group.notify',
          'table_name' => 'civicrm_uf_group',
          'entity' => 'UFGroup',
          'bao' => 'CRM_Core_BAO_UFGroup',
          'localizable' => 0,
          'add' => '1.8',
        ],
        'is_reserved' => [
          'name' => 'is_reserved',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'title' => ts('Profile Is Reserved'),
          'description' => ts('Is this group reserved for use by some other CiviCRM functionality?'),
          'required' => TRUE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_uf_group.is_reserved',
          'default' => '0',
          'table_name' => 'civicrm_uf_group',
          'entity' => 'UFGroup',
          'bao' => 'CRM_Core_BAO_UFGroup',
          'localizable' => 0,
          'html' => [
            'type' => 'Radio',
          ],
          'add' => '3.0',
        ],
        'name' => [
          'name' => 'name',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Profile Name'),
          'description' => ts('Name of the UF group for directly addressing it in the codebase'),
          'maxlength' => 64,
          'size' => CRM_Utils_Type::BIG,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_uf_group.name',
          'table_name' => 'civicrm_uf_group',
          'entity' => 'UFGroup',
          'bao' => 'CRM_Core_BAO_UFGroup',
          'localizable' => 0,
          'add' => '3.0',
        ],
        'created_id' => [
          'name' => 'created_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Created By Contact ID'),
          'description' => ts('FK to civicrm_contact, who created this UF group'),
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_uf_group.created_id',
          'table_name' => 'civicrm_uf_group',
          'entity' => 'UFGroup',
          'bao' => 'CRM_Core_BAO_UFGroup',
          'localizable' => 0,
          'FKClassName' => 'CRM_Contact_DAO_Contact',
          'html' => [
            'label' => ts("Created By"),
          ],
          'add' => '3.0',
        ],
        'created_date' => [
          'name' => 'created_date',
          'type' => CRM_Utils_Type::T_DATE + CRM_Utils_Type::T_TIME,
          'title' => ts('UF Group Created Date'),
          'description' => ts('Date and time this UF group was created.'),
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_uf_group.created_date',
          'table_name' => 'civicrm_uf_group',
          'entity' => 'UFGroup',
          'bao' => 'CRM_Core_BAO_UFGroup',
          'localizable' => 0,
          'add' => '3.0',
        ],
        'is_proximity_search' => [
          'name' => 'is_proximity_search',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'title' => ts('Include Proximity Search?'),
          'description' => ts('Should we include proximity search feature in this profile search form?'),
          'required' => TRUE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_uf_group.is_proximity_search',
          'default' => '0',
          'table_name' => 'civicrm_uf_group',
          'entity' => 'UFGroup',
          'bao' => 'CRM_Core_BAO_UFGroup',
          'localizable' => 0,
          'add' => '3.2',
        ],
        'cancel_button_text' => [
          'name' => 'cancel_button_text',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Cancel Button Text'),
          'description' => ts('Custom Text to display on the Cancel button when used in create or edit mode'),
          'maxlength' => 64,
          'size' => CRM_Utils_Type::BIG,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_uf_group.cancel_button_text',
          'default' => NULL,
          'table_name' => 'civicrm_uf_group',
          'entity' => 'UFGroup',
          'bao' => 'CRM_Core_BAO_UFGroup',
          'localizable' => 1,
          'html' => [
            'type' => 'Text',
          ],
          'add' => '4.7',
        ],
        'submit_button_text' => [
          'name' => 'submit_button_text',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Submit Button Text'),
          'description' => ts('Custom Text to display on the submit button on profile edit/create screens'),
          'maxlength' => 64,
          'size' => CRM_Utils_Type::BIG,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_uf_group.submit_button_text',
          'default' => NULL,
          'table_name' => 'civicrm_uf_group',
          'entity' => 'UFGroup',
          'bao' => 'CRM_Core_BAO_UFGroup',
          'localizable' => 1,
          'html' => [
            'type' => 'Text',
          ],
          'add' => '4.7',
        ],
        'add_cancel_button' => [
          'name' => 'add_cancel_button',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'title' => ts('Include Cancel Button'),
          'description' => ts('Should a Cancel button be included in this Profile form.'),
          'required' => TRUE,
          'usage' => [
            'import' => FALSE,
            'export' => FALSE,
            'duplicate_matching' => FALSE,
            'token' => FALSE,
          ],
          'where' => 'civicrm_uf_group.add_cancel_button',
          'default' => '1',
          'table_name' => 'civicrm_uf_group',
          'entity' => 'UFGroup',
          'bao' => 'CRM_Core_BAO_UFGroup',
          'localizable' => 0,
          'add' => '5.0',
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
    $r = CRM_Core_DAO_AllCoreTables::getImports(__CLASS__, 'uf_group', $prefix, []);
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
    $r = CRM_Core_DAO_AllCoreTables::getExports(__CLASS__, 'uf_group', $prefix, []);
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
      'UI_name' => [
        'name' => 'UI_name',
        'field' => [
          0 => 'name',
        ],
        'localizable' => FALSE,
        'unique' => TRUE,
        'sig' => 'civicrm_uf_group::1::name',
      ],
    ];
    return ($localize && !empty($indices)) ? CRM_Core_DAO_AllCoreTables::multilingualize(__CLASS__, $indices) : $indices;
  }

}
