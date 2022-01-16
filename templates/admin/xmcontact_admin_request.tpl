<div class="xmcontact">
    <{$renderbutton|default:''}>
</div>
<{if $message_error|default:'' != ''}>
    <div class="errorMsg" style="text-align: left;">
        <{$message_error}>
    </div>
<{/if}>
<{if $message_sucess|default:'' != ''}>
    <div class="resultMsg" style="text-align: left;">
        <{$message_sucess}>
    </div>
<{/if}>
<div class="xmcontact">
    <{$form|default:false}>

<{if $filter|default:false}>
	<div align="right">
		<form id="form_request_tri" name="form_request_tri" method="get" action="request.php">
			<{if $request_cid_options|default:'' != ''}>
				<{$smarty.const._AM_XMCONTACT_INDEX_CAT}>
				<select name="request_filter" id="request_filter" onchange="location='request.php?request_status=<{$request_status}>&request_cid='+this.options[this.selectedIndex].value">
					<{$request_cid_options}>
				</select>
			<{/if}>
			<{$smarty.const._AM_XMCONTACT_STATUS}>
			<select name="request_filter" id="request_filter" onchange="location='request.php?request_cid=<{$request_cid}>&request_status='+this.options[this.selectedIndex].value">
				<{$request_status_options}>
			</select>
		</form>
	</div>
<{/if}>
<{if $request_count|default:0 != 0}>
    <table id="xo-xmcontact-sorter" cellspacing="1" class="outer tablesorter">
        <thead>
        <tr>
			<{if $simplecontact == 0}>
            <th class="txtleft width15"><{$smarty.const._AM_XMCONTACT_CATEGORY}></th>
			<{/if}>
            <th class="txtleft"><{$smarty.const._AM_XMCONTACT_REQUEST_SUBJECT}></th>
            <th class="txtcenter width10"><{$smarty.const._AM_XMCONTACT_REQUEST_DATES}></th>
            <th class="txtcenter width10"><{$smarty.const._AM_XMCONTACT_REQUEST_DATER}></th>
            <th class="txtcenter width15"><{$smarty.const._AM_XMCONTACT_STATUS}></th>
            <th class="txtcenter width10"><{$smarty.const._AM_XMCONTACT_ACTION}></th>
        </tr>
        </thead>
        <tbody>
        <{foreach item=request from=$request}>
            <tr class="<{cycle values='even,odd'}> alignmiddle">
				<{if $simplecontact == 0}>
                <td class="txtleft"><{$request.category}></td>
				<{/if}>
                <td class="txtleft"><{$request.subject}></td>
                <td class="txtcenter"><{$request.date_e}></td>
                <td class="txtcenter"><{$request.date_r}></td>
                <td class="xo-actions txtcenter">
                    <{$request.status}>
                    <a class="tooltip" href="request.php?op=edit&amp;request_id=<{$request.id}>" title="<{$smarty.const._AM_XMCONTACT_EDITSTATUS}>">
                        <img src="<{xoAdminIcons edit.png}>" alt="<{$smarty.const._AM_XMCONTACT_EDITSTATUS}>"/></a>
                </td>
                <td class="xo-actions txtcenter">
                    <a class="tooltip" href="request.php?op=view&amp;request_id=<{$request.id}>" title="<{$smarty.const._AM_XMCONTACT_VIEW}>">
                        <img src="<{xoAdminIcons view.png}>" alt="<{$smarty.const._AM_XMCONTACT_VIEW}>"/></a>
                    <a class="tooltip" href="request.php?op=reply&amp;request_id=<{$request.id}>" title="<{$smarty.const._AM_XMCONTACT_REPLY}>">
                        <img src="<{xoAdminIcons mail_reply.png}>" alt="<{$smarty.const._AM_XMCONTACT_REPLY}>"/></a>
                    <a class="tooltip" href="request.php?op=del&amp;request_id=<{$request.id}>" title="<{$smarty.const._AM_XMCONTACT_DEL}>">
                        <img src="<{xoAdminIcons delete.png}>" alt="<{$smarty.const._AM_XMCONTACT_DEL}>"/></a>
                </td>

            </tr>
        <{/foreach}>
        </tbody>
    </table>
    <div class="clear spacer"></div>
    <{if $nav_menu|default:false}>
        <div class="xo-avatar-pagenav floatright"><{$nav_menu}></div>
        <div class="clear spacer"></div>
    <{/if}>
<{/if}>
<{if $view|default:false}>
    <table id="xo-xmcontact-sorter" cellspacing="1" class="outer tablesorter">
        <thead>
        <tr>
            <th class="txtleft width20"><{$smarty.const._AM_XMCONTACT_REQUEST_TITLE}></th>
            <th class="txtleft"><{$smarty.const._AM_XMCONTACT_REQUEST_INFORMATION}></th>
        </tr>
        </thead>
        <tbody>
        <{foreach from=$request_arr key=title item=information}>
            <tr class="<{cycle values='even,odd'}> alignmiddle">
                <td class="txtleft"><{$title}></td>
                <td class="txtleft"><{$information}></td>
            </tr>
        <{/foreach}>
            <tr class="<{cycle values='even,odd'}> alignmiddle">
                <td><{$smarty.const._AM_XMCONTACT_ACTION}></td>
                <td class="xo-actions txtleft">
                    <a class="tooltip" href="request.php?op=reply&amp;request_id=<{$request_id}>" title="<{$smarty.const._AM_XMCONTACT_REPLY}>">
                        <img src="<{xoAdminIcons mail_reply.png}>" alt="<{$smarty.const._AM_XMCONTACT_REPLY}>"/></a>
                    <a class="tooltip" href="request.php?op=del&amp;request_id=<{$request_id}>" title="<{$smarty.const._AM_XMCONTACT_DEL}>">
                        <img src="<{xoAdminIcons delete.png}>" alt="<{$smarty.const._AM_XMCONTACT_DEL}>"/></a>
                </td>

            </tr>
        </tbody>
    </table>
<{/if}>
