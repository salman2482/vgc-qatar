<!--checkbox actions-->
@include('pages.bookings.components.actions.checkbox-actions')

<!--main table view-->
@include('pages.bookings.components.table.table')
<!--filter-->
@if (auth()->user()->is_team)
    @include('pages.bookings.components.misc.filter-properties')
@endif
<!--filter-->
