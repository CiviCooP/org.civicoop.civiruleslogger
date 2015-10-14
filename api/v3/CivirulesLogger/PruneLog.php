<?php

/**
 * CivirulesLogger.PruneLog API
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_civirules_logger_prunelog($params) {
  CRM_Core_DAO::executeQuery("DELETE FROM `civirule_civiruleslogger_log` WHERE `timestamp` < (CURDATE() - INTERVAL 3 MONTH)");

  $returnValues = array();
  return civicrm_api3_create_success($returnValues, $params, 'CivirulesLogger', 'PruneLog');
}

