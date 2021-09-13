@extends('layouts.app')


@section('title') INET ED Platform :: FAQs @endsection

@section('content')
    @include('include.header')

    <header class="bg-lightWhite200 pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @foreach ($faqs_text as $faq)
                    <h6 class="font-familyAtlasGroteskWeb-Regular mb-4"><span class="text-colorMahroon700">Home</span> <i class="fas fa-angle-right ml-3 mr-3 text-colorMahroon100"></i> <span class="text-colorMahroon600">FAQs</span></h6>
                    <h2 class="font-familyAtlasGroteskWeb-Bold text-black">{!! $faq->heading !!}</h2>
                    <p class="font-familyAtlasGroteskWeb-Light text-colorblue200">{!! $faq->sub_heading !!}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </header>

    <section class="bg-white pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div id="accordion" class="font-familyFreightTextProLight-Regular text-colorblue200">
                    @foreach ($questions as $ques)



                        <div class="col-12 p-0 border-bottom mb-4">



                            <div class="mb-0 d-flex">
                                <a href="#" class="border-radius0all w-100 collapsed text-left p-0 pt-3 pb-3 font-familyAtlasGrotesk-Medium text-darkBlue {!! 'collapse'.$ques->id !!} text-decoration-none" data-toggle="collapse" data-target="{{ '#collapse'.$ques->id }}" aria-expanded="false" aria-controls="{{ 'collapse'.$ques->id }}">
                                    {!! $ques->question!!}
                                    <i class="fa float-right text-colorMahroon100"></i>
                                </a>
                            </div>

                            <div id="{{'collapse'. $ques->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                <p class="{!! 'colapseditTxtHdng'.$ques->id !!}">
                                    {!! $ques->answer!!}
                                </p>
                            </div>


                        </div>
                    @endforeach
                    </div>
                </div>

                @foreach ($faqs_text as $faq2)

                <div class="col-md-12 mt-5">
                    <div class="col-md-12 text-white p-5 bg-botPanel text-center font-size14px">
                        <h3 class="font-familyFreightTextProSemibold-Regular">{!! $faq2->cant_find !!}</h3>
                        <p class="mb-0"><span class="font-familyAtlasGrotesk-Regular">{!! $faq2->cant_find_sub !!}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('include.footer')

@endsection

