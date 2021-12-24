<!--checkbox actions-->
@include('pages.material.components.actions.checkbox-actions')

<!--main table view-->
@include('pages.material.components.table.table')
<!--filter-->
{{-- @if(auth()->user()->is_team) --}}
@include('pages.material.components.misc.filter-materials')
{{-- @endif --}}
<!--filter-->