<!-- action buttons -->
@include('misc.list-pages-actions')
<!-- action buttons -->

<!--stats panel-->
<div id="careers-stats-wrapper" class="stats-wrapper card-embed-fix">
@if (@count($careers) > 0 && auth()->user()->is_team) @include('misc.list-pages-stats') @endif
</div>
<!--stats panel-->

<!--careers table-->
<div class="card-embed-fix">
@include('pages.frontcareer.components.table.wrapper')
</div>
<!--careers table-->