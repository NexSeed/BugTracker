<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
use Auth;
use App\StatusList;

class Article extends Model
{
    //マスアサインメント(createで一気に登録)する用に必要な定義
    //定義をしてガードをすることで、不用意に変えられたくないデータを変えられないようにする
    protected $fillable = ['title', 'body', 'system','type','urgency','likes_count','status_list_id','deleted'];


    public function getTitleAttribute($value)
    {
        //大文字に変換
        return mb_strtoupper($value);

    }

    public function setTitleAttribute($value)
    {

        //小文字に変換
        $this->attributes['title'] = mb_strtolower($value);
    }


	//image
	public function getImage1Path() {
        $path = null;
        if (!empty($this->image1)) {
            $path = 'articleimages/'.$this->id.'/'.$this->image1;
        }

		return $path;
	}

	public function getImage2Path() {
        $path = null;
        if (!empty($this->image2)) {
            $path = 'articleimages/'.$this->id.'/'.$this->image2;
        }

		return $path;
	}
	public function getImage3Path() {
        $path = null;
        if (!empty($this->image3)) {
            $path = 'articleimages/'.$this->id.'/'.$this->image3;
        }

		return $path;
	}

    public function deleteImage1Path() {
        $this->image1 = "";
        $this->update();
    }

    public function deleteImage2Path() {
        $this->image2 = "";
        $this->update();
    }

    public function deleteImage3Path() {
        $this->image3 = "";
        $this->update();
    }

	// users
    public function user()
    {
        return $this->belongsTo('App\User');
    }

	//Likes
    public function likes()
    {
	    return  $this->hasMany('App\Like');

    }

    public function like_by($user_id)
    {
	    return  Like::where('article_id', $this->id)->where('user_id',$user_id)->get();
    }

    public function i_like_this()
    {

	    return $this->like_by(Auth::user()->id)->count();
    }

    public function setLikeCount() {

        $likes_count = $this->likes()->count();

        $this->likes_count = $likes_count;
        $this->update();
    }

	// Comments
    public function comments()
    {
    	return $this->hasMany('App\Comment');
    }

	// Status Lists
	public function status_list() {
	    return $this->belongsTo('App\StatusList');
    }

    public function status() {
	    $status_list_id = $this->status_list_id;
	    return StatusList::findOrFail($status_list_id)->name;
    }

}
