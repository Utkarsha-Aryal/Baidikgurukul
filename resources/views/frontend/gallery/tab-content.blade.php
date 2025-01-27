@if (!@empty($galleries) && count($galleries) > 0)
    @php $hasVideos = false; @endphp
    @foreach ($galleries as $gallery)
        <div class="gallery-r1"> <a href="{{ route('image.inner', $gallery->slug) }}">

                <div class="g1-img">
                    @if (!empty($gallery->image) && Storage::exists('public/gallery-image/' . $gallery->image))
                        <img src="{{ asset('storage/gallery-image/' . $gallery->image) }}" alt="">
                    @else
                        <img src="{{ asset('frontpanel/assets/images/Rectangle 170 (3).png') }}" alt="">
                    @endif
                </div>
            </a>
            <div class="gallery-g1-title">
                <p>{{ $gallery->name ?? '' }}</p>
            </div>
            <div class="gallery-g1-txt">
                <p>{{ count($gallery->images) }} Photos</p>
            </div>
        </div>
    @endforeach
    @if (!$hasVideos)
        <p>No video</p>
    @endif
@else
    <p>No Image Avaialble</p>
@endif
