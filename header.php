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

include '../../mainfile.php';
require_once dirname(__DIR__) . '/system/include/functions.php';
XoopsLoad::load('XoopsRequest');
//include_once XOOPS_ROOT_PATH . "/class/xoopsformloader.php";


// Include language file
//xoops_loadLanguage('admin', 'system');
//xoops_loadLanguage('admin', $xoopsModule->getVar('dirname', 'e'));
//xoops_loadLanguage('modinfo', $xoopsModule->getVar('dirname', 'e'));

// Get handler
$requestHandler = xoops_getModuleHandler('xmcontact_request', 'xmcontact');
$categoryHandler = xoops_getModuleHandler('xmcontact_category', 'xmcontact');
