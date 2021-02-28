<?php
// This file declares a managed database record of type "Job".
// The record will be automatically inserted, updated, or deleted from the
// database as appropriate. For more details, see "hook_civicrm_managed" at:
// http://wiki.civicrm.org/confluence/display/CRMDOC42/Hook+Reference
return [
  0 =>
  [
    'name' => 'Cron:CivirulesLogger.Prunelog',
    'entity' => 'Job',
    'params' =>
    [
      'version' => 3,
      'name' => 'Call CivirulesLogger.PruneLog API',
      'description' => 'Call CivirulesLogger.PruneLog API',
      'run_frequency' => 'Daily',
      'api_entity' => 'CivirulesLogger',
      'api_action' => 'prunelog',
      'parameters' => '',
    ],
  ],
];
