<div class="modal fade" id="modal_notify">
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
                    <form id="formMarkAsRead" name="formMarkAsRead" method="get" class="notify-modal-form">
                        @csrf
                        <input type="hidden" name="ubi" value="{{ base64_encode(request()->route()->getName()) }}">
                        <button type="submit" class="btn btn-sm btn-primary">{{ __('Mark as read') }}</button>
                        <button type="button" class="btn btn-sm btn-outline-default" data-bs-dismiss="modal">{{ trans('messages.Close') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
