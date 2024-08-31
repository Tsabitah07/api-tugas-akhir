@extends('layout.main')
@section('container')
    <div style="height: 100vh; width: 80vw;display: flex;flex-direction: column; justify-content: start; align-items: center; overflow: auto; white-space: nowrap; margin-top: 10vh;">
        <div>
            <h4>Edit Article</h4>
        </div>
        <div style="width: 100%; display: flex; justify-content: center; align-items: center;">
            <form action="/article/update/{{ $article->id }}" method="POST" style="width: 100%; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                @csrf
                @method('post')
                <div style="width: 100%; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                    <div style="width: 100%; display: flex; justify-content: center; align-items: center;">
                        <label for="title" style="width: 20%;">Title</label>
                        <input type="text" name="title" id="title" value="{{ $article->title }}" style="width: 80%;">
                    </div>
                    <div style="width: 100%; display: flex; justify-content: center; align-items: center;">
                        <label for="writer" style="width: 20%;">Writer</label>
                        <input type="text" name="writer" id="writer" value="{{ $article->writer }}" style="width: 80%;">
                    </div>
                    <div style="width: 100%; display: flex; justify-content: center; align-items: center;">
                        <label for="category" style="width: 20%;">Category</label>
                        <input type="text" name="category" id="category" value="{{ $article->category }}" style="width: 80%;">
                    </div>
                    <div style="width: 100%; display: flex; justify-content: center; align-items: center;">
                        <label for="content" style="width: 20%;">Content</label>
                        <textarea name="content" id="content" style="width: 80%;">{{ $article->content }}</textarea>
                    </div>
                    <div style="width: 100%; display: flex; justify-content: center; align-items: center;">
                        <label for="featured_image" style="width: 20%;">Image</label>
                        <input type="file" name="featured_image" id="featured_image" style="width: 80%;" value="{{ $article->featured_image }}">
                    </div>
                    <div style="width: 100%; display: flex; justify-content: center; align-items: center;">
                        <button type="submit" style="width: 100%;">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
