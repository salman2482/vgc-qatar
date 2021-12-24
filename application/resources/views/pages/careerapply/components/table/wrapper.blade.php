<!--checkbox actions-->
@include('pages.careerapply.components.actions.checkbox-actions')

<!--main table view-->
@include('pages.careerapply.components.table.table')
<!--filter-->
@if(auth()->user()->is_team)
@include('pages.careerapply.components.misc.filter-careersapply')
@endif
<!--filter-->