@extends('frontend.layouts.main')
@section('title', 'Home')
@section('content')
    <section class="first_content">
        <div class="bg_image">
            <img src="{{ asset('frontpanel/assets/images/image1.jpeg') }}" alt="">
        </div>
        <div class="overlay_content_after">
            <div class="container">
                <div class="overlay_image_txt_wrapper">
                    <div class="left_image_wrapper">
                        <img src="{{ asset('frontpanel/assets/images/overlay-image.png') }}" alt="">
                        <div class="circle_border_outer"></div>
                        <div class="circle_border_first"></div>
                    </div>
                    <div class="overlay_txt">
                        <div class="first_txt">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                            </svg>
                            <p>Welcome To Chochangay Samaj Nepal</p>
                        </div>
                        <div class="second_txt">
                            <p>Dream Of Every
                                Chochangay Samaj
                                Community </p>
                        </div>
                        <button class="explore_button">
                            <a href="#">
                                <p>EXPLORE NOW</p>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
                                </svg>
                            </a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="circle_border_bottom"></div>
        <div class="circle_border"></div>
    </section>
    <section class="rules_rituals">
        <div class="container">
            <div class="rules_dream_wrapper">
                <div class="rules_wrapper_left">
                    <div class="bg_image_gradient">
                        <img src="{{ asset('frontpanel/assets/images/rituals.jpeg') }}" alt="">
                    </div>
                    <div class="rituals_txt_wrapper">
                        <div class="first_ritual_txt">
                            <p>Rules For Rituals Of Birth</p>
                        </div>
                        <div class="second_rituals_txt">
                            <p>Lorem ipsum dolor sit amet consectetur. Blandit fames sceler isq ue auctor vel diam quis. Sed
                                tortor ultricies blandit cursus risus ipsum libero quis. Quam neque nulla mi integer.</p>
                        </div>
                        <button class="read_more">
                            <a href="#">
                                <p>READ MORE</p>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                                </svg>
                            </a>
                        </button>

                    </div>
                </div>
                <div class="rules_right_wrap">
                    <div class="first_txt">
                        <p>Lorem ipsum dolor sit amet consectetur. A quam a nec gravida faucibus est. Feugiat at ac massa
                            egestas nibh quam pretium nisl mauris. Scelerisque odio sagittis a dui porta tortor netus nibh.
                        </p>
                    </div>
                    <button class="register_button">
                        <a href="form">
                            <p>REGISTER NOW</p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
                            </svg>
                        </a>
                    </button>
                </div>

            </div>
        </div>
    </section>
    <section class="rituals_dreams">
        <div class="container">
            <div class="dreams_wrappper">
                <div class="about-lt">
                    <div class="radius-o">
                        <div class="inner-o"></div>
                        <div class="dance-img">
                            <img src="{{ asset('frontpanel/assets/images/cultural.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="right_dreams_txt">
                    <div class="first_dreams_txt">
                        <p>About Chochangay Samaj Nepal</p>
                    </div>
                    <div class="second_txt">
                        <p>Dream Of Every <span class="blue">Chochangay
                                Samaj Nepal</span> Community</p>
                    </div>
                    <div class="third_dream_txt">
                        <p>Lorem ipsum dolor sit amet consectetur. Condimentum placerat nisi tellus ultrices quam ligula
                            aliquam. Elementum nullam ultricies lacus eleifend vestibulum. Pellentesque nisl in habitasse
                            nibh adipiscing eu ut mus accumsan. Adipiscing at placerat scelerisque gravida facilisis.
                            Facilisis suscipit odio porta consequat quis mi. Aliquet diam nisl diam mauris mi. Faucibus duis
                            in vitae congue purus. Vitae lorem sociis tellus nunc. Diam nibh sagittis tempor est tellus
                            lorem curabitur eget fames. Amet feugiat morbi justo vitae. Ornare sapien sit turpis cursus odio
                            est volutpat.
                            Imperdiet interdum leo in eu semper nulla turpis mattis. Blandit eleifend rhoncus egestas proin.
                            Lacus viverra aliquet tortor vitae. Tortor tristique turpis lobortis quam. Elit in ut fames nisi
                            ultrices.</p>
                    </div>
                    <button class="read_button">
                        <a href="#">
                            <p>READ MORE</p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
                            </svg>
                        </a>
                    </button>
                </div>
            </div>
        </div>

    </section>
    <section class="rights_for_dreams">
        <div class="container">
            <div class="rights_wrapper">
                <div class="left_rights_txt">
                    <div class="quote_container">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-quote" viewBox="0 0 16 16">
                            <path
                                d="M12 12a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1h-1.388q0-.527.062-1.054.093-.558.31-.992t.559-.683q.34-.279.868-.279V3q-.868 0-1.52.372a3.3 3.3 0 0 0-1.085.992 4.9 4.9 0 0 0-.62 1.458A7.7 7.7 0 0 0 9 7.558V11a1 1 0 0 0 1 1zm-6 0a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1H4.612q0-.527.062-1.054.094-.558.31-.992.217-.434.559-.683.34-.279.868-.279V3q-.868 0-1.52.372a3.3 3.3 0 0 0-1.085.992 4.9 4.9 0 0 0-.62 1.458A7.7 7.7 0 0 0 3 7.558V11a1 1 0 0 0 1 1z" />
                        </svg>
                    </div>
                    <div class="first_txt">
                        <p>Dream Of Every <span class="blue">Chochangay
                                Samaj Community</span> Is To Gather Our Rights </p>
                    </div>
                    <div class="third_dream_txt">
                        <p>Lorem ipsum dolor sit amet consectetur. Condimentum placerat nisi tellus ultrices quam ligula
                            aliquam. Elementum nullam ultricies lacus eleifend vestibulum. Pellentesque nisl in habitasse
                            nibh adipiscing eu ut mus accumsan. Adipiscing at placerat scelerisque gravida facilisis.
                            Facilisis suscipit odio porta consequat quis mi. Aliquet diam nisl diam mauris mi. Faucibus duis
                            in vitae congue purus. Vitae lorem sociis tellus nunc. Diam nibh sagittis tempor est tellus
                            lorem curabitur eget fames. Amet feugiat morbi justo vitae. Ornare sapien sit turpis cursus odio
                            est volutpat.
                            Imperdiet interdum leo in eu semper nulla turpis mattis. Blandit eleifend rhoncus egestas proin.
                            Lacus viverra aliquet tortor vitae. Tortor tristique turpis lobortis quam. Elit in ut fames nisi
                            ultrices.</p>
                    </div>
                    <button class="read_button">
                        <a href="#">
                            <p>READ MORE</p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
                            </svg>
                        </a>
                    </button>
                </div>
                <div class="right_rights_image">
                    <div class="image_container">
                        <img src="{{ asset('frontpanel/assets/images/curved.jpeg') }}" alt="">
                        <div class="image_designation_container">
                            <a href="#">
                                <p>Anusha Raimajhi</p>
                                <p>Chairperson</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="program_swiper">
        <div class="container">
            <div class="program_txt_pagination_wrap">
                <div class="program_initiative_txt">
                    <div class="first_program_txt">
                        <p>Programs & Initiatives</p>
                    </div>
                    <div class="second_program_txt">
                        <p>Our Update <span class="blue">Programs & Initiatives</span></p>
                    </div>
                    <div class="third_program_txt">
                        <p>Lorem ipsum dolor sit amet consectetur. Adipiscing aliquet sed imperdiet metus ultrices. Vel
                            etiam ipsum felis.</p>
                    </div>
                </div>
                <div class="arrow_container">
                    <div class="swiper-prev">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                        </svg>
                    </div>
                    <div class="swiper-next">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="swiper_content_card_wrapper">
                            <div class="swiper_content_card">
                                <div class="card_image">
                                    <img src="{{ asset('frontpanel/assets/images/Rectangle 170 (3).png') }}"
                                        alt="">
                                </div>
                                <div class="first_txt">
                                    <p>Completed projects Completed of
                                        projects overview </p>
                                </div>
                                <div class="second_txt">
                                    <p>Lorem ipsum dolor sit amet consectetur. Vitae amet ultricies in sed nibh ipsum vitae.
                                        Egestas donec.</p>
                                </div>
                                <button class="read_more">
                                    <a href="#">
                                        <p>READ MORE</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                                        </svg>
                                    </a>
                                </button>
                            </div>
                            <div class="swiper_content_card">
                                <div class="card_image">
                                    <img src="{{ asset('frontpanel/assets/images/Rectangle 170 (3).png') }}"
                                        alt="">
                                </div>
                                <div class="first_txt">
                                    <p>Completed projects Completed of
                                        projects overview </p>
                                </div>
                                <div class="second_txt">
                                    <p>Lorem ipsum dolor sit amet consectetur. Vitae amet ultricies in sed nibh ipsum vitae.
                                        Egestas donec.</p>
                                </div>
                                <button class="read_more">
                                    <a href="#">
                                        <p>READ MORE</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                                        </svg>
                                    </a>
                                </button>
                            </div>
                            <div class="swiper_content_card">
                                <div class="card_image">
                                    <img src="{{ asset('frontpanel/assets/images/Rectangle 170 (3).png') }}"
                                        alt="">
                                </div>
                                <div class="first_txt">
                                    <p>Completed projects Completed of
                                        projects overview </p>
                                </div>
                                <div class="second_txt">
                                    <p>Lorem ipsum dolor sit amet consectetur. Vitae amet ultricies in sed nibh ipsum vitae.
                                        Egestas donec.</p>
                                </div>
                                <button class="read_more">
                                    <a href="#">
                                        <p>READ MORE</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                                        </svg>
                                    </a>
                                </button>
                            </div>

                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="swiper_content_card_wrapper">
                            <div class="swiper_content_card">
                                <div class="card_image">
                                    <img src="{{ asset('frontpanel/assets/images/Rectangle 170 (3).png') }}"
                                        alt="">
                                </div>
                                <div class="first_txt">
                                    <p>Completed projects Completed of
                                        projects overview </p>
                                </div>
                                <div class="second_txt">
                                    <p>Lorem ipsum dolor sit amet consectetur. Vitae amet ultricies in sed nibh ipsum vitae.
                                        Egestas donec.</p>
                                </div>
                                <button class="read_more">
                                    <a href="#">
                                        <p>READ MORE</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                                        </svg>
                                    </a>
                                </button>
                            </div>
                            <div class="swiper_content_card">
                                <div class="card_image">
                                    <img src="{{ asset('frontpanel/assets/images/Rectangle 170 (3).png') }}"
                                        alt="">
                                </div>
                                <div class="first_txt">
                                    <p>Completed projects Completed of
                                        projects overview </p>
                                </div>
                                <div class="second_txt">
                                    <p>Lorem ipsum dolor sit amet consectetur. Vitae amet ultricies in sed nibh ipsum vitae.
                                        Egestas donec.</p>
                                </div>
                                <button class="read_more">
                                    <a href="#">
                                        <p>READ MORE</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                                        </svg>
                                    </a>
                                </button>
                            </div>
                            <div class="swiper_content_card">
                                <div class="card_image">
                                    <img src="{{ asset('frontpanel/assets/images/Rectangle 170 (3).png') }}"
                                        alt="">
                                </div>
                                <div class="first_txt">
                                    <p>Completed projects Completed of
                                        projects overview </p>
                                </div>
                                <div class="second_txt">
                                    <p>Lorem ipsum dolor sit amet consectetur. Vitae amet ultricies in sed nibh ipsum vitae.
                                        Egestas donec.</p>
                                </div>
                                <button class="read_more">
                                    <a href="#">
                                        <p>READ MORE</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                                        </svg>
                                    </a>
                                </button>
                            </div>

                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="swiper_content_card_wrapper">
                            <div class="swiper_content_card">
                                <div class="card_image">
                                    <img src="{{ asset('frontpanel/assets/images/Rectangle 170 (3).png') }}"
                                        alt="">
                                </div>
                                <div class="first_txt">
                                    <p>Completed projects Completed of
                                        projects overview </p>
                                </div>
                                <div class="second_txt">
                                    <p>Lorem ipsum dolor sit amet consectetur. Vitae amet ultricies in sed nibh ipsum vitae.
                                        Egestas donec.</p>
                                </div>
                                <button class="read_more">
                                    <a href="#">
                                        <p>READ MORE</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                                        </svg>
                                    </a>
                                </button>
                            </div>
                            <div class="swiper_content_card">
                                <div class="card_image">
                                    <img src="{{ asset('frontpanel/assets/images/Rectangle 170 (3).png') }}"
                                        alt="">
                                </div>
                                <div class="first_txt">
                                    <p>Completed projects Completed of
                                        projects overview </p>
                                </div>
                                <div class="second_txt">
                                    <p>Lorem ipsum dolor sit amet consectetur. Vitae amet ultricies in sed nibh ipsum vitae.
                                        Egestas donec.</p>
                                </div>
                                <button class="read_more">
                                    <a href="#">
                                        <p>READ MORE</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                                        </svg>
                                    </a>
                                </button>
                            </div>
                            <div class="swiper_content_card">
                                <div class="card_image">
                                    <img src="{{ asset('frontpanel/assets/images/Rectangle 170 (3).png') }}"
                                        alt="">
                                </div>
                                <div class="first_txt">
                                    <p>Completed projects Completed of
                                        projects overview </p>
                                </div>
                                <div class="second_txt">
                                    <p>Lorem ipsum dolor sit amet consectetur. Vitae amet ultricies in sed nibh ipsum vitae.
                                        Egestas donec.</p>
                                </div>
                                <button class="read_more">
                                    <a href="#">
                                        <p>READ MORE</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                                        </svg>
                                    </a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <script>
        var swiper = new Swiper(".mySwiper", {
            navigation: {
                nextEl: ".swiper-next",
                prevEl: ".swiper-prev",
            },
        });
    </script>

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
                        <P>Lorem ipsum dolor sit amet consectetur. Adipiscing aliquet sed imperdiet metus ultrices. Vel
                            etiam ipsum felis.</P>
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
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                                                <path
                                                    d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                                            </svg>
                                        </div>
                                        <div class="event_time">
                                            <p>2:30 pm to 4:30 pm
                                            <p>
                                        </div>
                                    </div>
                                    <div class="event_location">
                                        <div class="event_img">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
                                                <path
                                                    d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
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
                                <a href="#">
                                    <p>Join Now <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-arrow-up-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0z" />
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
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                                                <path
                                                    d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                                            </svg>
                                        </div>
                                        <div class="event_time">
                                            <p>2:30 pm to 4:30 pm
                                            <p>
                                        </div>
                                    </div>
                                    <div class="event_location">
                                        <div class="event_img">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
                                                <path
                                                    d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
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
                                <a href="#">
                                    <p>Join Now <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-arrow-up-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0z" />
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
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                                                <path
                                                    d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                                            </svg>
                                        </div>
                                        <div class="event_time">
                                            <p>2:30 pm to 4:30 pm
                                            <p>
                                        </div>
                                    </div>
                                    <div class="event_location">
                                        <div class="event_img">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
                                                <path
                                                    d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
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
                                <a href="#">
                                    <p>Join Now <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-arrow-up-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0z" />
                                        </svg></p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="see_all_btn">
                        <a href="event">
                            <p>See All Events </p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
                            </svg>
                        </a>
                    </div>
                </div>
                <!--  image flexed for event page-->
                <div class="right_event_img">
                    <img src="{{ asset('frontpanel/assets/images/Rectangle 148 (2).png') }}" alt="">
                </div>
            </div>

        </div>
    </div>

    <section>
        <div class="historical_places_container">
            <div class="container">
                <div class="first_historical_txt">
                    <div class="first_program_txt">
                        <p>Historical Places</p>
                    </div>
                    <div class="second_program_txt">
                        <p>Our <span class="blue">Historical Places</span> Around The world </p>
                    </div>
                    <div class="third_program_txt">
                        <p>Lorem ipsum dolor sit amet consectetur. Adipiscing aliquet sed imperdiet metus ultrices. Vel
                            etiam ipsum felis.</p>
                    </div>
                </div>
                <div class="historical_places_wrapper">
                    <div class="historical_content_card">
                        <div class="card_image">
                            <img src="{{ asset('frontpanel/assets/images/Rectangle 143 (2).png') }}" alt="">
                        </div>
                        <div class="first_txt">
                            <p>Educate Empower Excel the on
                                Power of Learning!</p>
                        </div>
                        <div class="second_txt">
                            <p>Lorem ipsum dolor sit amet consectetur. Vitae amet ultricies in sed nibh ipsum vitae. Egestas
                                donec.</p>
                        </div>
                        <button class="read_more">
                            <a href="#">
                                <p>READ MORE</p>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                                </svg>
                            </a>
                        </button>
                    </div>
                    <div class="historical_content_card">
                        <div class="card_image">
                            <img src="{{ asset('frontpanel/assets/images/Rectangle 143 (2).png') }}" alt="">
                        </div>
                        <div class="first_txt">
                            <p>Educate Empower Excel the on
                                Power of Learning!</p>
                        </div>
                        <div class="second_txt">
                            <p>Lorem ipsum dolor sit amet consectetur. Vitae amet ultricies in sed nibh ipsum vitae. Egestas
                                donec.</p>
                        </div>
                        <button class="read_more">
                            <a href="#">
                                <p>READ MORE</p>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                                </svg>
                            </a>
                        </button>
                    </div>
                    <div class="historical_content_card">
                        <div class="card_image">
                            <img src="{{ asset('frontpanel/assets/images/Rectangle 143 (2).png') }}" alt="">
                        </div>
                        <div class="first_txt">
                            <p>Educate Empower Excel the on
                                Power of Learning!</p>
                        </div>
                        <div class="second_txt">
                            <p>Lorem ipsum dolor sit amet consectetur. Vitae amet ultricies in sed nibh ipsum vitae. Egestas
                                donec.</p>
                        </div>
                        <button class="read_more">
                            <a href="#">
                                <p>READ MORE</p>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                                </svg>
                            </a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

@endsection
