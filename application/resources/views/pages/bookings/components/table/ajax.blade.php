@foreach ($bookings as $booking)
    <tr id="booking_{{ $booking->id }}">
        <td class="bookings_col_id">{{ $booking->id }}
        </td>
        <td class="bookings_col_id">{{ $booking->start_time ?? 'not found' }}
        </td>
        <td class="bookings_col_id">{{ $booking->title ?? 'not found' }}
        </td>

        <td class="documents_col_ref_no">
            {{ $booking->full_name ?? 'not found' }}
        </td>
        <td class="documents_col_issue_date">
            {{ $booking->email ?? 'not found' }}
        </td>
        <td class="documents_col_subject">
            {{ $booking->phone ?? 'not found' }}
        </td>
        <td class="documents_col_delivered_by">
            {{ $booking->street_no ?? 'not found' }}
        </td>
        <td class="documents_col_delivered_by">
            {{ $booking->bldg_no ?? 'not found' }}
        </td>
        <td class="documents_col_delivered_by">
            {{ $booking->unit_no ?? 'not found' }}
        </td>
        <td class="documents_col_delivered_by">
            {{ $booking->zone_no ?? 'not found' }}
        </td>
        <td class="documents_col_delivered_by">
            {{ $booking->payment_type ?? 'not found' }}
        </td>
        <td class="documents_col_delivered_by">
            {{ $booking->price ?? 'not found' }}
        </td>
        <td class="documents_col_delivered_by">
            {{ $booking->description ?? 'not found' }}
        </td>



        <td class="documents_col_status">
            <span class="label {{ $booking->status == 'pending' ? 'label-warning' : 'label-success' }}">
                {{ $booking->status }}</span>
        </td>
        <td class="bookings_col_invoice">
            <a title="{{ cleanLang(__('lang.download')) }}" title="{{ cleanLang(__('lang.download')) }}"
            class="data-toggle-tooltip data-toggle-tooltip btn btn-outline-warning btn-circle btn-sm"
            href="{{ url('/booking/pdf/download/'.$booking->id) }}" >
            <i class="ti-import"></i></a>
        </td>
        <td>
            <a title="Change Status" class="data-toggle-action-tooltip  btn btn-outline-info btn-circle btn-sm actions-modal-button js-ajax-ux-request reset-target-modal-form"
                href="javascript:void(0)" data-toggle="modal" data-target="#actionsModal"
                data-modal-title="{{ cleanLang(__('lang.change_status')) }}"
                data-url="{{ urlResource('/bookings/' . $booking->id . '/change-status') }}"
                data-action-url="{{ urlResource('/bookings/' . $booking->id . '/change-status') }}"
                data-loading-target="actionsModalBody" data-action-method="POST">
                <i class="sl-icon-note"></i>
            </a>
        </td>

    </tr>
@endforeach
<!--each row-->
