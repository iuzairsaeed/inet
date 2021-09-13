@extends('layouts.app')


@section('title') INET ED Platform :: Contacts @endsection

@section('content')
    @include('include.header')

    <header class="bg-lightWhite200 pt-5 pb-5">
        <div class="container">
            <div class="row">
                @foreach ($contact_text as $item)
                <div class="col-md-12">
                    <h6 class="font-familyAtlasGroteskWeb-Regular mb-4"><span class="text-colorMahroon700">Home</span> <i class="fas fa-angle-right ml-3 mr-3 text-colorMahroon100"></i> <span class="text-colorMahroon600">Contact Us</span></h6>
                    <h2 class="font-familyAtlasGroteskWeb-Bold text-black">{!! $item->heading !!} </h2>
                    <p class="font-familyAtlasGroteskWeb-Light text-colorblue200">{!! $item->sub_heading !!}</p>
                </div>
                @endforeach
            </div>
        </div>
    </header>
    <section class="bg-white pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="font-familyAtlasGrotesk-Medium text-darkBlue mb-3">Send Us A Message</h4>
                    <form method="POST" action="{{ route('contact_us') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue font-size14px border-radius0all @error('fullName') is-invalid @enderror" id="fullName" name="fullName" placeholder="Full Name" value="{{ old('fullName') }}" required>
                            @error('fullName')
                                <small style="color:red">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue font-size14px border-radius0all @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                            @error('email')
                                <small style="color:red">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- <div class="form-group">
                            <input type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue font-size14px border-radius0all @error('topic') is-invalid @enderror" id="topic" name="topic" placeholder="Topic" value="{{ old('topic') }}" required>
                            @error('topic')
                                <small style="color:red">{{ $message }}</small>
                            @enderror
                        </div> --}}

                        <div class="form-group">
                            <input type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue font-size14px border-radius0all @error('subject') is-invalid @enderror" id="subject" name="subject" placeholder="Subject" value="{{ old('subject') }}" required>
                            @error('subject')
                                <small style="color:red">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <textarea class="form-control font-familyFreightTextProLight-Regular text-darkBlue font-size14px border-radius0all @error('message') is-invalid @enderror" id="message" name="message" placeholder="Message" rows="6" cols="60" required>{{ old('message') }}</textarea>
                            @error('message')
                                <small style="color:red">{{ $message }}</small>
                            @enderror
                        </div>

                        @if(session()->has('success'))
                            <small style="color:green; float: left">{{ session()->get('success') }}</small>
                        @endif

                        @if(session()->has('failed'))
                            <small style="color:red; float: left">{{ session()->get('failed') }}</small>
                        @endif


                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px p-0 border-radius0px btnBotmBar">
                                <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">SEND <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                                <div class="btn-bar"></div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @include('include.footer')

@endsection

