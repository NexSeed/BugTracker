<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Article;

class WelcomeController extends Controller
{

    public function index()
    {
        $articles = $this->getShowArticles();
        $doneERP = $articles->where('system' , 'ERP')
                        ->where('status_list_id',  3)->count();
        $doneHS = $articles->where('system' , 'HackersStory')
                        ->where('status_list_id',  3)->count();
        $doneBT = $articles->where('system' , 'BugnoTra')
                        ->where('status_list_id',  3)->count();

        $allERP = $articles->where('system' , 'ERP')
                        ->count();
        $allHS = $articles->where('system' , 'HackersStory')
                        ->count();
        $allBT = $articles->where('system' , 'BugnoTra')
                        ->count();
        return view('top',compact('doneERP','doneHS','doneBT','allERP','allHS','allBT'));
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




}
