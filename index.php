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
include 'header.php';
$xoopsOption['template_main'] = 'xmcontact_index.tpl';
include_once XOOPS_ROOT_PATH.'/header.php';
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
$category_arr = $category_Handler->getall($criteria);
$category_count = $category_Handler->getCount($criteria);
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
        if ($count_row == $count){
            $category['row'] = true;
            $count_row = $count_row + $xoopsModuleConfig['info_columncat'];
        } else { 
        $category['row'] = false;
        }
        $xoopsTpl->append_by_ref('category', $category);
        $count++;
        unset($category);
    }
}

include XOOPS_ROOT_PATH.'/footer.php';