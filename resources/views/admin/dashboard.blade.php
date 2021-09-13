@extends('layouts.app')


@section('title') INET ED Platform :: Dashboard @endsection

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

        .playlist-tabs{
            display: none;
        }

    </style>

    <section class="pt-5 pb-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-black font-familyAtlasGroteskWeb-Bold mb-4">Dashboard</h3>
                </div>
                <div class="col-md-12 list-groupCusMain mb-2">
                    <div class="list-group  font-familyAtlasGroteskWeb-Regular text-colorblue100 font-size14px border-bottom" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active col-lg-2 col-md-3" id="list-home-list" data-toggle="list" href="#pg-received" role="tab" aria-controls="Received">Received</a>
                        <a class="list-group-item list-group-item-action col-lg-2 col-md-3" id="list-profile-list" data-toggle="list" href="#pg-unreview" role="tab" aria-controls="Under Review">Under Review</a>
                        <a class="list-group-item list-group-item-action col-lg-2 col-md-3" id="list-history-list" data-toggle="list" href="#pg-history" role="tab" aria-controls="History">History</a>
                        <a class="list-group-item list-group-item-action col-lg-2 col-md-3" id="list-content-list" data-toggle="list" href="#add-content" role="tab" aria-controls="Contributor">Add Content</a>
                        <a class="list-group-item list-group-item-action col-lg-2 col-md-3" id="list-contributors-list" data-toggle="list" href="#pg-contributor" role="tab" aria-controls="Contributor">Teachers</a>
                        <a class="list-group-item list-group-item-action col-lg-2 col-md-3" id="list-comments-list" data-toggle="list" href="#pg-comments" role="tab" aria-controls="Contributor">Comments</a>

                        {{-- <a class="list-group-item list-group-item-action col-lg-2 col-md-3" id="list-playlist-list" data-toggle="list" href="#pg-playlist" role="tab" aria-controls="Contributor">Playlist</a> --}}

                    </div>
                </div>
                <div class="col-md-12 mt-4">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active horizontalScroll" id="pg-received" role="tabpanel" aria-labelledby="received">

                            <div class="col-md-12 font-familyAtlasGroteskWeb-Medium font-size13px customDropDownInnerPg  pt-0 pb-4">
                                <div class="row">
                                    <div class="col text-right align-self-center">
                                        <p class="opacity0point5 mb-3">Sort By</p>
                                    </div>

                                    <div class="col-3 mb-3">
                                        <select id="recive_sort" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue" onchange="recived_content_sort()">
                                            <option value="alphabetic">Alphabetically</option>
                                            <option value="newest">Newest</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <table id="dashboardDataTable1" class="table table-striped table-bordered font-familyAtlasGroteskWeb-Medium dashboardDataTable" style="width:100%">
                                <thead class="text-colorblue200 font-size13px">
                                <tr>
                                    <th></th>
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Difficulty Level</th>
                                    {{-- <th>Duration</th> --}}
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="list-of-recived-content">
                                    @foreach($recivedcontent as $rec)
                                    <tr>
                                        <td width="150">
                                          @if($rec->scope_type=='course')
                                        <a href="/inetEDPlatform/coursecontent/view/{{ $rec->id}}">
                                        @else
                                           <a href="/inetEDPlatform/content/view/{{ $rec->id}}">
                                           @endif
                                                <div class="thumbnailImg_WH2 overflow-hidden" style="background: url({{ url('public/uploads/content/profile_images')  . '/'. $rec->image_url }}) no-repeat; background-size: 100% 100%;">

                                                </div>
                                            {{--<img src="{{  asset('/public/uploads/content/profile_images') . '/'. $rec->image_url }}" alt="" width="150">--}}
                                            </a>
                                        </td>
                                        <td width="200" valign="middle">
                                        @if($rec->scope_type=='course')
                                        <a href="/inetEDPlatform/coursecontent/view/{{ $rec->id}}">
                                        @else
                                           <a href="/inetEDPlatform/content/view/{{ $rec->id}}">
                                           @endif
                                            <h6 class="mt-0 font-size1em">{{ $rec->title}}</h6>
                                           </a>
                                            <p class="text-colorblue200 mb-0">{{ $rec->authors}} <br> </p>
                                            <p class="text-colorblue200 mb-0">{{ $rec->affiliation}}</p>
                                        </td>
                                        <td width="150">{{ date('d M, Y', strtotime($rec->created_at)) }}</td>
                                        <td width="200">{{ $rec->difficulty_level}}</td>
                                        {{-- <td width="200">{{ $rec->duration}}</td> --}}
                                        <td><span class="badge badge-customBtn4 font-familyAtlasGroteskWeb-Medium font-weight-normal font-size13px p-3 text-brown">Awaiting Approval</span></td>
                                        <td align="center">
                                            <ul class="navbar-nav align-self-center font-familyFreightTextProLight-Regular">
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle p-0 text-lightGaray" href="#" id="listViewMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h font-size2em"></i></a>
                                                    <div class="dropdown-menu margin-top2em widthMin15rem border-radius0px right0 aPading" aria-labelledby="listViewMenu">
                                                        <div class="col pl-0 pr-0">
                                                            <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#moadalAddComment" onclick="showData({{ $rec->id}})"><i class="far fa-comment-alt mr-2"></i> <span>Add Comment</span></a>
                                                            <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#moadalApproved" onclick="showApproved({{ $rec->id}})"><i class="far fa-file-alt mr-2"></i> <span>Approve Course</span></a>
                                                            <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#moadalChooseAdmin"  onclick="showData2({{ $rec->id}})"><i class="fas fa-id-card-alt mr-2"></i> <span>Tag Other Admin</span></a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade horizontalScroll" id="pg-unreview" role="tabpanel" aria-labelledby="unreview">
                            <table id="dashboardDataTable2" class="table table-striped table-bordered font-familyAtlasGroteskWeb-Medium dashboardDataTable" style="width:100%">
                                <thead class="text-colorblue200 font-size13px">
                                <tr>
                                    <th></th>
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Difficulty Level</th>
                                    {{-- <th>Duration</th> --}}
                                    <th>Tagged</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="list-of-under-review">
                                    <tr>
                                        <td width="150">
                                            <div class="thumbnailImg_WH2 overflow-hidden" style="background: url('images/icons/img1-1.png') no-repeat; background-size: 100% 100%;">

                                            </div>
                                        </td>
                                        <td width="200" valign="middle">
                                            <h6 class="mt-0 font-size1em">Microeconomics: The Truth About Prices</h6>
                                            <p class="text-colorblue200">Ellen Chris</p>
                                        </td>
                                        <td width="150">15 January, 2020</td>
                                        <td width="200">Advanced Undergraduate</td>
                                        <td>32m</td>
                                        <td><span class="badge badge-customBtn4 font-familyAtlasGroteskWeb-Medium font-weight-normal font-size13px p-3 text-brown">Awaiting Approval</span></td>
                                        <td align="center">
                                            <ul class="navbar-nav align-self-center font-familyFreightTextProLight-Regular">
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle p-0 text-lightGaray" href="#" id="listViewMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h font-size2em"></i></a>
                                                    <div class="dropdown-menu margin-top2em widthMin15rem border-radius0px right0 aPading" aria-labelledby="listViewMenu">
                                                        <div class="col pl-0 pr-0">
                                                            <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#moadalAddComment"><i class="far fa-comment-alt mr-2"></i> <span>Add Comment</span></a>
                                                            <a class="dropdown-item font-size14px" href="#"><i class="far fa-file-alt mr-2"></i> <span>Approve Course</span></a>
                                                            <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#moadalChooseAdmin"><i class="fas fa-id-card-alt mr-2"></i> <span>Tag Other Admin</span></a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade horizontalScroll" id="pg-history" role="tabpanel" aria-labelledby="history">
                            <table id="dashboardDataTable3" class="table table-striped table-bordered font-familyAtlasGroteskWeb-Medium dashboardDataTable" style="width:100%">
                                <thead class="text-colorblue200 font-size13px">
                                <tr>
                                    <th></th>
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Difficulty Level</th>
                                    {{-- <th>Duration</th> --}}
                                    <th>Status</th>
                                    {{-- <th></th> --}}
                                </tr>
                                </thead>
                                <tbody id="list-of-history-content">
                                    <tr>
                                        <td width="150">
                                            <div class="thumbnailImg_WH2 overflow-hidden" style="background: url('images/icons/img1-2.png') no-repeat; background-size: 100% 100%;">

                                            </div>
                                        </td>
                                        <td width="200" valign="middle">
                                            <h6 class="mt-0 font-size1em">Microeconomics: The Truth About Prices</h6>
                                            <p class="text-colorblue200">Ellen Chris</p>
                                        </td>
                                        <td width="150">15 January, 2020</td>
                                        <td width="200">Advanced Undergraduate</td>
                                       <td><span class="badge badge-customBtn5 font-familyAtlasGroteskWeb-Medium font-weight-normal font-size13px p-3 text-ferozy">Approved</span></td>
                                        {{-- <td align="center">
                                            <ul class="navbar-nav align-self-center font-familyFreightTextProLight-Regular">
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle p-0 text-lightGaray" href="#" id="listViewMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h font-size2em"></i></a>
                                                    <div class="dropdown-menu margin-top2em widthMin15rem border-radius0px right0 aPading" aria-labelledby="listViewMenu">
                                                        <div class="col pl-0 pr-0">
                                                            <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#moadalAddComment"><i class="far fa-comment-alt mr-2"></i> <span>Add Comment</span></a>
                                                            <a class="dropdown-item font-size14px" href="#"><i class="far fa-file-alt mr-2"></i> <span>Approve Course</span></a>
                                                            <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#moadalChooseAdmin"><i class="fas fa-id-card-alt mr-2"></i> <span>Tag Other Admin</span></a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td> --}}
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade horizontalScroll" id="add-content" role="tabpanel" aria-labelledby="history">
                            <div class="row">
                                {{-- <div class="col-lg-4 col-md-6 mb-3 d-flex ">
                                    <div class="col-md-12 borderDotted text-center font-size12px">
                                        <div class="row h-100">
                                            <div class="align-self-center my-lg-auto mt-4 mb-4 w-100">
                                                <button class="btn btn-customBtn4 border-radius2em widHei2em" data-toggle="modal" data-target="#moadalAddNewCont"><i class="fas fa-plus text-white"></i></button>
                                                <p class="font-familyAtlasGroteskWeb-Bold text-colorblue200 mt-3 mb-0">ADD NEW COURSE</p>
                                            </div>
                                        </div>

                                    </div>
                                </div> --}}

                                <div class="col-lg-4 col-md-6 mb-3 d-flex ">
                                    <div class="col-md-12 borderDotted text-center font-size12px">
                                        <div class="row h-100">
                                            <div class="align-self-center my-lg-auto mt-4 mb-4 w-100">
                                                <button class="btn btn-customBtn4 border-radius2em widHei2em" data-toggle="modal" data-target="#moadalAddNewCourse"><i class="fas fa-plus text-white"></i></button>
                                                <p class="font-familyAtlasGroteskWeb-Bold text-colorblue200 mt-3 mb-0">ADD NEW CONTENT</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                @foreach($addedcontent as $add)
                                    <div class="col-lg-4 col-md-6 mb-3 d-flex bookmarkCheck">
                                        <div class="card col-12 p-0 border-radius0all">
                                            <a href="/inetEDPlatform/content/section/{{ $add->id}}">
                                                <div class="thumbnailImg_WHCard overflow-hidden" style="background: url({{ url('/public/uploads/content/profile_images') . '/'. $add->image_url }}) no-repeat; background-size: cover;">
                                                </div>
                                            {{--<img class="card-img-top" src="{{  asset('/public/uploads/content/profile_images') . '/'. $add->image_url }}" alt="image" height="250">--}}
                                            </a>
                                            <div class="card-header bg-transparent border-0 pb-0 pt-2 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200">
                                                {{-- <small class="float-left">{{ $add->download}} downloads</small> --}}
                                                <small class="float-right">{{ $add->views}} views</small>
                                                </div>
                                            <div class="card-body">

                                                <a href="/inetEDPlatform/content/section/{{ $add->id}}">
                                                    <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0 font-size1em">{{ $add->title}}</h6>
                                                </a>
                                                <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $add->authors}}</small></p>
                                                <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $add->affiliation}}</small></p>
                                                <p class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size13px mb-2">{{ $add->difficulty_level}}</p>
                                            </div>
                                            <div class="card-footer bg-transparent border-0 d-flex justify-content-between">
                                                {{--  <small class="font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size10px align-self-center">30 mint</small>
                                               <div class="m-0 text-colorblue200 d-flex bookmark">
                                                    <i class="fas fa-download"></i>
                                                    <div class="custom-control custom-checkbox mr-sm-2">
                                                        <input checked="" onclick="bookmark(this)" type="checkbox" value="[1,8]" class="custom-control-input" id="bookmark-1">
                                                        <label class="custom-control-label" for="bookmark-1"></label>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>

                        <!-- playlist tab -->
                        <div class="tab-pane fade horizontalScroll" id="pg-playlist" role="tabpanel" aria-labelledby="history">
                            <div class="row add-playlist">
                                <div class="col-lg-4 col-md-6 mb-3 d-flex ">
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
                           <!--                      <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $add->authors}}</small></p>
                                                <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">{{ $add->affiliation}}</small></p>
                                                <p class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size13px mb-2">{{ $add->difficulty_level}}</p> -->
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- all lists tab -->
                            <div class="row playlist-tabs">



                            </div>

                        </div>

                        {{-- <div class="tab-pane fade horizontalScroll" id="pg-contributor" role="tabpanel" aria-labelledby="contributor">
                            <div class="row mb-3 d-flex" id="list-contributors"> --}}
                        <div class="tab-pane fade active show" id="pg-contributor" role="tabpanel" aria-labelledby="contributor">
                            <div class="row" id="list-contributors">
                           </div>
                        </div>

                        <div class="tab-pane fade active show" id="pg-comments" role="tabpanel" aria-labelledby="contributor">
                            <div class="row" id="list-comments">
                            </div>
                        </div>




                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('include.footer')

   <!-- Approve content -->

   {{-- <div class="modal fade p-0" id="moadalApproved" tabindex="-1" role="dialog" aria-labelledby="moadalApproved" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered max-width690px p-md-0 p-3" role="document">
            <div class="modal-content border-radius0px">

        <form id="ApprovedContent" name="_method">
                    @csrf
                    {{ method_field('PUT')}}
                <input type="hidden" id="contentid2" name="contentid2">
                <div class="modal-body p-4">
                    <div class="media font-size14px">

                        <div class="media-body font-familyAtlasGrotesk-Medium align-self-center">
                            <h6 class="mt-0 text-colorblue100 mb-0 text-center" > Are you sure to approved this course?</h6>
                        </div>
                    </div>
                </div>
                <div class="modal-footer box-shadow text">
                    <button type="submit" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar">
                        <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">YES <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                        <div class="btn-bar"></div>
                    </button>

                    <button  data-dismiss="modal" aria-label="Close" type="button" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar">
                        <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">NO <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                        <div class="btn-bar"></div>
                    </button>
                </div>
            </div>
        </form>
        </div>
</div> --}}

<div class="modal fade" id="moadalApproved" tabindex="-1" role="dialog" aria-labelledby="moadalApprovedTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form id="ApprovedContent" name="ApprovedContent">
            @csrf
            {{ method_field('PUT')}}
        <input type="hidden" id="contentid2" name="contentid2">
        <div class="modal-content border-radius0px">
            <div class="modal-body text-center p-5">
                <p class="mb-0 font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size14px">Are you sure you want to approve this content?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar" data-dismiss="modal">
                    <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">No</span>
                    <div class="btn-bar"></div>
                </button>
                <button type="submit" onclick = " location.reload()" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar">
                    <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">Yes</span>
                    <div class="btn-bar"></div>
                </button>
            </div>
        </div>
        </form>
    </div>
</div>



<div class="modal fade" id="moadalApprovedcontributor" tabindex="-1" role="dialog" aria-labelledby="moadalApprovedTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form id="approvedContri" name="approvedContri">
            @csrf
            {{ method_field('PUT')}}
        <input type="hidden" id="contri_id" name="contri_id">
        <div class="modal-content border-radius0px">
            <div class="modal-body text-center p-5">
                <p class="mb-0 font-familyAtlasGroteskWeb-Medium text-colorblue200 font-size14px">Are you sure you want to approve this Teacher profile?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar" data-dismiss="modal">
                    <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">No</span>
                    <div class="btn-bar"></div>
                </button>
                <button type="submit" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar">
                    <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">Yes</span>
                    <div class="btn-bar"></div>
                </button>
            </div>
        </div>
        </form>
    </div>
</div>













    <!-- Modal ADD COMMENT -->
    <div class="modal fade p-0" id="moadalAddComment" tabindex="-1" role="dialog" aria-labelledby="moadalAddComment" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered max-width690px p-md-0 p-3" role="document">
            <div class="modal-content border-radius0px">
                <div class="modal-header p-4">
                    <h6 class="modal-title font-familyAtlasGroteskWeb-Bold text-colorblue100" id="moadalAddCommentTitle">ADD COMMENT</h6>
                    <button type="button" class="close outlineNone text-colorMahroon700" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        <form id="AddCommentForm" name="AddCommentForm">
                    @csrf
                <input type="hidden" id="contentid" name="contentid">
                <div class="modal-body p-4">
                    <div class="media font-size14px">
                        <img class="mr-3" src="{{ asset('images/icons/img1-1.png') }}" alt="placeholder image" width="150">
                        <div class="media-body font-familyAtlasGrotesk-Medium align-self-center">
                            <h6 class="mt-0 text-colorblue100 mb-0" id="title_content">Microeconomics: The Truth About Prices</h6>
                            <div class="col-md-12 font-familyAtlasGroteskWeb-Regular font-size13px">
                                <div class="row justify-content-between">
                                    <p class="text-colorblue200" id="name_author">Ellen Chris</p>
                                </div>
                            </div>
                            <p class="text-colorblue100 font-size10px mb-0">
                                <span class="mr-2" id="diff_level">Advanced Undergraduate</span> <i class="fas fa-circle font-size6px mr-2"></i>
                                {{-- <span class="mr-2" id="duration">14m</span> <i class="fas fa-circle font-size6px mr-2"></i> --}}
                                <span class="mr-2" id="content_cate">Economic History</span></p>
                        </div>
                    </div>

                        <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-5">
                            <label for="FormControlTextarea1" class="mb-0 mt-5">Comment</label>
                            <div class="col-md-12 font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">
                                <p class="float-left">Add comment to help contributor improve the content.</p>
                                <p class="float-right">0 / 260</p>
                            </div>
                            <textarea class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="FormControlTextarea1" name="FormControlTextarea1" placeholder="Comment here" rows="6" cols="260"></textarea>
                        </div>

                </div>
                <div class="modal-footer box-shadow">
                    <button type="submit" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar">
                        <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">Submit <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                        <div class="btn-bar"></div>
                    </button>
                </div>
            </div>
        </form>
        </div>
    </div>


    <!-- Modal Choose Addmin -->
    <div class="modal fade p-0" id="moadalChooseAdmin" tabindex="-1" role="dialog" aria-labelledby="moadalChooseAdmin" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered max-width790px p-md-0 p-3" role="document">
            <div class="modal-content border-radius0px">
                <div class="modal-header p-4">
                    <h6 class="modal-title font-familyAtlasGroteskWeb-Bold text-colorblue100" id="ChooseAdminTitle">TAG TO ADMIN</h6>
                    <button type="button" class="close outlineNone text-colorMahroon700" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="tagAdmin" name="tagAdmin">
                    @csrf
                    <input type="hidden" id="contentid3" name="contentid3">
                <div class="modal-body p-4">
                    <div class="media font-size14px">
                        <img class="mr-3" src="{{ asset('images/icons/img1-1.png') }}" alt="placeholder image" width="150">
                        <div class="media-body font-familyAtlasGrotesk-Medium align-self-center">
                            <h6 class="mt-0 text-colorblue100 mb-0" id="title_content3">Microeconomics: The Truth About Prices</h6>
                            <div class="col-md-12 font-familyAtlasGroteskWeb-Regular font-size13px">
                                <div class="row justify-content-between">
                                    <p class="text-colorblue200" id="author_name2">Ellen Chris</p>
                                </div>
                            </div>
                            <p class="text-colorblue100 font-size10px mb-0">
                                <span class="mr-2" id="diff_level2">Advanced Undergraduate</span> <i class="fas fa-circle font-size6px mr-2"></i>
                                {{-- <span class="mr-2" id="duration2">14m</span> <i class="fas fa-circle font-size6px mr-2"></i> --}}
                                <span class="mr-2" id="content_cate2">Economic History</span></p>
                        </div>
                    </div>
                    <div class="col-md-12 mt-5 p-0">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="mt-0 text-colorblue100 mb-0 font-familyAtlasGroteskWeb-Medium">Choose Admin</h6>
                                <p class="font-familyAtlasGroteskWeb-Light text-colorblue200 font-size12px">You can quickly tag content to other admin for review.</p>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-0">
                                    <input type="text" class="form-control font-familyFreightTextProLight-Regular text-colorblue200 pr-5 font-size14px" id="search" placeholder="Search Admins">
                                    <i class="fas fa-search text-colorblue200 searchIcon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 p-0 chosAdminMain">
                        <div class="row">
                            @foreach ($all_admins as $admin)
                            <div class="col-md-6 mb-3">
                                <div class="col-md-12 border p-3">
                                    <div class="media font-size14px">
                                        <img class="mr-3" src="{{ asset('images/icons/img2.png') }}" alt="placeholder image" width="60">
                                        <div class="media-body align-self-center d-flex justify-content-between">
                                            <div class="">
                                                <h6 class="mt-0 text-black mb-0 font-familyAtlasGroteskWeb-Bold">{{$admin->name}}</h6>
                                                <span class="badge badge-secondary font-familyFreightTextProMedium-Italic font-size13px pl-3 pr-3 pt-2 mt-2 pb-2">Admin</span>
                                            </div>
                                            <div class="custom-control custom-radio align-self-center">
                                                <input type="radio" id="{{$admin->id}}" name="customRadio" class="custom-control-input" value="{{$admin->id}}">
                                                <label class="custom-control-label" for="{{$admin->id}}"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="modal-footer box-shadow">
                    <button type="submit" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar">
                        <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">Submit <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                        <div class="btn-bar"></div>
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add content modal -->
    <div class="modal fade p-0" id="moadalAddNewCont" tabindex="-1" role="dialog" aria-labelledby="moadalAddNewCont" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered max-width790px p-md-0 p-3" role="document">
            <div class="modal-content border-radius0px">
                <form id="add_content_form" action="{{ route('contentAdd') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header p-4">
                        <h6 class="modal-title font-familyAtlasGroteskWeb-Bold text-colorblue100 text-uppercase" id="moadalAddNewCont">Add New Course</h6>
                        <button type="button" class="close outlineNone text-colorMahroon700" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="content_title" class="mb-0 text-colorblue100">Title</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Give your content  a title your students can easily identify.</p>
                                    <input type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="content_title" name="content_title" placeholder="Content Name">
                                    <small id="content_title_err" style="color: red"></small>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                                    <label for="Author" class="mb-0 text-colorblue100">Author</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Name of author(s) of the course.</p>

                                    <input type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="Author" name="Author" placeholder="Enter Author Name">
                                    <small id="author_" style="color: red"></small>
                                </div>



                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="institution_or_source" class="mb-0 text-colorblue100">Institution/Source</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Name of institution or source of course.</p>
                                    <input autocomplete="off" type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="institution_or_source" name="institution_or_source" placeholder="Institution / Source">

                                    <small id="institution_or_source_err" style="color: red"></small>
                                </div>


                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="content_discription" class="mb-0 text-colorblue100">Description</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">The Content description is what your students will see.</p>
                                    <p class="float-right font-size14px">
                                        <span id="count">0</span><span> </span></p>
                                    <textarea class="form-control font-familyFreightTextProLight-Regular text-darkBlue" onkeyup="charcountupdate1(this.value)" name="content_discription" id="content_discription" placeholder="Content Description" rows="6" cols="260"></textarea>
                                    <small id="content_discription_err" style="color: red"></small>
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
                                    <small id="content_difficulty_level_err" style="color: red"></small>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                                    <label for="selectcontent" class="mb-0 text-colorblue100">Select Category</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Choose any seven fields to which your content is most closely related.</p>
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
                                    <label for="Restriction" class="mb-0 text-colorblue100">Select Restriction</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Choose restriction of your content.</p>
                                    <select id="Restriction" name="privacy_content_01" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue">
                                        <option value="" selected disabled>Choose Restriction</option>
                                        <option value="0">Public</option>
                                        <option value="1">Private</option>

                                    </select>
                                    <small id="content_difficulty_level_err" style="color: red"></small>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customFileMain">
                                    <label for="addimg" class="mb-0 text-colorblue100">Add Thumbnail Image</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Add your thumbnail for your Content.</p>
                                    <div class="custom-file">
                                        <input id="content_image" name="content_image" type="file" class="custom-file-input col-md-12 p-0 getVal" onchange="getVal()">
                                        <div id="saveFileVal" class="font-familyAtlasGroteskWeb-Light text-colorblue200 font-size11px mt-1"></div>
                                        <label class="custom-file-label font-familyFreightTextProLight-Regular text-darkBlue font-size14px col-md-12 d-flex align-items-center justify-content-between" for="uploadImg">Upload</label>
                                    </div>

                                    <small id="content_avatar_err" style="color: red"></small>
                                </div>
                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                                    <label for="addTag" class="mb-0 text-colorblue100">Add Tags <span class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size10px">(Only 3)</span></label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Add tags to promote your content.</p>
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
                                {{-- <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="duration" class="mb-0 text-colorblue100">Duration</label>
                                    <input autocomplete="off" id="duration" name="duration" type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" placeholder="e.g 00 mint">
                                    <small id="content_duration_err" style="color: red"></small>
                                </div> --}}
                            </div>
                        </div>
                        <div class="reminder-text">By submitting materials, you confirm you are not violating others’ copyright rights, the materials may be used by others under the Terms of Service, and you agree to the <a href="{{ route('termsConditions')}}" target="_blank">Terms of Service.</a></div>
                    </div>
                    <div class="modal-footer box-shadow">
                        <p id="final_content_msg" style="text-align: center; width: 80%;"></p>
                        <button type="submit" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar">
                            <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">Add <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                            <div class="btn-bar"></div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>



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
                            <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">Add <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                            <div class="btn-bar"></div>
                        </button>
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
                                        <p class="text-colorblue200 font-size12px mb-0"><span id="count1">0</span><span> </span></p>
                                    </div>
                                    <textarea class="form-control" name="content_discription2" id="content_discription2" placeholder="Content Description"></textarea>
                                    <!-- <textarea class="form-control font-familyFreightTextProLight-Regular text-darkBlue" onkeyup="charcountupdate2(this.value)" name="content_discription2" id="content_discription2" placeholder="Content Description" rows="6" cols="260"></textarea> -->
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
                                        @if ($tags)
                                            @foreach ($tags as $tag)
                                                <option>{{ $tag->name }}</option>
                                            @endforeach
                                        @endif
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
                        <div class="reminder-text">By submitting materials, you confirm you are not violating others’ copyright rights, the materials may be used by others under the Terms of Service, and you agree to the <a href="{{ route('termsConditions')}}" target="_blank">Terms of Service. </a></div>

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
    </div>
     {{-- <div class="modal fade p-0" id="moadalAddNewCourse" tabindex="-1" role="dialog" aria-labelledby="moadalAddNewCourse" aria-hidden="true" data-backdrop="static">
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
                                    <label for="content_discription2" class="mb-0 text-colorblue100">Description</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">The Content description is what your students will see.</p>
                                    <p class="float-right text-colorblue200 font-size12px mb-0"> <span id="count1">0</span><span> / 160</span></p>
                                    <textarea class="form-control font-familyFreightTextProLight-Regular text-darkBlue" name="content_discription2" onkeyup="charcountupdate2(this.value)" id="content_discription2" placeholder="Content Description" rows="6" cols="260"></textarea>
                                    <small id="content_discription2_err" style="color: red"></small>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                                    <label for="selectcontent" class="mb-0 text-colorblue100">Select Category</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Choose any seven fields to which your content is most closely related.</p>
                                    <select id="selectpickerCategories2" name="selectpickerCategories2" class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue addPlaceholder" multiple title="Select Categories">
                                        @if ($data['categories'])
                                            @foreach ($data['categories'] as $category)
                                                <option value="{{ $category->id }}">{!! $category->name !!}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    {{--<i class="fas fa-angle-down position-absolute marginDArrow"></i>
                                    <i class="fas fa-angle-down position-absolute marginDArrow"></i>
                                    <small id="content_categories2_err" style="color: red"></small>
                                </div>

                                <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="affiliation2" class="mb-0 text-colorblue100">Author/Institute</label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Mention the name of the institution or affiliation</p>
                                    <input autocomplete="off" type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="affiliation2" name="affiliation2" placeholder="Enter Affiliation">

                                    <small id="content_affiliation2_err" style="color: red"></small>
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


                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-secondary active">
                                      <input type="radio" name="privacy_content" id="option1" value="0" autocomplete="off" checked> Public
                                    </label>
                                    <label class="btn btn-secondary">
                                      <input type="radio" name="privacy_content" id="option2" value="1" autocomplete="off"> Private
                                    </label>
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
                                    <label for="addTag" class="mb-0 text-colorblue100">Add Tags <span class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size10px">(Only 3)</span></label>
                                    <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Add tags to promote your content.</p>
                                    <select id="selectpickerTags2" name="selectpickerTags2" class="border font-familyFreightTextProLight-Regular text-darkBlue" multiple title="Tags" size='2'>
                                        {{-- @if ($tags)
                                            @foreach ($tags as $tag)
                                                <option>{{ $tag->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <i class="fas fa-angle-down position-absolute marginDArrow2-1"></i>
                                    <small id="content_tags2_err" style="color: red"></small>

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

                                <div id="description_div" class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                                    <label for="description" class="text-colorblue100">Article Description</label>
                                    <p class="float-right text-colorblue200 font-size12px mt-1"> <span id="count2">0</span><span> / 160</span></p>
                                    <textarea class="form-control classy-editor" name="description" id="description" rows="6" cols="260" onkeyup="charcountupdate3(this.value)"></textarea>
                                    <small id="description_div_err" style="color: red"></small>
                                </div>
                            </div>



                        </div>
                        <div class="reminder-text">By submitting materials, you confirm you are not violating others’ copyright rights, the materials may be used by others under the Terms of Service, and you agree to the Terms of Service.</div>

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
    </div> --}}

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
                    {{-- <button type="submit" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar">
                        <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">OK <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                        <div class="btn-bar"></div>
                    </button> --}}
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
        top: 748px;
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
                                    <a href="/inetEDPlatform/content/section/`+playListData[i].content.id+`">
                                        <div class="thumbnailImg_WHCard overflow-hidden" style="background: url('`+image+`') no-repeat; background-size: cover;">
                                        </div>
                                    </a>
                                    <div class="card-header bg-transparent border-0 pb-0 pt-2 font-size14px font-familyAtlasGroteskWeb-Regular text-colorblue200">
                                        <small class="float-right"> views `+playListData[i].content.views_count+`</small>

                                        </div>
                                    <div class="card-body">

                                        <a href="/inetEDPlatform/content/section/`+playListData[i].content.id+`">
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
              // $("#add_playlist_form").find('input[name="name"]').after('<p style="color: red">sdsd</p>');
              // console.log( $("#add_playlist_form").find('input[name="name"]'));
            },
          });

        });

        $(document).on('click','.back-playlist',function(e){
          e.preventDefault();

          $('.add-playlist').show();
          $('.playlist-tabs').hide();

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





    </script>


@endsection
