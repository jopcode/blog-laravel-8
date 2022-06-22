<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:view-article | edit-article | delete-article')->only('index');
        $this->middleware('permission:create-article', ['only' => ['create', 'store']] );
        $this->middleware('permission:edit-article', ['only' => ['edit', 'update']] );
        $this->middleware('permission:delete-article', ['only' => ['destroy']] );
    }

    public function index()
    {
        $articles = Article::paginate(5);
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('articles.create', compact('categories'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);
        $inputs = $request->all();
        $inputs['slug'] = str_replace(' ', '-', strtolower($inputs['title']));
        $inputs['user_id'] = Auth::user()->id;
        Article::create($inputs);

        return to_route('articles.index');
    }

    public function show($id)
    {
        $article = Article::find($id);
        return dd($article);
    }

    public function edit($id)
    {
        $article = Article::find($id);

        return view('articles.edit', compact('article'));
    }


    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $article->update($request->all());
        return to_route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return to_route('articles.index');
    }
}
