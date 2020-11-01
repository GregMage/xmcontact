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
// The name of this module
define('_MI_XMCONTACT_NAME', 'Contact Us');
define('_MI_XMCONTACT_DESC', 'Contact module');

// Admin menu
define('_MI_XMCONTACT_MENU_HOME', 'Home');
define('_MI_XMCONTACT_MENU_HOME_DESC', 'Go back to homepage');
define('_MI_XMCONTACT_MENU_CATEGORY', 'Forms');
define('_MI_XMCONTACT_MENU_CATEGORY_DESC', 'List of forms');
define('_MI_XMCONTACT_MENU_REQUEST', 'Requests');
define('_MI_XMCONTACT_MENU_REQUEST_DESC', 'List of requests');
define('_MI_XMCONTACT_MENU_ABOUT', 'About');
define('_MI_XMCONTACT_MENU_ABOUT_DESC', 'About this module');
define('_MI_XMCONTACT_MENU_HELP', 'Help');
define('_MI_XMCONTACT_MENU_HELP_DESC', 'Module help');
// Blocks
define('_MI_XMCONTACT_BLOCK_CONTACT', 'Contact');
define('_MI_XMCONTACT_BLOCK_CONTACT_DESC', 'Block of contact');
// Pref.
define('_MI_XMCONTACT_PREF_HEAD_INFORMATION', "<span style='font-weight: bold;'>Information</span>");
define('_MI_XMCONTACT_PREF_CAPTCHA', 'Use Captcha?');
define('_MI_XMCONTACT_PREF_CAPTCHA_DESC', 'Select Yes to use Captcha in the submit form');
define('_MI_XMCONTACT_PREF_COLUMNCAT', 'Number of column for Form View');
define('_MI_XMCONTACT_PREF_COLUMNCAT_DESC', 'Number of form that can be viewed: 1, 2 or 3 columns');
define('_MI_XMCONTACT_PREF_HEADER', 'Header index page');
define('_MI_XMCONTACT_PREF_HEADER_DESC', 'Set HTML codes to show in contact page');
define('_MI_XMCONTACT_PREF_FOOTER', 'Footer contact form');
define('_MI_XMCONTACT_PREF_FOOTER_DESC', 'Set HTML codes to show in contact page');
define('_MI_XMCONTACT_PREF_ADDRESSE', 'Addresse index page');
define('_MI_XMCONTACT_PREF_ADDRESSE_DESC', 'Set HTML codes to show in contact page');
define('_MI_XMCONTACT_PREF_GOOGLEMAPS', 'Embed Google maps');
define('_MI_XMCONTACT_PREF_GOOGLEMAPS_DESC', "Embed Google maps iFrame<br />change iFrame width to '100%'");
define('_MI_XMCONTACT_PREF_NOTIFICATION', 'Enable email notification');
define('_MI_XMCONTACT_PREF_NOTIFICATION_DESC', 'For every contact request, the form owner will receive an email notification');
define('_MI_XMCONTACT_PREF_HEAD_ADMIN', "<span style='font-weight: bold;'>Administration</span>");
define('_MI_XMCONTACT_PREF_EDITOR', 'Text Editor');
define('_MI_XMCONTACT_PREF_ITEMPERPAGE', 'Number of items per page in the Admin view');

//new version 1.0
define('_MI_XMCONTACT_PREF_HEAD_SIMPLECONTACT', 'Valid options if the module is used with a single contact form');
define('_MI_XMCONTACT_PREF_SP_DESC', 'Valid only if the module is used with a single contact form');
define('_MI_XMCONTACT_PREF_DOCIVILITY', 'View civility');
define('_MI_XMCONTACT_PREF_RECIVILITY', 'Required civility');
define('_MI_XMCONTACT_PREF_DONAME', 'View name');
define('_MI_XMCONTACT_PREF_RENAME', 'Required name');
define('_MI_XMCONTACT_PREF_DOPHONE', 'View phone number');
define('_MI_XMCONTACT_PREF_REPHONE', 'Required phone number');
define('_MI_XMCONTACT_PREF_DOSUBJECT', 'View subject');
define('_MI_XMCONTACT_PREF_RESUBJECT', 'Required subject');
define('_MI_XMCONTACT_PREF_DOADDRESS', 'View address');
define('_MI_XMCONTACT_PREF_READDRESS', 'Required address');
define('_MI_XMCONTACT_PREF_DOURL', 'View url');
define('_MI_XMCONTACT_PREF_REURL', 'Required url');

//new version 2.0
define('_MI_XMCONTACT_PREF_SIGNATURE', 'Default signature');
define('_MI_XMCONTACT_PREF_SIGNATURE_DESC', 'This signature will be used for single forms and by default for multiple forms');
define('_MI_XMCONTACT_PREF_SIMPLECONTACT', 'Use only of a simple contact form');
define('_MI_XMCONTACT_PREF_SIMPLECONTACT_DESC', 'If you want to use several forms, it is necessary to set this option to "no"');
define('_MI_XMCONTACT_BLOCK_CONTACTFORM', 'Contact form');
define('_MI_XMCONTACT_BLOCK_CONTACTFORM_DESC', 'Block with contact form');
define('_AM_XMCONTACT_CATEGORY_SIGNATURE', 'Signature');