<div class="row" id="js-careersapply-modal-add-edit" data-section="{{ $page['section'] }}">
    <div class="col-lg-12">

        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />

        <!--title<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('lang.title')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="careerapply_title" name="careerapply_title"
                     value="{{ $careerapply->title ?? '' }}">
            </div>
        </div>
        <!--/#title-->

        <!--experience<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('Experience')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="careerapply_experience" name="careerapply_experience"
                     value="{{ $careerapply->experience ?? '' }}">
            </div>
        </div>
        <!--/#experience-->


        <?php 
                  $cats = [
                    'ACCOUNTING',
                    'ADMINISTRATION',
                    'CIVIL',
                    'CLEANING',
                    'DISINFECTION',
                    'ELECTRICAL' ,
                    'ELECTRO-MECHANICAL',
                    'ELEVATORS',
                    'ESCALATORS',
                    'FACILITY MANAGEMENT',
                    'FINANCE',
                    'FIRE ALARM',
                    'FIRE FIGHTING',
                    'HOSPITALITY',
                    'HVAC',
                    'INSURANCE',
                    'IT',
                    'JOINERY',
                    'LOGISTICS',
                    'MAINTENANCE',
                    'MANAGEMENT',
                    'MARKETING',
                    'MECHANICAL' ,
                    'OPERATIONS',
                    'OTHERS',
                    'PEST CONTROL',
                    'PROCUREMENT',
                    'PROPERTY MANAGEMENT',
                    'PUBLIC RELATION',
                    'QUALITY CONTROL',
                    'QUANTITY SURVEY',
                    'SALES',
                    'TRANSPORTATION'
    ];
        ?>
        <!--category<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('lang.category')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                     
                        <select class="select2-basic form-control form-control-sm" name="careerapply_category" id="careerapply_category" data-allow-clear="false" >   
                            
                        {{-- if --}}
                        @if (isset($careerapply->category))
                            
                        @foreach($cats as $item)
                        <option value="{{ $item }}" {{$careerapply->category == $item ? 'selected' : ''}}>
                            {{$item }}
                        </option>
                        @endforeach

                        {{-- else --}}
                        @else

                        @foreach($cats as $item)
                        <option value="{{ $item }}" >
                            {{$item }}
                        </option>
                        @endforeach
                        {{-- end if --}}
                        @endif
                
                </select>
            </div>
        </div>
        <!--/#category-->

        <!--salary<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('Salary')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="careerapply_salary" name="careerapply_salary"
                     value="{{ $careerapply->salary ?? '' }}">
            </div>
        </div>
        <!--/#salary-->

        <!--category<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('lang.category')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                     
                        <select class="select2-basic form-control form-control-sm" name="careerapply_status" id="careerapply_status" data-allow-clear="false" >   
                            
                        <option value="{{'OPEN'}}" {{runtimePreselected( $careerapply->status ?? '' , 'OPEN' )}}>
                            OPEN
                        </option>

                        <option value="{{'CLOSED'}}" {{runtimePreselected( $careerapply->status ?? '' , 'CLOSED' )}}>
                            CLOSED
                        </option>
                        
                </select>
            </div>
        </div>
        <!--/#category-->
    
            <!--pass source-->
            <input type="hidden" name="source" value="{{ request('source') }}">

        </div>

    </div>
</div>
