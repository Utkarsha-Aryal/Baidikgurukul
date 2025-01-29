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
    <h1 class="modal-title fs-5" id="staticBackdropLabel">Post</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form action="{{ route('admin.post.save') }}" method="POST" id="postForm" enctype="multipart/form-data">

        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
                <input type="hidden" name="id" id="id" value="{{ @$id }}">
                <label for="category" class="form-label">Category <span class="required-field">*</span></label>
                <select class="form-select" aria-label="Default select example" id="category" name="category">
                    <option value="">Select Category</option>
                    <option value="article" {{ !empty($category) && $category === 'article' ? 'selected' : '' }}>Article
                    </option>
                    <option value="blog" {{ !empty($category) && $category === 'blog' ? 'selected' : '' }}>Blog
                    </option>
                    {{-- <option value="event" {{ !empty($category) && $category === 'event' ? 'selected' : '' }}>Event
                    </option> --}}
                    <option value="news" {{ !empty($category) && $category === 'news' ? 'selected' : '' }}>News
                    </option>
                    {{-- <option value="notice" {{ !empty($category) && $category === 'notice' ? 'selected' : '' }}>Notice
                    </option> --}}
                </select>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                <label for="title" class="form-label">Title <span class="required-field">*</span></label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title..."
                    value="{{ @$title }}">
            </div>
        </div>

        <div class="row mt-2">

            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 datepick" style="display: none" id="show_event_date">
                <label for="event_date" class="form-label">Date <span class="required-field">*</span></label>
                <p>
                    <input type="text" id="nepali-datepicker" name="event_date" placeholder="Select Date"
                        value="{{ @$event_date }}">
                </p>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9" style="display: none" id="show_event_address">
                <label for="title" class="form-label">Event Address <span class="required-field">*</span></label>
                <input type="text" class="form-control" id="event_address" name="event_address"
                    placeholder="Enter event address..." value="{{ @$event_address }}">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <label for="details" class="form-label">Details <span class="required-field">*</span></label>
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
    <button type="button" class="btn btn-primary saveNews"><i class="fa fa-save"></i>
        @if (empty($id))
            Save
        @else
            Update
        @endif
    </button>
</div>


<script>
    $(document).ready(function() {
        // Thumbnail image
        $('#thumbnail_image').on('change', function(event) {
            const selectedFile = event.target.files[0];
            if (selectedFile) {
                $('._image').attr('src', URL.createObjectURL(selectedFile));
            }
        });

        $('#postModal').on('shown.bs.modal', function() {
            $('#summernote').summernote({
                placeholder: 'Enter post details...',
                tabsize: 2,
                height: 150,
                dialogsInBody: true,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ],
                callbacks: {
                    onImageUpload: function(files) {
                        var formData = new FormData();
                        formData.append("file", files[0]);
                        showLoader();
                        $.ajax({
                            url: "post/upload-image",
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
                                    hideLoader();
                                }
                            },
                            error: function() {
                                showNotification('Image upload failed',
                                    'error');
                                hideLoader();
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
                            url: "post/delete-upload-image",
                            method: 'POST',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr(
                                    'content'),
                                image_path: imageUrl,
                            },
                            success: function(response) {
                                if (response.success) {
                                    showLoader();
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
                    },
                },
            });
        });

        $('#postModal').on('hidden.bs.modal', function() {
            if ($('#summernote').hasClass('note-editor')) {
                $('#summernote').summernote('destroy');
            }
        });

        $('#postForm').validate({
            rules: {
                category: "required",
                title: "required",
                event_date: "required",
                event_address: "required",
                details: "required",
                image: {
                    required: function() {
                        var id = $('#id').val();
                        return id === '';
                    },
                },
            },
            message: {
                category: {
                    required: "This field is required.",
                },
                title: {
                    required: "This field is required.",
                },
                details: {
                    required: "This field is required.",
                },
                event_date: {
                    required: "This field is required.",
                },
                event_address: {
                    required: "This field is required.",
                },
                image: {
                    required: "This field is required.",
                },
            },
            highlight: function(element) {
                $(element).addClass('border-danger');
            },
            unhighlight: function(element) {
                $(element).removeClass('border-danger');
            },
        });

        // Save post
        $('.saveNews').off('click');
        $('.saveNews').on('click', function() {
            if ($('#postForm').valid()) {
                const postDetail = $('#summernote').summernote('code');
                $('<input>')
                    .attr({
                        type: 'hidden',
                        name: 'details',
                        value: postDetail,
                    })
                    .appendTo('#postForm');
                showLoader();

                $('#postForm').ajaxSubmit(function(response) {
                    var result = JSON.parse(response);
                    if (result) {
                        if (result.type === 'success') {
                            showNotification(result.message, 'success');
                            hideLoader();
                            postTable.draw();
                            $('#postForm')[0].reset();
                            $('#id').val('');
                            $('#postModal').modal('hide');
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

        // Delete feature image
        $('.delete_feature_image').off('click');
        $('.delete_feature_image').on('click', function() {
            var deleteButton = $(this);
            Swal.fire({
                title: "Are you sure you want to delete this item",
                text: "You won't be able to revert it!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DB1F48",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoader();
                    var feature_image = $(this).data('feature_image');
                    var id = $('#id').val();

                    var url = "{{ route('admin.post.deletefeatureimage') }}";

                    var data = {
                        feature_image: feature_image,
                        id: id,
                    };
                    $.post(url, data, function(response) {
                        var result = JSON.parse(response);
                        if (result) {
                            if (result.type === 'success') {
                                showNotification(result.message, 'success');

                                deleteButton.closest('#feature_image').remove();

                                hideLoader();
                            } else {
                                showNotification(result.message, 'error');
                                hideLoader();
                            }
                        }
                    });
                }
            });
        });
    });
</script>
