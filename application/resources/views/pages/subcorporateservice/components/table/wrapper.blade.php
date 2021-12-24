<!--checkbox actions-->
@include('pages.subcorporateservice.components.actions.checkbox-actions')

<!--main table view-->
@include('pages.subcorporateservice.components.table.table')
<!--filter-->
@if(auth()->user()->is_team)
@include('pages.subcorporateservice.components.misc.filter-subcorporateservices')
@endif
<!--filter-->