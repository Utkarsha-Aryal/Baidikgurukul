@if (!empty($teammember))
<div id="content1" class="content-item">
    <div class="container_content_wrapper">
            @foreach ($teammember as $index => $member)
                <div class="image_container_wrap">
                    <div class="img_hover_bg">
                        <h3>{{ $member->name ?? '' }}</h3>
                        <p>{{ $member->designation ?? '' }}</p>
                    </div>
                    <div class="img_default_bg">
                        <h3>{{ $member->name ?? '' }}</h3>
                        <p>{{ $member->designation ?? '' }}</p>
                    </div>
                    <div class="img_wrap">
                        <a href="{{ route('teaminner', $member->slug) }}">
                            @if (!empty($member->photo) && Storage::exists('public/community/' . $member->photo))
                                <img src="{{ asset('storage/community/' . $member->photo) }}"
                                    alt="">
                            @else
                                <img src="{{ asset('frontpanel/assets/images/curved.jpeg') }}"
                                    alt="">
                            @endif
                        </a>
                    </div>
                </div>
                @endforeach
        </div>
    </div>
@else
<p>No Member Found</p>
@endif