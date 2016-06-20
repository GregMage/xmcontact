CREATE TABLE `xmcontact_request` (
  `request_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `request_cid` int(11) NOT NULL DEFAULT '0',
  `request_name` varchar(255) NOT NULL DEFAULT '',
  `request_email` varchar(255) NOT NULL DEFAULT '',
  `request_phone` varchar(255) NOT NULL DEFAULT '',
  `request_subject` varchar(255) NOT NULL DEFAULT '',
  `request_message` text NOT NULL,
  `request_date` int(10) NOT NULL DEFAULT '0',
  `request_status` tinyint(1) NOT NULL DEFAULT '0',
  `request_ip` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`request_id`),
  KEY `request_name` (`request_name`),
  KEY `request_subject` (`request_subject`)
) ENGINE=MyISAM;