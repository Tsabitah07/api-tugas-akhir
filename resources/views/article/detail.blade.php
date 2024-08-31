@extends('layout.main')
@section('container')
    <div style="height: 100vh; width: 80vw;display: flex;flex-direction: column; justify-content: start; align-items: center; overflow: auto; margin-top: 10vh;">
        <div style="width: 78vw; height: 9vh; display: flex; flex-direction: row; padding: 15px 10px 0 15px; justify-content: space-between; align-items: center">
            <a href="/admin/article" style="text-decoration: none; color: #1a202c; text-align: start; ">
                <h5 style="margin-bottom: 15px; padding: 0">< Back to List</h5>
            </a>
        </div>
        <img src="@env('APP_URL') @endenv{{ $article->featured_image }}" style="width: 45vw; height: 23vw">
        <h4>{{ $article->title }}</h4>
        <div style="display: flex; flex-direction: column; justify-content: start; align-items: start; padding: 7px; inline-size: 75vw; overflow-wrap: break-word">
            <p style="text-decoration: underline; margin: 0">Penulis</p>
            <p>{{ $article->writer }}</p>
            <p style="text-decoration: underline; margin: 0">Kategori</p>
            <p>{{ optional($article->Category)->category_name ?? "Tidak termasuk kategori apapun" }}</p>
            <p style="text-decoration: underline; margin: 0">Konten</p>
            <p>{{ $article->article_content }}</p>
        </div>
    </div>
@endsection
