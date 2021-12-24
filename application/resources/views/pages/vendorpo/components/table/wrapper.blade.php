<!--checkbox actions-->
@include('pages.vendorpo.components.actions.checkbox-actions')

<!--main table view-->
@include('pages.vendorpo.components.table.table')
<!--filter-->
@if(auth()->user()->is_team)
@include('pages.vendorpo.components.misc.filter-properties')
@endif
<!--filter-->