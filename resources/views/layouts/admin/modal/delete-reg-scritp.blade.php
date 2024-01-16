<script>
    $('#modalEliminar').appendTo("body");
    $('#modalEliminar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var name = button.data('name')
        var action = button.data('action')
        var route = button.data('route')
        action = route
        $('#formDelete').attr('action',action)
        //console.log(action)
        var modal = $(this)
        modal.find('.modal-title').text('Atención!!')
        modal.find('.modal-text').text('El registro ' + ' correspondiente a "' + name + '" se eliminará.')
    });
</script>
