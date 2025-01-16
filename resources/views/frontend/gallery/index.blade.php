@extends('frontend.layouts.main')
@section('title', 'Our Gallery')
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
                <div class="gallery-r1">
                    <a href="ginner">
                        <div class="g1-img">
                            <iframe src="https://www.youtube.com/embed/7q4o8Y5POdE?si=jLABvm_qw4tw8oZk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                    </a>
                    <div class="gallery-g1-title">
                        <p>Our Events Photo for the awareness programee in KTM</p>
                    </div>
                    <div class="gallery-g1-txt">
                        <p>20 Videos</p>
                    </div>
                </div>
                <div class="gallery-r1">
                    <div class="g1-img">
                        <img src="frontend\images\ritual.png">
                    </div>
                    <div class="gallery-g1-title">
                        <p>Our Events Photo for the awareness programee in KTM</p>
                    </div>
                    <div class="gallery-g1-txt">
                        <p>20 Photos</p>
                    </div>
                </div>
                <div class="gallery-r1">
                    <div class="g1-img">
                        <img src="frontend\images\ritual.png">
                    </div>
                    <div class="gallery-g1-title">
                        <p>Our Events Photo for the awareness programee in KTM</p>
                    </div>
                    <div class="gallery-g1-txt">
                        <p>11 videos</p>
                    </div>
                </div>
                <div class="gallery-r1">
                    <div class="g1-img">
                        <img src="frontend\images\ritual.png">
                    </div>
                    <div class="gallery-g1-title">
                        <p>Our Events Photo for the awareness programee in KTM</p>
                    </div>
                    <div class="gallery-g1-txt">
                        <p>20 Photos</p>
                    </div>
                </div>
                <div class="gallery-r1">
                    <div class="g1-img">
                        <img src="frontend\images\ritual.png">
                    </div>
                    <div class="gallery-g1-title">
                        <p>Our Events Photo for the awareness programee in KTM</p>
                    </div>
                    <div class="gallery-g1-txt">
                        <p>20 Photos</p>
                    </div>
                </div>
                <div class="gallery-r1">
                    <div class="g1-img">
                        <img src="frontend\images\ritual.png">
                    </div>
                    <div class="gallery-g1-title">
                        <p>Our Events Photo for the awareness programee in KTM</p>
                    </div>
                    <div class="gallery-g1-txt">
                        <p>11 videos</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="images" class="content">
            <div class="gallery-content-main">
                <div class="gallery-r1">
                    <div class="g1-img">
                        <img src="frontend\images\Rectangle 170 (3).png">
                    </div>
                    <div class="gallery-g1-title">
                        <p>Our Sports week Glimpses of 2080</p>
                    </div>
                    <div class="gallery-g1-txt">
                        <p>27 Photos</p>
                    </div>
                </div>
                <div class="gallery-r1">
                    <div class="g1-img">
                        <img src="frontend\images\Rectangle 170 (3).png">
                    </div>
                    <div class="gallery-g1-title">
                        <p>Our Picnic Photo of 2081</p>
                    </div>
                    <div class="gallery-g1-txt">
                        <p>36 Photos</p>
                    </div>
                </div>
                <div class="gallery-r1">
                    <div class="g1-img">
                        <img src="frontend\images\Rectangle 170 (3).png">
                    </div>
                    <div class="gallery-g1-title">
                        <p>Our Events Photo for the awareness programee in KTM</p>
                    </div>
                    <div class="gallery-g1-txt">
                        <p>2 Photos</p>
                    </div>
                </div>
                <div class="gallery-r1">
                    <div class="g1-img">
                        <img src="frontend\images\Rectangle 170 (3).png">
                    </div>
                    <div class="gallery-g1-title">
                        <p>Our Events Photo for the awareness programee in KTM</p>
                    </div>
                    <div class="gallery-g1-txt">
                        <p>27 Photos</p>
                    </div>
                </div>
                <div class="gallery-r1">
                    <div class="g1-img">
                        <img src="frontend\images\Rectangle 170 (3).png">
                    </div>
                    <div class="gallery-g1-title">
                        <p>Our Birthday Photos</p>
                    </div>
                    <div class="gallery-g1-txt">
                        <p>36 Photos</p>
                    </div>
                </div>
                <div class="gallery-r1">
                    <div class="g1-img">
                        <img src="frontend\images\Rectangle 170 (3).png">
                    </div>
                    <div class="gallery-g1-title">
                        <p>Our Picnic Photo of 2080</p>
                    </div>
                    <div class="gallery-g1-txt">
                        <p>2 Photos</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="videos" class="content">
            <div class="gallery-content-main">
                <div class="gallery-r1">
                    <div class="g1-img">
                        <iframe src="https://www.youtube.com/embed/7q4o8Y5POdE?si=jLABvm_qw4tw8oZk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                    <div class="gallery-g1-title">
                        <p>Our Events Video for the awareness programee in KTM</p>
                    </div>
                    <div class="gallery-g1-txt">
                        <p>20 Videos</p>
                    </div>
                </div>
                <div class="gallery-r1">
                    <div class="g1-img">
                        <iframe src="https://www.youtube.com/embed/7q4o8Y5POdE?si=jLABvm_qw4tw8oZk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                    <div class="gallery-g1-title">
                        <p>Our Events Video for the awareness programee in KTM</p>
                    </div>
                    <div class="gallery-g1-txt">
                        <p>21 Videos</p>
                    </div>
                </div>
                <div class="gallery-r1">
                    <div class="g1-img">
                        <iframe src="https://www.youtube.com/embed/7q4o8Y5POdE?si=jLABvm_qw4tw8oZk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                    <div class="gallery-g1-title">
                        <p>Our Birthday Videos</p>
                    </div>
                    <div class="gallery-g1-txt">
                        <p>7 Videos</p>
                    </div>
                </div>
                <div class="gallery-r1">
                    <div class="g1-img">
                        <iframe src="https://www.youtube.com/embed/7q4o8Y5POdE?si=jLABvm_qw4tw8oZk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                    <div class="gallery-g1-title">
                        <p>Our Sports Videos</p>
                    </div>
                    <div class="gallery-g1-txt">
                        <p>20 Videos</p>
                    </div>
                </div>
                <div class="gallery-r1">
                    <div class="g1-img">
                        <iframe src="https://www.youtube.com/embed/7q4o8Y5POdE?si=jLABvm_qw4tw8oZk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                    <div class="gallery-g1-title">
                        <p>Our Daily Videos</p>
                    </div>
                    <div class="gallery-g1-txt">
                        <p>21 Videos</p>
                    </div>
                </div>
                <div class="gallery-r1">
                    <div class="g1-img">
                        <iframe src="https://www.youtube.com/embed/7q4o8Y5POdE?si=jLABvm_qw4tw8oZk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                    <div class="gallery-g1-title">
                        <p>Our Events Video for the awareness programee in KTM</p>
                    </div>
                    <div class="gallery-g1-txt">
                        <p>7 Videos</p>
                    </div>
                </div>
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