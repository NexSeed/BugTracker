<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

use App\Http\Requests\CommentRequest;
use App\Comment;
use App\Article;

use Image;

use Input;

class CommentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['test']]);
    }
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
    public function store(CommentRequest $request, $article_id)
    {
        //
   		$input = $request->all();

        $comment = Comment::create(['user_id' => Auth::user()->id,
		        	  'article_id' => $article_id , 'body' => $input['body'] ]);

        $this->uploadImages($comment,$input);



         return redirect()->back();
    }

    function uploadImages($comment,$input) {

        $imageNum = 'image';

        if(isset($input[$imageNum])){

            //getClientOriginalName():アップロードしたファイルのオリジナル名を取得します
            //コメントidを頭につけておく
            $fileName = $comment->id.'_'.$input[$imageNum]->getClientOriginalName();


            //getRealPath():アップロードしたファイルのパスを取得します。
            $image = Image::make($input[$imageNum]->getRealPath());
              //画像を保存する


            $image->save(public_path().'/articleimages/'.$comment->article_id.'/'.$fileName);

            $comment->image = $fileName;
        }
        $comment->save();
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function test() {
	    
		$user = Auth::user();
		$token = 1;
		$name = $user->name;
	/*
		    $this->mailer->send($view, compact('user'), function ($m) use ($user, $token, $callback) {
	            $m->to($user->getEmailForPasswordReset());
	
	            if (! is_null($callback)) {
	                call_user_func($callback, $m, $user, $token);
	            }
	        });
	        
	*/
	    Mail::send('emails.test', compact('name'), function($message) use($user) {
			$message->to($user->email)->subject('Welcome');
	    });
	
		return  "こっちでもメッセージを $name  $user->email に、送ったと思うよね";	    
    }
}
