@extends('layouts.app') @section('title') INET ED Platform :: Dashboard @endsection @section('content') @include('include.header')

<style>
    #vote_up, #vote_down {
        cursor: pointer;
    }

</style>

@auth
    <input type="hidden" id="user_id" value="{{ Auth::user()->id }}">
@endauth

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
            <div class="col-md-7 pt-4 pb-4 font-familyAtlasGroteskWeb-Regular text-colorblue100 font-size14px">
                <div class="col-md-12 p-0 font-size12px border-bottom">

                    <h6 class="mb-0 font-familyAtlasGroteskWeb-Medium text-colorblue100">{{ $discussion->title }}</h6>

                    <div class="col-md-12 p-0 font-familyAtlasGroteskWeb-Regular text-colorblue200 border-bottom pt-3 pb-3">
                        <div class="media">

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
                            <img class="mr-3 align-self-center" src="{{ asset('public/uploads/profile_images') . '/'. $discussion->profile_pic_url }}" width="30">

                            <div class="media-body">
                                <h6 class="mt-0 font-familyAtlasGrotesk-Medium text-colorblue100 font-size13px">{{ $discussion->name }} </h6>
                                <span class="badge badge-secondary font-familyFreightTextProMedium-Italic pl-2 pr-2 pt-1 pb-1 font-size12px">{{ $discussion->role }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 pt-3 ">
                        <div class="row">
                            <div class="col-md-2 text-center text-colorblue100 opacity0point5 font-size14px mb-3">
                                <h1 id="vote_up" class="mb-0 line-height0"><i class="fas fa-caret-up"></i></h1>
                                <h5 id="votes_count" class="font-familyAtlasGroteskWeb-Medium mb-0">{{ $discussion->votes_count }}</h5>
                                <h1 id="vote_down" class="line-height0"><i class="fas fa-caret-down"></i></h1>

                                <p class="font-familyAtlasGroteskWeb-Regular mb-0 text-center text-colorblue100 font-size12px"><i class="far fa-eye mr-2"></i>
                                    <br> {{ $discussion->views_count }} Views</p>
                            </div>
                            <div class="col-md-10 mb-3 font-familyAtlasGroteskWeb-Light">
                                <div>{!! $discussion->body !!}</div>

                                <?php
                                    $tags = json_decode($discussion->tags, true);
                                    if ($tags) {
                                        foreach ($tags as $tag) {
                                            echo "<button onclick='tagbutton(this)' class='btn btn-customBtn1 font-familyAtlasGroteskWeb-Regular font-size11px mt-2 border-radius0all opacity0point5'>" . $tag . "</button>";
                                        }
                                    }
                                ?>

                                @if (Auth::check() && $discussion->user_id == Auth::user()->id)
                                    <div class="col-md-12 p-0 font-familyAtlasGroteskWeb-Bold pt-4">
                                        <a href="#" class="text-uppercase mr-3 text-colorblue200" data-toggle="modal" data-target="#moadalAskQuestion">Edit</a>

                                        <a id="delete_discussion" href="#" class="text-uppercase text-colorMahroon700">delete</a>
                                        <span class="text-ferozy pr-3 pb-2 font-familyAtlasGroteskWeb-Bold font-size12px float-right"><span>SHARE</span> <i class="fas fa-angle-down text-colorMahroon700 ml-2"></i></span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-12 p-0">
                    <h6 class="mb-0 mt-5 font-familyAtlasGroteskWeb-Medium text-colorblue100">ANSWERS</h6>

                    @if (count($discussion_responses))
                        @foreach ($discussion_responses as $response)
                            <div class="media mt-5 font-size14px">
                                <img class="mr-3 align-self-center" src="{{ asset('public/uploads/profile_images') . '/'. $response->profile_pic_url }}" width="60">

                                <div class="media-body">
                                    <h5 class="mt-0 font-familyAtlasGrotesk-Medium text-colorblue100 d-flex"><span class="align-self-center">{{ $response->name }}</span> <span class="badge badge-secondary font-familyFreightTextProMedium-Italic font-size13px pl-3 pr-3 pt-2 ml-2 pb-2">{{ $response->role }}</span></h5>
                                    <p class="text-colorblue200 font-familyAtlasGroteskWeb-Regular">{!! $response->body !!}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                @auth
                <div class="col-md-12 p-0">
                    <form action="{{ route('discussion_response') }}" method="POST">
                        @csrf
                        <input type="hidden" id="discussion_id" name="discussion_id" value="{{ $discussion->id }}">

                        <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-5">
                            <label for="FormControlTextarea1" class="mt-4">Your Answer</label>
                            <textarea id="discussion_response_text" name="discussion_response_text" class="form-control classy-editor" id="FormControlTextarea1" placeholder="Comment here" rows="6" cols="260"></textarea>
                        </div>

                        <button type="submit" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px p-0 border-radius0px btnBotmBar">
                            <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">SUBMIT RESPONSE <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                            <div class="btn-bar"></div>
                        </button>
                    </form>
                </div>
                @endauth

            </div>

        </div>
    </div>
</section>

<!-- Modal ASK QUESTION -->
<div class="modal fade p-0" id="moadalAskQuestion" tabindex="-1" role="dialog" aria-labelledby="moadalAskQuestion" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered max-width690px p-md-0 p-3" role="document">
        <div class="modal-content border-radius0px">
            <div class="modal-header p-4">
                <h6 class="modal-title font-familyAtlasGroteskWeb-Bold text-colorblue100 text-uppercase" id="moadalAskQuestion">EDIT QUESTION</h6>
                <button type="button" class="close outlineNone text-colorMahroon700" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body p-4">
                <div class="row">
                    <div class="col-md-12">
                        <form id="discussions_ask_question" action="{{ route('discussions_ask_question') }}" method="POST">
                            @csrf

                            <input type="hidden" id="discussion_id" name="discussion_id" value="{{ $discussion->id }}">

                            <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                <label for="ques_title" class="mb-0 text-colorblue100">Title</label>
                                <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Be specific and imagine you’re asking a question to another person.</p>
                                <input value="{{ $discussion->title }}" type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="ques_title" name="ques_title" placeholder="Question Title">
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
                                        @foreach ($discussion_tags as $tag_list)
                                            <?php
                                                $tags = json_decode($discussion->tags, true);
                                                echo in_array($tag_list->name, $tags) ? "<option selected>$tag_list->name</option>" : "<option>$tag_list->name</option>";
                                            ?>
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
                    <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">SAVE QUESTION <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                    <div class="btn-bar"></div>
                </button>
            </div>
        </div>
    </div>
</div>


@include('include.footer') @endsection @section('style')
<link href="{{ asset('css/textarea/jquery.classyedit.css') }}" rel="stylesheet"> @endsection @section('script')
<script src="{{ asset('js/textarea/jquery.classyedit.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $(".classy-editor").ClassyEdit();
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
