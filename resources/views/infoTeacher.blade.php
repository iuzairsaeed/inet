@extends('layouts.app')


@section('title') INET ED Platform @endsection

@section('content')
   @include('include.header')


       <header class="bg-lightWhite200 pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h6 class="font-familyAtlasGroteskWeb-Regular mb-4"><span class="text-colorMahroon700">Home</span> <i class="fas fa-angle-right ml-3 mr-3 text-colorMahroon100"></i> <span class="text-colorMahroon600">Teacher</span></h6>
                    <h2 class="font-familyAtlasGroteskWeb-Bold text-black"> {!! $st->info_for_students !!}</h2>
                    <p class="font-familyAtlasGroteskWeb-Light text-colorblue200">{!! $st->info_for_students_text !!} </p>
                </div>
            </div>
        </div>
    </header>



   <section class="pt-5 pb-4">
      <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 pr-sm-4 pt-3">
              <div class="col-sm-12 p-0 pt-5 pb-4 mb-4">
              <h2 class="text-black font-familyAtlasGrotesk-Bold"> {!! $st->community_offer !!}</h2>
              <p class="font-familyAtlasGroteskWeb-Light text-colorblue200">
                 {!! $st->community_offer_text !!}</p>
          </div>
            </div>

            <div class="col-lg-6 col-md-12 pl-5 pr-5 position-relative mb-4">
              <span class="position-absolute rectangle-box bg-black" style="z-index:0;right: 14px;bottom: -36px;"></span>
              <img src="{{asset('images/student-image.jpeg')}}" class="img-fluid position-relative">
            </div>
        </div>
      </div>
    </section>





    <section class="pt-5 pb-5">
  <div class="container">
        <div class="row">

          <div class="col-lg-7 pl-0 pr-sm-4 pr-0">
          <div class="col-sm-12 col-12 bg-lightWhite200 d-sm-flex pl-4 pt-5 pb-5 pr-4">
                <div class="col-md-4 col-12 text-center">
                  <div id="img-cusThumbnail-1" name="img-cusThumbnail-1" class="img-cusThumbnail" style="background: url(https://ineted.org/inetadmin/public/{{$st->user_image}}) no-repeat; background-size: cover; background-repeat: no-repeat;">

                            </div>

                   <h5 class="mt-0 font-familyAtlasGrotesk-Medium text-colorblue100 mt-3">
                    <span class="font-size14px mt-3 align-self-center col-sm-12">{!! $st->user_name !!}</span><br/> <span class="badge badge-secondary font-familyFreightTextProMedium-Italic font-size13px pl-3 pr-3 pt-2 ml-2 pb-2">Public</span></h5>
                </div>
                <div class="col-md-8 col-12 p-0">
                      <img src="{{asset('images/admin/Asset113.png')}}" class="position-absolute quote-img">
                  <p class="font-familyFreightTextProLight-Regular text-black pl-4 pt-5">
                      {!! $st->user_desc !!} </p>

                </div>
              </div>
          </div>

        <div class="col-lg-5 col-lg-5 pt-4 pb-5 text-right">
            <h3 class="font-familyAtlasGrotesk-Bold text-lightgrey"> {!! $st->plug !!}</h3>
            <p class="font-familyFreightTextProLight-Regular text-colorblue200 pb-2">  {!! $st->plug_text !!} </p>

            <a href="{{ route('register') }}" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px p-0 border-radius0px btnBotmBar">
                <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">Create Account <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
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
            <h3 class="font-familyAtlasGrotesk-Bold text-lightgrey"> {!! $st->connect_community !!}</h3>
            <p class="font-familyFreightTextProLight-Regular text-colorblue200 pb-2"> {!! $st->connect_community_text !!}</p>

           <!-- <a href="{{ route('register') }}" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px p-0 border-radius0px btnBotmBar">
                <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">Create Account <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                <div class="btn-bar"></div>
            </a> -->

        </div>
        <div class="col-lg-7 pr-0 pl-sm-4 pl-0">
          <div class="col-sm-12 col-12 bg-lightWhite200 d-sm-flex pl-4 pt-5 pb-5 pr-4">
                <div class="col-md-4 col-12 text-center">
                  <div id="img-cusThumbnail-2" name="img-cusThumbnail-2" class="img-cusThumbnail" style="background: url(https://ineted.org/inetadmin/public/{{ $st->teacher_image}}) no-repeat; background-size: cover; background-repeat: no-repeat;"></div>
                   <h5 class="mt-0 font-familyAtlasGrotesk-Medium text-colorblue100 mt-3">
                    <span class="font-size14px mt-3 align-self-center col-sm-12">  {!! $st->teacher_name !!}</span><br/> <span class="badge badge-secondary font-familyFreightTextProMedium-Italic font-size13px pl-3 pr-3 pt-2 ml-2 pb-2">Teacher</span></h5>
                </div>
                <div class="col-md-8 col-12 p-0">
                      <img src="{{asset('images/admin/Asset113.png')}}" class="position-absolute quote-img">
                  <p class="font-familyFreightTextProLight-Regular text-black pl-4 pt-5">
                       {!! $st->teacher_desc !!} </p>

                </div>
              </div>
          </div>
      </div>
  </div>
</section>




<section class="p-0 pb-5">
  <div class="container">
        <div class="row">


           <div class="col-lg-7 pl-0 pr-sm-4 pr-0">
          <div class="col-sm-12 col-12 bg-lightWhite200 d-sm-flex pl-4 pt-5 pb-5 pr-4">
                <div class="col-md-4 col-12 text-center">
                   <div id="img-cusThumbnail-2" name="img-cusThumbnail-2" class="img-cusThumbnail" style="background: url(https://ineted.org/inetadmin/public/{{$st->user_teacher_2_image}}) no-repeat; background-size: cover; background-repeat: no-repeat;"></div>
                   <h5 class="mt-0 font-familyAtlasGrotesk-Medium text-colorblue100 mt-3">
                    <span class="font-size14px mt-3 align-self-center col-sm-12">{!! $st->user_teacher_2_name !!}</span><br/> <span class="badge badge-secondary font-familyFreightTextProMedium-Italic font-size13px pl-3 pr-3 pt-2 ml-2 pb-2">Public</span></h5>
                </div>
                <div class="col-md-8 col-12 p-0">
                      <img src="{{asset('images/admin/Asset113.png')}}" class="position-absolute quote-img">
                  <p class="font-familyFreightTextProLight-Regular text-black pl-4 pt-5">
                      {!! $st->user_teacher_2_desc !!}</p>

                </div>
              </div>
          </div>

         <div class="col-lg-5 col-lg-5 pt-5 pb-5 text-right">
            <h3 class="font-familyAtlasGrotesk-Bold text-lightgrey"> {!! $st->grow_community !!}</h3>
            <p class="font-familyFreightTextProLight-Regular text-colorblue200 pb-2">  {!! $st->grow_community_text !!}</p>

            <!-- <a href="{{ route('register') }}" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px p-0 border-radius0px btnBotmBar">
                 <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">Create Account <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                 <div class="btn-bar"></div>
             </a>-->
             <a href="{{ route('abouts') }}" class="btn btn-customBtn3 text-colorMahroon700 font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar ml-3 ">
                 <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">Learn More <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                 <div class="btn-bar"></div>
             </a>

        </div>

      </div>
  </div>
</section>




   <div class="container pb-5 pt-4">
    <div class="row">
        <div class="col-lg-12 what-our-community text-center">
            <h2> {!! $st->explore !!}</h2>
            <p>{!! $st->explore_content !!}</p>
           {{-- <a href="{{ route('searchCourses') }}" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px mt-2 p-0 border-radius0px btnBotmBar" data-toggle="modal" data-target="#moadalEditProfile">
                        <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">Click Here <i class="fas fa-angle-right ml-3 text-colorMahroon100">

                        </i></span>
                        <div class="btn-bar"></div>
         </a> --}}

         <a href="/inetEDPlatform/search/courses" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px mt-2 p-0 border-radius0px btnBotmBar">
            <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">Click Here <i class="fas fa-angle-right ml-3 text-colorMahroon100">

            </i></span>
            <div class="btn-bar"></div>
        </a>
        </div>
    </div>
  </div>






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
    </style>
    </style>
@endsection
