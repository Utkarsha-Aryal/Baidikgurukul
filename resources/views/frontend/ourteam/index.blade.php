@extends('frontend.layouts.main')
@section('title', 'Our Team')
@section('content')
    <section class="introduction_page">
        <div class="img_before">
            <img src="{{ asset('frontpanel/assets/images/Mask group.png') }}" alt="">
        </div>
        <div class="common_image_txt">
            <div class="common_bg_wrapper">
                <img src="{{ asset('frontpanel/assets/images/image1.jpeg') }}" alt="hands">
            </div>
            <div class="main_txt">
                <p>Our Team</p>
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
                    @if (!empty($uniqueYearIntervals))
                        @foreach ($uniqueYearIntervals as $index => $yearInterval)
                            <div class="tab {{ $index == 0 ? 'active' : '' }}" id="tab{{ $index + 1 }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
                                </svg>
                                <p>{{ $yearInterval }}</p>
                            </div>
                        @endforeach
                    @else
                        <p>No Data Found</p>
                    @endif
                </div>

                <!-- Content Area (Right Side) -->
                <div class="content">
                    @if (!empty($members))
                        @foreach ($uniqueYearIntervals as $index => $yearInterval)
                            <div id="content{{ $index + 1 }}" class="content-item"
                                style="display: {{ $index == 0 ? 'block' : 'none' }}">
                                <div class="container_content_wrapper">
                                    @foreach ($members->where('timeInterval.year_interval', $yearInterval) as $member)
                                        <div class="image_container_wrap">
                                            <div class="img_hover_bg">
                                                <h3>{{ $member->name ?? '' }}</h3>
                                                <p>{{ $member->designation ?? '' }}</p>
                                            </div>
                                            <div class="img_default_bg">
                                                <h3>{{ $member->name ?? '' }}</h3>
                                                <p>{{ $member->designation ?? '' }}</p>
                                            </div>
                                            <div class="img_wrap">
                                                <a href="{{ route('teaminner', $member->slug) }}">
                                                    @if (!empty($member->photo) && Storage::exists('public/community/' . $member->photo))
                                                        <img src="{{ asset('storage/community/' . $member->photo) }}"
                                                            alt="">
                                                    @else
                                                        <img src="{{ asset('frontpanel/assets/images/curved.jpeg') }}"
                                                            alt="">
                                                    @endif
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>No Member Found</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Set the default tab content on page load
            showContent(1);
            setActiveTab(1); // Set the default active tab
        });

        // Handle tab click events
        const tabs = document.querySelectorAll(".tab");
        tabs.forEach(function(tab, index) {
            tab.addEventListener("click", function(event) {
                event.preventDefault();
                showContent(index + 1); // Show the clicked content
                setActiveTab(index + 1); // Set the active tab
            });
        });

        function showContent(tabIndex) {
            // Hide all content items
            let contents = document.querySelectorAll(".content-item");
            contents.forEach(function(content) {
                content.style.display = "none";
            });

            // Show the selected content
            document.getElementById("content" + tabIndex).style.display = "block";
        }

        function setActiveTab(tabIndex) {
            // Remove active class from all tabs
            let tabs = document.querySelectorAll(".tab");
            tabs.forEach(function(tab) {
                tab.classList.remove("active");
            });

            // Add active class to the clicked tab
            document.getElementById("tab" + tabIndex).classList.add("active");
        }
    </script>
@endsection
