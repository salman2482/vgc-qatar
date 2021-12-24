<!-- action buttons -->
@include('misc.list-pages-actions')
<!-- action buttons -->

<!--stats panel-->
<div id="lpos-stats-wrapper" class="stats-wrapper card-embed-fix">
@if (@count($lpos) > 0 && auth()->user()->is_team) @include('misc.list-pages-stats') @endif
</div>
<!--stats panel-->

<!--lpos table-->
<div class="card-embed-fix">
    
@include('pages.lpo.components.table.wrapper')
</div>
<!--lpos table-->