@extends('layout.main')
@section('container')
    <div style="height: 100vh; width: 80vw;display: flex;flex-direction: column; justify-content: start; align-items: center; overflow: auto; white-space: nowrap; margin-top: 10vh;">
        <div div style="width: 78vw; height: 9vh; display: flex; flex-direction: row; padding: 15px 10px 0 15px; justify-content: space-between; align-items: center">
            <form action="/counseling/search" method="get" style="display: flex; flex-direction: row; gap: 5px">
                <input type="search" placeholder="Search" aria-label="search" name="search" value="{{old('search')}}" style="height: 35px; width: 260px; border: 1px solid gray; border-radius: 7px; padding-left: 10px; margin: 0">
                <button type="submit" style="display: flex; justify-content: center; align-items: center; width: 35px; height: 35px; border: 1px solid gray; border-radius: 7px; background: white">
                    <img src="https://www.pixsector.com/cache/e7836840/av6584c34aabb39f00a10.png" style="width: 40px; height: 40px">
                </button>
            </form>

{{--            <form>--}}
{{--                --}}
{{--            </form>--}}
{{--            <a href="/counseling/create" style="border: #1a202c solid 1px; padding: 5px 15px; color: #1a202c; text-decoration: none">+ Add Mentor</a>--}}
        </div>
        <div style="width: 77vw; display: flex; flex-direction: column; align-items: center; margin-top: 5px">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($counseling as $counselings)
                        <tr>
                            <th scope="row">{{$no++}}</th>
                            <td>{{ optional($counselings->Student)->name ?? 'No Student' }}</td>
                            <td>{{ optional($counselings->Grade)->grade_name ?? 'No Grade' }}</td>
                            <td>{{ \Carbon\Carbon::parse($counselings->counseling_date)->format('F d, Y') }}</td>
                            <td>{{ optional($counselings->Status)->status ?? 'No Status' }}</td>
                            <td>
                                <a href="/counseling/detail/{{ $counselings->id }}" class="btn btn-outline-primary">Detail</a>
                                <form action="/counseling/delete/{{ $counselings->id }}" method="post" class="d-inline">
                                    @method('post')
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
