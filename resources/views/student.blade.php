@extends('layout.main')
@section('container')
    <div style="height: 100vh; width: 80vw;display: flex;flex-direction: column; justify-content: start; overflow: auto; white-space: nowrap; margin-top: 10vh;">
        <div div style="width: 80vw; height: 9vh; display: flex; flex-direction: row; padding: 5px 35px 0 15px; justify-content: space-between; align-items: center">
            <h4>Student</h4>
            <form style="display: flex; flex-direction: row; gap: 5px">
                <input type="search" placeholder="Search" aria-label="Search" style="height: 35px; width: 260px; border: 1px solid gray; border-radius: 7px; padding-left: 10px; margin: 0">
                <button type="submit" style="width: 35px; height: 35px; border: 1px solid gray; border-radius: 7px"></button>
            </form>
        </div>
{{--        <div style="padding: 10px 30px; max-height: 85vh;">--}}
{{--            <table class="table">--}}
{{--                <thead class="thead-light">--}}
{{--                <tr>--}}
{{--                    <th scope="col">#</th>--}}
{{--                    <th scope="col">First</th>--}}
{{--                    <th scope="col">Last</th>--}}
{{--                    <th scope="col">Action</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                <tr>--}}
{{--                    <th scope="row">1</th>--}}
{{--                    <td>Mark</td>--}}
{{--                    <td>Otto</td>--}}
{{--                    <td>--}}
{{--                        <button class="btn btn-primary">Detail</button>--}}
{{--                        <button class="btn btn-danger">Delete</button>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th scope="row">2</th>--}}
{{--                    <td>Jacob</td>--}}
{{--                    <td>Thornton</td>--}}
{{--                    <td>--}}
{{--                        <button class="btn btn-primary">Detail</button>--}}
{{--                        <button class="btn btn-danger">Delete</button>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th scope="row">3</th>--}}
{{--                    <td>Larry</td>--}}
{{--                    <td>the Bird</td>--}}
{{--                    <td>--}}
{{--                        <button class="btn btn-primary">Detail</button>--}}
{{--                        <button class="btn btn-danger">Delete</button>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--                </tbody>--}}
{{--            </table>--}}
{{--        </div>--}}
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
