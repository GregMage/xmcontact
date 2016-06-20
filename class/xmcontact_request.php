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
        $this->XoopsObject();
        $this->initVar('request_id',XOBJ_DTYPE_INT,null,false,11);
        $this->initVar('request_cid',XOBJ_DTYPE_INT,null,false,11);
        $this->initVar('request_name',XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('request_email',XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('request_phone',XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('request_subject',XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('request_message',XOBJ_DTYPE_TXTAREA, null, false);
        $this->initVar('request_date',XOBJ_DTYPE_INT,null,false,10);
        $this->initVar('request_status',XOBJ_DTYPE_INT,null,false,10);
        $this->initVar('request_ip',XOBJ_DTYPE_TXTBOX, null, false);

        //pour les jointures:
        //$this->initVar("cat_title",XOBJ_DTYPE_TXTBOX, null, false);
        //$this->initVar("cat_imgurl",XOBJ_DTYPE_TXTBOX, null, false);
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
}

class xmcontactxmcontact_requestHandler extends XoopsPersistableObjectHandler
{
    function __construct(&$db)
    {
        parent::__construct($db, "xmcontact_request", 'xmcontact_request', 'request_id', 'request_subject');
    }
}