@extends('frontend.layout2.main2')
@section('title', 'About Us')

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
                <p>वार्षिक प्रगति समरि</p>
            </div>
        </div>
        <div class="img_after">
            <img src="{{ asset('frontpanel/assets/images/Mask group.png') }}" alt="">
        </div>
    </section>
    <div class="mission_vision_container">
        <div class="container">
            <div class="timeline-container">
                @if (count($timelines) > 0)
                    <div class="timeline-header">
                        <p>
                            हाम्रो इतिहास
                        </p>
                    </div>
                @else
                    <p>No data found</p>
                @endif

                @if (!empty($timelines))
                    @foreach ($timelines as $index => $timeline)
                        <div class="{{ $index % 2 == 0 ? 'timeline-item_odd' : 'timeline-item_even' }}">
                            <div class="timeline-item-content">

                                <h3>{{ $timeline->year }}</h3>

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
                    <p>No Data Available</p>
                @endif
            </div>
        </div>
    </div>
@endsection
