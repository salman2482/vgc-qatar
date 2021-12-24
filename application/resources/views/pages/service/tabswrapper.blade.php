<!-- action buttons -->
@include('misc.list-pages-actions')
<!-- action buttons -->

<!--stats panel-->
<div id="services-stats-wrapper" class="stats-wrapper card-embed-fix">
    @if (@count($services) > 0 && auth()->user()->is_team)
        @include('misc.list-pages-stats') @endif
</div>
<!--stats panel-->

<!--services table-->
<div class="card-embed-fix">

    @include('pages.service.components.table.wrapper')
</div>
<!--services table-->
