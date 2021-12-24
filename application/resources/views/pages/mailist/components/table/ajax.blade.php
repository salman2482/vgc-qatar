@foreach ($mails as $mail)
    {{-- @dd(config('visibility.action_buttons_delete')) --}}
    <tr id="mail_{{ $mail->id }}">
        <td class="mails_col_id">{{ $mail->id }}
        </td>
        <td class="mails_col_reference_no">
            {{ $mail->email }}
        </td>

        <td class="mails_col_action actions_column">
            <!--action button-->
            <span class="list-table-action dropdown font-size-inherit">
                {{-- @if (config('visibility.action_buttons_delete')) --}}
                {{-- delete --}}
                <button type="button" title="{{ cleanLang(__('lang.delete')) }}"
                    class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                    data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                    data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" data-ajax-type="DELETE"
                    data-url="{{ url('/') }}/mails/{{ $mail->id }}">
                    <i class="sl-icon-trash"></i>
                </button>
                {{-- @endif --}}
            </span>

        </td>
    </tr>
@endforeach
<!--each row-->
