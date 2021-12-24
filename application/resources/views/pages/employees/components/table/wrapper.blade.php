<!--bulk actions-->
@include('pages.employees.components.actions.checkbox-actions')

<!--main table view-->
@include('pages.employees.components.table.table')

<!--filter-->
@if (auth()->user()->is_team)
    @include('pages.employees.components.misc.filter-contacts')
@endif
<!--filter-->
