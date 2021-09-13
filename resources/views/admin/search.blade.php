@extends('layouts.app')


@section('title') INET ED Platform :: Search @endsection

@section('content')
    @include('include.header')

    <section class="bg-white pt-3 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 pb-5">
                    <form class="textHover">
                        <div class="field">
                            <input type="text" id="email" name="email" class="field-input text-darkBlue" required>
                            <label for="email" class="field-label">Search</label>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 col-md-4 mb-3 d-flex">
                    <div class="card col-md-12 p-0 border-radius0px">
                        <div class="col text-center pb-4 pt-4">
                            <img src="{{ asset('images/icons/img1.png') }}" alt="" width="110">
                            <h5 class="mt-0 font-familyAtlasGrotesk-Medium text-colorblue100 mt-2">Laura Dan</h5>
                            <span class="badge badge-secondary font-familyFreightTextProMedium-Italic font-size13px pl-3 pr-3 pt-2 pb-2">Student</span>
                        </div>
                        <div class="card-footer bg-transparent border-top text-center font-familyAtlasGroteskWeb-Regular font-size12px d-flex p-0 text-center justify-content-between hoverBot">
                            <a class="pt-3 pb-3 border-right" href="#"><i class="far fa-user"></i> <span class="d-block">View Profile</span></a>
                            <a class="pt-3 pb-3" href="#"><i class="fas fa-people-arrows"></i> <span class="d-block">Make Contributor</span></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    @include('include.footer')

@endsection

