@extends('layouts.app') @section('title') INET ED Platform :: Account Settings @endsection @section('content') @include('include.header')
<section class="bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 d-flex">
                <div class="col-md-12 bg-lightWhite100 pt-4 pb-4">
                    <div class="list-group leftPanalList font-familyAtlasGroteskWeb-Regular font-size13px">
                        <a href="#" class="list-group-item list-group-item-action active text-colorblue200 transitionall">Account</a>
                        {{-- <a href="#" class="list-group-item list-group-item-action text-colorblue200 transitionall">Notifications</a> --}}
                    </div>

                </div>
            </div>

            <div class="col-lg-6 col-md-9 pt-4 pb-4">
                <h4 class="font-familyAtlasGroteskWeb-Bold text-black mb-0 pb-1">Account Settings</h4>
                <p class="font-familyAtlasGroteskWeb-Light text-colorblue200 font-size13px">Update your account settings i.e email or create personal url etc.</p>
                <form class="font-size12px" method="POST" action="{{ route('updateSetting') }}">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="emailAdd" class="font-familyAtlasGrotesk-Medium">Email Address</label>
                        <input value="{{ Auth::user()->email }}" readonly type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue font-size14px border-radius0all" name="email" id="email" placeholder="email@example.com">
                    </div>

                    <div class="form-group">
                        <label for="current_password" class="font-familyAtlasGrotesk-Medium">Password</label>
                        <input value="{{ old('current_password') }}" type="password" class="form-control font-familyFreightTextProLight-Regular text-darkBlue font-size14px border-radius0all" name="current_password" id="current_password" placeholder="Current password">
                    </div>
                    @error('current_password')
                    <p style="color: red">{{ $message }}</p>
                    @enderror

                    <div class="form-group mb-4">
                        <input value="{{ old('new_password') }}" type="password" class="form-control font-familyFreightTextProLight-Regular text-darkBlue font-size14px border-radius0all" name="new_password" id="new_password" placeholder="New password">
                    </div>
                    @error('new_password')
                    <p style="color: red">{{ $message }}</p>
                    @enderror
                   @if(Auth::user()->role_id==1||Auth::user()->role_id==3)
                    <div class="form-group mb-4">
                        <label for="affiliation" class="font-familyAtlasGrotesk-Medium">Affiliation</label>
                        <input  value="{{ Auth::user()->affiliation }}"  type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue font-size14px border-radius0all" name="affiliation" id="affiliation" placeholder="jerry.smith@email.com">
                    </div>
                   @endif
                    {{--<div class="form-group">
                        <label for="web_url" class="font-familyAtlasGrotesk-Medium">Customized URL</label>
                        <p class="font-familyFreightTextProLight-Regular">Your URL: {{ $data['profile']->web_url }}</p>
                        <input type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue font-size14px border-radius0all" name="web_url" id="web_url" placeholder="">
                    </div>--}}
                    {{--<div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="city" class="font-familyAtlasGrotesk-Medium">City</label>
                            <input value="{{ $data['profile']->city }}" type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue font-size14px border-radius0all" name="city" id="city" placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="zip_code" class="font-familyAtlasGrotesk-Medium">Zip Code</label>
                            <input value="{{ $data['profile']->zip_code }}" type="text" class="form-control font-familyFreightTextProLight-Regular text-darkBlue font-size14px border-radius0all" name="zip_code" id="zip_code" placeholder="">
                        </div>
                    </div>--}}
                   <div class="form-group font-familyFreightTextProLight-Regular text-colorblue100 mb-3 customDropDownInnerPg border-radius0Custom mb-4">
                        <label for="country" class="font-familyAtlasGrotesk-Medium">Country</label>
                        <select id="country" class="selectpicker  border text-darkBlue" required name="location">
                        <option value="" {{ (Auth::user()->location) ? 'selected' : '' }}>Select Country</option>
<option value="Afghanistan" {{ (Auth::user()->location=="Afghanistan") ? 'selected' : '' }}>Afghanistan</option>
<option value="Aland Islands" {{ (Auth::user()->location=="Aland Islands") ? 'selected' : '' }}>Aland Islands</option>
<option value="Albania" {{ (Auth::user()->location=="Albania") ? 'selected' : '' }}>Albania</option>
<option value="Algeria" {{ (Auth::user()->location=="Algeria") ? 'selected' : '' }}>Algeria</option>
<option value="American Samoa" {{ (Auth::user()->location=="American Samoa") ? 'selected' : '' }}>American Samoa</option>
<option value="Andorra" {{ (Auth::user()->location=="Andorra") ? 'selected' : '' }}>Andorra</option>
<option value="Angola" {{ (Auth::user()->location=="Angola") ? 'selected' : '' }}>Angola</option>
<option value="Anguilla" {{ (Auth::user()->location=="Anguilla") ? 'selected' : '' }}>Anguilla</option>
<option value="Antarctica" {{ (Auth::user()->location=="Antarctica") ? 'selected' : '' }}>Antarctica</option>
<option value="Antigua and Barbuda" {{ (Auth::user()->location=="Antigua and Barbuda") ? 'selected' : '' }}>Antigua and Barbuda</option>
<option value="Argentina" {{ (Auth::user()->location=="Argentina") ? 'selected' : '' }}>Argentina</option>
<option value="Armenia" {{ (Auth::user()->location=="Armenia") ? 'selected' : '' }}>Armenia</option>
<option value="Aruba" {{ (Auth::user()->location=="Aruba") ? 'selected' : '' }}>Aruba</option>
<option value="Australia" {{ (Auth::user()->location=="Australia") ? 'selected' : '' }}>Australia</option>
<option value="Austria" {{ (Auth::user()->location=="Austria") ? 'selected' : '' }}>Austria</option>
<option value="Azerbaijan" {{ (Auth::user()->location=="Azerbaijan") ? 'selected' : '' }}>Azerbaijan</option>
<option value="Bahamas" {{ (Auth::user()->location=="Bahamas") ? 'selected' : '' }}>Bahamas</option>
<option value="Bahrain" {{ (Auth::user()->location=="Bahrain") ? 'selected' : '' }}>Bahrain</option>
<option value="Bangladesh" {{ (Auth::user()->location=="Bangladesh") ? 'selected' : '' }}>Bangladesh</option>
<option value="Barbados" {{ (Auth::user()->location=="Barbados") ? 'selected' : '' }}>Barbados</option>
<option value="Belarus" {{ (Auth::user()->location=="Belarus") ? 'selected' : '' }}>Belarus</option>
<option value="Belgium" {{ (Auth::user()->location=="Belgium") ? 'selected' : '' }}>Belgium</option>
<option value="Belize" {{ (Auth::user()->location=="Belize") ? 'selected' : '' }}>Belize</option>
<option value="Benin" {{ (Auth::user()->location=="Benin") ? 'selected' : '' }}>Benin</option>
<option value="Bermuda" {{ (Auth::user()->location=="Bermuda") ? 'selected' : '' }}>Bermuda</option>
<option value="Bhutan" {{ (Auth::user()->location=="Bhutan") ? 'selected' : '' }}>Bhutan</option>
<option value="Bolivia" {{ (Auth::user()->location=="Bolivia") ? 'selected' : '' }}>Bolivia</option>
<option value="Bonaire, Sint Eustatius and Saba" {{ (Auth::user()->location=="Bonaire, Sint Eustatius and Saba") ? 'selected' : '' }}>Bonaire, Sint Eustatius and Saba</option>
<option value="Bosnia and Herzegovina" {{ (Auth::user()->location=="Bosnia and Herzegovina") ? 'selected' : '' }}>Bosnia and Herzegovina</option>
<option value="Botswana" {{ (Auth::user()->location=="Botswana") ? 'selected' : '' }}>Botswana</option>
<option value="Bouvet Island" {{ (Auth::user()->location=="Bouvet Island") ? 'selected' : '' }}>Bouvet Island</option>
<option value="Brazil" {{ (Auth::user()->location=="Brazil") ? 'selected' : '' }}>Brazil</option>
<option value="British Indian Ocean Territory" {{ (Auth::user()->location=="British Indian Ocean Territory") ? 'selected' : '' }}>British Indian Ocean Territory</option>
<option value="Brunei Darussalam" {{ (Auth::user()->location=="Brunei Darussalam") ? 'selected' : '' }}>Brunei Darussalam</option>
<option value="Bulgaria" {{ (Auth::user()->location=="Bulgaria") ? 'selected' : '' }}>Bulgaria</option>
<option value="Burkina Faso" {{ (Auth::user()->location=="Burkina Faso") ? 'selected' : '' }}>Burkina Faso</option>
<option value="Burundi"> {{ (Auth::user()->location=="Burundi") ? 'selected' : '' }}Burundi</option>
<option value="Cambodia" {{ (Auth::user()->location=="Cambodia") ? 'selected' : '' }}>Cambodia</option>
<option value="Cameroon" {{ (Auth::user()->location=="Cameroon") ? 'selected' : '' }}>Cameroon</option>
<option value="Canada" {{ (Auth::user()->location=="Canada") ? 'selected' : '' }}>Canada</option>
<option value="Cape Verde" {{ (Auth::user()->location=="Cape Verde") ? 'selected' : '' }}>Cape Verde</option>
<option value="Cayman Islands" {{ (Auth::user()->location=="Cayman Islands") ? 'selected' : '' }}>Cayman Islands</option>
<option value="Central African Republic" {{ (Auth::user()->location=="Central African Republic") ? 'selected' : '' }}>Central African Republic</option>
<option value="Chad" {{ (Auth::user()->location=="Chad") ? 'selected' : '' }}>Chad</option>
<option value="Chile" {{ (Auth::user()->location=="Chile") ? 'selected' : '' }}>Chile</option>
<option value="China" {{ (Auth::user()->location=="China") ? 'selected' : '' }}>China</option>
<option value="Christmas Island" {{ (Auth::user()->location=="Christmas Island") ? 'selected' : '' }}>Christmas Island</option>
<option value="Cocos (Keeling) Islands" {{ (Auth::user()->location=="Cocos (Keeling) Islands") ? 'selected' : '' }}>Cocos (Keeling) Islands</option>
<option value="Colombia" {{ (Auth::user()->location=="Colombia") ? 'selected' : '' }}>Colombia</option>
<option value="Comoros" {{ (Auth::user()->location=="Comoros") ? 'selected' : '' }}>Comoros</option>
<option value="Congo, Republic of the (Brazzaville)" {{ (Auth::user()->location=="Congo, Republic of the (Brazzaville)") ? 'selected' : '' }}>Congo, Republic of the (Brazzaville)</option>
<option value="Congo, the Democratic Republic of the (Kinshasa)" {{ (Auth::user()->location=="Congo, the Democratic Republic of the (Kinshasa)") ? 'selected' : '' }}>Congo, the Democratic Republic of the (Kinshasa)</option>
<option value="Cook Islands" {{ (Auth::user()->location=="Cook Islands") ? 'selected' : '' }}>Cook Islands</option>
<option value="Costa Rica" {{ (Auth::user()->location=="Costa Rica") ? 'selected' : '' }}>Costa Rica</option>
<option value="Cote d'Ivoire, Republic of" {{ (Auth::user()->location=="Cote d'Ivoire, Republic of") ? 'selected' : '' }}>Cote d'Ivoire, Republic of</option>
<option value="Croatia"{{ (Auth::user()->location=="Croatia") ? 'selected' : '' }}>Croatia</option>
<option value="Cuba" {{ (Auth::user()->location=="Cuba") ? 'selected' : '' }}>Cuba</option>
<option value="Curacao" {{ (Auth::user()->location=="Curacao") ? 'selected' : '' }}>Curacao</option>
<option value="Cyprus" {{ (Auth::user()->location=="Cyprus") ? 'selected' : '' }}>Cyprus</option>
<option value="Czech Republic" {{ (Auth::user()->location=="Czech Republic") ? 'selected' : '' }}>Czech Republic</option>
<option value="Denmark" {{ (Auth::user()->location=="Denmark") ? 'selected' : '' }}>Denmark</option>
<option value="Djibouti" {{ (Auth::user()->location=="Djibouti") ? 'selected' : '' }}>Djibouti</option>
<option value="Dominica" {{ (Auth::user()->location=="Dominica") ? 'selected' : '' }}>Dominica</option>
<option value="Dominican Republic" {{ (Auth::user()->location=="Dominican Republic") ? 'selected' : '' }}>Dominican Republic</option>
<option value="East Timor" {{ (Auth::user()->location=="East Timor") ? 'selected' : '' }}>East Timor</option>
<option value="Ecuador" {{ (Auth::user()->location=="Ecuador") ? 'selected' : '' }}>Ecuador</option>
<option value="Egypt" {{ (Auth::user()->location=="Egypt") ? 'selected' : '' }}>Egypt</option>
<option value="El Salvador" {{ (Auth::user()->location=="El Salvador") ? 'selected' : '' }}>El Salvador</option>
<option value="Equatorial Guinea" {{ (Auth::user()->location=="Equatorial Guinea") ? 'selected' : '' }}>Equatorial Guinea</option>
<option value="Eritrea" {{ (Auth::user()->location=="Eritrea") ? 'selected' : '' }}>Eritrea</option>
<option value="Estonia" {{ (Auth::user()->location=="Estonia") ? 'selected' : '' }}>Estonia</option>
<option value="Ethiopia" {{ (Auth::user()->location=="Ethiopia") ? 'selected' : '' }}>Ethiopia</option>
<option value="Falkland Islands (Islas Malvinas)" {{ (Auth::user()->location=="Falkland Islands (Islas Malvinas)") ? 'selected' : '' }}>Falkland Islands (Islas Malvinas)</option>
<option value="Faroe Islands" {{ (Auth::user()->location=="Faroe Islands") ? 'selected' : '' }}>Faroe Islands</option>
<option value="Fiji" {{ (Auth::user()->location=="Fiji") ? 'selected' : '' }}>Fiji</option>
<option value="Finland" {{ (Auth::user()->location=="Finland") ? 'selected' : '' }}>Finland</option>
<option value="France" {{ (Auth::user()->location=="France") ? 'selected' : '' }}>France</option>
<option value="France, Metropolitan" {{ (Auth::user()->location=="France, Metropolitan") ? 'selected' : '' }}>France, Metropolitan</option>
<option value="French Guiana" {{ (Auth::user()->location=="French Guiana") ? 'selected' : '' }}>French Guiana</option>
<option value="French Polynesia" {{ (Auth::user()->location=="French Polynesia") ? 'selected' : '' }}>French Polynesia</option>
<option value="French Southern and Antarctic Lands" {{ (Auth::user()->location=="French Southern and Antarctic Lands") ? 'selected' : '' }}>French Southern and Antarctic Lands</option>
<option value="Gabon" {{ (Auth::user()->location=="Gabon") ? 'selected' : '' }}>Gabon</option>
<option value="Gambia" {{ (Auth::user()->location=="Gambia") ? 'selected' : '' }}>Gambia</option>
<option value="Georgia" {{ (Auth::user()->location=="Georgia") ? 'selected' : '' }}>Georgia</option>
<option value="Germany" {{ (Auth::user()->location=="Germany") ? 'selected' : '' }}>Germany</option>
<option value="Ghana" {{ (Auth::user()->location=="Ghana") ? 'selected' : '' }}>Ghana</option>
<option value="Gibraltar" {{ (Auth::user()->location=="Gibraltar") ? 'selected' : '' }}>Gibraltar</option>
<option value="Greece" {{ (Auth::user()->location=="Greece") ? 'selected' : '' }}>Greece</option>
<option value="Greenland" {{ (Auth::user()->location=="Greenland") ? 'selected' : '' }}>Greenland</option>
<option value="Grenada" {{ (Auth::user()->location=="Grenada") ? 'selected' : '' }}>Grenada</option>
<option value="Guadeloupe" {{ (Auth::user()->location=="Guadeloupe") ? 'selected' : '' }}>Guadeloupe</option>
<option value="Guam" {{ (Auth::user()->location=="Guam") ? 'selected' : '' }}>Guam</option>
<option value="Guatemala" {{ (Auth::user()->location=="Guatemala") ? 'selected' : '' }}>Guatemala</option>
<option value="Guernsey" {{ (Auth::user()->location=="Guernsey") ? 'selected' : '' }}>Guernsey</option>
<option value="Guinea" {{ (Auth::user()->location=="Guinea") ? 'selected' : '' }}>Guinea</option>
<option value="Guinea-Bissau" {{ (Auth::user()->location=="Guinea-Bissau") ? 'selected' : '' }}>Guinea-Bissau</option>
<option value="Guyana" {{ (Auth::user()->location=="Guyana") ? 'selected' : '' }}>Guyana</option>
<option value="Haiti" {{ (Auth::user()->location=="Haiti") ? 'selected' : '' }}>Haiti</option>
<option value="Heard Island and McDonald Islands" {{ (Auth::user()->location=="Heard Island and McDonald Islands") ? 'selected' : '' }}>Heard Island and McDonald Islands</option>
<option value="Holy See (Vatican City)" {{ (Auth::user()->location=="Holy See (Vatican City)") ? 'selected' : '' }}>Holy See (Vatican City)</option>
<option value="Honduras" {{ (Auth::user()->location=="Honduras") ? 'selected' : '' }}>Honduras</option>
<option value="Hong Kong" {{ (Auth::user()->location=="Hong Kong") ? 'selected' : '' }}>Hong Kong</option>
<option value="Hungary" {{ (Auth::user()->location=="Hungary") ? 'selected' : '' }}>Hungary</option>
<option value="Iceland" {{ (Auth::user()->location=="Iceland") ? 'selected' : '' }}>Iceland</option>
<option value="India" {{ (Auth::user()->location=="India") ? 'selected' : '' }}>India</option>
<option value="Indonesia" {{ (Auth::user()->location=="Indonesia") ? 'selected' : '' }}>Indonesia</option>
<option value="Iran, Islamic Republic of" {{ (Auth::user()->location=="Iran, Islamic Republic of") ? 'selected' : '' }}>Iran, Islamic Republic of</option>
<option value="Iraq" {{ (Auth::user()->location=="Iraq") ? 'selected' : '' }}>Iraq</option>
<option value="Ireland" {{ (Auth::user()->location=="Ireland") ? 'selected' : '' }}>Ireland</option>
<option value="Isle of Man" {{ (Auth::user()->location=="Isle of Man") ? 'selected' : '' }}>Isle of Man</option>
<option value="Israel" {{ (Auth::user()->location=="Israel") ? 'selected' : '' }}>Israel</option>
<option value="Italy" {{ (Auth::user()->location=="Italy") ? 'selected' : '' }}>Italy</option>
<option value="Jamaica" {{ (Auth::user()->location=="Jamaica") ? 'selected' : '' }}>Jamaica</option>
<option value="Japan" {{ (Auth::user()->location=="Japan") ? 'selected' : '' }}>Japan</option>
<option value="Jersey" {{ (Auth::user()->location=="Jersey") ? 'selected' : '' }}>Jersey</option>
<option value="Jordan" {{ (Auth::user()->location=="Jordan") ? 'selected' : '' }}>Jordan</option>
<option value="Kazakhstan" {{ (Auth::user()->location=="Kazakhstan") ? 'selected' : '' }}>Kazakhstan</option>
<option value="Kenya" {{ (Auth::user()->location=="Kenya") ? 'selected' : '' }}>Kenya</option>
<option value="Kiribati" {{ (Auth::user()->location=="Kiribati") ? 'selected' : '' }}>Kiribati</option>
<option value="Korea, Democratic People's Republic of" {{ (Auth::user()->location=="Korea, Democratic People's Republic of") ? 'selected' : '' }}>Korea, Democratic People's Republic of</option>
<option value="Korea, Republic of" {{ (Auth::user()->location=="Korea, Republic of") ? 'selected' : '' }}>Korea, Republic of</option>
<option value="Kuwait" {{ (Auth::user()->location=="Kuwait") ? 'selected' : '' }}>Kuwait</option>
<option value="Kyrgyzstan" {{ (Auth::user()->location=="Kyrgyzstan") ? 'selected' : '' }}>Kyrgyzstan</option>
<option value="Laos" {{ (Auth::user()->location=="Laos") ? 'selected' : '' }}>Laos</option>
<option value="Latvia" {{ (Auth::user()->location=="Latvia") ? 'selected' : '' }}>Latvia</option>
<option value="Lebanon" {{ (Auth::user()->location=="Lebanon") ? 'selected' : '' }}>Lebanon</option>
<option value="Lesotho" {{ (Auth::user()->location=="Lesotho") ? 'selected' : '' }}>Lesotho</option>
<option value="Liberia" {{ (Auth::user()->location=="Liberia") ? 'selected' : '' }}>Liberia</option>
<option value="Libya" {{ (Auth::user()->location=="Libya") ? 'selected' : '' }}>Libya</option>
<option value="Liechtenstein" {{ (Auth::user()->location=="Liechtenstein") ? 'selected' : '' }}>Liechtenstein</option>
<option value="Lithuania" {{ (Auth::user()->location=="Lithuania") ? 'selected' : '' }}>Lithuania</option>
<option value="Luxembourg" {{ (Auth::user()->location=="Luxembourg") ? 'selected' : '' }}>Luxembourg</option>
<option value="Macao" {{ (Auth::user()->location=="Macao") ? 'selected' : '' }}>Macao</option>
<option value="Macedonia, Republic of" {{ (Auth::user()->location=="Macedonia, Republic of") ? 'selected' : '' }}>Macedonia, Republic of</option>
<option value="Madagascar" {{ (Auth::user()->location=="Madagascar") ? 'selected' : '' }}>Madagascar</option>
<option value="Malawi" {{ (Auth::user()->location=="Malawi") ? 'selected' : '' }}>Malawi</option>
<option value="Malaysia" {{ (Auth::user()->location=="Malaysia") ? 'selected' : '' }}>Malaysia</option>
<option value="Maldives" {{ (Auth::user()->location=="Maldives") ? 'selected' : '' }}>Maldives</option>
<option value="Mali" {{ (Auth::user()->location=="Mali") ? 'selected' : '' }}>Mali</option>
<option value="Malta" {{ (Auth::user()->location=="Malta") ? 'selected' : '' }}>Malta</option>
<option value="Marshall Islands" {{ (Auth::user()->location=="Marshall Islands") ? 'selected' : '' }}>Marshall Islands</option>
<option value="Martinique" {{ (Auth::user()->location=="Martinique") ? 'selected' : '' }}>Martinique</option>
<option value="Mauritania" {{ (Auth::user()->location=="Mauritania") ? 'selected' : '' }}>Mauritania</option>
<option value="Mauritius" {{ (Auth::user()->location=="Mauritius") ? 'selected' : '' }}>Mauritius</option>
<option value="Mayotte" {{ (Auth::user()->location=="Mayotte") ? 'selected' : '' }}>Mayotte</option>
<option value="Mexico" {{ (Auth::user()->location=="Mexico") ? 'selected' : '' }}>Mexico</option>
<option value="Micronesia, Federated States of" {{ (Auth::user()->location=="Micronesia, Federated States of") ? 'selected' : '' }}>Micronesia, Federated States of</option>
<option value="Moldova" {{ (Auth::user()->location=="Moldova") ? 'selected' : '' }}>Moldova, Republic of</option>
<option value="Monaco" {{ (Auth::user()->location=="Monaco") ? 'selected' : '' }}>Monaco</option>
<option value="Mongolia" {{ (Auth::user()->location=="Mongolia") ? 'selected' : '' }}>Mongolia</option>
<option value="Montserrat" {{ (Auth::user()->location=="Montserrat") ? 'selected' : '' }}>Montserrat</option>
<option value="Morocco" {{ (Auth::user()->location=="Morocco") ? 'selected' : '' }}>Morocco</option>
<option value="Mozambique" {{ (Auth::user()->location=="Mozambique") ? 'selected' : '' }}>Mozambique</option>
<option value="Myanmar" {{ (Auth::user()->location=="Myanmar") ? 'selected' : '' }}>Myanmar</option>
<option value="Namibia" {{ (Auth::user()->location=="Namibia") ? 'selected' : '' }}>Namibia</option>
<option value="Nauru" {{ (Auth::user()->location=="Nauru") ? 'selected' : '' }}>Nauru</option>
<option value="Nepal" {{ (Auth::user()->location=="Nepal") ? 'selected' : '' }}>Nepal</option>
<option value="Netherlands" {{ (Auth::user()->location=="Netherlands") ? 'selected' : '' }}>Netherlands</option>
<option value="Netherlands Antilles" {{ (Auth::user()->location=="Netherlands Antilles") ? 'selected' : '' }}>Netherlands Antilles</option>
<option value="New Caledonia" {{ (Auth::user()->location=="New Caledonia") ? 'selected' : '' }}>New Caledonia</option>
<option value="New Zealand" {{ (Auth::user()->location=="New Zealand") ? 'selected' : '' }}>New Zealand</option>
<option value="Nicaragua" {{ (Auth::user()->location=="Nicaragua") ? 'selected' : '' }}>Nicaragua</option>
<option value="Niger" {{ (Auth::user()->location=="Niger") ? 'selected' : '' }}>Niger</option>
<option value="Nigeria" {{ (Auth::user()->location=="Nigeria") ? 'selected' : '' }}>Nigeria</option>
<option value="Niue" {{ (Auth::user()->location=="Niue") ? 'selected' : '' }}>Niue</option>
<option value="Norfolk Island" {{ (Auth::user()->location=="Norfolk Island") ? 'selected' : '' }}>Norfolk Island</option>
<option value="Northern Mariana Islands" {{ (Auth::user()->location=="Northern Mariana Islands") ? 'selected' : '' }}>Northern Mariana Islands</option>
<option value="Norway" {{ (Auth::user()->location=="Norway") ? 'selected' : '' }}>Norway</option>
<option value="Oman" {{ (Auth::user()->location=="Oman") ? 'selected' : '' }}>Oman</option>
<option value="Pakistan" {{ (Auth::user()->location=="Pakistan") ? 'selected' : '' }}>Pakistan</option>
<option value="Palau" {{ (Auth::user()->location=="Palau") ? 'selected' : '' }}>Palau</option>
<option value="Panama" {{ (Auth::user()->location=="Panama") ? 'selected' : '' }}>Panama</option>
<option value="Papua New Guinea" {{ (Auth::user()->location=="Papua New Guinea") ? 'selected' : '' }}>Papua New Guinea</option>
<option value="Paraguay" {{ (Auth::user()->location=="Paraguay") ? 'selected' : '' }}>Paraguay</option>
<option value="Peru" {{ (Auth::user()->location=="Peru") ? 'selected' : '' }}>Peru</option>
<option value="Philippines" {{ (Auth::user()->location=="Philippines") ? 'selected' : '' }}>Philippines</option>
<option value="Pitcairn" {{ (Auth::user()->location=="Pitcairn") ? 'selected' : '' }}>Pitcairn</option>
<option value="Poland" {{ (Auth::user()->location=="Poland") ? 'selected' : '' }}>Poland</option>
<option value="Portugal" {{ (Auth::user()->location=="Portugal") ? 'selected' : '' }}>Portugal</option>
<option value="Puerto Rico" {{ (Auth::user()->location=="Puerto Rico") ? 'selected' : '' }}>Puerto Rico</option>
<option value="Qatar" {{ (Auth::user()->location=="Qatar") ? 'selected' : '' }}>Qatar</option>
<option value="Reunion" {{ (Auth::user()->location=="Reunion") ? 'selected' : '' }}>Reunion</option>
<option value="Romania" {{ (Auth::user()->location=="Romania") ? 'selected' : '' }}>Romania</option>
<option value="Russian Federation" {{ (Auth::user()->location=="Russian Federation") ? 'selected' : '' }}>Russian Federation</option>
<option value="Rwanda" {{ (Auth::user()->location=="Rwanda") ? 'selected' : '' }}>Rwanda</option>
<option value="Saint Barthelemy" {{ (Auth::user()->location=="Saint Barthelemy") ? 'selected' : '' }}>Saint Barthelemy</option>
<option value="Saint Helena, Ascension and Tristan da Cunha" {{ (Auth::user()->location=="Saint Helena, Ascension and Tristan da Cunha") ? 'selected' : '' }}>Saint Helena, Ascension and Tristan da Cunha</option>
<option value="Saint Kitts and Nevis" {{ (Auth::user()->location=="Saint Kitts and Nevis") ? 'selected' : '' }}>Saint Kitts and Nevis</option> 
<option value="Saint Lucia" {{ (Auth::user()->location=="Saint Lucia") ? 'selected' : '' }}>Saint Lucia</option>
<option value="Saint Martin" {{ (Auth::user()->location=="Saint Martin") ? 'selected' : '' }}>Saint Martin</option>
<option value="Saint Pierre and Miquelon" {{ (Auth::user()->location=="Saint Pierre and Miquelon") ? 'selected' : '' }}>Saint Pierre and Miquelon</option>
<option value="Saint Vincent and the Grenadines" {{ (Auth::user()->location=="Saint Vincent and the Grenadines") ? 'selected' : '' }}>Saint Vincent and the Grenadines</option>
<option value="Samoa" {{ (Auth::user()->location=="Samoa") ? 'selected' : '' }}>Samoa</option>
<option value="San Marino" {{ (Auth::user()->location=="San Marino") ? 'selected' : '' }}>San Marino</option>
<option value="Sao Tome and Principe" {{ (Auth::user()->location=="Sao Tome and Principe") ? 'selected' : '' }}>Sao Tome and Principe</option> 
<option value="Saudi Arabia" {{ (Auth::user()->location=="Saudi Arabia") ? 'selected' : '' }}>Saudi Arabia</option>
<option value="Senegal" {{ (Auth::user()->location=="Senegal") ? 'selected' : '' }}>Senegal</option>
<option value="Seychelles" {{ (Auth::user()->location=="Seychelles") ? 'selected' : '' }}>Seychelles</option>
<option value="Sierra Leone" {{ (Auth::user()->location=="Sierra Leone") ? 'selected' : '' }}>Sierra Leone</option>
<option value="Singapore" {{ (Auth::user()->location=="Singapore") ? 'selected' : '' }}>Singapore</option>
<option value="Sint Maarten (Dutch part)" {{ (Auth::user()->location=="Sint Maarten (Dutch part)") ? 'selected' : '' }}>Sint Maarten (Dutch part)</option>
<option value="Slovakia" {{ (Auth::user()->location=="Slovakia") ? 'selected' : '' }}>Slovakia</option>
<option value="Slovenia" {{ (Auth::user()->location=="Slovenia") ? 'selected' : '' }}>Slovenia</option>
<option value="Solomon Islands" {{ (Auth::user()->location=="Solomon Islands") ? 'selected' : '' }}>Solomon Islands</option>
<option value="Somalia" {{ (Auth::user()->location=="Somalia") ? 'selected' : '' }}>Somalia</option>
<option value="South Africa" {{ (Auth::user()->location=="South Africa") ? 'selected' : '' }}>South Africa</option>
<option value="South Georgia and South Sandwich Islands" {{ (Auth::user()->location=="South Georgia and South Sandwich Islands") ? 'selected' : '' }}>South Georgia and South Sandwich Islands</option>
<option value="Spain" {{ (Auth::user()->location=="Spain") ? 'selected' : '' }}>Spain</option>
<option value="Sri Lanka" {{ (Auth::user()->location=="Sri Lanka") ? 'selected' : '' }}>Sri Lanka</option>
<option value="St. Helena" {{ (Auth::user()->location=="St. Helena") ? 'selected' : '' }}>St. Helena</option>
<option value="St. Pierre and Miquelon" {{ (Auth::user()->location=="St. Pierre and Miquelon") ? 'selected' : '' }}>St. Pierre and Miquelon</option>
<option value="Sudan" {{ (Auth::user()->location=="Sudan") ? 'selected' : '' }}>Sudan</option>
<option value="Suriname" {{ (Auth::user()->location=="Suriname") ? 'selected' : '' }}>Suriname</option>
<option value="Svalbard and Jan Mayen Islands" {{ (Auth::user()->location=="Svalbard and Jan Mayen Islands") ? 'selected' : '' }}>Svalbard and Jan Mayen Islands</option>
<option value="Swaziland" {{ (Auth::user()->location=="Swaziland") ? 'selected' : '' }}>Swaziland</option>
<option value="Sweden" {{ (Auth::user()->location=="Sweden") ? 'selected' : '' }}>Sweden</option>
<option value="Switzerland" {{ (Auth::user()->location=="Switzerland") ? 'selected' : '' }}>Switzerland</option>
<option value="Syrian Arab Republic" {{ (Auth::user()->location=="Syrian Arab Republic") ? 'selected' : '' }}>Syrian Arab Republic</option>
<option value="Taiwan" {{ (Auth::user()->location=="Taiwan") ? 'selected' : '' }}>Taiwan</option>
<option value="Tajikistan" {{ (Auth::user()->location=="Tajikistan") ? 'selected' : '' }}>Tajikistan</option>
<option value="Tanzania, United Republic of" {{ (Auth::user()->location=="Tanzania, United Republic of") ? 'selected' : '' }}>Tanzania, United Republic of</option>
<option value="Thailand" {{ (Auth::user()->location=="Thailand") ? 'selected' : '' }}>Thailand</option>
<option value="Timor-Leste" {{ (Auth::user()->location=="Timor-Leste") ? 'selected' : '' }}>Timor-Leste</option>
<option value="Togo" {{ (Auth::user()->location=="Togo") ? 'selected' : '' }}>Togo</option>
<option value="Tokelau" {{ (Auth::user()->location=="Tokelau") ? 'selected' : '' }}>Tokelau</option>
<option value="Tonga" {{ (Auth::user()->location=="Tonga") ? 'selected' : '' }}>Tonga</option>
<option value="Trinidad and Tobago" {{ (Auth::user()->location=="Trinidad and Tobago") ? 'selected' : '' }}>Trinidad and Tobago</option>
<option value="Tunisia" {{ (Auth::user()->location=="Tunisia") ? 'selected' : '' }}>Tunisia</option>
<option value="Turkey" {{ (Auth::user()->location=="Turkey") ? 'selected' : '' }}>Turkey</option>
<option value="Turkmenistan" {{ (Auth::user()->location=="Turkmenistan") ? 'selected' : '' }}>Turkmenistan</option>
<option value="Turks and Caicos Islands" {{ (Auth::user()->location=="Turks and Caicos Islands") ? 'selected' : '' }}>Turks and Caicos Islands</option>
<option value="Tuvalu" {{ (Auth::user()->location=="Tuvalu") ? 'selected' : '' }}>Tuvalu</option>
<option value="Uganda" {{ (Auth::user()->location=="Uganda") ? 'selected' : '' }}>Uganda</option>
<option value="Ukraine" {{ (Auth::user()->location=="Ukraine") ? 'selected' : '' }}>Ukraine</option>
<option value="United Arab Emirates" {{ (Auth::user()->location=="United Arab Emirates") ? 'selected' : '' }}>United Arab Emirates</option>
<option value="United Kingdom" {{ (Auth::user()->location=="United Kingdom") ? 'selected' : '' }}>United Kingdom</option>
<option value="United States" {{ (Auth::user()->location=="United States") ? 'selected' : '' }}>United States</option>
<option value="United States Minor Outlying Islands" {{ (Auth::user()->location=="United States Minor Outlying Islands") ? 'selected' : '' }}>United States Minor Outlying Islands</option>
<option value="Uruguay" {{ (Auth::user()->location=="Uruguay") ? 'selected' : '' }}>Uruguay</option>
<option value="Uzbekistan" {{ (Auth::user()->location=="Uzbekistan") ? 'selected' : '' }}>Uzbekistan</option>
<option value="Vanuatu" {{ (Auth::user()->location=="Vanuatu") ? 'selected' : '' }}>Vanuatu</option>
<option value="Venezuela, Bolivarian Republic of" {{ (Auth::user()->location=="Venezuela, Bolivarian Republic of") ? 'selected' : '' }}>Venezuela, Bolivarian Republic of</option>
<option value="Vietnam" {{ (Auth::user()->location=="Vietnam") ? 'selected' : '' }}>Viet Nam</option>
<option value="Virgin Islands, British" {{ (Auth::user()->location=="Virgin Islands, British") ? 'selected' : '' }}>Virgin Islands, British</option>
<option value="Virgin Islands, U.S." {{ (Auth::user()->location=="Virgin Islands, U.S.") ? 'selected' : '' }}>Virgin Islands, U.S.</option>
<option value="Wallis and Futuna" {{ (Auth::user()->location=="Wallis and Futuna") ? 'selected' : '' }}>Wallis and Futuna</option>
<option value="Western Sahara" {{ (Auth::user()->location=="Western Sahara") ? 'selected' : '' }}>Western Sahara</option>
<option value="Yemen" {{ (Auth::user()->location=="Yemen") ? 'selected' : '' }}>Yemen</option>
<option value="Zambia" {{ (Auth::user()->location=="Zambia") ? 'selected' : '' }}>Zambia</option>
<option value="Zimbabwe" {{ (Auth::user()->location=="Zimbabwe") ? 'selected' : '' }}>Zimbabwe</option>

</select>                    
                   </div>
                    <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 customDropDownInnerPg border-radius0Custom mb-4">
                        <label for="timeZone" class="font-familyAtlasGrotesk-Medium">Time Zone</label>
                        <select class="selectpicker border font-familyFreightTextProLight-Regular text-darkBlue" name="time_zone" id="time_zone">
                            <option value="" {{ (!$data['profile']->time_zone) ? 'selected' : '' }}>Select Time Zone</option>
                            <option value="Asia/Kabul" {{ ($data['profile']->time_zone == 'Asia/Kabul') ? 'selected' : '' }}>Asia/Kabul (GMT + 04:30)</option>
                            <option value="Europe/Tirane" {{ ($data['profile']->time_zone == 'Europe/Tirane') ? 'selected' : '' }}>Europe/Tirane (GMT + 01:00)</option>
                            <option value="Africa/Algiers" {{ ($data['profile']->time_zone == 'Africa/Algiers') ? 'selected' : '' }}>Africa/Algiers (GMT + 01:00)</option>
                            <option value="Pacific/Pago_Pago" {{ ($data['profile']->time_zone == 'Pacific/Pago_Pago') ? 'selected' : '' }}>Pacific/Pago_Pago (GMT - 11:00)</option>
                            <option value="Europe/Andorra" {{ ($data['profile']->time_zone == 'Europe/Andorra') ? 'selected' : '' }}>Europe/Andorra (GMT + 01:00)</option>
                            <option value="Africa/Luanda" {{ ($data['profile']->time_zone == 'Africa/Luanda') ? 'selected' : '' }}>Africa/Luanda (GMT + 01:00)</option>
                            <option value="America/Anguilla" {{ ($data['profile']->time_zone == 'America/Anguilla') ? 'selected' : '' }}>America/Anguilla (GMT - 04:00)</option>
                            <option value="Antarctica/Casey" {{ ($data['profile']->time_zone == 'Antarctica/Casey') ? 'selected' : '' }}>Antarctica/Casey (GMT + 11:00)</option>
                            <option value="Antarctica/Davis" {{ ($data['profile']->time_zone == 'Antarctica/Davis') ? 'selected' : '' }}>Antarctica/Davis (GMT + 07:00)</option>
                            <option value="Antarctica/DumontDUrville" {{ ($data['profile']->time_zone == 'Antarctica/DumontDUrville') ? 'selected' : '' }}>Antarctica/DumontDUrville (GMT + 10:00)</option>
                            <option value="Antarctica/Mawson" {{ ($data['profile']->time_zone == 'Antarctica/Mawson') ? 'selected' : '' }}>Antarctica/Mawson (GMT + 05:00)</option>
                            <option value="Antarctica/McMurdo" {{ ($data['profile']->time_zone == 'Antarctica/McMurdo') ? 'selected' : '' }}>Antarctica/McMurdo (GMT + 12:00)</option>
                            <option value="Antarctica/Palmer" {{ ($data['profile']->time_zone == 'Antarctica/Palmer') ? 'selected' : '' }}>Antarctica/Palmer (GMT - 03:00)</option>
                            <option value="Antarctica/Rothera" {{ ($data['profile']->time_zone == 'Antarctica/Rothera') ? 'selected' : '' }}>Antarctica/Rothera (GMT - 03:00)</option>
                            <option value="Antarctica/Syowa" {{ ($data['profile']->time_zone == 'Antarctica/Syowa') ? 'selected' : '' }}>Antarctica/Syowa (GMT + 03:00)</option>
                            <option value="Antarctica/Troll" {{ ($data['profile']->time_zone == 'Antarctica/Troll') ? 'selected' : '' }}>Antarctica/Troll (GMT + 02:00)</option>
                            <option value="Antarctica/Vostok" {{ ($data['profile']->time_zone == 'Antarctica/Vostok') ? 'selected' : '' }}>Antarctica/Vostok (GMT + 06:00)</option>
                            <option value="America/Antigua" {{ ($data['profile']->time_zone == 'America/Antigua') ? 'selected' : '' }}>America/Antigua (GMT - 04:00)</option>
                            <option value="America/Argentina/Buenos_Aires" {{ ($data['profile']->time_zone == 'America/Argentina/Buenos_Aires') ? 'selected' : '' }}>America/Argentina/Buenos_Aires (GMT - 03:00)</option>
                            <option value="America/Argentina/Catamarca" {{ ($data['profile']->time_zone == 'America/Argentina/Catamarca') ? 'selected' : '' }}>America/Argentina/Catamarca (GMT - 03:00)</option>
                            <option value="America/Argentina/Cordoba" {{ ($data['profile']->time_zone == 'America/Argentina/Cordoba') ? 'selected' : '' }}>America/Argentina/Cordoba (GMT - 03:00)</option>
                            <option value="America/Argentina/Jujuy" {{ ($data['profile']->time_zone == 'America/Argentina/Jujuy') ? 'selected' : '' }}>America/Argentina/Jujuy (GMT - 03:00)</option>
                            <option value="America/Argentina/La_Rioja" {{ ($data['profile']->time_zone == 'America/Argentina/La_Rioja') ? 'selected' : '' }}>America/Argentina/La_Rioja (GMT - 03:00)</option>
                            <option value="America/Argentina/Mendoza" {{ ($data['profile']->time_zone == 'America/Argentina/Mendoza') ? 'selected' : '' }}>America/Argentina/Mendoza (GMT - 03:00)</option>
                            <option value="America/Argentina/Rio_Gallegos" {{ ($data['profile']->time_zone == 'America/Argentina/Rio_Gallegos') ? 'selected' : '' }}>America/Argentina/Rio_Gallegos (GMT - 03:00)</option>
                            <option value="America/Argentina/Salta" {{ ($data['profile']->time_zone == 'America/Argentina/Salta') ? 'selected' : '' }}>America/Argentina/Salta (GMT - 03:00)</option>
                            <option value="America/Argentina/San_Juan" {{ ($data['profile']->time_zone == 'America/Argentina/San_Juan') ? 'selected' : '' }}>America/Argentina/San_Juan (GMT - 03:00)</option>
                            <option value="America/Argentina/San_Luis" {{ ($data['profile']->time_zone == 'America/Argentina/San_Luis') ? 'selected' : '' }}>America/Argentina/San_Luis (GMT - 03:00))</option>
                            <option value="America/Argentina/Tucuman" {{ ($data['profile']->time_zone == 'America/Argentina/Tucuman') ? 'selected' : '' }}>America/Argentina/Tucuman (GMT - 03:00)</option>
                            <option value="America/Argentina/Ushuaia" {{ ($data['profile']->time_zone == 'America/Argentina/Ushuaia') ? 'selected' : '' }}>America/Argentina/Ushuaia (GMT - 03:00)</option>
                            <option value="Asia/Yerevan" {{ ($data['profile']->time_zone == 'Asia/Yerevan') ? 'selected' : '' }}>Asia/Yerevan (GMT + 04:00)</option>
                            <option value="America/Aruba" {{ ($data['profile']->time_zone == 'America/Aruba') ? 'selected' : '' }}>America/Aruba (GMT - 04:00)</option>
                            <option value="Antarctica/Macquarie" {{ ($data['profile']->time_zone == 'Antarctica/Macquarie') ? 'selected' : '' }}>Antarctica/Macquarie (GMT + 10:00)</option>
                            <option value="Australia/Adelaide" {{ ($data['profile']->time_zone == 'Australia/Adelaide') ? 'selected' : '' }}>Australia/Adelaide (GMT + 09:30)</option>
                            <option value="Australia/Brisbane" {{ ($data['profile']->time_zone == 'Australia/Brisbane') ? 'selected' : '' }}>Australia/Brisbane (GMT + 10:00)</option>
                            <option value="Australia/Broken_Hill" {{ ($data['profile']->time_zone == 'Australia/Broken_Hill') ? 'selected' : '' }}>Australia/Broken_Hill (GMT + 09:30)</option>
                            <option value="Australia/Currie" {{ ($data['profile']->time_zone == 'Australia/Currie') ? 'selected' : '' }}>Australia/Currie (GMT + 10:00)</option>
                            <option value="Australia/Darwin" {{ ($data['profile']->time_zone == 'Australia/Darwin') ? 'selected' : '' }}>Australia/Darwin (GMT + 09:30)</option>
                            <option value="Australia/Eucla" {{ ($data['profile']->time_zone == 'Australia/Eucla') ? 'selected' : '' }}>Australia/Eucla (GMT + 08:45)</option>
                            <option value="Australia/Hobart" {{ ($data['profile']->time_zone == 'Australia/Hobart') ? 'selected' : '' }}>Australia/Hobart (GMT + 11:00)</option>
                            <option value="Australia/Lindeman" {{ ($data['profile']->time_zone == 'Australia/Lindeman') ? 'selected' : '' }}>Australia/Lindeman (GMT + 10:00)</option>
                            <option value="Australia/Lord_Howe" {{ ($data['profile']->time_zone == 'Australia/Lord_Howe') ? 'selected' : '' }}>Australia/Lord_Howe (GMT + 10:30)</option>
                            <option value="Australia/Melbourne" {{ ($data['profile']->time_zone == 'Australia/Melbourne') ? 'selected' : '' }}>Australia/Melbourne (GMT + 10:00)</option>
                            <option value="Australia/Perth" {{ ($data['profile']->time_zone == 'Australia/Perth') ? 'selected' : '' }}>Australia/Perth (GMT + 08:00)</option>
                            <option value="Australia/Sydney" {{ ($data['profile']->time_zone == 'Australia/Sydney') ? 'selected' : '' }}>Australia/Sydney (GMT + 10:00)</option>
                            <option value="Europe/Vienna" {{ ($data['profile']->time_zone == 'Europe/Vienna') ? 'selected' : '' }}>Europe/Vienna (GMT + 10:00)</option>
                            <option value="Asia/Baku" {{ ($data['profile']->time_zone == 'Asia/Baku') ? 'selected' : '' }}>Asia/Baku (GMT + 10:00)</option>
                            <option value="America/Nassau" {{ ($data['profile']->time_zone == 'America/Nassau') ? 'selected' : '' }}>America/Nassau (GMT + 10:00)</option>
                            <option value="Asia/Bahrain" {{ ($data['profile']->time_zone == 'Asia/Bahrain') ? 'selected' : '' }}>Asia/Bahrain (GMT + 10:00)</option>
                            <option value="Asia/Dhaka" {{ ($data['profile']->time_zone == 'Asia/Dhaka') ? 'selected' : '' }}>Asia/Dhaka (GMT + 10:00)</option>
                            <option value="America/Barbados" {{ ($data['profile']->time_zone == 'America/Barbados') ? 'selected' : '' }}>America/Barbados (GMT + 10:00)</option>
                            <option value="Europe/Minsk" {{ ($data['profile']->time_zone == 'Europe/Minsk') ? 'selected' : '' }}>Europe/Minsk (GMT + 10:00)</option>
                            <option value="Europe/Brussels" {{ ($data['profile']->time_zone == 'Europe/Brussels') ? 'selected' : '' }}>Europe/Brussels (GMT + 10:00)</option>
                            <option value="America/Belize" {{ ($data['profile']->time_zone == 'America/Belize') ? 'selected' : '' }}>America/Belize (GMT - 06:00)</option>
                            <option value="Africa/Porto-Novo" {{ ($data['profile']->time_zone == 'Africa/Porto-Novo') ? 'selected' : '' }}>Africa/Porto-Novo (GMT + 01:00)</option>
                            <option value="Atlantic/Bermuda" {{ ($data['profile']->time_zone == 'Atlantic/Bermuda') ? 'selected' : '' }}>Atlantic/Bermuda (GMT - 04:00)</option>
                            <option value="Asia/Thimphu" {{ ($data['profile']->time_zone == 'Asia/Thimphu') ? 'selected' : '' }}>Asia/Thimphu (GMT - 04:00)</option>
                            <option value="America/La_Paz" {{ ($data['profile']->time_zone == 'America/La_Paz') ? 'selected' : '' }}>America/La_Paz (GMT - 04:00)</option>
                            <option value="America/Kralendijk" {{ ($data['profile']->time_zone == 'America/Kralendijk') ? 'selected' : '' }}>America/Kralendijk (GMT - 04:00)</option>
                            <option value="Europe/Sarajevo" {{ ($data['profile']->time_zone == 'Europe/Sarajevo') ? 'selected' : '' }}>Europe/Sarajevo (GMT + 02:00)</option>
                            <option value="Africa/Gaborone" {{ ($data['profile']->time_zone == 'Africa/Gaborone') ? 'selected' : '' }}>Africa/Gaborone (GMT + 02:00)</option>
                            <option value="America/Araguaina" {{ ($data['profile']->time_zone == 'America/Araguaina') ? 'selected' : '' }}>America/Araguaina (GMT - 03:00)</option>
                            <option value="America/Bahia" {{ ($data['profile']->time_zone == 'America/Bahia') ? 'selected' : '' }}>America/Bahia (GMT - 03:00)</option>
                            <option value="America/Belem" {{ ($data['profile']->time_zone == 'America/Belem') ? 'selected' : '' }}>America/Belem (GMT - 03:00)</option>
                            <option value="America/Boa_Vista" {{ ($data['profile']->time_zone == 'America/Boa_Vista') ? 'selected' : '' }}>America/Boa_Vista (GMT - 04:00)</option>
                            <option value="America/Campo_Grande" {{ ($data['profile']->time_zone == 'America/Campo_Grande') ? 'selected' : '' }}>America/Campo_Grande (GMT - 04:00)</option>
                            <option value="America/Cuiaba" {{ ($data['profile']->time_zone == 'America/Cuiaba') ? 'selected' : '' }}>America/Cuiaba (GMT - 04:00)</option>
                            <option value="America/Eirunepe" {{ ($data['profile']->time_zone == 'America/Eirunepe') ? 'selected' : '' }}>America/Eirunepe (GMT - 05:00)</option>
                            <option value="America/Fortaleza" {{ ($data['profile']->time_zone == 'America/Fortaleza') ? 'selected' : '' }}>America/Fortaleza (GMT - 03:00)</option>
                            <option value="America/Maceio" {{ ($data['profile']->time_zone == 'America/Maceio') ? 'selected' : '' }}>America/Maceio (GMT - 03:00)</option>
                            <option value="America/Manaus" {{ ($data['profile']->time_zone == 'America/Manaus') ? 'selected' : '' }}>America/Manaus (GMT - 04:00)</option>
                            <option value="America/Noronha" {{ ($data['profile']->time_zone == 'America/Noronha') ? 'selected' : '' }}>America/Noronha (GMT - 02:00)</option>
                            <option value="America/Porto_Velho" {{ ($data['profile']->time_zone == 'America/Porto_Velho') ? 'selected' : '' }}>America/Porto_Velho (GMT - 04:00)</option>
                            <option value="America/Recife" {{ ($data['profile']->time_zone == 'America/Recife') ? 'selected' : '' }}>America/Recife (GMT - 03:00)</option>
                            <option value="America/Rio_Branco" {{ ($data['profile']->time_zone == 'America/Rio_Branco') ? 'selected' : '' }}>America/Rio_Branco (GMT - 05:00)</option>
                            <option value="America/Santarem" {{ ($data['profile']->time_zone == 'America/Santarem') ? 'selected' : '' }}>America/Santarem (GMT - 03:00)</option>
                            <option value="America/Sao_Paulo" {{ ($data['profile']->time_zone == 'America/Sao_Paulo') ? 'selected' : '' }}>America/Sao_Paulo (GMT - 03:00)</option>
                            <option value="Indian/Chagos" {{ ($data['profile']->time_zone == 'Indian/Chagos') ? 'selected' : '' }}>Indian/Chagos (GMT + 06:00)</option>
                            <option value="Asia/Brunei" {{ ($data['profile']->time_zone == 'Asia/Brunei') ? 'selected' : '' }}>Asia/Brunei (GMT + 08:00)</option>
                            <option value="Europe/Sofia" {{ ($data['profile']->time_zone == 'Europe/Sofia') ? 'selected' : '' }}>Europe/Sofia (GMT + 02:00)</option>
                            <option value="Africa/Ouagadougou" {{ ($data['profile']->time_zone == 'Africa/Ouagadougou') ? 'selected' : '' }}>Africa/Ouagadougou (GMT + 00:00)</option>
                            <option value="Africa/Bujumbura" {{ ($data['profile']->time_zone == 'Africa/Bujumbura') ? 'selected' : '' }}>Africa/Bujumbura (GMT + 02:00)</option>
                            <option value="Asia/Phnom_Penh" {{ ($data['profile']->time_zone == 'Asia/Phnom_Penh') ? 'selected' : '' }}>Asia/Phnom_Penh (GMT + 07:00)</option>
                            <option value="Africa/Douala" {{ ($data['profile']->time_zone == 'Africa/Douala') ? 'selected' : '' }}>Africa/Douala (GMT + 01:00)</option>
                            <option value="America/Atikokan" {{ ($data['profile']->time_zone == 'America/Atikokan') ? 'selected' : '' }}>America/Atikokan (GMT - 05:00)</option>
                            <option value="America/Blanc-Sablon" {{ ($data['profile']->time_zone == 'America/Blanc-Sablon') ? 'selected' : '' }}>America/Blanc-Sablon (GMT - 04:00)</option>
                            <option value="America/Cambridge_Bay" {{ ($data['profile']->time_zone == 'America/Cambridge_Bay') ? 'selected' : '' }}>America/Cambridge_Bay (GMT - 07:00)</option>
                            <option value="America/Creston" {{ ($data['profile']->time_zone == 'America/Creston') ? 'selected' : '' }}>America/Creston (GMT - 07:00)</option>
                            <option value="America/Dawson" {{ ($data['profile']->time_zone == 'America/Dawson') ? 'selected' : '' }}>America/Dawson (GMT - 07:00)</option>
                            <option value="America/Dawson_Creek" {{ ($data['profile']->time_zone == 'America/Dawson_Creek') ? 'selected' : '' }}>America/Dawson_Creek (GMT - 07:00)</option>
                            <option value="America/Edmonton" {{ ($data['profile']->time_zone == 'America/Edmonton') ? 'selected' : '' }}>America/Edmonton (GMT - 07:00)</option>
                            <option value="America/Fort_Nelson" {{ ($data['profile']->time_zone == 'America/Fort_Nelson') ? 'selected' : '' }}>America/Fort_Nelson (GMT - 07:00)</option>
                            <option value="America/Glace_Bay" {{ ($data['profile']->time_zone == 'America/Glace_Bay') ? 'selected' : '' }}>America/Glace_Bay (GMT - 04:00)</option>
                            <option value="America/Goose_Bay" {{ ($data['profile']->time_zone == 'America/Goose_Bay') ? 'selected' : '' }}>America/Goose_Bay (GMT - 04:00)</option>
                            <option value="America/Halifax" {{ ($data['profile']->time_zone == 'America/Halifax') ? 'selected' : '' }}>America/Halifax (GMT - 04:00)</option>
                            <option value="America/Inuvik" {{ ($data['profile']->time_zone == 'America/Inuvik') ? 'selected' : '' }}>America/Inuvik (GMT - 07:00)</option>
                            <option value="America/Iqaluit" {{ ($data['profile']->time_zone == 'America/Iqaluit') ? 'selected' : '' }}>America/Iqaluit (GMT - 05:00)</option>
                            <option value="America/Moncton" {{ ($data['profile']->time_zone == 'America/Moncton') ? 'selected' : '' }}>America/Moncton (GMT - 04:00)</option>
                            <option value="America/Nipigon" {{ ($data['profile']->time_zone == 'America/Nipigon') ? 'selected' : '' }}>America/Nipigon (GMT - 05:00)</option>
                            <option value="America/Pangnirtung" {{ ($data['profile']->time_zone == 'America/Pangnirtung') ? 'selected' : '' }}>America/Pangnirtung (GMT - 05:00)</option>
                            <option value="America/Rainy_River" {{ ($data['profile']->time_zone == 'America/Rainy_River') ? 'selected' : '' }}>America/Rainy_River (GMT - 06:00)</option>
                            <option value="America/Rankin_Inlet" {{ ($data['profile']->time_zone == 'America/Rankin_Inlet') ? 'selected' : '' }}>America/Rankin_Inlet (GMT - 06:00)</option>
                            <option value="America/Regina" {{ ($data['profile']->time_zone == 'America/Regina') ? 'selected' : '' }}>America/Regina (GMT - 06:00)</option>
                            <option value="America/Resolute" {{ ($data['profile']->time_zone == 'America/Resolute') ? 'selected' : '' }}>America/Resolute (GMT - 06:00)</option>
                            <option value="America/St_Johns" {{ ($data['profile']->time_zone == 'America/St_Johns') ? 'selected' : '' }}>America/St_Johns (GMT - 03:30)</option>
                            <option value="America/Swift_Current" {{ ($data['profile']->time_zone == 'America/Swift_Current') ? 'selected' : '' }}>America/Swift_Current (GMT - 06:00)</option>
                            <option value="America/Thunder_Bay" {{ ($data['profile']->time_zone == 'America/Thunder_Bay') ? 'selected' : '' }}>America/Thunder_Bay (GMT - 05:00)</option>
                            <option value="America/Toronto" {{ ($data['profile']->time_zone == 'America/Toronto') ? 'selected' : '' }}>America/Toronto (GMT - 05:00)</option>
                            <option value="America/Vancouver" {{ ($data['profile']->time_zone == 'America/Vancouver') ? 'selected' : '' }}>America/Vancouver (GMT - 08:00)</option>
                            <option value="America/Whitehorse" {{ ($data['profile']->time_zone == 'America/Whitehorse') ? 'selected' : '' }}>America/Whitehorse (GMT - 07:00)</option>
                            <option value="America/Winnipeg" {{ ($data['profile']->time_zone == 'America/Winnipeg') ? 'selected' : '' }}>America/Winnipeg (GMT - 06:00)</option>
                            <option value="America/Yellowknife" {{ ($data['profile']->time_zone == 'America/Yellowknife') ? 'selected' : '' }}>America/Yellowknife (GMT - 07:00)</option>
                            <option value="Atlantic/Cape_Verde" {{ ($data['profile']->time_zone == 'Atlantic/Cape_Verde') ? 'selected' : '' }}>Atlantic/Cape_Verde (GMT - 01:00)</option>
                            <option value="America/Cayman" {{ ($data['profile']->time_zone == 'America/Cayman') ? 'selected' : '' }}>America/Cayman (GMT - 01:00)</option>
                            <option value="Africa/Bangui" {{ ($data['profile']->time_zone == 'Africa/Bangui') ? 'selected' : '' }}>Africa/Bangui (GMT + 01:00)</option>
                            <option value="Africa/Ndjamena" {{ ($data['profile']->time_zone == 'Africa/Ndjamena') ? 'selected' : '' }}>Africa/Ndjamena (GMT + 01:00)</option>
                            <option value="America/Punta_Arenas" {{ ($data['profile']->time_zone == 'America/Punta_Arenas') ? 'selected' : '' }}>America/Punta_Arenas (GMT - 03:00)</option>
                            <option value="America/Santiago" {{ ($data['profile']->time_zone == 'America/Santiago') ? 'selected' : '' }}>America/Santiago (GMT - 04:00)</option>
                            <option value="Pacific/Easter" {{ ($data['profile']->time_zone == 'Pacific/Easter') ? 'selected' : '' }}>Pacific/Easter (GMT + 06:00)</option>
                            <option value="Asia/Shanghai" {{ ($data['profile']->time_zone == 'Asia/Shanghai') ? 'selected' : '' }}>Asia/Shanghai (GMT + 08:00)</option>
                            <option value="Asia/Urumqi" {{ ($data['profile']->time_zone == 'Asia/Urumqi') ? 'selected' : '' }}>Asia/Urumqi (GMT + 06:00)</option>
                            <option value="Indian/Christmas" {{ ($data['profile']->time_zone == 'Indian/Christmas') ? 'selected' : '' }}>Indian/Christmas (GMT + 07:00)</option>
                            <option value="Indian/Cocos" {{ ($data['profile']->time_zone == 'Indian/Cocos') ? 'selected' : '' }}>Indian/Cocos (GMT + 06:30)</option>
                            <option value="America/Bogota" {{ ($data['profile']->time_zone == 'America/Bogota') ? 'selected' : '' }}>America/Bogota (GMT - 05:00)</option>
                            <option value="Indian/Comoro" {{ ($data['profile']->time_zone == 'Indian/Comoro') ? 'selected' : '' }}>Indian/Comoro (GMT + 03:00)</option>
                            <option value="Africa/Brazzaville" {{ ($data['profile']->time_zone == 'Africa/Brazzaville') ? 'selected' : '' }}>Africa/Brazzaville (GMT + 01:00)</option>
                            <option value="Africa/Kinshasa" {{ ($data['profile']->time_zone == 'Africa/Kinshasa') ? 'selected' : '' }}>Africa/Kinshasa (GMT + 01:00)</option>
                            <option value="Africa/Lubumbashi" {{ ($data['profile']->time_zone == 'Africa/Lubumbashi') ? 'selected' : '' }}>Africa/Lubumbashi (GMT + 02:00)</option>
                            <option value="Pacific/Rarotonga" {{ ($data['profile']->time_zone == 'Pacific/Rarotonga') ? 'selected' : '' }}>Pacific/Rarotonga (GMT - 10:00)</option>
                            <option value="America/Costa_Rica" {{ ($data['profile']->time_zone == 'America/Costa_Rica') ? 'selected' : '' }}>America/Costa_Rica (GMT - 06:00)</option>
                            <option value="Europe/Zagreb" {{ ($data['profile']->time_zone == 'Europe/Zagreb') ? 'selected' : '' }}>Europe/Zagreb (GMT + 02:00)</option>
                            <option value="America/Havana" {{ ($data['profile']->time_zone == 'America/Havana') ? 'selected' : '' }}>America/Havana (GMT - 05:00)</option>
                            <option value="America/Curacao" {{ ($data['profile']->time_zone == 'America/Curacao') ? 'selected' : '' }}>America/Curacao (GMT - 04:00)</option>
                            <option value="Asia/Famagusta" {{ ($data['profile']->time_zone == 'Asia/Famagusta') ? 'selected' : '' }}>Asia/Famagusta (GMT + 03:00)</option>
                            <option value="Asia/Nicosia" {{ ($data['profile']->time_zone == 'Asia/Nicosia') ? 'selected' : '' }}>Asia/Nicosia (GMT + 03:00)</option>
                            <option value="Europe/Prague" {{ ($data['profile']->time_zone == 'Europe/Prague') ? 'selected' : '' }}>Europe/Prague (GMT + 01:00)</option>
                            <option value="Africa/Abidjan" {{ ($data['profile']->time_zone == 'Africa/Abidjan') ? 'selected' : '' }}>Africa/Abidjan (GMT + 00:00)</option>
                            <option value="Europe/Copenhagen" {{ ($data['profile']->time_zone == 'Europe/Copenhagen') ? 'selected' : '' }}>Europe/Copenhagen (GMT + 01:00)</option>
                            <option value="Africa/Djibouti" {{ ($data['profile']->time_zone == 'Africa/Djibouti') ? 'selected' : '' }}>Africa/Djibouti (GMT + 03:00)</option>
                            <option value="America/Dominica" {{ ($data['profile']->time_zone == 'America/Dominica') ? 'selected' : '' }}>America/Dominica (GMT - 04:00)</option>
                            <option value="America/Santo_Domingo" {{ ($data['profile']->time_zone == 'America/Santo_Domingo') ? 'selected' : '' }}>America/Santo_Domingo (GMT + 02:00)</option>
                            <option value="America/Guayaquil" {{ ($data['profile']->time_zone == 'America/Guayaquil') ? 'selected' : '' }}>America/Guayaquil (GMT - 04:00)</option>
                            <option value="Pacific/Galapagos" {{ ($data['profile']->time_zone == 'Pacific/Galapagos') ? 'selected' : '' }}>Pacific/Galapagos (GMT - 06:00)</option>
                            <option value="Africa/Cairo" {{ ($data['profile']->time_zone == 'Africa/Cairo') ? 'selected' : '' }}>Africa/Cairo (GMT + 02:00)</option>
                            <option value="America/El_Salvador" {{ ($data['profile']->time_zone == 'America/El_Salvador') ? 'selected' : '' }}>America/El_Salvador (GMT + 02:00)</option>
                            <option value="Africa/Malabo" {{ ($data['profile']->time_zone == 'Africa/Malabo') ? 'selected' : '' }}>Africa/Malabo (GMT + 01:00)</option>
                            <option value="Africa/Asmara" {{ ($data['profile']->time_zone == 'Africa/Asmara') ? 'selected' : '' }}>Africa/Asmara (GMT + 03:00)</option>
                            <option value="Europe/Tallinn" {{ ($data['profile']->time_zone == 'Europe/Tallinn') ? 'selected' : '' }}>Europe/Tallinn (GMT + 02:00)</option>
                            <option value="Africa/Addis_Ababa" {{ ($data['profile']->time_zone == 'Africa/Addis_Ababa') ? 'selected' : '' }}>Africa/Addis_Ababa (GMT + 03:00)</option>
                            <option value="Atlantic/Stanley" {{ ($data['profile']->time_zone == 'Atlantic/Stanley') ? 'selected' : '' }}>Atlantic/Stanley (GMT - 03:00)</option>
                            <option value="Atlantic/Faroe" {{ ($data['profile']->time_zone == 'Atlantic/Faroe') ? 'selected' : '' }}>Atlantic/Faroe (GMT + 01:00)</option>
                            <option value="Pacific/Fiji" {{ ($data['profile']->time_zone == 'Pacific/Fiji') ? 'selected' : '' }}>Pacific/Fiji (GMT + 12:00)</option>
                            <option value="Europe/Helsinki" {{ ($data['profile']->time_zone == 'Europe/Helsinki') ? 'selected' : '' }}>Europe/Helsinki (GMT + 02:00)</option>
                            <option value="Europe/Paris" {{ ($data['profile']->time_zone == 'Europe/Paris') ? 'selected' : '' }}>Europe/Paris (GMT + 01:00)</option>
                            <option value="America/Cayenne" {{ ($data['profile']->time_zone == 'America/Cayenne') ? 'selected' : '' }}>America/Cayenne (GMT - 03:00)</option>
                            <option value="Pacific/Gambier" {{ ($data['profile']->time_zone == 'Pacific/Gambier') ? 'selected' : '' }}>Pacific/Gambier (GMT - 09:00)</option>
                            <option value="Pacific/Marquesas" {{ ($data['profile']->time_zone == 'Pacific/Marquesas') ? 'selected' : '' }}>Pacific/Marquesas (GMT - 10:30)</option>
                            <option value="Pacific/Tahiti" {{ ($data['profile']->time_zone == 'Pacific/Tahiti') ? 'selected' : '' }}>Pacific/Tahiti (GMT - 10:00)</option>
                            <option value="Indian/Kerguelen" {{ ($data['profile']->time_zone == 'Indian/Kerguelen') ? 'selected' : '' }}>Indian/Kerguelen (GMT + 05:00)</option>
                            <option value="Africa/Libreville" {{ ($data['profile']->time_zone == 'Africa/Libreville') ? 'selected' : '' }}>Africa/Libreville (GMT + 01:00)</option>
                            <option value="Africa/Banjul" {{ ($data['profile']->time_zone == 'Africa/Banjul') ? 'selected' : '' }}>Africa/Banjul (GMT + 00:00)</option>
                            <option value="Asia/Tbilisi" {{ ($data['profile']->time_zone == 'Asia/Tbilisi') ? 'selected' : '' }}>Asia/Tbilisi (GMT + 04:00)</option>
                            <option value="Europe/Berlin" {{ ($data['profile']->time_zone == 'Europe/Berlin') ? 'selected' : '' }}>Europe/Berlin (GMT + 02:00)</option>
                            <option value="Europe/Busingen" {{ ($data['profile']->time_zone == 'Europe/Busingen') ? 'selected' : '' }}>Europe/Busingen (GMT + 02:00)</option>
                            <option value="Africa/Accra" {{ ($data['profile']->time_zone == 'Africa/Accra') ? 'selected' : '' }}>Africa/Accra (GMT + 00:00)</option>
                            <option value="Europe/Gibraltar" {{ ($data['profile']->time_zone == 'Europe/Gibraltar') ? 'selected' : '' }}>Europe/Gibraltar (GMT + 01:00)</option>
                            <option value="Europe/Athens" {{ ($data['profile']->time_zone == 'Europe/Athens') ? 'selected' : '' }}>Europe/Athens (GMT + 02:00)</option>
                            <option value="America/Danmarkshavn" {{ ($data['profile']->time_zone == 'America/Danmarkshavn') ? 'selected' : '' }}>America/Danmarkshavn (GMT + 00:00)</option>
                            <option value="America/Nuuk" {{ ($data['profile']->time_zone == 'America/Nuuk') ? 'selected' : '' }}>America/Nuuk</option>
                            <option value="America/Scoresbysund" {{ ($data['profile']->time_zone == 'America/Scoresbysund') ? 'selected' : '' }}>America/Scoresbysund (GMT - 01:00)</option>
                            <option value="America/Thule" {{ ($data['profile']->time_zone == 'America/Thule') ? 'selected' : '' }}>America/Thule (GMT - 04:00)</option>
                            <option value="America/Grenada" {{ ($data['profile']->time_zone == 'America/Grenada') ? 'selected' : '' }}>America/Grenada (GMT - 04:00)</option>
                            <option value="America/Guadeloupe" {{ ($data['profile']->time_zone == 'America/Guadeloupe') ? 'selected' : '' }}>America/Guadeloupe (GMT - 04:00)</option>
                            <option value="Pacific/Guam" {{ ($data['profile']->time_zone == 'Pacific/Guam') ? 'selected' : '' }}>Pacific/Guam (GMT + 10:00)</option>
                            <option value="America/Guatemala" {{ ($data['profile']->time_zone == 'America/Guatemala') ? 'selected' : '' }}>America/Guatemala (GMT + 10:00)</option>
                            <option value="Europe/Guernsey" {{ ($data['profile']->time_zone == 'Europe/Guernsey') ? 'selected' : '' }}>Europe/Guernsey (GMT + 00:00)</option>
                            <option value="Africa/Conakry" {{ ($data['profile']->time_zone == 'Africa/Conakry') ? 'selected' : '' }}>Africa/Conakry (GMT + 00:00)</option>
                            <option value="Africa/Bissau" {{ ($data['profile']->time_zone == 'Africa/Bissau') ? 'selected' : '' }}>Africa/Bissau (GMT + 00:00)</option>
                            <option value="America/Guyana" {{ ($data['profile']->time_zone == 'America/Guyana') ? 'selected' : '' }}>America/Guyana (GMT - 04:00)</option>
                            <option value="America/Port-au-Prince" {{ ($data['profile']->time_zone == 'America/Port-au-Prince') ? 'selected' : '' }}>America/Port-au-Prince (GMT - 05:00)</option>
                            <option value="Europe/Vatican" {{ ($data['profile']->time_zone == 'Europe/Vatican') ? 'selected' : '' }}>Europe/Vatican (GMT + 02:00)</option>
                            <option value="America/Tegucigalpa" {{ ($data['profile']->time_zone == 'America/Tegucigalpa') ? 'selected' : '' }}>America/Tegucigalpa (GMT - 06:00)</option>
                            <option value="Asia/Hong_Kong" {{ ($data['profile']->time_zone == 'Asia/Hong_Kong') ? 'selected' : '' }}>Asia/Hong_Kong (GMT + 08:00)</option>
                            <option value="Europe/Budapest" {{ ($data['profile']->time_zone == 'Europe/Budapest') ? 'selected' : '' }}>Europe/Budapest (GMT + 02:00)</option>
                            <option value="Atlantic/Reykjavik" {{ ($data['profile']->time_zone == 'Atlantic/Reykjavik') ? 'selected' : '' }}>Atlantic/Reykjavik (GMT + 00:00)</option>
                            <option value="Asia/Kolkata" {{ ($data['profile']->time_zone == 'Asia/Kolkata') ? 'selected' : '' }}>Asia/Kolkata (GMT + 05:30)</option>
                            <option value="Asia/Jakarta" {{ ($data['profile']->time_zone == 'Asia/Jakarta') ? 'selected' : '' }}>Asia/Jakarta (GMT + 07:00)</option>
                            <option value="Asia/Jayapura" {{ ($data['profile']->time_zone == 'Asia/Jayapura') ? 'selected' : '' }}>Asia/Jayapura (GMT + 09:00)</option>
                            <option value="Asia/Makassar" {{ ($data['profile']->time_zone == 'Asia/Makassar') ? 'selected' : '' }}>Asia/Makassar (GMT + 08:00)</option>
                            <option value="Asia/Pontianak" {{ ($data['profile']->time_zone == 'Asia/Pontianak') ? 'selected' : '' }}>Asia/Pontianak (GMT + 07:00)</option>
                            <option value="Asia/Tehran" {{ ($data['profile']->time_zone == 'Asia/Tehran') ? 'selected' : '' }}>Asia/Tehran (GMT + 03:30)</option>
                            <option value="Asia/Baghdad" {{ ($data['profile']->time_zone == 'Asia/Baghdad') ? 'selected' : '' }}>Asia/Baghdad (GMT + 03:00)</option>
                            <option value="Europe/Dublin" {{ ($data['profile']->time_zone == 'Europe/Dublin') ? 'selected' : '' }}>Europe/Dublin (GMT + 00:00)</option>
                            <option value="Europe/Isle_of_Man" {{ ($data['profile']->time_zone == 'Europe/Isle_of_Man') ? 'selected' : '' }}>Europe/Isle_of_Man (GMT + 00:00)</option>
                            <option value="Asia/Jerusalem" {{ ($data['profile']->time_zone == 'Asia/Jerusalem') ? 'selected' : '' }}>Asia/Jerusalem (GMT + 02:00)</option>
                            <option value="Europe/Rome" {{ ($data['profile']->time_zone == 'Europe/Rome') ? 'selected' : '' }}>Europe/Rome (GMT + 01:00)</option>
                            <option value="America/Jamaica" {{ ($data['profile']->time_zone == 'America/Jamaica') ? 'selected' : '' }}>America/Jamaica (GMT + 02:00)</option>
                            <option value="Asia/Tokyo" {{ ($data['profile']->time_zone == 'Asia/Tokyo') ? 'selected' : '' }}>Asia/Tokyo (GMT - 05:00)</option>
                            <option value="Europe/Jersey" {{ ($data['profile']->time_zone == 'Europe/Jersey') ? 'selected' : '' }}>Europe/Jersey (GMT + 00:00)</option>
                            <option value="Asia/Amman" {{ ($data['profile']->time_zone == 'Asia/Amman') ? 'selected' : '' }}>Asia/Amman (GMT + 02:00)</option>
                            <option value="Asia/Almaty" {{ ($data['profile']->time_zone == 'Asia/Almaty') ? 'selected' : '' }}>Asia/Almaty (GMT + 06:00)</option>
                            <option value="Asia/Aqtau" {{ ($data['profile']->time_zone == 'Asia/Aqtau') ? 'selected' : '' }}>Asia/Aqtau (GMT + 05:00)</option>
                            <option value="Asia/Aqtobe" {{ ($data['profile']->time_zone == 'Asia/Aqtobe') ? 'selected' : '' }}>Asia/Aqtobe (GMT + 05:00)</option>
                            <option value="Asia/Atyrau" {{ ($data['profile']->time_zone == 'Asia/Atyrau') ? 'selected' : '' }}>Asia/Atyrau (GMT + 05:00)</option>
                            <option value="Asia/Oral" {{ ($data['profile']->time_zone == 'Asia/Oral') ? 'selected' : '' }}>Asia/Oral (GMT + 05:00)</option>
                            <option value="Asia/Qostanay" {{ ($data['profile']->time_zone == 'Asia/Qostanay') ? 'selected' : '' }}>Asia/Qostanay (GMT + 06:00)</option>
                            <option value="Asia/Qyzylorda" {{ ($data['profile']->time_zone == 'Asia/Qyzylorda') ? 'selected' : '' }}>Asia/Qyzylorda (GMT + 05:00)</option>
                            <option value="Africa/Nairobi" {{ ($data['profile']->time_zone == 'Africa/Nairobi') ? 'selected' : '' }}>Africa/Nairobi (GMT + 03:00)</option>
                            <option value="Pacific/Enderbury" {{ ($data['profile']->time_zone == 'Pacific/Enderbury') ? 'selected' : '' }}>Pacific/Enderbury (GMT + 13:00)</option>
                            <option value="Pacific/Kiritimati" {{ ($data['profile']->time_zone == 'Pacific/Kiritimati') ? 'selected' : '' }}>Pacific/Kiritimati (GMT + 14:00)</option>
                            <option value="Pacific/Tarawa" {{ ($data['profile']->time_zone == 'Pacific/Tarawa') ? 'selected' : '' }}>Pacific/Tarawa (GMT + 12:00)</option>
                            <option value="Asia/Pyongyang" {{ ($data['profile']->time_zone == 'Asia/Pyongyang') ? 'selected' : '' }}>Asia/Pyongyang (GMT + 09:00)</option>
                            <option value="Asia/Seoul" {{ ($data['profile']->time_zone == 'Asia/Seoul') ? 'selected' : '' }}>Asia/Seoul (GMT + 09:00)</option>
                            <option value="Asia/Kuwait" {{ ($data['profile']->time_zone == 'Asia/Kuwait') ? 'selected' : '' }}>Asia/Kuwait (GMT + 03:00)</option>
                            <option value="Asia/Bishkek" {{ ($data['profile']->time_zone == 'Asia/Bishkek') ? 'selected' : '' }}>Asia/Bishkek (GMT + 06:00)</option>
                            <option value="Asia/Vientiane" {{ ($data['profile']->time_zone == 'Asia/Vientiane') ? 'selected' : '' }}>Asia/Vientiane (GMT + 07:00)</option>
                            <option value="Europe/Riga" {{ ($data['profile']->time_zone == 'Europe/Riga') ? 'selected' : '' }}>Europe/Riga (GMT + 02:00)</option>
                            <option value="Asia/Beirut" {{ ($data['profile']->time_zone == 'Asia/Beirut') ? 'selected' : '' }}>Asia/Beirut (GMT + 02:00)</option>
                            <option value="Africa/Maseru" {{ ($data['profile']->time_zone == 'Africa/Maseru') ? 'selected' : '' }}>Africa/Maseru (GMT + 02:00)</option>
                            <option value="Africa/Monrovia" {{ ($data['profile']->time_zone == 'Africa/Monrovia') ? 'selected' : '' }}>Africa/Monrovia (GMT + 00:00)</option>
                            <option value="Africa/Tripoli" {{ ($data['profile']->time_zone == 'Africa/Tripoli') ? 'selected' : '' }}>Africa/Tripoli (GMT + 02:00)</option>
                            <option value="Europe/Vaduz" {{ ($data['profile']->time_zone == 'Europe/Vaduz') ? 'selected' : '' }}>Europe/Vaduz (GMT + 02:00)</option>
                            <option value="Europe/Vilnius" {{ ($data['profile']->time_zone == 'Europe/Vilnius') ? 'selected' : '' }}>Europe/Vilnius (GMT + 03:00)</option>
                            <option value="Europe/Luxembourg" {{ ($data['profile']->time_zone == 'Europe/Luxembourg') ? 'selected' : '' }}>Europe/Luxembourg (GMT + 01:00)</option>
                            <option value="Asia/Macau" {{ ($data['profile']->time_zone == 'Asia/Macau') ? 'selected' : '' }}>Asia/Macau (GMT + 08:00)</option>
                            <option value="Europe/Skopje" {{ ($data['profile']->time_zone == 'Europe/Skopje') ? 'selected' : '' }}>Europe/Skopje (GMT + 01:00)</option>
                            <option value="Indian/Antananarivo" {{ ($data['profile']->time_zone == 'Indian/Antananarivo') ? 'selected' : '' }}>Indian/Antananarivo (GMT + 03:00)</option>
                            <option value="Africa/Blantyre" {{ ($data['profile']->time_zone == 'Africa/Blantyre') ? 'selected' : '' }}>Africa/Blantyre (GMT + 02:00)</option>
                            <option value="Asia/Kuala_Lumpur" {{ ($data['profile']->time_zone == 'Asia/Kuala_Lumpur') ? 'selected' : '' }}>Asia/Kuala_Lumpur (GMT + 08:00)</option>
                            <option value="Asia/Kuching" {{ ($data['profile']->time_zone == 'Asia/Kuching') ? 'selected' : '' }}>Asia/Kuching (GMT + 08:00)</option>
                            <option value="Indian/Maldives" {{ ($data['profile']->time_zone == 'Indian/Maldives') ? 'selected' : '' }}>Indian/Maldives (GMT + 05:00)</option>
                            <option value="Africa/Bamako" {{ ($data['profile']->time_zone == 'Africa/Bamako') ? 'selected' : '' }}>Africa/Bamako (GMT + 00:00)</option>
                            <option value="Europe/Malta" {{ ($data['profile']->time_zone == 'Europe/Malta') ? 'selected' : '' }}>Europe/Malta (GMT + 01:00)</option>
                            <option value="Pacific/Kwajalein" {{ ($data['profile']->time_zone == 'Pacific/Kwajalein') ? 'selected' : '' }}>Pacific/Kwajalein (GMT + 12:00)</option>
                            <option value="Pacific/Majuro" {{ ($data['profile']->time_zone == 'Pacific/Majuro') ? 'selected' : '' }}>Pacific/Majuro (GMT + 12:00)</option>
                            <option value="America/Martinique" {{ ($data['profile']->time_zone == 'America/Martinique') ? 'selected' : '' }}>America/Martinique (GMT - 04:00)</option>
                            <option value="Africa/Nouakchott" {{ ($data['profile']->time_zone == 'Africa/Nouakchott') ? 'selected' : '' }}>Africa/Nouakchott (GMT + 00:00)</option>
                            <option value="Indian/Mauritius" {{ ($data['profile']->time_zone == 'Indian/Mauritius') ? 'selected' : '' }}>Indian/Mauritius (GMT + 04:00)</option>
                            <option value="Indian/Mayotte" {{ ($data['profile']->time_zone == 'Indian/Mayotte') ? 'selected' : '' }}>Indian/Mayotte (GMT + 03:00)</option>
                            <option value="America/Bahia_Banderas" {{ ($data['profile']->time_zone == 'America/Bahia_Banderas') ? 'selected' : '' }}>America/Bahia_Banderas (GMT - 05:00)</option>
                            <option value="America/Cancun" {{ ($data['profile']->time_zone == 'America/Cancun') ? 'selected' : '' }}>America/Cancun (GMT - 05:00)</option>
                            <option value="America/Chihuahua" {{ ($data['profile']->time_zone == 'America/Chihuahua') ? 'selected' : '' }}>America/Chihuahua (GMT - 07:00)</option>
                            <option value="America/Hermosillo" {{ ($data['profile']->time_zone == 'America/Hermosillo') ? 'selected' : '' }}>America/Hermosillo (GMT - 07:00)</option>
                            <option value="America/Matamoros" {{ ($data['profile']->time_zone == 'America/Matamoros') ? 'selected' : '' }}>America/Matamoros (GMT - 06:00)</option>
                            <option value="America/Mazatlan" {{ ($data['profile']->time_zone == 'America/Mazatlan') ? 'selected' : '' }}>America/Mazatlan (GMT - 07:00)</option>
                            <option value="America/Merida" {{ ($data['profile']->time_zone == 'America/Merida') ? 'selected' : '' }}>America/Merida (GMT - 06:00)</option>
                            <option value="America/Mexico_City" {{ ($data['profile']->time_zone == 'America/Mexico_City') ? 'selected' : '' }}>America/Mexico_City (GMT - 06:00)</option>
                            <option value="America/Monterrey" {{ ($data['profile']->time_zone == 'America/Monterrey') ? 'selected' : '' }}>America/Monterrey GMT - 06:00)</option>
                            <option value="America/Ojinaga" {{ ($data['profile']->time_zone == 'America/Ojinaga') ? 'selected' : '' }}>America/Ojinaga (GMT - 07:00)</option>
                            <option value="America/Tijuana" {{ ($data['profile']->time_zone == 'America/Tijuana') ? 'selected' : '' }}>America/Tijuana (GMT - 08:00)</option>
                            <option value="Pacific/Chuuk" {{ ($data['profile']->time_zone == 'Pacific/Chuuk') ? 'selected' : '' }}>Pacific/Chuuk (GMT + 10:00)</option>
                            <option value="Pacific/Kosrae" {{ ($data['profile']->time_zone == 'Pacific/Kosrae') ? 'selected' : '' }}>Pacific/Kosrae (GMT + 11:00)</option>
                            <option value="Pacific/Pohnpei" {{ ($data['profile']->time_zone == 'Pacific/Pohnpei') ? 'selected' : '' }}>Pacific/Pohnpei (GMT + 11:00)</option>
                            <option value="Europe/Chisinau" {{ ($data['profile']->time_zone == 'Europe/Chisinau') ? 'selected' : '' }}>Europe/Chisinau (GMT + 02:00)</option>
                            <option value="Europe/Monaco" {{ ($data['profile']->time_zone == 'Europe/Monaco') ? 'selected' : '' }}>Europe/Monaco (GMT + 01:00)</option>
                            <option value="Asia/Choibalsan" {{ ($data['profile']->time_zone == 'Asia/Choibalsan') ? 'selected' : '' }}>Asia/Choibalsan (GMT + 08:00)</option>
                            <option value="Asia/Hovd" {{ ($data['profile']->time_zone == 'Asia/Hovd') ? 'selected' : '' }}>Asia/Hovd (GMT + 07:00)</option>
                            <option value="Asia/Ulaanbaatar" {{ ($data['profile']->time_zone == 'Asia/Ulaanbaatar') ? 'selected' : '' }}>Asia/Ulaanbaata (GMT + 08:00)r</option>
                            <option value="Europe/Podgorica" {{ ($data['profile']->time_zone == 'Europe/Podgorica') ? 'selected' : '' }}>Europe/Podgorica (GMT + 02:00)</option>
                            <option value="America/Montserrat" {{ ($data['profile']->time_zone == 'America/Montserrat') ? 'selected' : '' }}>America/Montserrat (GMT - 04:00)</option>
                            <option value="Africa/Casablanca" {{ ($data['profile']->time_zone == 'Africa/Casablanca') ? 'selected' : '' }}>Africa/Casablanca (GMT + 00:00)</option>
                            <option value="Africa/Maputo" {{ ($data['profile']->time_zone == 'Africa/Maputo') ? 'selected' : '' }}>Africa/Maputo (GMT + 02:00)</option>
                            <option value="Asia/Yangon" {{ ($data['profile']->time_zone == 'Asia/Yangon') ? 'selected' : '' }}>Asia/Yangon (GMT + 06:30)</option>
                            <option value="Africa/Windhoek" {{ ($data['profile']->time_zone == 'Africa/Windhoek') ? 'selected' : '' }}>Africa/Windhoek (GMT + 02:00)</option>
                            <option value="Pacific/Nauru" {{ ($data['profile']->time_zone == 'Pacific/Nauru') ? 'selected' : '' }}>Pacific/Nauru (GMT + 12:00)</option>
                            <option value="Asia/Kathmandu" {{ ($data['profile']->time_zone == 'Asia/Kathmandu') ? 'selected' : '' }}>Asia/Kathmandu (GMT + 05:45)</option>
                            <option value="Europe/Amsterdam" {{ ($data['profile']->time_zone == 'Europe/Amsterdam') ? 'selected' : '' }}>Europe/Amsterdam (GMT + 01:00)</option>
                            <option value="Pacific/Noumea" {{ ($data['profile']->time_zone == 'Pacific/Noumea') ? 'selected' : '' }}>Pacific/Noumea (GMT + 11:00)</option>
                            <option value="Pacific/Auckland" {{ ($data['profile']->time_zone == 'Pacific/Auckland') ? 'selected' : '' }}>Pacific/Auckland (GMT + 12:00)</option>
                            <option value="Pacific/Chatham" {{ ($data['profile']->time_zone == 'Pacific/Chatham') ? 'selected' : '' }}>Pacific/Chatham (GMT + 12:45)</option>
                            <option value="America/Managua" {{ ($data['profile']->time_zone == 'America/Managua') ? 'selected' : '' }}>America/Managua (GMT - 06:00)</option>
                            <option value="Africa/Niamey" {{ ($data['profile']->time_zone == 'Africa/Niamey') ? 'selected' : '' }}>Africa/Niamey (GMT + 01:00)</option>
                            <option value="Africa/Lagos" {{ ($data['profile']->time_zone == 'Africa/Lagos') ? 'selected' : '' }}>Africa/Lagos (GMT + 01:00)</option>
                            <option value="Pacific/Niue" {{ ($data['profile']->time_zone == 'Pacific/Niue') ? 'selected' : '' }}>Pacific/Niue (GMT - 11:00)</option>
                            <option value="Pacific/Norfolk" {{ ($data['profile']->time_zone == 'Pacific/Norfolk') ? 'selected' : '' }}>Pacific/Norfolk (GMT + 11:00)</option>
                            <option value="Pacific/Saipan" {{ ($data['profile']->time_zone == 'Pacific/Saipan') ? 'selected' : '' }}>Pacific/Saipan (GMT + 10:00)</option>
                            <option value="Europe/Oslo" {{ ($data['profile']->time_zone == 'Europe/Oslo') ? 'selected' : '' }}>Europe/Oslo (GMT + 01:00)</option>
                            <option value="Asia/Muscat" {{ ($data['profile']->time_zone == 'Asia/Muscat') ? 'selected' : '' }}>Asia/Muscat (GMT + 04:00)</option>
                            <option value="Asia/Karachi" {{ ($data['profile']->time_zone == 'Asia/Karachi') ? 'selected' : '' }}>Asia/Karachi (GMT + 05:00)</option>
                            <option value="Pacific/Palau" {{ ($data['profile']->time_zone == 'Pacific/Palau') ? 'selected' : '' }}>Pacific/Palau (GMT + 09:00)</option>
                            <option value="Asia/Gaza" {{ ($data['profile']->time_zone == 'Asia/Gaza') ? 'selected' : '' }}>Asia/Gaza (GMT + 02:00)</option>
                            <option value="Asia/Hebron" {{ ($data['profile']->time_zone == 'Asia/Hebron') ? 'selected' : '' }}>Asia/Hebron (GMT + 02:00)</option>
                            <option value="America/Panama" {{ ($data['profile']->time_zone == 'America/Panama') ? 'selected' : '' }}>America/Panama (GMT - 05:00)</option>
                            <option value="Pacific/Bougainville" {{ ($data['profile']->time_zone == 'Pacific/Bougainville') ? 'selected' : '' }}>Pacific/Bougainville (GMT + 11:00)</option>
                            <option value="Pacific/Port_Moresby" {{ ($data['profile']->time_zone == 'Pacific/Port_Moresby') ? 'selected' : '' }}>Pacific/Port_Moresby (GMT + 10:00)</option>
                            <option value="America/Asuncion" {{ ($data['profile']->time_zone == 'America/Asuncion') ? 'selected' : '' }}>America/Asuncion (GMT - 04:00)</option>
                            <option value="America/Lima" {{ ($data['profile']->time_zone == 'America/Lima') ? 'selected' : '' }}>America/Lima (GMT - 05:00)</option>
                            <option value="Asia/Manila" {{ ($data['profile']->time_zone == 'Asia/Manila') ? 'selected' : '' }}>Asia/Manila (GMT + 08:00)</option>
                            <option value="Pacific/Pitcairn" {{ ($data['profile']->time_zone == 'Pacific/Pitcairn') ? 'selected' : '' }}>Pacific/Pitcairn (GMT + 02:00)</option>
                            <option value="Europe/Warsaw" {{ ($data['profile']->time_zone == 'Europe/Warsaw') ? 'selected' : '' }}>Europe/Warsaw (GMT - 08:00)</option>
                            <option value="Atlantic/Azores" {{ ($data['profile']->time_zone == 'Atlantic/Azores') ? 'selected' : '' }}>Atlantic/Azores (GMT - 01:00)</option>
                            <option value="Atlantic/Madeira" {{ ($data['profile']->time_zone == 'Atlantic/Madeira') ? 'selected' : '' }}>Atlantic/Madeira (GMT + 01:00)</option>
                            <option value="Europe/Lisbon" {{ ($data['profile']->time_zone == 'Europe/Lisbon') ? 'selected' : '' }}>Europe/Lisbon (GMT + 01:00)</option>
                            <option value="America/Puerto_Rico" {{ ($data['profile']->time_zone == 'America/Puerto_Rico') ? 'selected' : '' }}>America/Puerto_Rico (GMT - 04:00)</option>
                            <option value="Asia/Qatar" {{ ($data['profile']->time_zone == 'Asia/Qatar') ? 'selected' : '' }}>Asia/Qatar (GMT + 03:00)</option>
                            <option value="Europe/Bucharest" {{ ($data['profile']->time_zone == 'Europe/Bucharest') ? 'selected' : '' }}>Europe/Bucharest (GMT + 02:00)</option>
                            <option value="Asia/Anadyr" {{ ($data['profile']->time_zone == 'Asia/Anadyr') ? 'selected' : '' }}>Asia/Anadyr (GMT + 11:00)</option>
                            <option value="Asia/Barnaul" {{ ($data['profile']->time_zone == 'Asia/Barnaul') ? 'selected' : '' }}>Asia/Barnaul (GMT + 07:00)</option>
                            <option value="Asia/Chita" {{ ($data['profile']->time_zone == 'Asia/Chita') ? 'selected' : '' }}>Asia/Chita (GMT + 09:00)</option>
                            <option value="Asia/Irkutsk" {{ ($data['profile']->time_zone == 'Asia/Irkutsk') ? 'selected' : '' }}>Asia/Irkutsk (GMT + 08:00)</option>
                            <option value="Asia/Kamchatka" {{ ($data['profile']->time_zone == 'Asia/Kamchatka') ? 'selected' : '' }}>Asia/Kamchatka (GMT + 12:00)</option>
                            <option value="Asia/Khandyga" {{ ($data['profile']->time_zone == 'Asia/Khandyga') ? 'selected' : '' }}>Asia/Khandyga (GMT + 09:00)</option>
                            <option value="Asia/Krasnoyarsk" {{ ($data['profile']->time_zone == 'Asia/Krasnoyarsk') ? 'selected' : '' }}>Asia/Krasnoyarsk (GMT + 07:00)</option>
                            <option value="Asia/Magadan" {{ ($data['profile']->time_zone == 'Asia/Magadan') ? 'selected' : '' }}>Asia/Magadan (GMT + 11:00)</option>
                            <option value="Asia/Novokuznetsk" {{ ($data['profile']->time_zone == 'Asia/Novokuznetsk') ? 'selected' : '' }}>Asia/Novokuznetsk (GMT + 07:00)</option>
                            <option value="Asia/Novosibirsk" {{ ($data['profile']->time_zone == 'Asia/Novosibirsk') ? 'selected' : '' }}>Asia/Novosibirsk (GMT + 07:00)</option>
                            <option value="Asia/Omsk" {{ ($data['profile']->time_zone == 'Asia/Omsk') ? 'selected' : '' }}>Asia/Omsk (GMT + 06:00)</option>
                            <option value="Asia/Sakhalin" {{ ($data['profile']->time_zone == 'Asia/Sakhalin') ? 'selected' : '' }}>Asia/Sakhalin (GMT + 11:00)</option>
                            <option value="Asia/Srednekolymsk" {{ ($data['profile']->time_zone == 'Asia/Srednekolymsk') ? 'selected' : '' }}>Asia/Srednekolymsk (GMT + 11:00)</option>
                            <option value="Asia/Tomsk" {{ ($data['profile']->time_zone == 'Asia/Tomsk') ? 'selected' : '' }}>Asia/Tomsk (GMT + 07:00)</option>
                            <option value="Asia/Ust-Nera" {{ ($data['profile']->time_zone == 'Asia/Ust-Nera') ? 'selected' : '' }}>Asia/Ust-Nera (GMT + 10:00)</option>
                            <option value="Asia/Vladivostok" {{ ($data['profile']->time_zone == 'Asia/Vladivostok') ? 'selected' : '' }}>Asia/Vladivostok (GMT + 10:00)</option>
                            <option value="Asia/Yakutsk" {{ ($data['profile']->time_zone == 'Asia/Yakutsk') ? 'selected' : '' }}>Asia/Yakutsk (GMT + 09:00)</option>
                            <option value="Asia/Yekaterinburg" {{ ($data['profile']->time_zone == 'Asia/Yekaterinburg') ? 'selected' : '' }}>Asia/Yekaterinburg (GMT + 05:00)</option>
                            <option value="Europe/Astrakhan" {{ ($data['profile']->time_zone == 'Europe/Astrakhan') ? 'selected' : '' }}>Europe/Astrakhan (GMT + 04:00)</option>
                            <option value="Europe/Kaliningrad" {{ ($data['profile']->time_zone == 'Europe/Kaliningrad') ? 'selected' : '' }}>Europe/Kaliningrad (GMT + 02:00)</option>
                            <option value="Europe/Kirov" {{ ($data['profile']->time_zone == 'Europe/Kirov') ? 'selected' : '' }}>Europe/Kirov (GMT + 03:00)</option>
                            <option value="Europe/Moscow" {{ ($data['profile']->time_zone == 'Europe/Moscow') ? 'selected' : '' }}>Europe/Moscow (GMT + 03:00)</option>
                            <option value="Europe/Samara" {{ ($data['profile']->time_zone == 'Europe/Samara') ? 'selected' : '' }}>Europe/Samara (GMT + 04:00)</option>
                            <option value="Europe/Saratov" {{ ($data['profile']->time_zone == 'Europe/Saratov') ? 'selected' : '' }}>Europe/Saratov (GMT + 04:00)</option>
                            <option value="Europe/Ulyanovsk" {{ ($data['profile']->time_zone == 'Europe/Ulyanovsk') ? 'selected' : '' }}>Europe/Ulyanovsk (GMT + 01:00)</option>
                            <option value="Europe/Volgograd" {{ ($data['profile']->time_zone == 'Europe/Volgograd') ? 'selected' : '' }}>Europe/Volgograd (GMT + 03:00)</option>
                            <option value="Africa/Kigali" {{ ($data['profile']->time_zone == 'Africa/Kigali') ? 'selected' : '' }}>Africa/Kigali (GMT + 02:00)</option>
                            <option value="Indian/Reunion" {{ ($data['profile']->time_zone == 'Indian/Reunion') ? 'selected' : '' }}>Indian/Reunion (GMT + 04:00)</option>
                            <option value="America/St_Barthelemy" {{ ($data['profile']->time_zone == 'America/St_Barthelemy') ? 'selected' : '' }}>America/St_Barthelemy (GMT - 04:00)</option>
                            <option value="Atlantic/St_Helena" {{ ($data['profile']->time_zone == 'Atlantic/St_Helena') ? 'selected' : '' }}>Atlantic/St_Helena (GMT + 00:00)</option>
                            <option value="America/St_Kitts" {{ ($data['profile']->time_zone == 'America/St_Kitts') ? 'selected' : '' }}>America/St_Kitts (GMT - 04:00)</option>
                            <option value="America/St_Lucia" {{ ($data['profile']->time_zone == 'America/St_Lucia') ? 'selected' : '' }}>America/St_Lucia (GMT - 04:00)</option>
                            <option value="America/Marigot" {{ ($data['profile']->time_zone == 'America/Marigot') ? 'selected' : '' }}>America/Marigot (GMT - 04:00)</option>
                            <option value="America/Miquelon" {{ ($data['profile']->time_zone == 'America/Miquelon') ? 'selected' : '' }}>America/Miquelon (GMT - 03:00)</option>
                            <option value="America/St_Vincent" {{ ($data['profile']->time_zone == 'America/St_Vincent') ? 'selected' : '' }}>America/St_Vincent (GMT - 04:00)</option>
                            <option value="Pacific/Apia" {{ ($data['profile']->time_zone == 'Pacific/Apia') ? 'selected' : '' }}>Pacific/Apia (GMT + 13:00)</option>
                            <option value="Europe/San_Marino" {{ ($data['profile']->time_zone == 'Europe/San_Marino') ? 'selected' : '' }}>Europe/San_Marino (GMT + 01:00)</option>
                            <option value="Africa/Sao_Tome" {{ ($data['profile']->time_zone == 'Africa/Sao_Tome') ? 'selected' : '' }}>Africa/Sao_Tome (GMT + 00:00)</option>
                            <option value="Asia/Riyadh" {{ ($data['profile']->time_zone == 'Asia/Riyadh') ? 'selected' : '' }}>Asia/Riyadh (GMT + 03:00)</option>
                            <option value="Africa/Dakar" {{ ($data['profile']->time_zone == 'Africa/Dakar') ? 'selected' : '' }}>Africa/Dakar (GMT + 00:00)</option>
                            <option value="Europe/Belgrade" {{ ($data['profile']->time_zone == 'Europe/Belgrade') ? 'selected' : '' }}>Europe/Belgrade (GMT + 01:00)</option>
                            <option value="Indian/Mahe" {{ ($data['profile']->time_zone == 'Indian/Mahe') ? 'selected' : '' }}>Indian/Mahe (GMT + 04:00)</option>
                            <option value="Africa/Freetown" {{ ($data['profile']->time_zone == 'Africa/Freetown') ? 'selected' : '' }}>Africa/Freetown (GMT + 00:00)</option>
                            <option value="Asia/Singapore" {{ ($data['profile']->time_zone == 'Asia/Singapore') ? 'selected' : '' }}>Asia/Singapore (GMT + 08:00)</option>
                            <option value="America/Lower_Princes" {{ ($data['profile']->time_zone == 'America/Lower_Princes') ? 'selected' : '' }}>America/Lower_Princes (GMT - 04:00)</option>
                            <option value="Europe/Bratislava" {{ ($data['profile']->time_zone == 'Europe/Bratislava') ? 'selected' : '' }}>Europe/Bratislava (GMT + 01:00)</option>
                            <option value="Europe/Ljubljana" {{ ($data['profile']->time_zone == 'Europe/Ljubljana') ? 'selected' : '' }}>Europe/Ljubljana (GMT + 02:00)</option>
                            <option value="Pacific/Guadalcanal" {{ ($data['profile']->time_zone == 'Pacific/Guadalcanal') ? 'selected' : '' }}>Pacific/Guadalcanal (GMT + 11:00)</option>
                            <option value="Africa/Mogadishu" {{ ($data['profile']->time_zone == 'Africa/Mogadishu') ? 'selected' : '' }}>Africa/Mogadishu (GMT + 03:00)</option>
                            <option value="Africa/Johannesburg" {{ ($data['profile']->time_zone == 'Africa/Johannesburg') ? 'selected' : '' }}>Africa/Johannesburg (GMT + 02:00)</option>
                            <option value="Atlantic/South_Georgia" {{ ($data['profile']->time_zone == 'Atlantic/South_Georgia') ? 'selected' : '' }}>Atlantic/South_Georgia (GMT - 02:00)</option>
                            <option value="Africa/Juba" {{ ($data['profile']->time_zone == 'Africa/Juba') ? 'selected' : '' }}>Africa/Juba (GMT + 02:00)</option>
                            <option value="Africa/Ceuta" {{ ($data['profile']->time_zone == 'Africa/Ceuta') ? 'selected' : '' }}>Africa/Ceuta (GMT + 01:00)</option>
                            <option value="Atlantic/Canary" {{ ($data['profile']->time_zone == 'Atlantic/Canary') ? 'selected' : '' }}>Atlantic/Canary (GMT + 01:00)</option>
                            <option value="Europe/Madrid" {{ ($data['profile']->time_zone == 'Europe/Madrid') ? 'selected' : '' }}>Europe/Madrid (GMT + 01:00)</option>
                            <option value="Asia/Colombo" {{ ($data['profile']->time_zone == 'Asia/Colombo') ? 'selected' : '' }}>Asia/Colombo (GMT + 05:30)</option>
                            <option value="Africa/Khartoum" {{ ($data['profile']->time_zone == 'Africa/Khartoum') ? 'selected' : '' }}>Africa/Khartoum (GMT + 02:00)</option>
                            <option value="America/Paramaribo" {{ ($data['profile']->time_zone == 'America/Paramaribo') ? 'selected' : '' }}>America/Paramaribo (GMT - 03:00)</option>
                            <option value="Arctic/Longyearbyen" {{ ($data['profile']->time_zone == 'Arctic/Longyearbyen') ? 'selected' : '' }}>Arctic/Longyearbyen (GMT + 01:00)</option>
                            <option value="Africa/Mbabane" {{ ($data['profile']->time_zone == 'Africa/Mbabane') ? 'selected' : '' }}>Africa/Mbabane (GMT + 02:00)</option>
                            <option value="Europe/Stockholm" {{ ($data['profile']->time_zone == 'Europe/Stockholm') ? 'selected' : '' }}>Europe/Stockholm (GMT + 01:00)</option>
                            <option value="Europe/Zurich" {{ ($data['profile']->time_zone == 'Europe/Zurich') ? 'selected' : '' }}>Europe/Zurich (GMT + 01:00)</option>
                            <option value="Asia/Damascus" {{ ($data['profile']->time_zone == 'Asia/Damascus') ? 'selected' : '' }}>Asia/Damascus (GMT + 02:00)</option>
                            <option value="Asia/Taipei" {{ ($data['profile']->time_zone == 'Asia/Taipei') ? 'selected' : '' }}>Asia/Taipei (GMT + 08:00)</option>
                            <option value="Asia/Dushanbe" {{ ($data['profile']->time_zone == 'Asia/Dushanbe') ? 'selected' : '' }}>Asia/Dushanbe (GMT + 05:00)</option>
                            <option value="Africa/Dar_es_Salaam" {{ ($data['profile']->time_zone == 'Africa/Dar_es_Salaam') ? 'selected' : '' }}>Africa/Dar_es_Salaam (GMT + 03:00)</option>
                            <option value="Asia/Bangkok" {{ ($data['profile']->time_zone == 'Asia/Bangkok') ? 'selected' : '' }}>Asia/Bangkok (GMT + 07:00)</option>
                            <option value="Asia/Dili" {{ ($data['profile']->time_zone == 'Asia/Dili') ? 'selected' : '' }}>Asia/Dili (GMT + 09:00)</option>
                            <option value="Africa/Lome" {{ ($data['profile']->time_zone == 'Africa/Lome') ? 'selected' : '' }}>Africa/Lome (GMT + 00:00)</option>
                            <option value="Pacific/Fakaofo" {{ ($data['profile']->time_zone == 'Pacific/Fakaofo') ? 'selected' : '' }}>Pacific/Fakaofo (GMT + 13:00)</option>
                            <option value="Pacific/Tongatapu" {{ ($data['profile']->time_zone == 'Pacific/Tongatapu') ? 'selected' : '' }}>Pacific/Tongatapu (GMT + 13:00)</option>
                            <option value="America/Port_of_Spain" {{ ($data['profile']->time_zone == 'America/Port_of_Spain') ? 'selected' : '' }}>America/Port_of_Spain (GMT - 04:00)</option>
                            <option value="Africa/Tunis" {{ ($data['profile']->time_zone == 'Africa/Tunis') ? 'selected' : '' }}>Africa/Tunis (GMT + 01:00)</option>
                            <option value="Europe/Istanbul" {{ ($data['profile']->time_zone == 'Europe/Istanbul') ? 'selected' : '' }}>Europe/Istanbul (GMT + 03:00)</option>
                            <option value="Asia/Ashgabat" {{ ($data['profile']->time_zone == 'Asia/Ashgabat') ? 'selected' : '' }}>Asia/Ashgabat (GMT + 05:00)</option>
                            <option value="America/Grand_Turk" {{ ($data['profile']->time_zone == 'America/Grand_Turk') ? 'selected' : '' }}>America/Grand_Turk (GMT - 05:00)</option>
                            <option value="Pacific/Funafuti" {{ ($data['profile']->time_zone == 'Pacific/Funafuti') ? 'selected' : '' }}>Pacific/Funafuti (GMT + 12:00)</option>
                            <option value="Africa/Kampala" {{ ($data['profile']->time_zone == 'Africa/Kampala') ? 'selected' : '' }}>Africa/Kampala (GMT + 03:00)</option>
                            <option value="Europe/Kiev" {{ ($data['profile']->time_zone == 'Europe/Kiev') ? 'selected' : '' }}>Europe/Kiev (GMT + 02:00)</option>
                            <option value="Europe/Simferopol" {{ ($data['profile']->time_zone == 'Europe/Simferopol') ? 'selected' : '' }}>Europe/Simferopol (GMT + 03:00)</option>
                            <option value="Europe/Uzhgorod" {{ ($data['profile']->time_zone == 'Europe/Uzhgorod') ? 'selected' : '' }}>Europe/Uzhgorod (GMT + 02:00)</option>
                            <option value="Europe/Zaporozhye" {{ ($data['profile']->time_zone == 'Europe/Zaporozhye') ? 'selected' : '' }}>Europe/Zaporozhye (GMT + 02:00)</option>
                            <option value="Asia/Dubai" {{ ($data['profile']->time_zone == 'Asia/Dubai') ? 'selected' : '' }}>Asia/Dubai (GMT + 04:00)</option>
                            <option value="Europe/London" {{ ($data['profile']->time_zone == 'Europe/London') ? 'selected' : '' }}>Europe/London (GMT + 00:00)</option>
                            <option value="America/Adak" {{ ($data['profile']->time_zone == 'America/Adak') ? 'selected' : '' }}>America/Adak (GMT - 10:00)</option>
                            <option value="America/Anchorage" {{ ($data['profile']->time_zone == 'America/Anchorage') ? 'selected' : '' }}>America/Anchorage (GMT - 09:00)</option>
                            <option value="America/Boise" {{ ($data['profile']->time_zone == 'America/Boise') ? 'selected' : '' }}>America/Boise (GMT - 07:00)</option>
                            <option value="America/Chicago" {{ ($data['profile']->time_zone == 'America/Chicago') ? 'selected' : '' }}>America/Chicago (GMT - 05:00)</option>
                            <option value="America/Denver" {{ ($data['profile']->time_zone == 'America/Denver') ? 'selected' : '' }}>America/Denver (GMT - 07:00)</option>
                            <option value="America/Detroit" {{ ($data['profile']->time_zone == 'America/Detroit') ? 'selected' : '' }}>America/Detroit (GMT - 06:00)</option>
                            <option value="America/Indiana/Indianapolis" {{ ($data['profile']->time_zone == 'America/Indiana/Indianapolis') ? 'selected' : '' }}>America/Indiana/Indianapolis (GMT - 05:00)</option>
                            <option value="America/Indiana/Knox" {{ ($data['profile']->time_zone == 'America/Indiana/Knox') ? 'selected' : '' }}>America/Indiana/Knox (GMT - 06:00)</option>
                            <option value="America/Indiana/Marengo" {{ ($data['profile']->time_zone == 'America/Indiana/Marengo') ? 'selected' : '' }}>America/Indiana/Marengo (GMT - 04:00)</option>
                            <option value="America/Indiana/Petersburg" {{ ($data['profile']->time_zone == 'America/Indiana/Petersburg') ? 'selected' : '' }}>America/Indiana/Petersburg (GMT - 05:00)</option>
                            <option value="America/Indiana/Tell_City" {{ ($data['profile']->time_zone == 'America/Indiana/Tell_City') ? 'selected' : '' }}>America/Indiana/Tell_City (GMT - 05:00)</option>
                            <option value="America/Indiana/Vevay" {{ ($data['profile']->time_zone == 'America/Indiana/Vevay') ? 'selected' : '' }}>America/Indiana/Vevay (GMT - 05:00)</option>
                            <option value="America/Indiana/Vincennes" {{ ($data['profile']->time_zone == 'America/Indiana/Vincennes') ? 'selected' : '' }}>America/Indiana/Vincennes (GMT - 05:00)</option>
                            <option value="America/Indiana/Winamac" {{ ($data['profile']->time_zone == 'America/Indiana/Winamac') ? 'selected' : '' }}>America/Indiana/Winamac (GMT - 09:00)</option>
                            <option value="America/Juneau" {{ ($data['profile']->time_zone == 'America/Juneau') ? 'selected' : '' }}>America/Juneau (GMT - 09:00)</option>
                            <option value="America/Kentucky/Louisville" {{ ($data['profile']->time_zone == 'America/Kentucky/Louisville') ? 'selected' : '' }}>America/Kentucky/Louisville (GMT - 05:00)</option>
                            <option value="America/Kentucky/Monticello" {{ ($data['profile']->time_zone == 'America/Kentucky/Monticello') ? 'selected' : '' }}>America/Kentucky/Monticello (GMT - 05:00)</option>
                            <option value="America/Los_Angeles" {{ ($data['profile']->time_zone == 'America/Los_Angeles') ? 'selected' : '' }}>America/Los_Angeles (GMT - 08:00)</option>
                            <option value="America/Menominee" {{ ($data['profile']->time_zone == 'America/Menominee') ? 'selected' : '' }}>America/Menominee (GMT - 06:00)</option>
                            <option value="America/Metlakatla" {{ ($data['profile']->time_zone == 'America/Metlakatla') ? 'selected' : '' }}>America/Metlakatla (GMT - 09:00)</option>
                            <option value="America/New_York" {{ ($data['profile']->time_zone == 'America/New_York') ? 'selected' : '' }}>America/New_York (GMT - 05:00)</option>
                            <option value="America/Nome" {{ ($data['profile']->time_zone == 'America/Nome') ? 'selected' : '' }}>America/Nome (GMT - 09:00)</option>
                            <option value="America/North_Dakota/Beulah" {{ ($data['profile']->time_zone == 'America/North_Dakota/Beulah') ? 'selected' : '' }}>America/North_Dakota/Beulah (GMT - 06:00)</option>
                            <option value="America/North_Dakota/Center" {{ ($data['profile']->time_zone == 'America/North_Dakota/Center') ? 'selected' : '' }}>America/North_Dakota/Center (GMT - 05:00)</option>
                            <option value="America/North_Dakota/New_Salem" {{ ($data['profile']->time_zone == 'America/North_Dakota/New_Salem') ? 'selected' : '' }}>America/North_Dakota/New_Salem (GMT - 06:00)</option>
                            <option value="America/Phoenix" {{ ($data['profile']->time_zone == 'America/Phoenix') ? 'selected' : '' }}>America/Phoenix (GMT - 07:00)</option>
                            <option value="America/Sitka" {{ ($data['profile']->time_zone == 'America/Sitka') ? 'selected' : '' }}>America/Sitka (GMT - 09:00)</option>
                            <option value="America/Yakutat" {{ ($data['profile']->time_zone == 'America/Yakutat') ? 'selected' : '' }}>America/Yakutat (GMT - 09:00)</option>
                            <option value="Pacific/Honolulu" {{ ($data['profile']->time_zone == 'Pacific/Honolulu') ? 'selected' : '' }}>Pacific/Honolulu (GMT + 02:00)</option>
                            <option value="Pacific/Midway" {{ ($data['profile']->time_zone == 'Pacific/Midway') ? 'selected' : '' }}>Pacific/Midway (GMT - 10:00)</option>
                            <option value="Pacific/Wake" {{ ($data['profile']->time_zone == 'Pacific/Wake') ? 'selected' : '' }}>Pacific/Wake (GMT + 12:00)</option>
                            <option value="America/Montevideo" {{ ($data['profile']->time_zone == 'America/Montevideo') ? 'selected' : '' }}>America/Montevideo (GMT + 02:00)</option>
                            <option value="Asia/Samarkand" {{ ($data['profile']->time_zone == 'Asia/Samarkand') ? 'selected' : '' }}>Asia/Samarkand (GMT - 03:00)</option>
                            <option value="Asia/Tashkent" {{ ($data['profile']->time_zone == 'Asia/Tashkent') ? 'selected' : '' }}>Asia/Tashkent (GMT + 05:00)</option>
                            <option value="Pacific/Efate" {{ ($data['profile']->time_zone == 'Pacific/Efate') ? 'selected' : '' }}>Pacific/Efate (GMT + 11:00)</option>
                            <option value="America/Caracas" {{ ($data['profile']->time_zone == 'America/Caracas') ? 'selected' : '' }}>America/Caracas (GMT - 04:00)</option>
                            <option value="Asia/Ho_Chi_Minh" {{ ($data['profile']->time_zone == 'Asia/Ho_Chi_Minh') ? 'selected' : '' }}>Asia/Ho_Chi_Minh (GMT + 07:00)</option>
                            <option value="America/Tortola" {{ ($data['profile']->time_zone == 'America/Tortola') ? 'selected' : '' }}>America/Tortola (GMT - 04:00)</option>
                            <option value="America/St_Thomas" {{ ($data['profile']->time_zone == 'America/St_Thomas') ? 'selected' : '' }}>America/St_Thomas (GMT - 04:00)</option>
                            <option value="Pacific/Wallis" {{ ($data['profile']->time_zone == 'Pacific/Wallis') ? 'selected' : '' }}>Pacific/Wallis (GMT + 12:00)</option>
                            <option value="Africa/El_Aaiun" {{ ($data['profile']->time_zone == 'Africa/El_Aaiun') ? 'selected' : '' }}>Africa/El_Aaiun (GMT + 01:00)</option>
                            <option value="Asia/Aden" {{ ($data['profile']->time_zone == 'Asia/Aden') ? 'selected' : '' }}>Asia/Aden (GMT + 03:00)</option>
                            <option value="Africa/Lusaka" {{ ($data['profile']->time_zone == 'Africa/Lusaka') ? 'selected' : '' }}>Africa/Lusaka (GMT + 02:00)</option>
                            <option value="Africa/Harare" {{ ($data['profile']->time_zone == 'Africa/Harare') ? 'selected' : '' }}>Africa/Harare (GMT + 02:00)</option>
                            <option value="Europe/Mariehamn" {{ ($data['profile']->time_zone == 'Europe/Mariehamn') ? 'selected' : '' }}>Europe/Mariehamn (GMT + 02:00)</option>
                        </select>
                    </div>

                    <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 font-size14px mb-4">
                        <label for="gender" class="font-familyAtlasGrotesk-Medium d-block">Gender</label>
                        <div class="custom-control custom-radio custom-control-inline font-familyFreightTextProLight-Regular text-colorblue200 line-height1pot8">
                            <input value="Male" type="radio" id="male" {{ ($data[ 'profile']->gender == 'Male') ? 'checked="checked"' : '' }} name="gender" class="custom-control-input align-self-center">
                            <label class="custom-control-label" for="male">Male</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline font-familyFreightTextProLight-Regular text-colorblue200 line-height1pot8">
                            <input value="Female" type="radio" id="Female" {{ ($data[ 'profile']->gender == 'Female') ? 'checked="checked"' : '' }} name="gender" class="custom-control-input">
                            <label class="custom-control-label" for="Female">Female</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline font-familyFreightTextProLight-Regular text-colorblue200 line-height1pot8">
                            <input value="Non-Binary" type="radio" id="Non-Binary" {{ ($data[ 'profile']->gender == 'Non-Binary') ? 'checked="checked"' : '' }} name="gender" class="custom-control-input">
                            <label class="custom-control-label" for="Non-Binary">Non-Binary</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline font-familyFreightTextProLight-Regular text-colorblue200 line-height1pot8">
                            <input value="I-Prefer-not-to-answer" type="radio" id="I-Prefer-not-to-answer" {{ ($data[ 'profile']->gender == 'I-Prefer-not-to-answer') ? 'checked="checked"' : '' }} name="gender" class="custom-control-input">
                            <label class="custom-control-label" for="I-Prefer-not-to-answer">I Prefer not to answer</label>
                        </div>

                    </div>

                    <div class="form-group font-familyAtlasGroteskWeb-Medium text-colorblue100 mb-3 font-size12px">
                        <label for="" class="font-familyAtlasGrotesk-Medium d-block">Privacy</label>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="privacy_status" id="privacy_status" {{ ($data[ 'profile']->privacy_status == 1) ? 'checked' : '' }}>
                            <label class="custom-control-label text-colorblue200 line-height2pot1" for="privacy_status">Make my profile private.</label>
                        </div>
                        <div class="custom-control custom-checkbox mt-1">
                            <input type="checkbox" class="custom-control-input" name="web_search" id="web_search" {{ ($data[ 'profile']->web_search == 1) ? 'checked' : '' }}>
                            <label class="custom-control-label text-colorblue200 line-height2pot1" for="web_search">Remove my profile from web search results.</label>
                        </div>
                    </div>

                    @error('err_msg')
                    <p style="color: red; text-align: center;">{{ $message }}</p>
                    @enderror @if(session()->has('success_msg'))
                    <p style="color: green; text-align: center;">{{ session()->get('success_msg') }}</p>
                    @endif

                    <div class="form-group text-right mt-5 pr-1">
                        <button type="submit" class="btn btn-customBtn2 text-white font-familyAtlasGroteskWeb-Bold font-size12px p-0 border-radius0px btnBotmBar">
                                <span class="pt-2 pb-2 pl-3 pr-3 mb-0 d-block">SAVE CHANGES <i class="fas fa-angle-right ml-3 text-colorMahroon100"></i></span>
                                <div class="btn-bar"></div>
                            </button>
                        {{-- <a href="#" class="font-familyAtlasGroteskWeb-Bold text-colorMahroon700 font-size12px ml-3">Deactivate your Account</a> --}}
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>

@include('include.footer') @endsection
@section('script')
    <script src="{{ asset('js/country/crs.min.js') }}"></script>
@endsection