@extends('frontend.layout2.main2')
@section('title', 'Faq')
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
                <p>बारम्बार सोधिने प्रश्नहरू</p>
            </div>
        </div>
        <div class="img_after">
            <img src="{{ asset('frontpanel/assets/images/Mask group.png') }}" alt="">
        </div>
    </section>
    <div class="faq2_section">
        <div class="container">
            <div class="left_container">
                <div class="left_faq_container">
                    @if (!@empty($faqs) && count($faqs) > 0)
                        @foreach ($faqs as $faq)
                            <div class="faq_accordion">
                                <div class="question">
                                    <P>{{ $faq->question ?? '' }}</p>
                                    <div class="icon_container">
                                        <i class="icon bi bi-chevron-down"><svg xmlns="http://www.w3.org/2000/svg"
                                                width="16" height="16" fill="currentColor"
                                                class="icon  bi bi-chevron-down" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                                            </svg>
                                        </i>
                                    </div>
                                </div>
                                <div class="answer">
                                    <p>{{ $faq->answer }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>No FAQ available</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const accordions = document.querySelectorAll('.faq_accordion');
            accordions.forEach(faq_accordion => {
                const question = faq_accordion.querySelector('.question'); // Target the question element
                const icon = faq_accordion.querySelector('.icon');
                const answer = faq_accordion.querySelector('.answer');
                const icon_container = faq_accordion.querySelector('.icon_container');
                faq_accordion.addEventListener('click', () => {
                    // Check if the clicked accordion's answer is already visible
                    const isActive = answer.classList.contains('active');
                    // If it is active, remove the active class to hide the answer and icon
                    if (isActive) {
                        answer.classList.remove('active');
                        icon.classList.remove('active');
                        icon_container.classList.remove('active');
                        question.classList.remove('active'); // Remove active class from question
                    } else {
                        // Remove active class from other accordions
                        accordions.forEach(item => {
                            item.querySelector('.answer')?.classList.remove('active');
                            item.querySelector('.icon')?.classList.remove('active');
                            item.querySelector('.icon_container')?.classList.remove(
                                'active');
                            item.querySelector('.question')?.classList.remove('active');
                        });
                        // Add active class to clicked accordion
                        answer.classList.add('active');
                        icon.classList.add('active');
                        icon_container.classList.add('active');
                        question.classList.add('active'); // Add active class to question
                    }
                });
            });
        });
    </script>
@endsection
