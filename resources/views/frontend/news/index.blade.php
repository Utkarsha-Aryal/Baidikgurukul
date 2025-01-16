@extends('frontend.layouts.main')
@section('title', 'News & Blogs')
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
                <p>News & Blogs</p>
            </div>
        </div>
        <div class="img_after">
            <img src="frontend\images\Mask group.png" alt="mask_group">
        </div>
    </section>

    <div class="blogs-container-main">
        <div class="container">
            <div class="blogs-content-main">
                @foreach ($posts as $post)
                    <div class="blogs-r1">
                        <div class="blogs-img">
                            @if (!empty($post->image) && Storage::exists('public/post/' . $post->image))
                                <img src="{{ asset('storage/post/' . $post->image) }}" alt="">
                            @else
                                <img src="frontend\images\Rectangle 143 (2).png">
                            @endif
                        </div>
                        <div class="blogs-b1-header">
                            <p>{{ $post->title ?? '' }}</p>
                        </div>
                        <div class="blogs-b1-title">
                            <p>{!! Str::limit($post->details, 100, '...') !!}</p>
                        </div>
                        <div class="blogs-b1-txt">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-calendar-week" viewBox="0 0 16 16">
                                <path
                                    d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z" />
                                <path
                                    d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                            </svg>
                            <p>{{ !empty($post->created_at) ? $post->created_at->format('Y-m-d') : $post->updated_at->format('Y-m-d') }}
                            </p>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

@endsection
