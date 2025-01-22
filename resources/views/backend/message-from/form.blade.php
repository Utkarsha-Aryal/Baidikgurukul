<style>
    .iconpicker-popover.popover.bottom {
        opacity: 1;
    }

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
<div class="modal-header">
    <h1 class="modal-title fs-5" id="staticBackdropLabel">Message</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form action="{{ route('admin.message.save') }}" method="POST" id="form" enctype="multipart/form-data">
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                <input type="hidden" name="id" id="id" value="{{ @$id }}">
                <label for="name" class="form-label">Name <span class="required-field">*</span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name..."
                    value="{{ @$name }}">
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                <label for="designation" class="form-label">Designation <span class="required-field">*</span></label>
                <input type="text" class="form-control" id="designation" name="designation"
                    placeholder="Enter designation..." value="{{ @$designation }}">
            </div>

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                <label for="order" class="form-label">Order <span class="required-field">*</span></label>
                <input type="number" class="form-control" id="order" name="order"
                    placeholder="Enter message order..." value="{{ @$order }}">
            </div>

            <div class="row mt-2">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <label for="title" class="form-label">Message Title <span class="required-field">*</span></label>
                    <input type="text" class="form-control" id="title" name="title"
                        placeholder="Enter message title..." value="{{ @$title ?? '' }}">
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <label for="message" class="form-label">Message <span class="required-field">*</span></label>
                <!-- Quill Editor Container -->
                <div id="message" name="message">{!! @$message !!}</div>
                <input type="hidden" name="message" id="quill_content">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="row">
                    <label for="image" class="form-label">Photo </label>
                    <div class="relative" id="edit-image">
                        <div class="profile-user">
                            <label for="image" class="fe fe-camera profile-edit text-primary absolute"></label>
                        </div>
                        <input type="file" class="image" id="image"
                            style="position: absolute; clip: rect(0, 0, 0, 0); pointer-events: none;"
                            accept="image/*"name="image">

                        <div class="img-rectangle mt-2">
                            @if (!empty($image))
                                {!! $image !!}
                            @else
                                <img src="{{ asset('/no-image.jpg') }}" alt="Default Image"id="img_introduction"
                                    class="_image">
                            @endif

                        </div>
                    </div>
                </div>
                <div class="row mt-2 ms-1">
                    <p class="p-0 m-0">Accepted Format :<span class="text-muted"> jpg/jpeg/png</span></p>
                    <p class="p-0 m-0">File size :<span class="text-muted"> (300x475) in pixels</span></p>
                </div>
            </div>
            <div class="form-check col-xl-6 col-lg-6 col-md-6 col-sm-6">
                <input class="form-check-input" type="checkbox" value="Y" id="display_in_home"
                    name="display_in_home" {{ @$display_in_home === 'Y' ? 'checked' : '' }}>
                <label class="form-check-label" for="display_in_home">
                    Display in home
                </label>
            </div>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary save"><i class="fa fa-save"></i>
        @if (!empty($id))
            Update
        @else
            Save
        @endif
    </button>
</div>

<script>
    $(document).ready(function() {
        $('.icp-auto').iconpicker();
        var quill = new Quill('#message', {
            theme: 'snow'
        });

        $('#image').on('change', function(event) {
            const selectedFile = event.target.files[0];

            if (selectedFile) {
                $('._image').attr('src', URL.createObjectURL(selectedFile));
            }
        });

        $('#form').validate({
            rules: {
                name: 'required',
                designation: 'required',
                order: 'required',
                message: 'required',
            },
            message: {
                name: {
                    required: "This field is required"
                },
                designation: {
                    required: "This field is required"
                },
                order: {
                    required: "This field is required"
                },
                message: {
                    required: "This field is required"
                },
            },
            highlight: function(element) {
                $(element).addClass('border-danger')
            },
            unhighlight: function(element) {
                $(element).removeClass('border-danger')
            },
        })

        // Save message from
        $('.save').off('click');
        $('.save').on('click', function() {

            var message = quill.root.innerHTML;
            $('#form').find('#quill_content').val(message);

            if ($('#form').valid()) {
                showLoader();

                $('#form').ajaxSubmit(function(response) {
                    var result = JSON.parse(response);
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
