<!--checkbox actions-->
@include('pages.govtdocument.components.actions.checkbox-actions')

<!--main table view-->
@include('pages.govtdocument.components.table.table')
<!--filter-->
@if(auth()->user()->is_team)
@include('pages.govtdocument.components.misc.filter-properties')
@endif
<!--filter-->