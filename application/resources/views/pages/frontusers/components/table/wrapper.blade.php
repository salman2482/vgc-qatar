<!--bulk actions-->
@include('pages.frontusers.components.actions.checkbox-actions')

<!--main table view-->
@include('pages.frontusers.components.table.table')

<!--filter-->
@if (auth()->user()->is_team)
    @include('pages.frontusers.components.misc.filter-vusers')
@endif
<!--filter-->
