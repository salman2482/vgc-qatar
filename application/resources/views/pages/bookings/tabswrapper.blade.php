<!-- action buttons -->
@include('misc.list-pages-actions')
<!-- action buttons -->

<!--stats panel-->
<div id="documents-stats-wrapper" class="stats-wrapper card-embed-fix">
    @if (@count($bookings) > 0 && auth()->user()->is_team)
        @include('misc.list-pages-stats') @endif
</div>
<!--stats panel-->

<!--document table-->
<div class="card-embed-fix">
    @include('pages.bookings.components.table.wrapper')
</div>
<!--document table-->
