@extends('frontend.layout2.main2')
@section('title', 'Our Gallery Inner')
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
                <p>Our Gallery Inner</p>
            </div>
        </div>
        <div class="img_after">
            <img src="{{ asset('frontpanel/assets/images/Mask group.png') }}" alt="">
        </div>
    </section>
    <div class="gallery-inner-container">
        <div class="container">
            <div class="gallery-inner-wrapper">
                <div class="g1-img">
                    @foreach ($videos as $video)
                        <iframe src="{{ $video->video_url }}" frameborder="0"></iframe>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
