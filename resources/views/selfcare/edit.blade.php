@extends('layout.main')
@section('container')
    <div style="height: 100vh; width: 80vw;display: flex;flex-direction: column; justify-content: start; overflow: auto; white-space: nowrap; margin-top: 10vh;">
        <div style="width: 77vw; height: 7.5vh; padding: 15px 10px 0 15px">
            <a href="/admin/selfcare" style="text-decoration: none; color: #1a202c">
                <h5 style="margin-bottom: 15px; padding: 0">< Back to List</h5>
            </a>
            <form action="/selfcare/edit/{{ $selfcare->id }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="form-group mb-3">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') ?? $selfcare->title }}">
                </div>
                <div class="form-group mb-3">
                    <label for="description">Deskripsi</label>
                    <input type="text" name="description" id="description" class="form-control" value="{{ old('description') ?? $selfcare->description }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="link">Link:</label>
                    <input type="url" name="link" id="link" class="form-control" value="{{ old('link') ?? $selfcare->link }}">
                </div>
                <div class="form-group mb-3">
                    <label for="image">Image:</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary" style="margin-top: 15px; margin-bottom: 20px">Edit Selfcare</button>
            </form>
        </div>
    </div>
@endsection
