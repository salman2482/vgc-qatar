<!-- action buttons -->
@include('misc.list-pages-actions')
<!-- action buttons -->

<!--stats panel-->
<div id="subcorporateservices-stats-wrapper" class="stats-wrapper card-embed-fix">
@if (@count($subcorporateservices) > 0 && auth()->user()->is_team) @include('misc.list-pages-stats') @endif
</div>
<!--stats panel-->

<!--subcorporateservices table-->
<div class="card-embed-fix">
@include('pages.subcorporateservice.components.table.wrapper')
</div>
<!--subcorporateservices table-->