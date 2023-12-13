<script src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/moment.js') }}"></script>
<script src="{{ URL::asset('assets/vendor/slimscroll/slimscroll.min.js') }}"></script>
<script src="{{ URL::asset('assets/vendor/slimscroll/custom-scrollbar.js') }}"></script>
<script src="{{ URL::asset('assets/vendor/daterange/daterange.js') }}"></script>
<script src="{{ URL::asset('assets/vendor/daterange/custom-daterange.js') }}"></script>
<script src="{{ URL::asset('assets/js/main.js') }}"></script>
<script src="{{ URL::asset('assets/js/html2canvas.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.message').delay(2500).slideUp();
    });
    $(document).ready(function() {
        $('#customModal').on('hidden.bs.modal', function(e) {
            $('.modal-body p').val('');
        });
    });
</script>
@stack('js')
