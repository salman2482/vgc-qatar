<!-- action buttons -->
@include('misc.list-pages-actions')
<!-- action buttons -->

<!--stats panel-->
@if(auth()->user()->is_team)
<div id="vusers-stats-wrapper" class="stats-wrapper card-embed-fix">
@if (@count($vusers) > 0) @include('misc.list-pages-stats') @endif
</div>
@endif
<!--stats panel-->

<!--vusers table-->
<div class="card-embed-fix">
@include('pages.frontusers.components.table.wrapper')
</div>
<!--vusers table-->