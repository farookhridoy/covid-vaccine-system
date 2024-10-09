<!--jquery -->
<script src="{{asset('assets')}}/Jquery/jquery-3.6.1.min.js"></script>
<!--bootstrap-js-->
<script src="{{asset('assets/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('assets/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/wnoty/wnoty.js') }}"></script>

@if(session()->has('message'))
    <script type="text/javascript">
        $(document).ready(function () {
            notify('{{session()->get('message')}}', '{{session()->get('alert-type')}}');
        });
    </script>
@endif

@if($errors->any())
    <script type="text/javascript">
        $(document).ready(function () {
            var errors =<?php echo json_encode($errors->all()); ?>;
            $.each(errors, function (index, val) {
                notify(val, 'danger');
            });
        });
    </script>
@endif

<script type="text/javascript">
    $(document).ready(function () {
        $(".select2").each(function () {
            $(this).select2({
                dropdownParent: $(this).parent()
            });
        });

        $(".select2bs4").each(function () {
            $(this).select2({
                theme: "bootstrap4",
                dropdownParent: $(this).parent()
            });
        });

        $(".select2bs4-tags").each(function () {
            $(this).select2({
                tags: true,
                theme: "bootstrap4",
                dropdownParent: $(this).parent()
            });
        });
    });

    function notify(message, type) {
        $.wnoty({
            message: '<strong class="text-' + (type) + '">' + (message) + '</strong>',
            type: type,
            autohideDelay: 3000
        });
    }

    function openLink(link, type = '_parent') {
        window.open(link, type);
    }

</script>
