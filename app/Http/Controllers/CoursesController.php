<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use App\PlayLists;
use phpDocumentor\Reflection\Types\Null_;

class CoursesController extends Controller
{
    public function coursesAddWithDetail(Request $request)
    {
        $user_id = Auth::user()->id;
        $course_title = $request['content_title'];
        $course_discription = $request['content_discription'];
        $affiliation = $request['institution_or_source'];
        $difficulty_level_id = $request['difficulty_level3'];
        $course_image = $request['course_image2'];
        // $duration = $request['duration2'];
        $tags = $request['course_tags'];
        $category_ids = $request['categories3'];
        $category_ids = "," . $category_ids . ",";
        $status_course = 0;
        $archive = 0;
        $course_id = null;
        $course_privacy = $request->input('privacy_content_01');
        $author = $request->input('Author');
        $type_course = 'course';


        if (Auth::user()->role_id == 1) {
            $status_content = 1;
        }

        if ($course_image) {
            $request->validate([
                'course_image2' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            ]);

            $fileName = time() . '.' . $course_image->extension();
            $course_image->move(public_path('uploads/content/profile_images'), $fileName);

            try {
                DB::insert("INSERT INTO content (title, description, tags, category_ids, affiliation, difficulty_level_id, downloaded_count, views_count, steps_count, section_count, created_at, updated_at, image_url, user_id, status, content_privacy, archive, authors, scope_type)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [$course_title, $course_discription, $tags, $category_ids, $affiliation, $difficulty_level_id, 0, 0, 0, 0, now(), now(), $fileName, $user_id, $status_course, $course_privacy, $archive,$author, $type_course]);

                $content_id = DB::getPdo()->lastInsertId();
            } catch (QueryException $ex) {
                return response()->json([
                    'success' => false,
                    'message' => $ex->getMessage()
                ]);
            }
        } else {
            try {
                DB::insert("INSERT INTO content (title, description, tags, category_ids, affiliation, difficulty_level_id, downloaded_count, views_count, steps_count, section_count, created_at, updated_at, image_url, user_id, status, content_privacy, archive, authors, scope_type)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [$course_title, $course_discription, $tags, $category_ids, $affiliation, $difficulty_level_id, 0, 0, 0, 0, now(), now(), 'placeholder.png', $user_id, $status_course, $course_privacy, $archive, $author, $type_course]);

                $course_id = DB::getPdo()->lastInsertId();
                return response()->json([
                            'success' => true,
                            'course' => true,
                            'content_id' => $course_id,
                            'message' => "Course added successfully!"
                        ]);
            } catch (QueryException $ex) {
                return response()->json([
                    'success' => false,
                    'message' => $ex->getMessage()
                ]);
            }
        }

    }


    public function AddContentToCourse(Request $request)
    {
        // dd(Auth::user()->id);
        $user_id = Auth::user()->id;
        $course_id = $request->course_id;
        $content_id = $request->content_id;


        $courseAlreadyexists = DB::select("SELECT * FROM course_content_detail WHERE user_id= $user_id AND course_id= $course_id AND content_id=$content_id");


      if($courseAlreadyexists == NULL) {
         DB::insert("INSERT INTO course_content_detail (user_id,course_id,content_id)
                VALUES (?, ?, ?)", [$user_id,$course_id,$content_id]);


            return response()->json([
                'success' => true,
                'status' => 1,
                'message' => 'Course added successfully.'
            ]);


      }
      else {


        return response()->json([
            'success' => true,
            'status' => 0,
            'message' => 'Course already added to the playlist.'
        ]);






      }










    }



    public function GetContentForCourse($content_id)
    {
        //     $bookmark = "";
        //     if (Auth::check()) {
        //         $user_id = Auth::user()->id;
        //         // $bookmark = "(SELECT COUNT(id) FROM student_content_mapping WHERE user_id=$user_id AND content_id=c.id) as bookmark,";
        //     };

        //     try {

        //     $course_data = DB::select("SELECT title, description, tags, category_ids, affiliation, difficulty_level_id, downloaded_count, views_count, steps_count, section_count, created_at, updated_at, image_url, user_id, status, content_privacy, archive, authors, scope_type
        //                                   FROM content WHERE id = $course_id" );


        //    $content = DB::select("SELECT course_content_detail.*,  c.content_privacy , c.content_type , c.scope_type , c.authors as authors, c.difficulty_level_id , c.id, c.title,c.authors,c.affiliation,c.title,
        //    c.description, c.tags, c.created_at, c.views_count, c.user_id, c.section_count, c.category_ids

        //     FROM course_content_detail
        //     LEFT JOIN content c ON course_content_detail.content_id=c.id

        //      WHERE course_content_detail.course_id=$course_id");

        //     if (empty($content)){
        //         return view('student.contentSection', compact(
        //             'course_data'
        //         ));
        //     }
        //     else{
        //         return view('student.contentSection', compact(
        //             'course_data',
        //             'content'
        //         ));
        //     }




        //     } catch (QueryException $ex) {
        //         return response()->json([
        //             'success' => false,
        //             'message' => $ex->getMessage()
        //         ]);
        //     }


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



        $content = DB::select("SELECT c.content_privacy , c.content_type ,c.status, c.scope_type , c.authors as authors, c.difficulty_level_id , c.id, c.title,c.authors,c.affiliation,c.title, c.description, c.tags, c.duration, c.created_at, c.views_count, c.user_id, c.section_count, c.category_ids, $bookmark
        (SELECT name FROM users WHERE id=c.user_id) as author,
        (SELECT id FROM users WHERE id=c.user_id) as user_id,
        (SELECT profile_pic_url FROM profiles WHERE user_id=c.user_id) as author_profile_pic_url,
        (SELECT r.name FROM users u JOIN roles r ON u.role_id=r.id WHERE u.id=c.user_id) as author_role,
        (SELECT name FROM difficulty_level WHERE id=c.difficulty_level_id) as difficulty_level,
        (SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, c.category_ids)) as categories
        FROM content c WHERE c.id=$content_id AND c.archive=0 AND (c.status=1 OR c.status=0 OR c.status=2)");



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
        $courseC = DB::Table("course_content_detail")->where('course_id',$content_id);

        $difficulty_levels = DB::select("SELECT * FROM difficulty_level");
        $allTags = DB::select("SELECT * FROM tags");

        $courseCount = $courseC->get()->count();

        $playLists =  PlayLists::where('user_id',\Auth::user()->id)->get();
        $playLists2 = DB::select("SELECT course_content_detail.user_id, course_content_detail.content_id, course_content_detail.course_id,course_content_detail.id as mainID,c.image_url, c.content_privacy , c.status, c.content_type , c.scope_type , c.authors as authors, c.difficulty_level_id , c.id, c.title,c.authors,c.affiliation,c.title,
        c.description, c.tags, c.created_at, c.views_count, c.user_id, c.section_count, c.category_ids,difficulty_level.name as difficulty_level, cd.type,cd.asset,cd.section,cd.type,cd.steps,cd.embeded_url,cd.description

         FROM course_content_detail
         LEFT JOIN content c ON course_content_detail.content_id=c.id
         join difficulty_level on c.difficulty_level_id = difficulty_level.id
         JOIN content_details cd ON cd.content_id=c.id

          WHERE course_content_detail.course_id=$content_id  ORDER BY course_content_detail.content_order ASC" );

        $course_content_details = DB::select("SELECT course_content_detail.*,  c.content_privacy , c.content_type , c.scope_type , c.authors AS AUTHORS, c.difficulty_level_id , c.id, c.title,c.authors,c.affiliation,c.title,
        c.description, c.tags, c.created_at, c.views_count, c.user_id, c.section_count, c.category_ids

         FROM course_content_detail
         LEFT JOIN content c ON course_content_detail.content_id=c.id

          WHERE course_content_detail.course_id=$content_id");

        return view('student.courseContentnew', compact(
            'content',
            'content_details',
            'difficulty_levels',
            'allTags',
            'courseCount',
            'playLists',
            'playLists2',
            'course_content_details'

        ));

    }
    public function approvedCourseDetails($content_id)
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

        $content_details = DB::select("SELECT * FROM content_details WHERE content_id=$content_id");
        $courseC = DB::Table("course_content_detail")->where('course_id',$content_id);

        $difficulty_levels = DB::select("SELECT * FROM difficulty_level");
        $allTags = DB::select("SELECT * FROM tags");

        $courseCount = $courseC->get()->count();

        $playLists =  PlayLists::where('user_id',\Auth::user()->id)->get();
        $playLists2 = DB::select("SELECT course_content_detail.*,c.image_url, c.content_privacy , c.content_type , c.scope_type , c.authors as authors, c.difficulty_level_id , c.id, c.title,c.authors,c.affiliation,c.title,
        c.description, c.tags, c.created_at, c.views_count, c.user_id, c.section_count, c.category_ids,difficulty_level.name as difficulty_level

         FROM course_content_detail
         LEFT JOIN content c ON course_content_detail.content_id=c.id
         join difficulty_level on c.difficulty_level_id = difficulty_level.id

          WHERE course_content_detail.course_id=$content_id");

        $course_content_details = DB::select("SELECT course_content_detail.user_id,course_content_detail.course_id,course_content_detail.content_id,course_content_detail.id as mainID,c.id, c.content_privacy , c.content_type , c.scope_type , c.authors AS AUTHORS, c.difficulty_level_id , c.title,c.authors,c.affiliation,c.title,
        c.description, c.tags, c.created_at, c.views_count, c.section_count, c.category_ids, cd.type,cd.asset,cd.section,cd.type,cd.steps,cd.embeded_url,cd.description

         FROM course_content_detail
         JOIN content c ON course_content_detail.content_id=c.id
         JOIN content_details cd ON cd.content_id=c.id

          WHERE course_content_detail.course_id=$content_id");

        return view('student.contentSection', compact(
            'content',
            'content_details',
            'difficulty_levels',
            'allTags',
            'courseCount',
            'playLists',
            'playLists2',
            'course_content_details'

        ));

    }
    public function courseDetail($content_id)
    {

        $bookmark = "";
            if (Auth::check()) {
                $user_id = Auth::user()->id;
                // $bookmark = "(SELECT COUNT(id) FROM student_content_mapping WHERE user_id=$user_id AND content_id=c.id) as bookmark,";
            };

            try {

            $course_data = DB::select("SELECT title, description, tags, category_ids, affiliation, difficulty_level_id, downloaded_count, views_count, steps_count, section_count, created_at, updated_at, image_url, user_id, status, content_privacy, archive, authors, scope_type
                                          FROM content WHERE id = $content_id" );


           $content = DB::select("SELECT course_content_detail.*,  c.content_privacy , c.content_type , c.scope_type , c.authors as authors, c.difficulty_level_id , c.id, c.title,c.authors,c.affiliation,c.title,
           c.description, c.tags, c.created_at, c.views_count, c.user_id, c.section_count, c.category_ids

            FROM course_content_detail LEFT JOIN content c ON course_content_detail.content_id=c.id

             WHERE course_content_detail.course_id=$content_id");

            // if (empty($content)){
            //     return view('student.contentSection', compact(
            //         'course_data'
            //     ));
            // }
            // else{
                return view('student.contentSection', compact(
                    'course_data',
                    'content'
                ));
            // }




            } catch (QueryException $ex) {
                return response()->json([
                    'success' => false,
                    'message' => $ex->getMessage()
                ]);
            }



    }

    public function courseEditWithDetail(Request $request)
    {
        $status_content     = 0;
        $content_image      = $request['content_image_thumb'];
        $contentInput       = [];
        // $contentDetailInput = [];
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


        // $description = $request['description'];
        // $type        = $request['type'];
        // $asset       = $request['asset'];
        // $embeded_url = $request['embeded_url'];

        // switch ($type) {
        //     case 'Video':
        //         $content_path = "uploads/content/videos";

        //         $validator = Validator::make($request->all(), ['asset' => ['required', 'mimes:mp4,flv,m3u8,ts,3gp,mov,avi,wmv', 'max:150000']]);

        //         if ($validator->fails() && !$embeded_url) return response()->json([
        //             'success' => false,
        //             'message' => "Invalid video type!"
        //         ]);

        //         break;
        //     case 'Pdf':
        //         $content_path = "uploads/content/pdf";

        //         $validator = Validator::make($request->all(), ['asset' => ['required', 'mimes:pdf', 'max:10000']]);

        //         if ($validator->fails()) return response()->json([
        //             'success' => false,
        //             'message' => "Invalid pdf type!"
        //         ]);

        //         break;
        //     case 'Image':
        //         $content_path = "uploads/content/images";

        //         $validator = Validator::make($request->all(), ['asset' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:10000']]);

        //         if ($validator->fails()) return response()->json([
        //             'success' => false,
        //             'message' => "Invalid image type!"
        //         ]);

        //         break;
        //     case 'Audio':
        //         $content_path = "uploads/content/audios";

        //         $validator = Validator::make($request->all(), ['asset' => ['required', 'mimes:audio/mpeg,mpga,mp3,wav', 'max:150000']]);

        //         if ($validator->fails()) return response()->json([
        //             'success' => false,
        //             'message' => "Invalid audio type!"
        //         ]);

        //         break;

        //     default:
        //         $content_path = "";
        //         break;
        // }

        // $contentDetailInput['description'] = $description;
        // $contentDetailInput['type']        = $type;

        // if ($asset) {

        //     $fileName = time() . '.' . $asset->extension();
        //     $asset->move(public_path($content_path), $fileName);
        //     $contentDetailInput['asset'] = $fileName;

        // } else {

        //     $youtube_embed_url = null;

        //     if ($embeded_url) {
        //         $urlParts   = explode('/', $embeded_url);
        //         $vidid      = explode( '&', str_replace('watch?v=', '', end($urlParts) ) );
        //         $youtube_embed_url =  'https://www.youtube.com/embed/' . $vidid[0] ;
        //         $contentDetailInput['embeded_url'] = $youtube_embed_url;
        //     }

        // }


        try {

            $updateContent        = DB::table('content')->where('id',$request->content_id)->update($contentInput);
            // $updateContentDetail  = DB::table('content_details')->where('id',$request->content_detail_id)->update($contentDetailInput);
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

    public function submitCourse(Request $request)
    {
        // dd(Auth::user()->id);
        $role_id = Auth::user()->role_id;
        $course_id = $request->course_id;

        if ($role_id == 1){
          $status    = 1;
        }
        else{
            $status    = 0;
        }
        try {
            DB::insert("UPDATE content set status=$status WHERE id=$course_id");
           if ($role_id == 1){
            return response()->json([
                'success' => true,
                'status' => 1,
            ]);
            }else{
                return response()->json([
                    'success' => true,
                    'status' => 2,
                ]);
             }

        } catch (QueryException $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ]);
        }
    }
    public function courseUploadDelete(Request $request)
    {
        $content_id = $request['contentId'];
        $delete = DB::table('course_content_detail')->where('id',$content_id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Content Deleted successfully!'
        ]);
    }


    public function contentOrderList(Request $request)
    {

        $position = $request->position;
       

        $i=1;
    
        // Update Orting Data 
        foreach($position as $k => $v){
        
           
            try{
            $sql =DB::insert("UPDATE course_content_detail set content_order=$i WHERE id=$v");
    
            $i++;
            } catch (QueryException $ex) {
                return response()->json([
                    'success' => false,
                    'message' => $ex->getMessage()
             ]);
            }
        }
     }
    public function coursesPgFilternew(Request $request)
    {
        $sort = $request['sort'];
        $role_id = Auth::user()->role_id;
        $user_id = Auth::user()->id;
    
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
                    $sort = "ORDER BY c.views_count DESC";
                    break;
            }
        }


        $content =  DB::select("SELECT c.id, c.title,c.authors, c.content_privacy, c.affiliation, c.image_url, c.downloaded_count, c.views_count, c.featured, c.status,c.scope_type,c.content_group,content_details.type AS formatType,
        (SELECT name FROM users WHERE id=c.user_id) as author, 
        (SELECT count(course_id) FROM course_content_detail WHERE course_id=c.id) as count,
        (SELECT name FROM difficulty_level
        WHERE id=c.difficulty_level_id) as difficulty_level FROM content c 
     LEFT JOIN content_details ON content_details.content_id=c.id
WHERE c.user_id=$user_id AND c.scope_type='course' AND c.archive=0 $sort");

         $user_content_updated_list = DB::select("SELECT GROUP_CONCAT(content_id) as content_ids FROM student_content_mapping WHERE user_id=$user_id");
         $user_content_updated_list = $user_content_updated_list[0]->content_ids;

        

        return response()->json([
            'success' => true,
            'content' => $content
        ]);
        
        
    }
     public function contentPgFilternew(Request $request)
     {
         $sort = $request['sort'];
         $role_id = Auth::user()->role_id;
         $user_id = Auth::user()->id;
     
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
 
 
         $content =  DB::select("SELECT c.id, c.title,c.authors, c.content_privacy, c.affiliation, c.image_url, c.downloaded_count, c.views_count, c.featured, c.status,c.scope_type,c.content_group,content_details.type AS formatType,
         (SELECT name FROM users WHERE id=c.user_id) as author, 
         (SELECT name FROM difficulty_level
         WHERE id=c.difficulty_level_id) as difficulty_level FROM content c
     LEFT JOIN content_details ON content_details.content_id=c.id
       WHERE c.user_id=$user_id AND c.scope_type='content' AND c.archive=0 $sort");
 
          $user_content_updated_list = DB::select("SELECT GROUP_CONCAT(content_id) as content_ids FROM student_content_mapping WHERE user_id=$user_id");
          $user_content_updated_list = $user_content_updated_list[0]->content_ids;
 
         
 
         return response()->json([
             'success' => true,
             'content' => $content
         ]);
         
         
     }

    public function Studentsorting(Request $request)
    {
        $sort = $request['sort'];
        $role_id = Auth::user()->role_id;
        $user_id = Auth::user()->id;
    
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
                    $sort = "ORDER BY c.views_count DESC";
                    break;
            }
        }
        $my_bookmarks = DB::select("SELECT c.*,content_details.type AS formatType,
        (SELECT name FROM users WHERE id=c.user_id) as author,
        (SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, c.category_ids)) as categories,
        (SELECT name FROM difficulty_level WHERE id=c.difficulty_level_id) as difficulty_level
        FROM student_content_mapping scm JOIN content c ON c.id=scm.content_id 
        LEFT JOIN content_details ON content_details.content_id=c.id
       WHERE scm.user_id=$user_id AND c.status=1 AND c.archive=0 $sort");
    
        $user_content_updated_list = DB::select("SELECT GROUP_CONCAT(content_id) as content_ids FROM student_content_mapping WHERE user_id=$user_id");
        $user_content_updated_list = $user_content_updated_list[0]->content_ids;

   

        return response()->json([
           'success' => true,
           'content' => $my_bookmarks
        ]);
      }
public function add_group(Request $request)
{

     $course_id = $request->course_id;
    $group = $request->group;



    try {
        if($group=='None'){
            DB::table('content')
            ->where('id', $course_id)
            ->update(['content_group' => NULL]); 
            return response()->json([
                'success' => true,
                'status' => 1,
            ]);
        }else{
            if($group==null){
                return response()->json([
                    'success' => false,
                    'status' => 0,
                ]);
            }
            else{
          DB::table('content')
            ->where('id', $course_id)
            ->update(['content_group' => $group]); 
            return response()->json([
                'success' => true,
                'status' => 1,
            ]);
            }
        }   
    } catch (QueryException $ex) {
        return response()->json([
            'success' => false,
            'message' => $ex->getMessage()
        ]);
    }
}
public function contentPgFilterseqarchnew(Request $request)
     {
         $sort = $request['sort'];
        

         $user_content_updated_list = "";
         if (Auth::check()) {
             $user_id = Auth::user()->id;
             $role_id = Auth::user()->role_id;

             $user_content_updated_list = DB::select("SELECT GROUP_CONCAT(content_id) as content_ids FROM student_content_mapping WHERE user_id=$user_id");
             $user_content_updated_list = $user_content_updated_list[0]->content_ids;
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
                    $sort = "ORDER BY c.views_count DESC";
                    break;
            }
        }
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
                 $content = DB::select("SELECT c.id, c.title, c.authors, c.affiliation, c.duration, c.image_url, c.scope_type, c.downloaded_count, c.views_count, c.featured, c.content_group,content_details.type AS formatType,(SELECT name FROM users WHERE id=c.user_id) as author,
                 (SELECT name FROM difficulty_level WHERE id=c.difficulty_level_id) as difficulty_level,
                 (SELECT count(course_id) FROM course_content_detail WHERE course_id=c.id) as count, c.content_privacy FROM content c 
                LEFT JOIN content_details ON content_details.content_id=c.id 
               WHERE c.status=1 AND c.archive=0 AND c.id IN ($contents_ids) GROUP BY c.id $sort");
             }


             if ($users_ids && !$contents_ids) {
                 $content = DB::select("SELECT c.id, c.title, c.authors, c.affiliation, c.duration, c.image_url, c.scope_type, c.downloaded_count, c.views_count, c.featured,c.content_group,content_details.type AS formatType, (SELECT name FROM users WHERE id=c.user_id) as author,
                 (SELECT name FROM difficulty_level WHERE id=c.difficulty_level_id) as difficulty_level, (SELECT count(course_id) FROM course_content_detail WHERE course_id=c.id) as count, c.content_privacy 
               FROM content c 
              LEFT JOIN content_details ON content_details.content_id=c.id 
              JOIN users u ON u.id=c.user_id WHERE u.id IN ($users_ids) GROUP BY c.id $sort");
             }

             // code by javed
             $matchUser = DB::table('users')->where('name','like',"%{$query}%")->get();
             // end


            //  $courseC = DB::Table("course_content_detail")->where('course_id', $contents_ids);
            //  $courseCount = $courseC->get()->count();

            //  dd($courseCount);


   return response()->json([
        'success' => true,
        'content' => $content 
    ]); 

         
     }

     public function groupcontent()
    {

  

        try {
           $content = DB::select("SELECT content_group FROM content");


           return response()->json([
            'success' => true,
            'content' => $content 
        ]); 
            } catch (QueryException $ex) {
                return response()->json([
                    'success' => false,
                    'message' => $ex->getMessage()
                ]);
            }



    }

    }
