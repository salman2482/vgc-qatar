<!--checkbox actions-->
@include('pages.vendorinvoice.components.actions.checkbox-actions')

<!--main table view-->
@include('pages.vendorinvoice.components.table.table')
<!--filter-->
@if(auth()->user()->is_team)
@include('pages.vendorinvoice.components.misc.filter-properties')
@endif
<!--filter-->