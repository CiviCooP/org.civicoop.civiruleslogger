<?php

class CRM_Civiruleslogger_DatabaseLogger extends Psr\Log\AbstractLogger implements \Psr\Log\LoggerInterface {

  /**
   * Logs with an arbitrary level.
   *
   * @param mixed $level
   * @param string $message
   * @param array $context
   */
  public function log($level, $message, array $context = []): void {
    foreach($context as $key => $value) {
      $message = str_replace('{'.$key.'}', $value, $message);
    }
    $rec = new CRM_Civiruleslogger_DAO_CivirulesLog();
    $separateFields = ['contact_id', 'rule_id'];
    foreach ($separateFields as $separateField) {
      if (isset($context[$separateField])) {
        $rec->{$separateField} = $context[$separateField];
        unset($context[$separateField]);
      }
    }
    $rec->level = $level;
    $rec->message = $message;
    $rec->context = json_encode($context);
    $rec->save();
  }

}
