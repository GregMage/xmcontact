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
use Xmf\Module\Admin;

require __DIR__ . '/admin_header.php';

$moduleAdmin = Admin::getInstance();
$moduleAdmin->displayNavigation('index.php');

$moduleAdmin->addConfigModuleVersion('system', 212);

// category
$criteria = new CriteriaCompo();
$criteria->add(new Criteria('category_status', 1));
$category_active = $categoryHandler->getCount($criteria);
$criteria = new CriteriaCompo();
$criteria->add(new Criteria('category_status', 0));
$category_notactive = $categoryHandler->getCount($criteria);
$moduleAdmin->addInfoBox(_AM_XMCONTACT_INDEX_CAT);
$ret = '<span style=\'font-weight: bold; color: green;\'>' . $category_active . '</span>';
$moduleAdmin->addInfoBoxLine(sprintf( $ret . ' ' . _AM_XMCONTACT_INDEX_CAT_ACTIVE));
$ret = '<span style=\'font-weight: bold; color: red;\'>' . $category_notactive . '</span>';
$moduleAdmin->addInfoBoxLine(sprintf( $ret . ' ' . _AM_XMCONTACT_INDEX_CAT_NOTACTIVE));

// request
$criteria = new CriteriaCompo();
$criteria->add(new Criteria('request_status', 1));
$request_reply = $requestHandler->getCount($criteria);
$criteria = new CriteriaCompo();
$criteria->add(new Criteria('request_status', 0));
$request_notreply = $requestHandler->getCount($criteria);
$moduleAdmin->addInfoBox(_AM_XMCONTACT_INDEX_REQUEST);
$ret = '<span style=\'font-weight: bold; color: green;\'>' . $request_reply . '</span>';
$moduleAdmin->addInfoBoxLine(sprintf( $ret . ' ' . _AM_XMCONTACT_INDEX_REQUEST_REPLY));
$ret = '<span style=\'font-weight: bold; color: red;\'>' . $request_notreply . '</span>';
$moduleAdmin->addInfoBoxLine(sprintf( $ret . ' ' . _AM_XMCONTACT_INDEX_CAT_NOTREPLY));

$folder[] = $path_logo;
foreach (array_keys( $folder) as $i) {
    $moduleAdmin->addConfigBoxLine($folder[$i], 'folder');
    $moduleAdmin->addConfigBoxLine(array($folder[$i], '777'), 'chmod');
}



$moduleAdmin->displayIndex();

require __DIR__ . '/admin_footer.php';
