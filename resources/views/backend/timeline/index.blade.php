@extends('backend.layouts.main')

@section('title')
    Timeline datepicker
@endsection
<style>
    .iconpicker-popover.popover.bottom {
        opacity: 1;
    }

    .datepicker {
        margin-top: 243px !important;
    }

    input#trashed_file {
        border: 1px solid rgb(0, 99, 198) !important
    }
</style>
@section('main-content')
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <div class="my-auto">
            <h5 class="page-title fs-21 mb-1">Timeline</h5>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Timeline</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header Close -->

    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-4">
            <div class="card custom-card">
                <form action="{{ route('admin.timeline.save') }}" method="POST" id="timeline-form"
                    enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row gy-3">

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <input type="hidden" name="id" value="" id="id">
                                <label for="year" class="form-label">Year <span class="required-field">*</span></label>
                                <input type="text" class="form-control" id="datepicker" placeholder="Select date"
                                    name="year" autocomplete="off" />
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="details" class="form-label">Details <span
                                        class="required-field">*</span></label>
                                <textarea class="form-control" id="details" name="details" rows="5" placeholder="Enter details..."></textarea>
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
                        Timelines List
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
                                        <table id="timelineTable"
                                            class="table table-bordered text-nowrap w-100 dataTable no-footer mt-3"
                                            aria-describedby="datatable-basic_info">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Year</th>
                                                    <th>Details</th>
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
        var timelineTable;
        $(document).ready(function() {
            timelineTable = $('#timelineTable').DataTable({
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
                        "data": "year"
                    },
                    {
                        "data": "details"
                    },
                    {
                        "data": "order_number"
                    },

                    {
                        "data": "action"
                    },
                ],
                "ajax": {
                    "url": '{{ route('admin.timeline.list') }}',
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

            // display only year -start

            $("#datepicker").datepicker({
                format: " yyyy",
                viewMode: "years",
                minViewMode: "years"
                // autoclose: true,
            }).on('changeDate', function(e) {
                $(this).datepicker('hide');
            });
            // display only year -end

            $('#timeline-form').validate({
                rules: {

                    year: "required",
                    details: "required",
                    order_number: "required",
                },
                message: {
                    year: {
                        required: "This field is required."
                    },

                    details: {
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

            // Save timeline
            $('.saveData').off('click');
            $('.saveData').on('click', function() {
                if ($('#timeline-form').valid()) {
                    showLoader();
                    $('#timeline-form').ajaxSubmit(function(response) {
                        var result = JSON.parse(response);
                        if (result) {
                            if (result.type === 'success') {
                                $('.saveData').html('<i class="fa fa-save"></i> Save');
                                showNotification(result.message, 'success');
                                hideLoader();
                                timelineTable.draw();
                                $('#timeline-form')[0].reset();
                                $('#id').val('');

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

            // update timeline
            $(document).on('click', '.edittimeline', function(e) {
                e.preventDefault();
                $('#id').val($(this).data('id'));
                $('.saveData').html('<i class="fa fa-save"></i> Update');
                $('#datepicker').val($(this).data('year'));
                $('#details').val($(this).data('details'));
                $('#order_number').val($(this).data('order_number'));
            });


            // view trashed items-start
            $('#trashed_file').off('change');
            $('#trashed_file').on('change', function(e) {
                timelineTable.draw();
            });
            // view trashed items-ends


            // Delete timeline
            $(document).off('click', '.deletetimeline');
            $(document).on('click', '.deletetimeline', function() {

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
                        var url = '{{ route('admin.timeline.delete') }}';
                        $.post(url, data, function(response) {
                            var result = JSON.parse(response);
                            if (result) {
                                showNotification(result.message, result.type);
                                if (result.type === 'success') {
                                    timelineTable.draw();
                                    $('#timeline-form')[0].reset();
                                    $('#id').val('');
                                }
                            }
                        });
                    }
                });
            });


            //restore
            $(document).off('click', '.restore');
            $(document).on('click', '.restore', function() {
                Swal.fire({
                    title: "Are you sure you want to restore Timeline?",
                    text: "This will restore the Timeline.",
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
                        var url = '{{ route('admin.timeline.restore') }}';
                        $.post(url, data, function(response) {
                            if (response) {
                                if (response.type === 'success') {
                                    showNotification(response.message, 'success');
                                    timelineTable.draw();
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
