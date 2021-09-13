<?php

namespace App\Http\Controllers;

use App\ADashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\PlayLists;

class AdminDashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $updateddate = date('Y-m-d H:i:s');
        $content_id = $request->input('contentid');
        $comment = $request->input('FormControlTextarea1');

        $comment = DB::table('admin_comment')->insert(
            ['content_id' => $content_id, 'comment' => $comment, 'admin_id' => $user_id, 'created_at' => $updateddate, 'updated_at' => $updateddate]
        );

        return $comment;


    }

    public function tagadmin(Request $request)
    {
        $user_id = Auth::user()->id;
        $updateddate = date('Y-m-d H:i:s');
        $content_id = $request->input('contentid3');
        $other_admin_id =  $request->input('customRadio');
        $comment = $request->input('FormControlTextarea1');

        $addtag = DB::table('admin_tag_admin')->insert(
            ['admin_id' => $user_id, 'other_admin_id' => $other_admin_id, 'created_at' => $updateddate, 'updated_at' => $updateddate,  'content_id' => $content_id,]
        );

        return $addtag;
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\ADashboard  $aDashboard
     * @return \Illuminate\Http\Response
     */
    public function show(ADashboard $aDashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ADashboard  $aDashboard
     * @return \Illuminate\Http\Response
     */
    public function edit(ADashboard $aDashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ADashboard  $aDashboard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
          $user_id = Auth::user()->id;
          $id = $request->input('contentid2');

          $contentaprroved = DB::table('content')
          ->where('id', $id)
          ->update(['status' => 1]);


          return $contentaprroved;

    }


    ////////////////////archivecontent/////////////////////////

    public function updatearchive(Request $request, $id)
    {
          $user_id = Auth::user()->id;
          $id = $request->input('contentarchive_id');

          $contentarchive = DB::table('content')
          ->where('id', $id)
          ->update(['archive' => 1]);

         if($contentarchive)
         {
          return "success";
         }
        else{
            return "error";
          }

    }

    /////Contributor approve
    public function updatecontributor(Request $request, $id)
    {

          $id = $request->input('contri_id');
          $contentaprroved = DB::table('users')
          ->where('id', $id)
          ->update(['activate' => 1]);


          return $contentaprroved;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ADashboard  $aDashboard
     * @return \Illuminate\Http\Response
     */
    public function destroy(ADashboard $aDashboard)
    {
        //
    }

    public function showContent() {


      $contentRecive =  DB::select("SELECT content.id, content.affiliation ,content.authors,
            content.title,	content.image_url, difficulty_level.name as difficulty_level, content.created_at,
            content.status,content.duration, users.name
            FROM inet_stage.content
             left join inet_stage.users   on content.user_id = users.id
             join inet_stage.difficulty_level
             on content.difficulty_level_id = difficulty_level.id
             where content.status=0 AND content.archive=0 order by content.title");

     return json_encode($contentRecive);
  }

  public function historyContent() {


   $historycontent =  DB::select("SELECT content.id,content.affiliation ,content.authors,
         content.title,	content.image_url, difficulty_level.name as difficulty_level, content.created_at,
         content.status,content.duration, users.name
         FROM inet_stage.content
          left join inet_stage.users   on content.user_id = users.id
          join inet_stage.difficulty_level
          on content.difficulty_level_id = difficulty_level.id
          where content.status=1 AND content.archive=0");

    return json_encode($historycontent);
    }



 public function underreview() {

        $underreview = DB::select("SELECT fu.name AS admin, GROUP_CONCAT(tu.name) AS tagged,tag.content_id, content.id,content.title,content.authors,content.affiliation,content.image_url,content.created_at,content.duration,
        content.status,difficulty_level.name as difficulty_level, inet_stage.users.name  FROM inet_stage.admin_tag_admin tag
        INNER JOIN inet_stage.users fu  ON fu.id = tag.admin_id
        INNER JOIN inet_stage.users tu  ON tu.id = tag.other_admin_id
        INNER JOIN inet_stage.content   ON tag.content_id = inet_stage.content.id
        INNER JOIN inet_stage.difficulty_level on content.difficulty_level_id = difficulty_level.id
        INNER JOIN inet_stage.users on content.user_id = inet_stage.users.id
        where content.status=0 AND content.archive=0 group by content.id");
        return json_encode($underreview);
 }



public function listofcontributors(){
    $list_of_contributors = DB::select("SELECT inet_stage.users.id, inet_stage.users.name, inet_stage.profiles.profile_pic_url, inet_stage.roles.name as role
    FROM inet_stage.users
        INNER JOIN  inet_stage.profiles
        on inet_stage.users.id=inet_stage.profiles.user_id
        INNER JOIN inet_stage.roles
        on inet_stage.users.role_id= inet_stage.roles.id
        where roles.id=3 AND activate=0");
    return json_encode($list_of_contributors);
}



    public function singlecontent($content_id)
    {
        $content = DB::select("SELECT content.id, content.title, content.authors, content.affiliation, content.image_url, difficulty_level.name as difficulty_level, content.created_at,
        content.status,content.duration, users.name FROM inet_stage.content left join inet_stage.users on content.user_id = users.id join inet_stage.difficulty_level
        on content.difficulty_level_id = difficulty_level.id  where content.id=$content_id AND content.archive=0");
        return json_encode($content);
    }





    public function viewprofiles($id){


      $profile_data = DB::select("SELECT
                inet_stage.users.id,
                inet_stage.users.name,
                inet_stage.users.email,
                inet_stage.profiles.profile_pic_url,
                inet_stage.profiles.about_me,
                inet_stage.profiles.twitter_url,
                inet_stage.profiles.youtube_url,
                inet_stage.profiles.web_url,
                inet_stage.profiles.about_me,
                inet_stage.roles.name as role
            FROM
                inet_stage.users
                INNER JOIN  inet_stage.profiles
                on inet_stage.users.id=inet_stage.profiles.user_id
                INNER JOIN inet_stage.roles
                on inet_stage.users.role_id= inet_stage.roles.id
                where (roles.id=3 OR roles.id=2 OR roles.id=1)  AND inet_stage.users.id=$id");

            return json_encode($profile_data);
}


    public function viewsingleprofile($id) {
        $profile_data = DB::select("SELECT
               inet_stage.users.id,
               inet_stage.users.name,
               inet_stage.users.email,
               inet_stage.profiles.profile_pic_url,
               inet_stage.profiles.about_me,
               inet_stage.profiles.twitter_url,
               inet_stage.profiles.youtube_url,
               inet_stage.profiles.web_url,
               inet_stage.profiles.about_me,
               inet_stage.roles.name as role

              FROM inet_stage.users
                  INNER JOIN  inet_stage.profiles
                  on inet_stage.users.id=inet_stage.profiles.user_id
                  INNER JOIN inet_stage.roles
                  on inet_stage.users.role_id= inet_stage.roles.id
                  where(roles.id=3 OR roles.id=2 OR roles.id=1) AND inet_stage.users.id=$id");

        $contributions = DB::select("SELECT content.id,content.title,	content.image_url, difficulty_level.name as difficulty_level, content.created_at,
content.status,content.duration, users.name FROM inet_stage.content left join inet_stage.users   on content.user_id = users.id join inet_stage.difficulty_level on content.difficulty_level_id = difficulty_level.id where content.status=1 AND content.archive=0 AND user_id=$id");
          return view('admin.viewcontributorprofile', compact('profile_data', 'contributions'));


   }



    public function viewBookmarksofcontributors(){
      $user_id = Auth::user()->id;
      $contributormarks = DB::select("SELECT c.*,content_details.type AS formatType,
                (SELECT name FROM users WHERE id=c.user_id) as author,
                (SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, c.category_ids)) as categories,
                (SELECT name FROM difficulty_level WHERE id=c.difficulty_level_id) as difficulty_level
                FROM student_content_mapping scm 
               JOIN content c ON c.id=scm.content_id 
                LEFT JOIN content_details ON content_details.content_id=c.id
WHERE scm.user_id=$user_id AND c.status=1 AND c.archive=0 ORDER BY c.created_at DESC");

         return json_encode($contributormarks);

    }
    public function bookmarkSorting(Request $request){

        $sort = $request['sort'];
        $role_id = Auth::user()->role_id;
        $user_id = Auth::user()->id;
    
        if ($sort) {
            switch ($sort) {
                case 'new':
                    $sort = "ORDER BY c.created_at DESC";
                    break;
                case 'popular':
                    $sort = "ORDER BY c.views_count DESC";
                    break;
                case 'alpha':
                    $sort = "ORDER BY c.title ASC";
                    break;

                default:
                    $sort = "ORDER BY c.views_count DESC";
                    break;
            }
        }


        $contributormarks = DB::select("SELECT c.*, (SELECT name FROM users WHERE id=c.user_id) as author,content_details.type AS formatType,
        (SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, c.category_ids)) as categories,
        (SELECT name FROM difficulty_level WHERE id=c.difficulty_level_id) as difficulty_level
        FROM student_content_mapping scm JOIN content c ON c.id=scm.content_id 
     LEFT JOIN content_details ON content_details.content_id=c.id

WHERE scm.user_id=$user_id AND c.status=1 AND c.archive=0 $sort");

        

        return response()->json([
            'success' => true,
            'content' => $contributormarks
        ]);
    }
    public function contributorshistory(){

        $user_id = Auth::user()->id;

        $contributorhistroy = DB::select("SELECT content.id, content.title,content.authors,content.content_privacy,content.affiliation,content.duration,
        content.image_url, difficulty_level.name as difficulty_level, content.created_at,users.name, content.downloaded_count, content.views_count ,content.content_group,content_details.type AS formatType
        FROM inet_stage.content  left join inet_stage.users   on content.user_id = users.id
         LEFT JOIN inet_stage.content_details ON content_details.content_id=content.id 
 join inet_stage.difficulty_level on content.difficulty_level_id = difficulty_level.id
         where content.status=1 AND content.user_id=$user_id AND content.archive=0 ORDER BY content.created_at DESC");

        return json_encode($contributorhistroy);

    }
    public function historySorting(Request $request){

        $sort = $request['sort'];
        $role_id = Auth::user()->role_id;
        $user_id = Auth::user()->id;
    
        if ($sort) {
            switch ($sort) {
                case 'new':
                    $sort = "ORDER BY content.created_at DESC";
                    break;
                case 'popular':
                    $sort = "ORDER BY content.views_count DESC";
                    break;
                case 'alpha':
                    $sort = "ORDER BY content.title ASC";
                    break;

                default:
                    $sort = "ORDER BY content.views_count DESC";
                    break;
            }
        }


        $contributorhis =  DB::select("SELECT content.id, content.title,content.authors,content.content_privacy,content.affiliation,content.duration,
        content.image_url, difficulty_level.name as difficulty_level, content.created_at,users.name, content.downloaded_count, content.views_count, content.content_group,content_details.type AS formatType
        FROM inet_stage.content 
          join inet_stage.difficulty_level on content.difficulty_level_id = difficulty_level.id
          left join inet_stage.users on content.user_id = users.id
           left join inet_stage.content_details on content_details.content_id=content.id 

         

         where content.status=1 AND content.user_id=$user_id AND content.archive=0 $sort");

        

        return response()->json([
            'success' => true,
            'content' => $contributorhis
        ]);
    }
    public function commentshistory(){

        $user_id = Auth::user()->id;

        $contributorhistroy = DB::select(" SELECT content.id, content.title,content.authors,content.content_privacy,content.affiliation, content.image_url,content.duration, difficulty_level.name as difficulty_level, content.created_at,users.name, content.downloaded_count, content.views_count, content.status,content.content_group,content_details.type AS formatType,

        (SELECT GROUP_CONCAT(comment separator ',') FROM admin_comment WHERE content_id=content.id) AS comment
        FROM inet_stage.content 
       JOIN inet_stage.difficulty_level ON content.difficulty_level_id = difficulty_level.id
       LEFT JOIN inet_stage.users ON content.user_id=users.id
       LEFT JOIN inet_stage.content_details ON content_details.content_id=content.id 

        WHERE (content.status=1 OR content.status=0) AND content.user_id=$user_id AND content.archive=0");

        return json_encode($contributorhistroy);

    }

    public function admincomments(){

        $admincomments = DB::select("SELECT content.id, content.title,content.authors,content.content_privacy,content.affiliation, content.image_url,content.duration, difficulty_level.name as difficulty_level, content.created_at,users.name, content.downloaded_count, content.views_count, content.status,
        (SELECT GROUP_CONCAT(comment separator ',') FROM admin_comment WHERE content_id=content.id) AS comment
        FROM inet_stage.content LEFT JOIN inet_stage.users ON content.user_id=users.id JOIN inet_stage.difficulty_level ON content.difficulty_level_id = difficulty_level.id where content.archive=0");
        return json_encode($admincomments);

    }



    public function contentSectionPg($content_id)
    {
        $bookmark = "";
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $bookmark = "(SELECT COUNT(id) FROM student_content_mapping WHERE user_id=$user_id AND content_id=c.id) as bookmark,";
        };

        // $content = DB::select("SELECT c.id, c.title, c.description, c.tags, c.duration, c.created_at, c.views_count, c.user_id, c.section_count, $bookmark
        // (SELECT name FROM users WHERE id=c.user_id) as author,
        // (SELECT profile_pic_url FROM profiles WHERE user_id=c.user_id) as author_profile_pic_url,
        // (SELECT r.name FROM users u JOIN roles r ON u.role_id=r.id WHERE u.id=c.user_id) as author_role,
        // (SELECT name FROM difficulty_level WHERE id=c.difficulty_level_id) as difficulty_level,
        // (SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, c.category_ids)) as categories
        // FROM content c WHERE c.id=$content_id AND (c.status=1 OR c.status=0)");
        $content_type = DB::select("SELECT * FROM content WHERE id=$content_id");
        if($content_type[0]->scope_type=='course'){

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
                $course_data = DB::select("SELECT * FROM content WHERE user_id = $user_id AND scope_type='course' AND archive=0 AND status=2");
        
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
        
              WHERE course_content_detail.course_id=$content_id ORDER BY course_content_detail.content_order ASC");
        
            return view('student.approvedCourse', compact(
                'content',
                'content_details',
                'difficulty_levels',
                'allTags',
                'courseCount',
                'playLists',
                'course_data'
            ));
        
        }
        else{

        $content = DB::select("SELECT c.content_privacy , c.content_type , c.status, c.scope_type , c.authors as authors, c.difficulty_level_id , c.id, c.title,c.authors,c.affiliation,c.title, c.description, c.tags, c.duration, c.created_at, c.views_count, c.user_id, c.section_count, c.category_ids, $bookmark
        (SELECT name FROM users WHERE id=c.user_id) as author,
        (SELECT id FROM users WHERE id=c.user_id) as user_id,
        (SELECT profile_pic_url FROM profiles WHERE user_id=c.user_id) as author_profile_pic_url,
        (SELECT r.name FROM users u JOIN roles r ON u.role_id=r.id WHERE u.id=c.user_id) as author_role,
        (SELECT name FROM difficulty_level WHERE id=c.difficulty_level_id) as difficulty_level,
        (SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, c.category_ids)) as categories
        FROM content c WHERE c.id=$content_id AND (c.status=1 OR c.status=0)");



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

        $content_details = DB::select("SELECT * FROM content_details WHERE content_id=$content_id");
        $courseC = DB::Table("content_details")->where('content_id',$content_id);

        $difficulty_levels = DB::select("SELECT * FROM difficulty_level");
        $allTags = DB::select("SELECT * FROM tags");

        $courseCount = $courseC->get()->count();
        if (Auth::check()) {
        $playLists =  PlayLists::where('user_id',\Auth::user()->id)->get();
        $course_data = DB::select("SELECT * FROM content WHERE user_id =  $user_id AND scope_type='course' AND archive=0 AND status=2" );

        }
        // return view('student.contentSection', compact(
            // 'content',
            // 'content_details',
            // 'difficulty_levels',
            // 'allTags',
            // 'courseCount',
            // 'playLists'
        // ));
     

// if(empty($course_data)){
//     $course_data= "no course found";
//     return view('student.contentSection', compact(
//         'content',
//         'content_details',
//         'difficulty_levels',
//         'allTags',
//         'courseCount',
//         'playLists',
//         'course_data'
//     ));
// }else{

    return view('student.contentSection', compact(
        'content',
        'content_details',
        'difficulty_levels',
        'allTags',
        'courseCount',
        'playLists',
        'course_data'
    ));
// }
    }
}





    public function  singlecontentcomments($comment_id)  {
        $contentcomm = DB::select("SELECT content.id, content.title, content.image_url,content.duration, difficulty_level.name as difficulty_level, content.created_at,users.name, (SELECT GROUP_CONCAT(comment separator ',') FROM admin_comment WHERE content_id=content.id) AS comment
        FROM inet_stage.content LEFT JOIN inet_stage.users ON content.user_id=users.id JOIN inet_stage.difficulty_level ON content.difficulty_level_id = difficulty_level.id
        WHERE content.id=$comment_id");
         return json_encode($contentcomm);
    }


    ////////////////////////////////////////////Sorting in reciving ///////////////////////////////////////////////////////////////
    public function showContentnewest() {


        $contentRecive =  DB::select(" SELECT content.id, content.affiliation ,content.authors,
        content.title,	content.image_url, difficulty_level.name as difficulty_level, content.created_at,
        content.status, users.name
        FROM inet_stage.content
         left join inet_stage.users   on content.user_id = users.id
         join inet_stage.difficulty_level
         on content.difficulty_level_id = difficulty_level.id
         where content.status=0 AND content.archive=0
         order by content.created_at desc");

       return json_encode($contentRecive);
    }

    public function showContentAlpha() {

        $contentRecive =  DB::select("SELECT content.id, content.affiliation ,content.authors,
        content.title,	content.image_url, difficulty_level.name as difficulty_level, content.created_at,
        content.status, users.name
        FROM inet_stage.content
         left join inet_stage.users   on content.user_id = users.id
         join inet_stage.difficulty_level
         on content.difficulty_level_id = difficulty_level.id
         where content.status=0 AND content.archive=0
         order by content.title");

       return json_encode($contentRecive);
    }








}


