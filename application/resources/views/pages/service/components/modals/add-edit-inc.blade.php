<div class="row" id="js-services-modal-add-edit" data-section="{{ $page['section'] }}">
    <div class="col-lg-12">
        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
        <!--client id<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Service Title')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                @csrf
                <input type="text" class="form-control form-control-sm" name="service_title" id="service_title"
                    value="{{ $service->title ?? '' }}">
            </div>
        </div>
        {{-- <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Description')) }}</label>
            <div class="col-sm-12 col-lg-9">
                <textarea name="description" id="" cols="30" rows="7"
                    class="form-control form-control-sm">{{ $service->description ?? '' }}</textarea>
            </div>
        </div> --}}

        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Rate Per Hour')) }}</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" name="rate_per_hour" id="rate_per_hr"
                    value="{{ $service->rate_per_hour ?? '' }}">
            </div>
        </div>

        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Minimum Charge')) }}</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" name="minimum_charge" id="min_charge"
                    value="{{ $service->minimum_charge ?? '' }}">
            </div>
        </div>

        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Service Description')) }}</label>
            <div class="col-sm-12 col-lg-9">
                <textarea name="service_description" cols="30" class="form-control form-control-sm" rows="7">{{ $service->service_description ?? '' }}</textarea>
            </div>
        </div>

        <table class="table">
            <thead>
                <th>Description</th>
                <th>Price</th>
            </thead>
            <tbody>
                @if ($page['section'] == 'edit')
                    @php
                        $prices = explode(',', $service->price);
                        $descriptions = explode(',', $service->description);
                    @endphp
                    {{-- @dd($prices) --}}
                    {{-- @if (!empty($prices) && !empty($descriptions)) --}}
                    @for ($i = 0; $i <= 6; $i++)
                        {{-- @foreach (array_combine($prices, $descriptions) as $price => $desc) --}}
                        <tr>
                            <td>
                                <div class="col-sm-12 col-lg-9">
                                    <textarea name="description-{{ $i }}" cols="30" rows="7" class="form-control
                            form-control-sm">{{ $descriptions[$i] ?? '' }}</textarea>
                                </div>
                            </td>
                            <td>
                                <div class="col-sm-12 col-lg-9">
                                    <input type="text" class="form-control form-control-sm"
                                        name="price-{{ $i }}" value="{{ $prices[$i] ?? '' }}"
                                        placeholder="price">
                                </div>
                            </td>
                        </tr>
                        {{-- @endforeach --}}
                    @endfor
                    {{-- @endif --}}
                @endif
                @if ($page['section'] == 'create')
                    @for ($i = 1; $i <= 7; $i++)
                        <tr>
                            <td>

                                <div class="col-sm-12 col-lg-9">
                                    <textarea name="description-{{ $i }}" cols="30" rows="7"
                                        class="form-control form-control-sm">{{ $service->description ?? '' }}</textarea>
                                </div>
                            </td>
                            <td>
                                <div class="col-sm-12 col-lg-9">
                                    <input type="text" class="form-control form-control-sm"
                                        name="price-{{ $i }}" value="{{ $service->price ?? '' }}"
                                        placeholder="price">
                                </div>
                            </td>
                        </tr>
                    @endfor

                @endif
            </tbody>
        </table>


        <div>
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Service Image')) }}*</label>
            <!--fileupload-->
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="dropzone dz-clickable" id="service_image">
                        <div class="dz-default dz-message">
                            <i class="icon-Upload-toCloud"></i>
                            <span>{{ cleanLang(__('lang.drag_drop_file')) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <!--fileupload-->
            <!--existing files-->
            @if (isset($page['section']) && $page['section'] == 'edit')
                <table class="table table-bordered">
                    <tbody>
                        @foreach ($attachments as $attachment)
                            @if ($attachment->attachment_unique_input === 'service_image')
                                <tr id="service_attachment_{{ $attachment->attachment_id ?? '' }}">
                                    <td>{{ $attachment->attachment_filename ?? '' }} </td>
                                    <td class="w-px-40"> <button type="button"
                                            class="btn btn-danger btn-circle btn-sm confirm-action-danger"
                                            data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                                            data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" active"
                                            data-ajax-type="DELETE"
                                            data-url="{{ url('/services/attachments/' . $attachment->attachment_uniqiueid ?? '') }}">
                                            <i class="sl-icon-trash"></i>
                                        </button></td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <!--pass source-->
        <input type="hidden" name="source" value="{{ request('source') }}">

    </div>

</div>
