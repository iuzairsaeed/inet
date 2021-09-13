<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected function authenticated(Request $request, $user)
    {
        // if (Auth::user()->role_id == 2) {

        $user_id = Auth::user()->id;
        DB::update("UPDATE users SET last_login = now() WHERE id = $user_id");

        $incomplete_content = DB::select("SELECT c.id, c.steps_count as total_steps, MAX(lct.content_step) as step_on_leave, c.title, c.duration, c.views_count, c.image_url, c.downloaded_count, c.duration,
            (SELECT name FROM users WHERE id=c.user_id) as author,
            (SELECT name FROM difficulty_level WHERE id=c.difficulty_level_id) as difficulty_level
            FROM learner_content_tracking lct JOIN content c ON c.id=lct.content_id
            WHERE lct.user_id=$user_id AND c.status=1 GROUP BY c.id HAVING MAX(lct.content_step) != steps_count");

        if (count($incomplete_content)) {
            return redirect("/welcome/back");
        } else {
            return redirect("/home");
        }
        // } else {
        //     return redirect('/home');
        // }    
    }

    // protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
