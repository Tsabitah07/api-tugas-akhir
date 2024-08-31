@extends('layout.main')
@section('container')
    <div style="height: 100vh; width: 80vw;display: flex;flex-direction: column; justify-content: start; align-items: center; overflow: auto; white-space: nowrap; margin-top: 10vh;">
        <div style="width: 77vw; height: 7.5vh; padding: 15px 10px 0 15px">
            <a href="/admin/article" style="text-decoration: none; color: #1a202c">
                <h5 style="margin-bottom: 15px; padding: 0">< Back to List</h5>
            </a>
            <form action="/article/create" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                </div>
                <div class="form-group">
                    <label for="writer">Writer</label>
                    <input type="text" name="writer" id="writer" class="form-control" value="{{ old('writer') }}">
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-select" name="category" id="category">
                        @foreach($categories as $category)
                            <option value={{ $category->id }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="article_content">Content</label>
                    <textarea name="article_content" id="article_content" class="form-control">{{ old('article_content') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="preview_content">Preview Content</label>
                    <textarea name="preview_content" id="preview_content" class="form-control">{{ old('preview_content') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="featured_image">Image</label>
                    <input type="file" name="featured_image" id="featured_image" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary" style="margin-top: 15px; margin-bottom: 20px">Tambah Artikel</button>
            </form>
        </div>
    </div>
@endsection
