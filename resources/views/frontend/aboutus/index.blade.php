@extends('frontend.layouts.main')
@section('title', 'About Us')
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
                <p>Introduction</p>
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
                    <div class="first_dreams_txt">
                        <p>About Chochangay Samaj Nepal</p>
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
                    <p>We are focused on our Mission, Vision & Goals</p>
                </div>
                <div class="rght_row">
                    <p>The Magar community aims to ensure its continued growth, resilience, and contribution to society, all
                        while staying true to its roots and cultural identity.</p>
                </div>
            </div>

            <div class="mission_vision_goal_wrapper">
                <div class="mission_card_container">
                    <div class="mission_icon">
                        <img src="{{ asset('frontpanel/assets/images/Mask group.svg') }}" alt="">
                    </div>
                    <div class="mission_main">
                        <p>Mission</p>
                    </div>
                    <div class="mission_txt">
                        <p>{{ $aboutus->mission ?? '' }}</p>
                    </div>
                </div>
                <div class="mission_card_container">
                    <div class="mission_icon">
                        <img src="{{ asset('frontpanel/assets/images/Mask group.svg') }}" alt="">

                    </div>
                    <div class="mission_main">
                        <p>Vision</p>
                    </div>
                    <div class="mission_txt">
                        <p>{{ $aboutus->vision ?? '' }}</p>
                    </div>
                </div>
                <div class="mission_card_container">
                    <div class="mission_icon">
                        <img src="{{ asset('frontpanel/assets/images/Mask group.svg') }}" alt="">

                    </div>
                    <div class="mission_main">
                        <p>Goals</p>
                    </div>
                    <div class="mission_txt">
                        <p>{{ $aboutus->goals ?? '' }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="timeline-container">
                @if (count($timelines) > 0)
                    <div class="timeline-header">
                        <p>
                            Our History
                        </p>
                    </div>
                @else
                    <p>No data found</p>
                @endif

                @if (!empty($timelines))
                    @foreach ($timelines as $index => $timeline)
                        <div class="{{ $index % 2 == 0 ? 'timeline-item_odd' : 'timeline-item_even' }}">
                            <div class="timeline-item-content">
                                <h3>{{ $timeline->year }}</h3>The Magar community aims to ensure its continued growth,
                                resilience, and contribution to society, all while staying true to its roots and cultural
                                identity.
                                <p>{{ $timeline->details }}</p>
                            </div>
                            <div class="timeline-items {{ $index % 2 == 0 ? 'odd' : 'even' }}">
                                <div class="timeline-dot"></div>
                                <div class="timeline-line"></div>
                                <div class="timeline-second-dot"></div>
                            </div>
                        </div>
                    @endforeach
                @else
                @endif
            </div>
        </div>
    </div>
    <section class="rights_for_dreams">
        <div class="container">
            <div class="rights_wrapper">
                <div class="left_rights_txt">
                    <div class="quote_container">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-quote" viewBox="0 0 16 16">
                            <path
                                d="M12 12a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1h-1.388q0-.527.062-1.054.093-.558.31-.992t.559-.683q.34-.279.868-.279V3q-.868 0-1.52.372a3.3 3.3 0 0 0-1.085.992 4.9 4.9 0 0 0-.62 1.458A7.7 7.7 0 0 0 9 7.558V11a1 1 0 0 0 1 1zm-6 0a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1H4.612q0-.527.062-1.054.094-.558.31-.992.217-.434.559-.683.34-.279.868-.279V3q-.868 0-1.52.372a3.3 3.3 0 0 0-1.085.992 4.9 4.9 0 0 0-.62 1.458A7.7 7.7 0 0 0 3 7.558V11a1 1 0 0 0 1 1z" />
                        </svg>
                    </div>
                    <div class="first_txt">
                        <p>Dream Of Every <span class="blue">Chochangay
                                Samaj Community</span> Is To Gather Our Rights </p>
                    </div>
                    <div class="third_dream_txt">
                        @if (!@empty($message->message))
                            {!! $message->message !!}
                        @else
                            <p>No Data Available</p>
                        @endif
                    </div>
                </div>
                <div class="right_rights_image">
                    <div class="image_container_wrapper">
                        @if (!empty($message->image) && Storage::exists('public/message-from/' . $message->image))
                            <img src="{{ asset('storage/message-from/' . $message->image) }}" alt="">
                        @else
                            <img src="{{ asset('frontpanel/assets/images/curved.jpeg') }}" alt="">
                        @endif
                        <div class="image_designation_container">
                            <a href="#">
                                <p>{{ $message->name ?? '' }}</p>
                                <p>{{ $message->designation ?? '' }}</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="img_registration_wrap">
        <div class="lft_img">
            <img src="{{ asset('frontpanel/assets/images/ritual.png') }}" alt="">
        </div>
        <div class="rght_txt">
            <p>Entry Your Birth & Death
                Registration Form
                Keep Updated</p>
            <button class="entry_form">
                <a href="#">
                    <p>Entry Now</p>
                </a>
            </button>
        </div>
    </div>


@endsection
