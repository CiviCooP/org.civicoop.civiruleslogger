<?php

require_once 'civiruleslogger.civix.php';

if (!interface_exists("\\Psr\\Log\\LoggerInterface")) {
  require_once('psr/log/LoggerInterface.php');
}
if (!class_exists("\\Psr\\Log\\LogLevel")) {
  require_once('psr/log/LogLevel.php');
}

function civiruleslogger_civirules_logger(\Psr\Log\LoggerInterface &$logger=null) {
  if (empty($logger)) {
    $logger = new CRM_Civiruleslogger_DatabaseLogger();
  }
}

/**
 * When a rule is deleted from the system delete also the corresponding logs
 *
 * @param $op
 * @param $objectName
 * @param $id
 * @param $params
 */
function civiruleslogger_civicrm_post($op, $objectName, $id, &$params) {
  if ($op == 'delete' && $objectName == 'CiviRuleRule') {
    CRM_Core_DAO::executeQuery("DELETE FROM `civirule_civiruleslogger_log` WHERE `rule_id` = %1", array(1=>array($id, 'Integer')));
  }
}

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function civiruleslogger_civicrm_config(&$config) {
  _civiruleslogger_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @param $files array(string)
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function civiruleslogger_civicrm_xmlMenu(&$files) {
  _civiruleslogger_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function civiruleslogger_civicrm_install() {
  _civiruleslogger_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function civiruleslogger_civicrm_uninstall() {
  _civiruleslogger_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function civiruleslogger_civicrm_enable() {
  _civiruleslogger_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function civiruleslogger_civicrm_disable() {
  _civiruleslogger_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed
 *   Based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function civiruleslogger_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _civiruleslogger_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function civiruleslogger_civicrm_managed(&$entities) {
  _civiruleslogger_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function civiruleslogger_civicrm_caseTypes(&$caseTypes) {
  _civiruleslogger_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function civiruleslogger_civicrm_angularModules(&$angularModules) {
_civiruleslogger_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function civiruleslogger_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _civiruleslogger_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Functions below this ship commented out. Uncomment as required.
 *

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function civiruleslogger_civicrm_preProcess($formName, &$form) {

}

*/
