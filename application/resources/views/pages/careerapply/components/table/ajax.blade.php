@foreach($careersapply as $careerapply)
{{-- @dd(config('visibility.action_buttons_delete')) --}}
<tr id="careerapply_{{ $careerapply->id }}">
    <td class="careersapply_col_id">
        {{ $careerapply->id }}
    </td>
    <td class="careersapply_col_type">
        {{ $careerapply->type }}
    </td>
    <td class="careersapply_col_field">
        {{ str_limit($careerapply->field, 20) }}
    </td>
    <td class="careersapply_col_first_name">
        {{ str_limit($careerapply->first_name.' '.$careerapply->last_name, 20) }}
    </td>
    <td class="careersapply_col_primary_email	">
        {{ str_limit($careerapply->primary_email	, 20) }}
    </td>
    <td class="careersapply_col_mobile	">
        {{ str_limit($careerapply->mobile	, 20) }}
    </td>
    <td class="careersapply_col_education	">
        {{ str_limit($careerapply->education	, 20) }}
    </td>
    <td class="careersapply_col_nationality	">
        {{ str_limit($careerapply->nationality	, 20) }}
    </td>

    <td class="careersapply_col_action actions_column">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">
          {{-- delete --}}
            <button type="button" title="{{ cleanLang(__('lang.delete')) }}"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}" data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}"
                data-ajax-type="DELETE" data-url="{{ url('/') }}/careersapply/{{ $careerapply->id }}">
                <i class="sl-icon-trash"></i>
            </button>
            
            <!--[edit]-->
            <a href="{{route('careersapply.show', $careerapply->id)}}" class="btn btn-outline-info btn-circle btn-sm">
                <i class="ti-new-window"></i>
            </a>
            
        
        </span>
    
    </td>
</tr>
@endforeach
<!--each row-->