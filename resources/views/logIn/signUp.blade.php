<!-- @extends('layouts.app') @section('title') INET ED Platform :: Sign Up @endsection @section('content') @include('include.header')

<section class="pt-5 pb-5">
    <div class="container">
        <div class="row no-gutters justify-content-center">
            <div class="col-lg-4 col-md-5 d-flex bg-leftPanel">
                <div class="col-md-12 text-white font-familyFreightTextProLight-Regular p-5 font-size14px d-flex flex-column">
                    <h3 class="font-familyAtlasGroteskWeb-Bold mb-3">Help every student succeed with personalized practice.</h3>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</p>

                    <p class="mt-auto mb-0">By signing up for INET ED, you agree to our
                        <span class="font-familyFreightTextProMedium-Italic">Terms of use</span> and <span class="font-familyFreightTextProMedium-Italic">Privacy Policy</span></p>
                </div>
            </div>
            <div class="col-lg-6 col-md-7 bg-white box-shadow p-5 font-familyFreightTextProLight-Regular">
                <h3 class="font-familyAtlasGroteskWeb-Bold mb-3">Sign Up</h3>

                <div class="col-7 p-0 text-center mt-4">
                    <div class="list-group border list-groupCusSignUp flex-directionUnset" id="list-tab" role="tablist">
                        <a class="list-group-item p-2 list-group-item-action active transitionall text-colorblue200" id="list-home-list" data-toggle="list" href="#list-learner" role="tab" aria-controls="Learner">Learner</a>
                        <a class="list-group-item p-2 list-group-item-action transitionall text-colorblue200" id="list-profile-list" data-toggle="list" href="#list-contributor" role="tab" aria-controls="Contributor">Contributor</a>
                    </div>
                </div>
                <div class="col-12 p-0">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="list-learner" role="tabpanel" aria-labelledby="list-learner">
                            <form class="textHover">
                                <div class="field">
                                    <input type="text" id="name" name="name" class="field-input" required>
                                    <label for="name" class="field-label">Name</label>
                                </div>
                                <div class="field">
                                    <input type="text" id="email" name="email" class="field-input" required>
                                    <label for="email" class="field-label">Email</label>
                                </div>
                                <div class="field">
                                    <input type="text" id="password" name="password" class="field-input" required>
                                    <label for="password" class="field-label">Password</label>
                                </div>
                                <div class="field customDropDownSign">
                                    <select class="selectpicker">
                                            <option value="">Location</option>
                                            <option>item 1</option>
                                            <option>item 2</option>
                                            <option>item 3</option>
                                        </select>
                                </div>
                                <div class="form-group mt-4">
                                    <button type="button" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar">
                                            <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">SIGN UP <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                                            <div class="btn-bar"></div>
                                        </button>
                                </div>
                                <div class="form-group">
                                    <p class="text-black font-familyAtlasGroteskWeb-Light">Don’t have an Account? <a href="#" class="font-familyAtlasGroteskWeb-Regular text-colorMahroon700 mt-4">Sign Up</a></p>
                                </div>
                            </form>
                        </div>


                        <div class="tab-pane fade" id="list-contributor" role="tabpanel" aria-labelledby="list-contributor">
                            <form class="textHover">
                                <div class="field">
                                    <input type="text" id="name" name="name" class="field-input" required>
                                    <label for="name" class="field-label">Name</label>
                                </div>
                                <div class="field">
                                    <input type="text" id="email" name="email" class="field-input" required>
                                    <label for="email" class="field-label">Email</label>
                                </div>
                                <div class="field">
                                    <input type="text" id="password" name="password" class="field-input" required>
                                    <label for="password" class="field-label">Password</label>
                                </div>
                                <div class="field customDropDownSign">
                                    <select class="selectpicker">
                                            <option value="">Select Content Type You will Contribute</option>
                                            <option>item 1</option>
                                            <option>item 2</option>
                                            <option>item 3</option>
                                        </select>

                                </div>
                                <div class="field">
                                    <input type="text" id="contributorCode" name="contributorCode" class="field-input" required>
                                    <label for="contributorCode" class="field-label">Contributor Code (Optional)</label>
                                </div>
                                <div class="field customDropDownSign">
                                    <select class="selectpicker">
                                            <option value="">Location</option>
                                            <option>item 1</option>
                                            <option>item 2</option>
                                            <option>item 3</option>
                                        </select>
                                </div>
                                <div class="field">
                                    <input type="text" id="affiliation" name="affiliation" class="field-input" required>
                                    <label for="affiliation" class="field-label">Affiliation</label>
                                </div>
                                <div class="form-group mt-4">
                                    <button type="button" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar">
                                            <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">Next <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                                            <div class="btn-bar"></div>
                                        </button>
                                </div>
                                <div class="form-group">
                                    <p class="text-black font-familyAtlasGroteskWeb-Light">Don’t have an Account? <a href="#" class="font-familyAtlasGroteskWeb-Regular text-colorMahroon700 mt-4">Sign In</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('include.footer') @endsection -->