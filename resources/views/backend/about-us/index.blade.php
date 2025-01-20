@extends('backend.layouts.main')

@section('title')
    About Us
@endsection
<style>
    .relative {
        position: relative;
        width: 150px !important;
        padding-right: 0 !important;
    }

    .absolute {
        position: absolute;
        right: 0 !important;
    }
</style>
@section('main-content')
    <style>
        .ql-container {
            height: 200px;
        }

        .ql-editor {
            min-height: 100% !important;
        }

        input#admission_open {
            border: 1px solid rgb(176, 176, 176) !important
        }
    </style>
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <div>
            <h4 class="mb-0">About Us</h4>
            <p class="mb-0 text-muted">About us.</p>
        </div>
    </div>
    <!-- End Page Header -->

    <!-- row -->
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.aboutus.update') }}" id="about-us-form" enctype="multipart/form-data" method="POST">
                <div class="row">
                    <div class="form-group col-6">
                        <label for="inputEmail6">Introduction Title <span class="required-field">*</span></label>
                        <input type="text" class="form-control mt-1" id="aboutus_title" name="aboutus_title"
                            value="{{ isset($aboutusData['aboutus_title']) ? $aboutusData['aboutus_title'] : old('aboutus_title') }}"
                            placeholder="Enter about us title">
                    </div>
                    <div class="form-group col-10">
                        <label for="introduction">Introduction of organization <span class="required-field">*</span></label>
                        <div id="introduction" name="introduction">{!! @$aboutusData->introduction !!}</div>
                        <input type="hidden" name="introduction" id="quill-content-introduction">
                    </div>
                    <div class="form-group col-2">
                        <div class="row">
                            <div class="mt-2">
                                <label for="img_introduction">Introduction image</label>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="relative" id="edit-image">
                                <div class="profile-user">
                                    <label for="edit_img_introduction"
                                        class="fe fe-camera profile-edit text-primary absolute"></label>
                                </div>
                                <input type="file" class="edit_img_introduction" id="edit_img_introduction"
                                    style="position: absolute; clip: rect(0, 0, 0, 0); pointer-events: none;"
                                    accept="image/*" name="img_introduction">
                                <input type="hidden" class="form-control croppedImgIntroduction"
                                    id="croppedImgIntroduction" name="croppedImgIntroduction">
                                <div class="img-rectangle">
                                    @if (!empty($aboutusData['img_introduction']))
                                        <img alt=""
                                            src={{ asset('/storage/aboutus') . '/' . @$aboutusData['img_introduction'] }}
                                            alt="img" id="img_introduction">
                                    @else
                                        <img src="{{ asset('/no-image.jpg') }}" alt="Default Image" id="img_introduction">
                                    @endif

                                </div>
                            </div>
                            <div class="row mt-2 ms-1">
                                <p class="p-0 m-0">Accepted Format :<span class="text-muted"> jpg/jpeg/png</span></p>
                                <p class="p-0 m-0">File size :<span class="text-muted"> (300x475) in pixels</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <label for="mission">Mission </label>
                        <textarea class="form-control mt-2" id="mission" name="mission" rows="4" placeholder="Enter mission...">{{ @$aboutusData['mission'] }}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <label for="vision">Vision </label>
                        <textarea class="form-control mt-2" id="vision" name="vision" rows="4" placeholder="Enter vision...">{{ @$aboutusData['vision'] }}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <label for="goals">Goals </label>
                        <textarea class="form-control mt-2" id="goals" name="goals" rows="4" placeholder="Enter goals...">{{ @$aboutusData['goals'] }}</textarea>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end mt-3">
                    <button type="button" class="btn btn-primary" id="save_about"><i class="fa fa-save"></i>
                        Update</button>
                </div>
            </form>
        </div>
    </div>
    <!-- row close -->
    {{-- crop modal-start --}}

    <div class="modal cropModel fade" id="cropModel" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
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

                var imageIntroduction = $('.edit_img_introduction')[0].files[0];
                $('#img_introduction').attr('src', URL.createObjectURL(imageIntroduction));
                $('#cropModel').modal('hide');
            });
            //close Model --End

            //to pass image url to crop model ---Start
            $('.edit_img_introduction').off('change');
            $('.edit_img_introduction').on("change", function(e) {
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
                    // initailAspectRatio: 1,
                    aspectRatio: NaN,
                    viewMode: 1,
                    moveable: false,
                    zoomOnWheel: false,

                    preview: '.preview',
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
                    width: 160,
                    height: 160,
                });
                canvas.toBlob(function(blob) {
                    url = URL.createObjectURL(blob);
                    $('#img_introduction').attr('src', url);
                    var reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function() {
                        base64data = reader.result;
                        $('#cropModel').modal('hide');
                        $('#croppedImgIntroduction').val(base64data);
                    }
                })
            });
            //save crop image ---End
        });
    </script>
    {{-- crop image-end --}}


    <script>
        $(document).ready(function() {
            $('#edit_img_introduction').on('change', function(event) {
                var selectedFile = event.target.files[0];

                if (selectedFile) {
                    $('#img_introduction').attr('src', URL.createObjectURL(selectedFile));
                }
            });

            var quillIntroduction = new Quill('#introduction', {
                theme: 'snow'
            });

            $('#edit_img_vision').on('change', function(event) {
                var selectedFile = event.target.files[0];

                if (selectedFile) {
                    $('#img_vision').attr('src', URL.createObjectURL(selectedFile));
                }
            });

            $('#edit_img_mission').on('change', function(event) {
                var selectedFile = event.target.files[0];

                if (selectedFile) {
                    $('#img_mission').attr('src', URL.createObjectURL(selectedFile));
                }
            });

            $('#edit_img_founder').on('change', function(event) {
                var selectedFile = event.target.files[0];

                if (selectedFile) {
                    $('#img_founder').attr('src', URL.createObjectURL(selectedFile));
                }
            });

            $('#about-us-form').validate({
                rules: {
                    introduction: "required",
                    vision: "required",
                    mission: "required",
                    founder_name: "required",
                    message_title: "required",
                    message_from_founder: "required",
                },
                message: {
                    introduction: {
                        required: "Please enter introduction"
                    },
                    vision: {
                        required: "Please enter vision"
                    },
                    mission: {
                        required: "Please enter mission"
                    },
                    img_founder: {
                        required: "Please select image of founder."
                    },
                    founder_name: {
                        required: "Please enter founder name"
                    },
                    message_title: {
                        required: "Please enter message title"
                    },
                    message_from_founder: {
                        required: "Please enter message of founder."
                    },
                },
                highlight: function(element) {
                    $(element).addClass('border-danger')
                },
                unhighlight: function(element) {
                    $(element).removeClass('border-danger')
                },
            });

            $('#save_about').off('click');
            $('#save_about').on('click', function(e) {
                if ($('#about-us-form').valid()) {
                    showLoader();
                    var introductionContent = quillIntroduction.root.innerHTML;
                    $('#about-us-form').find('#quill-content-introduction').val(introductionContent);

                    $('#about-us-form').ajaxSubmit(function(response) {
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
