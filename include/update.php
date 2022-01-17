<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * xmcontact module
 *
 * @copyright       XOOPS Project (https://xoops.org)
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @author          Mage Gregory (AKA Mage)
 */

function xoops_module_update_xmcontact(XoopsModule $module, $previousVersion = null) {
    // Passage de la version 0.20 à 1.0
    if ($previousVersion <= 20) {
		//request
        $db = XoopsDatabaseFactory::getDatabaseConnection();
        $sql = "ALTER TABLE `" . $db->prefix('xmcontact_request') . "` ADD `request_form` varchar(50) NOT NULL DEFAULT '';";
        $db->query($sql);
        $sql = "ALTER TABLE `" . $db->prefix('xmcontact_request') . "` ADD `request_address` text NOT NULL;";
        $db->query($sql);
		$sql = "ALTER TABLE `" . $db->prefix('xmcontact_request') . "` ADD `request_url` varchar(255) NOT NULL DEFAULT '';";
        $db->query($sql);
		//category
		$sql = "ALTER TABLE `" . $db->prefix('xmcontact_category') . "` ADD `category_name` tinyint(2) unsigned NOT NULL DEFAULT '10';";
        $db->query($sql);
		$sql = "ALTER TABLE `" . $db->prefix('xmcontact_category') . "` ADD `category_fname` tinyint(2) unsigned NOT NULL DEFAULT '10';";
        $db->query($sql);
		$sql = "ALTER TABLE `" . $db->prefix('xmcontact_category') . "` ADD `category_phone` tinyint(2) unsigned NOT NULL DEFAULT '10';";
        $db->query($sql);
		$sql = "ALTER TABLE `" . $db->prefix('xmcontact_category') . "` ADD `category_subject` tinyint(2) unsigned NOT NULL DEFAULT '10';";
        $db->query($sql);
		$sql = "ALTER TABLE `" . $db->prefix('xmcontact_category') . "` ADD `category_address` tinyint(2) unsigned NOT NULL DEFAULT '10';";
        $db->query($sql);
		$sql = "ALTER TABLE `" . $db->prefix('xmcontact_category') . "` ADD `category_url` tinyint(2) unsigned NOT NULL DEFAULT '10';";
        $db->query($sql);
    }

	// Passage de la version 1.0 à 1.1
    if ($previousVersion <= 100) {
        $db = XoopsDatabaseFactory::getDatabaseConnection();
		//category
		$sql = "ALTER TABLE `" . $db->prefix('xmcontact_category') . "` ADD `category_civility` tinyint(2) unsigned NOT NULL DEFAULT '10' AFTER `category_logo`;";
        $db->query($sql);
    }
	
	// Passage de la version 1.1 à 2.0
    if ($previousVersion <= 110) {
        $db = XoopsDatabaseFactory::getDatabaseConnection();
		//category
		$sql = "ALTER TABLE `" . $db->prefix('xmcontact_category') . "` ADD `category_signature` TEXT NOT NULL AFTER `category_url`;";
        $db->query($sql);
		// answer
		$sql = "CREATE TABLE `" . $db->prefix('xmcontact_answer') . "` ( `answer_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT, `answer_title` varchar(100) NOT NULL DEFAULT '', `answer_description` text NOT NULL, `answer_answer` text NOT NULL, `answer_weight` smallint(5) unsigned NOT NULL DEFAULT '0', PRIMARY KEY (`answer_id`), KEY `answer_title` (`answer_title`) ) ENGINE=MyISAM;";
		$db->query($sql);
		//request
		$sql = "ALTER TABLE `" . $db->prefix('xmcontact_request') . "` ADD `request_token` varchar(40) NOT NULL DEFAULT '' AFTER `request_date_r`;";
        $db->query($sql);
    }
    return true;
}