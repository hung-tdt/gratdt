    <!-- Mainly scripts -->  
    @if(Route::currentRouteName() != 'admin')
        <script src="/admin/admin/js/jquery-3.1.1.min.js"></script>
    @endif
    
    {{-- <script src="/admin/admin/js/jquery-3.1.1.min.js"></script> --}}

    <script src="/admin/admin/js/bootstrap.min.js"></script>
    <script src="/admin/admin/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/admin/admin/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="/admin/admin/js/inspinia.js"></script>
    <script src="/admin/admin/js/plugins/pace/pace.min.js"></script>
    <script src="/admin/admin/js/plugins/footable/footable.all.min.js"></script>

    <!-- SUMMERNOTE -->
    <script src="/admin/admin/js/plugins/summernote/summernote.min.js"></script>
    
    <!-- iCheck -->
    <script src="/admin/admin/js/plugins/iCheck/icheck.min.js"></script>
    <script src="/admin/js/main.js"></script>

    <script>
        $(document).ready(function(){

            $('.summernote').summernote();
            $('.footable').footable();

       });
    </script>

    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>

@yield('footer')