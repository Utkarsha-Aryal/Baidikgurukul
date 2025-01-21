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
                <!-- Quill Editor Container -->
                <!-- <div id="details" name="details">{!! $details ?? '' !!}</div>
                <input type="hidden" name="details" id="quill-content"> -->
                <textarea name="details" id="editor">{!! $details ?? '' !!}</textarea>
                <input type="hidden" name="details" id="details">
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
    ClassicEditor
        .create(document.querySelector('#editor'), {
            ckfinder: {
                uploadUrl: "{{ route('admin.donar.upload.image', ['_token' => csrf_token()]) }}"
            },
            toolbar: {
                items: [
                    'undo', 'redo', '|', 'heading', '|', 'bold', 'italic', '|', 'blockQuote', '|',
                    'bulletedList', 'numberedList', '|',
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
