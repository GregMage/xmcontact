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

if (!defined("XOOPS_ROOT_PATH")) {
    die("XOOPS root path not defined");
}

class xmcontact_category extends XoopsObject
{
// constructor
    function __construct()
    {
        //$this->XoopsObject();
        $this->initVar('category_id',XOBJ_DTYPE_INT,null,false,11);
        $this->initVar('category_title',XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('category_description',XOBJ_DTYPE_TXTAREA, null, false);
        // use html
        $this->initVar('dohtml', XOBJ_DTYPE_INT, 1, false);
        $this->initVar('category_responsible',XOBJ_DTYPE_INT,null,false,11);
        $this->initVar('category_logo',XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('category_weight',XOBJ_DTYPE_INT,null,false,11);
        $this->initVar('category_status',XOBJ_DTYPE_INT,null,false,1);
    }
    function get_new_enreg()
    {
        global $xoopsDB;
        $new_enreg = $xoopsDB->getInsertId();
        return $new_enreg;
    }
    function xmcontact_category()
    {
        $this->__construct();
    }
    function getForm($action = false)
    {
        global $xoopsModuleConfig, $xoopsUser;
        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
        include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");
        
        //form title
        $title = $this->isNew() ? sprintf(_AM_XMCONTACT_ADD) : sprintf(_AM_XMCONTACT_EDIT);
        
        $form = new XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');

        // title
        $form->addElement(new XoopsFormText(_AM_XMCONTACT_CATEGORY_TITLE, 'category_title', 50, 255, $this->getVar('category_title')), true);

        // description
        $editor_configs=array();
        $editor_configs["name"] ="category_description";
        $editor_configs["value"] = $this->getVar('category_description', 'e');
        $editor_configs["rows"] = 20;
        $editor_configs["cols"] = 160;
        $editor_configs["width"] = "100%";
        $editor_configs["height"] = "400px";
        $editor_configs["editor"] = $xoopsModuleConfig['editor'];
        $form->addElement( new XoopsFormEditor(_AM_XMCONTACT_CATEGORY_DESC, "category_description", $editor_configs), false);
        // responsible
        $form->addElement(new XoopsFormSelectUser(_AM_XMCONTACT_CATEGORY_RESPONSIBLE, 'category_responsible', true, $this->getVar('category_responsible'), 1, false), true);
        // logo
        $blank_img = $this->getVar('category_logo') ? $this->getVar('category_logo') : 'blank.gif';
        $uploadirectory='/uploads/xmcontact/images/cats';
        $imgtray_img     = new XoopsFormElementTray(_AM_XMCONTACT_CATEGORY_LOGOFILE, '<br />');
        $imgpath_img     = sprintf(_AM_XMCONTACT_CATEGORY_FORMPATH, $uploadirectory);
        $imageselect_img = new XoopsFormSelect($imgpath_img, 'category_logo', $blank_img);
        $image_array_img = XoopsLists::getImgListAsArray(XOOPS_ROOT_PATH . $uploadirectory);
        $imageselect_img->addOption("$blank_img", $blank_img);
        foreach ($image_array_img as $image_img) {
            $imageselect_img->addOption("$image_img", $image_img);
        }
        $imageselect_img->setExtra( "onchange='showImgSelected(\"image_img2\", \"category_logo\", \"" . $uploadirectory . "\", \"\", \"" . XOOPS_URL . "\")'" );
        $imgtray_img->addElement($imageselect_img, false);
        $imgtray_img->addElement(new XoopsFormLabel('', "<br /><img src='" . XOOPS_URL . "/" . $uploadirectory . "/" . $blank_img . "' name='image_img2' id='image_img2' alt='' />" ) );
        $fileseltray_img = new XoopsFormElementTray('<br />', '<br /><br />');
        $fileseltray_img->addElement(new XoopsFormFile(_AM_XMCONTACT_CATEGORY_UPLOAD, 'category_logo', 500000), false);
        $fileseltray_img->addElement(new XoopsFormLabel(''), false);
        $imgtray_img->addElement($fileseltray_img);
        $form->addElement($imgtray_img);
        // weight
        $form->addElement(new XoopsFormText(_AM_XMCONTACT_CATEGORY_WEIGHT, 'category_weight', 5, 5, $this->getVar('category_weight', 'e')), false);
        if (!$this->isNew()) {
            $form->addElement(new XoopsFormHidden('category_id', $this->getVar('category_id')));
            $status = $this->getVar('category_status');
        } else {
            $status = 1;
        }
        // status
        $form->addElement(new XoopsFormRadioYN(_AM_XMCONTACT_STATUS, 'category_status', $status));

        $form->addElement(new XoopsFormHidden('op', 'save'));
        // submitt
        $form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));

        return $form;
    }
}

class xmcontactxmcontact_categoryHandler extends XoopsPersistableObjectHandler
{
    function __construct(&$db)
    {
        parent::__construct($db, "xmcontact_category", 'xmcontact_category', 'category_id', 'category_name');
    }
}