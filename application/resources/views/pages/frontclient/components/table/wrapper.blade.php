<!--checkbox actions-->
@include('pages.frontclient.components.actions.checkbox-actions')

<!--main table view-->
@include('pages.frontclient.components.table.table')
<!--filter-->
@if(auth()->user()->is_team)
@include('pages.frontclient.components.misc.filter-frontclients')
@endif
<!--filter-->