<div class="row" id="js-vendorpos-modal-add-edit" data-section="{{ $page['section'] }}">
    <div class="col-lg-12">
     

        <!--qtn_ref_no<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('QTN REF NO')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                {{-- <input type="text" class="form-control form-control-sm" id="vendorpo_qtn_ref_no" name="vendorpo_qtn_ref_no"
                    placeholder="" value="{{ $vendorpo->qtn_ref_no ?? '' }}"> --}}
                    <select name="vendorpo_qtn_ref_no" id="vendorpo_qtn_ref_no" class="select2-basic form-control form-control-sm">
                    <option>Select QTN REF</option>
                    
                    @foreach ($qtns as $req)
                    
                    <?php if(isset($vendorpo->qtn_ref_no)) { ?>

        <option value="{{$req->qtn_ref_no}}" {{$req->qtn_ref_no == $vendorpo->qtn_ref_no ? 'selected' : ''}}> 
                        {{$req->qtn_ref_no}} 
                    </option>
                    <?php } else{ ?>

                    <option value="{{$req->qtn_ref_no}}"  > 
                        {{$req->qtn_ref_no}} 
                    </option>
                        
                    <?php }?>
                    @endforeach
                    
                </select>
            </div>
        </div>

        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
        <!--/#qtn_ref_no-->

        <!--vendor_name<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('Company Name')) }}</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="vendor_name" name="vendor_name"
                    placeholder="Company Name" value="" readonly>
            </div>
        </div>
        <!--/#vendor_name-->


        <!--category<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('Category')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="vendorpo_category" name="vendorpo_category"
                    placeholder="" value="{{ $vendorpo->category ?? '' }}">
            </div>
        </div>
        <!--/#category-->

        <!--total_value<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('Total Value')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="vendorpo_total_value" name="vendorpo_total_value"
                    placeholder="" value="{{ $vendorpo->total_value ?? '' }}">
            </div>
        </div>
        <!--/#total_value-->


        <!--issuing_date<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('Issuing Date')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate" name="vendorpo_issuing_date"
                    autocomplete="off" value="{{ runtimeDatepickerDate($vendorpo->issuing_date ?? '') }}">
                <input class="mysql-date" type="hidden" name="vendorpo_issuing_date" id="vendorpo_issuing_date"
                    value="{{ $vendorpo->issuing_date ?? '' }}">
            </div>
        </div>
        <!--/#issuing_date-->

       <!--payment_method<>-->
       <div class="form-group row">
        <label
            class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
            {{ cleanLang(__('Payment Method')) }}*</label>
        <div class="col-sm-12 col-lg-9">
            <input type="text" class="form-control form-control-sm" id="vendorpo_payment_method" name="vendorpo_payment_method"
                placeholder="" value="{{ $vendorpo->payment_method ?? '' }}">
        </div>
    </div>
    <!--/#payment_method-->

        <!--terms_condition<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('Terms Condition')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <textarea name="vendorpo_terms_condition" class="form-control form-control-sm" id="vendorpo_terms_condition" cols="30" rows="10">{{ $vendorpo->terms_condition ?? '' }}</textarea>
            </div>
        </div>
        <!--/#terms_condition-->

        <!--document_copy<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('QTN Copy')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                {{-- <input type="text" class="form-control form-control-sm" id="vendorpo_document_copy" name="vendorpo_document_copy" placeholder="" value="{{ $vendorpo->document_copy ?? '' }}"> --}}
            </div>
        </div>

        <!--attach recipt-->
        <div>
            <!--fileupload-->
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="dropzone dz-clickable" id="fileupload_vendorpo_qtn">
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
                    @if ($attachment->attachment_unique_input === 'qtn_attachments')
                    <tr id="vendorpo_attachment_{{ $attachment->attachment_id }}">
                        <td>{{ $attachment->attachment_filename }} </td>
                        <td class="w-px-40"> <button type="button"
                                class="btn btn-danger btn-circle btn-sm confirm-action-danger"
                                data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                                data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" active"
                                data-ajax-type="DELETE"
                                data-url="{{ url('/vendorpos/attachments/'.$attachment->attachment_uniqiueid) }}">
                                <i class="sl-icon-trash"></i>
                            </button></td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>

        
        

         <!--last_renewal_copy<>-->
         <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('PO Copy')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                {{-- <input type="text" class="form-control form-control-sm" id="vendorpo_document_copy" name="vendorpo_document_copy" placeholder="" value="{{ $vendorpo->document_copy ?? '' }}"> --}}
            </div>
        </div>

        <!--attach recipt-->
        <div>
            <!--fileupload-->
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="dropzone dz-clickable" id="fileupload_vendorpo_po">
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
                    @if ($attachment->attachment_unique_input === 'po_attachments')
                        
                    
                    <tr id="vendorpo_attachment_{{ $attachment->attachment_id }}">
                        <td>{{ $attachment->attachment_filename }} </td>

                        <td class="w-px-40"> <button type="button"
                                class="btn btn-danger btn-circle btn-sm confirm-action-danger"
                                data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                                data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" active"
                                data-ajax-type="DELETE"
                                data-url="{{ url('/vendorpos/attachments/'.$attachment->attachment_uniqiueid) }}">
                                <i class="sl-icon-trash"></i>
                            </button></td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
        <!--/#last_renewal_copy-->

       


        </div>


        <!--redirect to vendorpo-->
        @if(config('visibility.vendorpo_show_vendorpo_option'))
        <div class="form-group form-group-checkbox row">
            <div class="col-12 text-left p-t-5">
                <input type="checkbox" id="show_after_adding" name="vendorpo_show_after_adding"
                    class="filled-in chk-col-light-blue" checked="checked">
                <label for="show_after_adding">{{ cleanLang(__('lang.show_vendorpo_after_its_created')) }}</label>
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


@if(isset($page['section']) && $page['section'] == 'edit')
<!--dynamic inline - set dynamic vendorpo progress-->
<script>
    NX.varInitialvendorpoProgress = "{{ $vendorpo['vendorpo_progress'] }}";
</script>
@endif

<script>
    var cat = null;
     $("#vendorpo_qtn_ref_no").change(function() {
         var rfq = $("#vendorpo_qtn_ref_no").val();
         $.ajax({
             url: "{{url('qtnCatTotal')}}",
             type: 'GET',
             data:{id: rfq},
             success:function(response) { 
                 cat = response.category;
                 $('#vendorpo_category').val(response.category.category);
                 $('#vendorpo_total_value').val(response.category.total_value);
                 $('#vendor_name').val(response.name);
                 
             }
         });
     });
 </script>