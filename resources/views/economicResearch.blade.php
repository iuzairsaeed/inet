@extends('layouts.app')


@section('title') INET ED Platform :: Economic Research @endsection

@section('content')
    @include('include.header')
    <section class="bg-white pt-5 pb-5">
        <div class="container">
            <div class="row justify-content-between">
                @foreach ($content_details as $item)
                <div class="col-md-7">
                    <h6 class="font-familyAtlasGroteskWeb-Regular mb-4"><span class="text-colorMahroon600">News</span> <i class="fas fa-angle-right ml-3 mr-3 text-colorMahroon100"></i> <span class="text-colorMahroon600">{!! $item->title !!}</span></h6>





                    <div class="col-md-12 p-0 mb-3">
                        <h3 class="text-colorblue100 font-familyAtlasGrotesk-Bold"> {!! $item->title !!}</h3>
                        <p class="font-size14px"><span class="font-familyFreightTextProBook-Regular text-colorblue200 opacity0point5">By</span> <span class="font-familyFreightTextProMedium-Italic text-colorblue100 mr-2">{!! $item->name !!}</span> <span class="mr-2 opacity0point5">|</span> <span class="font-familyAtlasGrotesk-Regular opacity0point5 font-size12px">  {!! date('d M, Y', strtotime($item->created_at)) !!}</span></p>
                        {{-- <img class="align-self-start mr-3 mt-1" src="{{ asset('images/bg/bg_covid.png') }}" alt="placeholder image" width="100%"> --}}
                        <p class="mt-3 font-familyFreightTextProSemibold-Regular">
                            {!! $item->body !!}
                        </p>
                    </div>
                    @endforeach

                        {{-- <button type="submit" form="discussions_ask_question" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px p-0 border-radius0px btnBotmBar">
                            <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">GO TO CAMBRIDGE-INET <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                            <div class="btn-bar"></div>
                        </button> --}}
                </div>
                {{-- <div class="col-md-5">
                    @include('include.discussionBoard')
                </div> --}}


            </div>
        </div>
    </section>

    @include('include.footer')




    <!-- Modal ADD NEWS -->
    <div class="modal fade p-0" id="moadalAddNews" tabindex="-1" role="dialog" aria-labelledby="moadalAddNews" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered max-width690px p-md-0 p-3" role="document">
            <div class="modal-content border-radius0px">
                <div class="modal-header p-4">
                    <h6 class="modal-title font-familyAtlasGroteskWeb-Bold text-colorblue100 text-uppercase" id="">ADD NEWS</h6>
                    <button type="button" class="close outlineNone text-colorMahroon700" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="" action="" method="POST">
                                @csrf

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="news_title" class="mb-0 text-colorblue100">Title</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Include news title for viewers.</p>
                                    <input type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="news_title" name="news_title" placeholder="Thread title">
                                </div>

                                <div class="col-md-12 p-0">
                                    <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                        <label for="news_body" class="">Body</label>
                                        <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Include all the information someone would need to answer your question.</p>
                                        <textarea class="form-control classy-editor" name="news_body" id="news_body" placeholder="" rows="6" cols="260"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="modal-footer box-shadow">
                    <button type="submit" form="discussions_ask_question" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px p-0 border-radius0px btnBotmBar">
                        <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">POST NEWS <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                        <div class="btn-bar"></div>
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('style')
    <link href="{{ asset('css/textarea/jquery.classyedit.css') }}" rel="stylesheet">
@endsection

@section('script')

    <script src="{{ asset('js/textarea/jquery.classyedit.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".classy-editor").ClassyEdit();
            $(".editor").attr('data-placeholder', 'Description');
        });
    </script>
@endsection
