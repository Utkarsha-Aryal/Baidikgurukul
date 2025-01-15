@extends('frontend.layouts.main')
@section('title', 'Our Historical Places')
@section('content')
    <section class="introduction_page">
        <div class="img_before">
            <img src="frontend\images\Mask group.png" alt="mask_group">
        </div>
        <div class="common_image_txt">
            <div class="common_bg_wrapper">
                <img src="{{ asset('frontpanel/assets/images/image1.jpeg') }}" alt="">
            </div>
            <div class="main_txt">
                <p>Our Historical Places</p>
            </div>
        </div>
        <div class="img_after">
            <img src="frontend\images\Mask group.png" alt="mask_group">
        </div>
    </section>
    <section class="team_tab_section">
        <div class="container">
            <div class="container_wrapper">
                <!-- Tab Navigation (Left Side) -->
                <div class="tabs">
                    <div class="first_txt">
                        <p>Our Historical Places</p>
                    </div>
                    <div class="tab active" id="tab1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
                        </svg>
                        <p>Historical Place of Nepal</p>
                    </div>
                    <div class="tab" id="tab2"> <svg xmlns="http://www.w3.org/2000/svg" width="16"
                            height="16" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
                        </svg>
                        <p>Historical Place of Nepal 1</p>
                    </div>
                    <div class="tab" id="tab3"> <svg xmlns="http://www.w3.org/2000/svg" width="16"
                            height="16" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
                        </svg>
                        <p>Historical Place of Nepal 2</p>
                    </div>
                    <div class="tab" id="tab4"> <svg xmlns="http://www.w3.org/2000/svg" width="16"
                            height="16" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
                        </svg>
                        <p>Historical Place of Nepal 3</p>
                    </div>
                </div>
                <!-- Content Area (Right Side) -->
                <div class="content">
                    <div id="content1" class="content-item">
                        <div class="first_content_wrapper">
                            <div class="first_txt">
                                <p>Rules for Rituals from Birth to Death Of Our
                                    Cho change Community</p>
                            </div>
                            <div class="second_txt">
                                <p>Lorem ipsum dolor sit amet consectetur. Sapien feugiat blandit placerat iaculis sed. Leo
                                    sed porttitor suspendisse ac faucibus venenatis. Morbi ut proin diam eget vestibulum
                                    venenatis duis tortor. Integer sapien fermentum integer tincidunt eget sapien sit vel
                                    laoreet. Amet blandit id neque turpis felis sollicitudin augue. Ut id amet venenatis
                                    quis vel egestas. Eu iaculis id id vivamus sit ac. Sodales viverra facilisi pulvinar
                                    amet a.
                                </p>
                            </div>
                            <div class="third_image_wrapper">
                                <div class="left_bigger_image">
                                    <img src="frontend\images\Rectangle 180.png" alt="image">
                                </div>
                                <div class="right_smaller_images">
                                    <div class="first_img">
                                        <img src="frontend\images\Rectangle 181.png" alt="image">
                                    </div>
                                    <div class="second_img">
                                        <img src="frontend\images\Rectangle 182.png" alt="image">
                                    </div>
                                </div>
                            </div>
                            <div class="forth_txt">
                                <p>Lorem ipsum dolor sit amet consectetur. Et aliquet sed dis in pharetra elementum. Aliquet
                                    pharetra commodo mauris diam aenean vulputate pharetra fringilla. Dolor eget nullam
                                    consequat sem erat consectetur. Consectetur integer mauris sem metus ut ac. Etiam magna
                                    nam eget metus commodo egestas non volutpat cras. Convallis varius semper tellus vitae
                                    risus in facilisis faucibus. Quis enim molestie ut arcu ac commodo tempor commodo. Metus
                                    enim nibh senectus interdum et amet gravida metus amet.</p>
                            </div>
                            <div class="fifth_txt">
                                <p>“Lorem ipsum dolor sit amet
                                    consectetur dolor sit amet
                                    gravida urna gravida ”</p>
                            </div>
                            <div class="sixth_txt">
                                <p>Lorem ipsum dolor sit amet consectetur. Et aliquet sed dis in pharetra elementum. Aliquet
                                    pharetra commodo mauris diam aenean vulputate pharetra fringilla. Dolor eget nullam
                                    consequat sem erat consectetur. Consectetur integer mauris sem metus ut ac. Etiam magna
                                    nam eget metus commodo egestas non volutpat cras. Convallis varius semper tellus vitae
                                    risus in facilisis faucibus. Quis enim molestie ut arcu ac commodo tempor commodo. Metus
                                    enim nibh senectus interdum et amet gravida metus amet.</p>
                            </div>
                        </div>
                    </div>
                    <div id="content2" class="content-item">
                        <div class="first_content_wrapper">
                            <div class="first_txt">
                                <p>Rules for Rituals from Birth to Death Of Our
                                    Cho change Community</p>
                            </div>
                            <div class="second_txt">
                                <p>Lorem ipsum dolor sit amet consectetur. Sapien feugiat blandit placerat iaculis sed. Leo
                                    sed porttitor suspendisse ac faucibus venenatis. Morbi ut proin diam eget vestibulum
                                    venenatis duis tortor. Integer sapien fermentum integer tincidunt eget sapien sit vel
                                    laoreet. Amet blandit id neque turpis felis sollicitudin augue. Ut id amet venenatis
                                    quis vel egestas. Eu iaculis id id vivamus sit ac. Sodales viverra facilisi pulvinar
                                    amet a.
                                </p>
                            </div>
                            <div class="third_image_wrapper">
                                <div class="left_bigger_image">
                                    <img src="frontend\images\Rectangle 180.png" alt="image">
                                </div>
                                <div class="right_smaller_images">
                                    <div class="first_img">
                                        <img src="frontend\images\Rectangle 181.png" alt="image">
                                    </div>
                                    <div class="second_img">
                                        <img src="frontend\images\Rectangle 182.png" alt="image">
                                    </div>
                                </div>
                            </div>
                            <div class="forth_txt">
                                <p>Lorem ipsum dolor sit amet consectetur. Et aliquet sed dis in pharetra elementum. Aliquet
                                    pharetra commodo mauris diam aenean vulputate pharetra fringilla. Dolor eget nullam
                                    consequat sem erat consectetur. Consectetur integer mauris sem metus ut ac. Etiam magna
                                    nam eget metus commodo egestas non volutpat cras. Convallis varius semper tellus vitae
                                    risus in facilisis faucibus. Quis enim molestie ut arcu ac commodo tempor commodo. Metus
                                    enim nibh senectus interdum et amet gravida metus amet.</p>
                            </div>
                            <div class="fifth_txt">
                                <p>“Lorem ipsum dolor sit amet
                                    consectetur dolor sit amet
                                    gravida urna gravida ”</p>
                            </div>
                            <div class="sixth_txt">
                                <p>Lorem ipsum dolor sit amet consectetur. Et aliquet sed dis in pharetra elementum. Aliquet
                                    pharetra commodo mauris diam aenean vulputate pharetra fringilla. Dolor eget nullam
                                    consequat sem erat consectetur. Consectetur integer mauris sem metus ut ac. Etiam magna
                                    nam eget metus commodo egestas non volutpat cras. Convallis varius semper tellus vitae
                                    risus in facilisis faucibus. Quis enim molestie ut arcu ac commodo tempor commodo. Metus
                                    enim nibh senectus interdum et amet gravida metus amet.</p>
                            </div>
                        </div>

                    </div>
                    <div id="content3" class="content-item">
                        <div class="first_content_wrapper">
                            <div class="first_txt">
                                <p>Rules for Rituals from Birth to Death Of Our
                                    Cho change Community</p>
                            </div>
                            <div class="second_txt">
                                <p>Lorem ipsum dolor sit amet consectetur. Sapien feugiat blandit placerat iaculis sed. Leo
                                    sed porttitor suspendisse ac faucibus venenatis. Morbi ut proin diam eget vestibulum
                                    venenatis duis tortor. Integer sapien fermentum integer tincidunt eget sapien sit vel
                                    laoreet. Amet blandit id neque turpis felis sollicitudin augue. Ut id amet venenatis
                                    quis vel egestas. Eu iaculis id id vivamus sit ac. Sodales viverra facilisi pulvinar
                                    amet a.
                                </p>
                            </div>
                            <div class="third_image_wrapper">
                                <div class="left_bigger_image">
                                    <img src="frontend\images\Rectangle 180.png" alt="image">
                                </div>
                                <div class="right_smaller_images">
                                    <div class="first_img">
                                        <img src="frontend\images\Rectangle 181.png" alt="image">
                                    </div>
                                    <div class="second_img">
                                        <img src="frontend\images\Rectangle 182.png" alt="image">
                                    </div>
                                </div>
                            </div>
                            <div class="forth_txt">
                                <p>Lorem ipsum dolor sit amet consectetur. Et aliquet sed dis in pharetra elementum. Aliquet
                                    pharetra commodo mauris diam aenean vulputate pharetra fringilla. Dolor eget nullam
                                    consequat sem erat consectetur. Consectetur integer mauris sem metus ut ac. Etiam magna
                                    nam eget metus commodo egestas non volutpat cras. Convallis varius semper tellus vitae
                                    risus in facilisis faucibus. Quis enim molestie ut arcu ac commodo tempor commodo. Metus
                                    enim nibh senectus interdum et amet gravida metus amet.</p>
                            </div>
                            <div class="fifth_txt">
                                <p>“Lorem ipsum dolor sit amet
                                    consectetur dolor sit amet
                                    gravida urna gravida ”</p>
                            </div>
                            <div class="sixth_txt">
                                <p>Lorem ipsum dolor sit amet consectetur. Et aliquet sed dis in pharetra elementum. Aliquet
                                    pharetra commodo mauris diam aenean vulputate pharetra fringilla. Dolor eget nullam
                                    consequat sem erat consectetur. Consectetur integer mauris sem metus ut ac. Etiam magna
                                    nam eget metus commodo egestas non volutpat cras. Convallis varius semper tellus vitae
                                    risus in facilisis faucibus. Quis enim molestie ut arcu ac commodo tempor commodo. Metus
                                    enim nibh senectus interdum et amet gravida metus amet.</p>
                            </div>
                        </div>

                    </div>
                    <div id="content4" class="content-item">
                        <div class="first_content_wrapper">
                            <div class="first_txt">
                                <p>Rules for Rituals from Birth to Death Of Our
                                    Cho change Community</p>
                            </div>
                            <div class="second_txt">
                                <p>Lorem ipsum dolor sit amet consectetur. Sapien feugiat blandit placerat iaculis sed. Leo
                                    sed porttitor suspendisse ac faucibus venenatis. Morbi ut proin diam eget vestibulum
                                    venenatis duis tortor. Integer sapien fermentum integer tincidunt eget sapien sit vel
                                    laoreet. Amet blandit id neque turpis felis sollicitudin augue. Ut id amet venenatis
                                    quis vel egestas. Eu iaculis id id vivamus sit ac. Sodales viverra facilisi pulvinar
                                    amet a.
                                </p>
                            </div>
                            <div class="third_image_wrapper">
                                <div class="left_bigger_image">
                                    <img src="frontend\images\Rectangle 180.png" alt="image">
                                </div>
                                <div class="right_smaller_images">
                                    <div class="first_img">
                                        <img src="frontend\images\Rectangle 181.png" alt="image">
                                    </div>
                                    <div class="second_img">
                                        <img src="frontend\images\Rectangle 182.png" alt="image">
                                    </div>
                                </div>
                            </div>
                            <div class="forth_txt">
                                <p>Lorem ipsum dolor sit amet consectetur. Et aliquet sed dis in pharetra elementum. Aliquet
                                    pharetra commodo mauris diam aenean vulputate pharetra fringilla. Dolor eget nullam
                                    consequat sem erat consectetur. Consectetur integer mauris sem metus ut ac. Etiam magna
                                    nam eget metus commodo egestas non volutpat cras. Convallis varius semper tellus vitae
                                    risus in facilisis faucibus. Quis enim molestie ut arcu ac commodo tempor commodo. Metus
                                    enim nibh senectus interdum et amet gravida metus amet.</p>
                            </div>
                            <div class="fifth_txt">
                                <p>“Lorem ipsum dolor sit amet
                                    consectetur dolor sit amet
                                    gravida urna gravida ”</p>
                            </div>
                            <div class="sixth_txt">
                                <p>Lorem ipsum dolor sit amet consectetur. Et aliquet sed dis in pharetra elementum. Aliquet
                                    pharetra commodo mauris diam aenean vulputate pharetra fringilla. Dolor eget nullam
                                    consequat sem erat consectetur. Consectetur integer mauris sem metus ut ac. Etiam magna
                                    nam eget metus commodo egestas non volutpat cras. Convallis varius semper tellus vitae
                                    risus in facilisis faucibus. Quis enim molestie ut arcu ac commodo tempor commodo. Metus
                                    enim nibh senectus interdum et amet gravida metus amet.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Set the default tab content on page load
            showContent("content1");
            setActiveTab("tab1"); // Set the default active tab
        });

        document.getElementById("tab1").addEventListener("click", function(event) {
            event.preventDefault();
            showContent("content1");
            setActiveTab("tab1");
        });

        document.getElementById("tab2").addEventListener("click", function(event) {
            event.preventDefault();
            showContent("content2");
            setActiveTab("tab2");
        });

        document.getElementById("tab3").addEventListener("click", function(event) {
            event.preventDefault();
            showContent("content3");
            setActiveTab("tab3");
        });

        document.getElementById("tab4").addEventListener("click", function(event) {
            event.preventDefault();
            showContent("content4");
            setActiveTab("tab4");
        });

        function showContent(contentId) {
            // Hide all content items
            let contents = document.querySelectorAll(".content-item");
            contents.forEach(function(content) {
                content.style.display = "none";
            });

            // Show the selected content
            document.getElementById(contentId).style.display = "block";
        }

        function setActiveTab(tabId) {
            // Remove active class from all tabs
            let tabs = document.querySelectorAll("#tab1, #tab2, #tab3, #tab4");
            tabs.forEach(function(tab) {
                tab.classList.remove("active");
            });

            // Add active class to the clicked tab
            document.getElementById(tabId).classList.add("active");
        }
    </script>

@endsection
