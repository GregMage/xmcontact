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

// Header
xoops_cp_header();

// Config


$xoopsTpl->assign('navigation', $admin_class->addNavigation('request.php'));
$xoopsTpl->assign('renderindex', $admin_class->renderIndex());
//echo $request_Handler->getCount();

// Get start pager
$start = system_CleanVars($_REQUEST, 'start', 0, 'int');
// Criteria
$criteria = new CriteriaCompo();
$criteria->setStart($start);
$criteria->setLimit($nb_limit);
// Content
$request_count = $request_Handler->getCount($criteria);
$request_arr = $request_Handler->getall($criteria);
$xoopsTpl->assign('request_count', $request_count);

// Define Stylesheet
$xoTheme->addStylesheet(XOOPS_URL . '/modules/system/css/admin.css');
// Assign Template variables
if ($request_count > 0) {
    foreach (array_keys($request_arr) as $i) {
        $request['id'] = $request_arr[$i]->getVar('request_id');
        $request['category'] = $request_arr[$i]->getVar('request_cid');
        $request['subject'] = $request_arr[$i]->getVar('request_subject');
        $request['name'] = $request_arr[$i]->getVar('request_name');
        $request['date_e'] = formatTimestamp($request_arr[$i]->getVar('request_date_e'));
        if ($request_arr[$i]->getVar('request_date_s') == 0) {
            $request['date_s'] = '/';
        } else {
            $request['date_s']    = formatTimestamp($request_arr[$i]->getVar('request_date_s'));
        }
        if ($request_arr[$i]->getVar('request_status') == 0){
            $request['status'] = '<span style="color: red; font-weight:bold;">' . _AM_XMCONTACT_REQUEST_STATUS_NR . '</span>';
        } else {
            $request['status'] = '<span style="color: green; font-weight:bold;">' . _AM_XMCONTACT_REQUEST_STATUS_R . '</span>';
        }
        $xoopsTpl->append_by_ref('request', $request);
        unset($request);
    }
    // Display Page Navigation
    if ($request_count > $nb_limit) {
        $nav = new XoopsPageNav($request_count, $nb_limit, $start, 'start');
        $xoopsTpl->assign('nav_menu', $nav->renderNav(4));
    }
}


// Call template file
$xoopsTpl->display(XOOPS_ROOT_PATH . '/modules/xmcontact/templates/admin/xmcontact_request.tpl');
xoops_cp_footer();