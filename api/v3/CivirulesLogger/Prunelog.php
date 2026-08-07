<?php

/**
 * CivirulesLogger.PruneLog API
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws CRM_Core_Exception
 */
function civicrm_api3_civirules_logger_prunelog($params) {
  $retentionDays = $params['retention_days'] ?? 90;
  CRM_Core_DAO::executeQuery(
    "DELETE FROM `civirule_civiruleslogger_log` WHERE `timestamp` < (CURDATE() - INTERVAL %1 DAY)",
    [1 => [(int) $retentionDays, 'Integer']]
  );

  $returnValues = ['retention_days' => $retentionDays];
  return civicrm_api3_create_success($returnValues, $params, 'CivirulesLogger', 'Prunelog');
}

/**
 * CivirulesLogger.PruneLog API spec
 *
 * @param array $params
 */
function _civicrm_api3_civirules_logger_Prunelog_spec(&$params) {
  $params['retention_days'] = [
    'title' => 'Retention (days)',
    'type' => CRM_Utils_Type::T_INT,
    'api.default' => 90,
    'description' => 'Delete civiruleslogger log entries older than this many days',
  ];
}

