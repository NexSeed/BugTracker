<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Article;
use AppArticle;
use App\Http\Requests\ArticleRequest;
use Carbon\Carbon;
use Flash;
use Auth;
use Image;
use App\StatusList;
use File;

class ArticlesController extends Controller
{

    // statusCounts[];  ステータス数

    /* コンストラクタ追加　この中でミドルウェアを使用するように設定。
     * Kernel.phpの$routeMiddleware プロパティに設定した時のキー(auth)を引数にして、middlewareメソッドを実行します。
     *オプション引数に'except'を指定して、ミドルウェアの対象からindexとshowを外しています
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show','listing','limitByStatusAndSystem']]);

         $this->statusCounts = array();

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $articles = Article::latest('created_at')->where('deleted' , 0)->paginate(10);

        $statusCounts = $this->statusCounts;

        return view('articles.feed', compact('articles'));
    }

    // public function listing()
    // {
    //     //
    //     // $articles = Article::all();

    //     $articles = $this->getShowArticles();
    //     $this->updateStatusCounts();
    //     $statusCounts = $this->statusCounts;


    //     return view('articles.list', compact('articles','statusCounts'));
    // }


	public function limitByStatusAndSystem($status_list_id=null,$system="all") {

        $articles = $this->getShowArticles();
        $this->updateStatusCounts($system);
        $statusCounts = $this->statusCounts;

        if($status_list_id != 'all') {
    		$articles = $articles->where('status_list_id',  (int)$status_list_id);
        }
        if($system != 'all') {
    		$articles = $articles->where('system',  $system);
        }

        return view('articles.list', compact('articles','statusCounts','system'));

	}



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //新規作成フォーム


        return view("articles.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
		$input = $request->all();
        $input['status_list_id'] = 1;  // Not Yet はじめは必ずNot Yetからスタート
        $input['deleted'] = 0;         // はじめは必ず0からスタート
        $article = \Auth::user()->articles()->create($input);

        $this->uploadImages($article,$input);

        \Session::flash('flash_message', 'Report is added.');

        return redirect('articles');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)  // 引数がArticleで、かけるのは、RouteServiceProviderに$router->model('articles', 'App\Article');を書いてるおかげ
    {
        //

        $page = 'show';
        return view('articles.show',compact('article','page'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $page = 'edit';
        return view('articles.edit',compact('article','page'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Article $article,ArticleRequest $request)
    {
        $input = $request->all();

        $article->update($input);

        $this->uploadImages($article,$input);


        \Flash::success('記事を更新しました。');

       // return redirect(url('articles', [$article->id]));
        return redirect('articles/'.$article->id);
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
  //      $article = Article::findOrFail($id);

        // $article->delete();
        $article->deleted = 1;
        $article->save();


        \Flash::warning('記事を削除しました。');

        return redirect('articles');
    }

    public function deleteImage(Article $article,$imagenum)
    {
        $path = "";
        switch ($imagenum) {
            case 1:
                $path = $article->getImage1Path();
                if(isset($path)) File::delete($path);
                $article->deleteImage1Path();
                break;
            case 2:
                $path = $article->getImage2Path();
                if(isset($path)) File::delete($path);
                $article->deleteImage2Path();
                break;
            case 3:
                $path = $article->getImage3Path();
                if(isset($path)) File::delete($path);
                $article->deleteImage3Path();
                break;
            default:
                break;
        }

        return response()->json(
            [
                'path' => $path
            ],
            200,[],
            JSON_UNESCAPED_UNICODE
        );

    }

    // 自作関数
    // 論理削除されてないarticleを最新順に並べて返す
    function getShowArticles($system = "all")
    {
        $articles = Article::latest('created_at')->get();
        if($system != "all") {
            $articles = $articles->where('system', $system);
        }


        return $articles->where('deleted' , 0);
    }



    // それぞれのステータスの数を数えておく関数
    // 結果はstatusCounts[]に代入
    function updateStatusCounts($system = "all") {

        if($system == "all") {
            $articles = $this->getShowArticles();
        }
        else {
            $articles = $this->getShowArticles($system);
        }

        $status_lists_count = StatusList::all()->count();

        for ($i=0; $i < $status_lists_count; $i++) {
            $tmp = $articles->where('status_list_id',  ($i+1))->count();
            $this->statusCounts[$i] = $tmp;
        }


    }

    // imageをアップロードするための関数
    // 初めてだったら、フォルダを作成
    function uploadImages($article,$input) {

        for($i = 1; $i <= 3; $i++ ) {
            switch ($i) {
                case 1:
                    $imageNum = 'image1';
                    if($input['updatedImage1']==1) {
                        $this->deleteImage($article,1);
                        // $article->image1 = "";
                    }
                    break;
                case 2:
                    $imageNum = 'image2';
                    if($input['updatedImage2']==1) {
                        $this->deleteImage($article,2);
                        // $article->image2 = "";
                    }
                    break;
                case 3:
                    $imageNum = 'image3';
                    if($input['updatedImage3']==1) {
                        $this->deleteImage($article,3);
                        // $article->image3 = "";
                    }
                    break;
                default:
                    break;
            }

            if(isset($input[$imageNum])){

                //getClientOriginalName():アップロードしたファイルのオリジナル名を取得します
                $fileName = $input[$imageNum]->getClientOriginalName();


                //getRealPath():アップロードしたファイルのパスを取得します。
                $image = Image::make($input[$imageNum]->getRealPath());
                  //画像を保存する

                $directory = public_path().'/articleimages/'.$article->id;
                // if (!isset($result) && $isNew) {
                if (! \File::isDirectory($directory)) {
                  $result = \File::makeDirectory($directory, 0775, true);
                }
                $image->save($directory.'/'.$fileName);

                switch ($i) {
                    case 1:
                        $article->image1 = $fileName;
                        break;
                    case 2:
                        $article->image2 = $fileName;
                        break;
                    case 3:
                        $article->image3 = $fileName;
                        break;
                    default:
                        break;
                }
            }
        }

        $article->save();
    }


}














