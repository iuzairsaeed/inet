<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class ContributorController extends Controller
{
    public function contentAdd(Request $request)
    {
        $inputs = [];
        $res = [];

        $user_id = Auth::user()->id;
        // $content_title = $request['content_title'];
        // $content_discription = $request['content_discription'];
        // $affiliation = $request['affiliation'];
        // $difficulty_level_id = $request['difficulty_level_c'];
        $content_image = $request['content_image'];
        // $duration = $request['duration'];
        // $tags = $request['tags'];

        $category_ids = $request['categories'];
        $category_ids = "," . $category_ids . ",";

        $status_content = 2;
        $archive1 = 0;
        $content_privacy1 = $request->input('privacy_content_01');

        // array for insert eloquent
        $inputs['title']       = $request['content_title'];
        $inputs['description'] = $request['content_discription'];
        $inputs['tags']        = $request['tags'];

        $inputs['category_ids']         = $category_ids;
        $inputs['affiliation']          = $request['institution_or_source'];
        $inputs['duration']             = $request['duration'];
        $inputs['difficulty_level_id']  = $request['difficulty_level_c'];
        $inputs['downloaded_count']     = 0;
        $inputs['views_count']          = 0;
        $inputs['steps_count']          = 0;
        $inputs['section_count']        = 0;
        $inputs['created_at']           = now();
        $inputs['updated_at']           = now();
        $inputs['image_url']            = 'placeholder.png';
        $inputs['user_id']              = $user_id;
        $inputs['content_privacy']      = $request->input('privacy_content_01');
        $inputs['archive']              = $archive1;
        $inputs['authors']              = $request['Author'];
        $inputs['affiliation']          = $request['institution_or_source'];
        $inputs['scope_type']           = 'course';



        if (Auth::user()->role_id == 1) {
            $status_content = 1;
        }

        $inputs['status'] = $status_content;
        // CHECK INPUT TYPE IMAGE UDPATE IMAGE ARRAY
        if ($content_image) {

            $fileName = time() . '.' . $content_image->extension();
            $content_image->move(public_path('uploads/content/profile_images'), $fileName);
            $inputs['image_url']  = $fileName;

            // json res
            $res['success']  = true;
            $res['course' ]  = false;
            $res['message']  = "Content added successfully!";

        }else{
            // json res
            $res['success']  = true;
            $res['message']  = "Content added successfully!";
        }

         try {

                $create             = DB::table('content')->insert($inputs);
                $lastInsertId       = DB::getPdo()->lastInsertId();
                $res['content_id']  = $lastInsertId;
                return response()->json($res);

        } catch (QueryException $ex) {
                return response()->json([
                    'success' => false,
                    'message' => $ex->getMessage()
                ]);
        }


         // dd($create);

        // if ($content_image) {
        //     $request->validate([
        //         'content_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        //     ]);

        //     $fileName = time() . '.' . $content_image->extension();
        //     $content_image->move(public_path('uploads/content/profile_images'), $fileName);

        //     try {
        //         DB::insert("INSERT INTO content (title, description, tags, category_ids, affiliation, duration, difficulty_level_id, downloaded_count, views_count, steps_count, section_count, created_at, updated_at, image_url, user_id, status, content_privacy, archive)
        //         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [$content_title, $content_discription, $tags, $category_ids, $affiliation, $duration, $difficulty_level_id, 0, 0, 0, 0, now(), now(), $fileName, $user_id, $status_content, $content_privacy1, $archive1]);

        //         $lastInsertId = DB::getPdo()->lastInsertId();

        //         return response()->json([
        //             'success' => true,
        //             'course' => false,
        //             'content_id' => $lastInsertId,
        //             'message' => "Content added successfully!"
        //         ]);
        //     } catch (QueryException $ex) {
        //         return response()->json([
        //             'success' => false,
        //             'message' => $ex->getMessage()
        //         ]);
        //     }
        // } else {
        //     try {

        //         DB::insert("INSERT INTO content (title, description, tags, category_ids, affiliation, duration, difficulty_level_id, downloaded_count, views_count, steps_count, section_count, created_at, updated_at, image_url, user_id, status, content_privacy, archive)
        //         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [$content_title, $content_discription, $tags, $category_ids, $affiliation, $duration, $difficulty_level_id, 0, 0, 0, 0, now(), now(), 'placeholder.png', $user_id, $status_content, $content_privacy1, $archive1]);

        //         $lastInsertId = DB::getPdo()->lastInsertId();

        //         return response()->json([
        //             'success' => true,
        //             'content_id' => $lastInsertId,
        //             'message' => "Content added successfully!"
        //         ]);
        //     } catch (QueryException $ex) {
        //         return response()->json([
        //             'success' => false,
        //             'message' => $ex->getMessage()
        //         ]);
        //     }
        // }
    }


    public function createContent($content_id)
    {
        if (!Auth::user()->activate) {
            return view('contributor.approve');
        }

        $content = DB::select("SELECT *, (SELECT GROUP_CONCAT(name separator ', ') FROM categories WHERE FIND_IN_SET(id, category_ids)) as categories FROM content WHERE id=$content_id");
        $content = $content[0];

        $content_detils = DB::select("SELECT * FROM content_details WHERE content_id=$content_id");

        return view('contributor.createContent', compact('content', 'content_detils'));
    }

    public function contentAddsection(Request $request)
    {

        $check = DB::select("SELECT MAX(section) AS section FROM content_details WHERE content_id= ?", [$request['content_id']]);

        if (count($check)) {
            $section = ($check[0]->section + 1);
            DB::update("UPDATE content SET section_count = $section WHERE id = ?", [$request['content_id']]);
        } else {
            DB::update("UPDATE content SET section_count = 1 WHERE id = ?", [$request['content_id']]);
        }

        return response()->json([
            'success' => true,
            'message' => "Section added successfully!"
        ]);
    }

    public function contentUpload(Request $request)
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
                    // 'message' => $validator->messages()->get('asset')[0]
                    'message' => "Invalid video type!"
                ]);

                break;
            case 'Pdf':
                $content_path = "uploads/content/pdf";

                $validator = Validator::make($request->all(), ['asset' => ['required', 'mimes:pdf', 'max:10000']]);

                if ($validator->fails()) return response()->json([
                    'success' => false,
                    // 'message' => $validator->messages()->get('asset')[0]
                    'message' => "Invalid pdf type!"
                ]);

                break;
            case 'Image':
                $content_path = "uploads/content/images";

                $validator = Validator::make($request->all(), ['asset' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:10000']]);

                if ($validator->fails()) return response()->json([
                    'success' => false,
                    // 'message' => $validator->messages()->get('asset')[0]
                    'message' => "Invalid image type!"
                ]);

                break;
            case 'Audio':
                $content_path = "uploads/content/audios";

                $validator = Validator::make($request->all(), ['asset' => ['required', 'mimes:audio/mpeg,mpga,mp3,wav', 'max:150000']]);

                if ($validator->fails()) return response()->json([
                    'success' => false,
                    // 'message' => $validator->messages()->get('asset')[0]
                    'message' => "Invalid audio type!"
                ]);

                break;

            default:
                $content_path = "";
                break;
        }

        $step = DB::select("SELECT MAX(steps) AS step FROM content_details WHERE content_id=$content_id");
        $step = ($step[0]->step) ? ($step[0]->step + 1) : 1;

        if ($asset) {

            $fileName = time() . '.' . $asset->extension();
            $asset->move(public_path($content_path), $fileName);

            DB::insert("INSERT INTO content_details (title, description, type, asset, duration, section, steps, content_id, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [$title, $description, $type, $fileName, $duration, $current_section, $step, $content_id, now(), now()]);
        } else {

            $youtube_embed_url = null;

            if ($embeded_url) {

                $urlParts   = explode('/', $embeded_url);
                $vidid      = explode( '&', str_replace('watch?v=', '', end($urlParts) ) );
                $youtube_embed_url =  'https://www.youtube.com/embed/' . $vidid[0] ;

                // $embed_url = substr($embeded_url, 8);
                // $embed_url = explode("/", $embed_url);
                // $embed_url = explode("?", $embed_url[1]);
                // $embed_url = $embed_url[0];

                // $youtube_embed_url = "https://www.youtube.com/embed/" . $embed_url;
            }

            DB::insert("INSERT INTO content_details (title, description, type, duration, section, steps, content_id, created_at, updated_at, embeded_url)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [$title, $description, $type, $duration, $current_section, $step, $content_id, now(), now(), $youtube_embed_url]);
        }


        $content_type = DB::select('SELECT CONCAT("[", GROUP_CONCAT(DISTINCT CONCAT("\"", type, "\"") separator ", "), "]") type FROM content_details WHERE content_id=?', [$content_id]);
        $content_type = $content_type[0]->type;

        try {
            DB::update("UPDATE content SET steps_count = $step, section_count = $current_section, content_type = '$content_type' WHERE id = ?", [$content_id]);

            return response()->json([
                'success' => true,
                'message' => 'Content added successfully!'
            ]);
        } catch (QueryException $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function getRelevantTags($cat_id)
    {
        $tags = DB::select("SELECT id, name FROM tags WHERE cat_id IN ($cat_id)");

        return response()->json([
            'cat_id' => $cat_id,
            'tags' => $tags
        ]);
    }
    public function contentAddWithDetail(Request $request)
    {
        $user_id = Auth::user()->id;
        $content_title = $request['content_title2'];
        $content_discription = $request['content_discription2'];
        $affiliation = $request['affiliation2'];
        $difficulty_level_id = $request['difficulty_level2'];
        $content_image = $request['content_image2'];
        $duration = $request['duration2'];
        $tags = $request['tags'];
        $category_ids = $request['categories'];
        $category_ids = "," . $category_ids . ",";
        $status_content = 0;
        $archive = 0;
        $content_id = null;
        $content_privacy = $request->input('privacy_content');
        $author = $request->input('author');
        $scope_type = 'content';


        if (Auth::user()->role_id == 1) {
            $status_content = 1;
        }

        if ($content_image) {
            $request->validate([
                'content_image2' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            ]);

            $fileName = time() . '.' . $content_image->extension();
            $content_image->move(public_path('uploads/content/profile_images'), $fileName);

            try {
                DB::insert("INSERT INTO content (title, description, tags, category_ids, affiliation, duration, difficulty_level_id, downloaded_count, views_count, steps_count, section_count, created_at, updated_at, image_url, user_id, status, content_privacy, archive,authors,scope_type)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [$content_title, $content_discription, $tags, $category_ids, $affiliation, $duration, $difficulty_level_id, 0, 0, 0, 0, now(), now(), $fileName, $user_id, $status_content, $content_privacy, $archive,$author,$scope_type]);

                $content_id = DB::getPdo()->lastInsertId();
            } catch (QueryException $ex) {
                return response()->json([
                    'success' => false,
                    'message' => $ex->getMessage()
                ]);
            }
        } else {
            try {
                DB::insert("INSERT INTO content (title, description, tags, category_ids, affiliation, duration, difficulty_level_id, downloaded_count, views_count, steps_count, section_count, created_at, updated_at, image_url, user_id, status, content_privacy, archive, authors, scope_type)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [$content_title, $content_discription, $tags, $category_ids, $affiliation, $duration, $difficulty_level_id, 0, 0, 0, 0, now(), now(), 'placeholder.png', $user_id, $status_content, $content_privacy, $archive, $author, $scope_type]);

                $content_id = DB::getPdo()->lastInsertId();
            } catch (QueryException $ex) {
                return response()->json([
                    'success' => false,
                    'message' => $ex->getMessage()
                ]);
            }
        }

        $current_section = 1;
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

        $step = DB::select("SELECT MAX(steps) AS step FROM content_details WHERE content_id=$content_id");
        $step = ($step[0]->step) ? ($step[0]->step + 1) : 1;

        if ($asset) {

            $fileName = time() . '.' . $asset->extension();
            $asset->move(public_path($content_path), $fileName);
            DB::insert("INSERT INTO content_details (title, description, type, asset, duration, section, steps, content_id, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [$title, $description, $type, $fileName, $duration, $current_section, $step, $content_id, now(), now()]);

        } else {

            $youtube_embed_url = null;

            if ($embeded_url) {
                $urlParts   = explode('/', $embeded_url);
                $vidid      = explode( '&', str_replace('watch?v=', '', end($urlParts) ) );
                $youtube_embed_url =  'https://www.youtube.com/embed/' . $vidid[0] ;
            }

            // if ($embeded_url) {
            //     $embed_url = substr($embeded_url, 8);
            //     $embed_url = explode("/", $embed_url);
            //     $embed_url = explode("?", $embed_url[1]);
            //     $embed_url = $embed_url[0];

            //     $youtube_embed_url = "https://www.youtube.com/embed/" . $embed_url;
            // }

            DB::insert("INSERT INTO content_details (title, description, type, duration, section, steps, content_id, created_at, updated_at, embeded_url)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [$title, $description, $type, $duration, $current_section, $step, $content_id, now(), now(), $youtube_embed_url]);
        }


        $content_type = DB::select('SELECT CONCAT("[", GROUP_CONCAT(DISTINCT CONCAT("\"", type, "\"") separator ", "), "]") type FROM content_details WHERE content_id=?', [$content_id]);
        $content_type = $content_type[0]->type;

        try {
            DB::update("UPDATE content SET steps_count = $step, section_count = $current_section, content_type = '$content_type' WHERE id = ?", [$content_id]);

            return response()->json([
                'success' => true,
                'course' => true,
                'content_id' => $content_id,
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
