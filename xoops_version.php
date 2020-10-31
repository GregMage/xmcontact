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

$modversion['name']                = _MI_XMCONTACT_NAME;
$modversion['version']             = '2.0';
$modversion['description']         = _MI_XMCONTACT_DESC;
$modversion['credits']             = 'G. Mage';
$modversion['author']              = 'G. Mage';
$modversion['nickname']            = 'Mage';
$modversion['license']             = 'GNU GPL';
$modversion['license_url']         = 'www.gnu.org/licenses/gpl-2.0.html/';
$modversion['official']            = 1;
$modversion['image']               = 'assets/images/xmcontact_logo.png';
$modversion['dirname']             = 'xmcontact';
$modversion['dirmoduleadmin']      = 'Frameworks/moduleclasses';
$modversion['icons16']             = 'Frameworks/moduleclasses/icons/16';
$modversion['icons32']             = 'Frameworks/moduleclasses/icons/32';
$modversion['help']                = 'page=help';

//about
$modversion['release_date']         = '';
$modversion['module_website_url']   = 'www.monxoops.fr/';
$modversion['module_website_name']  = 'MonXoops';
$modversion['module_status']        = 'Alpha';
$modversion['min_xoops'] 			= '2.5.10';
$modversion['min_php']   			= '7.0';
$modversion['min_db']    			= ['mysql' => '5.5'];

//install and update
$modversion['onInstall']           = 'include/install.php';
$modversion['onUpdate']            = 'include/update.php';

// Admin menu
// Set to 1 if you want to display menu generated by system module
$modversion['system_menu'] = 1;

// Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = 'admin/index.php';
$modversion['adminmenu'] = 'admin/menu.php';


// Admin Templates
$modversion['templates'][] = ['file' => 'xmcontact_admin_category.tpl', 'description' => '', 'type' => 'admin'];
$modversion['templates'][] = ['file' => 'xmcontact_admin_request.tpl', 'description' => '', 'type' => 'admin'];

// User Templates
$modversion['templates'][] = ['file' => 'xmcontact_index.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'xmcontact_form.tpl', 'description' => ''];

// Pour les blocs
$modversion['blocks'][] = array(
    'file'        => 'xmcontact_contact.php',
    'name'        => _MI_XMCONTACT_BLOCK_CONTACT,
    'description' => _MI_XMCONTACT_BLOCK_CONTACT_DESC,
    'show_func'   => 'block_xmcontact_contact_show',
    'edit_func'   => 'block_xmcontact_contact_edit',
	'options'     => '0|1|1|V|2',
    'template'    => 'xmcontact_contact.tpl'
);
$modversion['blocks'][] = array(
    'file'        => 'xmcontact_contactform.php',
    'name'        => _MI_XMCONTACT_BLOCK_CONTACTFORM,
    'description' => _MI_XMCONTACT_BLOCK_CONTACTFORM_DESC,
    'show_func'   => 'block_xmcontact_contactform_show',
    'edit_func'   => 'block_xmcontact_contactform_edit',
	'options'     => '0',
    'template'    => 'xmcontact_contactform.tpl'
);

// Menu
$modversion['hasMain'] = 1;

// Mysql file
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';

// Tables created by sql file (without prefix!)
$modversion['tables'][1] = 'xmcontact_request';
$modversion['tables'][2] = 'xmcontact_category';

// Pref.

$modversion['config'][] = array(
    'name'        => 'break',
    'title'       => '_MI_XMCONTACT_PREF_HEAD_INFORMATION',
    'description' => '',
    'formtype'    => 'line_break',
    'valuetype'   => 'textbox',
    'default'     => 'head'
);

$modversion['config'][] = array(
    'name'        => 'info_captcha',
    'title'       => '_MI_XMCONTACT_PREF_CAPTCHA',
    'description' => '_MI_XMCONTACT_PREF_CAPTCHA_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0
);

$modversion['config'][] = array(
    'name'        => 'info_columncat',
    'title'       => '_MI_XMCONTACT_PREF_COLUMNCAT',
    'description' => '_MI_XMCONTACT_PREF_COLUMNCAT_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'int',
    'default'     => 2,
    'options'     => array(1 => 1, 2 => 2, 3 => 3)
);

$modversion['config'][] = array(
    'name'        => 'info_header',
    'title'       => '_MI_XMCONTACT_PREF_HEADER',
    'description' => '_MI_XMCONTACT_PREF_HEADER_DESC',
    'formtype'    => 'textarea',
    'valuetype'   => 'text',
    'default'     => ''
);

$modversion['config'][] = array(
    'name'        => 'info_footer',
    'title'       => '_MI_XMCONTACT_PREF_FOOTER',
    'description' => '_MI_XMCONTACT_PREF_FOOTER_DESC',
    'formtype'    => 'textarea',
    'valuetype'   => 'text',
    'default'     => ''
);

$modversion['config'][] = array(
    'name'        => 'info_addresse',
    'title'       => '_MI_XMCONTACT_PREF_ADDRESSE',
    'description' => '_MI_XMCONTACT_PREF_ADDRESSE_DESC',
    'formtype'    => 'textarea',
    'valuetype'   => 'text',
    'default'     => ''
);

$modversion['config'][] = array(
    'name'        => 'info_googlemaps',
    'title'       => '_MI_XMCONTACT_PREF_GOOGLEMAPS',
    'description' => '_MI_XMCONTACT_PREF_GOOGLEMAPS_DESC',
    'formtype'    => 'textarea',
    'valuetype'   => 'text',
    'default'     => ''
);

$modversion['config'][] = array(
    'name'        => 'info_notification',
    'title'       => '_MI_XMCONTACT_PREF_NOTIFICATION',
    'description' => '_MI_XMCONTACT_PREF_NOTIFICATION_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1
);

$modversion['config'][] = array(
    'name'        => 'info_simplecontact',
    'title'       => '_MI_XMCONTACT_PREF_SIMPLECONTACT',
    'description' => '_MI_XMCONTACT_PREF_SIMPLECONTACT_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1
);

$modversion['config'][] = array(
    'name'        => 'break',
    'title'       => '_MI_XMCONTACT_PREF_HEAD_SIMPLECONTACT',
    'description' => '',
    'formtype'    => 'line_break',
    'valuetype'   => 'textbox',
    'default'     => 'head'
);

$modversion['config'][] = array(
    'name'        => 'sp_docivility',
    'title'       => '_MI_XMCONTACT_PREF_DOCIVILITY',
    'description' => '_MI_XMCONTACT_PREF_SP_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0
);

$modversion['config'][] = array(
    'name'        => 'sp_recivility',
    'title'       => '_MI_XMCONTACT_PREF_RECIVILITY',
    'description' => '_MI_XMCONTACT_PREF_SP_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0
);

$modversion['config'][] = array(
    'name'        => 'sp_doname',
    'title'       => '_MI_XMCONTACT_PREF_DONAME',
    'description' => '_MI_XMCONTACT_PREF_SP_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0
);

$modversion['config'][] = array(
    'name'        => 'sp_rename',
    'title'       => '_MI_XMCONTACT_PREF_RENAME',
    'description' => '_MI_XMCONTACT_PREF_SP_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0
);

$modversion['config'][] = array(
    'name'        => 'sp_dophone',
    'title'       => '_MI_XMCONTACT_PREF_DOPHONE',
    'description' => '_MI_XMCONTACT_PREF_SP_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0
);

$modversion['config'][] = array(
    'name'        => 'sp_rephone',
    'title'       => '_MI_XMCONTACT_PREF_REPHONE',
    'description' => '_MI_XMCONTACT_PREF_SP_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0
);

$modversion['config'][] = array(
    'name'        => 'sp_dosubject',
    'title'       => '_MI_XMCONTACT_PREF_DOSUBJECT',
    'description' => '_MI_XMCONTACT_PREF_SP_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0
);

$modversion['config'][] = array(
    'name'        => 'sp_resubject',
    'title'       => '_MI_XMCONTACT_PREF_RESUBJECT',
    'description' => '_MI_XMCONTACT_PREF_SP_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0
);

$modversion['config'][] = array(
    'name'        => 'sp_doaddress',
    'title'       => '_MI_XMCONTACT_PREF_DOADDRESS',
    'description' => '_MI_XMCONTACT_PREF_SP_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0
);

$modversion['config'][] = array(
    'name'        => 'sp_readdress',
    'title'       => '_MI_XMCONTACT_PREF_READDRESS',
    'description' => '_MI_XMCONTACT_PREF_SP_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0
);

$modversion['config'][] = array(
    'name'        => 'sp_dourl',
    'title'       => '_MI_XMCONTACT_PREF_DOURL',
    'description' => '_MI_XMCONTACT_PREF_SP_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0
);

$modversion['config'][] = array(
    'name'        => 'sp_reurl',
    'title'       => '_MI_XMCONTACT_PREF_REURL',
    'description' => '_MI_XMCONTACT_PREF_SP_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0
);

$modversion['config'][] = array(
    'name'        => 'break',
    'title'       => '_MI_XMCONTACT_PREF_HEAD_ADMIN',
    'description' => '',
    'formtype'    => 'line_break',
    'valuetype'   => 'textbox',
    'default'     => 'head'
);

xoops_load('xoopseditorhandler');
$editorHandler = XoopsEditorHandler::getInstance();
$modversion['config'][] = array(
    'name'        => 'admin_editor',
    'title'       => '_MI_XMCONTACT_PREF_EDITOR',
    'description' => '',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'default'     => 'dhtmltextarea',
    'options'     => array_flip($editorHandler->getList())
);

$modversion['config'][] = array(
    'name'        => 'admin_perpage',
    'title'       => '_MI_XMCONTACT_PREF_ITEMPERPAGE',
    'description' => '',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 15
);
