CREATE TABLE `xmcontact_request` (
  `request_id` 				mediumint(8) unsigned 	NOT NULL AUTO_INCREMENT,
  `request_cid` 			smallint(5)  unsigned	NOT NULL DEFAULT '0',
  `request_civility` 		varchar(50) 			NOT NULL DEFAULT '',
  `request_name` 			varchar(50) 			NOT NULL DEFAULT '',
  `request_email` 			varchar(60) 			NOT NULL DEFAULT '',
  `request_phone` 			varchar(20) 			NOT NULL DEFAULT '',
  `request_address` 		text 					NOT NULL,
  `request_url` 			varchar(255) 			NOT NULL DEFAULT '',
  `request_ip` 				varchar(20) 			NOT NULL DEFAULT '',
  `request_subject` 		varchar(100) 			NOT NULL DEFAULT '',
  `request_message` 		text 					NOT NULL,
  `request_date_e` 			int(10) 	 unsigned	NOT NULL DEFAULT '0',
  `request_date_r` 			int(10) 	 unsigned	NOT NULL DEFAULT '0',
  `request_token` 			varchar(40) 			NOT NULL DEFAULT '',
  `request_status` 			tinyint(1)   unsigned	NOT NULL DEFAULT '0',
  PRIMARY KEY (`request_id`),
  KEY `request_name` (`request_name`),
  KEY `request_subject` (`request_subject`)
) ENGINE=MyISAM;

CREATE TABLE `xmcontact_category` (
  `category_id` 			smallint(5) unsigned 	NOT NULL AUTO_INCREMENT,
  `category_title` 			varchar(100) 			NOT NULL DEFAULT '',
  `category_description` 	text 					NOT NULL,
  `category_responsible` 	smallint(5)	unsigned	NOT NULL DEFAULT '0',
  `category_logo` 			varchar(255) 			NOT NULL DEFAULT '',
  `category_civility`     	varchar(2)  		    NOT NULL DEFAULT '10',
  `category_name`         	varchar(2)  		    NOT NULL DEFAULT '10',
  `category_phone`       	varchar(2)  		    NOT NULL DEFAULT '10',
  `category_subject`     	varchar(2)  		    NOT NULL DEFAULT '10',
  `category_address`     	varchar(2)  		    NOT NULL DEFAULT '10',
  `category_url`          	varchar(2)  		    NOT NULL DEFAULT '10',
  `category_signature`   	text 					NOT NULL,
  `category_weight` 		smallint(5)	unsigned	NOT NULL DEFAULT '0',
  `category_status` 		tinyint(1) 	unsigned	NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`),
  KEY `category_title` (`category_title`)
) ENGINE=MyISAM;

CREATE TABLE `xmcontact_answer` (
  `answer_id` 				smallint(5) unsigned 	NOT NULL AUTO_INCREMENT,
  `answer_title` 			varchar(100) 			NOT NULL DEFAULT '',
  `answer_description` 		text 					NOT NULL,
  `answer_answer` 			text 					NOT NULL,
  `answer_weight` 		smallint(5)	unsigned	NOT NULL DEFAULT '0',
  PRIMARY KEY (`answer_id`),
  KEY `answer_title` (`answer_title`)
) ENGINE=MyISAM;