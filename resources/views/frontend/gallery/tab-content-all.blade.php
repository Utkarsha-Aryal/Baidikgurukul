@if ($galleries->isNotEmpty())

    <div class="gallery-content-main">
        @foreach ($galleries as $gallery)
            @if (count($gallery->videos) > 0)
                <div class="gallery-r1">
                    <a href="{{ route('ginner', $gallery->slug) }}">
                        <div class="g1-img">
                            <img src="{{ asset('storage/community/' . ($galleryVideoImages[$gallery->id] ?? 'default_image.jpg')) }}"
                                alt="">
                        </div>
                    </a>
                    <div class="gallery-g1-title">
                        <p>{{ $gallery->name ?? '' }}</p>
                    </div>
                    <div class="gallery-g1-txt">
                        <p>{{ count($gallery->videos) }} Videos</p>
                    </div>
                </div>
            @endif

            @if (count($gallery->images) > 0)
                <div class="gallery-r1">
                    <a href="{{ route('image.inner', $gallery->slug) }}">
                        <div class="g1-img">
                            <img src="{{ asset('storage/gallery-image/' . ($gallery->image ?? 'default_image.jpg')) }}"
                                alt="">
                        </div>
                        <div class="gallery-g1-title">
                            <p>{{ $gallery->name ?? '' }}</p>
                        </div>
                        <div class="gallery-g1-txt">
                            <p>{{ count($gallery->images) }} Photos</p>
                        </div>
                    </a>
                </div>
            @endif
        @endforeach
    </div>
@else
    <p>No video and image available</p>
@endif
