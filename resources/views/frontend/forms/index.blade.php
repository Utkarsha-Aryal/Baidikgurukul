@extends('frontend.layouts.main')
@section('title', 'Our Population Entry Form')

<link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>

<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'>
</script>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'>
</script>

<link rel="stylesheet" href="styles.css">
<script src="script.js"></script>
<style>
    h2 {
        color: #2F8D46;
    }

    #form {
        text-align: center;
        position: relative;
        margin-top: 20px
    }

    #form fieldset {
        background: white;
        border: 0 none;
        border-radius: 0.5rem;
        box-sizing: border-box;
        width: 100%;
        margin: 0;
        padding-bottom: 20px;
        position: relative
    }

    .finish {
        text-align: center
    }

    #form fieldset:not(:first-of-type) {
        display: none
    }

    #form .previous-step,
    .next-step {
        width: 100px;
        font-weight: bold;
        color: white;
        border: 0 none;
        border-radius: 0px;
        cursor: pointer;
        padding: 10px 5px;
        margin: 10px 5px 10px 0px;
        float: right
    }

    .form,
    .previous-step {
        background: #616161;
    }

    .form,
    .next-step {
        background: #2F8D46;
    }

    #form .previous-step:hover,
    #form .previous-step:focus {
        background-color: #000000
    }

    #form .next-step:hover,
    #form .next-step:focus {
        background-color: #2F8D46
    }

    .text {
        font-weight: normal
    }

    #progressbar {
        margin-bottom: 30px;
        overflow: hidden;
        color: lightgrey;
        display: flex;
        justify-content: center;

    }

    @media only screen and (max-width:768) {
        #progressbar {
            flex-direction: column;
        }
    }

    @media only screen and (max-width:992) {
        #progressbar {
            width: 100%;
        }
    }

    #progressbar .active {
        color: #000000;
        display: flex;
        flex-direction: column-reverse;
        gap: 20px;

    }

    @media only screen and (max-width:768) {
        #progressbar.active {
            width: 90%;
        }
    }

    #progressbar li {
        list-style-type: none;
        font-size: 15px;
        width: 25%;
        float: left;
        position: relative;
        font-weight: 400;
        display: flex;
        flex-direction: column-reverse;
        gap: 20px;
    }



    #progressbar #step1:before {
        content: "1"
    }

    #progressbar #step2:before {
        content: "2"
    }

    #progressbar #step3:before {
        content: "3"
    }

    #progressbar #step4:before {
        content: "4"
    }

    #progressbar li:before {
        width: 50px;
        height: 50px;
        line-height: 45px;
        display: block;
        font-size: 20px;
        color: #ffffff;
        background: lightgray;
        border-radius: 50%;
        margin: 0 auto 10px auto;
        padding: 2px;
    }

    #progressbar li:after {
        content: '';
        width: 100%;
        height: 2px;
        background: lightgray;
        position: absolute;
        left: 0;
        top: 60px;
        z-index: -1
    }

    #progressbar li.active:before,
    #progressbar li.active:after {
        background: rgba(6, 106, 200, 1);
    }

    .progress {
        height: 20px;
    }

    .progress-bar {
        background-color: rgba(217, 217, 217, 1);
    }

    .personal_info_container {
        background-color: rgba(239, 247, 255, 1);
        padding: 30px 30px;
        border-radius: 4px;
    }
    @media only screen and (max-width:768) {
        .personal_info_container {
            padding: 10px;
        }
    }

    .personal_txt_svg {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-block: 15px;
    }

    .personal_txt_svg p {
        margin: 0;
        font-size: 24px;
        font-weight: 500;
    }

    .form_wrapper {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .form_left {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
        width: 60%;

    }

    .form_right {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
        width: 40%;

    }

    input {
        padding: 15px;
        outline: none;
        border: none;
        border-radius: 4px;
        width: 100%;
        font-size: 14px;
        font-weight: 400;
    }

    @media only screen and (max-width:768) {
        input {
            padding: 8px !important;
        }
    }

    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    label {
        width: 100%;
    }

    fieldset {
        display: flex;
        justify-content: center;
    }

    .form_submit_container {
        width: 75%;
        display: flex;
        flex-direction: column;
    }

    @media only screen and (max-width:768) {
        .form_submit_container {
            width: 100% !important;
        }
    }

    .submit_btn {
        background: rgba(6, 106, 200, 1) !important;
        border-radius: 4px;
        border: none;
        padding: 12px 8px;
        margin-block: 20px;
        width: 20%;
    }

    .submit_btn p {
        font-size: 14px;
        font-weight: 500;
        color: white;
        margin: 0;
    }

    .permanent_ad_txt {
        p {
            text-align: start !important;
            font-size: 18px;
            font-weight: 500;
        }
    }

    .form_wrapper_wrap {
        display: flex;
        justify-content: space-between;
    }

    .form_left_wrap {
        width: 58%;
        position: relative;

        label {
            width: 100%;

        }

        input {
            width: 100%;
        }

    }

    .form_right_wrap {
        width: 40%;
        position: relative;

        label {
            width: 100%;
        }

        input {
            width: 100%;
        }

    }

    .ward_tole_wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 90%;
        margin-block: 20px;

    }

    .form_ward_wrap {
        width: 53%;
        position: relative;

    }

    .form_tole_wrap {
        width: 45%;
        position: relative;

    }

    .temp_ad_txt {
        p {
            text-align: start !important;
            font-size: 18px;
            font-weight: 500;
        }

    }

    .bi-card-text {
        color: rgba(6, 106, 200, 1);
        height: 15px;
        width: 15px;

    }

    .bi-chevron-down {
        position: absolute;
        right: 13px;
        top: 13px;
    }
</style>
@section('content')
<section class="introduction_page">
    <div class="img_before">
        <img src="{{ asset('frontpanel/assets/images/Mask group.png') }}" alt="">
    </div>
    <div class="common_image_txt">
        <div class="common_bg_wrapper">
            <img src="{{ asset('frontpanel/assets/images/image1.jpeg') }}" alt="">
        </div>
        <div class="main_txt">
            <p>Our Population Entry Form</p>
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
                <form id="form">
                    <ul id="progressbar">
                        <li class="active" id="step1">
                            <strong>Personal Details</strong>
                        </li>
                        <li id="step2"><strong>Contact & Address</strong></li>
                        <li id="step3"><strong>Academic & Occupation</strong></li>
                    </ul>
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div> <br>
                    <fieldset>
                        <div class="form_submit_container">
                            <div class="personal_info_container">
                                <div class="personal_txt_svg">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-text" viewBox="0 0 16 16">
                                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z" />
                                        <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8m0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5" />
                                    </svg>
                                    <p>Personal Details</p>
                                </div>
                                <div class="form_wrapper">
                                    <div class="form_left">
                                        <label for="name">
                                            <input type="text" placeholder="First Name" name="name">
                                        </label>
                                        <label for="Gname">
                                            <input type="text" placeholder="Grand Father Name" name="Gname">
                                        </label>
                                        <label for="Fname">
                                            <input type="text" placeholder="Father Name" name="Fname">
                                        </label>
                                        <label for="email">
                                            <input type="email" placeholder="Email" name="email">
                                        </label>
                                    </div>
                                    <div class="form_right">
                                        <label for="dob">
                                            <input type="number" placeholder="DOB" name="dob">
                                        </label>
                                        <label for="Gdob">
                                            <input type="number" placeholder="Grand Father DOB" name="Gdob">
                                        </label>
                                        <label for="Fdob">
                                            <input type="number" placeholder="Father DOB" name="Fdob">
                                        </label>
                                        <label for="contact">
                                            <input type="number" placeholder="Contact" name="contact">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button class="submit_btn">
                                <p>SUBMIT</p>
                            </button>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form_submit_container">
                            <div class="personal_info_container">
                                <div class="personal_txt_svg">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-text" viewBox="0 0 16 16">
                                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z" />
                                        <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8m0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5" />
                                    </svg>
                                    <p>Contact & Address</p>
                                </div>
                                <div class="permanent_ad_txt">
                                    <p>Permanent Address</p>

                                </div>
                                <div class="form_wrapper_wrap">
                                    <div class="form_left_wrap">
                                        <label for="Province">
                                            <input type="text" placeholder="Province" name="Province">
                                        </label>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                                        </svg>
                                    </div>
                                    <div class="form_right_wrap">
                                        <label for="Municipality">
                                            <input type="number" placeholder="Municipality" name="Municipality">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                                            </svg>
                                        </label>

                                    </div>
                                </div>
                                <div class="ward_tole_wrapper">
                                    <div class="form_ward_wrap">
                                        <label for="Ward">
                                            <input type="text" placeholder="Ward" name="Ward">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                                            </svg>
                                        </label>
                                    </div>
                                    <div class="form_tole_wrap">
                                        <label for="Tole">
                                            <input type="text" placeholder="Tole" name="Tole">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                                            </svg>
                                        </label>
                                    </div>
                                </div>
                                <div class="temp_ad_txt">
                                    <p>Temporary Address</p>
                                </div>
                                <div class="form_wrapper_wrap">
                                    <div class="form_left_wrap">
                                        <label for="Country">
                                            <input type="text" placeholder="Country" name="Country">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                                            </svg>
                                        </label>
                                    </div>
                                    <div class="form_right_wrap">
                                        <label for="City">
                                            <input type="text" placeholder="City" name="City">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                                            </svg>
                                        </label>
                                    </div>
                                </div>
                                <div class="ward_tole_wrapper">
                                    <div class="form_ward_wrap">
                                        <label for="Tole/Area">
                                            <input type="text" placeholder="Tole/Area" name="Tole/Area">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                                            </svg>
                                        </label>
                                    </div>
                                    <div class="form_tole_wrap">
                                        <label for="Postal Code">
                                            <input type="number" placeholder="Postal Code" name="Postal Code">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                                            </svg>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button class="submit_btn">
                                <p>SUBMIT</p>
                            </button>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form_submit_container">
                            <div class="personal_info_container">
                                <div class="personal_txt_svg">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-text" viewBox="0 0 16 16">
                                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z" />
                                        <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8m0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5" />
                                    </svg>
                                    <p>Academic & Occupation</p>
                                </div>
                                <div class="permanent_ad_txt">
                                    <p>Academic</p>

                                </div>
                                <div class="form_wrapper_wrap">
                                    <div class="form_left_wrap">
                                        <label for="Qualification">
                                            <input type="text" placeholder="Qualification" name="Qualification">
                                        </label>

                                    </div>
                                    <div class="form_right_wrap">
                                        <label for="Institution">
                                            <input type="text" placeholder="Institution" name="Institution">
                                        </label>
                                    </div>
                                </div>
                                <div class="ward_tole_wrapper">
                                    <div class="form_ward_wrap">
                                        <label for="Country">
                                            <input type="text" placeholder="Country" name="Country">
                                        </label>
                                    </div>
                                </div>
                                <div class="temp_ad_txt">
                                    <p>Occupation</p>
                                </div>
                                <div class="form_wrapper_wrap">
                                    <div class="form_left_wrap">
                                        <label for="Post">
                                            <input type="text" placeholder="Post" name="Post">
                                        </label>
                                    </div>
                                    <div class="form_right_wrap">
                                        <label for="Company/Institution">
                                            <input type="text" placeholder="Company/Institution" name="Company/Institution">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                                            </svg>
                                        </label>
                                    </div>
                                </div>
                                <div class="ward_tole_wrapper">
                                    <div class="form_ward_wrap">
                                        <label for="Country">
                                            <input type="text" placeholder="Country" name="Country">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                                            </svg>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button class="submit_btn">
                                <p>SUBMIT</p>
                            </button>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="finish">
                            <h2 class="text text-center">
                                <strong>FINISHED</strong>
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
</script>



@endsection