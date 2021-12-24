<!--checkbox actions-->
@include('pages.property.components.actions.checkbox-actions')

<!--main table view-->
@include('pages.property.components.table.table')
<!--filter-->
@if(auth()->user()->is_team)
@include('pages.property.components.misc.filter-properties')
@endif
<!--filter-->