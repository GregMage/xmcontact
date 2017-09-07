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
include __DIR__ . '/header.php';
$xoopsOption['template_main'] = 'xmcontact_index.tpl';
include_once XOOPS_ROOT_PATH.'/header.php';

// Get Action type
$op = XoopsRequest::getCmd('op', 'list');

$keywords = '';

switch ($op) {
    // list
    case 'list':
        default:
        $xoopsTpl->assign('info_header', $xoopsModuleConfig['info_header']);
        $xoopsTpl->assign('info_footer', $xoopsModuleConfig['info_footer']);
        $xoopsTpl->assign('info_addresse', $xoopsModuleConfig['info_addresse']);
        $xoopsTpl->assign('info_googlemaps', $xoopsModuleConfig['info_googlemaps']);
        $xoopsTpl->assign('info_columncat', $xoopsModuleConfig['info_columncat']);
        // Criteria
        $criteria = new CriteriaCompo();
        $criteria->setSort('category_weight ASC, category_title');
        $criteria->setOrder('ASC');
        $criteria->add(new Criteria('category_status', 1));
        $category_arr = $categoryHandler->getall($criteria);
        $category_count = $categoryHandler->getCount($criteria);
        $xoopsTpl->assign('category_count', $category_count);
        $count = 1;
        $count_row = 1;
        if ($category_count > 0) {
            foreach (array_keys($category_arr) as $i) {
                $category_id                 = $category_arr[$i]->getVar('category_id');
                $category['id']              = $category_id;
                $category['title']           = $category_arr[$i]->getVar('category_title');
                $category['description']     = $category_arr[$i]->getVar('category_description');
                $category_img                = $category_arr[$i]->getVar('category_logo') ?: 'blank.gif';
                $category['logo']            = XOOPS_UPLOAD_URL . '/xmcontact/images/cats/' .  $category_img;
                $category['count']           = $count;
                if ($count_row == $count) {
                    $category['row'] = true;
                    $count_row = $count_row + $xoopsModuleConfig['info_columncat'];
                } else {
                    $category['row'] = false;
                }
                if ($count == $category_count) {
                    $category['end'] = true;
                } else {
                    $category['end'] = false;
                }
                $xoopsTpl->append_by_ref('category', $category);
                $count++;
                $keywords .= $category['title'] . ',';
                unset($category);
            }
        } else {
            $xoopsTpl->assign('simple_contact', true);
        }
        //SEO
        //description
        $xoTheme->addMeta('meta', 'description', strip_tags($xoopsModule->name()));
        //keywords
        $keywords = substr($keywords, 0, -1);
        $xoTheme->addMeta('meta', 'keywords', $keywords);
        break;
    
    // form
    case 'form':
        // Captcha
        if ($xoopsModuleConfig['info_captcha'] == 1) {
            xoops_load('XoopsCaptcha');
            $captchaHandler  = XoopsCaptcha::getInstance();
            $configs['name']       = 'xoopscaptcha';
            $configs['skipmember'] = true;
            $captchaHandler->setConfigs($configs);
            if ($captchaHandler->isActive()) {
                $xoopsTpl->assign('captcha_caption', $captchaHandler->getCaption());
                $xoopsTpl->assign('captcha', $captchaHandler->render());
            }
        }
        
        $request['name'] = '';
        $request['email'] = '';
        $request['phone'] = '';
        $request['subject'] = '';
        $request['message'] = '';
        $xoopsTpl->assign('request', $request);
        $xoopsTpl->assign('form', true);
        $cat_id = XoopsRequest::getInt('cat_id', 0);
        $xoopsTpl->assign('cat_id', $cat_id);
        if ($cat_id != 0) {
            $category = $categoryHandler->get($cat_id);
            $xoopsTpl->assign('category_title', $category->getVar('category_title'));
            $xoopsTpl->assign('category_description', $category->getVar('category_description'));
            $category_img = $category->getVar('category_logo') ?: 'blank.gif';
            $xoopsTpl->assign('category_logo', XOOPS_UPLOAD_URL . '/xmcontact/images/cats/' .  $category_img);            
            // pagetitle
            $xoopsTpl->assign('xoops_pagetitle', strip_tags($category->getVar('category_title') . ' - ' . $xoopsModule->name()));
        }
        //description
        $xoTheme->addMeta('meta', 'description', strip_tags($xoopsModule->name() . ' ' . _MD_XMCONTACT_INDEX_FORM));
    break;

    // save
    case 'save':
        $cat_id = XoopsRequest::getInt('cat_id', 0, 'POST');
        $request['name'] = XoopsRequest::getString('name', '', 'POST');
        $request['email'] = XoopsRequest::getEmail('email', '', 'POST');
        $request['phone'] = XoopsRequest::getString('phone', '', 'POST');
        $request['subject'] = XoopsRequest::getString('subject', '', 'POST');
        $request['message'] = XoopsRequest::getText('message', '', 'POST');

        // error
        $message_error = '';
        // title
        if ($request['name'] == '') {
            $message_error .= _MD_XMCONTACT_ERROR_NAME . '<br />';
        }
        // email
        if ($request['email'] == '') {
            $message_error .= _MD_XMCONTACT_ERROR_EMAIL . '<br />';
        }
        // subject
        if ($request['subject'] == '') {
            $message_error .= _MD_XMCONTACT_ERROR_SUBJECT . '<br />';
        }
        // message
        if ($request['message'] == '') {
            $message_error .= _MD_XMCONTACT_ERROR_MESSAGE . '<br />';
        }
        // Captcha
        if ($xoopsModuleConfig['info_captcha'] == 1) {
            xoops_load('xoopscaptcha');
            $xoopsCaptcha = XoopsCaptcha::getInstance();
            if (! $xoopsCaptcha->verify() ) {
                $message_error .= $xoopsCaptcha->getMessage();
            }
        }
        if ($message_error != '') {
            // Captcha
            if ($xoopsModuleConfig['info_captcha'] == 1) {
                xoops_load('XoopsCaptcha');
                $captchaHandler  = XoopsCaptcha::getInstance();
                $configs['name']       = 'xoopscaptcha';
                $configs['skipmember'] = true;
                $captchaHandler->setConfigs($configs);
                if ($captchaHandler->isActive()) {
                    $xoopsTpl->assign('captcha_caption', $captchaHandler->getCaption());
                    $xoopsTpl->assign('captcha', $captchaHandler->render());
                }
            }
            $xoopsTpl->assign('request', $request);
            $xoopsTpl->assign('error', $message_error);
            $xoopsTpl->assign('form', true);
            $xoopsTpl->assign('cat_id', $cat_id);
            if ($cat_id != 0) {
                $category = $categoryHandler->get($cat_id);
                $xoopsTpl->assign('category_title', $category->getVar('category_title'));
                $xoopsTpl->assign('category_description', $category->getVar('category_description'));
                $category_img = $category->getVar('category_logo') ?: 'blank.gif';
                $xoopsTpl->assign('category_logo', XOOPS_UPLOAD_URL . '/xmcontact/images/cats/' .  $category_img);            
                // pagetitle
                $xoopsTpl->assign('xoops_pagetitle', strip_tags($category->getVar('category_title') . ' - ' . $xoopsModule->name()));
            }
            //description
            $xoTheme->addMeta('meta', 'description', strip_tags($xoopsModule->name() . ' ' . _MD_XMCONTACT_INDEX_FORM));
        } else {
            $message_error = '';
            $obj = $requestHandler->create();
            $obj->setVar('request_cid', $cat_id);
            $obj->setVar('request_name', $request['name']);
            $obj->setVar('request_email', $request['email']);
            $obj->setVar('request_phone', $request['phone']);
            $obj->setVar('request_ip', getenv('REMOTE_ADDR'));
            $obj->setVar('request_subject',  $request['subject']);
            $obj->setVar('request_message', $request['message']);
            $obj->setVar('request_date_e', time());
            $obj->setVar('request_status', 0);
            if ($requestHandler->insert($obj)) {
                if ($cat_id != 0 && $xoopsModuleConfig['info_notification'] == 1) {
                    $newcontent_id = $obj->get_new_enreg();
                    $category = $categoryHandler->get($cat_id);
                    $memberHandler = xoops_getHandler('member');
                    $thisUser = $memberHandler->getUser($category->getVar('category_responsible'));
                    $xoopsMailer = xoops_getMailer();
                    $xoopsMailer->useMail();
                    $xoopsMailer->setToEmails($thisUser->getVar('email'));
                    $xoopsMailer->setSubject(_MD_XMCONTACT_INDEX_MAIL_SUBJECT);

                    $xoopsMailer->setTemplateDir($GLOBALS['xoopsModule']->getVar('dirname', 'n'));
                    $xoopsMailer->setTemplate('new_request.tpl');
                    $xoopsMailer->assign('X_UNAME', XoopsUser::getUnameFromId($category->getVar('category_responsible')));
                    $xoopsMailer->assign('X_CATEGORY', $category->getVar('category_title'));
                    $xoopsMailer->assign('X_SUBJECT', $request['subject']);
                    $xoopsMailer->assign('X_NAME', $request['name']);
                    $xoopsMailer->assign('X_EMAIL', $request['email']);
                    $xoopsMailer->assign('X_PHONE', $request['phone']);
                    $xoopsMailer->assign('X_MESSAGE', $request['message']);
                    $xoopsMailer->assign('REQUEST_URL', XOOPS_URL . '/modules/xmcontact/admin/request.php?op=view&request_id=' . $newcontent_id);
                    
                    if (!$xoopsMailer->send()) {
                        $message_error = $xoopsMailer->getErrors();
                        $xoopsTpl->assign('message_error', $message_error);
                    }
                }
            } else {
                $message_error = $obj->getHtmlErrors();
            }
            if ($message_error != '') {
                $xoopsTpl->assign('error', $message_error);
            }
            redirect_header('index.php', 2, _MD_XMCONTACT_REDIRECT_SEND);
        }
    break;
}
include XOOPS_ROOT_PATH.'/footer.php';
