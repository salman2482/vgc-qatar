<!--checkbox actions-->
@include('pages.service.components.actions.checkbox-actions')

<!--main table view-->
@include('pages.service.components.table.table')
<!--filter-->
@if (auth()->user()->is_team)
    @include('pages.service.components.misc.filter-properties')
@endif
<!--filter-->
