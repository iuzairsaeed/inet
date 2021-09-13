<div class="col-md-12 bg-lightWhite p-5 font-size13px">
    <div class="col-md-12 border-bottomCus">
        <div class="row justify-content-between">
            <h5 class="font-familyAtlasGroteskWeb-Bold text-black">Discussion Board</h5>
                        {{-- <a href="{{ route('discussions', ['newest_page' => '1', 'tag' => 'All', 'main' => 'TopViews']) }}" class="font-familyFreightTextProMedium-Italic text-black align-self-center font-size14px">View All <i class="fas fa-angle-right text-colorMahroon700 ml-3"></i></a> --}}

            <a href="{{ route('discussionBoard') }}" class="font-familyFreightTextProMedium-Italic text-black align-self-center font-size14px">View All <i class="fas fa-angle-right text-colorMahroon700 ml-3"></i></a>
        </div>
    </div>

    @if ($recent_3_discussion)
        @foreach ($recent_3_discussion as $discussion)
            <div class="media mt-5">
                <a class="d-inline-block"  href="{!! route('discBoardprofile', ['u_id' => $discussion->user_id]) !!}" style="cursor: pointer;">
                <div class="thumbnailImg_WH4 thumbnailImg overflow-hidden" style="background: url({{ url('public/uploads/profile_images') . '/'. $discussion->profile_pic_url }}) no-repeat; background-size: cover;">
                </div>
                </a>
                {{--<img class="mr-3" src="{{ asset('public/uploads/profile_images') . '/'. $discussion->profile_pic_url }}" alt="placeholder image" width="70">--}}
                <div class="media-body">
                    <h6 class="mt-0 font-familyAtlasGrotesk-Medium text-colorblue100">
                        <a class="d-inline-block"  href="{!! route('discBoardprofile', ['u_id' => $discussion->user_id]) !!}" style="cursor: pointer;color:black;"> {{ $discussion->name }} </a>
                        <span class="badge badge-secondary font-familyFreightTextProMedium-Italic pl-3 pr-3 pt-2 ml-2 pb-2">{{ $discussion->role }}</span>
                    </h6>
                    <p class="text-colorblue200 font-familyAtlasGroteskWeb-Regular">
                        <a class="text-colorblue100 font-size13px" href="{{ route('thread_posts', ['board_id' => $discussion->diss_board_id, 'thread_id' => $discussion->id]) }} ">{{ $discussion->title }}</a>

                    </p>

                    <?php
                        $tags = json_decode($discussion->tags, true);
                        if ($tags) {
                            foreach ($tags as $tag) {
                                echo "<button onclick='tagbutton(this)' class='m-1 btn btn-customBtn1 font-familyAtlasGroteskWeb-Regular font-size13px border-radius0all opacity0point5'>" . $tag . "</button>";
                            }
                        }
                    ?>
                </div>
            </div>
        @endforeach
    @endif

    <hr class="mt-5 mb-5">

    <div class="col-md-12 border-bottomCus">
        <div class="row justify-content-between">
            <h5 class="font-familyAtlasGroteskWeb-Bold text-colorblue100">News & Updates</h5>
            <a href="{{ route('newsAndMedia') }}" class="font-familyFreightTextProMedium-Italic text-colorblue100 align-self-center font-size14px">View All <i class="fas fa-angle-right text-colorMahroon700 ml-3"></i></a>
        </div>
    </div>


    @if($recent_3_nws)

      @foreach ($recent_3_nws as $news)



    {{-- <p class="font-familyAtlasGroteskWeb-Bold text-colorblue100 mt-3">{!! $news->title !!}</p> --}}
    <div class="d-flex col p-0">
        {{-- <button class="btn btn-customBtn1 font-familyAtlasGroteskWeb-Regular font-size13px mr-2 border-radius0all opacity0point5">Economics</button> --}}

    </div>
    <div class="media mt-3 font-size14px">
        <div class="thumbnailImg_WH4 overflow-hidden mr-3" style="background: url('images/icons/img4.png') no-repeat; background-size: cover;">
        </div>
        <div class="media-body">
            <a class="align-self-center" href="{{ route('newssinglPg', $news->id) }}">
            <p class="font-familyAtlasGroteskWeb-Bold text-colorblue100 mt-3">{!! $news->title !!}</p>
            </a>
            <p class="align-self-center mb-0 text-colorblue100 font-familyFreightTextProMedium-Italic font-size13px border-radius0all opacity0point5"><span class="font-familyFreightTextProBook-Regular text-colorblue200">By: </span>{!!  $news->name!!}</p>
        </div>
    </div>

    <hr>
    @endforeach
    @endif

    {{-- <p class="font-familyAtlasGroteskWeb-Bold text-colorblue100 mt-3">Can a moderator share whatever lorem it was said in this forum. Lorem ipsum dolor sit amet ridiculus ligula augue nisi norum.</p>
    <div class="d-flex col p-0">
        <button class="btn btn-customBtn1 font-familyAtlasGroteskWeb-Regular font-size13px mr-2 border-radius0all opacity0point5">Economics</button>
        <p class="align-self-center mb-0 text-colorblue100 font-familyFreightTextProMedium-Italic font-size13px"><span class="font-familyFreightTextProBook-Regular text-colorblue200">By</span> Micheal Kirmani</p>
    </div>
    <div class="media mt-3 font-size14px">
        <div class="thumbnailImg_WH4 overflow-hidden mr-3" style="background: url('images/icons/img5.png') no-repeat; background-size: cover;">
        </div>
        <div class="media-body">
            <p class="text-colorblue200 font-familyAtlasGroteskWeb-Regular">Quam nullam ligula mollis. A curabitur vel quis
                pellentesque odio felis vitae nulla condimentum
                consectetuer eu.</p>
        </div>
    </div> --}}

</div>
