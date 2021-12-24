<!-- action buttons -->
@include('misc.list-pages-actions')
<!-- action buttons -->

<!--stats panel-->
<div id="banners-stats-wrapper" class="stats-wrapper card-embed-fix">
@if (@count($banners) > 0 && auth()->user()->is_team) @include('misc.list-pages-stats') @endif
</div>
<!--stats panel-->

<!--frontbanner table-->
<div class="card-embed-fix">
@include('pages.frontbanner.components.table.wrapper')
</div>
<!--frontbanner table-->