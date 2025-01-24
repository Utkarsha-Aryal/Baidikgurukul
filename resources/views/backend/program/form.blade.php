<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>

<div class="modal-header">
    <h1 class="modal-title fs-5" id="staticBackdropLabel">Program</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form action="{{ route('admin.program.save') }}" method="POST" id="form" enctype="multipart/form-data">

        <div class="row  mt-2">
            <input type="hidden" name="id" id="id" value="{{ $id ?? '' }}">
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                <label for="title" class="form-label">Program Name <span class="required-field">*</span></label>
                <input type="text" class="form-control" id="title" name="title"
                    placeholder="Enter program name..." value="{{ $title ?? '' }}">
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
                <label for="title" class="form-label">Order <span class="required-field">*</span></label>
                <input type="number" class="form-control" id="order_number" name="order_number"
                    placeholder="Enter order number..." value="{{ $order_number ?? '' }}">
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <label for="details" class="form-label">Program Details <span class="required-field">*</span></label>
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
    $(document).ready(function() {

        $('#thumbnail_image').on('change', function(event) {
            const selectedFile = event.target.files[0];

            if (selectedFile) {
                $('._image').attr('src', URL.createObjectURL(selectedFile));
            }
        });

        $('#modal').on('shown.bs.modal', function() {
            $('#summernote').summernote({
                placeholder: 'Enter program details...',
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
                            url: "program/upload-image",
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
                        var imageUrl = target.attr(
                            'src');
                        showLoader();
                        $.ajax({
                            url: "program/delete/upload-image",
                            method: 'POST',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr(
                                    'content'),
                                image_path: imageUrl
                            },
                            success: function(response) {
                                if (response.success) {
                                    showNotification(
                                        'Image deleted successfully',
                                        'success');
                                } else {
                                    showNotification(response.message,
                                        'error');
                                }
                            },
                            error: function() {
                                showNotification(
                                    'Image deletion failed',
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


        $('#form').validate({
            rules: {
                title: "required",
                order_number: "required",
                details: "required",
                image: {
                    required: function() {
                        var id = $('#id').val();
                        return id === '';
                    }
                },
            },
            message: {
                title: {
                    required: "This field is required."
                },

                details: {
                    required: "This field is required."
                },
                order_number: {
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

        // Save news
        $('.saveData').off('click');
        $('.saveData').on('click', function() {
            if ($('#form').valid()) {
                const programDetail = $('#summernote').summernote('code');
                $('<input>')
                    .attr({
                        type: 'hidden',
                        name: 'details',
                        value: programDetail,
                    })
                    .appendTo('#form');

                showLoader();

                $('#form').ajaxSubmit(function(response) {
                    var result = response;
                    if (result) {
                        if (result.type === 'success') {
                            showNotification(result.message, 'success');
                            hideLoader();
                            table.draw();
                            $('#form')[0].reset();
                            $('#id').val('');
                            $('#modal').modal('hide');
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
    });
</script>
