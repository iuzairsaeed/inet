@extends('layouts.app')


@section('title') INET ED Platform :: Dashboard @endsection

@section('content')
    @include('include.header')

    <section class="bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-4 d-flex">
                    <div class="col-md-12 bg-lightWhite100 pt-5 pb-5">
                        <div class="col text-center border-bottom pb-4">
                            <img src="http://127.0.0.1:8000/images/icons/img1.png" alt="" width="150">
                            <h5 class="mt-0 font-familyAtlasGrotesk-Medium text-colorblue100 mt-2">Laura Dan</h5>
                            <span class="badge badge-secondary font-familyFreightTextProMedium-Italic font-size13px pl-3 pr-3 pt-2 pb-2">Admin</span>
                        </div>
                        <div class="col text-center mt-3">
                            <a href="#" class="font-familyAtlasGroteskWeb-Regular text-colorblue200 font-size13px">ricksanchezworks.com</a>
                            <div class="mt-2">
                                <a href="#" class="text-colorblue200"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="text-colorblue200 ml-3 mr-3"><i class="fab fa-youtube"></i></a>
                                <a href="#" class="text-colorblue200"><i class="fas fa-globe"></i></a>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-6 col-md-8 pt-5 pb-5 font-familyAtlasGroteskWeb-Regular text-colorblue100 font-size14px">
                    <h3 class="text-black font-familyAtlasGroteskWeb-Bold mb-0">View Profile</h3>
                    <p class="font-familyAtlasGroteskWeb-Light text-colorblue200 font-size12px">Keep your profile informative and up to date.</p>

                    <h5 class="font-familyAtlasGroteskWeb-Bold">About Me</h5>
                    <p>Rick Sanchez has a Masters in Economics from Hogwarts School of Economics and has worked as a
                        Business Analyst in Gringorts - one of the largest banking and financial services organizations in the
                        world.</p>
                    <p>He has done research projects in Education involving field work and analysis of data. He holds a diploma
                        in Financial Planning and has good understanding of Risk Management concepts and Financial
                        Instruments as well.</p>
                    <p>He loves teaching and has been teaching since his college days in one way or another. It was in 2015,
                        when he founded ‘The Economics and Statistics School' and started teaching full time and is now
                        teaching Economics and Statistics to many students online.His areas of specialization include
                        Economics, Statistics, Finance and Game theory.</p>
                </div>
                <div class="col-lg-2 col-md-12 pt-5 pb-5 text-right">
                    <button type="button" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px p-0 border-radius0px btnBotmBar" data-toggle="modal" data-target="#moadalEditProfile">
                        <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">EDIT PROFILE <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                        <div class="btn-bar"></div>
                    </button>
                </div>
            </div>
        </div>
    </section>

    @include('include.footer')


    <!-- Modal ADD COMMENT -->
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

