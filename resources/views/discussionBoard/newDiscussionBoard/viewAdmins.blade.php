@extends('layouts.app')


@section('title') INET ED Platform :: Search @endsection

@section('content')
    @include('include.header')

    <section class="pt-5 pb-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h6 class="font-familyAtlasGroteskWeb-Regular mb-3"><span class="text-colorMahroon700">Discussion Board</span> <i class="fas fa-angle-right ml-3 mr-3 text-colorMahroon100"></i> <span class="text-colorMahroon600">View Admins</span></h6>

                    <div class="col-md-12 p-0 mb-4">
                        <div class="row justify-content-between">
                            <div class="col-md-6">
                                <h3 class="text-black font-familyAtlasGroteskWeb-Bold mb-0">View Admins</h3>
                            </div>
                            {{-- <div class="col-md-3">
                                <div class="form-group mb-0">
                                    <input type="text" class="form-control font-familyFreightTextProLight-Regular text-colorblue200 pr-5 font-size14px" id="search" placeholder="Search Banned User">
                                    <i class="fas fa-search text-colorblue200 searchIcon"></i>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>

            @foreach ($Admins as $item)


                <div class="col-lg-3 col-md-4 mb-3 d-flex">
                    <div class="card col-md-12 p-0 border-radius0px dashboardDataTable ModratorMenuMain">
                        {{-- <ul class="navbar-nav align-self-end font-familyFreightTextProLight-Regular position-absolute">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle p-0 text-lightGaray" href="#" id="listViewMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu margin-top2em widthMin13rem border-radius0px right0 aPading" aria-labelledby="listViewMenu">
                                    <div class="col pl-0 pr-0">
                                        <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#areYouSureClose" onclick="showUnmake({!! $item->id !!})"><i class="fas fa-star-half-alt mr-2"></i> <span>Unmake Moderator</span></a>
                                        <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#moadalBanUser" onclick="ban_post_user({!! $item->id !!})"><i class="fas fa-user-alt-slash mr-2"></i> <span>Ban User</span></a>
                                    </div>
                                </div>
                            </li>
                        </ul> --}}
                        <div class="col text-center pb-4 pt-4">
                            <div class="thumbnailImg_WH3 thumbnailImg overflow-hidden mr-0 m-auto" style="background:  url({{ url('public/uploads/profile_images/')  . '/'. $item->image }}) no-repeat; background-size: cover;">
                            </div>
                            <h5 class="font-familyAtlasGrotesk-Medium text-colorblue100 mt-2 d-flex mb-2 justify-content-center"><span class="ml-2">{!! $item->full_name !!}</span></h5>
                            <span class="badge badge-secondary font-familyFreightTextProMedium-Italic font-size13px pl-3 pr-3 pt-2 pb-2">{!! $item->role !!}</span>
                        </div>
                        <div class="col text-center font-size12px pb-4">
                            <div class="row justify-content-between">
                                <div class="col">
                                    <p class="mb-0 font-familyAtlasGroteskWeb-Bold text-colorblue100">{!! $item->bookmarks !!}</p>
                                    <p class="mb-0 font-familyAtlasGroteskWeb-Regular text-colorblue200 opacity0point5">Bookmarks</p>
                                </div>
                                <div class="col">
                                    <p class="mb-0 font-familyAtlasGroteskWeb-Bold text-colorblue100">{!! $item->threads !!}</p>
                                    <p class="mb-0 font-familyAtlasGroteskWeb-Regular text-colorblue200 opacity0point5">Threads</p>
                                </div>
                                <div class="col">
                                    <p class="mb-0 font-familyAtlasGroteskWeb-Bold text-colorblue100">{!! $item->posts !!}</p>
                                    <p class="mb-0 font-familyAtlasGroteskWeb-Regular text-colorblue200 opacity0point5">Posts</p>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer bg-transparent border-top text-center font-familyAtlasGroteskWeb-Regular font-size12px d-flex p-0 text-center justify-content-between hoverBot">
                        <a class="pt-3 pb-3 col-12" href="{!! route('discBoardprofile', ['u_id' => $item->id]) !!}"><i class="far fa-user"></i> <span class="d-block">View Profile</span></a>


                        </div>
                    </div>
                </div>
                @endforeach



            </div>
        </div>

<!-- Modal Are You Sure! -->
<div class="modal fade" id="areYouSureClose" tabindex="-1" role="dialog" aria-labelledby="areYouSureCloseTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered max-width-630px" role="document">
        <div class="modal-content border-radius0px">
            <div class="modal-body p-5">
                <p class="mb-0 font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size14px mb-0">Are you sure you want to unmake moderator this user?</p>
            </div>
            <form id="unmakecontributor" name="unmakecontributor">
                @csrf
                <input type="hidden" name="unmake_userid" id="unmake_userid">
                <div class="modal-footer">
                    <p id="message_content" style="position: absolute; left:25px;"></p>
                    <a href="#" class="font-familyAtlasGroteskWeb-Bold font-size12px align-self-center" data-dismiss="modal" aria-label="Close">CANCEL</a>
                    <button form="unmakecontributor" type="submit" class="btn btn-customBtn3 text-colorMahroon700 font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar ml-3 ">
                        <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">YES <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                        <div class="btn-bar"></div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>





<!-- Modal BAN USER -->
<div class="modal fade p-0" id="moadalBanUser" tabindex="-1" role="dialog" aria-labelledby="moadalBanUser" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered max-width690px overflow-hidden p-md-0 p-3" role="document">
        <div class="modal-content border-radius0px">
            <div class="modal-header p-4">
                <h6 class="modal-title font-familyAtlasGroteskWeb-Bold text-colorblue100" id="moadalMoveThreadTitle">BAN USER</h6>
                <button type="button" class="close outlineNone text-colorMahroon700" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0 font-size14px">
                <div class="col text-center border-bottom p-4">
                    <div id="ban_user_avatar" class="thumbnailImg_WHN9 thumbnailImg overflow-hidden mr-0 m-auto"></div>
                    <h6 id="ban_user_name" class="mt-0 font-familyAtlasGrotesk-Medium text-colorblue100 mt-2"></h6>
                    <span id="ban_user_role" class="badge badge-secondary font-familyFreightTextProMedium-Italic font-size13px pl-3 pr-3 pt-2 pb-2 mb-3"></span>
                    <p id="ban_user_joined" class="font-familyAtlasGroteskWeb-Medium text-colorblue200 mb-2"><span class="opacity0point5">Joined:</span></p>
                    <p id="ban_user_posts" class="font-familyAtlasGroteskWeb-Medium text-colorblue200 mb-0"><span class="opacity0point5">Posts:</span></p>
                </div>
                <div class="col-md-12 p-4">
                    <form id="diss_board_ban_user" action="{{ route('ban_user') }}" method="POST">
                        @csrf

                        <input type="hidden" id="ban_user_id" name="ban_user_id" value="">

                        <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100">
                            <label for="ban_user_body" class="mb-0">Write Ban Reason</label>
                            <div class="col-md-12 font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">
                                <p class="float-left">Write the correct reason of Ban.</p>
                            </div>
                            <textarea class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="ban_user_body" name="ban_user_body" placeholder="" rows="6" cols="260"></textarea>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer box-shadow">
                <button type="submit" form="diss_board_ban_user" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar">
                    <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">BAN USER <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                    <div class="btn-bar"></div>
                </button>
            </div>
        </div>
    </div>
</div>



    </section>

    @include('include.footer')

@endsection

@section('script')
    <script src="{{ asset('js/discussionBoard.js') }}"></script>
@endsection

