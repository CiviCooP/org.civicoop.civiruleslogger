<?php
use CRM_Civiruleslogger_ExtensionUtil as E;

class CRM_Civiruleslogger_BAO_CivirulesLog extends CRM_Civiruleslogger_DAO_CivirulesLog {

  /**
   * Create a new CivirulesLog based on array-data
   *
   * @param array $params key-value pairs
   * @return CRM_Civiruleslogger_DAO_CivirulesLog|NULL
   *
  public static function create($params) {
    $className = 'CRM_Civiruleslogger_DAO_CivirulesLog';
    $entityName = 'CivirulesLog';
    $hook = empty($params['id']) ? 'create' : 'edit';

    CRM_Utils_Hook::pre($hook, $entityName, CRM_Utils_Array::value('id', $params), $params);
    $instance = new $className();
    $instance->copyValues($params);
    $instance->save();
    CRM_Utils_Hook::post($hook, $entityName, $instance->id, $instance);

    return $instance;
  } */

}
