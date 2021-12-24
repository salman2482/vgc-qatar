<!-- action buttons -->
@include('misc.list-pages-actions')
<!-- action buttons -->

<!--stats panel-->
<div id="subproducts-stats-wrapper" class="stats-wrapper card-embed-fix">
@if (@count($subproducts) > 0 && auth()->user()->is_team) @include('misc.list-pages-stats') @endif
</div>
<!--stats panel-->

<!--subproducts table-->
<div class="card-embed-fix">
@include('pages.subproduct.components.table.wrapper')
</div>
<!--subproducts table-->