@extends('frontend.layout2.main2')
@section('title', 'हाम्रा हालका परियोजनाहरू')

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
                <p>कार्यक्रम विवरण पृष्ठ</p>
            </div>
        </div>
        <div class="img_after">
            <img src="{{ asset('frontpanel/assets/images/Mask group.png') }}" alt="">
        </div>
    </section>
    <div class="program-inner-container">
        <div class="container">
            <div class="program-inner-wrapper">
                <div class="program-inner-lt">
                    <div class="program-inner-title">
                        <p>{{ $program->title ?? '' }}</p>
                    </div>
                    <div class="program-inner-txt">
                        <p>{!! $program->details !!}
                        </p>
                    </div>
                </div>
                <div class="program-inner-rt">
                    <div class="program-inner-rt-content">
                        <div class="program-inner-rt-title">
                            <p>सम्बन्धित कार्यक्रमहरू</p>
                        </div>
                        @if (!@empty($programs))
                            @foreach ($programs as $program)
                                <div class="program-inner-rt-txt">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                                        <path
                                            d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                                    </svg>
                                    <a href="{{ route('program.inner', $program->slug) }}">
                                        <p>{{ $program->title ?? '' }}</p>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <p>No Date Found</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
