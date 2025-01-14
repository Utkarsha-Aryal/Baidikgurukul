@extends('backend.layouts.main')

@section('title')
    Service
@endsection
<style>
    input#trashed_file {
        border: 1px solid rgb(0, 99, 198) !important
    }
</style>
@section('main-content')
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <div class="my-auto">
            <h5 class="page-title fs-21 mb-1">Services</h5>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Services</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pe-1 mb-xl-0">
                <button type="button" class="btn btn-primary editService" data-id="" data-bs-toggle="modal"
                    data-bs-target="#serviceModal"><i class="fa fa-add"></i> Add</button>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="serviceModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                {{-- Content goes here --}}
            </div>
        </div>
    </div>
    <!-- Page Header Close -->
    {{-- crop modal-start --}}

    <div class="modal cropModel fade" id="cropModel" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Crop Image</h5>
                    <button type="button" class="closeCrop" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-12">
                                <img id="image" src="#" style="height: 200px; width: 250px;">
                            </div>
                            <div class="col-md-12">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
                    <div id="controls">
                        <button id="rotateLeft">Rotate Left</button>
                        <button id="rotateRight">Rotate Right</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn_btn cancel_btn cancelCrop" id="cancelCrop">Cancel</button>
                    <button type="button" class="btn_btn submit_btn" id="cropImage">Crop</button>
                </div>
            </div>
        </div>
    </div>
    {{-- crop modal-end --}}
    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Service List
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
                                        <table id="serviceTable"
                                            class="table table-bordered text-nowrap w-100 dataTable no-footer mt-3"
                                            aria-describedby="datatable-basic_info">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Title</th>
                                                    <th>Details</th>
                                                    <th>Thumbnail Image</th>
                                                    <th>Feature Image</th>
                                                    <th>Order</th>
                                                    {{-- <th>Icon</th> --}}
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
    {{-- crop image-start --}}
    <script>
        var cropper;
        $(document).ready(function() {

            //cancel Crop Model --Start
            $('.cancelCrop').off('click', '');
            $('.cancelCrop').on('click', function(e) {

                var thumbnail_image = $('.thumbnail_image')[0].files[0];
                $('._image').attr('src', URL.createObjectURL(thumbnail_image));
                $('#cropModel').modal('hide');
            });
            //close Model --End

            //to pass image url to crop model ---Start
            $('.thumbnail_image').off('change');
            $('.thumbnail_image').on("change", function(e) {
                var files = e.target.files;
                var done = function(url) {
                    $('#image').attr('src', url);
                    $('#cropModel').modal('show');
                };
                var reader;
                var file;
                var url;

                if (files && files.length > 0) {
                    file = files[0];
                    if (URL) {
                        done(URL.createObjectURL(file));
                    }
                }
            });
            //to pass image url to crop model ---End


            //to crop images---Start
            $('#cropModel').off('shown.bs.modal');
            $('#cropModel').on('shown.bs.modal', function() {
                var image = document.getElementById('image');

                cropper = new Cropper(image, {
                    initailAspectRatio: 1,
                    aspectRatio: 1,
                    viewMode: 1,
                    moveable: false,
                    zoomOnWheel: false,

                    preview: '.preview',
                });


                $("#rotateRight").on("click", e => {
                    cropper.rotate(90);
                });

                $("#rotateLeft").on("click", e => {
                    cropper.rotate(-90);
                });
            }).on('hidden.bs.modal', function() {
                cropper.destroy();
                cropper = null;
            });
            //to crop images---End

            //save crop image ---Start
            var base64data;
            $('#cropImage').off('click');
            $('#cropImage').on('click', function() {

                canvas = cropper.getCroppedCanvas({
                    width: 160,
                    height: 160,
                });
                canvas.toBlob(function(blob) {
                    url = URL.createObjectURL(blob);
                    $('._image').attr('src', url);
                    var reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function() {
                        base64data = reader.result;
                        $('#cropModel').modal('hide');
                        $('#croppedImg').val(base64data);
                    }
                })
            });
            //save crop image ---End
        });
        // crop image-end 
        var serviceTable;
        $(document).ready(function() {

            serviceTable = $('#serviceTable').DataTable({
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
                        "data": "details"
                    },
                    {
                        "data": "thumbnail_image"
                    },
                    {
                        "data": "feature_image"
                    },
                    {
                        "data": "order"
                    },
                    // {
                    //     "data": "icon"
                    // },

                    {
                        "data": "action"
                    },
                ],
                "ajax": {
                    "url": '{{ route("admin.service.list") }}',
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


            // Edit service
            $(document).off('click', '.editService');
            $(document).on('click', '.editService', function() {
                var id = $(this).data('id');
                var url = '{{ route('admin.service.form') }}';
                var data = {
                    id: id
                };
                $.post(url, data, function(response) {
                    $('#serviceModal .modal-content').html(response);
                    $('#serviceModal').modal('show');
                });
            });


            // view trashed items-start
            $('#trashed_file').off('change');
            $('#trashed_file').on('change', function(e) {
                serviceTable.draw();
            });
            // view trashed items-ends


            // Delete service
            $(document).off('click', '.deleteService');
            $(document).on('click', '.deleteService', function() {
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
                        showLoader();
                        var id = $(this).data('id');
                        var data = {
                            id: id,
                            type: type,
                        };
                        var url = '{{ route('admin.service.delete') }}';
                        $.post(url, data, function(response) {
                            var result = JSON.parse(response);
                            if (result) {
                                if (result.type === 'success') {
                                    showNotification(result.message, 'success');
                                    serviceTable.draw();
                                    hideLoader();
                                } else {
                                    showNotification(result.message, 'error');
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
