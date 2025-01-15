@extends('frontend.layouts.main')
@section('title', 'Our Donar List')
@section('content')
<section class="introduction_page">
    <div class="img_before">
        <img src="frontend\images\Mask group.png" alt="mask_group">
    </div>
    <div class="common_image_txt">
        <div class="common_bg_wrapper">
            <img src="frontend\images\image1.jpeg" alt="hands">
        </div>
        <div class="main_txt">
            <p>Our Donar List</p>
        </div>
    </div>
    <div class="img_after">
        <img src="frontend\images\Mask group.png" alt="mask_group">
    </div>
</section>

<div class="container">
    <div class="donation_list_container">
        <table>
            <tr>
                <th>S.N</th>
                <th>Donar Name</th>
                <th>Amount</th>
                <th>Donation Title</th>
            </tr>


            <tr>
                <td>1</td>
                <td>
                    <div class="image_txt_wrapper">
                        <div class="img_container">
                            <img src="frontend\images\Rectangle 172.png" alt="">
                        </div>
                        <p>Hikmat Gharti Magar</p>
                    </div>
                </td>
                <td>Rs. 1,20,000.00</td>
                <td>Smiriti Akshaya Kosh Campaign</td>
            </tr>
            <tr>
                <td>2</td>
                <td>
                    <div class="image_txt_wrapper">
                        <div class="img_container">
                            <img src="frontend\images\Rectangle 172.png" alt="">
                        </div>
                        <p>Hikmat Gharti Magar</p>
                    </div>
                </td>
                <td>Rs. 1,20,000.00</td>
                <td>Smiriti Akshaya Kosh Campaign</td>
            </tr>
            <tr>
                <td>3</td>
                <td>
                    <div class="image_txt_wrapper">
                        <div class="img_container">
                            <img src="frontend\images\Rectangle 172.png" alt="">
                        </div>
                        <p>Hikmat Gharti Magar</p>
                    </div>
                </td>
                <td>Rs. 1,20,000.00</td>
                <td>Smiriti Akshaya Kosh Campaign</td>
            </tr>
            <tr>
                <td>2</td>
                <td>
                    <div class="image_txt_wrapper">
                        <div class="img_container">
                            <img src="frontend\images\Rectangle 172.png" alt="">
                        </div>
                        <p>Hikmat Gharti Magar</p>
                    </div>
                </td>
                <td>Rs. 1,20,000.00</td>
                <td>Smiriti Akshaya Kosh Campaign</td>
            </tr>
            <tr>
                <td>2</td>
                <td>
                    <div class="image_txt_wrapper">
                        <div class="img_container">
                            <img src="frontend\images\Rectangle 172.png" alt="">
                        </div>
                        <p>Hikmat Gharti Magar</p>
                    </div>
                </td>
                <td>Rs. 1,20,000.00</td>
                <td>Smiriti Akshaya Kosh Campaign</td>
            </tr>
            <tr>
                <td>3</td>
                <td>
                    <div class="image_txt_wrapper">
                        <div class="img_container">
                            <img src="frontend\images\Rectangle 172.png" alt="">
                        </div>
                        <p>Hikmat Gharti Magar</p>
                    </div>
                </td>
                <td>Rs. 1,20,000.00</td>
                <td>Smiriti Akshaya Kosh Campaign</td>
            </tr>
        </table>

    </div>
</div>
@endsection