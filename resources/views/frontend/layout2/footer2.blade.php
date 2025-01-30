<link rel="stylesheet" href="frontend\sass\_header.scss">
<footer>
    <footer class="footer-container">
        <div class="container">
            <div class="footer-content">
                <div class="fcol1">
                    <div class="logo_wrapper">
                        <div class="nav_logo"> <a href="{{ route('home') }}">
                                @if (!empty($siteSetting->img_logo))
                                <img src={{ asset('storage/setting') . '/' . $siteSetting->img_logo }}>
                                @else
                                <img src="{{ asset('frontpanel/assets/images/WhatsApp Image 2024-12-26 at 10.57.06 AM 1@2x.png') }}"
                                    alt="">
                                @endif
                            </a>
                        </div>
                        <div class="logo_txt">
                            <a href="{{ route('home') }}">
                                <span class="logo_title">चाेचाङ्गी समाज<br>नेपाल</span>
                            </a>
                        </div>
                    </div>
                    <div class="fcol1_txt">
                        <p>चाेचाङ्गी समाज भावी पुस्ताका लागि वातावरण संरक्षणमा विश्वास गर्छ ।</p>
                    </div>

                </div>
                <div class="fcol2">
                    <div class="link">
                        <div class="link-title">
                            <p>महत्त्वपूर्ण लिङ्कहरू</p>
                            <div class="bottom-fl"></div>
                        </div>
                        <ul>
                            <li><a href="{{ route('history') }}"><span class="greater">></span> ऐतिहासिक स्थान</a>
                            </li>
                            <li><a href="{{ route('about') }}"><span class="greater">></span> परिचय</a></li>
                            <li><a href="{{ route('program') }}"><span class="greater">></span> कार्यक्रम</a></li>
                            <li><a href="{{ route('faq') }}"><span class="greater">></span> बारम्बार सोधिने
                                    प्रश्नहरू</a></li>
                            <li><a href="{{ route('gallery') }}"><span class="greater">></span> प्रदर्शनी/ग्यालरी</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="fcol3">
                    <div class="touch-link">
                        <div class="touch-title">
                            <p>सम्पर्क</p>
                            <div class="bottom-fl"></div>
                        </div>
                        <ul>
                            <div class="all-icon-box">
                                <div class="ficon-border">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z" />
                                    </svg>
                                </div>
                                <div class="icon-txt">
                                    @if (!empty($siteSetting->phone_number))
                                    <p><a href="tel:{{ $siteSetting->phone_number ?? '' }}"
                                            target="_blank">{{ $siteSetting->phone_number ?? '' }}</a>
                                    </p>
                                    @else
                                    <p><a href="tel:+1234567890">+977-9867886300</a></p>
                                    @endif
                                </div>
                            </div>
                            <div class="all-icon-box">
                                <div class="ficon-border">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z" />
                                    </svg>
                                </div>
                                <div class="icon-txt">
                                    @if (!empty($siteSetting->email))
                                    <p><a href="mailto:{{ $siteSetting->email ?? '' }}"
                                            target="_blank">{{ $siteSetting->email ?? '' }}</a></p>
                                    @else
                                    <p><a href="mailto:yourname@example.com">Chohangeysamaj@gmail</a></p>
                                    @endif
                                </div>
                            </div>
                            <div class="all-icon-box">
                                <div class="ficon-border">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
                                    </svg>
                                </div>
                                <div class="icon-txt">
                                    @if (!empty($siteSetting->address))
                                    <p><a href="">{{ $siteSetting->address ?? '' }}</a></p>
                                    @else
                                    <p><a href="https://www.google.com/maps?q=Your+Location"
                                            target="_blank">Buddhanagar, Ktm</a></p>
                                    @endif
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
                <div class="fcol4">
                    <div class="letter-link">
                        <div class="letter-title">
                            <p>सामाजिक संजाल </p>
                            <div class="bottom-fl"></div>
                        </div>
                        <!-- <div class="letter-txt">
                            <p> सम्पर्कमा रहनुहोस</p>
                        </div> -->
                        <div class="flogo-icon">
                            @if (!empty($siteSetting->link_twitter))
                            <div class="ficon-border">
                                <a href="#" class="fa fa-twitter ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                                        <path
                                            d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334q.002-.211-.006-.422A6.7 6.7 0 0 0 16 3.542a6.7 6.7 0 0 1-1.889.518 3.3 3.3 0 0 0 1.447-1.817 6.5 6.5 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.32 9.32 0 0 1-6.767-3.429 3.29 3.29 0 0 0 1.018 4.382A3.3 3.3 0 0 1 .64 6.575v.045a3.29 3.29 0 0 0 2.632 3.218 3.2 3.2 0 0 1-.865.115 3 3 0 0 1-.614-.057 3.28 3.28 0 0 0 3.067 2.277A6.6 6.6 0 0 1 .78 13.58a6 6 0 0 1-.78-.045A9.34 9.34 0 0 0 5.026 15" />
                                    </svg>
                                </a>
                            </div>
                            @else
                            <div class="ficon-border">
                                <a href="" class="fa fa-twitter ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                                        <path
                                            d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334q.002-.211-.006-.422A6.7 6.7 0 0 0 16 3.542a6.7 6.7 0 0 1-1.889.518 3.3 3.3 0 0 0 1.447-1.817 6.5 6.5 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.32 9.32 0 0 1-6.767-3.429 3.29 3.29 0 0 0 1.018 4.382A3.3 3.3 0 0 1 .64 6.575v.045a3.29 3.29 0 0 0 2.632 3.218 3.2 3.2 0 0 1-.865.115 3 3 0 0 1-.614-.057 3.28 3.28 0 0 0 3.067 2.277A6.6 6.6 0 0 1 .78 13.58a6 6 0 0 1-.78-.045A9.34 9.34 0 0 0 5.026 15" />
                                    </svg>
                                </a>
                            </div>
                            @endif
                            @if (!empty($siteSetting->link_facebook))
                            <div class="ficon-border">
                                <a href="#"
                                    class="fa fa-facebook ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                                    </svg>
                                </a>
                            </div>
                            @else
                            <div class="ficon-border">
                                <a href="" class="fa fa-facebook ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                                    </svg>
                                </a>
                            </div>
                            @endif
                            @if (!empty($siteSetting->link_instagram))
                            <div class="ficon-border">
                                <a href="#"
                                    class="fa fa-instagram ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                        <path
                                            d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
                                    </svg>
                                </a>
                            </div>
                            @else
                            <div class="ficon-border">
                                <a href="" class="fa fa-instagram ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                        <path
                                            d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
                                    </svg>
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="last_footer_wrapper">
            <div class="ltf_frow">
                <p>© 2025 चाेचाङ्गी समाज नेपाल सर्वाधिकार सुरक्षित</p>
            </div>
            <div class="right_frow">
                <p>Powered By <a href="https://cltech.com.np/" target="_blank"><span class="blue">CL</span><span
                            class="red">Tech</span></a></p>
            </div>

        </div>
    </footer>