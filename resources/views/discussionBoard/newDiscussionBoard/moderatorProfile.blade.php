@extends('layouts.app')


@section('title') INET ED Platform :: View Profile @endsection

@section('content')
    @include('include.header')

    <section class="bg-white pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-9 pb-5 ">
                    <div class="media font-size14px">
                        <div class="thumbnailImg_WHNew1 thumbnailImg overflow-hidden" style="background: url('images/icons/img2.png') no-repeat; background-size: cover;">
                        </div>
                        <div class="media-body align-self-center">
                            <h5 class="mt-0 font-familyAtlasGrotesk-Medium text-colorblue100 d-flex"><span class="align-self-center">Niko Tim</span> <span class="badge badge-secondary font-familyFreightTextProMedium-Italic font-size13px pl-3 pr-3 pt-2 ml-2 pb-2">Student</span> <span class="align-self-center text-colorblue200 opacity0point5 mr-2 ml-2">|</span>
                                <img src="{{ asset('images/icons/Icon-M.png') }}" alt="" class="align-self-center mr-1">
                                <span class="text-colorblue200 font-familyFreightTextProLight-Regular font-size13px opacity0point5 align-self-center">Moderator</span>
                            </h5>
                            <p class="text-colorblue200 font-familyAtlasGroteskWeb-Regular">Morty Maxel has a Masters in Economics from Hogwarts School of Economics and has worked as a
                                Business Analyst in Gringorts. <a href="https://ricksanchezworks.com">https://ricksanchezworks.com</a></p>

                            <div class="mt-3">
                                <div class="mt-2">
                                    <a href="#" class="text-colorblue200"><i class="fab fa-twitter"></i></a>
                                    <a href="#" class="text-colorblue200 ml-3 mr-3"><i class="fab fa-youtube"></i></a>
                                    <a href="#" class="text-colorblue200"><i class="fas fa-globe"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 text-right">
                    <button type="button" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px p-0 border-radius0px btnBotmBar" data-toggle="modal" data-target="#">
                    <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">EDIT PROFILE <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                    <div class="btn-bar"></div>
                    </button>
                </div>

                <div class="col-md-12 list-groupCusMain mb-2">
                    <div class="list-group  font-familyAtlasGroteskWeb-Regular text-colorblue100 font-size14px border-bottom" id="list-tab" role="tablist">
                        <a class="list-group-item col-lg-2 col-md-3 list-group-item-action active text-center" id="list-Bookmarks-list" data-toggle="list" href="#pg-bookmarks" role="tab" aria-controls="Bookmarks"><p class="mb-0 font-familyAtlasGroteskWeb-Bold text-colorblue100">3</p>Bookmarks</a>
                        <a class="list-group-item col-lg-2 col-md-3 list-group-item-action text-center" id="list-Threads-list" data-toggle="list" href="#pg-threads" role="tab" aria-controls="Threads"><p class="mb-0 font-familyAtlasGroteskWeb-Bold text-colorblue100">2</p>Threads</a>
                        <a class="list-group-item col-lg-2 col-md-3 list-group-item-action text-center" id="list-Posts-list" data-toggle="list" href="#pg-posts" role="tab" aria-controls="Posts"><p class="mb-0 font-familyAtlasGroteskWeb-Bold text-colorblue100">2.5k</p>Posts</a>
                        <a class="list-group-item list-group-item-action font-familyAtlasGroteskWeb-Bold font-size12px text-right pr-0 text-ferozy align-self-end" href="#"><i class="fas fa-circle text-ferozy mr-2"></i>Active Now</a>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active mt-4" id="pg-bookmarks" role="tabpanel" aria-labelledby="Bookmarks">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 mb-3 d-flex bookmarkCheck">
                                    <div class="card col-12 p-0 border-radius0all">
                                        <div class="thumbnailImg_WHNewCard overflow-hidden" style="background: url('images/icons/img1-1.png') no-repeat; background-size: cover;"></div>
                                        <div class="card-header bg-transparent border-0 pb-0 pt-2 font-size14px font-familyAtlasGroteskWeb-Medium text-colorblue200">
                                            <small class="float-left">Introductory Level 1</small>
                                            <small class="float-right">26m</small>
                                        </div>
                                        <div class="card-body">
                                            <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0">Microeconomics: The Truth About Prices</h6>
                                            <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">Jerry Smith</small></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 mb-3 d-flex bookmarkCheck">
                                    <div class="card col-12 p-0 border-radius0all">
                                        <div class="thumbnailImg_WHNewCard overflow-hidden" style="background: url('images/icons/img1-2.png') no-repeat; background-size: cover;"></div>
                                        <div class="card-header bg-transparent border-0 pb-0 pt-2 font-size14px font-familyAtlasGroteskWeb-Medium text-colorblue200">
                                            <small class="float-left">Advanced Undergraduate</small>
                                            <small class="float-right">32m</small>
                                        </div>
                                        <div class="card-body">
                                            <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0">Microeconomics: The Truth About Prices</h6>
                                            <p class="card-text"><small class="font-familyAtlasGroteskWeb-Regular text-colorblue200">Jerry Smith</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="pg-threads" role="tabpanel" aria-labelledby="Threads">
                            <h6 class="mt-5 mb-5">Threads Content Not Available</h6>
                        </div>

                        <div class="tab-pane fade" id="pg-posts" role="tabpanel" aria-labelledby="Posts">
                            <h6 class="mt-5 mb-5">Posts Content Not Available</h6>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    @include('include.footer')


    <!-- Modal Assign Rank -->
    <div class="modal fade p-0" id="moadalAssignRank" tabindex="-1" role="dialog" aria-labelledby="moadalAssignRank" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered max-width690px p-md-0 p-3" role="document">
            <div class="modal-content border-radius0px">
                <div class="modal-header p-4">
                    <h6 class="modal-title font-familyAtlasGroteskWeb-Bold text-colorblue100" id="moadalAssignRank">ASSIGN RANK</h6>
                    <button type="button" class="close outlineNone text-colorMahroon700" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <form>
                        <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg">
                            <label for="chooseRank" class="mb-0 text-colorblue100">Choose Rank</label>
                            <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Assign Rank from below drop-down.</p>
                            <select class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue">
                                <option value="">Select Rank</option>
                                <option>item 1</option>
                                <option>item 2</option>
                                <option>item 3</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer box-shadow">
                    <button type="button" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar">
                        <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">ASSIGN RANK <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                        <div class="btn-bar"></div>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

