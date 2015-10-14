<?php

class CRM_Civiruleslogger_DAO_CivirulesLog extends CRM_Core_DAO
{
  /**
   * static instance to hold the table name
   *
   * @var string
   */
  static $_tableName = 'civirule_civiruleslogger_log';
  /**
   * static instance to hold the field values
   *
   * @var array
   */
  static $_fields = null;
  /**
   * static instance to hold the keys used in $_fields for each field.
   *
   * @var array
   */
  static $_fieldKeys = null;
  /**
   * static instance to hold the FK relationships
   *
   * @var string
   */
  static $_links = null;
  /**
   * static instance to hold the values that can
   * be imported
   *
   * @var array
   */
  static $_import = null;
  /**
   * static instance to hold the values that can
   * be exported
   *
   * @var array
   */
  static $_export = null;
  /**
   * static value to see if we should log any modifications to
   * this table in the civicrm_log table
   *
   * @var boolean
   */
  static $_log = false;
  /**
   * Primary key ID
   *
   * @var int unsigned
   */
  public $id;
  /**
   * Standardized message
   *
   * @var string
   */
  public $message;
  /**
   * JSON encoded data
   *
   * @var longtext
   */
  public $context;
  /**
   * error level per PSR3
   *
   * @var string
   */
  public $level;
  /**
   * Timestamp of when event occurred.
   *
   * @var timestamp
   */
  public $timestamp;
  /**
   * Optional Contact ID that created the log. Not an FK as we keep this regardless
   *
   * @var int unsigned
   */
  public $contact_id;

  /**
   * Id of the rule
   *
   * @var int
   */
  public $rule_id;

  /**
   * class constructor
   *
   * @return CRM_Civiruleslogger_DAO_CivirulesLog
   */
  function __construct()
  {
    $this->__table = 'civirule_civiruleslogger_log';
    parent::__construct();
  }
  /**
   * Returns all the column names of this table
   *
   * @return array
   */
  static function &fields()
  {
    if (!(self::$_fields)) {
      self::$_fields = array(
        'id' => array(
          'name' => 'id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('System Log ID') ,
          'description' => 'Primary key ID',
          'required' => true,
        ) ,
        'message' => array(
          'name' => 'message',
          'type' => CRM_Utils_Type::T_LONGTEXT,
          'title' => ts('System Log Message') ,
          'description' => 'Standardized message',
          'required' => true,
        ) ,
        'context' => array(
          'name' => 'context',
          'type' => CRM_Utils_Type::T_LONGTEXT,
          'title' => ts('Detailed Log Data') ,
          'description' => 'JSON encoded data',
        ) ,
        'level' => array(
          'name' => 'level',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Detailed Log Data') ,
          'description' => 'error level per PSR3',
          'maxlength' => 9,
          'size' => CRM_Utils_Type::TWELVE,
          'default' => 'info',
        ) ,
        'timestamp' => array(
          'name' => 'timestamp',
          'type' => CRM_Utils_Type::T_TIMESTAMP,
          'title' => ts('Log Timestamp') ,
          'description' => 'Timestamp of when event occurred.',
          'default' => 'CURRENT_TIMESTAMP',
        ) ,
        'contact_id' => array(
          'name' => 'contact_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Log Contact ID') ,
          'description' => 'Optional Contact ID that created the log. Not an FK as we keep this regardless',
        ) ,
        'rule_id' => array(
          'name' => 'rule_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Rule ID') ,
          'description' => 'Optional Rule ID',
        ) ,
      );
    }
    return self::$_fields;
  }
  /**
   * Returns an array containing, for each field, the arary key used for that
   * field in self::$_fields.
   *
   * @return array
   */
  static function &fieldKeys()
  {
    if (!(self::$_fieldKeys)) {
      self::$_fieldKeys = array(
        'id' => 'id',
        'message' => 'message',
        'context' => 'context',
        'level' => 'level',
        'timestamp' => 'timestamp',
        'contact_id' => 'contact_id',
        'rule_id' => 'rule_id',
      );
    }
    return self::$_fieldKeys;
  }
  /**
   * Returns the names of this table
   *
   * @return string
   */
  static function getTableName()
  {
    return self::$_tableName;
  }
  /**
   * Returns if this table needs to be logged
   *
   * @return boolean
   */
  function getLog()
  {
    return self::$_log;
  }
  /**
   * Returns the list of fields that can be imported
   *
   * @param bool $prefix
   *
   * @return array
   */
  static function &import($prefix = false)
  {
    if (!(self::$_import)) {
      self::$_import = array();
      $fields = self::fields();
      foreach($fields as $name => $field) {
        if (CRM_Utils_Array::value('import', $field)) {
          if ($prefix) {
            self::$_import['civirule_civiruleslogger_log'] = & $fields[$name];
          } else {
            self::$_import[$name] = & $fields[$name];
          }
        }
      }
    }
    return self::$_import;
  }
  /**
   * Returns the list of fields that can be exported
   *
   * @param bool $prefix
   *
   * @return array
   */
  static function &export($prefix = false)
  {
    if (!(self::$_export)) {
      self::$_export = array();
      $fields = self::fields();
      foreach($fields as $name => $field) {
        if (CRM_Utils_Array::value('export', $field)) {
          if ($prefix) {
            self::$_export['civirule_civiruleslogger_log'] = & $fields[$name];
          } else {
            self::$_export[$name] = & $fields[$name];
          }
        }
      }
    }
    return self::$_export;
  }
}
