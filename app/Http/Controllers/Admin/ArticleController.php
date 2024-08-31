<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();

        return view('article.index', [
            'title' => 'Article',
            'articles' => $articles
        ]);
    }

    public function show($id)
    {
        $article = Article::find($id);

        return view('article.detail', [
            'title' => 'Article Detail',
            'article' => $article
        ]);
    }

    public function create()
    {
        $categories = ArticleCategory::all();

        return view('article.add', [
            'title' => 'Create Article',
            'categories' => $categories
        ]);
    }

    public function store(ArticleRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('featured_image')) {
            $image =Storage::url($request->file('featured_image')->store('images/article', 'public'));
        }

        Article::create([
            'title' => $data['title'],
            'article_content' => $data['article_content'],
            'preview_content' => $data['preview_content'],
            'category_id' => $data['category_id'],
            'featured_image' => $image
        ]);

        return redirect('/admin/article')->with('success', 'Article has been added');
    }

    public function editView($id)
    {
        $article = Article::find($id);
        $categories = ArticleCategory::all();

        return view('article.edit', [
            'title' => 'Edit Article',
            'article' => $article,
            'categories' => $categories
        ]);
    }

    public function edit(ArticleRequest $request, $id)
    {
        $article = Article::find($id);
        $data = $request->validate();

        if ($request->hasFile('image')){
            $data['image'] = Storage::url($request->file('image')->store('images/article', 'public'));
        } else {
            $data['image'] = $article->image;
        }

        $article->update($data);

        return redirect('/admin/article')->with('success', 'Article has been updated');
    }

    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();

        return redirect('/admin/article')->with('success', 'Article has been deleted');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $articles = Article::where('title', 'like', '%' . $search . '%')->get();

        return view('article.index', [
            'title' => 'Article',
            'articles' => $articles
        ]);
    }
}
