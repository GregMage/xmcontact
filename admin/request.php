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
require __DIR__ . '/header.php';

// Header
xoops_cp_header();

// Get Action type
$op = XoopsRequest::getCmd('op', 'list');

switch ($op) {
    // list of request
    case 'list':
        default:
        //navigation
        $xoopsTpl->assign('navigation', $admin_class->addNavigation('request.php'));
        $xoopsTpl->assign('renderindex', $admin_class->renderIndex());

        // Get start pager
        $start = XoopsRequest::getInt('start', 0);
        // Criteria
        $criteria = new CriteriaCompo();
        $criteria->setStart($start);
        $criteria->setLimit($nb_limit);
        // Content
        $request_count = $requestHandler->getCount($criteria);
        $request_arr = $requestHandler->getByLink($criteria);
        $xoopsTpl->assign('request_count', $request_count);
        // Define Stylesheet
        $xoTheme->addStylesheet(XOOPS_URL . '/modules/system/css/admin.css');
        // Assign Template variables
        if ($request_count > 0) {
            foreach (array_keys($request_arr) as $i) {
                $request['id'] = $request_arr[$i]->getVar('request_id');
                $request['category'] = $request_arr[$i]->getVar('category_title');
                $request['subject'] = $request_arr[$i]->getVar('request_subject');
                $request['name'] = $request_arr[$i]->getVar('request_name');
                $request['date_e'] = formatTimestamp($request_arr[$i]->getVar('request_date_e'));
                if (0 == $request_arr[$i]->getVar('request_date_r')) {
                    $request['date_r'] = '/';
                } else {
                    $request['date_r']    = formatTimestamp($request_arr[$i]->getVar('request_date_r'));
                }
                if (0 == $request_arr[$i]->getVar('request_status')) {
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
        break;

    // list of request
    case 'view':
        //navigation
        $xoopsTpl->assign('navigation', $admin_class->addNavigation('request.php'));
        $xoopsTpl->assign('renderindex', $admin_class->renderIndex());
        // Define button addItemButton
        $admin_class->addItemButton(_AM_XMCONTACT_REQUEST_LIST, 'request.php', 'list');
        $xoopsTpl->assign('renderbutton', $admin_class->renderButton());
        // Define Stylesheet
        $xoTheme->addStylesheet(XOOPS_URL . '/modules/system/css/admin.css');
        
        $xoopsTpl->assign('view', 'view');
        
        $request_id = XoopsRequest::getInt('request_id', 0);
        $request = $requestHandler->get($request_id);
        
        if (0 == $request->getVar('request_date_r')) {
            $date_r = '/';
        } else {
            $date_r = formatTimestamp($request->getVar('request_date_r'));
        }
        if (0 == $request->getVar('request_status')) {
            $status = '<span style="color: red; font-weight:bold;">' . _AM_XMCONTACT_REQUEST_STATUS_NR . '</span>';
        } else {
            $status = '<span style="color: green; font-weight:bold;">' . _AM_XMCONTACT_REQUEST_STATUS_R . '</span>';
        }
        $category = $categoryHandler->get($request->getVar('request_cid'));
        $category_title = $category->getVar('category_title');
        $request_arr = array(_AM_XMCONTACT_CATEGORY => $category_title,
                             _AM_XMCONTACT_REQUEST_SUBJECT => $request->getVar('request_subject'),
                             _AM_XMCONTACT_REQUEST_SUBMITTER => $request->getVar('request_name'),
                             _AM_XMCONTACT_REQUEST_SUBJECT => $request->getVar('request_subject'),
                             _AM_XMCONTACT_REQUEST_EMAIL => $request->getVar('request_email'),
                             _AM_XMCONTACT_REQUEST_PHONE => $request->getVar('request_phone'),
                             _AM_XMCONTACT_REQUEST_IP => $request->getVar('request_ip'),
                             _AM_XMCONTACT_REQUEST_DATES => formatTimestamp($request->getVar('request_date_e')),
                             _AM_XMCONTACT_REQUEST_DATER => $date_r,
                             _AM_XMCONTACT_STATUS => $status,
                             _AM_XMCONTACT_REQUEST_MESSAGE => $request->getVar('request_message', 'show'),
                             );

        $xoopsTpl->assign('request_arr', $request_arr);
        $xoopsTpl->assign('request_id', $request_id);
        break;

    // edit status
    case 'edit':
        //navigation
        $xoopsTpl->assign('navigation', $admin_class->addNavigation('request.php'));
        $xoopsTpl->assign('renderindex', $admin_class->renderIndex());
        // Define button addItemButton
        $admin_class->addItemButton(_AM_XMCONTACT_REQUEST_LIST, 'request.php', 'list');
        $xoopsTpl->assign('renderbutton', $admin_class->renderButton());

        // Create form
        $obj  = $requestHandler->get(XoopsRequest::getInt('request_id', 0));
        $form = $obj->getFormEdit();
        // Assign form
        $xoopsTpl->assign('form', $form->render());
        break;

    // save status
    case 'save':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('request.php', 3, implode('<br />', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        $request_id = XoopsRequest::getInt('request_id', 0);
        $request_status = XoopsRequest::getInt('request_status', 0, 'POST');
        if ($request_id > 0) {
            $obj = $requestHandler->get($request_id);
            if (1 == $request_status) {
                $obj->setVar('request_date_r', time());
            } else {
                $obj->setVar('request_date_r', 0);
            }
            $obj->setVar('request_status', $request_status);
            if ($requestHandler->insert($obj)) {
                redirect_header('request.php', 2, _AM_XMCONTACT_REDIRECT_SAVE);
            }
            echo $obj->getHtmlErrors();
        }
        break;

    // reply
    case 'reply':
        //navigation
        $xoopsTpl->assign('navigation', $admin_class->addNavigation('request.php'));
        $xoopsTpl->assign('renderindex', $admin_class->renderIndex());
        // Define button addItemButton
        $admin_class->addItemButton(_AM_XMCONTACT_REQUEST_LIST, 'request.php', 'list');
        $xoopsTpl->assign('renderbutton', $admin_class->renderButton());

        // Create form
        $obj  = $requestHandler->get(XoopsRequest::getInt('request_id', 0));
        $form = $obj->getFormReply();
        // Assign form
        $xoopsTpl->assign('form', $form->render());
        break;
    
    // send
    case 'send':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('request.php', 3, implode('<br />', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        $request_id = XoopsRequest::getInt('request_id', 0);
        // error
        $message_error = '';
        
        if ($request_id > 0) {
            $xoopsMailer = xoops_getMailer();
            $xoopsMailer->useMail();
            $xoopsMailer->setToEmails($_POST['toemail']);
            $xoopsMailer->setFromEmail($_POST['xmcontact_mail']);
            $xoopsMailer->setFromName($_POST['xmcontact_submitter']);
            $xoopsMailer->setSubject($_POST['xmcontact_subject']);
            $xoopsMailer->setBody($_POST['xmcontact_message']);
            if ($xoopsMailer->send()) {
                $message = _AM_XMCONTACT_REQUEST_SENDEMAIL;
                $obj = $requestHandler->get($request_id);
                $obj->setVar('request_date_r', time());
                $obj->setVar('request_status', 1);
                if ($requestHandler->insert($obj)) {
                    redirect_header('request.php', 2, _AM_XMCONTACT_REQUEST_SENDEMAIL . '<br />' . _AM_XMCONTACT_REDIRECT_SAVE);
                }
                $message_error .= $obj->getHtmlErrors();
            } else {
                $message_error .= $xoopsMailer->getErrors();
            }
            if ('' != $message_error) {
                // Define button addItemButton
                $admin_class->addItemButton(_AM_XMCONTACT_REQUEST_LIST, 'request.php', 'list');
                $xoopsTpl->assign('renderbutton', $admin_class->renderButton());
                $xoopsTpl->assign('message_error', $message_error);
            }
        }
        break;

    // del
    case 'del':
        // Create form
        $request_id = XoopsRequest::getInt('request_id', 0);
        $obj  = $requestHandler->get($request_id);

        if (isset($_POST['ok']) && 1 == $_POST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('request.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($requestHandler->delete($obj)) {
                redirect_header('request.php', 2, _AM_XMCONTACT_REDIRECT_SAVE);
            } else {
                xoops_error($obj->getHtmlErrors());
            }
        } else {
            xoops_confirm(array(
                              'ok' => 1,
                              'request_id' => $request_id,
                              'op' => 'del'), $_SERVER['REQUEST_URI'], sprintf(_AM_XMCONTACT_REQUEST_SUREDEL, $obj->getVar('request_name')) . '<br \>' . $obj->getVar('request_subject') . '<br \>');
        }
        break;
}
// Call template file
$xoopsTpl->display(XOOPS_ROOT_PATH . '/modules/xmcontact/templates/admin/xmcontact_request.tpl');
xoops_cp_footer();
