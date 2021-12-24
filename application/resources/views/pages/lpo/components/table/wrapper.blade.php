<!--checkbox actions-->
@include('pages.lpo.components.actions.checkbox-actions')

<!--main table view-->
@include('pages.lpo.components.table.table')
<!--filter-->
@if(auth()->user()->is_team)
@include('pages.lpo.components.misc.filter-properties')
@endif
<!--filter-->