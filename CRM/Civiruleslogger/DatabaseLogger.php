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
    foreach ($context as $key => $value) {
      // Only scalar/stringable values are valid PSR-3 message placeholders;
      // skip others (e.g. arrays) so they don't break interpolation. They
      // still get persisted below via json_encode($context).
      if (is_scalar($value) || (is_object($value) && method_exists($value, '__toString'))) {
        $message = str_replace('{' . $key . '}', (string) $value, $message);
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
