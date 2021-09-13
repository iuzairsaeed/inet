<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactEmail;
use App\PlayLists;

class PublicController extends Controller
{
    public function index()
    {

        $user_content_updated_list = "";

        $contents = DB::select("SELECT c.id, c.title, c.duration, c.image_url, c.downloaded_count, c.views_count, c.featured, c.authors, c.affiliation, (SELECT name FROM users WHERE id=c.user_id) as author, (SELECT name FROM difficulty_level WHERE id=c.difficulty_level_id) as difficulty_level FROM content c WHERE (c.status=1 AND c.user_id=1) AND c.archive=0 ORDER BY created_at DESC LIMIT 3");

        if (Auth::check()) {

            if (!Auth::user()->activate && Auth::user()->role_id == 3) {
                return view('contributor.approve');
            }

            $user_id = Auth::user()->id;

            $incomplete_content = DB::select("SELECT c.id, c.steps_count as total_steps, MAX(lct.content_step) as step_on_leave, c.title, c.duration, c.views_count, c.image_url, c.downloaded_count, c.duration,
                (SELECT name FROM users WHERE id=c.user_id) as author,
                (SELECT name FROM difficulty_level WHERE id=c.difficulty_level_id) as difficulty_level
                FROM learner_content_tracking lct JOIN content c ON c.id=lct.content_id
                WHERE lct.user_id=$user_id AND c.status=1 AND c.archive=0 GROUP BY c.id HAVING MAX(lct.content_step) != steps_count");

            return redirect("/welcome/back");
        }

        $homepage = DB::select('SELECT * FROM inet_stage.home_txt');

        return view('welcome', compact('contents', 'user_content_updated_list','homepage'));
    }


//////////////////////////////Rafey Search Work //////////////////////////////////////////////////

    // public function search(Request $request)
    // {
    //     $user_content_updated_list = "";
    //     if (Auth::check()) {
    //         $user_id = Auth::user()->id;

    //         $user_content_updated_list = DB::select("SELECT GROUP_CONCAT(content_id) as content_ids FROM student_content_mapping WHERE user_id=$user_id");
    //         $user_content_updated_list = $user_content_updated_list[0]->content_ids;
    //     }

    //     if ($request->has('query') && $request->input('query') != "") {
    //         $query = $request->input('query');

    //         $categories = DB::select("SELECT id FROM categories WHERE name LIKE '%$query%'");
    //         if (count($categories)) {
    //             $categories = $categories[0]->id;
    //             $categories_cmd = "OR c.category_ids LIKE '%,$categories,%'";
    //         } else {
    //             $categories_cmd = "";
    //         }

    //         $users_ids = DB::select("SELECT GROUP_CONCAT(id separator ', ') AS ids FROM users u WHERE name!= 'Admin' AND name LIKE '%$query%'");
    //         $users_ids = $users_ids[0]->ids;

    //         $contents_ids = DB::select("SELECT GROUP_CONCAT(c.id separator ', ') AS ids  FROM content c WHERE c.status=1 AND c.title LIKE '%$query%' OR c.tags LIKE '%$query%' $categories_cmd ORDER BY c.views_count DESC");
    //         $contents_ids = $contents_ids[0]->ids;

    //         $users = [];
    //         $contents = [];

    //         if ($users_ids) {
    //             $users = DB::select("SELECT name,id, (SELECT profile_pic_url FROM profiles WHERE user_id=u.id) as avatar, (SELECT name FROM roles WHERE id=u.role_id) as role FROM users u WHERE id IN ($users_ids) GROUP BY id");
    //         }

    //         if (!$users_ids && $contents_ids) {
    //             $users = DB::select("SELECT u.name,u.id, (SELECT profile_pic_url FROM profiles WHERE user_id=u.id) as avatar, (SELECT name FROM roles WHERE id=u.role_id) as role FROM users u JOIN content c ON u.id=c.user_id WHERE c.id IN ($contents_ids) GROUP BY u.id");
    //         }



    //         if ($contents_ids) {
    //             $contents = DB::select("SELECT c.id, c.title, c.affiliation, c.duration, c.image_url, c.downloaded_count, c.views_count, c.featured, (SELECT name FROM users WHERE id=c.user_id) as author,
    //             (SELECT name FROM difficulty_level WHERE id=c.difficulty_level_id) as difficulty_level FROM content c WHERE c.status=1 AND c.id IN ($contents_ids) GROUP BY c.id ORDER BY c.views_count DESC");
    //         }
    //         // else {
    //         //     $contents = DB::select("SELECT c.id, c.title, c.duration, c.image_url, c.downloaded_count, c.views_count, c.featured, (SELECT name FROM users WHERE id=c.user_id) as author,
    //         //     (SELECT name FROM difficulty_level WHERE id=c.difficulty_level_id) as difficulty_level FROM content c WHERE (c.status=1 AND c.content_privacy=1) AND c.id IN ($contents_ids) GROUP BY c.id ORDER BY c.views_count DESC");

    //         // }

    //         if ($users_ids && !$contents_ids) {
    //             $contents = DB::select("SELECT c.id, c.title, c.affiliation, c.duration, c.image_url, c.downloaded_count, c.views_count, c.featured, (SELECT name FROM users WHERE id=c.user_id) as author,
    //             (SELECT name FROM difficulty_level WHERE id=c.difficulty_level_id) as difficulty_level FROM content c JOIN users u ON u.id=c.user_id WHERE u.id IN ($users_ids) GROUP BY c.id ORDER BY c.views_count DESC");
    //         }


    //         return view('search', compact('contents', 'users', 'user_content_updated_list'));

    //     } else {
    //         return redirect('/');
    //     }
    // }


    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     /////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    //  public function search(Request $request)
    //  {
    //      $user_content_updated_list = "";
    //      if (Auth::check()) {
    //          $user_id = Auth::user()->id;

    //          $user_content_updated_list = DB::select("SELECT GROUP_CONCAT(content_id) as content_ids FROM student_content_mapping WHERE user_id=$user_id");
    //          $user_content_updated_list = $user_content_updated_list[0]->content_ids;
    //      }

    //      if ($request->has('query') && $request->input('query') != "") {
    //          $query = $request->input('query');

    //          $categories = DB::select("SELECT id FROM categories WHERE name LIKE '%$query%'");
    //          if (count($categories)) {
    //              $categories = $categories[0]->id;
    //              $categories_cmd = "OR c.category_ids LIKE '%,$categories,%'";
    //          } else {
    //              $categories_cmd = "";
    //          }

    //          $users_ids = DB::select("SELECT GROUP_CONCAT(id separator ', ') AS ids FROM users u WHERE name!= 'Admin' AND name LIKE '%$query%'");
    //          $users_ids = $users_ids[0]->ids;

    //          $contents_ids = DB::select("SELECT GROUP_CONCAT(c.id separator ', ') AS ids  FROM content c WHERE c.status=1 AND c.title LIKE '%$query%' OR c.tags LIKE '%$query%' OR c.affiliation  LIKE '%$query%'  OR c.description  LIKE '%$query%'   $categories_cmd ORDER BY c.views_count DESC");
    //          $contents_ids = $contents_ids[0]->ids;

    //          $users = [];
    //          $contents = [];

    //          if ($users_ids) {
    //              $users = DB::select("SELECT name,id, (SELECT profile_pic_url FROM profiles WHERE user_id=u.id) as avatar, (SELECT name FROM roles WHERE id=u.role_id) as role FROM users u WHERE id IN ($users_ids) GROUP BY id");
    //          }

    //          if (!$users_ids && $contents_ids) {
    //              $users = DB::select("SELECT u.name,u.id, (SELECT profile_pic_url FROM profiles WHERE user_id=u.id) as avatar, (SELECT name FROM roles WHERE id=u.role_id) as role FROM users u JOIN content c ON u.id=c.user_id WHERE c.id IN ($contents_ids) GROUP BY u.id");
    //          }



    //          if ($contents_ids) {
    //              $contents = DB::select("SELECT c.id, c.title, c.authors, c.affiliation, c.duration, c.image_url, c.downloaded_count, c.views_count, c.featured, (SELECT name FROM users WHERE id=c.user_id) as author,
    //              (SELECT name FROM difficulty_level WHERE id=c.difficulty_level_id) as difficulty_level, c.content_privacy FROM content c WHERE c.status=1 AND c.archive=0 AND c.id IN ($contents_ids) GROUP BY c.id ORDER BY c.views_count DESC");
    //          }
    //          // else {
    //          //     $contents = DB::select("SELECT c.id, c.title, c.duration, c.image_url, c.downloaded_count, c.views_count, c.featured, (SELECT name FROM users WHERE id=c.user_id) as author,
    //          //     (SELECT name FROM difficulty_level WHERE id=c.difficulty_level_id) as difficulty_level FROM content c WHERE (c.status=1 AND c.content_privacy=1) AND c.id IN ($contents_ids) GROUP BY c.id ORDER BY c.views_count DESC");

    //          // }

    //          if ($users_ids && !$contents_ids) {
    //              $contents = DB::select("SELECT c.id, c.title, c.authors, c.affiliation, c.duration, c.image_url, c.downloaded_count, c.views_count, c.featured, (SELECT name FROM users WHERE id=c.user_id) as author,
    //              (SELECT name FROM difficulty_level WHERE id=c.difficulty_level_id) as difficulty_level, c.content_privacy FROM content c JOIN users u ON u.id=c.user_id WHERE u.id IN ($users_ids) GROUP BY c.id ORDER BY c.views_count DESC");
    //          }

    //          // code by javed
    //          $matchUser = DB::table('users')->where('name','like',"%{$query}%")->get();
    //          // end



    //          return view('search', compact('contents', 'users', 'user_content_updated_list','matchUser'));

    //      } else {
    //          return redirect('/');
    //      }
    //  }


     /////////////////////////////////////////////////////////////////////

    public function search(Request $request)
     {
         $user_content_updated_list = "";
         if (Auth::check()) {
             $user_id = Auth::user()->id;
             $role_id = Auth::user()->role_id;

             $user_content_updated_list = DB::select("SELECT GROUP_CONCAT(content_id) as content_ids FROM student_content_mapping WHERE user_id=$user_id");
             $user_content_updated_list = $user_content_updated_list[0]->content_ids;
         }

         if ($request->has('query') && $request->input('query') != "") {
             $query = $request->input('query');

             $categories = DB::table('categories')->select("id")->where('name','like',"%{$query}%")->get();

             $users_ids = DB::table('users')->selectRaw("GROUP_CONCAT(id separator ', ') AS ids")->where('name','!=','Admin')->where('name','like',"%{$query}%")->get();


             $users_ids = $users_ids[0]->ids;




             $contents_ids = DB::table('content')->selectRaw(" GROUP_CONCAT(id separator ', ') AS ids")
             ->where('status',1)->where('title','like',"%{$query}%")
             ->orWhere('tags','like',"%{$query}%")
             ->orWhere('affiliation','like',"%{$query}%")
             ->orWhere('description','like',"%{$query}%")
             ->orWhere('authors','like',"%{$query}%");





             if (count($categories)) {
                 $categories = $categories[0]->id;
                 // $categories_cmd = "OR c.category_ids LIKE '%,$categories,%'";
                 $categories_cmd = $contents_ids->orWhere('category_ids','like',"%{,$categories,}%");

             } else {
                 $categories_cmd = "";
             }

             $contents_ids->orderBy('views_count','desc');
             $dataQ = $contents_ids->get();

             $contents_ids = $dataQ[0]->ids;

             $users = [];
             $contents = [];
             // dd($contents_ids);

             if ($users_ids) {
                 $users = DB::select("SELECT name,id, (SELECT profile_pic_url FROM profiles WHERE user_id=u.id) as avatar, (SELECT name FROM roles WHERE id=u.role_id) as role FROM users u WHERE id IN ($users_ids) GROUP BY id");
             }

             if (!$users_ids && $contents_ids) {
                 $users = DB::select("SELECT u.name,u.id, (SELECT profile_pic_url FROM profiles WHERE user_id=u.id) as avatar, (SELECT name FROM roles WHERE id=u.role_id) as role FROM users u JOIN content c ON u.id=c.user_id WHERE c.id IN ($contents_ids) GROUP BY u.id");
             }



             if ($contents_ids) {
                 $contents = DB::select("SELECT c.id, c.title, c.authors, c.affiliation, c.duration, c.image_url, c.scope_type, c.downloaded_count, c.views_count, c.featured, c.content_group,content_details.type AS formatType, (SELECT name FROM users WHERE id=c.user_id) as author,
                 (SELECT name FROM difficulty_level WHERE id=c.difficulty_level_id) as difficulty_level,
                 (SELECT count(course_id) FROM course_content_detail WHERE course_id=c.id) as count, c.content_privacy
               FROM content c 
                   LEFT JOIN content_details ON content_details.content_id=c.id 
              WHERE c.status=1 AND c.archive=0 AND c.id IN ($contents_ids) GROUP BY c.id ORDER BY c.views_count DESC");
             }


             if ($users_ids && !$contents_ids) {
                 $contents = DB::select("SELECT c.id, c.title, c.authors, c.affiliation, c.duration, c.image_url, c.scope_type, c.downloaded_count, c.views_count, c.featured, c.content_group,content_details.type AS formatType, (SELECT name FROM users WHERE id=c.user_id) as author,
                 (SELECT name FROM difficulty_level WHERE id=c.difficulty_level_id) as difficulty_level, (SELECT count(course_id) FROM course_content_detail WHERE course_id=c.id) as count, c.content_privacy 
              FROM content c
 LEFT JOIN content_details ON content_details.content_id=c.id 
 JOIN users u ON u.id=c.user_id WHERE u.id IN ($users_ids) AND c.status=1 AND c.archive=0  GROUP BY c.id ORDER BY c.views_count DESC");
             }

             // code by javed
             $matchUser = DB::table('users')->where('name','like',"%{$query}%")->get();
             // end


            //  $courseC = DB::Table("course_content_detail")->where('course_id', $contents_ids);
            //  $courseCount = $courseC->get()->count();

            //  dd($courseCount);


             return view('search', compact('contents', 'users', 'user_content_updated_list','matchUser','courseCount'));

         } else {
             return redirect('/');
         }
     }


//      public function search(Request $request)
//     {
//             $user_content_updated_list = "";
//             if (Auth::check()) {
//             $user_id = Auth::user()->id;

//             $user_content_updated_list = DB::select("SELECT GROUP_CONCAT(content_id) as content_ids FROM student_content_mapping WHERE user_id=$user_id");
//             $user_content_updated_list = $user_content_updated_list[0]->content_ids;
//             }

//             if ($request->has('query') && $request->input('query') != "") {
//             $query = $request->input('query');

//             $categories = DB::select("SELECT id FROM categories WHERE name LIKE '%".str_replace("'", '', $query)."%'");

//             if (count($categories)) {
//             $categories = $categories[0]->id;
//             $categories_cmd = "OR c.category_ids LIKE '%,$categories,%'";
//             } else {
//             $categories_cmd = "";
//             }

//             $users_ids = DB::select("SELECT GROUP_CONCAT(id separator ', ') AS ids FROM users u WHERE name!= 'Admin' AND name LIKE '%".str_replace("'", '', $query)."%'");
//             $users_ids = $users_ids[0]->ids;

//             $contents_ids = DB::select("SELECT GROUP_CONCAT(c.id separator ', ') AS ids FROM content c WHERE c.status=1 AND c.title LIKE '%".str_replace("'", '', $query)."%' OR c.tags LIKE '%".str_replace("'", '', $query)."%' OR c.affiliation LIKE '%".str_replace("'", '', $query)."%' OR c.description LIKE '%".str_replace("'", '', $query)."%' $categories_cmd ORDER BY c.views_count DESC");
//             $contents_ids = $contents_ids[0]->ids;

//             $users = [];
//             $contents = [];

//             if ($users_ids) {
//             $users = DB::select("SELECT name,id, (SELECT profile_pic_url FROM profiles WHERE user_id=u.id) as avatar, (SELECT name FROM roles WHERE id=u.role_id) as role FROM users u WHERE id IN ($users_ids) GROUP BY id");
//             }

//             if (!$users_ids && $contents_ids) {
//             $users = DB::select("SELECT u.name,u.id, (SELECT profile_pic_url FROM profiles WHERE user_id=u.id) as avatar, (SELECT name FROM roles WHERE id=u.role_id) as role FROM users u JOIN content c ON u.id=c.user_id WHERE c.id IN ($contents_ids) GROUP BY u.id");
//             }



//             if ($contents_ids) {
//             $contents = DB::select("SELECT c.id, c.title, c.authors, c.affiliation, c.duration, c.image_url, c.downloaded_count, c.views_count, c.featured, (SELECT name FROM users WHERE id=c.user_id) as author,
//             (SELECT name FROM difficulty_level WHERE id=c.difficulty_level_id) as difficulty_level, c.content_privacy FROM content c WHERE c.status=1 AND c.archive=0 AND c.id IN ($contents_ids) GROUP BY c.id ORDER BY c.views_count DESC");
//             }
//             // else {
//             // $contents = DB::select("SELECT c.id, c.title, c.duration, c.image_url, c.downloaded_count, c.views_count, c.featured, (SELECT name FROM users WHERE id=c.user_id) as author,
//             // (SELECT name FROM difficulty_level WHERE id=c.difficulty_level_id) as difficulty_level FROM content c WHERE (c.status=1 AND c.content_privacy=1) AND c.id IN ($contents_ids) GROUP BY c.id ORDER BY c.views_count DESC");

//             // }

//             if ($users_ids && !$contents_ids) {
//             $contents = DB::select("SELECT c.id, c.title, c.authors, c.affiliation, c.duration, c.image_url, c.downloaded_count, c.views_count, c.featured, (SELECT name FROM users WHERE id=c.user_id) as author,
//             (SELECT name FROM difficulty_level WHERE id=c.difficulty_level_id) as difficulty_level, c.content_privacy FROM content c JOIN users u ON u.id=c.user_id WHERE u.id IN ($users_ids) GROUP BY c.id ORDER BY c.views_count DESC");
//             }

//                 // code by javed
//                 $matchUser = DB::table('users')->where('name','like',"%{$query}%")->get();
//                 // end



//     return view('search', compact('contents', 'users', 'user_content_updated_list','matchUser'));

//     } else {
//     return redirect('/');
//     }
// }


    /////////////////////////////////////////////////////////////////////






    public function coursesPg($category_id)
    {
        $user_content_updated_list = null;

        if (Auth::check()) {
            $user_id = Auth::user()->id;

            $user_content_updated_list = DB::select("SELECT GROUP_CONCAT(content_id) as content_ids FROM student_content_mapping WHERE user_id=$user_id");
            $user_content_updated_list = $user_content_updated_list[0]->content_ids;
        }

        $difficulty_level = DB::select("SELECT id, name FROM difficulty_level");

        $cat = DB::select("SELECT id, name, avatar, description FROM categories WHERE id=$category_id");
        $cat = $cat[0];
        $tags = DB::select("SELECT id, name FROM tags WHERE cat_id=$category_id");

        $per_page = 6;
        $offset = 0;

        $content_total = DB::select("SELECT COUNT(*) as total FROM content WHERE category_ids LIKE '%,$category_id,%' AND status=1 AND archive=0");
        $content_total = $content_total[0]->total;
        $content_pages = ceil($content_total / $per_page);

        $course_total = DB::select("SELECT COUNT(*) as total FROM content WHERE category_ids LIKE '%,$category_id,%' AND status=1 AND archive=0 AND scope_type='course'");
        $course_total = $course_total[0]->total;
        $course_pages = ceil($course_total / $per_page);

        $Exercise_total = DB::select("SELECT COUNT(*) as total FROM content WHERE category_ids LIKE '%,$category_id,%' AND status=1 AND archive=0 AND content_group='Exercise'");
        $Exercise_total = $Exercise_total[0]->total;
        $Exercise_pages = ceil($Exercise_total / $per_page);

        $Syllabus_total = DB::select("SELECT COUNT(*) as total FROM content WHERE category_ids LIKE '%,$category_id,%' AND status=1 AND archive=0 AND content_group='Syllabus'");
        $Syllabus_total = $Syllabus_total[0]->total;
        $Syllabus_pages = ceil($Syllabus_total / $per_page);

        $Data_total = DB::select("SELECT COUNT(*) as total FROM content WHERE category_ids LIKE '%,$category_id,%' AND status=1 AND archive=0 AND content_group='Data'");
        $Data_total = $Data_total[0]->total;
        $Data_pages = ceil($Data_total / $per_page);

        $Website_total = DB::select("SELECT COUNT(*) as total FROM content WHERE category_ids LIKE '%,$category_id,%' AND status=1 AND archive=0 AND content_group='Website'");
        $Website_total = $Website_total[0]->total;
        $Website_pages = ceil($Website_total / $per_page);

        if(Auth::check() && Auth::user()->role_id != 2) {

        $contents = DB::select("SELECT content.*, users.name as user, difficulty_level.name as difficulty_level,content_details.type AS formatType,
        (SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, content.category_ids)) as categories,
        (SELECT COUNT(course_id) FROM course_content_detail WHERE course_id=content.id) AS coursecount
        FROM content LEFT JOIN users ON content.user_id=users.id LEFT JOIN difficulty_level ON content.difficulty_level_id=difficulty_level.id
        LEFT JOIN content_details ON content_details.content_id=content.id
        WHERE content.category_ids LIKE '%,$category_id,%' AND content.status=1 AND content.archive=0 ORDER BY content.views_count DESC LIMIT $per_page OFFSET $offset");
            
            $courses_g = DB::select("SELECT content.*, users.name as user, difficulty_level.name as difficulty_level,content_details.type AS formatType,
            (SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, content.category_ids)) as categories,
          (SELECT COUNT(course_id) FROM course_content_detail WHERE course_id=content.id) AS coursecount
            FROM content LEFT JOIN users ON content.user_id=users.id LEFT JOIN difficulty_level ON content.difficulty_level_id=difficulty_level.id
            LEFT JOIN content_details ON content_details.content_id=content.id
            WHERE content.category_ids LIKE '%,$category_id,%' AND content.scope_type='course' AND content.status=1 AND content.archive=0 ORDER BY content.views_count DESC LIMIT $per_page OFFSET $offset");

$exercise_g = DB::select("SELECT content.*, users.name as user, difficulty_level.name as difficulty_level,content_details.type AS formatType,
         (SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, content.category_ids)) as categories,
(SELECT COUNT(course_id) FROM course_content_detail WHERE course_id=content.id) AS coursecount
FROM content LEFT JOIN users ON content.user_id=users.id LEFT JOIN difficulty_level ON content.difficulty_level_id=difficulty_level.id
LEFT JOIN content_details ON content_details.content_id=content.id
WHERE content.category_ids LIKE '%,$category_id,%' AND content.content_group='Exercise' AND content.status=1 AND content.archive=0 ORDER BY content.views_count DESC LIMIT $per_page OFFSET $offset");

$syllabus_g = DB::select("SELECT content.*, users.name as user, difficulty_level.name as difficulty_level,content_details.type AS formatType,
        (SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, content.category_ids)) as categories,
(SELECT COUNT(course_id) FROM course_content_detail WHERE course_id=content.id) AS coursecount
FROM content LEFT JOIN users ON content.user_id=users.id LEFT JOIN difficulty_level ON content.difficulty_level_id=difficulty_level.id
LEFT JOIN content_details ON content_details.content_id=content.id
WHERE content.category_ids LIKE '%,$category_id,%' AND content.content_group='Syllabus' AND content.status=1 AND content.archive=0 ORDER BY content.views_count DESC LIMIT $per_page OFFSET $offset");

$data_g = DB::select("SELECT content.*, users.name as user, difficulty_level.name as difficulty_level,content_details.type AS formatType,
(SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, content.category_ids)) as categories,
(SELECT COUNT(course_id) FROM course_content_detail WHERE course_id=content.id) AS coursecount
FROM content LEFT JOIN users ON content.user_id=users.id LEFT JOIN difficulty_level ON content.difficulty_level_id=difficulty_level.id
LEFT JOIN content_details ON content_details.content_id=content.id
WHERE content.category_ids LIKE '%,$category_id,%' AND content.content_group='Data' AND content.status=1 AND content.archive=0 ORDER BY content.views_count DESC LIMIT $per_page OFFSET $offset");
    
    $website_g = DB::select("SELECT content.*, users.name as user, difficulty_level.name as difficulty_level,content_details.type AS formatType,
    (SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, content.category_ids)) as categories,
(SELECT COUNT(course_id) FROM course_content_detail WHERE course_id=content.id) AS coursecount
    FROM content LEFT JOIN users ON content.user_id=users.id LEFT JOIN difficulty_level ON content.difficulty_level_id=difficulty_level.id
LEFT JOIN content_details ON content_details.content_id=content.id
    WHERE content.category_ids LIKE '%,$category_id,%' AND content.content_group='Website' AND content.status=1 AND content.archive=0 ORDER BY content.views_count DESC LIMIT $per_page OFFSET $offset");
    }
        else {

            $contents = DB::select("SELECT content.*, users.name as user, difficulty_level.name as difficulty_level,content_details.type AS formatType,
            (SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, content.category_ids)) as categories,
            (SELECT COUNT(course_id) FROM course_content_detail WHERE course_id=content.id) AS coursecount
            FROM content LEFT JOIN users ON content.user_id=users.id LEFT JOIN difficulty_level ON content.difficulty_level_id=difficulty_level.id
            LEFT JOIN content_details ON content_details.content_id=content.id
            WHERE content.category_ids LIKE '%,$category_id,%' AND content.status=1 AND content.content_privacy=0  AND content.archive=0 ORDER BY content.views_count DESC LIMIT $per_page OFFSET $offset");

$courses_g = DB::select("SELECT content.*, users.name as user, difficulty_level.name as difficulty_level,content_details.type AS formatType,
(SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, content.category_ids)) as categories,
(SELECT COUNT(course_id) FROM course_content_detail WHERE course_id=content.id) AS coursecount
FROM content LEFT JOIN users ON content.user_id=users.id LEFT JOIN difficulty_level ON content.difficulty_level_id=difficulty_level.id
LEFT JOIN content_details ON content_details.content_id=content.id
WHERE content.category_ids LIKE '%,$category_id,%' AND content.scope_type='course' AND content.status=1 AND content.content_privacy=0  AND content.archive=0 ORDER BY content.views_count DESC LIMIT $per_page OFFSET $offset");

$exercise_g = DB::select("SELECT content.*, users.name as user, difficulty_level.name as difficulty_level,content_details.type AS formatType,
(SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, content.category_ids)) as categories,
(SELECT COUNT(course_id) FROM course_content_detail WHERE course_id=content.id) AS coursecount
FROM content LEFT JOIN users ON content.user_id=users.id LEFT JOIN difficulty_level ON content.difficulty_level_id=difficulty_level.id
LEFT JOIN content_details ON content_details.content_id=content.id
WHERE content.category_ids LIKE '%,$category_id,%' AND content.content_group='Exercise'  AND content.status=1 AND content.content_privacy=0  AND content.archive=0 ORDER BY content.views_count DESC LIMIT $per_page OFFSET $offset");

$syllabus_g = DB::select("SELECT content.*, users.name as user, difficulty_level.name as difficulty_level,content_details.type AS formatType,
(SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, content.category_ids)) as categories,
(SELECT COUNT(course_id) FROM course_content_detail WHERE course_id=content.id) AS coursecount
FROM content LEFT JOIN users ON content.user_id=users.id LEFT JOIN difficulty_level ON content.difficulty_level_id=difficulty_level.id
LEFT JOIN content_details ON content_details.content_id=content.id
WHERE content.category_ids LIKE '%,$category_id,%' AND content.content_group='Syllabus' AND content.status=1 AND content.content_privacy=0  AND content.archive=0 ORDER BY content.views_count DESC LIMIT $per_page OFFSET $offset");

$data_g = DB::select("SELECT content.*, users.name as user, difficulty_level.name as difficulty_level,content_details.type AS formatType,
(SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, content.category_ids)) as categories,
(SELECT COUNT(course_id) FROM course_content_detail WHERE course_id=content.id) AS coursecount
FROM content LEFT JOIN users ON content.user_id=users.id LEFT JOIN difficulty_level ON content.difficulty_level_id=difficulty_level.id
LEFT JOIN content_details ON content_details.content_id=content.id
WHERE content.category_ids LIKE '%,$category_id,%' AND content.content_group='Data' AND content.status=1 AND content.content_privacy=0  AND content.archive=0 ORDER BY content.views_count DESC LIMIT $per_page OFFSET $offset");

$website_g = DB::select("SELECT content.*, users.name as user, difficulty_level.name as difficulty_level,content_details.type AS formatType,
(SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, content.category_ids)) as categories,
(SELECT COUNT(course_id) FROM course_content_detail WHERE course_id=content.id) AS coursecount
FROM content LEFT JOIN users ON content.user_id=users.id LEFT JOIN difficulty_level ON content.difficulty_level_id=difficulty_level.id
LEFT JOIN content_details ON content_details.content_id=content.id
WHERE content.category_ids LIKE '%,$category_id,%' AND content.content_group='Website' AND content.status=1 AND content.content_privacy=0  AND content.archive=0 ORDER BY content.views_count DESC LIMIT $per_page OFFSET $offset");
        }
        if($contents){
        $contentID= $contents[0]->id;
        $courseC = DB::Table("course_content_detail")->where('course_id',  $contentID);
        $courseCount = $courseC->get()->count();
}else{
 $courseCount = '0';

}


        return view('student.courses', compact(
            'cat',
            'tags',
            'content_total',
            'content_pages',
            'course_pages',
            'Exercise_pages',
            'Syllabus_pages',
            'Data_pages',
            'Website_pages',
            'contents',
            'courses_g',
            'exercise_g',
            'syllabus_g',
            'data_g',
            'website_g',
            'difficulty_level',
            'user_content_updated_list',
            'courseCount'
        ));
    }

    public function coursesPgFilter(Request $request)
    {

        $cat_id = $request['cat_id'];
        $sort = $request['sort'];
        $difficulty_level_id = $request['difficulty_level_id'];
        $page = $request['page'];

        $_video = $request['_video'];
        $_article = $request['_article'];
        $_pdf = $request['_pdf'];
        $_image = $request['_image'];
        $_audio = $request['_audio'];


        $tagBtn = $request['tagBtn'];
        $searchQuery = $request['searchQuery'];
        $content_formate_sort = $request['content_formate_sort'];

        if ($sort) {
            switch ($sort) {
                case 'popular':
                    $sort = "ORDER BY content.views_count DESC";
                    break;
                case 'alpha':
                    $sort = "ORDER BY content.title ASC";
                    break;
                case 'new':
                    $sort = "ORDER BY content.created_at DESC";
                    break;
                default:
                    $sort = "ORDER BY content.views_count DESC";
                    break;
            }
        }
        // if ($content_formate_sort) {
        //     switch ($content_formate_sort) {
        //         case 'popular':
        //             $scontent_formate_sort = "AND content.content_group=='' ";
        //             break;
        //         case 'alpha':
        //             $content_formate_sort = "AND content.content_group==''";
        //             break;
        //         case 'new':
        //             $content_formate_sort = "AND content.content_group==''";
        //             break;
        //         default:
        //             $content_formate_sort = "ORDER BY content.views_count DESC";
        //             break;
        //     }
        // }

        if ($cat_id && $cat_id != "") {
            $condition = " WHERE content.category_ids LIKE '%,$cat_id,%'";
            $per_page = 6;
        } else {
            $condition = " WHERE";
            $per_page = 8;
        }

        if ($difficulty_level_id) {
            $difficulty_level_id = json_decode(json_encode($difficulty_level_id),true);

            // if ($difficulty_level_id[0] != 'all') {
            if ($difficulty_level_id != 'all') {
                // $difficulty_level_id = '(' . join(',', $difficulty_level_id) . ')';
                // $condition .= " AND content.difficulty_level_id IN $difficulty_level_id";
                $condition .= " AND content.difficulty_level_id  = $difficulty_level_id";
            }
        }

        if ($content_formate_sort) {
            switch ($content_formate_sort) {
              case 'video':
                $condition .= " AND content.content_type LIKE '%Video%'";
                break;
              case 'article':
                $condition .= " AND (content.content_type LIKE '%Article%' OR content.content_type LIKE '%Pdf%')";
                break;
              case 'pdf':
                $condition .= " AND content.content_type LIKE '%Pdf%'";
                break;
              case 'image':
                $condition .= " AND content.content_type LIKE '%Image%'";
                break;
               case 'audio':
                $condition .= " AND content.content_type LIKE '%Audio%'";
                break;
               case 'all':
                $condition .= " AND content.status=1";
                break;
            }
        }


        if ($tagBtn != "" && $tagBtn != "All") {
            $condition .= " AND content.tags LIKE '%$tagBtn%'";
        }

        if ($searchQuery && $searchQuery != "") {
            $condition .= " AND content.title LIKE '%$searchQuery%'";
        }


        $offset = ($page - 1) * $per_page;

        $content_total = DB::select("SELECT COUNT(*) as total FROM content $condition AND archive=0");
        $content_total = $content_total[0]->total;
        $content_pages = ceil($content_total / $per_page);

        $course_total = DB::select("SELECT COUNT(*) as total FROM content $condition AND scope_type='course'");
        $course_total = $course_total[0]->total;
        $course_pages = ceil($course_total / $per_page);

        $Exercise_total = DB::select("SELECT COUNT(*) as total FROM content $condition AND content_group='Exercise'");
        $Exercise_total = $Exercise_total[0]->total;
        $Exercise_pages = ceil($Exercise_total / $per_page);

        $Syllabus_total = DB::select("SELECT COUNT(*) as total FROM content $condition AND content_group='Syllabus'");
        $Syllabus_total = $Syllabus_total[0]->total;
        $Syllabus_pages = ceil($Syllabus_total / $per_page);

        $Data_total = DB::select("SELECT COUNT(*) as total FROM content $condition AND content_group='Data'");
        $Data_total = $Data_total[0]->total;
        $Data_pages = ceil($Data_total / $per_page);

        $Website_total = DB::select("SELECT COUNT(*) as total FROM content $condition AND content_group='Website'");
        $Website_total = $Website_total[0]->total;
        $Website_pages = ceil($Website_total / $per_page);


        if(Auth::check() && Auth::user()->role_id != 2) {
        $contents = DB::select("SELECT content.*, users.name as user, difficulty_level.name as difficulty_level,content_details.type AS formatType, (SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, content.category_ids)) as categories,
        (SELECT COUNT(course_id) FROM course_content_detail WHERE course_id=content.id) AS coursecount
        FROM content LEFT JOIN users ON content.user_id=users.id LEFT JOIN difficulty_level ON content.difficulty_level_id=difficulty_level.id
        LEFT JOIN content_details ON content_details.content_id=content.id

       $condition AND content.archive=0 $sort LIMIT $per_page OFFSET $offset");
        }
        else {

            $contents = DB::select("SELECT content.*, users.name as user, difficulty_level.name as difficulty_level,content_details.type AS formatType, (SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, content.category_ids)) as categories,
        (SELECT COUNT(course_id) FROM course_content_detail WHERE course_id=content.id) AS coursecount
            FROM content LEFT JOIN users ON content.user_id=users.id LEFT JOIN difficulty_level ON content.difficulty_level_id=difficulty_level.id
             LEFT JOIN content_details ON content_details.content_id=content.id

           $condition AND  content.content_privacy=0 AND content.archive=0 $sort LIMIT $per_page OFFSET $offset");

        }
        $contentID= $contents[0]->id;
        $courseC = DB::Table("course_content_detail")->where('course_id', $contentID);
        $courseCount = $courseC->get()->count();
 
        return response()->json([
            'success' => true,
            'content_total' => $content_total,
            'content_pages' => $content_pages,
            'course_pages' => $course_pages,
            'Exercise_pages' => $Exercise_pages,
            'Syllabus_pages' => $Syllabus_pages,
            'Data_pages' => $Data_pages,
            'Website_pages' => $Website_pages,
            'content_active_page' => $page,
            'contents' => $contents,
            'courseCount' => $courseCount
        ]);
    }
    public function coursesPgFilter1(Request $request)
    {

        $cat_id = $request['cat_id'];
        $sort = $request['sort'];
        $difficulty_level_id = $request['difficulty_level_id'];
        $page = $request['page'];

        $_video = $request['_video'];
        $_article = $request['_article'];
        $_pdf = $request['_pdf'];
        $_image = $request['_image'];
        $_audio = $request['_audio'];


        $tagBtn = $request['tagBtn'];
        $searchQuery = $request['searchQuery'];
        $content_formate_sort = $request['content_formate_sort'];

        if ($sort) {
            switch ($sort) {
                case 'popular':
                    $sort = "ORDER BY content.views_count DESC";
                    break;
                case 'alpha':
                    $sort = "ORDER BY content.title ASC";
                    break;
                case 'new':
                    $sort = "ORDER BY content.created_at DESC";
                    break;
                default:
                    $sort = "ORDER BY content.views_count DESC";
                    break;
            }
        }

        if ($cat_id && $cat_id != "") {
            $condition = " WHERE content.category_ids LIKE '%,$cat_id,%'";
            $per_page = 6;
        } else {
            
           //$condition = " WHERE ";
            $per_page = 8;
        }

        if ($difficulty_level_id) {
            $difficulty_level_id = json_decode(json_encode($difficulty_level_id),true);

            // if ($difficulty_level_id[0] != 'all') {
            if ($difficulty_level_id != 'all') {
                // $difficulty_level_id = '(' . join(',', $difficulty_level_id) . ')';
                // $condition .= " AND content.difficulty_level_id IN $difficulty_level_id";
                $condition .= " AND content.difficulty_level_id  = $difficulty_level_id";
            }
        }

        if ($content_formate_sort) {
            switch ($content_formate_sort) {
              case 'video':
                $condition .= " AND content.content_type LIKE '%Video%'";
                break;
              case 'article':
                $condition .= " AND (content.content_type LIKE '%Article%' OR content.content_type LIKE '%Pdf%')";
                break;
              case 'pdf':
                $condition .= " AND content.content_type LIKE '%Pdf%'";
                break;
              case 'image':
                $condition .= " AND content.content_type LIKE '%Image%'";
                break;
               case 'audio':
                $condition .= " AND content.content_type LIKE '%Audio%'";
                break;
               case 'all':
                $condition .= " AND content.status=1";
                break;
            }
        }


        if ($tagBtn != "" && $tagBtn != "All") {
            $condition .= " AND content.tags LIKE '%$tagBtn%'";
        }

        if ($searchQuery && $searchQuery != "") {
            $condition .= " AND content.title LIKE '%$searchQuery%'";
        }


        $offset = ($page - 1) * $per_page;

        $content_total = DB::select("SELECT COUNT(*) as total FROM content $condition AND archive=0");
        $content_total = $content_total[0]->total;
        $content_pages = ceil($content_total / $per_page);

        $course_total = DB::select("SELECT COUNT(*) as total FROM content $condition AND scope_type='course'");
        $course_total = $course_total[0]->total;
        $course_pages = ceil($course_total / $per_page);

        $Exercise_total = DB::select("SELECT COUNT(*) as total FROM content $condition AND content_group='Exercise'");
        $Exercise_total = $Exercise_total[0]->total;
        $Exercise_pages = ceil($Exercise_total / $per_page);

        $Syllabus_total = DB::select("SELECT COUNT(*) as total FROM content $condition AND content_group='Syllabus'");
        $Syllabus_total = $Syllabus_total[0]->total;
        $Syllabus_pages = ceil($Syllabus_total / $per_page);

        $Data_total = DB::select("SELECT COUNT(*) as total FROM content $condition AND content_group='Data'");
        $Data_total = $Data_total[0]->total;
        $Data_pages = ceil($Data_total / $per_page);

        $Website_total = DB::select("SELECT COUNT(*) as total FROM content $condition AND content_group='Website'");
        $Website_total = $Website_total[0]->total;
        $Website_pages = ceil($Website_total / $per_page);


        if(Auth::check() && Auth::user()->role_id != 2) {
        $contents = DB::select("SELECT content.*, users.name as user, difficulty_level.name as difficulty_level,content_details.type AS formatType, (SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, content.category_ids)) as categories,
        (SELECT COUNT(course_id) FROM course_content_detail WHERE course_id=content.id) AS coursecount

        FROM content LEFT JOIN users ON content.user_id=users.id LEFT JOIN difficulty_level ON content.difficulty_level_id=difficulty_level.id
        LEFT JOIN content_details ON content_details.content_id=content.id

        $condition AND content.archive=0 AND scope_type='course' $sort LIMIT $per_page OFFSET $offset");
        }
        else {

            $contents = DB::select("SELECT content.*, users.name as user, difficulty_level.name as difficulty_level,content_details.type AS formatType, (SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, content.category_ids)) as categories,
        (SELECT COUNT(course_id) FROM course_content_detail WHERE course_id=content.id) AS coursecount

            FROM content LEFT JOIN users ON content.user_id=users.id LEFT JOIN difficulty_level ON content.difficulty_level_id=difficulty_level.id
             LEFT JOIN content_details ON content_details.content_id=content.id

            $condition AND  content.content_privacy=0 AND content.archive=0 AND scope_type='course' $sort LIMIT $per_page OFFSET $offset");

        }
        $contentID= $contents[0]->id;
        $courseC = DB::Table("course_content_detail")->where('course_id', $contentID);
        $courseCount = $courseC->get()->count();
 
        return response()->json([
            'success' => true,
            'content_total' => $content_total,
            'content_pages' => $content_pages,
            'course_pages' => $course_pages,
            'Exercise_pages' => $Exercise_pages,
            'Syllabus_pages' => $Syllabus_pages,
            'Data_pages' => $Data_pages,
            'Website_pages' => $Website_pages,
            'content_active_page' => $page,
            'contents' => $contents,
            'courseCount' => $courseCount
        ]);
    }

    public function coursesPgFilter2(Request $request)
    {

        $cat_id = $request['cat_id'];
        $sort = $request['sort'];
        $difficulty_level_id = $request['difficulty_level_id'];
        $page = $request['page'];

        $_video = $request['_video'];
        $_article = $request['_article'];
        $_pdf = $request['_pdf'];
        $_image = $request['_image'];
        $_audio = $request['_audio'];


        $tagBtn = $request['tagBtn'];
        $searchQuery = $request['searchQuery'];
        $content_formate_sort = $request['content_formate_sort'];

        if ($sort) {
            switch ($sort) {
                case 'popular':
                    $sort = "ORDER BY content.views_count DESC";
                    break;
                case 'alpha':
                    $sort = "ORDER BY content.title ASC";
                    break;
                case 'new':
                    $sort = "ORDER BY content.created_at DESC";
                    break;
                default:
                    $sort = "ORDER BY content.views_count DESC";
                    break;
            }
        }

        if ($cat_id && $cat_id != "") {
            $condition = " WHERE content.category_ids LIKE '%,$cat_id,%'";
            $per_page = 6;
        } else {
            
           //$condition = " WHERE ";
            $per_page = 8;
        }

        if ($difficulty_level_id) {
            $difficulty_level_id = json_decode(json_encode($difficulty_level_id),true);

            // if ($difficulty_level_id[0] != 'all') {
            if ($difficulty_level_id != 'all') {
                // $difficulty_level_id = '(' . join(',', $difficulty_level_id) . ')';
                // $condition .= " AND content.difficulty_level_id IN $difficulty_level_id";
                $condition .= " AND content.difficulty_level_id  = $difficulty_level_id";
            }
        }

        if ($content_formate_sort) {
            switch ($content_formate_sort) {
              case 'video':
                $condition .= " AND content.content_type LIKE '%Video%'";
                break;
              case 'article':
                $condition .= " AND (content.content_type LIKE '%Article%' OR content.content_type LIKE '%Pdf%')";
                break;
              case 'pdf':
                $condition .= " AND content.content_type LIKE '%Pdf%'";
                break;
              case 'image':
                $condition .= " AND content.content_type LIKE '%Image%'";
                break;
               case 'audio':
                $condition .= " AND content.content_type LIKE '%Audio%'";
                break;
               case 'all':
                $condition .= " AND content.status=1";
                break;
            }
        }


        if ($tagBtn != "" && $tagBtn != "All") {
            $condition .= " AND content.tags LIKE '%$tagBtn%'";
        }

        if ($searchQuery && $searchQuery != "") {
            $condition .= " AND content.title LIKE '%$searchQuery%'";
        }


        $offset = ($page - 1) * $per_page;

        $content_total = DB::select("SELECT COUNT(*) as total FROM content $condition AND archive=0");
        $content_total = $content_total[0]->total;
        $content_pages = ceil($content_total / $per_page);

        $course_total = DB::select("SELECT COUNT(*) as total FROM content $condition AND scope_type='course'");
        $course_total = $course_total[0]->total;
        $course_pages = ceil($course_total / $per_page);

        $Exercise_total = DB::select("SELECT COUNT(*) as total FROM content $condition AND content_group='Exercise'");
        $Exercise_total = $Exercise_total[0]->total;
        $Exercise_pages = ceil($Exercise_total / $per_page);

        $Syllabus_total = DB::select("SELECT COUNT(*) as total FROM content $condition AND content_group='Syllabus'");
        $Syllabus_total = $Syllabus_total[0]->total;
        $Syllabus_pages = ceil($Syllabus_total / $per_page);

        $Data_total = DB::select("SELECT COUNT(*) as total FROM content $condition AND content_group='Data'");
        $Data_total = $Data_total[0]->total;
        $Data_pages = ceil($Data_total / $per_page);

        $Website_total = DB::select("SELECT COUNT(*) as total FROM content $condition AND content_group='Website'");
        $Website_total = $Website_total[0]->total;
        $Website_pages = ceil($Website_total / $per_page);


        if(Auth::check() && Auth::user()->role_id != 2) {
        $contents = DB::select("SELECT content.*, users.name as user, difficulty_level.name as difficulty_level,content_details.type AS formatType, (SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, content.category_ids)) as categories,
        (SELECT COUNT(course_id) FROM course_content_detail WHERE course_id=content.id) AS coursecount

        FROM content LEFT JOIN users ON content.user_id=users.id LEFT JOIN difficulty_level ON content.difficulty_level_id=difficulty_level.id
        LEFT JOIN content_details ON content_details.content_id=content.id

        $condition AND content.archive=0 AND content_group='Syllabus' $sort LIMIT $per_page OFFSET $offset");
        }
        else {

            $contents = DB::select("SELECT content.*, users.name as user, difficulty_level.name as difficulty_level,content_details.type AS formatType, (SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, content.category_ids)) as categories,
        (SELECT COUNT(course_id) FROM course_content_detail WHERE course_id=content.id) AS coursecount

            FROM content LEFT JOIN users ON content.user_id=users.id LEFT JOIN difficulty_level ON content.difficulty_level_id=difficulty_level.id
             LEFT JOIN content_details ON content_details.content_id=content.id

            $condition AND  content.content_privacy=0 AND content.archive=0 AND content_group='Syllabus' $sort LIMIT $per_page OFFSET $offset");

        }
        $contentID= $contents[0]->id;
        $courseC = DB::Table("course_content_detail")->where('course_id', $contentID);
        $courseCount = $courseC->get()->count();
 
        return response()->json([
            'success' => true,
            'content_total' => $content_total,
            'content_pages' => $content_pages,
            'course_pages' => $course_pages,
            'Exercise_pages' => $Exercise_pages,
            'Syllabus_pages' => $Syllabus_pages,
            'Data_pages' => $Data_pages,
            'Website_pages' => $Website_pages,
            'content_active_page' => $page,
            'contents' => $contents,
            'courseCount' => $courseCount
        ]);
    }
    public function coursesPgFilter3(Request $request)
    {

        $cat_id = $request['cat_id'];
        $sort = $request['sort'];
        $difficulty_level_id = $request['difficulty_level_id'];
        $page = $request['page'];

        $_video = $request['_video'];
        $_article = $request['_article'];
        $_pdf = $request['_pdf'];
        $_image = $request['_image'];
        $_audio = $request['_audio'];


        $tagBtn = $request['tagBtn'];
        $searchQuery = $request['searchQuery'];
        $content_formate_sort = $request['content_formate_sort'];

        if ($sort) {
            switch ($sort) {
                case 'popular':
                    $sort = "ORDER BY content.views_count DESC";
                    break;
                case 'alpha':
                    $sort = "ORDER BY content.title ASC";
                    break;
                case 'new':
                    $sort = "ORDER BY content.created_at DESC";
                    break;
                default:
                    $sort = "ORDER BY content.views_count DESC";
                    break;
            }
        }

        if ($cat_id && $cat_id != "") {
            $condition = " WHERE content.category_ids LIKE '%,$cat_id,%'";
            $per_page = 6;
        } else {
            
           //$condition = " WHERE ";
            $per_page = 8;
        }

        if ($difficulty_level_id) {
            $difficulty_level_id = json_decode(json_encode($difficulty_level_id),true);

            // if ($difficulty_level_id[0] != 'all') {
            if ($difficulty_level_id != 'all') {
                // $difficulty_level_id = '(' . join(',', $difficulty_level_id) . ')';
                // $condition .= " AND content.difficulty_level_id IN $difficulty_level_id";
                $condition .= " AND content.difficulty_level_id  = $difficulty_level_id";
            }
        }

        if ($content_formate_sort) {
            switch ($content_formate_sort) {
              case 'video':
                $condition .= " AND content.content_type LIKE '%Video%'";
                break;
              case 'article':
                $condition .= " AND (content.content_type LIKE '%Article%' OR content.content_type LIKE '%Pdf%')";
                break;
              case 'pdf':
                $condition .= " AND content.content_type LIKE '%Pdf%'";
                break;
              case 'image':
                $condition .= " AND content.content_type LIKE '%Image%'";
                break;
               case 'audio':
                $condition .= " AND content.content_type LIKE '%Audio%'";
                break;
               case 'all':
                $condition .= " AND content.status=1";
                break;
            }
        }


        if ($tagBtn != "" && $tagBtn != "All") {
            $condition .= " AND content.tags LIKE '%$tagBtn%'";
        }

        if ($searchQuery && $searchQuery != "") {
            $condition .= " AND content.title LIKE '%$searchQuery%'";
        }


        $offset = ($page - 1) * $per_page;

        $content_total = DB::select("SELECT COUNT(*) as total FROM content $condition AND archive=0");
        $content_total = $content_total[0]->total;
        $content_pages = ceil($content_total / $per_page);

        $course_total = DB::select("SELECT COUNT(*) as total FROM content $condition AND scope_type='course'");
        $course_total = $course_total[0]->total;
        $course_pages = ceil($course_total / $per_page);

        $Exercise_total = DB::select("SELECT COUNT(*) as total FROM content $condition AND content_group='Exercise'");
        $Exercise_total = $Exercise_total[0]->total;
        $Exercise_pages = ceil($Exercise_total / $per_page);

        $Syllabus_total = DB::select("SELECT COUNT(*) as total FROM content $condition AND content_group='Syllabus'");
        $Syllabus_total = $Syllabus_total[0]->total;
        $Syllabus_pages = ceil($Syllabus_total / $per_page);

        $Data_total = DB::select("SELECT COUNT(*) as total FROM content $condition AND content_group='Data'");
        $Data_total = $Data_total[0]->total;
        $Data_pages = ceil($Data_total / $per_page);

        $Website_total = DB::select("SELECT COUNT(*) as total FROM content $condition AND content_group='Website'");
        $Website_total = $Website_total[0]->total;
        $Website_pages = ceil($Website_total / $per_page);


        if(Auth::check() && Auth::user()->role_id != 2) {
        $contents = DB::select("SELECT content.*, users.name as user, difficulty_level.name as difficulty_level,content_details.type AS formatType, (SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, content.category_ids)) as categories,
        (SELECT COUNT(course_id) FROM course_content_detail WHERE course_id=content.id) AS coursecount

        FROM content LEFT JOIN users ON content.user_id=users.id LEFT JOIN difficulty_level ON content.difficulty_level_id=difficulty_level.id
        LEFT JOIN content_details ON content_details.content_id=content.id

        $condition AND content.archive=0 AND content_group='Exercise' $sort LIMIT $per_page OFFSET $offset");
        }
        else {

            $contents = DB::select("SELECT content.*, users.name as user, difficulty_level.name as difficulty_level,content_details.type AS formatType, (SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, content.category_ids)) as categories,
        (SELECT COUNT(course_id) FROM course_content_detail WHERE course_id=content.id) AS coursecount

            FROM content LEFT JOIN users ON content.user_id=users.id LEFT JOIN difficulty_level ON content.difficulty_level_id=difficulty_level.id
             LEFT JOIN content_details ON content_details.content_id=content.id

            $condition AND  content.content_privacy=0 AND content.archive=0 AND content_group='Exercise' $sort LIMIT $per_page OFFSET $offset");

        }
        $contentID= $contents[0]->id;
        $courseC = DB::Table("course_content_detail")->where('course_id', $contentID);
        $courseCount = $courseC->get()->count();
 
        return response()->json([
            'success' => true,
            'content_total' => $content_total,
            'content_pages' => $content_pages,
            'course_pages' => $course_pages,
            'Exercise_pages' => $Exercise_pages,
            'Syllabus_pages' => $Syllabus_pages,
            'Data_pages' => $Data_pages,
            'Website_pages' => $Website_pages,
            'content_active_page' => $page,
            'contents' => $contents,
            'courseCount' => $courseCount
        ]);
    }
    public function coursesPgFilter4(Request $request)
    {

        $cat_id = $request['cat_id'];
        $sort = $request['sort'];
        $difficulty_level_id = $request['difficulty_level_id'];
        $page = $request['page'];

        $_video = $request['_video'];
        $_article = $request['_article'];
        $_pdf = $request['_pdf'];
        $_image = $request['_image'];
        $_audio = $request['_audio'];


        $tagBtn = $request['tagBtn'];
        $searchQuery = $request['searchQuery'];
        $content_formate_sort = $request['content_formate_sort'];

        if ($sort) {
            switch ($sort) {
                case 'popular':
                    $sort = "ORDER BY content.views_count DESC";
                    break;
                case 'alpha':
                    $sort = "ORDER BY content.title ASC";
                    break;
                case 'new':
                    $sort = "ORDER BY content.created_at DESC";
                    break;
                default:
                    $sort = "ORDER BY content.views_count DESC";
                    break;
            }
        }

        if ($cat_id && $cat_id != "") {
            $condition = " WHERE content.category_ids LIKE '%,$cat_id,%'";
            $per_page = 6;
        } else {
            
           //$condition = " WHERE ";
            $per_page = 8;
        }

        if ($difficulty_level_id) {
            $difficulty_level_id = json_decode(json_encode($difficulty_level_id),true);

            // if ($difficulty_level_id[0] != 'all') {
            if ($difficulty_level_id != 'all') {
                // $difficulty_level_id = '(' . join(',', $difficulty_level_id) . ')';
                // $condition .= " AND content.difficulty_level_id IN $difficulty_level_id";
                $condition .= " AND content.difficulty_level_id  = $difficulty_level_id";
            }
        }

        if ($content_formate_sort) {
            switch ($content_formate_sort) {
              case 'video':
                $condition .= " AND content.content_type LIKE '%Video%'";
                break;
              case 'article':
                $condition .= " AND (content.content_type LIKE '%Article%' OR content.content_type LIKE '%Pdf%')";
                break;
              case 'pdf':
                $condition .= " AND content.content_type LIKE '%Pdf%'";
                break;
              case 'image':
                $condition .= " AND content.content_type LIKE '%Image%'";
                break;
               case 'audio':
                $condition .= " AND content.content_type LIKE '%Audio%'";
                break;
               case 'all':
                $condition .= " AND content.status=1";
                break;
            }
        }


        if ($tagBtn != "" && $tagBtn != "All") {
            $condition .= " AND content.tags LIKE '%$tagBtn%'";
        }

        if ($searchQuery && $searchQuery != "") {
            $condition .= " AND content.title LIKE '%$searchQuery%'";
        }


        $offset = ($page - 1) * $per_page;

        $content_total = DB::select("SELECT COUNT(*) as total FROM content $condition AND archive=0");
        $content_total = $content_total[0]->total;
        $content_pages = ceil($content_total / $per_page);

        $course_total = DB::select("SELECT COUNT(*) as total FROM content $condition AND scope_type='course'");
        $course_total = $course_total[0]->total;
        $course_pages = ceil($course_total / $per_page);

        $Exercise_total = DB::select("SELECT COUNT(*) as total FROM content $condition AND content_group='Exercise'");
        $Exercise_total = $Exercise_total[0]->total;
        $Exercise_pages = ceil($Exercise_total / $per_page);

        $Syllabus_total = DB::select("SELECT COUNT(*) as total FROM content $condition AND content_group='Syllabus'");
        $Syllabus_total = $Syllabus_total[0]->total;
        $Syllabus_pages = ceil($Syllabus_total / $per_page);

        $Data_total = DB::select("SELECT COUNT(*) as total FROM content $condition AND content_group='Data'");
        $Data_total = $Data_total[0]->total;
        $Data_pages = ceil($Data_total / $per_page);

        $Website_total = DB::select("SELECT COUNT(*) as total FROM content $condition AND content_group='Website'");
        $Website_total = $Website_total[0]->total;
        $Website_pages = ceil($Website_total / $per_page);


        if(Auth::check() && Auth::user()->role_id != 2) {
        $contents = DB::select("SELECT content.*, users.name as user, difficulty_level.name as difficulty_level,content_details.type AS formatType, (SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, content.category_ids)) as categories,
        (SELECT COUNT(course_id) FROM course_content_detail WHERE course_id=content.id) AS coursecount

        FROM content LEFT JOIN users ON content.user_id=users.id LEFT JOIN difficulty_level ON content.difficulty_level_id=difficulty_level.id
        LEFT JOIN content_details ON content_details.content_id=content.id

        $condition AND content.archive=0 AND content_group='Data' $sort LIMIT $per_page OFFSET $offset");
        }
        else {

            $contents = DB::select("SELECT content.*, users.name as user, difficulty_level.name as difficulty_level,content_details.type AS formatType, (SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, content.category_ids)) as categories,
        (SELECT COUNT(course_id) FROM course_content_detail WHERE course_id=content.id) AS coursecount

            FROM content LEFT JOIN users ON content.user_id=users.id LEFT JOIN difficulty_level ON content.difficulty_level_id=difficulty_level.id
             LEFT JOIN content_details ON content_details.content_id=content.id

            $condition AND  content.content_privacy=0 AND content.archive=0 AND content_group='Data' $sort LIMIT $per_page OFFSET $offset");

        }
        $contentID= $contents[0]->id;
        $courseC = DB::Table("course_content_detail")->where('course_id', $contentID);
        $courseCount = $courseC->get()->count();
 
        return response()->json([
            'success' => true,
            'content_total' => $content_total,
            'content_pages' => $content_pages,
            'course_pages' => $course_pages,
            'Exercise_pages' => $Exercise_pages,
            'Syllabus_pages' => $Syllabus_pages,
            'Data_pages' => $Data_pages,
            'Website_pages' => $Website_pages,
            'content_active_page' => $page,
            'contents' => $contents,
            'courseCount' => $courseCount
        ]);
    }
    public function coursesPgFilter5(Request $request)
    {

        $cat_id = $request['cat_id'];
        $sort = $request['sort'];
        $difficulty_level_id = $request['difficulty_level_id'];
        $page = $request['page'];

        $_video = $request['_video'];
        $_article = $request['_article'];
        $_pdf = $request['_pdf'];
        $_image = $request['_image'];
        $_audio = $request['_audio'];


        $tagBtn = $request['tagBtn'];
        $searchQuery = $request['searchQuery'];
        $content_formate_sort = $request['content_formate_sort'];

        if ($sort) {
            switch ($sort) {
                case 'popular':
                    $sort = "ORDER BY content.views_count DESC";
                    break;
                case 'alpha':
                    $sort = "ORDER BY content.title ASC";
                    break;
                case 'new':
                    $sort = "ORDER BY content.created_at DESC";
                    break;
                default:
                    $sort = "ORDER BY content.views_count DESC";
                    break;
            }
        }

        if ($cat_id && $cat_id != "") {
            $condition = " WHERE content.category_ids LIKE '%,$cat_id,%'";
            $per_page = 6;
        } else {
            
           //$condition = " WHERE ";
            $per_page = 8;
        }

        if ($difficulty_level_id) {
            $difficulty_level_id = json_decode(json_encode($difficulty_level_id),true);

            // if ($difficulty_level_id[0] != 'all') {
            if ($difficulty_level_id != 'all') {
                // $difficulty_level_id = '(' . join(',', $difficulty_level_id) . ')';
                // $condition .= " AND content.difficulty_level_id IN $difficulty_level_id";
                $condition .= " AND content.difficulty_level_id  = $difficulty_level_id";
            }
        }

        if ($content_formate_sort) {
            switch ($content_formate_sort) {
              case 'video':
                $condition .= " AND content.content_type LIKE '%Video%'";
                break;
              case 'article':
                $condition .= " AND (content.content_type LIKE '%Article%' OR content.content_type LIKE '%Pdf%')";
                break;
              case 'pdf':
                $condition .= " AND content.content_type LIKE '%Pdf%'";
                break;
              case 'image':
                $condition .= " AND content.content_type LIKE '%Image%'";
                break;
               case 'audio':
                $condition .= " AND content.content_type LIKE '%Audio%'";
                break;
               case 'all':
                $condition .= " AND content.status=1";
                break;
            }
        }


        if ($tagBtn != "" && $tagBtn != "All") {
            $condition .= " AND content.tags LIKE '%$tagBtn%'";
        }

        if ($searchQuery && $searchQuery != "") {
            $condition .= " AND content.title LIKE '%$searchQuery%'";
        }


        $offset = ($page - 1) * $per_page;

        $content_total = DB::select("SELECT COUNT(*) as total FROM content $condition AND archive=0");
        $content_total = $content_total[0]->total;
        $content_pages = ceil($content_total / $per_page);

        $course_total = DB::select("SELECT COUNT(*) as total FROM content $condition AND scope_type='course'");
        $course_total = $course_total[0]->total;
        $course_pages = ceil($course_total / $per_page);

        $Exercise_total = DB::select("SELECT COUNT(*) as total FROM content $condition AND content_group='Exercise'");
        $Exercise_total = $Exercise_total[0]->total;
        $Exercise_pages = ceil($Exercise_total / $per_page);

        $Syllabus_total = DB::select("SELECT COUNT(*) as total FROM content $condition AND content_group='Syllabus'");
        $Syllabus_total = $Syllabus_total[0]->total;
        $Syllabus_pages = ceil($Syllabus_total / $per_page);

        $Data_total = DB::select("SELECT COUNT(*) as total FROM content $condition AND content_group='Data'");
        $Data_total = $Data_total[0]->total;
        $Data_pages = ceil($Data_total / $per_page);

        $Website_total = DB::select("SELECT COUNT(*) as total FROM content $condition AND content_group='Website'");
        $Website_total = $Website_total[0]->total;
        $Website_pages = ceil($Website_total / $per_page);


        if(Auth::check() && Auth::user()->role_id != 2) {
        $contents = DB::select("SELECT content.*, users.name as user, difficulty_level.name as difficulty_level,content_details.type AS formatType, (SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, content.category_ids)) as categories,
        (SELECT COUNT(course_id) FROM course_content_detail WHERE course_id=content.id) AS coursecount

        FROM content LEFT JOIN users ON content.user_id=users.id LEFT JOIN difficulty_level ON content.difficulty_level_id=difficulty_level.id
        LEFT JOIN content_details ON content_details.content_id=content.id

        $condition AND content.archive=0 AND content_group='Website' $sort LIMIT $per_page OFFSET $offset");
        }
        else {

            $contents = DB::select("SELECT content.*, users.name as user, difficulty_level.name as difficulty_level,content_details.type AS formatType, (SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, content.category_ids)) as categories,
        (SELECT COUNT(course_id) FROM course_content_detail WHERE course_id=content.id) AS coursecount

            FROM content LEFT JOIN users ON content.user_id=users.id LEFT JOIN difficulty_level ON content.difficulty_level_id=difficulty_level.id
             LEFT JOIN content_details ON content_details.content_id=content.id

            $condition AND  content.content_privacy=0 AND content.archive=0 AND content_group='Website' $sort LIMIT $per_page OFFSET $offset");

        }
        $contentID= $contents[0]->id;
        $courseC = DB::Table("course_content_detail")->where('course_id', $contentID);
        $courseCount = $courseC->get()->count();
 
        return response()->json([
            'success' => true,
            'content_total' => $content_total,
            'content_pages' => $content_pages,
            'course_pages' => $course_pages,
            'Exercise_pages' => $Exercise_pages,
            'Syllabus_pages' => $Syllabus_pages,
            'Data_pages' => $Data_pages,
            'Website_pages' => $Website_pages,
            'content_active_page' => $page,
            'contents' => $contents,
            'courseCount' => $courseCount
        ]);
    }

    public function searchCoursesPg()
    {
        $user_content_updated_list = null;

        if (Auth::check()) {
            $user_id = Auth::user()->id;

            $user_content_updated_list = DB::select("SELECT GROUP_CONCAT(content_id) as content_ids FROM student_content_mapping WHERE user_id=$user_id");
            $user_content_updated_list = $user_content_updated_list[0]->content_ids;
        }

        $difficulty_level = DB::select("SELECT id, name FROM difficulty_level");

        $cat = DB::select("SELECT id, name, avatar, description FROM categories");
        $cat = $cat[0];
        $tags = DB::select("SELECT id, name FROM tags");

        $per_page = 8;
        $offset = 0;

        $content_total = DB::select("SELECT COUNT(*) as total FROM content WHERE status=1");
        $content_total = $content_total[0]->total;
        $content_pages = ceil($content_total / $per_page);

        if(Auth::check() && Auth::user()->role_id != 2) {
        $contents = DB::select("SELECT content.*, users.name as user, difficulty_level.name as difficulty_level,
        (SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, content.category_ids)) as categories
        FROM content LEFT JOIN users ON content.user_id=users.id LEFT JOIN difficulty_level ON content.difficulty_level_id=difficulty_level.id
        WHERE content.status=1 AND content.archive=0 ORDER BY content.views_count DESC LIMIT $per_page OFFSET $offset");
        }
        else {
            $contents = DB::select("SELECT content.*, users.name as user, difficulty_level.name as difficulty_level,
            (SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, content.category_ids)) as categories
            FROM content LEFT JOIN users ON content.user_id=users.id LEFT JOIN difficulty_level ON content.difficulty_level_id=difficulty_level.id
            WHERE content.status=1 AND content.content_privacy=0 AND content.archive=0 ORDER BY content.views_count DESC LIMIT $per_page OFFSET $offset");


        }

        return view('student.searchCourses', compact(
            'cat',
            'tags',
            'content_total',
            'content_pages',
            'contents',
            'difficulty_level',
            'user_content_updated_list'
        ));
    }

    public function contentSectionPg($content_id)
    {
        $bookmark = "";
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $bookmark = "(SELECT COUNT(id) FROM student_content_mapping WHERE user_id=$user_id AND content_id=c.id) as bookmark,";
        };
        $content_type = DB::select("SELECT * FROM content WHERE id=$content_id");
        // dd($content_type[0]->scope_type);
        if($content_type[0]->scope_type=='course') {

            $content = DB::select("SELECT c.content_privacy , c.content_type ,c.status, c.scope_type , c.authors as authors, c.difficulty_level_id , c.id, c.title,c.authors,c.affiliation,c.title, c.description, c.tags, c.duration, c.created_at, c.views_count, c.user_id, c.section_count, c.category_ids, $bookmark
            (SELECT name FROM users WHERE id=c.user_id) as author,
            (SELECT id FROM users WHERE id=c.user_id) as user_id,
            (SELECT profile_pic_url FROM profiles WHERE user_id=c.user_id) as author_profile_pic_url,
            (SELECT r.name FROM users u JOIN roles r ON u.role_id=r.id WHERE u.id=c.user_id) as author_role,
            (SELECT name FROM difficulty_level WHERE id=c.difficulty_level_id) as difficulty_level,
            (SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, c.category_ids)) as categories
            FROM content c WHERE c.id=$content_id AND (c.status=1 OR c.status=0 OR c.status=2)");



            // if (!count($content)) {
            //     return redirect()->back();
            // }

            $content = $content[0];

            if (Auth::check()) {
                if ($user_id != $content->user_id) {
                    $views_count = ($content->views_count + 1);
                    DB::update('UPDATE content set views_count = ? WHERE id = ?', [$views_count, $content_id]);
                }
            } else {
                $views_count = ($content->views_count + 1);
                DB::update('UPDATE content set views_count = ? WHERE id = ?', [$views_count, $content_id]);
            }

            // $content_details = DB::select("SELECT * FROM content_details WHERE content_id=$content_id");
            $courseC = DB::Table("course_content_detail")->where('course_id',$content_id);

            $difficulty_levels = DB::select("SELECT * FROM difficulty_level");
            $allTags = DB::select("SELECT * FROM tags");

            $courseCount = $courseC->get()->count();

            if (Auth::check()) {
            $playLists =  PlayLists::where('user_id',\Auth::user()->id)->get();

                $course_data = DB::select("SELECT * FROM content WHERE user_id = $user_id AND scope_type='course' AND status=2 AND archive=0");

                }
            $playLists2 = DB::select("SELECT course_content_detail.*,c.image_url, c.content_privacy , c.content_type , c.scope_type , c.authors as authors, c.difficulty_level_id , c.id, c.title,c.authors,c.affiliation,c.title,
            c.description, c.tags, c.created_at, c.views_count, c.user_id, c.section_count, c.category_ids,difficulty_level.name as difficulty_level

             FROM course_content_detail
             LEFT JOIN content c ON course_content_detail.content_id=c.id
             join difficulty_level on c.difficulty_level_id = difficulty_level.id

              WHERE course_content_detail.course_id=$content_id");

            $content_details = DB::select("SELECT course_content_detail.user_id,course_content_detail.course_id,course_content_detail.content_id,course_content_detail.id as mainID,c.id, c.content_privacy , c.content_type , c.scope_type , c.authors AS AUTHORS, c.difficulty_level_id , c.title,c.authors,c.affiliation,c.title,
            c.description, c.tags, c.created_at, c.views_count, c.section_count, c.category_ids, cd.type,cd.asset,cd.section,cd.type,cd.steps,cd.embeded_url,cd.description

             FROM course_content_detail
             JOIN content c ON course_content_detail.content_id=c.id
             JOIN content_details cd ON cd.content_id=c.id

              WHERE course_content_detail.course_id=$content_id");

            return view('student.approvedCourse', compact(
                'content',
                'content_details',
                'difficulty_levels',
                'allTags',
                'courseCount',
                'playLists',
                'course_data',
                'playLists2'
            ));

        }
    else{



        $archive = 0;
        $content = DB::select("SELECT c.scope_type , c.authors  as authors, c.content_privacy , c.difficulty_level_id , c.content_type , c.status, c.category_ids, c.id, c.title, c.authors, c.affiliation, c.description, c.tags, c.duration, c.created_at, c.views_count, c.user_id, c.section_count, c.category_ids, $bookmark
        (SELECT name FROM users WHERE id=c.user_id) as author,
        (SELECT profile_pic_url FROM profiles WHERE user_id=c.user_id) as author_profile_pic_url,
        (SELECT r.name FROM users u JOIN roles r ON u.role_id=r.id WHERE u.id=c.user_id) as author_role,
        (SELECT name FROM difficulty_level WHERE id=c.difficulty_level_id) as difficulty_level,
        (SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, c.category_ids)) as categories
        FROM content c WHERE c.id=$content_id AND c.status=1 AND c.archive=0");

        if (!count($content)) {
            return redirect()->back();
        }

        $content = $content[0];

        if (Auth::check()) {
            if ($user_id != $content->user_id) {
                $views_count = ($content->views_count + 1);
                DB::update('UPDATE content set views_count = ? WHERE id = ?', [$views_count, $content_id]);
            }
        } else {
            $views_count = ($content->views_count + 1);
            DB::update('UPDATE content set views_count = ? WHERE id = ?', [$views_count, $content_id]);
        }

        $difficulty_levels = DB::select("SELECT * FROM difficulty_level");
        $allTags = DB::select("SELECT * FROM tags");

        $content_details = DB::select("SELECT * FROM content_details WHERE content_id=$content_id");

        $courseC = DB::Table("content_details")->where('content_id',$content_id);
        $courseCount = $courseC->get()->count();


        $playLists = isset(\Auth::user()->id) ?  PlayLists::where('user_id',\Auth::user()->id)->get() : [];

        if (Auth::check()) {
        $course_data = DB::select("SELECT * FROM content WHERE user_id = $user_id AND scope_type='course' AND archive = $archive AND status=2");
        }



    return view('student.contentSection', compact(
        'content',
        'content_details',
        'difficulty_levels',
        'allTags',
        'courseCount',
        'playLists',
        'course_data'
    ));
    }



    }

    public function contact_us(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullName' => ['required'],
            'email' => ['required', 'string', 'email', 'max:50'],
            'subject' => ['required', 'string', 'max:50'],
            'message' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();

        try {
            DB::insert("INSERT INTO contact_us (name, email, subject, message) VALUES (?, ?, ?, ?)", [$request['fullName'], $request['email'], $request['subject'], $request['message']]);

            Mail::to("ineted@ineteconomics.org")->send(new ContactEmail($request->all()));
           // Mail::to("muddasirkhan23@gmail.com")->send(new ContactEmail("Email sent"));

            return redirect()->back()->with("success", "Submitted successfully! We will contact you soon");
        } catch (QueryException $ex) {
            return redirect()->back()->with("failed", $ex->getMessage());
        }
    }


    public function discussions(Request $request)
    {
        $condition = "";

        if (Auth::check()) {

            if (!Auth::user()->activate && Auth::user()->role_id == 3) {
                return view('contributor.approve');
            }

            $user_id = Auth::user()->id;
        }

        if ($request->has('tag') && $request->input('tag') != "All") {
            $tag = $request->input('tag');
            $condition = "AND tags LIKE '%$tag%'";
        }

        if ($request->has('main') && $request->input('main') == "YourQuestions" && Auth::check()) {
            $condition .= "AND discussion.user_id = $user_id";
        }

        if ($request->has('main') && $request->input('main') == "YourAnswers" && Auth::check()) {
            $condition .= "AND discussion.id IN (SELECT discussion_id FROM discussion_response WHERE user_id=$user_id)";
        }

        if ($request->has('main') && $request->input('main') == "TopViews") {
            $condition .= " ORDER BY discussion.views_count DESC";
        } else {
            $condition .= " ORDER BY discussion.created_at DESC";
        }

        $per_page = 10;

        $newest_offset = 0;
        $active_offset = 0;
        $featured_offset = 0;
        $unanswered_offset = 0;


        if ($request->has('newest_page')) {
            $newest_offset = ($request->input('newest_page') - 1) * $per_page;
        }

        if ($request->has('active_page')) {
            $active_offset = ($request->input('active_page') - 1) * $per_page;
        }

        if ($request->has('featured_page')) {
            $featured_offset = ($request->input('featured_page') - 1) * $per_page;
        }

        if ($request->has('unanswered_page')) {
            $unanswered_offset = ($request->input('unanswered_page') - 1) * $per_page;
        }


        $newest_total_discussions = DB::select("SELECT COUNT(*) AS total FROM discussion WHERE DATE(created_at) >= subdate(curdate(), 1) $condition");
        $newest_total_discussions = $newest_total_discussions[0]->total;
        $newest_discussions_pages_count = $newest_total_discussions / $per_page;

        $active_total_discussions = DB::select("SELECT COUNT(*) AS total FROM discussion WHERE discussion.status=1 $condition");
        $active_total_discussions = $active_total_discussions[0]->total;
        $active_discussions_pages_count = $active_total_discussions / $per_page;

        $featured_total_discussions = DB::select("SELECT COUNT(*) AS total FROM discussion WHERE discussion.featured=1 $condition");
        $featured_total_discussions = $featured_total_discussions[0]->total;
        $featured_discussions_pages_count = $featured_total_discussions / $per_page;

        $unanswered_total_discussions = DB::select("SELECT COUNT(*) AS total FROM discussion WHERE discussion.answered!=1 $condition");
        $unanswered_total_discussions = $unanswered_total_discussions[0]->total;
        $unanswered_discussions_pages_count = $unanswered_total_discussions / $per_page;


        $newest_discussions = DB::select("SELECT discussion.*, users.name, roles.name as role, profiles.profile_pic_url FROM discussion
        LEFT JOIN users ON discussion.user_id=users.id JOIN roles ON users.role_id=roles.id JOIN profiles ON users.id=profiles.user_id
        WHERE DATE(discussion.created_at) >= subdate(curdate(), 1) $condition
        LIMIT 10 OFFSET $newest_offset");

        $active_discussions = DB::select("SELECT discussion.*, users.name, roles.name as role, profiles.profile_pic_url FROM discussion
        LEFT JOIN users ON discussion.user_id=users.id JOIN roles ON users.role_id=roles.id JOIN profiles ON users.id=profiles.user_id
        WHERE discussion.status=1 $condition
        LIMIT 10 OFFSET $active_offset ");

        $featured_discussions = DB::select("SELECT discussion.*, users.name, roles.name as role, profiles.profile_pic_url FROM discussion
        LEFT JOIN users ON discussion.user_id=users.id JOIN roles ON users.role_id=roles.id JOIN profiles ON users.id=profiles.user_id
        WHERE discussion.featured=1 $condition
        LIMIT 10 OFFSET $featured_offset");

        $unanswered_discussions = DB::select("SELECT discussion.*, users.name, roles.name as role, profiles.profile_pic_url FROM discussion
        LEFT JOIN users ON discussion.user_id=users.id JOIN roles ON users.role_id=roles.id JOIN profiles ON users.id=profiles.user_id
        WHERE discussion.answered!=1 $condition
        LIMIT 10 OFFSET $unanswered_offset");

        $discussion_tags = DB::select("SELECT * FROM tags");
        $discustxt = DB::select("SELECT *  FROM discussion_text");

        return view('discussionBoard.discussionBoardPanel', compact(
            'newest_discussions',
            'newest_discussions_pages_count',

            'active_discussions',
            'active_discussions_pages_count',

            'featured_discussions',
            'featured_discussions_pages_count',

            'unanswered_discussions',
            'unanswered_discussions_pages_count',


            'discussion_tags',
            'discustxt'
        ));
    }

    public function discussion_show(Request $request, $discussion_id)
    {
        if (Auth::check() && !Auth::user()->activate && Auth::user()->role_id == 3) {
            return view('contributor.approve');
        }

        $discussion = DB::select("SELECT discussion.*, users.name, roles.name as role, profiles.profile_pic_url
        FROM discussion LEFT JOIN users ON discussion.user_id=users.id
        JOIN roles ON users.role_id=roles.id JOIN profiles ON users.id=profiles.user_id WHERE discussion.id = ?", [$discussion_id]);

        $discussion_tags = DB::select("SELECT * FROM tags");

        $discussion_responses = DB::select("SELECT discussion_response.*, users.name, roles.name as role, profiles.profile_pic_url
        FROM discussion_response LEFT JOIN users ON discussion_response.user_id=users.id
        JOIN roles ON users.role_id=roles.id JOIN profiles ON users.id=profiles.user_id WHERE discussion_response.discussion_id= ?", [$discussion_id]);

        if (Auth::check() && $discussion[0]->user_id != Auth::user()->id) {
            $views_count = $discussion[0]->views_count + 1;
            DB::update('UPDATE discussion SET views_count = ? where id = ?', [$views_count, $discussion_id]);
        }

        $discussion = $discussion[0];

        return view('discussionBoard.discussion_show', compact('discussion', 'discussion_tags', 'discussion_responses'));
    }

    public function contentById(Request $request)
    {
        return $data = DB::table('content_details')->where('id',$request->contentId)->get();
    }

    public function contentUploadEdit(Request $request)
    {

        $content_id = $request['content_id'];
        $current_section = (!$request['current_section'] || $request['current_section'] == '0') ? 1 : $request['current_section'];
        $title = $request['title'];
        $description = $request['description'];
        $duration = $request['duration'];
        $type = $request['type'];
        $asset = $request['asset'];
        $embeded_url = $request['embeded_url'];

        switch ($type) {
            case 'Video':
                $content_path = "uploads/content/videos";

                $validator = Validator::make($request->all(), ['asset' => ['required', 'mimes:mp4,flv,m3u8,ts,3gp,mov,avi,wmv', 'max:150000']]);

                if ($validator->fails() && !$embeded_url) return response()->json([
                    'success' => false,
                    'message' => "Invalid video type!"
                ]);

                break;
            case 'Pdf':
                $content_path = "uploads/content/pdf";

                $validator = Validator::make($request->all(), ['asset' => ['required', 'mimes:pdf', 'max:10000']]);

                if ($validator->fails()) return response()->json([
                    'success' => false,
                    'message' => "Invalid pdf type!"
                ]);

                break;
            case 'Image':
                $content_path = "uploads/content/images";

                $validator = Validator::make($request->all(), ['asset' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:10000']]);

                if ($validator->fails()) return response()->json([
                    'success' => false,
                    'message' => "Invalid image type!"
                ]);

                break;
            case 'Audio':
                $content_path = "uploads/content/audios";

                $validator = Validator::make($request->all(), ['asset' => ['required', 'mimes:audio/mpeg,mpga,mp3,wav', 'max:150000']]);

                if ($validator->fails()) return response()->json([
                    'success' => false,
                    'message' => "Invalid audio type!"
                ]);

                break;

            default:
                $content_path = "";
                break;
        }

        $inputs = [];
        $inputs['title']       = $title;
        $inputs['description'] = $description;
        $inputs['type']        = $type;
        $inputs['duration']    = $duration;
        $inputs['section']     = $current_section;
        $inputs['created_at']  = now();
        $inputs['updated_at']  = now();


        if ($asset) {

            $fileName = time() . '.' . $asset->extension();
            $asset->move(public_path($content_path), $fileName);
            $inputs['asset'] = $fileName;

        } else {

            $youtube_embed_url = null;

            if ($embeded_url) {
                $urlParts   = explode('/', $embeded_url);
                $vidid      = explode( '&', str_replace('watch?v=', '', end($urlParts) ) );
                $youtube_embed_url =  'https://www.youtube.com/embed/' . $vidid[0] ;
                $inputs['embeded_url'] = $youtube_embed_url;
            }
        }



        try {

            $update = DB::table('content_details')->where('id',$request->content__detail_id)->update($inputs);
            return response()->json([
                'success' => true,
                'message' => 'Content updated successfully!'
            ]);

        } catch (QueryException $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ]);
        }


    }

    public function contentUploadDelete(Request $request)
    {
        $content_id = $request['contentId'];
        $delete = DB::table('content_details')->where('id',$content_id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Content Deleted successfully!'
        ]);
    }


    public function mainContentUpdate(Request $request)
    {
        $inputs = [];
        $res    = [];

        $user_id       = Auth::user()->id;
        $content_image = $request['content_image'];
        $category_ids  = $request['categories'];
        $category_ids  = "," . implode(',', $request['categories']) . ",";


        //$status_content   = 0;
         $archive1         = 0;
       
        $content_privacy1 = $request->input('privacy_content_01');

        $chk_id= $request['content_id'];
        $check_status = DB::select("SELECT * FROM content WHERE id =  $chk_id AND scope_type='course' ");
        if($check_status[0]->status == 2 || $check_status[0]->status == 1 ){
            $status         = 2;
        }
        else{
            $status         = 0;
        }
        // array for insert eloquent
        $inputs['title']       = $request['content_title'];
        $inputs['description'] = $request['content_discription'];
        $inputs['tags']        = json_encode($request['tags'] ,true);
        $inputs['category_ids']         = $category_ids;
        $inputs['affiliation']          = $request['affiliation'];
        $inputs['duration']             = $request['duration'];
        $inputs['difficulty_level_id']  = $request['difficulty_level_c'];
        $inputs['updated_at']           = now();
       // $inputs['image_url']            = 'placeholder.png';
        $inputs['user_id']              = $user_id;
        $inputs['content_privacy']      = $request->input('privacy_content_01');
        $inputs['archive']              = $archive1;
        $inputs['status']              =  $status;
        $inputs['authors']              = $request['author'];
        $inputs['affiliation']          = $request['institution_or_source'];
        $inputs['scope_type']           = 'course';

        if (Auth::user()->role_id == 1) {
            $status_content = 1;
        }

       // $inputs['status'] = $status_content;
        // CHECK INPUT TYPE IMAGE UDPATE IMAGE ARRAY
        if ($content_image!= null) {

            $fileName = time() . '.' . $content_image->extension();
            $content_image->move(public_path('uploads/content/profile_images'), $fileName);
            $inputs['image_url']            = $fileName;

            // json res
            $res['success']  = true;
            $res['course' ]  = false;
            $res['message']  = "Course updated successfully!";

        }else{
            // json res
            $image_old = DB::table('content')->select('image_url')->where('id', $chk_id)->value('image_url');
            $inputs['image_url']= $image_old; 
            $res['success']  = true;
            $res['message']  = "Course updated successfully!";
        }

         try {

                $update             = DB::table('content')->where('id',$request['content_id'])->update($inputs);
                return response()->json($res);

        } catch (QueryException $ex) {
                return response()->json([
                    'success' => false,
                    'message' => $ex->getMessage()
                ]);
        }
    }

    public function mainContentDelete(Request $request)
    {
         // $content_id   = $request['contentId'];
        $archive1         = 1;
        $inputs['archive'] = $archive1;
        $inputs['updated_at']  = now();
        $update             = DB::table('content')->where('id',$request['contentId'])->update($inputs);
        // $delete       = DB::table('content')->where('id',$content_id)->delete();
        // $deleteDetail = DB::table('content_details')->where('content_id',$content_id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Content Deleted successfully!'
        ]);
    }


    public function contentEditWithDetail(Request $request)
    {
        $status_content     = 0;
        $content_image      = $request['content_image_thumb'];
        $contentInput       = [];
        $contentDetailInput = [];
        $user_id = Auth::user()->id;

        $contentInput['title']               = $request->content_title;
        $contentInput['description']         = $request->content_discription2;
        $contentInput['tags']                = json_encode($request->tags,true);
        $contentInput['category_ids']        = "," . implode(',', $request->categories) . ",";
        $contentInput['affiliation']         = $request->affiliation;
        $contentInput['difficulty_level_id'] = $request->difficulty_level;
        $contentInput['updated_at']          = now();
        $contentInput['user_id']             = $user_id;
        $contentInput['content_privacy']     = $request->privacy_content;
        $contentInput['authors']             = $request->author;
        $contentInput['content_type']        = [$request['type']];
        // check then update status value
        if (Auth::user()->role_id == 1) {
            $status_content = 1;
        }

        $contentInput['status'] = $status_content;

        if ($content_image) {
            $request->validate([
                'content_image_thumb' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            ]);

            $fileName = time() . '.' . $content_image->extension();
            $content_image->move(public_path('uploads/content/profile_images'), $fileName);
            $contentInput['image_url']           = $fileName;

        }


        $description = $request['description'];
        $type        = $request['type'];
        $asset       = $request['asset'];
        $embeded_url = $request['embeded_url'];

        switch ($type) {
            case 'Video':
                $content_path = "uploads/content/videos";

                $validator = Validator::make($request->all(), ['asset' => ['required', 'mimes:mp4,flv,m3u8,ts,3gp,mov,avi,wmv', 'max:150000']]);

                if ($validator->fails() && !$embeded_url) return response()->json([
                    'success' => false,
                    'message' => "Invalid video type!"
                ]);

                break;
            case 'Pdf':
               if( $asset == null){
                    $detail_id=$request->content_detail_id;
                     $asset_old = DB::table('content_details')->select('asset')->where('id', $detail_id)->value('asset');
                    $contentDetailInput['asset'] = $asset_old; 
                break;
                }else{
                $content_path = "uploads/content/pdf";

                $validator = Validator::make($request->all(), ['asset' => ['required', 'mimes:pdf', 'max:10000']]);

                if ($validator->fails()) return response()->json([
                    'success' => false,
                    'message' => "Invalid pdf type!"
                ]);

                break;
              }
            case 'Image':
               if( $asset == null){
                    $detail_id=$request->content_detail_id;
                     $asset_old = DB::table('content_details')->select('asset')->where('id', $detail_id)->value('asset');
                    $contentDetailInput['asset'] = $asset_old; 
                break;
                }else{

                $content_path = "uploads/content/images";

                $validator = Validator::make($request->all(), ['asset' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:10000']]);

                if ($validator->fails()) return response()->json([
                    'success' => false,
                    'message' => "Invalid image type!"
                ]);

                break;
              }
            case 'Audio':
               if( $asset == null){
                    $detail_id=$request->content_detail_id;
                     $asset_old = DB::table('content_details')->select('asset')->where('id', $detail_id)->value('asset');
                    $contentDetailInput['asset'] = $asset_old; 
                break;
                }else{

                $content_path = "uploads/content/audios";

                $validator = Validator::make($request->all(), ['asset' => ['required', 'mimes:audio/mpeg,mpga,mp3,wav', 'max:150000']]);

                if ($validator->fails()) return response()->json([
                    'success' => false,
                    'message' => "Invalid audio type!"
                ]);

                break;
              } 

            default:
                $content_path = "";
                break;
        }

        $contentDetailInput['description'] = $description;
        $contentDetailInput['type']        = $type;
        if($contentDetailInput['type']  =="Video"){
            $contentDetailInput['asset'] = null ;
        }

        if ($asset) {

            $fileName = time() . '.' . $asset->extension();
            $asset->move(public_path($content_path), $fileName);
            $contentDetailInput['asset'] = $fileName;

        } else {

            $youtube_embed_url = null;

            if ($embeded_url) {
                $urlParts   = explode('/', $embeded_url);
                $vidid      = explode( '&', str_replace('watch?v=', '', end($urlParts) ) );
                $youtube_embed_url =  'https://www.youtube.com/embed/' . $vidid[0] ;
                $contentDetailInput['embeded_url'] = $youtube_embed_url;
            }

        }


        try {

            $updateContent        = DB::table('content')->where('id',$request->content_id)->update($contentInput);
            $updateContentDetail  = DB::table('content_details')->where('id',$request->content_detail_id)->update($contentDetailInput);
            return response()->json([
                'success' => true,
                'course'  => true,
                'message' => "Content Updated successfully!"
            ]);
        } catch (QueryException $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ]);
        }
    }
}
