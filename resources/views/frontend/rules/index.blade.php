@extends('frontend.layout2.main2')
@section('title', 'Our Rules For Our Rituals')
@section('content2')
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
                                            <p>Rules for Rituals from Birth to Death</p>
                                        </div>
                                        <div class="youtube_icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                                                <path
                                                    d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z" />
                                            </svg>
                                        </div>
                                        <div class="img_absolute">
                                            <img src="frontpanel\assets1\images\banner\banner1.jpg" alt="">
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
