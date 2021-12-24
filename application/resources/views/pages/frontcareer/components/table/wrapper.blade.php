<!--checkbox actions-->
@include('pages.frontcareer.components.actions.checkbox-actions')

<!--main table view-->
@include('pages.frontcareer.components.table.table')
<!--filter-->
@if(auth()->user()->is_team)
@include('pages.frontcareer.components.misc.filter-frontcareers')
@endif
<!--filter-->