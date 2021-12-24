<!--bulk actions-->
@include('pages.vusers.components.actions.checkbox-actions')

<!--main table view-->
@include('pages.vusers.components.table.table')

<!--filter-->
@if(auth()->user()->is_team)
@include('pages.vusers.components.misc.filter-vusers')
@endif
<!--filter-->