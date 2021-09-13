@extends('layouts.app')


@section('title') INET ED Platform @endsection

@section('content')
    @include('include.header')

    <style>
        .dropdown-toggle {
            padding: 5px !important;
        }

        .toolbar {
            width: 100%;
        }
        .lds-dual-ring {
            display: inline-block;
            width: 80px;
            height: 80px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
        }
        .lds-dual-ring:after {
            content: " ";
            display: block;
            width: 64px;
            height: 64px;
            margin: 8px;
            border-radius: 50%;
            border: 6px solid black;
            border-color: black transparent black transparent;
            animation: lds-dual-ring 1.2s linear infinite;
        }
        @keyframes lds-dual-ring {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
        .restric_cap {
            color: #591931;
            background: #c3a5af;
            text-align: center;
            border-radius: 15px;
            padding: 4px 3px;
        }

    </style>

    <?php $user_content_list = explode(",", $user_content_updated_list); ?>

    <section class="pt-5 pb-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-6 p-0">
                    <div class="col-md-12">
                        <h3 class="text-black font-familyAtlasGroteskWeb-Bold mb-4">Dashboard</h3>
                    </div>

                    <div class="col-md-12 list-groupCusMain mb-2">
                        <div class="list-group  font-familyAtlasGroteskWeb-Regular text-colorblue100 font-size14px border-bottom" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#pg-content" role="tab" aria-controls="Content">Content</a>
                            <a class="list-group-item list-group-item-action" id="list-course-list" data-toggle="list" href="#pg-course" role="tab" aria-controls="courses">Courses</a>
                            <a class="list-group-item list-group-item-action" id="list-contributors-bookmarks-list" data-toggle="list" href="#contri-bookmarks" role="tab" aria-controls="Bookmarks">Bookmarks</a>
                            <a class="list-group-item list-group-item-action" id="list-contributor-history" data-toggle="list" href="#contributor-history" role="tab" aria-controls="History">History</a>
                            <a class="list-group-item list-group-item-action" id="list-commented-history" data-toggle="list" href="#commented-history" role="tab" aria-controls="History">Comments by Admin</a>

                            {{-- <a class="list-group-item list-group-item-action" id="list-playlist-list" data-toggle="list" href="#pg-playlist" role="tab" aria-controls="Contributor">
                                Playlist
                            </a> --}}

                        </div>
                    </div>

                    <div class="col-md-12 mt-4">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="pg-content" role="tabpanel" aria-labelledby="Content">
                            <div class="row">


                                    <div class="col-lg-6 col-md-12 mb-3 d-flex">
                                        <div class="col-md-12 borderDotted text-center font-size12px pt-5 pb-5">
                                            <div class="row h-100">
                                                <div class="align-self-center my-lg-auto mt-4 mb-4 w-100">
                                                    <button class="btn btn-customBtn4 border-radius2em widHei2em" data-toggle="modal" data-target="#moadalAddNewCourse"><i class="fas fa-plus text-white"></i></button>
                                                    <p class="font-familyAtlasGroteskWeb-Bold text-colorblue200 mt-3 mb-0">ADD NEW CONTENT</p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                 </div>
                                <hr class="mb-4">

                                <div class="row">
                                    <div class="col-md-4 font-size13px align-self-center pt-5 pb-md-4 pb-0 mb-3">
                                        <div class="row no-gutters" id="list-tab" role="tablist">
                                            <p class="font-familyAtlasGroteskWeb-Medium text-grayDark mb-0 mr-2 opacity0point5 align-self-center">VIEW</p>

                                            <a id="view-thumbnail_t"><i id="viewIcon1" class="fas fa-th-large align-self-center text-colorblue200 text-ferozy mr-2" onclick="chnageColor(1)"></i></a>
                                            <a id="view-list_t"><i id="viewIcon2" class="fas fa-th-list align-self-center text-colorblue200" onclick="chnageColor(2)"></i></a>
                                        </div>
                                    </div>


                                </div>







                                <div class="row" id="content_with_thumbnail">
                                    @if ($my_content)
                                        @foreach ($my_content as $content)
                                            @if ($content->status == 1)
                                                <div class="col-lg-6 col-md-12 mb-3 d-flex bookmarkCheck">
                                                    <div class="card col-12 p-0 border-radius0all">
                                                        <a href="content/view/{!!$content->id !!}">
                                                            <div class="thumbnailImg_WHCard overflow-hidden" style="background: url({{ url('public/uploads/content/profile_images/' . $content->image_url ) }}) no-repeat; background-size: cover;"></div>
                                                        </a>

                                                        <div class="card-header bg-transparent border-0 pb-0 pt-2 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200">

                                                            <small class="float-right">{{ $content->views_count }} Views</small>
                                                            </div>
                                                        <div class="card-body">

                                                            <a href="content/view/{!!$content->id !!}">
                                                                <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0 font-size1em">{{ $content->title }}</h6>
                                                            </a>
                                                            <p class="card-text  mb-0"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $content->authors }}</small></p>
                                                            <p class="card-text  mb-0"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $content->affiliation }}</small></p>
                                                            <p class="card-text mb-0"><small class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size13px mb-2">{{ $content->difficulty_level }}</small></p>
                                                        </div>
                                                        @if($content->content_privacy == 0)
                                                        <div class="text-right pr-3">Public</div>
                                                        @else
                                                        <div class="text-right pr-3">Restricted</div>
                                                        @endif
                                                        <div class="card-footer bg-transparent border-0 d-flex justify-content-between">
                                                            <small class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size10px align-self-center"></small>
                                                            <div class="m-0 text-colorblue200 d-flex bookmark">

                                                                <div class="custom-control custom-checkbox mr-sm-2">
                                                                    <input {{ in_array($content->id, $user_content_list) ? 'checked' : '' }} onclick="bookmark(this)" type="checkbox" value={{ '[' . $content->id . ',' . Auth::user()->id . ']' }} class="custom-control-input" id="bookmark-{{ $content->id }}">
                                                                    <label class="custom-control-label" for="bookmark-{{ $content->id }}"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-lg-6 col-md-12 mb-3 d-flex bookmarkCheck flex-column">
                                                    <div class="card col-12 p-0 opacity0point5 border-radius0all">
                                                     <a href="content/view/{!!$content->id !!}">
                                                        <div class="thumbnailImg_WHCard overflow-hidden" style="background: url({{ url('public/uploads/content/profile_images/' . $content->image_url) }}) no-repeat; background-size: cover;">
                                                        </div>
                                                    </a>

                                                        <div class="card-header bg-transparent border-0 pb-0 pt-2 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200">

                                                            <small class="float-right">{{ $content->views_count }} Views</small>
                                                        </div>
                                                        <div class="card-body">

                                                             <a href="content/view/{!!$content->id !!}">
                                                                <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0 font-size1em">{{ $content->title }}</h6>
                                                            </a>
                                                            <p class="card-text mb-0"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $content->authors }}</small></p>
                                                            <p class="card-text mb-0"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $content->affiliation }}</small></p>
                                                            <p class="card-text mb-0"><small class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size13px mb-2">{{ $content->difficulty_level }}</small></p>
                                                        </div>
                                                        @if($content->content_privacy == 0)
                                                        <div class="text-right pr-3">Public</div>
                                                        @else
                                                        <div class="text-right pr-3">Restricted</div>
                                                        @endif
                                                        <span class="badge badge-customBtn4 font-familyAtlasGroteskWeb-Medium font-weight-normal font-size12px p-3  text-brown border-radius0all align-self-end">Awaiting Approval</span>
                                                        <div class="card-footer bg-transparent border-0 d-flex justify-content-between">
                                                            <small class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size10px align-self-center"></small>

                                                            <div class="m-0 text-colorblue200 d-flex bookmark">

                                                                <div class="custom-control custom-checkbox mr-sm-2">
                                                                    <input {{ in_array($content->id, $user_content_list) ? 'checked' : '' }} onclick="bookmark(this)" type="checkbox" value={{ '[' . $content->id . ',' . Auth::user()->id . ']' }} class="custom-control-input" id="bookmark-{{ $content->id }}">
                                                                    <label class="custom-control-label" for="bookmark-{{ $content->id }}"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif

                                </div>

                                <!--List View content --->
                                <div class="row" id="content_with_list" style="display: none;">
                                    @if ($my_content)
                                        @foreach ($my_content as $content)
                                            @if ($content->status == 1)
                                                <div class="col-md-7">
                                                    <div class="media font-size14px">
                                                        <div class="media-body font-familyAtlasGrotesk-Medium">
                                                            <a href="content/view/{!!$content->id !!}">
                                                                <h6 class="mt-0 text-colorblue100 mb-0">{{ $content->title }}</h6>
                                                            </a>
                                                            <div class="font-familyAtlasGroteskWeb-Regular font-size13px">
                                                                <div class="justify-content-between">
                                                                    <p class="text-colorblue200 mb-2">{{ $content->authors }} <br> {{ $content->affiliation }} </p>
                                                                </div>
                                                            </div>
                                                            <p class="text-colorblue100 font-size10px"><span class="mr-2">{{ $content->difficulty_level }}</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    @if($content->content_privacy == 0)
                                                    {{-- <div class="text-right pr-3">Public</div> --}}
                                                    @else
                                                    <div class="restric_cap"> <span><i class="fas fa-graduation-cap"></i></span> <span class="font-size12px font-familyAtlasGroteskWeb-Regular">Restricted</span> </div>
                                                    @endif
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="card-footer bg-transparent border-0 d-flex justify-content-between">
                                                        <small class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size10px align-self-center"></small>

                                                        <div class="m-0 text-colorblue200 d-flex bookmark">
                                                            {{-- <i class="fas fa-download"></i> --}}
                                                            <div class="custom-control custom-checkbox mr-sm-2">
                                                                <input {{ in_array($content->id, $user_content_list) ? 'checked' : '' }} onclick="bookmark(this)" type="checkbox" value={{ '[' . $content->id . ',' . Auth::user()->id . ']' }} class="custom-control-input" id="bookmark-{{ $content->id }}">
                                                                <label class="custom-control-label" for="bookmark-{{ $content->id }}"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else

                                            <div class="col-md-7">
                                                <div class="media font-size14px">
                                                    <div class="media-body font-familyAtlasGrotesk-Medium">
                                                        <a href="content/view/{!!$content->id !!}">
                                                            <h6 class="mt-0 text-colorblue100 mb-0">{{ $content->title }}</h6>
                                                        </a>
                                                        <div class="font-familyAtlasGroteskWeb-Regular font-size13px">
                                                            <div class="justify-content-between">
                                                                <p class="text-colorblue200 mb-2">{{ $content->authors }} <br> {{ $content->affiliation }} </p>
                                                            </div>
                                                        </div>
                                                        <p class="text-colorblue100 font-size10px"><span class="mr-2">{{ $content->difficulty_level }}</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                @if($content->content_privacy == 0)
                                                {{-- <div class="text-right pr-3">Public</div> --}}
                                                @else
                                                <div class="restric_cap"> <span><i class="fas fa-graduation-cap"></i></span> <span class="font-size12px font-familyAtlasGroteskWeb-Regular">Restricted</span> </div>
                                                @endif
                                            </div>
                                            <div class="col-md-2">
                                                <div class="card-footer bg-transparent border-0 d-flex justify-content-between">
                                                    <small class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size10px align-self-center"></small>

                                                    <div class="m-0 text-colorblue200 d-flex bookmark">
                                                        {{-- <i class="fas fa-download"></i> --}}
                                                        <div class="custom-control custom-checkbox mr-sm-2">
                                                            <input {{ in_array($content->id, $user_content_list) ? 'checked' : '' }} onclick="bookmark(this)" type="checkbox" value={{ '[' . $content->id . ',' . Auth::user()->id . ']' }} class="custom-control-input" id="bookmark-{{ $content->id }}">
                                                            <label class="custom-control-label" for="bookmark-{{ $content->id }}"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            @endif
                                        @endforeach
                                    @endif

                                </div>

                            </div>



         <!-- course -->



             <div class="tab-pane fade" id="pg-course" role="tabpanel" aria-labelledby="Content">
                        <div class="row">


                                    <div class="col-lg-6 col-md-12 mb-3 d-flex">
                                        <div class="col-md-12 borderDotted text-center font-size12px pt-5 pb-5">
                                            <div class="row h-100">
                                                <div class="align-self-center my-lg-auto mt-4 mb-4 w-100">
                                                    <button class="btn btn-customBtn4 border-radius2em widHei2em" data-toggle="modal" data-target="#moadalAddNewCourse1"><i class="fas fa-plus text-white"></i></button>
                                                    <p class="font-familyAtlasGroteskWeb-Bold text-colorblue200 mt-3 mb-0">CREATE NEW COURSE</p>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                 </div>
                                <hr class="mb-4">

                                <div class="row">
                                    <div class="col-md-4 font-size13px align-self-center pt-5 pb-md-4 pb-0 mb-3">
                                        <div class="row no-gutters" id="list-tab" role="tablist">
                                            <p class="font-familyAtlasGroteskWeb-Medium text-grayDark mb-0 mr-2 opacity0point5 align-self-center">VIEW</p>

                                            <a id="view-thumbnail_co">
                                                <i id="viewIcon3" class="fas fa-th-large align-self-center text-colorblue200 text-ferozy mr-2" onclick="chnageColor2(3)"></i>
                                            </a>
                                            <a id="view-list_co">
                                                <i id="viewIcon4" class="fas fa-th-list align-self-center text-colorblue200" onclick="chnageColor2(4)"></i>
                                            </a>
                                        </div>
                                    </div>
                            <div class="col-md-8 font-familyAtlasGroteskWeb-Medium font-size13px customDropDownInnerPg pt-md-5 pt-0 pb-4 ">
                                <div class="row">
                                    <div class="col text-right align-self-center">
                                        <p class="opacity0point5 mb-3">Sort By</p>
                                    </div>

                                    <div class="col mb-3">
                                        <select id='course_sort_new' name='sort' class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue">

                                            <option value="popular">Most Viewed/Popular</option>
                                            <option value="alpha">Alphabetically</option>
                                            <option value="new">Newest</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                        </div>








                                <div class="row" id="content_with_thumbnail_course">
                                    @if ($my_course)
                                        @foreach ($my_course as $content)

                                            @if ($content->status == 1)
                                                <div class="col-lg-6 col-md-12 mb-3 d-flex bookmarkCheck">
                                                    <div class="card col-12 p-0 border-radius0all">
                                                    <a href="content/view/{!!$content->id !!}">
                                                            <div class="thumbnailImg_WHCard overflow-hidden" style="background: url({{ url('public/uploads/content/profile_images/' . $content->image_url ) }}) no-repeat; background-size: cover;"></div>
                                                        </a>

                                                        <div class="card-header bg-transparent border-0 pb-0 pt-2 d-flex flex-wrap">
                                                                    <div class="col-sm-6 p-0">
                                                                    @if($content->content_privacy == 0 && $content->scope_type=='course')
                                                                    <div class="text-center p-2 badge-secondary border-radius2em font-size13px font-familyAtlasGrotesk-Medium">Public</div>
                                                                    @else
                                                                    <div class="text-center p-2 badge-secondary border-radius2em font-size13px font-familyAtlasGrotesk-Medium">Restricted</div>
                                                                    @endif
                                                                    </div>

                                                            <div class="col-sm-6 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200 p-0 text-right"><small>{{ $content->views_count }} Views</small></div>
                                                            </div>
                                                        <div class="card-body" style="flex:0;min-height: auto;">

                                                        <a href="content/view/{!!$content->id !!}">
                                                                <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0 font-size1em">{{ $content->title }}</h6>
                                                            </a>
                                                            <p class="card-text  mb-0"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $content->authors }}</small></p>
                                                            <p class="card-text  mb-0"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $content->affiliation }}</small></p>
                                                            <p class="card-text mb-0"><small class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size13px mb-2">{{ $content->difficulty_level }}</small></p>
                                                        </div>

                                                        <div class="w-100 bg-lightWhite p-2" style="border-radius:0px 30px 30px 0px;max-width: 179px;">
                                                        <h6 class="font-familyAtlasGrotesk-Regular text-colorblue200 font-size12px m-0" style="line-height: 2.3;"><img src="{{ asset('images/bookicon.png') }}" width="25" class="mr-1"> Course ({{$content->count}} items) </h6></div>


                                                        <div class="card-footer bg-transparent border-0 d-flex justify-content-between">
                                                            <small class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size10px align-self-center"></small>
                                                            <div class="m-0 text-colorblue200 d-flex bookmark">

                                                                <div class="custom-control custom-checkbox mr-sm-2">
                                                                    <input {{ in_array($content->id, $user_content_list) ? 'checked' : '' }} onclick="bookmark(this)" type="checkbox" value={{ '[' . $content->id . ',' . Auth::user()->id . ']' }} class="custom-control-input" id="bookmark-{{ $content->id }}">
                                                                    <label class="custom-control-label" for="bookmark-{{ $content->id }}"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-lg-6 col-md-12 mb-3 d-flex bookmarkCheck flex-column">
                                                    <div class="card col-12 p-0 opacity0point5 border-radius0all">
                                                     <a href="coursecontent/view/{!!$content->id !!}">
                                                        <div class="thumbnailImg_WHCard overflow-hidden" style="background: url({{ url('public/uploads/content/profile_images/' . $content->image_url) }}) no-repeat; background-size: cover;">
                                                        </div>
                                                    </a>

                                                        <div class="card-header bg-transparent border-0 pb-0 pt-2 d-flex flex-wrap">

                                                        <div class="col-sm-6 p-0">
                                                        @if($content->content_privacy == 0 && $content->scope_type=='course')
                                                        <div class="text-center p-2 badge-secondary border-radius2em font-size13px font-familyAtlasGrotesk-Medium">Public</div>
                                                        @else
                                                        <div class="text-center p-2 badge-secondary border-radius2em font-size13px font-familyAtlasGrotesk-Medium">Restricted</div>
                                                        @endif
                                                        </div>


                                                            <div class="col-sm-6 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200 p-0 text-right">
                                                            <small class="">{{ $content->views_count }} Views</small></div>
                                                        </div>
                                                        <div class="card-body">

                                                        <a href="coursecontent/view/{!!$content->id !!}">
                                                                <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0 font-size1em">{{ $content->title }}</h6>
                                                            </a>
                                                            <p class="card-text mb-0"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $content->authors }}</small></p>
                                                            <p class="card-text mb-0"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $content->affiliation }}</small></p>
                                                            <p class="card-text mb-0"><small class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size13px mb-2">{{ $content->difficulty_level }}</small></p>
                                                        </div>

                                                        <div class="w-100 bg-lightWhite p-2" style="border-radius:0px 30px 30px 0px;max-width: 179px;">
                                                        <h6 class="font-familyAtlasGrotesk-Regular text-colorblue200 font-size12px m-0" style="line-height: 2.3;"><img src="{{ asset('images/bookicon.png') }}" width="25" class="mr-1"> Course ({{$content->count}} items) </h6></div>

                                                        @if ($content->status == 0)
                                                        <span class="badge badge-customBtn4 font-familyAtlasGroteskWeb-Medium font-weight-normal font-size12px p-3  text-brown border-radius0all align-self-end">Awaiting Approval</span>
                                                        @endif

                                                        <div class="card-footer bg-transparent border-0 d-flex justify-content-between">
                                                            <small class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size10px align-self-center"></small>

                                                            <div class="m-0 text-colorblue200 d-flex bookmark">

                                                                <div class="custom-control custom-checkbox mr-sm-2">
                                                                    <input {{ in_array($content->id, $user_content_list) ? 'checked' : '' }} onclick="bookmark(this)" type="checkbox" value={{ '[' . $content->id . ',' . Auth::user()->id . ']' }} class="custom-control-input" id="bookmark-{{ $content->id }}">
                                                                    <label class="custom-control-label" for="bookmark-{{ $content->id }}"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif

                                </div>

                                <!--List View content --->
                                <div class="row" id="content_with_list_course" style="display: none;">
                                    @if ($my_course)
                                        @foreach ($my_course as $content)
                                            @if ($content->status == 1 )
                                                <div class="col-md-7">
                                                    <div class="media font-size14px">
                                                        <div class="media-body font-familyAtlasGrotesk-Medium">
                                                        <a href="content/view/{!!$content->id !!}">
                                                                <h6 class="mt-0 text-colorblue100 mb-0">{{ $content->title }}</h6>
                                                            </a>
                                                            <div class="font-familyAtlasGroteskWeb-Regular font-size13px">
                                                                <div class="justify-content-between">
                                                                    <p class="text-colorblue200 mb-2">{{ $content->authors }} <br> {{ $content->affiliation }} </p>
                                                                </div>
                                                            </div>
                                                            <p class="text-colorblue100 font-size10px"><span class="mr-2">{{ $content->difficulty_level }}</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    @if($content->content_privacy == 0 && $content->scope_type=='course')
                                                    {{-- <div class="text-right pr-3">Public</div> --}}
                                                    @else
                                                    <div class="restric_cap"> <span><i class="fas fa-graduation-cap"></i></span> <span class="font-size12px font-familyAtlasGroteskWeb-Regular">Restricted</span> </div>
                                                    @endif
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="card-footer bg-transparent border-0 d-flex justify-content-between">
                                                        <small class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size10px align-self-center"></small>


                                                    </div>
                                                </div>
                                            @else

                                            <div class="col-md-7">
                                                <div class="media font-size14px">
                                                    <div class="media-body font-familyAtlasGrotesk-Medium">
                                                    <a href="coursecontent/view/{!!$content->id !!}">
                                                            <h6 class="mt-0 text-colorblue100 mb-0">{{ $content->title }}</h6>
                                                        </a>
                                                        <div class="font-familyAtlasGroteskWeb-Regular font-size13px">
                                                            <div class="justify-content-between">
                                                                <p class="text-colorblue200 mb-2">{{ $content->authors }} <br> {{ $content->affiliation }} </p>
                                                            </div>
                                                        </div>
                                                        <p class="text-colorblue100 font-size10px"><span class="mr-2">{{ $content->difficulty_level }}</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                @if($content->content_privacy == 0)
                                                {{-- <div class="text-right pr-3">Public</div> --}}
                                                @else
                                                {{-- <div class="restric_cap"> <span><i class="fas fa-graduation-cap"></i></span> <span class="font-size12px font-familyAtlasGroteskWeb-Regular">Restricted</span> </div> --}}
                                                @endif
                                            </div>
                                            <div class="col-md-2">
                                                <div class="card-footer bg-transparent border-0 d-flex justify-content-between">
                                                    <small class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size10px align-self-center"></small>

                                                    {{-- <div class="m-0 text-colorblue200 d-flex bookmark">

                                                        <div class="custom-control custom-checkbox mr-sm-2">
                                                            <input {{ in_array($content->id, $user_content_list) ? 'checked' : '' }} onclick="bookmark(this)" type="checkbox" value={{ '[' . $content->id . ',' . Auth::user()->id . ']' }} class="custom-control-input" id="bookmark-{{ $content->id }}">
                                                            <label class="custom-control-label" for="bookmark-{{ $content->id }}"></label>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                            </div>

                                            @endif
                                        @endforeach
                                    @endif

                                </div>

            </div>










                            <div class="tab-pane fade" id="contri-bookmarks" role="tabpanel" aria-labelledby="Bookmarks">
                                <div class="row" id="contributors-bookmarks">
                                </div>
                            </div>

                            <div class="tab-pane fade" id="contributor-history" role="tabpanel" aria-labelledby="history">
                                <div class="row" id="contributors-history">
                                </div>
                            </div>


                            <div class="tab-pane fade" id="commented-history" role="tabpanel" aria-labelledby="history">
                                <div class="row" id="commented-history-list">

                                </div>
                            </div>



                            <!-- playlist tab -->
                        <div class="tab-pane fade horizontalScroll" id="pg-playlist" role="tabpanel" aria-labelledby="history">
                            <div class="row add-playlist">
                                <div class="col-6 col-md-6 mb-3 d-flex ">
                                    <div class="col-md-12 borderDotted text-center font-size12px">
                                        <div class="row h-100">
                                            <div class="align-self-center my-lg-auto mt-4 mb-4 w-100">
                                                <button class="btn btn-customBtn4 border-radius2em widHei2em" data-toggle="modal" data-target="#moadalAddPlaylist"><i class="fas fa-plus text-white"></i></button>
                                                <p class="font-familyAtlasGroteskWeb-Bold text-colorblue200 mt-3 mb-0">Add Playlist</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>



                                @foreach($playLists as $playList)
                                    <div class="col-lg-4 col-md-6 mb-3 d-flex">
                                        <div class="card col-12 p-0 border-radius0all">
                                            <a  href="javascript:void(0);" class="playList-event" data-playlistId="{{$playList->id}}">
                                                <div class="thumbnailImg_WHCard overflow-hidden" style="background: url({{ url('public/'.$playList->image) }}) no-repeat; background-size: cover;">
                                                </div>

                                            </a>

                                            <div class="card-body">

                                                <a href="javascript:void(0);" class="playList-event" data-playlistId="{{$playList->id}}">
                                                    <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0 font-size1em">{{ $playList->name}}</h6>
                                                </a>

                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- all lists tab -->
                            <div class="row playlist-tabs">



                            </div>

                        </div>


                        <div class="tab-pane fade active show" id="pg-comments" role="tabpanel" aria-labelledby="contributor">
                            <div class="row" id="list-comments">
                            </div>
                        </div>



                        </div>
                    </div>
                </div>

                <nav class="col-lg-5 col-md-6 d-flex">
                    @include('include.discussionBoard')
                </nav>
            </div>
        </div>
    </section>

    @include('include.footer')


     <!-- Add playlist modal -->
    <div class="modal fade p-0" id="moadalAddPlaylist" tabindex="-1" role="dialog" aria-labelledby="moadalAddPlaylist" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered max-width790px p-md-0 p-3" role="document">
            <div class="modal-content border-radius0px">
                <form id="add_playlist_form" action="{{ route('playlist.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header p-4">
                        <h6 class="modal-title font-familyAtlasGroteskWeb-Bold text-colorblue100 text-uppercase" id="moadalAddPlaylist">Add New Playlist</h6>
                        <button type="button" class="close outlineNone text-colorMahroon700" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="play_title" class="mb-0 text-colorblue100">Name</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Give your playlist  a title you  can easily identify.</p>
                                    <input type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="play_title" name="name" placeholder="Playlist Name">
                                    <small id="content_title_err" style="color: red"></small>
                                </div>

                            </div>

                            <div class="col-md-6">





                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customFileMain">
                                    <label for="addimg" class="mb-0 text-colorblue100">Add Thumbnail Image</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Add your thumbnail for your Content.</p>
                                    <div class="custom-file">
                                        <input id="playlist_image" name="image" type="file" class="custom-file-input col-md-12 p-0 getVal" onchange="getVal()">
                                        <div id="saveFileVal1" class="font-familyAtlasGroteskWeb-Light text-colorblue200 font-size11px mt-1"></div>
                                        <label class="custom-file-label font-familyFreightTextProLight-Regular text-darkBlue font-size14px col-md-12 d-flex align-items-center justify-content-between" for="uploadImg">Upload</label>
                                    </div>

                                    <small id="content_avatar_err" style="color: red"></small>
                                </div>


                            </div>
                        </div>

                    </div>
                    <div class="modal-footer box-shadow">
                        <p id="final_content_msg" style="text-align: center; width: 80%;"></p>
                        <button type="submit" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar">
                            <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">Add <i class="ml-3 fas fa-plus"></i><i class="ml-3 text-colorMahroon100"></i></span>
                            <div class="btn-bar"></div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


  <!-- Modal ADD NEW CONTENT -->
  <div class="modal fade p-0" id="moadalAddNewCourse1" tabindex="-1" role="dialog" aria-labelledby="moadalAddNewCourse1" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered max-width790px p-md-0 p-3" role="document">
            <div class="modal-content border-radius0px">
                <form id="add_content_form" action="{{ route('contentAdd') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header p-4">
                        <h6 class="modal-title font-familyAtlasGroteskWeb-Bold text-colorblue100 text-uppercase" id="moadalAddNewCont">Create New Course</h6>
                        <button type="button" class="close outlineNone text-colorMahroon700" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="content_title" class="mb-0 text-colorblue100">Title</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Give your course a title your students can easily identify.</p>
                                    <input type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="content_title" name="content_title" placeholder="Course Name">
                                    <small id="content_title_err3" style="color: red"></small>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                                    <label for="Author" class="mb-0 text-colorblue100">Author</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Name of author(s) of the course.</p>
                                    <input type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="Author" name="Author" placeholder="Enter Author Name">
                                    <small id="author3" style="color: red"></small>
                                </div>



                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="institution_or_source" class="mb-0 text-colorblue100">Institution/Source</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Name of institution or source of course.</p>
                                    <input autocomplete="off" type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="institution_or_source" name="institution_or_source" placeholder="Institution / Source">
                                    <small id="content_affiliation_err3" style="color: red"></small>
                                </div>


                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="content_discription" class="mb-0 text-colorblue100">Description</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">The Course description is what your students will see.</p>
                                    <p class="float-right font-size14px">
                                     <span id="count"></span><span> </span></p>
                                    <textarea class="form-control" name="content_discription" id="content_discription"></textarea>
                                     <!-- <textarea class="form-control" onkeyup="charcountupdate1(this.value)" name="content_discription" id="content_discription"></textarea> -->

                                     <small id="content_discription_err3" style="color: red"></small>                                    
                                </div>




                                {{--
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-secondary active">
                                      <input type="radio" name="privacy_content_01" id="option1" value="0" autocomplete="off" checked> Public
                                    </label>
                                    <label class="btn btn-secondary">
                                      <input type="radio" name="privacy_content_01" id="option2" value="1" autocomplete="off"> Private
                                    </label>
                                </div>
                                --}}
                            </div>
                            <div class="col-md-6">



                            <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customFileMain">
                                    <label for="addimg" class="mb-0 text-colorblue100">Add Thumbnail Image</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Add thumbnail image for your course.</p>
                                    <div class="custom-file">
                                        <input id="content_image" name="content_image" type="file" class="custom-file-input col-md-12 p-0 getVal" onchange="getVal()">
                                        <div id="saveFileVal" class="font-familyAtlasGroteskWeb-Light text-colorblue200 font-size11px mt-1"></div>
                                        <label class="custom-file-label font-familyFreightTextProLight-Regular text-darkBlue font-size14px col-md-12 d-flex align-items-center justify-content-between" for="uploadImg">Upload</label>
                                    </div>

                                    <small id="content_avatar_err" style="color: red"></small>
                                </div>


                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                                    <label for="choseLevel" class="mb-0 text-colorblue100">Choose Difficulty Level</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Please choose appropriate difficulty level.</p>
                                    <select id="difficulty_level" name="difficulty_level_c" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue">
                                        <option value="" selected disabled>Choose Difficulty Level</option>
                                        @if ($difficulty_levels)
                                            @foreach ($difficulty_levels as $difficulty_level)
                                                <option value="{{ $difficulty_level->id }}">{{ $difficulty_level->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small id="content_difficulty_level_err3" style="color: red"></small>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                                    <label for="selectcontent" class="mb-0 text-colorblue100">Select Category</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Choose any 7 fields to which your content is most closely related.</p>
                                    <select id="selectpickerCategories" name="selectpickerCategories" class="border font-familyFreightTextProLight-Regular text-darkBlue addPlaceholder" multiple title="Select Category">
                                        @if ($data['categories'])
                                            @foreach ($data['categories'] as $category)
                                                <option value="{{ $category->id }}">{!! $category->name !!}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <i class="fas fa-angle-down position-absolute marginDArrow"></i>
                                    <small id="content_categories_err" style="color: red"></small>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                                    <label for="addTag" class="mb-0 text-colorblue100">Add Tags <span class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size10px">(Upto 3)</span></label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Add sub-fields tags to filter-topic.</p>
                                    <select id="selectpickerTags" name="selectpickerTags" class="border font-familyFreightTextProLight-Regular text-darkBlue" multiple title="Tags" size='2'>
                                        @if ($tags)
                                            @foreach ($tags as $tag)
                                                <option>{{ $tag->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <i class="fas fa-angle-down position-absolute marginDArrow2"></i>
                                    <small id="content_tags_err" style="color: red" class="textError position-absolute"></small>

                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                                    <label for="Restriction" class="mb-0 text-colorblue100">Select Restriction</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Choose restriction of your content.</p>
                                    <select id="Restriction" name="privacy_content_01" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue">
                                        <option value="0" selected>Generally Accessible (Default)</option>
                                        <!-- <option value="0">Generally Accessible (Default)</option> -->
                                        <option value="1">Restrict access to teachers only</option>

                                    </select>
                                    <small id="restriction_err" style="color: red" class="textError position-absolute"> </small>
                                </div>
<!--
                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customFileMain">
                                    <label for="addimg" class="mb-0 text-colorblue100">Add Thumbnail Image</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Add your thumbnail for your Content.</p>
                                    <div class="custom-file">
                                        <input id="content_image" name="content_image" type="file" class="custom-file-input col-md-12 p-0 getVal" onchange="getVal()">
                                        <div id="saveFileVal" class="font-familyAtlasGroteskWeb-Light text-colorblue200 font-size11px mt-1"></div>
                                        <label class="custom-file-label font-familyFreightTextProLight-Regular text-darkBlue font-size14px col-md-12 d-flex align-items-center justify-content-between" for="uploadImg">Upload</label>
                                    </div>

                                    <small id="content_avatar_err" style="color: red"></small>
                                </div> -->

                                {{-- <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="duration" class="mb-0 text-colorblue100">Duration</label>
                                    <input autocomplete="off" id="duration" name="duration" type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" placeholder="e.g 00 mint">
                                    <small id="content_duration_err" style="color: red"></small>
                                </div> --}}
                            </div>
                        </div>

                           <p class="w-100 text-center text-colorblue200 font-familyAtlasGroteskWeb-Light ml-auto mr-auto max-width690px font-size14px"><strong>Note:</strong> To add content items to course, select desired content and click “Add to Course”</p>
                           <p class="w-100 text-center text-colorblue200 font-familyAtlasGroteskWeb-Light ml-auto mr-auto max-width690px font-size14px"><strong>Note:</strong> Courses created by users are for private use and accessible only through profile dashboard. If you wish to make your course a public course to featured on the general site, please submit to admin for approval when completed</p>

                    </div>
                    <div class="modal-footer box-shadow" style=" justify-content: flex-start;">
                        <!-- <p id="final_content_msg" style="text-align: center; width: 80%;"></p> -->
                        <div class="alert alert-warning fade show alert-dismissible text-dark pt-0 pb-0 pr-3 pl-0 border-radius2em overflow-hidden font-size13px" role="alert" style="background:#fff5eb;float: left;">
                        <div class="text-warning p-2 mr-2" style="background:#ffecd8;display: inline-block;"><i class="fas fa-lightbulb mr-2"></i>Tips</div>
                        You can use “TAB” key to scroll through form.</div>
                        <!-- <button type="submit" class="btn btn-customBtn6 text-colorMahroon700 font-familyAtlasGroteskWeb-Bold font-size12px p-0 border-radius0px btnBotmBar" data-dismiss="modal">
                            <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">Cancel </span>
                            <div class="btn-bar"></div>
                        </button> -->
                        <div class="text-right col-sm-6 p-0">
                        <button type="submit" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar">
                            <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">Add<i class="ml-3 fas fa-plus"></i> <i class="ml-3 text-colorMahroon100"></i></span>
                            <div class="btn-bar"></div>
                        </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Add Course modal -->
    <div class="modal fade p-0" id="moadalAddNewCourse" tabindex="-1" role="dialog" aria-labelledby="moadalAddNewCourse" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered max-width790px p-md-0 p-3" role="document">
            <div class="form-container modal-content border-radius0px">
                <form id="add_content_form_with_detail" action="{{ route('contentAddWithDetail') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header p-4">
                        <h6 class="modal-title font-familyAtlasGroteskWeb-Bold text-colorblue100 text-uppercase" id="moadalAddNewCont2">Add New Content</h6>
                        <button type="button" class="close outlineNone text-colorMahroon700" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-4">

                        <div class="lds-dual-ring" style="display:none"></div>

                        <div class="row">
                            <div class="col-md-7">

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="content_title2" class="mb-0 text-colorblue100">Title</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Give your content  a title your students can easily identify.</p>
                                    <input type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="content_title2" name="content_title2" placeholder="Content Name">
                                    <small id="content_title2_err" style="color: red"></small>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="author" class="mb-0 text-colorblue100">Author</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Name of author(s) of the content</p>
                                    <input autocomplete="off" type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="author" name="author" placeholder="Enter Author">
                                    <small id="author_err" style="color: red"></small>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="affiliation2" class="mb-0 text-colorblue100">Institution/Source</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Mention the name of the institution or affiliation</p>
                                    <input autocomplete="off" type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="affiliation2" name="affiliation2" placeholder="Enter Affiliation">

                                    <small id="content_affiliation2_err" style="color: red"></small>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="content_discription2" class="mb-0 text-colorblue100">Description</label>
                                    <div class="d-flex justify-content-between">
                                        <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">The Content description is what your students will see.</p>
                                        <p class="text-colorblue200 font-size12px mb-0"><span id="count1"></span><span> </span></p>
                                    </div>

                                    <textarea class="form-control" name="content_discription2" id="content_discription2"></textarea>
                                    <small id="content_discription2_err" style="color: red"></small>
                                </div>





                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                                    <label for="choseLevel" class="mb-0 text-colorblue100">Choose Difficulty Level</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Please choose appropriate difficulty level.</p>
                                    <select id="difficulty_level2" name="difficulty_level2" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue">
                                        <option value="" selected disabled>Choose Difficulty Level</option>
                                        @if ($difficulty_levels)
                                            @foreach ($difficulty_levels as $difficulty_level)
                                                <option value="{{ $difficulty_level->id }}">{{ $difficulty_level->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small id="content_difficulty_level2_err" style="color: red"></small>
                                </div>









                            </div>
                            <div class="col-md-5">
                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customFileMain">
                                    <label for="addimg" class="mb-0 text-colorblue100">Add thumbnail</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Add your thumbnail for your Content.</p>
                                    <div class="custom-file">
                                        <input id="content_image2" name="content_image2" type="file" class="custom-file-input col-md-12 p-0 getVal2" onchange="getVal2()">
                                        <div id="saveFileVal2" class="font-familyAtlasGroteskWeb-Light text-colorblue200 font-size11px mt-1"></div>
                                        <label class="custom-file-label font-familyFreightTextProLight-Regular text-darkBlue font-size14px col-md-12 d-flex align-items-center justify-content-between" for="content_image2">Upload</label>
                                    </div>

                                    <small id="content_avatar2_err" style="color: red"></small>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                                    <label for="selectcontent" class="mb-0 text-colorblue100">Select Category</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Choose any seven fields to which your content is most closely related.</p>
                                    <select id="selectpickerCategories2" name="selectpickerCategories2" class="border font-familyFreightTextProLight-Regular text-darkBlue addPlaceholder" multiple title="Categories">
                                        @if ($data['categories'])
                                            @foreach ($data['categories'] as $category)
                                                <option value="{{ $category->id }}">{!! $category->name !!}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    {{--<i class="fas fa-angle-down position-absolute marginDArrow"></i>--}}
                                    <i class="fas fa-angle-down position-absolute marginDArrow"></i>
                                    <small id="content_categories2_err" style="color: red"></small>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                                    <label for="addTag" class="mb-0 text-colorblue100">Add Tags <span class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size10px">(Only 3)</span></label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Add tags to promote your content.</p>
                                    <select id="selectpickerTags2" name="selectpickerTags2" class="border font-familyFreightTextProLight-Regular text-darkBlue" multiple title="Tags" size='2'>
                                        {{-- @if ($tags)
                                            @foreach ($tags as $tag)
                                                <option>{{ $tag->name }}</option>
                                            @endforeach
                                        @endif--}}
                                    </select>
                                    <i class="fas fa-angle-down position-absolute marginDArrow2-1"></i>
                                    <small id="content_tags2_err" style="color: red"></small>

                                </div>



                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 font-size14px">
                                    <label for="gender" class="font-familyAtlasGrotesk-Medium d-block">Select Restrictions</label>
                                    <div class="custom-control custom-radio font-familyFreightTextProLight-Regular text-colorblue200 line-height1pot8">
                                        <input value="0" type="radio" id="option11" name="privacy_content" class="custom-control-input align-self-center" checked>
                                        <label class="custom-control-label" for="option11">Generally accessible</label>
                                    </div>
                                    <div class="custom-control custom-radio font-familyFreightTextProLight-Regular text-colorblue200 line-height1pot8">
                                        <input value="1" type="radio" id="option22" name="privacy_content" class="custom-control-input">
                                        <label class="custom-control-label" for="option22">Restrict access to teachers only</label>
                                    </div>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                                    <label for="type" class="mb-0 text-colorblue100">Select Type</label>
                                    <select name="type" id="type" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue">
                                        <option value="" selected disabled>Select Type</option>
                                        <option value="Video">Video</option>
                                        <option value="Pdf">Pdf</option>
                                        <option value="Article">Article</option>
                                        <option value="Image">Image</option>
                                        <option value="Audio">Audio</option>
                                    </select>
                                    <small id="type_err" style="color: red"></small>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="embeded_url" class="text-colorblue100">Embed URL</label>
                                    <input autocomplete="off" type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="embeded_url" name="embeded_url" placeholder="https://example.com">
                                    <small id="embeded_url_err" style="color: red"></small>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customFileMain">
                                    <label for="addimg" class="text-colorblue100">Add Asset</label>
                                    <div class="custom-file">
                                        <input id="asset" name="asset" type="file" class="custom-file-input col-md-4 p-0 getVal3" onchange="getVal3()">
                                        <div id="saveFileVal3" class="font-familyAtlasGroteskWeb-Light text-colorblue200 font-size11px mt-1"></div>
                                        <label class="custom-file-label font-familyFreightTextProLight-Regular text-darkBlue font-size14px col-md-12 d-flex align-items-center justify-content-between" for="uploadImg3">Upload</label>
                                    </div>
                                    <small id="asset_err" style="color: red"></small>
                                </div>


                            </div>
                            <div class="col-md-12">
                                <div id="description_div" class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="description" class="text-colorblue100">Article Text</label>
                                    <p class="float-right text-colorblue200 font-size12px mt-1"><span id="count2">0</span><span> </span></p>
                                    <textarea class="form-control classy-editor" name="description" id="description" onkeyup="charcountupdate3(this.value)" rows="6" cols="260"></textarea>
                                    <small id="description_div_err" style="color: red"></small>
                                </div>
                            </div>
                        </div>
                        <div class="reminder-text">By submitting materials, you confirm you are not violating others’ copyright rights, the materials may be used by others under the Terms of Service, and you agree to the <a href="{{ route('termsConditions')}}" target="_blank">Terms of Service </a>.</div>

                    </div>
                    <div class="modal-footer box-shadow" style=" justify-content: flex-start;">
                        <!-- <p id="final_content2_msg" style="text-align: center; width: 80%;"></p> -->

                        <div class="alert alert-warning fade show alert-dismissible text-dark pt-0 pb-0 pr-3 pl-0 border-radius2em overflow-hidden font-size13px" role="alert" style="background:#fff5eb;float: left;">
                        <div class="text-warning p-2 mr-2" style="background:#ffecd8;display: inline-block;"><i class="fas fa-lightbulb mr-2"></i>Tips</div>
                        You can use “TAB” key to scroll through form.</div>
                        <div class="text-right col-sm-6 p-0">
                        <button type="submit" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar">
                            <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">Add <i class="ml-3 fas fa-plus"></i><i class="ml-3 text-colorMahroon100"></i></span>
                            <div class="btn-bar"></div>
                        </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <!-- Add Course modal -->
    <!-- <div class="modal fade p-0" id="moadalAddNewCourse" tabindex="-1" role="dialog" aria-labelledby="moadalAddNewCourse" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered max-width790px p-md-0 p-3" role="document">
            <div class="form-container modal-content border-radius0px">
                <form id="add_content_form_with_detail" action="{{ route('contentAddWithDetail') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header p-4">
                        <h6 class="modal-title font-familyAtlasGroteskWeb-Bold text-colorblue100 text-uppercase" id="moadalAddNewCont2">Add New Content</h6>
                        <button type="button" class="close outlineNone text-colorMahroon700" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-4">

                        <div class="lds-dual-ring" style="display:none"></div>

                        <div class="row">
                            <div class="col-md-7">

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="content_title2" class="mb-0 text-colorblue100">Title</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Give your content  a title your students can easily identify.</p>
                                    <input type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="content_title2" name="content_title2" placeholder="Content Name">
                                    <small id="content_title2_err" style="color: red"></small>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="author" class="mb-0 text-colorblue100">Author</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Name of author(s) of the content</p>
                                    <input autocomplete="off" type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="author" name="author" placeholder="Enter Author">
                                    <small id="author_err" style="color: red"></small>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="affiliation2" class="mb-0 text-colorblue100">Institution/Source</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Mention the name of the institution or affiliation</p>
                                    <input autocomplete="off" type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="affiliation2" name="affiliation2" placeholder="Enter Affiliation">

                                    <small id="content_affiliation2_err" style="color: red"></small>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="content_discription2" class="mb-0 text-colorblue100">Description</label>
                                    <div class="d-flex justify-content-between">
                                        <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">The Content description is what your students will see.</p>
                                         <p class="text-colorblue200 font-size12px mb-0"><span id="count1"></span><span> </span></p>
                                    </div>

                                 <textarea class="form-control" name="content_discription2" id="content_discription2" placeholder="Content Description" rows="6" cols="260"></textarea>
                                    <small id="content_discription2_err" style="color: red"></small>
                                </div>





                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                                    <label for="choseLevel" class="mb-0 text-colorblue100">Choose Difficulty Level</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Please choose appropriate difficulty level.</p>
                                    <select id="difficulty_level2" name="difficulty_level2" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue">
                                        <option value="" selected disabled>Choose Difficulty Level</option>
                                        @if ($difficulty_levels)
                                            @foreach ($difficulty_levels as $difficulty_level)
                                                <option value="{{ $difficulty_level->id }}">{{ $difficulty_level->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small id="content_difficulty_level2_err" style="color: red"></small>
                                </div>









                            </div>
                            <div class="col-md-5">
                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customFileMain">
                                    <label for="addimg" class="mb-0 text-colorblue100">Add thumbnail</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Add your thumbnail for your Content.</p>
                                    <div class="custom-file">
                                        <input id="content_image2" name="content_image2" type="file" class="custom-file-input col-md-12 p-0 getVal2" onchange="getVal2()">
                                        <div id="saveFileVal2" class="font-familyAtlasGroteskWeb-Light text-colorblue200 font-size11px mt-1"></div>
                                        <label class="custom-file-label font-familyFreightTextProLight-Regular text-darkBlue font-size14px col-md-12 d-flex align-items-center justify-content-between" for="content_image2">Upload</label>
                                    </div>

                                    <small id="content_avatar2_err" style="color: red"></small>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                                    <label for="selectcontent" class="mb-0 text-colorblue100">Select Category</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Choose any seven fields to which your content is most closely related.</p>
                                    <select id="selectpickerCategories2" name="selectpickerCategories2" class="border font-familyFreightTextProLight-Regular text-darkBlue addPlaceholder" multiple title="Categories">
                                        @if ($data['categories'])
                                            @foreach ($data['categories'] as $category)
                                                <option value="{{ $category->id }}">{!! $category->name !!}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    {{--<i class="fas fa-angle-down position-absolute marginDArrow"></i>--}}
                                    <i class="fas fa-angle-down position-absolute marginDArrow"></i>
                                    <small id="content_categories2_err" style="color: red"></small>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                                    <label for="addTag" class="mb-0 text-colorblue100">Add Tags <span class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size10px">(Only 3)</span></label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Add tags to promote your content.</p>
                                    <select id="selectpickerTags2" name="selectpickerTags2" class="border font-familyFreightTextProLight-Regular text-darkBlue" multiple title="Tags" size='2'>
                                        {{-- @if ($tags)
                                            @foreach ($tags as $tag)
                                                <option>{{ $tag->name }}</option>
                                            @endforeach
                                        @endif--}}
                                    </select>
                                    <i class="fas fa-angle-down position-absolute marginDArrow2-1"></i>
                                    <small id="content_tags2_err" style="color: red"></small>

                                </div>



                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 font-size14px">
                                    <label for="gender" class="font-familyAtlasGrotesk-Medium d-block">Select Restrictions</label>
                                    <div class="custom-control custom-radio font-familyFreightTextProLight-Regular text-colorblue200 line-height1pot8">
                                        <input value="0" type="radio" id="option11" name="privacy_content" class="custom-control-input align-self-center" checked>
                                        <label class="custom-control-label" for="option11">Generally accessible</label>
                                    </div>
                                    <div class="custom-control custom-radio font-familyFreightTextProLight-Regular text-colorblue200 line-height1pot8">
                                        <input value="1" type="radio" id="option22" name="privacy_content" class="custom-control-input">
                                        <label class="custom-control-label" for="option22">Restrict access to teachers only</label>
                                    </div>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                                    <label for="type" class="mb-0 text-colorblue100">Select Type</label>
                                    <select name="type" id="type" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue">
                                        <option value="" selected disabled>Select Type</option>
                                        <option value="Video">Video</option>
                                        <option value="Pdf">Pdf</option>
                                        <option value="Article">Article</option>
                                        <option value="Image">Image</option>
                                        <option value="Audio">Audio</option>
                                    </select>
                                    <small id="type_err" style="color: red"></small>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="embeded_url" class="text-colorblue100">Embed URL</label>
                                    <input autocomplete="off" type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="embeded_url" name="embeded_url" placeholder="https://example.com">
                                    <small id="embeded_url_err" style="color: red"></small>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customFileMain">
                                    <label for="addimg" class="text-colorblue100">Add Asset</label>
                                    <div class="custom-file">
                                        <input id="asset" name="asset" type="file" class="custom-file-input col-md-4 p-0 getVal3" onchange="getVal3()">
                                        <div id="saveFileVal3" class="font-familyAtlasGroteskWeb-Light text-colorblue200 font-size11px mt-1"></div>
                                        <label class="custom-file-label font-familyFreightTextProLight-Regular text-darkBlue font-size14px col-md-12 d-flex align-items-center justify-content-between" for="uploadImg3">Upload</label>
                                    </div>
                                    <small id="asset_err" style="color: red"></small>
                                </div>


                            </div>
                            <div class="col-md-12">
                                <div id="description_div" class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="description" class="text-colorblue100">Article Text</label>
                                    <p class="float-right text-colorblue200 font-size12px mt-1"><span id="count2">0</span><span> </span></p>
                                    <textarea class="form-control classy-editor" name="description" id="description" onkeyup="charcountupdate3(this.value)" rows="6" cols="260"></textarea>
                                    <small id="description_div_err" style="color: red"></small>
                                </div>
                            </div>
                        </div>
                        <div class="reminder-text">By submitting materials, you confirm you are not violating others’ copyright rights, the materials may be used by others under the Terms of Service, and you agree to the <a href="{{ route('termsConditions')}}" target="_blank">Terms of Service </a>.</div>

                    </div>
                    <div class="modal-footer box-shadow">
                        <p id="final_content2_msg" style="text-align: center; width: 80%;"></p>
                        <button type="submit" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar">
                            <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">Add <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                            <div class="btn-bar"></div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div> -->

     <!-- Modal View COMMENT -->
     <div class="modal fade p-0" id="modalviewcomment" tabindex="-1" role="dialog" aria-labelledby="modalviewcomment" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered max-width690px p-md-0 p-3" role="document">
            <div class="modal-content border-radius0px">
                <div class="modal-header p-4">
                    <h6 class="modal-title font-familyAtlasGroteskWeb-Bold text-colorblue100" id="modalviewcommentTitle">VIEW COMMENT</h6>
                    <button type="button" class="close outlineNone text-colorMahroon700" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="media font-size14px">
                        <img id="view_img_comment" class="mr-3" src="{{ asset('images/icons/img1-1.png') }}" alt="placeholder image" width="150">
                        <div class="media-body font-familyAtlasGrotesk-Medium align-self-center">
                            <h6 class="mt-0 text-colorblue100 mb-0" id="view_title_content">Microeconomics: The Truth About Prices</h6>
                            <div class="col-md-12 font-familyAtlasGroteskWeb-Regular font-size13px">
                                <div class="row justify-content-between">
                                    <p class="text-colorblue200" id="view_name_author">Ellen Chris</p>
                                </div>
                            </div>
                            <p class="text-colorblue100 font-size10px mb-0">
                                <span class="mr-2" id="view_diff_level">Advanced Undergraduate</span>
                                {{-- <span class="mr-2" id="view_content_cate">Economic History</span></p> --}}
                        </div>
                    </div>

                        <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-5">
                            <label for="FormControlTextarea1" class="mb-0 mt-5">Comments</label>
                            <div class="col-md-12 font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">
                                <p class="float-left" id="view_comments_of_admin"></p>
                            </div>
                        </div>

                </div>
                <div class="modal-footer box-shadow">
                    <button type="button" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">Ok</span>
                    </button>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('style')
    <link href="{{ asset('css/textarea/jquery.classyedit.css') }}" rel="stylesheet">
    <style>
        .reminder-text {

          font-size: 13px;

          width: 100%;
          max-width: 575px;
          left: 179px;
          color: #606C80;
        }
      </style>
@endsection

@section('script')

    <script src="{{ asset('js/textarea/jquery.classyedit.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".classy-editor").ClassyEdit();
            $(".editor").attr('data-placeholder', 'Description');
        });

 tinymce.init({
      selector: '#content_discription',
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

 tinymce.init({
      selector: '#content_discription2',
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



    $("#add_playlist_form").submit(function (e) {
          e.preventDefault();
          var formData = new FormData(this);

          $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {

                $('.remove').remove();
                $(".modal-header").after(`<p class='remove alert alert-success'>`+data.message+`</p>`);
                 $('#add_playlist_form')[0].reset();
            },

            error: function (err) {

                var data = JSON.parse(err.responseText);

                $('.remove').remove();
                for (const [key, value] of Object.entries(data.message)) {
                      console.log(`${key}: ${value}`);
                      $(`<small class='remove' style="color: red">`+value+`</small>`).insertAfter("input[name='"+key+"']");
                }
            },
          });
        });




     $(document).on('click','.playList-event',function(e){
      e.preventDefault();
      // var formData = new FormData(this);
      var playListid = $(this).attr('data-playlistId');
      $('.add-playlist').hide();
      $('.playlist-tabs').show();


      $.ajax({
        type: "GET",
        url: '{{url("playlist")}}/'+playListid,
        success: function (data) {

          var playListData = data.data;
          var playlistHtml = `<div class="col-md-12" style="margin-bottom:12px">
                                <button type="button" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px p-0 border-radius0px back-playlist">
                                    <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">BACK <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                                    <div class="btn-bar"></div>
                                </button>
                            </div>`;

            for (var i = 0; i < playListData.length; i++) {
                var image  = "{{  asset('/public/uploads/content/profile_images') . '/'}}"+playListData[i].content.image_url;

                playlistHtml += `

                    <div class="col-lg-4 col-md-6 mb-3 d-flex bookmarkCheck float-left">
                            <div class="card col-12 p-0 border-radius0all">
                                <a href="/content/view/`+playListData[i].content.id+`">
                                    <div class="thumbnailImg_WHCard overflow-hidden" style="background: url('`+image+`') no-repeat; background-size: cover;">
                                    </div>
                                </a>
                                <div class="card-header bg-transparent border-0 pb-0 pt-2 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200">
                                    <small class="float-right"> views `+playListData[i].content.views_count+`</small>

                                    </div>
                                <div class="card-body">

                                    <a href="/content/view/`+playListData[i].content.id+`">
                                        <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0 font-size1em">`+playListData[i].content.title+`</h6>
                                    </a>
                                    <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">`+playListData[i].content.authors+`</small></p>
                                    <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">`+playListData[i].content.affiliation+`</small></p>
                                    <p class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size13px mb-2">`+playListData[i].content.level_name+`</p>
                                </div>
                                <div class="card-footer bg-transparent border-0 d-flex justify-content-between">

                                </div>
                            </div>
                    </div>
                `;

            }

            $(".playlist-tabs").html(playlistHtml);

        },

        error: function (err) {
          $("#display_result").html(`<p style="color: red">${err}</p>`);
        },
      });

    });

    $(document).on('click','.back-playlist',function(e){
      e.preventDefault();

      $('.add-playlist').show();
      $('.playlist-tabs').hide();

    });


//     $(".sortdata").on("click", function (e) {

// // if (confirm('Are you sure you want to add this?')) {

//    var sort= $(this).data('sort');
// //    var content_id  = '{{ collect(request()->segments())->last() }}';



//     // return false;
//     $.ajax({
//         type: "POST",
//         url: '{{ route("home") }}',

//         data: {sort:sort},
//         // cache: false,
//         // contentType: false,
//         // processData: false,
//         success: function (data) {
//                alert('Course already added to the playlist.');
//             },
//             error: function (err) {
//         },
//       });


// });






    </script>
@endsection
