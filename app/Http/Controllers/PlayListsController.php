<?php

namespace App\Http\Controllers;

use App\PlayLists;
use App\UserPlayList;
use Illuminate\Http\Request;
use Validator;
use DB;

class PlayListsController extends Controller
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

        $validator = Validator::make($request->all(), [
                'name'  => 'required',
                'image' =>['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:10000']
        ]);


         if($validator->fails()){
            return response()->json([
                'status'  => false,
                'message' => $validator->errors(),
                'code'    => 404
            ], 404); 
        }

        //create
        $playListsArr = [
            'name'      => $request->name,
            'user_id'   => \Auth::user()->id
        ];

        $content_path = "uploads/playlist";


        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path($content_path), $fileName);
            $playListsArr['image'] = $content_path.'/'.$fileName;
        }

        $create = PlayLists::create($playListsArr);

  
        return response()->json([
            'status'  => true,
            'data'    => $create,
            'message' => 'Playlist added successfully',
            'code'    => 200
        ], 200); 
            
    }


    public function userPlayListAdd(Request $request)
    {   
        // source_id if for table id 
        $playList =  UserPlayList::where('source_id',$request->source_id)->where('playlist_id',$request->playlist_id)->where('type','content_course')->first();

        // eloquent result then insert record
        if (empty($playList)) {
            $playList = new UserPlayList;
        }

        $playList->playlist_id = $request->playlist_id;
        $playList->source_id   = $request->source_id;
        $playList->type        = 'content_course';
        $playList->save();

        return response()->json([
            'status'  => true,
            'data'    => $playList,
            'message' => 'Playlist added successfully',
            'code'    => 200
        ], 200); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PlayLists  $playLists
     * @return \Illuminate\Http\Response
     */
    public function show(PlayLists $playLists)
    {
        //
        $data['playList'] =  $playLists::where('user_id',\Auth::user()->id)->get();
        return $data['playList'];
        // return view('hereis blade',$data);
    }


    /**
     * Display the all record of playlist 
   
     */
    public function playListEntry(PlayLists $playLists , $playListId)
    {
        //
        $playListEntry =  $playLists::find($playListId)->userPlayLists;

        foreach ($playListEntry as $key => $value) {
           $value->content = DB::Table('content')
           ->select('content.*','difficulty_level.name as level_name')
           ->join('difficulty_level','difficulty_level.id','=','content.difficulty_level_id')
           ->where('content.id',$value->source_id)->first();
        }

        $data['playListEntry'] = $playListEntry;

        return response()->json([
            'status'  => true,
            'data'    => $data['playListEntry'],
            'message' => 'successfully',
            'code'    => 200
        ], 200); 

        return $data['playListEntry'];

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PlayLists  $playLists
     * @return \Illuminate\Http\Response
     */
    public function edit(PlayLists $playLists)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PlayLists  $playLists
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlayLists $playLists)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PlayLists  $playLists
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlayLists $playLists,$playlistId)
    {
        //
        $delete = $playLists::find($playlistId)->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Playlist Deleted successfully',
            'code'    => 200
        ], 200);
    }
}
