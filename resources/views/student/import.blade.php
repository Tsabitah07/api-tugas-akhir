@extends('layout.main')
@section('container')
    <div style="height: 100vh; width: 80vw;display: flex;flex-direction: column; justify-content: start; overflow: auto; white-space: nowrap; margin-top: 10vh;">
        <div style="width: 77vw; height: 7.5vh; padding: 15px 10px 0 15px">
            <a href="/admin/student" style="text-decoration: none; color: #1a202c">
                <h5 style="margin-bottom: 15px; padding: 0">< Back to List</h5>
            </a>
            <form action="/student/import" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="form-group">
                    <label for="file">Excel: [xlsx,xls]</label>
                    <input type="file" name="file" id="file" class="form-control" value="{{ old('file') }}">
                </div>
                <button type="submit" class="btn btn-primary" style="margin-top: 15px; margin-bottom: 20px">Add student data</button>
            </form>
        </div>
    </div>
@endsection
