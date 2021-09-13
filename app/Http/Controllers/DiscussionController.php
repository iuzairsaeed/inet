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
use Illuminate\Support\Facades\Auth as FacadesAuth;

class DiscussionController extends Controller
{
    private $thread_per_page = 10;
    private $flag_thread_per_page = 10;
    private $watched_thread_per_page = 10;
    private $post_per_page = 10;
    private $your_posts_per_page = 10;
    private $flagged_posts_per_page = 10;

    public function __construct() {
        $this->middleware('auth');
    }
    
    public function discussionBoardPg()
    {
        if (Auth::check()) {
            $role_id = Auth::user()->role_id;
            $user_id = Auth::user()->id;
            $ban_user = DB::select("select count(*) as ban from ban_users where user_id=? and ban_date is not null", [$user_id]);
            $ban_user = $ban_user[0]->ban;

            if (Auth::user()->moderator) {
                if($role_id==2) {
                    $role_id=3;
                }
                $diss_board_cat = DB::select("SELECT * FROM diss_board_cat WHERE role_ids LIKE '%$role_id%'");
                $diss_board = DB::select("SELECT diss_board.* FROM diss_board JOIN diss_board_cat ON diss_board_cat.id=diss_board.diss_board_cat_id WHERE diss_board_cat.role_ids LIKE '%$role_id%' AND diss_board.diss_board_privacy LIKE '%4%'");


            } else {
                $diss_board_cat = DB::select("SELECT * FROM diss_board_cat WHERE role_ids LIKE '%$role_id%' AND id != 4");
                $diss_board = DB::select("SELECT diss_board.* FROM diss_board JOIN diss_board_cat ON diss_board_cat.id=diss_board.diss_board_cat_id WHERE diss_board_cat.role_ids LIKE '%$role_id%' AND diss_board_cat.id != 4 AND diss_board.diss_board_privacy LIKE '%$role_id%'");
            }
        } else {
            $role_id = 0;

            $diss_board_cat = DB::select("SELECT * FROM diss_board_cat WHERE role_ids LIKE '%$role_id%'");
            $diss_board = DB::select("SELECT diss_board.* FROM diss_board JOIN diss_board_cat ON diss_board_cat.id=diss_board.diss_board_cat_id WHERE diss_board_cat.role_ids LIKE '%$role_id%' AND diss_board.diss_board_privacy LIKE '%$role_id%'");
        }

        return view('discussionBoard.newDiscussionBoard.discussionBoard', compact('diss_board_cat', 'diss_board', 'ban_user'));
    }
    public function addContentPg()
    {
        $role_id = Auth::user()->role_id;

        $diss_board_cat = DB::select("SELECT * FROM diss_board_cat WHERE role_ids LIKE '%$role_id%'");
        $diss_board = DB::select("SELECT diss_board.* FROM diss_board JOIN diss_board_cat ON diss_board_cat.id=diss_board.diss_board_cat_id WHERE diss_board_cat.role_ids LIKE '%$role_id%' AND diss_board.diss_board_privacy LIKE '%$role_id%'");

        return view('discussionBoard.newDiscussionBoard.addContent', compact('diss_board_cat', 'diss_board'));
    }

    public function addBoard(Request $request)
    {
        $user_id = Auth::user()->id;

        $title = $request['title'];
        $icon = 'far fa-file-alt';
        $diss_board_cat_id = $request['cat_id'];
        $diss_board_privacy = $request['privacy'];

        switch ($diss_board_privacy) {
            case 'admin':
                $diss_board_privacy = '1';
                break;
            case 'general':
                $diss_board_privacy = '0,1,2,3,4';
                break;
            case 'moderator':
                $diss_board_privacy = '1,4';
                break;
            case 'teacher':
                $diss_board_privacy = '1,3,4';
                break;
        }

        try {
            DB::insert("INSERT INTO diss_board (title, icon, diss_board_privacy, threads_count, messages_count, user_id, diss_board_cat_id, c_at, u_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)", [$title, $icon, $diss_board_privacy, 0, 0, $user_id, $diss_board_cat_id, now(), now()]);

            return response()->json([
                'success' => true,
                'message' => "Board successfully added!"
            ]);
        } catch (QueryException $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function contentSuggestionPg(Request $request)
    {
        if (!$request->has('board_id')) {
            return redirect()->back();
        }

        if (Auth::check()) {
            $user_id = Auth::user()->id;
        }

        $board_id = $request->get('board_id');

        $board = DB::select("select *, (select name from diss_board_cat where id=diss_board.diss_board_cat_id) as board_cat from diss_board where id=$board_id");
        if (!count($board)) {
            return redirect('/discussionBoard');
        }
        $board = $board[0];

        $tags = DB::select("SELECT * FROM tags");

        if (Auth::check()) {
            $ban_user = DB::select("select count(*) as ban from ban_users where user_id=? and ban_date is not null", [$user_id]);
            $ban_user = $ban_user[0]->ban;
        }

        $per_page = $this->thread_per_page;
        $offset = 0;

        // ===================
        // NEWEST THREADS
        // ===================
        $thread_total = DB::select("SELECT COUNT(*) AS total FROM diss_board_thread WHERE diss_board_id=$board_id and d_at is null ORDER BY c_at");
        $thread_total = $thread_total[0]->total;
        $thread_pages = ceil($thread_total / $per_page);

        if (Auth::check()) {
            $diss_board_thread = DB::select("select diss_board_thread.*,
            (select id from users where id=diss_board_thread.user_id) AS author_id,
            (select name from users where id=diss_board_thread.user_id) AS author,
            (select profile_pic_url from profiles where user_id=diss_board_thread.user_id) AS author_avatar,
            (select roles.name from users join roles on users.role_id=roles.id where users.id=user_id) AS role,
            (select count(*) from diss_board_pinned_thread where thread_id=diss_board_thread.id) as pinned,
            (select name from users where id=diss_board_thread.l_reply_user_id) AS l_reply_user,
            (select profile_pic_url from profiles where user_id=diss_board_thread.l_reply_user_id) AS l_reply_user_avatar
            from diss_board_thread where diss_board_id=$board_id and d_at is null order by pinned DESC, u_at DESC LIMIT $per_page OFFSET $offset");
        } else {
            $diss_board_thread = DB::select("  select diss_board_thread.*,
            (select id from users where id=diss_board_thread.user_id) AS author_id,
            (select name from users where id=diss_board_thread.user_id) AS author,
            (select profile_pic_url from profiles where user_id=diss_board_thread.user_id) AS author_avatar,
            (select roles.name from users join roles on users.role_id=roles.id where users.id=user_id) AS role,
            0 as pinned,
            (select name from users where id=diss_board_thread.l_reply_user_id) AS l_reply_user,
            (select profile_pic_url from profiles where user_id=diss_board_thread.l_reply_user_id) AS l_reply_user_avatar
            from diss_board_thread where diss_board_id=$board_id and d_at is null order by pinned DESC, u_at DESC LIMIT $per_page OFFSET $offset");
        }

        // ===================
        // FLAG THREADS
        // ===================
        if (Auth::check()) {
            $flag_threads_per_page = $this->flag_thread_per_page;

            $flag_threads_total = DB::select("select count(*) as total from diss_board_flag_threads dbft join diss_board_thread dbt on dbft.thread_id=dbt.id where dbft.user_id=$user_id AND dbt.diss_board_id=$board_id and dbt.d_at is null ");
            $flag_threads_total = $flag_threads_total[0]->total;
            $flag_threads_pages = ceil($flag_threads_total / $flag_threads_per_page);


            if(Auth::check() && Auth::user()->role_id == 1) {

            $flag_threads = DB::select("select dbt.*,
            (select name from users where id=dbt.user_id) AS author,
            (select profile_pic_url from profiles where user_id=dbt.user_id) AS author_avatar,
            (select roles.name from users join roles on users.role_id=roles.id where users.id=dbt.user_id) AS role,dbft.id as flagthreadid
            from diss_board_flag_threads dbft join diss_board_thread dbt on dbft.thread_id=dbt.id
            where  dbt.diss_board_id=$board_id and dbt.d_at is null order by dbt.c_at desc LIMIT $flag_threads_per_page OFFSET $offset");

            }
            else {
                $flag_threads = DB::select("select dbt.*,
                (select name from users where id=dbt.user_id) AS author,
                (select profile_pic_url from profiles where user_id=dbt.user_id) AS author_avatar,
                (select roles.name from users join roles on users.role_id=roles.id where users.id=dbt.user_id) AS role
                from diss_board_flag_threads dbft join diss_board_thread dbt on dbft.thread_id=dbt.id
                where dbft.user_id=$user_id and dbt.diss_board_id=$board_id and dbt.d_at is null order by dbt.c_at desc LIMIT $flag_threads_per_page OFFSET $offset");
            }



        } else {
            $flag_threads = [];
        }
        // ===================
        // WATCHED THREADS
        // ===================
        if (Auth::check()) {
            $watched_threads_per_page = $this->watched_thread_per_page;

            $watched_threads_total = DB::select("select count(*) as total from diss_board_watched_thread dbft join diss_board_thread dbt on dbft.thread_id=dbt.id where dbft.user_id=$user_id AND dbt.diss_board_id=$board_id and dbt.d_at is null");
            $watched_threads_total = $watched_threads_total[0]->total;
            $watched_threads_pages = ceil($watched_threads_total / $watched_threads_per_page);

            $watched_threads = DB::select("select dbt.*,
            (select name from users where id=dbt.user_id) AS author,
            (select profile_pic_url from profiles where user_id=dbt.user_id) AS author_avatar,
            (select roles.name from users join roles on users.role_id=roles.id where users.id=dbt.user_id) AS role
            from diss_board_watched_thread dbwt join diss_board_thread dbt on dbwt.thread_id=dbt.id
            where dbwt.user_id=$user_id AND dbt.diss_board_id=$board_id and dbt.d_at is null order by dbt.c_at desc LIMIT $watched_threads_per_page OFFSET $offset");
        } else {
            $watched_threads = [];
        }

        // ===================
        // YOUR POSTS
        // ===================
        if (Auth::check()) {

            $your_posts_per_page = $this->your_posts_per_page;

            $your_posts_total = DB::select("select count(*) as total from diss_board_thread_post dbtp join diss_board_thread dbt on dbtp.thread_id=dbt.id where dbtp.user_id=$user_id and dbt.diss_board_id=$board_id and dbt.d_at is null");
            $your_posts_total = $your_posts_total[0]->total;
            $your_posts_pages = ceil($your_posts_total / $your_posts_per_page);

            $your_posts = DB::select("select dbtp.*, (select title from diss_board_thread where id=dbtp.thread_id) as thread,
            (select name from users where id=dbtp.user_id) AS author,
            (select profile_pic_url from profiles where user_id=dbtp.user_id) AS author_avatar,
            (select roles.name from users join roles on users.role_id=roles.id where users.id=dbtp.user_id) AS role
            from diss_board_thread_post dbtp join diss_board_thread dbt on dbtp.thread_id=dbt.id where dbtp.user_id=$user_id and dbt.diss_board_id=$board_id and dbt.d_at is null order by dbtp.c_at desc LIMIT $your_posts_per_page OFFSET $offset");
        } else {
            $your_posts = [];
        }

        // ===================
        // FLAG POSTS
        // ===================
        if (Auth::check()) {

            $flagged_posts_per_page = $this->flagged_posts_per_page;

            $flagged_posts_total = DB::select("select count(*) as total from diss_board_flag_posts dbfp join diss_board_thread_post dbtp on dbfp.post_id=dbtp.id join diss_board_thread dbt on dbtp.thread_id=dbt.id where dbfp.user_id=$user_id and dbt.diss_board_id=$board_id and dbt.d_at is null and dbtp.d_at is null");
            $flagged_posts_total = $flagged_posts_total[0]->total;
            $flagged_posts_pages = ceil($flagged_posts_total / $flagged_posts_per_page);


            if(Auth::check() && Auth::user()->role_id == 1) {

               $flagged_posts = DB::select("select dbtp.*, (select title from diss_board_thread where id=dbtp.thread_id) as thread,
               (select name from users where id=dbtp.user_id) AS author,
               (select profile_pic_url from profiles where user_id=dbtp.user_id) AS author_avatar,
               (select roles.name from users join roles on users.role_id=roles.id where users.id=dbtp.user_id) AS role,
               (select name from users where id=dbfp.user_id) AS flagged_by, dbfp.id as flagid
               from diss_board_flag_posts dbfp
               join diss_board_thread_post dbtp on dbfp.post_id=dbtp.id
               join diss_board_thread dbt on dbtp.thread_id=dbt.id
               where dbt.diss_board_id=$board_id and dbt.d_at is null and dbtp.d_at is null order by dbtp.c_at desc
               LIMIT $flagged_posts_per_page OFFSET $offset");



            }

            else {


            $flagged_posts = DB::select("select dbtp.*, (select title from diss_board_thread where id=dbtp.thread_id) as thread,
            (select name from users where id=dbtp.user_id) AS author,
            (select profile_pic_url from profiles where user_id=dbtp.user_id) AS author_avatar,
            (select roles.name from users join roles on users.role_id=roles.id where users.id=dbtp.user_id) AS role,
            (select name from users where id=dbfp.user_id) AS flagged_by
            from diss_board_flag_posts dbfp join diss_board_thread_post dbtp on dbfp.post_id=dbtp.id join diss_board_thread dbt on dbtp.thread_id=dbt.id where dbfp.user_id=$user_id and dbt.diss_board_id=$board_id and dbt.d_at is null and dbtp.d_at is null order by dbtp.c_at desc LIMIT $flagged_posts_per_page OFFSET $offset");

            }





        } else {
            $flagged_posts = [];
        }

        foreach ($diss_board_thread as $threadKey => $threadValue) {
            $latestReplyUser = DB::table('diss_board_thread_post')
            ->where('thread_id',$threadValue->id)
            ->whereNull('d_at')
            ->orderBy('id','desc')->first();

            $threadValue->last_reply_user = isset($latestReplyUser->user_id) ? DB::table('users')->where('id',$latestReplyUser->user_id)->first()  :null;
            $threadValue->last_reply_post = isset($latestReplyUser->user_id) ? $latestReplyUser:null;
            $threadValue->last_reply_profile = isset($latestReplyUser->user_id) ? DB::table('profiles')->where('user_id',$latestReplyUser->user_id)->first():null;
        }

        //dd($diss_board_thread);

        return view('discussionBoard.newDiscussionBoard.contentSuggeestion', compact(
            'tags',
            'board',
            'ban_user',

            'thread_total',
            'thread_pages',
            'diss_board_thread',

            'flag_threads_total',
            'flag_threads_pages',
            'flag_threads',

            'watched_threads_total',
            'watched_threads_pages',
            'watched_threads',

            'your_posts_total',
            'your_posts_pages',
            'your_posts',

            'flagged_posts_total',
            'flagged_posts_pages',
            'flagged_posts'
        ));
    }

    public function contentSuggestionPagination(Request $request)
    {
        $page = $request['page'];
        $board_id = $request['board_id'];
        $user_id = Auth::user()->id;

        $per_page = $this->thread_per_page;
        $offset = ($page - 1) * $per_page;

        $thread_total = DB::select("SELECT COUNT(*) AS total FROM diss_board_thread WHERE diss_board_id=$board_id and d_at is null ORDER BY c_at");
        $thread_total = $thread_total[0]->total;
        $thread_pages = ceil($thread_total / $per_page);

        $threads = DB::select("select diss_board_thread.*,
        (select name from users where id=diss_board_thread.user_id) AS author,
        (select profile_pic_url from profiles where user_id=diss_board_thread.user_id) AS author_avatar,
        (select roles.name from users join roles on users.role_id=roles.id where users.id=user_id) AS role,
        (select count(*) from diss_board_pinned_thread where thread_id=diss_board_thread.id) as pinned,
        (select name from users where id=diss_board_thread.l_reply_user_id) AS l_reply_user,
        (select profile_pic_url from profiles where user_id=diss_board_thread.l_reply_user_id) AS l_reply_user_avatar
        from diss_board_thread where diss_board_id=$board_id and d_at is null order by pinned DESC, u_at desc LIMIT $per_page OFFSET $offset");

        return response()->json([
            'success' => true,
            'thread_total' => $thread_total,
            'thread_pages' => $thread_pages,
            'thread_active_page' => $page,
            'threads' => $threads,
        ]);
    }

    public function flagThreadPagination(Request $request)
    {
        $user_id = Auth::user()->id;

        $page = $request['page'];
        $board_id = $request['board_id'];

        $per_page = $this->flag_thread_per_page;
        $offset = ($page - 1) * $per_page;

        $flag_threads_total = DB::select("select count(*) as total from diss_board_flag_threads dbft join diss_board_thread dbt on dbft.thread_id=dbt.id where dbft.user_id=$user_id AND dbt.diss_board_id=$board_id and dbt.d_at is null");
        $flag_threads_total = $flag_threads_total[0]->total;
        $flag_threads_pages = ceil($flag_threads_total / $per_page);

        $flag_threads = DB::select("select dbt.*,
        (select name from users where id=dbt.user_id) AS author,
        (select profile_pic_url from profiles where user_id=dbt.user_id) AS author_avatar,
        (select roles.name from users join roles on users.role_id=roles.id where users.id=dbt.user_id) AS role
        from diss_board_flag_threads dbft join diss_board_thread dbt on dbft.thread_id=dbt.id
        where dbft.user_id=$user_id AND dbt.diss_board_id=$board_id and dbt.d_at is null order by dbt.c_at desc LIMIT $per_page OFFSET $offset");

        return response()->json([
            'success' => true,
            'flag_threads_total' => $flag_threads_total,
            'flag_threads_pages' => $flag_threads_pages,
            'flag_thread_active_page' => $page,
            'flag_threads' => $flag_threads,
        ]);
    }

    public function watchedThreadPagination(Request $request)
    {
        $user_id = Auth::user()->id;

        $page = $request['page'];
        $board_id = $request['board_id'];

        $per_page = $this->watched_thread_per_page;
        $offset = ($page - 1) * $per_page;

        $watched_threads_total = DB::select("select count(*) as total from diss_board_watched_thread dbft join diss_board_thread dbt on dbft.thread_id=dbt.id where dbft.user_id=$user_id AND dbt.diss_board_id=$board_id and dbt.d_at is null");
        $watched_threads_total = $watched_threads_total[0]->total;
        $watched_threads_pages = ceil($watched_threads_total / $per_page);

        $watched_threads = DB::select("select dbt.*,
        (select name from users where id=dbt.user_id) AS author,
        (select profile_pic_url from profiles where user_id=dbt.user_id) AS author_avatar,
        (select roles.name from users join roles on users.role_id=roles.id where users.id=dbt.user_id) AS role
        from diss_board_watched_thread dbwt join diss_board_thread dbt on dbwt.thread_id=dbt.id
        where dbwt.user_id=$user_id AND dbt.diss_board_id=$board_id and dbt.d_at is null order by dbt.c_at desc LIMIT $per_page OFFSET $offset");

        return response()->json([
            'success' => true,
            'watched_threads_total' => $watched_threads_total,
            'watched_threads_pages' => $watched_threads_pages,
            'watched_thread_active_page' => $page,
            'watched_threads' => $watched_threads,
        ]);
    }

    public function yourPostPagination(Request $request)
    {
        $user_id = Auth::user()->id;

        $page = $request['page'];
        $board_id = $request['board_id'];

        $per_page = $this->your_posts_per_page;
        $offset = ($page - 1) * $per_page;

        $your_posts_total = DB::select("select count(*) as total from diss_board_thread_post dbtp join diss_board_thread dbt on dbtp.thread_id=dbt.id where dbtp.user_id=$user_id and dbt.diss_board_id=$board_id and dbt.d_at is null");
        $your_posts_total = $your_posts_total[0]->total;
        $your_posts_pages = ceil($your_posts_total / $per_page);

        $your_posts = DB::select("select dbtp.*, (select title from diss_board_thread where id=dbtp.thread_id) as thread,
        (select name from users where id=dbtp.user_id) AS author,
        (select profile_pic_url from profiles where user_id=dbtp.user_id) AS author_avatar,
        (select roles.name from users join roles on users.role_id=roles.id where users.id=dbtp.user_id) AS role
        from diss_board_thread_post dbtp join diss_board_thread dbt on dbtp.thread_id=dbt.id where dbtp.user_id=$user_id and dbt.diss_board_id=$board_id and dbt.d_at is null order by dbtp.c_at desc LIMIT $per_page OFFSET $offset");

        return response()->json([
            'success' => true,
            'your_posts_total' => $your_posts_total,
            'your_posts_pages' => $your_posts_pages,
            'your_posts_active_page' => $page,
            'your_posts' => $your_posts,
        ]);
    }

    public function flagPostPagination(Request $request)
    {
        $user_id = Auth::user()->id;

        $page = $request['page'];
        $board_id = $request['board_id'];

        $per_page = $this->flagged_posts_per_page;
        $offset = ($page - 1) * $per_page;

        $flagged_posts_total = DB::select("select count(*) as total from diss_board_flag_posts dbfp join diss_board_thread_post dbtp on dbfp.post_id=dbtp.id join diss_board_thread dbt on dbtp.thread_id=dbt.id where dbfp.user_id=$user_id and dbt.diss_board_id=$board_id and dbt.d_at is null");
        $flagged_posts_total = $flagged_posts_total[0]->total;
        $flagged_posts_pages = ceil($flagged_posts_total / $per_page);

        $flagged_posts = DB::select("select dbtp.*, (select title from diss_board_thread where id=dbtp.thread_id) as thread,
        (select name from users where id=dbtp.user_id) AS author,
        (select profile_pic_url from profiles where user_id=dbtp.user_id) AS author_avatar,
        (select roles.name from users join roles on users.role_id=roles.id where users.id=dbtp.user_id) AS role,
        (select name from users where id=dbfp.user_id) AS flagged_by
        from diss_board_flag_posts dbfp join diss_board_thread_post dbtp on dbfp.post_id=dbtp.id join diss_board_thread dbt on dbtp.thread_id=dbt.id where dbfp.user_id=$user_id and dbt.diss_board_id=$board_id and dbt.d_at is null order by dbtp.c_at desc LIMIT $per_page OFFSET $offset");

        return response()->json([
            'success' => true,
            'flagged_posts_total' => $flagged_posts_total,
            'flagged_posts_pages' => $flagged_posts_pages,
            'flagged_posts_active_page' => $page,
            'flagged_posts' => $flagged_posts,
        ]);
    }


    public function postThread(Request $request)
    {
        $user_id = Auth::user()->id;

        $title = $request['title'];
        $body = $request['body'];
        $diss_board_id = $request['board_id'];
        $id = $request['thread_id'];

        // $tags = $request['tags'];
        // $tags = json_decode($tags, true);
        // $tags = "," . join(",", $tags) . ",";

        try {
            if ($id) {

                DB::update("update diss_board_thread set title='$title', u_at=? where id = ?", [now(), $id]);
                DB::update("update diss_board set u_at=? where id = ?", [now(), $diss_board_id]);

            //     if ($body) {
            //         DB::update("update diss_board_thread set title='$title', body='$body', u_at=? where id = ?", [now(), $id]);
            //     } else {
            //         DB::update("update diss_board_thread set title='$title', u_at=? where id = ?", [now(), $id]);
            //    }

                return response()->json([
                    'success' => true,
                    'message' => "Thread updated successfully!"
                ]);
            }

            DB::insert("INSERT INTO diss_board_thread (title, body, user_id, diss_board_id, replies_count, views_count, c_at, u_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)", [$title, $body, $user_id, $diss_board_id, 0, 0, now(), now()]);

            $lastId = DB::getPdo()->lastInsertId();

            DB::insert("INSERT INTO inet_stage.diss_board_thread_post (body, thread_id, user_id, c_at, u_at)
            VALUES(?,?,?,?,? )", [$body,  $lastId, $user_id, now(), now()]);

            $this->boardThreadPostCount($diss_board_id);
            DB::update("update diss_board set u_at=? where id = ?", [now(), $diss_board_id]);

            return response()->json([
                'success' => true,
                'message' => "Thread successfully added!"
            ]);
        } catch (QueryException $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function thread_posts(Request $request)
    {

        if (!$request->has('thread_id')) {
            return redirect()->back();
        }

        $diss_board_cat = [];
        $diss_board = [];

        if (Auth::check()) {
            $role_id = Auth::user()->role_id;
            $user_id = Auth::user()->id;

            $diss_board_cat = DB::select("SELECT * FROM diss_board_cat WHERE role_ids LIKE '%$role_id%'");
            $diss_board = DB::select("SELECT diss_board.* FROM diss_board JOIN diss_board_cat ON diss_board_cat.id=diss_board.diss_board_cat_id WHERE diss_board_cat.role_ids LIKE '%$role_id%'");

            $ban_user = DB::select("select count(*) as ban from ban_users where user_id=? and ban_date is not null", [$user_id]);
            $ban_user = $ban_user[0]->ban;

            if ($request->has('notification_id')) {
                $notification_id = $request->get('notification_id');
                DB::update('update notifications set `read`=1 where id=?', [$notification_id]);
            }
        }

        $thread_id = $request->get('thread_id');
        $board_id = $request->get('board_id');
        $board = DB::select("select * from diss_board where id=$board_id");
        $board = $board[0];
        $thread = DB::select("SELECT dbt.*, (SELECT name FROM users WHERE id=dbt.user_id) AS author,
        (SELECT count(*) FROM diss_board_thread_post WHERE user_id=dbt.user_id and d_at is null) AS author_post,
        (SELECT created_at FROM users WHERE id=dbt.user_id) AS author_joined,
        (SELECT profile_pic_url FROM profiles WHERE user_id=dbt.user_id) AS author_avatar,
        (SELECT roles.name FROM users JOIN roles ON users.role_id=roles.id WHERE users.id=dbt.user_id) AS role,
        (SELECT name FROM users WHERE id=dbt.l_reply_user_id) AS l_reply_user,
        (SELECT profile_pic_url FROM profiles WHERE user_id=dbt.l_reply_user_id) AS l_reply_user_avatar
        FROM diss_board_thread dbt WHERE dbt.id=$thread_id AND dbt.diss_board_id=$board_id and dbt.d_at is null");

        if (!count($thread)) {
            return redirect('/contentSuggestion?board_id=' . $board_id);
        }

        $thread = $thread[0];

        $per_page = $this->post_per_page;
        $offset = 0;

        $thread_posts_total = DB::select("SELECT COUNT(*) AS total FROM diss_board_thread_post WHERE thread_id=$thread_id and d_at is null ORDER BY c_at");
        $thread_posts_total = $thread_posts_total[0]->total;
        $thread_posts_pages = ceil($thread_posts_total / $per_page);

        $thread_posts = DB::select("select dbtp.*,
        (select name from users where id=dbtp.user_id) AS author,
        (select profile_pic_url from profiles where user_id=dbtp.user_id) AS author_avatar,
        (select roles.name from users JOIN roles ON users.role_id=roles.id WHERE users.id=dbtp.user_id) AS author_role,
        (select created_at from users where id=dbtp.user_id) AS author_joined,
        (select count(*) from diss_board_thread_post where user_id=dbtp.user_id and d_at is null) AS author_posts,
        (select count(*) from likes where post_id=dbtp.id AND thumbup=1) AS thumbup_count,
        (select count(*) from likes where post_id=dbtp.id AND smiley=1) AS smiley_count,
        (select count(*) from likes where post_id=dbtp.id AND info=1) AS info_count,
        (select count(*) from likes where post_id=dbtp.id AND agree=1) AS agree_count,
        (select count(*) from likes where post_id=dbtp.id AND respectfully_disagree=1) AS respectfully_disagree_count,
        (select diss_board_ranks.rank from diss_board_ranks join user_rank_mapping on diss_board_ranks.id=user_rank_mapping.rank_id where user_rank_mapping.user_id=dbtp.user_id) AS rank,
        (select diss_board_ranks.image from diss_board_ranks join user_rank_mapping on diss_board_ranks.id=user_rank_mapping.rank_id where user_rank_mapping.user_id=dbtp.user_id) AS rank_image,
        (select body from diss_board_thread_post where id=dbtp.repied_on_post_id) AS repied_post,
        (select users.name from diss_board_thread_post join users on diss_board_thread_post.user_id=users.id where diss_board_thread_post.id=dbtp.repied_on_post_id) AS repied_post_author
        from diss_board_thread_post dbtp where thread_id=? and d_at is null order by c_at asc limit $per_page offset $offset", [$thread_id]);

        // TRACK WATCHED THREAD
        // if (Auth::check()) {
        //     $checkIfAlreadyWatched = DB::select('select id from diss_board_watched_thread where thread_id=? and user_id=?', [$thread_id, $user_id]);
        //     if (!count($checkIfAlreadyWatched)) {
        //         DB::insert('insert into diss_board_watched_thread (thread_id, user_id) values (?, ?)', [$thread_id, $user_id]);
        //     }
        // }

        $views_count = DB::select('select count(id) as views_count from diss_board_watched_thread where thread_id=?', [$thread_id]);

        DB::update("update diss_board_thread set views_count=? where id=?", [$views_count[0]->views_count, $thread_id]);

        return view('discussionBoard.newDiscussionBoard.post', compact(
            'ban_user',
            'thread',
            'thread_posts',
            'thread_posts_total',
            'thread_posts_pages',
            'diss_board_cat',
            'diss_board',
            'board'
        ));
    }

    public function thread_post_pagination(Request $request)
    {
        $page = $request['page'];
        $thread_id = $request['thread_id'];

        $per_page = $this->post_per_page;;
        $offset = ($page - 1) * $per_page;

        $thread_posts_total = DB::select("SELECT COUNT(*) AS total FROM diss_board_thread_post WHERE thread_id=$thread_id and d_at is null ORDER BY c_at");
        $thread_posts_total = $thread_posts_total[0]->total;
        $thread_posts_pages = ceil($thread_posts_total / $per_page);

        $thread_posts = DB::select("select dbtp.*,
        (select name from users where id=dbtp.user_id) AS author,
        (select profile_pic_url from profiles where user_id=dbtp.user_id) AS author_avatar,
        (select roles.name from users JOIN roles ON users.role_id=roles.id WHERE users.id=dbtp.user_id) AS author_role,
        (select created_at from users where id=dbtp.user_id) AS author_joined,
        (select count(*) from diss_board_thread_post where user_id=dbtp.user_id and d_at is null) AS author_posts,
        (select count(*) from likes where post_id=dbtp.id AND thumbup=1) AS thumbup_count,
        (select count(*) from likes where post_id=dbtp.id AND smiley=1) AS smiley_count,
        (select count(*) from likes where post_id=dbtp.id AND info=1) AS info_count,
        (select count(*) from likes where post_id=dbtp.id AND agree=1) AS agree_count,
        (select count(*) from likes where post_id=dbtp.id AND respectfully_disagree=1) AS respectfully_disagree_count,
        (select diss_board_ranks.rank from diss_board_ranks join user_rank_mapping on diss_board_ranks.id=user_rank_mapping.rank_id where user_rank_mapping.user_id=dbtp.user_id) AS rank,
        (select diss_board_ranks.image from diss_board_ranks join user_rank_mapping on diss_board_ranks.id=user_rank_mapping.rank_id where user_rank_mapping.user_id=dbtp.user_id) AS rank_image,
        (select body from diss_board_thread_post where id=dbtp.repied_on_post_id) AS repied_post,
        (select users.name from diss_board_thread_post join users on diss_board_thread_post.user_id=users.id where diss_board_thread_post.id=dbtp.repied_on_post_id) AS repied_post_author
        from diss_board_thread_post dbtp where thread_id=? and d_at is null order by c_at asc limit $per_page offset $offset", [$thread_id]);

        return response()->json([
            'success' => true,
            'thread_posts_total' => $thread_posts_total,
            'thread_posts_pages' => $thread_posts_pages,
            'thread_posts_active_page' => $page,
            'thread_posts' => $thread_posts,
        ]);
    }

    public function thread_post_pagination_last(Request $request)
    {
        $page = $request['page'];
        $thread_id = $request['thread_id'];

        $per_page = $this->post_per_page;
        $offset = ($page - 1) * $per_page;

        $thread_posts_total = DB::select("SELECT COUNT(*) AS total FROM diss_board_thread_post WHERE thread_id=$thread_id and d_at is null ORDER BY c_at");
        $thread_posts_total = $thread_posts_total[0]->total;
        $thread_posts_pages = ceil($thread_posts_total / $per_page);

        $thread_posts = DB::select("select dbtp.*,
        (select name from users where id=dbtp.user_id) AS author,
        (select profile_pic_url from profiles where user_id=dbtp.user_id) AS author_avatar,
        (select roles.name from users JOIN roles ON users.role_id=roles.id WHERE users.id=dbtp.user_id) AS author_role,
        (select created_at from users where id=dbtp.user_id) AS author_joined,
        (select count(*) from diss_board_thread_post where user_id=dbtp.user_id and d_at is null) AS author_posts,
        (select count(*) from likes where post_id=dbtp.id AND thumbup=1) AS thumbup_count,
        (select count(*) from likes where post_id=dbtp.id AND smiley=1) AS smiley_count,
        (select count(*) from likes where post_id=dbtp.id AND info=1) AS info_count,
        (select count(*) from likes where post_id=dbtp.id AND agree=1) AS agree_count,
        (select count(*) from likes where post_id=dbtp.id AND respectfully_disagree=1) AS respectfully_disagree_count,
        (select diss_board_ranks.rank from diss_board_ranks join user_rank_mapping on diss_board_ranks.id=user_rank_mapping.rank_id where user_rank_mapping.user_id=dbtp.user_id) AS rank,
        (select diss_board_ranks.image from diss_board_ranks join user_rank_mapping on diss_board_ranks.id=user_rank_mapping.rank_id where user_rank_mapping.user_id=dbtp.user_id) AS rank_image,
        (select body from diss_board_thread_post where id=dbtp.repied_on_post_id) AS repied_post,
        (select users.name from diss_board_thread_post join users on diss_board_thread_post.user_id=users.id where diss_board_thread_post.id=dbtp.repied_on_post_id) AS repied_post_author
        from diss_board_thread_post dbtp where thread_id=? and d_at is null order by dbtp.id desc limit 10", [$thread_id]);

        return response()->json([
            'success' => true,
            'thread_posts_total' => $thread_posts_total,
            'thread_posts_pages' => $thread_posts_pages,
            'thread_posts_active_page' => $page,
            'thread_posts' => $thread_posts,
        ]);
    }


    public function diss_thread_posts(Request $request)
    {
        $user_id = Auth::user()->id;
        $page = $request['page'] ?? 1;
        $board_id = $request['board_id'];
        $thread_id = $request['thread_id'];
        $post_id = $request['post_id'];
        $body = $request['body'];
        $repied_on_post_id = $request['repied_on_post_id'];
        $timestamp = now();


        $per_page = $this->post_per_page;
        $offset = ($page - 1) * $per_page;



        if ($post_id != null || $post_id != "") {
 		
            DB::update("UPDATE diss_board_thread_post set body = '$body', u_at = '$timestamp' WHERE id=$post_id");
            DB::update("update diss_board set u_at=? where id = ?", [now(), $board_id]);

            $thread_posts_total = DB::select("SELECT COUNT(*) AS total FROM diss_board_thread_post WHERE thread_id=$thread_id and d_at is null ORDER BY c_at");
            $thread_posts_total = $thread_posts_total[0]->total;
            $thread_posts_pages = ceil($thread_posts_total / $per_page);

            $page_html = "";
            if ($thread_posts_pages > 1){
                $page_html .=`<ul class="pagination font-familyAtlasGrotesk-Regular text-colorblue100 font-size12px" id="post_pagination">
                  <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1"><i class="fas fa-arrow-left"></i></a></li>
                `;
                    for ($i=0; $i < $thread_posts_pages; $i++) {
                        $page = $i + 1;
                        $default_active = $page == 1 ? 'active disabled' : '';
                        $page_html.= "<li class='page-item $default_active' ><a class='page-link' onclick='change_thread_post_page($page)'>$page</a></li>";
                    }

                $page_html .= `<li class="page-item"><a class="page-link" onclick='change_thread_post_page(2)'><i class="fas fa-arrow-right"></i></a></li>
                </ul>`;
            }

            return response([
                'message'=>'Post successfully updated!',
                'body'=>$body,
                'post_id'=>$post_id,
                'goto'=>false,
                'page_html'=>$page_html,
                'last_page' => $thread_posts_pages
  	     ],200);
        }

        if ($repied_on_post_id != null || $repied_on_post_id != "") {
            DB::insert("INSERT INTO notifications (post_id, replied_by_u_id) VALUES (?, ?)", [$repied_on_post_id, $user_id]);
             DB::update("update diss_board set u_at=? where id = ?", [now(), $board_id]);

        }

        try {
            DB::insert("INSERT INTO diss_board_thread_post (body, thread_id, user_id, repied_on_post_id, c_at, u_at)
            VALUES (?, ?, ?, ?, ?, ?)", [$body, $thread_id, $user_id, $repied_on_post_id, now(), now()]);

            DB::update("UPDATE diss_board_thread set l_reply_user_id = $user_id, l_reply_at = '$timestamp' , u_at ='$timestamp' WHERE id = $thread_id");
            DB::update("update diss_board set u_at=? where id = ?", [now(), $board_id]);

            $this->threadPostCount($thread_id);
            $this->boardThreadPostCount($board_id);

            $thread_posts_total = DB::select("SELECT COUNT(*) AS total FROM diss_board_thread_post WHERE thread_id=$thread_id and d_at is null ORDER BY c_at");
            $thread_posts_total = $thread_posts_total[0]->total;
            $thread_posts_pages = ceil($thread_posts_total / $per_page);

            $page_html = "";
            if ($thread_posts_pages > 1){
                $page_html .=`<ul class="pagination font-familyAtlasGrotesk-Regular text-colorblue100 font-size12px" id="post_pagination">
                  <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1"><i class="fas fa-arrow-left"></i></a></li>
                `;
                    for ($i=0; $i < $thread_posts_pages; $i++) {
                        $page = $i + 1;
                        $default_active = $page == 1 ? 'active disabled' : '';
                        $page_html.= "<li class='page-item $default_active' ><a class='page-link' onclick='change_thread_post_page($page)'>$page</a></li>";
                    }

                $page_html .= `<li class="page-item"><a class="page-link" onclick='change_thread_post_page(2)'><i class="fas fa-arrow-right"></i></a></li>
                </ul>`;
            }

		return response([
			'message'=>'Post successfully added!',
			'goto'=>true,
            		'page_html'=>$page_html,
           		'last_page' => $thread_posts_pages
		],200);
        } catch (QueryException $ex) {
            return response([
                'message'=> $ex->getMessage()
            ],400);
        }
    }


    public function likepost(Request $request)
    {
        $user_id = Auth::user()->id;
        $post_id = $request['post_id'];
        $like_type = $request['like_type'];

        $getPostById = DB::table('diss_board_thread_post')->where('id', $post_id)->first();

        // code by javed abbasi
        if (!empty($getPostById)) {
           // check if post_user id and auth id same then return error message
           if ($getPostById->user_id == $user_id) {
               return $this->checkUserLikes($user_id,$post_id,$like_type,$request);
           }
        }

        // check if social type and db  type same
       $checkLikeType = DB::table('likes')->where('user_id', $user_id)
       ->where('post_id', $post_id)
       ->where($like_type,1)
       ->count();

       if ( $checkLikeType > 0 ) {
          return  $this->unlikePost($user_id,$post_id,$like_type,$request);
       }

       // end

        $check = DB::select("SELECT id FROM likes WHERE user_id=? AND post_id=?", [$user_id, $post_id]);

        try {
            if (count($check)) {
                DB::delete('delete from likes where id = ?', [$check[0]->id]);
                DB::insert("INSERT INTO likes (post_id, user_id, $like_type) VALUES (?, ?, ?)", [$post_id, $user_id, 1]);
            } else {
                DB::insert("INSERT INTO likes (post_id, user_id, $like_type) VALUES (?, ?, ?)", [$post_id, $user_id, 1]);
            }

            $_check = DB::select("SELECT id FROM notifications WHERE post_id=? AND liked_by_u_id=?", [$post_id, $user_id]);

            if (count($_check)) {
                DB::delete('delete from notifications where id = ?', [$_check[0]->id]);
                DB::insert("INSERT INTO notifications (post_id, liked_by_u_id, reaction) VALUES (?, ?, ?)", [$post_id, $user_id, $like_type]);
            } else {
                DB::insert("INSERT INTO notifications (post_id, liked_by_u_id, reaction) VALUES (?, ?, ?)", [$post_id, $user_id, $like_type]);
            }

            $likes_count = DB::select("select count(*) as count from likes where post_id=?", [$post_id]);
            $likes_count = $likes_count[0]->count;

            $like_types = DB::select("select sum(thumbup) thumbup, sum(smiley) smiley, sum(info) info, sum(agree) agree, sum(respectfully_disagree) respectfully_disagree from likes where post_id=?", [$post_id]);
            $like_types = $like_types[0];

            return response()->json([
                'success' => true,
                'post_id' => $post_id,
                'like_types' => $like_types,
                'likes_count' => $likes_count
            ]);
        } catch (QueryException $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }


    public function movethread(Request $request)
    {
        $new_board_id = (int)$request['board_id'];
        $thread_id = (int)$request['thread_id'];

        $diss_board_thread = DB::select("SELECT * FROM diss_board_thread WHERE id=?", [$thread_id]);
        $diss_board_thread_old_id = $diss_board_thread[0]->diss_board_id;

        try {
            if (count($diss_board_thread)) {
                DB::update("UPDATE diss_board_thread set diss_board_id = $new_board_id WHERE id = ?", [$diss_board_thread[0]->id]);

                $this->boardThreadPostCount($new_board_id);
                $this->boardThreadPostCount($diss_board_thread_old_id);

                return response()->json([
                    'success' => true
                ]);
            } else {
                return response()->json([
                    'success' => false
                ]);
            }
        } catch (QueryException $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function flagthread(Request $request)
    {
        $thread_id = (int)$request['thread_id'];
        $user_id = Auth::user()->id;

        $check = DB::select("SELECT * FROM diss_board_flag_threads WHERE thread_id=? and user_id=?", [$thread_id, $user_id]);

        try {
            if (!count($check)) {
                DB::insert("INSERT INTO diss_board_flag_threads (thread_id, user_id) VALUES (?, ?)", [$thread_id, $user_id]);
                return response()->json([
                    'success' => true,
                    'message' => "Thread flagged successfully!"
                ]);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => "Thread already flagged!"
                ]);
            }
        } catch (QueryException $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function pinnedthread(Request $request)
    {
        $thread_id = (int)$request['thread_id'];
        $user_id = Auth::user()->id;

        $check = DB::select("SELECT * FROM diss_board_pinned_thread WHERE thread_id=? and user_id=?", [$thread_id, $user_id]);

        try {
            if (!count($check)) {
                DB::insert("INSERT INTO diss_board_pinned_thread (thread_id, user_id) VALUES (?, ?)", [$thread_id, $user_id]);
                return response()->json([
                    'success' => true,
                    'message' => "Thread pinned successfully!"
                ]);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => "Thread already pinned!"
                ]);
            }
        } catch (QueryException $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function unpinnedthread(Request $request)
    {
        $thread_id = (int)$request['thread_id'];


        try {
            DB::table('diss_board_pinned_thread')->where('thread_id', $thread_id)->delete();

                // DB::delete("DELETE diss_board_pinned_thread WHERE thread_id=?", [$thread_id]);
                return response()->json([
                    'success' => true,
                    'message' => "Thread unpinned successfully!"
                ]);

        } catch (QueryException $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ]);
        }
    }


    public function deletethread(Request $request)
    {
        $thread_id = (int)$request['thread_id'];
        $board_id = (int)$request['board_id'];
        $user_id = Auth::user()->id;

        $check = DB::select("select * from diss_board_thread where id=?", [$thread_id]);
        $postth= DB::select("select * from diss_board_thread_post where thread_id=?", [$thread_id]);

        if (!count($check)) {
            return response()->json([
                'success' => false,
                'message' => "Thread not found!",
            ]);
        }

        try {
            DB::update('update diss_board_thread set d_at=?, d_by=? where id=?', [now(), $user_id, $thread_id]);
            DB::update('update diss_board_thread_post set d_at=?, d_by=? where thread_id=?', [now(), $user_id, $thread_id]);

            $this->boardThreadPostCount($board_id);

            return response()->json([
                'success' => true,
                'message' => "Thread deleted successfully!"
            ]);
        } catch (QueryException $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function closethread(Request $request)
    {
        $thread_id = (int)$request['thread_id'];

        $check = DB::select("select * from diss_board_thread where id=?", [$thread_id]);

        if (!count($check)) {
            return response()->json([
                'success' => false,
                'message' => "Thread not found!",
            ]);
        }

        try {
            DB::update('update diss_board_thread set closed_at=? where id=?', [now(), $thread_id]);

            return response()->json([
                'success' => true,
                'message' => "Thread closed successfully!"
            ]);
        } catch (QueryException $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function unclosethread(Request $request)
    {
        $thread_id = (int)$request['thread_id'];

        $check = DB::select("select * from diss_board_thread where id=?", [$thread_id]);

        if (!count($check)) {
            return response()->json([
                'success' => false,
                'message' => "Thread not found!",
            ]);
        }

        try {
            DB::update('update diss_board_thread set closed_at=? where id=?', [null, $thread_id]);

            return response()->json([
                'success' => true,
                'message' => "Thread closed successfully!"
            ]);
        } catch (QueryException $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ]);
        }
    }

    private function boardThreadPostCount($board_id)
    {
        try {
            $threads_count = DB::select('select count(*) as total from diss_board_thread where diss_board_id = ? and d_at is null', [$board_id]);
            $threads_count = $threads_count[0]->total;
            $post_count = DB::select("select count(*) as total from diss_board_thread_post join diss_board_thread on diss_board_thread_post.thread_id=diss_board_thread.id where diss_board_thread.diss_board_id=? and diss_board_thread.d_at is null and diss_board_thread_post.d_at is null", [$board_id]);
            $post_count = $post_count[0]->total;

            DB::update("UPDATE diss_board set threads_count = $threads_count, messages_count = $post_count WHERE id = ?", [$board_id]);

            return true;
        } catch (QueryException $ex) {
            return false;
        }
    }

    private function threadPostCount($thread_id)
    {
        try {
            $replies_count = DB::select("select count(*) as total from diss_board_thread_post where thread_id = ? and d_at is null", [$thread_id]);
            $replies_count = $replies_count[0]->total;

            DB::update("UPDATE diss_board_thread set replies_count = $replies_count WHERE id = $thread_id");

            return true;
        } catch (QueryException $ex) {
            return false;
        }
    }


    public function ban_user(Request $request)
    {
        $user_id = Auth::user()->id;
        $ban_user_id = (int)$request['ban_user_id'];
        $ban_user_body = $request['ban_user_body'];

        $check = DB::select("select * from ban_users where user_id=$ban_user_id");

        if (count($check)) {
            try {
                DB::update("update ban_users set user_id=?, ban_date=?, unban_date=null, ban_reason=?, ban_by=? where id=?", [$ban_user_id, now(), $ban_user_body, $user_id, $check[0]->id]);
            } catch (QueryException $ex) {
                return response()->json([
                    'success' => false,
                    'message' => $ex->getMessage()
                ]);
            }
        } else {
            try {
                DB::insert("insert into ban_users (user_id, ban_date, ban_reason, ban_by) values (?, ?, ?, ?)", [$ban_user_id, now(), $ban_user_body, $user_id]);
            } catch (QueryException $ex) {
                return response()->json([
                    'success' => false,
                    'message' => $ex->getMessage()
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => "User ban successfully!"
        ]);
    }

    public function flagpost(Request $request)
    {
        $post_id = (int)$request['post_id'];
        $user_id = Auth::user()->id;

        $check = DB::select("SELECT * FROM diss_board_flag_posts WHERE post_id=? and user_id=?", [$post_id, $user_id]);

        try {
            if (!count($check)) {
                DB::insert("INSERT INTO diss_board_flag_posts (post_id, user_id) VALUES (?, ?)", [$post_id, $user_id]);
                return response()->json([
                    'success' => true,
                    'message' => "Post flagged successfully!"
                ]);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => "Post already flagged!"
                ]);
            }
        } catch (QueryException $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function getThreads($board_id)
    {
        $threads = DB::select("select diss_board_thread.*,
        (select name from users where id=diss_board_thread.user_id) AS author,
        (select profile_pic_url from profiles where user_id=diss_board_thread.user_id) AS author_avatar
        from diss_board_thread where diss_board_id=? and d_at is null order by c_at desc", [$board_id]);

        return response()->json([
            'success' => true,
            'threads' => $threads
        ]);
    }
    public function movepost(Request $request)
    {
        $board_id = (int)$request['board_id'];
        $thread_id = (int)$request['thread_id'];
        $post_id = (int)$request['post_id'];

        $post = DB::select("select dbt.diss_board_id, dbtp.thread_id from diss_board_thread_post dbtp join diss_board_thread dbt on dbtp.thread_id=dbt.id where dbtp.id=?", [$post_id]);

        $old_board_id = $post[0]->diss_board_id;
        $old_thread_id = $post[0]->thread_id;

        try {
            DB::update("update diss_board_thread_post set thread_id=$thread_id where id = ?", [$post_id]);

            $this->threadPostCount($thread_id);
            $this->boardThreadPostCount($board_id);

            $this->threadPostCount($old_thread_id);
            $this->boardThreadPostCount($old_board_id);

            return response()->json([
                'success' => true,
                'message' => "Post successfully moved!"
            ]);
        } catch (QueryException $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function deletepost(Request $request)
    {
        $post_id = (int)$request['post_id'];
        $user_id = Auth::user()->id;

        $post = DB::select("select dbt.diss_board_id, dbtp.thread_id from diss_board_thread_post dbtp join diss_board_thread dbt on dbtp.thread_id=dbt.id where dbtp.id=?", [$post_id]);

        $board_id = $post[0]->diss_board_id;
        $thread_id = $post[0]->thread_id;

        try {

            DB::update("update diss_board_thread_post set d_at=?, d_by=? where id = ?", [now(), $user_id, $post_id]);

            $this->boardThreadPostCount($board_id);
            $this->threadPostCount($thread_id);

            return response()->json([
                'success' => true,
                'message' => "Post successfully deleted!"
            ]);
        } catch (QueryException $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function banuserdetails($user_id)
    {
        $banuserdetails = DB::select("select name, created_at, (select name from roles where id=users.role_id) as role,
        (select profile_pic_url from profiles WHERE user_id=users.id) as profile_pic_url,
        (select count(*) from diss_board_thread_post WHERE user_id=users.id and d_at is null) as posts
        from users where id=?", [$user_id]);

        $banuserdetails = $banuserdetails[0];

        return response()->json($banuserdetails);
    }

    public function messages()
    {
        $user_id = Auth::user()->id;
        $users = DB::select("select *,
        (select message from chat_message where chat_message.thread_id=chat_threads.id order by id desc limit 1) as latest_message,
        (select MAX(c_at) from chat_message where chat_message.thread_id=chat_threads.id) as latest_message_tstamp,
        (select name from users where id=user_1) as user_1_name,
        (select name from users where id=user_2) as user_2_name,
        (select profile_pic_url from profiles where user_id=user_1) as user_1_avatar,
        (select profile_pic_url from profiles where user_id=user_2) as user_2_avatar,
        (select roles.name from users JOIN roles ON users.role_id=roles.id WHERE users.id=user_1) AS user_1_role,
        (select roles.name from users JOIN roles ON users.role_id=roles.id WHERE users.id=user_2) AS user_2_role
        from chat_threads where user_1=$user_id or user_2=$user_id order by latest_message_tstamp desc");


        $chatted_user_list = [$user_id];

        foreach ($users as $user) {
            if ($user->user_1 != $user_id) {
                $chatted_user_list[] = $user->user_1;
            } else {
                $chatted_user_list[] = $user->user_2;
            }
        }

        $sqlArray = '(' . join(',', $chatted_user_list) . ')';

        $not_chatted_user = DB::select("select u.id, u.name,
        (select roles.name from users JOIN roles ON users.role_id=roles.id WHERE users.id=u.id) AS role,
        (select profile_pic_url from profiles where user_id=u.id) as avatar
        from users u where u.id not in $sqlArray");

        return view('discussionBoard.newDiscussionBoard.messages', compact('users', 'not_chatted_user'));
    }

    public function thread_messages($thread_id)
    {
        $user_id = Auth::user()->id;

        $today_chats = DB::select("select * from chat_message where thread_id=? and DATE(c_at)=CURDATE()", [$thread_id]);
        $yesterday_chats = DB::select("select * from chat_message where thread_id=? and DATE(c_at)=DATE_SUB(CURRENT_DATE(),INTERVAL 1 DAY)", [$thread_id]);
        $previous_chats = DB::select("select * from chat_message where thread_id=? and DATE(c_at)!=DATE_SUB(CURRENT_DATE(),INTERVAL 1 DAY) and DATE(c_at)!=CURDATE()", [$thread_id]);

        DB::update('update chat_message set `read`=1 where thread_id=? and user_id!=?', [$thread_id, $user_id]);

        return response()->json([
            'success' => true,
            'today_chats' => $today_chats,
            'yesterday_chats' => $yesterday_chats,
            'previous_chats' => $previous_chats,
        ]);
    }

    public function thread_messages_post(Request $request)
    {
        $user_id = Auth::user()->id;
        $thread_id = (int)$request['thread_id'];
        $message = $request['msg'];

        $attachImage = $request['attachImage'];
        $attachFile = $request['attachFile'];

        $attachImageName = null;
        $attachFileName = null;

        if ($attachImage != "undefined") {
            $attachImageName = time() . '.' . $attachImage->extension();
            $attachImage->move(public_path('uploads/chat/images/'), $attachImageName);
        }

        if ($attachFile != "undefined") {
            $attachFileName = time() . '.' . $attachFile->extension();
            $attachFile->move(public_path('uploads/chat/files/'), $attachFileName);
        }

        DB::insert('insert into chat_message (user_id, message, thread_id, `read`, c_at, attach_image, attach_file) values (?, ?, ?, ?, ?, ?, ?)', [$user_id, $message, $thread_id, 0, now(), $attachImageName, $attachFileName]);

        return response()->json([
            'success' => true,
            'message' => 'Message successfully added!'
        ]);
    }

    public function create_new_thread(Request $request)
    {
        $user_id = Auth::user()->id;
        $chat_with_user_id = (int)$request['user_id'];

        $check = DB::select("select id from chat_threads where user_1=$user_id and user_2=$chat_with_user_id");
        $_check = DB::select("select id from chat_threads where user_2=$user_id and user_1=$chat_with_user_id");

        if (!count($check) && !count($_check)) {
            try {
                DB::insert('insert into chat_threads (user_1, user_2, c_at) values (?, ?, ?)', [$user_id, $chat_with_user_id, now()]);

                return response()->json([
                    'success' => true,
                    'thread_id' => DB::getPdo()->lastInsertId()
                ]);
            } catch (QueryException $ex) {
                return response()->json([
                    'success' => false,
                    'message' => $ex->getMessage()
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'thread_id' => count($check) ? $check[0]->id : $_check[0]->id
        ]);
    }


/////// book mark thread //////////////////////////////

///////////////// Un watched Thread /////////////////////

public function bookmarkthread(Request $request)
{
    $user_id = Auth::user()->id;
    $thread_id = (int)$request['thread_id'];




    try {


        if (Auth::check()) {

            $checkIfAlreadyWatched = DB::select('select id from diss_board_watched_thread where thread_id=? and user_id=?', [$thread_id, $user_id]);

            if (count($checkIfAlreadyWatched)) {

                    return response()->json([
                        'success' => true,
                        'message' => "Thread already bookmarked!"
                    ]);

            }





            if (!count($checkIfAlreadyWatched)) {
                DB::insert('insert into diss_board_watched_thread (thread_id, user_id) values (?, ?)', [$thread_id, $user_id]);

                return response()->json([
                    'success' => true,
                    'message' => "Thread bookmarked successfully!"
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




///////////////// Un watched Thread /////////////////////

     public function unwatchthread(Request $request)
    {
        $user_id = Auth::user()->id;
        $thread_id = (int)$request['thread_id'];

        try {

            DB::table('diss_board_watched_thread')
                ->where('thread_id', $thread_id)
                ->where('user_id', $user_id)
                ->delete();

                // DB::delete("DELETE diss_board_pinned_thread WHERE thread_id=?", [$thread_id]);
                return response()->json([
                    'success' => true,
                    'message' => "Thread unbookmark successfully!"
                ]);

        } catch (QueryException $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ]);
        }
    }

 ///////////////  un flag thread //////////////////


   public function unflagthread(Request $request)
    {
        $user_id = Auth::user()->id;
        $thread_id = (int)$request['thread_id'];

        try {

            DB::table('diss_board_flag_threads')
                ->where('thread_id', $thread_id)
                ->where('user_id', $user_id)
                ->delete();

                // DB::delete("DELETE diss_board_pinned_thread WHERE thread_id=?", [$thread_id]);
                return response()->json([
                    'success' => true,
                    'message' => "Thread un flag successfully!"
                ]);

        } catch (QueryException $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ]);
        }
    }



     ///////////////  un flag thread //////////////////


   public function unflagthreadbyadmin(Request $request)
   {
      // $user_id = Auth::user()->id;
       $thread_id = (int)$request['thread_id'];

       try {

           DB::table('diss_board_flag_threads')
               ->where('id', $thread_id)
               ->delete();

               // DB::delete("DELETE diss_board_pinned_thread WHERE thread_id=?", [$thread_id]);
               return response()->json([
                   'success' => true,
                   'message' => "Thread un flag successfully!"
               ]);

       } catch (QueryException $ex) {
           return response()->json([
               'success' => false,
               'message' => $ex->getMessage()
           ]);
       }
   }


 //////////////  un flag post /////////////////////



   public function unflagpost(Request $request)
    {
        $user_id = Auth::user()->id;

        $post_id = (int)$request['post_id'];

        try {

            DB::table('diss_board_flag_posts')
                ->where('post_id', $post_id)
                ->where('user_id', $user_id)
                ->delete();

                // DB::delete("DELETE diss_board_pinned_thread WHERE thread_id=?", [$thread_id]);
                return response()->json([
                    'success' => true,
                    'message' => "Post un flag successfully!"
                ]);


        } catch (QueryException $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ]);
        }
    }




    //////////////// unflag post by admin //////////////////////


   public function unflagpostbyadmin(Request $request)
   {
      // $user_id = Auth::user()->id;

       $post_id = (int)$request['post_id'];

       try {

           DB::table('diss_board_flag_posts')
               ->where('id', $post_id)
               ->delete();

               // DB::delete("DELETE diss_board_pinned_thread WHERE thread_id=?", [$thread_id]);
               return response()->json([
                   'success' => true,
                   'message' => "Post un flag successfully!"
               ]);


       } catch (QueryException $ex) {
           return response()->json([
               'success' => false,
               'message' => $ex->getMessage()
           ]);
       }
   }
//////////////////////////////////////////////




    // code by javed
    // check user owner post
    public function checkUserLikes($user_id,$post_id,$like_type,$request)
    {
        $postLikeType = $like_type;
        $likes_count  = DB::select("select count(*) as count from likes where post_id=?", [$post_id]);
        $likes_count  = $likes_count[0]->count;

        $like_types = DB::select("select sum(thumbup) thumbup, sum(smiley) smiley, sum(info) info, sum(agree) agree, sum(respectfully_disagree) respectfully_disagree from likes where post_id=?", [$post_id]);
        $like_types = $like_types[0];

        return response()->json([
            'success'     => true,
            'message'     => 'Author could not '.$postLikeType. ' the post',
            'post_id'     => $post_id,
            'like_types'  => $like_types,
            'like_type_p' => $postLikeType,
            'likes_count' => $likes_count
        ]);
    }

    // unlike the post
    public function unlikePost($user_id,$post_id,$like_type,$request)
    {

        $check = DB::select("SELECT id FROM likes WHERE user_id=? AND post_id=?", [$user_id, $post_id]);
        DB::delete('delete from likes where id = ?', [$check[0]->id]);

        $postLikeType = $like_type;
        $likes_count  = DB::select("select count(*) as count from likes where post_id=?", [$post_id]);
        $likes_count  = $likes_count[0]->count;

        $like_types = DB::select("select sum(thumbup) thumbup, sum(smiley) smiley, sum(info) info, sum(agree) agree, sum(respectfully_disagree) respectfully_disagree from likes where post_id=?", [$post_id]);
        $like_types = $like_types[0];

        return response()->json([
            'success'     => true,
            'post_id'     => $post_id,
            'like_types'  => $like_type,
            'like_type_p' => $postLikeType,
            'likes_count' => $likes_count
        ]);
    }


}



