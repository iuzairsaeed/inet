<script>
    // "global" vars, built using blade
    var flagsUrl = "{{ URL::asset('/public/uploads/profile_images/') }}";
    var contenturl = "{{ URL::asset('/public/uploads/content/profile_images/') }}";

</script>

<header>
<style>
.customDropDownInnerPg2 .btn-light {
    color: #fff !important;
}
.customDropDownInnerPg2 .bootstrap-select {
    border-radius: 0rem !important;
}
.customDropDownInnerPg2 .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
    width: 15rem !important;
}
</style>
    <article class="bg-header pt-3 pb-3">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <a href="https://www.ineteconomics.org/" target="_blank"> <img src="{{ asset('images/logo/logosub.png') }}" alt="" width="250"></a>
                </div>
                <div class="col-md-6 text-right align-self-center">
                    <h5 class="font-familyFreightTextProLight-Regular text-white mb-0 mt-md-0 mt-4">Economics must serve humanity.</h5>
                </div>
            </div>
        </div>
    </article>
    <nav class="navbar-expand-md navbar-dark bg-colorFerozy font-familyAtlasGroteskWeb-Regular font-size14px p-3">
        <div class="container">
            <div class="row justify-content-between no-gutters">
                <a class="navbar-brand p-0" href="/inetEDPlatform"><img src="{{ asset('images/logo/logo.png') }}" alt="" width="150"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                    <div class="{{ (Auth::check()) ? 'col-lg-4' : 'col-lg-8' }} col-md-12 d-flex align-items-center p-0 mt-md-0 mt-3 customDropDownInnerPg customDropDownInnerPg2">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown logSign">
                                <a class="nav-link dropdown-toggle" href="#" id="exploreMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Explore</a>
                                <div class="dropdown-menu widthMin30rem mt-3 border-radius0px p-0 font-familyAtlasGroteskWeb-Regular text-colorblue200 font-size14px" aria-labelledby="exploreMenu">
                                    <div class="col-md-12 border-bottom pt-4 pb-3">
                                        <p class="border-bottom pb-1">Learn</p>
                                        <ul class="explorDropdown text-colorblue100">
                                            @if ($data['categories'])
                                                @foreach ($data['categories'] as $category)
                                                    <li>
                                                        <a class="dropdown-item" href="{!! route('courses', ['category_id' => $category->id]) !!}"><img class="mr-2" src="{{ asset('/images/icons/' . $category->avatar) }}" alt="" width="35"> {!! $category->name !!}</a>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="col-md-12 mt-4 mt-md-0 bg-lightgray pt-3 pb-3">
                                        <p class="mb-1"><a class="text-colorblue200" href="{{ route('searchCourses') }}">All Content</a></p>
                                        {{-- <p class="mb-0"><a class="text-colorblue200" href="{{ route('home') }}">Recommended Content</a></p> --}}
                                    </div>
                                </div>
                            </li>
                        </ul>

                        <form id="search-everything-form" class="form-inline" action="{{ route('searchAll') }}">
                            <input id="search-everything-query" class="custominput font-familyFreightTextProLight-Regular" type="text" placeholder="Search for anything" aria-label="Search" value="{{ request()->get('query') }}">
                               <i class="fas fa-search text-white iconserch position-absolute" id="search-for-every"></i>

                        </form>
                    </div>
                    @if (!Auth::check())
                    <div class="col-md-4 align-items-center mt-md-0 mt-3" style="display: block;">
                        <div class="row justify-content-md-end">
                            {{-- <ul class="navbar-nav">
                                <li class="nav-item dropdown logSign">
                                    <a class="nav-link dropdown-toggle" href="#" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Menu</a>
                                </li>
                            </ul> --}}
                            <div class="align-self-center font-familyAtlasGroteskWeb-Medium logSign">

                                <a href="{{ route('login') }}" class="mr-3">Login</a> <span class="text-white mr-3">|</span>
                                <a href="{{ route('register') }}">Sign Up</a>
                            </div>
                        </div>
                    </div>
                    @endif


                    {{--PROFILE MENU ADMIN --}}
                    @auth
                    {{--
                    <div class="col-md-4 align-items-center mt-md-0 mt-3" style="display: block">
                        <div class="row justify-content-md-end">
                            <div class="align-self-center font-familyAtlasGroteskWeb-Regular d-flex logSign">
                                <p class="mb-0 text-white"><a style="color: white; text-decoration: none;" href="{{ route('home') }}">Dashboard</a></p>
                                <span class="text-white ml-3">|</span>
                            </div>
                            <div class="ml-3">
                                <div class="thumbnailImg_WH5 thumbnailImg overflow-hidden mr-0" style="background: url({{ url('public/uploads/profile_images/' . $data['profile']->profile_pic_url) }}) no-repeat; background-size: cover;">
                                </div>
                            </div>
                            <ul class="navbar-nav align-self-center font-familyAtlasGroteskWeb-Regular">
                                <li class="nav-item dropdown logSign">
                                    <a class="nav-link dropdown-toggle p-0 pl-3" href="#" id="userDropMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $data['profile']->full_name }}</a>
                                    <div class="dropdown-menu margin-top2em widthMin15rem border-radius0px right0 aPading" aria-labelledby="userDropMenu">

                                        <div class="col text-center border-bottom p-4">
                                            <div class="thumbnailImg_WH3 thumbnailImg overflow-hidden mr-0 m-auto" style="background: url({{ url('public/uploads/profile_images/' . $data['profile']->profile_pic_url) }}) no-repeat; background-size: cover;">
                                            </div>
                                            <h6 class="mt-0 font-familyAtlasGrotesk-Medium text-colorblue100 mt-2">{{ $data['profile']->full_name }}</h6>
                                            <span class="badge badge-secondary font-familyFreightTextProMedium-Italic font-size13px pl-3 pr-3 pt-2 pb-2">{{ $data['role'] }}</span>
                                        </div>
                                        <div class="col pl-0 pr-0 pt-3 pb-3">
                                            <a class="dropdown-item font-size14px" href="{{ route('viewProfile') }}"><i class="fas fa-user mr-2"></i> View Proï¬le</a>

                                            <a class="dropdown-item font-size14px" href="{{ route('discussions', ['newest_page' => '1', 'tag' => 'All', 'main' => 'TopViews']) }}"><i class="far fa-comment-dots mr-2"></i> Discussion Board</a>
                                            <a class="dropdown-item font-size14px" href="{{ route('accountSetting') }}"><i class="fas fa-cog mr-2"></i> Account Settings</a>
                                            <a class="dropdown-item font-size14px" href="#" id="logout_btn" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt mr-2"></i> Log Out</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div> --}}
                    @endauth


                    {{--DISCUSSION BOARD--}}
                    @auth
                        <div class="col-lg-8 col-md-12 align-items-center mt-md-0 mt-3" >
                            <div class="row justify-content-md-end">
                                <div class="align-self-center font-familyAtlasGroteskWeb-Regular d-flex logSign">

                                    @if(Auth::user()->role_id == 2 || Auth::user()->role_id == 3)
                                    <p class="mb-0 text-white align-self-center mr-2 active"><a style="color: white; text-decoration: none;" href="{{ route('home') }}">Dashboard</a></p>
                                     @endif

                                    @if(Auth::user()->role_id == 1)
                                    <ul class="navbar-nav align-self-center font-familyAtlasGroteskWeb-Regular">
                                        <li class="nav-item dropdown logSign">
                                            <a class="nav-link dropdown-toggle p-0 pl-3"   href="{{ route('home') }}" id="userDropMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dashboard</a>


                                            <div class="dropdown-menu margin-top2em widthMin15rem border-radius0px right0 aPading" aria-labelledby="listViewMenu">
                                                <div class="col pl-0 pr-0">
                                                    <a class="dropdown-item font-size14px"  href="{{ route('home') }}"><i class="fas fa-plus mr-2"></i> <span>ADD</span></a>

                                                    <a class="dropdown-item font-size14px"  href="{{ route('tasks') }}"><i class="fas fa-tasks mr-2"></i> <span>Tasks</span></a>
                                                    <a class="dropdown-item font-size14px"  href="{{ route('users') }}"><i class="fas fa-users mr-2"></i> <span>Users</span></a>
                                                </div>
                                            </div>

                                        </li>
                                    </ul>

                                    @endif



                                    @if(Auth::user()->role_id == 1)
                                    <ul class="navbar-nav align-self-center font-familyAtlasGroteskWeb-Regular">
                                        <li class="nav-item dropdown logSign">
                                            <a class="nav-link dropdown-toggle p-0 pl-3" href="#" id="userDropMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Discussion Board</a>
                                            <div class="dropdown-menu margin-top2em widthMin15rem border-radius0px right0 aPading" aria-labelledby="listViewMenu">
                                                <div class="col pl-0 pr-0">
                                                    <a class="dropdown-item font-size14px"  href="{{ route('discussionBoard') }}"><i class="far fa-comment-dots mr-2"></i> <span>View Discussion Board</span></a>

                                                    <a class="dropdown-item font-size14px"  href="{{ route('bannedUser') }}"><i class="fas fa-user-alt-slash mr-2"></i> <span>Banned Users</span></a>
                                                    <a class="dropdown-item font-size14px"  href="{{ route('deletedThreads') }}"><i class="far fa-trash-alt mr-2"></i> <span>Deleted Threads</span></a>
                                                    <a class="dropdown-item font-size14px"  href="{{ route('viewModerators') }}"><i class="fab fa-monero mr-2"></i> <span>View Moderators</span></a>


                                                    <a class="dropdown-item font-size14px"  href="{{ route('viewadmins') }}"><i class="fas fa-users mr-2"></i> <span>View Admins</span></a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    @else
                                    <div class="col pl-0 pr-0">
                                        <a class="dropdown-item font-size14px text-white"  href="{{ route('discussionBoard') }}"><i class="far fa-comment-dots mr-2"></i> <span>Discussion Board</span></a>
                                    </div>
                                    @endif
                                  <span class="text-white ml-2  align-self-center">|</span>
                                     {{--  <a href="{{ route('messages') }}" style="line-height: 2.4;"><i class="fas fa-envelope text-white align-self-center ml-3 {{ ($data['new_message']) ? 'redDot' : '' }}" title="Messenger"></i></a> --}}

                                    <ul class="navbar-nav align-self-center font-familyAtlasGroteskWeb-Regular dashboardDataTable width_2point5em">
                                        <li class="nav-item dropdown logSign">
                                            <a class="nav-link dropdown-toggle p-0 pl-3 " href="#" id="userDropMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                                <?php $notification_read=0 ?>

                                                @if(count($data['notification']))
                                                    @foreach ($data['notification'] as $notification)
                                                        @if(!$notification->read)
                                                            <?php $notification_read=1 ?>
                                                            @break;
                                                        @endif
                                                    @endforeach
                                                @endif
                                                <i class="fas fa-bell text-white align-self-center {{ $notification_read ? 'redDot' : '' }}" title="Notifications"></i>
                                            </a>
                                            <div class="dropdown-menu margin-top2em widthMin27rem border-radius0px right0 p-0" aria-labelledby="userDropMenu">

                                                @if(count($data['notification']))
                                                    @foreach ($data['notification'] as $notification)
                                                        @if($notification->reaction)
                                                        <div class="media p-4 border-bottom cursorPointer {{ $notification->read ? '' : 'bg-lightgray' }}" onclick="routeNotification(`{{ route('thread_posts', ['board_id' => $notification->board_id, 'thread_id' => $notification->thread_id, 'notification_id' => $notification->id]) }}`, {{ $notification->post_id }})">
                                                            <div class="thumbnailImg_WH5_2 thumbnailImg overflow-hidden" style="background: url('https://ineted.org/public/uploads/profile_images/{{ $notification->like_by_user_avatar }}') no-repeat; background-size: cover;"></div>
                                                            <div class="media-body align-self-center font-familyAtlasGroteskWeb-Regular font-size14px">
                                                                <p class="mb-0 text-colorblue200"><a class="font-familyAtlasGroteskWeb-Bold p-0"><span>@</span>{{ $notification->like_by_user }}</a> reacted to your post in thread:</p>
                                                                <p class="text-colorblue100 mb-2">â€œ{{ $notification->thread }}â€</p>
                                                                @switch($notification->reaction)
                                                                    @case('thumbup')
                                                                        <p class="text-colorblue200 mb-2"><i class="fas fa-thumbs-up colorBlue ml-2"></i> <span class="opacity0point5">{{ date("M d, Y", strtotime($notification->c_at)) }} at {{ date("h:m", strtotime($notification->c_at)) }}</span></p>
                                                                        @break
                                                                    @case('smiley')
                                                                        <p class="text-colorblue200 mb-2"><span class="font-size14px ml-2">&#128518; <span class="opacity0point5">{{ date("M d, Y", strtotime($notification->c_at)) }} at {{ date("h:m", strtotime($notification->c_at)) }}</span></p>
                                                                        @break
                                                                    @case('info')
                                                                        <p class="text-colorblue200 mb-2"><i class="fas fa-info-circle colorGreen ml-2"></i> <span class="opacity0point5">{{ date("M d, Y", strtotime($notification->c_at)) }} at {{ date("h:m", strtotime($notification->c_at)) }}</span></p>
                                                                        @break
                                                                    @case('agree')
                                                                        <p class="text-colorblue200 mb-2"><i class="fas fa-check-circle text-success ml-2"></i> <span class="opacity0point5">{{ date("M d, Y", strtotime($notification->c_at)) }} at {{ date("h:m", strtotime($notification->c_at)) }}</span></p>
                                                                        @break
                                                                    @case('respectfully_disagree')
                                                                        <p class="text-colorblue200 mb-2"><i class="fas fa-times-circle text-danger ml-2"></i> <span class="opacity0point5">{{ date("M d, Y", strtotime($notification->c_at)) }} at {{ date("h:m", strtotime($notification->c_at)) }}</span></p>
                                                                        @break
                                                                @endswitch
                                                            </div>
                                                        </div>
                                                        @else
                                                        <div class="media p-4 border-bottom cursorPointer {{ $notification->read ? '' : 'bg-lightgray' }}" onclick="routeNotification(`{{ route('thread_posts', ['board_id' => $notification->board_id, 'thread_id' => $notification->thread_id, 'notification_id' => $notification->id]) }}`, {{ $notification->post_id }})">
                                                            <div class="thumbnailImg_WH5_2 thumbnailImg overflow-hidden" style="background: url('https://ineted.org/public/uploads/profile_images/{{ $notification->replied_by_user_avatar }}') no-repeat; background-size: cover;"></div>
                                                            <div class="media-body align-self-center font-familyAtlasGroteskWeb-Regular font-size14px">
                                                                <p class="mb-0 text-colorblue200"><a class="font-familyAtlasGroteskWeb-Bold p-0"><span>@</span>{{ $notification->replied_by_user }}</a> replied to your post in thread:</p>
                                                                <p class="text-colorblue100 mb-2">â€œ{{ $notification->thread }}â€</p>
                                                                <p class="text-colorblue200 mb-2"><i class="fas fa-quote-right text-colorMahroon700 ml-2"></i> <span class="opacity0point5">{{ date("M d, Y", strtotime($notification->c_at)) }} at {{ date("h:m", strtotime($notification->c_at)) }}</span></p>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    @endforeach
                                                @endif

                                            </div>
                                        </li>
                                    </ul>

                                </div>
                                <div class="ml-3">
                                    <div class="thumbnailImg_WH5 thumbnailImg overflow-hidden mr-0" style="background: url({{ url('public/uploads/profile_images/' . $data['profile']->profile_pic_url) }}) no-repeat; background-size: cover;">
                                    </div>
                                </div>
                                <ul class="navbar-nav align-self-center font-familyAtlasGroteskWeb-Regular">
                                    <li class="nav-item dropdown logSign">
                                        <a class="nav-link dropdown-toggle p-0 ml-2" href="#" id="userDropMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $data['profile']->full_name }}</a>
                                        <div class="dropdown-menu margin-top2em widthMin15rem border-radius0px right0 aPading" aria-labelledby="userDropMenu">

                                            <div class="col text-center border-bottom p-4">
                                                <div class="thumbnailImg_WH3 thumbnailImg overflow-hidden mr-0 m-auto" style="background: url({{ url('public/uploads/profile_images/' . $data['profile']->profile_pic_url) }}) no-repeat; background-size: cover;">
                                                </div>
                                                <h6 class="mt-0 font-familyAtlasGrotesk-Medium text-colorblue100 mt-2">{{ $data['profile']->full_name }}</h6>
                                                <span class="badge badge-secondary font-familyFreightTextProMedium-Italic font-size13px pl-3 pr-3 pt-2 pb-2">{{ $data['role'] }}</span>
                                            </div>
                                            <div class="col pl-0 pr-0 pt-3 pb-3">
                                                <a class="dropdown-item font-size14px" href="{{ route('viewProfile') }}"><i class="fas fa-user mr-2"></i> View Proï¬le</a>

                                                <a class="dropdown-item font-size14px" href="{{ route('discussionBoard') }}"><i class="far fa-comment-dots mr-2"></i> Discussion Board</a>
                                                <a class="dropdown-item font-size14px" href="{{ route('accountSetting') }}"><i class="fas fa-cog mr-2"></i> Account Settings</a>
                                                <a class="dropdown-item font-size14px" href="#" id="logout_btn" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt mr-2"></i> Log Out</a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</header>

<script>
    function routeNotification (url, post_id) {
        location.href = url + "#thread-post-"+post_id;
    }
</script>
