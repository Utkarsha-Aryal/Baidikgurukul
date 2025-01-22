@extends('frontend.layout2.main2')
@section('title', 'Our Gallery')
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
                <p>Our Gallery</p>
            </div>
        </div>
        <div class="img_after">
            <img src="{{ asset('frontpanel/assets/images/Mask group.png') }}" alt="">
        </div>
    </section>
    <div class="gallery-container-main">
        <div class="container">
            <div class="tabs">
                <button class="tab active" data-target="all">All</button>
                <button class="tab" data-target="images">Images</button>
                <button class="tab" data-target="videos">Videos</button>
            </div>
        </div>
        <div class="container">
            <div id="all" class="content active">
                <div class="gallery-content-main">
                    @if (!@empty($galleries) && count($galleries) > 0)
                        @foreach ($galleries as $gallery)
                            <div class="gallery-r1">
                                <a href="{{ route('ginner', $gallery->slug) }}">
                                    <div class="g1-img">
                                        @if (
                                            !empty($galleryVideoImages[$gallery->id]) &&
                                                Storage::exists('public/community/' . $galleryVideoImages[$gallery->id]))
                                            <img src="{{ asset('storage/community/' . $galleryVideoImages[$gallery->id]) }}"
                                                alt="">
                                        @else
                                            <img src="{{ asset('frontpanel/assets/images/cultural.png') }}" alt="">
                                        @endif
                                    </div>
                                </a>
                                <div class="gallery-g1-title">
                                    <p>{{ $gallery->name ?? '' }}</p>
                                </div>
                                <div class="gallery-g1-txt">
                                    <p>{{ count($gallery->videos) }} Videos</p>
                                </div>
                            </div>
                            <div class="gallery-r1">
                                <a href="{{ route('image.inner', $gallery->slug) }}">
                                    <div class="g1-img">

                                        @if (!empty($gallery->image) && Storage::exists('public/gallery-image/' . $gallery->image))
                                            <img src="{{ asset('storage/gallery-image/' . $gallery->image) }}"
                                                alt="">
                                        @else
                                            <img src="{{ asset('frontpanel/assets/images/cultural.png') }}" alt="">
                                        @endif
                                    </div>
                                    <div class="gallery-g1-title">
                                        <p>{{ $gallery->name ?? '' }}</p>
                                    </div>
                                    <div class="gallery-g1-txt">
                                        <p>{{ count($gallery->images) }} Photos</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <p>No video and image available</p>
                    @endif
                </div>
            </div>
            <div id="images" class="content">
                <div class="gallery-content-main">
                    @if (!@empty($galleries) && count($galleries) > 0)
                        @foreach ($galleries as $gallery)
                            <div class="gallery-r1"> <a href="{{ route('image.inner', $gallery->slug) }}">

                                    <div class="g1-img">
                                        @if (!empty($gallery->image) && Storage::exists('public/gallery-image/' . $gallery->image))
                                            <img src="{{ asset('storage/gallery-image/' . $gallery->image) }}"
                                                alt="">
                                        @else
                                            <img src="{{ asset('frontpanel/assets/images/Rectangle 170 (3).png') }}"
                                                alt="">
                                        @endif
                                    </div>
                                </a>
                                <div class="gallery-g1-title">
                                    <p>{{ $gallery->name ?? '' }}</p>
                                </div>
                                <div class="gallery-g1-txt">
                                    <p>{{ count($gallery->images) }} Photos</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>No image available</p>
                    @endif
                </div>
            </div>
            <div id="videos" class="content">
                <div class="gallery-content-main">
                    @if (!@empty($galleries) && count($galleries) > 0)
                        @foreach ($galleries as $gallery)
                            <div class="gallery-r1"> <a href="{{ route('ginner', $gallery->slug) }}">
                                    <div class="g1-img">
                                        @if (
                                            !empty($galleryVideoImages[$gallery->id]) &&
                                                Storage::exists('public/community/' . $galleryVideoImages[$gallery->id]))
                                            <img src="{{ asset('storage/community/' . $galleryVideoImages[$gallery->id]) }}"
                                                alt="">
                                        @else
                                            <img src="{{ asset('frontpanel/assets/images/cultural.png') }}" alt="">
                                        @endif
                                    </div>
                                    <div class="gallery-g1-title">
                                        <p>{{ $gallery->name ?? '' }}</p>
                                    </div>
                                    <div class="gallery-g1-txt">
                                        <p>{{ count($gallery->videos) }} Videos</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <p>No video available</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        const tabs = document.querySelectorAll('.tab');
        const contents = document.querySelectorAll('.content');
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove active class from all tabs and contents
                tabs.forEach(t => t.classList.remove('active'));
                contents.forEach(c => c.classList.remove('active'));
                // Add active class to clicked tab and corresponding content
                tab.classList.add('active');
                const target = document.getElementById(tab.dataset.target);
                target.classList.add('active');
            });
        });
    </script>
@endsection
