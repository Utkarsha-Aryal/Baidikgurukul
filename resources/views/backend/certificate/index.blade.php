@extends('backend.layouts.main')

@section('title')
    Certificate/Awards
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
            <h5 class="page-title fs-21 mb-1"> Certificate/Awards</h5>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> Certificate/Awards</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header Close -->

    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-4">
            <div class="card custom-card">
                <form action="{{ route('admin.certificate.save') }}" method="POST" id="certificate_form"
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
                                    placeholder="Enter certificate/award order" name="order_number">
                            </div>
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
                        Certificate List
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
                                        <table id="certificateTable"
                                            class="table table-bordered text-nowrap w-100 dataTable no-footer mt-3"
                                            aria-describedby="datatable-basic_info">
                                            <thead>
                                                <tr>
                                                    <th width="5%">S.No</th>
                                                    <th width="65%">Title</th>
                                                    <th width="5%">Order</th>
                                                    <th width="5%">Image</th>
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
        var certificateTable;
        $(document).ready(function() {
            // Initialize DataTable
            certificateTable = $('#certificateTable').DataTable({
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
                        "data": "image"
                    },
                    {
                        "data": "action"
                    }
                ],
                "ajax": {
                    "url": '{{ route('admin.certificate.list') }}',
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
            $('#certificate_form').validate({
                rules: {
                    title: "required",
                    order_number: "required",
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
                    image: {
                        required: "This field is required."
                    },
                },
                highlight: function(element) {
                    $(element).addClass("border-danger");
                },
                unhighlight: function(element) {
                    $(element).removeClass("border-danger");
                }
            });

            // Save certificate
            $('.saveData').off('click').on('click', function() {
                if ($('#certificate_form').valid()) {
                    showLoader();
                    $('#certificate_form').ajaxSubmit(function(response) {
                        var result = JSON.parse(response);
                        if (result) {
                            if (result.type === 'success') {
                                $('.saveData').html('<i class="fa fa-save"></i> Save');
                                showNotification(result.message, 'success');
                                hideLoader();
                                certificateTable.draw();
                                $('#certificate_form')[0].reset();
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

            // Edit certificate

            $(document).on('click', '.edit_certificate', function(e) {
                e.preventDefault();

                // Populate basic form fields
                let certificateId = $(this).data('id');
                $('#id').val(certificateId);
                $('.saveData').html('<i class="fa fa-save"></i> Update');
                $('#title').val($(this).data('title'));
                $('#order_number').val($(this).data('order_number'));

                // Update the image preview
                var image = $(this).data('image');
                // alert(image);
                var imagePath = image ? `/storage/certificate/${image}` : '/no-image.jpg';


                $('#certificate_form ._image').attr('src', imagePath);
            });


            // // View trashed items
            $('#trashed_file').off('change').on('change', function(e) {
                certificateTable.draw();
            });

            // Delete certificate
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
                        var url = '{{ route('admin.certificate.delete') }}';
                        $.post(url, data, function(response) {
                            var rep = JSON.parse(response);
                            if (rep) {
                                showNotification(rep.message, rep.type);
                                if (rep.type === 'success') {
                                    certificateTable.draw();
                                    $('#certificate_form')[0].reset();
                                    $('#id').val('');
                                }
                            }
                        });
                    }
                });
            });

            // Restore certificate
            $(document).off('click', '.restore').on('click', '.restore', function() {
                Swal.fire({
                    title: "Are you sure you want to restore Certificate?",
                    text: "This will restore the Certificate.",
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
                        var url = '{{ route('admin.certificate.restore') }}';
                        $.post(url, data, function(response) {
                            if (response) {
                                if (response.type === 'success') {
                                    showNotification(response.message,
                                        'success');
                                    certificateTable.draw();
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
@endsection
