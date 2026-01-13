<?php
use CRM_Civiruleslogger_ExtensionUtil as E;

return [
  'name' => 'CivirulesLog',
  'table' => 'civirule_civiruleslogger_log',
  'class' => 'CRM_Civiruleslogger_DAO_CivirulesLog',
  'getInfo' => fn() => [
    'title' => E::ts('Civirules Log'),
    'title_plural' => E::ts('Civirules Logs'),
    'description' => E::ts('Civirules logger log'),
    'log' => TRUE,
  ],
  'getFields' => fn() => [
    'id' => [
      'title' => E::ts('ID'),
      'sql_type' => 'int unsigned',
      'input_type' => 'Number',
      'required' => TRUE,
      'description' => E::ts('Unique CivirulesLog ID'),
      'primary_key' => TRUE,
      'auto_increment' => TRUE,
    ],
    'message' => [
      'title' => E::ts('Message'),
      'sql_type' => 'text',
      'input_type' => 'Text',
      'required' => TRUE,
      'description' => E::ts('Standardized message'),
    ],
    'context' => [
      'title' => E::ts('Context'),
      'sql_type' => 'longtext',
      'input_type' => 'TextArea',
      'description' => E::ts('JSON encoded data'),
    ],
    'level' => [
      'title' => E::ts('Level'),
      'sql_type' => 'varchar(9)',
      'input_type' => 'Text',
      'description' => E::ts('error level per PSR3'),
      'default' => 'info',
    ],
    'timestamp' => [
      'title' => E::ts('Timestamp'),
      'sql_type' => 'timestamp',
      'input_type' => NULL,
      'required' => TRUE,
      'description' => E::ts('Timestamp of when event occurred.'),
      'default' => 'CURRENT_TIMESTAMP',
    ],
    'contact_id' => [
      'title' => E::ts('Contact ID'),
      'sql_type' => 'int unsigned',
      'input_type' => 'Number',
      'description' => E::ts('Optional Contact ID that created the log. Not an FK as we keep this regardless'),
      'default' => NULL,
    ],
    'rule_id' => [
      'title' => E::ts('Rule ID'),
      'sql_type' => 'int unsigned',
      'input_type' => 'Number',
      'description' => E::ts('Optional Rule ID that created the log'),
      'default' => NULL,
    ],
  ],
];
