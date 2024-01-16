<div class="modal fade" id="modalEliminar">
    <div class="modal-dialog modal-dialog-centered text-center" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header py-2 bg-danger-transparent">
                <h4 class="m-0">
                    <i class="fe fe-alert-triangle"></i>&nbsp;<span class="modal-title"><!-- Message Titulo --></span>
                </h4>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="modal-text">&nbsp;<!-- Message Text --></p>
            </div>
            <div class="modal-footer py-2">
                <form id="formDelete" method="POST">
                    @csrf @method('DELETE')
                    @if (isset($sourceRoute))
                        <input type="hidden" name="route" value="{{ $sourceRoute }}">
                    @endif
                    <button type="submit" class="btn btn-sm btn-outline-danger text-uppercase">{{ trans('messages.Delete') }}</button>
                </form>
                <button class="btn btn-sm btn-outline-default text-uppercase" data-bs-dismiss="modal">{{ trans('messages.Cancel') }}</button>
            </div>
        </div>
    </div>
</div>
