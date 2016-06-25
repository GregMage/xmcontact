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

class xmcontact_request extends XoopsObject
{
// constructor
    function __construct()
    {
        //$this->XoopsObject();
        $this->initVar('request_id',XOBJ_DTYPE_INT,null,false,11);
        $this->initVar('request_cid',XOBJ_DTYPE_INT,null,false,11);
        $this->initVar('request_name',XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('request_email',XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('request_phone',XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('request_ip',XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('request_subject',XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('request_message',XOBJ_DTYPE_TXTAREA, null, false);
        $this->initVar('request_date_e',XOBJ_DTYPE_INT,null,false,10);
        $this->initVar('request_date_r',XOBJ_DTYPE_INT,null,false,10);
        $this->initVar('request_status',XOBJ_DTYPE_INT,null,false,10);

        //pour les jointures:
        $this->initVar('category_title',XOBJ_DTYPE_TXTBOX, null, false);
    }
    function get_new_enreg()
    {
        global $xoopsDB;
        $new_enreg = $xoopsDB->getInsertId();
        return $new_enreg;
    }
    function xmcontact_request()
    {
        $this->__construct();
    }
    function getFormEdit($action = false)
    {
        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
        include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");
        
        $form = new XoopsThemeForm(_AM_XMCONTACT_EDITSTATUS, 'form', $action, 'post', true);
        // submitter
        $form->addElement(new XoopsFormLabel(_AM_XMCONTACT_REQUEST_SUBMITTER, $this->getVar('request_name'), 'name'));
        // subject
        $form->addElement(new XoopsFormLabel(_AM_XMCONTACT_REQUEST_SUBJECT, $this->getVar('request_subject'), 'subject'));    
        // status
        $status = new XoopsFormRadio(_AM_XMCONTACT_STATUS, 'request_status', $this->getVar('request_status'));
        $options = array('0' =>_AM_XMCONTACT_REQUEST_STATUS_NR, '1' => _AM_XMCONTACT_REQUEST_STATUS_R);
        $status->addOptionArray($options);
        $form->addElement($status);

        $form->addElement(new XoopsFormHidden('request_id', $this->getVar('request_id')));
        $form->addElement(new XoopsFormHidden('op', 'save'));
        // submitt
        $form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));

        return $form;
    }
    
    function getFormReply($action = false)
    {
        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
        include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");
        
        $form = new XoopsThemeForm(_AM_XMCONTACT_EDITSTATUS, 'form', $action, 'post', true);
        
        $form->addElement(new XoopsFormLabel(_AM_XMCONTACT_REQUEST_SUBMITTER, $this->getVar('request_name'), 'name'));
        //$form->addElement(new XoopsFormLabel(_AM_XMCONTACT_REQUEST_EMAIL, $this->getVar('request_email'), 'email'));
        $form->addElement(new XoopsFormLabel(_AM_XMCONTACT_REQUEST_SUBJECT, $this->getVar('request_subject'), 'subject'));
        //$form->addElement(new XoopsFormLabel(_AM_XMCONTACT_REQUEST_MESSAGE, $this->getVar('request_message', 'show'), 'message'));
        
        // status
        $status = new XoopsFormRadio(_AM_XMCONTACT_STATUS, 'date_update', $this->getVar('request_status'));
        $options = array('0' =>_AM_XMCONTACT_REQUEST_STATUS_NR, '1' => _AM_XMCONTACT_REQUEST_STATUS_R);
        $status->addOptionArray($options);
        $form->addElement($status);

        $form->addElement(new XoopsFormHidden('op', 'save'));
        // submitt
        $form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));

        return $form;
    }
}

class xmcontactxmcontact_requestHandler extends XoopsPersistableObjectHandler
{
    function __construct(&$db)
    {
        parent::__construct($db, "xmcontact_request", 'xmcontact_request', 'request_id', 'request_subject');
    }
}