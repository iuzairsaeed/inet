<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }


    public function welcomBackPg()
    {
        if (!Auth::user()->activate && Auth::user()->role_id == 3) {
            return view('contributor.approve');
        }

        $user_id = Auth::user()->id;

        $recent_3_discussion = DB::select("SELECT d.*, u.name, r.name as role, p.profile_pic_url FROM discussion d LEFT JOIN users u ON d.user_id=u.id JOIN roles r ON u.role_id=r.id JOIN profiles p ON u.id=p.user_id ORDER BY d.created_at DESC LIMIT 3");
        $contents = DB::select("SELECT c.id, c.title, c.duration, c.authors, c.affiliation, c.image_url, c.downloaded_count, c.views_count, c.featured, (SELECT name FROM users WHERE id=c.user_id) as author,
        (SELECT name FROM difficulty_level WHERE id=c.difficulty_level_id) as difficulty_level FROM content c WHERE (c.status=1 AND c.user_id=1) AND c.archive=0 ORDER BY created_at DESC LIMIT 3");

        $user_content_updated_list = DB::select("SELECT GROUP_CONCAT(content_id) as content_ids FROM student_content_mapping WHERE user_id=$user_id");
        $user_content_updated_list = $user_content_updated_list[0]->content_ids;

        $incomplete_content = DB::select("SELECT c.id, c.steps_count as total_steps, MAX(lct.content_step) as step_on_leave, c.title, c.duration, c.views_count, c.image_url, c.downloaded_count, c.duration,
        (SELECT name FROM users WHERE id=c.user_id) as author,
        (SELECT name FROM difficulty_level WHERE id=c.difficulty_level_id) as difficulty_level
        FROM learner_content_tracking lct JOIN content c ON c.id=lct.content_id
        WHERE lct.user_id=$user_id AND c.status=1 GROUP BY c.id HAVING MAX(lct.content_step) != steps_count");

        return view('student.welcomBack', compact('recent_3_discussion', 'contents', 'user_content_updated_list', 'incomplete_content'));
    }

    // public function coursesPg($category_id)
    // {
    //     if (Auth::user()->role_id != 2) {
    //         return redirect('/home');
    //     }

    //     $user_id = Auth::user()->id;

    //     $difficulty_level = DB::select("SELECT id, name FROM difficulty_level");

    //     $user_content_updated_list = DB::select("SELECT GROUP_CONCAT(content_id) as content_ids FROM student_content_mapping WHERE user_id=$user_id");
    //     $user_content_updated_list = $user_content_updated_list[0]->content_ids;

    //     $cat = DB::select("SELECT id, name, avatar, description FROM categories WHERE id=$category_id");
    //     $cat = $cat[0];
    //     $tags = DB::select("SELECT id, name FROM tags");

    //     $per_page = 6;
    //     $offset = 0;

    //     $content_total = DB::select("SELECT COUNT(*) as total FROM content WHERE category_ids LIKE '%,$category_id,%' AND status=1");
    //     $content_total = $content_total[0]->total;
    //     $content_pages = ceil($content_total / $per_page);

    //     $contents = DB::select("SELECT content.*, users.name as user, difficulty_level.name as difficulty_level,
    //     (SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, content.category_ids)) as categories
    //     FROM content LEFT JOIN users ON content.user_id=users.id LEFT JOIN difficulty_level ON content.difficulty_level_id=difficulty_level.id
    //     WHERE content.category_ids LIKE '%,$category_id,%' AND content.status=1 ORDER BY content.views_count DESC LIMIT $per_page OFFSET $offset");

    //     return view('student.courses', compact(
    //         'cat',
    //         'tags',
    //         'content_total',
    //         'content_pages',
    //         'contents',
    //         'difficulty_level',
    //         'user_content_updated_list'
    //     ));
    // }


    // public function coursesPgFilter(Request $request)
    // {

    //     $cat_id = $request['cat_id'];
    //     $sort = $request['sort'];
    //     $difficulty_level_id = $request['difficulty_level_id'];
    //     $page = $request['page'];

    //     $_video = $request['_video'];
    //     $_article = $request['_article'];
    //     $_pdf = $request['_pdf'];
    //     $_image = $request['_image'];


    //     $tagBtn = $request['tagBtn'];
    //     $searchQuery = $request['searchQuery'];

    //     if ($sort) {
    //         switch ($sort) {
    //             case 'popular':
    //                 $sort = "ORDER BY content.views_count DESC";
    //                 break;
    //             case 'alpha':
    //                 $sort = "ORDER BY content.title ASC";
    //                 break;
    //             case 'new':
    //                 $sort = "ORDER BY content.created_at ASC";
    //                 break;
    //             default:
    //                 $sort = "ORDER BY content.views_count DESC";
    //                 break;
    //         }
    //     }

    //     if ($cat_id && $cat_id != "") {
    //         $condition = " WHERE content.category_ids LIKE '%,$cat_id,%' AND content.status=1";
    //         $per_page = 6;
    //     } else {
    //         $condition = " WHERE content.status=1";
    //         $per_page = 8;
    //     }

    //     if ($difficulty_level_id) {
    //         $condition .= " AND content.difficulty_level_id = $difficulty_level_id";
    //     }

    //     if ($_video) {
    //         $condition .= " AND content.content_type LIKE '%Video%'";
    //     }

    //     if ($_article) {
    //         $condition .= " AND content.content_type LIKE '%Article%'";
    //     }

    //     if ($_pdf) {
    //         $condition .= " AND content.content_type LIKE '%Pdf%'";
    //     }

    //     if ($_image) {
    //         $condition .= " AND content.content_type LIKE '%Image%'";
    //     }

    //     if ($tagBtn != "" && $tagBtn != "All") {
    //         $condition .= " AND content.tags LIKE '%$tagBtn%'";
    //     }

    //     if ($searchQuery && $searchQuery != "") {
    //         $condition .= " AND content.title LIKE '%$searchQuery%'";
    //     }


    //     $offset = ($page - 1) * $per_page;

    //     $content_total = DB::select("SELECT COUNT(*) as total FROM content $condition");
    //     $content_total = $content_total[0]->total;
    //     $content_pages = ceil($content_total / $per_page);

    //     $contents = DB::select("SELECT content.*, users.name as user, difficulty_level.name as difficulty_level, (SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, content.category_ids)) as categories
    //     FROM content LEFT JOIN users ON content.user_id=users.id LEFT JOIN difficulty_level ON content.difficulty_level_id=difficulty_level.id
    //     $condition $sort LIMIT $per_page OFFSET $offset");

    //     return response()->json([
    //         'success' => true,
    //         'content_total' => $content_total,
    //         'content_pages' => $content_pages,
    //         'content_active_page' => $page,
    //         'contents' => $contents,
    //     ]);
    // }

    // public function searchCoursesPg()
    // {
    //     if (Auth::user()->role_id != 2) {
    //         return redirect('/home');
    //     }

    //     $user_id = Auth::user()->id;

    //     $difficulty_level = DB::select("SELECT id, name FROM difficulty_level");

    //     $user_content_updated_list = DB::select("SELECT GROUP_CONCAT(content_id) as content_ids FROM student_content_mapping WHERE user_id=$user_id");
    //     $user_content_updated_list = $user_content_updated_list[0]->content_ids;

    //     $cat = DB::select("SELECT id, name, avatar, description FROM categories");
    //     $cat = $cat[0];
    //     $tags = DB::select("SELECT id, name FROM tags");

    //     $per_page = 8;
    //     $offset = 0;

    //     $content_total = DB::select("SELECT COUNT(*) as total FROM content WHERE status=1");
    //     $content_total = $content_total[0]->total;
    //     $content_pages = ceil($content_total / $per_page);

    //     $contents = DB::select("SELECT content.*, users.name as user, difficulty_level.name as difficulty_level,
    //     (SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, content.category_ids)) as categories
    //     FROM content LEFT JOIN users ON content.user_id=users.id LEFT JOIN difficulty_level ON content.difficulty_level_id=difficulty_level.id
    //     WHERE content.status=1 ORDER BY content.views_count DESC LIMIT $per_page OFFSET $offset");

    //     return view('student.searchCourses', compact(
    //         'cat',
    //         'tags',
    //         'content_total',
    //         'content_pages',
    //         'contents',
    //         'difficulty_level',
    //         'user_content_updated_list'
    //     ));
    // }

    public function courses_bookmarked(Request $request)
    {
        $content_id = $request['content_id'];
        $user_id = $request['user_id'];
        $bookmark = $request['bookmark'];

        $check = DB::select("SELECT * FROM student_content_mapping WHERE user_id=$user_id AND content_id=$content_id");

        if (count($check)) {
            if (!$bookmark) {
                DB::delete('DELETE FROM student_content_mapping WHERE id = ?', [$check[0]->id]);
            }
        } else {
            if ($bookmark) {
                DB::insert('INSERT INTO student_content_mapping (user_id, content_id, created_at, updated_at) values (?, ?, ?, ?)', [$user_id, $content_id, now(), now()]);
            }
        }

        $user_content_updated_list = DB::select("SELECT GROUP_CONCAT(content_id) as content_ids FROM student_content_mapping WHERE user_id=$user_id");
        $user_content_updated_list = $user_content_updated_list[0]->content_ids;

        return response()->json([
            'bookmark' => $bookmark,
            'content_id' => $content_id,
            'user_id' => $user_id,
            'user_content_updated_list' => $user_content_updated_list
        ]);
    }

    // public function contentSectionPg($content_id)
    // {
    //     // if (Auth::user()->role_id != 2) {
    //     //     return redirect('/home');
    //     // }

    //     $user_id = Auth::user()->id;

    //     $content = DB::select("SELECT c.id, c.title, c.description, c.tags, c.duration, c.created_at, c.views_count, c.user_id, c.section_count,
    //     (SELECT COUNT(id) FROM student_content_mapping WHERE user_id=$user_id AND content_id=c.id) as bookmark,
    //     (SELECT name FROM users WHERE id=c.user_id) as author,
    //     (SELECT profile_pic_url FROM profiles WHERE user_id=c.user_id) as author_profile_pic_url,
    //     (SELECT r.name FROM users u JOIN roles r ON u.role_id=r.id WHERE u.id=c.user_id) as author_role,
    //     (SELECT name FROM difficulty_level WHERE id=c.difficulty_level_id) as difficulty_level,
    //     (SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, c.category_ids)) as categories
    //     FROM content c WHERE c.id=$content_id AND c.status=1");

    //     if (!count($content)) {
    //         return redirect('/bookmarks');
    //     }

    //     $content = $content[0];

    //     if ($user_id != $content->user_id) {
    //         $views_count = ($content->views_count + 1);
    //         DB::update('UPDATE content set views_count = ? WHERE id = ?', [$views_count, $content_id]);
    //     }

    //     $content_details = DB::select("SELECT * FROM content_details WHERE content_id=$content_id");

    //     return view('student.contentSection', compact(
    //         'content',
    //         'content_details',
    //     ));
    // }

    public function contentTracking(Request $request)
    {
        $user_id = Auth::user()->id;

        $content_id = $request['content_id'];
        $section = $request['section'];
        $step = $request['step'];

        $check = DB::select("SELECT * FROM learner_content_tracking WHERE user_id=$user_id AND content_id=$content_id AND content_section=$section AND content_step=$step");

        if (!count($check)) {
            DB::insert('INSERT INTO learner_content_tracking (user_id, content_id, content_section, content_step, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, ?)', [$user_id, $content_id, $section, $step, now(), now()]);
        }

        return response()->json([
            'user_id' => $user_id,
            'content_id' => $content_id,
            'section' => $section,
            'step' => $step
        ]);
    }


    public function newssinglPg($content_id)
    {
        $content_details = DB::select("SELECT nf.id, nf.title, nf.body, nf.img_url, nf.created_at, nf.updated_at, nf.user_id, users.name FROM inet_stage.news_feed nf INNER JOIN inet_stage.users on nf.user_id = inet_stage.users.id Where nf.id=$content_id");
        return view('economicResearch', compact('content_details'));
    }
}
