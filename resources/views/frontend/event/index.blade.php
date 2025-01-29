@extends('frontend.layout2.main2')
@section('title', 'आगामी कार्यक्रम')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

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
                <p>Our Events</p>
            </div>
        </div>
        <div class="img_after">
            <img src="{{ asset('frontpanel/assets/images/Mask group.png') }}" alt="">
        </div>
    </section>
    <div class="swiper_pagination_wrapper">
        <div class="Event_page">
            <div class="container">
                <div class="event_wrapper">
                    <div class="left_event_text">
                        <div class="first_blue_text">
                            <p>आगामी कार्यक्रमहरू</p>
                        </div>
                        <div class="second_event_text">
                            <p>हाम्रो आगामी <span class="blue_text">कार्यक्रमहरूमा सामेल हुनुहोस् </span></p>
                        </div>
                        <div class="third_event_text">
                            <P>चाेचाङ्गी समाज नेपालले आफ्नो समुदाय र संस्कृति संरक्षण, प्रवर्द्धन, र सामाजिक एकताका लागि
                                विशेष कार्यक्रमको आयोजना गर्दै आएको छ। हालै सम्पन्न यस कार्यक्रमले स्थानीय समुदायलाई
                                एकताबद्ध गर्दै सामाजिक सेवामा योगदान पुर्‍याउने मुख्य उद्देश्य बोकेको थियो।</P>
                        </div>
                        @foreach ($events as $event)
                            <div class="event_notice_container">
                                <a href="{{ route('event.inner.page', $event->slug) }}">
                                    <div class="event_notice_info_cards">
                                        <div class="date_info">
                                            <div class="date1">
                                                <p>{{ $event->event_date->format('d') }}</p>
                                            </div>
                                            <div class="date2">
                                                <p>{{ $formattedDates[$event->id]['monthNepali'] . ', ' . $event->event_date->format('Y') }}
                                            </div>
                                        </div>
                                        <div class="event_info">
                                            <div class="time_date_container">
                                                <div class="event_time">
                                                    <div class="event_img">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-clock"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                                                            <path
                                                                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                                                        </svg>
                                                    </div>
                                                    <div class="event_time">
                                                        <p>{{ $event->event_time_start ?? '' }} to
                                                            {{ $event->event_time_end ?? '' }}
                                                        <p>
                                                    </div>
                                                </div>
                                                <div class="event_location">
                                                    <div class="event_img">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-geo-alt"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
                                                            <path
                                                                d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                                        </svg>
                                                    </div>
                                                    <div class="event_location">
                                                        <p>{{ $event->venue ?? '' }},
                                                            {{ $event->address ?? '' }}
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="main_text">
                                                <P>{{ $event->title ?? '' }}</P>
                                            </div>
                                        </div>
                                        <div class="button">

                                            <p>Join Now <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                    height="16" fill="currentColor" class="bi bi-arrow-up-right"
                                                    viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0z" />
                                                </svg></p>

                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="right_event_img">
                        @if (!empty($eventImage->image) && Storage::exists('public/event/' . $eventImage->image))
                            <img src="{{ asset('storage/event/' . $event->image) }}" alt="">
                        @else
                            <img src="{{ asset('frontpanel/assets/images/Rectangle 148 (2).png') }}" alt="">
                        @endif
                    </div>
                </div>
                <div style="margin-top: 2rem;">
                    {{ $events->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>

    </div>
@endsection
