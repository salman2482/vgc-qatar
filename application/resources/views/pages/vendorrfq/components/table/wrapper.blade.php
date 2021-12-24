<!--checkbox actions-->
@include('pages.vendorrfq.components.actions.checkbox-actions')

<!--main table view-->
@include('pages.vendorrfq.components.table.table')
<!--filter-->
@if(auth()->user()->is_team)
@include('pages.vendorrfq.components.misc.filter-properties')
@endif
<!--filter-->