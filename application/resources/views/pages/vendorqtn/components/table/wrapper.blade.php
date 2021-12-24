<!--checkbox actions-->
@include('pages.vendorqtn.components.actions.checkbox-actions')

<!--main table view-->
@include('pages.vendorqtn.components.table.table')
<!--filter-->
@if(auth()->user()->is_team)
@include('pages.vendorqtn.components.misc.filter-properties')
@endif
<!--filter-->