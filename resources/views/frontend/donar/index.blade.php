@extends('frontend.layout2.main2')
@section('title', 'Our Donar List')
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
                <p>Our Donar List</p>
            </div>
        </div>
        <div class="img_after">
            <img src="{{ asset('frontpanel/assets/images/Mask group.png') }}" alt="">
        </div>
    </section>

    <div class="container">
        <div class="donation_list_container">
            <table>
                <tr>
                    <th>S.N</th>
                    <th>Donar Name</th>
                    <th>Amount/Item</th>
                    <th>Donation Title</th>
                </tr>
                @if (!empty($doners))
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
                            <td>Rs. {{ $doner->amount }}</td>
                            <td>{{ $doner->title }}</td>
                        </tr>
                    @endforeach
                @endif

            </table>
        </div>
    </div>
@endsection
