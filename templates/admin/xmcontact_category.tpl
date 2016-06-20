<script type="text/javascript">
    IMG_ON = '<{xoAdminIcons success.png}>';
    IMG_OFF = '<{xoAdminIcons cancel.png}>';
</script>
<div class="xmcontact">
    <{$navigation}>
</div>
<div class="xmcontact">
    <{$renderbutton}>
</div>
<{if $message_error != ''}>
    <div class="errorMsg" style="text-align: left;">
        <{$message_error}>
    </div>
<{/if}>
<div class="xmcontact">
    <{$form}>
</div>
<{if $category_count != 0}>
    <table id="xo-xmcontact-sorter" cellspacing="1" class="outer tablesorter">
        <thead>
        <tr>
            <th class="txtcenter width10"><{$smarty.const._AM_XMCONTACT_CATEGORY_LOGO}></th>
            <th class="txtleft" width15><{$smarty.const._AM_XMCONTACT_CATEGORY_TITLE}></th>
            <th class="txtleft"><{$smarty.const._AM_XMCONTACT_CATEGORY_DESC}></th>
            <th class="txtcenter width5"><{$smarty.const._AM_XMCONTACT_CATEGORY_WEIGHT}></th>
            <th class="txtcenter width5"><{$smarty.const._AM_XMCONTACT_STATUS}></th>
            <th class="txtcenter width10"><{$smarty.const._AM_XMCONTACT_ACTION}></th>
        </tr>
        </thead>
        <tbody>
        <{foreach item=category from=$category}>
            <tr class="<{cycle values='even,odd'}> alignmiddle">
                 <td class="txtcenter"><{$category.logo}></td>
                 <td class="txtleft"><{$category.title}></td>
                 <td class="txtleft"><{$category.description}></td>
                 <td class="txtcenter"><{$category.weight}></td>
                 <td class="xo-actions">
                    <img id="loading_sml<{$category.id}>" src="images/spinner.gif" style="display:none;" title="<{$smarty.const._AM_SYSTEM_LOADING}>"
                    alt="<{$smarty.const._AM_SYSTEM_LOADING}>"/><img class="cursorpointer tooltip" id="sml<{$category.id}>"
                    onclick="system_setStatus( { op: 'category_update_status', category_id: <{$category.id}> }, 'category.php' )"
                    src="<{if $category.status}><{xoAdminIcons success.png}><{else}><{xoAdminIcons cancel.png}><{/if}>"
                    alt="<{if $category.status}><{$smarty.const._AM_SYSTEM_SMILIES_OFF}><{else}><{$smarty.const._AM_SYSTEM_SMILIES_ON}><{/if}>"
                    title="<{if $category.status}><{$smarty.const._AM_SYSTEM_SMILIES_OFF}><{else}><{$smarty.const._AM_SYSTEM_SMILIES_ON}><{/if}>"/>
                 </td>
                 <td class="txtcenter"><{$category.edit_delete}></td>
            </tr>
        <{/foreach}>
        </tbody>
    </table>
    <div class="clear spacer"></div>
    <{if $nav_menu}>
        <div class="xo-avatar-pagenav floatright"><{$nav_menu}></div>
        <div class="clear spacer"></div>
    <{/if}>
<{/if}>


