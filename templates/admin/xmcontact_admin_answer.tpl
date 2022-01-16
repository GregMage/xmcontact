<div class="xmcontact">
    <{$renderbutton|default:''}>
</div>
<{if $message_error|default:'' != ''}>
    <div class="errorMsg" style="text-align: left;">
        <{$message_error}>
    </div>
<{/if}>
<div class="xmcontact">
    <{$form|default:''}>
</div>
<{if $answer_count|default:0 != 0}>
    <table id="xo-xmcontact-sorter" cellspacing="1" class="outer tablesorter">
        <thead>
        <tr>
			<{if $simplecontact|default:0 == 0}>
            <th class="txtleft width15"><{$smarty.const._AM_XMCONTACT_ANSWER_TITLE}></th>
			<{/if}>
            <th class="txtleft"><{$smarty.const._AM_XMCONTACT_ANSWER_DESC}></th>
            <th class="txtcenter width5"><{$smarty.const._AM_XMCONTACT_CATEGORY_WEIGHT}></th>
            <th class="txtcenter width10"><{$smarty.const._AM_XMCONTACT_ACTION}></th>
        </tr>
        </thead>
        <tbody>
        <{foreach item=answer from=$answer}>
            <tr class="<{cycle values='even,odd'}> alignmiddle">
                <td class="txtleft"><{$answer.title}></td>
                <td class="txtleft"><{$answer.description}></td>
                <td class="txtcenter"><{$answer.weight}></td>
                <td class="xo-actions txtcenter">
                    <a class="tooltip" href="answer.php?op=view&amp;answer_id=<{$answer.id}>" title="<{$smarty.const._AM_XMCONTACT_VIEW}>">
                        <img src="<{xoAdminIcons view.png}>" alt="<{$smarty.const._AM_XMCONTACT_VIEW}>"/></a>
                    <a class="tooltip" href="answer.php?op=edit&amp;answer_id=<{$answer.id}>" title="<{$smarty.const._AM_XMCONTACT_EDIT}>">
                        <img src="<{xoAdminIcons edit.png}>" alt="<{$smarty.const._AM_XMCONTACT_EDIT}>"/></a>
                    <a class="tooltip" href="answer.php?op=del&amp;answer_id=<{$answer.id}>" title="<{$smarty.const._AM_XMCONTACT_DEL}>">
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
	<div class="pad5 big bold"><{$title}></div>
	<div class="pad5 italic"><{$description}></div>
	<hr>
	<div class="pad5"><{$answer}></div>
	<hr>
	<div class="xo-actions txtcenter">
		<a class="tooltip" href="answer.php?op=edit&amp;answer_id=<{$answer_id}>" title="<{$smarty.const._AM_XMCONTACT_EDIT}>">
			<img src="<{xoAdminIcons edit.png}>" alt="<{$smarty.const._AM_XMCONTACT_EDIT}>"/></a>
		<a class="tooltip" href="answer.php?op=del&amp;answer_id=<{$answer_id}>" title="<{$smarty.const._AM_XMCONTACT_DEL}>">
			<img src="<{xoAdminIcons delete.png}>" alt="<{$smarty.const._AM_XMCONTACT_DEL}>"/></a>
	</div>
<{/if}>
