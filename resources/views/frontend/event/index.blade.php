@extends('frontend.layouts.main')
@section('title', 'Our Events')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
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
            <p>Our Events</p>
        </div>
    </div>
    <div class="img_after">
        <img src="{{ asset('frontpanel/assets/images/Mask group.png') }}" alt="">
    </div>
</section>
<div class="swiper_pagination_wrapper">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="Event_page">
                    <div class="container">
                        <div class="event_wrapper">
                            <div class="left_event_text">
                                <div class="first_blue_text">
                                    <p>Upcoming Events</p>
                                </div>
                                <div class="second_event_text">
                                    <p>Join Our Upcoming <span class="blue_text">Events </span></p>
                                </div>
                                <div class="third_event_text">
                                    <P>Lorem ipsum dolor sit amet consectetur. Adipiscing aliquet sed imperdiet metus ultrices. Vel etiam ipsum felis.</P>
                                </div>
                                <!-- event card boxes starts here -->
                                <!-- first event box -->
                                <div class="event_notice_container">
                                    <div class="event_notice_info_cards">
                                        <div class="date_info">
                                            <div class="date1">
                                                <p>25</p>
                                            </div>
                                            <div class="date2">
                                                <p>May, 2024 </P>
                                            </div>
                                        </div>
                                        <div class="event_info">
                                            <div class="time_date_container">
                                                <div class="event_time">
                                                    <div class="event_img">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                                            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                                                        </svg>
                                                    </div>
                                                    <div class="event_time">
                                                        <p>2:30 pm to 4:30 pm
                                                        <p>
                                                    </div>
                                                </div>
                                                <div class="event_location">
                                                    <div class="event_img">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                                            <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
                                                            <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                                        </svg>
                                                    </div>
                                                    <div class="event_location">
                                                        <p>Buddhanagar, Ktm</p>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="main_text">
                                                <p>Community Service Events</p>
                                            </div>
                                        </div>
                                        <div class="button">
                                            <a href="einner">
                                                <p>Join Now <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-right" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0z" />
                                                    </svg></p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- second event box -->
                                <div class="event_notice_container">
                                    <div class="event_notice_info_cards">
                                        <div class="date_info">
                                            <div class="date1">
                                                <p>25</p>
                                            </div>
                                            <div class="date2">
                                                <p>May, 2024 </P>
                                            </div>
                                        </div>
                                        <div class="event_info">
                                            <div class="time_date_container">
                                                <div class="event_time">
                                                    <div class="event_img">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                                            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                                                        </svg>
                                                    </div>
                                                    <div class="event_time">
                                                        <p>2:30 pm to 4:30 pm
                                                        <p>
                                                    </div>
                                                </div>
                                                <div class="event_location">
                                                    <div class="event_img">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                                            <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
                                                            <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                                        </svg>
                                                    </div>
                                                    <div class="event_location">
                                                        <p>Buddhanagar, Ktm</p>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="main_text">
                                                <p>Community Service Events</p>
                                            </div>
                                        </div>
                                        <div class="button">
                                            <a href="einner">
                                                <p>Join Now <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-right" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0z" />
                                                    </svg></p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- third event box -->
                                <div class="event_notice_container">
                                    <div class="event_notice_info_cards">
                                        <div class="date_info">
                                            <div class="date1">
                                                <p>25</p>
                                            </div>
                                            <div class="date2">
                                                <p>May, 2024 </P>
                                            </div>
                                        </div>
                                        <div class="event_info">
                                            <div class="time_date_container">
                                                <div class="event_time">
                                                    <div class="event_img">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                                            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                                                        </svg>
                                                    </div>
                                                    <div class="event_time">
                                                        <p>2:30 pm to 4:30 pm
                                                        <p>
                                                    </div>
                                                </div>
                                                <div class="event_location">
                                                    <div class="event_img">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                                            <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
                                                            <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                                        </svg>
                                                    </div>
                                                    <div class="event_location">
                                                        <p>Buddhanagar, Ktm</p>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="main_text">
                                                <p>Community Service Events</p>
                                            </div>
                                        </div>
                                        <div class="button">
                                            <a href="einner">
                                                <p>Join Now <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-right" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0z" />
                                                    </svg></p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--  image flexed for event page-->
                            <div class="right_event_img">
                                <img src="frontend\images\Rectangle 148 (2).png">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="Event_page">
                    <div class="container">
                        <div class="event_wrapper">
                            <div class="left_event_text">
                                <div class="first_blue_text">
                                    <p>Upcoming Events</p>
                                </div>
                                <div class="second_event_text">
                                    <p>Join Our Upcoming <span class="blue_text">Events </span></p>
                                </div>
                                <div class="third_event_text">
                                    <P>Lorem ipsum dolor sit amet consectetur. Adipiscing aliquet sed imperdiet metus ultrices. Vel etiam ipsum felis.</P>
                                </div>
                                <!-- event card boxes starts here -->
                                <!-- first event box -->
                                <div class="event_notice_container">
                                    <div class="event_notice_info_cards">
                                        <div class="date_info">
                                            <div class="date1">
                                                <p>25</p>
                                            </div>
                                            <div class="date2">
                                                <p>May, 2024 </P>
                                            </div>
                                        </div>
                                        <div class="event_info">
                                            <div class="time_date_container">
                                                <div class="event_time">
                                                    <div class="event_img">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                                            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                                                        </svg>
                                                    </div>
                                                    <div class="event_time">
                                                        <p>2:30 pm to 4:30 pm
                                                        <p>
                                                    </div>
                                                </div>
                                                <div class="event_location">
                                                    <div class="event_img">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                                            <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
                                                            <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                                        </svg>
                                                    </div>
                                                    <div class="event_location">
                                                        <p>Buddhanagar, Ktm</p>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="main_text">
                                                <p>Community Service Events</p>
                                            </div>
                                        </div>
                                        <div class="button">
                                            <a href="einner">
                                                <p>Join Now <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-right" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0z" />
                                                    </svg></p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- second event box -->
                                <div class="event_notice_container">
                                    <div class="event_notice_info_cards">
                                        <div class="date_info">
                                            <div class="date1">
                                                <p>25</p>
                                            </div>
                                            <div class="date2">
                                                <p>May, 2024 </P>
                                            </div>
                                        </div>
                                        <div class="event_info">
                                            <div class="time_date_container">
                                                <div class="event_time">
                                                    <div class="event_img">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                                            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                                                        </svg>
                                                    </div>
                                                    <div class="event_time">
                                                        <p>2:30 pm to 4:30 pm
                                                        <p>
                                                    </div>
                                                </div>
                                                <div class="event_location">
                                                    <div class="event_img">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                                            <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
                                                            <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                                        </svg>
                                                    </div>
                                                    <div class="event_location">
                                                        <p>Buddhanagar, Ktm</p>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="main_text">
                                                <p>Community Service Events</p>
                                            </div>
                                        </div>
                                        <div class="button">
                                            <a href="einner">
                                                <p>Join Now <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-right" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0z" />
                                                    </svg></p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- third event box -->
                                <div class="event_notice_container">
                                    <div class="event_notice_info_cards">
                                        <div class="date_info">
                                            <div class="date1">
                                                <p>25</p>
                                            </div>
                                            <div class="date2">
                                                <p>May, 2024 </P>
                                            </div>
                                        </div>
                                        <div class="event_info">
                                            <div class="time_date_container">
                                                <div class="event_time">
                                                    <div class="event_img">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                                            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                                                        </svg>
                                                    </div>
                                                    <div class="event_time">
                                                        <p>2:30 pm to 4:30 pm
                                                        <p>
                                                    </div>
                                                </div>
                                                <div class="event_location">
                                                    <div class="event_img">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                                            <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
                                                            <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                                        </svg>
                                                    </div>
                                                    <div class="event_location">
                                                        <p>Buddhanagar, Ktm</p>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="main_text">
                                                <p>Community Service Events</p>
                                            </div>
                                        </div>
                                        <div class="button">
                                            <a href="einner">
                                                <p>Join Now <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-right" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0z" />
                                                    </svg></p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--  image flexed for event page-->
                            <div class="right_event_img">
                                <img src="frontend\images\Rectangle 148 (2).png">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="Event_page">
                    <div class="container">
                        <div class="event_wrapper">
                            <div class="left_event_text">
                                <div class="first_blue_text">
                                    <p>Upcoming Events</p>
                                </div>
                                <div class="second_event_text">
                                    <p>Join Our Upcoming <span class="blue_text">Events </span></p>
                                </div>
                                <div class="third_event_text">
                                    <P>Lorem ipsum dolor sit amet consectetur. Adipiscing aliquet sed imperdiet metus ultrices. Vel etiam ipsum felis.</P>
                                </div>
                                <!-- event card boxes starts here -->
                                <!-- first event box -->
                                <div class="event_notice_container">
                                    <div class="event_notice_info_cards">
                                        <div class="date_info">
                                            <div class="date1">
                                                <p>25</p>
                                            </div>
                                            <div class="date2">
                                                <p>May, 2024 </P>
                                            </div>
                                        </div>
                                        <div class="event_info">
                                            <div class="time_date_container">
                                                <div class="event_time">
                                                    <div class="event_img">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                                            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                                                        </svg>
                                                    </div>
                                                    <div class="event_time">
                                                        <p>2:30 pm to 4:30 pm
                                                        <p>
                                                    </div>
                                                </div>
                                                <div class="event_location">
                                                    <div class="event_img">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                                            <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
                                                            <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                                        </svg>
                                                    </div>
                                                    <div class="event_location">
                                                        <p>Buddhanagar, Ktm</p>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="main_text">
                                                <p>Community Service Events</p>
                                            </div>
                                        </div>
                                        <div class="button">
                                            <a href="einner">
                                                <p>Join Now <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-right" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0z" />
                                                    </svg></p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- second event box -->
                                <div class="event_notice_container">
                                    <div class="event_notice_info_cards">
                                        <div class="date_info">
                                            <div class="date1">
                                                <p>25</p>
                                            </div>
                                            <div class="date2">
                                                <p>May, 2024 </P>
                                            </div>
                                        </div>
                                        <div class="event_info">
                                            <div class="time_date_container">
                                                <div class="event_time">
                                                    <div class="event_img">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                                            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                                                        </svg>
                                                    </div>
                                                    <div class="event_time">
                                                        <p>2:30 pm to 4:30 pm
                                                        <p>
                                                    </div>
                                                </div>
                                                <div class="event_location">
                                                    <div class="event_img">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                                            <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
                                                            <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                                        </svg>
                                                    </div>
                                                    <div class="event_location">
                                                        <p>Buddhanagar, Ktm</p>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="main_text">
                                                <p>Community Service Events</p>
                                            </div>
                                        </div>
                                        <div class="button">
                                            <a href="einner">
                                                <p>Join Now <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-right" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0z" />
                                                    </svg></p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- third event box -->
                                <div class="event_notice_container">
                                    <div class="event_notice_info_cards">
                                        <div class="date_info">
                                            <div class="date1">
                                                <p>25</p>
                                            </div>
                                            <div class="date2">
                                                <p>May, 2024 </P>
                                            </div>
                                        </div>
                                        <div class="event_info">
                                            <div class="time_date_container">
                                                <div class="event_time">
                                                    <div class="event_img">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                                            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                                                        </svg>
                                                    </div>
                                                    <div class="event_time">
                                                        <p>2:30 pm to 4:30 pm
                                                        <p>
                                                    </div>
                                                </div>
                                                <div class="event_location">
                                                    <div class="event_img">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                                            <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
                                                            <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                                        </svg>
                                                    </div>
                                                    <div class="event_location">
                                                        <p>Buddhanagar, Ktm</p>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="main_text">
                                                <p>Community Service Events</p>
                                            </div>
                                        </div>
                                        <div class="button">
                                            <a href="einner">
                                                <p>Join Now <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-right" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0z" />
                                                    </svg></p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--  image flexed for event page-->
                            <div class="right_event_img">
                                <img src="frontend\images\Rectangle 148 (2).png">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="Event_page">
                    <div class="container">
                        <div class="event_wrapper">
                            <div class="left_event_text">
                                <div class="first_blue_text">
                                    <p>Upcoming Events</p>
                                </div>
                                <div class="second_event_text">
                                    <p>Join Our Upcoming <span class="blue_text">Events </span></p>
                                </div>
                                <div class="third_event_text">
                                    <P>Lorem ipsum dolor sit amet consectetur. Adipiscing aliquet sed imperdiet metus ultrices. Vel etiam ipsum felis.</P>
                                </div>
                                <!-- event card boxes starts here -->
                                <!-- first event box -->
                                <div class="event_notice_container">
                                    <div class="event_notice_info_cards">
                                        <div class="date_info">
                                            <div class="date1">
                                                <p>25</p>
                                            </div>
                                            <div class="date2">
                                                <p>May, 2024 </P>
                                            </div>
                                        </div>
                                        <div class="event_info">
                                            <div class="time_date_container">
                                                <div class="event_time">
                                                    <div class="event_img">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                                            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                                                        </svg>
                                                    </div>
                                                    <div class="event_time">
                                                        <p>2:30 pm to 4:30 pm
                                                        <p>
                                                    </div>
                                                </div>
                                                <div class="event_location">
                                                    <div class="event_img">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                                            <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
                                                            <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                                        </svg>
                                                    </div>
                                                    <div class="event_location">
                                                        <p>Buddhanagar, Ktm</p>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="main_text">
                                                <p>Community Service Events</p>
                                            </div>
                                        </div>
                                        <div class="button">
                                            <a href="einner">
                                                <p>Join Now <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-right" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0z" />
                                                    </svg></p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- second event box -->
                                <div class="event_notice_container">
                                    <div class="event_notice_info_cards">
                                        <div class="date_info">
                                            <div class="date1">
                                                <p>25</p>
                                            </div>
                                            <div class="date2">
                                                <p>May, 2024 </P>
                                            </div>
                                        </div>
                                        <div class="event_info">
                                            <div class="time_date_container">
                                                <div class="event_time">
                                                    <div class="event_img">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                                            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                                                        </svg>
                                                    </div>
                                                    <div class="event_time">
                                                        <p>2:30 pm to 4:30 pm
                                                        <p>
                                                    </div>
                                                </div>
                                                <div class="event_location">
                                                    <div class="event_img">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                                            <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
                                                            <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                                        </svg>
                                                    </div>
                                                    <div class="event_location">
                                                        <p>Buddhanagar, Ktm</p>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="main_text">
                                                <p>Community Service Events</p>
                                            </div>
                                        </div>
                                        <div class="button">
                                            <a href="einner">
                                                <p>Join Now <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-right" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0z" />
                                                    </svg></p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- third event box -->
                                <div class="event_notice_container">
                                    <div class="event_notice_info_cards">
                                        <div class="date_info">
                                            <div class="date1">
                                                <p>25</p>
                                            </div>
                                            <div class="date2">
                                                <p>May, 2024 </P>
                                            </div>
                                        </div>
                                        <div class="event_info">
                                            <div class="time_date_container">
                                                <div class="event_time">
                                                    <div class="event_img">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                                            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                                                        </svg>
                                                    </div>
                                                    <div class="event_time">
                                                        <p>2:30 pm to 4:30 pm
                                                        <p>
                                                    </div>
                                                </div>
                                                <div class="event_location">
                                                    <div class="event_img">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                                            <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
                                                            <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                                        </svg>
                                                    </div>
                                                    <div class="event_location">
                                                        <p>Buddhanagar, Ktm</p>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="main_text">
                                                <p>Community Service Events</p>
                                            </div>
                                        </div>
                                        <div class="button">
                                            <a href="einner">
                                                <p>Join Now <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-right" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0z" />
                                                    </svg></p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--  image flexed for event page-->
                            <div class="right_event_img">
                                <img src="frontend\images\Rectangle 148 (2).png">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="pagination">
            <div class="pagination_number">
                <p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0" />
                    </svg></p>
            </div>
            <div class="pagination_number">
                <p>1</p>
            </div>
            <div class="pagination_number">
                <p>2</p>
            </div>
            <div class="pagination_number">
                <p>3</p>
            </div>
            <div class="pagination_number">
                <p>4</p>
            </div>
            <div class="pagination_number">
                <p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                    </svg></p>
            </div>
        </div> -->
    </div>
</div>

<script>
    var swiper = new Swiper(".mySwiper", {
        pagination: {
            el: ".pagination",
        },
        autoplay: {
            delay: 3000, // time in milliseconds between slides
            disableOnInteraction: false, // allows autoplay to continue after user interaction
        },
    });
</script>

@endsection