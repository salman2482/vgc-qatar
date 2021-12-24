<!--checkbox actions-->
@include('pages.document.components.actions.checkbox-actions')

<!--main table view-->
@include('pages.document.components.table.table')
<!--filter-->
@if(auth()->user()->is_team)
@include('pages.document.components.misc.filter-properties')
@endif
<!--filter-->