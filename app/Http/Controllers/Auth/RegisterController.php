<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use App\Mail\ContactEmail;

class RegisterController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails() && $request['role_id'] == '3') {
            return redirect('/register?switch=true')->withErrors($validator)->withInput();
        } else if ($validator->fails() && $request['role_id'] == '2') {
            return redirect('/register')->withErrors($validator)->withInput();
        }

        if ($request['role_id'] == '3') {
            $check = DB::select('SELECT id FROM passcode WHERE code = ?', [$request['con_contributor_code']]);

            if (count($check) || $request['con_contributor_code'] == "") {
                event(new Registered($user = $this->create($request->all())));
                $this->profile($request['con_fname'].' '.$request['con_lname'], $user->id, $request['role_id'], $request['gender_con']);
            } else {
                return redirect('/register?switch=true')->withErrors(['con_contributor_code' => 'Invalid teacher code'])->withInput();
            }
        } else if ($request['role_id'] == '2') {
            event(new Registered($user = $this->create($request->all())));
            $this->profile($request['fname'].' '.$request['lname'], $user->id, $request['role_id'], $request['gender_std']);
        }

        $this->guard()->login($user);
        return $this->registered($request, $user) ?: redirect($this->redirectPath());
    }

    protected function validator(array $data)
    {
        if ($data['role_id'] == '2') {

            $rules = [
                'role_id' => 'required',
                'fname' => 'required|string|max:255',
                'lname' => 'required|string|max:255',
                'gender_std' => 'required',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
                'country' => 'required|string|max:255',
                // 'region' => 'required|string|max:255',
                'password_confirmation' => 'required|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/|same:password',
            ];

            $messages = [
                'email.required' => 'Please enter your email address.',
                'email.unique' => 'This email has already been taken',
                'fname.required' => 'Please enter your first name.',
                'lname.required' => 'Please enter your last name.',
                'gender_std.required' => 'Please select your sex.',
                'country.required' => 'Please select your country.',
                // 'region.required' => 'Please select your region.',
                'password.required' => 'Please enter your password.',
                'password.regex' => 'Password must contain a minimum of 8 characters, contain at least one uppercase character, one lowercase character, one number and a special character.',
                'password.min' => 'Password must contain a minimum of 8 characters, contain at least one uppercase character, one lowercase character, one number and a special character.',
                'password_confirmation.same' => 'Password Confirmation should match the Password',
                'password_confirmation.required' => 'Password Confirmation should match the Password.',
                'password_confirmation.regex' => 'Password Confirmation should match the Password.',
                'password_confirmation.min' => 'Password Confirmation should match the Password.',
            ];
            return Validator::make($data, $rules, $messages);

        } else if ($data['role_id'] == '3') {

            $rules = [
                'role_id' => 'required',
                'con_fname' => 'required|string|max:255',
                'con_lname' => 'required|string|max:255',
                'gender_con' => 'required',
                'con_email' => 'required|string|email|max:255|unique:users,email',
                'con_password' => 'required|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
                'con_country' => 'required|string|max:255',
                // 'con_region' => 'required|string|max:255',
                'con_affiliation' => 'required|string|max:255',
                'con_password_confirmation' => 'required|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/|same:con_password',
            ];

            $messages = [
                'con_email.unique' => 'This email has already been taken.',
                'con_email.email' => 'The email must be a valid address.',
                'con_fname.required' => 'Please enter your first name.',
                'con_lname.required' => 'Please enter your last name.',
                'gender_con.required' => 'Please select your sex.',
                'con_email.required' => 'Please enter your email address.',
                'con_country.required' => 'Please select your country.',
                // 'con_region.required' => 'Please select your region.',
                'con_password.required' => 'Please enter your password.',
                'con_password.regex' => 'Password must contain a minimum of 8 characters, contain at least one uppercase character, one lowercase character, one number and a special character.',
                'con_password.min' => 'Password must contain a minimum of 8 characters, contain at least one uppercase character, one lowercase character, one number and a special character.',
                'con_affiliation.required' => 'Please enter affiliation.',
                'con_password_confirmation.same' => 'Password Confirmation should match the Password',
                'con_password_confirmation.required' => 'Password Confirmation should match the Password.',
                'con_password_confirmation.regex' => 'Password Confirmation should match the Password.',
                'con_password_confirmation.min' => 'Password Confirmation should match the Password.',
            ];

            return Validator::make($data, $rules, $messages);
        }
    }

    protected function create(array $data)
    {
        if ($data['role_id'] == '2') {
            return User::create([
                'role_id' => (int) $data['role_id'],
                'name' => $data['fname'] .' '. $data['lname'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'location' => $data['country'],
                'gender' => $data['gender_std'],
                'activate' => 1,
            ]);
        } else if ($data['role_id'] == '3') {

            return User::create([
                'role_id' => (int) $data['role_id'],
                'name' => $data['con_fname'].' '.$data['con_lname'] ,
                'email' => $data['con_email'],
                'password' => Hash::make($data['con_password']),
                'location' => $data['con_country'],
                'affiliation' => $data['con_affiliation'],
                // 'contributor_code' => $data['con_contributor_code'],
                'gender' => $data['gender_con'],
                'activate' => 0,
            ]);
        }
    }

    protected function profile($full_name, $user_id, $role_id, $gender)
    {
        DB::table('profiles')->insert([
            'full_name' => $full_name,
            'user_id' => $user_id,
            'created_at' => now(),
            'updated_at' => now(),
            'gender' => $gender,
            'profile_pic_url' => "profile.jpg"
        ]);
    }
}
