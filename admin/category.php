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
$moduleAdmin->displayNavigation('category.php');


// Get Action type
$op = Request::getCmd('op', 'list');

switch ($op) {
    // list of category
    case 'list':
        default:
        // Define Stylesheet
        $xoTheme->addStylesheet(XOOPS_URL . '/modules/system/css/admin.css');
        $xoTheme->addScript('modules/system/js/admin.js');
		// Module admin
        $moduleAdmin->addItemButton(_AM_XMCONTACT_CATEGORY_ADD, 'category.php?op=add', 'add');
        $xoopsTpl->assign('renderbutton', $moduleAdmin->renderButton());
        // Get start pager
        $start = Request::getInt('start', 0);
        // Criteria
        $criteria = new CriteriaCompo();
        $criteria->setSort('category_weight ASC, category_title');
        $criteria->setOrder('ASC');
        $criteria->setStart($start);
        $criteria->setLimit($nb_limit);
        $category_arr = $categoryHandler->getall($criteria);
        $category_count = $categoryHandler->getCount($criteria);
        $xoopsTpl->assign('category_count', $category_count);

        if ($category_count > 0) {
            foreach (array_keys($category_arr) as $i) {
                $category_id                 = $category_arr[$i]->getVar('category_id');
                $category['id']              = $category_id;
                $category['title']           = $category_arr[$i]->getVar('category_title');
				$category['description']     = $category_arr[$i]->getVar('category_description');
				if (true == strpos($category['description'], '[break]')){
					$category['description'] =  substr($category['description'],0,strpos($category['description'],'[break]'));
				}
                $category['uid']             = $category_arr[$i]->getVar('category_responsible');
                $category['responsible']     = XoopsUser::getUnameFromId($category_arr[$i]->getVar('category_responsible'));
                $category['weight']          = $category_arr[$i]->getVar('category_weight');
                $category['status']          = $category_arr[$i]->getVar('category_status');
                $category_img                = $category_arr[$i]->getVar('category_logo') ?: 'blank.gif';
				if ($category_img == ''){
					$category['logo']        = '';
				} else {
					$category['logo']        = $url_logo . $category_img;
				}
                //$category['logo']            = '<img src="' . XOOPS_UPLOAD_URL . '/xmcontact/images/cats/' .  $category_img . '" alt="' . $category_img . '" style="max-width:150px"/>';
                $xoopsTpl->appendByRef('category', $category);
                unset($category);
            }
            // Display Page Navigation
            if ($category_count > $nb_limit) {
                $nav = new XoopsPageNav($category_count, $nb_limit, $start, 'start');
                $xoopsTpl->assign('nav_menu', $nav->renderNav(4));
            }
        } else {
            $xoopsTpl->assign('message_error', _AM_XMCONTACT_ERROR_CAT);
        }
        break;

    // add category
    case 'add':
		// Module admin
        $moduleAdmin->addItemButton(_AM_XMCONTACT_CATEGORY_LIST, 'category.php', 'list');
        $xoopsTpl->assign('renderbutton', $moduleAdmin->renderButton());
        // Create form
        $obj  = $categoryHandler->create();
        $form = $obj->getForm();
        // Assign form
        $xoopsTpl->assign('form', $form->render());
        break;

    // edit category
    case 'edit':
		// Module admin
        $moduleAdmin->addItemButton(_AM_XMCONTACT_CATEGORY_ADD, 'category.php?op=add', 'add');
        $moduleAdmin->addItemButton(_AM_XMCONTACT_CATEGORY_LIST, 'category.php', 'list');
        $xoopsTpl->assign('renderbutton', $moduleAdmin->renderButton());
        // Create form
		$category_id = Request::getInt('category_id', 0);
        $obj  = $categoryHandler->get($category_id);
        $form = $obj->getForm();
        // Assign form
        $xoopsTpl->assign('form', $form->render());
        break;

    // del category
    case 'del':
        // Create form
		$category_id = Request::getInt('category_id', 0);
        $obj  = $categoryHandler->get($category_id);

        if (isset($_POST['ok']) && 1 == $_POST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('category.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($categoryHandler->delete($obj)) {
                //Del logo
                if ('blank.gif' != $obj->getVar('category_logo')) {
                    // Criteria
                    $criteria = new CriteriaCompo();
                    $criteria->add(new Criteria('category_logo', $obj->getVar('category_logo')));
                    $category_count = $categoryHandler->getCount($criteria);
                    if (0 == $category_count) {
                        $urlfile = XOOPS_UPLOAD_PATH . '/xmcontact/images/cats/' . $obj->getVar('category_logo');
                        if (is_file($urlfile)) {
                            chmod($urlfile, 0777);
                            unlink($urlfile);
                        }
                    }
                }
                redirect_header('category.php', 2, _AM_XMCONTACT_REDIRECT_SAVE);
            } else {
                xoops_error($obj->getHtmlErrors());
            }
        } else {
            $category_img = $obj->getVar('category_logo') ?: 'blank.gif';
            xoops_confirm(array(
                              'ok' => 1,
                              'category_id' => $category_id,
                              'op' => 'del'), $_SERVER['REQUEST_URI'], sprintf(_AM_XMCONTACT_CATEGORY_SUREDEL, $obj->getVar('category_title')) . '<br \><img src="' . XOOPS_UPLOAD_URL . '/xmcontact/images/cats/' . $category_img . '" alt="" style="max-width:100px"/><br \>');
        }
        break;
    // save category
    case 'save':
		if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('category.php', 3, implode('<br>', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        $category_id = Request::getInt('category_id', 0);
        if ($category_id == 0) {
            $obj = $categoryHandler->create();
        } else {
            $obj = $categoryHandler->get($category_id);
        }
        $error_message = $obj->saveCategory($categoryHandler, 'category.php');
        if ($error_message != ''){
            $xoopsTpl->assign('error_message', $error_message);
            $form = $obj->getForm();
            $xoopsTpl->assign('form', $form->render());
        }

        break;

    // update status
    case 'category_update_status':
		$category_id = Request::getInt('category_id', 0);
        if ($category_id > 0) {
            $obj = $categoryHandler->get($category_id);
            $old = $obj->getVar('category_status');
            $obj->setVar('category_status', !$old);
            if ($categoryHandler->insert($obj)) {
                exit;
            }
            echo $obj->getHtmlErrors();
        }
        break;
}
$xoopsTpl->display("db:xmcontact_admin_category.tpl");
require __DIR__ . '/admin_footer.php';
