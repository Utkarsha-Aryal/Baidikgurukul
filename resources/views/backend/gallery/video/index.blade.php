<style>
    .buttonItems {
        display: flex;
        justify-content: flex-end;
    }

    input#trashed_file_image,
    #external_link {
        border: 1px solid rgb(0, 99, 198) !important
    }
</style>
<div class="modal-header">
    <h1 class="modal-title fs-5" id="staticBackdropLabel">Videos - {{ @$title }}</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form id="videoForm" method="POST" action="{{ route('admin.gallery.video.save') }}" enctype="multipart/form-data">
        <div class="row d-flex align-items-end">
            <div class="col-md-12">
                <input type="hidden" name="gallery_id" id="gallery_id" value="{{ @$id }}">
                <input type="hidden" name="gallery_video_id" id="edit_id" value="">
                <label for="video" class="form-label">Video URL <span class="required-field">*</span></label>
                <input type="text" class="form-control" name="video" id="video" value="" />
            </div>

            <div class="row mt-3">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <div class="row">
                        <label for="image" class="form-label">Photo </label>
                        <div class="relative" id="edit-image">
                            <div class="profile-user">
                                <label for="image" class="fe fe-camera profile-edit text-primary absolute"></label>
                            </div>
                            <input type="file" class="image" id="image"
                                style="position: absolute; clip: rect(0, 0, 0, 0); pointer-events: none;"
                                accept="image/*"name="image">

                            <div class="img-rectangle mt-2">
                                @if (!empty($image))
                                    {!! $image !!}
                                @else
                                    <img src="{{ asset('/no-image.jpg') }}" alt="Default Image" id="img_introduction"
                                        class="ishan">
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="row mt-2 ms-1">
                        <p class="p-0 m-0">Accepted Format :<span class="text-muted"> jpg/jpeg/png</span></p>
                        <p class="p-0 m-0">File size :<span class="text-muted"> (300x475) in pixels</span></p>
                    </div>
                </div>
                <div class="form-check col-xl-6 col-lg-6 col-md-6 col-sm-6">
                    <input class="form-check-input" type="checkbox" value="Y" id="display_in_home"
                        name="display_in_home" {{ @$display_in_home === 'Y' ? 'checked' : '' }}>
                    <label class="form-check-label" for="display_in_home">
                        Display in home
                    </label>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button class="btn btn-primary" id="saveVideo"><i class="fas fa-save"></i> Save</button>
            </div>
        </div>
    </form>
    <div class="row ms-0">
        <div class="form-check col-xl-12 col-lg-12 col-md-12 col-sm-12 trash">
            <input class="form-check-input" type="checkbox" value="Y" id="trashed_file_image" name="trashed_file">
            <label class="form-check-label" for="trashed_file_image">
                View Trashed
            </label>
        </div>
    </div>
    <div class="row mt-4">
        <div class="table-responsive">
            <div id="datatable-basic_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="row">
                    <div class="col-sm-12 col-md-12 mb-3">
                        <div class="dataTables_length" id="datatable-basic_length">
                            <table id="videoTable"
                                class="table table-bordered text-nowrap w-100 dataTable no-footer mt-3"
                                aria-describedby="datatable-basic_info">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Video</th>
                                        <th>Video Image</th>
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
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>


<script>
    $(document).on('click', '.editVideo', function(e) {
        e.preventDefault();
        var video = $(this).data('video');
        var videoUrl = $(this).data('videourl');
        var editId = $(this).data('id');
        $('#video').val(video);
        $('#edit_id').val(editId);
        $('.video-url').html(videoUrl);
    })


    $('#trashed_file_image').off('change');
    $('#trashed_file_image').on('change', function(e) {
        videoTable.draw();
    });

    $('#image').on('change', function(event) {
        var selectedFile = event.target.files[0];

        if (selectedFile) {
            $('.ishan').attr('src', URL.createObjectURL(selectedFile));
        }
    });

    // Save Video gallery
    $('#saveVideo').on('click', function(e) {
        e.preventDefault();
        showLoader();
        $('#videoForm').ajaxSubmit(function(response) {
            var rep = JSON.parse(response);
            if (rep) {
                hideLoader();
                showNotification(rep.message, rep.type);
                if (rep.type === 'success') {
                    videoTable.draw();
                    $('#videoForm')[0].reset();
                    $('#gallery_video_id').val('');
                    $('#image').val('');
                    $('#edit-image .img-rectangle').html(
                        '<img src="{{ asset('/no-image.jpg') }}" alt="Default Image" id="img_introduction" class="ishan">'
                    );

                    $('.video-url').html('');
                }
            } else {
                hideLoader();
            }
        });
    });

    // Delete gallery  video
    $(document).on('click', '.deleteVideo', function(e) {
        e.preventDefault();
        Swal.fire({
            title: "Are you sure you want to delete ?",
            text: "You won't be able to revert it!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DB1F48",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                var id = $(this).data('id');
                var type = $('#trashed_file_image').is(':checked') == true ? 'trashed' :
                    'nottrashed';
                var data = {
                    id: id,
                    type: type,
                };
                var url = '{{ route('admin.gallery.video.delete') }}';
                $.post(url, data, function(response) {
                    var rep = JSON.parse(response);
                    if (rep) {
                        showNotification(rep.message, rep.type);
                        if (rep.type === 'success') {
                            $('#imageModel').modal('show');
                            videoTable.draw();
                        }
                    }
                });
            }
        });
    });


    //restore video
    $(document).off('click', '.restoreVideo');
    $(document).on('click', '.restoreVideo', function() {
        Swal.fire({
            title: "Are you sure you want to restore Gallery Video?",
            text: "This will restore the Gallery Video.",
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
                var url = '{{ route('admin.gallery.video.restore') }}';
                $.post(url, data, function(response) {
                    if (response) {
                        if (response.type === 'success') {
                            showNotification(response.message, 'success');
                            videoTable.draw();
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

    // Edit video
    $(document).on('click', '.editVideo', function(e) {
        e.preventDefault();
        var id = $(this).data('id')
        $('#id').val(id);
        $('#video').val($(this).data('video_url'));
        var imageUrl = $(this).data('video_image');
        $('.ishan').attr('src', `{{ asset('/storage/community') }}/${imageUrl}`);
        $('#id').val(id);
        if ((id)) {
            $('.saveData').html('<i class="fa fa-save"></i> Update album');
        }
    });
</script>


<script>
    var videoTable;
    var gallery_id = '{{ @$id }}';
    $(document).ready(function() {

        videoTable = $('#videoTable').DataTable({
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
                "sEmptyTable": "<p class='no_data_message text-center'>No data available.</p>"
            },
            "aoColumnDefs": [{
                "bSortable": false,
                "aTargets": [1]
            }],
            "aoColumns": [{
                    "data": "sno"
                },
                {
                    "data": "video"
                },
                {
                    "data": "video_image"
                },
                {
                    "data": "action"
                },
            ],
            "ajax": {
                "url": '{{ route('admin.gallery.video.list') }}',
                "type": "POST",
                "data": function(d) {
                    var type = $('#trashed_file_image').is(':checked') == true ? 'trashed' :
                        'nottrashed';
                    d.gallery_id = gallery_id;
                    d.type = type;
                }
            }
        });

    });
</script>
