@extends('layouts.app')


@section('title') INET ED Platform @endsection

@section('content')
    @include('include.header')

    <section class="pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12"></div>
                <div class="col-lg-3 col-md-4 mb-3 d-flex">
                    <div class="card">
                        <img class="card-img-top" src="{{ asset('images/icons/img1-1.png') }}" alt="image">
                        <div class="card-header bg-transparent border-0 pb-0 pt-2 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200">
                            <small class="float-left">2.4k Downloads</small>
                            <small class="float-right">3k Views</small>
                        </div>
                        <div class="card-body">
                            <p class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size14px mb-2">Introductory Level 1</p>
                            <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0">Microeconomics: The Truth About Prices</h6>
                            <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">Jerry Smith</small></p>
                        </div>
                        <div class="card-footer bg-transparent border-0">
                            <small class="float-left font-familyAtlasGroteskWeb-Medium text-colorblue100 mt-1">26m</small>
                            <div class="float-right m-0 text-colorblue100 d-flex bookmark">
                                <i class="fas fa-download mr-4"></i>
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="bookmark1">
                                    <label class="custom-control-label" for="bookmark1"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 mb-3 d-flex">
                    <div class="card">
                        <img class="card-img-top" src="..." alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        </div>
                        <div class="card-footer bg-transparent border-success">Footer</div>
                    </div>
                </div>


            </div>
        </div>
    </section>

    @include('include.footer')
@endsection
