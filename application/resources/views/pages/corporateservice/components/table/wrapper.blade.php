<!--checkbox actions-->
@include('pages.corporateservice.components.actions.checkbox-actions')

<!--main table view-->
@include('pages.corporateservice.components.table.table')
<!--filter-->
@if(auth()->user()->is_team)
@include('pages.corporateservice.components.misc.filter-corporateservices')
@endif
<!--filter-->