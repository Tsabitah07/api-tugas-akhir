<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function store(ArticleRequest $request)
    {
        $request->validated();

        if ($request->hasFile('featured_image')) {
            $imageName = time() . $request->file('featured_image')->getClientOriginalName();
            $imagePath = $request->file('featured_image')->storeAs('public/Article', $imageName);
            $imageUrl = Storage::url($imagePath);
        }

        $data = [
            'title' => $request->title,
            'link_content' => $request->link_content,
            'featured_image' => $imageUrl,
        ];

        $article = Article::create($data);

        return response()->json([
            'status' => 'success',
            'data' => $article
        ]);
    }

    public function index()
    {
        $article = Article::all();

        return response()->json([
            'status' => 'success',
            'data' => $article
        ]);
    }

    public function edit(ArticleRequest $request, $id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Article not found'
            ]);
        }

        if ($request->hasFile('featured_image')) {
            $delete = Storage::delete('public/article' . $article->featured_image);
            if ($delete) {
                $imageName = time() . $request->file('featured_image')->getClientOriginalName();
                $imagePath = $request->file('featured_image')->storeAs('public/article', $imageName);
                $imageUrl = Storage::url($imagePath);
            }
        }

        $data = $request->all();
        $article->title = $data['title'];
        $article->link_content = $data['link_content'];
        $article->featured_image = $imageUrl;
        $article->save();

        return response()->json([
            'status' => 'success',
            'data' => $article
        ]);
    }

    public function delete($id)
    {
        $article = Article::find($id);
        $article->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Article deleted'
        ]);
    }
}
