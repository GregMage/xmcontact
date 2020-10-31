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
function block_xmcontact_contact_show($options) {
	$helper = Helper::getHelper('xmcontact');
	// Get handler
	$categoryHandler = xoops_getModuleHandler('xmcontact_category', 'xmcontact');
	
	$category_ids = explode(',', $options[0]);
	
	// Criteria
	$criteria = new CriteriaCompo();
	$criteria->setSort('category_weight ASC, category_title');
	$criteria->setOrder('ASC');
	$criteria->add(new Criteria('category_status', 1));
	if (!in_array(0, $category_ids)) {
        $criteria->add(new Criteria('category_id', '(' . $options[0] . ')', 'IN'));
    }
	$category_arr = $categoryHandler->getall($criteria);
	$category_count = $categoryHandler->getCount($criteria);
	if ($category_count == 0 || $helper->getConfig('info_simplecontact', 1) == 1) {
		$block['simple_contact']   = true;
		$category_count = 0;		
	}
	$block['category_count']   = $category_count;
	$count = 1;
	$count_row = 1;
	if ($category_count > 0){
		echo '<br>cat: ' . $category_count;
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
				$count_row = $count_row + $options[4];
			} else {
				$category['row'] = false;
			}
			if ($count == $category_count) {
				$category['end'] = true;
			} else {
				$category['end'] = false;
			}
			$count++;
			$block['category'][] = $category;
		}
		$block['show_description'] = $options[1];
		$block['show_logo']        = $options[2];
		$block['display']          = $options[3];
		$block['nb_column']        = $options[4];
	}
	return $block;
}

function block_xmcontact_contact_edit($options) {
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
		$category = new XoopsFormSelect(_MB_XMCONTACT_CATEGORY, 'options[0]', $options[0], 5, true);
		$category->addOption(0, _MB_XMCONTACT_ALLCATEGORY);
		foreach (array_keys($category_arr) as $i) {
			$category->addOption($category_arr[$i]->getVar('category_id'), $category_arr[$i]->getVar('category_title'));
		}
		
		$description = new XoopsFormRadioYN(_MB_XMCONTACT_DESCRIPTION, 'options[1]', $options[1]);
		
		$logo = new XoopsFormRadioYN(_MB_XMCONTACT_LOGO, 'options[2]', $options[2]);
		
		$display = new XoopsFormElementTray(_MB_XMCONTACT_DISPLAY);
		$display_VH = new XoopsFormRadio('', 'options[3]', $options[3]);
		$display_VH->addOptionArray(array('V' =>_MB_XMCONTACT_VERTICAL, 'H' =>_MB_XMCONTACT_HORIZONTAL));
		$display->addElement($display_VH);
		$display_HC = new XoopsFormSelect('', 'options[4]', $options[4]);
		$display_HC->addOptionArray(array(2 =>'2', 3 =>'3'));
		$display->addElement($display_HC);
		
		$form->addElement($category);
		$form->addElement($description);
		$form->addElement($logo);
		$form->addElement($display);
	}

	return $form->render();
}