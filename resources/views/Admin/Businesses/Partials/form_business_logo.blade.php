<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-2">
                @if (isset($business))
                    @if ($business->logo)
                        <img id="business-img" src="{{ Storage::url($business->logo) }}" class="img-responsive br-5" style="height: 110px;object-fit: contain;">
                    @else
                        <img id="business-img" src="/assets/images/nophoto.jpeg" class="img-responsive br-5" style="height: 110px;object-fit: contain;">
                    @endif
                @else
                    <img id="business-img" src="/assets/images/nophoto.jpeg" class="img-responsive br-5" style="height: 110px;object-fit: contain;">
                @endif
            </div>
            <div class="col-10">
                <div class="form-group">
                    <label for="logo" class="form-label mt-0">{{ trans('messages.ChangeImage') }}</label>
                    <input id='logo' name="logo" class="form-control" type="file" accept="image/png, image/jpeg">
                </div>
                @if (isset($business)&&$business->logo)
                    <a href="{{ route('admin.businesses.deleteLogo',$business) }}"><small class="text-danger"><i class="fa-solid fa-trash-can"></i>&nbsp;{{ trans('messages.DeleteImage') }}</small></a>
                @endif

            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-sm btn-outline-primary text-uppercase"><i class="fa fa-save"></i>&nbsp;&nbsp;{{ trans('messages.Save') }}</button>
            </div>
        </div>
    </div>
</div>
