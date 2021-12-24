<!--CRUMBS CONTAINER (RIGHT)-->
<div class="col-md-12  col-lg-5 align-self-center text-right p-b-9  {{ $page['list_page_actions_size'] ?? '' }} {{ $page['list_page_container_class'] ?? '' }}"
    id="list-page-actions-container">
    <div id="list-page-actions">
        @if(auth()->user()->is_team && auth()->user()->role->role_estimates > 2)
        <!--publish-->
        @if($bill->bill_status == 'draft')
        <button type="button" data-toggle="tooltip" title="{{ cleanLang(__('lang.publish_estimate')) }}"
            class="list-actions-button btn btn-page-actions waves-effect waves-dark confirm-action-info"
            href="javascript:void(0)" data-confirm-title="{{ cleanLang(__('lang.publish_estimate')) }}"
            data-confirm-text="{{ cleanLang(__('lang.the_estimate_will_be_sent_to_customer')) }}"
            data-url="{{ urlResource('/estimates/'.$bill->bill_estimateid.'/publish') }}"
            id="estimate-action-publish-estimate"><i class="sl-icon-share-alt"></i></button>
        @endif
        <!--mark as revised-->
        @if($bill->bill_status == 'declined')
        <button type="button" data-toggle="tooltip" title="{{ cleanLang(__('lang.publish_revised_estimate')) }}"
            class="list-actions-button btn btn-page-actions waves-effect waves-dark confirm-action-info"
            href="javascript:void(0)" data-confirm-title="{{ cleanLang(__('lang.publish_revised_estimate')) }}"
            data-confirm-text="{{ cleanLang(__('lang.the_estimate_will_be_marked_as_revised')) }}"
            data-url="{{ urlResource('/estimates/'.$bill->bill_estimateid.'/publish-revised') }}"
            id="estimate-action-publish-revised-estimate"><i class="sl-icon-share-alt"></i></button>
        @endif
        <!--email estimate-->
        <button type="button" data-toggle="tooltip" title="{{ cleanLang(__('lang.send_email')) }}"
            class="list-actions-button btn btn-page-actions waves-effect waves-dark confirm-action-info"
            href="javascript:void(0)" data-confirm-title="{{ cleanLang(__('lang.send_email')) }}"
            data-confirm-text="{{ cleanLang(__('lang.confirm')) }}"
            data-url="{{ urlResource('/estimates/'.$bill->bill_estimateid.'/resend') }}"
            id="estimate-action-email-estimate"><i class="ti-email"></i></button>
        <!--edit-->
        <span class="dropdown">
            <button type="button" data-toggle="dropdown" title="{{ cleanLang(__('lang.edit')) }}" aria-haspopup="true" aria-expanded="false"
                class="data-toggle-tooltip list-actions-button btn btn-page-actions waves-effect waves-dark">
                <i class="sl-icon-note"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="listTableAction">
                <a class="dropdown-item"
                    href="{{ url('/estimates/'.$bill->bill_estimateid.'/edit-estimate') }}">{{ cleanLang(__('lang.edit_estimate')) }}</a>
                <!--attach project-->
                <a class="dropdown-item confirm-action-danger {{ runtimeVisibility('dettach-estimate', $bill->bill_projectid)}}"
                    href="javascript:void(0)" data-confirm-title="{{ cleanLang(__('lang.detach_from_project')) }}"
                    id="bill-actions-dettach-project" data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}"
                    data-url="{{ urlResource('/estimates/'.$bill->bill_estimateid.'/detach-project') }}">
                    {{ cleanLang(__('lang.detach_from_project')) }}</a>
                <!--deattach project-->
                <a class="dropdown-item actions-modal-button js-ajax-ux-request reset-target-modal-form {{ runtimeVisibility('attach-estimate', $bill->bill_projectid)}}"
                    href="javascript:void(0)" data-toggle="modal" data-target="#actionsModal"
                    id="bill-actions-attach-project" data-modal-title="{{ cleanLang(__('lang.attach_to_project')) }}"
                    data-url="{{ urlResource('/estimates/'.$bill->bill_estimateid.'/attach-project?client_id='.$bill->bill_clientid) }}"
                    data-action-url="{{ urlResource('/estimates/'.$bill->bill_estimateid.'/attach-project') }}"
                    data-loading-target="actionsModalBody" data-action-method="POST">
                    {{ cleanLang(__('lang.attach_to_project')) }}</a>
            </div>
        </span>

        <!--delete-->
        <button type="button" data-toggle="tooltip" title="{{ cleanLang(__('lang.delete_estimate')) }}"
            class="list-actions-button btn btn-page-actions waves-effect waves-dark confirm-action-danger"
            data-confirm-title="{{ cleanLang(__('lang.delete_estimate')) }}" data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}"
            data-ajax-type="DELETE" data-url="{{ url('/') }}/estimates/{{ $bill->bill_estimateid }}?source=page"><i
                class="sl-icon-trash"></i></button>

        @endif

        <!--Download PDF-->
        <a data-toggle="tooltip" title="{{ cleanLang(__('lang.download')) }}" id="estimateDownloadButton"
            href="{{ url('/estimates/'.$bill->bill_estimateid.'/pdf') }}"
            class="list-actions-button btn btn-page-actions waves-effect waves-dark" download>
            <i class="mdi mdi-download"></i>
        </a>

    </div>
</div>