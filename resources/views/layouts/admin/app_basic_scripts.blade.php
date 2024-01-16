<script>
    (function() {
        @if (session('info'))
            return $.growl.notice({
                title: '<i class="fa-solid fa-circle-info"></i>&nbsp;&nbsp;Info',
                message: "{{ session('info') }}"
            });
        @endif

        @if (session('error'))
            return $.growl.error1({
                title: '<i class="fa-solid fa-triangle-exclamation"></i>&nbsp;&nbsp;Error',
                message: '<i class="fas fa-hand-point-right"></i>&nbsp;{{ session("error") }}'
            });
        @endif

        @if (session('warning'))
            return $.growl.warning1({
                title: '<i class="fa-solid fa-triangle-exclamation"></i>&nbsp;&nbsp;Info',
                message: '<i class="fas fa-hand-point-right"></i>&nbsp;{{ session("warning") }}'
            });
        @endif

        @if ($errors->any())
            return $.growl.error1({
                title: '<i class="fa-solid fa-triangle-exclamation"></i>&nbsp;&nbsp;Error',
                message: '@foreach ($errors->all() as $error) <i class="fas fa-hand-point-right"></i>&nbsp;&nbsp;{{$error}}<br> @endforeach'
            });
        @endif
    }).call(this);
</script>
<script>
    $(document).ready(function() {
        $('form').submit(function() {
            $(this).find(':button[type=submit]').prop('disabled', true);
        });
    });
</script>
<script>
    $(function () {
        $('[data-toggle-glob="tooltip"]').tooltip()
    });
</script>

@include('layouts.admin.modal.notification-scritp')
@include('layouts.admin.modal.notification-readed-scritp')
