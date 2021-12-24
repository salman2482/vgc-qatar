<div class="row">
    <div class="col-lg-12">

        

        @if(isset($page['section']) && $page['section'] == 'edit' && auth()->user()->is_team)
        <div class="form-group row">
            <label for="example-month-input" class="col-sm-12 col-lg-3 col-form-label text-left">{{ cleanLang(__('lang.status')) }}</label>
            <div class="col-sm-12 col-lg-9">
                <select class="select2-basic form-control form-control-sm" id="status" name="status">
                    <option></option>
                    <option value="active" {{ runtimePreselected($user->status ?? '', 'active') }}>{{ cleanLang(__('lang.active')) }}</option>
                    <option value="suspended" {{ runtimePreselected($user->status ?? '', 'suspended') }}>{{ cleanLang(__('lang.suspended')) }}
                    </option>
                    <option value="unverified" {{ runtimePreselected($user->status ?? '', 'unverified') }}>{{ cleanLang(__('Not Verified')) }}
                    </option>
                </select>
            </div>
        </div>
        <div class="line"></div>
        @endif
        

        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.first_name')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="first_name" name="first_name"
                    value="{{ $user->first_name ?? '' }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.last_name')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="last_name" name="last_name"
                    value="{{ $user->last_name ?? '' }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.email_address')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="email" name="email"
                    value="{{ $user->email ?? '' }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label">{{ cleanLang(__('lang.telephone')) }}</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="phone" name="phone"
                    value="{{ $user->phone ?? '' }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label">{{ cleanLang(__('lang.position')) }}</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="position" name="position"
                    value="{{ $user->position ?? '' }}">
            </div>
        </div>

        {{-- vendor_company_name --}}
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label">{{ cleanLang(__('Company Name')) }}</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="vendor_company_name" name="vendor_company_name"
                    value="{{ $user->fvendor->vendor_company_name ?? '' }}">
            </div>
        </div>

        {{-- commercial_registration_no --}}
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label">{{ cleanLang(__('Commercial Registration Number')) }}</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="commercial_registration_no" name="commercial_registration_no"
                    value="{{ $user->fvendor->commercial_registration_no ?? '' }}">
            </div>
        </div>

        {{-- trade_license_no --}}
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label">{{ cleanLang(__('Trade License No')) }}</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="trade_license_no" name="trade_license_no"
                    value="{{ $user->fvendor->trade_license_no ?? '' }}">
            </div>
        </div>

        {{-- office_telephone_no --}}
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label">{{ cleanLang(__('Office Telephone No')) }}</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="office_telephone_no" name="office_telephone_no"
                    value="{{ $user->fvendor->office_telephone_no ?? '' }}">
            </div>
        </div>

        {{-- address --}}
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label">{{ cleanLang(__('lang.address')) }}</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="address" name="address"
                    value="{{ $user->fvendor->address ?? '' }}">
            </div>
        </div>

        {{-- po_box --}}
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label">{{ cleanLang(__('Po Box')) }}</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="po_box" name="po_box"
                    value="{{ $user->fvendor->po_box ?? '' }}">
            </div>
        </div>

        {{-- company_association --}}
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label">{{ cleanLang(__('Company Association')) }}</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="company_association" name="company_association"
                    value="{{ $user->fvendor->company_association ? 'Yes' : 'No' }}">
            </div>
        </div>

        {{--  learn_about_compnay --}}
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label">{{ cleanLang(__('Learn About Compnay')) }}</label>
            <div class="col-sm-12 col-lg-9">
                <textarea cols="30" rows="10" type="text" class="form-control form-control-sm" id="learn_about_compnay" name="learn_about_compnay">{{ $user->fvendor->learn_about_compnay ?? '' }}</textarea>
            </div>
        </div>


        {{--  company_profile --}}
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label">
                {{ "Company Profile" }}</label>
            <div class="col-sm-12 col-lg-9">
                @if($user->fvendor->company_profile != null)
                <a 
                    href="{{asset('storage/public/vendor/'.$user->fvendor->company_profile)}}" 
                    download 
                    class="form-control"
                > 
                    Download 
                    <i class="fa fa-download"></i> 
                </a>
                
                @else
                    <p class="form-control">Not Available</p>
                @endif
            </div>
        </div>

        {{--  company_commercial_license --}}
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label">
                {{ "Commercial License" }}</label>
            <div class="col-sm-12 col-lg-9">
                @if($user->fvendor->company_commercial_license != null)
                <a 
                    href="{{asset('storage/public/vendor/'.$user->fvendor->company_commercial_license)}}" 
                    download 
                    class="form-control"
                > 
                    Download 
                    <i class="fa fa-download"></i> 
                </a>
                
                @else
                    <p class="form-control">Not Available</p>
                @endif
            </div>
        </div>

        {{--  other_documents --}}
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label">
                {{ "Other Documents" }}</label>
            <div class="col-sm-12 col-lg-9">
                @if($user->fvendor->other_documents != null)
                <a 
                    href="{{asset('storage/public/vendor/'.$user->fvendor->other_documents)}}" 
                    download 
                    class="form-control"
                > 
                    Download 
                    <i class="fa fa-download"></i> 
                </a>
                
                @else
                    <p class="form-control">Not Available</p>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label">{{ cleanLang(__('Categories')) }}</label>
              <div class="col-sm-12 col-lg-9"> 
                    {{-- <textarea name="cats" readonly class="form-control form-control-sm" cols="30" rows="10">{{ $user->fvendor->category ?? '' }}</textarea> --}}
                    @php $cats= explode(',',$user->fvendor->category) @endphp
                    <div class="row">
                    
                        @foreach ($cats as $item)
                        <div class="col-md-6">
                            
                            <span style="font-size: 11px; line-height: 15px; color: darkblue;" class="mt-1 label {{ runtimeCategoryStatusLabel('active') }}">
                                {{$item ?? '' }}
                            </span>    
                        </div>
                    
                        @endforeach
                </div>
            </div>
        </div>

        <!--[UPCOMING] change account owner-->
        @if(config('visibility.vusers_modal_account_owner'))
        <div class="form-group form-group-checkbox row hidden">
            <label class="col-sm-12 col-lg-3 col-form-label text-left">{{ cleanLang(__('lang.account_owner')) }}?</label>
            <div class="col-6 text-left p-t-5">
                <input type="checkbox" id="account_owner" name="account_owner" class="filled-in chk-col-light-blue"
                    {{ runtimeAccountOwnerDisabled($user['account_owner'] ?? '') }}
                    {{ runtimeAccountOwnerCheckbox($user['account_owner'] ?? '') }}>
                <label for="account_owner"></label>
            </div>
        </div>
        @endif

        @if(isset($page['section']) && $page['section'] == 'edit')
       
        @endif

        <!--pass source-->
        <input type="hidden" name="source" value="{{ request('source') }}">

        <!--notes-->
        <div class="row">
            <div class="col-12">
                <div><small><strong>* {{ cleanLang(__('lang.required')) }}</strong></small></div>
            </div>
        </div>
    </div>
</div>