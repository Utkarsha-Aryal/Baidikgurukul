    <div class="row">
        <div class="card-body">
            <div class="mb-4 main-content-label">Personal Information</div>

            <form class="form-horizontal" id="profile_form" action="{{ route('admin.updateprofile') }}" method="POST"
                enctype="multipart/form-data">
                <div class="mb-4 main-content-label">Name</div>
                <div class="form-group mb-3">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label"for="name">User Name</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="name"name="name" placeholder="User Name"
                                value="{{ $userData['name'] }}">
                        </div>
                    </div>
                </div>
                <div class="mb-4 main-content-label">Contact Info</div>
                <div class="form-group mb-3">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label"for="email">Email</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="email" id="email" placeholder="Email"
                                value={{ $userData['email'] }} disabled>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label"for="address">Address</label>
                        </div>
                        <div class="col-md-9">
                            <textarea class="form-control" name="address" rows="2" placeholder="Address" id="address">{{ $userData['address'] }}</textarea>
                        </div>
                    </div>
                </div>
        </div>


        </form>
    </div>
    <div class="card-footer">
        <button type="button" class="btn btn-primary waves-effect waves-light update_profile" id="savedata">Update
            Profile</button>
    </div>
    </div>
    <script>
        $(document).off('click', '#savedata');
        $(document).on('click', '#savedata', function() {
            showLoader();
            $('#profile_form').ajaxSubmit(function(response) {
                var result = JSON.parse(response);
                if (result) {
                    if (result.type === 'success') {
                        showNotification(result.message, 'success');
                        hideLoader();

                    } else {
                        showNotification(result.message, 'error');
                        hideLoader();
                    }
                } else {
                    hideLoader();
                }
            });
        });
    </script>
