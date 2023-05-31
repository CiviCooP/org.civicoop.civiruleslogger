<?php
require_once 'civiruleslogger.civix.php';
use CRM_Civiruleslogger_ExtensionUtil as E;

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
    CRM_Core_DAO::executeQuery("DELETE FROM `civirule_civiruleslogger_log` WHERE `rule_id` = %1", [1 => [$id, 'Integer']]);
  }
}

/**
 * Add link to view logs of a particulair rule
 *
 * @param $formName
 * @param $form
 */
function civiruleslogger_civicrm_buildForm($formName, &$form) {
  if ($form instanceof CRM_Civirules_Form_Rule) {
    $ruleId = $form->getVar('ruleId');
    if ($ruleId) {
      $url = CRM_Utils_System::url('civicrm/civirule/rule/log', ['rule_id' => $ruleId]);
      $logCount = CRM_Core_DAO::singleValueQuery("SELECT COUNT(*) FROM `civirule_civiruleslogger_log` WHERE `rule_id` = %1", [
        1 => [
          $ruleId,
          'Integer'
        ]
      ]);

      $form->setPostRuleBlock("
        <div class=\"crm-section\"><div class=\"label\">" . E::ts('Logging') . "</div>
        <div class=\"content\"><a href=\"" . $url . "\">" . E::ts('There are %1 log entries', [1 => $logCount]) . "</a></div><div class=\"clear\"></div></div>"
      );
    }
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
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function civiruleslogger_civicrm_install() {
  _civiruleslogger_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function civiruleslogger_civicrm_enable() {
  _civiruleslogger_civix_civicrm_enable();
}
