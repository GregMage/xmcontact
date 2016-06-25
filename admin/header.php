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
 * @copyright       XOOPS Project (http://xoops.org)
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @author          Mage Gregory (AKA Mage)
 */

require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/include/cp_header.php';
include_once $GLOBALS['xoops']->path('Frameworks/moduleclasses/moduleadmin/moduleadmin.php');
require_once dirname(dirname(dirname(__FILE__))) . '/system/include/functions.php';
include_once XOOPS_ROOT_PATH.'/class/pagenav.php';

global $xoopsModule;

// Config
$uploaddir = XOOPS_ROOT_PATH . '/uploads/xmcontact/images/cats/';
$uploadurl = XOOPS_URL . '/uploads/xmcontact/images/cats/';
$upload_size = 500000;
$nb_limit = $xoopsModuleConfig['admin_perpage'];
$pathIcon16 = XOOPS_URL . '/' . $xoopsModule->getInfo('icons16');
$pathIcon32 = XOOPS_URL . '/' . $xoopsModule->getInfo('icons32');
// Include language file
xoops_loadLanguage('admin', 'system');
xoops_loadLanguage('admin', $xoopsModule->getVar('dirname', 'e'));
xoops_loadLanguage('modinfo', $xoopsModule->getVar('dirname', 'e'));
$admin_class = new ModuleAdmin();

// Get handler
$category_Handler = xoops_getModuleHandler('xmcontact_category', 'xmcontact');
$request_Handler = xoops_getModuleHandler('xmcontact_request', 'xmcontact');
// joint
$request_Handler->table_link = $request_Handler->db->prefix('xmcontact_category'); // Nom de la table en jointure
$request_Handler->field_link = 'category_id'; // champ de la table en jointure
$request_Handler->field_object = 'request_cid'; // champ de la table courante