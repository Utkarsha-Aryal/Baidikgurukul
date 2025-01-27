@extends('frontend.layout2.main2')
@section('title', 'हाम्रो टोली')
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
                <p>हाम्रो टोली</p>
            </div>
        </div>
        <div class="img_after">
            <img src="{{ asset('frontpanel/assets/images/Mask group.png') }}" alt="">
        </div>
    </section>
    <div class="team_detail_flx">
        <div class="container">
            <div class="left_rght_txt_img">
                <div class="left_img">
                    @if (!empty($member->photo) && Storage::exists('public/community/' . $member->photo))
                        <img src="{{ asset('storage/community/' . $member->photo) }}" alt="">
                    @else
                        <img src="{{ asset('frontpanel/assets/images/curved.jpeg') }}" alt="">
                    @endif
                </div>
                <div class="rght_txt">
                    <p>{{ $member->name ?? '' }}</p>
                    <p>{{ $member->designation ?? '' }}</p>
                    <p>{!! $member->details !!}</p>
                </div>
            </div>
        </div>
    </div>

@endsection
