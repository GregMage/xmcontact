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
$nb_limit = 15;

$pathIcon16 = XOOPS_URL . '/' . $xoopsModule->getInfo('icons16');
$pathIcon32 = XOOPS_URL . '/' . $xoopsModule->getInfo('icons32');
// Include language file
xoops_loadLanguage('admin', 'system');
xoops_loadLanguage('admin', $xoopsModule->getVar('dirname', 'e'));
xoops_loadLanguage('modinfo', $xoopsModule->getVar('dirname', 'e'));
$admin_class = new ModuleAdmin();

// Get handler
$request_Handler = xoops_getModuleHandler('xmcontact_request', 'xmcontact');
$category_Handler = xoops_getModuleHandler('xmcontact_category', 'xmcontact');

// Get main instance
//XoopsLoad::load('system', 'system');

/*$request = Xoops_Request::getInstance();
$helper = Page::getInstance();
$xoops = $helper->xoops();

// Get handler
$content_Handler = $helper->getContentHandler();
$related_Handler = $helper->getRelatedHandler();
$link_Handler = $helper->getLinkHandler();
$rating_Handler = $helper->getRatingHandler();
$gperm_Handler = $helper->getGrouppermHandler();

// Get $_POST, $_GET, $_REQUEST
$op = $request->asStr('op', 'list');
$start = $request->asInt('start', 0);

// Parameters
$nb_limit = $helper->getConfig('page_adminpager');
$module_id = $helper->getModule()->getVar('mid');

// Define Stylesheet
$xoops->theme()->addStylesheet('modules/system/css/admin.css');

// Add Scripts
$xoops->theme()->addScript('media/xoops/xoops.js');*/
