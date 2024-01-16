<script>
    $('#modal_notify_readed').appendTo("body");
    $('#modal_notify_readed').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var title = button.data('title');
        var text = button.data('text');
        var date = button.data('date');
        var route = button.data('route');
        var modal = $(this);
        modal.find('.notify-modal-title').text(title);
        modal.find('.notify-modal-date').text(date);
        modal.find('.notify-modal-text').text(text);
        if(route){
            modal.find('.notify-modal-route').html('<i class="fa-solid fa-link"></i> {{ trans('messages.File') }}');
            modal.find('.notify-modal-route').attr('href', route);
        }
    });
</script>
