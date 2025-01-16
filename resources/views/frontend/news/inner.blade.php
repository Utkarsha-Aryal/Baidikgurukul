@extends('frontend.layouts.main')
@section('title', 'News & Blogs inner page')
@section('content')
    <section class="introduction_page">
        <div class="img_before">
            <img src="{{ asset('frontpanel/assets/images/Mask group.png') }}" alt="">
        </div>
        <div class="common_image_txt">
            <div class="common_bg_wrapper">
                <img src="{{ asset('frontpanel/assets/images/Mask group.png') }}" alt="">
            </div>
            <div class="main_txt">
                <p>News & Blogs Inner Page</p>
            </div>
        </div>
        <div class="img_after">
            <img src="{{ asset('frontpanel/assets/images/Mask group.png') }}" alt="">
        </div>
    </section>

    <div class="container">
        <div class="nb_details_container">
            <div class="nb_left_container">
                <div class="left_first_text">
                    @if (!@empty($post->title))
                        <P>
                            {{ $post->title ?? '' }}
                        </P>
                    @endif
                </div>
                <div class="left_container_image">
                    @if (!empty($post->image) && Storage::exists('public/post/' . $post->image))
                        <img src="{{ asset('storage/post/' . $post->image) }}" alt="">
                    @else
                        <img src="frontend\images\Rectangle 143 (2).png">
                    @endif
                </div>
                <div class="left_container_content">
                    @if (!@empty($post->details))
                        <P>
                            {!! $post->details ?? '' !!}
                        </P>
                    @endif
                </div>
            </div>
            <div class="nb_right_wrapper_wrap">
                <div class="nb_right_container">
                    <div class="right_first_text">
                        <p>
                            Recent News
                        </p>
                    </div>
                    @if (!@empty($posts))
                        @foreach ($posts as $post)
                            <a href="{{ route('news.inner.page', $post->slug) }}">

                                <div class="nb_right_wrapper">
                                    <div class="right_container_image">
                                        @if (!empty($post->image) && Storage::exists('public/post/' . $post->image))
                                            <img src="{{ asset('storage/post/' . $post->image) }}" alt="">
                                        @else
                                            <img src="frontend\images\Rectangle 143 (2).png">
                                        @endif
                                    </div>
                                    <div class="right_text">
                                        <p>{{ $post->title ?? '' }}</p>
                                        <div class="right_calender">
                                            <p>
                                                <i class="fa-solid fa-calendar-week"></i>
                                                {{ !empty($post->created_at) ? $post->created_at->format('d F, Y') : $post->updated_at->format('d F, Y') }}
                                            </p>

                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
