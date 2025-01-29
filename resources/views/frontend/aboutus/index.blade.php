@extends('frontend.layout2.main2')
@section('title', 'हाम्रो बारेमा')
{{-- <style>
    .wrapperMain {
        display: flex;
        align-content: center;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .mission_main {
        margin: 0 !important;
    }
</style> --}}
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
                <p>परिचय</p>
            </div>
        </div>
        <div class="img_after">
            <img src="{{ asset('frontpanel/assets/images/Mask group.png') }}" alt="">
        </div>
    </section>
    <section class="rituals_dreams">
        <div class="container">
            <div class="dreams_wrappper_wrap">
                <div class="about-lt">
                    <div class="radius-o">
                        <div class="inner-o"></div>
                        <div class="dance-img">
                            @if (!empty($aboutus->img_introduction) && Storage::exists('public/aboutus/' . $aboutus->img_introduction))
                                <img src="{{ asset('storage/aboutus/' . $aboutus->img_introduction) }}" alt="">
                            @else
                                <img src="{{ asset('frontpanel/assets/images/cultural.png') }}" alt="">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="right_dreams_txt">
                    <div class="first_dreams_txt custom_heading12">
                        <p>चाेचाङ्गी समाज नेपाल</p>
                    </div>
                    <div class="second_txt">
                        <p>{{ $aboutus->aboutus_title }}</p>

                    </div>
                    <div class="third_dream_txt">
                        {{-- <p>{!! Str::limit($aboutus->introduction, 1000, '...') !!}</p> --}}
                        <p>{!! $aboutus->introduction !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="mission_vision_container">
        <div class="container">
            <div class="ft_wrap">
                <div class="lfr_row">
                    <p>हामी हाम्रो मिशन, भिजन र लक्ष्यहरूमा केन्द्रित छौं</p>
                </div>
                <div class="rght_row">
                    <p>मगर समुदायले आफ्नो निरन्तर वृद्धि, लचिलोपन र समाजमा योगदान सुनिश्चित गर्ने लक्ष्य राखेको छ, सबै
                        आफ्नो जरा र सांस्कृतिक पहिचानप्रति सच्चा रहँदा।</p>
                </div>
            </div>

            <div class="mission_vision_goal_wrapper">
                <div class="mission_card_container">
                    <div class="wrapperMain">
                        <div class="mission_icon">
                            <img src="{{ asset('frontpanel/assets/images/Mask group.svg') }}" alt="">
                        </div>
                        <div class="mission_main">
                            <p>मिशन</p>
                        </div>
                    </div>
                    <div class="mission_txt">
                        <p>{{ $aboutus->mission ?? '' }}</p>
                    </div>
                </div>
                <div class="mission_card_container">
                    <div class="wrapperMain">
                        <div class="mission_icon">
                            <img src="{{ asset('frontpanel/assets/images/vision.png') }}" alt="">
                        </div>
                        <div class="mission_main">
                            <p>दृष्टि</p>
                        </div>
                    </div>
                    <div class="mission_txt">
                        <p>{{ $aboutus->vision ?? '' }}</p>
                    </div>
                </div>
                <div class="mission_card_container">
                    <div class="wrapperMain">
                        <div class="mission_icon">
                            <img src="{{ asset('frontpanel/assets/images/goal.png') }}" alt="">

                        </div>
                        <div class="mission_main">
                            <p>लक्ष्यहरू</p>
                        </div>
                    </div>
                    <div class="mission_txt">
                        <p>{{ $aboutus->goals ?? '' }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
    {{-- <div class="img_registration_wrap">
        <div class="lft_img">
            <img src="{{ asset('frontpanel/assets/images/ritual.png') }}" alt="">
        </div>
        <div class="rght_txt">
            <p>तपाईंको जन्म र मृत्यु प्रविष्टि गर्नुहोस
                दर्ता फारम
                अपडेट राख्नुहोस</p>
            <button class="entry_form">
                <a href="#">
                    <p>अहिले प्रवेश गर्नुहोस</p>
                </a>
            </button>
        </div>
    </div> --}}


@endsection
