@extends('layouts.app') @section('title') INET ED Platform :: Discussion Board @endsection @section('content') @include('include.header')

<style>
    .tag_active {
        background-color: #606C80 !important;
        color: white !important;
    }
</style>
<section class="bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-3 d-flex">
                <div class="col-md-12 bg-lightWhite100 pt-4 pb-4">
                    <div id="_leftPanalList" class="list-group leftPanalList font-familyAtlasGroteskWeb-Regular font-size13px text-colorblue200">
                        <a onclick="mainButton(this)" class="list-group-item list-group-item-action text-colorblue200 transitionall {{ request()->get('main') == 'TopViews' ? 'active' : '' }}" style="cursor: pointer;">Top Views</a>
                        @auth
                            <a onclick="mainButton(this)" class="list-group-item list-group-item-action text-colorblue200 transitionall {{ request()->get('main') == 'YourQuestions' ? 'active' : '' }}" style="cursor: pointer;">Your Questions</a>
                            <a onclick="mainButton(this)" class="list-group-item list-group-item-action text-colorblue200 transitionall {{ request()->get('main') == 'YourAnswers' ? 'active' : '' }}" style="cursor: pointer;">Your Answers</a>
                        @endauth
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-8 pt-4 pb-4 font-familyAtlasGroteskWeb-Regular text-colorblue100 font-size14px">
                <div class="col-md-12 p-0">
                    <div class="row no-gutters">
                        @foreach ($discustxt as $dis)


                        <div class="col-md-12">
                            <h4 class="text-black font-familyAtlasGroteskWeb-Bold d-flex">{!! $dis->heading !!}</h4>
                            <p class="font-familyAtlasGroteskWeb-Light text-colorblue200 font-size12px">{!! $dis->sub_heading !!}</p>
                        </div>

                        @endforeach

                        <div class="col-md-12 p-0">
                            <div class="col-md-12 list-groupCusMain mb-2 p-0">
                                <div class="list-group  font-familyAtlasGroteskWeb-Regular text-colorblue100 font-size13px border-bottom" id="list-tab" role="tablist">
                                    <a class="list-group-item list-group-item-action {{ request()->has('newest_page') ? 'active' : '' }}" id="list-newest-list" data-toggle="list" href="#pg-newest" role="tab" aria-controls="Newest">Newest</a>
                                    <a class="list-group-item list-group-item-action {{ request()->has('active_page') ? 'active' : '' }}" id="list-active-list" data-toggle="list" href="#pg-active" role="tab" aria-controls="Active">Active</a>
                                    <a class="list-group-item list-group-item-action {{ request()->has('featured_page') ? 'active' : '' }}" id="list-featured-list" data-toggle="list" href="#pg-featured" role="tab" aria-controls="Featured">Featured</a>
                                    <a class="list-group-item list-group-item-action {{ request()->has('unanswered_page') ? 'active' : '' }}" id="list-unanswered-list" data-toggle="list" href="#pg-unanswered" role="tab" aria-controls="Unanswered">Unanswered</a>
                                    <!-- <a class="list-group-item list-group-item-action {{ request()->has('frequent_page') ? 'active' : '' }}" id="list-frequent-list" data-toggle="list" href="#pg-frequent" role="tab" aria-controls="Frequent">Frequent</a> -->
                                    <!-- <a class="align-self-center" href="#"><i class="fas fa-plus text-colorMahroon100"></i></a> -->
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="tab-content" id="nav-tabContent">





                                <div class="tab-pane fade {{ request()->has('newest_page') ? 'show active' : '' }}" id="pg-newest" role="tabpanel" aria-labelledby="Newest">

                                    @if ($newest_discussions)
                                        @foreach ($newest_discussions as $discussion)
                                            @if ($discussion->deleted_at == null)
                                            <div class="col-md-12 p-0 font-size12px border-bottom mt-4">
                                                <div class="row">
                                                    <div class="col-md-2 text-center text-colorblue100 opacity0point5 font-size13px mb-3 align-self-center">
                                                        <p class="font-familyAtlasGroteskWeb-Medium mb-2">{{ $discussion->votes_count }}</p>
                                                        <p class="font-familyAtlasGroteskWeb-Regular">Votes</p>

                                                        <p class="font-familyAtlasGroteskWeb-Medium mb-2">{{ $discussion->answers_count }}</p>
                                                        <p class="font-familyAtlasGroteskWeb-Regular">Answers</p>
                                                    </div>
                                                    <div class="col-md-7 mb-3">
                                                        <h6 class="mt-0 font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size13px"><a href="{!! route('discussion_show', ['discussion_id' => $discussion->id]) !!}">{{ $discussion->title }}</a></h6>

                                                        <?php
                                                            $tags = json_decode($discussion->tags, true);
                                                            if ($tags) {
                                                                foreach ($tags as $tag) {
                                                                    echo "<button onclick='tagbutton(this)' class='m-1 btn btn-customBtn1 font-familyAtlasGroteskWeb-Regular font-size11px mt-2 border-radius0all opacity0point5'>" . $tag . "</button>";
                                                                }
                                                            }
                                                        ?>

                                                        <div class="col-md-12 p-0 font-familyAtlasGroteskWeb-Regular text-colorblue200">
                                                            <div class="media mt-3">

                                                                <?php
                                                                    $start_date = strtotime($discussion->created_at);
                                                                    $end_date = strtotime(now());

                                                                    $days = round(($end_date - $start_date)/60/60/24);
                                                                    $hr = round(($end_date - $start_date)/60/60);
                                                                    $min = round(($end_date - $start_date)/60);
                                                                    $sec = round(($end_date - $start_date));

                                                                    if($sec <= 120) {
                                                                        echo("<span class='align-self-center'>Posted " . $sec . " sec ago</span>");
                                                                    } else if($min <= 120) {
                                                                        echo("<span class='align-self-center'>Posted " . $min . " min ago</span>");
                                                                    } else if($hr <= 24) {
                                                                        echo("<span class='align-self-center'>Posted " . $hr . " hr ago</span>");
                                                                    } else {
                                                                        echo("<span class='align-self-center'>Posted at " . date("d/m/Y", $start_date) . "</span>");
                                                                    }
                                                                ?>

                                                                <span class="align-self-center mr-3 ml-3">|</span>
                                                                    <div class="thumbnailImg_WH5 thumbnailImg overflow-hidden" style="background: url({{ url('public/uploads/profile_images') . '/'. $discussion->profile_pic_url }}) no-repeat; background-size: cover;">
                                                                    </div>
                                                                {{--<img class="mr-3 align-self-center" src="{{ asset('public/uploads/profile_images') . '/'. $discussion->profile_pic_url }}" alt="placeholder image" width="30">--}}
                                                                <div class="media-body">
                                                                    <h6 class="mt-0 font-familyAtlasGrotesk-Medium text-colorblue100 font-size13px">{{ $discussion->name }} </h6>
                                                                    <span class="badge badge-secondary font-familyFreightTextProMedium-Italic pl-2 pr-2 pt-1 pb-1">{{ $discussion->role }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 text-center text-colorblue100 opacity0point5 font-size12px  mb-3 align-self-center">
                                                        <p class="font-familyAtlasGroteskWeb-Regular mb-0"><i class="far fa-eye mr-2"></i> {{ $discussion->views_count }} Views</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        @endforeach
                                    @endif

                                    {{--PAGINATION--}}
                                    @if ($newest_discussions_pages_count >= 1)
                                    <div class="col-md-12 mt-4">
                                        <nav aria-label="Page navigation">
                                            <ul class="pagination justify-content-end font-familyAtlasGrotesk-Regular font-size12px">
                                                <li class="page-item {{ request()->get('newest_page') == 1 || !request()->has('newest_page') ? 'disabled' : '' }}">
                                                    <a class="page-link" href="?newest_page={{ request()->has('tag') ? request()->get('newest_page') - 1 . '&tag=' . request()->get('tag') . '&main=' . request()->get('main') : request()->get('newest_page') - 1 }}" tabindex="-1">Previous</a>
                                                </li>

                                                <?php
                                                    for ($i=0; $i < $newest_discussions_pages_count; $i++) {
                                                        $page = $i + 1;
                                                        $active_class = ($page == request()->get('newest_page') || (!request()->has('newest_page') && $i == 0)) ? 'active disabled' : '';

                                                        $href = (request()->has('tag')) ? '?newest_page='.$page.'&tag='.request()->get('tag') : '?newest_page='.$page;

                                                        $href .= request()->has('main') ? '&main='. request()->get('main') : '';

                                                        echo "<li class='page-item $active_class' ><a class='page-link' href=$href>$page</a></li>";
                                                    }
                                                ?>

                                                <li class="page-item {{ request()->has('newest_page') && request()->get('newest_page') > $newest_discussions_pages_count ? 'disabled' : ''   }}">
                                                    <a class="page-link" href="?newest_page={{ request()->has('tag') ? request()->get('newest_page') + 1 . '&tag=' . request()->get('tag') . '&main=' . request()->get('main') : request()->get('newest_page') + 1 }}">Next</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                    @endif

                                </div>







                                <div class="tab-pane fade {{ request()->has('active_page') ? 'show active' : '' }}" id="pg-active" role="tabpanel" aria-labelledby="Active">

                                    @if ($active_discussions)
                                        @foreach ($active_discussions as $discussion)
                                            @if ($discussion->deleted_at == null)
                                            <div class="col-md-12 p-0 font-size12px border-bottom mt-4">
                                                <div class="row">
                                                    <div class="col-md-2 text-center text-colorblue100 opacity0point5 font-size13px mb-3 align-self-center">
                                                        <p class="font-familyAtlasGroteskWeb-Medium mb-2">{{ $discussion->votes_count }}</p>
                                                        <p class="font-familyAtlasGroteskWeb-Regular">Votes</p>

                                                        <p class="font-familyAtlasGroteskWeb-Medium mb-2">{{ $discussion->answers_count }}</p>
                                                        <p class="font-familyAtlasGroteskWeb-Regular">Answers</p>
                                                    </div>
                                                    <div class="col-md-7 mb-3">
                                                        <h6 class="mt-0 font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size13px"><a href="{!! route('discussion_show', ['discussion_id' => $discussion->id]) !!}">{{ $discussion->title }}</a></h6>

                                                        <?php
                                                            $tags = json_decode($discussion->tags, true);
                                                            if ($tags) {
                                                                foreach ($tags as $tag) {
                                                                    echo "<button onclick='tagbutton(this)' class='m-1 btn btn-customBtn1 font-familyAtlasGroteskWeb-Regular font-size11px mt-2 border-radius0all opacity0point5'>" . $tag . "</button>";
                                                                }
                                                            }
                                                        ?>

                                                        <div class="col-md-12 p-0 font-familyAtlasGroteskWeb-Regular text-colorblue200">
                                                            <div class="media mt-3">

                                                                <?php
                                                                    $start_date = strtotime($discussion->created_at);
                                                                    $end_date = strtotime(now());

                                                                    $days = round(($end_date - $start_date)/60/60/24);
                                                                    $hr = round(($end_date - $start_date)/60/60);
                                                                    $min = round(($end_date - $start_date)/60);
                                                                    $sec = round(($end_date - $start_date));

                                                                    if($sec <= 120) {
                                                                        echo("<span class='align-self-center'>Posted " . $sec . " sec ago</span>");
                                                                    } else if($min <= 120) {
                                                                        echo("<span class='align-self-center'>Posted " . $min . " min ago</span>");
                                                                    } else if($hr <= 24) {
                                                                        echo("<span class='align-self-center'>Posted " . $hr . " hr ago</span>");
                                                                    } else {
                                                                        echo("<span class='align-self-center'>Posted at " . date("d/m/Y", $start_date) . "</span>");
                                                                    }
                                                                ?>

                                                                <span class="align-self-center mr-3 ml-3">|</span>
                                                                    <div class="thumbnailImg_WH5 thumbnailImg overflow-hidden" style="background: url({{ url('public/uploads/profile_images') . '/'. $discussion->profile_pic_url }}) no-repeat; background-size: cover;">
                                                                    </div>
                                                                {{--<img class="mr-3 align-self-center" src="{{ asset('public/uploads/profile_images') . '/'. $discussion->profile_pic_url }}" alt="placeholder image" width="30">--}}
                                                                <div class="media-body">
                                                                    <h6 class="mt-0 font-familyAtlasGrotesk-Medium text-colorblue100 font-size13px">{{ $discussion->name }} </h6>
                                                                    <span class="badge badge-secondary font-familyFreightTextProMedium-Italic pl-2 pr-2 pt-1 pb-1">{{ $discussion->role }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 text-center text-colorblue100 opacity0point5 font-size12px  mb-3 align-self-center">
                                                        <p class="font-familyAtlasGroteskWeb-Regular mb-0"><i class="far fa-eye mr-2"></i> {{ $discussion->views_count }} Views</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        @endforeach
                                    @endif

                                    {{--PAGINATION--}}
                                    @if ($active_discussions_pages_count >= 1)
                                    <div class="col-md-12 mt-4">
                                        <nav aria-label="Page navigation">
                                            <ul class="pagination justify-content-end font-familyAtlasGrotesk-Regular font-size12px">
                                                <li class="page-item {{ request()->get('active_page') == 1 || !request()->has('active_page') ? 'disabled' : '' }}">
                                                    <a class="page-link" href="?active_page={{ request()->has('tag') ? request()->get('active_page') - 1 . '&tag=' . request()->get('tag') . '&main=' . request()->get('main') : request()->get('active_page') - 1 }}" tabindex="-1">Previous</a>
                                                </li>

                                                <?php
                                                    for ($i=0; $i < $active_discussions_pages_count; $i++) {
                                                        $page = $i + 1;
                                                        $active_class = ($page == request()->get('active_page') || (!request()->has('active_page') && $i == 0)) ? 'active disabled' : '';

                                                        $href = (request()->has('tag')) ? '?active_page='.$page.'&tag='.request()->get('tag') : '?active_page='.$page;

                                                        $href .= request()->has('main') ? '&main='. request()->get('main') : '';

                                                        echo "<li class='page-item $active_class' ><a class='page-link' href=$href>$page</a></li>";
                                                    }
                                                ?>

                                                <li class="page-item {{ request()->has('active_page') && request()->get('active_page') > $active_discussions_pages_count ? 'disabled' : '' }}">
                                                    <a class="page-link" href="?active_page={{ request()->has('tag') ? request()->get('active_page') + 1 . '&tag=' . request()->get('tag') . '&main=' . request()->get('main') : request()->get('active_page') + 1 }}">Next</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                    @endif

                                </div>







                                <div class="tab-pane fade {{ request()->has('featured_page') ? 'show active' : '' }}" id="pg-featured" role="tabpanel" aria-labelledby="Featured">
                                    @if ($featured_discussions)
                                        @foreach ($featured_discussions as $discussion)
                                            @if ($discussion->deleted_at == null)
                                            <div class="col-md-12 p-0 font-size12px border-bottom mt-4">
                                                <div class="row">
                                                    <div class="col-md-2 text-center text-colorblue100 opacity0point5 font-size13px mb-3 align-self-center">
                                                        <p class="font-familyAtlasGroteskWeb-Medium mb-2">{{ $discussion->votes_count }}</p>
                                                        <p class="font-familyAtlasGroteskWeb-Regular">Votes</p>

                                                        <p class="font-familyAtlasGroteskWeb-Medium mb-2">{{ $discussion->answers_count }}</p>
                                                        <p class="font-familyAtlasGroteskWeb-Regular">Answers</p>
                                                    </div>
                                                    <div class="col-md-7 mb-3">
                                                        <h6 class="mt-0 font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size13px"><a href="{!! route('discussion_show', ['discussion_id' => $discussion->id]) !!}">{{ $discussion->title }}</a></h6>

                                                        <?php
                                                            $tags = json_decode($discussion->tags, true);
                                                            if ($tags) {
                                                                foreach ($tags as $tag) {
                                                                    echo "<button onclick='tagbutton(this)' class='m-1 btn btn-customBtn1 font-familyAtlasGroteskWeb-Regular font-size11px mt-2 border-radius0all opacity0point5'>" . $tag . "</button>";
                                                                }
                                                            }
                                                        ?>

                                                        <div class="col-md-12 p-0 font-familyAtlasGroteskWeb-Regular text-colorblue200">
                                                            <div class="media mt-3">

                                                                <?php
                                                                    $start_date = strtotime($discussion->created_at);
                                                                    $end_date = strtotime(now());

                                                                    $days = round(($end_date - $start_date)/60/60/24);
                                                                    $hr = round(($end_date - $start_date)/60/60);
                                                                    $min = round(($end_date - $start_date)/60);
                                                                    $sec = round(($end_date - $start_date));

                                                                    if($sec <= 120) {
                                                                        echo("<span class='align-self-center'>Posted " . $sec . " sec ago</span>");
                                                                    } else if($min <= 120) {
                                                                        echo("<span class='align-self-center'>Posted " . $min . " min ago</span>");
                                                                    } else if($hr <= 24) {
                                                                        echo("<span class='align-self-center'>Posted " . $hr . " hr ago</span>");
                                                                    } else {
                                                                        echo("<span class='align-self-center'>Posted at " . date("d/m/Y", $start_date) . "</span>");
                                                                    }
                                                                ?>

                                                                <span class="align-self-center mr-3 ml-3">|</span>
                                                                    <div class="thumbnailImg_WH5 thumbnailImg overflow-hidden" style="background: url({{ url('public/uploads/profile_images') . '/'. $discussion->profile_pic_url }}) no-repeat; background-size: cover;">
                                                                    </div>
                                                                {{--<img class="mr-3 align-self-center" src="{{ asset('public/uploads/profile_images') . '/'. $discussion->profile_pic_url }}" alt="placeholder image" width="30">--}}
                                                                <div class="media-body">
                                                                    <h6 class="mt-0 font-familyAtlasGrotesk-Medium text-colorblue100 font-size13px">{{ $discussion->name }} </h6>
                                                                    <span class="badge badge-secondary font-familyFreightTextProMedium-Italic pl-2 pr-2 pt-1 pb-1">{{ $discussion->role }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 text-center text-colorblue100 opacity0point5 font-size12px  mb-3 align-self-center">
                                                        <p class="font-familyAtlasGroteskWeb-Regular mb-0"><i class="far fa-eye mr-2"></i> {{ $discussion->views_count }} Views</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        @endforeach
                                    @endif

                                    {{--PAGINATION--}}
                                    @if ($featured_discussions_pages_count >= 1)
                                    <div class="col-md-12 mt-4">
                                        <nav aria-label="Page navigation">
                                            <ul class="pagination justify-content-end font-familyAtlasGrotesk-Regular font-size12px">
                                                <li class="page-item {{ request()->get('featured_page') == 1 || !request()->has('featured_page') ? 'disabled' : '' }}">
                                                    <a class="page-link" href="?featured_page={{ request()->has('tag') ? request()->get('featured_page') - 1 . '&tag=' . request()->get('tag') . '&main=' . request()->get('main') : request()->get('featured_page') - 1 }}" tabindex="-1">Previous</a>
                                                </li>

                                                <?php
                                                    for ($i=0; $i < $featured_discussions_pages_count; $i++) {
                                                        $page = $i + 1;
                                                        $active_class = ($page == request()->get('featured_page') || (!request()->has('featured_page') && $i == 0)) ? 'active disabled' : '';

                                                        $href = (request()->has('tag')) ? '?featured_page='.$page.'&tag='.request()->get('tag') : '?featured_page='.$page;

                                                        $href .= request()->has('main') ? '&main='. request()->get('main') : '';

                                                        echo "<li class='page-item $active_class' ><a class='page-link' href=$href>$page</a></li>";
                                                    }
                                                ?>

                                                <li class="page-item {{ request()->has('featured_page') && request()->get('featured_page') > $featured_discussions_pages_count ? 'disabled' : '' }}">
                                                    <a class="page-link" href="?featured_page={{ request()->has('tag') ? request()->get('featured_page') + 1 . '&tag=' . request()->get('tag') . '&main=' . request()->get('main') : request()->get('featured_page') + 1 }}">Next</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                    @endif

                                </div>








                                <div class="tab-pane fade {{ request()->has('unanswered_page') ? 'show active' : '' }}" id="pg-unanswered" role="tabpanel" aria-labelledby="Unanswered">

                                    @if ($unanswered_discussions)
                                        @foreach ($unanswered_discussions as $discussion)
                                            @if ($discussion->deleted_at == null)
                                            <div class="col-md-12 p-0 font-size12px border-bottom mt-4">
                                                <div class="row">
                                                    <div class="col-md-2 text-center text-colorblue100 opacity0point5 font-size13px mb-3 align-self-center">
                                                        <p class="font-familyAtlasGroteskWeb-Medium mb-2">{{ $discussion->votes_count }}</p>
                                                        <p class="font-familyAtlasGroteskWeb-Regular">Votes</p>

                                                        <p class="font-familyAtlasGroteskWeb-Medium mb-2">{{ $discussion->answers_count }}</p>
                                                        <p class="font-familyAtlasGroteskWeb-Regular">Answers</p>
                                                    </div>
                                                    <div class="col-md-7 mb-3">
                                                        <h6 class="mt-0 font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size13px"><a href="{!! route('discussion_show', ['discussion_id' => $discussion->id]) !!}">{{ $discussion->title }}</a></h6>

                                                        <?php
                                                            $tags = json_decode($discussion->tags, true);
                                                            if ($tags) {
                                                                foreach ($tags as $tag) {
                                                                    echo "<button onclick='tagbutton(this)' class='m-1 btn btn-customBtn1 font-familyAtlasGroteskWeb-Regular font-size11px mt-2 border-radius0all opacity0point5'>" . $tag . "</button>";
                                                                }
                                                            }
                                                        ?>

                                                        <div class="col-md-12 p-0 font-familyAtlasGroteskWeb-Regular text-colorblue200">
                                                            <div class="media mt-3">

                                                                <?php
                                                                    $start_date = strtotime($discussion->created_at);
                                                                    $end_date = strtotime(now());

                                                                    $days = round(($end_date - $start_date)/60/60/24);
                                                                    $hr = round(($end_date - $start_date)/60/60);
                                                                    $min = round(($end_date - $start_date)/60);
                                                                    $sec = round(($end_date - $start_date));

                                                                    if($sec <= 120) {
                                                                        echo("<span class='align-self-center'>Posted " . $sec . " sec ago</span>");
                                                                    } else if($min <= 120) {
                                                                        echo("<span class='align-self-center'>Posted " . $min . " min ago</span>");
                                                                    } else if($hr <= 24) {
                                                                        echo("<span class='align-self-center'>Posted " . $hr . " hr ago</span>");
                                                                    } else {
                                                                        echo("<span class='align-self-center'>Posted at " . date("d/m/Y", $start_date) . "</span>");
                                                                    }
                                                                ?>

                                                                <span class="align-self-center mr-3 ml-3">|</span>
                                                                    <div class="thumbnailImg_WH5 thumbnailImg overflow-hidden" style="background: url({{ url('public/uploads/profile_images') . '/'. $discussion->profile_pic_url }}) no-repeat; background-size: cover;">
                                                                    </div>
                                                                {{--<img class="mr-3 align-self-center" src="{{ asset('public/uploads/profile_images') . '/'. $discussion->profile_pic_url }}" alt="placeholder image" width="30">--}}
                                                                <div class="media-body">
                                                                    <h6 class="mt-0 font-familyAtlasGrotesk-Medium text-colorblue100 font-size13px">{{ $discussion->name }} </h6>
                                                                    <span class="badge badge-secondary font-familyFreightTextProMedium-Italic pl-2 pr-2 pt-1 pb-1">{{ $discussion->role }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 text-center text-colorblue100 opacity0point5 font-size12px  mb-3 align-self-center">
                                                        <p class="font-familyAtlasGroteskWeb-Regular mb-0"><i class="far fa-eye mr-2"></i> {{ $discussion->views_count }} Views</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        @endforeach
                                    @endif

                                    {{--PAGINATION--}}
                                    @if ($unanswered_discussions_pages_count >= 1)
                                    <div class="col-md-12 mt-4">
                                        <nav aria-label="Page navigation">
                                            <ul class="pagination justify-content-end font-familyAtlasGrotesk-Regular font-size12px">
                                                <li class="page-item {{ request()->get('unanswered_page') == 1 || !request()->has('unanswered_page') ? 'disabled' : '' }}">
                                                    <a class="page-link" href="?unanswered_page={{ request()->has('tag') ? request()->get('unanswered_page') - 1 . '&tag=' . request()->get('tag') . '&main=' . request()->get('main') : request()->get('unanswered_page') - 1 }}" tabindex="-1">Previous</a>
                                                </li>

                                                <?php
                                                    for ($i=0; $i < $unanswered_discussions_pages_count; $i++) {
                                                        $page = $i + 1;
                                                        $active_class = ($page == request()->get('unanswered_page') || (!request()->has('unanswered_page') && $i == 0)) ? 'active disabled' : '';

                                                        $href = (request()->has('tag')) ? '?unanswered_page='.$page.'&tag='.request()->get('tag') : '?unanswered_page='.$page;

                                                        $href .= request()->has('main') ? '&main='. request()->get('main') : '';

                                                        echo "<li class='page-item $active_class' ><a class='page-link' href=$href>$page</a></li>";
                                                    }
                                                ?>

                                                <li class="page-item {{ request()->has('unanswered_page') && request()->get('unanswered_page') > $unanswered_discussions_pages_count ? 'disabled' : '' }}">
                                                    <a class="page-link" href="?unanswered_page={{ request()->has('tag') ? request()->get('unanswered_page') + 1 . '&tag=' . request()->get('tag') . '&main=' . request()->get('main') : request()->get('unanswered_page') + 1 }}">Next</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                    @endif

                                </div>






                                <!-- <div class="tab-pane fade" id="pg-frequent" role="tabpanel" aria-labelledby="Frequent">
                                    <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0">Content Required</h6>
                                </div> -->







                            </div>
                        </div>


                    </div>
                </div>

            </div>
            <div class="col-md-3 pt-4 pb-4">
                <div class="col-md-12 justify-content-end d-flex p-0">
                    @auth
                        <button type="button" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px p-0 border-radius0px btnBotmBar" data-toggle="modal" data-target="#moadalAskQuestion">
                            <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">ASK QUESTION <i class="fas fa-plus ml-3 text-colorMahroon100"></i></span>
                            <div class="btn-bar"></div>
                        </button>
                    @endauth
                </div>
                <div class="col-md-12 bg-lightWhite300 mt-4 font-size14px pt-4">
                    <p class="font-familyAtlasGroteskWeb-Medium text-colorblue200 opacity0point5">Tags</p>
                    <div class="list-group rightPanalList font-familyAtlasGroteskWeb-Regular font-size12px text-colorblue200 verticalScroll height45em">
                        <a onclick="tagbutton(this)" style="cursor: pointer;" class="list-group-item list-group-item-action active text-colorblue200 transitionall {{ (request()->get('tag') == 'All') ? 'tag_active' : '' }}">All</a>

                        @if ($discussion_tags)
                            @foreach ($discussion_tags as $tag)
                                <a onclick="tagbutton(this)" style="cursor: pointer;" class="m-1 list-group-item list-group-item-action text-colorblue200 transitionall {{ (request()->get('tag') == $tag->name) ? 'tag_active' : '' }}">{{$tag->name}}</a>
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('include.footer')













<!-- Modal ASK QUESTION -->
<div class="modal fade p-0" id="moadalAskQuestion" tabindex="-1" role="dialog" aria-labelledby="moadalAskQuestion" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered max-width690px p-md-0 p-3" role="document">
        <div class="modal-content border-radius0px">
            <div class="modal-header p-4">
                <h6 class="modal-title font-familyAtlasGroteskWeb-Bold text-colorblue100 text-uppercase" id="moadalAskQuestion">ASK QUESTION</h6>
                <button type="button" class="close outlineNone text-colorMahroon700" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body p-4">
                <div class="row">
                    <div class="col-md-12">
                        <form id="discussions_ask_question" action="{{ route('discussions_ask_question') }}" method="POST">
                            @csrf

                            <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                <label for="ques_title" class="mb-0 text-colorblue100">Title</label>
                                <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Be specific and imagine you’re asking a question to another person.</p>
                                <input type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="ques_title" name="ques_title" placeholder="Question Title">
                            </div>

                            <div class="col-md-12 p-0">
                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="ques_body" class="">Body</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Include all the information someone would need to answer your question.</p>
                                    <textarea class="form-control classy-editor" name="ques_body" id="ques_body" placeholder="" rows="6" cols="260"></textarea>
                                </div>
                            </div>

                            <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                                <label for="ques_tags" class="mb-0 text-colorblue100">Add Tags</label>
                                <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Add up to 5 tags to describe what your question is about.</p>
                                <select name="ques_tags" id="ques_tags" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue" multiple title="Tags">

                                    @if ($discussion_tags)
                                        @foreach ($discussion_tags as $tag)
                                            <option>{{ $tag->name }}</option>
                                        @endforeach
                                    @endif

                                </select>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="modal-footer box-shadow">
                <button type="submit" form="discussions_ask_question" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px p-0 border-radius0px btnBotmBar">
                    <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">POST QUESTION <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
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
        $(".editor").attr('data-placeholder', 'Question body');
    });

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();
</script>
@endsection
