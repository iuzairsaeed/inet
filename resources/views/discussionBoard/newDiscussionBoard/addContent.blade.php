@extends('layouts.app')

@section('title') INET ED Platform :: Dashboard @endsection

@section('content')
    @include('include.header')

    <section class="bg-white pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 home-dnd">

                    <div class="col-md-12 d-flex p-0 justify-content-between">
                        <h4 class="text-black font-familyAtlasGroteskWeb-Bold mb-0 align-self-center">Discussion Board</h4>
                        <div class="">
                            <a href="{{ route('discussionBoard') }}" class="font-familyAtlasGroteskWeb-Bold text-colorMahroon700 font-size14px align-self-center">CANCEL</a>
                            <button id="discussionBoardredirect" type="button" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px p-0 border-radius0px btnBotmBar ml-4" data-toggle="modal" data-target="#moadalEditProfile">
                                <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block text-uppercase">SAVE CHANGES <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                                <div class="btn-bar"></div>
                            </button>
                        </div>
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
                                                    <h6 class="mb-0 font-familyAtlasGroteskWeb-Medium text-colorblue100">{{ $board->title }}</h6>
                                                    <p class="mb-0 font-familyAtlasGroteskWeb-Regular font-size13px text-colorblue200 opacity0point5">Updated {{ date("d-m-Y", strtotime($board->u_at)) }}</p>
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
                                                    <span class="align-self-center"><a href="#"><i class="fas fa-angle-right align-self-center ml-2"></i></a></span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            @endif

                            <div class="col-md-12 mb-4 p-0">
                                <div class="col-md-12 borderDotted text-center font-size12px d-flex justify-content-center cursorPointer text-center pt-3 pb-3" data-toggle="modal" data-target="#moadalAddNBoard">
                                    <p class="font-familyAtlasGroteskWeb-Bold text-ferozy mb-0">ADD BOARD</p>
                                    <i class="fas fa-plus text-colorMahroon700 align-self-center ml-3"></i>
                                </div>
                            </div>

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



    <!-- Modal ADD BOARD -->
    <div class="modal fade p-0" id="moadalAddNBoard" tabindex="-1" role="dialog" aria-labelledby="moadalAddNBoard" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered max-width580px p-md-0 p-3" role="document">
            <div class="modal-content border-radius0px">
                <div class="modal-header p-4">
                    <h6 class="modal-title font-familyAtlasGroteskWeb-Bold text-colorblue100 text-uppercase" id="moadalAddNBoard">ADD BOARD</h6>
                    <button type="button" class="close outlineNone text-colorMahroon700" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="diss_board" action="{{ route('addBoard') }}" method="POST">
                                @csrf
                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="title" class="mb-0 text-colorblue100">Board Title</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">The board title is what others will see.</p>
                                    <input type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="board_title" name="title" placeholder="Board Title">
                                    <p id="board_title_err" style="color:red; font-size: 10px;"></p>
                                </div>

                                {{-- <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="icon" class="mb-0 text-colorblue100">Board Icon</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">The board icon is what others will see.</p>
                                    <input type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="board_icon" name="icon" placeholder="Board Icon">
                                </div> --}}

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                                    <label for="cat_id" class="mb-0 text-colorblue100">Board Category</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Choose board category from the following.</p>
                                    <select id="board_cat_id" name="cat_id" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue">
                                        <option value="">Select Board Category</option>
                                        @foreach ($diss_board_cat as $category)
                                            <option value="{{ $category->id}}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <p id="board_category_err" style="color:red; font-size: 10px;"></p>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                                    <label for="boardPrivacy" class="mb-0 text-colorblue100">Board Privacy</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Choose board privacy from the following.</p>
                                    <select id="board_privacy" name="privacy"  class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue">
                                        <option value="">Select Board Privacy</option>
                                        <option value="admin">Admin</option>
                                        <option value="general">General</option>
                                        <option value="moderator">Moderator</option>
                                        <option value="teacher">Teacher</option>
                                    </select>
                                    <p id="board_privacy_err" style="color:red; font-size: 10px;"></p>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
                <div class="modal-footer box-shadow">
                    <button type="submit" form="diss_board" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar">
                        <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">ADD BOARD <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                        <div class="btn-bar"></div>
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('script')
    <script src="{{ asset('js/dragInDrop.min.js') }}"></script>
    <script src="{{ asset('js/dragInDropCustom.js') }}"></script>
    <script src="{{ asset('js/discussionBoard.js') }}"></script>
@endsection
