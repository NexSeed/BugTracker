<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //マスアサインメント(createで一気に登録)する用に必要な定義
    //定義をしてガードをすることで、不用意に変えられたくないデータを変えられないようにする
    protected $fillable = ['body','user_id','article_id'];

    public function user()
    {
	    return  $this->belongsTo(User::class);
    }

    public function article()
    {
      //第１引数には関連するモデル名
      //第２引数は多対多の中間テーブル名
      //ここでは第２引数を省略しているが、省略すると、モデル名をアルファベット順で並べたものがテーブル名となる
      //第３、第４キーは外部キーが省略されていて、'article_id','comment_id'が入ってる
      //withTimestampsは中間テーブルのタイムスタンプ更新のため。
      return $this->belongsTo('App\Article');
    }

    //image
    public function getImagePath() {
        $path = null;
        if (!empty($this->image)) {
            $path = 'articleimages/'.$this->article_id.'/'.$this->image;
        }

        return $path;
    }


}