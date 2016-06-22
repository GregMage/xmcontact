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
$xoopsTpl->assign('navigation', $admin_class->addNavigation('index.php'));
$xoopsTpl->assign('renderindex', $admin_class->renderIndex());

// Call template file
$xoopsTpl->display(XOOPS_ROOT_PATH . '/modules/xmcontact/templates/admin/xmcontact_index.tpl');

xoops_cp_footer();