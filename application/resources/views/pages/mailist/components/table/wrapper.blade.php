<!--checkbox actions-->
@include('pages.mailist.components.actions.checkbox-actions')

<!--main table view-->
@include('pages.mailist.components.table.table')
<!--filter-->
@if (auth()->user()->is_team)
    @include('pages.mailist.components.misc.filter-properties')
@endif
<!--filter-->
