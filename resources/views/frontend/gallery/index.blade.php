@extends('frontend.layout2.main2')
@section('title', 'Our Gallery')
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
                <p>हाम्रो ग्यालेरी</p>
            </div>
        </div>
        <div class="img_after">
            <img src="{{ asset('frontpanel/assets/images/Mask group.png') }}" alt="">
        </div>
    </section>
    <div class="gallery-container-main">
        <div class="container">
            <div class="tabs">
                <button class="tab active" data-target="all">सबै</button>
                <button class="tab" data-target="images">फोटो</button>
                <button class="tab" data-target="videos">भिडियो</button>
            </div>
        </div>
        <div class="container">
            <div id="all" class="content active">
                <div class="gallery-content-main">
                    <p>Loading...</p>
                </div>
            </div>
            <div id="images" class="content">
                <div class="gallery-content-main">
                    <p>Loading...</p>
                </div>
            </div>
            <div id="videos" class="content">
                <div class="gallery-content-main">
                    <p>Loading...</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.tab').on('click', function(e) {
                e.preventDefault();

                $('.tab').removeClass('active');
                $(this).addClass('active');

                let target = $(this).data('target');

                $('.content').removeClass('active');
                $('#' + target).addClass('active');

                let url = "{{ url('/gallery/image/gettabcontent') }}/" + target;
                $('#' + target + ' .gallery-content-main').html('<p>Loading...</p>');

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        target: target
                    },
                    success: function(response) {
                        if (response.html) {
                            $('#' + target + ' .gallery-content-main').html(response.html);
                        } else {
                            $('#' + target + ' .gallery-content-main').html(
                                '<p>No content found.</p>');
                        }
                    },
                    error: function() {
                        $('#' + target + ' .gallery-content-main').html(
                            '<p>An error occurred. Please try again later.</p>');
                    }
                });
            });

            $(document).ready(function() {
                $('.tab.active').trigger('click');
            });
        });
    </script>
@endsection
