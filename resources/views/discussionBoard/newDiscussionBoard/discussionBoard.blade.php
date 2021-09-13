@extends('layouts.app')


@section('title') INET ED Platform :: Dashboard @endsection

@section('content')
    @include('include.header')

    <section class="bg-white pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12 d-flex p-0 justify-content-between">
                        <h4 class="text-black font-familyAtlasGroteskWeb-Bold mb-0 align-self-center">Discussion Board</h4>
                        @if (Auth::check() && Auth::user()->role_id == 1 && !$ban_user)
                        <a href="{{ route('addContent') }}" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px p-0 border-radius0px btnBotmBar align-self-end">
                            <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block text-uppercase">Edit Board <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                            <div class="btn-bar"></div>
                        </a>
                        @endif
                    </div>

                    @if ($diss_board_cat)
                        @foreach ($diss_board_cat as $category)
                            <div class="col-md-12 border-bottom p-0 mt-4 mb-4 pb-2">
                                <h5 class="text-black font-familyAtlasGroteskWeb-Bold mb-0 align-self-center">{{ $category->name }}</h5>
                            </div>

                            <div class="col-md-12 p-0">
                                @if ($diss_board)
                                    @foreach ($diss_board as $board)
                                        @if ($board->diss_board_cat_id == $category->id)
                                            <div class="col-md-12 bg-lightWhite300 p-4 mb-4">
                                                <div class="row justify-content-between">

                                                    <div class="col-lg-6 col-md-12 d-flex">
                                                        <h3 class="align-self-center text-colorMahroon700"><i class="{{ $board->icon }}"></i></h3>
                                                        <div class="col">
                                                            <a href="{{ route('contentSuggestion', ['board_id' => $board->id]) }}">
                                                            <h6 class="mb-0 font-familyAtlasGroteskWeb-Medium text-colorblue100">{{ $board->title }}</h6>
                                                            </a>
                                                            <p class="mb-0 font-familyAtlasGroteskWeb-Regular font-size13px text-colorblue200 opacity0point5">Updated {{ date("d M, Y", strtotime($board->u_at)) }}</p>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4 col-md-12 text-center">
                                                        <div class="row justify-content-between no-gutters">
                                                            <span class="">
                                                                <h6 class="mb-0 font-familyAtlasGroteskWeb-Medium text-colorblue200 opacity0point5">{{ $board->threads_count }}</h6>
                                                                <p class="mb-0 font-familyAtlasGroteskWeb-Regular font-size13px text-colorblue200 opacity0point5">Threads</p>
                                                            </span>
                                                            <span class="">
                                                                <h6 class="mb-0 font-familyAtlasGroteskWeb-Medium text-colorblue200 opacity0point5">{{ $board->messages_count }}</h6>
                                                                <p class="mb-0 font-familyAtlasGroteskWeb-Regular font-size13px text-colorblue200 opacity0point5">Messages</p>
                                                            </span>
                                                            <span class="align-self-center"><a href="{{ route('contentSuggestion', ['board_id' => $board->id]) }}"><i class="fas fa-angle-right align-self-center ml-2"></i></a></span>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div>

                {{-- <div class="col-md-5 d-flex">
                    @include('include.newdiBoardRightPanel')
                </div> --}}
            </div>
        </div>
    </section>

    @include('include.footer')

@endsection

@section('style')
    <link href="{{ asset('css/textarea/jquery.classyedit.css') }}" rel="stylesheet">
@endsection

@section('script')
    <script src="{{ asset('js/textarea/jquery.classyedit.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".classy-editor").ClassyEdit();
        });
    </script>
@endsection
