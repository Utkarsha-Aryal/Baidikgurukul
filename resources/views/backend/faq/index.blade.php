@extends('backend.layouts.main')

@section('title')
    FAQ
@endsection

@section('styles')
    <style>
        .iconpicker-popover.popover.bottom {
            opacity: 1;
        }

        label#file_input-error {
            position: absolute;
            top: 8.3rem !important;
            left: 1rem;
        }
    </style>
@endsection

@section('main-content')
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <div class="my-auto">
            <h5 class="page-title fs-21 mb-1">FAQ</h5>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="faqModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                {{-- Content goes here --}}
            </div>
        </div>
    </div>
    <!-- Page Header Close -->

    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-4">
            <div class="card custom-card">
                <form action="{{ route('admin.faq.save') }}" method="POST" id="faq-form" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row gy-4">

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <input type="hidden" name="id" value="" id="id">
                                <label for="question" class="form-label">Question <span
                                        class="required-field">*</span></label>
                                <input type="text" class="form-control" id="question" placeholder="Enter question..."
                                    name="question">
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <input type="hidden" name="id" value="" id="id">
                                <label for="answer" class="form-label">Answer <span
                                        class="required-field">*</span></label>
                                <input type="text" class="form-control" id="answer" placeholder="Enter answer..."
                                    name="answer">
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="order_number" class="form-label">Order <span
                                        class="required-field">*</span></label>
                                <input type="number" class="form-control" id="order_number" placeholder="Enter order..."
                                    name="order_number">
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
                        faqs List
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
                                        <table id="faqTable"
                                            class="table table-bordered text-nowrap w-100 dataTable no-footer mt-3"
                                            aria-describedby="datatable-basic_info">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Question</th>
                                                    <th>Answer</th>
                                                    <th>Order</th>
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
        var faqTable;
        $(document).ready(function() {
            faqTable = $('#faqTable').DataTable({
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
                        "data": "question"
                    },
                    {
                        "data": "answer"
                    },
                    {
                        "data": "order_number"
                    },
                    {
                        "data": "action"
                    },
                ],
                "ajax": {
                    "url": '{{ route('admin.faq.list') }}',
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

            // Save faq

            //upload image

            $('#file_input').on('change', function(event) {
                var selectedFile = event.target.files[0];
                if (selectedFile) {
                    $('._image').attr('src', URL.createObjectURL(selectedFile));
                }
            });
            //end upload image

            $('#faq-form').validate({
                rules: {
                    question: "required",
                    answer: "required",
                    order_number: "required",
                },
                message: {
                    question: {
                        required: "This field is required."
                    },
                    answer: {
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

            // Save faq
            $(document).off('click', '.saveData');
            $(document).on('click', '.saveData', function() {
                if ($('#faq-form').valid()) {
                    showLoader();
                    $('#faq-form').ajaxSubmit({
                        success: function(response) {
                            if (response) {
                                if (response.type === 'success') {
                                    $('.saveData').html('<i class="fa fa-save"></i> Save');
                                    showNotification(response.message, 'success');
                                    hideLoader();
                                    faqTable.draw();
                                    $('#faq-form')[0].reset();
                                    $('#id').val('');
                                    $('._image').attr('src', "{{ asset('/no-image.jpg') }}");
                                } else {
                                    showNotification(response.message, 'error');
                                    hideLoader();
                                }
                            } else {
                                hideLoader();
                            }
                        },
                        error: function(xhr) {
                            hideLoader();
                            var response = xhr.responseJSON;
                            showNotification(response && response.message ? response.message :
                                'An error occurred', 'error');
                        }
                    });
                }
            });

            // update faq
            $(document).off('click', '.edit');
            $(document).on('click', '.edit', function() {
                var id = $(this).data('id');
                var answer = $(this).data('answer');
                var question = $(this).data('question');
                var order_number = $(this).data('order_number');
                $('#faq-form input[name = "id"]').val(id);
                $('#faq-form input[name = "answer"]').val(answer);
                $('#faq-form input[name = "question"]').val(question);
                $('#faq-form input[name = "order_number"]').val(order_number);
                $('.saveData').html('<i class="fa fa-save"></i> Update');
            });


            // view trashed items-start
            $('#trashed_file').off('change');
            $('#trashed_file').on('change', function(e) {
                faqTable.draw();
            });
            // view trashed items-ends

            // Delete faq
            $(document).on('click', '.delete', function(e) {
                e.preventDefault();

                var type = $('#trashed_file').is(':checked') == true ? 'trashed' :
                    'nottrashed';
                Swal.fire({
                    title: type === "nottrashed" ? "Are you sure you want to delete this FAQ?" :
                        "Are you sure you want to delete permanently  this FAQ?",
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
                        var url = '{{ route('admin.faq.delete') }}';
                        $.post(url, data, function(response) {

                            if (response) {
                                showNotification(response.message, response.type);
                                if (response.type === 'success') {
                                    faqTable.draw();
                                    $('#faq-form')[0].reset();
                                    $('#id').val('');
                                }
                            }
                        });
                    }
                });
            });

            // Restore
            $(document).off('click', '.restore');
            $(document).on('click', '.restore', function() {
                Swal.fire({
                    title: "Are you sure you want to restore Faq?",
                    text: "This will restore the Faq.",
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
                        var url = '{{ route('admin.faq.restore') }}';
                        $.post(url, data, function(response) {
                            if (response) {
                                if (response.type === 'success') {
                                    showNotification(response.message, 'success');
                                    faqTable.draw();
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
