<div class="row" id="js-vendorinvoices-modal-add-edit" data-section="{{ $page['section'] }}">
    <div class="col-lg-12">
        
        <!--status<>-->
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('status')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                    @php    
                    $reqs = [
                        'Received For Authentication',
                        'Request For Amendment',
                        'Approved',
                        'Ready For collection',
                        
                    ];
            @endphp
        
            <select name="vendorinvoice_status" id="vendorinvoice_status" class="select2-basic form-control form-control-sm">
                {{-- <option>Select Status</option> --}}
                @foreach ($reqs as $req)
                
                <?php if(isset($vendorinvoice->status)) { ?>
                <option value="{{$req}}"  {{$vendorinvoice->status == $req ? 'selected' : ''}} > 
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

        <!--reason<>-->
        <div class="form-group row" id="vendorinvoice_reason">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('Reason')) }}</label>
            <div class="col-sm-12 col-lg-9">
                <textarea class="form-control form-control-sm" id="vendorinvoice_reason" name="vendorinvoice_reason" cols="20" rows="8">{{ $vendorinvoice->reason ?? '' }}</textarea>
            </div>
        </div>
        <!--/#uom--> 
        
       


    </div>


    <!--redirect to vendorinvoice-->
    @if (config('visibility.vendorinvoice_show_vendorinvoice_option'))
        <div class="form-group form-group-checkbox row">
            <div class="col-12 text-left p-t-5">
                <input type="checkbox" id="show_after_adding" name="vendorinvoice_show_after_adding"
                    class="filled-in chk-col-light-blue" checked="checked">
                <label for="show_after_adding">{{ cleanLang(__('lang.show_vendorinvoice_after_its_created')) }}</label>
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

<script>
$(function() {
    if($('#vendorinvoice_status').val() == 'Request For Amendment') {
            $('#vendorinvoice_reason').show(); 
        } else {
            $('#vendorinvoice_reason').hide(); 
        }

    $('#vendorinvoice_status').change(function(){

        if($('#vendorinvoice_status').val() == 'Request For Amendment') {
            $('#vendorinvoice_reason').show(); 
        } else {
            $('#vendorinvoice_reason').hide(); 
        } 
    });
});

</script>

@if (isset($page['section']) && $page['section'] == 'edit')
    <!--dynamic inline - set dynamic vendorinvoice progress-->
    <script>
        NX.varInitialvendorinvoiceProgress = "{{ $vendorinvoice['vendorinvoice_progress'] }}";

    </script>
@endif


