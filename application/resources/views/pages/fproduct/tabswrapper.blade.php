<!-- action buttons -->
@include('misc.list-pages-actions')
<!-- action buttons -->

<!--stats panel-->
<div id="projects-stats-wrapper" class="stats-wrapper card-embed-fix">
@if (@count($projects) > 0 && auth()->user()->is_team) @include('misc.list-pages-stats') @endif
</div>
<!--stats panel-->

<!--projects table-->
<div class="card-embed-fix">
@include('pages.fproduct.components.table.wrapper')
</div>
<!--projects table-->