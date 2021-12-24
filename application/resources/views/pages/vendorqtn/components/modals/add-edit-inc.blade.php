<div class="row" id="js-vendorqtns-modal-add-edit" data-section="{{ $page['section'] }}">
    <div class="col-lg-12">
        <!--category<>-->
        {{-- <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('Category')) }}*</label>
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

                    <select name="vendorqtn_category" id="vendorqtn_category" class="select2-basic form-control form-control-sm">
                        <option>Select Category</option>
                        @foreach ($cats as $cat)
                        
                        
                        @endforeach
                    </select>
            </div>
        </div>

        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
        <!--/#category-->

        <!--rfq_ref<>-->
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('rfq_ref')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="vendorqtn_rfq_ref"
                    name="vendorqtn_rfq_ref" placeholder="" value="{{ $vendorqtn->rfq_ref ?? '' }}">
            </div>
        </div>
        <!--/#rfq_ref-->

        <!--qtn_ref_no<>-->
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('qtn_ref_no')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="vendorqtn_qtn_ref_no"
                    name="vendorqtn_qtn_ref_no" placeholder="" value="{{ $vendorqtn->qtn_ref_no ?? '' }}">
            </div>
        </div>
        <!--/#qtn_ref_no-->


        <!--receiving_date<>-->
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('Due Date Request')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate" name="vendorqtn_receiving_date"
                    autocomplete="off" value="{{ runtimeDatepickerDate($vendorqtn->receiving_date ?? '') }}">
                <input class="mysql-date" type="hidden" name="vendorqtn_receiving_date"
                    id="vendorqtn_receiving_date" value="{{ $vendorqtn->receiving_date ?? '' }}">
            </div>
        </div>
        <!--/#receiving_date-->

        <!--devlivery_time<>-->
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('Due Date Request')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate" name="vendorqtn_devlivery_time"
                    autocomplete="off" value="{{ runtimeDatepickerDate($vendorqtn->devlivery_time ?? '') }}">
                <input class="mysql-date" type="hidden" name="vendorqtn_devlivery_time"
                    id="vendorqtn_devlivery_time" value="{{ $vendorqtn->devlivery_time ?? '' }}">
            </div>
        </div>
        <!--/#devlivery_time-->


        <!--total_value<>-->
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('total_value')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="vendorqtn_total_value" name="vendorqtn_total_value"
                    placeholder="" value="{{ $vendorqtn->total_value ?? '' }}">
            </div>
        </div>
        <!--/#total_value-->

        {{-- <!--uom<>-->
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('UOM')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="vendorqtn_uom" name="vendorqtn_uom"
                    placeholder="" value="{{ $vendorqtn->uom ?? '' }}">
            </div>
        </div>
        <!--/#uom--> --}}

        <!--status<>-->
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('status')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                {{-- <input type="text" class="form-control form-control-sm" id="vendorqtn_status" name="vendorqtn_status"
                    placeholder="" value="{{ $vendorqtn->status ?? '' }}"> --}}

                    @php    
                    $reqs = [
                        'APPROVED',
                        'REQUESTING FOR DISCOUNT',
                        'CANCELLED',
                        'WAITING FOR APPROVAL',
                        
                    ];
            @endphp
        
            <select name="vendorqtn_status" id="vendorqtn_status" class="select2-basic form-control form-control-sm">
                {{-- <option>Select Status</option> --}}
                @foreach ($reqs as $req)
                
                <?php if(isset($vendorqtn->status)) { ?>
                <option value="{{$req}}"  {{$vendorqtn->status == $req ? 'selected' : ''}} > 
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
        <!--/#status-->

        {{-- <!--required_quotation_validity<>-->
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
                
                    <select name="vendorqtn_required_quotation_validity" id="vendorqtn_required_quotation_validity" class="select2-basic form-control form-control-sm">
                        <option>Select Validity</option>
                        @foreach ($reqs as $req)
                        
                        <?php if(isset($vendorqtn->required_quotation_validity)) { ?>
                        <option value="{{$req}}"  {{$vendorqtn->required_quotation_validity == $req ? 'selected' : ''}} > 
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

        <!--/#required_quotation_validity--> --}}



    </div>


    <!--redirect to vendorqtn-->
    @if (config('visibility.vendorqtn_show_vendorqtn_option'))
        <div class="form-group form-group-checkbox row">
            <div class="col-12 text-left p-t-5">
                <input type="checkbox" id="show_after_adding" name="vendorqtn_show_after_adding"
                    class="filled-in chk-col-light-blue" checked="checked">
                <label for="show_after_adding">{{ cleanLang(__('lang.show_vendorqtn_after_its_created')) }}</label>
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
    <!--dynamic inline - set dynamic vendorqtn progress-->
    <script>
        NX.varInitialvendorqtnProgress = "{{ $vendorqtn['vendorqtn_progress'] }}";

    </script>
@endif
