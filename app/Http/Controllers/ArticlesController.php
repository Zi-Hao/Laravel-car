<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Exceptions\InvalidRequestException;

class ArticlesController extends Controller
{
    public function index(){
        $article = Article::query()->where('release', 1)->where('status',1)->where('sort','驾校文章')->paginate(5);

        return view('articles.index', ['articles' => $article]);
    }

    public function show(Article $articles)
    {
        // 判断教练是否审核通过，如果没有通过则抛出异常。
        if ($articles->status == 1) {
            return view('articles.show', ['artcile' => $articles]);
        }
        else{
            throw new InvalidRequestException('文章未通过审核');
        }


    }
    public function car(){
        $car = Article::query()->where('release', 1)->where('status',1)->where('sort','驾校简介')->get();
        $count = Article::query()->where('release', 1)->where('status',1)->where('sort','驾校简介')->count();
            return view('articles.car', ['cars' => $car,'count'=>$count]);
    }
}
