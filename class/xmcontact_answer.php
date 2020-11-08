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
use Xmf\Request;
if (!defined('XOOPS_ROOT_PATH')) {
    die('XOOPS root path not defined');
}

/**
 * Class xmcontact_answer
 */
class xmcontact_answer extends XoopsObject
{
    // constructor
    /**
     * xmcontact_answer constructor.
     */
    public function __construct()
    {
        //$this->XoopsObject();
        $this->initVar('answer_id', XOBJ_DTYPE_INT, null, false, 11);
        $this->initVar('answer_title', XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar('answer_description', XOBJ_DTYPE_TXTAREA, null, false);
        // use html
		$this->initVar('dohtml', XOBJ_DTYPE_INT, 1, false);
		$this->initVar('answer_answer', XOBJ_DTYPE_TXTAREA, null, false);
		$this->initVar('answer_weight', XOBJ_DTYPE_INT, null, 11);
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
    public function saveAnswer($answerHandler, $action = false)
    {
		if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
		include __DIR__ . '/../include/common.php';
        $error_message = '';
        // test error
        if ((int)$_REQUEST['answer_weight'] == 0 && $_REQUEST['answer_weight'] != '0') {
            $error_message .= _AM_XMCONTACT_ERROR_WEIGHT . '<br>';
            $this->setVar('answer_weight', 0);
        }

        $this->setVar('answer_title', Request::getString('answer_title', ''));
        $this->setVar('answer_description', Request::getText('answer_description', ''));
        $this->setVar('answer_answer', Request::getText('answer_answer', ''));

         if ($error_message == '') {
            $this->setVar('answer_weight', Request::getInt('answer_weight', 0));
            if ($answerHandler->insert($this)) {
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
    public function getForm($action = false, $answer_mesage = '')
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
        
        if (!$this->isNew()) {
			$form->addElement(new XoopsFormHidden('answer_id', $this->getVar('answer_id')));
            $weight = $this->getVar('answer_weight');
			$answer_mesage = $this->getVar('answer_answer', 'e');
        } else {
            $weight = 0;
        }

        // title
        $form->addElement(new XoopsFormText(_AM_XMCONTACT_ANSWER_TITLE, 'answer_title', 50, 255, $this->getVar('answer_title')), true);

        // description
		$form->addElement(new XoopsFormTextArea(_AM_XMCONTACT_ANSWER_DESC, 'answer_description', $this->getVar('answer_description', 'e'), 1), false);
		
		// answer
        $editor_configs           =array();
        $editor_configs['name']   = 'answer_answer';
        $editor_configs['value']  = $answer_mesage;
        $editor_configs['rows']   = 20;
        $editor_configs['cols']   = 160;
        $editor_configs['width']  = '100%';
        $editor_configs['height'] = '400px';
        $editor_configs['editor'] = $helper->getConfig('admin_editor', 'Plain Text');
        $form->addElement(new XoopsFormEditor(_AM_XMCONTACT_ANSWER_ANSWER, 'answer_answer', $editor_configs), true);
		
        // weight
        $form->addElement(new XoopsFormText(_AM_XMCONTACT_CATEGORY_WEIGHT, 'answer_weight', 5, 5, $weight), true);

        $form->addElement(new XoopsFormHidden('op', 'save'));
        // submitt
        $form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));

        return $form;
    }
}

/**
 * Class xmcontactxmcontact_answerHandler
 */
class xmcontactxmcontact_answerHandler extends XoopsPersistableObjectHandler
{
    /**
     * xmcontactxmcontact_answerHandler constructor.
     * @param null|XoopsDatabase $db
     */
    public function __construct(&$db)
    {
        parent::__construct($db, 'xmcontact_answer', 'xmcontact_answer', 'answer_id', 'answer_title');
    }
}
