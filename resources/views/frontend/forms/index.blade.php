@extends('frontend.layout2.main2')
@section('title', 'Our Population Entry Form')

<link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>

<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

<link rel="stylesheet" href="styles.css">
<script src="script.js"></script>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

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
                <p>हाम्रो जनसंख्या प्रविष्टि फारम</p>
            </div>
        </div>
        <div class="img_after">
            <img src="{{ asset('frontpanel/assets/images/Mask group.png') }}" alt="">
        </div>
    </section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-11 col-sm-9 col-md-7  
                col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2">
                <div class="px-0 pt-4 pb-0 mt-3 mb-3">
                    <form id="form" class="personal-details">
                        <ul id="progressbar">
                            <li class="active" id="step1">
                                <strong>व्यक्तिगत विवरणहरू</strong>
                            </li>
                            <li id="step2"><strong> सम्पर्क र ठेगाना</strong></li>
                            <li id="step3"><strong>शैक्षिक र पेशा</strong></li>
                        </ul>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div> <br>
                        <fieldset>
                            <div class="form_submit_container">
                                <div class="personal_info_container">
                                    <div class="personal_txt_svg">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-card-text" viewBox="0 0 16 16">
                                            <path
                                                d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z" />
                                            <path
                                                d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8m0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5" />
                                        </svg>
                                        <p>व्यक्तिगत विवरणहरू</p>
                                    </div>
                                    <div class="form_wrapper">
                                        <div class="form_left">
                                            <label for="name">
                                                <input type="text" placeholder="पहिलो नाम" * name="name">
                                            </label>
                                            <label for="Gname">
                                                <input type="text" placeholder="हजुरबुबाको नाम *" name="Gname">
                                            </label>
                                            <label for="Fname">
                                                <input type="text" placeholder="बुबाको नाम *" name="Fname">
                                            </label>
                                            <label for="email">
                                                <input type="email" placeholder="इमेल *" name="email">
                                            </label>
                                        </div>
                                        <div class="form_right">
                                            <label for="dob">
                                                <input type="number" placeholder="जन्म मिति *" name="dob">
                                            </label>
                                            <label for="Gdob">
                                                <input type="number" placeholder="हजुरबुबाको जन्म मिति *" name="Gdob">
                                            </label>
                                            <label for="Fdob">
                                                <input type="number" placeholder="बुबाको जन्म मिति" name="Fdob">
                                            </label>
                                            <label for="contact">
                                                <input type="number" placeholder="सम्पर्क नम्बर *" name="contact">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <button class="submit_btn">
                                    <p>पेश गर्नुहोस्</p>
                                </button>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form_submit_container">
                                <div class="personal_info_container">
                                    <div class="personal_txt_svg">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-card-text" viewBox="0 0 16 16">
                                            <path
                                                d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z" />
                                            <path
                                                d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8m0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5" />
                                        </svg>
                                        <p>सम्पर्क र ठेगाना</p>
                                    </div>
                                    <div class="permanent_ad_txt">
                                        <p>स्थायी ठेगाना</p>

                                    </div>
                                    <div class="form_wrapper_wrap">
                                        <div class="form_left_wrap">
                                            <label for="Province">
                                                <input type="text" placeholder="प्रान्त *" name="Province">
                                            </label>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="form_icon bi bi-chevron-down"
                                                viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                                            </svg>
                                        </div>
                                        <div class="form_right_wrap">
                                            <label for="Municipality">
                                                <input type="number" placeholder="नगरपालिका *" name="Municipality">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="form_icon bi bi-chevron-down"
                                                    viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                                                </svg>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="form_icon bi bi-chevron-down"
                                                    viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                                                </svg>
                                            </label>

                                        </div>
                                    </div>
                                    <div class="ward_tole_wrapper">
                                        <div class="form_ward_wrap">
                                            <label for="Ward">
                                                <input type="text" placeholder="वार्ड *" name="Ward">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="form_icon bi bi-chevron-down"
                                                    viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                                                </svg>
                                            </label>
                                        </div>
                                        <div class="form_tole_wrap">
                                            <label for="Tole">
                                                <input type="text" placeholder="टोल *" name="Tole">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="form_icon bi bi-chevron-down"
                                                    viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                                                </svg>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="temp_ad_txt">
                                        <p>अस्थायी ठेगाना</p>
                                    </div>
                                    <div class="form_wrapper_wrap">
                                        <div class="form_left_wrap">
                                            <label for="Country">
                                                <input type="text" placeholder="देश *" name="Country">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="form_icon bi bi-chevron-down"
                                                    viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                                                </svg>
                                            </label>
                                        </div>
                                        <div class="form_right_wrap">
                                            <label for="City">
                                                <input type="text" placeholder="सहर *" name="City">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="form_icon bi bi-chevron-down"
                                                    viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                                                </svg>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="ward_tole_wrapper">
                                        <div class="form_ward_wrap">
                                            <label for="Tole/Area">
                                                <input type="text" placeholder="टोल/क्षेत्र *" name="Tole/Area">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="form_icon bi bi-chevron-down"
                                                    viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                                                </svg>
                                            </label>
                                        </div>
                                        <div class="form_tole_wrap">
                                            <label for="Postal Code">
                                                <input type="number" placeholder="हुलाक कोड *" name="Postal Code">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="form_icon bi bi-chevron-down"
                                                    viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                                                </svg>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <button class="submit_btn">
                                    <p>पेश गर्नुहोस्</p>
                                </button>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form_submit_container">
                                <div class="personal_info_container">
                                    <div class="personal_txt_svg">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-card-text" viewBox="0 0 16 16">
                                            <path
                                                d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z" />
                                            <path
                                                d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8m0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5" />
                                        </svg>
                                        <p>शैक्षिक र पेशा</p>
                                    </div>
                                    <div class="permanent_ad_txt">
                                        <p>शैक्षिक</p>

                                    </div>
                                    <div class="form_wrapper_wrap">
                                        <div class="form_left_wrap">
                                            <label for="Qualification">
                                                <input type="text" placeholder="योग्यता *" name="Qualification">
                                            </label>

                                        </div>
                                        <div class="form_right_wrap">
                                            <label for="Institution">
                                                <input type="text" placeholder="संस्था *" name="Institution">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="ward_tole_wrapper">
                                        <div class="form_ward_wrap">
                                            <label for="Country">
                                                <input type="text" placeholder="देश *" name="Country">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="temp_ad_txt">
                                        <p>पेशा</p>
                                    </div>
                                    <div class="form_wrapper_wrap">
                                        <div class="form_left_wrap">
                                            <label for="Post">
                                                <input type="text" placeholder="पोस्ट *" name="Post">
                                            </label>
                                        </div>
                                        <div class="form_right_wrap">
                                            <label for="Company/Institution">
                                                <input type="text" placeholder="कम्पनी/संस्था *"
                                                    name="Company/Institution">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="form_icon bi bi-chevron-down"
                                                    viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                                                </svg>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="ward_tole_wrapper">
                                        <div class="form_ward_wrap">
                                            <label for="Country">
                                                <input type="text" placeholder="देश *" name="Country">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="form_icon bi bi-chevron-down"
                                                    viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                                                </svg>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <button class="submit_btn">
                                    <p>पेश गर्नुहोस्</p>
                                </button>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="finish">
                                <h2 class="text text-center">
                                    <strong>समाप्त</strong>
                                </h2>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var currentStep = 1;
            var steps = $("fieldset").length;

            // Initialize the progress bar
            setProgressBar(currentStep);
            setActiveStep(currentStep);

            // Click on a step to navigate to that step
            $("#progressbar li").click(function() {
                var stepIndex = $(this).index() + 1; // Get the clicked step index (1-based)

                if (stepIndex !== currentStep) {
                    // Show the clicked step's section
                    showStep(stepIndex);
                }
            });

            // Function to show the step
            function showStep(step) {
                var currentStepElement = $("fieldset:nth-of-type(" + currentStep + ")");
                var nextStepElement = $("fieldset:nth-of-type(" + step + ")");

                // Update progress bar
                $("#progressbar li").removeClass("active");
                $("#progressbar li").eq(step - 1).addClass("active");

                // Animate the current and next step visibility
                currentStepElement.animate({
                    opacity: 0
                }, {
                    step: function(now) {
                        currentStepElement.css({
                            'display': 'none',
                            'position': 'relative'
                        });
                        nextStepElement.css({
                            'opacity': 1
                        });
                    },
                    duration: 500
                });

                // Show the new step
                nextStepElement.show();

                // Update current step and progress bar
                currentStep = step;
                setProgressBar(currentStep);
            }

            // Function to update progress bar width
            function setProgressBar(step) {
                var percent = (100 / steps) * step;
                $(".progress-bar").css("width", percent + "%");
            }

            // Function to set the active step in the progress bar
            function setActiveStep(step) {
                $("#progressbar li").removeClass("active");
                $("#progressbar li").eq(step - 1).addClass("active");
            }
        });

        $(document).ready(function() {
            $('.personal-details').validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                        minlength: 5,
                    },
                    name: {
                        required: true
                    },
                    // phone: {
                    //     required: true,
                    //     digits: true,
                    //     minlength: 10,
                    //     maxlength: 10,
                    // },
                    // message: {
                    //     required: true,
                    //     minlength: 10,
                    // }
                },
                messages: {
                    email: {
                        required: 'Please enter email.',
                        minlength: 'Email must be at least 5 characters.',
                    },
                    name: {
                        required: 'Please enter name.',
                    },
                    phone: {
                        required: 'Please enter contact.',
                        digits: "Please enter only digits.",
                        minlength: "Phone number must be exactly 10 digits.",
                        maxlength: "Phone number must be exactly 10 digits.",
                    },
                    message: {
                        required: 'Please enter Message.',
                        minlength: 'Inquiry must be at least 10 characters.',
                    }
                },
                errorElement: 'label',
                errorPlacement: function(error, element) {
                    error.addClass('error-message'); // Add the 'error-message' class to the error label
                    error.insertAfter(element); // Display error message after the input field
                }
            });

            $('.submitData').off('click');
            $('.submitData').on('click', function() {
                // Check if CAPTCHA is valid
                const captchaResponse = grecaptcha.getResponse();
                if (!captchaResponse) {
                    $('#captchaError').show(); // Show error message
                    return;
                } else {
                    $('#captchaError').hide(); // Hide error message
                }

                // Validate the form and submit via AJAX
                if ($('#contactUsForm').valid()) {
                    showLoader();

                    $('#contactUsForm').ajaxSubmit({
                        success: function(response) {
                            if (response) {
                                if (response.type === 'success') {
                                    showNotification(response.message, 'success');
                                    $('#contactUsForm')[0].reset();
                                    grecaptcha.reset(); // Reset CAPTCHA
                                    hideLoader();
                                } else {
                                    showNotification(response.message, 'error');
                                    hideLoader();
                                }
                            }
                            hideLoader();
                        },
                        error: function(xhr) {
                            hideLoader();
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
