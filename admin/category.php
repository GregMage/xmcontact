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


// Get Action type
$op = XoopsRequest::getCmd('op', 'list');

switch ($op) {
    // list of category
    case 'list':
        default:
        // Define Stylesheet
        $xoTheme->addStylesheet(XOOPS_URL . '/modules/system/css/admin.css');
        $xoTheme->addScript('browse.php?Frameworks/jquery/jquery.js');
        $xoTheme->addScript('browse.php?Frameworks/jquery/plugins/jquery.tablesorter.js');
        $xoTheme->addScript('modules/system/js/admin.js');
        //navigation
        $xoopsTpl->assign('navigation', $admin_class->addNavigation('category.php'));
        $xoopsTpl->assign('renderindex', $admin_class->renderIndex());
        // Define button addItemButton
        $admin_class->addItemButton(_AM_XMCONTACT_CATEGORY_ADD, 'category.php?op=add', 'add');
        $xoopsTpl->assign('renderbutton', $admin_class->renderButton());
        // Get start pager
        $start = XoopsRequest::getInt('start', 0);
        // Criteria
        $criteria = new CriteriaCompo();
        $criteria->setSort('category_weight ASC, category_title');
        $criteria->setOrder('ASC');
        $criteria->setStart($start);
        $criteria->setLimit($nb_limit);
        $category_arr = $category_Handler->getall($criteria);
        $category_count = $category_Handler->getCount($criteria);
        $xoopsTpl->assign('category_count', $category_count);

        if ($category_count > 0) {
            foreach (array_keys($category_arr) as $i) {
                $category_id                 = $category_arr[$i]->getVar('category_id');
                $category['id']              = $category_id;
                $category['title']           = $category_arr[$i]->getVar('category_title');
                $category['description']     = $category_arr[$i]->getVar('category_description');
                $category['uid']             = $category_arr[$i]->getVar('category_responsible');
                $category['responsible']     = XoopsUser::getUnameFromId($category_arr[$i]->getVar('category_responsible'));
                $category['weight']          = $category_arr[$i]->getVar('category_weight');
                $category['status']          = $category_arr[$i]->getVar('category_status');
                $category_img                = $category_arr[$i]->getVar('category_logo') ?: 'blank.gif';
                $category['logo']            = '<img src="' . XOOPS_UPLOAD_URL . '/xmcontact/images/cats/' .  $category_img . '" alt="' . $category_img . '" />';
                $xoopsTpl->append_by_ref('category', $category);
                unset($category);
            }
            // Display Page Navigation
            if ($category_count > $nb_limit) {
                $nav = new XoopsPageNav($category_count, $nb_limit, $start, 'start');
                $xoopsTpl->assign('nav_menu', $nav->renderNav(4));
            }
        } else{
            $xoopsTpl->assign('message_error', _AM_XMCONTACT_ERROR_CAT);
        }
        break;
    
    // add category
    case 'add':
        //navigation
        $xoopsTpl->assign('navigation', $admin_class->addNavigation('category.php'));
        $xoopsTpl->assign('renderindex', $admin_class->renderIndex());
        // Define button addItemButton
        $admin_class->addItemButton(_AM_XMCONTACT_CATEGORY_LIST, 'category.php', 'list');
        $xoopsTpl->assign('renderbutton', $admin_class->renderButton());
        
        // Create form
        $obj  = $category_Handler->create();
        $form = $obj->getForm();
        // Assign form
        $xoopsTpl->assign('form', $form->render());
        break;

    // edit category
    case 'edit':
        //navigation
        $xoopsTpl->assign('navigation', $admin_class->addNavigation('category.php'));
        $xoopsTpl->assign('renderindex', $admin_class->renderIndex());
        // Define button addItemButton
        $admin_class->addItemButton(_AM_XMCONTACT_CATEGORY_ADD, 'category.php?op=add', 'add');
        $admin_class->addItemButton(_AM_XMCONTACT_CATEGORY_LIST, 'category.php', 'list');
        $xoopsTpl->assign('renderbutton', $admin_class->renderButton());
        
        // Create form
        $obj  = $category_Handler->get($start = XoopsRequest::getInt('category_id', 0));
        $form = $obj->getForm();
        // Assign form
        $xoopsTpl->assign('form', $form->render());
        break;

    // del category
    case 'del':
        // Create form
        $category_id = XoopsRequest::getInt('category_id', 0);
        $obj  = $category_Handler->get($category_id);

        if (isset($_POST['ok']) && $_POST['ok'] == 1) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('category.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($category_Handler->delete($obj)) {
                //Del logo
				if($obj->getVar('category_logo') != 'blank.gif'){
					// Criteria
					$criteria = new CriteriaCompo();
					$criteria->add(new Criteria('category_logo', $obj->getVar('category_logo')));
					$category_count = $category_Handler->getCount($criteria);
					if($category_count == 0){
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
                              'op' => 'del'), $_SERVER['REQUEST_URI'], sprintf(_AM_XMCONTACT_CATEGORY_SUREDEL, $obj->getVar('category_title')) . '<br \><img src="' . XOOPS_UPLOAD_URL . '/xmcontact/images/cats/' . $category_img . '" alt="" /><br \>');
        }
        break;
    // save category
    case 'save':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('category.php', 3, implode('<br />', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (isset($_POST['category_id'])) {
            $obj = $category_Handler->get(XoopsRequest::getInt('category_id', 0));
        } else {
            $obj = $category_Handler->create();
        }
        // error
        $message_error = '';
        
        $obj->setVar('category_title', $_POST['category_title']);
        $obj->setVar('category_description', $_POST['category_description']);
        $obj->setVar('category_responsible', $_POST['category_responsible']);
        $obj->setVar('category_weight', $_POST['category_weight']);
        $status = ($_POST['category_status'] == 1) ? '1' : '0';
        $obj->setVar('category_status', $status);
        if (intval($_REQUEST['category_weight'])==0 && $_REQUEST['category_weight'] != '0') {
            $message_error .= _AM_XMCONTACT_ERROR_WEIGHT . '<br>';
        }
        //logo
        if ($_FILES['category_logo']['error'] != UPLOAD_ERR_NO_FILE) {
            include_once XOOPS_ROOT_PATH . '/class/uploader.php';
            $uploader_category_img = new XoopsMediaUploader(XOOPS_UPLOAD_PATH . '/xmcontact/images/cats/', array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/x-png', 'image/png'), $upload_size, null, null);
            if ($uploader_category_img->fetchMedia('category_logo')) {
                $uploader_category_img->setPrefix('cat_');
                if (!$uploader_category_img->upload()) {
                    $message_error .= $uploader_category_img->getErrors() . '<br />';
                } else {
                    $obj->setVar('category_logo', $uploader_category_img->getSavedFileName());
                }
            } else {
                $message_error .= $uploader_category_img->getErrors();
            }
        } else {
            $obj->setVar('category_logo', $_POST['category_logo']);
        }
        if ($message_error != '') {
            // Define button addItemButton
            $admin_class->addItemButton(_AM_XMCONTACT_CATEGORY_LIST, 'category.php', 'list');
            $xoopsTpl->assign('renderbutton', $admin_class->renderButton());
            $xoopsTpl->assign('message_error', $message_error);
            $form = $obj->getForm();
            $xoopsTpl->assign('form', $form->render());
        }else{
            if ($category_Handler->insert($obj)) {
                redirect_header('category.php', 2, _AM_XMCONTACT_REDIRECT_SAVE);
            }else {
                $xoopsTpl->assign('message_error', $obj->getHtmlErrors());
            }
        }
        break;

    // update status
    case 'category_update_status':
        $category_id = XoopsRequest::getInt('category_id', 0);
        if ($category_id > 0) {
            $obj = $category_Handler->get($category_id);
            $old = $obj->getVar('category_status');
            $obj->setVar('category_status', !$old);
            if ($category_Handler->insert($obj)) {
                exit;
            }
            echo $obj->getHtmlErrors();
        }
        break;
}

// Call template file
$xoopsTpl->display(XOOPS_ROOT_PATH . '/modules/xmcontact/templates/admin/xmcontact_category.tpl');
xoops_cp_footer();