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

/**
 * Class XmcontactUtility
 */
class XmcontactUtility
{

	public static function generateDescriptionTagSafe($text, $wordCount = 100)
    {
		if (xoops_isActiveModule('xlanguage')){
			$text = XoopsModules\Xlanguage\Utility::cleanMultiLang($text);
		}
		$text = \Xmf\Metagen::generateDescription($text, $wordCount);
		return $text;
	}

	public static function TagSafe($text)
    {
		if (xoops_isActiveModule('xlanguage')){
			$text = XoopsModules\Xlanguage\Utility::cleanMultiLang($text);
		}
		return $text;
	}
}
