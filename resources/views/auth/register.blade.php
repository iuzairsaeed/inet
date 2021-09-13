@extends('layouts.app') @section('title') INET ED Platform :: Sign Up @endsection @section('content') @include('include.header')
<style>
    .invalid-feedback {
        display: block;
    }
    html {
    scroll-padding-top: 50px;
    }
</style>
<section class="pt-5 pb-5">
    <div class="container">
        <div class="row no-gutters justify-content-center">
            <div class="col-lg-4 col-md-5 d-flex bg-leftPanel">
                <div class="col-md-12 text-white font-familyFreightTextProLight-Regular p-5 font-size14px d-flex flex-column">
                    <h3 id="headingSignUp" class="font-familyAtlasGroteskWeb-Bold mb-3">Join our Community Today!</h3>
                    <p id="textSignUp">Create your account.  Keep track of your learning experience and talk to other community members.</p>

                    <p class="mt-auto mb-0">By signing up for INET ED, you agree to our
                        <a href="{{ route('termsConditions') }}" class="text-white"><span class="font-familyFreightTextProMedium-Italic">Terms of Service</span></a>,
                        <a href="privacyPolicy" class="text-white"><span class="font-familyFreightTextProMedium-Italic">Privacy Policy</span></a> and
                        <a href="{{ route('coummunity') }}" class="text-white"><span class="font-familyFreightTextProMedium-Italic">Community Guidelines</span></a>
                   </p>

            </div>
            </div>
            <div class="col-lg-6 col-md-7 bg-white box-shadow p-5 font-familyFreightTextProLight-Regular animated fadeIn" id="signUp">
                <h3 class="font-familyAtlasGroteskWeb-Bold mb-3">Sign Up</h3>

                <div class="col-7 p-0 text-center mt-4">
                    <div class="list-group border list-groupCusSignUp flex-directionUnset" id="list-tab" role="tablist">
                        <a class="list-group-item p-2 list-group-item-action transitionall text-colorblue200 {{ (!request()->get('switch')) ? 'active' : '' }}" id="list-home-list" data-toggle="list" href="#list-learner" role="tab" aria-controls="Learner" onclick="txtchnage('Join our Community Today!','Create your account.  Keep track of your learning experience and talk to other community members.')">Learner</a>
                        <a class="list-group-item p-2 list-group-item-action transitionall text-colorblue200 {{ (request()->get('switch')) ? 'active' : '' }}" id="list-profile-list" data-toggle="list" href="#list-contributor" role="tab" aria-controls="Contributor" onclick="txtchnage('Help every student succeed with personalized practice.','Create your account.  Help us change the way economics is taught and learned.')">Teacher</a>
                    </div>
                </div>
                <div class="col-12 p-0">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade {{ (!request()->get('switch')) ? 'show active' : '' }}" id="list-learner" role="tabpanel" aria-labelledby="list-learner">
                            <form class="textHover" method="POST" action="{{ route('register') }}">
                                @csrf
                                <input type="hidden" id="role_id" name="role_id" value="2">
                                <div class="field">
                                    <input type="text" id="firstname" name="fname" class="field-input @error('fname') is-invalid @enderror" value="{{ old('fname') }}" required autocomplete="firstname" autofocus>
                                    <label for="firstname" class="field-label">First Name</label>
                                </div>
                                @error('fname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                 @enderror

                                <div class="field">
                                    <input type="text" id="lname" name="lname" class="field-input @error('lname') is-invalid @enderror" value="{{ old('lname') }}" required autocomplete="name" autofocus>
                                    <label for="name" class="field-label">Last Name</label>
                                </div>
                                @error('lname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                 @enderror

                                <div class="field customDropDownSign">
                                    <select class="selectpicker" name="gender_std"  id="gender_std" required>
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Non-Binary">Non-Binary</option>
                                        <option value="I-Prefer-not-to-answer">I Prefer not to answer</option>
                                    </select>
                                </div>
                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                 @enderror



                                <div class="field">
                                    <input type="text" id="email" name="email" class="field-input @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <label for="email" class="field-label">Email</label>
                                </div>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span> @enderror

                                <div class="field">
                                    <input type="password" id="password" name="password" class="field-input @error('password') is-invalid @enderror" required autocomplete="new-password">
                                    <label for="password" class="field-label">Password</label>
                                </div>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span> @enderror
                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span> @enderror

                                <div class="field">
                                    <input type="password" id="password-confirm" name="password_confirmation" class="field-input" required autocomplete="new-password">
                                    <label for="password" class="field-label">Confirm Password</label>
                                </div>


                                <div class="field customDropDownSign">
                                    <select id="country" class="selectpicker crs-country" data-region-id="countryRegion" required name="country"></select>
                                </div>
                                @error('country')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span> @enderror

                                <!-- <div class="field customDropDownSign">
                                    <select class="selectpicker" id="countryRegion" required name="region" title="Select Region"></select>
                                </div>
                                @error('region')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror -->

                                <div class="field">
                                    <input type="checkbox" name="terms" id="terms" required oninvalid="this.setCustomValidity('You must be agree with Terms of Service')" oninput="setCustomValidity('')">  I Agree <a href="#" data-toggle="modal" data-target="#termsofservice">Terms of Service</a>
                                </div>



                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar" onclick="">
                                            <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">SIGN UP <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                                            <div class="btn-bar"></div>
                                    </button>
                                </div>

                                <div class="form-group">
                                    <p class="text-black font-familyAtlasGroteskWeb-Light">Already have an account? <a href="{{ route('login') }}" class="font-familyAtlasGroteskWeb-Regular text-colorMahroon700 mt-4">Login</a></p>
                                </div>
                            </form>
                        </div>


                        <div class="tab-pane fade {{ (request()->get('switch')) ? 'show active' : '' }}" id="list-contributor" role="tabpanel" aria-labelledby="list-contributor">
                            <form class="textHover" method="POST" action="{{ route('register') }}">
                                @csrf
                                <input type="hidden" id="role_id" name="role_id" value="3">
                                <div class="field">
                                    <input type="text" id="con_fname" name="con_fname" class="field-input @error('con_fname') is-invalid @enderror" value="{{ old('con_fname') }}" required autocomplete="con_Fname" autofocus>
                                    <label for="con_fname" class="field-label">First Name</label>
                                </div>
                                @error('con_fname')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span> @enderror

                                <div class="field">
                                    <input type="text" id="con_lname" name="con_lname" class="field-input @error('con_lname') is-invalid @enderror" value="{{ old('con_lname') }}" required autocomplete="con_name" autofocus>
                                    <label for="con_lname" class="field-label">Last Name</label>
                                </div>
                                @error('con_lname')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror


                                <div class="field customDropDownSign">
                                    <select class="selectpicker" name="gender_con"  id="gender_con" required>
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Non-Binary">Non-Binary</option>
                                        <option value="I-Prefer-not-to-answer">I Prefer not to answer</option>
                                        
                                    </select>
                                </div>
                                @error('gender_con')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                 @enderror




                                <div class="field">
                                    <input type="text" id="con_email" name="con_email" class="field-input @error('con_email') is-invalid @enderror" value="{{ old('con_email') }}" required autocomplete="con_email" autofocus>
                                    <label for="con_email" class="field-label">Email</label>
                                </div>
                                @error('con_email')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span> @enderror

                                <div class="field">
                                    <input type="password" id="con_password" name="con_password" class="field-input @error('con_password') is-invalid @enderror" required autocomplete="con_new-password">
                                    <label for="con_password" class="field-label">Password</label>
                                </div>
                                @error('con_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span> @enderror
                                @error('con_password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span> @enderror

                                <div class="field">
                                    <input type="password" id="con_password_confirmation" name="con_password_confirmation" class="field-input" required autocomplete="con_new-password">
                                    <label for="con_password_confirmation" class="field-label">Confirm Password</label>
                                </div>

                                {{-- <div class="field">
                                    <input type="text" id="con_content_type" name="con_content_type" class="field-input rmAddRequired" required  value="{{ old('con_content_type') }}">
                                    <label for="con_content_type" class="field-label">Content Type You will Contribute</label>
                                </div> --}}
                                {{-- @error('con_content_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span> @enderror --}}

                                <!-- <div class="field">
                                    <input type="text" id="con_contributor_code" name="con_contributor_code" class="field-input rmAddRequired" required value="{{ old('con_contributor_code') }}">
                                    <label for="con_contributor_code" class="field-label">Teacher Code (Optional)</label>
                                </div>
                                @error('con_contributor_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span> @enderror -->

                                <div class="field customDropDownSign">
                                    <select id="con-country" class="selectpicker crs-country" data-region-id="con-countryRegion" required name="con_country"></select>
                                </div>

                                @error('con_country')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span> @enderror

                                <!-- <div class="field customDropDownSign">
                                 <select class="selectpicker" id="con-countryRegion" required name="con_region" title="Select Region"></select>
                                </div>
                                @error('con_region')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>

                                </span>
                                @enderror -->



                                <div class="field">
                                    <input type="text" id="con_affiliation" name="con_affiliation" class="field-input" value="{{ old('con_affiliation') }}" required autofocus>
                                    <label for="con_affiliation" class="field-label">Affiliation</label>
                                </div>
                                @error('con_affiliation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                 @enderror

                                 <div class="field">
                                    <input type="checkbox" name="terms2" id="terms2" required oninvalid="this.setCustomValidity('You must be agree with Terms of Service')" oninput="setCustomValidity('')">  I Agree <a href="#" data-toggle="modal" data-target="#termsofservice">Terms of Service</a>
                                </div>

                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar" onclick="removeAdd_required()">
                                            <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">SIGN UP <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                                            <div class="btn-bar"></div>
                                        </button>
                                </div>
                                <div class="form-group">
                                    <p class="text-black font-familyAtlasGroteskWeb-Light">Already have an account? <a href="{{ route('login') }}" class="font-familyAtlasGroteskWeb-Regular text-colorMahroon700 mt-4">Login</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-7 bg-white box-shadow p-5 font-familyFreightTextProLight-Regular animated fadeIn" id="TermsAndConditions" style="display: none">
                <h3 class="font-familyAtlasGroteskWeb-Bold mb-3">Terms of Service</h3>
                <div class="col-md-12 p-0 pr-3 overflow-hidden overflow-yScroll height45em">
                    <h6 class="font-familyAtlasGroteskWeb-Bold">Acceptance of Terms</h6>
                    <p>These Terms of Service (this “<b>Agreement</b>”) is made between <b>you</b> and <b>The Institute for New Economic Thinking (“INET”)</b>, under which you, the user, may use the platform INET ED. By using <b>INET ED</b>, you acknowledge and agree to the terms and conditions of use set forth below in this Agreement:</p>

                    <h5 class="font-familyAtlasGroteskWeb-Bold">General Information about INET ED</h5>
                    <p>INET ED is a service that allows you to use and share educational and teaching resources, materials and other content, to improve economics education, and provides a forum for users to connect and share ideas and information related to economics and new and critical ways of thinking about the economy. Your use of the service is subject to <a href="#">INET’s Community Guidelines</a> and this Agreement.</p>

                    <h5 class="font-familyAtlasGroteskWeb-Bold">Your Use of INET ED</h5>
                    <p>The contents of INET ED, including but not limited to all materials, information, publications, text, documents, databases, data, graphics, graphs, images, charts, photographs, illustrations, audio material, and audiovisual material (the “<b>Content</b>”) may be used by you only as stated below, for noncommercial purposes only. INET ED is protected by copyright as a collective work or compilation. All Content contained on INET ED is protected by copyright, and is owned or controlled by INET or the party or user that provides it. Unauthorized use may violate copyright, trademark, or other laws.
                    </p>
                    <p>You are authorized to use the Content <b>only</b> as follows:</p>
                    <ul>
                       <li> <i> if you are a teacher or instructor:</i> you may freely download, distribute, display, copy and otherwise use the Content, and you may prepare, publish, and distribute derivative works based on the Content, only for classroom, instructional, or teaching purposes (“ <b>Educational Purposes</b>”).  You may allow others to copy, distribute, publish, display, use, and prepare derivative works based on the Content only for Educational Purposes. You may also download, use, and copy the Content for your own noncommercial personal use;
                    </li>
                       <li><i> if you are a learner, student or other non-teacher user:</i> you may freely download, copy, and use the Content on INET ED only for your own personal, noncommercial use, unless you have obtained prior written permission from INET; and
                    </li>
                       <li><i>in all cases:</i> you must maintain all copyright notices, credits, attributions, and other notices contained in the Content, you must abide by any restrictions, copyright notices, or information contained in any Content, and you may not make any commercial use of the Content. </li>
                    </ul>

                    <h5 class="font-familyAtlasGroteskWeb-Bold">Additional Restrictions on Use</h5>
                    <p>Additional Restrictions on Use. We encourage you to develop a community here and that means treating one another with respect and sensitivity. Users will abide by the “Community Guidelines” applicable to INET ED located at It is important to us that you do not contribute anything that could be offensive or derogatory. You agree that you will not upload, post, transmit to or distribute, or otherwise publish through INET ED any materials that:</p>

                    <ul>
                        <li>restrict or inhibit any other user from using and enjoying INET ED;</li>
                        <li>are unlawful, threatening, abusive, libelous, defamatory, obscene, vulgar, offensive, pornographic, profane, sexually explicit, or indecent;</li>
                        <li>constitute or encourage conduct that would constitute a criminal offense, give rise to civil liability, or otherwise violate law;</li>
                        <li>violate, plagiarize, or infringe the rights of third parties including without limitation copyright, trademark, patent, rights of privacy or publicity, or any other proprietary right;</li>
                        <li>contain a virus or other harmful components;</li>
                        <li>contain any information, software, or other material of a commercial nature;</li>
                        <li>contain advertising for commercial goods and services; or</li>
                        <li>constitute or contain false or misleading indications of origin or statements of fact.</li>
                    </ul>
                    <p>You will not circumvent, disable, fraudulently engage with, or otherwise interfere with any part of INET ED (or attempt to do any of these things), including security-related features or features that (a) prevent or restrict the copying or other use of Content or (b) limit the use of INET ED or Content.
                    </p>
                    <p>Consider folding the above prohibitions into the Community Guidelines, in order to make this more concise</p>
                    <p>INET will remove from INET ED any Content it believes violates these terms, and your account may be subject to termination. </p>

                    <h5 class="font-familyAtlasGroteskWeb-Bold">Representation and Warranty with Regard to Age</h5>
                    <p>You represent and warrant that you are at least 16 years old. </p>

                    <h5 class="font-familyAtlasGroteskWeb-Bold">Submission of Contributions to INET ED</h5>
                    <p>To achieve the goals and purposes of INET ED, qualified users may submit for posting to INET ED teaching materials, resources, files, documents, audiovisual material, graphs, charts, electronic files, data, messages, postings, and other content (“<b>Contributions</b>”) via the INET ED platform. While it is important to us that you maintain ownership rights in your Contributions, in order to operate INET ED for its intended purposes, we do require a grant of certain rights to INET ED and to other users. This section governs the terms under which you provide Contributions or communications to INET ED:</p>

                    <ul>
                        <li><u>License to INET ED.</u>  By providing Contributions or engaging in any other form of communication with or to INET ED or other users, you hereby grant to INET a perpetual, worldwide, royalty-free, nonexclusive, sublicenseable, and transferable license to copy, display, post, reproduce, transmit, publish, perform, modify, adapt, prepare derivative works based on, and otherwise use your Contributions in furtherance of the purposes of INET ED.</li>
                        <li><u>License to other users.</u> In order for users of INET ED to share resources, information, and ideas, and to facilitate the purposes of INET ED, you hereby grant each user of INET ED a perpetual, worldwide, royalty-free, nonexclusive, sublicenseable, and transferable license to access, copy, display, post, reproduce, transmit, publish, perform, modify, adapt, prepare derivative works based on, and otherwise use your Contributions in furtherance of the purposes of INET ED and in accordance with the Community Guidelines and this Agreement. You acknowledge and agree that users may use your Contributions in the manner permitted in Section 2 of this Agreement.</li>
                        <li><u>Posting and removal of Contributions.</u> INET ED has no obligation to use, upload or post on INET ED, or return to you, any Contributions you submit.  INET ED may remove your Contributions in its sole discretion. You may request removal of your Contributions from INET ED by submitting a written request to <a href="#">ineted@ineteconomics.org</a>. You must notify INET ED and request removal of Content if you no longer have the rights to such Content. The licenses granted by you continue for a commercially reasonable period of time after your Content is removed from INET ED.</li>
                        <li><u>You must own or have the right to use your Contributions.</u>  You will not submit Contributions or other material that you don’t own or don’t have the right to use. You are legally responsible for the Contributions you submit to INET ED. You hereby represent and warrant to INET ED that your Contributions do not infringe the proprietary right of any other person, that you have the rights you are granting under this Agreement, and that you have the power and authority to grant those rights.</li>
                        <li><u>Waiver of infringement claims against INET.</u>  You hereby waive all rights to any claim against INET or INET ED for any alleged or actual infringements of any proprietary rights, rights of privacy and publicity, moral rights, and rights of attribution in connection with your Contributions.</li>
                    </ul>

                    <h5 class="font-familyAtlasGroteskWeb-Bold">No Confidentiality</h5>
                    <p>You acknowledge that when you post or upload Contributions to INET ED, or otherwise use the functions of INET ED, those Contributions are not confidential and your Contributions may be available to and read by other users. You acknowledge that by submitting Contributions to INET ED, no confidential, fiduciary, contractually implied, or other relationship is created between you and INET other than in accordance with this Agreement. You acknowledge that if you opt to include your name or other identifying information as part of or in any Contributions, that information may be available to users and will not be confidential.</p>

                    <h5 class="font-familyAtlasGroteskWeb-Bold">Personal information; Privacy</h5>
                    <p>Your privacy is extremely important to us. INET’s use of personal information collected from and about you in connection with your use of INET ED is governed by a Privacy Policy, available here: As part of this Agreement you agree to the Privacy Policy. </p>

                    <h5 class="font-familyAtlasGroteskWeb-Bold">Commitment to Data Security</h5>
                    <p>To prevent unauthorized access, maintain data accuracy, and ensure the correct use of information, INET has put in place appropriate physical, electronic, and managerial procedures to safeguard and secure the information collected on INET ED. Please notify INET if you believe your account’s security has been compromised in any way.</p>

                    <h5 class="font-familyAtlasGroteskWeb-Bold">Changes to the Website</h5>
                    <p> INET may change, suspend, or discontinue any aspect of INET ED at any time, including the availability of any feature, database, or other Content. INET may also impose limits on certain features and services or restrict your access to parts or all of INET ED without notice or liability. INET will try to give you notice of any changes to INET ED but you are responsible for reading and understanding them as they occur.</p>

                    <h5 class="font-familyAtlasGroteskWeb-Bold">Termination</h5>
                    <p>So long as you do not violate the terms of this Agreement, you may participate in INET ED. But we reserve the right to suspend or terminate your account for any violation of these terms at INET’s sole discretion.</p>

                    <h5 class="font-familyAtlasGroteskWeb-Bold">Limitation of Liability</h5>
                    <p>In no event will INET, INET ED, its affiliates, subsidiaries, and related companies, and partners, or any of their directors, officers, employees, shareholders, representatives, or agents (collectively “<b>The INET Parties</b>”) be responsible or liable for any damages or losses of any kind, including direct, indirect, incidental, consequential, special, or punitive damages arising out of your access to or use of INET ED (including without limitation the Content and any errors contained therein).</p>

                    <h5 class="font-familyAtlasGroteskWeb-Bold">Indemnification</h5>
                    <p>You will indemnify, defend, and hold the INET Parties harmless from and against any and all claims, liabilities, suits, losses, damages, and expenses, including without limitation costs and attorney’s fees (collectively “<b>Claims</b>”) arising out of (a) any breach by you of any term of this Agreement, (b) any breach by you of any representation, warranty or covenant made by you in this Agreement, or (c) any Claims that any of your Contributions infringes, misappropriates, or otherwise violates any intellectual property rights or other rights of any third party. You will cooperate as fully as reasonably required in the defense of any claim. INET reserves the right, at its own expense, to assume the exclusive defense and control of any matter otherwise subject to indemnification by you, and you will not in any event settle any matter without the written consent of INET.
                    </p>

                    <h5 class="font-familyAtlasGroteskWeb-Bold">Disclaimer of Warranties</h5>
                    <p>INET ED, including all Content, documents, software, functions, materials, and information made available on or accessed through INET ED, is provided “as is.” To the fullest extent permissible by law, INET and affiliates make no representation or warranties of any kind whatsoever for the content on INET ED or the materials, information, and functions made accessible by the software used on or accessed through INET ED, for any products or services or hypertext links to third parties, or for any breach of security associated with the transmission of sensitive information through INET ED or any linked site. Further, INET and its affiliates disclaim any express or implied warranties, including without limitation noninfringement, merchantability, or fitness for a particular purpose. INET does not warrant that the functions contained on INET ED or any materials or content contained therein will be uninterrupted or error free, that defects will be corrected, or that INET ED or the server that makes it available is free of viruses or other harmful components. INET and its affiliates are not liable for your use of INET ED, including without limitation the Content and any errors contained therein.</p>

                    <h5 class="font-familyAtlasGroteskWeb-Bold">Site-Content Disclaimer</h5>
                    <p>INET does not represent or endorse the accuracy or reliability of any information displayed or distributed through INET ED, and INET disclaims any and all responsibility for content contained in any third-party materials provided through links from INET ED. You acknowledge that any reliance upon any such opinion, advice, statement, memorandum, or information is at your sole risk. INET reserves the right, in its sole discretion, to correct any errors or omissions in any portion of INET ED at any time. INET may change, suspend, or continue any aspect of INET ED at any time, or limit certain features and services without liability.</p>

                    <h5 class="font-familyAtlasGroteskWeb-Bold">User-Content Disclaimer</h5>
                    <p>INET is not responsible for materials posted by users. INET reserves the right at all times to disclose any information as necessary to satisfy any law, regulation, or government request, or to edit, refuse to post, or to remove any information or materials, in whole or in part, that in INET’s sole discretion are objectionable or in violation of this Agreement.
                    </p>

                    <h5 class="font-familyAtlasGroteskWeb-Bold">Third-Party Resources Disclaimer</h5>
                    <p>INET ED may contain links and pointers to other Internet sites and resources and to parties affiliated with INET ED. Links to and from INET ED to third-party sites do not constitute an endorsement by INET or its affiliates of any third-party resources or their contents.</p>


                    <h5 class="font-familyAtlasGroteskWeb-Bold">Copyright Protection</h5>
                    <p>INET ED respects the intellectual property rights of others. It is the policy of INET ED to respond promptly to notices of alleged copyright infringement that comply with the law. INET ED reserves the right to delete or disable content alleged to be infringing and terminate the accounts of repeat infringers. Potential infringement should be reported per our Digital Millennium Copyright Act (“<b>DMCA</b>”) Policy below. Our Designated Agent (“<b>Designated Agent</b>”) under the DMCA is:
                    <br><br>
                    Copyright Agent<br>
                    INET ED<br>
                    300 Park Avenue South, 5th Floor<br>
                    New York, NY 10010<br>
                    copyright@ineteconomics.org<br>
                    646-751-4900<br></p>

                    <h5 class="font-familyAtlasGroteskWeb-Bold">DMCA Policy</h5>
                    <p>Copyright owners, or those authorized to act on behalf of one or authorized to act under any exclusive right of copyright, may report alleged copyright infringement occurring on the INET ED platform by completing the following DMCA Notice of Alleged Infringement (the “Notice”) and delivering it to the Designated Agent. Any such Notice must:
                    </p>

                    <ul>
                        <li>Identify the copyrighted work for which infringement is claimed. If the Notice is intended to cover multiple copyrighted works, you may provide a representative list of the copyrighted works for which infringement is claimed.</li>
                        <li>Identify the material or link that you claim is infringing the copyrighted work and for which you wish access to be disabled. At minimum, this includes the URL of the link shown on INET ED or the exact location where the material may be found.</li>
                        <li>Provide your company affiliation (if applicable), mailing address, telephone number, and, if available, email address.</li>
                        <li>Include both of the following statements in the body of the Notice:
                            <ul>
                                <li>“I hereby state that I have a good faith belief that the disputed use of the copyrighted material is not authorized by the copyright owners, its agent, or the law (e.g., as a fair use).”</li>
                                <li>“I hereby state the information in this Notice is accurate and, under penalty of perjury, that I am the owner, or authorized to act on behalf of, the owner, of the copyright or of an exclusive right under the copyright that is allegedly infringed.” </li>
                            </ul>
                        </li>
                        <li>Provide your full legal name and your electronic or physical signature.</li>
                    </ul>

                    <h5 class="font-familyAtlasGroteskWeb-Bold">Administrative Provisions</h5>

                    <ul>
                        <li><b>Entire Agreement.</b> This Agreement constitutes the entire agreement between INET and you with respect to your use of INET ED. If for any reason a court of competent jurisdiction finds any provision of this Agreement, or portion thereof, to be unenforceable, that provision must be enforced to the maximum extent permissible so as to effect the intent of this Agreement, and the remainder of this Agreement continues in full force and effect.
                        </li>
                        <li><b>Changes to this Agreement.</b> INET reserves the right, at its sole discretion, to change, modify, add or remove any portion of this Agreement, in whole or in part, at any time. Notification of changes in this Agreement will be posted on INET ED.
                        </li>
                        <li><b>Choice of Law; Jurisdiction.</b>  This Agreement is governed by and construed in accordance with the laws of the state of New York without regard to its conflicts-of-laws provisions. Sole and exclusive jurisdiction for any action or proceeding arising out of or related to this Agreement is in an appropriate state or federal court located in New York. Any cause of action you may have with respect to your use of INET ED must be commenced within one year after the claim or cause of action arises.
                        </li>
                        <li><b>Contact Information.</b> You may contact us through any of the following ways:
                            <ul>
                                <li><b>By Email:</b>
                                    <br>
                                    ineted@ineteconomics.org
                                </li>
                                <li>
                                    <b>By Mail:</b>
                                    <br>
                                    300 Park Avenue South, 5th Floor, New York, NY 10010
                                </li>
                                <li>
                                    <b>By Phone:</b>
                                    <br>
                                    646-751-4900
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="row justify-content-between">
                        <div class="form-group mt-5 mb-0">
                            <button type="submit" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar">
                                <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">Accept <i class="fas fa-check ml-3 text-colorMahroon100"></i></span>
                                <div class="btn-bar"></div>
                            </button>
                        </div>

                        <div class="form-group mt-5 mb-0">
                            <button type="button" class="btn btn-customBtn3 text-colorMahroon700 font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar ml-3 " onclick="signUpOpen()">
                                <span class="pt-2 pb-2 pl-4 pr-4 mb-0 d-block">DECLINE <i class="fas fa-times ml-3 text-colorMahroon100"></i></span>
                                <div class="btn-bar"></div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</section>

{{-- Terms of service modal --}}
<div class="modal fade p-0" id="termsofservice" tabindex="-1" role="dialog" aria-labelledby="moadalAddNewCourse" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered max-width790px p-md-0 p-3" role="document">
            <div class="form-container modal-content border-radius0px">
                    <div class="modal-header p-4">
                        <h6 class="modal-title font-familyAtlasGroteskWeb-Bold text-colorblue100 text-uppercase" id="moadalAddNewCont2">Terms of Service</h6>
                        <button type="button" class="close outlineNone text-colorMahroon700" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-12 p-4 pr-3 overflow-hidden overflow-yScroll height45em">
                            <h6 class="font-familyAtlasGroteskWeb-Bold">Acceptance of Terms</h6>
                            <p>These Terms of Service (this “<b>Agreement</b>”) is made between <b>you</b> and <b>The Institute for New Economic Thinking (“INET”)</b>, under which you, the user, may use the platform INET ED. By using <b>INET ED</b>, you acknowledge and agree to the terms and conditions of use set forth below in this Agreement:</p>

                            <h5 class="font-familyAtlasGroteskWeb-Bold">General Information about INET ED</h5>
                            <p>INET ED is a service that allows you to use and share educational and teaching resources, materials and other content, to improve economics education, and provides a forum for users to connect and share ideas and information related to economics and new and critical ways of thinking about the economy. Your use of the service is subject to <a href="#">INET’s Community Guidelines</a> and this Agreement.</p>

                            <h5 class="font-familyAtlasGroteskWeb-Bold">Your Use of INET ED</h5>
                            <p>The contents of INET ED, including but not limited to all materials, information, publications, text, documents, databases, data, graphics, graphs, images, charts, photographs, illustrations, audio material, and audiovisual material (the “<b>Content</b>”) may be used by you only as stated below, for noncommercial purposes only. INET ED is protected by copyright as a collective work or compilation. All Content contained on INET ED is protected by copyright, and is owned or controlled by INET or the party or user that provides it. Unauthorized use may violate copyright, trademark, or other laws.
                            </p>
                            <p>You are authorized to use the Content <b>only</b> as follows:</p>
                            <ul>
                               <li> <i> if you are a teacher or instructor:</i> you may freely download, distribute, display, copy and otherwise use the Content, and you may prepare, publish, and distribute derivative works based on the Content, only for classroom, instructional, or teaching purposes (“ <b>Educational Purposes</b>”).  You may allow others to copy, distribute, publish, display, use, and prepare derivative works based on the Content only for Educational Purposes. You may also download, use, and copy the Content for your own noncommercial personal use;
                            </li>
                               <li><i> if you are a learner, student or other non-teacher user:</i> you may freely download, copy, and use the Content on INET ED only for your own personal, noncommercial use, unless you have obtained prior written permission from INET; and
                            </li>
                               <li><i>in all cases:</i> you must maintain all copyright notices, credits, attributions, and other notices contained in the Content, you must abide by any restrictions, copyright notices, or information contained in any Content, and you may not make any commercial use of the Content. </li>
                            </ul>

                            <h5 class="font-familyAtlasGroteskWeb-Bold">Additional Restrictions on Use</h5>
                            <p>Additional Restrictions on Use. We encourage you to develop a community here and that means treating one another with respect and sensitivity. Users will abide by the “Community Guidelines” applicable to INET ED located at It is important to us that you do not contribute anything that could be offensive or derogatory. You agree that you will not upload, post, transmit to or distribute, or otherwise publish through INET ED any materials that:</p>

                            <ul>
                                <li>restrict or inhibit any other user from using and enjoying INET ED;</li>
                                <li>are unlawful, threatening, abusive, libelous, defamatory, obscene, vulgar, offensive, pornographic, profane, sexually explicit, or indecent;</li>
                                <li>constitute or encourage conduct that would constitute a criminal offense, give rise to civil liability, or otherwise violate law;</li>
                                <li>violate, plagiarize, or infringe the rights of third parties including without limitation copyright, trademark, patent, rights of privacy or publicity, or any other proprietary right;</li>
                                <li>contain a virus or other harmful components;</li>
                                <li>contain any information, software, or other material of a commercial nature;</li>
                                <li>contain advertising for commercial goods and services; or</li>
                                <li>constitute or contain false or misleading indications of origin or statements of fact.</li>
                            </ul>
                            <p>You will not circumvent, disable, fraudulently engage with, or otherwise interfere with any part of INET ED (or attempt to do any of these things), including security-related features or features that (a) prevent or restrict the copying or other use of Content or (b) limit the use of INET ED or Content.
                            </p>
                            <p>Consider folding the above prohibitions into the Community Guidelines, in order to make this more concise</p>
                            <p>INET will remove from INET ED any Content it believes violates these terms, and your account may be subject to termination. </p>

                            <h5 class="font-familyAtlasGroteskWeb-Bold">Representation and Warranty with Regard to Age</h5>
                            <p>You represent and warrant that you are at least 16 years old. </p>

                            <h5 class="font-familyAtlasGroteskWeb-Bold">Submission of Contributions to INET ED</h5>
                            <p>To achieve the goals and purposes of INET ED, qualified users may submit for posting to INET ED teaching materials, resources, files, documents, audiovisual material, graphs, charts, electronic files, data, messages, postings, and other content (“<b>Contributions</b>”) via the INET ED platform. While it is important to us that you maintain ownership rights in your Contributions, in order to operate INET ED for its intended purposes, we do require a grant of certain rights to INET ED and to other users. This section governs the terms under which you provide Contributions or communications to INET ED:</p>

                            <ul>
                                <li><u>License to INET ED.</u>  By providing Contributions or engaging in any other form of communication with or to INET ED or other users, you hereby grant to INET a perpetual, worldwide, royalty-free, nonexclusive, sublicenseable, and transferable license to copy, display, post, reproduce, transmit, publish, perform, modify, adapt, prepare derivative works based on, and otherwise use your Contributions in furtherance of the purposes of INET ED.</li>
                                <li><u>License to other users.</u> In order for users of INET ED to share resources, information, and ideas, and to facilitate the purposes of INET ED, you hereby grant each user of INET ED a perpetual, worldwide, royalty-free, nonexclusive, sublicenseable, and transferable license to access, copy, display, post, reproduce, transmit, publish, perform, modify, adapt, prepare derivative works based on, and otherwise use your Contributions in furtherance of the purposes of INET ED and in accordance with the Community Guidelines and this Agreement. You acknowledge and agree that users may use your Contributions in the manner permitted in Section 2 of this Agreement.</li>
                                <li><u>Posting and removal of Contributions.</u> INET ED has no obligation to use, upload or post on INET ED, or return to you, any Contributions you submit.  INET ED may remove your Contributions in its sole discretion. You may request removal of your Contributions from INET ED by submitting a written request to <a href="#">ineted@ineteconomics.org</a>. You must notify INET ED and request removal of Content if you no longer have the rights to such Content. The licenses granted by you continue for a commercially reasonable period of time after your Content is removed from INET ED.</li>
                                <li><u>You must own or have the right to use your Contributions.</u>  You will not submit Contributions or other material that you don’t own or don’t have the right to use. You are legally responsible for the Contributions you submit to INET ED. You hereby represent and warrant to INET ED that your Contributions do not infringe the proprietary right of any other person, that you have the rights you are granting under this Agreement, and that you have the power and authority to grant those rights.</li>
                                <li><u>Waiver of infringement claims against INET.</u>  You hereby waive all rights to any claim against INET or INET ED for any alleged or actual infringements of any proprietary rights, rights of privacy and publicity, moral rights, and rights of attribution in connection with your Contributions.</li>
                            </ul>

                            <h5 class="font-familyAtlasGroteskWeb-Bold">No Confidentiality</h5>
                            <p>You acknowledge that when you post or upload Contributions to INET ED, or otherwise use the functions of INET ED, those Contributions are not confidential and your Contributions may be available to and read by other users. You acknowledge that by submitting Contributions to INET ED, no confidential, fiduciary, contractually implied, or other relationship is created between you and INET other than in accordance with this Agreement. You acknowledge that if you opt to include your name or other identifying information as part of or in any Contributions, that information may be available to users and will not be confidential.</p>

                            <h5 class="font-familyAtlasGroteskWeb-Bold">Personal information; Privacy</h5>
                            <p>Your privacy is extremely important to us. INET’s use of personal information collected from and about you in connection with your use of INET ED is governed by a Privacy Policy, available here: As part of this Agreement you agree to the Privacy Policy. </p>

                            <h5 class="font-familyAtlasGroteskWeb-Bold">Commitment to Data Security</h5>
                            <p>To prevent unauthorized access, maintain data accuracy, and ensure the correct use of information, INET has put in place appropriate physical, electronic, and managerial procedures to safeguard and secure the information collected on INET ED. Please notify INET if you believe your account’s security has been compromised in any way.</p>

                            <h5 class="font-familyAtlasGroteskWeb-Bold">Changes to the Website</h5>
                            <p> INET may change, suspend, or discontinue any aspect of INET ED at any time, including the availability of any feature, database, or other Content. INET may also impose limits on certain features and services or restrict your access to parts or all of INET ED without notice or liability. INET will try to give you notice of any changes to INET ED but you are responsible for reading and understanding them as they occur.</p>

                            <h5 class="font-familyAtlasGroteskWeb-Bold">Termination</h5>
                            <p>So long as you do not violate the terms of this Agreement, you may participate in INET ED. But we reserve the right to suspend or terminate your account for any violation of these terms at INET’s sole discretion.</p>

                            <h5 class="font-familyAtlasGroteskWeb-Bold">Limitation of Liability</h5>
                            <p>In no event will INET, INET ED, its affiliates, subsidiaries, and related companies, and partners, or any of their directors, officers, employees, shareholders, representatives, or agents (collectively “<b>The INET Parties</b>”) be responsible or liable for any damages or losses of any kind, including direct, indirect, incidental, consequential, special, or punitive damages arising out of your access to or use of INET ED (including without limitation the Content and any errors contained therein).</p>

                            <h5 class="font-familyAtlasGroteskWeb-Bold">Indemnification</h5>
                            <p>You will indemnify, defend, and hold the INET Parties harmless from and against any and all claims, liabilities, suits, losses, damages, and expenses, including without limitation costs and attorney’s fees (collectively “<b>Claims</b>”) arising out of (a) any breach by you of any term of this Agreement, (b) any breach by you of any representation, warranty or covenant made by you in this Agreement, or (c) any Claims that any of your Contributions infringes, misappropriates, or otherwise violates any intellectual property rights or other rights of any third party. You will cooperate as fully as reasonably required in the defense of any claim. INET reserves the right, at its own expense, to assume the exclusive defense and control of any matter otherwise subject to indemnification by you, and you will not in any event settle any matter without the written consent of INET.
                            </p>

                            <h5 class="font-familyAtlasGroteskWeb-Bold">Disclaimer of Warranties</h5>
                            <p>INET ED, including all Content, documents, software, functions, materials, and information made available on or accessed through INET ED, is provided “as is.” To the fullest extent permissible by law, INET and affiliates make no representation or warranties of any kind whatsoever for the content on INET ED or the materials, information, and functions made accessible by the software used on or accessed through INET ED, for any products or services or hypertext links to third parties, or for any breach of security associated with the transmission of sensitive information through INET ED or any linked site. Further, INET and its affiliates disclaim any express or implied warranties, including without limitation noninfringement, merchantability, or fitness for a particular purpose. INET does not warrant that the functions contained on INET ED or any materials or content contained therein will be uninterrupted or error free, that defects will be corrected, or that INET ED or the server that makes it available is free of viruses or other harmful components. INET and its affiliates are not liable for your use of INET ED, including without limitation the Content and any errors contained therein.</p>

                            <h5 class="font-familyAtlasGroteskWeb-Bold">Site-Content Disclaimer</h5>
                            <p>INET does not represent or endorse the accuracy or reliability of any information displayed or distributed through INET ED, and INET disclaims any and all responsibility for content contained in any third-party materials provided through links from INET ED. You acknowledge that any reliance upon any such opinion, advice, statement, memorandum, or information is at your sole risk. INET reserves the right, in its sole discretion, to correct any errors or omissions in any portion of INET ED at any time. INET may change, suspend, or continue any aspect of INET ED at any time, or limit certain features and services without liability.</p>

                            <h5 class="font-familyAtlasGroteskWeb-Bold">User-Content Disclaimer</h5>
                            <p>INET is not responsible for materials posted by users. INET reserves the right at all times to disclose any information as necessary to satisfy any law, regulation, or government request, or to edit, refuse to post, or to remove any information or materials, in whole or in part, that in INET’s sole discretion are objectionable or in violation of this Agreement.
                            </p>

                            <h5 class="font-familyAtlasGroteskWeb-Bold">Third-Party Resources Disclaimer</h5>
                            <p>INET ED may contain links and pointers to other Internet sites and resources and to parties affiliated with INET ED. Links to and from INET ED to third-party sites do not constitute an endorsement by INET or its affiliates of any third-party resources or their contents.</p>


                            <h5 class="font-familyAtlasGroteskWeb-Bold">Copyright Protection</h5>
                            <p>INET ED respects the intellectual property rights of others. It is the policy of INET ED to respond promptly to notices of alleged copyright infringement that comply with the law. INET ED reserves the right to delete or disable content alleged to be infringing and terminate the accounts of repeat infringers. Potential infringement should be reported per our Digital Millennium Copyright Act (“<b>DMCA</b>”) Policy below. Our Designated Agent (“<b>Designated Agent</b>”) under the DMCA is:
                            <br><br>
                            Copyright Agent<br>
                            INET ED<br>
                            300 Park Avenue South, 5th Floor<br>
                            New York, NY 10010<br>
                            copyright@ineteconomics.org<br>
                            646-751-4900<br></p>

                            <h5 class="font-familyAtlasGroteskWeb-Bold">DMCA Policy</h5>
                            <p>Copyright owners, or those authorized to act on behalf of one or authorized to act under any exclusive right of copyright, may report alleged copyright infringement occurring on the INET ED platform by completing the following DMCA Notice of Alleged Infringement (the “Notice”) and delivering it to the Designated Agent. Any such Notice must:
                            </p>

                            <ul>
                                <li>Identify the copyrighted work for which infringement is claimed. If the Notice is intended to cover multiple copyrighted works, you may provide a representative list of the copyrighted works for which infringement is claimed.</li>
                                <li>Identify the material or link that you claim is infringing the copyrighted work and for which you wish access to be disabled. At minimum, this includes the URL of the link shown on INET ED or the exact location where the material may be found.</li>
                                <li>Provide your company affiliation (if applicable), mailing address, telephone number, and, if available, email address.</li>
                                <li>Include both of the following statements in the body of the Notice:
                                    <ul>
                                        <li>“I hereby state that I have a good faith belief that the disputed use of the copyrighted material is not authorized by the copyright owners, its agent, or the law (e.g., as a fair use).”</li>
                                        <li>“I hereby state the information in this Notice is accurate and, under penalty of perjury, that I am the owner, or authorized to act on behalf of, the owner, of the copyright or of an exclusive right under the copyright that is allegedly infringed.” </li>
                                    </ul>
                                </li>
                                <li>Provide your full legal name and your electronic or physical signature.</li>
                            </ul>

                            <h5 class="font-familyAtlasGroteskWeb-Bold">Administrative Provisions</h5>

                            <ul>
                                <li><b>Entire Agreement.</b> This Agreement constitutes the entire agreement between INET and you with respect to your use of INET ED. If for any reason a court of competent jurisdiction finds any provision of this Agreement, or portion thereof, to be unenforceable, that provision must be enforced to the maximum extent permissible so as to effect the intent of this Agreement, and the remainder of this Agreement continues in full force and effect.
                                </li>
                                <li><b>Changes to this Agreement.</b> INET reserves the right, at its sole discretion, to change, modify, add or remove any portion of this Agreement, in whole or in part, at any time. Notification of changes in this Agreement will be posted on INET ED.
                                </li>
                                <li><b>Choice of Law; Jurisdiction.</b>  This Agreement is governed by and construed in accordance with the laws of the state of New York without regard to its conflicts-of-laws provisions. Sole and exclusive jurisdiction for any action or proceeding arising out of or related to this Agreement is in an appropriate state or federal court located in New York. Any cause of action you may have with respect to your use of INET ED must be commenced within one year after the claim or cause of action arises.
                                </li>
                                <li><b>Contact Information.</b> You may contact us through any of the following ways:
                                    <ul>
                                        <li><b>By Email:</b>
                                            <br>
                                            ineted@ineteconomics.org
                                        </li>
                                        <li>
                                            <b>By Mail:</b>
                                            <br>
                                            300 Park Avenue South, 5th Floor, New York, NY 10010
                                        </li>
                                        <li>
                                            <b>By Phone:</b>
                                            <br>
                                            646-751-4900
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        </div>

                    </div>
                    <div class="modal-footer box-shadow">
                        <button type="button" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size13px p-0 border-radius0px btnBotmBar" data-dismiss="modal" aria-label="Close">
                            <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">OK <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                            <div class="btn-bar"></div>
                        </button>
                    </div>

            </div>
        </div>
    </div>




@include('include.footer') @endsection

@section('script')
    <script src="{{ asset('js/country/crs.min.js') }}"></script>
@endsection
