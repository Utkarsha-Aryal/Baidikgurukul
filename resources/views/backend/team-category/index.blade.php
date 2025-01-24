@extends('backend.layouts.main')

@section('title')
    Team Category
@endsection
<style>
    .iconpicker-popover.popover.bottom {
        opacity: 1;
    }

    input#trashed_file {
        border: 1px solid rgb(0, 99, 198) !important
    }
</style>
@section('main-content')
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <div class="my-auto">
            <h5 class="page-title fs-21 mb-1">Team Category</h5>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Team Category</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header Close -->

    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-4">
            <div class="card custom-card">
                <form action="{{ route('admin.teamcategory.save') }}" method="POST" id="team_category_form"
                    enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row gy-4">

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <input type="hidden" name="id" value="" id="id">
                                <label for="team_category" class="form-label">Team Category <span
                                        class="required-field">*</span></label>
                                <input type="text" class="form-control" id="team_category"
                                    placeholder="Enter team category" name="team_category">
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="order_number" class="form-label">Order <span
                                        class="required-field">*</span></label>
                                <input type="number" class="form-control" id="order_number" placeholder="Enter team order"
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
                        Team Category List
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
                                        <table id="team_categoryTable"
                                            class="table table-bordered text-nowrap w-100 dataTable no-footer mt-3"
                                            aria-describedby="datatable-basic_info">
                                            <thead>
                                                <tr>
                                                    <th width="5%">S.No</th>
                                                    <th width="75%">Team Category</th>
                                                    <th width="5%">Order</th>
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
    <script>
        var team_categoryTable;
        $(document).ready(function() {
            team_categoryTable = $('#team_categoryTable').DataTable({
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
                        "data": "team_category"
                    },
                    {
                        "data": "order_number"
                    },
                    {
                        "data": "action"
                    },
                ],
                "ajax": {
                    "url": '{{ route('admin.teamcategory.list') }}',
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

            $('#team_category_form').validate({
                rules: {
                    team_category: "required",
                    order_number: "required"
                },
                message: {
                    team_category: {
                        required: "This field is required."
                    },
                    order_number: {
                        required: "This field is required."
                    },
                },
                highlight: function(element) {
                    $(element).addClass("border-danger")
                },
                unhighlight: function(element) {
                    $(element).removeClass("border-danger")
                },
            });

            // Save Team Category
            $('.saveData').off('click');
            $('.saveData').on('click', function() {
                if ($('#team_category_form').valid()) {
                    showLoader();
                    $('#team_category_form').ajaxSubmit(function(response) {
                        var result = JSON.parse(response);
                        if (result) {
                            if (result.type === 'success') {
                                $('.saveData').html('<i class="fa fa-save"></i> Save');
                                showNotification(result.message, 'success');
                                hideLoader();
                                team_categoryTable.draw();
                                $('#team_category_form')[0].reset();
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

            // update Team Category
            $(document).on('click', '.edit_team_category', function(e) {
                e.preventDefault();
                $('#id').val($(this).data('id'));
                $('.saveData').html('<i class="fa fa-save"></i> Update');
                $('#team_category').val($(this).data('team_category'));
                $('#order_number').val($(this).data('order_number'));
            });


            // view trashed items-start
            $('#trashed_file').off('change');
            $('#trashed_file').on('change', function(e) {
                team_categoryTable.draw();
            });
            // view trashed items-ends

            // Delete Team Category
            $(document).off('click', '.delete_team_category');
            $(document).on('click', '.delete_team_category', function() {

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
                        var url = '{{ route('admin.teamcategory.delete') }}';
                        $.post(url, data, function(response) {
                            var rep = JSON.parse(response);
                            if (rep) {
                                showNotification(rep.message, rep.type);
                                if (rep.type === 'success') {
                                    team_categoryTable.draw();
                                    $('#team_category_form')[0].reset();
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
                    title: "Are you sure you want to restore Team Category?",
                    text: "This will restore the Team Category.",
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
                        var url = '{{ route('admin.teamcategory.restore') }}';
                        $.post(url, data, function(response) {
                            if (response) {
                                if (response.type === 'success') {
                                    showNotification(response.message, 'success');
                                    team_categoryTable.draw();
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
