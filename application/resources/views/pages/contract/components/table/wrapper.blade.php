<!--checkbox actions-->
@include('pages.contract.components.actions.checkbox-actions')

<!--main table view-->
@include('pages.contract.components.table.table')
<!--filter-->
@if(auth()->user()->is_team)
@include('pages.contract.components.misc.filter-properties')
@endif
<!--filter-->