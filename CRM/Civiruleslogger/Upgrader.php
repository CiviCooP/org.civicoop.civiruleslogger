<?php

/**
 * Collection of upgrade steps.
 */
class CRM_Civiruleslogger_Upgrader extends CRM_Civiruleslogger_Upgrader_Base {

  public function install() {
    $this->executeSqlFile('sql/install.sql');
  }

}
