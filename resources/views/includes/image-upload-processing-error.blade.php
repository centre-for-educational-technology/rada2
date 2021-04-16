@if (Session::has('image_upload_processing_error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="mdi mdi-image-broken" aria-hidden="true"></i>
        {{ Session::get('image_upload_processing_error') }}
    </div>
@endif