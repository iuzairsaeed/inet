@extends('layouts.app')


@section('title') INET ED Platform @endsection

@section('content')
   @include('include.header')
   @foreach ($homepage as $home)

   {{-- <section class="banner pt-7 pb-8"> --}}
    <section id="img-cusThumbnail-1" class="banner pt-7 pb-8" style="background: url('https://ineted.org/inetadmin/public/images/home/banner/{{ $home->banner_img }}'); background-size: cover; background-repeat: no-repeat;">

   <div class="container">
    <div class="row">



      <div class="col-lg-6 col-sm-12">
           <h2 class="text-black"><strong>{!! $home->banner_heading !!} </strong></h2>
           <p  class="text-colorblue200 font-familyFreightTextProLight-Regular pt-1" style="font-size: 22px;">{!! $home->banner_sub_heading !!}</p>
      </div>


    </div>
   </div>

  </section>

<section class="pt-5">
       <div class="container">
           <div class="row">
               <div class="col-md-12 font-familyAtlasGroteskWeb-Bold mb-4 text-center">
                   <h4 class="text-black mb-0">{!! $home->browser_heading !!} </h4>
                   <p class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{!! $home->browser_sub_heading !!}</p>
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
                                                        {{-- <div class="custom-control custom-checkbox mr-sm-2">
                                                            <input {{ in_array($content->id, $user_content_list) ? 'checked' : '' }} onclick="bookmark(this)" type="checkbox" value={{ '[' . $content->id . ',' . Auth::user()->id . ']' }} class="custom-control-input" id="bookmark-{{ $content->id }}">
                                                            <label class="custom-control-label" for="bookmark-{{ $content->id }}"></label>
                                                        </div> --}}
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



<section class="p-0 pb-5">
  <div class="container">
        <div class="row">

          <div class="col-sm-12 p-0 pb-5">
            <h3 class="font-familyAtlasGroteskWeb-Bold text-black pt-5  text-center">{!! $home->community_heading !!}</h3>
            <p class="text-colorblue200 font-size14px text-center font-familyAtlasGrotesk-Regular">{!! $home->community_sub_heading !!}</p>
          </div>


        <div class="col-lg-5 col-lg-5 pt-5 pb-5">
            <h4 class="font-familyAtlasGrotesk-Bold text-black">{!! $home->teacher_heading !!}</h4>
            <p class="font-familyFreightTextProLight-Regular text-colorblue200 pb-2">{!! $home->teacher_sub_heading !!}</p>

            <a href="{{ route('register') }}" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px p-0 border-radius0px btnBotmBar">
                        <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">Create Account <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                        <div class="btn-bar"></div>
                    </a>
            <a href="{{ route('infoTeacher') }}" class="btn btn-customBtn3 text-colorMahroon700 font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar ml-3 ">
                        <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">Learn More <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                        <div class="btn-bar"></div>
                    </a>

        </div>
        <div class="col-lg-7 pr-0 pl-sm-4 pl-0">
          <div class="col-sm-12 col-12 bg-lightWhite200 d-sm-flex pl-4 pt-5 pb-5 pr-4">
                <div class="col-md-4 col-12 text-center">
                    <div id="img-cusThumbnail-2" name="img-cusThumbnail-2" class="img-cusThumbnail" style="background: url('https://ineted.org/inetadmin/public/images/home/teacher/{{ $home->teacher_img }}') no-repeat; background-size: cover; background-repeat: no-repeat;"></div>
                   {{-- <img src="{{ asset('images/icons/img3.png')}}" class="img-fluid img-cirlce" style="width: 105px;"> --}}
                   <h5 class="mt-0 font-familyAtlasGrotesk-Medium text-colorblue100 mt-3">
                    <span class="font-size14px mt-3 align-self-center col-sm-12">{!! $home->teacher_name !!}</span><br/> <span class="badge badge-secondary font-familyFreightTextProMedium-Italic font-size13px pl-3 pr-3 pt-2 ml-2 pb-2">Teacher</span></h5>
                </div>
                <div class="col-md-8 col-12 p-0">
                      <img src="{{asset('images/admin/Asset113.png')}}" class="position-absolute quote-img">
                  <p class="font-familyFreightTextProLight-Regular text-black pl-4 pt-5">
                    {!! $home->teacher2_sub_heading !!} </p>

                </div>
              </div>
          </div>
      </div>
  </div>
</section>


<section class="p-0 pb-5">
  <div class="container">
        <div class="row">

        <div class="col-lg-7">
            <div class="col-sm-12 col-12 bg-lightWhite200 d-sm-flex pl-4 pt-5 pb-5 pr-4">
                <div class="col-md-4 col-12 text-center">
                    <div id="img-cusThumbnail-3" class="img-cusThumbnail" style="background: url('https://ineted.org/inetadmin/public/images/home/student/{{ $home->student_img }}') no-repeat; background-size: cover;"></div>

                    <h5 class="mt-0 font-familyAtlasGrotesk-Medium text-colorblue100 mt-3">
                    <span class="font-size14px mt-3 align-self-center col-sm-12">{!! $home->student_name !!}</span><br/> <span class="badge badge-secondary font-familyFreightTextProMedium-Italic font-size13px pl-3 pr-3 pt-2 ml-2 pb-2">Student</span></h5>
                </div>
                <div class="col-md-8 col-12 p-0">
                        <img src="{{asset('images/admin/Asset113.png')}}" class="position-absolute quote-img">
                    <p class="font-familyFreightTextProLight-Regular text-black pl-4 pt-5">
                        {!! $home->student_sub_heading !!} </p>

                </div>
                </div>
        </div>

        <div class="col-lg-5 col-lg-5 pt-5 pb-5 text-right">
            <h4 class="font-familyAtlasGrotesk-Bold text-black">{!! $home->student2_heading !!}</h4>
            <p class="font-familyFreightTextProLight-Regular text-colorblue200 pb-2">{!! $home->student2_sub_heading !!}</p>

            <a href="{{ route('register') }}" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px p-0 border-radius0px btnBotmBar">
                <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">Create Account <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                <div class="btn-bar"></div>
            </a>
            <a href="{{ route('infoStudent') }}" class="btn btn-customBtn3 text-colorMahroon700 font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar ml-3 ">
                <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">Learn More <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                <div class="btn-bar"></div>
            </a>

        </div>

      </div>
  </div>
</section>


<section class="p-0 pb-5">
    <div class="container">
          <div class="row">
          <div class="col-lg-5 col-lg-5 pt-5 pb-5">
              <h4 class="font-familyAtlasGrotesk-Bold text-black">{!! $home->public_heading !!}</h4>
              <p class="font-familyFreightTextProLight-Regular text-colorblue200 pb-2">{!! $home->public_sub_heading !!}</p>

              <a href="{{ route('register') }}" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px p-0 border-radius0px btnBotmBar">
                  <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">Create Account <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                  <div class="btn-bar"></div>
              </a>
              <a href="{{ route('abouts') }}" class="btn btn-customBtn3 text-colorMahroon700 font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar ml-3 ">
                  <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">Learn More <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                  <div class="btn-bar"></div>
              </a>
          </div>

          <div class="col-lg-7 pr-0 pl-sm-4 pl-0">
            <div class="col-sm-12 col-12 bg-lightWhite200 d-sm-flex pl-4 pt-5 pb-5 pr-4">
                  <div class="col-md-4 col-12 text-center">
                    <div id="img-cusThumbnail-4" class="img-cusThumbnail" style="background: url('https://ineted.org/inetadmin/public/images/home/public/{{ $home->public_img }}') no-repeat; background-size: cover;"></div>
                    <h5 class="mt-0 font-familyAtlasGrotesk-Medium text-colorblue100 mt-3">
                      <span class="font-size14px mt-3 align-self-center col-sm-12">{!! $home->public_name !!}</span><br/> <span class="badge badge-secondary font-familyFreightTextProMedium-Italic font-size13px pl-3 pr-3 pt-2 ml-2 pb-2">Public</span></h5>
                  </div>
                  <div class="col-md-8 col-12 p-0">
                        <img src="{{asset('images/admin/Asset113.png')}}" class="position-absolute quote-img">
                    <p class="font-familyFreightTextProLight-Regular text-black pl-4 pt-5">
                        {!! $home->public2_sub_heading !!} </p>

                  </div>
                </div>
            </div>

        </div>
    </div>
  </section>


  <div class="container pb-4 pt-5">
    <div class="row">
        <div class="col-lg-12 what-our-community text-center">
            <h2> {!! $home->what_is !!} </h2>
            <p> {!! $home->what_is_text !!}  </p>
           <a href="/inetEDPlatform/discussionBoard" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px mt-2 p-0 border-radius0px btnBotmBar">
              <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">Click Here <i class="fas fa-angle-right ml-3 text-colorMahroon100">
                </i></span>
              <div class="btn-bar"></div>
           </a>
        </div>
    </div>
  </div>

  <section class="pt-4 pb-5">
    <div class="container">
      <div class="row">
          <div class="col-sm-6 text-center pr-sm-3 mt-5">
              <div class="col-sm-12 bg-lightWhite p-4">
                <img src="{{asset('images/mission-asset.png')}}" class="img-fluid mt-minus-3" style="width: 129px;">
                <h3 class="mt-3 font-familyAtlasGrotesk-Bold"><strong> {!! $home->home_mission_heading !!} </strong></h3>
                <p class="font-familyFreightTextProLight-Regular text-colorblue200">{!! $home->home_mission_sub_heading !!}</p>
            </div>
          </div>
          <div class="col-sm-6 text-center pl-sm-3 mt-5">
                  <div class="col-sm-12 bg-lightWhite p-4">
                    <img src="{{asset('images/vision-asset.png')}}" class="img-fluid mt-minus-3" style="width: 129px;">
                    <h3 class="mt-3 font-familyAtlasGrotesk-Bold"><strong>{!! $home->home_vission_heading !!}</strong></h3>
                    <p class="font-familyFreightTextProLight-Regular text-colorblue200"> {!! $home->home_vission_sub_heading !!} </p>
                </div>
          </div>
          @endforeach
      </div>
    </div>
  </section>






   @include('include.footer')
@endsection

@section('style')
    <style>
        body{background-color: #fff !important;}
        .img-cusThumbnail {
        width: 7em;
        height: 7em;
        overflow: hidden;
        border-radius: 100%;
        margin: auto;
        }
    </style>
@endsection
