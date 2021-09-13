@extends('layouts.app')


@section('title') INET ED Platform :: Dashboard @endsection

@section('content')
    @include('include.header')

    <section class="pt-4 pb-4 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <h6 class="text-colorblue100 font-familyAtlasGroteskWeb-Medium mb-3">Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum mperdie ultricies</h6>
                    <div class="media">
                        <div class="thumbnailImg_WHN3 thumbnailImg overflow-hidden" style="background: url('images/icons/img2.png') no-repeat; background-size: cover;">
                        </div>
                        <div class="media-body align-self-center d-flex">
                            <p class="mt-0 mb-0 font-familyAtlasGrotesk-Medium text-colorblue100 font-size14px align-self-center"><span class="align-self-center mr-2">Niko Tim</span> <span class="badge badge-secondary font-familyFreightTextProMedium-Italic pl-3 pr-3 pt-2 pb-2">Student</span></p>
                            <span class="text-colorblue200 opacity0point5 mr-3 ml-3 align-self-center">|</span>
                            <div class="align-self-center">
                                <span class="align-self-center"><img src="{{ asset('images/icons/pencil.png') }}" alt="" width="20" class="mr-2"></span>
                                <span class="text-colorblue200 font-familyAtlasGroteskWeb-Regular font-size13px opacity0point5 align-self-center">July 4, 2020</span>
                            </div>
                            <span class="text-colorblue200 opacity0point5 mr-3 ml-3 align-self-center">|</span>
                            <div class="align-self-center">
                                <span class="align-self-center opacity0point5 text-colorblue200 mr-2"><i class="far fa-eye"></i></span>
                                <span class="text-colorblue200 font-familyAtlasGroteskWeb-Regular font-size13px opacity0point5 align-self-center">2.7k Views</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 border-bottom contSuggTable mt-4 p-0">
                        <div class="row justify-content-between no-gutters">
                            <div class="col-md-6">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination font-familyAtlasGrotesk-Regular text-colorblue100 font-size12px ">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">Next</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="col-md-4 dashboardDataTable dashboardDataTable2 d-flex justify-content-end">
                                <span class="text-ferozy pr-3 font-familyAtlasGroteskWeb-Bold font-size12px align-self-center"><span>SHARE</span> <i class="fas fa-angle-down text-colorMahroon700 ml-2"></i></span>
                                <span class="font-familyAtlasGroteskWeb-Bold text-colorblue200 opacity0point5 font-size12px align-self-center">Watch Thread</span>
                                <ul class="navbar-nav align-self-center font-familyFreightTextProLight-Regular width23px">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle p-0 text-lightGaray ml-3" href="#" id="listViewMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu margin-top2em widthMin15rem border-radius0px right0 aPading" aria-labelledby="listViewMenu">
                                            <div class="col pl-0 pr-0">
                                                <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#"><i class="far fa-edit mr-2"></i> <span>Edit Thread</span></a>
                                                <a class="dropdown-item font-size14px" href="#"><i class="far fa-flag mr-2"></i> <span>Flag Thread</span></a>
                                                <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#areYouSure"><i class="far fa-trash-alt mr-2"></i> <span>Delete Thread</span></a>
                                                <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#"><i class="far fa-window-close mr-2"></i> <span>Close Thread</span></a>
                                                <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#"><i class="fas fa-thumbtack mr-2"></i> <span>Pin Thread</span></a>
                                                <a class="dropdown-item font-size14px" href="#" data-toggle="modal" data-target="#moadalMoveThread"><i class="fas fa-arrows-alt mr-2"></i> <span>Move Thread</span></a>
                                                <a class="dropdown-item font-size14px" href="{{ route('bannedUser') }}"><i class="fas fa-user-slash mr-2"></i> <span>Ban User</span></a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-12 p-0">
                        <div class="row no-gutters">
                            <div class="col-lg-2 col-md-3 text-center mb-3">
                                <div class="col text-center mb-3">
                                    <div class="thumbnailImg_WHN5 thumbnailImg overflow-hidden mr-0 m-auto" style="background: url('images/icons/img1.png') no-repeat; background-size: cover;">
                                    </div>

                                    <p class="font-familyAtlasGrotesk-Medium text-colorblue100 mt-2 mb-2 font-size14px">Niko Tim</p>
                                    <span class="badge badge-secondary font-familyFreightTextProMedium-Italic font-size12px pl-3 pr-3 pt-2 pb-2">Student</span>
                                </div>
                                <p class="font-familyAtlasGroteskWeb-Regular text-colorblue200 font-size14px mb-1"><span class="opacity0point5">Joined:</span> July 1, 2020</p>
                                <p class="font-familyAtlasGroteskWeb-Regular text-colorblue200 font-size14px"><span class="opacity0point5">Posts:</span> 276</p>
                                <img src="{{ asset('images/icons/gloldMember.png') }}" alt="" width="80">
                            </div>
                            <div class="col-lg-10 col-md-9 mb-3">
                                <div class="col-md-12 bg-lightWhite100 p-0 font-familyAtlasGroteskWeb-Regular text-colorblue200 font-size13px arrow">
                                    <div class="col-md-12 p-4">
                                        <div class="col-md-12 p-0 font-familyAtlasGroteskWeb-Regular text-colorblue200 mb-3 d-flex justify-content-between">
                                            <p class="mb-0 font-size13px align-self-center opacity0point5">July 4, 2020 at 16:00</p>
                                            <span class="badge badge-secondary2 pl-3 pr-3 pt-2 pb-2 font-size13px">#1</span>
                                        </div>
                                        <p>This is a post description section where you can write about your listing. We have provided an editor for entering this information on Submit listing page so your visitors will be able to format their description easily. They can highlight their content with Bold, Italic, Underline options, they can also use ordered and un-ordered lists:
                                        </p>
                                        <p class="mb-2">Ordered list:</p>
                                        <ol>
                                            <li>Allow users to publish their posts on your site</li>
                                            <li>You can also <span class="font-familyAtlasGroteskWeb-Medium">add media or attachment</span></li>
                                            <li>You can use <span class="font-familyAtlasGroteskWeb-Light"><i>shortcodes</i></span></li>
                                        </ol>
                                        <p class="mb-2">Unordered list:</p>
                                        <ol>
                                            <li>Allow users to publish their posts on your site</li>
                                            <li>You can also <span class="font-familyAtlasGroteskWeb-Medium">add media or attachment</span></li>
                                            <li>You can use <span class="font-familyAtlasGroteskWeb-Light"><i>shortcodes</i></span></li>
                                        </ol>
                                        <p><a href="#">Hyperlinks, </a>images and bbcode can also be added here. &#128578;</p>
                                    </div>

                                    <div class="col-md-12 border-top p-4">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <i class="fas fa-thumbs-up colorBlue font-size18px"></i>
                                                <span class="font-size18px">&#128518;</span>
                                                <i class="fas fa-info-circle colorGreen font-size18px"></i>
                                                <span class="font-familyAtlasGroteskWeb-Medium text-ferozy font-size14px ml-1">78</span>
                                            </div>
                                            <div class="col-md-6 text-right align-self-center">
                                                <i class="fas fa-thumbs-up colorBlue font-size18px"></i>
                                                <span class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size12px ml-1">LIKE</span>
                                                <i class="fas fa-reply font-size18px text-colorblue100 ml-5"></i>
                                                <span class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size12px ml-1">REPLY</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12 p-0">
                        <div class="row no-gutters">
                            <div class="col-lg-2 col-md-3 text-center mb-3">
                                <div class="col text-center mb-3">
                                    <div class="thumbnailImg_WHN5 thumbnailImg overflow-hidden mr-0 m-auto" style="background: url('images/icons/img1.png') no-repeat; background-size: cover;">
                                    </div>

                                    <p class="font-familyAtlasGrotesk-Medium text-colorblue100 mt-2 mb-2 font-size14px">Niko Tim</p>
                                    <span class="badge badge-secondary font-familyFreightTextProMedium-Italic font-size12px pl-3 pr-3 pt-2 pb-2">Student</span>
                                </div>
                                <p class="font-familyAtlasGroteskWeb-Regular text-colorblue200 font-size14px mb-1"><span class="opacity0point5">Joined:</span> July 1, 2020</p>
                                <p class="font-familyAtlasGroteskWeb-Regular text-colorblue200 font-size14px"><span class="opacity0point5">Posts:</span> 276</p>
                                <img src="{{ asset('images/icons/silverMember.png') }}" alt="" width="80">
                            </div>
                            <div class="col-lg-10 col-md-9 mb-3">
                                <div class="col-md-12 bg-lightWhite100 p-0 font-familyAtlasGroteskWeb-Regular text-colorblue200 font-size13px arrow">
                                    <div class="col-md-12 p-4">
                                        <div class="col-md-12 p-0 font-familyAtlasGroteskWeb-Regular text-colorblue200 mb-3 d-flex justify-content-between">
                                            <div class="col-md-6 p-0 align-self-center "><p class="mb-0 font-size13pxopacity0point5">July 4, 2020 at 16:00</p></div>
                                            <div class="col-md-6 p-0 text-right">
                                                <span class="badge badge-secondary2 pl-3 pr-3 pt-2 pb-2 font-size13px">#2</span>
                                                <a href="#" class="text-colorblue200 opacity0point5 ml-3 font-size16px"><i class="fas fa-ellipsis-h"></i></a>
                                            </div>
                                        </div>
                                        <p>This is a post description section where you can write about your listing. We have provided an editor for entering this information on Submit listing page so your visitors will be able to format their description easily. They can highlight their content with Bold, Italic, Underline options, they can also use ordered and un-ordered lists:
                                        </p>
                                        <p class="mb-2">Ordered list:</p>
                                        <ol>
                                            <li>Allow users to publish their posts on your site</li>
                                            <li>You can also <span class="font-familyAtlasGroteskWeb-Medium">add media or attachment</span></li>
                                            <li>You can use <span class="font-familyAtlasGroteskWeb-Light"><i>shortcodes</i></span></li>
                                        </ol>
                                        <p class="mb-2">Unordered list:</p>
                                        <ol>
                                            <li>Allow users to publish their posts on your site</li>
                                            <li>You can also <span class="font-familyAtlasGroteskWeb-Medium">add media or attachment</span></li>
                                            <li>You can use <span class="font-familyAtlasGroteskWeb-Light"><i>shortcodes</i></span></li>
                                        </ol>
                                        <p><a href="#">Hyperlinks, </a>images and bbcode can also be added here. &#128578;</p>
                                    </div>

                                    <div class="col-md-12 border-top p-4">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <i class="fas fa-thumbs-up colorBlue font-size18px"></i>
                                                <span class="font-size18px">&#128518;</span>
                                                <i class="fas fa-info-circle colorGreen font-size18px"></i>
                                                <span class="font-familyAtlasGroteskWeb-Medium text-ferozy font-size14px ml-1">78</span>
                                            </div>
                                            <div class="col-md-6 text-right align-self-center">
                                                <i class="fas fa-thumbs-up colorBlue font-size18px"></i>
                                                <span class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size12px ml-1">LIKE</span>
                                                <i class="fas fa-reply font-size18px text-colorblue100 ml-5"></i>
                                                <span class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size12px ml-1">REPLY</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 p-0">
                        <div class="row no-gutters">
                            <div class="col-lg-2 col-md-3 text-center mb-3">
                                <div class="col text-center mb-3">
                                    <div class="thumbnailImg_WHN5 thumbnailImg overflow-hidden mr-0 m-auto" style="background: url('images/icons/img1.png') no-repeat; background-size: cover;">
                                    </div>

                                    <p class="font-familyAtlasGrotesk-Medium text-colorblue100 mt-2 mb-2 font-size14px">Niko Tim</p>
                                    <span class="badge badge-secondary font-familyFreightTextProMedium-Italic font-size12px pl-3 pr-3 pt-2 pb-2">Student</span>
                                </div>
                                <p class="font-familyAtlasGroteskWeb-Regular text-colorblue200 font-size14px mb-1"><span class="opacity0point5">Joined:</span> July 1, 2020</p>
                                <p class="font-familyAtlasGroteskWeb-Regular text-colorblue200 font-size14px"><span class="opacity0point5">Posts:</span> 276</p>
                                <img src="{{ asset('images/icons/bronzeMember.png') }}" alt="" width="80">
                            </div>
                            <div class="col-lg-10 col-md-9 mb-3">
                                <div class="col-md-12 bg-lightWhite100 p-0 font-familyAtlasGroteskWeb-Regular text-colorblue200 font-size13px arrow">
                                    <div class="col-md-12 p-4">
                                        <div class="col-md-12 p-0 font-familyAtlasGroteskWeb-Regular text-colorblue200 mb-3 d-flex justify-content-between">
                                            <div class="col-md-6 p-0 align-self-center "><p class="mb-0 font-size13pxopacity0point5">July 4, 2020 at 16:00</p></div>
                                            <div class="col-md-6 p-0 text-right">
                                                <span class="badge badge-secondary2 pl-3 pr-3 pt-2 pb-2 font-size13px">#3</span>
                                                <a href="#" class="text-colorblue200 opacity0point5 ml-3 font-size16px"><i class="fas fa-ellipsis-h"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-md-12 p-4 mb-3 bg-gray900">
                                            <p class="text-ferozy font-familyAtlasGroteskWeb-Medium mb-0">Frank Knight said:</p>
                                            <p class="font-familyAtlasGroteskWeb-Regular mb-0">i think micro is overrated!</p>
                                        </div>

                                        <p class="mb-2">I tend to agree, but its hard to to teach properly without having gone over some micro first.</p>
                                        <p>I wonder what <a href="#">@Jerry Smith</a> thinks about this</p>
                                    </div>

                                    <div class="col-md-12 border-top p-4">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <i class="fas fa-thumbs-up colorBlue font-size18px"></i>
                                                <span class="font-size18px">&#128518;</span>
                                                <i class="fas fa-info-circle colorGreen font-size18px"></i>
                                                <span class="font-familyAtlasGroteskWeb-Medium text-ferozy font-size14px ml-1">78</span>
                                            </div>
                                            <div class="col-md-6 text-right align-self-center">
                                                <i class="fas fa-thumbs-up colorBlue font-size18px"></i>
                                                <span class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size12px ml-1">LIKE</span>
                                                <i class="fas fa-reply font-size18px text-colorblue100 ml-5"></i>
                                                <span class="font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size12px ml-1">REPLY</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-5">

                    <div class="col-md-12 p-0">
                        <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-4 h-textEditor">
                            <label for="FormControlTextarea1" class="">Your Answer</label>
                            <textarea class="form-control classy-editor" id="FormControlTextarea1" placeholder="" rows="6" cols="260"></textarea>
                        </div>
                        <button type="button" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px p-0 border-radius0px btnBotmBar">
                            <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">POST ANSWER <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                            <div class="btn-bar"></div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('include.footer')

    <!-- Modal Are You Sure! -->
    <div class="modal fade" id="areYouSure" tabindex="-1" role="dialog" aria-labelledby="areYouSureTitle" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered max-width-630px" role="document">
            <div class="modal-content border-radius0px">
                <div class="modal-body p-5">
                    <p class="mb-0 font-familyAtlasGroteskWeb-Medium text-colorblue100 font-size14px mb-0">Are you sure you want to delete this thread?</p>
                    <p class="font-familyAtlasGroteskWeb-Light text-colorblue200 opacity0point5 font-size14px mb-0">You can also repost the thread again from the discussion board drop-down.</p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="font-familyAtlasGroteskWeb-Bold font-size12px align-self-center" data-dismiss="modal" aria-label="Close">CANCEL</a>
                    <button type="button" class="btn btn-customBtn3 text-colorMahroon700 font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar ml-3 ">
                        <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">DELETE <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                        <div class="btn-bar"></div>
                    </button>
                </div>
            </div>
        </div>
    </div>




    <!-- Modal MOVE THREAD -->
    <div class="modal fade p-0" id="moadalMoveThread" tabindex="-1" role="dialog" aria-labelledby="moadalMoveThread" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered max-width790px overflow-hidden p-md-0 p-3" role="document">
            <div class="modal-content border-radius0px">
                <div class="modal-header p-4">
                    <h6 class="modal-title font-familyAtlasGroteskWeb-Bold text-colorblue100" id="moadalMoveThreadTitle">MOVE THREAD</h6>
                    <button type="button" class="close outlineNone text-colorMahroon700" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0 font-size14px">
                    <div class="col p-0">
                        <div class="col-md-12 bg-gray900 p-4">
                            <h6 class="text-black font-familyAtlasGroteskWeb-Bold mb-0">Official</h6>
                        </div>
                        <div class="col-md-12 bg-lightWhite600 pr-4 pl-4 p-3 border-bottom">
                            <div class="row justify-content-between">
                                <div class="col-lg-6 col-md-12 d-flex align-self-center">
                                    <p class="mb-0 font-familyAtlasGroteskWeb-Regular text-colorblue200">Announcements</p>
                                </div>
                                <div class="col-lg-4 col-md-12 text-center">
                                    <div class="row justify-content-end no-gutters">
                                        <span class="font-size13px">
                                            <p class="mb-0 font-familyAtlasGroteskWeb-Medium text-colorblue200 opacity0point5">285</p>
                                            <p class="mb-0 font-familyAtlasGroteskWeb-Regular font-size12px text-colorblue200 opacity0point5">Threads</p>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 bg-lightWhite600 pr-4 pl-4 p-3 border-bottom">
                            <div class="row justify-content-between">
                                <div class="col-lg-6 col-md-12 d-flex align-self-center">
                                    <p class="mb-0 font-familyAtlasGroteskWeb-Regular text-colorblue200">Have you seen this..?</p>
                                </div>
                                <div class="col-lg-4 col-md-12 text-center">
                                    <div class="row justify-content-end no-gutters">
                                        <span class="font-size13px">
                                            <p class="mb-0 font-familyAtlasGroteskWeb-Medium text-colorblue200 opacity0point5">285</p>
                                            <p class="mb-0 font-familyAtlasGroteskWeb-Regular font-size12px text-colorblue200 opacity0point5">Threads</p>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 bg-lightWhite600 pr-4 pl-4 p-3 mb-4 border-bottom">
                            <div class="row justify-content-between">
                                <div class="col-lg-6 col-md-12 d-flex align-self-center">
                                    <p class="mb-0 font-familyAtlasGroteskWeb-Regular text-colorblue200">Frequently Asked Questions</p>
                                </div>
                                <div class="col-lg-4 col-md-12 text-center">
                                    <div class="row justify-content-end no-gutters">
                                        <span class="font-size13px">
                                            <p class="mb-0 font-familyAtlasGroteskWeb-Medium text-colorblue200 opacity0point5">285</p>
                                            <p class="mb-0 font-familyAtlasGroteskWeb-Regular font-size12px text-colorblue200 opacity0point5">Threads</p>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col p-0">
                        <div class="col-md-12 bg-gray900 p-4">
                            <h6 class="text-black font-familyAtlasGroteskWeb-Bold mb-0">Teacher</h6>
                        </div>
                        <div class="col-md-12 bg-lightWhite600 pr-4 pl-4 p-3 border-bottom mb-4">
                            <div class="row justify-content-between">
                                <div class="col-lg-6 col-md-12 d-flex align-self-center">
                                    <p class="mb-0 font-familyAtlasGroteskWeb-Regular text-colorblue200">Frequently Asked Questions</p>
                                </div>
                                <div class="col-lg-4 col-md-12 text-center">
                                    <div class="row justify-content-end no-gutters">
                                        <span class="font-size13px">
                                            <p class="mb-0 font-familyAtlasGroteskWeb-Medium text-colorblue200 opacity0point5">285</p>
                                            <p class="mb-0 font-familyAtlasGroteskWeb-Regular font-size12px text-colorblue200 opacity0point5">Threads</p>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col p-0">
                        <div class="col-md-12 bg-gray900 p-4">
                            <h6 class="text-black font-familyAtlasGroteskWeb-Bold mb-0">Admin</h6>
                        </div>
                        <div class="col-md-12 bg-lightWhite600 pr-4 pl-4 p-3 border-bottom mb-4">
                            <div class="row justify-content-between">
                                <div class="col-lg-6 col-md-12 d-flex align-self-center">
                                    <p class="mb-0 font-familyAtlasGroteskWeb-Regular text-colorblue200">Frequently Asked Questions</p>
                                </div>
                                <div class="col-lg-4 col-md-12 text-center">
                                    <div class="row justify-content-end no-gutters">
                                        <span class="font-size13px">
                                            <p class="mb-0 font-familyAtlasGroteskWeb-Medium text-colorblue200 opacity0point5">285</p>
                                            <p class="mb-0 font-familyAtlasGroteskWeb-Regular font-size12px text-colorblue200 opacity0point5">Threads</p>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer box-shadow">
                    <button type="button" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar">
                        <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">MOVE THREAD <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                        <div class="btn-bar"></div>
                    </button>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('style')
    <link href="{{ asset('css/textarea/jquery.classyedit.css') }}" rel="stylesheet">
@endsection

@section('script')
    <script src="{{ asset('js/textarea/jquery.classyedit.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".classy-editor").ClassyEdit();
        });
    </script>
@endsection
