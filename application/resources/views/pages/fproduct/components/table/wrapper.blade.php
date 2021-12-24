<!--checkbox actions-->
@include('pages.fproduct.components.actions.checkbox-actions')

<!--main table view-->
@include('pages.fproduct.components.table.table')
<!--filter-->
@if(auth()->user()->is_team)
@include('pages.fproduct.components.misc.filter-fproducts')
@endif
<!--filter-->