<!-- action buttons -->
@include('misc.list-pages-actions')
<!-- action buttons -->

<!--stats panel-->
<div id="vendors-stats-wrapper" class="stats-wrapper card-embed-fix">
@if (@count($vendors) > 0 && auth()->user()->is_team) @include('misc.list-pages-stats') @endif
</div>
<!--stats panel-->

<!--vendors table-->
<div class="card-embed-fix">
@include('pages.vendor.components.table.wrapper')
</div>
<!--vendors table-->