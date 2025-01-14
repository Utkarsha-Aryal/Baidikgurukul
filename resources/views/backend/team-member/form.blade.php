<style>
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

    label#photo-error {
        position: absolute;
        top: 8.2rem !important
    }
</style>
<div class="modal-header">
    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add new member</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form id="form" method="POST" action="{{ route('admin.member.save') }}" enctype="multipart/form-data">
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <input type="hidden" name="id" id="id" value="{{ @$id }}">
                <label for="category" class="form-label">Member Type <span class="required-field">*</span></label>
                <select class="form-select" aria-label="Default select example" id="category" name="category">
                    <option value="" selected>Select Category</option>
                    @foreach ($category as $item)
                        <option value="{{ $item->id }}"
                            {{ !empty($category_id) && $category_id == $item->id ? 'selected' : '' }}>
                            {{ $item->team_category }}
                        </option>
                    @endforeach

                </select>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <label for="name" class="form-label">Name <span class="required-field">*</span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name..."
                    value="{{ @$name }}">
            </div>


        </div>
        <div class="row mt-3 ">

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <label for="order" class="form-label">Order <span class="required-field">*</span></label>
                <input type="number" class="form-control" id="order" name="order" placeholder="Enter Order"
                    value="{{ @$order }}">
            </div>

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <label for="designation" class="form-label">Designation <span class="required-field">*</span></label>
                <input type="text" class="form-control" id="designation" name="designation"
                    placeholder="Enter Designation..." value="{{ @$designation }}">
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <label for="facebook_url" class="form-label">Facebook Link</label>
                <input type="text" class="form-control" id="facebook_url" name="facebook_url"
                    placeholder="Enter Facebook Link..." value="{{ @$facebook_url }}">
            </div>


        </div>
        <div class="row mt-3">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <label for="instagram_url" class="form-label">Instagram link</label>
                <input type="text" class="form-control" id="instagram_url" name="instagram_url"
                    placeholder="Enter instagram link..." value="{{ @$instagram_url }}">
            </div>

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ">
                <label for="twitter_url" class="form-label">Twitter Link</label>
                <input type="text" class="form-control" id="twitter_url" name="twitter_url"
                    placeholder="Enter Twitter link..." value="{{ @$twitter_url }}">
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2">
                <div class="row">
                    <label class="form-label">Photo <span class="required-field">*</span></label>
                    <div class="relative" id="edit-image">
                        <div class="profile-user">
                            <label for="photo" class="fe fe-camera profile-edit text-primary absolute"></label>
                        </div>
                        <input type="file" class="photo" id="photo"
                            style="position: absolute; clip: rect(0, 0, 0, 0); pointer-events: none;"
                            accept="image/*"name="photo">
                        <input type="hidden" class="form-control croppedImg" id="croppedImg" name="croppedImg">
                        <div class="img-rectangle mb-2">
                            @if (!empty($photo))
                                {!! $photo !!}
                            @else
                                <img src="{{ asset('/no-image.jpg') }}" alt="Default Image"id="img_introduction"
                                    class="_image">
                            @endif

                        </div>
                    </div>
                </div>
                <div class="row mt-3 ms-2">
                    <p class="p-0 m-0">Accepted Format :<span class="text-muted"> jpg/jpeg/png</span></p>
                    <p class="p-0 m-0">File size :<span class="text-muted"> (300x475) in pixels</span></p>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary saveData"><i class="fa fa-add"></i>
        @if (empty($id))
            Save
        @else
            Update
        @endif
    </button>
</div>
<script>
    $(document).ready(function() {

        $('#photo').on('change', function(event) {
            const selectedFile = event.target.files[0];

            if (selectedFile) {
                $('._image').attr('src', URL.createObjectURL(selectedFile));
            }
        });


        $('#form').validate({
            rules: {
                category: "required",
                name: "required",
                order: "required",
                designation: "required",
                photo: {
                    required: function() {
                        var id = $('#id').val();
                        return id === '';
                    }
                },
            },
            message: {
                category: {
                    required: "This field is required."
                },
                name: {
                    required: "This field is required."
                },
                order: {
                    required: "This field is required."
                },
                designation: {
                    required: "This field is required."
                },
                photo: {
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

        // Save bod
        $('.saveData').off('click');
        $('.saveData').on('click', function(e) {

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
        // $('#category').trigger('change');
    });
</script>
