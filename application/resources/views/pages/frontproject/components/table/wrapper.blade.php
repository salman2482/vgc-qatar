<!--checkbox actions-->
@include('pages.frontproject.components.actions.checkbox-actions')

<!--main table view-->
@include('pages.frontproject.components.table.table')
<!--filter-->
@if(auth()->user()->is_team)
@include('pages.frontproject.components.misc.filter-frontprojects')
@endif
<!--filter-->