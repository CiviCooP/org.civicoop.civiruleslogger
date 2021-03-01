<?php

class CRM_Civiruleslogger_Page_ViewLog extends CRM_Core_Page {

  protected $ruleId;

  protected $rule;

  public function run() {
    $this->ruleId = CRM_Utils_Request::retrieve('rule_id', 'Integer');
    $this->rule = new CRM_Civirules_BAO_Rule();
    if (!empty($this->ruleId)) {
      $this->rule->id = $this->ruleId;
      if (!$this->rule->find(TRUE)) {
        throw new Exception('Civirules could not find rule');
      }
    } else {
      throw new Exception('Civirules could not find rule');
    }

    // Example: Set the page-title dynamically; alternatively, declare a static title in xml/Menu/*.xml
    CRM_Utils_System::setTitle(ts('View log for rule: "%1"', [1=>$this->rule->label]));
    $this->assign('rule', $this->rule);

    $total = CRM_Core_DAO::singleValueQuery("SELECT COUNT(*) FROM `civirule_civiruleslogger_log` WHERE `rule_id` = %1", [1 => [$this->ruleId, 'Integer']]);
    $params['total'] = $total;
    $params['currentPage'] = $this->get(CRM_Utils_Pager::PAGE_ID);
    $params['rowCount'] = CRM_Utils_Pager::ROWCOUNT;
    $params['status'] = ts('Log entries %%StatusMessage%%');
    $this->_pager = new CRM_Utils_Pager($params);
    $this->assign_by_ref('pager', $this->_pager);
    list($this->_pagerOffset, $this->_pagerRowCount) = $this->_pager->getOffsetAndRowCount();

    $logEntries = [];
    $queryParams = [
      1 => [$this->ruleId, 'Integer'],
      2 => [$this->_pagerOffset, 'Integer'],
      3 => [$this->_pagerRowCount, 'Integer'],
    ];
    $dao = CRM_Core_DAO::executeQuery("SELECT * FROM `civirule_civiruleslogger_log` WHERE `rule_id` = %1 ORDER BY `timestamp` DESC LIMIT %2, %3", $queryParams);
    while($dao->fetch()) {
      $entry = [];
      $entry['id'] = $dao->id;
      $entry['message'] = $dao->message;
      $entry['context'] = print_r(json_decode($dao->context, true), true);
      $entry['level'] = $dao->level;
      $timestamp = new DateTime($dao->timestamp);
      $entry['timestamp'] = $timestamp->format('Y-m-d H:i');
      $entry['contact_id'] = $dao->contact_id;
      $entry['display_name'] = CRM_Contact_BAO_Contact::displayName($dao->contact_id);
      $entry['contact_link'] = '';
      if (!empty($entry['display_name'])) {
        $entry['contact_link'] = CRM_Utils_System::url('civicrm/contact/view', ['reset' => 1, 'cid' => $dao->contact_id]);
      }
      $logEntries[] = $entry;
    }

    $this->assign('logEntries', $logEntries);

    parent::run();
  }

}
