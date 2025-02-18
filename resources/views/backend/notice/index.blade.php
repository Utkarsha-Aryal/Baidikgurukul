@extends('backend.layouts.main')

@section('title')
    Notice
@endsection

<style>
    .iconpicker-popover.popover.bottom {
        opacity: 1;
    }

    input#trashed_file {
        border: 1px solid rgb(0, 99, 198) !important;
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
</style>

@section('main-content')
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <div class="my-auto">
            <h5 class="page-title fs-21 mb-1">Notice</h5>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Notice</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header Close -->

    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-4">
            <div class="card custom-card">
                <form action="{{ route('admin.notice.save') }}" method="POST" id="notice_form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row gy-4">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <input type="hidden" name="id" value="" id="id">
                                <label for="title" class="form-label">Title<span class="required-field">*</span></label>
                                <input type="text" class="form-control" id="title" placeholder="Enter title"
                                    name="title">
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="order_number" class="form-label">Order <span
                                        class="required-field">*</span></label>
                                <input type="number" class="form-control" id="order_number"
                                    placeholder="Enter notice order" name="order_number">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <label for="start_date" class="form-label">Starting Date<span
                                        class="required-field">*</span></label>
                                <input type="date" class="form-control" id="start_date" placeholder="Enter starting date"
                                    name="start_date">
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <label for="end_date" class="form-label">Ending Date<span
                                        class="required-field">*</span></label>
                                <input type="date" class="form-control" id="end_date" placeholder="Enter ending date"
                                    name="end_date">
                            </div>

                            {{-- <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="row">
                                    <label for="description" class="form-label">
                                        Images
                                        <input class="form-control mt-2" type="file" name="feature_images[]"
                                            id="feature_images" multiple>
                                    </label>
                                </div>
                                <div class="row mt-2 ms-1">
                                    <p class="p-0 m-0">Multiple Images Can Be Uploaded </p>
                                    <p class="p-0 m-0">Accepted Format :<span class="text-muted"> jpg/jpeg/png</span>
                                    </p>
                                </div>

                                <div class="row">
                                    <div id="imagePreviewContainer"></div>
                                </div>
                            </div> --}}

                            <div class="row mt-2">
                                <label for="photo" class="form-label">Photo</label>
                                <div class="col-10 relative" id="edit-image">

                                    <div class="profile-user">
                                        <label for="file_input"
                                            class="fe fe-camera profile-edit text-primary absolute"></label>
                                    </div>
                                    <input type="file" class="file_input" id="file_input"
                                        style="position: absolute; clip: rect(0, 0, 0, 0); pointer-events: none;"
                                        accept="image/*" name="image">
                                    <img id="upload-image" src="{{ asset('/no-image.jpg') }}" width="160px"
                                        alt="Default Image" class='_image'>
                                </div>
                            </div>
                            <div class="row mt-4 ms-1">
                                <p class="p-0 m-0">Accepted Format :<span class="text-muted"> jpg/jpeg/png</span></p>
                                <p class="p-0 m-0">File size :<span class="text-muted"> 512KB </span></p>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button type="button" class="btn btn-primary saveData"><i class="fa fa-save"></i>
                            Save</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Notice List
                    </div>
                    <div class="row ms-0">
                        <div class="form-check col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <input class="form-check-input" type="checkbox" value="Y" id="trashed_file"
                                name="trashed_file">
                            <label class="form-check-label" for="trashed_file">
                                View Trashed
                            </label>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="datatable-basic_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 mb-3">
                                    <div class="dataTables_length" id="datatable-basic_length">
                                        <table id="noticeTable"
                                            class="table table-bordered text-nowrap w-100 dataTable no-footer mt-3"
                                            aria-describedby="datatable-basic_info">
                                            <thead>
                                                <tr>
                                                    <th width="5%">S.No</th>
                                                    <th width="65%">Title</th>
                                                    <th width="5%">Order</th>
                                                    <th width="5%">Starting Date</th>
                                                    <th width="5%">Endging Date</th>
                                                    <th width="5%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End::row-1 -->
@endsection

@section('script')
    <!-- Ensure CSRF token is sent with all AJAX requests -->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script>
        var noticeTable;
        $(document).ready(function() {
            // Initialize DataTable
            noticeTable = $('#noticeTable').DataTable({
                "sPaginationType": "full_numbers",
                "bSearchable": false,
                "lengthMenu": [
                    [5, 10, 15, 20, 25, -1],
                    [5, 10, 15, 20, 25, "All"]
                ],
                'iDisplayLength': 15,
                "sDom": 'ltipr',
                "bAutoWidth": false,
                "aaSorting": [
                    [0, 'desc']
                ],
                "bSort": false,
                "bProcessing": true,
                "bServerSide": true,
                "oLanguage": {
                    "sEmptyTable": "<p class='no_data_message'>No data available.</p>"
                },
                "aoColumnDefs": [{
                    "bSortable": false,
                    "aTargets": [1]
                }],
                "aoColumns": [{
                        "data": "sno"
                    },
                    {
                        "data": "title"
                    },
                    {
                        "data": "order_number"
                    },
                    {
                        "data": "start_date"
                    },
                    {
                        "data": "end_date"
                    },
                    {
                        "data": "action"
                    }
                ],
                "ajax": {
                    "url": '{{ route('admin.notice.list') }}',
                    "type": "POST",
                    "data": function(d) {
                        // CSRF token is already set in headers via $.ajaxSetup
                        var type = $('#trashed_file').is(':checked') ? 'trashed' : 'nottrashed';
                        d.type = type;
                    }
                },
                "initComplete": function() {
                    // Create a search input in the header for column 1
                    this.api().columns([1]).every(function() {
                        var column = this;
                        var input = document.createElement("input");
                        var columnName = column.header().innerText.trim();
                        $(input).appendTo($(column.header()).empty())
                            .attr('placeholder', columnName)
                            .css('width', '100%')
                            .addClass('search-input-highlight')
                            .on('keyup change', function() {
                                column.search(this.value).draw();
                            });
                    });
                }
            });

            $('#file_input').on('change', function(event) {
                var selectedFile = event.target.files[0];
                if (selectedFile) {
                    $('._image').attr('src', URL.createObjectURL(selectedFile));
                }
            });

            // Form Validation
            $('#notice_form').validate({
                rules: {
                    title: "required",
                    order_number: "required",
                    start_date: "required",
                    end_date: "required",
                    image: {
                        required: function() {
                            return $('#id').val() === '';
                        }
                    }
                },
                messages: {
                    title: {
                        required: "This field is required."
                    },
                    order_number: {
                        required: "This field is required."
                    },
                    start_date: {
                        required: "This field is required."
                    },
                    end_date: {
                        required: "This field is required."
                    }
                },
                highlight: function(element) {
                    $(element).addClass("border-danger");
                },
                unhighlight: function(element) {
                    $(element).removeClass("border-danger");
                }
            });

            // Save Notice
            $('.saveData').off('click').on('click', function() {
                if ($('#notice_form').valid()) {
                    showLoader();
                    $('#notice_form').ajaxSubmit(function(response) {
                        var result = JSON.parse(response);
                        if (result) {
                            if (result.type === 'success') {
                                $('.saveData').html('<i class="fa fa-save"></i> Save');
                                showNotification(result.message, 'success');
                                hideLoader();
                                noticeTable.draw();
                                $('#notice_form')[0].reset();
                                $('#id').val('');
                                $('._image').attr('src', "{{ asset('/no-image.jpg') }}");
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

            // Edit Notice

            $(document).on('click', '.edit_notice', function(e) {
                e.preventDefault();

                // Populate basic form fields
                let noticeId = $(this).data('id');
                $('#id').val(noticeId);
                $('.saveData').html('<i class="fa fa-save"></i> Update');
                $('#title').val($(this).data('title'));
                $('#start_date').val($(this).data('start_date'));
                $('#end_date').val($(this).data('end_date'));
                $('#order_number').val($(this).data('order_number'));

                // Update the image preview
                var image = $(this).data('image');
                // alert(image);
                var imagePath = image ? `/storage/notice/${image}` : '/no-image.jpg';


                $('#notice_form ._image').attr('src', imagePath);
            });


            // $(document).on('click', '.edit_notice', function(e) {
            //     e.preventDefault();

            //     // Populate basic form fields
            //     let noticeId = $(this).data('id');
            //     $('#id').val(noticeId);
            //     $('.saveData').html('<i class="fa fa-save"></i> Update');
            //     $('#title').val($(this).data('title'));
            //     $('#start_date').val($(this).data('start_date'));
            //     $('#end_date').val($(this).data('end_date'));
            //     $('#order_number').val($(this).data('order_number'));
            //     var image = $(this).data('image');
            //     $('#notice_form ._image').attr('src', image);





            //     //     // Clear previous image previews
            //     //     $('#imagePreviewContainer').html('');

            //     //     // Retrieve the JSON string from the data-image attribute
            //     //     let imagesData = $(this).attr('data-image');
            //     //     alert(imagesData);

            //     //     // Parse the JSON string to an array of image filenames
            //     //     try {
            //     //         let imagesArray = JSON.parse(imagesData);
            //     //         // Loop through the array and append each preview
            //     //         $.each(imagesArray, function(index, image) {
            //     //             let previewHtml = `
        // //     <div class="image-preview" data-image="${image}">
        // //         <img src="/storage/notice/${image}" class="img-thumbnail" width="100" alt="Image Preview">
        // //         <button type="button" class="btn btn-danger btn-sm delete-image" data-image="${image}" data-id="${noticeId}">
        // //             <i class="fa fa-trash"></i>
        // //         </button>
        // //     </div>
        // // `;
            //     //             $('#imagePreviewContainer').append(previewHtml);
            //     //         });
            //     //     } catch (err) {
            //     //         console.error("Error parsing image data:", err);
            //     //     }
            // });

            // // View trashed items
            $('#trashed_file').off('change').on('change', function(e) {
                noticeTable.draw();
            });

            // Delete Notice
            $(document).off('click', '.delete').on('click', '.delete', function() {
                var type = $('#trashed_file').is(':checked') ? 'trashed' : 'nottrashed';
                Swal.fire({
                    title: type === "nottrashed" ?
                        "Are you sure you want to delete this item" :
                        "Are you sure you want to delete permanently this item",
                    text: "You won't be able to revert it!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DB1F48",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        var id = $(this).data('id');
                        var data = {
                            id: id,
                            type: type,
                        };
                        var url = '{{ route('admin.notice.delete') }}';
                        $.post(url, data, function(response) {
                            var rep = JSON.parse(response);
                            if (rep) {
                                showNotification(rep.message, rep.type);
                                if (rep.type === 'success') {
                                    noticeTable.draw();
                                    $('#notice_form')[0].reset();
                                    $('#id').val('');
                                }
                            }
                        });
                    }
                });
            });

            // Restore Notice
            $(document).off('click', '.restore').on('click', '.restore', function() {
                Swal.fire({
                    title: "Are you sure you want to restore Notice?",
                    text: "This will restore the Notice.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#28a745",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Restore it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        showLoader();
                        var id = $(this).data('id');
                        var data = {
                            id: id,
                            type: 'restore'
                        };
                        var url = '{{ route('admin.notice.restore') }}';
                        $.post(url, data, function(response) {
                            if (response) {
                                if (response.type === 'success') {
                                    showNotification(response.message,
                                        'success');
                                    noticeTable.draw();
                                    hideLoader();
                                } else {
                                    showNotification(response.message, 'error');
                                    hideLoader();
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>

    {{-- <script>
        var dt = new DataTransfer();

        $(document).ready(function() {
            $("#feature_images").on("change", function(event) {
                let input = event.target;
                let files = input.files;

                // Loop through each selected file
                for (let i = 0; i < files.length; i++) {
                    let file = files[i];
                    dt.items.add(file);

                    let fileReader = new FileReader();
                    fileReader.onload = function(e) {
                        // Build the preview element with a delete button
                        let preview = $(`
                            <span class="pip">
                                <img class="imageThumb" src="${e.target.result}" title="${file.name}" alt="${file.name}" />
                                <br/>
                                <span class="remove" style="cursor:pointer; color:red;">Delete</span>
                            </span>
                        `);
                        $(preview).insertAfter("#feature_images");
                    };
                    fileReader.readAsDataURL(file);
                }
                // Update the file input's FileList
                input.files = dt.files;
            });

            // Remove file preview and update DataTransfer object on clicking "Delete"
            $(document).on("click", ".remove", function() {
                let fileName = $(this).siblings("img").attr("title");
                $(this).closest(".pip").remove();

                for (let i = 0; i < dt.items.length; i++) {
                    if (dt.items[i].getAsFile().name === fileName) {
                        dt.items.remove(i);
                        break;
                    }
                }
                $("#feature_images")[0].files = dt.files;
            });
        });
    </script> --}}
@endsection
