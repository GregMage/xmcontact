<{if $info_header}>
<div class="row">
    <div class="col-sm-12" style="padding-bottom: 10px; padding-top: 5px;">
        <{$info_header}>
    </div>
</div>
<{/if}>

<{if $info_googlemaps && $info_addresse}>
    <div class="row" style="padding-bottom: 5px; padding-top: 5px;">
        <div class="col-md-8 col-sm-12">
            <{$info_googlemaps}>
        </div>
        <div class="col-md-4 col-sm-12">
            <{$info_addresse}>
        </div>
    </div>
<{else}>
    <{if $info_googlemaps}>
        <div class="row" style="padding-bottom: 5px; padding-top: 5px;">
            <div class="col-sm-12">
                <{$info_googlemaps}>
            </div>
        </div>
    <{/if}>
    <{if $info_addresse}>
        <div class="row" style="padding-bottom: 5px; padding-top: 5px;">
            <div class="col-sm-12">
                <{$info_addresse}>
            </div>
        </div>
    <{/if}>
<{/if}>
<{if $category_count > 20}>
    <{foreach item=category from=$category}>
    <div class="row" style="padding-bottom: 5px; padding-top: 5px;">
        <div class="col-sm-2" style="height: 152px; text-align: center; border: 1px solid #6699FF">
            <img src="<{$category.logo}>" title="<{$category.title}>" class="img-rounded" style="max-height: 150px;">
        </div>
        <{if $info_columncat == 1}>
        <div class="col-sm-10" style="border: 1px solid #6699FF">
        <{/if}>
        <{if $info_columncat == 2}>
        <div class="col-sm-4" style="border: 1px solid #6699FF">
        <{/if}>
        <{if $info_columncat == 3}>
        <div class="col-sm-2" style="border: 1px solid #6699FF">
        <{/if}>
            <h4><{$category.title}></h4>
            <{$category.description}>
            <p style="padding-top: 15px;">
                <a href="form.php?cat_id=<{$category.id}>"><button type="button" class="btn btn-info btn-xs"><{$smarty.const._MD_XMCONTACT_INDEX_CONTACT}></button></a>
            </p>
        </div>
        <{if $info_columncat == 2 || $info_columncat == 3}>
        <div class="col-sm-2" style="height: 152px; text-align: center; border: 1px solid #6699FF">
            <img src="<{$category.logo}>" title="<{$category.title}>" class="img-rounded" style="max-height: 150px;">
        </div>
        <{if $info_columncat == 2}>
        <div class="col-sm-4" style="border: 1px solid #6699FF">
        <{/if}>
        <{if $info_columncat == 3}>
        <div class="col-sm-2" style="border: 1px solid #6699FF">
        <{/if}>
            <h4><{$category.title}></h4>
            <{$category.description}>
            <p style="padding-top: 15px;">
                <a href="form.php?cat_id=<{$category.id}>"><button type="button" class="btn btn-info btn-xs"><{$smarty.const._MD_XMCONTACT_INDEX_CONTACT}></button></a>
            </p>
        </div>
        <{if $info_columncat == 3}>
        <div class="col-sm-2" style="height: 152px; text-align: center; border: 1px solid #6699FF">
            <img src="<{$category.logo}>" title="<{$category.title}>" class="img-rounded" style="max-height: 150px;">
        </div>
        <div class="col-sm-2" style="border: 1px solid #6699FF">
            <h4><{$category.title}></h4>
            <{$category.description}>
            <p style="padding-top: 15px;">
                <a href="form.php?cat_id=<{$category.id}>"><button type="button" class="btn btn-info btn-xs"><{$smarty.const._MD_XMCONTACT_INDEX_CONTACT}></button></a>
            </p>
        </div>
        <{/if}>
        <{/if}>
    </div>
    <{/foreach}>
<{/if}>

<{if $category_count != 0}>
    <{foreach item=category from=$category}>
    <{if $info_columncat == 1}>
        <div class="row" style="padding-bottom: 5px; padding-top: 5px;">
            <div class="col-sm-2" style="height: 152px; text-align: center; border: 1px solid #6699FF">
                <img src="<{$category.logo}>" title="<{$category.title}>" class="img-rounded" style="max-height: 150px;">
            </div>
            <div class="col-sm-10" style="border: 1px solid #6699FF">
                <h4><{$category.title}></h4>
                <{$category.description}>
                <p style="padding-top: 15px;">
                    <a href="form.php?cat_id=<{$category.id}>"><button type="button" class="btn btn-info btn-xs"><{$smarty.const._MD_XMCONTACT_INDEX_CONTACT}></button></a>
                </p>
            </div>
        </div>
    <{/if}>
    <{if $info_columncat == 2}>
        <{if $category.row == true}>
        <div class="row" style="margin-top: 5px;">
        <{/if}>
            <div class="col-md-2 col-sm-12" style="height: 152px; text-align: center; border: 1px solid #6699FF">
                <img src="<{$category.logo}>" title="<{$category.title}>" class="img-rounded" style="max-height: 150px;">
            </div>
            <div class="col-md-4 col-sm-12" style="border: 1px solid #6699FF">
                <h4><{$category.title}></h4>
                <{$category.description}>
                <p style="padding-top: 15px;">
                    <a href="form.php?cat_id=<{$category.id}>"><button type="button" class="btn btn-info btn-xs"><{$smarty.const._MD_XMCONTACT_INDEX_CONTACT}></button></a>
                </p>
            </div>
        <{if $category.count is div by $info_columncat}>
        </div>
        <{/if}>
    <{/if}>
    <{if $info_columncat == 3}>
        <{if $category.row == true}>
        <div class="row" style="margin-top: 5px;">
        <{/if}>
            <div class="col-md-2 col-sm-12" style="height: 152px; text-align: center; border: 1px solid #6699FF">
                <img src="<{$category.logo}>" title="<{$category.title}>" class="img-rounded" style="max-height: 150px;">
            </div>
            <div class="col-md-2 col-sm-12" style="border: 1px solid #6699FF">
                <h4><{$category.title}></h4>
                <{$category.description}> <{$category.count}>
                <p style="padding-top: 15px;">
                    <a href="form.php?cat_id=<{$category.id}>"><button type="button" class="btn btn-info btn-xs"><{$smarty.const._MD_XMCONTACT_INDEX_CONTACT}></button></a>
                </p>
            </div>
        <{if $category.count is div by $info_columncat}>
        </div>
        <{/if}>
    <{/if}>
    <{/foreach}>
<{/if}>

<{if $info_footer}>
    <div class="row" style="padding-bottom: 5px; padding-top: 5px;">
        <div class="col-sm-12">
            <{$info_footer}>
        </div>
    </div>
<{/if}>