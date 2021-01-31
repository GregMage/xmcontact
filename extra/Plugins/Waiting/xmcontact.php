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
 * @return array
 */
function b_waiting_xmcontact()
{
    /** @var \XoopsMySQLDatabase $xoopsDB */
    $xoopsDB = \XoopsDatabaseFactory::getDatabaseConnection();
    $ret     = [];
    $block   = [];
    $sql    = 'SELECT COUNT(*) FROM ' . $xoopsDB->prefix('xmcontact_request') . ' WHERE request_status=0';
    $result = $xoopsDB->query($sql);
    if ($result) {
        $block['adminlink'] = XOOPS_URL . '/modules/xmcontact/admin/request.php?request_cid=0&request_status=0';
        [$block['pendingnum']] = $xoopsDB->fetchRow($result);
        $block['lang_linkname'] = _PI_WAITING_CONTACT;
    }

    $ret[] = $block;

    return $ret;
}
