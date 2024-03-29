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
if (!defined('XOOPS_ROOT_PATH')) {
    die('XOOPS root path not defined');
}

/**
 * Class xmcontact_request
 */
class xmcontact_request extends XoopsObject
{
    // constructor
    /**
     * xmcontact_request constructor.
     */
    public function __construct()
    {
        //$this->XoopsObject();
        $this->initVar('request_id', XOBJ_DTYPE_INT, null, false, 11);
        $this->initVar('request_cid', XOBJ_DTYPE_INT, null, false, 11);
        $this->initVar('request_civility', XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('request_name', XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('request_email', XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('request_phone', XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar('request_address', XOBJ_DTYPE_TXTAREA, null, false);
		$this->initVar('request_url', XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('request_ip', XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('request_subject', XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('request_message', XOBJ_DTYPE_TXTAREA, null, false);
        $this->initVar('request_date_e', XOBJ_DTYPE_INT, null, false, 10);
        $this->initVar('request_date_r', XOBJ_DTYPE_INT, null, false, 10);
		$this->initVar('request_token', XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('request_status', XOBJ_DTYPE_INT, null, false, 10);

        //pour les jointures:
        $this->initVar('category_title', XOBJ_DTYPE_TXTBOX, null, false);
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
     * @param bool $action
     * @return XoopsThemeForm
     */
    public function getFormEdit($action = false)
    {
        if (false === $action) {
            $action = $_SERVER['REQUEST_URI'];
        }
        include_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
        
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

    /**
     * @param bool $action
     * @return XoopsThemeForm
     */
    public function getFormReply($action = false)
    {
        if (false === $action) {
            $action = $_SERVER['REQUEST_URI'];
        }
        global $xoopsModuleConfig, $xoopsUser;
        include_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
		include __DIR__ . '/../include/common.php';

		$helper = Helper::getHelper('xmcontact');
		$category = $categoryHandler->get($this->getVar('request_cid'));
		if ($category->getVar('category_signature') != ''){
			$signature = $category->getVar('category_signature', 'e');
		} elseif($helper->getConfig('info_signature', '') != ''){
			$signature = $helper->getConfig('info_signature', '');
		} else {
			$signature = '';
		}
        
        $form = new XoopsThemeForm(_AM_XMCONTACT_REPLY, 'form', $action, 'post', true);
        
        $form->addElement(new XoopsFormLabel('', '<span style="font-weight:bold;">' . _AM_XMCONTACT_REQUEST_TO . '</span>', ''));
        $form->addElement(new XoopsFormLabel(_AM_XMCONTACT_REQUEST_SUBMITTER, $this->getVar('request_name'), 'name'));
        $form->addElement(new XoopsFormLabel(_AM_XMCONTACT_REQUEST_EMAIL, $this->getVar('request_email'), 'email'));
        $form->addElement(new XoopsFormLabel(_AM_XMCONTACT_REQUEST_SUBJECT, $this->getVar('request_subject'), 'subject'));
        $form->addElement(new XoopsFormLabel(_AM_XMCONTACT_REQUEST_MESSAGE, $this->getVar('request_message', 'show'), 'message'));
        
        $form->addElement(new XoopsFormLabel('', '<span style="font-weight:bold;">' . _AM_XMCONTACT_REQUEST_FROM . '</span>', ''));
        $form->addElement(new XoopsFormText(_AM_XMCONTACT_REQUEST_SUBMITTER, 'xmcontact_submitter', 50, 255, XoopsUser::getUnameFromId($GLOBALS['xoopsUser']->uid())), true);
        $form->addElement(new XoopsFormText(_AM_XMCONTACT_REQUEST_EMAIL, 'xmcontact_mail', 50, 255, $GLOBALS['xoopsUser']->getVar('email')), true);
        $form->addElement(new XoopsFormText(_AM_XMCONTACT_REQUEST_SUBJECT, 'xmcontact_subject', 50, 255, _RE . ' ' . $this->getVar('request_subject')), true);
		$reply_value = "\n\n\n\n";
		if ($signature != '') {
			$reply_value .= $signature;
			$reply_value .= "\n\n";
		}		
		$reply_value .= "-----------------------------------------------------------------------------------------------------\n";
		$reply_value .= _AM_XMCONTACT_REQUEST_FROM . " " . $this->getVar('request_email') . "( " . $this->getVar('request_name') . ")\n";
		$reply_value .= _AM_XMCONTACT_REQUEST_DATES . " : " . formatTimestamp($this->getVar('request_date_e')) . "\n";
		$reply_value .= _AM_XMCONTACT_REQUEST_SUBJECT . " : " . $this->getVar('request_subject') . "\n";
		$reply_value .= "\n" . $this->getVar('request_message', 'e');
        $editor_configs=array();
        $editor_configs['name'] ='xmcontact_message';
        $editor_configs['value'] = $reply_value;
        $editor_configs['rows'] = 20;
        $editor_configs['cols'] = 160;
        $editor_configs['width'] = '100%';
        $editor_configs['height'] = '400px';
        $editor_configs['editor'] = $xoopsModuleConfig['admin_editor'];
        $form->addElement(new XoopsFormEditor(_AM_XMCONTACT_REQUEST_MESSAGE, 'xmcontact_message', $editor_configs), false);
		
		// Answer
		if ($helper->getConfig('info_answer', 1) == 1) {
			$criteria = new CriteriaCompo();
			$criteria->setSort('answer_weight ASC, answer_title');
			$criteria->setOrder('ASC');
			$answer_arr = $answerHandler->getall($criteria);
			$answer_count = $answerHandler->getCount($criteria);
			if ($answer_count > 0) {
				$form_answer = new XoopsFormElementTray(_AM_XMCONTACT_REQUEST_ANSWER);
				$answer = new XoopsFormRadio('', 'radioanswer', array_key_first($answer_arr));
				$answer->columns = 4;
				foreach (array_keys($answer_arr) as $i) {
					$value = '<div class="pad5 big bold">' . $answer_arr[$i]->getVar('answer_title') . '</div>';
					$value .= '<div class="pad5 italic">' . $answer_arr[$i]->getVar('answer_description') . '</div>';
					$answer->addOption($i, $value);
					$form->addElement(new XoopsFormHidden('answer' . $answer_arr[$i]->getVar('answer_id'), $answer_arr[$i]->getVar('answer_answer', 'e')));
				}
				$form_answer->addElement($answer);
				$form_answer->addElement(new XoopsFormLabel('<br>', "<button type='button' onclick='insert_answer()'>" . _AM_XMCONTACT_REQUEST_INSERT . "</button>"));
				$form->addElement($form_answer);
			}
			$form->addElement(new XoopsFormRadioYN(_AM_XMCONTACT_REQUEST_SAVEANSWER, 'request_saveanswer', false));
		} else {
			$form->addElement(new XoopsFormHidden('request_saveanswer', 0));
		}		
        $form->addElement(new XoopsFormHidden('toemail', $this->getVar('request_email')));
        $form->addElement(new XoopsFormHidden('request_id', $this->getVar('request_id')));
        $form->addElement(new XoopsFormHidden('xmcontact_signature', $signature));
        $form->addElement(new XoopsFormHidden('op', 'send'));
        // submitt
        $form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
        return $form;
    }
}

/**
 * Class xmcontactxmcontact_requestHandler
 */
class xmcontactxmcontact_requestHandler extends XoopsPersistableObjectHandler
{
    /**
     * xmcontactxmcontact_requestHandler constructor.
     * @param null|XoopsDatabase $db
     */
    public function __construct($db)
    {
        parent::__construct($db, 'xmcontact_request', 'xmcontact_request', 'request_id', 'request_subject');
    }
}
