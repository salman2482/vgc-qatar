<!--checkbox actions-->
@include('pages.subproduct.components.actions.checkbox-actions')

<!--main table view-->
@include('pages.subproduct.components.table.table')
<!--filter-->
@if(auth()->user()->is_team)
@include('pages.subproduct.components.misc.filter-subproducts')
@endif
<!--filter-->