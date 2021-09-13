@extends('layouts.app')


@section('title') INET ED Platform @endsection

@section('content')
   @include('include.header')

    <header class="bg-lightWhite200 pt-5 pb-5">
        <div class="container">
            <div class="row">
                @foreach ($about_text as $abt)
                <div class="col-md-12">
                    <h6 class="font-familyAtlasGroteskWeb-Regular mb-4"><span class="text-colorMahroon700">Home</span> <i class="fas fa-angle-right ml-3 mr-3 text-colorMahroon100"></i> <span class="text-colorMahroon600">About</span></h6>
                    <h2 class="font-familyAtlasGroteskWeb-Bold text-black">{!! $abt->heading !!}</h2>
                    <p class="font-familyAtlasGroteskWeb-Light text-colorblue200">{!! $abt->sub_heading !!}</p>
                </div>
            </div>
        </div>
    </header>



    <section class="pt-5 pb-4">
    	<div class="container">
    		<div class="row">
    				<div class="col-lg-6 col-md-12 pr-sm-5 pt-4">
    					<div class="col-sm-12 p-0 pt-5 pb-4 mb-4">
    					<h2 class="text-black font-familyAtlasGrotesk-Bold">{!! $abt->what_heading !!}</h2>
    					<p class="font-familyAtlasGroteskWeb-Light text-colorblue200">
                            {!! $abt->what_sub_heading !!}
                        </p>
					</div>
    				</div>

    				<div class="col-lg-6 col-md-12 pl-5 pr-5 position-relative mb-4">
    					<img src="{{asset('images/student-image.jpeg')}}" class="img-fluid position-relative">
    				</div>
    		</div>
    	</div>
    </section>


   <section class="pt-4 pb-5 mt-2">
  <div class="container">
    <div class="row">
        <div class="col-sm-6 text-center pr-sm-3 mt-5">
            <div class="col-sm-12 bg-lightWhite p-4">
              <img src="{{asset('images/mission-asset.png')}}" class="img-fluid mt-minus-3" style="width: 129px;">
              <h3 class="mt-3 font-familyAtlasGroteskWeb-Bold"><strong> {!! $abt->mission_heading !!} </strong></h3>
              <p class="font-familyFreightTextProLight-Regular text-colorblue200">{!! $abt->mission_sub_heading !!}</p>
          </div>
        </div>
        <div class="col-sm-6 text-center pl-sm-3 mt-5">
                <div class="col-sm-12 bg-lightWhite p-4">
                  <img src="{{asset('images/vision-asset.png')}}" class="img-fluid mt-minus-3" style="width: 129px;">
                  <h3 class="mt-3 font-familyAtlasGroteskWeb-Bold"><strong> {!! $abt->vision_heading !!} </strong></h3>
                  <p class="font-familyFreightTextProLight-Regular text-colorblue200">{!! $abt->vision_sub_heading !!}</p>
              </div>
        </div>
       
    </div>
  </div>
</section>



<div class="container pb-6 pt-4">
    <div class="row">
        <div class="col-lg-12 what-our-community text-center">
            <h2> {!! $abt->what_is !!}</h2>
            <p> {!! $abt->what_is_text !!}</p>
           {{-- <button type="button" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px mt-2 p-0 border-radius0px btnBotmBar" data-toggle="modal" data-target="#moadalEditProfile">
                        <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">Click Here <i class="fas fa-angle-right ml-3 text-colorMahroon100">

                        </i></span>
                        <div class="btn-bar"></div>
        </button> --}}
        <a href="/discussionBoard" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px mt-2 p-0 border-radius0px btnBotmBar">
            <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">Click Here <i class="fas fa-angle-right ml-3 text-colorMahroon100">

            </i></span>
            <div class="btn-bar"></div>
       </a>
        </div>
    </div>
  </div>

 @endforeach




   @include('include.footer')
@endsection
@section('style')
    <style>
        body{background-color: #fff !important;}
    </style>
@endsection
