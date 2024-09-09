@extends('layout.main')
@section('container')
    <div style="height: 100vh; width: 80vw;display: flex;flex-direction: column; justify-content: start; overflow: auto; white-space: nowrap; margin-top: 10vh;">
        <div style="width: 78vw; height: 9vh; display: flex; flex-direction: row; padding: 5px 35px 0 15px; justify-content: space-between; align-items: center">
            <h4>Jumlah Data Siswa</h4>
        </div>
        <div style="display: flex; flex-direction: row; justify-content: start; gap: 10px; width: 63vw; padding: 0 15px">
            @foreach($years as $key => $year)
            <div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; background: #9F41EA; border-radius: 7px; width: 20vw; height: 7vw; padding-left: 15px; padding-right: 20px">
                <div style="display: flex; flex-direction: column">
                    <h4 style="text-align: center; color: white">Jumlah Siswa Tahun</h4>
                    <h4 style="text-align: center; color: white">{{ $year }}</h4>
{{--                    <p style="padding: 0; margin: 0"><a href="/admin/mentor" style="text-decoration: underline; color: #1a1a1a; font-weight: bold">See Detail</a></p>--}}
                </div>
                <h3 style="text-align: center; font-size: xxx-large; color: white">{{$counts[$year]}}</h3>
            </div>
            @endforeach
{{--            <div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; background: white; border-radius: 7px; width: 20vw; height: 7vw; padding-left: 15px; padding-right: 20px">--}}
{{--                <div>--}}
{{--                    <h4 style="text-align: center; color: #1a1a1a">Jumlah Student</h4>--}}
{{--                    <p style="padding: 0; margin: 0"><a href="/admin/student" style="text-decoration: underline; color: #1a1a1a; font-weight: bold">See Detail</a></p>--}}
{{--                </div>--}}
{{--                <h3 style="text-align: center; font-size: xxx-large; color: #1a1a1a">{{$student_sum}}</h3>--}}
{{--            </div>--}}
{{--            <div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; background: white; border-radius: 7px; width: 20vw; height: 7vw; padding-left: 15px; padding-right: 20px">--}}
{{--                <div>--}}
{{--                    <h4 style="text-align: center; color: #1a1a1a">Jumlah Counseling</h4>--}}
{{--                    <p style="padding: 0; margin: 0"><a href="/admin/counseling" style="text-decoration: underline; color: #1a1a1a; font-weight: bold">See Detail</a></p>--}}
{{--                </div>--}}
{{--                <h3 style="text-align: center; font-size: xxx-large; color: #1a1a1a">{{$counseling_sum}}</h3>--}}
{{--            </div>--}}

            {{--                <div style="background: #1a202c; width: 13vw; height: 7vw"></div>--}}
        </div>
        <div style="width: 78vw; height: 9vh; display: flex; flex-direction: row; padding: 5px 35px 0 15px; justify-content: space-between; align-items: center">
            <div style="display: flex;flex-direction: row; gap: 10px">
                <form action="/student/search" method="get" style="display: flex; flex-direction: row; gap: 5px">
                    <input type="search" placeholder="Search" aria-label="search" name="search" value="{{old('search')}}" style="height: 35px; width: 260px; border: 1px solid gray; border-radius: 7px; padding-left: 10px; margin: 0">
                    <button type="submit" style="display: flex; justify-content: center; align-items: center; width: 35px; height: 35px; border: 1px solid gray; border-radius: 7px; background: white">
                        <img src="https://www.pixsector.com/cache/e7836840/av6584c34aabb39f00a10.png" style="width: 40px; height: 40px">
                    </button>
                </form>
            </div>
            <div style="display: flex; flex-direction: row; gap: 15px">
                <a href="/student/create" style="border: #1a202c solid 1px; padding: 5px 15px; color: #1a202c; text-decoration: none">+ Add Student</a>
                <a href="/student/import" style="border: #1a202c solid 1px; padding: 5px 15px; color: #1a202c; text-decoration: none">+ Import Student</a>
            </div>
        </div>
        <div style="display: flex; width: 77vw">
            <table class="table" style="margin-left: 15px">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">NIS</th>
                    <th scope="col">Name</th>
                    <th scope="col">Major</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody class="table-group-divider">
                @foreach($students as $key => $student)
                    <tr>
                        <th scope="row">{{$no++}}</th>
                        <td>{{$student->nis}}</td>
                        <td>{{$student->name}}</td>
                        <td>{{$student->Grade->grade_name}}</td>
                        <td>
                            <a href="/student/detail/{{$student->id}}" class="btn btn-outline-primary">Detail</a>
                            <a href="/student/edit/{{$student->id}}" class="btn btn-outline-warning">Edit</a>
                            <form action="/student/delete/{{$student->id}}" method="post" class="d-inline">
                                @csrf
                                @method('post')
                                <button class="btn btn-outline-danger"  onclick="return confirm('Are you sure you want to delete this class?')">Delete</button>
                            </form>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
