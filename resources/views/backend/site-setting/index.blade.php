@extends('backend.layouts.main')

@section('title')
    Site Setting
@endsection

@section('main-content')
    <style>
        #img_banner_homepage {
            border-radius: 0 !important;
            /* width: 300px !important;
                                                    height: 300px !important; */
        }

        .homepagebanner {
            width: 250px !important;
        }
    </style>
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <div>
            <h4 class="mb-0">Site Setting</h4>
            <p class="mb-0 text-muted">Site Setting.</p>
        </div>
    </div>
    <!-- End Page Header -->

    <!-- row -->
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.sitesetting.update') }}" id="site-setting-form"
                enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group col-4">
                        <label for="inputEmail4">Organization Name <span class="required-field">*</span></label>
                        <input type="text" class="form-control mt-1" id="name" name="name"
                            value="{{ isset($siteSettings) ? $siteSettings['name'] : old('name') }}"
                            placeholder="Enter school name">
                    </div>
                    <div class="form-group col-4">
                        <label for="email">Email </label>
                        <input type="email" class="form-control mt-1" id="email" name="email"
                            value="{{ $siteSettings['email'] }}" placeholder="Enter email">
                    </div>
                    <div class="form-group col-4">
                        <label for="phone_number">Phone Number</label>
                        <input type="numper" class="form-control mt-1" id="phone_number" name="phone_number"
                            value="{{ $siteSettings['phone_number'] }}" placeholder="Enter phone number">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-4">
                        <label for="inputEmail4">Address <span class="required-field">*</span></label>
                        <input type="text" class="form-control mt-1" id="address" name="address"
                            value="{{ $siteSettings['address'] }}" placeholder="Enter address">
                    </div>
                    <div class="form-group col-4">
                        <label for="link_facebook">Facebook Link</label>
                        <input type="text" class="form-control mt-1" id="facebook" name="link_facebook"
                            value="{{ $siteSettings['link_facebook'] }}" placeholder="Enter facebook link">
                    </div>
                    <div class="form-group col-4">
                        <label for="link_instagram">Instagram Link</label>
                        <input type="text" class="form-control mt-1" id="instagram" name="link_instagram"
                            value="{{ $siteSettings['link_instagram'] }}" placeholder="Enter instagram link">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-4">
                        <label for="link_twitter">Twitter(X) Link</label>
                        <input type="text" class="form-control mt-1" id="twitter" name="link_twitter"
                            value="{{ $siteSettings['link_twitter'] }}" placeholder="Enter twitter link">
                    </div>
                    <div class="form-group col-8">
                        <label for="link_map">Map Link</label>
                        <textarea class="form-control mt-1" id="link_map" name="link_map" rows="2" placeholder="Enter google map link">{{ $siteSettings['link_map'] }}</textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-4">
                        <label for="homepage_title">Home Page Title</label>
                        <textarea class="form-control mt-1" id="homepage_title" name="homepage_title" rows="2"
                            placeholder="Eg:- Welcome To Chochangay Samaj Nepal">{{ $siteSettings['homepage_title'] }}</textarea>
                    </div>
                    <div class="form-group col-8">
                        <label for="hmaepage_description">HomePage Short Description</label>
                        <textarea class="form-control mt-1" id="hmaepage_description" name="hmaepage_description" rows="2"
                            placeholder="Eg Dream Of Every Chochangay Samaj Community">{{ $siteSettings['hmaepage_description'] }}</textarea>
                    </div>
                </div>


                <div class="row">
                    <div class="form-group col-4">
                        <div class="row">
                            <div class="form-group col-4">
                                <label for="img_banner_homepage">Home Page Banner Image </label>
                            </div>
                            <div class="form-group col-6">
                                <div class="main-profile-overview">
                                    {{-- <div class="img-rectangle"> --}}
                                    <div class="main-img-user profile-user user-profile homepagebanner">
                                        <label for="input_homepage_banner"
                                            class="fe fe-camera profile-edit text-primary"></label>
                                        <input type="file" id="input_homepage_banner" class="input_homepage_banner"
                                            style="position: absolute; clip: rect(0, 0, 0, 0); pointer-events: none;"
                                            accept="image/*" name="img_banner_homepage">
                                        <input type="hidden" class="form-control croppedImg" id="croppedImg"
                                            name="croppedImg">
                                        <input type="hidden" class="form-control croppedImgFavicon"
                                            id="croppedImgFavicon" name="croppedImgFavicon">
                                        @php
                                            $imagePath = 'setting/' . $siteSetting->img_banner_homepage;
                                        @endphp
                                        @if (!empty($siteSetting->img_banner_homepage) && Storage::exists('public/' . $imagePath))
                                            <img aorganizationlt=""
                                                src="{{ asset('/storage/setting') . '/' . $siteSettings['img_banner_homepage'] }}"
                                                alt="img" id="img_banner_homepage">
                                        @else
                                            <img src="{{ asset('/no-image.jpg') }}" alt="Default Image"
                                                id='img_banner_homepage' style="width: 90px">
                                        @endif

                                    </div>
                                </div>
                                <div class="row ms-1">
                                    <p class="p-0 m-0">Accepted Format :<span class="text-muted"> jpg/jpeg/png</span></p>
                                    <p class="p-0 m-0">File size :<span class="text-muted"> (300x475) in pixels</span></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-4">
                        <div class="row">
                            <div class="form-group col-4">
                                <label for="img_logo">Logo </label>
                            </div>
                            <div class="form-group col-6">
                                <div class="main-profile-overview">
                                    <div class="main-img-user profile-user user-profile">
                                        <label for="input_logo" class="fe fe-camera profile-edit text-primary"></label>
                                        <input type="file" id="input_logo" class="input_logo"
                                            style="position: absolute; clip: rect(0, 0, 0, 0); pointer-events: none;"
                                            accept="image/*" name="img_logo">
                                        <input type="hidden" class="form-control croppedImg" id="croppedImg"
                                            name="croppedImg">
                                        <input type="hidden" class="form-control croppedImgFavicon"
                                            id="croppedImgFavicon" name="croppedImgFavicon">
                                        @php
                                            $imagePath = 'setting/' . $siteSetting->img_logo;
                                        @endphp
                                        @if (!empty($siteSetting->img_logo) && Storage::exists('public/' . $imagePath))
                                            <img aorganizationlt=""
                                                src="{{ asset('/storage/setting') . '/' . $siteSettings['img_logo'] }}"
                                                alt="img" id="img_logo">
                                        @else
                                            <img src="{{ asset('/no-image.jpg') }}" alt="Default Image" id='img_logo'>
                                        @endif
                                    </div>
                                </div>
                                <div class="row ms-1">
                                    <p class="p-0 m-0">Accepted Format :<span class="text-muted"> jpg/jpeg/png</span></p>
                                    <p class="p-0 m-0">File size :<span class="text-muted"> (300x475) in pixels</span></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-4">
                        <div class="row">
                            <div class="form-group col-4">
                                <label for="img_favicon">Favicon</label>

                            </div>
                            <div class="form-group col-6">
                                <div class="main-profile-overview">
                                    <div class="main-img-user profile-user user-profile">
                                        <a>
                                            <label for="input_favicon"
                                                class="fe fe-camera profile-edit text-primary"></label>
                                            <input type="file" id="input_favicon" class="input_favicon"
                                                style="position: absolute; clip: rect(0, 0, 0, 0); pointer-events: none;"
                                                accept="image/*" name="img_favicon">
                                            @php
                                                $imagePath = 'setting/' . $siteSetting->img_favicon;
                                            @endphp
                                            @if (!empty($siteSetting->img_favicon) && Storage::exists('public/' . $imagePath))
                                                <img alt=""
                                                    src="{{ asset('/storage/setting') . '/' . $siteSettings['img_favicon'] }}"
                                                    alt="img" id="img_favicon">
                                            @else
                                                <img src="{{ asset('/no-image.jpg') }}" alt="Default Image"
                                                    id='img_favicon'>
                                            @endif
                                        </a>
                                    </div>
                                </div>
                                <div class="row ms-1">
                                    <p class="p-0 m-0">Accepted Format :<span class="text-muted"> jpg/jpeg/png</span></p>
                                    <p class="p-0 m-0">File size :<span class="text-muted"> (300x475) in pixels</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="button" class="btn btn-primary" id="save_site_setting"><i class="fa fa-save"></i>
                        Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- row close -->

    {{-- crop modal-start --}}

    {{-- <div class="modal cropModel fade" id="cropModel" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Crop Image</h5>
                    <button type="button" class="closeCrop" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-12">
                                <img id="image" src="#" style="height: 200px; width: 250px;">
                            </div>
                            <div class="col-md-12">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
                    <div id="controls">
                        <button id="rotateLeft">Rotate Left</button>
                        <button id="rotateRight">Rotate Right</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn_btn cancel_btn cancelCrop" id="cancelCrop">Cancel</button>
                    <button type="button" class="btn_btn submit_btn" id="cropImage">Crop</button>
                </div>
            </div>
        </div>
    </div> --}}



    <div class="modal cropModel fade" id="cropModel" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Image Crop & Rotate </h5>
                    <button type="button" class="close" aria-label="Close">
                        <span aria-hidden="true" class='closeButton'>×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-7">
                                <img id="image">
                            </div>
                            <div class="col-md-5">
                                <div class="row" id="side">
                                    {{-- <div class="col-md-12">
                            <div class="preview" id="crop-preview"></div>
                        </div> --}}
                                    <div class="col-md-6">
                                        <label>Width</label>
                                        <input type="text" class="form-control" id="image-width">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Height</label>
                                        <input type="text" class="form-control" id="image-height">
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <button class="btn btn-primary" id="rotateLeft" title="Rotate 45 deg. Left"><i
                                                class="fa fa-undo"></i></button>
                                        <button class="btn btn-primary" id="rotateRight" title="Rotate 45 deg. Right"><i
                                                class="fa fa-redo"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="cropImage"><i class="fa fa-edit"></i> Update
                        Image</button>
                </div>
            </div>
        </div>
    </div>




    {{-- crop modal-end --}}
@endsection

@section('script')
    {{-- crop image-start --}}
    <script>
        var cropper;
        $(document).ready(function() {

            //cancel Crop Model --Start
            $('.cancelCrop').off('click', '');
            $('.cancelCrop').on('click', function(e) {

                var logo = $('.input_logo')[0].files[0];
                $('#img_logo').attr('src', URL.createObjectURL(logo));
                $('#cropModel').modal('hide');
            });
            //close Model --End

            //to pass image url to crop model ---Start
            $('.input_logo').off('change');
            $('.input_logo').on("change", function(e) {
                var files = e.target.files;
                var done = function(url) {
                    $('#image').attr('src', url);
                    $('#cropModel').modal('show');
                };
                var reader;
                var file;
                var url;

                if (files && files.length > 0) {
                    file = files[0];
                    if (URL) {
                        done(URL.createObjectURL(file));
                    }
                }
            });
            //to pass image url to crop model ---End

            //to crop images---Start
            $('#cropModel').off('shown.bs.modal');
            $('#cropModel').on('shown.bs.modal', function() {
                var image = document.getElementById('image');

                cropper = new Cropper(image, {
                    viewMode: 3,
                    preview: '.preview',
                    rotatable: true,
                    crop(event) {
                        document.getElementById("image-width").value = Math.round(event.detail
                            .width);
                        document.getElementById("image-height").value = Math.round(event.detail
                            .height);
                    },
                });


                $("#rotateRight").on("click", e => {
                    cropper.rotate(90);
                });

                $("#rotateLeft").on("click", e => {
                    cropper.rotate(-90);
                });
            }).on('hidden.bs.modal', function() {
                cropper.destroy();
                cropper = null;
            });
            //to crop images---End

            //save crop image ---Start
            var base64data;
            $('#cropImage').off('click');
            $('#cropImage').on('click', function() {

                canvas = cropper.getCroppedCanvas({
                    width: 600,
                    height: 350,
                });
                canvas.toBlob(function(blob) {
                    url = URL.createObjectURL(blob);
                    $('#img_logo').attr('src', url);
                    var reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function() {
                        base64data = reader.result;
                        $('#cropModel').modal('hide');
                        $('#croppedImg').val(base64data);
                    }
                })
            });
            //save crop image ---End
        });
    </script>
    {{-- crop image-end --}}


    <script>
        $(document).ready(function() {
            // frontend validation-start
            $('#site-setting-form').validate({

                rules: {
                    name: "required",
                    address: "required",
                },
                messages: {

                    name: {
                        required: "Please enter organization name.",
                    },

                    address: {
                        required: "Please enter address.",
                    },
                },
                highlight: function(element) {
                    $(element).addClass('border-danger');
                },
                unhighlight: function(element) {
                    $(element).removeClass('border-danger');
                },
            });
            // frontend validation-end
            //upload logo
            $('#input_logo').on('change', function(event) {
                var selectedFile = event.target.files[0];

                if (selectedFile) {
                    $('#img_logo').attr('src', URL.createObjectURL(selectedFile));
                }
            });

            //upload favicon
            $('#input_favicon').on('change', function(event) {
                var selectedFile = event.target.files[0];

                if (selectedFile) {
                    $('#img_favicon').attr('src', URL.createObjectURL(selectedFile));
                }
            });

            //upload Home Page Banner
            $('#input_homepage_banner').on('change', function(event) {
                var selectedFile = event.target.files[0];

                if (selectedFile) {
                    $('#img_banner_homepage').attr('src', URL.createObjectURL(selectedFile));
                }
            });

            $('#save_site_setting').on('click', function(e) {
                e.preventDefault();
                if ($('#site-setting-form').valid()) {
                    showLoader();
                    $('#site-setting-form').ajaxSubmit(function(response) {
                        var parseResponse = JSON.parse(response);
                        if (parseResponse) {
                            hideLoader();
                            showNotification(parseResponse.message, parseResponse.type);

                        } else {
                            hideLoader();
                        }

                    });
                }
            });

        });
    </script>
@endsection
