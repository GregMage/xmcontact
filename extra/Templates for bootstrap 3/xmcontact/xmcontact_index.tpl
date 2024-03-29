<{if $form|default:false}>
	<ol class="breadcrumb">
		<li><a href="index.php"><{$index_module}></a></li>
		<{if $cat_id ==0}>
			<li class="active"><{$smarty.const._MD_XMCONTACT_INDEX_FORM}></li>
		<{else}>
			<li class="active"><{$category_title}></li>
		<{/if}>
	</ol>
	<{if $error|default:false}>
	<div class="alert alert-danger" role="alert">
		<{$error}>
	</div>
	<{/if}>
	<{if $cat_id !=0}>
	<div class="row" style="padding-bottom: 5px; padding-top: 5px;">
		<div class="col-sm-2" style="height: 152px; text-align: center;">
			<img src="<{$category_logo}>" title="<{$category_title}>" class="img-rounded" style="max-height: 100px;">
		</div>
		<div class="col-sm-10">
			<h4><{$category_title}></h4>
			<{$category_description}>
		</div>
	</div>
	<{/if}>
	<{include file="db:xmcontact_form.tpl"}>
<{else}>
	<{if $confirm|default:false}>
	    <ol class="breadcrumb">
			<li><a href="index.php"><{$index_module}></a></li>
			<li class="active"><{$smarty.const._MD_XMCONTACT_INDEX_CONFIRM}></li>
		 </ol>
		<div class="alert alert-success" role="alert">
			<{$smarty.const._MD_XMCONTACT_CONFIRM_SEND}>
		</div>
		<table class="table table-striped">
			<tr>
				<th class="txtleft width40"><{$smarty.const._AM_XMCONTACT_REQUEST_TITLE}></th>
				<th class="txtleft"><{$smarty.const._AM_XMCONTACT_REQUEST_INFORMATION}></th>
			</tr>
			<{foreach from=$request_arr key=title item=information}>
				<tr>
					<td class="txtleft"><{$title}></td>
					<td class="txtleft"><{$information}></td>
				</tr>
			<{/foreach}>
		</table>
	<{else}>
		<ol class="breadcrumb">
			<li class="breadcrumb-item active"><{$index_module}></li>
		</ol>
	<{/if}>
	<{if $error|default:false}>
	<div class="alert alert-danger" role="alert">
		<{$error}>
	</div>
	<{/if}>
<{/if}>

<{if $info_header|default:'' != ''}>
<div class="row">
    <div class="col-sm-12" style="padding-bottom: 10px; padding-top: 5px;">
        <{$info_header}>
    </div>
</div>
<{/if}>

<{if $info_googlemaps|default:'' != '' && $info_addresse|default:'' != ''}>
    <div class="row" style="padding-bottom: 5px; padding-top: 5px;">
        <div class="col-md-8 col-sm-12">
            <{$info_googlemaps}>
        </div>
        <div class="col-md-4 col-sm-12">
            <{$info_addresse}>
        </div>
    </div>
<{else}>
    <{if $info_googlemaps|default:'' != ''}>
        <div class="row" style="padding-bottom: 5px; padding-top: 5px;">
            <div class="col-sm-12">
                <{$info_googlemaps}>
            </div>
        </div>
    <{/if}>
    <{if $info_addresse|default:'' != ''}>
        <div class="row" style="padding-bottom: 5px; padding-top: 5px;">
            <div class="col-sm-12">
                <{$info_addresse}>
            </div>
        </div>
    <{/if}>
<{/if}>
<{if $category_count|default:0 != 0}>
    <{foreach item=itemcategory from=$category}>
    <{if $info_columncat == 1}>
        <div class="row" style="padding-bottom: 5px; padding-top: 5px;">
            <div class="col-sm-2" style="height: 152px; text-align: center;">
                <img src="<{$itemcategory.logo}>" title="<{$itemcategory.title}>" class="img-rounded" style="max-height: 100px;">
            </div>
            <div class="col-sm-10">
                <h4><{$itemcategory.title}></h4>
                <{$itemcategory.description}>
                <p style="padding-top: 15px;">
                    <a href="index.php?op=form&cat_id=<{$itemcategory.id}>"><button type="button" class="btn btn-primary btn-xs"><{$smarty.const._MD_XMCONTACT_INDEX_CONTACT}></button></a>
                </p>
            </div>
        </div>
    <{/if}>
    <{if $info_columncat == 2}>
        <{if $itemcategory.row == true}>
        <div class="row" style="margin-top: 5px;">
        <{/if}>
            <div class="col-md-2 col-sm-12" style="height: 152px; text-align: center;">
                <img src="<{$itemcategory.logo}>" title="<{$itemcategory.title}>" class="img-rounded" style="max-height: 100px;">
            </div>
            <div class="col-md-4 col-sm-12">
                <h4><{$itemcategory.title}></h4>
                <{$itemcategory.description}>
                <p style="padding-top: 15px;">
                    <a href="index.php?op=form&cat_id=<{$itemcategory.id}>"><button type="button" class="btn btn-primary btn-xs"><{$smarty.const._MD_XMCONTACT_INDEX_CONTACT}></button></a>
                </p>
            </div>
        <{if $itemcategory.count is div by $info_columncat || $itemcategory.end == true}>
        </div>
        <{/if}>
    <{/if}>
    <{if $info_columncat == 3}>
        <{if $itemcategory.row == true}>
        <div class="row" style="margin-top: 5px;">
        <{/if}>
            <div class="col-md-2 col-sm-12" style="height: 152px; text-align: center;">
                <img src="<{$itemcategory.logo}>" title="<{$itemcategory.title}>" class="img-rounded" style="max-height: 100px;">
            </div>
            <div class="col-md-2 col-sm-12">
                <h4><{$itemcategory.title}></h4>
                <{$itemcategory.description}>
                <p style="padding-top: 15px;">
                    <a href="index.php?op=form&cat_id=<{$itemcategory.id}>"><button type="button" class="btn btn-primary btn-xs"><{$smarty.const._MD_XMCONTACT_INDEX_CONTACT}></button></a>
                </p>
            </div>
        <{if $itemcategory.count is div by $info_columncat || $itemcategory.end == true}>
        </div>
        <{/if}>
    <{/if}>
    <{/foreach}>
<{/if}>
<{if $simple_contact|default:false}>
    <div class="row" style="padding-bottom: 5px; padding-top: 5px;">
		<{include file="db:xmcontact_form.tpl"}>
    </div>
<{/if}>

<{if $info_footer|default:'' != ''}>
    <div class="row" style="padding-bottom: 5px; padding-top: 5px;">
        <div class="col-sm-12">
            <{$info_footer}>
        </div>
    </div>
<{/if}>