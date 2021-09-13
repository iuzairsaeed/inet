@extends('layouts.app') @section('title') INET ED Platform :: Dashboard @endsection @section('content') @include('include.header')

<section class="pt-4 pb-4 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4">
                <h6 class="text-colorblue100 font-familyAtlasGroteskWeb-Medium mb-3">{{ $thread->title }}</h6>
                <div class="media">
                    <div class="thumbnailImg_WHN3 thumbnailImg overflow-hidden" style="background: url('https://ineted.org/public/uploads/profile_images/{{ $thread->author_avatar }}') no-repeat; background-size: cover;">
                    </div>
                    <div class="media-body align-self-center d-flex">
                        <p class="mt-0 mb-0 font-familyAtlasGrotesk-Medium text-colorblue100 font-size14px align-self-center"><span class="align-self-center mr-2">{{ $thread->author }}</span> <span class="badge badge-secondary font-familyFreightTextProMedium-Italic pl-3 pr-3 pt-2 pb-2">{{ $thread->role }}</span></p>
                        <span class="text-colorblue200 opacity0point5 mr-3 ml-3 align-self-center">|</span>
                        <div class="align-self-center">
                            <span class="align-self-center"><img src="{{ asset('images/icons/pencil.png') }}" alt="" width="20" class="mr-2"></span>
                            <span class="text-colorblue200 font-familyAtlasGroteskWeb-Regular font-size13px opacity0point5 align-self-center">{{ date("M d, Y", strtotime($thread->c_at)) }}</span>
                        </div>
                        <span class="text-colorblue200 opacity0point5 mr-3 ml-3 align-self-center">|</span>
                        <div class="align-self-center">
                            <span class="align-self-center opacity0point5 text-colorblue200 mr-2"><i class="far fa-eye"></i></span>
                            <span class="text-colorblue200 font-familyAtlasGroteskWeb-Regular font-size13px opacity0point5 align-self-center">{{ $thread->views_count }} Views</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 border-bottom contSuggTable mt-4 p-0">
                    <div class="row justify-content-between no-gutters">
                        <div class="col-md-6">
                            <nav aria-label="Page navigation">
                                @if ($thread_posts_pages > 1)
                                <ul class="pagination font-familyAtlasGrotesk-Regular text-colorblue100 font-size12px" id="post_pagination">
                                    <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Previous</a></li>

                                    <?php
                                        for ($i=0; $i < $thread_posts_pages; $i++) {
                                            $page = $i + 1;
                                            $default_active = $page == 1 ? 'active disabled' : '';
                                            echo "<li class='page-item $default_active' ><a class='page-link' onclick='change_thread_post_page($page)'>$page</a></li>";
                                        }
                                    ?>

                                    <li class="page-item"><a class="page-link" onclick='change_thread_post_page(2)'>Next</a></li>
                                </ul>
                                @endif
                            </nav>
                        </div>
                        <div class="col-md-4 dashboardDataTable dashboardDataTable2 d-flex justify-content-end">
                            <span class="text-ferozy pr-3 font-familyAtlasGroteskWeb-Bold font-size12px align-self-center"><span>SHARE</span> <i class="fas fa-angle-down text-colorMahroon700 ml-2"></i></span>
                            <span class="font-familyAtlasGroteskWeb-Bold text-colorblue200 opacity0point5 font-size12px align-self-center">Watch Thread</span>
                            <ul class="navbar-nav align-self-center font-familyFreightTextProLight-Regular width23px">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle p-0 text-lightGaray ml-3" href="#" id="listViewMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu margin-top2em widthMin15rem border-radius0px right0 aPading" aria-labelledby="listViewMenu">
                                        <div class="col pl-0 pr-0">
                                            <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#"><i class="far fa-edit mr-2"></i> <span>Edit Thread</span></a>
                                            <a class="dropdown-item font-size14px" href="#"><i class="far fa-flag mr-2"></i> <span>Flag Thread</span></a>
                                            <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#areYouSure"><i class="far fa-trash-alt mr-2"></i> <span>Delete Thread</span></a>
                                            <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#"><i class="far fa-window-close mr-2"></i> <span>Close Thread</span></a>
                                            <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#"><i class="fas fa-thumbtack mr-2"></i> <span>Pin Thread</span></a>
                                            <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#moadalMoveThread"><i class="fas fa-arrows-alt mr-2"></i> <span>Move Thread</span></a>
                                            <a class="dropdown-item font-size14px" href="{{ route('bannedUser') }}"><i class="fas fa-user-slash mr-2"></i> <span>Ban User</span></a>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                                    <div class="col-md-12 border-top p-4">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <i class="fas fa-thumbs-up colorBlue font-size18px"></i>
                                                <span class="font-size18px">&#128518;</span>
                                                <i class="fas fa-info-circle colorGreen font-size18px"></i>
                                                <span class="font-familyAtlasGroteskWeb-Medium text-ferozy font-size14px ml-1">78</span>
                                            </div>
                                            <div class="col-md-6 text-right align-self-center dashboardDataTable">
                                                <div class="btn-group dropup">
                                                    <a href="#" class="dropdown-toggle text-decoration-none" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-thumbs-up colorBlue font-size18px"></i>
                                                        <span class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size12px ml-1">LIKE</span>
                                                    </a>

                                                    <div class="dropdown-menu emojies animated fadeIn">
                                                        <div class="d-flex">
                                                            <i class="fas fa-thumbs-up colorBlue font-size32px cursorPointer align-self-center"></i>
                                                            <i class="fas fa-info-circle colorGreen font-size38px cursorPointer  align-self-center"></i>
                                                            <i class="fas fa-check-circle text-success font-size38px cursorPointer  align-self-center"></i>
                                                            <i class="fas fa-times-circle text-danger font-size38px  cursorPointer  align-self-center"></i>
                                                            <i class="fas fa-laugh-squint text-yellow font-size38px  cursorPointer  align-self-center"></i>
                                                        </div>

                                                    </div>
                                                </div>

                                                <i class="fas fa-reply font-size18px text-colorblue100 ml-3"></i>
                                                <span class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size12px ml-1">REPLY</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-12" >

                <div id="post_result">
                    @if ($thread_posts) @foreach ($thread_posts as $post)

                    <div class="col-md-12 p-0">
                        <div class="row no-gutters">
                            <div class="col-lg-2 col-md-3 text-center mb-3">
                                <div class="col text-center mb-3">
                                    <div class="thumbnailImg_WHN5 thumbnailImg overflow-hidden mr-0 m-auto" style="background: url('https://ineted.org/public/uploads/profile_images/{{ $post->author_avatar }}') no-repeat; background-size: cover;">
                                    </div>

                                    <p class="font-familyAtlasGrotesk-Medium text-colorblue100 mt-2 mb-2 font-size14px">{{ $post->author }}</p>
                                    <span class="badge badge-secondary font-familyFreightTextProMedium-Italic font-size12px pl-3 pr-3 pt-2 pb-2">{{ $post->author_role }}</span>
                                </div>
                                <p class="font-familyAtlasGroteskWeb-Regular text-colorblue200 font-size14px mb-1"><span class="opacity0point5">Joined:</span> {{ date("M d, Y", strtotime($post->author_joined)) }}</p>
                                <p class="font-familyAtlasGroteskWeb-Regular text-colorblue200 font-size14px"><span class="opacity0point5">Posts:</span> {{ $post->author_posts }}</p>
                                <img src="{{ asset('images/icons/' . $post->rank_image) }}" alt="" width="80">
                            </div>
                            <div class="col-lg-10 col-md-9 mb-3">
                                <div class="col-md-12 bg-lightWhite100 p-0 font-familyAtlasGroteskWeb-Regular text-colorblue200 font-size13px arrow">
                                    <div class="col-md-12 p-4">
                                        <div class="col-md-12 p-0 font-familyAtlasGroteskWeb-Regular text-colorblue200 mb-3 d-flex justify-content-between">
                                            <p class="mb-0 font-size13px align-self-center opacity0point5">{{ date("M d, Y", strtotime($post->c_at)) }} at {{ date("h:m", strtotime($post->c_at)) }}</p>
                                            <span class="badge badge-secondary2 pl-3 pr-3 pt-2 pb-2 font-size13px">#1</span>
                                        </div>
                                        <div>
                                            {!! $post->body !!}
                                        </div>
                                    </div>

                                    <div class="col-md-12 border-top p-4">
                                        <div class="row">
                                            <div class="col-md-6">
                                                @if ($post->thumbup_count)
                                                <i class="fas fa-thumbs-up colorBlue font-size18px"></i> @endif @if ($post->smiley_count)
                                                <span class="font-size18px">&#128518;</span> @endif @if ($post->info_count)
                                                <i class="fas fa-info-circle colorGreen font-size18px"></i> @endif

                                                <span class="font-familyAtlasGroteskWeb-Medium text-ferozy font-size14px ml-1">{{ $post->thumbup_count + $post->smiley_count + $post->info_count }}</span>
                                            </div>
                                            <div class="col-md-6 text-right align-self-center" style="cursor:pointer">
                                                <i onclick="likepost({{ $post->id }})" class="fas fa-thumbs-up colorBlue font-size18px"></i>
                                                <span onclick="likepost({{ $post->id }})" class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size12px ml-1">LIKE</span>
                                                <i class="fas fa-reply font-size18px text-colorblue100 ml-5"></i>
                                            <div class="col-md-6 text-right align-self-center dashboardDataTable">
                                                <div class="btn-group dropup">
                                                    <a href="#" class="dropdown-toggle text-decoration-none" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-thumbs-up colorBlue font-size18px"></i>
                                                        <span class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size12px ml-1">LIKE</span>
                                                    </a>

                                                    <div class="dropdown-menu emojies animated fadeIn">
                                                        <div class="d-flex">
                                                            <i class="fas fa-thumbs-up colorBlue font-size32px cursorPointer align-self-center"></i>
                                                            <i class="fas fa-info-circle colorGreen font-size38px cursorPointer  align-self-center"></i>
                                                            <i class="fas fa-check-circle text-success font-size38px cursorPointer  align-self-center"></i>
                                                            <i class="fas fa-times-circle text-danger font-size38px  cursorPointer  align-self-center"></i>
                                                            <i class="fas fa-laugh-squint text-yellow font-size38px  cursorPointer  align-self-center"></i>
                                                        </div>

                                                    </div>
                                                </div>

                                                <i class="fas fa-reply font-size18px text-colorblue100 ml-3"></i>
                                                <span class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size12px ml-1">REPLY</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach @endif
                </div>

                <hr class="mt-5">

                <div class="col-md-12 p-0">
                    <form id="diss_board_post" action="{{ route('diss_thread_posts') }}" method="POST">
                        @csrf
                                    <div class="col-md-12 border-top p-4">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <i class="fas fa-thumbs-up colorBlue font-size18px"></i>
                                                <span class="font-size18px">&#128518;</span>
                                                <i class="fas fa-info-circle colorGreen font-size18px"></i>
                                                <span class="font-familyAtlasGroteskWeb-Medium text-ferozy font-size14px ml-1">78</span>
                                            </div>
                                            <div class="col-md-6 text-right align-self-center dashboardDataTable">
                                                <div class="btn-group dropup">
                                                    <a href="#" class="dropdown-toggle text-decoration-none" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-thumbs-up colorBlue font-size18px"></i>
                                                        <span class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size12px ml-1">LIKE</span>
                                                    </a>

                                                    <div class="dropdown-menu emojies animated fadeIn">
                                                        <div class="d-flex">
                                                            <i class="fas fa-thumbs-up colorBlue font-size32px cursorPointer align-self-center"></i>
                                                            <i class="fas fa-info-circle colorGreen font-size38px cursorPointer  align-self-center"></i>
                                                            <i class="fas fa-check-circle text-success font-size38px cursorPointer  align-self-center"></i>
                                                            <i class="fas fa-times-circle text-danger font-size38px  cursorPointer  align-self-center"></i>
                                                            <i class="fas fa-laugh-squint text-yellow font-size38px  cursorPointer  align-self-center"></i>
                                                        </div>

                                                    </div>
                                                </div>

                                                <i class="fas fa-reply font-size18px text-colorblue100 ml-3"></i>
                                                <span class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size12px ml-1">REPLY</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                        <input type="hidden" id="board_id" name="board_id" value="{{ Request::get('board_id') }}">
                        <input type="hidden" id="thread_id" name="thread_id" value="{{ Request::get('thread_id') }}">

                        <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-4 h-textEditor">
                            <label for="body" class="">Your Answer</label>
                            <textarea class="form-control classy-editor" id="body" name="body" placeholder="" rows="6" cols="260"></textarea>
                        </div>
                        <button type="submit" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px p-0 border-radius0px btnBotmBar">
                            <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">POST ANSWER <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                            <div class="btn-bar"></div>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section>

@include('include.footer')

<!-- Modal Are You Sure! -->
<div class="modal fade" id="areYouSure" tabindex="-1" role="dialog" aria-labelledby="areYouSureTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered max-width-630px" role="document">
        <div class="modal-content border-radius0px">
            <div class="modal-body p-5">
                <p class="mb-0 font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size14px mb-0">Are you sure you want to delete this thread?</p>
                <p class="font-familyAtlasGroteskWeb-Light text-colorblue200 opacity0point5 font-size14px mb-0">You can also repost the thread again from the discussion board drop-down.</p>
            </div>
            <div class="modal-footer">
                <a href="#" class="font-familyAtlasGroteskWeb-Bold font-size12px align-self-center" data-dismiss="modal" aria-label="Close">Cancel</a>
                <button type="button" class="btn btn-customBtn3 text-colorMahroon700 font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar ml-3 ">
                        <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">DELETE <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                        <div class="btn-bar"></div>
                    </button>
            </div>
        </div>
    </div>
</div>




<!-- Modal MOVE THREAD -->
<div class="modal fade p-0" id="moadalMoveThread" tabindex="-1" role="dialog" aria-labelledby="moadalMoveThread" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered max-width790px overflow-hidden p-md-0 p-3" role="document">
        <div class="modal-content border-radius0px">
            <div class="modal-header p-4">
                <h6 class="modal-title font-familyAtlasGroteskWeb-Bold text-colorblue100" id="moadalMoveThreadTitle">MOVE THREAD</h6>
                <button type="button" class="close outlineNone text-colorMahroon700" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body p-0 font-size14px">
                <div class="col p-0">
                    <div class="col-md-12 bg-gray900 p-4">
                        <h6 class="text-black font-familyAtlasGroteskWeb-Bold mb-0">Official</h6>
                    </div>
                    <div class="col-md-12 bg-lightWhite600 pr-4 pl-4 p-3 border-bottom">
                        <div class="row justify-content-between">
                            <div class="col-lg-6 col-md-12 d-flex align-self-center">
                                <p class="mb-0 font-familyAtlasGroteskWeb-Regular text-colorblue200">Announcements</p>
                            </div>
                            <div class="col-lg-4 col-md-12 text-center">
                                <div class="row justify-content-end no-gutters">
                                    <span class="font-size13px">
                                            <p class="mb-0 font-familyAtlasGroteskWeb-Medium text-colorblue200 opacity0point5">285</p>
                                            <p class="mb-0 font-familyAtlasGroteskWeb-Regular font-size12px text-colorblue200 opacity0point5">Threads</p>
                                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 bg-lightWhite600 pr-4 pl-4 p-3 border-bottom">
                        <div class="row justify-content-between">
                            <div class="col-lg-6 col-md-12 d-flex align-self-center">
                                <p class="mb-0 font-familyAtlasGroteskWeb-Regular text-colorblue200">Have you seen this..?</p>
                            </div>
                            <div class="col-lg-4 col-md-12 text-center">
                                <div class="row justify-content-end no-gutters">
                                    <span class="font-size13px">
                                            <p class="mb-0 font-familyAtlasGroteskWeb-Medium text-colorblue200 opacity0point5">285</p>
                                            <p class="mb-0 font-familyAtlasGroteskWeb-Regular font-size12px text-colorblue200 opacity0point5">Threads</p>
                                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 bg-lightWhite600 pr-4 pl-4 p-3 mb-4 border-bottom">
                        <div class="row justify-content-between">
                            <div class="col-lg-6 col-md-12 d-flex align-self-center">
                                <p class="mb-0 font-familyAtlasGroteskWeb-Regular text-colorblue200">Frequently Asked Questions</p>
                            </div>
                            <div class="col-lg-4 col-md-12 text-center">
                                <div class="row justify-content-end no-gutters">
                                    <span class="font-size13px">
                                            <p class="mb-0 font-familyAtlasGroteskWeb-Medium text-colorblue200 opacity0point5">285</p>
                                            <p class="mb-0 font-familyAtlasGroteskWeb-Regular font-size12px text-colorblue200 opacity0point5">Threads</p>
                                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col p-0">
                    <div class="col-md-12 bg-gray900 p-4">
                        <h6 class="text-black font-familyAtlasGroteskWeb-Bold mb-0">Teacher</h6>
                    </div>
                    <div class="col-md-12 bg-lightWhite600 pr-4 pl-4 p-3 border-bottom mb-4">
                        <div class="row justify-content-between">
                            <div class="col-lg-6 col-md-12 d-flex align-self-center">
                                <p class="mb-0 font-familyAtlasGroteskWeb-Regular text-colorblue200">Frequently Asked Questions</p>
                            </div>
                            <div class="col-lg-4 col-md-12 text-center">
                                <div class="row justify-content-end no-gutters">
                                    <span class="font-size13px">
                                            <p class="mb-0 font-familyAtlasGroteskWeb-Medium text-colorblue200 opacity0point5">285</p>
                                            <p class="mb-0 font-familyAtlasGroteskWeb-Regular font-size12px text-colorblue200 opacity0point5">Threads</p>
                                        </span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col p-0">
                    <div class="col-md-12 bg-gray900 p-4">
                        <h6 class="text-black font-familyAtlasGroteskWeb-Bold mb-0">Admin</h6>
                    </div>
                    <div class="col-md-12 bg-lightWhite600 pr-4 pl-4 p-3 border-bottom mb-4">
                        <div class="row justify-content-between">
                            <div class="col-lg-6 col-md-12 d-flex align-self-center">
                                <p class="mb-0 font-familyAtlasGroteskWeb-Regular text-colorblue200">Frequently Asked Questions</p>
                            </div>
                            <div class="col-lg-4 col-md-12 text-center">
                                <div class="row justify-content-end no-gutters">
                                    <span class="font-size13px">
                                            <p class="mb-0 font-familyAtlasGroteskWeb-Medium text-colorblue200 opacity0point5">285</p>
                                            <p class="mb-0 font-familyAtlasGroteskWeb-Regular font-size12px text-colorblue200 opacity0point5">Threads</p>
                                        </span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer box-shadow">
                <button type="button" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar">
                        <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">MOVE THREAD <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                        <div class="btn-bar"></div>
                    </button>
            </div>
        </div>
    </div>
</div>





<!-- Modal MOVE POST 1-->
<div class="modal fade p-0" id="moadalMovePost1" tabindex="-1" role="dialog" aria-labelledby="moadalMovePost1" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered max-width790px overflow-hidden p-md-0 p-3" role="document">
        <div class="modal-content border-radius0px">
            <div class="modal-header p-4">
                <h6 class="modal-title font-familyAtlasGroteskWeb-Bold text-colorblue100" id="moadalMoveThreadTitle">MOVE POST <span class="font-familyAtlasGroteskWeb-Medium text-colorblue200 opacity0point5 font-size12px">(STEP 1 OF 2)</span></h6>
                <button type="button" class="close outlineNone text-colorMahroon700" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body p-0 font-size14px">
                <div class="col p-0">
                    <div class="col-md-12 bg-gray900 p-4">
                        <h6 class="text-black font-familyAtlasGroteskWeb-Bold mb-0">Official</h6>
                    </div>
                    <div class="col-md-12 bg-lightWhite600 pr-4 pl-4 p-3 border-bottom">
                        <div class="row justify-content-between">
                            <div class="col-lg-6 col-md-12 d-flex align-self-center">
                                <p class="mb-0 font-familyAtlasGroteskWeb-Regular text-colorblue200">Announcements</p>
                            </div>
                            <div class="col-lg-4 col-md-12 text-center">
                                <div class="row justify-content-end no-gutters">
                                    <span class="font-size13px">
                                            <p class="mb-0 font-familyAtlasGroteskWeb-Medium text-colorblue200 opacity0point5">285</p>
                                            <p class="mb-0 font-familyAtlasGroteskWeb-Regular font-size12px text-colorblue200 opacity0point5">Threads</p>
                                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 bg-lightWhite600 pr-4 pl-4 p-3 border-bottom">
                        <div class="row justify-content-between">
                            <div class="col-lg-6 col-md-12 d-flex align-self-center">
                                <p class="mb-0 font-familyAtlasGroteskWeb-Regular text-colorblue200">Have you seen this..?</p>
                            </div>
                            <div class="col-lg-4 col-md-12 text-center">
                                <div class="row justify-content-end no-gutters">
                                    <span class="font-size13px">
                                            <p class="mb-0 font-familyAtlasGroteskWeb-Medium text-colorblue200 opacity0point5">285</p>
                                            <p class="mb-0 font-familyAtlasGroteskWeb-Regular font-size12px text-colorblue200 opacity0point5">Threads</p>
                                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 bg-lightWhite600 pr-4 pl-4 p-3 mb-4 border-bottom">
                        <div class="row justify-content-between">
                            <div class="col-lg-6 col-md-12 d-flex align-self-center">
                                <p class="mb-0 font-familyAtlasGroteskWeb-Regular text-colorblue200">Frequently Asked Questions</p>
                            </div>
                            <div class="col-lg-4 col-md-12 text-center">
                                <div class="row justify-content-end no-gutters">
                                    <span class="font-size13px">
                                            <p class="mb-0 font-familyAtlasGroteskWeb-Medium text-colorblue200 opacity0point5">285</p>
                                            <p class="mb-0 font-familyAtlasGroteskWeb-Regular font-size12px text-colorblue200 opacity0point5">Threads</p>
                                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col p-0">
                    <div class="col-md-12 bg-gray900 p-4">
                        <h6 class="text-black font-familyAtlasGroteskWeb-Bold mb-0">Teacher</h6>
                    </div>
                    <div class="col-md-12 bg-lightWhite600 pr-4 pl-4 p-3 border-bottom mb-4">
                        <div class="row justify-content-between">
                            <div class="col-lg-6 col-md-12 d-flex align-self-center">
                                <p class="mb-0 font-familyAtlasGroteskWeb-Regular text-colorblue200">Frequently Asked Questions</p>
                            </div>
                            <div class="col-lg-4 col-md-12 text-center">
                                <div class="row justify-content-end no-gutters">
                                    <span class="font-size13px">
                                            <p class="mb-0 font-familyAtlasGroteskWeb-Medium text-colorblue200 opacity0point5">285</p>
                                            <p class="mb-0 font-familyAtlasGroteskWeb-Regular font-size12px text-colorblue200 opacity0point5">Threads</p>
                                        </span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col p-0">
                    <div class="col-md-12 bg-gray900 p-4">
                        <h6 class="text-black font-familyAtlasGroteskWeb-Bold mb-0">Admin</h6>
                    </div>
                    <div class="col-md-12 bg-lightWhite600 pr-4 pl-4 p-3 border-bottom mb-4">
                        <div class="row justify-content-between">
                            <div class="col-lg-6 col-md-12 d-flex align-self-center">
                                <p class="mb-0 font-familyAtlasGroteskWeb-Regular text-colorblue200">Frequently Asked Questions</p>
                            </div>
                            <div class="col-lg-4 col-md-12 text-center">
                                <div class="row justify-content-end no-gutters">
                                    <span class="font-size13px">
                                            <p class="mb-0 font-familyAtlasGroteskWeb-Medium text-colorblue200 opacity0point5">285</p>
                                            <p class="mb-0 font-familyAtlasGroteskWeb-Regular font-size12px text-colorblue200 opacity0point5">Threads</p>
                                        </span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer justify-content-between box-shadow">
                <p class="font-familyAtlasGroteskWeb-Medium font-size12px text-colorMahroon600">*Choose which board to move the post in.</p>
                <button type="button" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar" onclick="movePostStep2()">
                        <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">NEXT <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                        <div class="btn-bar"></div>
                    </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal MOVE POST 2-->
<div class="modal fade p-0" id="moadalMovePost2" tabindex="-1" role="dialog" aria-labelledby="moadalMovePost2" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered max-width790px overflow-hidden p-md-0 p-3" role="document">
        <div class="modal-content border-radius0px">
            <div class="modal-header p-4">
                <h6 class="modal-title font-familyAtlasGroteskWeb-Bold text-colorblue100" id="moadalMoveThreadTitle">MOVE POST <span class="font-familyAtlasGroteskWeb-Medium text-colorblue200 opacity0point5 font-size12px">(STEP 2 OF 2)</span></h6>
                <button type="button" class="close outlineNone text-colorMahroon700" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body p-0 font-size14px">
                <div class="col-md-12 p-4 pt-3 pb-3">
                    <div class="row justify-content-between">
                        <div class="col-md-8">
                            <h6 class="text-black font-familyAtlasGroteskWeb-Bold mb-0">Choose Thread</h6>
                            <p class="font-familyAtlasGroteskWeb-Light text-colorblue200 mb-0">Add comment to help contributor improve the content.</p>
                        </div>
                        <div class="col-md-4 align-self-center">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control font-familyFreightTextProLight-Regular text-colorblue200 pr-5 font-size14px" id="search" placeholder="Search Thread">
                                <i class="fas fa-search text-colorblue200 searchIcon"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col p-0 movePost_a">
                    <a href="#" class="d-block bg-lightWhite600">
                        <div class="col-md-12 pr-4 pl-4 p-3 border-bottom">
                            <div class="row">
                                <div class="col-lg-8 col-md-12 d-flex align-self-center">
                                    <p class="mb-0 font-familyAtlasGroteskWeb-Medium font-size12px">Pellentesque posuere. Praesent turpis. Aenean posuere, tortor sed cursus feugiatn...</p>
                                </div>
                                <div class="col-lg-4 col-md-12 d-flex justify-content-end">
                                    <div class="media">
                                        <div class="thumbnailImg_WHN3 thumbnailImg overflow-hidden" style="background: url('images/icons/img2.png') no-repeat; background-size: cover;">
                                        </div>
                                        <div class="media-body align-self-center d-flex">
                                            <p class="mt-0 mb-0 font-familyAtlasGrotesk-Medium font-size14px align-self-center"><span class="align-self-center mr-2">Niko Tim</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="#" class="d-block bg-lightWhite600">
                        <div class="col-md-12 pr-4 pl-4 p-3 border-bottom">
                            <div class="row">
                                <div class="col-lg-8 col-md-12 d-flex align-self-center">
                                    <p class="mb-0 font-familyAtlasGroteskWeb-Medium font-size12px">Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metusaccu</p>
                                </div>
                                <div class="col-lg-4 col-md-12 d-flex justify-content-end">
                                    <div class="media">
                                        <div class="thumbnailImg_WHN3 thumbnailImg overflow-hidden" style="background: url('images/icons/img2.png') no-repeat; background-size: cover;">
                                        </div>
                                        <div class="media-body align-self-center d-flex">
                                            <p class="mt-0 mb-0 font-familyAtlasGrotesk-Medium font-size14px align-self-center"><span class="align-self-center mr-2">Niko Tim</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="#" class="d-block bg-lightWhite600">
                        <div class="col-md-12 pr-4 pl-4 p-3 border-bottom">
                            <div class="row">
                                <div class="col-lg-8 col-md-12 d-flex align-self-center">
                                    <p class="mb-0 font-familyAtlasGroteskWeb-Medium font-size12px">Suspendisse pulvinar, augue ac venenatis condimentum, sem libero volutpat nibh</p>
                                </div>
                                <div class="col-lg-4 col-md-12 d-flex justify-content-end">
                                    <div class="media">
                                        <div class="thumbnailImg_WHN3 thumbnailImg overflow-hidden" style="background: url('images/icons/img2.png') no-repeat; background-size: cover;">
                                        </div>
                                        <div class="media-body align-self-center d-flex">
                                            <p class="mt-0 mb-0 font-familyAtlasGrotesk-Medium font-size14px align-self-center"><span class="align-self-center mr-2">Niko Tim</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="#" class="d-block bg-lightWhite600">
                        <div class="col-md-12 pr-4 pl-4 p-3 border-bottom">
                            <div class="row">
                                <div class="col-lg-8 col-md-12 d-flex align-self-center">
                                    <p class="mb-0 font-familyAtlasGroteskWeb-Medium font-size12px">Morbi mattis ullamcorper velit. Phasellus gravida semper nisi. Nullam vel sem</p>
                                </div>
                                <div class="col-lg-4 col-md-12 d-flex justify-content-end">
                                    <div class="media">
                                        <div class="thumbnailImg_WHN3 thumbnailImg overflow-hidden" style="background: url('images/icons/img2.png') no-repeat; background-size: cover;">
                                        </div>
                                        <div class="media-body align-self-center d-flex">
                                            <p class="mt-0 mb-0 font-familyAtlasGrotesk-Medium font-size14px align-self-center"><span class="align-self-center mr-2">Niko Tim</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="#" class="d-block bg-lightWhite600">
                        <div class="col-md-12 pr-4 pl-4 p-3 border-bottom">
                            <div class="row">
                                <div class="col-lg-8 col-md-12 d-flex align-self-center">
                                    <p class="mb-0 font-familyAtlasGroteskWeb-Medium font-size12px">Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum mperdie ultricies</p>
                                </div>
                                <div class="col-lg-4 col-md-12 d-flex justify-content-end">
                                    <div class="media">
                                        <div class="thumbnailImg_WHN3 thumbnailImg overflow-hidden" style="background: url('images/icons/img2.png') no-repeat; background-size: cover;">
                                        </div>
                                        <div class="media-body align-self-center d-flex">
                                            <p class="mt-0 mb-0 font-familyAtlasGrotesk-Medium font-size14px align-self-center"><span class="align-self-center mr-2">Niko Tim</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="#" class="d-block bg-lightWhite600">
                        <div class="col-md-12 pr-4 pl-4 p-3 border-bottom">
                            <div class="row">
                                <div class="col-lg-8 col-md-12 d-flex align-self-center">
                                    <p class="mb-0 font-familyAtlasGroteskWeb-Medium font-size12px">Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metusaccu</p>
                                </div>
                                <div class="col-lg-4 col-md-12 d-flex justify-content-end">
                                    <div class="media">
                                        <div class="thumbnailImg_WHN3 thumbnailImg overflow-hidden" style="background: url('images/icons/img2.png') no-repeat; background-size: cover;">
                                        </div>
                                        <div class="media-body align-self-center d-flex">
                                            <p class="mt-0 mb-0 font-familyAtlasGrotesk-Medium font-size14px align-self-center"><span class="align-self-center mr-2">Niko Tim</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>


                </div>
            </div>
            <div class="modal-footer box-shadow">
                <button type="button" class="btn btn-customBtn4 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar" onclick="movePostStep1()">
                        <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block"><i class="fas fa-angle-left text-colorblue200"></i></span>
                        <div class="btn-bar"></div>
                    </button>
                <button type="button" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar">
                        <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">MOVE POST <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                        <div class="btn-bar"></div>
                    </button>
            </div>
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
                    <div class="thumbnailImg_WHN9 thumbnailImg overflow-hidden mr-0 m-auto" style="background: url('images/icons/img1.png') no-repeat; background-size: cover;">
                    </div>

                    <h6 class="mt-0 font-familyAtlasGrotesk-Medium text-colorblue100 mt-2">Frank Knight</h6>
                    <span class="badge badge-secondary font-familyFreightTextProMedium-Italic font-size13px pl-3 pr-3 pt-2 pb-2 mb-3">Student</span>
                    <p class="font-familyAtlasGroteskWeb-Medium text-colorblue200 mb-2"><span class="opacity0point5">Joined:</span> Jan 12, 2020</p>
                    <p class="font-familyAtlasGroteskWeb-Medium text-colorblue200 mb-0"><span class="opacity0point5">Posts:</span> 2.8k</p>
                </div>
                <div class="col-md-12 p-4">
                    <form>
                        <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                            <label for="banReason" class="mb-0 text-colorblue100">Select Ban Reason</label>
                            <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Choose the correct reason of Ban.</p>
                            <select class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue">
                                    <option value="">-- Please Select --</option>
                                    <option>item 1</option>
                                    <option>item 2</option>
                                    <option>item 3</option>
                                </select>
                        </div>
                        <p class="font-familyAtlasGroteskWeb-Medium text-colorblue200 opacity0point5"> Or</p>

                        <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100">
                            <label for="writeBanReason" class="mb-0">Write Ban Reason</label>
                            <div class="col-md-12 font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">
                                <p class="float-left">Write the correct reason of Ban.</p>
                            </div>
                            <textarea class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="writeBanReason" placeholder="" rows="6" cols="260"></textarea>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer box-shadow">
                <button type="button" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar">
                        <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">BAN USER <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                        <div class="btn-bar"></div>
                    </button>
            </div>
        </div>
    </div>
</div>

@endsection @section('style')
<link href="{{ asset('css/textarea/jquery.classyedit.css') }}" rel="stylesheet"> @endsection @section('script')
<script src="{{ asset('js/textarea/jquery.classyedit.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $(".classy-editor").ClassyEdit();
    });
</script>
<script src="{{ asset('js/discussionBoard.js') }}"></script>
@endsection
