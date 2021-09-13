@extends('layouts.app') @section('title') INET ED Platform :: Dashboard @endsection @section('content') @include('include.header')

@Auth
<input type="hidden" id="c_user_name" value="{{ Auth::user()->name }}">
<input type="hidden" id="c_user_id" value="{{ Auth::user()->id }}">
<input type="hidden" id="c_role_id" value="{{ Auth::user()->role_id }}">
<input type="hidden" id="c_moderator" value="{{ Auth::user()->moderator }}">
@endauth
<section class="pt-4 pb-5 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4">
                <h6 class="font-familyAtlasGroteskWeb-Regular text-colorMahroon700"><a class="text-colorMahroon700" href="{{ route('discussionBoard') }}">{{ $board->board_cat }}</a></h6>
                <div class="col-md-12">
                    <div class="row justify-content-between">
                        <h3 class="text-black font-familyAtlasGroteskWeb-Bold mb-0">{{ $board->title }}</h3>
                        @if (Auth::check() && !$ban_user)
                        <div class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px p-0 border-radius0px btnBotmBar">
                            <span onclick="openPop()" class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block text-uppercase">POST THREAD <i class="fas fa-plus ml-3 text-colorMahroon100"></i></span>
                            <div class="btn-bar"></div>
                        </div>
                        @endif
                    </div>
                </div>

            </div>
            <div class="col-md-12 list-groupCusMain mb-2">
                <div class="list-group  font-familyAtlasGroteskWeb-Regular text-colorblue100 font-size14px border-bottom" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-Newest-list" data-toggle="list" href="#pg-newest" role="tab" aria-controls="Newest">Threads</a>
                    <a class="list-group-item list-group-item-action" id="list-WatchedThreads-list" data-toggle="list" href="#pg-watchedThreads" role="tab" aria-controls="Watched Threads">Bookmarked Threads</a>
                    <a class="list-group-item list-group-item-action" id="list-YourPosts-list" data-toggle="list" href="#pg-yourPosts" role="tab" aria-controls="YourPosts">Your Posts</a>
                    <a class="list-group-item list-group-item-action" id="list-FlagThreads-list" data-toggle="list" href="#pg-flagThreads" role="tab" aria-controls="FlagThreads">Flag Threads</a>
                    <a class="list-group-item list-group-item-action" id="list-FlagPosts-list" data-toggle="list" href="#pg-flagPosts" role="tab" aria-controls="FlagPosts">Flag Posts</a>
                    {{-- <a class="list-group-item list-group-item-action" id="list-Search-list" data-toggle="list" href="#pg-search" role="tab" aria-controls="Search">Search</a>
                    <a class="list-group-item list-group-item-action font-familyAtlasGroteskWeb-Bold font-size12px text-right pr-0 text-ferozy" href="#">FILTER<i class="fas fa-angle-down text-colorMahroon700 ml-3"></i></a> --}}
                </div>
            </div>
            <div class="col-md-12">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active horizontalScroll" id="pg-newest" role="tabpanel" aria-labelledby="Newest">
                        @if (!$diss_board_thread)
                            <h6 class="mt-5 mb-5">Newest Thread Content Not Available</h6>
                        @else
                            <table class="table font-familyAtlasGroteskWeb-Medium contSuggTable">
                                <tbody id="thread_result">
                                    @if ($diss_board_thread)
                                        @foreach ($diss_board_thread as $thread)
                                            <tr class="border-bottom">
                                                <td class="">
                                                    <p class="text-colorblue100 font-size12px"><a class="text-colorblue100 font-size16px" href="{{ route('thread_posts', ['board_id' => Request::get('board_id'), 'thread_id' => $thread->id]) }} ">{{ $thread->title }}</a></p>
                                                    <div class="media">
                                                       <a class="text-colorblue100 font-size14px" href="{!! route('discBoardprofile', ['u_id' =>  $thread->author_id]) !!}">
                                                        <div class="thumbnailImg_WHN3 thumbnailImg overflow-hidden" style="background: url('https://ineted.org/public/uploads/profile_images/{{ $thread->author_avatar }}') no-repeat; background-size: cover;">
                                                        </div>
                                                        </a>
                                                        <div class="media-body align-self-center d-flex">
                                                            <p class="mt-0 mb-0 font-familyAtlasGrotesk-Medium text-colorblue100 font-size12px align-self-center">
                                                                <a class="text-colorblue100 font-size14px" href="{!! route('discBoardprofile', ['u_id' =>  $thread->author_id]) !!}">
                                                                <span class="align-self-center mr-2">{{ $thread->author }}</span>
                                                                </a>
                                                                 <span class="badge badge-secondary font-familyFreightTextProMedium-Italic pl-3 pr-3 pt-2 pb-2">{{ $thread->role }}</span></p>
                                                            <span class="text-colorblue200 opacity0point5 mr-3 ml-3 align-self-center">|</span>
                                                            <div class="align-self-center">
                                                                <span class="align-self-center"><img src="{{ asset('images/icons/pencil.png') }}" alt="" width="20" class="mr-2"></span>
                                                                <span class="text-colorblue200 font-familyAtlasGroteskWeb-Regular font-size13px opacity0point5 align-self-center">{{ date("M d, Y", strtotime($thread->c_at)) }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="d-flex justify-content-end">
                                                            <span class="text-colorblue200 font-familyAtlasGroteskWeb-Regular font-size13px opacity0point5 align-self-center mr-3">Jump To</span>
                                                            <nav aria-label="Page navigation">
                                                                <ul class="pagination font-familyAtlasGrotesk-Regular font-size14px mb-0">
                                                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                                </ul>
                                                            </nav>
                                                        </div> --}}

                                                </td>
                                                <td class="verticalalign" width="10%">
                                                    <div class="text-center bg-lightWhite100 p-3 font-size14px">
                                                        <p class="mb-0 font-familyAtlasGroteskWeb-Medium text-colorblue100">{{ $thread->replies_count }}</p>
                                                        <p class="mb-0 font-familyAtlasGroteskWeb-Regular text-colorblue200 opacity0point5">Replies</p>
                                                        <i class="far fa-comments text-ferozy"></i>
                                                    </div>
                                                </td>
                                                <td class="verticalalign" width="10%">
                                                    <div class="text-center bg-lightWhite100 p-3 font-size14px">
                                                        <p class="mb-0 font-familyAtlasGroteskWeb-Medium text-colorblue100">{{ $thread->views_count }}</p>
                                                        <p class="mb-0 font-familyAtlasGroteskWeb-Regular text-colorblue200 opacity0point5">Views</p>
                                                        <i class="far fa-eye text-ferozy"></i>
                                                    </div>
                                                </td>
                                                <td class="text-center verticalalign">
                                                    @if($thread->pinned)
                                                        <div class="badge badge-secondary font-familyFreightTextProMedium-Italic pl-3 pr-3 pt-2 pb-2"><i class="fas fa-thumbtack mr-2"></i><span>Pinned</span></div>
                                                    @endif
                                                </td>
                                                <td class="text-center verticalalign">
                                                    @if($thread->pinned && Auth::user()->role_id == 1)

                                                <a onclick="unpinned_thread({{ $thread->id }})">
                                                    <div class="badge badge-secondary font-familyFreightTextProMedium-Italic pl-3 pr-3 pt-2 pb-2" style="cursor: pointer;">
                                                        <i class="fas fa-thumbtack mr-2" style="transform: rotate(180deg);"></i>
                                                        <span>Un Pin</span>
                                                    </div>
                                                </a>
                                                    @endif
                                                </td>
                                                <td class="verticalalign">
                                                    @if ($thread->l_reply_at)
                                                    <div class="media text-right">
                                                        <div class="media-body align-self-center text-right">
                                                            <div class="align-self-center">
                                                                <span class="align-self-center"><img src="{{ asset('images/icons/pencil.png') }}" alt="" width="20" class="mr-2"></span>
                                                                <span class="text-colorblue200 font-familyAtlasGroteskWeb-Regular font-size13px opacity0point5 align-self-center">{{ date("M d, Y", strtotime($thread->last_reply_post->c_at)) }}</span>
                                                            </div>
                                                            <p class="mt-0 mb-0 font-familyAtlasGrotesk-Medium text-colorblue100 font-size14px align-self-center">
                                                                <span class="align-self-center">
                                                                {{ isset($thread->last_reply_user->name) ? $thread->last_reply_user->name:''}}
                                                                </span>
                                                            </p>
                                                        </div>

                                                        <div class="thumbnailImg_WHN3 thumbnailImg overflow-hidden ml-2 mr-0" style="background: url( 'https://ineted.org/public/uploads/profile_images/{{ $thread->last_reply_profile->profile_pic_url }}') no-repeat; background-size: cover;">
                                                        </div>
                                                    </div>
                                                    @endif
                                                </td>
                                            </tr>

                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        @endif

                        <div class="col-md-12 p-0 mt-5 mb-5">
                            <nav aria-label="Page navigation">
                                @if ($thread_pages > 1)
                                    <ul class="pagination justify-content-end font-familyAtlasGrotesk-Regular text-colorblue100 font-size14px" id="thread_pagination">
                                        <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Previous</a></li>

                                        <?php
                                            for ($i=0; $i < $thread_pages; $i++) {
                                                $page = $i + 1;
                                                $default_active = $page == 1 ? 'active disabled' : '';
                                                echo "<li class='page-item $default_active' ><a class='page-link' onclick='change_thread_page($page)'>$page</a></li>";
                                            }
                                        ?>

                                        <li class="page-item"><a class="page-link" onclick='change_thread_page(2)'>Next</a></li>
                                    </ul>
                                @endif
                            </nav>
                        </div>

                    </div>

                    <div class="tab-pane fade" id="pg-watchedThreads" role="tabpanel" aria-labelledby="WatchedThreads">
                        @if (!$watched_threads)
                            <h6 class="mt-5 mb-5">Watched Threads Content Not Available</h6>
                        @else
                            <table class="table font-familyAtlasGroteskWeb-Medium contSuggTable">
                                <tbody id="watched_thread_result">
                                    @if ($watched_threads)
                                        @foreach ($watched_threads as $thread)
                                            <tr class="border-bottom">
                                                <td class="">
                                                    <p class="text-colorblue100 font-size13px"><a class="text-colorblue100 font-size16px" href="{{ route('thread_posts', ['board_id' => Request::get('board_id'), 'thread_id' => $thread->id]) }} ">{{ $thread->title }}</a></p>

                                                    <div class="media">
                                                        <div class="thumbnailImg_WHN3 thumbnailImg overflow-hidden" style="background: url('https://ineted.org/public/uploads/profile_images/{{ $thread->author_avatar }}') no-repeat; background-size: cover;">
                                                        </div>
                                                        <div class="media-body align-self-center d-flex">
                                                            <p class="mt-0 mb-0 font-familyAtlasGrotesk-Medium text-colorblue100 font-size12px align-self-center"><span class="align-self-center mr-2">{{ $thread->author }}</span> <span class="badge badge-secondary font-familyFreightTextProMedium-Italic pl-3 pr-3 pt-2 pb-2">{{ $thread->role }}</span></p>
                                                            <span class="text-colorblue200 opacity0point5 mr-3 ml-3 align-self-center">|</span>
                                                            <div class="align-self-center">
                                                                <span class="align-self-center"><img src="{{ asset('images/icons/pencil.png') }}" alt="" width="20" class="mr-2"></span>
                                                                <span class="text-colorblue200 font-familyAtlasGroteskWeb-Regular font-size13px opacity0point5 align-self-center">{{ date("M d, Y", strtotime($thread->c_at)) }}</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </td>


                                            <td class="text-center verticalalign">
                                                <a onclick="unwatch_thread({!! $thread->id !!})">
                                                    <div class="badge badge-secondary font-familyFreightTextProMedium-Italic pl-3 pr-3 pt-2 pb-2" style="cursor: pointer;">
                                                        <i class="far fa-bookmark"></i>
                                                        <span>Unbookmark thread</span>
                                                    </div>
                                                </a>
                                            </td>



                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        @endif

                        <div class="col-md-12 p-0 mt-5 mb-5">
                            <nav aria-label="Page navigation">
                                @if (Auth::check() && $watched_threads_pages > 1)
                                    <ul class="pagination justify-content-end font-familyAtlasGrotesk-Regular text-colorblue100 font-size14px" id="watched_thread_pagination">
                                        <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Previous</a></li>

                                        <?php
                                            for ($i=0; $i < $watched_threads_pages; $i++) {
                                                $page = $i + 1;
                                                $default_active = $page == 1 ? 'active disabled' : '';
                                                echo "<li class='page-item $default_active' ><a class='page-link' onclick='change_watched_thread_page($page)'>$page</a></li>";
                                            }
                                        ?>

                                        <li class="page-item"><a class="page-link" onclick='change_watched_thread_page(2)'>Next</a></li>
                                    </ul>
                                @endif
                            </nav>
                        </div>

                    </div>

                    <div class="tab-pane fade" id="pg-yourPosts" role="tabpanel" aria-labelledby="YourPosts">

                        @if (!$your_posts)
                            <h6 class="mt-5 mb-5">Your Post Content Not Available</h6>
                        @else
                            <div id="your_posts_result">
                                @if ($your_posts)
                                    @foreach ($your_posts as $post)
                                        <div class="col-md-12 border-bottom p-0 pt-4">
                                            <div class="row no-gutters">
                                                <div class="col-md-8 nb-3">
                                                    <a class="text-colorblue100 font-familyAtlasGroteskWeb-Medium mb-0 font-size14px" href="{{ route('thread_posts', ['board_id' => Request::get('board_id'), 'thread_id' => $post->thread_id]) }} ">{{ $post->thread }}</a>
                                                </div>
                                                <div class="col-md-4 text-right d-flex align-self-center font-familyAtlasGroteskWeb-Medium justify-content-end mb-3">
                                                </div>

                                                <div class="col-lg-2 col-md-3 text-center mb-3">
                                                    <div class="col text-center mb-3">
                                                        <div class="thumbnailImg_WHN5 thumbnailImg overflow-hidden mr-0 m-auto" style="background: url('https://ineted.org/public/uploads/profile_images/{{ $post->author_avatar }}') no-repeat; background-size: cover;">
                                                        </div>

                                                        <p class="font-familyAtlasGrotesk-Medium text-colorblue100 mt-2 mb-2 font-size14px">{{ $post->author }}</p>
                                                        <span class="badge badge-secondary font-familyFreightTextProMedium-Italic font-size12px pl-3 pr-3 pt-2 pb-2">{{ $post->role }}</span>
                                                    </div>

                                                </div>

                                                <div class="col-lg-10 col-md-9 mb-3">
                                                    <div class="col-md-12 bg-lightWhite100 p-0 font-familyAtlasGroteskWeb-Regular text-colorblue200 font-size13px arrow">
                                                        <div class="col-md-12 p-4">
                                                            <div class="col-md-12 p-0 font-familyAtlasGroteskWeb-Regular text-colorblue200 mb-3 d-flex justify-content-between">
                                                                <div class="col-md-6 p-0 align-self-center ">
                                                                    <p class="mb-0 font-size13pxopacity0point5">{{ date("M d, Y", strtotime($post->c_at)) }} at {{ date("h:m", strtotime($post->c_at)) }}</p>
                                                                </div>
                                                                <div class="col-md-6 p-0 text-right">
                                                                </div>
                                                            </div>
                                                            <p>{!! $post->body !!}</p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        @endif

                        <div class="col-md-12 p-0 mt-5 mb-5">
                            <nav aria-label="Page navigation">
                                @if (Auth::check() && $your_posts_pages > 1)
                                    <ul class="pagination justify-content-end font-familyAtlasGrotesk-Regular text-colorblue100 font-size14px" id="your_post_page_pagination">
                                        <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Previous</a></li>

                                        <?php
                                            for ($i=0; $i < $your_posts_pages; $i++) {
                                                $page = $i + 1;
                                                $default_active = $page == 1 ? 'active disabled' : '';
                                                echo "<li class='page-item $default_active' ><a class='page-link' onclick='change_your_post_page($page)'>$page</a></li>";
                                            }
                                        ?>

                                        <li class="page-item"><a class="page-link" onclick='change_your_post_page(2)'>Next</a></li>
                                    </ul>
                                @endif
                            </nav>
                        </div>

                    </div>

                    <div class="tab-pane fade" id="pg-flagThreads" role="tabpanel" aria-labelledby="FlagThreads">
                        @if (!$flag_threads)
                            <h6 class="mt-5 mb-5">Flag Thread Content Not Available</h6>
                        @else
                            <table class="table font-familyAtlasGroteskWeb-Medium contSuggTable">
                                <tbody id="flag_thread_result">
                                    @if ($flag_threads)
                                        @foreach ($flag_threads as $thread)
                                            <tr class="border-bottom">
                                                <td class="">
                                                    <p class="text-colorblue100 font-size13px"><a class="text-colorblue100 font-size16px" href="{{ route('thread_posts', ['board_id' => Request::get('board_id'), 'thread_id' => $thread->id]) }} ">{{ $thread->title }}</a></p>
                                                    <div class="media">
                                                        <div class="thumbnailImg_WHN3 thumbnailImg overflow-hidden" style="background: url('https://ineted.org/public/uploads/profile_images/{{ $thread->author_avatar }}') no-repeat; background-size: cover;">
                                                        </div>
                                                        <div class="media-body align-self-center d-flex">
                                                            <p class="mt-0 mb-0 font-familyAtlasGrotesk-Medium text-colorblue100 font-size12px align-self-center"><span class="align-self-center mr-2">{{ $thread->author }}</span> <span class="badge badge-secondary font-familyFreightTextProMedium-Italic pl-3 pr-3 pt-2 pb-2">{{ $thread->role }}</span></p>
                                                            <span class="text-colorblue200 opacity0point5 mr-3 ml-3 align-self-center">|</span>
                                                            <div class="align-self-center">
                                                                <span class="align-self-center"><img src="{{ asset('images/icons/pencil.png') }}" alt="" width="20" class="mr-2"></span>
                                                                <span class="text-colorblue200 font-familyAtlasGroteskWeb-Regular font-size13px opacity0point5 align-self-center">{{ date("M d, Y", strtotime($thread->c_at)) }}</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </td>

                                                <td class="text-center verticalalign" width="110">
                                                    <a href="#" class="text-colorMahroon700 font-size12px">
                                                        <p class="mb-0 "><i class="fas fa-flag mr-1"></i> Flagged by</p>
                                                    </a>

                                                </td>
                                                <td class="text-center verticalalign" width="160">
                                                    <div class="badge badge-customBtn4 pl-3 pr-3 pt-2 pb-2">
                                                        <img src="{{ Auth::user()->moderator ? asset('images/icons/Icon-M.png') : '' }}"><span class="ml-2 font-familyAtlasGroteskWeb-Light">{{ Auth::user()->name }}</span>
                                                    </div>
                                                </td>

                                            <td class="text-center verticalalign">
                                                @if (Auth::user()->role_id == 1)
                                                <a onclick="unflag_threadbyadmin({!! $thread->flagthreadid !!})">
                                                    <div class="badge badge-secondary font-familyFreightTextProMedium-Italic pl-3 pr-3 pt-2 pb-2" style="cursor: pointer;">
                                                        <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                                        <span>Un flag thread</span>
                                                    </div>
                                                </a>

                                                @else

                                                <a onclick="unflag_thread({!! $thread->id !!})">
                                                    <div class="badge badge-secondary font-familyFreightTextProMedium-Italic pl-3 pr-3 pt-2 pb-2" style="cursor: pointer;">
                                                        <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                                        <span>Un flag thread</span>
                                                    </div>
                                                </a>

                                                @endif


                                            </td>


                                                {{-- <td class="verticalalign dashboardDataTable text-right">
                                                    <ul class="navbar-nav align-self-center font-familyFreightTextProLight-Regular">
                                                        <li class="nav-item dropdown">
                                                            <a class="nav-link dropdown-toggle p-0 text-lightGaray" href="#" id="listViewMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h font-size2em"></i></a>
                                                        </li>
                                                    </ul>
                                                </td> --}}
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        @endif

                        <div class="col-md-12 p-0 mt-5 mb-5">
                            <nav aria-label="Page navigation">
                                @if (Auth::check() && $flag_threads_pages > 1)
                                    <ul class="pagination justify-content-end font-familyAtlasGrotesk-Regular text-colorblue100 font-size14px" id="flag_thread_pagination">
                                        <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Previous</a></li>

                                        <?php
                                            for ($i=0; $i < $flag_threads_pages; $i++) {
                                                $page = $i + 1;
                                                $default_active = $page == 1 ? 'active disabled' : '';
                                                echo "<li class='page-item $default_active' ><a class='page-link' onclick='change_flag_thread_page($page)'>$page</a></li>";
                                            }
                                        ?>

                                        <li class="page-item"><a class="page-link" onclick='change_flag_thread_page(2)'>Next</a></li>
                                    </ul>
                                @endif
                            </nav>
                        </div>

                    </div>

                    <div class="tab-pane fade" id="pg-flagPosts" role="tabpanel" aria-labelledby="FlagPosts">

                        @if (!$flagged_posts)
                            <h6 class="mt-5 mb-5">Flagged Post Content Not Available</h6>
                        @else
                            <div id="flag_post_result">
                                @if ($flagged_posts)
                                    @foreach ($flagged_posts as $post)
                                    <div class="col-md-12 border-bottom p-0 pt-4">
                                        <div class="row no-gutters">
                                            <div class="col-md-8 nb-3">
                                                <a class="text-colorblue100 font-familyAtlasGroteskWeb-Medium mb-0 font-size16px" href="{{ route('thread_posts', ['board_id' => Request::get('board_id'), 'thread_id' => $post->thread_id]) }} ">{{ $post->thread }}</a>
                                            </div>
                                            <div class="col-md-4 text-right d-flex align-self-center font-familyAtlasGroteskWeb-Medium justify-content-end mb-3">
                                                <a href="#" class="text-colorMahroon700 font-size12px align-self-center">
                                                    <p class="mb-0 "><i class="fas fa-flag mr-1"></i> Flagged by</p>
                                                </a>
                                                <div class="badge badge-customBtn4 pl-1 pr-3 pt-2 pb-2 ml-3">
                                                    <img src="{{ Auth::user()->moderator ? asset('images/icons/Icon-M.png') : '' }}" alt=""><span class="ml-2 font-familyAtlasGroteskWeb-Light">{{ $post->flagged_by }}</span>
                                                </div>
                                            </div>

                                            <div class="col-lg-2 col-md-3 text-center mb-3">
                                                <div class="col text-center mb-3">
                                                    <div class="thumbnailImg_WHN5 thumbnailImg overflow-hidden mr-0 m-auto" style="background: url('https://ineted.org/public/uploads/profile_images/{{ $post->author_avatar }}') no-repeat; background-size: cover;">
                                                    </div>

                                                    <p class="font-familyAtlasGrotesk-Medium text-colorblue100 mt-2 mb-2 font-size12px">{{ $post->author }}</p>
                                                    <span class="badge badge-secondary font-familyFreightTextProMedium-Italic font-size12px pl-3 pr-3 pt-2 pb-2">{{ $post->role }}</span>
                                                </div>

                                            </div>

                                            <div class="col-lg-10 col-md-9 mb-3">
                                                <div class="col-md-12 bg-lightWhite100 p-0 font-familyAtlasGroteskWeb-Regular text-colorblue200 font-size13px arrow">
                                                    <div class="col-md-12 p-4">
                                                        <div class="col-md-12 p-0 font-familyAtlasGroteskWeb-Regular text-colorblue200 mb-3 d-flex justify-content-between">
                                                            <div class="col-md-6 p-0 align-self-center ">
                                                                <p class="mb-0 font-size13pxopacity0point5">{{ date("M d, Y", strtotime($post->c_at)) }}</p>
                                                            </div>
                                                            <div class="col-md-6 p-0 text-right">
                                                                {{-- <a href="#" class="text-colorblue200 opacity0point5 ml-3 font-size16px"><i class="fas fa-ellipsis-h"></i></a> --}}
                                                            </div>
                                                        </div>
                                                        {!! $post->body !!}
                                                    </div>
                                                </div>


                                                @if (Auth::user()->role_id == 1)

                                                <div class="text-right mt-2">
                                                    <a onclick="unflag_post_by_admin({!!$post->flagid !!})">
                                                        <div class="badge badge-secondary font-familyFreightTextProMedium-Italic pl-3 pr-3 pt-2 pb-2" style="cursor: pointer;">
                                                            <i class="fa fa-flag-o" aria-hidden="true"></i>
                                                            <span>Un flag Post</span>
                                                        </div>
                                                    </a>
                                                </div>

                                                @else

                                                <div class="text-right mt-2">
                                                    <a onclick="unflag_post({!!$post->id !!})">
                                                        <div class="badge badge-secondary font-familyFreightTextProMedium-Italic pl-3 pr-3 pt-2 pb-2" style="cursor: pointer;">
                                                            <i class="fa fa-flag-o" aria-hidden="true"></i>
                                                            <span>Un flag Post</span>
                                                        </div>
                                                    </a>
                                                </div>

                                                @endif





                                            </div>

                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        @endif

                        <div class="col-md-12 p-0 mt-5 mb-5">
                            <nav aria-label="Page navigation">
                                @if (Auth::check() && $flagged_posts_pages > 1)
                                    <ul class="pagination justify-content-end font-familyAtlasGrotesk-Regular text-colorblue100 font-size14px" id="flag_post_pagination">
                                        <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Previous</a></li>

                                        <?php
                                            for ($i=0; $i < $flagged_posts_pages; $i++) {
                                                $page = $i + 1;
                                                $default_active = $page == 1 ? 'active disabled' : '';
                                                echo "<li class='page-item $default_active' ><a class='page-link' onclick='change_flag_post_page($page)'>$page</a></li>";
                                            }
                                        ?>

                                        <li class="page-item"><a class="page-link" onclick='change_flag_post_page(2)'>Next</a></li>
                                    </ul>
                                @endif
                            </nav>
                        </div>

                    </div>

                    <div class="tab-pane fade" id="pg-search" role="tabpanel" aria-labelledby="Search">
                        <h6 class="mt-5 mb-5">Search Content Not Available</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('include.footer')

{{-- <!-- Modal POST THREAD -->
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

                            <input type="hidden" id="board_id" name="board_id" value="{{ Request::get('board_id') }}">

                            <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                <label for="title" class="mb-0 text-colorblue100">Title</label>
                                <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Be specific and imagine you’re asking a question to another person.</p>
                                <input type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="title" name="title" placeholder="Thread title">
                                <small id="error_title" style="color: red" class="position-absolute"></small>
                            </div>

                            <div class="col-md-12 p-0">
                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="body" class="">Body</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Include all the information someone would need to answer your question.</p>
                                    <textarea id="body" name="body" class="summernote"></textarea>
                                    <small id="error_body" style="color: red" class="position-absolute"></small>
                                </div>
                            </div>

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
</div> --}}

<div id="popup1" class="overlay"  aria-hidden="true" data-backdrop="static">
	<div class="popup">
        <div class="modal-header p-4">
            <h6 class="modal-title font-familyAtlasGroteskWeb-Bold text-colorblue100 text-uppercase">POST THREAD</h6>
            <a class="close outlineNone text-colorMahroon700" onclick="ClosePop()">&times;</a>
        </div>

        <div class="modal-body p-4">
			<div class="row">
                <div class="col-md-12">
                    <form id="diss_board_thread" action="{{ route('postThread') }}" method="POST">
                        @csrf

                        <input type="hidden" id="board_id" name="board_id" value="{{ Request::get('board_id') }}">

                        <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                            <label for="title" class="mb-0 text-colorblue100">Title</label>
                            <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Be specific and imagine you’re asking a question to another person.</p>
                            <input type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="title" name="title" placeholder="Thread title">
                            <small id="error_title" style="color: red" class="position-absolute"></small>
                        </div>

                        <div class="col-md-12 p-0">
                            <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                <label for="body" class="">Body</label>
                                <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Include all the information someone would need to answer your question.</p>
                                {{-- <textarea class="form-control classy-editor" id="body" name="body" placeholder="" rows="6" cols="260"></textarea> --}}

                                <textarea id="body" name="body" class="summernote"></textarea>
                                <small id="error_body" style="color: red" class="position-absolute"></small>


                            </div>
                        </div>

                    </form>
                </div>
            </div>

            <div class="modal-footer border-0 p-0">
                <button type="submit" form="diss_board_thread" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar">
                    <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">POST THREAD <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                    <div class="btn-bar"></div>
                </button>
            </div>

		</div>
	</div>
</div>

@endsection @section('style')
<link href="{{ asset('css/textEditor/summernote.min.css') }}" rel="stylesheet">

@endsection

@section('script')
<script src="{{ asset('js/textarea/jquery.classyedit.js') }}"></script>
<style>
.list-group-item-action {
        width: unset !important;
    }
.modal-backdrop.show {
    display: none;
}

.box {
  width: 40%;
  margin: 0 auto;
  background: rgba(255,255,255,0.2);
  padding: 35px;
  border: 2px solid #fff;
  border-radius: 20px/50px;
  background-clip: padding-box;
  text-align: center;
}

.popbutton {
  font-size: 1em;
  padding: 10px 20px;
  color: #06D85F;
  border: 2px solid #06D85F;
  border-radius: 50px;
  text-decoration: none;
  cursor: pointer;
  transition: all 0.3s ease-out;
}
.button:hover {
  background: #06D85F;
}

.overlay {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.7);
  transition: opacity 500ms;
  visibility: hidden;
  opacity: 0;
  z-index: 99;
}
.overlay:target {
  visibility: visible;
  opacity: 1;
}

.popup {
  margin: 70px auto;
  padding: 0px;
  background: #fff;
  border-radius:0px;
  width: 100%;
  position: relative;
  max-width: 580px;
}

.popup h2 {
  margin-top: 0;
  color: #333;
  font-family: Tahoma, Arial, sans-serif;
}
.popup .close {
  position: absolute;
  top: 20px;
  right: 30px;
  transition: all 200ms;
  font-size: 30px;
  font-weight: bold;
  text-decoration: none;
  color: #333;
}
.popup .close:hover {
  color: #4d142a;
}



</style>

<script src="{{ asset('js/textEditor/summernote.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.summernote').summernote();
    });

  function openPop(){
       $("#popup1").css("visibility","visible");
       $("#popup1").css("opacity", 1);
    }

    function ClosePop(){
        $("#popup1").css("visibility","hidden");
       $("#popup1").css("opacity", 0);
    }




</script>

<script src="{{ asset('js/discussionBoard.js') }}"></script>
@endsection
