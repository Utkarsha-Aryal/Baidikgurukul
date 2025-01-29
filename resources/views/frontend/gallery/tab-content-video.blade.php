@if ($galleries->isNotEmpty() && count($galleries) > 0)
    @php $hasVideos = false; @endphp <div class="gallery-content-main">
        @foreach ($galleries as $gallery)
            @if (count($gallery->videos) > 0)
                @php $hasVideos = true; @endphp
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
                        <p>{{ count($gallery->videos) }} Videos </p>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    <div style="margin-top: 2rem;">
        {{ $galleries->links('pagination::bootstrap-4') }}
    </div>
    @if (!$hasVideos)
    @endif
@else
    <p>No video available</p>
@endif
