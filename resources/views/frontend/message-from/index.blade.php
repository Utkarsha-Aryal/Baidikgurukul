@extends('frontend.layout2.main2')
@section('title', 'अध्यक्षको सन्देश')

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
                <p>अध्यक्षको सन्देश</p>
            </div>
        </div>
        <div class="img_after">
            <img src="{{ asset('frontpanel/assets/images/Mask group.png') }}" alt="">
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

                        @if (!@empty($message->title))
                            @php
                                $text = $message->title ?? '';
                                $words = explode(' ', $text);
                                if (count($words) > 3) {
                                    $words[3] =
                                        '
<span style="color: rgba(6, 106, 200, 1);">' . $words[3];
                                    $words[5] .= '</span>';
                                }
                                $styledText = implode(' ', $words);
                            @endphp

                            <p>{!! $styledText !!}</p>
                        @else
                            <p>हरेक <span class="blue"> चाेचाङ्गी को सपना
                                    समाज समुदाय </span> हाम्रो अधिकार जुटाउन हो </p>
                        @endif

                    </div>
                    <div class="third_dream_txt">
                        @if (!@empty($message->message))
                            {!! $message->message !!}
                        @else
                            <p>No Data Available</p>
                        @endif
                    </div>
                </div>
                <div class="right_rights_image">
                    <div class="image_container_wrapper">
                        @if (!empty($message->image) && Storage::exists('public/message-from/' . $message->image))
                            <img src="{{ asset('storage/message-from/' . $message->image) }}" alt="">
                        @else
                            <img src="{{ asset('frontpanel/assets/images/curved.jpeg') }}" alt="">
                        @endif
                        <div class="image_designation_container">
                            <a href="#">
                                <p>{{ $message->name ?? '' }}</p>
                                <p>{{ $message->designation ?? '' }}</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- <div class="img_registration_wrap">
    <div class="lft_img">
        <img src="{{ asset('frontpanel/assets/images/ritual.png') }}" alt="">
    </div>
    <div class="rght_txt">
        <p>तपाईंको जन्म र मृत्यु प्रविष्टि गर्नुहोस
            दर्ता फारम
            अपडेट राख्नुहोस</p>
        <button class="entry_form">
            <a href="#">
                <p>अहिले प्रवेश गर्नुहोस</p>
            </a>
        </button>
    </div>
</div> --}}


@endsection
