@extends('frontend.layouts.main')
@section('title', 'Our Gallery Inner')
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
            <div class="g-inner-img">
                <img src="assets/image/gallery/galleryr1.png">
            </div>
            <div class="g-inner-img">
                <img src="assets/image/gallery/galleryr1.png">
            </div>
            <div class="g-inner-img">
                <img src="assets/image/gallery/galleryr1.png">
            </div>
            <div class="g-inner-img">
                <img src="assets/image/gallery/galleryr1.png">
            </div>
            <div class="g-inner-img">
                <img src="assets/image/gallery/galleryr1.png">
            </div>
            <div class="g-inner-img">
                <img src="assets/image/gallery/galleryr1.png">
            </div>
        </div>
    </div>
</div>

@endsection