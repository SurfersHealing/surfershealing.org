<?php
use CRM_CivicrmAdminUi_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_Administer_Scheduled_Reminders',
    'entity' => 'SavedSearch',
    'cleanup' => 'always',
    'update' => 'unmodified',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Administer_Scheduled_Reminders',
        'label' => E::ts('Administer Scheduled Reminders'),
        'form_values' => NULL,
        'mapping_id' => NULL,
        'search_custom_id' => NULL,
        'api_entity' => 'ActionSchedule',
        'api_params' => [
          'version' => 4,
          'select' => [
            'title',
            'mapping_id:label',
            'entity_value:label',
            'entity_status:label',
            'is_repeat',
            'is_active',
            'start_action_offset',
            'start_action_unit:label',
            'start_action_condition',
            'start_action_date:label',
            'absolute_date',
          ],
          'orderBy' => [],
          'where' => [
            ['used_for', 'IS EMPTY'],
          ],
          'groupBy' => [],
          'join' => [],
          'having' => [],
        ],
        'expires_date' => NULL,
        'description' => NULL,
      ],
      'match' => [
        'name',
      ],
    ],
  ],
  [
    'name' => 'SavedSearch_Administer_Scheduled_Reminders_SearchDisplay_Administer_Scheduled_Reminders_Table',
    'entity' => 'SearchDisplay',
    'cleanup' => 'always',
    'update' => 'unmodified',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Administer_Scheduled_Reminders_Table',
        'label' => E::ts('Administer Scheduled Reminders Table'),
        'saved_search_id.name' => 'Administer_Scheduled_Reminders',
        'type' => 'table',
        'settings' => [
          'description' => NULL,
          'sort' => [
            [
              'title',
              'ASC',
            ],
          ],
          'limit' => 50,
          'pager' => [],
          'placeholder' => 5,
          'columns' => [
            [
              'type' => 'field',
              'key' => 'title',
              'dataType' => 'String',
              'label' => E::ts('Title'),
              'sortable' => TRUE,
              'editable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'mapping_id:label',
              'dataType' => 'String',
              'label' => E::ts('Used For'),
              'sortable' => TRUE,
              'rewrite' => '[mapping_id:label] - [entity_value:label]',
            ],
            [
              'type' => 'field',
              'key' => 'absolute_date',
              'dataType' => 'Date',
              'label' => E::ts('When'),
              'sortable' => TRUE,
              'empty_value' => '[start_action_offset] [start_action_unit:label] [start_action_condition] [start_action_date:label]',
            ],
            [
              'type' => 'field',
              'key' => 'entity_status:label',
              'dataType' => 'String',
              'label' => E::ts('While'),
              'sortable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'is_repeat',
              'dataType' => 'Boolean',
              'label' => E::ts('Repeat'),
              'sortable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'is_active',
              'dataType' => 'Boolean',
              'label' => E::ts('Enabled'),
              'sortable' => TRUE,
              'editable' => TRUE,
            ],
            [
              'size' => 'btn-xs',
              'links' => [
                [
                  'entity' => 'ActionSchedule',
                  'action' => 'update',
                  'join' => '',
                  'target' => 'crm-popup',
                  'icon' => 'fa-pencil',
                  'text' => E::ts('Update'),
                  'style' => 'default',
                  'path' => '',
                  'task' => '',
                  'condition' => [],
                ],
                [
                  'task' => 'disable',
                  'entity' => 'ActionSchedule',
                  'join' => '',
                  'target' => 'crm-popup',
                  'icon' => 'fa-toggle-off',
                  'text' => E::ts('Disable'),
                  'style' => 'default',
                  'path' => '',
                  'action' => '',
                  'condition' => [
                    'is_active',
                    '=',
                    TRUE,
                  ],
                ],
                [
                  'task' => 'enable',
                  'entity' => 'ActionSchedule',
                  'join' => '',
                  'target' => 'crm-popup',
                  'icon' => 'fa-toggle-on',
                  'text' => E::ts('Enable'),
                  'style' => 'default',
                  'path' => '',
                  'action' => '',
                  'condition' => [
                    'is_active',
                    '=',
                    FALSE,
                  ],
                ],
                [
                  'entity' => 'ActionSchedule',
                  'action' => 'delete',
                  'join' => '',
                  'target' => 'crm-popup',
                  'icon' => 'fa-trash',
                  'text' => E::ts('Delete'),
                  'style' => 'danger',
                  'path' => '',
                  'task' => '',
                  'condition' => [],
                ],
              ],
              'type' => 'buttons',
              'alignment' => 'text-right',
            ],
          ],
          'actions' => FALSE,
          'classes' => [
            'table',
            'table-striped',
            'crm-sticky-header',
          ],
          'addButton' => [
            'path' => 'civicrm/admin/scheduleReminders/edit?reset=1&action=add',
            'text' => E::ts('Add Scheduled Reminder'),
            'icon' => 'fa-plus',
          ],
        ],
        'acl_bypass' => FALSE,
      ],
      'match' => [
        'name',
        'saved_search_id',
      ],
    ],
  ],
];
