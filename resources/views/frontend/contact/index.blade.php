@extends('frontend.layouts.main')
@section('title', 'Contact')
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
            <p>Contact</p>
        </div>
    </div>
    <div class="img_after">
        <img src="frontend\images\Mask group.png" alt="mask_group">
    </div>
</section>

<div class="contact-container-main">
    <div class="container">
        <div class="contact-content">
            <div class="contact-content-lt">
                <div class="contact-lt-header">
                    <p>Have a question ? Let’s get in touch with us.</p>
                </div>
                <div class="contact-lt-txt">
                    <p>Fill up the Form and our team will get back to within 24 hrs</p>
                </div>
                <div class="contact-lt-form">
                    <input type="text" id="fname" placeholder="First Name">
                    <input type="text" id="lmail" placeholder="Last Name">
                    <input type="email" id="mail" placeholder="Email Address">
                    <input type="text" id="msg" placeholder="Type message">
                </div>
                <div class="submit-btn">
                    <button onclick="alert('On Progress')">
                        <p>SUBMIT</p>
                    </button>
                </div>
            </div>
            <div class="contact-content-rt">
                <div class="contact-rt-wrapper">
                    <div class="contact-rt">
                        <div class="contact-rt1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                                <path
                                    d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
                            </svg>
                            <p>Location</p>
                        </div>
                        <div class="rt-desc">
                            <p>DLF Cybercity, Bhubaneswar,<br> India, &52050</p>
                        </div>
                    </div>
                    <div class="contact-rt">
                        <div class="contact-rt1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                <path
                                    d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z" />
                            </svg>
                            <p>Contact Us</p>
                        </div>
                        <div class="rt-desc">
                            <p>020 7993 2905 <br>hi@finsweet.com</p>
                        </div>
                    </div>
                </div>
                <iframe class="contact-iframe"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3533.098326374331!2d85.32828877456592!3d27.68335572655079!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19acf9643d87%3A0x9a28e549b2e189b3!2sCode%20Logic%20Technologies%20Pvt.Ltd.!5e0!3m2!1sen!2snp!4v1734942902938!5m2!1sen!2snp"></iframe>
            </div>
        </div>
    </div>
</div>

@endsection