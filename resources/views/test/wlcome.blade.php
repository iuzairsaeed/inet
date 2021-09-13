@extends('layouts.app')


@section('title') INET ED Platform @endsection

@section('content')
@include('include.header')


<div class="container-fluid banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-12 welcome-text">
                <h1 class="">Welcome to <br> The ED Platform</h1>
                <p  class="">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                    eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                    enim ad minim veniam, quis nostrud exercitation ullamco laboris
                    commodo consequat.</p>
            </div>

        </div>
    </div>

</div>

<div class="container-fluid p-0">

    <div class="container">
        <div class="row rowbox">
            <div class="col-lg-7 greybox">
                <h2 class="font-familyAtlasGroteskWeb-Bold text-black pt-5 mt-5 text-center">Our Mission</h2>
                <p class="text-center pl-2 pr-2 paratext">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                    eiusmod temp inc ididunt ut labore et dolore magna. Ut enim ad minim
                    veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                    commodo consequat.</p>
            </div>
            <div class="col-lg-5">
                <div class="m-auto text-center p-5"> <img src="{{ asset("images/admin/Asset131.png")}}" width="250" height="250"></div>
            </div>
        </div>

        <div class="row rowbox">
            <div class="col-lg-5">
                <div class="m-auto text-center p-5"> <img src="{{ asset("images/admin/Asset130.png")}}" width="250" height="250"></div>
            </div>
            <div class="col-lg-7 greybox">
                <h2 class="font-familyAtlasGroteskWeb-Bold text-black pt-5 mt-5 text-center">Our Vision</h2>
                <p class="text-center pl-2 pr-2 paratext font-familyAtlasGroteskWeb-Regular">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                    eiusmod temp inc ididunt ut labore et dolore magna. Ut enim ad minim
                    veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                    commodo consequat.</p>
            </div>
        </div>
    </div>
    <hr>

</div>

<div class="container-fluid p-0 pb-5">
    <div class="container">
        <h2 class="font-familyAtlasGroteskWeb-Bold text-black pt-5  text-center browsby">Browse by Field of Interest</h2>
        <p class="browsbyp">Each field opens up into a number of subcategories, explore content according <br> to your niche area of interest</p>

        <div class="row">
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row catgoery-box ">
                            <div class="col-md-4 catgoery-img">
                                <img src="{{ asset("images/admin/Asset129.png") }}">
                            </div>
                            <div class="col-md-6 catgoery-text">Microeconomics</div>
                        </div>

                        <div class="row catgoery-box ">
                            <div class="col-md-4 catgoery-img">
                                <img src="{{ asset("images/admin/Asset129.png") }}">
                            </div>
                            <div class="col-md-6 catgoery-text">Thought </div>
                        </div>


                        <div class="row catgoery-box ">
                            <div class="col-md-4 catgoery-img">
                                <img src="{{ asset("images/admin/Asset129.png") }}">
                            </div>
                            <div class="col-md-6 catgoery-text">Policy</div>
                        </div>


                    </div>


                    <div class="col-md-6">

                        <div class="row catgoery-box ">
                            <div class="col-md-4 catgoery-img">
                                <img src="{{ asset("images/admin/Asset129.png") }}">
                            </div>
                            <div class="col-md-6 catgoery-text">Macroeconomics</div>
                        </div>

                        <div class="row catgoery-box ">
                            <div class="col-md-4 catgoery-img">
                                <img src="{{ asset("images/admin/Asset129.png") }}">
                            </div>
                            <div class="col-md-6 catgoery-text">History</div>
                        </div>

                        <div class="row catgoery-box ">
                            <div class="col-md-4 catgoery-img">
                                <img src="{{ asset("images/admin/Asset129.png") }}">
                            </div>
                            <div class="col-md-6 catgoery-text">Method</div>
                        </div>


                    </div>
                </div>





            </div>

            <div class="col-md-5">
                <div class="col-md-12 bg-lightWhite p-3">
                    <div class="col-md-12 border-bottomCus">
                        <div class="row justify-content-between">
                            <h4 class="font-familyAtlasGroteskWeb-Bold text-black">Featured Content</h4>
                            <a href="#" class="font-familyFreightTextProMedium-Italic text-black">View All <i class="fas fa-angle-right text-colorMahroon700 ml-3"></i></a>
                            <hr>

                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div> <img src="{{ asset("images/icons/img1-2.png")}}" width="100%" /></div>
                                    </div>

                                    <div class="swiper-slide">
                                        <div> <img src="{{ asset("images/icons/img1-3.png")}}" width="100%" /></div>
                                    </div>

                                    <div class="swiper-slide">
                                        <div> <img src="{{ asset("images/icons/img1-2.png")}}" width="100%" /></div>
                                    </div>

                                    <div class="swiper-slide">
                                        <div> <img src="{{ asset("images/icons/img1-3.png")}}" width="100%" /></div>
                                    </div>

                                </div>
                                <!-- Add Pagination -->
                                <div class="swiper-pagination"></div>
                            </div>

                        </div>
                    </div>




                </div>
            </div>
        </div>
    </div>



</div>

<hr>


<div class="container-fluid p-0 pb-5">
    <div class="container">
        <h2 class="font-familyAtlasGroteskWeb-Bold text-black pt-5  text-center browsby">Read More About The Community We Are Building</h2>
        <p class="browsbyp">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo<br>  ligula eget dolor. Aenean massa.</p>

        <div class="row rowbox  mt-5 mb-5">
            <div class="col-lg-5 col-lg-5 pt-5 pb-5">
                <h3 class="font-familyAtlasGroteskWeb-Bold howserve">How We Serve Teachers</h3>
                <p class="howserve-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                    temp inc ididunt ut labore et dolore magna. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat xercit.</p>

                <button class="create-btn">Create Account <span class="btn-img"><img src="{{ asset("images/admin/Asset117.png")}}" ></span></button>
                <button class="learn-btn">LEARN MORE <span class="btn-img"><img src="{{ asset("images/admin/Asset114.png")}}" ></span></button>

            </div>
            <div class="col-lg-7 greybox">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <div class="readmore-img"><img src="{{ asset("images/icons/img3.png")}}"></div>
                        <div class="readmore-name">Jerry Smith</div>
                        <div class="readmore-profession">Teacher</div>
                    </div>
                    <div class="col-md-8">
                        <p class="profilebox-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                            temp inc ididunt ut labore et dolore magna. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat xercit.</p>

                    </div>
                </div>

            </div>
        </div>


        <div class="row rowbox">

            <div class="col-lg-7 greybox">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <div class="readmore-img"><img src="{{ asset("images/icons/img2.png")}}"></div>
                        <div class="readmore-name">Donnie Montana</div>
                        <div class="readmore-profession">Public</div>
                    </div>
                    <div class="col-md-8">
                        <p class="profilebox-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                            temp inc ididunt ut labore et dolore magna. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat xercit.</p>

                    </div>
                </div>

            </div>

            <div class="col-lg-5 col-lg-5 pt-5 pb-5 text-right">
                <h3 class="font-familyAtlasGroteskWeb-Bold howserve">How We Serve General Public</h3>
                <p class="howserve-text  text-right">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                    temp inc ididunt ut labore et dolore magna. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat xercit.</p>
                <div class="ready-text">I’m ready to:</div>
                <button class="create-btn mt-0">Create Account <span class="btn-img"><img src="{{ asset("images/admin/Asset117.png")}}" ></span></button>
                <button class="learn-btn mt-0">EXPLORE <span class="btn-img"><img src="{{ asset("images/admin/Asset114.png")}}" ></span></button>

            </div>
        </div>


        <div class="row rowbox">
            <div class="col-lg-5 col-lg-5 pt-5 pb-5">
                <h3 class="font-familyAtlasGroteskWeb-Bold howserve">How We Serve Students</h3>
                <p class="howserve-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                    temp inc ididunt ut labore et dolore magna. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat xercit.</p>

                <button class="create-btn">Create Account <span class="btn-img"><img src="{{ asset("images/admin/Asset117.png")}}" ></span></button>
                <button class="learn-btn">LEARN MORE <span class="btn-img"><img src="{{ asset("images/admin/Asset114.png")}}" ></span></button>

            </div>
            <div class="col-lg-7 greybox">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <div class="readmore-img"><img src="{{ asset("images/icons/img1.png")}}"></div>
                        <div class="readmore-name">Morty Maxel</div>
                        <div class="readmore-profession">Student</div>
                    </div>
                    <div class="col-md-8">
                        <p class="profilebox-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                            temp inc ididunt ut labore et dolore magna. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat xercit.</p>

                    </div>
                </div>

            </div>
        </div>




        <div class="row rowbox text-center">
            <div class="col-lg-12 what-our-community">
                <h2>Hear What Our Community Is Talking About</h2>
                <p>Join or read one of our many community wide discussion boards here.</p>
                <button class="create-btn">CLICK HERE <span class="btn-img"><img src="{{ asset("images/admin/Asset117.png")}}" ></span></button>
            </div>
        </div>


    </div>



</div>






@include('include.footer')
@endsection
