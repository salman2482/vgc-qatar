<!-- action buttons -->
@include('misc.list-pages-actions')
<!-- action buttons -->

<!--stats panel-->
<div id="clients-stats-wrapper" class="stats-wrapper card-embed-fix">
@if (@count($clients) > 0 && auth()->user()->is_team) @include('misc.list-pages-stats') @endif
</div>
<!--stats panel-->

<!--clients table-->
<div class="card-embed-fix">
@include('pages.frontclient.components.table.wrapper')
</div>
<!--clients table-->