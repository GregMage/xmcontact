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
use \Xmf\Request;
use \Xmf\Metagen;

include_once __DIR__ . '/header.php';
$GLOBALS['xoopsOption']['template_main'] = 'xmcontact_index.tpl';
include_once XOOPS_ROOT_PATH . '/header.php';

// Get Action type
$op = Request::getCmd('op', 'list');

// Criteria
$criteria = new CriteriaCompo();
$criteria->setSort('category_weight ASC, category_title');
$criteria->setOrder('ASC');
$criteria->add(new Criteria('category_status', 1));
$category_arr = $categoryHandler->getall($criteria);
$category_count = $categoryHandler->getCount($criteria);
if ($category_count == 0) {
	$xoopsTpl->assign('info_header', $helper->getConfig('info_header', ''));
	$xoopsTpl->assign('info_footer', $helper->getConfig('info_footer', ''));
	$xoopsTpl->assign('info_addresse', $helper->getConfig('info_addresse', ''));
	$xoopsTpl->assign('info_googlemaps', $helper->getConfig('info_googlemaps', ''));
	$op = 'form';
	$simple_contact = true;
	$xoopsTpl->assign('simple_contact', $simple_contact);
} else {
	$simple_contact = false;
}

$keywords = '';

switch ($op) {
    // list
    case 'list':
        default:
		$info_columncat = $helper->getConfig('info_columncat', 2);
        $xoopsTpl->assign('info_header', $helper->getConfig('info_header', ''));
        $xoopsTpl->assign('info_footer', $helper->getConfig('info_footer', ''));
        $xoopsTpl->assign('info_addresse', $helper->getConfig('info_addresse', ''));
        $xoopsTpl->assign('info_googlemaps', $helper->getConfig('info_googlemaps', ''));
        $xoopsTpl->assign('info_columncat', $info_columncat);

        $xoopsTpl->assign('category_count', $category_count);
        $count = 1;
        $count_row = 1;
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
				$count_row = $count_row + $info_columncat;
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
			$keywords .= Metagen::generateSeoTitle($category['title']) . ',';
			unset($category);
		}
        //SEO
		// pagetitle
		$xoopsTpl->assign('xoops_pagetitle', $xoopsModule->name());
        //description
        $xoTheme->addMeta('meta', 'description', Metagen::generateDescription($xoopsModule->name(), 30));
        //keywords
        $keywords = substr($keywords, 0, -1);
        $xoTheme->addMeta('meta', 'keywords', $keywords);
        break;
    
    // form
    case 'form':
		if ($simple_contact == False){
			$xoopsTpl->assign('form', true);
		}
        // Captcha
        if (1 == $helper->getConfig('info_captcha', 1)) {
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
        
        $request['civility'] = '';
        $request['name'] = '';
        $request['email'] = '';
        $request['phone'] = '';
        $request['address'] = '';
        $request['url'] = '';
        $request['subject'] = '';
        $request['message'] = '';
        $xoopsTpl->assign('request', $request);
        $xoopsTpl->assign('token', $GLOBALS['xoopsSecurity']->createToken(0, 'XOOPS_TOKEN'));
        $cat_id = Request::getInt('cat_id', 0);
        $xoopsTpl->assign('cat_id', $cat_id);
        if (0 != $cat_id) {
            $category = $categoryHandler->get($cat_id);
            $xoopsTpl->assign('category_title', $category->getVar('category_title'));
            $xoopsTpl->assign('category_description', $category->getVar('category_description'));
            $xoopsTpl->assign('docivility', substr($category->getVar('category_civility'), 0, 1));
            $xoopsTpl->assign('recivility', substr($category->getVar('category_civility'), 1, 1));
			$xoopsTpl->assign('doname', substr($category->getVar('category_name'), 0, 1));
            $xoopsTpl->assign('rename', substr($category->getVar('category_name'), 1, 1));
			$xoopsTpl->assign('dophone', substr($category->getVar('category_phone'), 0, 1));
            $xoopsTpl->assign('rephone', substr($category->getVar('category_phone'), 1, 1));
			$xoopsTpl->assign('doaddress', substr($category->getVar('category_address'), 0, 1));
            $xoopsTpl->assign('readdress', substr($category->getVar('category_address'), 1, 1));
			$xoopsTpl->assign('dourl', substr($category->getVar('category_url'), 0, 1));
            $xoopsTpl->assign('reurl', substr($category->getVar('category_url'), 1, 1));
			$xoopsTpl->assign('dosubject', substr($category->getVar('category_subject'), 0, 1));
            $xoopsTpl->assign('resubject', substr($category->getVar('category_subject'), 1, 1));
			
            $category_img = $category->getVar('category_logo') ?: 'blank.gif';
            $xoopsTpl->assign('category_logo', XOOPS_UPLOAD_URL . '/xmcontact/images/cats/' .  $category_img);            
            // pagetitle
			$xoopsTpl->assign('xoops_pagetitle', Metagen::generateSeoTitle($category->getVar('category_title')) . '-' . $xoopsModule->name());
			$keywords = Metagen::generateKeywords($category->getVar('category_description'), 10);    
			$xoTheme->addMeta('meta', 'keywords', implode(', ', $keywords));
	        //description
			$xoTheme->addMeta('meta', 'description', Metagen::generateDescription($xoopsModule->name() . ' ' . _MD_XMCONTACT_INDEX_FORM . ' ' . $category->getVar('category_description'), 30));
        } else {
			$xoopsTpl->assign('docivility', $helper->getConfig('sp_docivility', 0));
            $xoopsTpl->assign('recivility', $helper->getConfig('sp_recivility', 0));
			$xoopsTpl->assign('doname', $helper->getConfig('sp_doname', 0));
            $xoopsTpl->assign('rename', $helper->getConfig('sp_rename', 0));
			$xoopsTpl->assign('dophone', $helper->getConfig('sp_dophone', 0));
            $xoopsTpl->assign('rephone', $helper->getConfig('sp_rephone', 0));
			$xoopsTpl->assign('doaddress', $helper->getConfig('sp_doaddress', 0));
            $xoopsTpl->assign('readdress', $helper->getConfig('sp_readdress', 0));
			$xoopsTpl->assign('dourl', $helper->getConfig('sp_dourl', 0));
            $xoopsTpl->assign('reurl', $helper->getConfig('sp_reurl', 0));
			$xoopsTpl->assign('dosubject', $helper->getConfig('sp_dosubject', 0));
            $xoopsTpl->assign('resubject', $helper->getConfig('sp_resubject', 0));
		}
    break;

    // save
    case 'save':
		if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('index.php', 3, implode('<br>', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        $cat_id = Request::getInt('cat_id', 0, 'POST');
        $request['civility'] = Request::getString('civility', '', 'POST');
        $request['name'] = Request::getString('name', '', 'POST');
        $request['email'] = Request::getEmail('email', '', 'POST');
        $request['phone'] = Request::getString('phone', '', 'POST');
        $request['address'] = Request::getString('address', '', 'POST');
        $request['url'] = Request::getString('url', '', 'POST');
        $request['subject'] = Request::getString('subject', '', 'POST');
        $request['message'] = Request::getText('message', '', 'POST');
		if (0 != $cat_id) {
			$category 	= $categoryHandler->get($cat_id);
			$docivility = substr($category->getVar('category_civility'), 0, 1);
            $recivility = substr($category->getVar('category_civility'), 1, 1);
			$doname 	= substr($category->getVar('category_name'), 0, 1);
            $rename 	= substr($category->getVar('category_name'), 1, 1);
			$dophone 	= substr($category->getVar('category_phone'), 0, 1);
            $rephone 	= substr($category->getVar('category_phone'), 1, 1);
			$doaddress	= substr($category->getVar('category_address'), 0, 1);
            $readdress 	= substr($category->getVar('category_address'), 1, 1);
			$dourl 		= substr($category->getVar('category_url'), 0, 1);
            $reurl 		= substr($category->getVar('category_url'), 1, 1);
			$dosubject 	= substr($category->getVar('category_subject'), 0, 1);
            $resubject 	= substr($category->getVar('category_subject'), 1, 1);
			
		} else {
			$docivility = $helper->getConfig('sp_docivility', 0);
            $recivility = $helper->getConfig('sp_recivility', 0);
			$doname 	= $helper->getConfig('sp_doname', 0);
            $rename 	= $helper->getConfig('sp_rename', 0);
			$dophone 	= $helper->getConfig('sp_dophone', 0);
            $rephone 	= $helper->getConfig('sp_rephone', 0);
			$doaddress	= $helper->getConfig('sp_doaddress', 0);
            $readdress 	= $helper->getConfig('sp_readdress', 0);
			$dourl 		= $helper->getConfig('sp_dourl', 0);
            $reurl 		= $helper->getConfig('sp_reurl', 0);
			$dosubject 	= $helper->getConfig('sp_dosubject', 0);
            $resubject 	= $helper->getConfig('sp_resubject', 0);
			//en cours
		}
        // error
        $message_error = '';
		// civility
        if ('' == $request['civility'] && $docivility == 1 && $recivility == 1) {
            $message_error .= _MD_XMCONTACT_ERROR_CIVILITY . '<br />';
        }
        // name
        if ('' == $request['name'] && $doname == 1 && $rename == 1) {
            $message_error .= _MD_XMCONTACT_ERROR_NAME . '<br />';
        }
        // email
        if ('' == $request['email']) {
            $message_error .= _MD_XMCONTACT_ERROR_EMAIL . '<br />';
        }
		// phone
        if ('' == $request['phone'] && $dophone == 1 && $rephone == 1) {
            $message_error .= _MD_XMCONTACT_ERROR_PHONE . '<br />';
        }
		// address
        if ('' == $request['address'] && $doaddress == 1 && $readdress == 1) {
            $message_error .= _MD_XMCONTACT_ERROR_ADDRESS . '<br />';
        }
		// url
        if ('' == $request['url'] && $dourl == 1 && $reurl == 1) {
            $message_error .= _MD_XMCONTACT_ERROR_URL . '<br />';
        }
        // subject
        if ('' == $request['subject'] && $dosubject == 1 && $resubject == 1) {
            $message_error .= _MD_XMCONTACT_ERROR_SUBJECT . '<br />';
        }
        // message
        if ('' == $request['message']) {
            $message_error .= _MD_XMCONTACT_ERROR_MESSAGE . '<br />';
        }
        // Captcha
        if (1 == $helper->getConfig('info_captcha', 1)) {
            xoops_load('xoopscaptcha');
            $xoopsCaptcha = XoopsCaptcha::getInstance();
            if (! $xoopsCaptcha->verify() ) {
                $message_error .= $xoopsCaptcha->getMessage();
            }
        }
        if ('' != $message_error) {
            // Captcha
            if (1 == $helper->getConfig('info_captcha', 1)) {
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
			$xoopsTpl->assign('docivility', $docivility);
            $xoopsTpl->assign('recivility', $recivility);
			$xoopsTpl->assign('doname', $doname);
            $xoopsTpl->assign('rename', $rename);
			$xoopsTpl->assign('dophone', $dophone);
            $xoopsTpl->assign('rephone', $rephone);
			$xoopsTpl->assign('doaddress', $doaddress);
            $xoopsTpl->assign('readdress', $readdress);
			$xoopsTpl->assign('dourl', $dourl);
            $xoopsTpl->assign('reurl', $reurl);
			$xoopsTpl->assign('dosubject', $dosubject);
            $xoopsTpl->assign('resubject', $resubject);
            if (0 != $cat_id) {
                $category = $categoryHandler->get($cat_id);
                $xoopsTpl->assign('category_title', $category->getVar('category_title'));
                $xoopsTpl->assign('category_description', $category->getVar('category_description'));
                $category_img = $category->getVar('category_logo') ?: 'blank.gif';
                $xoopsTpl->assign('category_logo', XOOPS_UPLOAD_URL . '/xmcontact/images/cats/' .  $category_img);
            }
        } else {
            $message_error = '';
            $obj = $requestHandler->create();
            $obj->setVar('request_cid', $cat_id);
            $obj->setVar('request_civility', $request['civility']);
            $obj->setVar('request_name', $request['name']);
            $obj->setVar('request_email', $request['email']);
            $obj->setVar('request_phone', $request['phone']);
            $obj->setVar('request_address', $request['address']);
            $obj->setVar('request_url', $request['url']);
            $obj->setVar('request_ip', getenv('REMOTE_ADDR'));
            $obj->setVar('request_subject',  $request['subject']);
            $obj->setVar('request_message', $request['message']);
            $obj->setVar('request_date_e', time());
            $obj->setVar('request_status', 0);
            if ($requestHandler->insert($obj)) {
                if (0 != $cat_id && 1 == $helper->getConfig('info_notification', 1)) {
                    $newcontent_id = $obj->get_new_enreg();
                    $category = $categoryHandler->get($cat_id);
					if ($category->getVar('category_responsible') != 0){
						$memberHandler = xoops_getHandler('member');
						$thisUser = $memberHandler->getUser($category->getVar('category_responsible'));
						$xoopsMailer = xoops_getMailer();
						$xoopsMailer->useMail();
						$xoopsMailer->setToEmails($thisUser->getVar('email'));
						$xoopsMailer->setSubject(_MD_XMCONTACT_INDEX_MAIL_SUBJECT . ' "' . $category->getVar('category_title') . '"');
						$xoopsMailer->setTemplateDir($GLOBALS['xoopsModule']->getVar('dirname', 'n'));
						$xoopsMailer->setTemplate('new_request.tpl');
						$xoopsMailer->assign('X_CIVILITY', $request['civility']);
						$xoopsMailer->assign('X_UNAME', XoopsUser::getUnameFromId($category->getVar('category_responsible')));
						$xoopsMailer->assign('X_CATEGORY', $category->getVar('category_title'));
						$xoopsMailer->assign('X_SUBJECT', $request['subject']);
						$xoopsMailer->assign('X_NAME', $request['name']);
						$xoopsMailer->assign('X_EMAIL', $request['email']);
						$xoopsMailer->assign('X_PHONE', $request['phone']);
						$xoopsMailer->assign('X_URL', $request['url']);
						$xoopsMailer->assign('X_ADDRESS', $request['address']);
						$xoopsMailer->assign('X_MESSAGE', $request['message']);
						$xoopsMailer->assign('REQUEST_URL', XOOPS_URL . '/modules/xmcontact/admin/request.php?op=view&request_id=' . $newcontent_id);                    
						if (!$xoopsMailer->send()) {
							$message_error = $xoopsMailer->getErrors();
							$xoopsTpl->assign('message_error', $message_error);
						}
					}
                }
            } else {
                $message_error = $obj->getHtmlErrors();
            }
            if ('' != $message_error) {
                $xoopsTpl->assign('error', $message_error);
            } else {
				redirect_header('index.php', 2, _MD_XMCONTACT_REDIRECT_SEND);
			}
        }
    break;
}
include XOOPS_ROOT_PATH.'/footer.php';
