@extends('frontend.layouts.main')
@section('title', 'Our Rules For Our Rituals')
@section('content')
    <section class="introduction_page">
        <div class="img_before">
            <img src="{{ asset('frontpanel/assets/images/Mask group.png') }}" alt="">
        </div>
        <div class="common_image_txt">
            <div class="common_bg_wrapper">
                <img src="{{ asset('frontpanel/assets/images/image1.jpeg') }}" alt="">
            </div>
            <div class="main_txt">
                <p>Our Rules For Our Rituals</p>
            </div>
        </div>
        <div class="img_after">
            <img src="{{ asset('frontpanel/assets/images/Mask group.png') }}" alt="">
        </div>
    </section>
    <section class="team_tab_section">
        <div class="container">
            <div class="container_wrapper">
                <!-- Tab Navigation (Left Side) -->
                <div class="tabs">
                    <div class="first_txt">
                        <p>Our Rules for Rituals</p>
                    </div>
                    @if (!empty($ritules) && count($ritules) > 0)
                        @foreach ($ritules as $index => $ritul)
                            <div class="tab {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
                                </svg>
                                <p>{{ $ritul->title }}</p>
                            </div>
                        @endforeach
                    @else
                        <p>No Data Available</p>
                    @endif
                </div>
                <!-- Content Area (Right Side) -->
                <div class="content">
                    @if (!empty($ritules))
                        @foreach ($ritules as $index => $ritul)
                            <div class="content-item" id="content-{{ $index }}"
                                style="{{ $index === 0 ? '' : 'display:none;' }}">
                                <div class="first_content_wrapper">
                                    <div class="first_txt">
                                        <p>{{ $ritul->title }}</p>
                                    </div>
                                    <div class="second_txt">
                                        <p>{!! $ritul->details !!}</p>
                                    </div>
                                    <div class="blue_bg_image">
                                        <div class="img_absolute_txt">
                                            <iframe class="contact-iframe" src="{{ $ritul->video_link }}"></iframe>
                                            <p>Rules for Rituals from Birth to Death</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>No Data Available</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Select all tabs and content items
            const tabs = document.querySelectorAll(".tab");
            const contents = document.querySelectorAll(".content-item");

            // Add click event listener for each tab
            tabs.forEach((tab, index) => {
                tab.addEventListener("click", function(event) {
                    event.preventDefault();

                    // Hide all content items
                    contents.forEach(content => content.style.display = "none");

                    // Remove active class from all tabs
                    tabs.forEach(tab => tab.classList.remove("active"));

                    // Show the selected content and set the clicked tab as active
                    document.getElementById(`content-${index}`).style.display = "block";
                    tab.classList.add("active");
                });
            });
        });
    </script>
@endsection
