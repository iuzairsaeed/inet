@extends('layouts.app') @section('title') INET ED Platform :: Dashboard @endsection @section('content') @include('include.header')

@auth
<input type="hidden" id="c_user_id" value="{{ Auth::user()->id }}">
<input type="hidden" id="c_role_id" value="{{ Auth::user()->role_id }}">
<input type="hidden" id="c_moderator" value="{{ Auth::user()->moderator }}">
@endauth

<section class="pt-4 pb-4 bg-white">
    <div class="container">



        <a class="text-colorMahroon700" href="{{ route('contentSuggestion', ['board_id' => Request::get('board_id')]) }}">
            <h6 class=""><i class="fas fa-step-backward"></i> Back</h6>
        </a>

        <div class="row">
            <div class="col-md-12 mb-4">
                <h6 class="text-colorblue100 font-familyAtlasGroteskWeb-Medium mb-3">{{ $thread->title }}
                  @if ($thread->closed_at)
                    <span>[CLOSED]</span>
                  @endif
                </h6>
                <div class="media">
                    <div class="thumbnailImg_WHN3 thumbnailImg overflow-hidden" style="background: url('http://pro.celeritas-solutions.com/inetEDPlatform//public/uploads/profile_images/{{ $thread->author_avatar }}') no-repeat; background-size: cover;">
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

                        </div>
                        <div class="col-md-4 dashboardDataTable dashboardDataTable2 d-flex justify-content-end">
                            <div id="alertsBox" class="alert alert-success border-radius0px font-familyAtlasGroteskWeb-Medium font-size13px boxPos" role="alert" style="display: none;">The link is ready to be pasted.</div>
                            <span class="text-ferozy pr-3 font-familyAtlasGroteskWeb-Bold font-size12px align-self-center" onclick="Copy()"><span>SHARE</span> <i class="fas fa-angle-down text-colorMahroon700 ml-2"></i></span>
                            <input type="text" id="linkshare" style="position: absolute;left: -999em;" aria-hidden="true">

                            @auth
                            {{-- <span class="font-familyAtlasGroteskWeb-Bold text-colorblue200 opacity0point5 font-size12px align-self-center">Watch Thread</span> --}}
                            <ul class="navbar-nav align-self-center font-familyFreightTextProLight-Regular width23px">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle p-0 text-lightGaray ml-3" href="#" id="listViewMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu margin-top2em widthMin15rem border-radius0px right0 aPading" aria-labelledby="listViewMenu">
                                        <div class="col pl-0 pr-0">
                                            @if (Auth::user()->role_id == 1 || Auth::user()->moderator == 1 || $thread->user_id == Auth::user()->id)
                                            <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#moadalPostThread"><i class="far fa-edit mr-2"></i> <span>Edit Thread</span></a>
                                            @endif
                                            @if ($thread->user_id != Auth::user()->id)
                                            <a onclick="flag_thread({{ $thread->id }})" class="dropdown-item font-size14px" href="#"><i class="far fa-flag mr-2"></i> <span>Flag Thread</span></a>
                                            <a onclick="bookmark_thread({{ $thread->id }})" class="dropdown-item font-size14px" href="#"><i class="fas fa-bookmark"></i> <span>Bookmark Thread</span></a>
                                            @endif
                                            @if (Auth::user()->role_id == 1 || Auth::user()->moderator == 1 || $thread->user_id == Auth::user()->id)
                                            <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#areYouSure"><i class="far fa-trash-alt mr-2"></i> <span>Delete Thread</span></a>
                                            @endif
                                            @if (Auth::user()->role_id == 1 || Auth::user()->moderator == 1)

                                            @if ($thread->closed_at)
                                            <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#areYouSureUnClose"><i class="far fa-window-close mr-2"></i> <span>Re Open Thread</span></a>
                                            @else
                                            <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#areYouSureClose"><i class="far fa-window-close mr-2"></i> <span>Close Thread</span></a>
                                            @endif


                                            <a onclick="pinned_thread({{ $thread->id }})" class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#"><i class="fas fa-thumbtack mr-2"></i> <span>Pin Thread</span></a>

                                            <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#moadalMoveThread"><i class="fas fa-arrows-alt mr-2"></i> <span>Move Thread</span></a>
                                            @endif
                                            @if ($thread->user_id != Auth::user()->id && (Auth::user()->role_id == 1 || Auth::user()->moderator == 1))
                                            <a class="dropdown-item font-size14px" href="#" onclick="ban_post_user({{ $thread->user_id }})"><i class="fas fa-user-slash mr-2"></i> <span>Ban User</span></a>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            @endauth
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-12" >

                <div id="post_result">
                    <?php $indexcount = 1 ?>
                    @if ($thread_posts) @foreach ($thread_posts as $post)

                    <div class="col-md-12 p-0" id="thread-post-{{ $post->id }}">
                        <div class="row no-gutters">
                            <div class="col-lg-2 col-md-3 text-center mb-3">
                                <div class="col text-center mb-3">
                                    <div class="thumbnailImg_WHN5 thumbnailImg overflow-hidden mr-0 m-auto" style="background: url('http://pro.celeritas-solutions.com/inetEDPlatform//public/uploads/profile_images/{{ $post->author_avatar }}') no-repeat; background-size: cover;">
                                    </div>

                                    <p class="font-familyAtlasGrotesk-Medium text-colorblue100 mt-2 mb-2 font-size14px">{{ $post->author }}</p>
                                    <span class="badge badge-secondary font-familyFreightTextProMedium-Italic font-size12px pl-3 pr-3 pt-2 pb-2">{{ $post->author_role }}</span>
                                </div>
                                <p class="font-familyAtlasGroteskWeb-Regular text-colorblue200 font-size14px mb-1"><span class="opacity0point5">Joined:</span> {{ date("M d, Y", strtotime($post->author_joined)) }}</p>
                                <p class="font-familyAtlasGroteskWeb-Regular text-colorblue200 font-size14px"><span class="opacity0point5">Posts:</span> {{ $post->author_posts }}</p>
                                @if ($post->rank_image)
                                <img src="{{ asset('images/icons/' . $post->rank_image) }}" alt="" width="80">
                                @endif
                            </div>
                            <div class="col-lg-10 col-md-9 mb-3">
                                <div class="col-md-12 bg-lightWhite100 p-0 font-familyAtlasGroteskWeb-Regular text-colorblue200 font-size14px arrow">
                                    <div class="col-md-12 p-4">
                                        <div class="col-md-12 p-0 font-familyAtlasGroteskWeb-Regular text-colorblue200 mb-3 d-flex justify-content-between">
                                            <p class="mb-0 font-size13px align-self-center opacity0point5">{{ date("M d, Y", strtotime($post->c_at)) }} at {{ date("h:m", strtotime($post->c_at)) }}</p>
                                            <span class="badge badge-secondary2 pl-3 pr-3 pt-2 pb-2 font-size13px num">{{ $indexcount <= 9 ? '#0'.$indexcount : '#'.$indexcount }}</span>
                                            <?php $indexcount++?>

                                            @auth



                                            <ul class="navbar-nav align-self-center font-familyFreightTextProLight-Regular dashboardDataTable" style="width: 1em;">
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle p-0 text-lightGaray" href="#" id="listViewMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fas fa-ellipsis-h"></i></a>
                                                    <div class="dropdown-menu margin-top2em widthMin13rem border-radius0px right0 aPading translate3d0px1" aria-labelledby="listViewMenu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 19px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <div class="col pl-0 pr-0">
                                                            @if (Auth::user()->role_id == 1 || Auth::user()->moderator == 1 || $post->user_id == Auth::user()->id)
                                                              <a class="dropdown-item font-size14px" onclick="edit_post('{{ $post->id }}', ` {{ json_encode($post->body) }} `)"><i class="far fa-edit mr-2"></i><span>Edit Post</span>
                                                                <input type="hidden" id="get_text{{ $post->id }}" value="{{ $post->body }}">   
                                                         </a>
                                                            @endif
                                                            @if ($post->user_id != Auth::user()->id)
                                                            <a class="dropdown-item font-size14px" onclick="flag_post({{ $post->id }})"><i class="fas fa-flag mr-2"></i> <span>Flag Post</span></a>
                                                            @endif
                                                            @if (Auth::user()->role_id == 1 || Auth::user()->moderator == 1)
                                                            <a class="dropdown-item font-size14px" onclick="move_post({{ $post->id }})"><i class="fas fa-arrows-alt mr-2"></i> <span>Move Post</span></a>
                                                            @endif
                                                            @if (Auth::user()->role_id == 1 || Auth::user()->moderator == 1 || $post->user_id == Auth::user()->id)


                                                            <a class="dropdown-item font-size14px" onclick="delete_post({{ $post->id }})"><i class="far fa-trash-alt mr-2"></i> <span>Delete Post</span></a>

                                                            @endif
                                                            @if ($post->user_id != Auth::user()->id && (Auth::user()->role_id == 1 || Auth::user()->moderator == 1))
                                                            <a class="dropdown-item font-size14px" onclick="ban_post_user({{ $post->user_id }})"><i class="fas fa-user-slash mr-2"></i> <span>Ban User</span></a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            @endauth
                                        </div>

                                        <div class="p-3 post_body get_postVal{{ $post->id }}"> {!! $post->body !!} </div>
                                    </div>

                                    <div class="col-md-12 border-top p-4">
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div id="emojees-div-{{ $post->id }}" style="display:inline">
                                                    @if ($post->thumbup_count)
                                                    <i class="fas fa-thumbs-up colorBlue font-size18px cursorPointer"></i>
                                                    @endif

                                                    @if ($post->smiley_count)
                                                    <span class="font-size16px cursorPointer">&#128518;</span>
                                                    @endif

                                                    @if ($post->info_count)
                                                    <i class="fas fa-info-circle colorGreen font-size18px cursorPointer"></i>
                                                    @endif

                                                    @if ($post->agree_count)
                                                    <i class="fas fa-check-circle text-success font-size18px cursorPointer"></i>
                                                    @endif

                                                    @if ($post->respectfully_disagree_count)
                                                    <i class="fas fa-times-circle text-danger font-size18px cursorPointer"></i>
                                                    @endif
                                                </div>

                                                <span id="emojees-div-count-{{ $post->id }}" class="font-familyAtlasGroteskWeb-Medium text-ferozy font-size14px ml-1">{{ ($post->thumbup_count + $post->smiley_count + $post->info_count + $post->agree_count + $post->respectfully_disagree_count > 0 ? $post->thumbup_count + $post->smiley_count + $post->info_count + $post->agree_count + $post->respectfully_disagree_count : '' ) }}</span>
                                            </div>

                                            <div class="col-md-6 text-right align-self-center dashboardDataTable">
                                                <div class="btn-group dropup">
                                                    <a href="#" class="dropdown-toggle text-decoration-none" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-thumbs-up colorBlue font-size18px"></i>
                                                        <span class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size12px ml-1">LIKE</span>
                                                    </a>

                                                    <div class="dropdown-menu emojies animated fadeIn">
                                                        <div class="d-flex">
                                                            <i onclick="likepost({{ $post->id }}, 'thumbup')" class="fas fa-thumbs-up colorBlue font-size32px cursorPointer align-self-center"></i>
                                                            <i onclick="likepost({{ $post->id }}, 'info')" class="fas fa-info-circle colorGreen font-size38px cursorPointer align-self-center"></i>
                                                            <i onclick="likepost({{ $post->id }}, 'agree')" class="fas fa-check-circle text-success font-size38px cursorPointer align-self-center"></i>
                                                            <i onclick="likepost({{ $post->id }}, 'respectfully_disagree')" class="fas fa-times-circle text-danger font-size38px cursorPointer align-self-center"></i>
                                                            <i onclick="likepost({{ $post->id }}, 'smiley')" class="fas fa-laugh-squint text-yellow font-size38px cursorPointer align-self-center"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <i onclick="repied_on_post({{ $post->id }}, '{{ $post->author }}', `{{ $post->body }}`)" class="fas fa-reply font-size18px text-colorblue100 ml-3 cursorPointer"></i>
                                                <span onclick=" ({{ $post->id }}, '{{ $post->author }}', `{{ $post->body }}`)" class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size12px ml-1 cursorPointer">REPLY</span>
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

                @if(!$thread->closed_at && Auth::check() && !$ban_user)
                <div class="col-md-12 p-0" id="reply_post">
                   <form id="editForm" >
                        @csrf

                        <input type="hidden" id="board_id" name="board_id" value="{{ Request::get('board_id') }}">
                        <input type="hidden" id="thread_id" name="thread_id" value="{{ Request::get('thread_id') }}">
                        <input type="hidden" id="post_id" name="post_id" value="">
                        <input type="hidden" id="repied_on_post_id" name="repied_on_post_id" value="">

                        <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-4 h-textEditor">
                            <label for="body" class="">Your Answer</label>
                            <textarea id="summernote" name="body"></textarea>
                        </div>

                        <p id="post-form-err" style="color:red"></p>

                        <button type="button" id="editPostBtn" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px p-0 border-radius0px btnBotmBar">
                            <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">POST<i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                            <div class="btn-bar"></div>
                        </button>
                    </form>
                </div>
                @endif
            </div>





        </div>

         <!-- Pagination at bottom -->
 <div class="row">
    <div class="col-md-6"></div>

      <div class="col-md-6">

          <nav aria-label="Page navigation" style="float: right;">
              @if ($thread_posts_pages > 1)
              <ul class="pagination font-familyAtlasGrotesk-Regular text-colorblue100 font-size12px" id="post_pagination">
                  <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1"><i class="fas fa-arrow-left"></i></a></li>

                  <?php
                      for ($i=0; $i < $thread_posts_pages; $i++) {
                          $page = $i + 1;
                          $default_active = $page == 1 ? 'active disabled' : '';
                          echo "<li class='page-item $default_active' ><a class='page-link' onclick='change_thread_post_page($page)'>$page</a></li>";
                      }
                  ?>

                  <li class="page-item"><a class="page-link" onclick='change_thread_post_page(2)'><i class="fas fa-arrow-right"></i></a></li>
              </ul>
              @endif
          </nav>
      </div>

  </div>


        </div>





    </div>
</section>

@include('include.footer')

<form id="deletethread" action="{{ route('deletethread') }}" method="POST">
    @csrf
    <input type="hidden" name="board_id" value="{{ Request::get('board_id') }}">
    <input type="hidden" name="thread_id" value="{{ $thread->id }}">
</form>

<!-- Modal Are You Sure! -->
<div class="modal fade" id="areYouSure" tabindex="-1" role="dialog" aria-labelledby="areYouSureTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered max-width-630px" role="document">
        <div class="modal-content border-radius0px">
            <div class="modal-body p-5">
                <p class="mb-0 font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size14px mb-0">Are you sure you want to delete this thread?</p>
                <p class="font-familyAtlasGroteskWeb-Light text-colorblue200 opacity0point5 font-size14px mb-0">You can also repost the thread again from the discussion board drop-down.</p>
            </div>
            <div class="modal-footer">
                <a href="#" class="font-familyAtlasGroteskWeb-Bold font-size12px align-self-center" data-dismiss="modal" aria-label="Close">CANCEL</a>
                <button form="deletethread" type="submit" class="btn btn-customBtn3 text-colorMahroon700 font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar ml-3 ">
                    <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">DELETE <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                    <div class="btn-bar"></div>
                </button>
            </div>
        </div>
    </div>
</div>

<form id="closethread" action="{{ route('closethread') }}" method="POST">
    @csrf
    <input type="hidden" name="thread_id" value="{{ $thread->id }}">
</form>

<!-- Modal Are You Sure! close thread -->
<div class="modal fade" id="areYouSureClose" tabindex="-1" role="dialog" aria-labelledby="areYouSureCloseTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered max-width-630px" role="document">
        <div class="modal-content border-radius0px">
            <div class="modal-body p-5">
                <p class="mb-0 font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size14px mb-0">Are you sure you want to close this thread?</p>
                <p class="font-familyAtlasGroteskWeb-Light text-colorblue200 opacity0point5 font-size14px mb-0">You can also repost the thread again from the discussion board drop-down.</p>
            </div>
            <div class="modal-footer">
                <a href="#" class="font-familyAtlasGroteskWeb-Bold font-size12px align-self-center" data-dismiss="modal" aria-label="Close">CANCEL</a>
                <button form="closethread" type="submit" class="btn btn-customBtn3 text-colorMahroon700 font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar ml-3 ">
                    <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">CLOSE <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                    <div class="btn-bar"></div>
                </button>
            </div>
        </div>
    </div>
</div>

<form id="unclosethread" action="{{ route('unclosethread') }}" method="POST">
    @csrf
    <input type="hidden" name="thread_id" value="{{ $thread->id }}">
</form>

<!-- Modal Are You Sure! close thread -->
<div class="modal fade" id="areYouSureUnClose" tabindex="-1" role="dialog" aria-labelledby="areYouSureCloseTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered max-width-630px" role="document">
        <div class="modal-content border-radius0px">
            <div class="modal-body p-5">
                <p class="mb-0 font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size14px mb-0">Are you sure you want to un close this thread?</p>
                <p class="font-familyAtlasGroteskWeb-Light text-colorblue200 opacity0point5 font-size14px mb-0">You can also repost the thread again from the discussion board drop-down.</p>
            </div>
            <div class="modal-footer">
                <a href="#" class="font-familyAtlasGroteskWeb-Bold font-size12px align-self-center" data-dismiss="modal" aria-label="Close">CANCEL</a>
                <button form="unclosethread" type="submit" class="btn btn-customBtn3 text-colorMahroon700 font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar ml-3 ">
                    <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">UN CLOSE <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                    <div class="btn-bar"></div>
                </button>
            </div>
        </div>
    </div>
</div>



<!-- Modal Are You Sure! -->
<div class="modal fade" id="areYouSurePostDeleteClose" tabindex="-1" role="dialog" aria-labelledby="areYouSurePostDeleteCloseTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered max-width-630px" role="document">
        <div class="modal-content border-radius0px">
            <div class="modal-body p-5">
                <p class="mb-0 font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size14px mb-0">Are you sure you want to delete this message?</p>
                <p class="font-familyAtlasGroteskWeb-Light text-colorblue200 opacity0point5 font-size14px mb-0">You can also repost the message again from the bottom form.</p>
            </div>
            <div class="modal-footer">
                <a href="#" class="font-familyAtlasGroteskWeb-Bold font-size12px align-self-center" data-dismiss="modal" aria-label="Close">CANCEL</a>
                <button id="delete_post_btn" type="button" class="btn btn-customBtn3 text-colorMahroon700 font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar ml-3 ">
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
                @if ($diss_board_cat)
                    @foreach ($diss_board_cat as $category)
                    <div class="col p-0">
                        <div class="col-md-12 bg-gray900 p-4">
                            <h6 class="text-black font-familyAtlasGroteskWeb-Bold mb-0">{{ $category->name }}</h6>
                        </div>

                        @if ($diss_board)
                            @foreach ($diss_board as $board)
                                @if ($board->diss_board_cat_id == $category->id)
                                    <div class="col-md-12 bg-lightWhite600 pr-4 pl-4 p-3 border-bottom board_tap">
                                        <input type="hidden" class="move_thread_board_id" value="{{ $board->id }}">

                                        <div class="row justify-content-between">
                                            <div class="col-lg-6 col-md-12 d-flex align-self-center">
                                                <p class="mb-0 font-familyAtlasGroteskWeb-Regular text-colorblue200 board_tap_title">{{ $board->title }}</p>
                                            </div>
                                            <div class="col-lg-4 col-md-12 text-center">
                                                <div class="row justify-content-end no-gutters">
                                                    <span class="font-size13px">
                                                        <p class="mb-0 font-familyAtlasGroteskWeb-Medium text-colorblue200 opacity0point5 board_tap_threads_count">{{ $board->threads_count }}</p>
                                                        <p class="mb-0 font-familyAtlasGroteskWeb-Regular font-size12px text-colorblue200 opacity0point5 board_tap_threads">Threads</p>
                                                    </span>
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
            <div class="modal-footer box-shadow">
                <button id="board_tap_btn" disabled type="button" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar">
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
                @if ($diss_board_cat)
                    @foreach ($diss_board_cat as $category)
                    <div class="col p-0">
                        <div class="col-md-12 bg-gray900 p-4">
                            <h6 class="text-black font-familyAtlasGroteskWeb-Bold mb-0">{{ $category->name }}</h6>
                        </div>

                        @if ($diss_board)
                            @foreach ($diss_board as $board)
                                @if ($board->diss_board_cat_id == $category->id)
                                    <div class="col-md-12 bg-lightWhite600 pr-4 pl-4 p-3 border-bottom move_post_tap">
                                        <input type="hidden" class="move_post_board_id" value="{{ $board->id }}">

                                        <div class="row justify-content-between">
                                            <div class="col-lg-6 col-md-12 d-flex align-self-center">
                                                <p class="mb-0 font-familyAtlasGroteskWeb-Regular text-colorblue200 move_post_tap_title">{{ $board->title }}</p>
                                            </div>
                                            <div class="col-lg-4 col-md-12 text-center">
                                                <div class="row justify-content-end no-gutters">
                                                    <span class="font-size13px">
                                                        <p class="mb-0 font-familyAtlasGroteskWeb-Medium text-colorblue200 opacity0point5 move_post_tap_count">{{ $board->threads_count }}</p>
                                                        <p class="mb-0 font-familyAtlasGroteskWeb-Regular font-size12px text-colorblue200 opacity0point5 move_post_tap_thread">Threads</p>
                                                    </span>
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
            <div class="modal-footer justify-content-between box-shadow">
                <p class="font-familyAtlasGroteskWeb-Medium font-size12px text-colorMahroon600">*Choose which board to move the post in.</p>
                <button id="move_post_tap_btn" disabled="disabled" type="button" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar" onclick="move_post_step_2()">
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
                            <p class="font-familyAtlasGroteskWeb-Light text-colorblue200 mb-0">You can quickly move post in any thread</p>
                        </div>
                        <div class="col-md-4 align-self-center">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control font-familyFreightTextProLight-Regular text-colorblue200 pr-5 font-size14px" id="search" placeholder="Search Thread">
                                <i class="fas fa-search text-colorblue200 searchIcon"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col p-0 movePost_a" id="move_post_threads"></div>
            </div>
            <div class="modal-footer box-shadow">
                <p class="font-familyAtlasGroteskWeb-Medium font-size12px text-colorMahroon600" style="position: absolute; left: 25px;">*Choose which thread to move the post in.</p>
                <button type="button" class="btn btn-customBtn4 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar" onclick="movePostStep1()">
                    <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block"><i class="fas fa-angle-left text-colorblue200"></i></span>
                    <div class="btn-bar"></div>
                </button>
                <button id="move_post2_tap_btn" type="button" disabled="disabled" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar">
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
                    <div id="ban_user_avatar" class="thumbnailImg_WHN9 thumbnailImg overflow-hidden mr-0 m-auto"></div>
                    <h6 id="ban_user_name" class="mt-0 font-familyAtlasGrotesk-Medium text-colorblue100 mt-2">{{ $thread->author }}</h6>
                    <span id="ban_user_role" class="badge badge-secondary font-familyFreightTextProMedium-Italic font-size13px pl-3 pr-3 pt-2 pb-2 mb-3">{{ $thread->role }}</span>
                    <p id="ban_user_joined" class="font-familyAtlasGroteskWeb-Medium text-colorblue200 mb-2"><span class="opacity0point5">Joined:</span> {{ date("M d, Y", strtotime($thread->author_joined)) }}</p>
                    <p id="ban_user_posts" class="font-familyAtlasGroteskWeb-Medium text-colorblue200 mb-0"><span class="opacity0point5">Posts:</span> {{ $thread->author_post }}</p>
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

<!-- Modal POST THREAD -->
<div class="modal fade p-0" id="moadalPostThread" tabindex="-1" role="dialog" aria-labelledby="moadalPostThread" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered max-width-630px p-md-0 p-3" role="document">
        <div class="modal-content border-radius0px">
            <div class="modal-header p-4">
                <h6 class="modal-title font-familyAtlasGroteskWeb-Bold text-colorblue100 text-uppercase">POST THREAD</h6>
                <button type="button" class="close outlineNone text-colorMahroon700" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body p-4">
                <div class="row">
                    <div class="col-md-12">
                        <form id="diss_board_thread" action="{{ route('postThread') }}" method="POST">
                            @csrf

                            <input type="hidden" name="board_id" value="{{ Request::get('board_id') }}">
                            <input type="hidden" name="thread_id" value="{{ $thread->id }}">

                            <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                <label for="title" class="mb-0 text-colorblue100">Title</label>
                                <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Be specific and imagine youÃ¢â‚¬â„¢re asking a question to another person.</p>
                                <input type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="title" name="title" placeholder="Thread title" value="{{ $thread->title }}">
                            </div>

                            {{-- <div class="col-md-12 p-0">
                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="body" class="">Body</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Include all the information someone would need to answer your question.</p>
                                    <textarea class="form-control classy-editor" id="body" name="body" placeholder="" rows="6" cols="260"></textarea>
                                </div>
                            </div> --}}

                        </form>
                    </div>
                </div>

            </div>
            <div class="modal-footer box-shadow">
                <button type="submit" form="diss_board_thread" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar">
                    <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">POST THREAD <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                    <div class="btn-bar"></div>
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('style')
    {{-- <link href="{{ asset('css/textEditor/summernote.min.css') }}" rel="stylesheet"> --}}
    <style>
        .num{
            position: absolute;
            right: 21px;
            top: -6px;
        }
        .post_body { height: auto; overflow: auto;}

    </style>
@endsection

@section('script')
<script src="https://cdn.tiny.cloud/1/menglvwei69s5pqkk3gsz8ta5ltcq2dy3ejucumslqlct1r3/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>


<script>
   tinymce.init({   
      selector: '#summernote',
      plugins: 'mentions a11ychecker advcode casechange formatpainter  autolink lists checklist media mediaembed pageembed permanentpen  table preview  tinycomments tinymcespellchecker fullscreen anchor   image code imagetools emoticons link ',
      toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | preview | link image | print  media fullpage | forecolor backcolor emoticons | code ',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
	  file_picker_types: 'file image media',
      mentions_selector: '.mymention',
  mentions_fetch: mentions_fetch,
  mentions_menu_hover: mentions_menu_hover,
  mentions_menu_complete: mentions_menu_complete,
  mentions_select: mentions_select,
  mentions_item_type: 'profile',
	  convert_urls: false,
	    /* enable title field in the Image dialog*/
  image_title: true,
  /* enable automatic uploads of images represented by blob or data URIs*/
  automatic_uploads: true,
  /*
    URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
    images_upload_url: 'postAcceptor.php',
    here we add custom filepicker only to Image dialog
  */
  file_picker_types: 'image',
  /* and here's our custom image picker*/
  file_picker_callback: function (cb, value, meta) {
    var input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*');

    /*
      Note: In modern browsers input[type="file"] is functional without
      even adding it to the DOM, but that might not be the case in some older
      or quirky browsers like IE, so you might want to add it to the DOM
      just in case, and visually hide it. And do not forget do remove it
      once you do not need it anymore.
    */

    input.onchange = function () {
      var file = this.files[0];

      var reader = new FileReader();
      reader.onload = function () {
        /*
          Note: Now we need to register the blob in TinyMCEs image blob
          registry. In the next release this part hopefully won't be
          necessary, as we are looking to handle it internally.
        */
        var id = 'blobid' + (new Date()).getTime();
        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
        var base64 = reader.result.split(',')[1];
        var blobInfo = blobCache.create(id, file, base64);
        blobCache.add(blobInfo);

        /* call the callback and populate the Title field with the file name */
        cb(blobInfo.blobUri(), { title: file.name });
      };
      reader.readAsDataURL(file);
    };

    input.click();
  },
    });

$(document).ready(function(){
    $('#post_result a').attr('target', '_blank');
 });
  </script>
    {{-- <script src="{{ asset('js/textEditor/summernote.js') }}"></script> 
    <script type="text/javascript">
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>--}}

    <script src="{{ asset('js/discussionBoard.js') }}"></script>
@endsection
