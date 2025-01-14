<form class="form-horizontal" id="setting_form" action="{{ route('admin.update') }}" method="POST"
    enctype="multipart/form-data">
    <div class="form-group mb-3">
        <label class="form-label" for="current_password">Current password <span class="required-field">*</span></label>
        <div class="input-group">
            <input type="password" placeholder="Enter current password" id="current_password"name="current_password"
                class="form-control">
            <button class="border-0" type="button" id="show_current_password">
                <svg class="eye_current_password" xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em"
                    viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M2 5.27L3.28 4L20 20.72L18.73 22l-3.08-3.08c-1.15.38-2.37.58-3.65.58c-5 0-9.27-3.11-11-7.5c.69-1.76 1.79-3.31 3.19-4.54zM12 9a3 3 0 0 1 3 3a3 3 0 0 1-.17 1L11 9.17A3 3 0 0 1 12 9m0-4.5c5 0 9.27 3.11 11 7.5a11.8 11.8 0 0 1-4 5.19l-1.42-1.43A9.86 9.86 0 0 0 20.82 12A9.82 9.82 0 0 0 12 6.5c-1.09 0-2.16.18-3.16.5L7.3 5.47c1.44-.62 3.03-.97 4.7-.97M3.18 12A9.82 9.82 0 0 0 12 17.5c.69 0 1.37-.07 2-.21L11.72 15A3.064 3.064 0 0 1 9 12.28L5.6 8.87c-.99.85-1.82 1.91-2.42 3.13" />
                </svg>
            </button>
        </div>
    </div>

    <div class="form-group mb-3">
        <label class="form-label" for="password">New password <span class="required-field">*</span></label>
        <div class="input-group">
            <input type="password" placeholder="Enter new password" id="password"name="password" class="form-control">
            <button class="border-0" type="button"id="show_password">
                <svg class="eye_password" xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em"
                    viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M2 5.27L3.28 4L20 20.72L18.73 22l-3.08-3.08c-1.15.38-2.37.58-3.65.58c-5 0-9.27-3.11-11-7.5c.69-1.76 1.79-3.31 3.19-4.54zM12 9a3 3 0 0 1 3 3a3 3 0 0 1-.17 1L11 9.17A3 3 0 0 1 12 9m0-4.5c5 0 9.27 3.11 11 7.5a11.8 11.8 0 0 1-4 5.19l-1.42-1.43A9.86 9.86 0 0 0 20.82 12A9.82 9.82 0 0 0 12 6.5c-1.09 0-2.16.18-3.16.5L7.3 5.47c1.44-.62 3.03-.97 4.7-.97M3.18 12A9.82 9.82 0 0 0 12 17.5c.69 0 1.37-.07 2-.21L11.72 15A3.064 3.064 0 0 1 9 12.28L5.6 8.87c-.99.85-1.82 1.91-2.42 3.13" />
                </svg>
            </button>
        </div>
    </div>
    <div class="form-group mb-3">
        <label class="form-label" for="confirm_password">Confirm password <span class="required-field">*</span></label>
        <div class="input-group">
            <input type="password" placeholder="Enter confirm password" id="confirm_password"name="confirm_password"
                class="form-control">
            <button class="border-0" type="button"id="show_confirm_password">
                <svg class="eye_confirm_password" xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em"
                    viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M2 5.27L3.28 4L20 20.72L18.73 22l-3.08-3.08c-1.15.38-2.37.58-3.65.58c-5 0-9.27-3.11-11-7.5c.69-1.76 1.79-3.31 3.19-4.54zM12 9a3 3 0 0 1 3 3a3 3 0 0 1-.17 1L11 9.17A3 3 0 0 1 12 9m0-4.5c5 0 9.27 3.11 11 7.5a11.8 11.8 0 0 1-4 5.19l-1.42-1.43A9.86 9.86 0 0 0 20.82 12A9.82 9.82 0 0 0 12 6.5c-1.09 0-2.16.18-3.16.5L7.3 5.47c1.44-.62 3.03-.97 4.7-.97M3.18 12A9.82 9.82 0 0 0 12 17.5c.69 0 1.37-.07 2-.21L11.72 15A3.064 3.064 0 0 1 9 12.28L5.6 8.87c-.99.85-1.82 1.91-2.42 3.13" />
                </svg>
            </button>
        </div>
    </div>
    <button class="btn btn-primary waves-effect waves-light w-md saveSetting" id="savedata" type="button">Update
        Password</button>
</form>

<script>
    $(document).off('click', '#savedata');
    $(document).on('click', '#savedata', function() {
        showLoader();
        $('#setting_form').ajaxSubmit(function(response) {
            var result = JSON.parse(response);
            if (result) {
                if (result.type === 'success') {
                    $('#setting_form')[0].reset();
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
    // Show password-start
    $('#show_current_password').off('click');
    $('#show_current_password').on('click', function() {
        var passwordField = $('#current_password');
        var icon = $(this).find('.eye_current_password');
        if (passwordField.prop('type') == 'password') {
            passwordField.prop('type', 'text');
            icon.find('path').attr('d',
                "M12 9a3 3 0 0 1 3 3a3 3 0 0 1-3 3a3 3 0 0 1-3-3a3 3 0 0 1 3-3m0-4.5c5 0 9.27 3.11 11 7.5c-1.73 4.39-6 7.5-11 7.5S2.73 16.39 1 12c1.73-4.39 6-7.5 11-7.5M3.18 12a9.821 9.821 0 0 0 17.64 0a9.821 9.821 0 0 0-17.64 0"
            );
        } else {
            passwordField.prop('type', 'password');
            icon.find('path').attr('d',
                "M2 5.27L3.28 4L20 20.72L18.73 22l-3.08-3.08c-1.15.38-2.37.58-3.65.58c-5 0-9.27-3.11-11-7.5c.69-1.76 1.79-3.31 3.19-4.54zM12 9a3 3 0 0 1 3 3a3 3 0 0 1-.17 1L11 9.17A3 3 0 0 1 12 9m0-4.5c5 0 9.27 3.11 11 7.5a11.8 11.8 0 0 1-4 5.19l-1.42-1.43A9.86 9.86 0 0 0 20.82 12A9.82 9.82 0 0 0 12 6.5c-1.09 0-2.16.18-3.16.5L7.3 5.47c1.44-.62 3.03-.97 4.7-.97M3.18 12A9.82 9.82 0 0 0 12 17.5c.69 0 1.37-.07 2-.21L11.72 15A3.064 3.064 0 0 1 9 12.28L5.6 8.87c-.99.85-1.82 1.91-2.42 3.13"
            );
        }
    });
    $('#show_password').off('click');
    $('#show_password').on('click', function() {
        var passwordField = $('#password');
        var icon = $(this).find('.eye_password');
        if (passwordField.prop('type') == 'password') {
            passwordField.prop('type', 'text');
            icon.find('path').attr('d',
                "M12 9a3 3 0 0 1 3 3a3 3 0 0 1-3 3a3 3 0 0 1-3-3a3 3 0 0 1 3-3m0-4.5c5 0 9.27 3.11 11 7.5c-1.73 4.39-6 7.5-11 7.5S2.73 16.39 1 12c1.73-4.39 6-7.5 11-7.5M3.18 12a9.821 9.821 0 0 0 17.64 0a9.821 9.821 0 0 0-17.64 0"
            );

        } else {
            passwordField.prop('type', 'password');

            icon.find('path').attr('d',
                "M2 5.27L3.28 4L20 20.72L18.73 22l-3.08-3.08c-1.15.38-2.37.58-3.65.58c-5 0-9.27-3.11-11-7.5c.69-1.76 1.79-3.31 3.19-4.54zM12 9a3 3 0 0 1 3 3a3 3 0 0 1-.17 1L11 9.17A3 3 0 0 1 12 9m0-4.5c5 0 9.27 3.11 11 7.5a11.8 11.8 0 0 1-4 5.19l-1.42-1.43A9.86 9.86 0 0 0 20.82 12A9.82 9.82 0 0 0 12 6.5c-1.09 0-2.16.18-3.16.5L7.3 5.47c1.44-.62 3.03-.97 4.7-.97M3.18 12A9.82 9.82 0 0 0 12 17.5c.69 0 1.37-.07 2-.21L11.72 15A3.064 3.064 0 0 1 9 12.28L5.6 8.87c-.99.85-1.82 1.91-2.42 3.13"
            );


        }
    });
    $('#show_confirm_password').off('click');
    $('#show_confirm_password').on('click', function() {
        var passwordField = $('#confirm_password');
        var icon = $(this).find('.eye_confirm_password');
        if (passwordField.prop('type') == 'password') {
            passwordField.prop('type', 'text');
            icon.find('path').attr('d',
                "M12 9a3 3 0 0 1 3 3a3 3 0 0 1-3 3a3 3 0 0 1-3-3a3 3 0 0 1 3-3m0-4.5c5 0 9.27 3.11 11 7.5c-1.73 4.39-6 7.5-11 7.5S2.73 16.39 1 12c1.73-4.39 6-7.5 11-7.5M3.18 12a9.821 9.821 0 0 0 17.64 0a9.821 9.821 0 0 0-17.64 0"
            );
        } else {
            passwordField.prop('type', 'password');
            icon.find('path').attr('d',
                "M2 5.27L3.28 4L20 20.72L18.73 22l-3.08-3.08c-1.15.38-2.37.58-3.65.58c-5 0-9.27-3.11-11-7.5c.69-1.76 1.79-3.31 3.19-4.54zM12 9a3 3 0 0 1 3 3a3 3 0 0 1-.17 1L11 9.17A3 3 0 0 1 12 9m0-4.5c5 0 9.27 3.11 11 7.5a11.8 11.8 0 0 1-4 5.19l-1.42-1.43A9.86 9.86 0 0 0 20.82 12A9.82 9.82 0 0 0 12 6.5c-1.09 0-2.16.18-3.16.5L7.3 5.47c1.44-.62 3.03-.97 4.7-.97M3.18 12A9.82 9.82 0 0 0 12 17.5c.69 0 1.37-.07 2-.21L11.72 15A3.064 3.064 0 0 1 9 12.28L5.6 8.87c-.99.85-1.82 1.91-2.42 3.13"
            );
        }
    });
    // Show password-end
</script>
