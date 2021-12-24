<!-- action buttons -->
@include('misc.list-pages-actions')
<!-- action buttons -->

<!--stats panel-->
<div id="rfms-stats-wrapper" class="stats-wrapper card-embed-fix">
@if (@count($rfms) > 0 && auth()->user()->is_team) @include('misc.list-pages-stats') @endif
</div>
<!--stats panel-->

<!--rfms table-->
<div class="card-embed-fix">
@include('pages.rfms.components.table.wrapper')
</div>
<!--rfms table-->