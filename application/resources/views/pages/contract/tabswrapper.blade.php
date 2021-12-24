<!-- action buttons -->
@include('misc.list-pages-actions')
<!-- action buttons -->

<!--stats panel-->
<div id="contracts-stats-wrapper" class="stats-wrapper card-embed-fix">
@if (@count($contracts) > 0 && auth()->user()->is_team) @include('misc.list-pages-stats') @endif
</div>
<!--stats panel-->

<!--contracts table-->
<div class="card-embed-fix">
    
@include('pages.contract.components.table.wrapper')
</div>
<!--contracts table-->