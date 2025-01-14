@extends('backend.layouts.main')

@section('title')
    Testimonial
@endsection
<style>
    .iconpicker-popover.popover.bottom {
        opacity: 1;
    }

    input#trashed_file {
        border: 1px solid rgb(0, 99, 198) !important
    }

    label#file_input-error {
        position: absolute;
        top: 8.3rem !important;
        left: 1rem;
    }
</style>
@section('main-content')
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <div class="my-auto">
            <h5 class="page-title fs-21 mb-1">Testimonial</h5>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Testimonial</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header Close -->

    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-4">
            <div class="card custom-card">
                <form action="{{ route('admin.testimonial.save') }}" method="POST" id="testimonial-form"
                    enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row gy-4">

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <input type="hidden" name="id" value="" id="id">
                                <label for="name" class="form-label">Name <span class="required-field">*</span></label>
                                <input type="text" class="form-control" id="name" placeholder="Enter name..."
                                    name="name">
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="designation" class="form-label">Designation </label>
                                <input type="text" class="form-control" id="designation" placeholder="Enter designation..."
                                    name="designation">
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="review" class="form-label">Review <span
                                        class="required-field">*</span></label>
                                <textarea class="form-control" id="review" name="review" rows="3" placeholder="Enter review..."></textarea>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="review" class="form-label">Rating <span
                                        class="required-field">*</span></label>
                                <select class="form-select" aria-label="Default select example" id="rating"
                                    name="rating">
                                    <option value="5" {{ !empty($rating) && $rating === '5' ? 'selected' : '' }}>5
                                    </option>
                                    <option value="4" {{ !empty($rating) && $rating === '4' ? 'selected' : '' }}>4
                                    </option>
                                    <option value="3" {{ !empty($rating) && $rating === '3' ? 'selected' : '' }}>3
                                    </option>
                                    <option value="2" {{ !empty($rating) && $rating === '2' ? 'selected' : '' }}>2
                                    </option>
                                    <option value="1" {{ !empty($rating) && $rating === '1' ? 'selected' : '' }}>1
                                    </option>
                                </select>
                            </div>
                            <div class="row mt-2">
                                <label for="review" class="form-label">Photo <span class="required-field">*</span></label>
                                <div class="col-10 relative" id="edit-image">

                                    <div class="profile-user">
                                        <label for="file_input"
                                            class="fe fe-camera profile-edit text-primary absolute"></label>
                                    </div>
                                    <input type="file" class="file_input" id="file_input"
                                        style="position: absolute; clip: rect(0, 0, 0, 0); pointer-events: none;"
                                        accept="image/*"name="image">

                                    <div id="edit_image">
                                        @if (!empty($image))
                                            {!! $image !!}
                                        @else
                                            <img src="{{ asset('/no-image.jpg') }}" width="160px" alt="Default Image"
                                                class='edit_image'>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4 ms-1">
                                <p class="p-0 m-0">Accepted Format :<span class="text-muted"> jpg/jpeg/png</span></p>
                                <p class="p-0 m-0">File size :<span class="text-muted"> (300x475) in pixels</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button type="button" class="btn btn-primary saveData"><i class="fa fa-save"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Testimonials List
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
                                        <table id="testimonialTable"
                                            class="table table-bordered text-nowrap w-100 dataTable no-footer mt-3"
                                            aria-describedby="datatable-basic_info">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Name</th>
                                                    <th>Designation</th>
                                                    <th>Review</th>
                                                    <th>Rating</th>
                                                    <th>Image</th>
                                                    <th>Action</th>
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
    <script>
        var testimonialTable;
        $(document).ready(function() {
            testimonialTable = $('#testimonialTable').DataTable({
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
                        "data": "name"
                    },
                    {
                        "data": "designation"
                    },
                    {
                        "data": "review"
                    },
                    {
                        "data": "rating"
                    },
                    {
                        "data": "image"
                    },
                    {
                        "data": "action"
                    },
                ],
                "ajax": {
                    "url": '{{ route('admin.testimonial.list') }}',
                    "type": "POST",
                    "data": function(d) {
                        var type = $('#trashed_file').is(':checked') == true ? 'trashed' :
                            'nottrashed';
                        d.type = type;
                    }
                },
                "initComplete": function() {
                    // Ensure text input fields in the header for specific columns with placeholders
                    this.api().columns([1]).every(function() {
                        var column = this;
                        var input = document.createElement("input");
                        var columnName = column.header().innerText.trim();
                        // Append input field to the header, set placeholder, and apply CSS styling
                        $(input).appendTo($(column.header()).empty())
                            .attr('placeholder', columnName).css('width',
                                '100%') // Set width to 100%
                            .addClass(
                                'search-input-highlight') // Add a CSS class for highlighting
                            .on('keyup change', function() {
                                column.search(this.value).draw();
                            });
                    });
                }
            });

            // Save testimonial

            //upload image

            $('#file_input').on('change', function(event) {
                var selectedFile = event.target.files[0];

                if (selectedFile) {
                    $('.edit_image').attr('src', URL.createObjectURL(selectedFile));
                }
            });
            //end upload image

            $('#testimonial-form').validate({
                rules: {
                    name: "required",
                    review: "required",
                    rating: "required",
                    image: {
                        required: function() {
                            var id = $('#id').val();
                            return id === '';
                        }
                    }
                },
                message: {
                    name: {
                        required: "This field is required."
                    },
                    review: {
                        required: "This field is required."
                    },
                    rating: {
                        required: "This field is required."
                    },
                    image: {
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

            // Save testimonial
            $(document).off('click', '.saveData');
            $(document).on('click', '.saveData', function() {

                if ($('#testimonial-form').valid()) {
                    showLoader();
                    $('#testimonial-form').ajaxSubmit(function(response) {
                        var result = JSON.parse(response);
                        if (result) {
                            if (result.type === 'success') {
                                $('.saveData').html('<i class="fa fa-save"></i> Save');
                                showNotification(result.message, 'success');
                                hideLoader();
                                testimonialTable.draw();
                                $('#testimonial-form')[0].reset();
                                $('#id').val('');
                                $('.edit_image').attr('src', '{{ asset('/no-image.jpg') }}');
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

            // update testimonial
            $(document).on('click', '.editTestimonial', function(e) {
                e.preventDefault();
                $('#id').val($(this).data('id'));
                $('.saveData').html('<i class="fa fa-save"></i> Update');
                $('#name').val($(this).data('name'));
                $('#designation').val($(this).data('designation'));
                $('#review').val($(this).data('review'));
                $('#rating').val($(this).data('rating'));
                $('#image').val($(this).data('image'));
                var imageUrl = $(this).data('image');
                $('.edit_image').attr('src', `{{ asset('/storage/testimonial') }}/${imageUrl}`);
            });


            // view trashed items-start
            $('#trashed_file').off('change');
            $('#trashed_file').on('change', function(e) {
                testimonialTable.draw();
            });
            // view trashed items-ends

            // Delete testimonial
            $(document).on('click', '.deleteTestimonial', function(e) {
                e.preventDefault();

                var type = $('#trashed_file').is(':checked') == true ? 'trashed' :
                    'nottrashed';

                Swal.fire({
                    title: type === "nottrashed" ? "Are you sure you want to delete this item" :
                        "Are you sure you want to delete permanently  this item",
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
                        var url = '{{ route('admin.testimonial.delete') }}';
                        $.post(url, data, function(response) {
                            var rep = JSON.parse(response);
                            if (rep) {
                                showNotification(rep.message, rep.type);
                                if (rep.type === 'success') {
                                    testimonialTable.draw();
                                    $('#testimonial-form')[0].reset();
                                    $('#id').val('');
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
