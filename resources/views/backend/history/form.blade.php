<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>

<div class="modal-header">
    <h1 class="modal-title fs-5" id="staticBackdropLabel">History</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form action="{{ route('admin.history.save') }}" method="POST" id="historyForm" enctype="multipart/form-data">

        <div class="row  mt-2">
            <input type="hidden" name="id" id="id" value="{{ $id ?? '' }}">
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                <label for="title" class="form-label">History Title <span class="required-field">*</span></label>
                <input type="text" class="form-control" id="title" name="title"
                    placeholder="Enter history title..." value="{{ $title ?? '' }}">
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
                <label for="title" class="form-label">Order <span class="required-field">*</span></label>
                <input type="number" class="form-control" id="order_number" name="order_number"
                    placeholder="Enter order number..." value="{{ $order_number ?? '' }}">
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <label for="details" class="form-label">History Details <span class="required-field">*</span></label>
                <div id="summernote">{!! $details ?? '' !!}</div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <label for="image">History Thumbnail Image <span class="required-field">*</span></label>
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
    <button type="button" class="btn btn-primary saveHistory"><i class="fa fa-save"></i>
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

        $('#historyModal').on('shown.bs.modal', function() {
            $('#summernote').summernote({
                placeholder: 'Enter history details...',
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
                            url: "history/upload-image",
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
                            url: "history/delete/upload-image",
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

        $('#historyModal').on('hidden.bs.modal', function() {
            if ($('#summernote').hasClass('note-editor')) {
                $('#summernote').summernote('destroy');
            }
        });

        $('#historyForm').validate({
            rules: {
                title: "required",
                order_number: "required",
                short_quote: "required",
                details: "required",
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
                short_quote: {
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

        $('.saveHistory').off('click');
        $('.saveHistory').on('click', function() {
            if ($('#historyForm').valid()) {
                const historyDetails = $('#summernote').summernote('code');
                $('<input>')
                    .attr({
                        type: 'hidden',
                        name: 'details',
                        value: historyDetails,
                    })
                    .appendTo('#historyForm');
                showLoader();
                $('#historyForm').ajaxSubmit(function(response) {
                    var result = JSON.parse(response);
                    if (result) {
                        if (result.type === 'success') {
                            showNotification(result.message, 'success');
                            historyTable.draw();
                            $('#historyForm')[0].reset();
                            $('#id').val('');
                            $('#historyModal').modal('hide');
                        } else {
                            showNotification(result.message, 'error');
                        }
                    }
                    hideLoader();
                });
            }
        });
    });

    function showLoader() {
        $('#loader').show();
    }

    function hideLoader() {
        $('#loader').hide();
    }
</script>
