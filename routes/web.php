<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

View::composer(['*'], function ($view) {
    $data = [];

    if (Auth::check()) {
        $profile = DB::select('SELECT * FROM profiles WHERE user_id = ?', [Auth::id()]);
        $user = DB::select('SELECT role_id FROM users WHERE id = ?', [Auth::id()]);
        $role = DB::select('SELECT name FROM roles WHERE id = ?', [$user[0]->role_id]);

        $notification = DB::select("select n.id, n.reaction, n.read, n.post_id, n.c_at, dbtp.thread_id,
        (select diss_board_id from diss_board_thread where id=dbtp.thread_id) as board_id,
        (select title from diss_board_thread where id=dbtp.thread_id) as thread,
        (select name from users where id=n.liked_by_u_id) as like_by_user,
        (select profile_pic_url from profiles where user_id=n.liked_by_u_id) as like_by_user_avatar,
        (select name from users where id=n.replied_by_u_id) as replied_by_user,
        (select profile_pic_url from profiles where user_id=n.replied_by_u_id) as replied_by_user_avatar
        from notifications n join diss_board_thread_post dbtp on n.post_id=dbtp.id where dbtp.user_id=? order by n.c_at desc limit 5", [Auth::id()]);
        $tagsncat2 =DB::select("select c.tags,c.category_ids,c.tags,c.gender,

        (select affiliation FROM users WHERE id=c.user_id) AS affiliation,
        (select location FROM users WHERE id=c.user_id) AS country,
        (select email FROM users WHERE id=c.user_id) AS email,
        (select GROUP_CONCAT(NAME SEPARATOR ', ') FROM categories WHERE FIND_IN_SET(id, c.category_ids)) AS categories
        FROM profiles c WHERE c.user_id=?", [Auth::id()]);

        $new_message = DB::select("select count(*) new_message from chat_threads join chat_message on chat_threads.id=chat_message.thread_id where (chat_threads.user_1=? or chat_threads.user_2=?) and chat_message.read=0 and chat_message.user_id!=?", [Auth::id(), Auth::id(), Auth::id()]);
        $new_message = $new_message[0]->new_message;
        $tagsonly = DB::select('SELECT tags FROM profiles WHERE user_id = ?', [Auth::id()]);
         $u_id2=Auth::id();
        $threads = DB::select("SELECT diss_board_thread.*,
        (select name from users where id=diss_board_thread.user_id) AS author,
        (select profile_pic_url from profiles where user_id=diss_board_thread.user_id) AS author_avatar,
        (select roles.name from users join roles on users.role_id=roles.id where users.id=$u_id2) AS role,
        (select count(*) from diss_board_pinned_thread where thread_id=diss_board_thread.id and user_id=$u_id2) as pinned,
        (select name from users where id=diss_board_thread.l_reply_user_id) AS l_reply_user,
        (select profile_pic_url from profiles where user_id=diss_board_thread.l_reply_user_id) AS l_reply_user_avatar
        from diss_board_thread where user_id=? AND d_by is NULL",[Auth::id()]);

        $posts = DB::select("SELECT dbtp.*,
        (select name from users where id=dbtp.user_id) AS author,
        (select profile_pic_url from profiles where user_id=dbtp.user_id) AS author_avatar,
        (select roles.name from users join roles on users.role_id=roles.id where users.id=dbtp.user_id) AS role
        from diss_board_thread_post dbtp  where dbtp.user_id=? AND dbtp.d_at is null  order by dbtp.c_at desc",[Auth::id()]);

$my_contributions = DB::select("SELECT  c.id, c.title,c.authors, c.content_privacy, c.affiliation, c.image_url, c.downloaded_count, c.views_count, c.featured, c.status,c.scope_type,c.created_at,
(SELECT NAME FROM users WHERE id=c.user_id) AS author,
(SELECT profile_pic_url FROM profiles WHERE user_id=c.id) AS image,
(SELECT NAME FROM difficulty_level WHERE id=c.difficulty_level_id) AS difficulty_level,
(SELECT roles.name FROM users JOIN roles ON users.role_id=roles.id WHERE users.id=c.user_id) AS role
 FROM content c   WHERE c.user_id=? AND c.archive=0 AND c.status=1 GROUP BY  c.created_at DESC ", [Auth::id()]);

$userdetailsnew = DB::select("SELECT u.*,
(SELECT count(user_id) from content where user_id=u.id AND archive=0 AND status=1) as contributionstotal,
(SELECT count(user_id) from diss_board_thread where user_id=u.id and d_by is null) as threads,
(SELECT count(user_id) from diss_board_thread_post where user_id=u.id and d_by is null) as posts
from users u  where id=?",[Auth::id()]);
                $user_content_updated_list = DB::select("SELECT GROUP_CONCAT(content_id) as content_ids FROM student_content_mapping WHERE user_id=?",[Auth::id()]);
                $user_content_updated_list = $user_content_updated_list[0]->content_ids;

        $data['profile'] = $profile[0];
        $data['role'] = $role[0]->name;
        $data['notification'] = $notification;
        $data['tagsncat2'] = $tagsncat2[0];
        $data['new_message'] = $new_message;
        $data['tagsonly'] = $tagsonly[0];
        $data['threads2'] = $threads;
        $data['posts'] = $posts;
        $data['my_contributions'] = $my_contributions;
        $data['userdetailsnew'] = $userdetailsnew;
        // $data['user_content_updated_list'] = $user_content_updated_list[0];
    }

    $categories = DB::select("SELECT * FROM categories");
    $data['categories'] = $categories;

    $view->with('data', $data);
});

Route::get('/', 'PublicController@index')->name('welcomePg');
Route::get('/search/all', 'PublicController@search')->name('searchAll');

Auth::routes(['verify' => true]);

Auth::routes();

Route::get('/infoStudent', 'pagesRoutesController@infoStudentPg')->name('infoStudent');
Route::get('/infoTeacher', 'pagesRoutesController@infoTeacherPg')->name('infoTeacher');
Route::get('/viewProfile', 'HomeController@viewprofPg')->name('viewProfile');
Route::post('/updateProfile', 'HomeController@updateProfile')->name('updateProfile');
Route::get('/accountSetting', 'HomeController@accountSettingPg')->name('accountSetting');
Route::post('/updateSetting', 'HomeController@updateSetting')->name('updateSetting');

Route::get('/discussions', 'PublicController@discussions')->name('discussions');
Route::get('/discussion/show/{discussion_id}', 'PublicController@discussion_show')->name('discussion_show');

Route::post('/discussions_ask_question', 'HomeController@discussions_ask_question')->name('discussions_ask_question');
Route::post('/discussion/vote/{discussion_id}', 'HomeController@discussion_vote')->name('discussion_vote');
Route::get('/discussion/delete/{discussion_id}', 'HomeController@discussion_delete')->name('discussion_delete');
Route::post('/discussion/response', 'HomeController@discussion_response')->name('discussion_response');

Route::get('/abouts', 'pagesRoutesController@aboutsPg')->name('abouts');
Route::get('/info', 'pagesRoutesController@infoPg')->name('info');

Route::get('/communityguidelines', 'pagesRoutesController@coummunity')->name('coummunity');


// LOGIN ROUTES
// Route::get('/login', 'pagesRoutesController@loginPg')->name('login');
// Route::get('/signup', 'pagesRoutesController@signupPg')->name('signup');
// Route::get('/verifyemail', 'pagesRoutesController@verifyemailPg')->name('verifyemail');

// ADMIN ROUTES
// Route::get('/dashboard', 'pagesRoutesController@dashboardPg')->name('dashboard');
// Route::get('/viewProfile', 'HomeController@viewprofPg')->name('viewProfile');
Route::get('/recievedcontent', 'AdminDashController@showContent')->name('recievedcontent');
Route::get('/historycontent', 'AdminDashController@historyContent')->name('historycontent');
Route::get('/listofcontributors', 'AdminDashController@listofcontributors')->name('listofcontributors');
Route::get('/underreview', 'AdminDashController@underreview')->name('underreview');
Route::get('/listofcontributors', 'AdminDashController@listofcontributors')->name('listofcontributors');
Route::get('/singlecontent/show/{content_id}', 'AdminDashController@singlecontent')->name('singlecontent');

Route::post('/addcoment', 'AdminDashController@store')->name('addcoment');
Route::post('/tagadmin', 'AdminDashController@tagadmin')->name('tagadmin');

Route::put('/approvedcontent/{content_id}', 'AdminDashController@update')->name('approvedcontent');

Route::get('/search', 'pagesRoutesController@searchPg')->name('search');
Route::get('/contact', 'pagesRoutesController@contactPg')->name('contact');
Route::post('/contact', 'PublicController@contact_us')->name('contact_us');
Route::get('/faqs', 'pagesRoutesController@faqsPg')->name('faqs');
Route::get('/newsAndMedia', 'pagesRoutesController@newsAndMediaPg')->name('newsAndMedia');
Route::post('/courses/filter1', 'PublicController@coursesPgFilter1')->name('coursesPgFilter1');
Route::post('/courses/filter2', 'PublicController@coursesPgFilter2')->name('coursesPgFilter2');
Route::post('/courses/filter3', 'PublicController@coursesPgFilter3')->name('coursesPgFilter3');
Route::post('/courses/filter4', 'PublicController@coursesPgFilter4')->name('coursesPgFilter4');
Route::post('/courses/filter5', 'PublicController@coursesPgFilter5')->name('coursesPgFilter5');

// CONTRIBUTOR ROUTES
// Route::get('/contributorDashboard', 'pagesRoutesController@contributorDashboardPg')->name('contributorDashboard');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/welcome/back', 'StudentController@welcomBackPg')->name('welcomBack');

Route::post('/content/add', 'ContributorController@contentAdd')->name('contentAdd');
Route::get('/create/content/{content_id}', 'ContributorController@createContent')->name('createContent');
Route::post('/content/addsection', 'ContributorController@contentAddsection')->name('contentAddsection');
Route::post('/content/upload', 'ContributorController@contentUpload')->name('contentUpload');

Route::post('/contentwithdetail/add', 'ContributorController@contentAddWithDetail')->name('contentAddWithDetail');

// Route::get('/microeconomics', 'pagesRoutesController@microeconomicsPg')->name('microeconomics');
// Route::get('/contributorProfile', 'pagesRoutesController@contributorProfilePg')->name('contributorProfile');
// Route::get('/accountSetting', 'pagesRoutesController@accountSettingPg')->name('accountSetting');

// DISCUSSION BOARD ROUTES
// Route::get('/discussionBoardPanel', 'pagesRoutesController@discussionBoardPanelPg')->name('discussionBoardPanel');
// Route::get('/addFilter', 'pagesRoutesController@addFilterPg')->name('addFilter');

// STUDENT ROUTES
Route::post('/courses/filter', 'PublicController@coursesPgFilter')->name('coursesPgFilter');
Route::get('/courses/{category_id}', 'PublicController@coursesPg')->name('courses');
Route::get('/search/courses', 'PublicController@searchCoursesPg')->name('searchCourses');
Route::post('/courses/bookmarked', 'StudentController@courses_bookmarked')->name('courses_bookmarked');
Route::get('/content/section/{content_id}', 'PublicController@contentSectionPg')->name('contentSection');
Route::get('/contentById', 'PublicController@contentById')->name('contentById');
Route::post('/contentUploadEdit', 'PublicController@contentUploadEdit')->name('contentUploadEdit');
Route::get('/content/contentUploadDelete', 'PublicController@contentUploadDelete')->name('contentUploadDelete');
Route::post('/content/mainContentUpdate', 'PublicController@mainContentUpdate')->name('mainContentUpdate');
Route::post('/content/mainContentDelete', 'PublicController@mainContentDelete')->name('mainContentDelete');
Route::post('/contentwithdetail/update', 'PublicController@contentEditWithDetail')->name('contentEditWithDetail');


// Route::get('/bookmarks', 'StudentController@bookmarksPg')->name('bookmarks');
Route::post('/content/tracking', 'StudentController@contentTracking')->name('contentTracking');

Route::get('/singlecontent/show/{content_id}', 'AdminDashController@singlecontent')->name('singlecontent');

Route::get('/profile/{id}', 'AdminDashController@viewprofiles')->name('viewprofiles');

Route::get('/admin/viewcontributorprofile/{id}', 'AdminDashController@viewsingleprofile')->name('viewsingleprofile');


Route::get('/contributorsbookmarks', 'AdminDashController@viewBookmarksofcontributors')->name('viewBookmarksofcontributors');
Route::get('/contributorshistory', 'AdminDashController@contributorshistory')->name('contributorshistory');
Route::get('/commentshistory', 'AdminDashController@commentshistory')->name('commentshistory');
Route::get('/content/view/{content_id}', 'AdminDashController@contentSectionPg')->name('contentview');
Route::get('mail/send', 'MailController@send');

Route::get('/privacyPolicy', 'pagesRoutesController@privacyPolicyPg')->name('privacyPolicy');
Route::get('/termsConditions', 'pagesRoutesController@termsConditionsPg')->name('termsConditions');
Route::get('/admincomments', 'AdminDashController@admincomments')->name('admincomments');
Route::get('/tags/{cat_id}', 'ContributorController@getRelevantTags')->name('getRelevantTags');
Route::put('/approvedContri/{content_id}', 'AdminDashController@updatecontributor')->name('approvedContri');
Route::get('/singlecontent/comments/{content_id}', 'AdminDashController@singlecontentcomments')->name('singlecontentcomments');

//new sub page
Route::get('/economicResearch/{content_id}', 'StudentController@newssinglPg')->name('newssinglPg');

//    NEW DISCUSSION BOARD
Route::get('/discussionBoard', 'DiscussionController@discussionBoardPg')->name('discussionBoard');
Route::get('/addContent', 'DiscussionController@addContentPg')->name('addContent');
Route::post('/addBoard', 'DiscussionController@addBoard')->name('addBoard');
Route::get('/contentSuggestion', 'DiscussionController@contentSuggestionPg')->name('contentSuggestion');
Route::post('/postThread', 'DiscussionController@postThread')->name('postThread');
Route::post('/contentSuggestionPagination', 'DiscussionController@contentSuggestionPagination')->name('contentSuggestionPagination');
Route::post('/flagThreadPagination', 'DiscussionController@flagThreadPagination')->name('flagThreadPagination');
Route::post('/watchedThreadPagination', 'DiscussionController@watchedThreadPagination')->name('watchedThreadPagination');
Route::post('/yourPostPagination', 'DiscussionController@yourPostPagination')->name('yourPostPagination');
Route::post('/flagPostPagination', 'DiscussionController@flagPostPagination')->name('flagPostPagination');
Route::get('/thread/posts', 'DiscussionController@thread_posts')->name('thread_posts');
Route::post('/thread/posts', 'DiscussionController@diss_thread_posts')->name('diss_thread_posts');
Route::post('/thread/posts/pagination', 'DiscussionController@thread_post_pagination')->name('thread_post_pagination');
Route::post('/thread/posts/pagination/last', 'DiscussionController@thread_post_pagination_last')->name('thread_post_pagination_last');
Route::post('/likepost', 'DiscussionController@likepost')->name('likepost');
Route::post('/movethread', 'DiscussionController@movethread')->name('movethread');
Route::post('/flagthread', 'DiscussionController@flagthread')->name('flagthread');
Route::post('/pinnedthread', 'DiscussionController@pinnedthread')->name('pinnedthread');
Route::post('/deletethread', 'DiscussionController@deletethread')->name('deletethread');
Route::post('/closethread', 'DiscussionController@closethread')->name('closethread');
Route::post('/ban_user', 'DiscussionController@ban_user')->name('ban_user');
Route::post('/flagpost', 'DiscussionController@flagpost')->name('flagpost');
Route::post('/movepost', 'DiscussionController@movepost')->name('movepost');
Route::post('/deletepost', 'DiscussionController@deletepost')->name('deletepost');
Route::get('/messages', 'DiscussionController@messages')->name('messages');
Route::get('/thread_messages/{thread_id}', 'DiscussionController@thread_messages')->name('thread_messages');
Route::post('/thread_messages_post', 'DiscussionController@thread_messages_post')->name('thread_messages_post');
Route::post('/create_new_thread', 'DiscussionController@create_new_thread')->name('create_new_thread');
Route::get('/bannedUser', 'dissfunctionController@bannedUserPg')->name('bannedUser');
Route::get('/deletedThreads', 'dissfunctionController@deletedThreadsPg')->name('deletedThreads');
Route::get('/viewModerators', 'dissfunctionController@viewModeratorsPg')->name('viewModerators');
Route::get('/discBoardprofile/{u_id}', 'dissfunctionController@discBoardprofilePg')->name('discBoardprofile');
Route::get('/moderatorProfile', 'dissfunctionController@moderatorProfilePg')->name('moderatorProfile');
// Route::get('/postThreadPg', 'DiscussionController@postThreadPg')->name('postThreadPg');
Route::get('/getThreads/{board_id}', 'DiscussionController@getThreads')->name('getThreads');
Route::get('/banuserdetails/{user_id}', 'DiscussionController@banuserdetails')->name('banuserdetails');
Route::put('/unbanuser/{user_id}', 'dissfunctionController@unbanUser')->name('unbanuser');
Route::put('/restoreques/{ques_id}', 'dissfunctionController@restoreThread')->name('restoreques');
Route::put('/unmakecontributor/{user_id}', 'dissfunctionController@unmakecontri')->name('unmakecontributor');
Route::get('/showuserdetails/{u_id}', 'dissfunctionController@showuserdetails')->name('showuserdetails');
Route::put('/makecontributor/{u_id}', 'dissfunctionController@makecontributor')->name('makecontributor');
Route::post('/assignrank', 'dissfunctionController@assignRank')->name('assignRank');

///////////////////////////////////////////////////////////////////////////////////////////
Route::put('/archivecontent/{content_id}', 'AdminDashController@updatearchive')->name('archivecontent');
Route::get('/recievedcontentalpha', 'AdminDashController@showContentAlpha')->name('recievedcontentalpha');
Route::get('/showContentnewest', 'AdminDashController@showContentnewest')->name('showContentnewest');

///////////////////////////////////////////////////////////////////////////////////////////////////////

Route::get('/viewadmins', 'dissfunctionController@viewAdminPg')->name('viewadmins');
Route::post('/unclosethread', 'DiscussionController@unclosethread')->name('unclosethread');
Route::post('/unpinnedthread', 'DiscussionController@unpinnedthread')->name('unpinnedthread');





// playlists
Route::post('/playlists-store', 'PlayListsController@store')->name('playlist.store');
Route::post('/userplaylist-store', 'PlayListsController@userPlayListAdd')->name('user.playlist.store');
Route::get('/playlist-show', 'PlayListsController@show')->name('user.playlist.show');
Route::get('/playlist/{id}', 'PlayListsController@playListEntry')->name('user.playlist.entry');



////unflag a post

Route::post('/unflagpost', 'DiscussionController@unflagpost')->name('unflagpost');

//// unflag thread

Route::post('/unflagthread', 'DiscussionController@unflagthread')->name('unflagthread');

Route::post('/unflagpostbyadmin', 'DiscussionController@unflagpostbyadmin')->name('unflagpostbyadmin');

Route::post('/unflagthreadbyadmin', 'DiscussionController@unflagthreadbyadmin')->name('unflagthreadbyadmin');


Route::post('/unwatchthread', 'DiscussionController@unwatchthread')->name('unwatchthread');


Route::post('/bookmarkthread', 'DiscussionController@bookmarkthread')->name('bookmarkthread');


Route::get('/allusers', 'dissfunctionController@allusers')->name('allusers');


//newRoutesForCourse

Route::post('/courseswithdetail/add', 'CoursesController@coursesAddWithDetail')->name('courseswithDetail');
Route::post('/addcontenttocourse/add', 'CoursesController@AddContentToCourse')->name('AddContentToCourse');
Route::get('/coursecontent/view/{content_id}', 'CoursesController@GetContentForCourse')->name('courseview');
Route::get('/approvedCourseDetails/view/{content_id}', 'CoursesController@approvedCourseDetails')->name('approvedCourseDetails');
// Route::get('/content/view/{content_id}', 'AdminDashController@contentSectionPg')->name('contentview');
Route::get('/courseDetail/view/{content_id}', 'CoursesController@courseDetail')->name('courseDetail');
Route::get('/submitcourse/update', 'CoursesController@submitCourse')->name('SubmitCourse');
Route::get('/mainCourseDelete', 'CoursesController@courseUploadDelete')->name('mainCourseDelete');
Route::get('/coursesdashboard/filter', 'CoursesController@coursesPgFilternew')->name('coursesPgFilterdashboard');
Route::get('/contentSort/update', 'CoursesController@contentOrderList')->name('contentOrderList');
Route::post('/coursesdashboard/filter', 'CoursesController@coursesPgFilternew')->name('coursesPgFilterdashboard');
Route::post('/contentdashboard/filter', 'CoursesController@contentPgFilternew')->name('contentPgFilterdashboard');

Route::get('/add', 'HomeController@addPg')->name('add');
Route::get('/tasks', 'HomeController@taskPg')->name('tasks');
Route::get('/users', 'HomeController@userPg')->name('users');
Route::post('/userspg/filter', 'HomeController@userpgAppend')->name('userpgAppend');
Route::post('/bookmarkspg/filter', 'AdminDashController@bookmarkSorting')->name('bookmarkSorting');
Route::post('/historypg/filter', 'AdminDashController@historySorting')->name('historySorting');
Route::post('/studentpg/filter', 'CoursesController@Studentsorting')->name('Studentsorting');
Route::post('/add_group', 'CoursesController@add_group')->name('add_group');
Route::post('/contentsearchsort/filter', 'CoursesController@contentPgFilterseqarchnew')->name('contentPgFilterseqarchnew');

Route::get('/get_group', 'CoursesController@groupcontent')->name('groupcontent');













