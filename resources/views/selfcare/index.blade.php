@extends('layout.main')
@section('container')
    <div style="height: 100vh; width: 80vw;display: flex;flex-direction: column; justify-content: start; overflow: auto; white-space: nowrap; margin-top: 10vh;">
        <div div style="width: 78vw; height: 9vh; display: flex; flex-direction: row; padding: 15px 10px 0 15px; justify-content: space-between; align-items: center">
            <form action="/selfcare/search" method="get" style="display: flex; flex-direction: row; gap: 5px">
                <input type="search" placeholder="Search" aria-label="search" name="search" value="{{old('search')}}" style="height: 35px; width: 260px; border: 1px solid gray; border-radius: 7px; padding-left: 10px; margin: 0">
                <button type="submit" style="display: flex; justify-content: center; align-items: center; width: 35px; height: 35px; border: 1px solid gray; border-radius: 7px; background: white">
                    <img src="https://www.pixsector.com/cache/e7836840/av6584c34aabb39f00a10.png" style="width: 40px; height: 40px">
                </button>
            </form>
            <a href="/selfcare/create" style="border: #1a202c solid 1px; padding: 5px 15px; color: #1a202c; text-decoration: none">+ Add Selfcare</a>
        </div>
        <div style="width: 77vw; display: flex; flex-direction: column; align-items: center; margin-top: 10px; gap: 10px">
            @foreach($selfcare as $key => $selfcares)
                <div style="width: 75vw; height: 10vw; display: flex; flex-direction: row; justify-content: space-evenly; align-items: center; border: #9F41EA solid 2px; border-radius: 7px">
                    <img src="@env('APP_URL') @endenv{{ $selfcares->image }}" style="width: 14vw; height: 8vw">
                    <div style="width: 48vw; height: 8vw; display: flex; flex-direction: column; justify-content: space-between; align-items: start">
                        <div>
                            <h4 style="margin: 0; padding: 0; overflow: hidden">{{ $selfcares->title }}</h4>
                            <p style="margin: 0; padding: 0; overflow: hidden">{{ $selfcares->description }}</p>
                        </div>
                        <p style="margin: 0; padding: 0">dihubungkan pada {{ \Carbon\Carbon::parse($selfcares->created_at)->format('d F Y') }}</p>
                    </div>
                    <div style="height: 8vw; width: 7vw; display: flex; flex-direction: column; justify-content: space-between; align-items: center;">
                        <div style="display: flex; flex-direction: column; gap: 7px">
                            <a href="/selfcare/edit/{{ $selfcares->id }}" style="border: #9F41EA solid 1.5px; border-radius: 7px; padding: 3px 25px; color: #9F41EA; text-decoration: none; font-weight: bold">Edit</a>
                            <form action="/selfcare/delete/{{ $selfcares->id }}" method="post">
                                @csrf
                                @method('post')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this class?')" style="border: #ef4444 solid 1.5px; border-radius: 7px; padding: 3px 15px; background: white; color: #ef4444; text-decoration: none; font-weight: bold">Delete</button>
                            </form>
                        </div>
                        <a href="{{ $selfcares->link }}" style="border: #1b57fa solid 1px; border-radius:  7px; padding: 3px 7px; color: #1b57fa; text-decoration: none; font-weight: bold">Visit Web</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
