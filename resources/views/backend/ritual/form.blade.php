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
</style>
<div class="modal-header">
    <h1 class="modal-title fs-5" id="staticBackdropLabel">Ritual</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form action="{{ route('admin.ritual.save') }}" method="POST" id="ritualForm" enctype="multipart/form-data">

        <div class="row  mt-2">
            <input type="hidden" name="id" id="id" value="{{ $id ?? '' }}">
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                <label for="title" class="form-label">Rules For Rituals Title <span
                        class="required-field">*</span></label>
                <input type="text" class="form-control" id="title" name="title"
                    placeholder="Enter rule for rituals title..." value="{{ $title ?? '' }}">
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
                <label for="title" class="form-label">Order <span class="required-field">*</span></label>
                <input type="number" class="form-control" id="order_number" name="order_number"
                    placeholder="Enter order number..." value="{{ $order_number ?? '' }}">
            </div>
        </div>


        <div class="row mt-2">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <label for="details" class="form-label">Rules For Rituals Details <span
                        class="required-field">*</span></label>
                <textarea name="details" id="editor">{!! $details ?? '' !!}</textarea>
                <input type="hidden" name="details" id="details">
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <label for="video_link" class="form-label">Rules For Rituals Video Link <span
                        class="required-field">*</span></label>
                <input type="text" class="form-control" id="video_link" name="video_link"
                    placeholder="Enter video link..." value="{{ $video_link ?? '' }}">
            </div>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary saveRitual"><i class="fa fa-save"></i>
        @if (empty($id))
            Save
        @else
            Update
        @endif
    </button>
</div>

<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            ckfinder: {
                uploadUrl: "{{ route('admin.ritual.upload.image', ['_token' => csrf_token()]) }}"
            },
            toolbar: {
                items: [
                    'undo', 'redo', '|', 'heading', '|', 'bold', 'italic', '|', 'blockQuote', '|',
                    'imageUpload', 'imageStyle:full', 'imageStyle:alignLeft', 'imageStyle:alignCenter',
                    'imageStyle:alignRight'
                ],
                shouldNotGroupWhenFull: true
            },
            heading: {
                options: [{
                    model: 'paragraph',
                    title: 'Paragraph',
                    class: 'ck-heading_paragraph'
                }]
            }
        })
        .then(editor => {
            // Save reference to the editor instance
            window.editor = editor;
        })
        .catch(error => {
            console.error(error);
        });
</script>

<script>
    $(document).ready(function() {

        //uploaded image preview start
        $(document).on("change", "#feature_images", function(event) {
            var images = event.target.files;
            var filesLength = images.length;
            for (var i = 0; i < filesLength; i++) {
                var f = images[i];
                var fileReader = new FileReader();
                fileReader.onload = (function(e) {
                    var file = e.target;
                    $("<span class=\"pip\">" +
                        "<img class=\"imageThumb\" src=\"" + e.target.result +
                        "\" title=\"" + file.name + "\"/>" +
                        "</span>").insertAfter("#feature_images");
                });
                fileReader.readAsDataURL(f);
            }
        });

        $(document).on('change', '#feature_images', function() {
            $('.pip').hide();
        });
        // uploaded image preview end

        $('#thumbnail_image').on('change', function(event) {
            const selectedFile = event.target.files[0];

            if (selectedFile) {
                $('._image').attr('src', URL.createObjectURL(selectedFile));
            }
        });


        $('#ritualForm').validate({
            rules: {
                title: "required",
                order_number: "required",
                video_link: "required",
                details: "required",
            },
            message: {
                title: {
                    required: "This field is required."
                },

                details: {
                    required: "This field is required."
                },
                video_link: {
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
        $('.saveRitual').off('click');
        $('.saveRitual').on('click', function() {
            if ($('#ritualForm').valid()) {
                $('#details').val(window.editor.getData());
                showLoader();

                $('#ritualForm').ajaxSubmit(function(response) {
                    var result = JSON.parse(response);
                    if (result) {
                        if (result.type === 'success') {
                            showNotification(result.message, 'success');
                            hideLoader();
                            ritualTable.draw();
                            $('#ritualForm')[0].reset();
                            $('#id').val('');
                            $('#ritualModal').modal('hide');
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
        $('.delete_feature_image').off('click')
        $('.delete_feature_image').on('click', function() {
            var deleteButton = $(this); // Here, you define deleteButton
            Swal.fire({
                title: "Are you sure you want to delete this item",
                text: "You won't be able to revert it!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DB1F48",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoader();
                    var feature_image = $(this).data('feature_image');
                    var id = $('#id').val();

                    var url = "{{ route('admin.ritual.deletefeatureimage') }}";

                    var data = {
                        feature_image: feature_image,
                        id: id,
                    };
                    $.post(url, data, function(response) {
                        var result = JSON.parse(response);
                        if (result) {
                            if (result.type === 'success') {
                                showNotification(result.message, 'success');

                                // Remove the deleted image from the DOM
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
