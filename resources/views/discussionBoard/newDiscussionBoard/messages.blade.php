@extends('layouts.app')


@section('title') INET ED Platform :: Dashboard @endsection

@section('content')
    @include('include.header')

    <input type="hidden" id="c_user_id" value="{{ Auth::user()->id }}">
    <input type="hidden" id="c_role_id" value="{{ Auth::user()->role_id }}">
    <input type="hidden" id="c_moderator" value="{{ Auth::user()->moderator }}">

    <section class="bg-white pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h4 class="text-black font-familyAtlasGroteskWeb-Bold mb-4">Messages</h4>
                    <div class="col-md-12 list-groupCusMain mb-2 p-0">
                        <div class="list-group  font-familyAtlasGroteskWeb-Regular text-colorblue100 font-size14px border-bottom" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action active" id="list-allMessages-list" data-toggle="list" href="#pg-allMessages" role="tab" aria-controls="AllMessages">All Messages</a>
                            {{-- <a class="list-group-item list-group-item-action" id="list-Search-list" data-toggle="list" href="#pg-search" role="tab" aria-controls="Search">Search</a> --}}
                        </div>
                    </div>
                    <div class="col-md-12 p-0">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="pg-allMessages" role="tabpanel" aria-labelledby="allMessages">
                                <div class="list-group vh-80 overflow-yScroll overflow-hidden newList" id="list-tab" role="tablist">

                                    @if ($users)
                                        @foreach ($users as $user)
                                            <a onclick="chat_person_tab({{ $user->id }}, '{{ ($user->user_1 != Auth::user()->id) ? $user->user_1_name : $user->user_2_name }}', '{{ ($user->user_1 != Auth::user()->id) ? $user->user_1_role : $user->user_2_role }}', '{{ ($user->user_1 != Auth::user()->id) ? $user->user_1_avatar : $user->user_2_avatar }}')" class="list-group-item list-group-item-action pt-4 pb-4 activePerson user-thread-list" id="user-thread-{{ $user->id }}">
                                                <div class="col-md-12">
                                                    <div class="row justify-content-between">
                                                        <div class="media">
                                                            <div class="thumbnailImg_WHN3 thumbnailImg overflow-hidden" style="background: url('https://ineted.org/public/uploads/profile_images/{{ ($user->user_1 != Auth::user()->id) ? $user->user_1_avatar : $user->user_2_avatar }}') no-repeat; background-size: cover;"></div>
                                                            <div class="media-body align-self-center font-familyAtlasGrotesk-Medium" style="font-size: 12px !important;">
                                                                <p class="mt-0 mb-0 font-size14px"><span class="align-self-center mr-2">{{ ($user->user_1 != Auth::user()->id) ? $user->user_1_name : $user->user_2_name }}</span> <span class="font-size10px pl-3 pr-3 pt-2 pb-2">{{ ($user->latest_message_tstamp) ? date("M d, Y", strtotime($user->latest_message_tstamp)) : '' }}</span></p>
                                                                <p class="p-0 font-size12px mb-0 font-familyAtlasGroteskWeb-Regular" style="font-weight: bold !important;">{!! $user->latest_message !!}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    @endif

                                    @if ($not_chatted_user)
                                        @foreach ($not_chatted_user as $user)
                                            <a onclick="not_chat_person_tab({{ $user->id }}, '{{ $user->name }}', '{{ $user->role }}', '{{ $user->avatar }}')" class="list-group-item list-group-item-action pt-4 pb-4 activePerson not-user-thread-list" id="not-user-thread-{{ $user->id }}">
                                                <div class="col-md-12">
                                                    <div class="row justify-content-between">
                                                        <div class="media">
                                                            <div class="thumbnailImg_WHN3 thumbnailImg overflow-hidden" style="background: url('https://ineted.org/public/uploads/profile_images/{{ $user->avatar }}') no-repeat; background-size: cover;"></div>
                                                            <div class="media-body align-self-center font-familyAtlasGrotesk-Medium">
                                                                <p class="mt-0 mb-0 font-size14px"><span class="align-self-center mr-2">{{ $user->name }}</span></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    @endif

                                </div>
                            </div>

                            <div class="tab-pane fade" id="pg-search" role="tabpanel" aria-labelledby="search">
                                <div class="col-md-12 p-0 mt-4 mb-4">
                                    {{-- <div class="form-group mb-0">
                                        <input type="text" class="form-control font-familyFreightTextProLight-Regular text-colorblue200 pr-5 font-size14px" id="search" placeholder="Search">
                                        <i class="fas fa-search text-colorblue200 searchIcon right20px"></i>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="col-md-12 p-0 border overflow-hidden">
                        <header class="bg-lightWhite100 border-bottom pt-4 pb-4">
                            <div class="col-md-12">
                                <div class="row justify-content-between" id="chat_user_details"></div>
                            </div>
                        </header>
                        <section class="overflow-hidden height45em overflow-yScroll pt-4 pb-4" id="chat-window">
                            <div class="tab-content" id="chat_result">

                                <div class="tab-pane fade show active" id="list-user1" role="tabpanel" aria-labelledby="list-user1-list">
                                    <div class="col-md-12">

                                        <div id="previous_chats"></div>

                                        <div id="yesterday_chats"></div>

                                        <div id="today_chats"></div>

                                    </div>
                                </div>

                            </div>
                        </section>
                        <footer id="chat-footer" style="display: none" class="bg-lightWhite border-top pt-4 pb-4">
                            <div class="col-md-12">
                                <div class="row">

                                    <div id="asset-selection" class="col-md-12" style="position: absolute; bottom: 45px;">
                                        <img id="asset-selection-image" src="" class="img-thumbnail" style="width: 80px;">
                                        <img id="asset-selection-attachment" src="" class="img-thumbnail" style="width: 40px;">
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group mb-0">
                                            <textarea id="emojionearea" class="form-control font-familyAtlasGroteskWeb-Regular font-size12px text-darkBlue" placeholder="Type your message..."></textarea>
                                            <div class="position-absolute selectFileMain">
                                                <i id="message_send_btn" class="far fa-paper-plane text-colorblue200 opacity0point5 mr-2 cursorPointer"></i>
                                                <i class="far fa-image text-colorblue200 opacity0point5 mr-2"><input type="file" class="form-control-file selectFile" id="attachImage"></i>
                                                <i class="fas fa-paperclip text-colorblue200 opacity0point5"><input type="file" class="form-control-file selectFile" id="attachFile"></i>
                                            </div>
                                        </div>
                                    </div>

                                    {{--<div class="col-md-2">--}}
                                        {{--<i class="far fa-image text-colorblue200"></i>--}}
                                        {{--<i class="far fa-image text-colorblue200"></i>--}}
                                        {{--<input type="file" class="form-control-file" id="exampleFormControlFile1">--}}
                                        {{--<div class="custom-file">--}}
                                            {{--<input type="file" class="custom-file-input col-md-4 p-0" id="uploadImg">--}}
                                            {{--<label class="custom-file-label font-familyFreightTextProLight-Regular text-darkBlue font-size14px col-md-12 d-flex align-items-center justify-content-between" for="uploadImg">Upload</label>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                </div>
                            </div>
                        </footer>
                    </div>

                </div>
            </div>
        </div>
    </section>

    @include('include.footer')

@endsection



@section('style')
    <link rel="stylesheet" href="{{ asset('css/emojionearea.css') }}">
    <style>
        .emojionearea .emojionearea-editor {
            max-width: 48em;
        }
    </style>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('js/textarea/emojionearea.js') }}"></script>
    <script>
        $(document).ready(function(){
            setTimeout(function () {
                $("#emojionearea").emojioneArea({
                    pickerPosition: "top",
                    filtersPosition: "bottom",
                    tones: true,
                    autocomplete: false,
                    inline: false,
                    hidePickerOnBlur: false
                });
            }, 500);
        });
    </script>
    <script src="{{ asset('js/discussionBoard.js') }}"></script>
@endsection
