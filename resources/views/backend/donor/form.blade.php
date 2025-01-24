<style>
    .ck-content {
        min-height: 300px !important;
    }

    input[type="file"] {
        display: block;
    }

    .imageThumb {
        max-height: 75px;
        border: 2px solid;
        margin-left: 10px;
        margin-bottom: 3px;
        padding: 1px;
        cursor: pointer;
    }

    .pip {
        display: inline-block;
        margin: 10px 10px 0 0;
    }


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
        top: 9rem !important
    }

    /* #ndp-nepali-box {
        top: 65px !important;
        left: 10px !important;
    } */

    input#nepali-datepicker {
        width: 100% !important;
        height: 50% !important;
        border-radius: 0.2rem !important;
        border: 0.1px solid rgb(236, 231, 231);
        padding-left: 0.5rem !important;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
<div class="modal-header">
    <h1 class="modal-title fs-5" id="staticBackdropLabel">Donor</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form action="{{ route('admin.donor.save') }}" method="POST" id="form" enctype="multipart/form-data">

        <input type="hidden" name="id" id="id" value="{{ $id ?? '' }}">
        <div class="row  mt-2">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                <label for="name" class="form-label">Name <span class="required-field">*</span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter donar name"
                    value="{{ $name ?? '' }}">
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
                <label for="amount" class="form-label">Amount/Item <span class="required-field">*</span></label>
                <input type="text" class="form-control" id="amount" name="amount"
                    placeholder="Enter amount or item..." value="{{ $amount ?? '' }}">
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
                <label for="title" class="form-label">Order <span class="required-field">*</span></label>
                <input type="number" class="form-control" id="order_number" name="order_number"
                    placeholder="Enter order number..." value="{{ $order_number ?? '' }}">
            </div>
        </div>
        <div class="row  mt-2">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <label for="title" class="form-label">Donation Title <span class="required-field">*</span></label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title..."
                    value="{{ $title ?? '' }}">
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <label for="details" class="form-label">Donation Details <span class="required-field">*</span></label>
                <div id="summernote">{!! $details ?? '' !!}</div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <label for="image">Thumbnail Image <span class="required-field">*</span></label>
                        <div class="relative" id="edit-image">
                            <div class="profile-user">
                                <label for="thumbnail_image"
                                    class="fe fe-camera profile-edit text-primary absolute"></label>
                            </div>
                            <input type="file" class="thumbnail_image" id="thumbnail_image"
                                style="position: absolute; clip: rect(0, 0, 0, 0); pointer-events: none;"
                                accept="image/*" name="image">
                            <input type="hidden" class="form-control croppedImg" id="croppedImg" name="croppedImg">

                            <div class="img-rectangle mt-2">
                                @if (!empty($image))
                                    {!! $image !!}
                                @else
                                    <img src="{{ asset('/no-image.jpg') }}" alt="Default Image" id="img_introduction"
                                        class="_image">
                                @endif
                            </div>
                        </div>
                        <div class="row mt-4 ms-1">
                            <p class="p-0 m-0">Accepted Format :<span class="text-muted"> jpg/jpeg/png</span></p>
                            <p class="p-0 m-0">File size :<span class="text-muted"> (300x475) in pixels</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary saveData"><i class="fa fa-save"></i>
        @if (empty($id))
            Save
        @else
            Update
        @endif
    </button>
</div>
<script>
    $('#thumbnail_image').on('change', function(event) {
        const selectedFile = event.target.files[0];
        if (selectedFile) {
            $('._image').attr('src', URL.createObjectURL(selectedFile));
        }
    });

    $(document).ready(function() {
        $('#modal').on('shown.bs.modal', function() {
            $('#summernote').summernote({
                placeholder: 'Enter donor details...',
                tabsize: 2,
                height: 150,
                dialogsInBody: true,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onImageUpload: function(files) {
                        var formData = new FormData();
                        formData.append("file", files[0]);

                        showLoader();
                        $.ajax({
                            url: "donor/upload-image",
                            method: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                if (response.success) {
                                    var imageUrl = response.imageUrl;
                                    $('#summernote').summernote('insertImage',
                                        imageUrl);

                                    $('<input>')
                                        .attr({
                                            type: 'hidden',
                                            name: 'image_path',
                                            value: imageUrl,
                                        })
                                        .appendTo('#form');
                                    showNotification(
                                        'Image uploaded successfully',
                                        'success');
                                } else {
                                    showNotification(response.message, 'error');
                                }
                            },
                            error: function() {
                                showNotification('Image upload failed',
                                    'error');
                            },
                            complete: function() {
                                hideLoader();
                            }
                        });
                    },
                    onMediaDelete: function(target) {
                        var imageUrl = target.attr('src');

                        showLoader();
                        $.ajax({
                            url: "donor/delete-upload-image",
                            method: 'POST',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr(
                                    'content'),
                                image_path: imageUrl
                            },
                            success: function(response) {
                                if (response.success) {
                                    hideLoader();
                                    showNotification(
                                        'Image deleted successfully',
                                        'success');
                                } else {
                                    hideLoader();
                                    showNotification(response.message, 'error');
                                }
                            },
                            error: function() {
                                hideLoader();
                                showNotification('Image deletion failed',
                                    'error');
                            },
                            complete: function() {
                                hideLoader();
                            }
                        });
                    }
                }
            });
        });

        $('#modal').on('hidden.bs.modal', function() {
            if ($('#summernote').hasClass('note-editor')) {
                $('#summernote').summernote('destroy');
            }
        });

        // Validation
        $('#form').validate({
            rules: {
                name: "required",
                amount: "required",
                title: "required",
                order_number: "required",
                image: {
                    required: function() {
                        var id = $('#id').val();
                        return id === '';
                    }
                },
            },
            messages: {
                title: {
                    required: "This field is required."
                },
                details: {
                    required: "This field is required."
                },
                amount: {
                    required: "This field is required."
                },
                image: {
                    required: "This field is required."
                },
                order_number: {
                    required: "This field is required."
                },
            },
            highlight: function(element) {
                $(element).addClass('border-danger');
            },
            unhighlight: function(element) {
                $(element).removeClass('border-danger');
            },
        });

        $('.saveData').on('click', function() {
            if ($('#form').valid()) {
                const donorDetail = $('#summernote').summernote('code');
                $('<input>')
                    .attr({
                        type: 'hidden',
                        name: 'details',
                        value: donorDetail,
                    })
                    .appendTo('#form');

                showLoader();
                $('#form').ajaxSubmit({
                    success: function(response) {
                        const result = JSON.parse(response);
                        if (result.type === 'success') {
                            showNotification(result.message, 'success');
                            $('#modal').modal('hide');
                            table.draw();
                        } else {
                            showNotification(result.message, 'error');
                        }
                    },
                    error: function() {
                        showNotification('An error occurred.', 'error');
                    },
                    complete: function() {
                        hideLoader();
                    }
                });
            }
        });
    });
</script>
