<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\PlayLists;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index(Request $request)
    {
        $role_id = Auth::user()->role_id;
        $user_id = Auth::user()->id;
        $sort = $request['sort'];



        if($role_id == 3 || $role_id == 1) {

            $recent_3_discussion = DB::select("SELECT db.title,db.diss_board_cat_id,d.*,u.id as user_id, u.name, r.name as role, p.profile_pic_url FROM diss_board_thread d LEFT JOIN users u ON d.user_id=u.id JOIN roles r ON u.role_id=r.id JOIN profiles p ON u.id=p.user_id JOIN diss_board db ON db.id=d.diss_board_id WHERE d.d_at is NULL AND (db.diss_board_cat_id=1 || db.diss_board_cat_id=2 || db.diss_board_cat_id=5) ORDER BY d.c_at DESC LIMIT 3");
        }

        if($role_id == 2) {

            $recent_3_discussion = DB::select("SELECT db.title,db.diss_board_cat_id,d.*,u.id as user_id, u.name, r.name as role, p.profile_pic_url FROM diss_board_thread d LEFT JOIN users u ON d.user_id=u.id  JOIN roles r ON u.role_id=r.id  JOIN profiles p ON u.id=p.user_id JOIN diss_board db ON db.id=d.diss_board_id  WHERE d.d_at is NULL AND (db.diss_board_cat_id=1 || db.diss_board_cat_id=5) ORDER BY d.c_at DESC LIMIT 3");

        }
        $recent_3_nws = DB::select("SELECT nf.id, nf.title, LEFT(nf.body,500) as body, nf.img_url, nf.created_at, nf.updated_at, nf.user_id, users.name FROM inet_live.news_feed nf   INNER JOIN inet_live.users on nf.user_id = inet_live.users.id ORDER BY nf.created_at DESC LIMIT 3");


        $all_admins = DB::select("SELECT  inet_stage.users.id, inet_stage.users.name, inet_stage.users.role_id, profiles.profile_pic_url FROM inet_stage.users LEFT JOIN inet_stage.profiles on inet_stage.users.id = profiles.user_id  where role_id=1");

        // playlist javed code
        $playLists =  PlayLists::where('user_id',\Auth::user()->id)->get();

        switch ($role_id) {
            case 1:
                // $difficulty_levels = DB::select("SELECT * FROM difficulty_level");
                // $tags = DB::select("SELECT * FROM tags");
                // $recivedcontent = DB::select("SELECT content.id,content.title,content.authors, content.affiliation, content.image_url, content.scope_type, difficulty_level.name as difficulty_level, content.created_at, content.status,content.duration,content.content_privacy, users.name FROM inet_stage.content left join inet_stage.users   on content.user_id = users.id join inet_stage.difficulty_level on content.difficulty_level_id = difficulty_level.id where content.status=0 AND content.archive=0 order by content.title");
                // $addedcontent = DB::select("SELECT content.id, content.title,content.authors, content.affiliation,	content.image_url, difficulty_level.name as difficulty_level,content.content_privacy, content.created_at, content.status,content.views_count as views, content.downloaded_count as download, users.name
                // FROM inet_stage.content left join inet_stage.users  on content.user_id = users.id join inet_stage.difficulty_level on content.difficulty_level_id = difficulty_level.id
                //  where content.user_id=$user_id  AND content.archive=0");


                // return view('admin.dashboard', compact('all_admins', 'difficulty_levels', 'tags', 'recivedcontent', 'addedcontent','playLists', 'recent_3_nws'));
                // break;

                $difficulty_levels = DB::select("SELECT * FROM difficulty_level");
                $tags = DB::select("SELECT * FROM tags");

                $my_content = DB::select("SELECT c.id, c.title,c.authors, c.content_privacy, c.affiliation, c.image_url, c.downloaded_count, c.views_count, c.featured, c.status,c.scope_type,c.content_group,content_details.type AS formatType,
                (SELECT name FROM users WHERE id=c.user_id) as author, (SELECT name FROM difficulty_level
                WHERE id=c.difficulty_level_id) as difficulty_level FROM content c 
                 LEFT JOIN content_details ON content_details.content_id=c.id
                WHERE c.user_id=$user_id AND c.scope_type='content' AND c.archive=0
                GROUP BY c.created_at DESC");
        
        
        
        
            $my_course = DB::select("SELECT c.id, c.title,c.authors, c.content_privacy, c.affiliation, c.image_url, c.downloaded_count, c.views_count, c.featured, c.status,c.scope_type,c.content_group,content_details.type AS formatType,
            (SELECT name FROM users WHERE id=c.user_id) as author,
            (SELECT name FROM difficulty_level WHERE id=c.difficulty_level_id) as difficulty_level,
            (SELECT count(course_id) FROM course_content_detail WHERE course_id=c.id) as count
             FROM content c  
             LEFT JOIN content_details ON content_details.content_id=c.id
             WHERE c.user_id=$user_id AND c.scope_type='course' AND c.archive=0 GROUP BY c.created_at DESC");
        
        
        
        
                $user_content_updated_list = DB::select("SELECT GROUP_CONCAT(content_id) as content_ids FROM student_content_mapping WHERE user_id=$user_id");
                $user_content_updated_list = $user_content_updated_list[0]->content_ids;

                // $course_ID=$my_course[0]->id;



            //     $courseC = DB::Table("course_content_detail")->where('course_id',$course_ID);
            //     $courseCount = $courseC->get()->count();
            //   //  dd($courseCount);
                return view('admin.add', compact('recent_3_discussion', 'my_content','my_course', 'user_content_updated_list', 'difficulty_levels', 'tags','playLists', 'recent_3_nws'));
                break;
            case 2:
                // $incomplete_content = DB::select("SELECT c.id, c.steps_count as total_steps, MAX(lct.content_step) as step_on_leave, c.title, c.duration, c.views_count, c.image_url, c.downloaded_count, c.duration,
                // (SELECT name FROM users WHERE id=c.user_id) as author,
                // (SELECT name FROM difficulty_level WHERE id=c.difficulty_level_id) as difficulty_level
                // FROM learner_content_tracking lct JOIN content c ON c.id=lct.content_id
                // WHERE lct.user_id=$user_id AND c.status=1 GROUP BY c.id HAVING MAX(lct.content_step) != steps_count");

                // if (count($incomplete_content)) {
                //     return redirect("/welcome/back");
                // } else {
                //     return redirect("/home");
                // }

                $my_bookmarks = DB::select("SELECT c.*,content_details.type AS formatType, (SELECT name FROM users WHERE id=c.user_id) as author,
                (SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, c.category_ids)) as categories,
                (SELECT name FROM difficulty_level WHERE id=c.difficulty_level_id) as difficulty_level
                FROM student_content_mapping scm JOIN content c ON c.id=scm.content_id 
                LEFT JOIN content_details ON content_details.content_id=c.id

                WHERE scm.user_id=$user_id AND c.status=1 AND c.archive=0 ORDER BY c.created_at DESC");

                $user_content_updated_list = DB::select("SELECT GROUP_CONCAT(content_id) as content_ids FROM student_content_mapping WHERE user_id=$user_id");
                $user_content_updated_list = $user_content_updated_list[0]->content_ids;


                return view('student.bookmarks', compact('my_bookmarks', 'recent_3_discussion', 'recent_3_nws', 'user_content_updated_list'));

                break;
            case 3:

                if (!Auth::user()->activate) {
                    return view('contributor.approve');
                }
                if ($sort) {
                    switch ($sort) {
                        case 'popular':
                            $sort = "ORDER BY c.views_count DESC";
                            break;
                        case 'alpha':
                            $sort = "ORDER BY c.title ASC";
                            break;
                        case 'new':
                            $sort = "ORDER BY c.created_at DESC";
                            break;
                        default:
                            $sort = "ORDER BY c.created_at DESC";
                            break;
                    }
                }


                $difficulty_levels = DB::select("SELECT * FROM difficulty_level");
                $tags = DB::select("SELECT * FROM tags");

                $my_content = DB::select("SELECT c.id, c.title,c.authors, c.content_privacy, c.affiliation, c.image_url, c.downloaded_count, c.views_count, c.featured, c.status,c.scope_type,c.content_group,content_details.type AS formatType,
                (SELECT name FROM users WHERE id=c.user_id) as author, (SELECT name FROM difficulty_level
                WHERE id=c.difficulty_level_id) as difficulty_level 
                FROM content c 
                LEFT JOIN content_details ON content_details.content_id=c.id
                WHERE c.user_id=$user_id AND c.scope_type='content' AND c.archive=0
                GROUP BY c.created_at DESC");

              /////////////////////////////////SAMRA/////////////////////////////////
            //     $my_course = DB::select("SELECT c.id, c.title,c.authors, c.content_privacy, c.affiliation, c.image_url, c.downloaded_count, c.views_count, c.featured, c.status,c.scope_type,
            //    (SELECT name FROM users WHERE id=c.user_id) as author, (SELECT name FROM difficulty_level
            //    WHERE id=c.difficulty_level_id) as difficulty_level FROM content c WHERE c.user_id=$user_id AND c.scope_type='course' AND c.archive=0 $sort");


            $my_course = DB::select("SELECT c.id, c.title,c.authors, c.content_privacy, c.affiliation, c.image_url, c.downloaded_count, c.views_count, c.featured, c.status,c.scope_type,c.content_group,content_details.type AS formatType,
            (SELECT name FROM users WHERE id=c.user_id) as author,
            (SELECT name FROM difficulty_level WHERE id=c.difficulty_level_id) as difficulty_level,
            (SELECT count(course_id) FROM course_content_detail WHERE course_id=c.id) as count
             FROM content c 
             LEFT JOIN content_details ON content_details.content_id=c.id
              WHERE c.user_id=$user_id AND c.scope_type='course' AND c.archive=0 ORDER BY c.created_at DESC");



                $user_content_updated_list = DB::select("SELECT GROUP_CONCAT(content_id) as content_ids FROM student_content_mapping WHERE user_id=$user_id");
                $user_content_updated_list = $user_content_updated_list[0]->content_ids;

               // $course_ID=$my_course[0]->id;



            //     $courseC = DB::Table("course_content_detail")->where('course_id',$course_ID);
            //     $courseCount = $courseC->get()->count();
            //   //  dd($courseCount);
                return view('contributor.contributorDashboard', compact('recent_3_discussion', 'my_content','my_course', 'user_content_updated_list', 'difficulty_levels', 'tags','playLists', 'recent_3_nws'));
                break;
            default:
                return view('notFound404');
                break;
        }
    }

    public function viewprofPg()
    {
        if (!Auth::user()->activate && Auth::user()->role_id == 3) {
            return view('contributor.approve');
        }
        $difficulty_levels = DB::select("SELECT * FROM difficulty_level");
        $allTags = DB::select("SELECT * FROM tags");
        $user_id = Auth::user()->id;
        $contributions = DB::select("SELECT content.id,content.title,content.authors,content.image_url, difficulty_level.name as difficulty_level, content.created_at,users.affiliation,
        users.location,users.gender,users.email,
        content.status,content.duration, users.name FROM inet_stage.content left join inet_stage.users   on content.user_id = users.id
         join inet_stage.difficulty_level on content.difficulty_level_id = difficulty_level.id where content.status=1 AND user_id=$user_id  AND content.archive=0");
        $tagsncat2 =DB::select("SELECT c.tags,c.category_ids,

        (SELECT affiliation FROM users WHERE id=c.user_id) AS affiliation,
        (SELECT location FROM users WHERE id=c.user_id) AS country,
        (SELECT gender FROM users WHERE id=c.user_id) AS gender,
        (SELECT email FROM users WHERE id=c.user_id) AS email,
        (SELECT GROUP_CONCAT(NAME SEPARATOR ', ') FROM categories WHERE FIND_IN_SET(id, c.category_ids)) AS categories
        FROM profiles c WHERE c.user_id=$user_id");

        return view('admin/viewProfile', compact('contributions', 'difficulty_levels', 'allTags','tagsncat2'));    }


    public function updateProfile(Request $request)
    {

       try {
            $user_id = Auth::user()->id;
            $contentInput['tags']        = $request['tags'];
            $category_ids = $request['categories'];
            $category_ids = "," . $category_ids . ",";
            $contentInput['category_ids']= $category_ids;

            if ($request['profile_image']) {
                $request->validate([
                    'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                $fileName = time() . '.' . $request['profile_image']->extension();
                $request['profile_image']->move(public_path('uploads/profile_images'), $fileName);

                DB::table('profiles')->where('user_id',$user_id)->update($contentInput);
                DB::update('UPDATE users SET name = ?, updated_at = ? where id = ?', [$request['profile_fullName'], now(), Auth::user()->id]);
                DB::update('UPDATE profiles SET full_name = ?, about_me = ?, profile_pic_url = ?, updated_at = ?, twitter_url = ?, youtube_url = ?, web_url = ? where user_id = ?', [$request['profile_fullName'], $request['profile_discription'], $fileName, now(), $request['twitter_url'], $request['youtube_url'], $request['web_url'], Auth::user()->id,]);
            } else {

                DB::table('profiles')->where('user_id',$user_id)->update($contentInput);
                DB::update('UPDATE users SET name = ?, updated_at = ? where id = ?', [$request['profile_fullName'], now(), Auth::user()->id]);
                DB::update('UPDATE profiles SET full_name = ?, about_me = ?, updated_at = ?, twitter_url = ?, youtube_url = ?, web_url = ? where user_id = ?', [$request['profile_fullName'], $request['profile_discription'], now(), $request['twitter_url'], $request['youtube_url'], $request['web_url'], Auth::user()->id]);
            }

            return response()->json([
                'success' => true,
                'message' => "Profile updated successfully",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $contentInput,
            ], 400);
        }
    }

    public function accountSettingPg()
    {
        if (!Auth::user()->activate && Auth::user()->role_id == 3) {
            return view('contributor.approve');
        }

        return view('contributor.accountSetting');
    }

    public function updateSetting(Request $request)
    {
        $email = $request['email'];
        $current_password = $request['current_password'];
        $new_password = $request['new_password'];
        $web_url = $request['web_url'];
        $city = $request['city'];
        $zip_code = $request['zip_code'];
        $time_zone = $request['time_zone'];
        $gender = $request['gender'];
        $privacy_status = $request['privacy_status'];
        $web_search = $request['web_search'];
        $location= $request['location'];
        $affiliation= $request['affiliation'];

        $check = DB::select("SELECT * FROM users WHERE email='$email'");

        if ($current_password) {
            if (!Hash::check($current_password, $check[0]->password)) {
                return redirect()->back()->withErrors(['current_password' => 'Your current password is incorrect'])->withInput();
            }

            $request->validate([
                'new_password' => 'required|string|min:8',
            ]);

            if (Hash::check($new_password, $check[0]->password)) {
                return redirect()->back()->withErrors(['new_password' => 'Old password cannot be used again'])->withInput();
            }

            try {
                DB::update('UPDATE users SET password = ?, updated_at = ? WHERE email = ?', [Hash::make($new_password), now(), $email]);
            } catch (QueryException $ex) {
                return redirect()->back()->withErrors(['err_msg' => $ex->getMessage()])->withInput();
            }
        }

        $form_data = [
            $web_url,
            $city,
            $zip_code,
            $time_zone,
            $gender,
            (($privacy_status == 'on') ? 1 : 0),
            (($web_search == 'on') ? 1 : 0),
            $check[0]->id
        ];

        $newdata = [
            $affiliation,
            $location,
            $check[0]->id
        ];


        try {
            if($newdata){
                DB::update('UPDATE users SET affiliation = ?, location= ?  WHERE id = ?', $newdata);

                DB::update('UPDATE profiles SET web_url = ?, city = ?, zip_code = ?, time_zone = ?, gender = ?, privacy_status = ?, web_search = ? WHERE user_id = ?', $form_data);
                return redirect()->back()->with('success_msg', "Settings updated successfully");
            }else{
                DB::update('UPDATE profiles SET web_url = ?, city = ?, zip_code = ?, time_zone = ?, gender = ?, privacy_status = ?, web_search = ? WHERE user_id = ?', $form_data);
                return redirect()->back()->with('success_msg', "Settings updated successfully");
            }
        } catch (QueryException $ex) {
            return redirect()->back()->withErrors(['err_msg' => $ex->getMessage()])->withInput();
        }
    }

    public function discussions(Request $request)
    {
        if (!Auth::user()->activate && Auth::user()->role_id == 3) {
            return view('contributor.approve');
        }

        $condition = "";
        $user_id = Auth::user()->id;

        if ($request->has('tag') && $request->input('tag') != "All") {
            $tag = $request->input('tag');
            $condition = "AND tags LIKE '%$tag%'";
        }

        if ($request->has('main') && $request->input('main') == "YourQuestions") {
            $condition .= "AND discussion.user_id = $user_id";
        }

        if ($request->has('main') && $request->input('main') == "YourAnswers") {
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

    public function discussions_ask_question(Request $request)
    {
        $ques_id = $request['ques_id'];
        $ques_title = $request['ques_title'];
        $ques_body = $request['ques_body'];
        $ques_tags = $request['ques_tags'];

        if ($ques_id) {
            $data = [$ques_title, $ques_body, $ques_tags, now(), $ques_id];

            $updated = DB::update('UPDATE discussion SET title = ?, body = ?, tags = ?, updated_at = ? where id = ?', $data);

            return $updated;
        } else {
            $data = [$ques_title, $ques_body, $ques_tags, Auth::user()->id, now(), now(), 1];

            try {
                $insertedData = DB::insert('insert into discussion (title, body, tags, user_id, created_at, updated_at, status) values (?, ?, ?, ?, ?, ?, ?)', $data);
                return $insertedData;
                return response()->json([
                    'success' => true,
                    'message' => $insertedData,
                ]);
            } catch (QueryException $ex) {
                return response()->json([
                    'success' => false,
                    'message' => $ex->getMessage(),
                ], 400);
            }
        }
    }

    public function discussion_show(Request $request, $discussion_id)
    {
        if (!Auth::user()->activate && Auth::user()->role_id == 3) {
            return view('contributor.approve');
        }

        $discussion = DB::select("SELECT discussion.*, users.name, roles.name as role, profiles.profile_pic_url
        FROM discussion LEFT JOIN users ON discussion.user_id=users.id
        JOIN roles ON users.role_id=roles.id JOIN profiles ON users.id=profiles.user_id WHERE discussion.id = ?", [$discussion_id]);

        $discussion_tags = DB::select("SELECT * FROM tags");

        $discussion_responses = DB::select("SELECT discussion_response.*, users.name, roles.name as role, profiles.profile_pic_url
        FROM discussion_response LEFT JOIN users ON discussion_response.user_id=users.id
        JOIN roles ON users.role_id=roles.id JOIN profiles ON users.id=profiles.user_id WHERE discussion_response.discussion_id= ?", [$discussion_id]);

        if ($discussion[0]->user_id != Auth::user()->id) {
            $views_count = $discussion[0]->views_count + 1;
            DB::update('UPDATE discussion SET views_count = ? where id = ?', [$views_count, $discussion_id]);
        }

        $discussion = $discussion[0];

        return view('discussionBoard.discussion_show', compact('discussion', 'discussion_tags', 'discussion_responses'));
    }


    public function discussion_vote(Request $request, $discussion_id)
    {
        DB::update('UPDATE discussion SET votes_count = ? where id = ?', [$request['vote'], $discussion_id]);

        return response()->json([
            'success' => true,
            'discussion_id' => $discussion_id,
        ]);
    }
    public function discussion_delete($discussion_id)
    {
        try {
            DB::update('UPDATE discussion SET deleted_at = ?, status = ? where id = ?', [now(), 0, $discussion_id]);
            DB::update('UPDATE discussion_response SET deleted_at = ? where discussion_id = ?', [now(), $discussion_id]);

            return response()->json([
                'success' => true,
                'message' => "Successfully deleted the discussion",
            ]);
        } catch (QueryException $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage(),
            ], 400);
        }
    }
    public function discussion_response(Request $request)
    {
        $discussion_id = $request['discussion_id'];
        $discussion_response_text = $request['discussion_response_text'];

        $data = [
            Auth::user()->id,
            $discussion_id,
            $discussion_response_text,
            now(),
        ];

        try {
            $insertedData = DB::insert('insert into discussion_response (user_id, discussion_id, body, created_at) values (?, ?, ?, ?)', $data);
            if ($insertedData) {

                $total_discussion_response = DB::select('SELECT COUNT(id) AS total FROM discussion_response WHERE discussion_id = ?', [$discussion_id]);
                $total_discussion_response = $total_discussion_response[0]->total;

                DB::update('UPDATE discussion SET answers_count = ?, answered = ?, last_reply_at = ? where id = ?', [$total_discussion_response, 1, now(), $discussion_id]);

                return redirect()->back()->with('success_msg', "Settings updated successfully");
            }
        } catch (QueryException $ex) {
            return redirect()->back()->withErrors(['err_msg' => $ex->getMessage()])->withInput();
        }
    }

  public function addPg()
    {
        $role_id = Auth::user()->role_id;
        $user_id = Auth::user()->id;

        $recent_3_discussion = DB::select("SELECT db.title,db.diss_board_cat_id,d.*,u.id as user_id, u.name, r.name as role, p.profile_pic_url FROM diss_board_thread d LEFT JOIN users u ON d.user_id=u.id JOIN roles r ON u.role_id=r.id JOIN profiles p ON u.id=p.user_id JOIN diss_board db ON db.id=d.diss_board_id WHERE d.d_at is NULL AND (db.diss_board_cat_id=1 || db.diss_board_cat_id=2 || db.diss_board_cat_id=5) ORDER BY d.c_at DESC LIMIT 3");

        $recent_3_nws = DB::select("SELECT nf.id, nf.title, LEFT(nf.body,500) as body, nf.img_url, nf.created_at, nf.updated_at, nf.user_id, users.name FROM inet_live.news_feed nf   INNER JOIN inet_live.users on nf.user_id = inet_live.users.id ORDER BY nf.created_at DESC LIMIT 3");


        $all_admins = DB::select("SELECT  inet_stage.users.id, inet_stage.users.name, inet_stage.users.role_id, profiles.profile_pic_url FROM inet_stage.users LEFT JOIN inet_stage.profiles on inet_stage.users.id = profiles.user_id  where role_id=1");

        $playLists =  PlayLists::where('user_id',\Auth::user()->id)->get();

        $difficulty_levels = DB::select("SELECT * FROM difficulty_level");
        $tags = DB::select("SELECT * FROM tags");

        $my_content = DB::select("SELECT c.id, c.title,c.authors, c.content_privacy, c.affiliation, c.image_url, c.downloaded_count, c.views_count, c.featured, c.status,c.scope_type, c.content_group, content_details.type AS formatType,
        (SELECT name FROM users WHERE id=c.user_id) as author, (SELECT name FROM difficulty_level
        WHERE id=c.difficulty_level_id) as difficulty_level FROM content c
     LEFT JOIN content_details ON content_details.content_id=content.id
 WHERE c.user_id=$user_id AND c.scope_type='content' AND c.archive=0
        GROUP BY c.created_at DESC");




    $my_course = DB::select("SELECT c.id, c.title,c.authors, c.content_privacy, c.affiliation, c.image_url, c.downloaded_count, c.views_count, c.featured, c.status,c.scope_type,c.content_group,content_details.type AS formatType,
    (SELECT name FROM users WHERE id=c.user_id) as author,
    (SELECT name FROM difficulty_level WHERE id=c.difficulty_level_id) as difficulty_level,
    (SELECT count(course_id) FROM course_content_detail WHERE course_id=c.id) as count
     FROM content c 
     LEFT JOIN content_details ON content_details.content_id=content.id
 WHERE c.user_id=$user_id AND c.scope_type='course' AND c.archive=0 GROUP BY c.created_at DESC");




        $user_content_updated_list = DB::select("SELECT GROUP_CONCAT(content_id) as content_ids FROM student_content_mapping WHERE user_id=$user_id");
        $user_content_updated_list = $user_content_updated_list[0]->content_ids;

        // $course_ID=$my_course[0]->id;



    //     $courseC = DB::Table("course_content_detail")->where('course_id',$course_ID);
    //     $courseCount = $courseC->get()->count();
    //   //  dd($courseCount);
        return view('admin.add', compact('recent_3_discussion', 'my_content','my_course', 'user_content_updated_list', 'difficulty_levels', 'tags','playLists', 'recent_3_nws'

      ));   
 }

    public function taskPg()
    {
        $role_id = Auth::user()->role_id;
        $user_id = Auth::user()->id;


                $recent_3_nws = DB::select("SELECT nf.id, nf.title, LEFT(nf.body,500) as body, nf.img_url, nf.created_at, nf.updated_at, nf.user_id, users.name FROM inet_live.news_feed nf   INNER JOIN inet_live.users on nf.user_id = inet_live.users.id ORDER BY nf.created_at DESC LIMIT 3");

                $playLists =  PlayLists::where('user_id',\Auth::user()->id)->get();
                $all_admins = DB::select("SELECT  inet_stage.users.id, inet_stage.users.name, inet_stage.users.role_id, profiles.profile_pic_url FROM inet_stage.users LEFT JOIN inet_stage.profiles on inet_stage.users.id = profiles.user_id  where role_id=1");
                $difficulty_levels = DB::select("SELECT * FROM difficulty_level");

                $tags = DB::select("SELECT * FROM tags");
                $recivedcontent = DB::select("SELECT content.id,content.title,content.authors, content.affiliation, content.image_url, content.scope_type, difficulty_level.name as difficulty_level, content.created_at, content.status,content.duration,content.content_privacy,content.content_group, users.name FROM inet_stage.content left join inet_stage.users   on content.user_id = users.id join inet_stage.difficulty_level on content.difficulty_level_id = difficulty_level.id where content.status=0 AND content.archive=0 order by content.title");
                $addedcontent = DB::select("SELECT content.id, content.title,content.authors, content.affiliation,	content.image_url, difficulty_level.name as difficulty_level,content.content_privacy, content.created_at, content.status,content.views_count as views, content.downloaded_count as download, users.name
                FROM inet_stage.content left join inet_stage.users  on content.user_id = users.id join inet_stage.difficulty_level on content.difficulty_level_id = difficulty_level.id
                 where content.user_id=$user_id  AND content.archive=0");

         $historycontent =  DB::select("SELECT content.id,content.affiliation ,content.authors,content.scope_type,
         content.title,	content.image_url, difficulty_level.name as difficulty_level, content.created_at,
         content.status,content.duration, users.name
         FROM inet_stage.content
          left join inet_stage.users   on content.user_id = users.id
          join inet_stage.difficulty_level
          on content.difficulty_level_id = difficulty_level.id
          where content.status=1 AND content.archive=0");

          $current_date = now();
          $pastsixdays = $current_date->subDay(5)->format('Y-m-d');

         $deletecontent =  DB::select("SELECT content.id,content.affiliation ,content.authors,content.scope_type,
         content.title,	content.image_url, difficulty_level.name as difficulty_level, content.created_at,
         content.status,content.duration, users.name
         FROM inet_stage.content
          left join inet_stage.users   on content.user_id = users.id
          join inet_stage.difficulty_level
          on content.difficulty_level_id = difficulty_level.id
          where content.archive=1 AND content.updated_at > '$pastsixdays'");



                return view('admin.task', compact('all_admins', 'difficulty_levels', 'tags', 'recivedcontent', 'addedcontent','playLists', 'recent_3_nws', 'historycontent', 'deletecontent'));

    }
    public function userPg()
    {
        $role_id = Auth::user()->role_id;
        $user_id = Auth::user()->id;

        $userinfo = DB::select("SELECT c.*,
        (SELECT COUNT(id) FROM content WHERE user_id=c.id) AS COUNT,
        (SELECT COUNT(id) FROM diss_board_thread_post d WHERE d.user_id=c.id) AS POST
         FROM users c ORDER BY c.name ASC
        ");
        return(view('admin.user', compact('userinfo')));
    }

    public function userpgAppend(Request $request)
    {
        $sort = $request['sort'];
        $role_id = Auth::user()->role_id;
        $user_id = Auth::user()->id;
    
        if ($sort) {
            switch ($sort) {
                case 'All':
                    $sort = "ORDER BY c.name ASC";
                    break;
                case 'learner':
                    $sort = "WHERE c.role_id=2";
                    break;
                case 'teacher':
                    $sort = "WHERE c.role_id=3";
                    break;
                default:
                    $sort = "ORDER BY c.name ASC";
                    break;
            }
        }


        $userinfoAppend = DB::select("SELECT c.*,
        (SELECT COUNT(id) FROM content WHERE user_id=c.id) AS COUNT,
        (SELECT COUNT(id) FROM diss_board_thread_post d WHERE d.user_id=c.id) AS POST
         FROM users c $sort
        ");

        

        return response()->json([
            'success' => true,
            'userinfoAppend' => $userinfoAppend
        ]);
        
        
    }
}
