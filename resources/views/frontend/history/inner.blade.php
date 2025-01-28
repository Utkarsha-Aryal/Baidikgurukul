{{-- @extends('frontend.layout2.main2')
@section('title', 'हाम्रा ऐतिहासिक ठाउँहरू')
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
                <p>हाम्रा ऐतिहासिक ठाउँहरू</p>
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
                        <p>हाम्रा ऐतिहासिक ठाउँहरू</p>
                    </div>
                    @if (!empty($histories) && count($histories) > 0)
                        @foreach ($histories as $index => $history)
                            <a href="#" class="tab-link" data-index="{{ $index }}">
                                <div class="tab {{ $index === 0 ? 'active' : '' }}" id="tab{{ $index }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
                                    </svg>
                                    <p>{{ $history->title }}</p>
                                </div>
                            </a>
                        @endforeach
                    @else
                        <li>No Data Found</li>
                    @endif
                </div>
                <!-- Content Area (Right Side) -->
                <div class="content">
                    @if (!empty($histories))
                        @foreach ($histories as $index => $history)
                            <div id="content{{ $index }}" class="content-item"
                                style="{{ $index === 0 ? 'display: block;' : 'display: none;' }}">
                                <div class="first_content_wrapper">
                                    <div class="first_txt">
                                        <p>{{ $history->title }}</p>
                                    </div>
                                    <div class="second_txt">
                                        <p>
                                            {!! $history->details !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>No Data Found</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tabs = document.querySelectorAll(".tab-link");
            const contents = document.querySelectorAll(".content-item");

            tabs.forEach((tab) => {
                tab.addEventListener("click", function(event) {
                    event.preventDefault();

                    // Get the index of the clicked tab
                    const index = this.getAttribute("data-index");

                    // Remove active class from all tabs and hide all content
                    tabs.forEach((t) => t.querySelector(".tab").classList.remove("active"));
                    contents.forEach((content) => (content.style.display = "none"));

                    // Activate the clicked tab and show its corresponding content
                    document.getElementById(`tab${index}`).classList.add("active");
                    document.getElementById(`content${index}`).style.display = "block";
                });
            });
        });
    </script>
@endsection --}}
