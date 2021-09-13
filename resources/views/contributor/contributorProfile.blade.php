<!-- @extends('layouts.app')


@section('title') INET ED Platform :: View Profile @endsection

@section('content')
    @include('include.header')

    <section class="bg-white pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-9 mb-4">
                    <h3 class="text-black font-familyAtlasGroteskWeb-Bold mb-0">View Profile</h3>
                    <p class="font-familyAtlasGroteskWeb-Light text-colorblue200 font-size12px">Keep your profile informative and up to date.</p>
                    <div class="media mt-5 font-size14px">
                        <img class="mr-3" src="{{ asset('images/icons/img1.png') }}" alt="placeholder image" width="130">
                        <div class="media-body">
                            <h5 class="mt-0 font-familyAtlasGrotesk-Medium text-colorblue100 d-flex"><span class="align-self-center">Laura Dan</span> <span class="badge badge-secondary font-familyFreightTextProMedium-Italic font-size13px pl-3 pr-3 pt-2 ml-2 pb-2">Contributor</span></h5>
                            <p class="text-colorblue200 font-familyAtlasGroteskWeb-Regular">What does lorem ipsum means? and how it can be used in dummy text. What does lorem ipsum means? and how it can be used in dummy text.</p>

                            <div class="mt-3">
                                <a href="#" class="font-familyAtlasGroteskWeb-Regular text-colorblue200 font-size13px">ricksanchezworks.com</a>
                                <div class="mt-2">
                                    <a href="#" class="text-colorblue200"><i class="fab fa-twitter"></i></a>
                                    <a href="#" class="text-colorblue200 ml-3 mr-3"><i class="fab fa-youtube"></i></a>
                                    <a href="#" class="text-colorblue200"><i class="fas fa-globe"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 text-right mb-4">
                    <button type="button" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px p-0 border-radius0px btnBotmBar" data-toggle="modal" data-target="#moadalEditProfile">
                        <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">EDIT PROFILE <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                        <div class="btn-bar"></div>
                    </button>
                </div>

                <div class="col-md-12 p-0 mt-5">
                    <div class="col-md-12 list-groupCusMain mb-2">
                        <div class="list-group  font-familyAtlasGroteskWeb-Regular text-colorblue100 font-size14px border-bottom" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action active col-lg-2 col-md-3" id="list-contributions-list" data-toggle="list" href="#pg-contributions" role="tab" aria-controls="Contributions">Contributions</a>
                            <a class="list-group-item list-group-item-action col-lg-2 col-md-3" id="list-Threads-list" data-toggle="list" href="#pg-threads" role="tab" aria-controls="Threads">Threads</a>
                            <a class="list-group-item list-group-item-action col-lg-2 col-md-3" id="list-answers-list" data-toggle="list" href="#pg-answers" role="tab" aria-controls="Answers">Answers</a>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="pg-contributions" role="tabpanel" aria-labelledby="contributions">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 mb-3 d-flex bookmarkCheck">
                                        <div class="card col-12 p-0 border-radius0all">
                                            <img class="card-img-top" src="{{ asset('images/icons/img1-1.png') }}" alt="image">
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
                                            <img class="card-img-top" src="{{ asset('images/icons/img1-2.png') }}" alt="image">
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

                            <div class="tab-pane fade" id="pg-threads" role="tabpanel" aria-labelledby="threads">
                                <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0">Content Required</h6>
                            </div>

                            <div class="tab-pane fade" id="pg-answers" role="tabpanel" aria-labelledby="answers">
                                <h6 class="card-title font-familyAtlasGroteskWeb-Bold text-colorblue100 mb-0">Content Required</h6>
                            </div>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>

    @include('include.footer')


    Modal ADD COMMENT
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
                    <form>
                        <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customFileMain">
                            <label for="fullName" class="mb-0 text-colorblue100">Update Profile Picture</label>
                            <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">Change your profile picture (Profile picture can only be equal or less than 3mb)</p>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input col-md-4 p-0" id="uploadImg">
                                <label class="custom-file-label font-familyFreightTextProLight-Regular text-darkBlue font-size14px col-md-4 d-flex align-items-center justify-content-between" for="uploadImg">Upload</label>
                            </div>
                        </div>
                        <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3">
                            <label for="fullName" class="mb-0 text-colorblue100">Full Name</label>
                            <p class="font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">This is how your name your name will appear, and how admin and your students will recognize you.</p>
                            <input type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="fullName" placeholder="Name">
                        </div>
                        <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-5">
                            <label for="FormControlTextarea1" class="mb-0 text-colorblue100">About Me</label>
                            <div class="col-md-12 font-familyAtlasGroteskWeb-Light p-0 text-colorblue200 font-size13px">
                                <p class="float-left">Add Content description to help students discover and learn about your Content.</p>
                                <p class="float-right">0 / 160</p>
                            </div>
                            <textarea class="form-control font-familyFreightTextProLight-Regular text-darkBlue" id="FormControlTextarea1" placeholder="Content Description" rows="6" cols="260"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer box-shadow">
                    <button type="button" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar">
                        <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">Save <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                        <div class="btn-bar"></div>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
