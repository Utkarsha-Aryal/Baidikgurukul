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
<div class="modal-header">
    <h1 class="modal-title fs-5" id="staticBackdropLabel">History</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form action="{{ route('admin.history.save') }}" method="POST" id="eventForm" enctype="multipart/form-data">

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
                <textarea name="details" id="editor">{!! $details ?? '' !!}</textarea>
                <input type="hidden" name="details" id="details">
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
                    {{-- it is only for v2 --}}
                    
                    {{-- <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                        <div class="row">
                            <label for="description" class="form-label">Event Feature Images
                                <input class="form-control mt-2" type="file" name="feature_images[]"
                                    id="feature_images" multiple>
                        </div>
                        <div class="row mt-2 ms-1">
                            <p class="p-0 m-0">Multiple Images Can Be Uploaded </p>
                            <p class="p-0 m-0">Accepted Format :<span class="text-muted"> jpg/jpeg/png</span></p>
                        </div>

                        <div class="row">
                            @if (!empty($decodedFeatureImages))
                                @foreach ($decodedFeatureImages as $featureImage)
                                    <div id="feature_image">

                                        <img src="{{ asset('/storage/history') . '/' . $featureImage }}"
                                            class="_feature-image imageThumb" alt="Feature Image" />

                                        <button type="button"
                                            class="delete_feature_image btn btn-danger label-btn ms-2"
                                            id="delete_feature_image" data-feature_image="{{ $featureImage }}">Delete<i
                                                class="bi bi-trash label-btn-icon"></i></button>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div> --}}


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
    ClassicEditor
        .create(document.querySelector('#editor'), {
            ckfinder: {
                uploadUrl: "{{ route('admin.history.upload.image', ['_token' => csrf_token()]) }}"
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


        $('#eventForm').validate({
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
            message: {
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
                $(element).addClass('border-danger')
            },
            unhighlight: function(element) {
                $(element).removeClass('border-danger')
            },
        });

        // Save news
        $('.saveHistory').off('click');
        $('.saveHistory').on('click', function() {
            if ($('#eventForm').valid()) {
                $('#details').val(window.editor.getData());
                showLoader();

                $('#eventForm').ajaxSubmit(function(response) {
                    var result = JSON.parse(response);
                    if (result) {
                        if (result.type === 'success') {
                            showNotification(result.message, 'success');
                            hideLoader();
                            historyTable.draw();
                            $('#eventForm')[0].reset();
                            $('#id').val('');
                            $('#historyModal').modal('hide');
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

        // $('.delete_feature_image').on('click', function() {
        //     var feature_image = $(this).data('feature_image');
        //     var id = $('#id').val();
        //     var url = '{{ route('admin.post.deletefeatureimage') }}';
        //     $.ajax({
        //         url: url,
        //         type: 'POST',
        //         data: {
        //             feature_image: feature_image,
        //             id: id,
        //         },
        //         success: function(response) {
        //             // Handle success message or update UI
        //             console.log(response);
        //             // Reload or update UI to reflect changes
        //         },
        //         error: function(xhr, status, error) {
        //             // Handle error
        //             console.error(error);
        //         }
        //     });
        // });
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

                    var url = "{{ route('admin.history.deletefeatureimage') }}";

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
