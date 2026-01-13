<?php
declare(strict_types = 1);
use CRM_Civiruleslogger_ExtensionUtil as E;

/**
 * Collection of upgrade steps.
 */
final class CRM_Civiruleslogger_Upgrader extends \CRM_Extension_Upgrader_Base {

  /**
   * Convert message from varchar to text
   *
   * @return TRUE on success
   * @throws CRM_Core_Exception
   */
  public function upgrade_1000(): bool {
    $this->ctx->log->info('Convert message from varchar to text');
    CRM_Core_DAO::executeQuery("ALTER TABLE civirule_civiruleslogger_log MODIFY COLUMN `message` text NOT NULL COMMENT 'Standardised message'");
    return TRUE;
  }

}
