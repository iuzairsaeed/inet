@extends('layouts.app') @section('title') INET ED Platform :: Approve Account @endsection @section('content') @include('include.header')

<section class="pt-5 pb-5">
    <div class="container">
        <div class="row no-gutters justify-content-center">
            <div class="col-md-4 d-flex bg-leftPanel">
                <div class="col-md-12 text-white font-familyFreightTextProLight-Regular p-5 font-size14px d-flex flex-column">
                    <h3 class="font-familyAtlasGroteskWeb-Bold mb-3">Approve Account Pending</h3>

                    <p>Admin will review your application and approve your account.</p>

                    <p class="mt-auto mb-0">By signing up for INET ED, you agree to our
                        <a href="{{ route('termsConditions') }}" class="text-white"><span class="font-familyFreightTextProMedium-Italic">Terms of Service</span></a>,
                        <a href="{{ route('privacyPolicy') }}" class="text-white"><span class="font-familyFreightTextProMedium-Italic">Privacy Policy</span></a> and
                        <a href="{{ route('coummunity') }}" class="text-white"><span class="font-familyFreightTextProMedium-Italic">Community Guidelines</span></a>
                    </p>
                </div>
            </div>
            <div class="col-md-6 bg-white box-shadow p-5 font-familyAtlasGroteskWeb-Regular font-size14px height45em">
                <h3 class="font-familyAtlasGroteskWeb-Bold mb-4">ACCOUNT PENDING: Your account is currently not active. An administrator needs to
                    activate your account before you can login.</h3>
            </div>
        </div>
    </div>
</section>

@include('include.footer') @endsection
