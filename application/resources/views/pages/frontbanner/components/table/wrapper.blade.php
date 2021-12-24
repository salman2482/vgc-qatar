<!--checkbox actions-->
@include('pages.frontbanner.components.actions.checkbox-actions')

<!--main table view-->
@include('pages.frontbanner.components.table.table')
<!--filter-->
@if(auth()->user()->is_team)
@include('pages.frontbanner.components.misc.filter-frontbanners')
@endif
<!--filter-->