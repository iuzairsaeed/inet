<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class pagesRoutesController extends Controller
{
    public function aboutsPg()
    {
        $about_text = DB::select('SELECT *  FROM inet_stage.about_us_text');
        return view('about', compact('about_text'));
    }

    public function infoPg()
    {
        return view('info');
    }



    public function infoStudentPg()
    {
        $data['st'] = DB::Table('info_student')->where('id',1)->first();
        return view('infoStudent',$data);
    }

    public function infoTeacherPg()
    {
        $data['st'] = DB::Table('info_teacher')->where('id',1)->first();
        return view('infoTeacher',$data);
    }




    public function privacyPolicyPg()
    {
        $data['privacy'] = DB::table('privacy_policy')->where('id', 1)->first();
        return view('privacyPolicy',$data);

    }

    public function coummunity()
    {
        $data['cm'] = DB::Table('community_guidelines')->where('id',1)->first();
        return view('communityguidelines',$data);


    }

    public function termsConditionsPg()
    {
         $data['tm'] = DB::Table('terms_of_use')->where('id',1)->first();
        return view('termsConditions',$data);


    }

    public function searchPg()
    {
        return view('admin/search');
    }
    public function contactPg()
    {
        $contact_text = DB::select('SELECT *  FROM inet_stage.contact_us_text');
        return view('admin/contact', compact('contact_text'));
    }
    public function faqsPg()
    {
        $questions = DB::select('SELECT id, question, answer FROM  inet_stage.faqs_questions');
        $faqs_text = DB::select('SELECT *  FROM inet_stage.faqs_text');
        return view('admin/faqs', compact('faqs_text', 'questions'));
    }
    public function newsAndMediaPg()
    {
        $newsPost = DB::select('SELECT nf.id, nf.title, nf.body, nf.img_url, nf.created_at, nf.updated_at, nf.user_id, users.name FROM inet_stage.news_feed nf
        INNER JOIN inet_stage.users on nf.user_id = inet_stage.users.id ORDER BY nf.created_at DESC');
        $news_text = DB::select('SELECT * FROM inet_stage.news where id=1');
        return view('admin/newsAndMedia', compact('news_text', 'newsPost'));
    }

    public function microeconomicsPg()
    {
        return view('contributor.microeconomics');
    }

    public function viewcontprofile($id){

        $profile_data = DB::select("SELECT  inet_stage.users.id,inet_stage.users.name, inet_stage.users.email,inet_stage.profiles.profile_pic_url,
        inet_stage.profiles.about_me, inet_stage.profiles.twitter_url, inet_stage.profiles.youtube_url, inet_stage.profiles.web_url, inet_stage.profiles.about_me,
        inet_stage.roles.name as role  FROM  inet_stage.users
        INNER JOIN  inet_stage.profiles  on inet_stage.users.id=inet_stage.profiles.user_id
        INNER JOIN inet_stage.roles      on inet_stage.users.role_id= inet_stage.roles.id
        where roles.id=3 AND inet_stage.users.id=$id");
         return view('admin/viewcontributorprofile', compact('profile_data'));
    }

}


