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
    return true;
}