<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Like;
use Auth;
use App\Article;


class LikesController extends Controller
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
    public function store(Article $article)
    {
        //

        Like::create(['user_id' => Auth::user()->id,
		        	  'article_id' => $article->id]);

        $article->setLikeCount();

		return response()->json(
            [
                'likes_count' => $article->likes_count
            ],
            200,[],
            JSON_UNESCAPED_UNICODE
        );
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
    public function destroy(Article $article)
    {
        //
        $user_id = Auth::user()->id;
        $article->like_by($user_id)->first()->delete();

        $article->setLikeCount();

// 		return redirect('articles');  // routeから正規のフローで飛んでくれる
// 		return  redirect()->back();
		return response()->json(
            [
                'likes_count' => $article->likes_count
            ],
            200,[],
            JSON_UNESCAPED_UNICODE
        );

    }
}
