<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayLists extends Model
{
    //
    protected $guarded = []; 

    public function userPlayLists()
    {
    	return $this->hasMany('App\UserPlayList','playlist_id')->where('type','content_course');
    } 
}
