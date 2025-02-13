@extends('frontend.layout2.main2')
@section('title', 'हाम्रो टोली')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content2')
    <section class="introduction_page">
        <div class="img_before">
            <img src="{{ asset('frontpanel/assets/images/Mask group.png') }}" alt="">
        </div>
        <div class="common_image_txt">
            <div class="common_bg_wrapper">
                <img src="{{ asset('frontpanel/assets/images/image1.jpeg') }}" alt="hands">
            </div>
            <div class="main_txt">
                <p>हाम्रो टोली</p>
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
                            <div class="tab {{ $index == 0 ? 'active' : '' }}" id="tab{{ $index + 1 }}"
                                data-year-interval="{{ $yearInterval }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
                                </svg>
                                <li>{{ $yearInterval }}</li>
                            </div>
                        @endforeach
                    @else
                        <p>No Data Found</p>
                    @endif
                </div>

                <!-- Content Area (Right Side) -->
                <div class="content">

                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            var slug = @json($slug);

            function loadTabContent(tab) {
                $('.tab').removeClass('active');
                tab.addClass('active');

                let yearInterval = tab.data('year-interval');
                let url = "{{ url('/team/gettabcontent') }}";

                $('.content').html('<p>Loading...</p>');

                var data = {
                    yearInterval: yearInterval,
                    slug: slug,
                };

                $.post({
                    url: url,
                    method: 'POST',
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.html) {
                            $('.content').html(response.html);
                        } else {
                            $('.content').html('<p>No content found.</p>');
                        }
                    },
                    error: function() {
                        $('.content').html(
                            '<p>An error occurred while loading data. Please try again later.</p>');
                    }
                });
            }

            $('.tab').on('click', function(e) {
                e.preventDefault();
                loadTabContent($(this));
            });

            // Trigger click on the first tab to load its content on page load
            $('.tab').first().trigger('click');
        });
    </script>
@endsection
