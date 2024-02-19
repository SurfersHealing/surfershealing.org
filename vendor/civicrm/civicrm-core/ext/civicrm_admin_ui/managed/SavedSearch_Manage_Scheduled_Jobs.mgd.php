<?php
use CRM_CivicrmAdminUi_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_Scheduled_Jobs',
    'entity' => 'SavedSearch',
    'cleanup' => 'always',
    'update' => 'unmodified',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Scheduled_Jobs',
        'label' => E::ts('Scheduled Jobs'),
        'form_values' => NULL,
        'mapping_id' => NULL,
        'search_custom_id' => NULL,
        'api_entity' => 'Job',
        'api_params' => [
          'version' => 4,
          'select' => [
            'id',
            'name',
            'description',
            'run_frequency:label',
            'parameters',
            'last_run',
            'is_active',
            'api_entity',
            'api_action',
          ],
          'orderBy' => [],
          'where' => [],
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
    'name' => 'SavedSearch_Scheduled_Jobs_SearchDisplay_Scheduled_Jobs_Table_2',
    'entity' => 'SearchDisplay',
    'cleanup' => 'always',
    'update' => 'unmodified',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Scheduled_Jobs_Table_2',
        'label' => E::ts('Scheduled Jobs Table 2'),
        'saved_search_id.name' => 'Scheduled_Jobs',
        'type' => 'table',
        'settings' => [
          'description' => NULL,
          'sort' => [
            [
              'is_active',
              'DESC',
            ],
            [
              'name',
              'ASC',
            ],
          ],
          'limit' => 50,
          'pager' => [
            'show_count' => TRUE,
            'expose_limit' => TRUE,
            'hide_single' => TRUE,
          ],
          'placeholder' => 5,
          'columns' => [
            [
              'type' => 'html',
              'key' => 'name',
              'dataType' => 'String',
              'label' => E::ts('Job'),
              'sortable' => TRUE,
              'cssRules' => [
                [
                  'disabled',
                  'is_active',
                  '=',
                  FALSE,
                ],
              ],
              'rewrite' => '<b>[name]</b><br>[description]',
            ],
            [
              'type' => 'field',
              'key' => 'run_frequency:label',
              'dataType' => 'String',
              'label' => E::ts('Frequency'),
              'sortable' => TRUE,
              'cssRules' => [
                [
                  'disabled',
                  'is_active',
                  '=',
                  FALSE,
                ],
              ],
            ],
            [
              'type' => 'field',
              'key' => 'last_run',
              'dataType' => 'Timestamp',
              'label' => E::ts('Last Run'),
              'sortable' => TRUE,
              'cssRules' => [
                [
                  'disabled',
                  'is_active',
                  '=',
                  FALSE,
                ],
              ],
            ],
            [
              'type' => 'field',
              'key' => 'is_active',
              'dataType' => 'Boolean',
              'label' => E::ts('Enabled'),
              'sortable' => TRUE,
              'editable' => TRUE,
              'cssRules' => [
                [
                  'disabled',
                  'is_active',
                  '=',
                  FALSE,
                ],
              ],
            ],
            [
              'type' => 'field',
              'key' => 'api_entity',
              'dataType' => 'String',
              'label' => E::ts('API'),
              'sortable' => TRUE,
              'cssRules' => [
                [
                  'disabled',
                  'is_active',
                  '=',
                  FALSE,
                ],
              ],
              'rewrite' => '[api_entity].[api_action]',
            ],
            [
              'text' => '',
              'style' => 'default',
              'size' => 'btn-xs',
              'icon' => 'fa-bars',
              'links' => [
                [
                  'entity' => '',
                  'action' => '',
                  'join' => '',
                  'target' => '',
                  'icon' => 'fa-file-o',
                  'text' => E::ts('View joblog'),
                  'style' => 'default',
                  'path' => 'civicrm/admin/joblog?jid=[id]&reset=1',
                  'condition' => [],
                ],
                [
                  'entity' => '',
                  'action' => '',
                  'join' => '',
                  'target' => '',
                  'icon' => 'fa-play',
                  'text' => E::ts('Execute now'),
                  'style' => 'default',
                  'path' => 'civicrm/admin/job/edit?action=view&id=[id]&reset=1',
                  'condition' => [],
                ],
                [
                  'entity' => 'Job',
                  'action' => 'update',
                  'join' => '',
                  'target' => 'crm-popup',
                  'icon' => 'fa-pencil',
                  'text' => E::ts('Edit Job'),
                  'style' => 'default',
                  'path' => '',
                  'condition' => [],
                ],
                [
                  'entity' => '',
                  'action' => '',
                  'join' => '',
                  'target' => '',
                  'icon' => 'fa-clone',
                  'text' => E::ts('Clone'),
                  'style' => 'secondary',
                  'path' => 'civicrm/admin/job/edit?action=copy&id=[id]',
                  'condition' => [],
                ],
                [
                  'task' => 'enable',
                  'entity' => 'Job',
                  'target' => 'crm-popup',
                  'icon' => 'fa-toggle-on',
                  'text' => E::ts('Enable'),
                  'style' => 'default',
                  'condition' => ['is_active', '=', FALSE],
                ],
                [
                  'task' => 'disable',
                  'entity' => 'Job',
                  'target' => 'crm-popup',
                  'icon' => 'fa-toggle-off',
                  'text' => E::ts('Disable'),
                  'style' => 'default',
                  'condition' => ['is_active', '=', TRUE],
                ],
                [
                  'entity' => 'Job',
                  'action' => 'delete',
                  'join' => '',
                  'target' => 'crm-popup',
                  'icon' => 'fa-trash',
                  'text' => E::ts('Delete Job'),
                  'style' => 'danger',
                  'path' => '',
                  'condition' => [],
                ],
              ],
              'type' => 'menu',
              'alignment' => 'text-right',
            ],
          ],
          'actions' => FALSE,
          'classes' => [
            'table',
            'table-striped',
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
