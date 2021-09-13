<footer>
    <nav class="bg-footer  pt-5 pb-5 font-familyAtlasGroteskWeb-Regular text-white font-size13px">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <!-- Links -->
                    <h6 class="text-uppercase font-familyAtlasGroteskWeb-Black">ABOUT</h6>
                    <ul class="list-unstyled">
                        <li>
                            <a href="{{ route('abouts') }}">INET ED Platform</a>
                        </li>
                        <li>
                            <a href="{{ route('newsAndMedia') }}">News</a>
                        </li>
                        <li>
                            <a href="{{ route('infoTeacher') }}">Teacher Info</a>
                        </li>
                        <li>
                            <a href="{{ route('infoStudent') }}">Student Info</a>
                        </li>
                        <li>
                            <a href="/inetEDPlatform/courses/7">General Resources</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase font-familyAtlasGroteskWeb-Black">HELP</h6>
                    <ul class="list-unstyled">
                        <li>
                            <a href="{{ route('contact') }}">Contact Us</a>
                        </li>
                        <li>

                            <a href="/inetEDPlatform/discussionBoard">Discussion Board</a>
                        </li>
                        <li>
                            <a href="{{ route('faqs') }}">FAQs</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase font-familyAtlasGroteskWeb-Black">SOCIAL</h6>
                    <ul class="list-unstyled">
                        <li>
                            <a href="https://web.facebook.com/INETeconomics?_rdc=1&_rdr" target="_blank">Facebook</a>
                        </li>
                        <li>
                            <a href="https://twitter.com/ineteconomics" target="_blank">Twitter</a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/ineteconomics/?hl=en" target="_blank">Instagram</a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-6 mt-4 align-self-center">
                    <img src="{{ asset('images/logo/logosub.png') }}" alt="" width="340">
                </div>
                <div class="col-md-6 text-right text-white font-familyAtlasGroteskWeb-Light mt-4">
                    <p class="mb-0">Institute for New Economic Thinking</p>
                    <p class="mb-0">300 Park Avenue South, Floor 5</p>
                    <p class="mb-0">New York, NY 10010</p>
                    <p class="mb-0">(646) 751-4900</p>
                </div>

            </div>
        </div>
    </nav>
    <article class="bg-colorMehroon pt-4 pb-4 text-white font-familyAtlasGroteskWeb-Light font-size14px">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0">
                        <a class="text-white" href="{{ route('termsConditions') }}">Terms of Service</a> | <a class="text-white" href="{{ route('privacyPolicy') }}">Privacy Policy</a> | <a class="text-white" href="{{ route('coummunity') }}">Community Guidelines</a></p>
                </div>
                <div class="col-md-6 text-right">
                    <p class="font-familyFreightTextProLight-Regular mb-0 mt-md-0 mt-3 opacity0point5">©2020 Institute for New Economic Thinking. All Rights Reserved</p>
                </div>
            </div>
        </div>
    </article>


</footer>


