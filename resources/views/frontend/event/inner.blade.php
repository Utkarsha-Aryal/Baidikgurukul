@extends('frontend.layouts.main')
@section('title', 'Our Events Inner Page')
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
            <p>Our Events Inner</p>
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
                <P>
                    What Is Good For The Betterment Of Your
                    Children Health
                </P>
            </div>
            <div class="left_container_image">
                <img src="frontend\images\Rectangle 165 (4).png">
            </div>
            <div class="left_container_content">
                <p>Lorem ipsum dolor sit amet consectetur. Vestibulum varius mus id elit elit facilisis amet bibendum a. Vulputate ut porta pulvinar dictumst. Sagittis aliquam dis nec nunc amet quis. Faucibus elementum et nunc bibendum tortor eu ut. Feugiat donec ornare pretium vestibulum quis felis pharetra sagittis. Sit in ornare praesent porta pellentesque adipiscing massa aenean sit.<br><br>

                    Phasellus nibh semper id maecenas lobortis mi est in. Ipsum dolor enim ipsum pharetra. Morbi faucibus curabitur hendrerit dui. Gravida nam est ut odio. Lorem nisi amet aliquet viverra euismod neque sed platea in. Massa blandit ac urna molestie nulla vehicula eleifend morbi. Malesuada molestie orci consequat ultrices bibendum. Viverra ullamcorper et eu at adipiscing. Pellentesque massa amet ut mi facilisis nisl donec id. Feugiat volutpat enim sit donec nec.

                    Phasellus nibh semper id maecenas lobortis mi est in.<br><br> Ipsum dolor enim ipsum pharetra. Morbi faucibus curabitur hendrerit dui. Gravida nam est ut odio. Lorem nisi amet aliquet viverra euismod neque sed platea in. Massa blandit ac urna molestie nulla vehicula eleifend morbi. Malesuada molestie orci consequat ultrices bibendum. Viverra ullamcorper et eu at adipiscing. Pellentesque massa amet ut mi facilisis nisl donec id. Feugiat volutpat enim sit donec nec.
                </p>
            </div>
        </div>
        <div class="nb_right_wrapper_wrap">
            <div class="nb_right_container">
                <div class="right_first_text">
                    <p>
                        Events Information
                    </p>
                </div>
                <div class="nb_right_wrapper">
                    <div class="right_calender">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar4-week" viewBox="0 0 16 16">
                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M2 2a1 1 0 0 0-1 1v1h14V3a1 1 0 0 0-1-1zm13 3H1v9a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z" />
                            <path d="M11 7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-2 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z" />
                        </svg>
                        <p>Date:<span class="grey_txt">Jun 21, 2024</span> </p>
                    </div>
                </div>
                <div class="nb_right_wrapper">
                    <div class="right_calender">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                        </svg>
                        <p>Time:<span class="grey_txt"> 8:00am - 4:00 pm</span> </p>
                    </div>
                </div>

                <div class="nb_right_wrapper">
                    <div class="right_calender">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                            <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
                            <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                        </svg>
                        <p>Venue:<span class="grey_txt"> Smart School</span> </p>
                    </div>
                </div>
                <div class="nb_right_wrapper">
                    <div class="right_calender">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                            <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
                            <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                        </svg>
                        <p>Address:<span class="grey_txt"> Buddhanagar</span> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection