@extends('layouts.app')


@section('title') INET ED Platform :: Tasks @endsection

@section('content')
    <style>
#data-table span {
    display:none; 
}
    </style>
    @include('include.header')
    <section class="pt-5 pb-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-black font-familyAtlasGroteskWeb-Bold mb-4">Tasks</h3>
                </div>

                <div class="col-md-12 list-groupCusMain mb-2">
                    <div class="list-group  font-familyAtlasGroteskWeb-Regular text-colorblue100 font-size14px border-bottom" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active col-lg-2 col-md-3" id="list-received-list" data-toggle="list" href="#pg-received" role="tab" aria-controls="Received">Received</a>
                        <a class="list-group-item list-group-item-action col-lg-2 col-md-3" id="list-profile-list" data-toggle="list" href="#pg-approved" role="tab" aria-controls="Approved">Approved</a>
                        <a class="list-group-item list-group-item-action col-lg-2 col-md-3" id="list-deleted-list" data-toggle="list" href="#pg-deleted" role="tab" aria-controls="Deleted">Deleted</a>
                        <a class="list-group-item list-group-item-action col-lg-2 col-md-3" id="list-comments-list" data-toggle="list" href="#pg-comments" role="tab" aria-controls="Comments">Comments</a>
                        <a class="list-group-item list-group-item-action col-lg-2 col-md-3" id="list-contributors-list" data-toggle="list" href="#pg-candidates" role="tab" aria-controls="Candidates">Candidates</a>
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active horizontalScroll" id="pg-received" role="tabpanel" aria-labelledby="received">
                            <table id="tasksDataTable" class="table table-striped table-bordered font-familyAtlasGroteskWeb-Medium font-size13px dashboardDataTable" style="width:100%">
                                <thead class="text-colorblue200 font-size12px font-familyAtlasGroteskWeb-Black text-uppercase">
                                <tr>
                                    <th></th>
                                    <th>Title</th>
                                    <th>Contributor</th>
                                    <th>Date</th>
                                    <th>Group</th>
                                    <th>Status</th>
                                    <th>Action </th>
                                </tr>
                                </thead>
                                <tbody>
                                  @foreach($recivedcontent as $rec)
                                <tr>
                                    <td>
                                        @if($rec->scope_type=='course')
                                           <a href="/inetEDPlatform/coursecontent/view/{{ $rec->id}}">
                                         @else
                                           <a href="/inetEDPlatform/content/view/{{ $rec->id}}">
                                        @endif
                                      <img src="http://pro.celeritas-solutions.com/inetEDPlatform/public/uploads/content/profile_images/{{$rec->image_url}}" alt="" width="150"></td>
                                            </a>
                                     <td>
                                        @if($rec->scope_type=='course')
                                        <a href="/inetEDPlatform/coursecontent/view/{{ $rec->id}}">
                                         @else
                                           <a href="/inetEDPlatform/content/view/{{ $rec->id}}">
                                        @endif
                                        <h6 class="mt-0 font-size1em">{{ $rec->title}}</h6>
                                        </a>
                                        <p class="font-familyAtlasGroteskWeb-Regular mt-3 mb-0">{{ $rec->name}}</p>
                                    </td>
                                    <td>{{ $rec->authors}}</td>
                                    <td><span>{{date('Y/m/d', strtotime($rec->created_at))}}</span></td>
                                    <td>{{ $rec->scope_type}},<br> {{ $rec->content_group}}</td>
                                    <td><span class="badge badge-customBtn4 font-familyAtlasGroteskWeb-Medium font-weight-normal font-size12px p-3 text-brown">Waiting for Approval</span></td>
                                    <td align="center">
                                        <ul class="navbar-nav align-self-center font-familyFreightTextProLight-Regular">
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle p-0 text-lightGaray" href="#" id="listViewMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ><i class="fas fa-ellipsis-h font-size2em"></i></a>
                                                <div class="dropdown-menu margin-top2em widthMin15rem border-radius0px right0 aPading" aria-labelledby="listViewMenu">
                                                    <div class="col pl-0 pr-0">
                                                            <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#moadalAddComment" onclick="showData({{ $rec->id}})"><i class="far fa-comment-alt mr-2"></i> <span>Add Comment</span></a>
                                                            <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#moadalApproved" onclick="showApproved({{ $rec->id}})"><i class="far fa-file-alt mr-2"></i> <span>Approve Course</span></a>
                                                            <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#moadalChooseAdmin"  onclick="showData2({{ $rec->id}})"><i class="fas fa-id-card-alt mr-2"></i> <span>Tag Other Admin</span></a>  

                                                            <a class="dropdown-item font-size14px" href="#" course_id="{{$rec->content_group}}" data-toggle="modal" data-target="#moadalChangeGroup" onclick="showApproved3({{ $rec->id}})"><i class="fas fa-layer-group mr-2"></i> <span>Change Group</span></a>      
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
                        <div class="tab-pane fade show horizontalScroll" id="pg-approved" role="tabpanel" aria-labelledby="approved">
                            <table id="tasksDataTable2" class="table table-striped table-bordered font-familyAtlasGroteskWeb-Medium font-size13px dashboardDataTable" style="width:100%">
                                <thead class="text-colorblue200 font-size12px font-familyAtlasGroteskWeb-Black text-uppercase">
                                <tr>
                                    <th></th>
                                    <th>Title</th>
                                    <th>Contributor</th>
                                    <th>Date</th>
                                    <th>Group</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                  @foreach($historycontent as $rec)
                                <tr>
                                    <td>
                                        @if($rec->scope_type=='course')
                                           <a href="/inetEDPlatform/coursecontent/view/{{ $rec->id}}">
                                         @else
                                           <a href="/inetEDPlatform/content/view/{{ $rec->id}}">
                                        @endif
                                      <img src="http://pro.celeritas-solutions.com/inetEDPlatform/public/uploads/content/profile_images/{{$rec->image_url}}" alt="" width="150"></td>
                                            </a>
                                     <td>
                                        @if($rec->scope_type=='course')
                                        <a href="/inetEDPlatform/coursecontent/view/{{ $rec->id}}">
                                         @else
                                           <a href="/inetEDPlatform/content/view/{{ $rec->id}}">
                                        @endif
                                        <h6 class="mt-0 font-size1em">{{ $rec->title}}</h6>
                                        </a>
                                        <p class="font-familyAtlasGroteskWeb-Regular mt-3 mb-0">{{ $rec->name}}</p>
                                    </td>
                                    <td>{{ $rec->authors}}</td>
                                    <td><span>{{date('Y/m/d', strtotime($rec->created_at))}}</span></td>
                                    <td>{{ $rec->scope_type}}</td>
                                    <td><span class="badge badge-customBtn5 font-familyAtlasGroteskWeb-Medium font-weight-normal font-size13px p-3 text-ferozy">Approved</span></td>
                                </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade show horizontalScroll" id="pg-deleted" role="tabpanel" aria-labelledby="deleted">
                            <table id="tasksDataTable3" class="table table-striped table-bordered font-familyAtlasGroteskWeb-Medium font-size13px dashboardDataTable" style="width:100%">
                                <thead class="text-colorblue200 font-size12px font-familyAtlasGroteskWeb-Black text-uppercase">
                                <tr>
                                    <th></th>
                                    <th>Title</th>
                                    <th>Contributor</th>
                                    <th>Date</th>
                                    <th>Group</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                  @foreach($deletecontent as $rec)
                                <tr>
                                    <td>
                                      <img src="http://pro.celeritas-solutions.com/inetEDPlatform/public/uploads/content/profile_images/{{$rec->image_url}}" alt="" width="150"></td>
                                     <td>
                                        <h6 class="mt-0 font-size1em">{{ $rec->title}}</h6>
                                        <p class="font-familyAtlasGroteskWeb-Regular mt-3 mb-0">{{ $rec->name }}</p>
                                    </td>
                                    <td>{{ $rec->authors }}</td>
                                    <td><span>{{date('Y/m/d', strtotime($rec->created_at))}}</span></td>
                                    <td>{{ $rec->scope_type}}</td>
                                    <td>
                                      @if($rec->status==0)
                                       <span class="badge badge-customBtn4 font-familyAtlasGroteskWeb-Medium font-weight-normal font-size12px p-3 text-brown">Waiting for Approval</span>
                                        @else
                                    <span class="badge badge-customBtn5 font-familyAtlasGroteskWeb-Medium font-weight-normal font-size13px p-3 text-ferozy">Approved</span>
                                      @endif
                                    </td>
                                </tr>
                                  @endforeach
                                </tbody>
                            </table>

                        </div>
                        <div class="tab-pane fade show horizontalScroll" id="pg-comments" role="tabpanel" aria-labelledby="comments">
                            <div class="row" id="list-comments">
                            </div>
                        </div>
                        <div class="tab-pane fade show horizontalScroll" id="pg-candidates" role="tabpanel" aria-labelledby="candidates">
                            <div class="row" id="list-contributors">
                           </div>

                           </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    @include('include.footer')

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
    <!-- Modal ADD APPROVE -->
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

<div class="modal fade p-0" id="moadalChangeGroup" tabindex="-1" role="dialog" aria-labelledby="moadalChangeGroup" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered p-md-0 p-3" role="document" style="max-width: 380px;">
            <div class="modal-content border-radius0px">
                <div class="modal-header p-4">
                    <h6 class="modal-title font-familyAtlasGroteskWeb-Bold text-colorblue100" id="moadalChangeGroupTitle">Change Group</h6>
                    <button type="button" class="close outlineNone text-colorMahroon700" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4 customDropDownInnerPg">
                  <input type="hidden" id="contentid3" name="contentid3">
		<div class="form-group">
		   <label for="FormControlTextarea1" class="" >Select Group</label>
                    <select id='addGroup' name='group' class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue">

                                            <option selected value="">Select Group</option>
                                            <option value="None">None</option>
                                            <option value="Syllabus">Syllabus</option>
                                            <option value="Exercise">Exercise</option>
                                            <option value="Data">Data</option>
                                            <option value="Featured">Featured</option>
                                            <option value="Website">Website</option>

                                        </select>
                        		</div>

                </div>
                <div class="modal-footer box-shadow">
                    {{-- <button type="submit" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar">
                        <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">OK <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                        <div class="btn-bar"></div>
                    </button>--}}
                    <button id="nonbut" type="submit" onclick = "location.reload()"  class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">Submit</span>
                    </button>
                </div>
            </div>

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

@section('script')
    <script>
        $(document).ready(function() {
            $("#tasksDataTable").DataTable({
                bPaginate: true,
                bLengthChange: false,
                bFilter: false,
                bInfo: false,
                bAutoWidth: false,
		order: [[ 3, "asc" ]],
                sPaginationType: "full_numbers",
                iDisplayLength: 10,
                ordering: true,
                language: {
                    searchPlaceholder: "Keyword search here",
                    search: "",
                },
            });
        } );

        $(document).ready(function() {
            $("#tasksDataTable2").DataTable({
                bPaginate: true,
                bLengthChange: false,
                bFilter: false,
                bInfo: false,
                bAutoWidth: false,
		order: [[ 3, "asc" ]],
                sPaginationType: "full_numbers",
                iDisplayLength: 10,
                ordering: true,
                language: {
                    searchPlaceholder: "Keyword search here",
                    search: "",
                },
            });
        } );

        $(document).ready(function() {
            $("#tasksDataTable3").DataTable({
                bPaginate: true,
                bLengthChange: false,
                bFilter: false,
                bInfo: false,
                bAutoWidth: false,
		order: [[ 3, "asc" ]],
                sPaginationType: "full_numbers",
                iDisplayLength: 10,
                ordering: true,
                language: {
                    searchPlaceholder: "Keyword search here",
                    search: "",
                },
            });
        } );



    $("#addGroup").on("change", function () {
    addGroupname();
   });
function showApproved3(id){
     $("#contentid3").val(id);
}

   function addGroupname(id) {
    
   // var course_id= $(this).data('course_id');
     var contentid = $("#contentid3").val();    
console.log(contentid);
     const group = $("#addGroup").val();

 
     $.ajax({
       type: "POST",
       url: `${base_url}add_group`,
       headers: {
         "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
       },
       data: {group:group,course_id:contentid},
       success: function () {
       },
   
       error: function (err) {
         console.log(err);
       },
     });
    }  

    $('#addGroup').on('change', function () {
    $('#nonbut').prop('disabled', !$(this).val());
}).trigger('change');


 </script>

@endsection