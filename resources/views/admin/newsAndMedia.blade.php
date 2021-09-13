@extends('layouts.app')


@section('title') INET ED Platform :: News & Media Mentions @endsection

@section('content')
    @include('include.header')

    <header class="bg-lightWhite200 pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @foreach ($news_text as $new)
                    <h6 class="font-familyAtlasGroteskWeb-Regular mb-4"><span class="text-colorMahroon700">Home</span> <i class="fas fa-angle-right ml-3 mr-3 text-colorMahroon100"></i> <span class="text-colorMahroon600">News</span></h6>
                    <h2 class="font-familyAtlasGroteskWeb-Bold text-black">{!! $new->heading!!}</h2>
                    <p class="font-familyAtlasGroteskWeb-Light text-colorblue200">{!! $new->sub_heading!!}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </header>
    <section class="bg-white pt-5 pb-5">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-6">
                    @foreach ($newsPost as $item)
                    <div class="col-md-12 p-0 mb-4">
                        <h6 class="text-colorblue100 font-familyAtlasGrotesk-Medium mb-1">{!! $item->title !!}</h6>
                        <p class="font-size14px"><span class="font-familyFreightTextProBook-Regular text-colorblue200 opacity0point5">By</span> <span class="font-familyFreightTextProMedium-Italic text-colorblue100 mr-3">{!!
                            $item->name!!}</span> <span class="font-familyAtlasGrotesk-Regular opacity0point5 font-size12px">|  {!! date('d M, Y', strtotime($item->created_at)) !!}</span></p>
                        <div class="media border-bottom pb-3">

                            <img class="align-self-start mr-3 mt-1" src="{{ asset('images/icons/img4.png') }}" alt="placeholder image" width="80">
                            <div class="media-body font-familyFreightTextProLight-Regular text-colorblue200 font-size14px">
                                <p class="mb-0">{!! $item->body !!}</p>
                            </div>
                            <a class="align-self-center" href="{{ route('newssinglPg', $item->id) }}"><i class="fas fa-angle-right text-colorMahroon100 align-self-center ml-2"></i></a>

                        </div>
                    </div>
                    @endforeach

                </div>
                {{-- <div class="col-md-5">
                    <div class="row">
                        <div class="col-xl-8 col-lg-7 col-md-12 searchIcon2 d-flex mb-3 mb-lg-0 ">
                            <input type="text" class="form-control font-familyFreightTextProLight-Regular text-colorblue200 pr-5 font-size14px align-self-center" id="search" placeholder="Keyword search...">
                        </div>
                        <div class="col-xl-4 col-lg-5 col-md-12 text-right">
                            <button type="button" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px p-0 border-radius0px btnBotmBar">
                                <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">Search <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                                <div class="btn-bar"></div>
                            </button>
                        </div>

                        <div class="col-md-12 font-familyAtlasGroteskWeb-Medium font-size13px customDropDownInnerPg d-md-flex mt-4">
                           <label class="opacity0point5 mr-3 align-self-center mb-md-0 mb-2">Sort By</label>
                            <select class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue col-md-5 col-12 p-0">
                                <option value="">Relevance</option>
                                <option>item 1</option>
                                <option>item 2</option>
                                <option>item 3</option>
                            </select>
                        </div>
                    </div>
                </div> --}}


            </div>
        </div>
    </section>

    @include('include.footer')

@endsection

