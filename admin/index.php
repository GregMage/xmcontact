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
require dirname(__FILE__) . '/header.php';

// header
xoops_cp_header();

// category
$criteria = new CriteriaCompo();
$criteria->add(new Criteria('category_status', 1));
$category_active = $category_Handler->getCount($criteria);
$criteria = new CriteriaCompo();
$criteria->add(new Criteria('category_status', 0));
$category_notactive = $category_Handler->getCount($criteria);
$admin_class->addInfoBox(_AM_XMCONTACT_INDEX_CAT);
$admin_class->addInfoBoxLine(_AM_XMCONTACT_INDEX_CAT, _AM_XMCONTACT_INDEX_CAT_ACTIVE, $category_active, 'green');
$admin_class->addInfoBoxLine(_AM_XMCONTACT_INDEX_CAT, _AM_XMCONTACT_INDEX_CAT_NOTACTIVE, $category_notactive, 'red');

// request
$criteria = new CriteriaCompo();
$criteria->add(new Criteria('request_status', 1));
$request_reply = $request_Handler->getCount($criteria);
$criteria = new CriteriaCompo();
$criteria->add(new Criteria('request_status', 0));
$request_notreply = $request_Handler->getCount($criteria);
$admin_class->addInfoBox(_AM_XMCONTACT_INDEX_REQUEST);
$admin_class->addInfoBoxLine(_AM_XMCONTACT_INDEX_REQUEST, _AM_XMCONTACT_INDEX_REQUEST_REPLY, $request_reply, 'green');
$admin_class->addInfoBoxLine(_AM_XMCONTACT_INDEX_REQUEST, _AM_XMCONTACT_INDEX_CAT_NOTREPLY, $request_notreply, 'red');

// folder
$folder = array(XOOPS_ROOT_PATH . '/uploads/xmcontact/', XOOPS_ROOT_PATH . '/uploads/xmcontact/images',
               XOOPS_ROOT_PATH . '/uploads/xmcontact/images/cats');
foreach (array_keys( $folder) as $i) {
    $admin_class->addConfigBoxLine($folder[$i], 'folder');
    $admin_class->addConfigBoxLine(array($folder[$i], '777'), 'chmod');
}

$xoopsTpl->assign('navigation', $admin_class->addNavigation('index.php'));
$xoopsTpl->assign('renderindex', $admin_class->renderIndex());

// Call template file
$xoopsTpl->display(XOOPS_ROOT_PATH . '/modules/xmcontact/templates/admin/xmcontact_index.tpl');

xoops_cp_footer();