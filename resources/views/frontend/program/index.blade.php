@extends('frontend.layout2.main2')
@section('title', 'Program')
@section('content2')
    <section class="introduction_page">
        <div class="img_before">
            <img src="{{ asset('frontpanel/assets/images/Mask group.png') }}" alt="">
        </div>
        <div class="common_image_txt">
            <div class="common_bg_wrapper">
                <img src="{{ asset('frontpanel/assets/images/image1.jpeg') }}" alt="hands">
            </div>
            <div class="main_txt">
                <p>कार्यक्रम</p>
            </div>
        </div>
        <div class="img_after">
            <img src="{{ asset('frontpanel/assets/images/Mask group.png') }}" alt="">
        </div>
    </section>
    <div class="program-container-main">
        <div class="container">
            <div class="program-content">
                @if (!@empty($programs) && count($programs) > 0)

                    @foreach ($programs as $program)
                        <div class="program-r1">
                            <div class="r1-img">
                                @if (!empty($program->image) && Storage::exists('public/program/' . $program->image))
                                    <img src="{{ asset('storage/program/' . $program->image) }}" alt="">
                                @else
                                    <img src="{{ asset('frontpanel/assets/images/Rectangle 148 (2).png') }}" alt="image">
                                @endif
                            </div>
                            <div class=" program-r1-title">
                                <p>{!! Str::limit($program->title, 30, '...') !!}</p>
                            </div>
                            {{-- <div class="program-r1-txt">
                                <p>{!! Str::limit($program->details, 40, '...') !!}</p>
                            </div> --}}
                            <div class="readmore-none">
                                <a href="{{ route('program.inner', $program->slug) }}">
                                    <p>
                                        थप पढ्नुहोस्</p>
                                </a>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" />
                                </svg>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No Program Available</p>
                @endif
            </div>
        </div>
    </div>


@endsection
