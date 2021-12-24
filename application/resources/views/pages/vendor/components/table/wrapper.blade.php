<!--checkbox actions-->
@include('pages.vendor.components.actions.checkbox-actions')

<!--main table view-->
@include('pages.vendor.components.table.table')
<!--filter-->
@if(auth()->user()->is_team)
@include('pages.vendor.components.misc.filter-properties')
@endif
<!--filter-->