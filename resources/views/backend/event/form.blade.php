<link href="https://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/css/nepali.datepicker.v4.0.1.min.css"
    rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
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

    input#nepali-datepicker {
        width: 100% !important;
        height: 50% !important;
        border-radius: 0.2rem !important;
        border: 0.1px solid rgb(236, 231, 231);
        padding-left: 0.5rem !important;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
<script src="https://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v4.0.1.min.js"
    type="text/javascript"></script>
<script>
    function showDatePicker() {
        window.onload = function() {
            var mainInput = document.getElementById("nepali-datepicker");
            mainInput.nepaliDatePicker();
        };

        $("#nepali-datepicker").nepaliDatePicker({
            container: ".datepick",
        });
    }

    $(document).ready(function() {
        $("#nepali-datepicker").nepaliDatePicker({
            container: ".datepick"
        });
    });
</script>

<div class="modal-header">
    <h1 class="modal-title fs-5" id="staticBackdropLabel">Event</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
    <form action="{{ route('admin.event.save') }}" method="POST" id="eventForm" enctype="multipart/form-data">
        <div class="row">
            <input type="hidden" name="id" id="id" value="{{ $id ?? '' }}">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <label for="title" class="form-label">Event Title <span class="required-field">*</span></label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title..."
                    value="{{ $title ?? '' }}">
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 datepick">
                <label for="event_date" class="form-label">Event Date <span class="required-field">*</span></label>
                {{-- <input type="date" name="event_date" id="event_date" class="form-control"
                    value="{{ isset($event_date) ? \Carbon\Carbon::parse($event_date)->format('Y-m-d') : '' }}"> --}}
                <input type="text" id="nepali-datepicker" class="form-control" name="event_date"
                    value="{{ isset($event_date) ? \Carbon\Carbon::parse($event_date)->format('Y-m-d') : '' }}"
                    placeholder="Select Event Date">
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                <label for="event_address" class="form-label">Event Address <span
                        class="required-field">*</span></label>
                <input type="text" class="form-control" id="event_address" name="event_address"
                    placeholder="Enter event address..." value="{{ $address ?? '' }}">
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                <label for="event_venue" class="form-label">Event Venue <span class="required-field">*</span></label>
                <input type="text" class="form-control" id="event_venue" name="event_venue"
                    placeholder="Enter event venue..." value="{{ $venue ?? '' }}">
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                <label for="event_time_start" class="form-label">Event Starting Time <span
                        class="required-field">*</span></label>
                <input type="time" class="form-control" id="event_time_start" name="event_time_start"
                    value="{{ $event_time_start ?? '' }}">
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                <label for="event_time_end" class="form-label">Event Ending Time <span
                        class="required-field">*</span></label>
                <input type="time" class="form-control" id="event_time_end" name="event_time_end"
                    value="{{ $event_time_end ?? '' }}">
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                <label for="order_number" class="form-label">Order <span class="required-field">*</span></label>
                <input type="number" class="form-control" id="order_number" name="order_number"
                    value="{{ $order_number ?? '' }}">
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <label for="details" class="form-label">Event Details <span class="required-field">*</span></label>
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
    <button type="button" class="btn btn-primary saveEvent"><i class="fa fa-save"></i> Save</button>
</div>

<script>
    $('#thumbnail_image').on('change', function(event) {
        const selectedFile = event.target.files[0];
        if (selectedFile) {
            $('._image').attr('src', URL.createObjectURL(selectedFile));
        }
    });

    $(document).ready(function() {
        $('#eventModal').on('shown.bs.modal', function() {
            $('#summernote').summernote({
                placeholder: 'Enter event details...',
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
                            url: "event/upload-image",
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
                                        .appendTo('#eventForm');
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
                            url: "event/delete-upload-image",
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
                                    showLoader();
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

        $('#eventModal').on('hidden.bs.modal', function() {
            if ($('#summernote').hasClass('note-editor')) {
                $('#summernote').summernote('destroy');
            }
        });

        // Form validation
        $('#eventForm').validate({
            rules: {
                title: "required",
                order_number: "required",
                event_address: "required",
                event_date: "required",
                event_venue: "required",
                event_time_end: "required",
                event_time_start: "required",
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

        $('.saveEvent').on('click', function() {
            if ($('#eventForm').valid()) {
                const eventDetails = $('#summernote').summernote('code');
                $('<input>')
                    .attr({
                        type: 'hidden',
                        name: 'details',
                        value: eventDetails,
                    })
                    .appendTo('#eventForm');

                showLoader();
                $('#eventForm').ajaxSubmit({
                    success: function(response) {
                        const result = JSON.parse(response);
                        if (result.type === 'success') {
                            showNotification(result.message, 'success');
                            $('#eventModal').modal('hide');
                            eventTable.draw();
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
