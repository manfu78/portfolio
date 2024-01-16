<script>
    $('#modal_notify').appendTo("body");
    $('#modal_notify').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var title = button.data('title');
        var text = button.data('text');
        var date = button.data('date');
        var route = button.data('route');
        var action = button.data('action');
        var modal = $(this);
        modal.find('.notify-modal-title').text(title);
        modal.find('.notify-modal-date').text(date);
        modal.find('.notify-modal-text').text(text);
        $('#formMarkAsRead').attr('action',action)
        if(route){
            modal.find('.notify-modal-route').html('<i class="fa-solid fa-link"></i> {{ trans('messages.File') }}');
            modal.find('.notify-modal-route').attr('href', route);
        }
    });
</script>
