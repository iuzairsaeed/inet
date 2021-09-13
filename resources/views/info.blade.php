@extends('layouts.app')


@section('title') INET ED Platform @endsection

@section('content')
   @include('include.header')


       <header class="bg-lightWhite200 pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h6 class="font-familyAtlasGroteskWeb-Regular mb-4"><span class="text-colorMahroon700">Home</span> <i class="fas fa-angle-right ml-3 mr-3 text-colorMahroon100"></i> <span class="text-colorMahroon600">Student</span></h6>
                    <h2 class="font-familyAtlasGroteskWeb-Bold text-black">Information for Student</h2>
                    <p class="font-familyAtlasGroteskWeb-Light text-colorblue200">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris commodo consequat.</p>
                </div>
            </div>
        </div>
    </header>



   <section class="pt-5 pb-4">
      <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 pr-sm-4 pt-3">
              <div class="col-sm-12 p-0 pt-5 pb-4 mb-4">
              <h2 class="text-black font-familyAtlasGroteskWeb-Bold">What does our community offer?</h2>
              <p class="font-familyAtlasGroteskWeb-Light text-colorblue200">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
            eiusmod temp inc ididunt ut labore et dolore magna. Ut enim ad minim
            veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
            commodo consequat.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
            eiusmod temp inc ididunt ut labore et dolore magna.</p>
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
                   <img src="{{ asset('images/icons/img2.png')}}" class="img-fluid img-cirlce" style="width: 105px;">
                   <h5 class="mt-0 font-familyAtlasGrotesk-Medium text-colorblue100 mt-3">
                    <span class="font-size14px mt-3 align-self-center col-sm-12">Donnie Montana</span><br/> <span class="badge badge-secondary font-familyFreightTextProMedium-Italic font-size13px pl-3 pr-3 pt-2 ml-2 pb-2">Public</span></h5>
                </div>
                <div class="col-md-8 col-12 p-0">
                      <img src="{{asset('images/admin/Asset113.png')}}" class="position-absolute quote-img">
                  <p class="font-familyFreightTextProLight-Regular text-black pl-4 pt-5">
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                        temp inc ididunt ut labore et dolore magna. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat xercit. </p>

                </div>
              </div>
          </div>

        <div class="col-lg-5 col-lg-5 pt-4 pb-5 text-right">
            <h3 class="font-familyAtlasGroteskWeb-Bold text-lightgrey">How We get plugged in?</h3>
            <p class="font-familyFreightTextProLight-Regular text-colorblue200 pb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod temp inc ididunt ut labore et dolore magna. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat xercit.</p>

            <button type="button" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px p-0 border-radius0px btnBotmBar" data-toggle="modal" data-target="#moadalEditProfile">
                        <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">Create Account <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                        <div class="btn-bar"></div>
                    </button>
   

        </div>
    
      </div>
  </div>
</section>




    <section class="p-0 pb-5">
  <div class="container">
        <div class="row">


        <div class="col-lg-5 col-lg-5 pt-5 pb-5">
            <h3 class="font-familyAtlasGroteskWeb-Bold text-lightgrey">How to connect with the community?</h3>
            <p class="font-familyFreightTextProLight-Regular text-colorblue200 pb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod temp inc ididunt ut labore et dolore magna. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat xercit.</p>

            <button type="button" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px p-0 border-radius0px btnBotmBar" data-toggle="modal" data-target="#moadalEditProfile">
                        <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">Click Here <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                        <div class="btn-bar"></div>
                    </button>

        </div>
        <div class="col-lg-7 pr-0 pl-sm-4 pl-0">
          <div class="col-sm-12 col-12 bg-lightWhite200 d-sm-flex pl-4 pt-5 pb-5 pr-4">
                <div class="col-md-4 col-12 text-center">
                   <img src="{{ asset('images/icons/img3.png')}}" class="img-fluid img-cirlce" style="width: 105px;">
                   <h5 class="mt-0 font-familyAtlasGrotesk-Medium text-colorblue100 mt-3">
                    <span class="font-size14px mt-3 align-self-center col-sm-12">Laura Dan</span><br/> <span class="badge badge-secondary font-familyFreightTextProMedium-Italic font-size13px pl-3 pr-3 pt-2 ml-2 pb-2">Teacher</span></h5>
                </div>
                <div class="col-md-8 col-12 p-0">
                      <img src="{{asset('images/admin/Asset113.png')}}" class="position-absolute quote-img">
                  <p class="font-familyFreightTextProLight-Regular text-black pl-4 pt-5">
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                        temp inc ididunt ut labore et dolore magna. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat xercit. </p>

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
                   <img src="{{ asset('images/icons/img2.png')}}" class="img-fluid img-cirlce" style="width: 105px;">
                   <h5 class="mt-0 font-familyAtlasGrotesk-Medium text-colorblue100 mt-3">
                    <span class="font-size14px mt-3 align-self-center col-sm-12">Donnie Montana</span><br/> <span class="badge badge-secondary font-familyFreightTextProMedium-Italic font-size13px pl-3 pr-3 pt-2 ml-2 pb-2">Public</span></h5>
                </div>
                <div class="col-md-8 col-12 p-0">
                      <img src="{{asset('images/admin/Asset113.png')}}" class="position-absolute quote-img">
                  <p class="font-familyFreightTextProLight-Regular text-black pl-4 pt-5">
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                        temp inc ididunt ut labore et dolore magna. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat xercit. </p>

                </div>
              </div>
          </div>

         <div class="col-lg-5 col-lg-5 pt-5 pb-5 text-right">
            <h3 class="font-familyAtlasGroteskWeb-Bold text-lightgrey">How you grow the community?</h3>
            <p class="font-familyFreightTextProLight-Regular text-colorblue200 pb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod temp inc ididunt ut labore et dolore magna. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat xercit.</p>

            <button type="button" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px p-0 border-radius0px btnBotmBar" data-toggle="modal" data-target="#moadalEditProfile">
                        <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">Create Account <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                        <div class="btn-bar"></div>
                    </button>
            <button type="button" class="btn btn-customBtn3 text-colorMahroon700 font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar ml-3 ">
                        <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">Learn More <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                        <div class="btn-bar"></div>
                    </button>

        </div>
      
      </div>
  </div>
</section>




   <div class="container pb-5 pt-4">
    <div class="row">
        <div class="col-lg-12 what-our-community text-center">
            <h2>Hear What Our Community Is Talking About</h2>
            <p>Join or read one of our many community wide discussion boards here.</p>
           <button type="button" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px mt-2 p-0 border-radius0px btnBotmBar" data-toggle="modal" data-target="#moadalEditProfile">
                        <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">Click Here <i class="fas fa-angle-right ml-3 text-colorMahroon100">
                          
                        </i></span>
                        <div class="btn-bar"></div>
                    </button>
        </div>
    </div>
  </div>






   @include('include.footer')
@endsection

@section('style')
    <style>
        body{background-color: #fff !important;}
    </style>
@endsection
