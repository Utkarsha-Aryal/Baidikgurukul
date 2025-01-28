@extends('frontend.layout2.main2')
@section('title', 'नियमहरू')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
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
            <p>हाम्रा अनुष्ठानका लागि हाम्रा नियमहरू</p>
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
                    <p>अनुष्ठान को लागी हाम्रो नियम</p>
                </div>
                @if (!empty($ritules) && count($ritules) > 0)
                @foreach ($ritules as $index => $ritul)
                <div class="tab {{ $index === 0 ? 'active' : '' }}" data-slug="{{ $ritul->slug }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
                    </svg>
                    <li>{{ $ritul->title }}</li>
                </div>
                @endforeach
                @else
                <p>No Data Available</p>
                @endif
            </div>
            <!-- Content Area (Right Side) -->
            <div class="content">
                @if (!empty($rule))
                <div class="content-item" id="content1">
                    <div class="first_content_wrapper">
                        <div class="first_txt">
                            <p>{{ $rule->title }}</p>
                        </div>
                        <div class="second_txt">
                            <p>{!! $rule->details !!}</p>
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
<script>
    $(document).ready(function() {
        $('.tab').on('click', function(e) {
            e.preventDefault();

            $('.tab').removeClass('active');
            $(this).addClass('active');

            let tabSlug = $(this).data('slug');

            let url = "{{ url('/rules/gettabcontent') }}/" + tabSlug;

            $('.content').html('<p>Loading...</p>');

            $.post({
                url: url,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.html) {
                        $('.content').html(response.html);
                    } else {
                        $('.content').html('<p>No content found.</p>');
                    }
                },
                error: function() {
                    $('.content').html(
                        '<p>An error occurred while loading data. Please try again later.</p>'
                    );
                }
            });
        });
    });
</script>
@endsection