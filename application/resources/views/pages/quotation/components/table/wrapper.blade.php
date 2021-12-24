<!--checkbox actions-->
@include('pages.quotation.components.actions.checkbox-actions')

<!--main table view-->
@include('pages.quotation.components.table.table')
<!--filter-->
@if(auth()->user()->is_team)
@include('pages.quotation.components.misc.filter-properties')
@endif
<!--filter-->