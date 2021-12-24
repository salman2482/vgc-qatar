<div class="row " id="js-rfms-modal-add-edit" data-section="{{ $page['section'] }}">
    <div class="col-lg-12">
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label ">{{ cleanLang(__('Change Status*')) }}</label>
            <div class="col-sm-12 col-lg-9">
                <!--select2 basic search-->
                <select name="change_status" id="change_status"
                    class="form-control form-control-sm js-select2-basic" >
                    <option value="approved" {{ $rfm->status == 'approved' ? 'selected' : '' }}>
                        Approved
                    </option>
                    <option value="rejected" {{ $rfm->status == 'rejected' ? 'selected' : '' }}>
                        Rejected
                    </option>
                </select>   
            </div>
        </div>
        <div class="form-group row hidden">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label ">{{ cleanLang(__('lang.rfm_department')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <div class="col-sm-12 col-lg-4">
                    <select class="select2-basic form-control form-control-sm" type="hidden"  name="rfm_department" id="rfm_department"
                        data-allow-clear="false" >
                        <option value="soft service" {{ $rfm->department == "soft service" ? 'selected' : '' }}>Soft Service</option>
                        <option value="hard service" {{ $rfm->department == "hard service" ? 'selected' : '' }}>Hard service</option>
                        <option value="office supply"  {{ $rfm->department == "office supply" ? 'selected' : '' }}>Office Supply</option>
                        <option value="transport" {{ $rfm->department == "transport" ? 'selected' : '' }} >Transport</option>
                    </select>
                </div>
                {{-- <input type="text" class="form-control form-control-sm" id="rfm_title" name="rfm_title"
                    placeholder="" value="{{ $rfm-> ?? '' }}"> --}}
            </div>
        </div>
      
        <div class="form-group row hidden">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label ">{{ cleanLang(__('Select Inline Manager*')) }}</label>
            <div class="col-sm-12 col-lg-9">
                <!--select2 basic search-->
                <select type="hidden" name="rfm_clientid" id="rfm_clientid"
                    class="clients_and_projects_toggle form-control form-control-sm js-select2-basic-search-modal"
                    data-ajax--url="{{ url('/') }}/feed/company_managers" hidden>
                    @if (isset($rfm->inline_manager_id) != '')
                    <option value="{{ $rfm->inline_manager_id ?? '' }}" "{{ $rfm->inline_manager_id ? 'selected' : '' }}">{{ $rfm->first_name }}
                    </option>
                    @endif
                    
                </select>
            </div>
        </div>
        <div class="form-group row hidden">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label ">{{ cleanLang(__('Select Head Of Account*')) }}</label>
            <div class="col-sm-12 col-lg-9">
                <!--select2 basic search-->
                <select name="rfm_hoa" id="rfm_hoa"
                    class="clients_and_projects_toggle form-control form-control-sm js-select2-basic-search-modal"
                    data-ajax--url="{{ url('/') }}/feed/company_managers">
                    @if(isset($rfm->hoc_id) && $rfm->hoc_id != '')
                        <option value="{{ $rfm->hoc_id ?? '' }}">{{ $rfm->first_name }}
                        </option>
                    @endif
                </select>
            </div>
        </div>
        <!--subject<>-->
        <div class="form-group row hidden">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label hidden">{{ cleanLang(__('lang.rfm_subject')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <textarea name="rfm_subject" id="rfm_subject" class="form-control form-control-sm"  cols="30" rows="10" >{{ $rfm->subject ?? ''}}</textarea>
            </div>
        </div>
        <!--/#subject-->

        <!--remarks<>-->
        <div class="form-group hidden">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label hidden">{{ cleanLang(__('Remarks')) }}*</label>
                <div class="col-sm-12 col-lg-9">
                    <input type="hidden"  name="rfm_remarks" id="rfm_remarks" class="form-control form-control-sm" value="{{ $rfm->remarks ?? ''}}" >
                </div>
        </div>
        <!--/#remarks-->

        <!--site<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label hidden">{{ cleanLang(__('lang.rfm_site')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="hidden"  name="rfm_site" id="rfm_site" class="form-control form-control-sm" value="{{ $rfm->site ?? ''}}">
            </div>
        </div>
        <!--/#site-->
        <!--material<>-->
            {{-- <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label ">{{ cleanLang(__('lang.rfm_material')) }}*</label>
            <table id="tbl" class="mb-2">
            <tr id="product0">
                <td>
                  <select class="form-control w-50" name="material_id[]">
                   @foreach ($materials as $material)
                       <option value="{{ $material->id }}">{{ $material->title }}</option>
                   @endforeach
                  </select>
                  <input type="number" name="qty[]" class="form-control w-25 d-inline"  placeholder="quantity">
                </td>
            </tr>
            <tr id="product1">
                
            </tr>
        </table>
        <input type="hidden" id="materials" name="materials" value="0">
        <button type="button" id="btnAdd"  class="btn btn-sm btn-dark">
            Add
        </button>                     --}}
                    

        <!--/#material-->

        <!--quantity<>-->
        <div class="form-group row hidden">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label hidden">{{ cleanLang(__('lang.rfm_quantity')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="hidden"  name="rfm_quantity" id="rfm_quantity" class="form-control form-control-sm" value="{{ $rfm->quantity ?? ''}}" >
            </div>
        </div>
        <!--/#quantity-->

        <!--available stock<>-->
        <div class="form-group row hidden">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label hidden">{{ cleanLang(__('lang.rfm_stock')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="hidden" name="rfm_available_stock" id="rfm_available_stock" class="form-control form-control-sm" value="{{$rfm->available_stock ?? ''}}" >
            </div>
        </div>
        <!--/#available stock-->
        <!--due date <>-->
        <div class="form-group row hidden">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label hidden">Due Date</label>
            <div class="col-sm-12 col-lg-9">
                <input type="hidden" class="form-control form-control-sm pickadate" name="rfm_due_date" autocomplete="off" value="{{ runtimeDatepickerDate($rfm->due_date ?? '') }}">
                <input class="mysql-date" type="hidden" name="rfm_due_date" id="rfm_due_date" value="{{ $rfm->due_date ?? ''}}">
            </div>
        </div>

        {{-- <input type="hidden" name="send_to_admin" value="send_to_admin"> --}}
        <!--/# due date-->
        <!--pass source-->
        <input type="hidden" name="source" value="{{ request('source') }}">

        </div>

    </div>
</div>
