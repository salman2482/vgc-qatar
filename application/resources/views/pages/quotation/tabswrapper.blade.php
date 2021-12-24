<!-- action buttons -->
@include('misc.list-pages-actions')
<!-- action buttons -->

<!--stats panel-->
<div id="quotations-stats-wrapper" class="stats-wrapper card-embed-fix">
@if (@count($quotations) > 0 && auth()->user()->is_team) @include('misc.list-pages-stats') @endif
</div>
<!--stats panel-->

<!--quotations table-->
<div class="card-embed-fix">
    
@include('pages.quotation.components.table.wrapper')
</div>
<!--quotations table-->