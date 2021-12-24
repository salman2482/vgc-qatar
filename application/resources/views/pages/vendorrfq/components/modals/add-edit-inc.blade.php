<div class="row" id="js-vendorrfqs-modal-add-edit" data-section="{{ $page['section'] }}">
    <div class="col-lg-12">
        <!--category<>-->
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('Business Category')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                    @php    
                            $cats = [
                            'Battery Supplier',
                            'Carpentry Equipment Supplier',
                            'Carpentry Material Supplier',
                            'Cctv Maintenance Contractor',
                            'Civil Contractor',
                            'Civil Maintenance Contractor',
                            'Cleaning Equipment Supplier',
                            'Cleaning Material Supplier',
                            'Cleaning Services',
                            'Electrical Contractor',
                            'Electrical Equipment Supplier',
                            'Electrical Material Supplier',
                            'Electromechanical Contractor',
                            'Electromechanical Maintenance Contractor',
                            'Elv Equipment Supplier',
                            'Elv Maintenance Contractor',
                            'Elv Material Supplier',
                            'Ff & Fa Contractor',
                            'Ff & Fa Maintenance Contractor',
                            'Fire Alarm Equipment Supplier',
                            'Fire Alarm Material Supplier',
                            'Fire Fighting Equipment Supplier',
                            'Fire Fighting Material Supplier',
                            'Fit-Out Contractor',
                            'Generator Contractor',
                            'Hvac Contractor',
                            'Hvac Material Supplier',
                            'Industrial Oil Supplier',
                            'Joinery',
                            'Joinery Equipment Supplier',
                            'Joinery Material Supplier',
                            'Landscaping Contractor',
                            'Manpower Supplier',
                            'Mechanical Contractor',
                            'Office Supplies',
                            'Others',
                            'Pest Control Services',
                            'Plumbing Equipment Supplier',
                            'Plumbing Material Supplier',
                            'Security Services',
                            'Vehicle Maintenance & Garage Services ',
                            'Vehicle Spare parts Supplier',
                            ];
                        @endphp

                    
                    {{-- multi categories --}}
                    <select name="vendorrfq_category" id="vendorrfq_category"
                    class="form-control form-control-sm select2-basic select2-multiple select2-tags select2-hidden-accessible"
                    multiple="multiple" tabindex="-1" aria-hidden="true">
                    <!-- vendorrfq_category-->
                    
                    @if(isset($page['section']) && $page['section'] == 'edit' && isset($vendorrfq->category))
                    
                    @foreach(explode(",",$vendorrfq->category) as $rfqcats)
                    @php $assigned[] = $rfqcats; @endphp
                    @endforeach
                    
                    @endif

                    <!--/# vendorrfq_category-->
                    @foreach($cats as $item)
                    <option value="{{ $item }}" {{ runtimePreselectedInArray($item ?? '', $assigned ?? []) }}>
                    {{$item }}</option>
                    @endforeach
                    <!--/#vendorrfq_category-->
                </select>
                    {{-- multi categories --}}

            </div>
        </div>


        @php
            $ccats = [
                'soft service' => 'Soft Service',
                'hard service' => 'Hard Service',
                'office supply' => 'Office Supply',
                'transport' => 'Transport'
            ];
        @endphp
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('Company Category')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                    <select class="select2-basic form-control form-control-sm" name="vendorrfq_company_category" id="vendorrfq_company_category" data-allow-clear="false" >
                        
                        @if (isset($vendorrfq->company_category))
                            
                        @foreach($ccats as $item)
                        <option value="{{ $item }}" {{$vendorrfq->company_category == $item ? 'selected' : ''}}>
                            {{$item }}
                        </option>
                        @endforeach
                        @else
                        @foreach($ccats as $item)
                        <option value="{{ $item }}" >
                            {{$item }}
                        </option>
                        @endforeach
                        @endif
                
                </select>

            </div>
        </div>

        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
        <!--/#category-->

        <!--priority<>-->
        <div class="form-group row">
            @php    
            $priority = [
            'High',
            'Medium',
            'Low',
            ];
            @endphp
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('Priority')) }}*</label>
            <div class="col-sm-12 col-lg-9">

                    <select name="vendorrfq_priority" id="vendorrfq_priority" class="select2-basic form-control form-control-sm">
                        @foreach ($priority as $priority)
                        
                        <?php if(isset($vendorrfq->priority)) { ?>
                        <option value="{{$priority}}"  {{$vendorrfq->priority == $priority ? 'selected' : ''}} > 
                            {{$priority}} 
                        </option>
                        <?php } else{ ?>

                        <option value="{{$priority}}"  > 
                            {{$priority}} 
                        </option>
                        <?php }?>
                        @endforeach
                    </select>
            </div>
        </div>
        <!--/#priority-->


        <!--due_date_request<>-->
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('Due Date Request')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate" name="vendorrfq_due_date_request"
                    autocomplete="off" value="{{ runtimeDatepickerDate($vendorrfq->due_date_request ?? '') }}">
                <input class="mysql-date" type="hidden" name="vendorrfq_due_date_request"
                    id="vendorrfq_due_date_request" value="{{ $vendorrfq->due_date_request ?? '' }}">
            </div>
        </div>
        <!--/#due_date_request-->

        <!--required_quotation_validity<>-->
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('REQ QTN Validity')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                    @php    
                            $reqs = [
                                '15 DAYS',
                                '1 MONTH',
                                '3 MONTHS',
                                
                            ];
                    @endphp
                
                    <select name="vendorrfq_required_quotation_validity" id="vendorrfq_required_quotation_validity" class="select2-basic form-control form-control-sm">
                        @foreach ($reqs as $req)
                        
                        <?php if(isset($vendorrfq->required_quotation_validity)) { ?>
                        <option value="{{$req}}"  {{$vendorrfq->required_quotation_validity == $req ? 'selected' : ''}} > 
                            {{$req}} 
                        </option>
                        <?php } else{ ?>

                        <option value="{{$req}}"  > 
                            {{$req}} 
                        </option>
                        <?php }?>
                        @endforeach
                    </select>
            </div>
        </div>
        <!--/#required_quotation_validity-->
<!--document_copy<>-->
<div class="form-group row">
    <label
        class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
        {{ cleanLang(__('RFQ Copy')) }}*</label>
    <div class="col-sm-12 col-lg-9">
        
    </div>
</div>

<!--attach recipt-->
<div>
    <!--fileupload-->
    <div class="form-group row">
        <div class="col-sm-12">
            <div class="dropzone dz-clickable" id="fileupload_vendorrfq_rfq">
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
    <table class="table table-bordered">
        <tbody>
            {{-- @dd($attachments) --}}
            @foreach($attachments as $attachment)
            @if ($attachment->attachment_unique_input === 'rfq_attachments')
            <tr id="vendorrfq_attachment_{{ $attachment->attachment_id }}">
                <td>{{ $attachment->attachment_filename }} </td>
                <td class="w-px-40"> <button type="button"
                        class="btn btn-danger btn-circle btn-sm confirm-action-danger"
                        data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                        data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" active
                        data-ajax-type="DELETE"
                        data-url="{{ url('/vendorrfqs/attachments/'.$attachment->attachment_uniqiueid) }}">
                        <i class="sl-icon-trash"></i>
                    </button></td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
    @endif
</div>




 <!--image<>-->
 <div class="form-group row">
    <label
        class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
        {{ cleanLang(__('Image')) }}*</label>
    <div class="col-sm-12 col-lg-9">
        
    </div>
</div>

<!--attach recipt-->
<div>
    <!--fileupload-->
    <div class="form-group row">
        <div class="col-sm-12">
            <div class="dropzone dz-clickable" id="fileupload_vendorrfq_video">
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
    <table class="table table-bordered">
        <tbody>
            @foreach($attachments as $attachment)
            @if ($attachment->attachment_unique_input === 'video_attachments')
                
            
            <tr id="vendorrfq_attachment_{{ $attachment->attachment_id }}">
                <td>{{ $attachment->attachment_filename }} </td>

                <td class="w-px-40"> <button type="button"
                        class="btn btn-danger btn-circle btn-sm confirm-action-danger"
                        data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                        data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" active
                        data-ajax-type="DELETE"
                        data-url="{{ url('/vendorrfqs/attachments/'.$attachment->attachment_uniqiueid) }}">
                        <i class="sl-icon-trash"></i>
                    </button></td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
    @endif
</div>
<!--/#image-->


    </div>


    <!--redirect to vendorrfq-->
    @if (config('visibility.vendorrfq_show_vendorrfq_option'))
        <div class="form-group form-group-checkbox row">
            <div class="col-12 text-left p-t-5">
                <input type="checkbox" id="show_after_adding" name="vendorrfq_show_after_adding"
                    class="filled-in chk-col-light-blue" checked="checked">
                <label for="show_after_adding">{{ cleanLang(__('lang.show_vendorrfq_after_its_created')) }}</label>
            </div>
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


@if (isset($page['section']) && $page['section'] == 'edit')
    <!--dynamic inline - set dynamic vendorrfq progress-->
    <script>
        NX.varInitialvendorrfqProgress = "{{ $vendorrfq['vendorrfq_progress'] }}";

    </script>
@endif
