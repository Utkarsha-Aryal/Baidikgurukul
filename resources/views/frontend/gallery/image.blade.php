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
                @foreach ($images as $imagePath)
                    <div class="g-inner-img">
                        <div class="g1-img">
                            @if (!empty($imagePath->image) && Storage::exists('public/gallery-image/' . $imagePath->image))
                                <img src="{{ asset('storage/gallery-image/' . $imagePath->image) }}" alt="">
                            @else
                                <img src="{{ asset('frontpanel/assets/images/cultural.png') }}" alt="">
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
