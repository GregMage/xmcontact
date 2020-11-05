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
class_exists('\Xmf\Module\Admin') or die('XMF is required.');

use Xmf\Module\Helper;

$helper = Helper::getHelper(basename(dirname(__DIR__)));

$url_logo  = XOOPS_UPLOAD_URL . '/xmcontact/images/cats/';
$path_logo = XOOPS_UPLOAD_PATH . '/xmcontact/images/cats';

$upload_size = 500000;

// Get handler
$categoryHandler  = $helper->getHandler('xmcontact_category');
$requestHandler =  $helper->getHandler('xmcontact_request');
$answerHandler =  $helper->getHandler('xmcontact_answer');
// joint
$requestHandler->table_link = $requestHandler->db->prefix('xmcontact_category'); // Nom de la table en jointure
$requestHandler->field_link = 'category_id'; // champ de la table en jointure
$requestHandler->field_object = 'request_cid'; // champ de la table courante