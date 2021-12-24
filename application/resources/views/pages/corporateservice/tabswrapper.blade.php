<!-- action buttons -->
@include('misc.list-pages-actions')
<!-- action buttons -->

<!--stats panel-->
<div id="corporateservices-stats-wrapper" class="stats-wrapper card-embed-fix">
@if (@count($corporateservices) > 0 && auth()->user()->is_team) @include('misc.list-pages-stats') @endif
</div>
<!--stats panel-->

<!--corporateservices table-->
<div class="card-embed-fix">
@include('pages.corporateservice.components.table.wrapper')
</div>
<!--corporateservices table-->