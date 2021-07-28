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
use Xmf\Request;

require __DIR__ . '/admin_header.php';
$moduleAdmin = Admin::getInstance();
$moduleAdmin->displayNavigation('request.php');

// Get Action type
$op = Request::getCmd('op', 'list');

switch ($op) {
    // list of request
    case 'list':
        default:
        // Get start pager
        $start = Request::getInt('start', 0);
		$xoopsTpl->assign('filter', true);
		// Simple contact
		$xoopsTpl->assign('simplecontact', $simplecontact);
		// Category
		$request_cid = Request::getInt('request_cid', 0);
        $xoopsTpl->assign('request_cid', $request_cid);
		$criteria = new CriteriaCompo();
		$criteria->setSort('category_weight ASC, category_title');
		$criteria->setOrder('ASC');
		$category_arr = $categoryHandler->getAll($criteria);
		if (count($category_arr) > 0) {
			$request_cid_options = '<option value="0"' . ($request_cid == 0 ? ' selected="selected"' : '') . '>' . _ALL .'</option>';
			foreach (array_keys($category_arr) as $i) {
				$request_cid_options .= '<option value="' . $i . '"' . ($request_cid == $i ? ' selected="selected"' : '') . '>' . $category_arr[$i]->getVar('category_title') . '</option>';
			}
			$xoopsTpl->assign('request_cid_options', $request_cid_options);
		}
        // Status
        $request_status = Request::getInt('request_status', 10);
        $xoopsTpl->assign('request_status', $request_status);
        $status_options         = [1 => _AM_XMCONTACT_REQUEST_STATUS_R, 0 => _AM_XMCONTACT_REQUEST_STATUS_NR];
		$request_status_options = '<option value="10"' . ($request_status == 0 ? ' selected="selected"' : '') . '>' . _ALL .'</option>';
        foreach (array_keys($status_options) as $i) {
            $request_status_options .= '<option value="' . $i . '"' . ($request_status == $i ? ' selected="selected"' : '') . '>' . $status_options[$i] . '</option>';
        }
        $xoopsTpl->assign('request_status_options', $request_status_options);
        // Criteria
        $criteria = new CriteriaCompo();
		if ($request_cid != 0){
			$criteria->add(new Criteria('request_cid', $request_cid));
		}
        if ($request_status != 10){
			$criteria->add(new Criteria('request_status', $request_status));
		} 
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
				if (strlen($request_arr[$i]->getVar('request_subject')) > 300){
					$request['subject'] = substr($request_arr[$i]->getVar('request_subject'), 0, 300) . '...';
				} else {
					$request['subject'] = $request_arr[$i]->getVar('request_subject');
				}
                $request['name'] = $request_arr[$i]->getVar('request_name');
                $request['date_e'] = formatTimestamp($request_arr[$i]->getVar('request_date_e'), 'm');
                if (0 == $request_arr[$i]->getVar('request_date_r')) {
                    $request['date_r'] = '/';
                } else {
                    $request['date_r']    = formatTimestamp($request_arr[$i]->getVar('request_date_r'), 'm');
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
                $nav = new XoopsPageNav($request_count, $nb_limit, $start, 'start', 'request_cid=' . $request_cid . '&request_status=' . $request_status);
                $xoopsTpl->assign('nav_menu', $nav->renderNav(4));
            }
        }
        break;

    // list of request
    case 'view':
		// Module admin
        $moduleAdmin->addItemButton(_AM_XMCONTACT_REQUEST_LIST, 'request.php', 'list');
        $xoopsTpl->assign('renderbutton', $moduleAdmin->renderButton());
        // Define Stylesheet
        $xoTheme->addStylesheet(XOOPS_URL . '/modules/system/css/admin.css');
        
        $xoopsTpl->assign('view', 'view');
        
        $request_id = Request::getInt('request_id', 0);
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
		if (empty($category)) {
			$category_title = '';
		} else {
			$category_title = $category->getVar('category_title');
		}
        $request_arr = array(_AM_XMCONTACT_CATEGORY => $category_title,
							 _AM_XMCONTACT_REQUEST_CIVILITY => $request->getVar('request_civility'),
                             _AM_XMCONTACT_REQUEST_SUBMITTER => $request->getVar('request_name'),
							 _AM_XMCONTACT_REQUEST_EMAIL => $request->getVar('request_email'),
							 _AM_XMCONTACT_REQUEST_PHONE => $request->getVar('request_phone'),
							 _AM_XMCONTACT_REQUEST_ADDRESS => $request->getVar('request_address'),
							 _AM_XMCONTACT_REQUEST_URL => '<a href="' . $request->getVar('request_url') . '" target="_blank">' . $request->getVar('request_url') . '</a>',
                             _AM_XMCONTACT_REQUEST_SUBJECT => $request->getVar('request_subject'),
							 _AM_XMCONTACT_REQUEST_MESSAGE => $request->getVar('request_message', 'show'),
                             _AM_XMCONTACT_REQUEST_IP => $request->getVar('request_ip'),
                             _AM_XMCONTACT_REQUEST_DATES => formatTimestamp($request->getVar('request_date_e')),
                             _AM_XMCONTACT_REQUEST_DATER => $date_r,
                             _AM_XMCONTACT_STATUS => $status,
                             );

        $xoopsTpl->assign('request_arr', $request_arr);
        $xoopsTpl->assign('request_id', $request_id);
        break;

    // edit status
    case 'edit':
		// Module admin
        $moduleAdmin->addItemButton(_AM_XMCONTACT_REQUEST_LIST, 'request.php', 'list');
        $xoopsTpl->assign('renderbutton', $moduleAdmin->renderButton());
        // Create form
		$request_id = Request::getInt('request_id', 0);
        $obj  = $requestHandler->get($request_id);
        $form = $obj->getFormEdit();
        // Assign form
        $xoopsTpl->assign('form', $form->render());
        break;

    // save status
    case 'save':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('request.php', 3, implode('<br />', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        $request_id = Request::getInt('request_id', 0);
        $request_status = Request::getInt('request_status', 0, 'POST');
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
		$xoTheme->addScript('modules/xmcontact/assets/js/xmcontact_answer.js');
		// Module admin
        $moduleAdmin->addItemButton(_AM_XMCONTACT_REQUEST_LIST, 'request.php', 'list');
        $xoopsTpl->assign('renderbutton', $moduleAdmin->renderButton());
        // Create form
		$request_id = Request::getInt('request_id', 0);

        // Create form
        $obj  = $requestHandler->get($request_id);
        $form = $obj->getFormReply();
        // Assign form
        $xoopsTpl->assign('form', $form->render());
        break;
    
    // send
    case 'send':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('request.php', 3, implode('<br />', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        $request_id = Request::getInt('request_id', 0);
        // error
        $message_error = '';
        
        if ($request_id > 0) {
            $xoopsMailer = xoops_getMailer();
            $xoopsMailer->useMail();
            $xoopsMailer->setToEmails($_POST['toemail']);
            $xoopsMailer->setFromEmail($_POST['xmcontact_mail']);
            $xoopsMailer->setFromName($_POST['xmcontact_submitter']);
            $xoopsMailer->setSubject($_POST['xmcontact_subject']);
			$message = Request::getText('xmcontact_message', '');
            $xoopsMailer->setBody($message);
			if (Request::getInt('request_saveanswer', 0) == 1){
				$answer_mesage = substr($message, 0, strpos($message, '-----------------------------------------------------------------------------------------------------'));
				$answer_mesage = str_replace($_POST['xmcontact_signature'], '', $answer_mesage);
				//echo $answer_mesage;
			}

            if ($xoopsMailer->send()) {
                $obj = $requestHandler->get($request_id);
                $obj->setVar('request_date_r', time());
                $obj->setVar('request_status', 1);
                if ($requestHandler->insert($obj)) {
					if (Request::getInt('request_saveanswer', 0) == 0){
						redirect_header('request.php', 2, _AM_XMCONTACT_REQUEST_SENDEMAIL . '<br />' . _AM_XMCONTACT_REDIRECT_SAVE);
					} else {
						// Define Stylesheet
						$xoTheme->addStylesheet(XOOPS_URL . '/modules/system/css/admin.css');
						$xoopsTpl->assign('message_sucess', _AM_XMCONTACT_REQUEST_SENDEMAIL . '<br />' . _AM_XMCONTACT_REDIRECT_SAVE);
						// Create form
						$obj  = $answerHandler->create();
						$form = $obj->getForm('answer.php', $answer_mesage);
						// Assign form
						$xoopsTpl->assign('form', $form->render());
					}
                } else {
					$message_error .= $obj->getHtmlErrors();
				}
            } else {
                $message_error .= $xoopsMailer->getErrors();
            }
            if ('' != $message_error) {
				// Define Stylesheet
				$xoTheme->addStylesheet(XOOPS_URL . '/modules/system/css/admin.css');
				// Module admin
				$moduleAdmin->addItemButton(_AM_XMCONTACT_REQUEST_LIST, 'request.php', 'list');
				$xoopsTpl->assign('renderbutton', $moduleAdmin->renderButton());
                $xoopsTpl->assign('message_error', $message_error);
				if (Request::getInt('request_saveanswer', 0) == 1){
					// Create form
					$obj  = $answerHandler->create();
					$form = $obj->getForm('answer.php', $answer_mesage);
					// Assign form
					$xoopsTpl->assign('form', $form->render());
				}
            }
        }
        break;

    // del
    case 'del':
        // Create form
        $request_id = Request::getInt('request_id', 0);
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
$xoopsTpl->display("db:xmcontact_admin_request.tpl");
require __DIR__ . '/admin_footer.php';
