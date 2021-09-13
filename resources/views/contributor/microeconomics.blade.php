@extends('layouts.app')


@section('title') INET ED Platform :: FAQs @endsection

@section('content')
    @include('include.header')

    <header class="bg-lightWhite200 pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <h6 class="font-familyAtlasGroteskWeb-Regular mb-4"><span class="text-colorMahroon700">Bookmarks</span> <i class="fas fa-angle-right ml-3 mr-3 text-colorMahroon100"></i> <span class="text-colorMahroon600">Microeconomics: The Truth About Prices</span></h6>
                    <h2 class="font-familyAtlasGroteskWeb-Bold text-black">Microeconomics: The Truth About Prices</h2>
                    <p class="font-familyAtlasGroteskWeb-Light text-colorblue200 font-size14px">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>
                    <p class="text-colorblue100 font-size12px mb-0"><span class="mr-2">Advanced Undergraduate</span> <i class="fas fa-circle font-size6px mr-2"></i> <span class="mr-2">14m</span> <i class="fas fa-circle font-size6px mr-2"></i> <span class="mr-2">Economic History</span> <span class="mr-2 opacity0point5">|</span> <span class="mr-2 opacity0point5">Posted on : 16 APR, 2020</span></p>
                </div>
                <div class="col-md-3 align-self-center text-right mt-3 mt-md-0">
                   <span class="mr-2 text-ferozy">Bookmarked</span>
                   <button class="btn btn-customBtn2 border-radius2em"><i class="fas fa-bookmark text-white"></i></button>
                </div>
            </div>
        </div>
    </header>
    <section class="bg-white pt-5 pb-5 font-familyAtlasGroteskWeb-Regular font-size14px">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-12 border-bottom d-flex justify-content-between align-self-center mb-4">
                    <span class="border-bottom3px text-ferozy pr-3 pb-2">Content</span>
                    <span class="text-ferozy pr-3 pb-2 font-familyAtlasGroteskWeb-Bold font-size12px"><span>SHARE</span> <i class="fas fa-angle-down text-colorMahroon700 ml-2"></i></span>
                </div>

                <div class="col-md-12 mb-4">
                    <div id="accordion" class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size13px">
                        <div class="col-12 border mb-4 p-0 bg-white">
                            <div class="mb-0 d-flex no-gutters pt-2 pb-2 pl-3 pr-3">
                                <div class="col-md-6 d-flex">
                                    <img src="{{ asset('images/icons/videoIcon.png') }}" alt="" height="30">
                                    <div class="align-self-center ml-3">
                                        <p class="mb-0">Introduction</p>
                                        <p class="mb-0 font-size10px opacity0point5">VIDEO</p>
                                    </div>

                                </div>
                                <div class="col-md-3 align-self-center">
                                    <span class="badge badge-customBtn4 pl-3 pr-3 pt-2 pb-2 font-size10px border-radius0all align-self-center font-familyAtlasGroteskWeb-Regular"><i class="far fa-clock mr-1"></i> 00:12:00</span>
                                </div>
                                <div class="col-md-3 text-right align-self-center">
                                    <a href="#" class="border-radius0all w-100 text-left p-0 pt-3 pb-3 font-familyAtlasGroteskWeb-Bold font-size10px" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        <span>VIEWED</span>
                                        <i class="fa text-ferozy ml-3 font-size14px align-self-center"></i>
                                    </a>
                                </div>
                            </div>

                            <div id="collapseOne" class="collapse show pt-3" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="col-md-12 p-0 d-flex">
                                    <video class="w-100" controls>
                                        <source src="{{ asset('video/Loremipsumvideo.mp4') }}" type="video/mp4">
                                    </video>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 border-top pt-4 pb-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6 class="font-familyFreightTextProMedium-Italic text-black">Contributor</h6>
                            <div class="media mt-2">
                                <img class="mr-3" src="{{ asset('images/icons/img1.png') }}" alt="placeholder image" width="70">
                                <div class="media-body align-self-center">
                                    <h6 class="mt-0 font-familyAtlasGrotesk-Medium text-colorblue100">Nina Jojo </h6>
                                    <span class="badge badge-secondary font-familyFreightTextProMedium-Italic pl-3 pr-3 pt-2 pb-2 font-size12px">Contributor</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-0 float-right">
                                <h6 class="font-familyFreightTextProMedium-Italic text-black">Tags:</h6>
                                <button class="btn btn-customBtn1 font-familyAtlasGroteskWeb-Regular font-size13px mt-2 border-radius0all opacity0point5">Economic Thought</button>
                                <button class="btn btn-customBtn1 font-familyAtlasGroteskWeb-Regular font-size13px mt-2 border-radius0all opacity0point5">Business</button>
                                <button class="btn btn-customBtn1 font-familyAtlasGroteskWeb-Regular font-size13px mt-2 border-radius0all opacity0point5">Finance</button>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    @include('include.footer')

@endsection

