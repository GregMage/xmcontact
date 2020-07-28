<{if $block.category_count != 0}>
<{foreach item=category from=$block.category}>
	<{if $block.display == "V"}>
		<div class="row" style="padding-bottom: 5px; padding-top: 5px;">
			<{if $block.show_logo == True}>
			<div class="col-sm-2" style="height: 152px; text-align: center;">
				<img src="<{$category.logo}>" title="<{$category.title}>" class="img-rounded" style="max-height: 100px;">
			</div>
			<{/if}>
			<div class="col-sm-10">
				<h4><{$category.title}></h4>
				<{if $block.show_description == True}>
				<{$category.description}>
				<{/if}>
				<p style="padding-top: 15px;">
					<a href="<{$xoops_url}>/modules/xmcontact/index.php?op=form&cat_id=<{$category.id}>"><button type="button" class="btn btn-primary btn-xs"><{$smarty.const._MB_XMCONTACT_CONTACT}></button></a>
				</p>
			</div>
		</div>
	<{/if}>
	<{if $block.display == "H"}>
		<{if $block.nb_column == 2}>
			<{if $category.row == true}>
			<div class="row" style="margin-top: 5px;">
			<{/if}>
				<{if $block.show_logo == True}>
				<div class="col-md-2 col-sm-12" style="height: 152px; text-align: center;">
					<img src="<{$category.logo}>" title="<{$category.title}>" class="img-rounded" style="max-height: 100px;">
				</div>
				<{/if}>
				<div class="col-md-4 col-sm-12">
					<h4><{$category.title}></h4>
					<{if $block.show_description == True}>
					<{$category.description}>
					<{/if}>
					<p style="padding-top: 15px;">
						<a href="<{$xoops_url}>/modules/xmcontact/index.php?op=form&cat_id=<{$category.id}>"><button type="button" class="btn btn-primary btn-xs"><{$smarty.const._MB_XMCONTACT_CONTACT}></button></a>
					</p>
				</div>
			<{if $category.count is div by $block.nb_column || $category.end == true}>
			</div>
			<{/if}>
		<{/if}>
		<{if $block.nb_column == 3}>
			<{if $category.row == true}>
			<div class="row" style="margin-top: 5px;">
			<{/if}>
				<{if $block.show_logo == True}>
				<div class="col-md-2 col-sm-12" style="height: 152px; text-align: center;">
					<img src="<{$category.logo}>" title="<{$category.title}>" class="img-rounded" style="max-height: 100px;">
				</div>
				<{/if}>
				<div class="col-md-2 col-sm-12">
					<h4><{$category.title}></h4>
					<{if $block.show_description == True}>
					<{$category.description}>
					<{/if}>
					<p style="padding-top: 15px;">
						<a href="<{$xoops_url}>/modules/xmcontact/index.php?op=form&cat_id=<{$category.id}>"><button type="button" class="btn btn-primary btn-xs"><{$smarty.const._MB_XMCONTACT_CONTACT}></button></a>
					</p>
				</div>
			<{if $category.count is div by $block.nb_column || $category.end == true}>
			</div>
			<{/if}>	
		<{/if}>
	<{/if}>
<{/foreach}>
<{/if}>
<{if $block.simple_contact}>
	<p style="padding-top: 15px;">
		<a href="<{$xoops_url}>/modules/xmcontact/index.php?op=form"><button type="button" class="btn btn-primary btn-xs"><{$smarty.const._MB_XMCONTACT_CONTACT}></button></a>
	</p>
<{/if}>