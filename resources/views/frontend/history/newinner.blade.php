@extends('frontend.layouts.main')
@section('title', 'Our Historical Places')
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
                <p>Our Historical Places</p>
            </div>
        </div>
        <div class="img_after">
            <img src="{{ asset('frontpanel/assets/images/Mask group.png') }}" alt="">
        </div>
    </section>

    <section class="team_tab_section">
        <div class="container">
            <div class="container_wrapper">
                <!-- Tab Navigation (Left Side) -->
                <div class="tabs">
                    <div class="first_txt">
                        <p>Our Historical Places</p>
                    </div>
                    @if (!empty($histories) && count($histories) > 0)
                        @foreach ($histories as $index => $history)
                            <a href="{{ route('history.inners', $history->slug) }}">
                                <div class="tab {{ request()->slug === $history->slug ? 'active' : '' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
                                    </svg>
                                    <p>{{ $history->title }}</p>
                                </div>
                            </a>
                        @endforeach
                    @else
                        <p>No Data Found</p>
                    @endif
                </div>

                <div class="content">
                    @if (!empty($historyDeatils))
                        <div class="content-item">
                            <div class="first_content_wrapper">
                                <div class="first_txt">
                                    <p>{{ $historyDeatils->title }}</p>
                                </div>
                                <div class="second_txt">
                                    <p>{!! $historyDeatils->details !!}</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <p>No Data Found</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
