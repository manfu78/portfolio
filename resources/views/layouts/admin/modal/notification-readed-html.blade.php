<div class="modal fade" id="modal_notify_readed">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header py-2 bg-primary-transparent">
                <h4 class="m-0">
                    <i class="fa-regular fa-bell"></i>&nbsp;{{ trans('messages.Notification.Notification') }}
                </h4>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4 pb-5">
                <div class="example p-2">
                    <p>
                        <span class="fw-semibold notify-modal-date">
                            <!-- Message Date -->
                        </span>
                        <br>
                        <span class="fw-bold notify-modal-title">
                            <!-- Message Title -->
                        </span>
                        <br>
                        <span class="notify-modal-text">
                            <!-- Message Text -->
                        </span>
                    </p>
                    <small>
                    <a href="#" class="notify-modal-route" target="_blank">
                        <!-- Message Route -->
                    </a></small>
                </div>
                <div class="text-end mt-3">
                    <button type="button" class="btn btn-sm btn-outline-default" data-bs-dismiss="modal">{{ trans('messages.Close') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
