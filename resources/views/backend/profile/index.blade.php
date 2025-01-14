@extends('backend.layouts.main')
@section('title')
    Profile
@endsection
<style>
    a.active {
        background: white !important;
        border-block-end: 0;
        color: var(--custom-black);
    }
</style>
@section('main-content')
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <div class="my-auto">
            <h5 class="page-title fs-21 mb-1">Profile</h5>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header Close -->

    <!-- Start::row-1 -->
    <div class="row row-sm">
        <div class="col-xl-4">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="ps-0">
                        <div class="main-profile-overview">
                            <div class="main-img-user profile-user user-profile" id="profileImage">
                                @if (!empty($userData['image']))
                                    <img alt="User Image"class='profile_image'
                                        src="{{ asset('/storage/profile') . '/' . $userData['image'] }}">
                                @else
                                    <img alt="No User"class='profile_image' src="{{ asset('/no-user.jpg') }}">
                                @endif
                                <label for="profileImageInput" class="fe fe-camera profile-edit text-primary"></label>
                                <input type="file" id="profileImageInput"
                                    style="position: absolute; clip: rect(0, 0, 0, 0); pointer-events: none;"
                                    accept="image/*">
                            </div>
                            <div class="d-flex justify-content-between mb-4">
                                <div>
                                    <h5 class="main-profile-name">{{ @$userData['name'] }}</h5>
                                    <p class="main-profile-name-text text-muted">{{ @$userData['email'] }}</p>
                                </div>
                            </div>
                        </div><!-- main-profile-overview -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8">

            <div class="card">
                <div class="card-body">
                    <div class="tabs-menu ">
                        <!-- Tabs -->
                        <ul class="nav nav-tabs profile navtab-custom panel-tabs">
                            <li class="nav-list" data-id="editprofile">
                                <a class="active" href="javascript:void();" id="profile-tab" data-bs-toggle="tab"
                                    aria-expanded="false">
                                    <span class="visible-xs"><i class="las la-images fs-15 me-1"></i></span>
                                    <span class="hidden-xs">Edit Profile</span> </a>
                            </li>
                            <li class="nav-list active" data-id="setting">
                                <a href="javascript:void();" data-bs-toggle="tab" aria-expanded="false"> <span
                                        class="visible-xs"><i class="las la-cog fs-16 me-1"></i></span>
                                    <span class="hidden-xs">SETTINGS</span> </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content border border-top-0 p-4 br-dark"id="tabContent">
                        {{-- content here --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End::row-1 -->
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            $('.nav-list').on('click', function(e) {
                e.preventDefault();
                $(this).addClass('active');
                var data = {
                    id: $(this).data('id')
                };
                var url = '{{ route('admin.gettabcontent') }}';
                $.post({
                    url: url,
                    data: data,
                    success: function(response) {
                        $('#tabContent').html(response);
                    }
                });
            });


            // Update profile image
            $('#profileImageInput').on('change', function(event) {
                showLoader();
                const selectedFile = event.target.files[0];

                if (selectedFile) {
                    $('.profile_image').attr('src', URL.createObjectURL(selectedFile));

                    const formData = new FormData();
                    formData.append('image', selectedFile);

                    const updateImageUrl = '{{ route('admin.updateprofileimage') }}';

                    $.ajax({
                        url: updateImageUrl,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            var parseResponse = JSON.parse(response);
                            if (parseResponse) {
                                hideLoader();
                                showNotification(parseResponse.message, parseResponse.type)
                            }

                        },
                    });
                }
            });

            $('#profile-tab').trigger('click');
        });
    </script>
@endsection
