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
$moduleAdmin->displayNavigation('answer.php');


// Get Action type
$op = Request::getCmd('op', 'list');

switch ($op) {
    // list of answer
    case 'list':
        default:
        // Define Stylesheet
        $xoTheme->addStylesheet(XOOPS_URL . '/modules/system/css/admin.css');
        $xoTheme->addScript('modules/system/js/admin.js');
		// Module admin
        $moduleAdmin->addItemButton(_AM_XMCONTACT_ANSWER_ADD, 'answer.php?op=add', 'add');
        $xoopsTpl->assign('renderbutton', $moduleAdmin->renderButton());
        // Get start pager
        $start = Request::getInt('start', 0);
        // Criteria
        $criteria = new CriteriaCompo();
        $criteria->setSort('answer_weight ASC, answer_title');
        $criteria->setOrder('ASC');
        $criteria->setStart($start);
        $criteria->setLimit($nb_limit);
        $answer_arr = $answerHandler->getall($criteria);
        $answer_count = $answerHandler->getCount($criteria);
        $xoopsTpl->assign('answer_count', $answer_count);

        if ($answer_count > 0) {
            foreach (array_keys($answer_arr) as $i) {
                $answer_id                 = $answer_arr[$i]->getVar('answer_id');
                $answer['id']              = $answer_id;
                $answer['title']           = $answer_arr[$i]->getVar('answer_title');
                $answer['description']     = $answer_arr[$i]->getVar('answer_description');
                $answer['weight']          = $answer_arr[$i]->getVar('answer_weight');
                $xoopsTpl->append_by_ref('answer', $answer);
                unset($answer);
            }
            // Display Page Navigation
            if ($answer_count > $nb_limit) {
                $nav = new XoopsPageNav($answer_count, $nb_limit, $start, 'start');
                $xoopsTpl->assign('nav_menu', $nav->renderNav(4));
            }
        } else {
            $xoopsTpl->assign('message_error', _AM_XMCONTACT_ERROR_ANSWER);
        }
        break;
    
    // add answer
    case 'add':
		// Module admin
        $moduleAdmin->addItemButton(_AM_XMCONTACT_ANSWER_LIST, 'answer.php', 'list');
        $xoopsTpl->assign('renderbutton', $moduleAdmin->renderButton());            
        // Create form
        $obj  = $answerHandler->create();
        $form = $obj->getForm();
        // Assign form
        $xoopsTpl->assign('form', $form->render());
        break;

    // edit answer
    case 'edit':
		// Module admin
        $moduleAdmin->addItemButton(_AM_XMCONTACT_ANSWER_ADD, 'answer.php?op=add', 'add');
        $moduleAdmin->addItemButton(_AM_XMCONTACT_ANSWER_LIST, 'answer.php', 'list');
        $xoopsTpl->assign('renderbutton', $moduleAdmin->renderButton());         
        // Create form
		$answer_id = Request::getInt('answer_id', 0);
        $obj  = $answerHandler->get($answer_id);
        $form = $obj->getForm();
        // Assign form
        $xoopsTpl->assign('form', $form->render());
        break;

    // del answer
    case 'del':
        // Create form
		$answer_id = Request::getInt('answer_id', 0);
        $obj  = $answerHandler->get($answer_id);

        if (isset($_POST['ok']) && 1 == $_POST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('answer.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($answerHandler->delete($obj)) {
                redirect_header('answer.php', 2, _AM_XMCONTACT_REDIRECT_SAVE);
            } else {
                xoops_error($obj->getHtmlErrors());
            }
        } else {
            xoops_confirm([
                              'ok' => 1,
                              'answer_id' => $answer_id,
                              'op' => 'del'
                          ], $_SERVER['REQUEST_URI'], sprintf(_AM_XMCONTACT_ANSWER_SUREDEL, $obj->getVar('answer_title')) . '<br \>' . $obj->getVar('answer_description') . '<br \>');
        }
        break;

    // save answer
    case 'save':
		if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('answer.php', 3, implode('<br>', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        $answer_id = Request::getInt('answer_id', 0);
        if ($answer_id == 0) {
            $obj = $answerHandler->create();            
        } else {
            $obj = $answerHandler->get($answer_id);
        }
        $error_message = $obj->saveAnswer($answerHandler, 'answer.php');
        if ($error_message != ''){
            $xoopsTpl->assign('error_message', $error_message);
            $form = $obj->getForm();
            $xoopsTpl->assign('form', $form->render());
        }        
        break;

	case 'view':
		// Module admin
        $moduleAdmin->addItemButton(_AM_XMCONTACT_ANSWER_LIST, 'answer.php', 'list');
        $xoopsTpl->assign('renderbutton', $moduleAdmin->renderButton());
        // Define Stylesheet
        $xoTheme->addStylesheet(XOOPS_URL . '/modules/system/css/admin.css');
        
        $xoopsTpl->assign('view', 'view');
        
        $answer_id = Request::getInt('answer_id', 0);
        $answer = $answerHandler->get($answer_id);
		
		$xoopsTpl->assign('title', $answer->getVar('answer_title'));
		$xoopsTpl->assign('description', $answer->getVar('answer_description'));
		$xoopsTpl->assign('answer', $answer->getVar('answer_answer'));
		$xoopsTpl->assign('weight', $answer->getVar('answer_weight'));
        $xoopsTpl->assign('answer_id', $answer_id);
        break;

}
$xoopsTpl->display("db:xmcontact_admin_answer.tpl");
require __DIR__ . '/admin_footer.php';
