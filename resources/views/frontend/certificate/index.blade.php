@extends('frontend.layout2.main2')
@section('title', 'प्रमाणपत्र / पुरस्कार ')
<style>
    .certificate_wrapper img {
        width: 400px;
        height: 400px;
    }
</style>
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
                <p>प्रमाणपत्र / पुरस्कार </p>
            </div>
        </div>
        <div class="img_after">
            <img src="{{ asset('frontpanel/assets/images/Mask group.png') }}" alt="">
        </div>
    </section>

    <section class="certificate_section">
        <div class="certificate_container">
            <div class="container">
                <div class="certificate_hover_wrap">
                    @if (!@empty($certificates) && count($certificates) > 0)
                        @foreach ($certificates as $certificate)
                            <div class="certificate_wrapper">
                                <img src="{{ asset('storage/certificate/' . $certificate->image) }}" alt="Gallery Image"
                                    data-src="{{ asset('storage/certificate/' . $certificate->image) }}">
                                <div class="overlapping_content">
                                    <p>{{ $certificate->title }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>No data available</p>
                    @endif

                </div>
            </div>
        </div>
    </section>
@endsection
