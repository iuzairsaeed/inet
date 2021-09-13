@extends('layouts.app') @section('title') INET ED Platform :: Verify Your Email @endsection @section('content') @include('include.header')

<section class="pt-5 pb-5">
    <div class="container">
        <div class="row no-gutters justify-content-center">
            <div class="col-md-4 d-flex bg-leftPanel">
                <div class="col-md-12 text-white font-familyFreightTextProLight-Regular p-5 font-size14px d-flex flex-column">
                    <h3 class="font-familyAtlasGroteskWeb-Bold mb-3">Verify your email address to sign up</h3>

                    <p>You'll need to verify your email address to complete registration.</p>

                    <p class="mt-auto mb-0">By signing up for INET ED, you agree to our
                        <a href="{{ route('termsConditions') }}" class="text-white"><span class="font-familyFreightTextProMedium-Italic">Terms of Service</span></a>,
                        <a href="{{ route('privacyPolicy') }}" class="text-white"><span class="font-familyFreightTextProMedium-Italic">Privacy Policy</span></a> and
                        <a href="{{ route('coummunity') }}" class="text-white"><span class="font-familyFreightTextProMedium-Italic">Community Guidelines</span></a>
                    </p>
                </div>
            </div>
            <div class="col-md-6 bg-white box-shadow p-5 font-familyAtlasGroteskWeb-Regular font-size14px height45em">
                <h3 class="font-familyAtlasGroteskWeb-Bold mb-4">Verify Your Email</h3>
                <img src="{{ asset('images/icons/emialIcon.png') }}" alt="" width="140">
                <p class="text-colorblue200 mt-4">An email has been sent to {{ Auth::user()->email }} with a link to verify your account. If you haven't received the email after a few minutes, please check your spam folder.</p>

                @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
                @endif

                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar ">
                            <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">RESEND EMAIL <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                            <div class="btn-bar"></div>
                        </button>

                    <button type="button" class="btn btn-customBtn3 text-colorMahroon700 font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar ml-3 ">
                        <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">LOGIN <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                        <div class="btn-bar"></div>
                    </button>
                </form>

                {{--<button type="button" class="btn btn-customBtn3 text-colorMahroon700 font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar ml-3 ">
                        <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">LOGIN <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                        <div class="btn-bar"></div>
                    </button>--}}
            </div>
        </div>
    </div>
</section>

@include('include.footer') @endsection
