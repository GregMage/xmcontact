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
use Xmf\Module\Helper;
function block_xmcontact_contactform_show($options) {
	global $xoopsUser;
	$helper = Helper::getHelper('xmcontact');
	$helper->loadLanguage('main');
	// Get handler
	$categoryHandler = xoops_getModuleHandler('xmcontact_category', 'xmcontact');
	$block['token'] = $GLOBALS['xoopsSecurity']->createToken(0, 'XOOPS_TOKEN');
	// Captcha
	if (1 == $helper->getConfig('info_captcha', 1)) {
		xoops_load('XoopsCaptcha');
		$captchaHandler  = XoopsCaptcha::getInstance();
		$configs['name']       = 'xoopscaptcha';
		$configs['skipmember'] = true;
		$captchaHandler->setConfigs($configs);
		if ($captchaHandler->isActive()) {
			$block['captcha_caption'] = $captchaHandler->getCaption();
			$block['captcha'] = $captchaHandler->render();
		}
	}
	$request['civility'] = '';
	if (is_object($xoopsUser)) {
		$request['name'] = $xoopsUser->getVar('name');
		$request['email'] = $xoopsUser->getVar('email');
	} else {
		$request['name'] = '';
		$request['email'] = '';
	}
	$request['phone'] = '';
	$request['address'] = '';
	$request['url'] = '';
	$request['subject'] = '';
	$request['message'] = '';
	$block['request'] = $request;
	$category_id = $options[0];
	// Criteria
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria('category_status', 1));
	$criteria->add(new Criteria('category_id', $category_id));
	$category_count = $categoryHandler->getCount($criteria);
	if ($helper->getConfig('info_simplecontact', 1) == 1 || $category_count == 0){
		$block['docivility'] = $helper->getConfig('sp_docivility', 0);
		$block['recivility'] = $helper->getConfig('sp_recivility', 0);
		$block['doname'] = $helper->getConfig('sp_doname', 0);
		$block['rename'] = $helper->getConfig('sp_rename', 0);
		$block['dophone'] = $helper->getConfig('sp_dophone', 0);
		$block['rephone'] = $helper->getConfig('sp_rephone', 0);
		$block['doaddress'] = $helper->getConfig('sp_doaddress', 0);
		$block['readdress'] = $helper->getConfig('sp_readdress', 0);
		$block['dourl'] = $helper->getConfig('sp_dourl', 0);
		$block['reurl'] = $helper->getConfig('sp_reurl', 0);
		$block['dosubject'] = $helper->getConfig('sp_dosubject', 0);
		$block['resubject'] = $helper->getConfig('sp_resubject', 0);
	} else {
		$category = $categoryHandler->get($category_id);
		$block['cat_id'] = $category_id;
		$block['docivility'] = substr($category->getVar('category_civility'), 0, 1);
		$block['recivility'] = substr($category->getVar('category_civility'), 1, 1);
		$block['doname'] = substr($category->getVar('category_name'), 0, 1);
		$block['rename'] = substr($category->getVar('category_name'), 1, 1);
		$block['dophone'] = substr($category->getVar('category_phone'), 0, 1);
		$block['rephone'] = substr($category->getVar('category_phone'), 1, 1);
		$block['doaddress'] = substr($category->getVar('category_address'), 0, 1);
		$block['readdress'] = substr($category->getVar('category_address'), 1, 1);
		$block['dourl'] = substr($category->getVar('category_url'), 0, 1);
		$block['reurl'] = substr($category->getVar('category_url'), 1, 1);
		$block['dosubject'] = substr($category->getVar('category_subject'), 0, 1);
		$block['resubject'] = substr($category->getVar('category_subject'), 1, 1);
	}
	return $block;
}

function block_xmcontact_contactform_edit($options) {
	// Get handler
	$categoryHandler = xoops_getModuleHandler('xmcontact_category', 'xmcontact');
	// Criteria
	$criteria = new CriteriaCompo();
	$criteria->setSort('category_weight ASC, category_title');
	$criteria->setOrder('ASC');
	$criteria->add(new Criteria('category_status', 1));
	$category_arr = $categoryHandler->getall($criteria);
	$category_count = $categoryHandler->getCount($criteria);
	$helper = Helper::getHelper('xmcontact');
	if ($category_count == 0 || $helper->getConfig('info_simplecontact', 1) == 1){
		return '';
	} else {	
		include_once XOOPS_ROOT_PATH.'/modules/xmcontact/class/blockform.php';
		xoops_load('XoopsFormLoader');

		$form = new XmcontactBlockForm();
		$category = new XoopsFormSelect(_MB_XMCONTACT_CATEGORY, 'options[0]', $options[0], 1, false);
		foreach (array_keys($category_arr) as $i) {
			$category->addOption($category_arr[$i]->getVar('category_id'), $category_arr[$i]->getVar('category_title'));
		}		
		$form->addElement($category);
	}

	return $form->render();
}