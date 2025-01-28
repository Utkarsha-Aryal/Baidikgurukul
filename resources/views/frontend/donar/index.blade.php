@extends('frontend.layout2.main2')
@section('title', 'दाताहरूको सूची')
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
            <p>दाताहरूको सूची</p>
        </div>
    </div>
    <div class="img_after">
        <img src="{{ asset('frontpanel/assets/images/Mask group.png') }}" alt="">
    </div>
</section>

<div class="container">
    <div class="donation_list_container">
        @if (!empty($doners) && count($doners) > 0)
        <table>
            <tr>
                <th>क्रम संख्या</th>
                <th>नाम</th>
                <th>रकम/वस्तु</th>
                <th>दान शीर्षक</th>
            </tr>
            @foreach ($doners as $index => $doner)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    <div class="image_txt_wrapper">
                        <div class="img_container">
                            @if (!empty($doner->image) && Storage::exists('public/donor/' . $doner->image))
                            <img src="{{ asset('storage/donor/' . $doner->image) }}" alt="">
                            @else
                            <img src="frontend\images\Rectangle 172.png" alt="">
                            @endif
                        </div>
                        <p>{{ $doner->name ?? '' }}</p>
                    </div>
                </td>
                <td>{{ $doner->amount }}</td>
                <td>{{ $doner->title }}</td>
            </tr>
            @endforeach
        </table>
        <div style="margin-top: 2rem;">
            {{ $doners->links('pagination::bootstrap-4') }}
        </div>
        @else
        <p>No data found</p>
        @endif
    </div>
</div>
@endsection