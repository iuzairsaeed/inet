@extends('layouts.app')


@section('title') INET ED Platform @endsection

@section('content')
   @include('include.header')


    <div class="container-fluid bg-lightWhite200 pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h6 class="font-familyAtlasGroteskWeb-Regular mb-4 breadcumb-text"><span class="text-colorMahroon700">Home</span> <i class="fas fa-angle-right ml-3 mr-3 text-colorMahroon100"></i> <span class="text-colorMahroon600">Student</span></h6>
                    <h2 class="font-familyAtlasGroteskWeb-Bold text-black">Information for Students</h2>
                    <p class="text-grey  font-familyFreightTextProLight-Regular">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris commodo consequat.</p>
                </div>
            </div>
        </div>
    </div>



    <div class="container-fluid pt-6 pb-6">
        <div class="container">
            <div class="row">
                  <div class="col-sm-7 text-community-box mt-6">
                      <h1 class="font-bold">What does our community offer?</h1>
                      <p class="font-familyFreightTextProLight-Regular text-grey">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod temp inc ididunt ut labore et dolore magna. Ut enim ad minim
                      veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                      commodo consequat </p>
                  </div>
                  <div class="col-sm-5 page-small-banner text-left p-0">
                      <span class="back-box"></span>
                      <img src="{{asset('images/student-image.jpeg')}}" class="img-fluid">
                  </div>
              </div>
        </div>
    </div>


<div class="container-fluid p-0 pb-5">
  <div class="container">


        <div class="row rowbox">

        <div class="col-lg-7 pr-5">
            <div class="col-sm-12 greybox pt-3 pb-6 d-sm-flex">
                <div class="col-md-3 text-center">
                   <div class="readmore-img"><img src="{{ asset('images/icons/img2.png')}}"></div>
                   <div class="readmore-name">Donnie Montana</div>
                   <div class="readmore-profession">Public</div>
                </div>
                <div class="col-md-8 p-0">
                    <p class="profilebox-text font-familyFreightTextProLight-Regular">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                        temp inc ididunt ut labore et dolore magna. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat xercit.</p>

                </div>
            </div>

        </div>

        <div class="col-lg-5 col-lg-5 pt-5 pb-5 text-right">
            <h3 class="font-familyAtlasGroteskWeb-Bold howserve">How to get plugged in?</h3>
            <p class="howserve-text text-right font-familyFreightTextProLight-Regular">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                temp inc ididunt ut labore et dolore magna. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat xercit.</p>
            <div class="ready-text">I’m ready to:</div>
            <a href="" class="create-btn mt-0">Create Account <span class="btn-img"><img src="{{ asset('images/admin/Asset117.png')}}" ></span></a>
          

        </div>
    </div>
   
    <div class="row rowbox  mt-5 mb-5">
        <div class="col-lg-5 col-lg-5 pt-5 pb-5">
            <h3 class="font-familyAtlasGroteskWeb-Bold howserve">How to connect with the community?</h3>
            <p class="howserve-text font-familyFreightTextProLight-Regular">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                temp inc ididunt ut labore et dolore magna. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat xercit.</p>
                <div class="ready-text">Read Discussion Boards:</div>
            <button class="create-btn">Click here<span class="btn-img"><img src="{{ asset('images/admin/Asset117.png')}}" ></span></button>
            

        </div>
        <div class="col-lg-7 pl-5">
            <div class="col-sm-12 greybox pt-3 pb-6 d-sm-flex">
                <div class="col-md-3 text-center">
                   <div class="readmore-img"><img src="{{ asset('images/icons/img3.png')}}"></div>
                   <div class="readmore-name">Jerry Smith</div>
                   <div class="readmore-profession">Teacher</div>
                </div>
                <div class="col-md-8 p-0">
                    <p class="profilebox-text font-familyFreightTextProLight-Regular">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                        temp inc ididunt ut labore et dolore magna. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat xercit.</p>

                </div>
            </div>

        </div>
    </div>



    <div class="row rowbox">
        <div class="col-lg-5 col-lg-5 pt-5 pb-5">
            <h3 class="font-familyAtlasGroteskWeb-Bold howserve">How you grow the community? </h3>
            <p class="howserve-text font-familyFreightTextProLight-Regular">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                temp inc ididunt ut labore et dolore magna. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat xercit.</p>
                <div class="ready-text"> Link to YSI:</div>
            <a href="" class="create-btn">Click Here <span class="btn-img"><img src="{{ asset('images/admin/Asset117.png')}}" ></span></a>
           
        </div>
        <div class="col-lg-7 pl-5">
            <div class="col-sm-12 greybox pt-3 pb-6 d-sm-flex">
                <div class="col-md-3 text-center">
                   <div class="readmore-img"><img src="{{ asset('images/icons/img1.png')}}"></div>
                   <div class="readmore-name">Morty Maxel</div>
                   <div class="readmore-profession">Student</div>
                </div>
                <div class="col-md-8 p-0">
                    <p class="profilebox-text font-familyFreightTextProLight-Regular">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                        temp inc ididunt ut labore et dolore magna. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat xercit.</p>

                </div>
            </div>

        </div>
    </div>

 </div>

</div>


<div class="container">

      <div class="row pl-3 pr-3 pb-7 text-center">
          <div class="col-lg-12 what-our-community">
              <h2>I’m Ready To Explore</h2>
              <p>Join or read one of our many community wide discussion boards here.</p>
              <button class="create-btn">CLICK HERE <span class="btn-img"><img src="{{ asset('images/admin/Asset117.png')}}" ></span></button>
          </div>
      </div>
</div>





   @include('include.footer')
@endsection
