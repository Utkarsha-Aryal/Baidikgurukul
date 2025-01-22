@extends('backend.layouts.main')

@section('title')
    Time Interval
@endsection

<style>
    .req {
        color: red;
    }
</style>

@section('main-content')
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <div class="my-auto">
            <h5 class="page-title fs-21 mb-1"> Time Interval </h5>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> Time Interval </li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header Close -->

    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-4">
            <div class="card custom-card">
                <form action="{{ route('admin.timeinterval.save') }}" method="POST" id="time-form"
                    enctype="multipart/form-data">
                    <div class="card-body">

                        <div class="row gy-4">
                            <!-- Starting Year -->
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="yearSelectstart" class="form-label">Select Starting Year <span
                                        class="req">*</span></label>
                                <select class="form-select" id="yearSelectstart" name="start_date"></select>
                                <input type="hidden" name="id" value="" id="id">
                            </div>
                        </div>


                        <div class="row mt-2">

                            <!-- Ending Year -->
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="yearSelectend" class="form-label">Select Ending Year <span
                                        class="req">*</span></label>
                                <select class="form-select" id="yearSelectend" name="end_date"></select>
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
                        Time Interval List
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
                                        <table id="time_interval_table"
                                            class="table table-bordered text-nowrap w-100 dataTable no-footer mt-3"
                                            aria-describedby="datatable-basic_info">
                                            <thead>
                                                <tr>
                                                    <th width="5%">S.No</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th width="10%">Action</th>
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
    <script>
        const currentYear = new Date().getFullYear();

        const startYear = currentYear + 25;
        const endYear = currentYear + 75;

        const yearSelectStart = document.getElementById('yearSelectstart');

        const emptyOption = document.createElement('option');
        emptyOption.value = "";
        emptyOption.textContent = "Select a Year";
        emptyOption.selected = true;
        emptyOption.disabled = true;
        yearSelectStart.appendChild(emptyOption);

        for (let year = startYear; year <= endYear; year++) {
            const option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            yearSelectStart.appendChild(option);
        }

        const startYearEnd = currentYear + 25;
        const endYearEnd = currentYear + 75;

        const yearSelectEnd = document.getElementById('yearSelectend');

        const emptyOptionEnd = document.createElement('option');
        emptyOptionEnd.value = "";
        emptyOptionEnd.textContent = "Select a Year";
        emptyOptionEnd.selected = true;
        emptyOptionEnd.disabled = true;
        yearSelectEnd.appendChild(emptyOptionEnd);

        for (let year = startYearEnd; year <= endYearEnd; year++) {
            const option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            yearSelectEnd.appendChild(option);
        }


        var time_interval_table;
        $(document).ready(function() {
            time_interval_table = $('#time_interval_table').DataTable({
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
                        "data": "start_date"
                    },
                    {
                        "data": "end_date"
                    },
                    {
                        "data": "action"
                    },
                ],
                "ajax": {
                    "url": '{{ route('admin.timeinterval.list') }}',
                    "type": "POST",
                    "data": function(d) {
                        var type = $('#trashed_file').is(':checked') == true ? 'trashed' : 'nottrashed';
                        d.type = type;
                    }
                },
            });

            $('#time-form').validate({
                rules: {
                    start_date: {
                        required: true,
                    },
                    end_date: {
                        required: true,
                    },
                },
                messages: {
                    start_date: {
                        required: "Please select a starting year.",
                    },
                    end_date: {
                        required: "Please select an ending year.",
                    },
                },
                highlight: function(element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid');
                },
                errorPlacement: function(error, element) {
                    error.addClass('text-danger');
                    element.closest('.col-xl-12').append(error);
                },
            });

            // Save Data Logic
            $('.saveData').off('click');
            $('.saveData').on('click', function() {
                if ($('#time-form').valid()) {
                    showLoader();
                    $('#time-form').ajaxSubmit(function(response) {
                        var result = JSON.parse(response);
                        if (result) {
                            if (result.type === 'success') {
                                $('.saveData').html('<i class="fa fa-save"></i> Save');
                                showNotification(result.message, 'success');
                                hideLoader();
                                time_interval_table.draw();
                                $('#time-form')[0].reset();
                                $('#id').val('');
                                $('#yearSelectstart').val('');
                                $('#yearSelectend').val('');
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


            // update Team Category
            $(document).on('click', '.edit', function(e) {
                e.preventDefault();
                $('#id').val($(this).data('id'));
                $('.saveData').html('<i class="fa fa-save"></i> Update');
                $('#yearSelectstart').val($(this).data('start_date'));
                $('#yearSelectend').val($(this).data('end_date'));
            });


            // view trashed items-start
            $('#trashed_file').off('change');
            $('#trashed_file').on('change', function(e) {
                time_interval_table.draw();
            });
            // view trashed items-ends

            // Delete Team Category
            $(document).off('click', '.delete');
            $(document).on('click', '.delete', function() {

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
                        var url = '{{ route('admin.timeinterval.delete') }}';
                        $.post(url, data, function(response) {
                            var rep = JSON.parse(response);
                            if (rep) {
                                showNotification(rep.message, rep.type);
                                if (rep.type === 'success') {
                                    time_interval_table.draw();
                                    $('#time-form')[0].reset();
                                    $('#yearSelectstart').val('');
                                    $('#yearSelectend').val('');
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
                    title: "Are you sure you want to restore Time Interval?",
                    text: "This will restore the Time Interval.",
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
                        var url = '{{ route('admin.timeinterval.restore') }}';
                        $.post(url, data, function(response) {
                            if (response) {
                                if (response.type === 'success') {
                                    showNotification(response.message, 'success');
                                    time_interval_table.draw();
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
