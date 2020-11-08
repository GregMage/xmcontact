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
use Xmf\Request;
use Xmf\Module\Helper;

defined('XOOPS_ROOT_PATH') || exit('Restricted access.');

/**
 * Class xmcontact_category
 */
class xmcontact_category extends XoopsObject
{
    // constructor
    /**
     * xmcontact_category constructor.
     */
    public function __construct()
    {
        $this->initVar('category_id', XOBJ_DTYPE_INT, null, false, 11);
        $this->initVar('category_title', XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('category_description', XOBJ_DTYPE_TXTAREA, null, false);
        // use html
        $this->initVar('dohtml', XOBJ_DTYPE_INT, 1, false);
        $this->initVar('category_responsible', XOBJ_DTYPE_INT, null, false, 11);
        $this->initVar('category_logo', XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar('category_civility', XOBJ_DTYPE_TXTBOX, '10', false);
		$this->initVar('category_name', XOBJ_DTYPE_TXTBOX, '10', false);
		$this->initVar('category_phone', XOBJ_DTYPE_TXTBOX, '10', false);
		$this->initVar('category_subject', XOBJ_DTYPE_TXTBOX, '10', false);
		$this->initVar('category_address', XOBJ_DTYPE_TXTBOX, '10', false);
		$this->initVar('category_url', XOBJ_DTYPE_TXTBOX, '10', false);
		$this->initVar('category_signature', XOBJ_DTYPE_TXTAREA, null, false);
        $this->initVar('category_weight', XOBJ_DTYPE_INT, null, 11);
        $this->initVar('category_status', XOBJ_DTYPE_INT, 1, false);
    }

    /**
     * @return mixed
     */
    public function get_new_enreg()
    {
        global $xoopsDB;
        $new_enreg = $xoopsDB->getInsertId();
        return $new_enreg;
    }
    /**
     * @return mixed
     */
    public function saveCategory($categoryHandler, $action = false)
    {
		if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
		include __DIR__ . '/../include/common.php';
        $error_message = '';
        // test error
        if ((int)$_REQUEST['category_weight'] == 0 && $_REQUEST['category_weight'] != '0') {
            $error_message .= _AM_XMCONTACT_ERROR_WEIGHT . '<br>';
            $this->setVar('category_weight', 0);
        }
        //logo
        $uploadirectory = $path_logo;		
        if ($_FILES['category_logo']['error'] != UPLOAD_ERR_NO_FILE) {
            include_once XOOPS_ROOT_PATH . '/class/uploader.php';
            $uploader_category_img = new XoopsMediaUploader($uploadirectory, ['image/gif', 'image/jpeg', 'image/pjpeg', 'image/x-png', 'image/png'], $upload_size, null, null);
            if ($uploader_category_img->fetchMedia('category_logo')) {
                $uploader_category_img->setPrefix('category_');
                if (!$uploader_category_img->upload()) {
                    $error_message .= $uploader_category_img->getErrors() . '<br>';
                } else {
                    $this->setVar('category_logo', $uploader_category_img->getSavedFileName());
                }
            } else {
                $error_message .= $uploader_category_img->getErrors();
            }
        } else {
            $this->setVar('category_logo', Request::getString('category_logo', ''));
        }
        $this->setVar('category_title', Request::getString('category_title', ''));
        $this->setVar('category_description', Request::getText('category_description', ''));
        $this->setVar('category_signature', Request::getText('category_signature', ''));
        $this->setVar('category_responsible', Request::getInt('category_responsible', 1));
        $this->setVar('category_civility', Request::getInt('category_docivility', 1) . Request::getInt('category_recivility', 0));
        $this->setVar('category_name', Request::getInt('category_doname', 1) . Request::getInt('category_rename', 0));
        $this->setVar('category_phone', Request::getInt('category_dophone', 1) . Request::getInt('category_rephone', 0));
        $this->setVar('category_subject', Request::getInt('category_dosubject', 1) . Request::getInt('category_resubject', 0));
        $this->setVar('category_address', Request::getInt('category_doaddress', 1) . Request::getInt('category_readdress', 0));
        $this->setVar('category_url', Request::getInt('category_dourl', 1) . Request::getInt('category_reurl', 0));
        $this->setVar('category_status', Request::getInt('category_status', 1));

         if ($error_message == '') {
            $this->setVar('category_weight', Request::getInt('category_weight', 0));
            if ($categoryHandler->insert($this)) {
				redirect_header($action, 2, _AM_XMCONTACT_REDIRECT_SAVE);
            } else {
                $error_message = $this->getHtmlErrors();
            }
        }

        return $error_message;
    }

    /**
     * @param bool $action
     * @return XoopsThemeForm
     */
    public function getForm($action = false)
    {
		$helper      = Helper::getHelper('xmcontact');
        if (false === $action) {
            $action = $_SERVER['REQUEST_URI'];
        }
        include_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
		include __DIR__ . '/../include/common.php';
        
        //form title
        $title = $this->isNew() ? sprintf(_AM_XMCONTACT_ADD) : sprintf(_AM_XMCONTACT_EDIT);
        
        $form = new XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        
        if (!$this->isNew()) {
            $form->addElement(new XoopsFormHidden('category_id', $this->getVar('category_id')));
            $status = $this->getVar('category_status');
            $weight = $this->getVar('category_weight');
        } else {
            $status = 1;
            $weight = 0;
        }

        // title
        $form->addElement(new XoopsFormText(_AM_XMCONTACT_CATEGORY_TITLE, 'category_title', 50, 255, $this->getVar('category_title')), true);

        // description
        $editor_configs           =array();
        $editor_configs['name']   = 'category_description';
        $editor_configs['value']  = $this->getVar('category_description', 'e');
        $editor_configs['rows']   = 20;
        $editor_configs['cols']   = 160;
        $editor_configs['width']  = '100%';
        $editor_configs['height'] = '400px';
        $editor_configs['editor'] = $helper->getConfig('admin_editor', 'Plain Text');
		$description = new XoopsFormEditor(_AM_XMCONTACT_CATEGORY_DESC, 'category_description', $editor_configs);
		$description->setDescription(AM_XMCONTACT_CATEGORY_DESC_DSC);
        $form->addElement($description, false);
		
        // responsible
		xoops_load('formuser', 'xmcontact');
        $form->addElement(new XmcontactFormUser(_AM_XMCONTACT_CATEGORY_RESPONSIBLE, 'category_responsible', true, $this->getVar('category_responsible'), 1, false), true);
        // logo
        $blank_img = $this->getVar('category_logo') ? $this->getVar('category_logo') : 'blank.gif';
		$uploadirectory  = str_replace(XOOPS_URL, '', $url_logo);
        $imgtray_img     = new XoopsFormElementTray(_AM_XMCONTACT_CATEGORY_LOGOFILE  . '<br /><br />' . sprintf(_AM_XMCONTACT_CATEGORY_UPLOADSIZE, $upload_size/1000), '<br />');
        $imgpath_img     = sprintf(_AM_XMCONTACT_CATEGORY_FORMPATH, $uploadirectory);
        $imageselect_img = new XoopsFormSelect($imgpath_img, 'category_logo', $blank_img);
        $image_array_img = XoopsLists::getImgListAsArray(XOOPS_ROOT_PATH . $uploadirectory);
        $imageselect_img->addOption("$blank_img", $blank_img);
        foreach ($image_array_img as $image_img) {
            $imageselect_img->addOption("$image_img", $image_img);
        }
        $imageselect_img->setExtra("onchange='showImgSelected(\"image_img2\", \"category_logo\", \"" . $uploadirectory . "\", \"\", \"" . XOOPS_URL . "\")'");
        $imgtray_img->addElement($imageselect_img, false);
        $imgtray_img->addElement(new XoopsFormLabel('', "<br /><img src='" . XOOPS_URL . '/' . $uploadirectory . '/' . $blank_img . "' name='image_img2' id='image_img2' alt='' style='max-width:100px'/>"));
        $fileseltray_img = new XoopsFormElementTray('<br />', '<br /><br />');
        $fileseltray_img->addElement(new XoopsFormFile(_AM_XMCONTACT_CATEGORY_UPLOAD, 'category_logo', $upload_size), false);
        $fileseltray_img->addElement(new XoopsFormLabel(''), false);
        $imgtray_img->addElement($fileseltray_img);
        $form->addElement($imgtray_img);
		
		
		
		if (!$this->isNew()) {
			$docivility = substr($this->getVar('category_civility'), 0, 1);
			$recivility = substr($this->getVar('category_civility'), 1, 1);
			$doname = substr($this->getVar('category_name'), 0, 1);
			$rename = substr($this->getVar('category_name'), 1, 1);
			$dophone = substr($this->getVar('category_phone'), 0, 1);
			$rephone = substr($this->getVar('category_phone'), 1, 1);
			$dosubject = substr($this->getVar('category_subject'), 0, 1);
			$resubject = substr($this->getVar('category_subject'), 1, 1);
			$doaddress = substr($this->getVar('category_address'), 0, 1);
			$readdress = substr($this->getVar('category_address'), 1, 1);
			$dourl = substr($this->getVar('category_url'), 0, 1);
			$reurl = substr($this->getVar('category_url'), 1, 1);
		} else {
			$docivility = 1;
			$recivility = 0;
			$doname = 1;
			$rename = 0;
			$dophone = 1;
			$rephone = 0;
			$dosubject = 1;
			$resubject = 0;
			$doaddress = 1;
			$readdress = 0;
			$dourl = 1;
			$reurl = 0;
		}
		$opentable  = new \XoopsFormLabel('', '<table><tr><td width="25%">');
		$addcol     = new \XoopsFormLabel('', '</td><td>');
		$closetable = new \XoopsFormLabel('', '</td></tr></table>');
		// civility
		$civility = new XoopsFormElementTray(_AM_XMCONTACT_CATEGORY_CIVILITY, '');
		$civility ->addElement($opentable);
		$docivility = new XoopsFormRadioYN(_AM_XMCONTACT_CATEGORY_VIEW, 'category_docivility', $docivility);
		$civility->addElement($docivility);
		$civility->addElement($addcol);
		$recivility = new XoopsFormRadioYN(_AM_XMCONTACT_CATEGORY_REQUIRED, 'category_recivility', $recivility);
		$civility->addElement($recivility);
		$civility->addElement($closetable);
		$form->addElement($civility, false);
		// name
		$name = new XoopsFormElementTray(_AM_XMCONTACT_CATEGORY_NAME, '');
		$doname = new XoopsFormRadioYN(_AM_XMCONTACT_CATEGORY_VIEW, 'category_doname', $doname);
		$name ->addElement($opentable);
		$name->addElement($doname);
		$name->addElement($addcol);
		$rename = new XoopsFormRadioYN(_AM_XMCONTACT_CATEGORY_REQUIRED, 'category_rename', $rename);
		$name->addElement($rename);
		$name->addElement($closetable);
		$form->addElement($name, false);
		// phone
		$phone = new XoopsFormElementTray(_AM_XMCONTACT_CATEGORY_PHONE, '');
		$dophone = new XoopsFormRadioYN(_AM_XMCONTACT_CATEGORY_VIEW, 'category_dophone', $dophone);
		$phone ->addElement($opentable);
		$phone->addElement($dophone);
		$phone->addElement($addcol);
		$rephone = new XoopsFormRadioYN(_AM_XMCONTACT_CATEGORY_REQUIRED, 'category_rephone', $rephone);
		$phone->addElement($rephone);
		$phone->addElement($closetable);
		$form->addElement($phone, false);
		// subject
		$subject = new XoopsFormElementTray(_AM_XMCONTACT_CATEGORY_SUBJECT, '');
		$dosubject = new XoopsFormRadioYN(_AM_XMCONTACT_CATEGORY_VIEW, 'category_dosubject', $dosubject);
		$subject ->addElement($opentable);
		$subject->addElement($dosubject);
		$subject->addElement($addcol);
		$resubject = new XoopsFormRadioYN(_AM_XMCONTACT_CATEGORY_REQUIRED, 'category_resubject', $resubject);
		$subject->addElement($resubject);
		$subject->addElement($closetable);
		$form->addElement($subject, false);
		// address
		$address = new XoopsFormElementTray(_AM_XMCONTACT_CATEGORY_ADDRESS, '');
		$doaddress = new XoopsFormRadioYN(_AM_XMCONTACT_CATEGORY_VIEW, 'category_doaddress', $doaddress);
		$address ->addElement($opentable);
		$address->addElement($doaddress);
		$address->addElement($addcol);
		$readdress = new XoopsFormRadioYN(_AM_XMCONTACT_CATEGORY_REQUIRED, 'category_readdress', $readdress);
		$address->addElement($readdress);
		$address->addElement($closetable);
		$form->addElement($address, false);
		// url
		$url = new XoopsFormElementTray(_AM_XMCONTACT_CATEGORY_URL, '');
		$dourl = new XoopsFormRadioYN(_AM_XMCONTACT_CATEGORY_VIEW, 'category_dourl', $dourl);
		$url ->addElement($opentable);
		$url->addElement($dourl);
		$url->addElement($addcol);
		$reurl = new XoopsFormRadioYN(_AM_XMCONTACT_CATEGORY_REQUIRED, 'category_reurl', $reurl);
		$url->addElement($reurl);
		$url->addElement($closetable);
		$form->addElement($url, false);
		
		// signature
        $form->addElement(new XoopsFormTextArea(_AM_XMCONTACT_CATEGORY_SIGNATURE, 'category_signature', $this->getVar('category_signature', 'e')), false);
		
        // weight
        $form->addElement(new XoopsFormText(_AM_XMCONTACT_CATEGORY_WEIGHT, 'category_weight', 5, 5, $weight), true);

        // status
        $form_status = new XoopsFormRadio(_AM_XMCONTACT_STATUS, 'category_status', $status);
        $options = array(1 => _AM_XMCONTACT_STATUS_A, 0 =>_AM_XMCONTACT_STATUS_NA,);
        $form_status->addOptionArray($options);
        $form->addElement($form_status);

        $form->addElement(new XoopsFormHidden('op', 'save'));
        // submitt
        $form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));

        return $form;
    }
}

/**
 * Class xmcontactxmcontact_categoryHandler
 */
class xmcontactxmcontact_categoryHandler extends XoopsPersistableObjectHandler
{
    /**
     * xmcontactxmcontact_categoryHandler constructor.
     * @param null|XoopsDatabase $db
     */
    public function __construct(&$db)
    {
        parent::__construct($db, 'xmcontact_category', 'xmcontact_category', 'category_id', 'category_title');
    }
}
