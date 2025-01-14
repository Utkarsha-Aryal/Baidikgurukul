<style>
    .ck-content {
        min-height: 300px !important;
    }

    /* .iconpicker-popover.popover.bottom {
        opacity: 1;
    } */

    .cropper-container {
        width: 100% !important;
    }

    .modal-header {
        position: relative;
    }

    .modal-header .closeCrop {
        position: absolute;
        top: 13px;
        right: 15px;
    }

    label#thumbnail_image-error {
        position: absolute;
        top: 9rem !important;
        left: 0.4rem;
    }

    label#feature_image-error {
        position: absolute;
        top: 9rem !important;
        left: 0.4rem;
    }
</style>
<div class="modal-header">
    <h1 class="modal-title fs-5" id="staticBackdropLabel">Service</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form action="{{ route('admin.service.save') }}" method="POST" id="serviceForm" enctype="multipart/form-data">

        <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
                <input type="hidden" name="id" id="id" value="{{ @$id }}">
                <label for="title" class="form-label">Title <span class="required-field">*</span></label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title..." value="{{ @$title }}">
            </div>
            {{-- <div class="col-xl-3 col-lg-3 col-md-3col-sm-3">

                <div class="form-group select-style">
                    <label for="title" class="form-label">Service icon <span class="required-field">*</span></label>
                    <input type="text" class="form-control faicon icp icp-auto" id="faicon" placeholder="Select service icon" name="icon" value="{{ @$icon }}">
                </div>
            </div> --}}
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">

                <div class="form-group select-style">
                    <label for="title" class="form-label">Order <span class="required-field">*</span></label>
                    <input type="number" class="form-control" id="order" name="order" placeholder="Enter order..." value="{{ @$order }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <label for="details" class="form-label">Details <span class="required-field">*</span></label>
                <!-- Quill Editor Container -->
                <textarea name="details" id="editor">{!! @$details !!}</textarea>
                <input type="hidden" name="details" id="details">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                <label class="form-label">Thumbnail Image <span class="required-field">*</span></label>
                <div class="relative" id="edit-image">
                    <div class="profile-user">
                        <label for="thumbnail_image" class="fe fe-camera profile-edit text-primary absolute"></label>
                    </div>
                    <input type="file" class="thumbnail_image" id="thumbnail_image" style="position: absolute; clip: rect(0, 0, 0, 0); pointer-events: none;" accept="image/*" name="thumbnail_image">
                    <input type="hidden" class="form-control croppedImg" id="croppedImg" name="croppedImg">

                    <div class="img-rectangle mb-2">
                        @if (!empty($thumbnail_image))
                        {!! $thumbnail_image !!}
                        @else
                        <img src="{{ asset('/no-image.jpg') }}" alt="Default Image" class="_image">
                        @endif

                    </div>
                </div>
                <div class="row mt-4 ms-1">
                    <p class="p-0 m-0">Accepted Format :<span class="text-muted"> jpg/jpeg/png</span></p>
                    <p class="p-0 m-0">File size :<span class="text-muted"> (300x475) in pixels</span></p>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                <label class="form-label">Banner Image <span class="required-field">*</span></label>
                <div class="relative" id="edit-image">
                    <div class="profile-user">
                        <label for="feature_image" class="fe fe-camera profile-edit text-primary absolute"></label>
                    </div>
                    <input type="file" class="feature_image" id="feature_image" style="position: absolute; clip: rect(0, 0, 0, 0); pointer-events: none;" accept="image/*" name="feature_image">

                    <div class="img-rectangle mb-2">
                        @if (!empty($feature_image))
                        {!! $feature_image !!}
                        @else
                        <img src="{{ asset('/no-image.jpg') }}" alt="Default Image" class="feature_image">
                        @endif

                    </div>
                </div>
                <div class="row mt-4 ms-1">
                    <p class="p-0 m-0">Accepted Format :<span class="text-muted"> jpg/jpeg/png</span></p>
                    <p class="p-0 m-0">File size :<span class="text-muted"> (300x475) in pixels</span></p>
                </div>
            </div>
        </div>

    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary saveservice"><i class="fa fa-save"></i>
        @if (!empty($id))
        Update
        @else
        Save
        @endif
    </button>
</div>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: {
                items: [
                    'undo', 'redo', '|', 'heading', '|', 'bold', 'italic',
                ],
            },
        })
        .then(editor => {
            window.editor = editor;
        })
        .catch(error => {
            console.error(error);
        });
</script>
<script>
    // $(document).ready(function() {
    //     $('.icp-auto').iconpicker();
    // });

    $('#thumbnail_image').on('change', function(event) {
        const selectedFile = event.target.files[0];

        if (selectedFile) {
            $('._image').attr('src', URL.createObjectURL(selectedFile));
        }
    });
    $('#feature_image').on('change', function(event) {
        const selectedFile = event.target.files[0];

        if (selectedFile) {
            $('.feature_image').attr('src', URL.createObjectURL(selectedFile));
        }
    });


    $('#serviceForm').validate({
        rules: {
            title: "required",
            // icon: "required",
            order: "required",
            details: "required",
            thumbnail_image: {
                required: function() {
                    var id = $('#id').val();
                    return id === '';
                }
            },
            feature_image: {
                required: function() {
                    var id = $('#id').val();
                    return id === '';
                }
            }
        },
        message: {
            title: {
                required: "This field is required."
            },
            // icon: {
            //     required: "This field is required."
            // },
            order: {
                required: "This field is required."
            },
            details: {
                required: "This field is required."
            },
            thumbnail_image: {
                required: "This field is required."
            },
            feature_image: {
                required: "This field is required."
            },
        },
        highlight: function(element) {
            $(element).addClass('border-danger')
        },
        unhighlight: function(element) {
            $(element).removeClass('border-danger')
        },
    });


    // Save service
    $(document).off('click', '.saveservice');
    $(document).on('click', '.saveservice', function() {

        if ($('#serviceForm').valid()) {
            showLoader();
            $('#details').val(window.editor.getData());
            $('#serviceForm').ajaxSubmit(function(response) {
                var result = JSON.parse(response);
                if (result) {
                    if (result.type === 'success') {
                        showNotification(result.message, 'success');
                        hideLoader();
                        serviceTable.draw();
                        $('#serviceForm')[0].reset();
                        $('#id').val('');
                        $('#serviceModal').modal('hide');
                    } else {
                        showNotification(result.message, 'error');
                        hideLoader();
                    }
                } else {
                    hideLoader();
                }
            });
        }
    });
</script>