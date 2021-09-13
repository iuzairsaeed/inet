@extends('layouts.app') @section('title') INET ED Platform :: View Profile @endsection @section('content')
    <style>
        .bookmarkCheckBox {
            border: 1px solid #dee2e6;
            border-radius: 100%;
            width: 3em;
            height: 3em;
            left: 0px;
        }

        .bookmarkCheck .custom-control-label::after {
            top: 0.61rem !important;
            left: 0.8rem !important;
            color: #5F6B7F;

        }

        .bookmarkCheck .custom-control-label::before {
            top: 0.61rem !important;
            left: 0.8rem !important;
            content: "\F02E" !important;
            background-color: transparent !important;
            color: #5F6B7F;
        }
   </style>
     @auth
        <?php $user_content_list = explode(",", $data['user_content_updated_list']);
                $cTags = json_decode($data['profile']->tags,true);
                $cCategoryIds = array_filter(explode(',', $data['profile']->category_ids));
 ?>
    @endauth
@include('include.header')

<section class="bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-9 pt-5 pb-5 ">
                <h3 class="text-black font-familyAtlasGroteskWeb-Bold mb-1">View Profile</h3>
                <p class="font-familyAtlasGroteskWeb-Light text-colorblue200 font-size12px">Keep your profile informative and up to date.</p>
                <div class="media mt-5 font-size14px">
                    <div class="thumbnailImg_WH1 thumbnailImg" style="background: url({{ url('/public/uploads/profile_images') . '/'. $data['profile']->profile_pic_url  }}) no-repeat; background-size: cover;">
                        {{--<img class="mr-3" src="{{ asset('public/uploads/profile_images') . '/'. $data['profile']->profile_pic_url }}" alt="placeholder image" width="130">--}}
                    </div>

                    <div class="media-body">
                        <h5 class="mt-0 font-familyAtlasGrotesk-Medium text-colorblue100 d-flex"><span class="align-self-center">{!! $data['profile']->full_name !!}</span> <span class="badge badge-secondary font-familyFreightTextProMedium-Italic font-size13px pl-3 pr-3 pt-2 ml-2 pb-2">{{ $data['role'] }}</span></h5>
                        <p class="text-colorblue200 font-familyAtlasGroteskWeb-Regular mb-1">{!! $data['profile']->about_me !!}</p>




                        <div class="mb-4">
                          {{--  <a href="#" class="font-familyAtlasGroteskWeb-Regular text-colorblue200 font-size13px">{!! Auth::user()->email !!}</a>--}}
                            <div class="">
                                @if ( $data['profile']->twitter_url == "")
                                <a href="#" class="text-colorblue200"><i class="fab fa-twitter"></i></a>
                                @else
                                <a href="{{ $data['profile']->twitter_url }}" class="text-colorblue200" target="_blank"><i class="fab fa-twitter"></i></a>
                                @endif

                                @if ( $data['profile']->youtube_url == "")
                                <a href="#"class="text-colorblue200 ml-3 mr-3"><i class="fab fa-youtube"></i></a>
                                @else
                                <a href="{{ $data['profile']->youtube_url }}"class="text-colorblue200 ml-3 mr-3"  target="_blank"><i class="fab fa-youtube"></i></a>
                                @endif


                                @if ( $data['profile']->web_url == "")
                                <a href="#" class="text-colorblue200"><i class="fas fa-globe"></i></a>
                                @else
                                <a href="{{ $data['profile']->web_url }}" class="text-colorblue200"  target="_blank"><i class="fas fa-globe"></i></a>
                                @endif
                            </div>
                        </div>
                        <p class="font-familyAtlasGrotesk-Medium text-colorblue100 font-size14px mb-0">Areas of Interest:</p>
                        <ul class="relatedTag font-familyAtlasGroteskWeb-Medium">
                                 <?php
                                    $tags = json_decode($data['tagsonly']->tags, true);
                                    if($tags!=Null){
                                    if (count($tags)) {
                                        foreach ($tags as $tag) {
                                            echo "<button onclick='coursesTagButton(this)' class='m-1 btn btn-customBtn1 font-familyAtlasGroteskWeb-Regular font-size13px mt-2 border-radius0all opacity0point5'>" . $tag . "</button>";
                                        }
                                    }
                                }
                                ?>
                        </ul>

                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-12 pt-5 pb-5 text-right">
                <button type="button" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px p-0 border-radius0px btnBotmBar" data-toggle="modal" data-target="#moadalEditProfile">
                    <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">EDIT PROFILE <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                    <div class="btn-bar"></div>
                </button>
            </div>
            @if(Auth::user()->role_id == 1 || Auth::user()->id == Auth::id())
            <div class="col-md-12 pb-5">
                <div class="col-md-12 border-top border-bottom pt-4 pb-4 font-familyAtlasGrotesk-Medium font-size14px">
                    <h6 class="mt-0text-colorblue100 d-flex mb-4"><i class="fas fa-user-clock mr-3"></i> <span class="align-self-center">Private Info</span></h6>
                    <div class="row">
                    @if(Auth::user()->role_id==1||Auth::user()->role_id==3)
                        <div class="col-md-3">
                            <p class="text-colorblue200 mb-0 font-size12px">Affiliation</p>
                            <p class="font-familyFreightTextProLight-Regular mb-0">{!! $data['tagsncat2']->affiliation  !!}</p>
                        </div>
                    @endif
                        <div class="col-md-3">
                            <p class="text-colorblue200 mb-0 font-size12px">Country</p>
                            <p class="font-familyFreightTextProLight-Regular">{!! $data['tagsncat2']->country !!}</p>
                        </div>
                        <div class="col-md-3">
                            <p class="text-colorblue200 mb-0 font-size12px">Gender</p>
                            <p class="font-familyFreightTextProLight-Regular mb-0">{!! $data['tagsncat2']->gender !!}</p>
                        </div>
                        <div class="col-md-3">
                            <p class="text-colorblue200 mb-0 font-size12px">Email</p>
                            <p class="font-familyFreightTextProLight-Regular mb-0">{!! $data['tagsncat2']->email !!}</p>
                        </div>
                    </div>
                </div>
            </div>

            @endif
            <div class="col-md-12 pb-5 p-0">
            @if(count($data['userdetailsnew']))
            @foreach ($data['userdetailsnew'] as $item)
                <div class="col-md-12 list-groupCusMain mb-2">
                    <div class="list-group  font-familyAtlasGroteskWeb-Regular text-colorblue100 font-size14px border-bottom" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active col-lg-2 col-md-3 text-center" id="list-threads-list" data-toggle="list" href="#pg-threads" role="tab" aria-controls="Threads"><span class="">{!! $item->threads !!}</span><br> Threads</a>
                         <a class="list-group-item list-group-item-action col-lg-2 col-md-3 text-center" id="list-posts-list" data-toggle="list" href="#pg-posts" role="tab" aria-controls="Posts"><span class="">{!! $item->posts !!}</span><br> Posts</a>
                        @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 3)
                        <a class="list-group-item list-group-item-action col-lg-2 col-md-3 text-center" id="list-contributionsNew-list" data-toggle="list" href="#pg-contributionsNew" role="tab" aria-controls="Contributions">
                            <span class="">{!! $item->contributionstotal !!}</span> <br> Contributions</a>
                        @endif
                    </div>
                </div>
                @endforeach
                @endif
                <div class="col-md-12 font-familyAtlasGroteskWeb-Regular font-size12px">
                    <div class="tab-content" id="">
                        <div class="tab-pane fade show active" id="pg-threads" role="tabpanel" aria-labelledby="Threads">
                        @if(count($data['threads2']))
                        @foreach ($data['threads2'] as $thead)
                            <div class="col-md-12 border-bottom pt-4 pb-4">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <p class="font-familyAtlasGroteskWeb-Medium">{!! $thead->title !!}</p>
                                        <div class="col p-0">
                                            <div class="row align-items-center">
                                                <div class="col border-right d-flex align-items-center">
                                                    <div class="thumbnailImg_WH5 thumbnailImg overflow-hidden mr-0" style="background: url({{ url('public/uploads/profile_images/')  . '/'. $thead->author_avatar }}) no-repeat; background-size: cover;">
                                                    </div>
                                                    <span class="font-familyAtlasGroteskWeb-Medium ml-3">{!!  $thead->author !!}</span>
                                                    <span class="badge badge-secondary font-familyFreightTextProMedium-Italic font-size13px pl-3 pr-3 pt-2 ml-2 pb-2">{!!  $thead->role !!}</span>
                                                </div>
                                                <div class="col-3 font-familyAtlasGroteskWeb-Regular d-flex align-items-center">
                                                    <img src="{{ asset('images/icons/pencil.png') }}" alt="" width="15" height="15">
                                                    <p class="mb-0 text-colorblue200 font-size12px ml-3">{{ date("M d, Y", strtotime($thead->c_at)) }}</p>
                                                </div>
                                                <div class="col font-familyAtlasGroteskWeb-Regular border-left d-flex align-items-center">
                                                    <!-- <p class="mb-0 text-colorblue200 font-size12px mr-3">Jump To</p>
                                                    <nav >
                                                        <ul class="pagination pagination-sm mb-0">
                                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                        </ul>
                                                    </nav> -->
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="col-12 text-center bg-lightWhite100 border font-size14px pt-3 pb-3">
                                                    <p class="font-familyAtlasGroteskWeb-Medium mb-2">{!! $thead->replies_count !!}</p>
                                                    <p class="font-familyAtlasGroteskWeb-Regular text-grayDark opacity0point5 mb-2">Replies</p>
                                                    <i class="far fa-comments text-ferozy font-size16px"></i>
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="col-12 text-center bg-lightWhite100 border font-size14px pt-3 pb-3">
                                                    <p class="font-familyAtlasGroteskWeb-Medium mb-2">{!! $thead->views_count !!}</p>
                                                    <p class="font-familyAtlasGroteskWeb-Regular text-grayDark opacity0point5 mb-2">Views</p>
                                                    <i class="far fa-eye text-ferozy font-size16px"></i>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="col-12 p-0 d-flex justify-content-end">
                                         @if ($thead->l_reply_at)
                                            <div class="font-familyAtlasGroteskWeb-Regular text-right mr-3">
                                                <div class="d-flex align-items-center">
                                                    <img src="http://127.0.0.1:8000/images/icons/pencil.png" alt="" width="15" height="15">
                                                    <p class="mb-0 text-colorblue200 font-size12px ml-3">{!! date("M d, Y", strtotime($thead->l_reply_at)) !!}</p>
                                                </div>
                                                <span class="font-familyAtlasGroteskWeb-Medium ml-3">{!! $thead->l_reply_user !!}</span>
                                            </div>
                                            <div class="thumbnailImg_WH5 thumbnailImg overflow-hidden mr-0" style="background: url({{ url('public/uploads/profile_images/')  . '/'. $thead->l_reply_user_avatar }}) no-repeat; background-size: cover;">
                                            </div>
                                         @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                            <!-- <div class="col-md-12 border-bottom pt-4 pb-4">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <p class="font-familyAtlasGroteskWeb-Medium">Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum mperdie ultricies</p>
                                        <div class="col p-0">
                                            <div class="row align-items-center">
                                                <div class="col border-right d-flex align-items-center">
                                                    <div class="thumbnailImg_WH5 thumbnailImg overflow-hidden mr-0" style="background: url(https://ineted.org/public/uploads/profile_images/1614696306.png) no-repeat; background-size: cover;">
                                                    </div>
                                                    <span class="font-familyAtlasGroteskWeb-Medium ml-3">Niko Tim</span>
                                                    <span class="badge badge-secondary font-familyFreightTextProMedium-Italic font-size13px pl-3 pr-3 pt-2 ml-2 pb-2">Student</span>
                                                </div>
                                                <div class="col-3 font-familyAtlasGroteskWeb-Regular d-flex align-items-center">
                                                    <img src="{{ asset('images/icons/pencil.png') }}" alt="" width="15" height="15">
                                                    <p class="mb-0 text-colorblue200 font-size12px ml-3">1min ago</p>
                                                </div>
                                                <div class="col font-familyAtlasGroteskWeb-Regular border-left d-flex align-items-center">
                                                    <p class="mb-0 text-colorblue200 font-size12px mr-3">Jump To</p>
                                                    <nav >
                                                        <ul class="pagination pagination-sm mb-0">
                                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                        </ul>
                                                    </nav>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="col-12 text-center bg-lightWhite100 border font-size14px pt-3 pb-3">
                                                    <p class="font-familyAtlasGroteskWeb-Medium mb-2">74</p>
                                                    <p class="font-familyAtlasGroteskWeb-Regular text-grayDark opacity0point5 mb-2">Replies</p>
                                                    <i class="far fa-comments text-ferozy font-size16px"></i>
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="col-12 text-center bg-lightWhite100 border font-size14px pt-3 pb-3">
                                                    <p class="font-familyAtlasGroteskWeb-Medium mb-2">2.7k</p>
                                                    <p class="font-familyAtlasGroteskWeb-Regular text-grayDark opacity0point5 mb-2">Views</p>
                                                    <i class="far fa-eye text-ferozy font-size16px"></i>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="col-12 p-0 d-flex justify-content-end">
                                            <div class="font-familyAtlasGroteskWeb-Regular text-right mr-3">
                                                <div class="d-flex align-items-center">
                                                    <img src="http://127.0.0.1:8000/images/icons/pencil.png" alt="" width="15" height="15">
                                                    <p class="mb-0 text-colorblue200 font-size12px ml-3">1min ago</p>
                                                </div>
                                                <span class="font-familyAtlasGroteskWeb-Medium ml-3">Niko Tim</span>
                                            </div>
                                            <div class="thumbnailImg_WH5 thumbnailImg overflow-hidden mr-0" style="background: url(https://ineted.org/public/uploads/profile_images/1614696306.png) no-repeat; background-size: cover;">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <div class="tab-pane fade" id="pg-posts" role="tabpanel" aria-labelledby="Posts">
                          @if(count($data['posts']))
                          @foreach ($data['posts'] as $post)
                            <div class="col-md-12 border-bottom pt-4 pb-4">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <p class="font-familyAtlasGroteskWeb-Medium">{!!  $post->body !!}</p>
                                        <div class="col p-0">
                                            <div class="row align-items-center">
                                                <div class="col border-right d-flex align-items-center">
                                                    <div class="thumbnailImg_WH5 thumbnailImg overflow-hidden mr-0" style="background: url({{ url('public/uploads/profile_images/')  . '/'. $post->author_avatar }}) no-repeat; background-size: cover;">
                                                    </div>
                                                    <span class="font-familyAtlasGroteskWeb-Medium ml-3">{!!  $post->author !!}</span>
                                                    <span class="badge badge-secondary font-familyFreightTextProMedium-Italic font-size13px pl-3 pr-3 pt-2 ml-2 pb-2">Student</span>
                                                </div>
                                                <div class="col-3 font-familyAtlasGroteskWeb-Regular d-flex align-items-center">
                                                    <img src="{{ asset('images/icons/pencil.png') }}" alt="" width="15" height="15">
                                                    <p class="mb-0 text-colorblue200 font-size12px ml-3">{{ date("M d, Y", strtotime($post->c_at)) }}</p>
                                                </div>
                                                <div class="col font-familyAtlasGroteskWeb-Regular border-left d-flex align-items-center">
                                                    <!-- <p class="mb-0 text-colorblue200 font-size12px mr-3">Jump To</p>
                                                    <nav >
                                                        <ul class="pagination pagination-sm mb-0">
                                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                        </ul>
                                                    </nav> -->
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <!-- <div class="col-12 text-center bg-lightWhite100 border font-size14px pt-3 pb-3">
                                                @if($post->repied_on_post_id==NULL)
                                                <p class="font-familyAtlasGroteskWeb-Medium mb-2">-</p>
                                                    <p class="font-familyAtlasGroteskWeb-Regular text-grayDark opacity0point5 mb-2">Replies</p>
                                                    <i class="far fa-comments text-ferozy font-size16px"></i>
                                                @else
                                                    <p class="font-familyAtlasGroteskWeb-Medium mb-2">{!!  $post->repied_on_post_id  !!}</p>
                                                    <p class="font-familyAtlasGroteskWeb-Regular text-grayDark opacity0point5 mb-2">Replies</p>
                                                    <i class="far fa-comments text-ferozy font-size16px"></i>
                                                @endif
                                                </div> -->

                                            </div>
                                            <div class="col-md-6">
                                                <!-- <div class="col-12 text-center bg-lightWhite100 border font-size14px pt-3 pb-3">
                                                    <p class="font-familyAtlasGroteskWeb-Medium mb-2">2.7k</p>
                                                    <p class="font-familyAtlasGroteskWeb-Regular text-grayDark opacity0point5 mb-2">Views</p>
                                                    <i class="far fa-eye text-ferozy font-size16px"></i>
                                                </div> -->

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="col-12 p-0 d-flex justify-content-end">
                                          <!-- @if ($post->repied_on_post_id)
                                            <div class="font-familyAtlasGroteskWeb-Regular text-right mr-3">
                                                <div class="d-flex align-items-center">
                                                    <img src="http://127.0.0.1:8000/images/icons/pencil.png" alt="" width="15" height="15">
                                                    <p class="mb-0 text-colorblue200 font-size12px ml-3">{{ date("M d, Y", strtotime($post->c_at)) }}</p>
                                                </div>
                                                <span class="font-familyAtlasGroteskWeb-Medium ml-3">{!! $post->repied_on_post_id !!}</span>
                                            </div>
                                            <div class="thumbnailImg_WH5 thumbnailImg overflow-hidden mr-0" style="background: url({{ url('public/uploads/profile_images/')  . '/'. $post->author_avatar }}) no-repeat; background-size: cover;">
                                            </div>
                                          @endif -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>

                       @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 3)
                     <div class="tab-pane fade" id="pg-contributionsNew" role="tabpanel" aria-labelledby="Contributions">
                        <div id="content_thumbnail_view" class="col-md-12 pt-4 pb-4">
                         <div class="row" id="content_result">
                          @if(count($data['my_contributions']))
                          @foreach ($data['my_contributions'] as $contribution)
                                                <div class="col-lg-4 col-md-6 mb-3 d-flex bookmarkCheck">
                                                    <div class="card col-12 p-0 border-radius0all">
                                                        <a href="content/view/{!!$contribution->id !!}">
                                                            <div class="thumbnailImg_WHCard overflow-hidden" style="background: url({{ url('public/uploads/content/profile_images/' . $contribution->image_url ) }}) no-repeat; background-size: cover;"></div>
                                                        </a>

                                                        <div class="card-header bg-transparent border-0 pb-0 pt-2 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200">

                                                            <small class="float-right">{{ $contribution->views_count }} Views</small>
                                                            </div>
                                                        <div class="card-body">

                                                            <a href="content/view/{!!$contribution->id !!}">
                                                                <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0 font-size1em">{{ $contribution->title }}</h6>
                                                            </a>
                                                            <p class="card-text  mb-0"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $contribution->authors }}</small></p>
                                                            <p class="card-text  mb-0"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $contribution->affiliation }}</small></p>
                                                            <p class="card-text mb-0"><small class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size13px mb-2">{{ $contribution->difficulty_level }}</small></p>
                                                        </div>
                                                        @if($contribution->content_privacy == 0)
                                                        <div class="text-right pr-3">Public</div>
                                                        @else
                                                        <div class="text-right pr-3">Restricted</div>
                                                        @endif
                                                        <div class="card-footer bg-transparent border-0 d-flex justify-content-between">
                                                            <small class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size10px align-self-center"></small>
                                                            <div class="m-0 text-colorblue200 d-flex bookmark">

                                                                <div class="custom-control custom-checkbox mr-sm-2">
                                                                <input {{ in_array($contribution->id, $user_content_list) ? 'checked' : '' }} onclick="bookmark(this)" type="checkbox" value={{ '[' . $contribution->id . ',' . Auth::user()->id . ']' }} class="custom-control-input" id="bookmark-{{ $contribution->id }}">
                                                                    <label class="custom-control-label bookmarkCheckBox" for="bookmark-{{ $contribution->id }}"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                          @endforeach
                          @endif
                         </div>
                        </div>
                     </div>
                    @endif
                    </div>
                </div>

            </div>

            @if ($data['role'] == 'Contributor')
            <div class="col-md-12 p-0 mt-5 mb-5">
                <div class="col-md-12 list-groupCusMain mb-2">
                    <div class="list-group  font-familyAtlasGroteskWeb-Regular text-colorblue100 font-size14px border-bottom" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active col-lg-2 col-md-3" id="list-contributions-list" data-toggle="list" href="#pg-contributions" role="tab" aria-controls="Contributions">Contributions</a>
                        {{-- <a class="list-group-item list-group-item-action col-lg-2 col-md-3" id="list-Threads-list" data-toggle="list" href="#pg-threads" role="tab" aria-controls="Threads">Threads</a>
                        <a class="list-group-item list-group-item-action col-lg-2 col-md-3" id="list-answers-list" data-toggle="list" href="#pg-answers" role="tab" aria-controls="Answers">Answers</a> --}}
                    </div>
                </div>
                <div class="col-md-12 mt-4">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="pg-contributions" role="tabpanel" aria-labelledby="contributions">
                            <div class="row">

                                @foreach($contributions as $contr)

                                <div class="col-lg-3 col-md-6 mb-3 d-flex bookmarkCheck">
                                    <div class="card col-12 p-0 border-radius0all">
                                        <a href="{!! route('contentSection', ['content_id' => $contr->id]) !!}">
                                            <div class="thumbnailImg_WHCard overflow-hidden" style="background: url({{ url('/public/uploads/content/profile_images') . '/'.  $contr->image_url }}) no-repeat; background-size: cover;">
                                            </div>
                                        </a>
                                        <div class="card-header bg-transparent border-0 pb-0 pt-2 font-size14px font-familyAtlasGroteskWeb-Medium text-colorblue200">
                                            <small class="float-left">{!! $contr->difficulty_level !!}</small>
                                        </div>
                                        <div class="card-body">
                                            <a href="{!! route('contentSection', ['content_id' => $contr->id]) !!}">
                                            <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0">{!! $contr->title !!}</h6>
                                            </a>
                                            <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{!! $contr->name !!}</small></p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach



                            </div>
                        </div>

                        <div class="tab-pane fade" id="pg-threads" role="tabpanel" aria-labelledby="threads">
                            <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0">Content Required</h6>
                        </div>

                        <div class="tab-pane fade" id="pg-answers" role="tabpanel" aria-labelledby="answers">
                            <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0">Content Required</h6>
                        </div>

                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</section>

@include('include.footer')

<!-- Modal EDIT PROFILE -->
<div class="modal fade p-0" id="moadalEditProfile" tabindex="-1" role="dialog" aria-labelledby="moadalEditProfile" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered max-width690px p-md-0 p-3" role="document">
        <div class="modal-content border-radius0px">
            <div class="modal-header p-4">
                <h6 class="modal-title font-familyAtlasGroteskWeb-Bold text-colorblue100" id="moadalEditProfileTitle">EDIT PROFILE</h6>
                <button type="button" class="close outlineNone text-colorMahroon700" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body p-4">
                <form id="profile_update_form" action="{{ route('updateProfile') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customFileMain">
                        <label for="fullName" class="mb-0 text-colorblue100">Update Profile Picture</label>
                        <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Change your profile picture (Profile picture can only be equal or less than 3mb)</p>
                        <div class="custom-file">
                            <input name="profile_image" type="file" class="custom-file-input col-md-4 p-0 getVal"  onchange="getVal()">
                            <div id="saveFileVal" class="font-familyAtlasGroteskWeb-Light text-colorblue200 font-size11px mt-1"></div>
                            <label class="custom-file-label font-familyFreightTextProLight-Regular text-darkBlue font-size14px col-md-4 d-flex align-items-center justify-content-between" for="profile_image">Upload</label>
                        </div>
                    </div>

                    <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                        <label for="profile_fullName" class="mb-0 text-colorblue100">Full Name</label>
                        <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">This is how your name will appear, and how admin and your students will recognize you.</p>
                        <input value="{{ $data['profile']->full_name }}" id="profile_image" type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" name="profile_fullName" placeholder="Name">
                    </div>


                    <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                        <label for="twitter_url" class="mb-0 text-colorblue100">Twitter URL</label>
                        <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Add your twitter here.</p>
                        <input value="{{ $data['profile']->twitter_url }}" id="twitter_url" type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" name="twitter_url" placeholder="twitter url">
                    </div>

                    <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                        <label for="youtube_url" class="mb-0 text-colorblue100">Youtube URL</label>
                        <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Add your youtube URL.</p>
                        <input value="{{ $data['profile']->youtube_url }}" id="youtube_url" type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" name="youtube_url" placeholder="youtube url">
                    </div>


                    <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                        <label for="web_url" class="mb-0 text-colorblue100">Web URL</label>
                        <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Add your WEB URL.</p>
                        <input value="{{ $data['profile']->web_url }}" id="web_url" type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" name="web_url" placeholder="web url">
                    </div>





                    <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-4 pb-2">

                        <label for="profile_discription" class="mb-0 text-colorblue100">About Me</label>
                        <div class="col-md-12 font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">
                            <p class="float-left mb-0">Add Content description to help students discover and learn about your Content.</p>
                            {{-- <p class="float-right mb-0"><span id="count2">0</span> / 160</p> --}}
                        </div>
                    </div>
                    <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100">



                        {{-- <textarea class="form-control font-familyFreightTextProLight-Regular text-darkBlue classy-editor" name="profile_discription" id="profile_discription"  rows="6" cols="260" onkeyup="charcountupdate(this.value)"  maxlength="160" placeholder="Content Description">{{ $data['profile']->about_me }}</textarea>
                    </div> --}}

                        <input type="hidden" class="hidden" name="profile_discription" id="profile_discription">


                        {{--{{ $data['profile']->about_me }}--}}
                       <textarea class="form-control font-familyFreightTextProLight-Regular text-darkBlue"  id="profile_discription_c" placeholder="Content Description" rows="6" cols="260" onkeyup="charcountupdate(this.value)"  maxlength="160">{!! $data['profile']->about_me !!}</textarea>

                    </div>
                    <div class="form-group">
                        <button type="button" disabled class="btn btn-customBtn1 font-size12px mt-2 border-radius0all opacity0point5 text-white font-familyAtlasGroteskWeb-Medium">Areas of Interest</button>
                    </div>
                    <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                        <label for="profile_selectpickerCategories" class="mb-0 text-colorblue100">Select Category</label>
                        <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Choose any seven fields to which your interests is most closely related.</p>
                        <select id="selectpickerCategories2" name="selectpickerCategories2" class="border font-familyFreightTextProLight-Regular text-darkBlue addPlaceholder" multiple title="Categories">
                        @if ($data['categories'])
                                            @foreach ($data['categories'] as $category)
                                               @if($cCategoryIds==NULL)
                                                 <option value="{{ $category->id }}">{!! $category->name !!}</option>
                                               @else
                                                 <option value="{{ $category->id }}" {{in_array($category->id,$cCategoryIds) ? 'selected': ''}}>{!! $category->name !!}</option>
                                               @endif
                                            @endforeach
                         @endif
                        </select>
                        <i class="fas fa-angle-down position-absolute marginDArrow"></i>
                        <small id="profile_content_categories_err" style="color: red"></small>
                    </div>

                    <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                        <label for="selectpickerTags2" class="mb-0 text-colorblue100">Add Tags (Only 3)</label>
                        <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Add tags that best reflects your interests.</p>
                        <select id="selectpickerTags2" name="selectpickerTags2" class="border font-familyFreightTextProLight-Regular text-darkBlue" multiple title="Tag" size='2'>
                        @if ($allTags)
                         @foreach ($allTags as $tag)
                             @if($cTags==NULL)
                                 <option>{{ $tag->name }}</option>
                               @else
                                <option value="{{$tag->name}}" {{in_array($tag->name,$cTags) ? 'selected':''}}>{{ $tag->name }}</option>
                             @endif
                          @endforeach
                        @endif
                        </select>
                        <i class="fas fa-angle-down position-absolute marginDArrow"></i>
                        <small id="profile_content_tag_err" style="color: red"></small>
                    </div>



                    <div class="form-group" id="display_result" style="text-align: center;"></div>
                </form>

            </div>
            <div class="modal-footer box-shadow">
                <button type="submit" form="profile_update_form" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar">
                    <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">Save <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                    <div class="btn-bar"></div>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')

<script>
    tinymce.init({
      selector: '#profile_discription_c',
      plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table preview advtable tinycomments tinymcespellchecker fullscreen anchor   image code imagetools emoticons link ',
      toolbar: 'insertfile undo redo |  bold italic | alignleft aligncenter alignright alignjustify | link image | print  media fullpage | forecolor backcolor emoticons | code ',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
	  file_picker_types: 'file image media',
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
  </script>
    {{-- <script src="{{ asset('js/textarea/jquery.classyedit.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".classy-editor").ClassyEdit();
            $(".editor").attr('data-placeholder', 'Enter a Short Bio');
        });
    </script> --}}
@endsection
@section('style')
    <style>
       /* .bg-lightWhite {
            background-color: #f7f7f6 !important;
        }*/
    </style>
    {{-- <link href="{{ asset('css/textarea/jquery.classyedit.css') }}" rel="stylesheet"> --}}
@endsection
