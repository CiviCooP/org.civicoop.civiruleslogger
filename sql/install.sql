CREATE TABLE `civirule_civiruleslogger_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary key ID',
  `message` varchar(128) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Standardized message',
  `context` longtext COLLATE utf8_unicode_ci COMMENT 'JSON encoded data',
  `level` varchar(9) COLLATE utf8_unicode_ci DEFAULT 'info' COMMENT 'error level per PSR3',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Timestamp of when event occurred.',
  `contact_id` int(10) unsigned DEFAULT NULL COMMENT 'Optional Contact ID that created the log. Not an FK as we keep this regardless',
  `rule_id` int(10) unsigned DEFAULT NULL COMMENT 'Optional Contact ID that created the log. Not an FK as we keep this regardless',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci