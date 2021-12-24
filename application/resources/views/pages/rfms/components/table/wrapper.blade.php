<!--checkbox actions-->
@include('pages.rfms.components.actions.checkbox-actions')

<!--main table view-->
@include('pages.rfms.components.table.table')
<!--filter-->
@if(auth()->user()->is_team)
@include('pages.rfms.components.misc.filter-rfms')
@endif
<!--filter-->