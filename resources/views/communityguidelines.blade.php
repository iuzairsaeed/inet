@extends('layouts.app')


@section('title') INET ED Platform :: News & Media Mentions @endsection

@section('content')
    @include('include.header')
    <section class="bg-white pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8  font-size14px">
                    {!! $cm->community_text !!}

                </div>

                <div class="col-md-4">
                    <div class="col-md-12 border-bottomCus p-0">
                        <h5 class="font-familyAtlasGroteskWeb-Bold text-black">Contact Information</h5>
                    </div>
                    <div class="mt-2 font-familyAtlasGroteskWeb-Light text-colorblue100">
                        <p class="mb-0">Institute for New Economic Thinking</p>
                        <p class="mb-0">300 Park Avenue South, Floor 5</p>
                        <p class="mb-0">New York, NY 10010</p>
                        <p class="mb-0">(646) 751-4900</p>
                        <p class=""><span class="">Email your queries to </span> <a  href="mailto: ineted@ineteconomics.org" class="font-familyAtlasGrotesk-Medium">ineted@ineteconomics.org</a></p>
                        <a href="{{ route('contact') }}" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar">
                            <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">Email Us<i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                            <div class="btn-bar"></div>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    @include('include.footer')

@endsection

