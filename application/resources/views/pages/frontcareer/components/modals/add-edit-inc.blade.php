<div class="row" id="js-frontcareers-modal-add-edit" data-section="{{ $page['section'] }}">
    <div class="col-lg-12">

        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />

        <!--title<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('lang.title')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="frontcareer_title" name="frontcareer_title"
                     value="{{ $frontcareer->title ?? '' }}">
            </div>
        </div>
        <!--/#title-->

        <!--experience<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('Experience')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="frontcareer_experience" name="frontcareer_experience"
                     value="{{ $frontcareer->experience ?? '' }}">
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
                     
                        <select class="select2-basic form-control form-control-sm" name="frontcareer_category" id="frontcareer_category" data-allow-clear="false" >   
                            
                        {{-- if --}}
                        @if (isset($frontcareer->category))
                            
                        @foreach($cats as $item)
                        <option value="{{ $item }}" {{$frontcareer->category == $item ? 'selected' : ''}}>
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
                <input type="text" class="form-control form-control-sm" id="frontcareer_salary" name="frontcareer_salary"
                     value="{{ $frontcareer->salary ?? '' }}">
            </div>
        </div>
        <!--/#salary-->

        <!--position<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('Position Applied For')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="frontcareer_position" name="frontcareer_position"
                     value="{{ $frontcareer->position ?? '' }}">
            </div>
        </div>
        <!--/#position-->

        <!--Status<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('Status')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                     
                        <select class="select2-basic form-control form-control-sm" name="frontcareer_status" id="frontcareer_status" data-allow-clear="false" >   
                            
                        <option value="{{'OPEN'}}" {{runtimePreselected( $frontcareer->status ?? '' , 'OPEN' )}}>
                            OPEN
                        </option>

                        <option value="{{'CLOSED'}}" {{runtimePreselected( $frontcareer->status ?? '' , 'CLOSED' )}}>
                            CLOSED
                        </option>
                        
                </select>
            </div>
        </div>
        <!--/#Status-->
    
            <!--pass source-->
            <input type="hidden" name="source" value="{{ request('source') }}">

        </div>

    </div>
</div>
