@foreach($frontbanners as $frontbanner)
{{-- @dd(config('visibility.action_buttons_delete')) --}}
<tr id="frontbanner_{{ $frontbanner->id }}">
    <td class="frontbanners_col_id">
        {{ $frontbanner->id }}
    </td>
    <td class="frontbanners_col_title">
        {{ $frontbanner->title }}
    </td>
    <td class="frontbanners_col_title_ar">
        {{ $frontbanner->title_ar }}
    </td>

    <td class="frontbanners_col_description">
        {!! str_limit($frontbanner->description, 10) !!}
    </td>
    <td class="frontbanners_col_description_ar">
        {!! str_limit($frontbanner->description_ar, 10) !!}
    </td>

   
    
    <td class="frontbanners_col_action actions_column">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">
          {{-- delete --}}
            <button type="button" title="{{ cleanLang(__('lang.delete')) }}"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}" data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}"
                data-ajax-type="DELETE" data-url="{{ url('/') }}/frontbanners/{{ $frontbanner->id }}">
                <i class="sl-icon-trash"></i>
            </button>
            
            <!--[edit]-->
            @if(config('visibility.action_buttons_edit'))
            <button type="button" title="{{ cleanLang(__('lang.edit')) }}"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal"
                data-url="{{ urlResource('/frontbanners/'.$frontbanner->id.'/edit') }}"
                data-loading-target="commonModalBody" data-modal-title="{{ cleanLang(__('lang.frontbanner_edit')) }}"
                data-action-url="{{ urlResource('/frontbanners/'.$frontbanner->id) }}" data-action-method="PUT"
                data-action-ajax-class="" data-action-ajax-loading-target="frontbanners-td-container">
                <i class="sl-icon-note"></i>
            </button>
            @endif

            <button type="button" title="{{ cleanLang(__('lang.view')) }}"
            class="data-toggle-tooltip show-modal-button btn btn-outline-info btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
            data-toggle="modal" data-target="#plainModal" data-loading-target="plainModalBody"
            data-modal-title="{{ cleanLang(__('Product')) }}" data-url="{{ url('/frontbanners/'.$frontbanner->id) }}">
            <i class="ti-new-window"></i>
        </button>
        
        </span>
    
    </td>
</tr>
@endforeach
<!--each row-->