@extends('layouts.app')


@section('title') INET ED Platform @endsection

@section('content')
    @include('include.header')

    <?php $user_content_list = explode(",", $user_content_updated_list); ?>

    <section class="pt-5 pb-5 bg-white">

        {{-- @if($incomplete_content)
            <section>
                <div class="container">
                    <div class="row">

                        <div class="col-md-12 mb-3">
                            <h5 class="text-colorblue100 font-familyAtlasGroteskWeb-Bold">Welcome back {{ Auth::user()->name }}, continue from where you left?</h5>
                        </div>
                        @foreach ($incomplete_content as $content)
                            <div class="col-lg-6 col-md-12 mb-3 bookmarkCheck">
                                <div class="col-md-12 border d-md-flex p-0">
                                    <div class="col-md-5 p-0 d-flex">
                                        <a href="{!! route('contentSection', ['content_id' => $content->id]) !!}">
                                       <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/' . $content->image_url) }}" alt="image">
                                        </a>
                                    </div>

                                    <div class="col-lg-7 p-0 border-radius0all">
                                        <div class="card-header bg-transparent border-0 pb-0 pt-2 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200 overflow-hidden">
                                            {{-- <small class="float-left">{{ $content->downloaded_count }} Downloads</small>
                                            <small class="float-right">{{ $content->views_count }} Views</small>
                                        </div>
                                        <div class="card-body pt-2 pb-2">
                                            <p class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size12px mb-2">{{ $content->difficulty_level }}</p>
                                            <a href="{!! route('contentSection', ['content_id' => $content->id]) !!}">
                                                <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0 font-size0point8">{{ $content->title }}</h6>
                                            </a>
                                            <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200 font-size13px">{{ $content->author }}</small></p>
                                        </div>
                                        <div class="card-footer bg-transparent border-0 d-flex justify-content-between pt-0 pb-1">

                                           <small class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size10px align-self-center"></small>
                                            <div class="m-0 text-colorblue200 d-flex bookmark">

                                                <div class="custom-control custom-checkbox mr-sm-2">
                                                    <input {{ in_array($content->id, $user_content_list) ? 'checked' : '' }} onclick="bookmark(this)" type="checkbox" value={{ '[' . $content->id . ',' . Auth::user()->id . ']' }} class="custom-control-input" id="bookmark-{{ $content->id }}">
                                                    <label class="custom-control-label" for="bookmark-{{ $content->id }}"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif --}}


        {{-- <section class="pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 font-familyAtlasGroteskWeb-Bold d-flex mb-4 justify-content-between">
                        <h4 class="text-colorblue100 mb-0">Recommended Content</h4>
                        <a href="{{ route('searchCourses') }}" class="text-ferozy font-size13px align-self-center">VIEW ALL <i class="fas fa-chevron-right text-colorMahroon700 ml-3"></i></a>
                    </div>

                    <?php $count = 0; ?>
                    @if ($contents)
                        @foreach ($contents as $content)

                        <?php if($count == 4) break; ?>
                        <?php $count++; ?>

                            <div class="col-lg-3 col-md-6 mb-3 d-flex bookmarkCheck">
                                <div class="card col-12 p-0 border-radius0all">
                                    <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/' . $content->image_url) }}" alt="image">
                                    <div class="card-header bg-transparent border-0 pb-0 pt-2 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200">
                                        {{-- <small class="float-left">{{ $content->downloaded_count }} Downloads</small>
                                        <small class="float-right">{{ $content->views_count }} Views</small>
                                    </div>
                                    <div class="card-body">
                                        <p class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size13px mb-2">{{ $content->difficulty_level }}</p>
                                        <a href="{!! route('contentSection', ['content_id' => $content->id]) !!}">
                                            <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0 font-size1em">{{ $content->title }}</h6>
                                        </a>
                                        <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $content->author }}</small></p>
                                    </div>
                                    <div class="card-footer bg-transparent border-0 d-flex justify-content-between">
                                        {{-- <small class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size10px align-self-center">{{ $content->duration }}</small>
                                        <div class="m-0 text-colorblue200 d-flex bookmark">
                                            {{-- <i class="fas fa-download"></i>
                                                <div class="custom-control custom-checkbox mr-sm-2">
                                                <input {{ in_array($content->id, $user_content_list) ? 'checked' : '' }} onclick="bookmark(this)" type="checkbox" value={{ '[' . $content->id . ',' . Auth::user()->id . ']' }} class="custom-control-input" id="bookmark-{{ $content->id }}">
                                                <label class="custom-control-label" for="bookmark-{{ $content->id }}"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </section> --}}

        <section class="pt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 font-familyAtlasGroteskWeb-Bold mb-4 text-center">
                        <h4 class="text-colorblue100 mb-0">Browse Content </h4>
                        <p class="font-familyAtlasGroteskWeb-Regular text-colorblue200">Search for content by field</p>
                    </div>

                    <div class="col-lg-6 col-md-12 font-familyAtlasGroteskWeb-Medium text-colorblue100 d-flex">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 mb-3 mb-lg-0 d-flex align-self-center">
                                <div class="col-md-12 bg-lightWhite100 p-3">
                                    <a href="{{ route('courses', '1') }}" class="d-block text-black">
                                    <img src="{{asset('images/icons/icon1.png')}}" class="mr-2" width="60">
                                    <span>Micro</span>
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12 mb-3 mb-lg-0 d-flex align-self-center">
                                <div class="col-md-12 bg-lightWhite100 p-3">
                                    <a href="{{ route('courses', '2') }}" class="d-block text-black">
                                    <img src="{{asset('images/icons/icon2.png')}}" class="mr-2" width="60">
                                    <span>Macro</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 mb-3 mb-lg-0 d-flex align-self-center">
                                <div class="col-md-12 bg-lightWhite100 p-3">
                                    <a href="{{ route('courses', '5') }}" class="d-block text-black">
                                    <img src="{{asset('images/icons/icon3.png')}}" class="mr-2" width="60">
                                    <span>Thought</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 mb-3 mb-lg-0 d-flex align-self-center">
                                <div class="col-md-12 bg-lightWhite100 p-3">
                                    <a href="{{ route('courses', '6') }}" class="d-block text-black">
                                    <img src="{{asset('images/icons/icon4.png')}}" class="mr-2" width="60">
                                    <span>History</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 mb-3 mb-lg-0 d-flex align-self-center">
                                <div class="col-md-12 bg-lightWhite100 p-3">
                                    <a href="{{ route('courses', '3') }}" class="d-block text-black">
                                    <img src="{{asset('images/icons/icon5.png')}}" class="mr-2" width="60">
                                    <span>Method</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 mb-3 mb-lg-0 d-flex align-self-center">
                                <div class="col-md-12 bg-lightWhite100 p-3">
                                    <a href="{{ route('courses', '4') }}" class="d-block text-black">
                                    <img src="{{asset('images/icons/icon6.png')}}" class="mr-2" width="60">
                                    <span>Policy</span>
                                    </a>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="col-md-12 bg-lightWhite p-5 font-size13px">
                            <div class="col-md-12 border-bottomCus">
                                <div class="row justify-content-between">
                                    <h5 class="font-familyAtlasGroteskWeb-Bold text-black">Featured Content</h5>
                                    <a href="{{ route('searchCourses') }}" class="font-familyFreightTextProMedium-Italic text-black align-self-center font-size14px">View All <i class="fas fa-angle-right text-colorMahroon700 ml-3"></i></a>
                                </div>
                            </div>

                            <div class="col-md-12 p-0">
                                <!-- Swiper -->
                                <div class="swiper-container pt-4">
                                    <div class="swiper-wrapper">

                                        @if ($contents)
                                            @foreach ($contents as $content)

                                                    <div class="swiper-slide text-left">
                                                        <div class="card col-12 p-0 border-radius0all bookmarkCheck">
                                                            <a href="{!! route('contentSection', ['content_id' => $content->id]) !!}">
                                                            <img class="card-img-top" src="{{ asset('public/uploads/content/profile_images/' . $content->image_url) }}" alt="image">
                                                            </a>

                                                            <div class="card-header bg-transparent border-0 pb-0 pt-2 font-size13px font-familyAtlasGroteskWeb-Regular text-colorblue200">
                                                                {{-- <small class="float-left">{{ $content->downloaded_count }} Downloads</small> --}}
                                                                <small class="float-right">{{ $content->views_count }} Views</small>
                                                            </div>

                                                            <div class="card-body pb-0 pt-3">
                                                                <p class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size13px mb-2">{{ $content->difficulty_level }}</p>
                                                                <a href="{!! route('contentSection', ['content_id' => $content->id]) !!}">
                                                                    <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0 font-size0point8">{{ $content->title }}</h6>
                                                                </a>
                                                                <p class="card-text font-size13px"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $content->authors }}</small></p>

                                                                <p class="card-text font-size13px"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $content->affiliation }}</small></p>
                                                            </div>

                                                            <div class="card-footer bg-transparent border-0 d-flex justify-content-between">
                                                             <small class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size10px align-self-center"></small>
                                                                <div class="m-0 text-colorblue200 d-flex bookmark font-size14px">
                                                                    {{-- <i class="fas fa-download"></i> --}}
                                                                    <div class="custom-control custom-checkbox mr-sm-2">
                                                                        <input {{ in_array($content->id, $user_content_list) ? 'checked' : '' }} onclick="bookmark(this)" type="checkbox" value={{ '[' . $content->id . ',' . Auth::user()->id . ']' }} class="custom-control-input" id="bookmark-{{ $content->id }}">
                                                                        <label class="custom-control-label" for="bookmark-{{ $content->id }}"></label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                            @endforeach
                                        @endif

                                    </div>
                                    <!-- Add Pagination -->
                                    <div class="swiper-pagination position-relative mt-4"></div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </section>

        <article class="sub_banner pt-4 pb-4 mt-4 mb-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 text-white pt-3 pb-3 mt-3 mb-3 text-center font-size14px">
                        <h2 class="font-familyFreightTextProSemibold-Regular">What is the Community Talking About?</h2>
                        <p class="mb-0 font-familyAtlasGrotesk-Regular opacity0point5">Read what our community is talking about in our discussion boards</p>
                        {{-- <button type="button" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px p-0 border-radius0px btnBotmBar mt-4">
                            <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">Click Here <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                            <div class="btn-bar"></div>
                        </button> --}}

                        <a href="/inetEDPlatform/discussionBoard" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px mt-2 p-0 border-radius0px btnBotmBar">
                            <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">Click Here <i class="fas fa-angle-right ml-3 text-colorMahroon100">

                            </i></span>
                            <div class="btn-bar"></div>
                        </a>

                    </div>
                </div>
            </div>
        </article>

    </section>

    @include('include.footer')
@endsection
