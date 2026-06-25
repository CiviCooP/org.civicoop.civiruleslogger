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
    // PSR-3 placeholder interpolation: only replace {key} with values that can
    // be safely cast to a string. Array/object context values (e.g. the nested
    // rule action that CRM_Civirules_Utils_LoggerFactory::logError() passes in)
    // must be skipped, otherwise str_replace() throws a TypeError on PHP 8 and
    // the logger crashes exactly when it is trying to log an error.
    foreach($context as $key => $value) {
      if (is_scalar($value) || $value === NULL || (is_object($value) && method_exists($value, '__toString'))) {
        $message = str_replace('{'.$key.'}', (string) $value, $message);
      }
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
