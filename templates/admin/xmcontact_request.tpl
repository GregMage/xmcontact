<script type="text/javascript">
    IMG_ON = '<{xoAdminIcons success.png}>';
    IMG_OFF = '<{xoAdminIcons cancel.png}>';
</script>
<div class="xmcontact">
    <{$navigation}>
</div>
<table id="xo-xmcontact-sorter" cellspacing="1" class="outer tablesorter">
    <thead>
    <tr>
        <th class="txtcenter width5"><{$smarty.const._AM_XMCONTACT_REQUEST_NUMBER}></th>
        <th class="txtleft width15"><{$smarty.const._AM_XMCONTACT_CATEGORY}></th>
        <th class="txtcleft"><{$smarty.const._AM_XMCONTACT_REQUEST_SUBJECT}></th>
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
            <td class="txtcenter"><{$request.category}></td>
            <td class="txtcenter"><{$request.id}></td>
            <td class="txtcenter"><{$request.name}></td>
            <td class="txtcenter"><{$request.id}></td>
            <td class="txtcenter"><{$request.id}></td>
            <td class="txtcenter"><{$request.id}></td>
            <td class="txtcenter"><{$request.id}></td>

        </tr>
    <{/foreach}>
    </tbody>
</table>
