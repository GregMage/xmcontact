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
<{if $request_count != 0}>
    <table id="xo-xmcontact-sorter" cellspacing="1" class="outer tablesorter">
        <thead>
        <tr>
            <th class="txtcenter width5"><{$smarty.const._AM_XMCONTACT_REQUEST_NUMBER}></th>
            <th class="txtleft width15"><{$smarty.const._AM_XMCONTACT_CATEGORY}></th>
            <th class="txtleft"><{$smarty.const._AM_XMCONTACT_REQUEST_SUBJECT}></th>
            <th class="txtcenter width15"><{$smarty.const._AM_XMCONTACT_REQUEST_SUBMITTER}></th>
            <th class="txtcenter width15"><{$smarty.const._AM_XMCONTACT_REQUEST_DATES}></th>
            <th class="txtcenter width10"><{$smarty.const._AM_XMCONTACT_REQUEST_DATER}></th>
            <th class="txtcenter width10"><{$smarty.const._AM_XMCONTACT_STATUS}></th>
            <th class="txtcenter width10"><{$smarty.const._AM_XMCONTACT_ACTION}></th>
        </tr>
        </thead>
        <tbody>
        <{foreach item=request from=$request}>
            <tr class="<{cycle values='even,odd'}> alignmiddle">
                <td class="txtcenter"><{$request.id}></td>
                <td class="txtleft"><{$request.category}></td>
                <td class="txtleft"><{$request.subject}></td>
                <td class="txtcenter"><{$request.name}></td>
                <td class="txtcenter"><{$request.date_e}></td>
                <td class="txtcenter"><{$request.date_s}></td>
                <td class="xo-actions txtcenter">
                    <{$request.status}>
                    <a class="tooltip" href="request.php?op=edit&amp;request_id=<{$request.id}>" title="<{$smarty.const._AM_XMCONTACT_EDITSTATUS}>">
                        <img src="<{xoAdminIcons edit.png}>" alt="<{$smarty.const._AM_XMCONTACT_EDITSTATUS}>"/>
                    </a>
                </td>
                <td class="xo-actions txtcenter">
                    <a class="tooltip" href="request.php?op=view&amp;request_id=<{$request.id}>" title="<{$smarty.const._AM_XMCONTACT_VIEW}>">
                        <img src="<{xoAdminIcons view.png}>" alt="<{$smarty.const._AM_XMCONTACT_VIEW}>"/>
                    </a>
                    <a class="tooltip" href="request.php?op=reply&amp;request_id=<{$request.id}>" title="<{$smarty.const._AM_XMCONTACT_REPLY}>">
                        <img src="<{xoAdminIcons mail_reply.png}>" alt="<{$smarty.const._AM_XMCONTACT_REPLY}>"/>
                    </a>
                    <a class="tooltip" href="request.php?op=del&amp;request_id=<{$request.id}>" title="<{$smarty.const._AM_XMCONTACT_DEL}>">
                        <img src="<{xoAdminIcons delete.png}>" alt="<{$smarty.const._AM_XMCONTACT_DEL}>"/>
                    </a>
                </td>

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
