<!-- Start::app-sidebar -->
<aside class="app-sidebar sticky" id="sidebar">

    <!-- Start::main-sidebar-header -->
    <div class="main-sidebar-header">
        <a href="{{ route('admin.dashboard') }}" class="header-logo">
            <?php
            $imgPath = !empty($siteSetting->img_logo) && \Illuminate\Support\Facades\Storage::exists('public/setting/' . $siteSetting->img_logo) ? asset('storage/setting/' . $siteSetting->img_logo) : asset('no-image.jpg');
            ?>
            <img src="{{ $imgPath }}" class="rounded-circle" alt="School Logo" width="37" height="37">
        </a>
    </div>
    <!-- End::main-sidebar-header -->

    <!-- Start::main-sidebar -->
    <div class="main-sidebar" id="sidebar-scroll">

        <!-- Start::nav -->
        <nav class="main-menu-container nav nav-pills flex-column sub-open">
            <div class="slide-left" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                </svg>
            </div>
            <ul class="main-menu">
                <li class="slide__category"><span class="category-name">Dashboard</span></li>
                {{-- <li class="slide__category"><span class="category-name"> Enquiry</span></li> --}}
                <li class="slide">
                    <a href="{{ route('admin.dashboard') }}" class="side-menu__item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3" />
                            <path
                                d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z" />
                        </svg>
                        <span class="side-menu__label">Dashboard</span>
                    </a>
                </li>

                <li class="slide__category"><span class="category-name">One Time Setting</span></li>

                <li class="slide">
                    <a href="{{ route('admin.sitesetting') }}" class="side-menu__item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="16" height="16"
                            fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                            <path
                                d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z" />
                        </svg>
                        <span class="side-menu__label">Site Setting</span>
                    </a>
                </li>

                <li class="slide">
                    <a href="{{ route('admin.aboutus') }}" class="side-menu__item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="16" height="16"
                            viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M11 9h2V7h-2m1 13c-4.41 0-8-3.59-8-8s3.59-8 8-8s8 3.59 8 8s-3.59 8-8 8m0-18A10 10 0 0 0 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10A10 10 0 0 0 12 2m-1 15h2v-6h-2z" />
                        </svg>
                        <span class="side-menu__label">About Us</span>
                    </a>
                </li>
               <li class="slide">
                    <a href="{{ route('admin.member') }}" class="side-menu__item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                        </svg>
                        <span class="side-menu__label">Our Team</span>
                    </a>
                </li>
                <li class="slide">
                    <a href="{{ route('admin.message') }}" class="side-menu__item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="16" height="16"
                            viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M4 4h16v12H5.17L4 17.17zm0-2c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm2 10h12v2H6zm0-3h12v2H6zm0-3h12v2H6z" />
                        </svg>
                        <span class="side-menu__label">Message From</span>
                    </a>
                </li>
                <li class="slide">
                    <a href="{{ route('admin.post') }}" class="side-menu__item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="16" height="16"
                            viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h8q.425 0 .713.288T14 4t-.288.713T13 5H5v14h14v-8q0-.425.288-.712T20 10t.713.288T21 11v8q0 .825-.587 1.413T19 21zm4-4q-.425 0-.712-.288T8 16t.288-.712T9 15h6q.425 0 .713.288T16 16t-.288.713T15 17zm0-3q-.425 0-.712-.288T8 13t.288-.712T9 12h6q.425 0 .713.288T16 13t-.288.713T15 14zm0-3q-.425 0-.712-.288T8 10t.288-.712T9 9h6q.425 0 .713.288T16 10t-.288.713T15 11zm9-2q-.425 0-.712-.288T17 8V7h-1q-.425 0-.712-.288T15 6t.288-.712T16 5h1V4q0-.425.288-.712T18 3t.713.288T19 4v1h1q.425 0 .713.288T21 6t-.288.713T20 7h-1v1q0 .425-.288.713T18 9" />
                        </svg>
                        <span class="side-menu__label">Post</span>
                    </a>
                </li>

                <li class="slide">
                    <a href="{{ route('admin.service') }}" class="side-menu__item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="16"
                            height="16" viewBox="0 0 32 32">
                            <path fill="currentColor"
                                d="M26 20a2.97 2.97 0 0 0-1.855.66L22 19.423v-1.606a3 3 0 1 0-2 0v1.606l-2.145 1.239A2.97 2.97 0 0 0 16 20a3.02 3.02 0 1 0 2.925 2.353L21 21.155l2.075 1.198A2.998 2.998 0 1 0 26 20m-10 4a1 1 0 1 1 1-1a1 1 0 0 1-1 1m5-10a1 1 0 1 1-1 1a1 1 0 0 1 1-1m5 10a1 1 0 1 1 1-1a1 1 0 0 1-1 1" />
                            <path fill="currentColor"
                                d="M16 31A11.013 11.013 0 0 1 5 20V6.382l10.987-5.5l10.46 5.237l-.895 1.788l-9.565-4.789L7 7.618V20a9 9 0 0 0 14.4 7.201l1.2 1.599A10.908 10.908 0 0 1 16 31" />
                        </svg>
                        <span class="side-menu__label">Services</span>
                    </a>
                </li>
                <li class="slide">
                    <a href="{{ route('admin.testimonial') }}" class="side-menu__item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="16"
                            height="16" fill="currentColor" class="bi bi-megaphone" viewBox="0 0 16 16">
                            <path
                                d="M13 2.5a1.5 1.5 0 0 1 3 0v11a1.5 1.5 0 0 1-3 0v-.214c-2.162-1.241-4.49-1.843-6.912-2.083l.405 2.712A1 1 0 0 1 5.51 15.1h-.548a1 1 0 0 1-.916-.599l-1.85-3.49-.202-.003A2.014 2.014 0 0 1 0 9V7a2.02 2.02 0 0 1 1.992-2.013 75 75 0 0 0 2.483-.075c3.043-.154 6.148-.849 8.525-2.199zm1 0v11a.5.5 0 0 0 1 0v-11a.5.5 0 0 0-1 0m-1 1.35c-2.344 1.205-5.209 1.842-8 2.033v4.233q.27.015.537.036c2.568.189 5.093.744 7.463 1.993zm-9 6.215v-4.13a95 95 0 0 1-1.992.052A1.02 1.02 0 0 0 1 7v2c0 .55.448 1.002 1.006 1.009A61 61 0 0 1 4 10.065m-.657.975 1.609 3.037.01.024h.548l-.002-.014-.443-2.966a68 68 0 0 0-1.722-.082z" />
                        </svg>
                        <span class="side-menu__label">Testimonial</span>
                    </a>
                </li>
                <li class="slide">
                    <a href="{{ route('admin.timeline') }}" class="side-menu__item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="16"
                            height="16" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M21 8c-1.5 0-2.3 1.4-1.9 2.5l-3.6 3.6c-.3-.1-.7-.1-1 0l-2.6-2.6c.4-1.1-.4-2.5-1.9-2.5c-1.4 0-2.3 1.4-1.9 2.5L3.5 16c-1.1-.3-2.5.5-2.5 2c0 1.1.9 2 2 2c1.4 0 2.3-1.4 1.9-2.5l4.5-4.6c.3.1.7.1 1 0l2.6 2.6c-.3 1 .5 2.5 2 2.5s2.3-1.4 1.9-2.5l3.6-3.6c1.1.3 2.5-.5 2.5-1.9c0-1.1-.9-2-2-2m-6 1l.9-2.1L18 6l-2.1-.9L15 3l-.9 2.1L12 6l2.1.9zM3.5 11L4 9l2-.5L4 8l-.5-2L3 8l-2 .5L3 9z" />
                        </svg>
                        <span class="side-menu__label">Timeline</span>
                    </a>
                </li>

                <li class="slide">
                    <a href="{{ route('admin.gallery') }}" class="side-menu__item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="16"
                            height="16" fill="currentColor" class="bi bi-card-image" viewBox="0 0 16 16">
                            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                            <path
                                d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54L1 12.5v-9a.5.5 0 0 1 .5-.5z" />
                        </svg>
                        <span class="side-menu__label">Gallery</span>
                    </a>
                </li>


                <li class="slide">
                    <a href="{{ route('admin.event') }}" class="side-menu__item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon"width="16" height="16"
                            fill="currentColor" class="bi bi-calendar-event" viewBox="0 0 16 16">
                            <path
                                d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z" />
                            <path
                                d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                        </svg>
                        <span class="side-menu__label">Event</span>
                    </a>
                </li>

                <li class="slide">
                    <a href="{{ route('admin.history') }}" class="side-menu__item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="16"
                            height="16" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                            <path
                                d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022zm2.004.45a7 7 0 0 0-.985-.299l.219-.976q.576.129 1.126.342zm1.37.71a7 7 0 0 0-.439-.27l.493-.87a8 8 0 0 1 .979.654l-.615.789a7 7 0 0 0-.418-.302zm1.834 1.79a7 7 0 0 0-.653-.796l.724-.69q.406.429.747.91zm.744 1.352a7 7 0 0 0-.214-.468l.893-.45a8 8 0 0 1 .45 1.088l-.95.313a7 7 0 0 0-.179-.483m.53 2.507a7 7 0 0 0-.1-1.025l.985-.17q.1.58.116 1.17zm-.131 1.538q.05-.254.081-.51l.993.123a8 8 0 0 1-.23 1.155l-.964-.267q.069-.247.12-.501m-.952 2.379q.276-.436.486-.908l.914.405q-.24.54-.555 1.038zm-.964 1.205q.183-.183.35-.378l.758.653a8 8 0 0 1-.401.432z" />
                            <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0z" />
                            <path
                                d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5" />
                        </svg>
                        <span class="side-menu__label">History</span>
                    </a>
                </li>

                <li class="slide">
                    <a href="{{ route('admin.faq') }}" class="side-menu__item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="16"
                            height="16" fill="currentColor" class="bi bi-patch-question" viewBox="0 0 16 16">
                            <path
                                d="M8.05 9.6c.336 0 .504-.24.554-.627.04-.534.198-.815.847-1.26.673-.475 1.049-1.09 1.049-1.986 0-1.325-.92-2.227-2.262-2.227-1.02 0-1.792.492-2.1 1.29A1.7 1.7 0 0 0 6 5.48c0 .393.203.64.545.64.272 0 .455-.147.564-.51.158-.592.525-.915 1.074-.915.61 0 1.03.446 1.03 1.084 0 .563-.208.885-.822 1.325-.619.433-.926.914-.926 1.64v.111c0 .428.208.745.585.745" />
                            <path
                                d="m10.273 2.513-.921-.944.715-.698.622.637.89-.011a2.89 2.89 0 0 1 2.924 2.924l-.01.89.636.622a2.89 2.89 0 0 1 0 4.134l-.637.622.011.89a2.89 2.89 0 0 1-2.924 2.924l-.89-.01-.622.636a2.89 2.89 0 0 1-4.134 0l-.622-.637-.89.011a2.89 2.89 0 0 1-2.924-2.924l.01-.89-.636-.622a2.89 2.89 0 0 1 0-4.134l.637-.622-.011-.89a2.89 2.89 0 0 1 2.924-2.924l.89.01.622-.636a2.89 2.89 0 0 1 4.134 0l-.715.698a1.89 1.89 0 0 0-2.704 0l-.92.944-1.32-.016a1.89 1.89 0 0 0-1.911 1.912l.016 1.318-.944.921a1.89 1.89 0 0 0 0 2.704l.944.92-.016 1.32a1.89 1.89 0 0 0 1.912 1.911l1.318-.016.921.944a1.89 1.89 0 0 0 2.704 0l.92-.944 1.32.016a1.89 1.89 0 0 0 1.911-1.912l-.016-1.318.944-.921a1.89 1.89 0 0 0 0-2.704l-.944-.92.016-1.32a1.89 1.89 0 0 0-1.912-1.911z" />
                            <path d="M7.001 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0" />
                        </svg>
                        <span class="side-menu__label">FAQ</span>
                    </a>
                </li>

                <!-- End::slide -->
            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                </svg></div>
        </nav>
        <!-- End::nav -->

    </div>
    <!-- End::main-sidebar -->

</aside>
<!-- End::app-sidebar -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#childMenu').off('click');
        $('#childMenu').on('click', function(event) {
            $('#mainMenu').addClass('open');
            event.stopPropagation();
            console.log("Clicked childMenu");
        });
    });
</script>
