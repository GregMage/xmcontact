<{if $info_header}>
<div class="col-sm-12" style="padding-bottom: 30px; padding-top: 5px;">
    <{$info_header}>
</div>
<{/if}>

<{if $info_googlemaps && $info_addresse}>
    <div class="col-md-8 col-sm-12">
        <{$info_googlemaps}>
    </div>
    <div class="col-md-4 col-sm-12">
        <{$info_addresse}>
    </div>
<{else}>
    <{if $info_googlemaps}>
        <div class="col-sm-12" style="padding-bottom: 5px; padding-top: 5px;">
            <{$info_googlemaps}>
        </div>
    <{/if}>
    <{if $info_addresse}>
        <div class="col-sm-12" style="padding-bottom: 5px; padding-top: 5px;">
            <{$info_addresse}>
        </div>
    <{/if}>
<{/if}>

<{if $info_footer}>
    <div class="col-sm-12" style="padding-bottom: 5px; padding-top: 20px;">
        <{$info_footer}>
    </div>
<{/if}>