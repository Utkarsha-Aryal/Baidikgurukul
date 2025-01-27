@extends('frontend.layout2.main2')


@section('title', 'सम्पर्क')
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
                <p>सम्पर्क गर्नुहोस</p>
            </div>
        </div>
        <div class="img_after">
            <img src="{{ asset('frontpanel/assets/images/Mask group.png') }}" alt="">
        </div>
    </section>

    <div class="contact-container-main">
        <div class="container">
            <div class="contact-content">
                <div class="contact-content-lt">
                    <div class="contact-lt-header">
                        <p>एउटा प्रश्न छ? हामीलाई सम्पर्क गरौं।</p>
                    </div>
                    <div class="contact-lt-txt">
                        <p>फारम भर्नुहोस् र हाम्रो टोलीले २४ घन्टा भित्रमा तपाईंलाई फिर्ता गर्नेछ</p>
                    </div>
                    <form action=" {{ route('enquiry.save') }}" id="contactUsForm" method="POST">
                        <div class="contact-lt-form">
                            @csrf
                            <input type="text" id="fname" name="first_name" placeholder="पहिलो नाम *">
                            <input type="text" id="lname" name="last_name" placeholder="अन्तिम नाम *">
                            <input type="email" id="mail" name="email" placeholder="इमेल *">
                            <input type="text" id="msg" name="message" placeholder="सन्देश लेख्नुहोस् *">
                        </div>
                        <div class="submit-btn">
                            <button type="submit" class="submitData">
                                <p>पेश गर्नुहोस</p>
                            </button>
                        </div>
                    </form>
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
                                <p>स्थान</p>
                            </div>
                            <div class="rt-desc">
                                @if (!empty($sitesetting->address))
                                    <p>{{ $sitesetting->address }}<br> Nepal</p>
                                @else
                                    <p>DLF Cybercity, Bhubaneswar,<br>Nepal</p>
                                @endif
                            </div>
                        </div>
                        <div class="contact-rt">
                            <div class="contact-rt1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z" />
                                </svg>
                                <p>हामीलाई सम्पर्क गर्नुहोस</p>
                            </div>
                            <div class="rt-desc">
                                @if (!empty($sitesetting->phone_number))
                                    <p>{{ $sitesetting->phone_number }}<br> {{ $sitesetting->email }}</p>
                                @else
                                    <p>020 7993 2905 <br>hi@finsweet.com</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if (!empty($sitesetting->link_map))
                        <iframe class="contact-iframe" src="{{ $siteSetting->link_map }}"></iframe>
                    @else
                        <iframe class="contact-iframe"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3533.098326374331!2d85.32828877456592!3d27.68335572655079!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19acf9643d87%3A0x9a28e549b2e189b3!2sCode%20Logic%20Technologies%20Pvt.Ltd.!5e0!3m2!1sen!2snp!4v1734942902938!5m2!1sen!2snp"></iframe>
                    @endif
                </div>
            </div>
        </div>
    </div>





    <script>
        $(document).ready(function() {

            $('#contactUsForm').validate({
                rules: {
                    first_name: {
                        required: true,
                        minlength: 2
                    },
                    last_name: {
                        required: true,
                        minlength: 2
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    message: {
                        required: true,
                        minlength: 10
                    }
                },
                messages: {
                    first_name: {
                        required: 'Please enter your first name.',
                        minlength: 'First name must be at least 2 characters long.'
                    },
                    last_name: {
                        required: 'Please enter your last name.',
                        minlength: 'Last name must be at least 2 characters long.'
                    },
                    email: {
                        required: 'Please enter your email address.',
                        email: 'Please enter a valid email address.'
                    },
                    message: {
                        required: 'Please enter a message.',
                        minlength: 'Message must be at least 10 characters long.'
                    }
                },
                errorElement: 'label',
                errorPlacement: function(error, element) {
                    error.addClass('error-message');
                    error.insertAfter(element);
                }
            });

            $('.submitData').on('click', function(e) {
                e.preventDefault(); // Prevent the default form submission

                // Check if the form is valid
                if ($('#contactUsForm').valid()) {
                    showLoader(); // Show loader during form submission

                    $('#contactUsForm').ajaxSubmit({
                        success: function(response) {
                            if (response && response.type === 'success') {
                                showNotification(response.message, 'success');
                                $('#contactUsForm')[0].reset(); // Reset the form
                            } else {
                                showNotification(response.message, 'error');
                            }
                            hideLoader(); // Hide loader
                        },
                        error: function(xhr) {
                            hideLoader(); // Hide loader on error
                            const response = xhr.responseJSON;
                            showNotification(response && response.message ? response.message :
                                'An error occurred', 'error');
                        }
                    });
                }
            });


        });
    </script>

@endsection
