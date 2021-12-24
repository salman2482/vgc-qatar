<script src="{{ asset('public/fv/assets/libs/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ asset('public/fv/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<!-- apps -->
<script src="{{ asset('public/fv/dist/js/app.min.js') }}"></script>
<script src="{{ asset('public/fv/dist/js/app.init.js') }}"></script>
<script src="{{ asset('public/fv/dist/js/app-style-switcher.js') }}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{ asset('public/fv/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('public/fv/assets/extra-libs/sparkline/sparkline.js') }}"></script>
<!--Wave Effects -->
<script src="{{ asset('public/fv/dist/js/waves.js') }}"></script>
<!--Menu sidebar -->
<script src="{{ asset('public/fv/dist/js/sidebarmenu.js') }}"></script>
<!--Custom JavaScript -->
<script src="{{ asset('public/fv/dist/js/feather.min.js') }}"></script>
<script src="{{ asset('public/fv/dist/js/custom.min.js') }}"></script>

@yield('scripts')
<script>
  // trustech
    $(document).ready(function() {
    $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
  });
});
</script>