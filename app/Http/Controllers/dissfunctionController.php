<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Object_;

class dissfunctionController extends Controller
{

    public function bannedUserPg()
    {
        $banUsers = DB::select('SELECT bu.*, (SELECT name from users where id=bu.user_id) as name,
        (SELECT name from users where id=bu.ban_by) as banby,
        (SELECT roles.name FROM users JOIN roles ON users.role_id=roles.id WHERE users.id=user_id) AS role,
        (SELECT profile_pic_url from profiles where user_id=bu.user_id) as profile_pic_url
        FROM inet_stage.ban_users bu where bu.ban_date IS NOT NULL');
        return view('discussionBoard.newDiscussionBoard.bannedUser', compact('banUsers'));
    }

    public function deletedThreadsPg()
    {
        $deletdThreads = DB::select('SELECT dbt.*,
        (SELECT title from diss_board where id=dbt.diss_board_id) as board,
        (SELECT name from users where id=dbt.user_id) as name,
        (SELECT profile_pic_url from profiles where user_id=dbt.user_id) as profile_pic_url,
        (SELECT roles.name FROM users JOIN roles ON users.role_id=roles.id WHERE users.id=user_id) AS role,
        (SELECT name from users where id=dbt.d_by) as deletby
        FROM inet_stage.diss_board_thread dbt where d_by IS NOT NULL ORDER by dbt.d_at DESC');
        return view('discussionBoard.newDiscussionBoard.deletedThreads', compact('deletdThreads'));
    }


    public function viewModeratorsPg()
    {
        $moderators = DB::select('SELECT u.*,
        (SELECT full_name from profiles where user_id=u.id) as full_name,
        (SELECT profile_pic_url from profiles where user_id=u.id) as image,
        (SELECT name from roles where id=u.role_id) as role,
        (SELECT count(user_id) from student_content_mapping where user_id=u.id) as bookmarks,
        (SELECT count(user_id) from diss_board_thread where user_id=u.id and d_by is null) as threads,
        (SELECT count(user_id) from diss_board_thread_post where user_id=u.id and d_by is null) as posts
        from users u  where u.moderator=1');
        return view('discussionBoard.newDiscussionBoard.viewModerators', compact('moderators'));
    }

    public function viewAdminPg()
    {

        $Admins = DB::select('SELECT u.*,
        (SELECT full_name from profiles where user_id=u.id) as full_name,
        (SELECT profile_pic_url from profiles where user_id=u.id) as image,
        (SELECT name from roles where id=u.role_id) as role,
        (SELECT count(user_id) from student_content_mapping where user_id=u.id) as bookmarks,
        (SELECT count(user_id) from diss_board_thread where user_id=u.id and d_by is null) as threads,
        (SELECT count(user_id) from diss_board_thread_post where user_id=u.id and d_by is null) as posts
        from users u  where u.role_id=1');
        return view('discussionBoard.newDiscussionBoard.viewAdmins', compact('Admins'));
    }

    public function allusers()
    {

        $users_name = DB::select("SELECT  name FROM inet_stage.users");

        return response()->json([
                'data' => $users_name
            ]);



    }

    public function discBoardprofilePg($u_id)
    {
       $profile = DB::select("SELECT * FROM profiles WHERE user_id=$u_id");

        $user = DB::select("SELECT role_id FROM users WHERE id = $u_id");
        $user_rid=$user[0]->role_id;
        $role = DB::select("SELECT * FROM roles WHERE id = $user_rid");

        $notification = DB::select("select n.id, n.reaction, n.read, n.post_id, n.c_at, dbtp.thread_id,
        (select diss_board_id from diss_board_thread where id=dbtp.thread_id) as board_id,
        (select title from diss_board_thread where id=dbtp.thread_id) as thread,
        (select name from users where id=n.liked_by_u_id) as like_by_user,
        (select profile_pic_url from profiles where user_id=n.liked_by_u_id) as like_by_user_avatar,
        (select name from users where id=n.replied_by_u_id) as replied_by_user,
        (select profile_pic_url from profiles where user_id=n.replied_by_u_id) as replied_by_user_avatar
        from notifications n join diss_board_thread_post dbtp on n.post_id=dbtp.id where dbtp.user_id=? order by n.c_at desc limit 5", [$u_id]);

        $tagsncat2 =DB::select("select c.tags,c.category_ids,c.tags,c.gender,

        (select affiliation FROM users WHERE id=c.user_id) AS affiliation,
        (select location FROM users WHERE id=c.user_id) AS country,
        (select email FROM users WHERE id=c.user_id) AS email,
        (select GROUP_CONCAT(NAME SEPARATOR ', ') FROM categories WHERE FIND_IN_SET(id, c.category_ids)) AS categories
        FROM profiles c WHERE c.user_id=?", [$u_id]);

        $new_message = DB::select("select count(*) new_message from chat_threads join chat_message on chat_threads.id=chat_message.thread_id where (chat_threads.user_1=? or chat_threads.user_2=?) and chat_message.read=0 and chat_message.user_id!=?", [$u_id, $u_id, $u_id]);
        $new_message = $new_message[0]->new_message;
        $tagsonly = DB::select("SELECT tags FROM profiles WHERE user_id = $u_id");
        $threads = DB::select("SELECT diss_board_thread.*,
        (select name from users where id=diss_board_thread.user_id) AS author,
        (select profile_pic_url from profiles where user_id=diss_board_thread.user_id) AS author_avatar,
        (select roles.name from users join roles on users.role_id=roles.id where users.id=$u_id) AS role,
        (select count(*) from diss_board_pinned_thread where thread_id=diss_board_thread.id and user_id=$u_id) as pinned,
        (select name from users where id=diss_board_thread.l_reply_user_id) AS l_reply_user,
        (select profile_pic_url from profiles where user_id=diss_board_thread.l_reply_user_id) AS l_reply_user_avatar
        from diss_board_thread where user_id=$u_id AND d_by is NULL");

        $posts = DB::select("SELECT dbtp.*,
        (select name from users where id=dbtp.user_id) AS author,
        (select profile_pic_url from profiles where user_id=dbtp.user_id) AS author_avatar,
        (select roles.name from users join roles on users.role_id=roles.id where users.id=dbtp.user_id) AS role
        from diss_board_thread_post dbtp  where dbtp.user_id=? AND dbtp.d_at is null  order by dbtp.c_at desc",[$u_id]);

$my_contributions = DB::select("SELECT  c.id, c.title,c.authors, c.content_privacy, c.affiliation, c.image_url, c.downloaded_count, c.views_count, c.featured, c.status,c.scope_type,c.created_at,
(SELECT NAME FROM users WHERE id=c.user_id) AS author,
(SELECT profile_pic_url FROM profiles WHERE user_id=c.id) AS image,
(SELECT NAME FROM difficulty_level WHERE id=c.difficulty_level_id) AS difficulty_level,
(SELECT roles.name FROM users JOIN roles ON users.role_id=roles.id WHERE users.id=c.user_id) AS role
 FROM content c   WHERE c.user_id=? AND c.archive=0 AND c.status=1 GROUP BY  c.created_at DESC ", [$u_id]);

$userdetailsnew = DB::select("SELECT u.*,
(SELECT count(user_id) from content where user_id=u.id AND archive=0 AND status=1) as contributionstotal,
(SELECT count(user_id) from diss_board_thread where user_id=u.id and d_by is null) as threads,
(SELECT count(user_id) from diss_board_thread_post where user_id=u.id and d_by is null) as posts
from users u  where id=?",[$u_id]);
                $user_content_updated_list = DB::select("SELECT GROUP_CONCAT(content_id) as content_ids FROM student_content_mapping WHERE user_id=?",[$u_id]);
                $user_content_updated_list = $user_content_updated_list[0]->content_ids;
    $categories = DB::select("SELECT * FROM categories");
        $allTags = DB::select("SELECT * FROM tags");

        // return view('discussionBoard.newDiscussionBoard.discBoardprofile', compact('userdetails', 'ranks', 'bookmarkscontent','threads','posts'));
         return view('discussionBoard.newDiscussionBoard.discBoardprofile', compact('profile', 'role', 'tagsncat2','new_message','tagsonly','threads','posts','my_contributions','userdetailsnew','user_content_updated_list','categories','allTags'));   }

    public function unbanUser($user_id)
    {

        try {
            DB::update("update ban_users set ban_date=null, unban_date=? where user_id = ?", [now(), $user_id]);
            return response()->json([
                'success' => true,
                'message' => "User's ban lifted successfully!"
            ]);
        } catch (QueryException $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ]);
        }
    }


    public function restoreThread($ques_id)
    {

        try {
            DB::update("update diss_board_thread set d_at=null, d_by=null where id = ?", [$ques_id]);
            return response()->json([
                'success' => true,
                'message' => "Thread restored successfully!"
            ]);
        } catch (QueryException $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function unmakecontri($user_id)
    {

        try {
            DB::update("update users set moderator=0 where id = ?", [$user_id]);
            return response()->json([
                'success' => true,
                'message' => "Unmake contributor successfully!"
            ]);
        } catch (QueryException $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ]);
        }
    }


    public function makecontributor($user_id)
    {

        try {
            DB::update("update users set moderator=1 where id = ?", [$user_id]);
            return response()->json([
                'success' => true,
                'message' => "Unmake contributor successfully!"
            ]);
        } catch (QueryException $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function showuserdetails($u_id)
    {

        $userdetail = DB::select("SELECT u.*,
        (SELECT full_name from profiles where user_id=u.id) as full_name,
        (SELECT profile_pic_url from profiles where user_id=u.id) as image,
        (SELECT name from roles where id=u.role_id) as role,
        (SELECT count(user_id) from student_content_mapping where user_id=u.id) as bookmarks,
        (SELECT count(user_id) from diss_board_thread where user_id=u.id) as threads,
        (SELECT count(user_id) from diss_board_thread_post where user_id=u.id) as posts
        from users u where u.id=$u_id");
        return json_encode($userdetail);
    }


    public function assignRank(Request $request)
    {

        $user_idrank = $request['asign_rankid'];
        $rank_id = $request['rank_id'];

        $checkRank = DB::select('SELECT count(user_id) as num FROM inet_stage.user_rank_mapping where user_id = ?', [$user_idrank]);
        $checkRank = $checkRank[0]->num;

        if ($checkRank == 0)  {
            try {
                DB::insert("INSERT INTO user_rank_mapping (user_id, rank_id)
                VALUES (?, ?)", [$user_idrank, $rank_id]);

                return response()->json([
                    'success' => true,
                    'message' => "Rank Assigned successfully!"
                ]);
            } catch (QueryException $ex) {
                return response()->json([
                    'success' => false,
                    'message' => $ex->getMessage()
                ]);
            }
        } else {

            return response()->json([
                'success' => true,
                'message' => "User already hava a Rank!"
            ]);


        }
    }
}
