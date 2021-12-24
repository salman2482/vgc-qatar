@foreach($frontcareers as $frontcareer)
{{-- @dd(config('visibility.action_buttons_delete')) --}}
<tr id="frontcareer_{{ $frontcareer->id }}">
    <td class="frontcareers_col_id">
        {{ $frontcareer->id }}
    </td>
    <td class="frontcareers_col_title">
        {{ $frontcareer->title }}
    </td>
    <td class="frontcareers_col_experience">
        {{ str_limit($frontcareer->experience, 20) }}
    </td>
    <td class="frontcareers_col_category">
        {{ str_limit($frontcareer->category, 20) }}
    </td>
    <td class="frontcareers_col_position">
        {{ str_limit($frontcareer->position, 20) }}
    </td>
    <td class="frontcareers_col_salary">
        {{ str_limit($frontcareer->salary, 20) }}
    </td>
    <td class="frontcareers_col_status">
        @if( $frontcareer->status == 'OPEN')
        <span class="badge-font badge bg-light-success text-success">{{$frontcareer->status ?? ''}}</span> 
        @else
        <span class="badge-font badge bg-light-danger text-danger">{{$frontcareer->status ?? ''}}</span> 
        @endif
    </td>

   
    
    <td class="frontcareers_col_action actions_column">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">
          {{-- delete --}}
            <button type="button" title="{{ cleanLang(__('lang.delete')) }}"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}" data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}"
                data-ajax-type="DELETE" data-url="{{ url('/') }}/frontcareers/{{ $frontcareer->id }}">
                <i class="sl-icon-trash"></i>
            </button>
            
            <!--[edit]-->
            @if(config('visibility.action_buttons_edit'))
            <button type="button" title="{{ cleanLang(__('lang.edit')) }}"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal"
                data-url="{{ urlResource('/frontcareers/'.$frontcareer->id.'/edit') }}"
                data-loading-target="commonModalBody" data-modal-title="{{ cleanLang(__('lang.frontcareer_edit')) }}"
                data-action-url="{{ urlResource('/frontcareers/'.$frontcareer->id) }}" data-action-method="PUT"
                data-action-ajax-class="" data-action-ajax-loading-target="frontcareers-td-container">
                <i class="sl-icon-note"></i>
            </button>
            @endif
            
            <button type="button" title="{{ cleanLang(__('lang.view')) }}"
            class="data-toggle-tooltip show-modal-button btn btn-outline-info btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
            data-toggle="modal" data-target="#plainModal" data-loading-target="plainModalBody"
            data-modal-title="{{ cleanLang(__('Front View Career Show')) }}" 
            data-url="{{ url('/frontcareers/'.$frontcareer->id) }}">
            <i class="ti-new-window"></i>
            </button>
        
        </span>
    
    </td>
</tr>
@endforeach
<!--each row-->