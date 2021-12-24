@extends('layouts.main')
@push('styles')
<!-- Select2 -->
<link rel="stylesheet" href="{!! asset('assets/admin/plugins/select2/css/select2.min.css') !!}">
<link rel="stylesheet" href="{!! asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}">
<link rel="stylesheet" href="{!! asset('assets/admin/plugins/fontawesome-free/css/all.min.css') !!}">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{!! asset('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') !!}">
<!-- Bootstrap Color Picker -->
<!-- Tempusdominus Bbootstrap 4 -->
<link rel="stylesheet" href="{!! asset('assets/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') !!}">
<!-- Select2 -->
<link rel="stylesheet" href="{!! asset('assets/admin/plugins/select2/css/select2.min.css') !!}">
<link rel="stylesheet" href="{!! asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}">
<!-- Theme style -->
<link rel="stylesheet" href="{!! asset('assets/dist/css/adminlte.min.css') !!}">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<style>
    #sortable { list-style-type: none; margin: 0; padding: 0; width: 100%; }
    #sortable li { margin: 0px; padding: 0px; padding:0px;margin-bottom: 10px; font-size: 1.4em; /*height: 18px;*/ }
    #sortable li span { /*position: absolute;*//* margin-left: -1.3em;*/ }
</style>
<style>
    .plan-drill-item {
    list-style: none;
    font-weight: 700;
    color: #fff;
    width: 100%;
    padding: 0;
    margin-bottom: 1px
    }
    .plan-drill-item-inner {
    background: #434343;
    border: 1px solid #000;
    display: flex;
    align-items: center;
    padding: .25rem .5rem;
    }
    .c-spn-handles {
    cursor: move;
    font-size: 12px;
    margin-right: .5rem;
    }
    .c-txt-drill-timing {
    display: inline-block;
    margin-top: 0;
    margin-right: .5rem;
    margin-left: 0;
    height: 25px;
    width: 35px;
    padding: 0 7px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #ccc;
    background-color: #555;
    background-image: none;
    border: 1px solid #333;
    text-align: center;
    }
    .plan-drill-item-inner h4 {
    color: #fff;
    margin: 0;
    padding: 7px;
    font-size: 15px;
    font-weight: 700;
    flex-grow: 1;
    }
    /*.c-spn-handles {
    display: flex;
    }*/
    .plan-drill-actions {
    display: flex;
    align-items: center;
    }
    .plan-toggle {
    cursor: pointer;
    padding: 0;
    background: #555;
    color: #fff;
    font-size: 1rem;
    margin: 0 0 0 .5rem;
    border: 1px solid #333;
    border-radius: 14px;
    height: 28px;
    width: 28px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    }
    .c-spn-remove-drill {
    cursor: pointer;
    padding: 0;
    background: #555;
    color: #fff;
    font-size: 1rem;
    margin: 0 0 0 .5rem;
    border: 1px solid #333;
    border-radius: 14px;
    height: 28px;
    width: 28px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    }
    .c-div-expand-collapse {
    font-size: 12px;
    margin-bottom: 14px;
    text-align: center;
    color: #434343;
    }
    .c-div-expand-collapse a:not([href]) {
    color: #1969a5;
    font-weight: 700;
    font-size: 16px;
    cursor: pointer;
    }
    .c-div-drill {
    min-height: 20px;
    background-color: red;
    margin-top: 12px;
    display: none;
    }
    .minslabel {
    margin-right: 20px;
    }
</style>
@endpush
<div class="row">
    <div class="col-md-12">
        <div class="c-div-expand-collapse">
            <a id="c-a-expand-all">EXPAND</a> | 
            <a id="c-a-collapse-all">COLLAPSE</a>
        </div>
        <ul id="sortable">
            @php /*
            <li class="ui-state-default plan-drill-item">
                <div class="plan-drill-item-inner">
                    <span class="c-spn-handles">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                    </span>
                    <input type="text" class="form-control c-txt-drill-timing drill_count" value="3">
                    <h4>qwed</h4>
                    <div class="plan-drill-actions">
                        <p class="plan-toggle" title="Expand / Collapse">
                            <span class="fas fa-chevron-down"></span>
                        </p>
                        <p class="c-spn-remove-drill">
                            <span class="fas fa-times"></span>
                        </p>
                    </div>
                </div>
                <div class="c-div-drill hide-me">
                </div>
            </li>
            */ @endphp                                                                      
        </ul>
    </div>
</div>
@push('scripts')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $( function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
} );
</script>
<!-- Select2 -->
<script src="{!! asset('assets/admin/plugins/select2/js/select2.full.min.js') !!}"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/prashantchaudhary/ddslick/master/jquery.ddslick.min.js" ></script>
<!-- Select2 -->
<script src="{!! asset('assets/admin/plugins/select2/js/select2.full.min.js') !!}"></script>
<!-- Bootstrap 4 -->
<script src="{!! asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
<!-- Summernote -->
<script src="{!! asset('assets/admin/plugins/summernote/summernote-bs4.min.js') !!}"></script>sss
<!--athira-->
<!-- jQuery -->
<!-- <script src="{!! asset('assets/admin/plugins/jquery/jquery.min.js') !!}"></script> -->
<!-- Bootstrap 4 -->
<script src="{!! asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
<!-- Select2 -->
<script src="{!! asset('assets/admin/plugins/select2/js/select2.full.min.js') !!}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{!! asset('assets/admin/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') !!}"></script>
<!-- InputMask -->
<script src="{!! asset('assets/admin/plugins/moment/moment.min.js') !!}"></script>
<script src="{!! asset('assets/admin/plugins/inputmask/min/jquery.inputmask.bundle.min.js') !!}"></script>
<!-- date-range-picker -->
<script src="{!! asset('assets/admin/plugins/daterangepicker/daterangepicker.js') !!}"></script>
<!-- bootstrap color picker -->
<script src="{!! asset('assets/admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') !!}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{!! asset('assets/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') !!}"></script>
<!-- Bootstrap Switch -->
<script src="{!! asset('assets/admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js') !!}"></script>
<script src="{!! asset('assets/admin/dist/js/adminlte.min.js') !!}"></script>
<script src="{!! asset('assets/admin/dist/js/demo.js') !!}"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<!-- Page script -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
<script>
$(function () {
    $('.select2').select2()
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
})
</script>
<script>
    i = 0; // you can assign unique name to each textbox using this i
    $( document ).ready(function() {
    var total=0;
      $("#add").click(function() {
            var quicknote = $("#quicknote_dummy").val();
            quicknote = quicknote.trim();
            if(quicknote.length === 0) {
                alert("Enter Name For Quick Drill");
            }
            else {
                var qmins=+document.getElementById('quicknotemin_dummy').value;
                total+=qmins;
                $("#sortable").append('<li id="quick'+i+'" class="ui-state-default plan-drill-item"><div class="plan-drill-item-inner"> <span class="c-spn-handles"><i class="fa fa-bars" aria-hidden="true"></i></span><input style="width:60px" type="number" class="form-control c-txt-drill-timing drill_count" value="'+qmins+'" onchange="findtotalmins()"><h4>'+document.getElementById('quicknote_dummy').value+'</h4><div class="plan-drill-actions"><p class="c-spn-remove-drill"><span class="fas fa-times"></span></p></div></div></li>');
                i++;
                findtotalmins();
            }
        })
    });
</script>
<script>
function findtotalmins() {
    var totalminscount = 0;
    $(".c-txt-drill-timing").each(function(){
        totalminscount += +$(this).val();
    });
    $('.minslabel').empty();
    $('.minslabel').text(totalminscount+ ' Mins  ');
}
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).on('click','.plan-toggle .fa-chevron-down', function(e){
    $(this).parent().parent().parent().parent().find('.c-div-drill').css('display','block');
    //$(this).parent().empty();
    $(this).parent().append('<span class="fas fa-chevron-up"></span>');
    $(this).remove();
    });
    $(document).on('click','.plan-toggle .fa-chevron-up', function(e) {
    $(this).parent().parent().parent().parent().find('.c-div-drill').css('display','none');
    //$(this).parent().empty();
    $(this).parent().append('<span class="fas fa-chevron-down"></span>');
    $(this).remove();
    });
    $(document).on('click','.c-spn-remove-drill .fa-times', function(e) {
    $(this).parent().parent().parent().parent().remove();
    findtotalmins();
    });
    $('#c-a-expand-all').click(function(){
    $('.c-div-drill').css('display','block');
    $('.plan-toggle').empty();
    $('.plan-toggle').append('<span class="fas fa-chevron-up"></span>');
    })
    $('#c-a-collapse-all').click(function(){
    $('.c-div-drill').css('display','none');
    $('.plan-toggle').empty();
    $('.plan-toggle').append('<span class="fas fa-chevron-down"></span>');
    })
</script>
@endpush
@endsection