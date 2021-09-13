 @extends('layouts.app') @section('title') INET ED Platform :: LogIn @endsection @section('content') @include('include.header')
<style>
    .invalid-feedback {
        display: block;
    }
</style>
<section class="pt-5 pb-5">
    <div class="container">
        <div class="row no-gutters justify-content-center">
            <div class="col-md-4 d-flex bg-leftPanel">
                <div class="col-md-12 text-white font-familyFreightTextProLight-Regular p-5 font-size14px d-flex flex-column">
                    <h3 class="font-familyAtlasGroteskWeb-Bold mb-3">Welcome back!</h3>
                    <p>Remember to update your profile to help community members find you.</p>

                    <p class="mt-auto mb-0">By signing up for INET ED, you agree to our
                        <a href="{{ route('termsConditions') }}" class="text-white"><span class="font-familyFreightTextProMedium-Italic">Terms of Service</span></a>,
                        <a href="privacyPolicy" class="text-white"><span class="font-familyFreightTextProMedium-Italic">Privacy Policy</span></a> and
                        <a href="{{ route('coummunity') }}" class="text-white"><span class="font-familyFreightTextProMedium-Italic">Community Guidelines</span></a>
                    </p>

                </div>
            </div>
            <div class="col-md-6 bg-white box-shadow p-5 font-familyFreightTextProLight-Regular font-size14px height45em">
                <h3 class="font-familyAtlasGroteskWeb-Bold mb-3">Login</h3>
                <form class="textHover" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="field">
                        <input type="text" id="email" name="email" class="field-input @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        <label for="email" class="field-label">Email</label>
                    </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span> @enderror
                    <div class="field">
                        <input type="password" id="password" name="password" class="field-input @error('password') is-invalid @enderror" required autocomplete="current-password">
                        <label for="password" class="field-label">Password</label>
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span> @enderror
                    <div class="form-group mt-3">
                        <a href="/inetEDPlatform/password/reset" class="font-familyAtlasGroteskWeb-Regular text-colorMahroon700">Forgot Password?</a>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar">
                            <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">LOG IN <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                            <div class="btn-bar"></div>
                        </button>
                    </div>
                    <div class="form-group">
                        <p class="text-black font-familyAtlasGroteskWeb-Light">Don’t have an Account? <a href="{{ route('register') }}" class="font-familyAtlasGroteskWeb-Regular text-colorMahroon700 mt-4">Sign Up</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@include('include.footer') @endsection
