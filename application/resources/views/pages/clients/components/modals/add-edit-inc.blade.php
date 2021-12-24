<!--modal-->
<div class="row" id="js-trigger-clients-modal-add-edit" data-payload="{{ $page['section'] ?? '' }}">
    <div class="col-lg-12">
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.company_name')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="client_company_name"
                    name="client_company_name" value="{{ $client->client_company_name ?? '' }}">
            </div>
        </div>

        @if(isset($page['section']) && $page['section'] == 'edit' && auth()->user()->is_team)
        <div class="form-group row">
            <label for="example-month-input" class="col-sm-12 col-lg-3 col-form-label text-left">{{ cleanLang(__('lang.status')) }}</label>
            <div class="col-sm-12 col-lg-9">
                <select class="select2-basic form-control form-control-sm" id="client_status" name="client_status">
                    <option></option>
                    <option value="active" {{ runtimePreselected($client->client_status ?? '', 'active') }}>{{ cleanLang(__('lang.active')) }}</option>
                    <option value="suspended" {{ runtimePreselected($client->client_status ?? '', 'suspended') }}>{{ cleanLang(__('lang.suspended')) }}
                    </option>
                </select>
            </div>
        </div>
        <div class="line"></div>
        @endif

        <!--contact section-->
        @if(isset($page['section']) && $page['section'] == 'create')
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.first_name')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="first_name" name="first_name"
                    placeholder="">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.last_name')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="last_name" name="last_name" placeholder="">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.email_address')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="email" name="email" placeholder="">
            </div>
        </div>
       
        <div class="line"></div>
        @endif
        <!--contact section-->
        <div>
            <label
            class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Client Stamp')) }}*</label>
            <!--fileupload-->
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="dropzone dz-clickable" id="client_stamp">
                        <div class="dz-default dz-message">
                            <i class="icon-Upload-toCloud"></i>
                            <span>{{ cleanLang(__('lang.drag_drop_file')) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <!--fileupload-->
            <!--existing files-->
            @if(isset($page['section']) && $page['section'] == 'edit')
                @if (isset($attachments))
                    <table class="table table-bordered">
                        <tbody>
                            @foreach($attachments as $attachment)
                                @if ($attachment->attachment_unique_input === 'client_stamp')
                                <tr id="client_attachment_{{ $attachment->attachment_id ?? '' }}">
                                    <td>{{ $attachment->attachment_filename ?? '' }} </td>
                                    <td class="w-px-40"> <button type="button"
                                            class="btn btn-danger btn-circle btn-sm confirm-action-danger"
                                            data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                                            data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" active"
                                            data-ajax-type="DELETE"
                                            data-url="{{ url('/clients/attachments/'.$attachment->attachment_uniqiueid ?? '') }}">
                                            <i class="sl-icon-trash"></i>
                                        </button></td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                @endif
            @endif
        </div>
        <!--billing address section-->
        <div class="spacer row">
            <div class="col-sm-12 col-lg-8">
                <span class="title">{{ cleanLang(__('lang.billing_address')) }}</span class="title">
            </div>
            <div class="col-sm-12 col-lg-4">
                <div class="switch  text-right">
                    <label>
                        <input type="checkbox" name="add_client_option_bill_address" id="add_client_option_bill_address"
                            class="js-switch-toggle-hidden-content" data-target="add_client_billing_address_section">
                        <span class="lever switch-col-light-blue"></span>
                    </label>
                </div>
            </div>
        </div>
        <!--billing address section-->


        <!--billing address section-->
        <div id="add_client_billing_address_section" class="hidden">
            <div class="form-group row">
                <label class="col-sm-12 col-lg-3 text-left control-label col-form-label">{{ cleanLang(__('lang.street')) }}</label>
                <div class="col-sm-12 col-lg-9">
                    <input type="text" class="form-control form-control-sm" id="client_billing_street"
                        name="client_billing_street" value="{{ $client->client_billing_street ?? '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-lg-3 text-left control-label col-form-label">{{ cleanLang(__('lang.city')) }}</label>
                <div class="col-sm-12 col-lg-9">
                    <input type="text" class="form-control form-control-sm" id="client_billing_city"
                        name="client_billing_city" value="{{ $client->client_billing_city ?? '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-lg-3 text-left control-label col-form-label">{{ cleanLang(__('lang.state')) }}</label>
                <div class="col-sm-12 col-lg-9">
                    <input type="text" class="form-control form-control-sm" id="client_billing_state"
                        name="client_billing_state" value="{{ $client->client_billing_state ?? '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-lg-3 text-left control-label col-form-label">{{ cleanLang(__('lang.zipcode')) }}</label>
                <div class="col-sm-12 col-lg-9">
                    <input type="text" class="form-control form-control-sm" id="client_billing_zip"
                        name="client_billing_zip" value="{{ $client->client_billing_zip ?? '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="example-month-input" class="col-sm-12 col-lg-3 col-form-label text-left">{{ cleanLang(__('lang.country')) }}</label>
                <div class="col-sm-12 col-lg-9">
                    @php $selected_country = $client->client_billing_country ?? ''; @endphp
                    <select class="select2-basic form-control form-control-sm" id="client_billing_country"
                        name="client_billing_country">
                        <option></option>
                        @include('misc.country-list')
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-lg-3 text-left control-label col-form-label">{{ cleanLang(__('lang.telephone')) }}</label>
                <div class="col-sm-12 col-lg-9">
                    <input type="text" class="form-control form-control-sm" id="client_phone" name="client_phone"
                        value="{{ $client->client_phone ?? '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-lg-3 text-left control-label col-form-label">{{ cleanLang(__('lang.website')) }}</label>
                <div class="col-sm-12 col-lg-9">
                    <input type="text" class="form-control form-control-sm" id="client_website" name="client_website"
                        value="{{ $client->client_website ?? '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-lg-3 text-left control-label col-form-label">{{ cleanLang(__('lang.vat_tax_number')) }}</label>
                <div class="col-sm-12 col-lg-9">
                    <input type="text" class="form-control form-control-sm" id="client_vat" name="client_vat"
                        value="{{ $client->client_vat ?? '' }}">
                </div>
            </div>
            <div class="line"></div>
        </div>
        <!--billing address section-->


        <!--shipping address section-->
        @if(config('system.settings_clients_shipping_address') == 'enabled')
        <div class="spacer row">
            <div class="col-sm-12 col-lg-8">
                <span class="title">{{ cleanLang(__('lang.shipping_address')) }}</span class="title">
            </div>
            <div class="col-sm-12 col-lg-4">
                <div class="switch  text-right">
                    <label>
                        <input type="checkbox" name="add_client_option_shipping_address"
                            id="add_client_option_shipping_address" class="js-switch-toggle-hidden-content"
                            data-target="add_client_shipping_address_section">
                        <span class="lever switch-col-light-blue"></span>
                    </label>
                </div>
            </div>
        </div>
        @endif
        <!--shipping address section-->


        <!--shipping address section-->
        @if(config('system.settings_clients_shipping_address') == 'enabled')
        <div id="add_client_shipping_address_section" class="hidden">
            <div class="form-group row">
                <label class="col-sm-12 col-lg-3 text-left control-label col-form-label">{{ cleanLang(__('lang.street')) }}</label>
                <div class="col-sm-12 col-lg-9">
                    <input type="text" class="form-control form-control-sm" id="client_shipping_street"
                        name="client_shipping_street" value="{{ $client->client_shipping_street ?? '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-lg-3 text-left control-label col-form-label">{{ cleanLang(__('lang.city')) }}</label>
                <div class="col-sm-12 col-lg-9">
                    <input type="text" class="form-control form-control-sm" id="client_shipping_city"
                        name="client_shipping_city" value="{{ $client->client_shipping_city ?? '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-lg-3 text-left control-label col-form-label">{{ cleanLang(__('lang.state')) }}</label>
                <div class="col-sm-12 col-lg-9">
                    <input type="text" class="form-control form-control-sm" id="client_shipping_state"
                        name="client_shipping_state" value="{{ $client->client_shipping_state ?? '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-lg-3 text-left control-label col-form-label">{{ cleanLang(__('lang.zipcode')) }}</label>
                <div class="col-sm-12 col-lg-9">
                    <input type="text" class="form-control form-control-sm" id="client_shipping_zip"
                        name="client_shipping_zip" value="{{ $client->client_shipping_zip ?? '' }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="example-month-input" class="col-sm-12 col-lg-3 col-form-label text-left">{{ cleanLang(__('lang.country')) }}</label>
                <div class="col-sm-12 col-lg-9">
                    @php $selected_country = $client->client_shipping_country ?? ''; @endphp
                    <select class="select2-basic form-control form-control-sm" id="client_shipping_country"
                        name="client_shipping_country">
                        <option></option>
                        @include('misc.country-list')
                    </select>
                </div>
            </div>
            <div class="form-group form-group-checkbox row" id="expense_billable_option">
                <label class="col-sm-12 col-lg-3 col-form-label text-left">{{ cleanLang(__('lang.same_as_billing')) }}</label>
                <div class="col-6 text-left p-t-5">
                    <input type="checkbox" id="same_as_billing_address" name="same_as_billing_address"
                        class="filled-in chk-col-light-blue">
                    <label for="same_as_billing_address"></label>
                </div>
            </div>
        </div>
        @endif
        <!--shipping address section-->

        <!--other details-->
        @if(auth()->user()->is_team)
        <div class="spacer row">
            <div class="col-sm-12 col-lg-8">
                <span class="title">{{ cleanLang(__('lang.other_details')) }}</span class="title">
            </div>
            <div class="col-sm-12 col-lg-4">
                <div class="switch  text-right">
                    <label>
                        <input type="checkbox" name="add_client_option_other" id="add_client_option_other"
                            class="js-switch-toggle-hidden-content" data-target="add_client_details">
                        <span class="lever switch-col-light-blue"></span>
                    </label>
                </div>
            </div>
        </div>
        <div id="add_client_details" class="hidden">
            <!--tags-->
            <div class="form-group row">
                <label class="col-sm-12 col-lg-3 text-left control-label col-form-label">{{ cleanLang(__('lang.tags')) }}</label>
                <div class="col-md-9">
                    <select name="tags" id="tags"
                        class="form-control form-control-sm select2-multiple select2-tags select2-hidden-accessible"
                        multiple="multiple" tabindex="-1" aria-hidden="true">

                        <!--array of selected tags-->
                        @if(isset($page['section']) && $page['section'] == 'edit')
                        @foreach($client->tags as $tag)
                        @php $selected_tags[] = $tag->tag_title ; @endphp
                        @endforeach
                        @endif
                        <!--/#array of selected tags-->

                        @foreach($tags as $tag)
                        <option value="{{ $tag->tag_title }}"
                            {{ runtimePreselectedInArray($tag->tag_title ?? '', $selected_tags  ?? []) }}>{{ $tag->tag_title }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!--/#tags-->
        </div>
        @endif
        <!--notes-->
        <div class="row">
            <div class="col-12">
                <div><small><strong>* {{ cleanLang(__('lang.required')) }}</strong></small></div>
            </div>
        </div>
    </div>
</div>