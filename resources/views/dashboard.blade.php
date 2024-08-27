@extends('layout.main')
@section('container')
{{--    <div style="height: 100vh; width: 80vw;display: flex;flex-direction: column; justify-content: start; overflow: auto; white-space: nowrap; margin-top: 10vh;">--}}
{{--        <div style="width: 80vw; height: 50vh; display: flex; flex-direction: column; background: beige; padding: 10px 10px 0 15px; gap: 10px">--}}
{{--            <div style="display: flex; flex-direction: column; padding: 15px">--}}
{{--                <h1>Dashboard</h1>--}}
{{--            </div>--}}
{{--            <h4>Mentor</h4>--}}
{{--            <div style="display: flex; flex-direction: row; width: 100%; height: 37vh; gap: 15px; overflow: auto; white-space: nowrap">--}}
{{--                <div style="display: flex; flex-direction: column; width: 13rem; padding: 10px; gap: 15px; justify-content: start; align-items: center; background: #9F41EA">--}}
{{--                    <img src="image_static/image.png" alt="mentor" style="width: 100px; height: 130px">--}}
{{--                    <p style="font-weight: bold; text-align: justify">Anda adalah mentor</p>--}}
{{--                </div>--}}
{{--                <div style="display: flex; flex-direction: column; width: 13rem; padding: 10px; gap: 15px; justify-content: start; align-items: center; background: #9F41EA">--}}
{{--                    <img src="image_static/image.png" alt="mentor" style="width: 100px; height: 130px">--}}
{{--                    <p style="font-weight: bold; text-align: justify">Anda adalah mentor</p>--}}
{{--                </div>--}}
{{--                <div style="display: flex; flex-direction: column; width: 13rem; padding: 10px; gap: 15px; justify-content: start; align-items: center; background: #9F41EA">--}}
{{--                    <img src="image_static/image.png" alt="mentor" style="width: 100px; height: 130px">--}}
{{--                    <p style="font-weight: bold; text-align: justify">Anda adalah mentor</p>--}}
{{--                </div>--}}
{{--                <div style="display: flex; flex-direction: column; width: 13rem; padding: 10px; gap: 15px; justify-content: start; align-items: center; background: #9F41EA">--}}
{{--                    <img src="image_static/image.png" alt="mentor" style="width: 100px; height: 130px">--}}
{{--                    <p style="font-weight: bold; text-align: justify">Anda adalah mentor</p>--}}
{{--                </div>--}}
{{--                <div style="display: flex; flex-direction: column; width: 13rem; padding: 10px; gap: 15px; justify-content: start; align-items: center; background: #9F41EA">--}}
{{--                    <img src="image_static/image.png" alt="mentor" style="width: 100px; height: 130px">--}}
{{--                    <p style="font-weight: bold; text-align: justify">Anda adalah mentor</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div style="width: 80vw; height: auto; display: flex; flex-direction: column; padding: 10px 15px 0 15px; gap: 10px; background: #a0aec0">--}}
{{--            <div style="display: flex; flex-direction: row; justify-content: space-between">--}}
{{--                <h4>Student</h4>--}}
{{--                <div style="margin-right: 20px">--}}
{{--                    <p>sort by</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div style="padding: 0 15px">--}}
{{--                <table class="table table-striped table-hover">--}}
{{--                    <thead>--}}
{{--                        <tr>--}}
{{--                            <th scope="col">No</th>--}}
{{--                            <th scope="col">Name</th>--}}
{{--                            <th scope="col">Email</th>--}}
{{--                            <th scope="col">Action</th>--}}
{{--                        </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                        <tr>--}}
{{--                            <th scope="row">1</th>--}}
{{--                            <td>Mark</td>--}}
{{--                            <td>mark@gmail.com</td>--}}
{{--                            <td>--}}
{{--                                <button class="btn btn-primary">Detail</button>--}}
{{--                                <button class="btn btn-danger">Delete</button>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div style="height: 100vh; width: 80vw;display: flex;flex-direction: column; justify-content: start; overflow: auto; white-space: nowrap; margin-top: 10vh;">
        <div style="width: 80vw; height: 24vh; display: flex; flex-direction: column; padding: 10px 10px 0 15px; gap: 10px; background: linear-gradient(to bottom, #9F41EA 70%, #f7f7f7 30%)">
            <h4 style="color: white">Data Penggunaan</h4>
            <div style="display: flex; flex-direction: row; justify-content: space-between; width: 63vw;">
                <div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; background: white; border-radius: 7px; width: 20vw; height: 7vw; padding-left: 15px; padding-right: 20px">
                    <div>
                        <h4 style="text-align: center; color: #1a1a1a">Jumlah Mentor</h4>
                        <p style="padding: 0; margin: 0"><a href="/admin/mentor" style="text-decoration: underline; color: #1a1a1a; font-weight: bold">See Detail</a></p>
                    </div>
                    <h3 style="text-align: center; font-size: xxx-large; color: #1a1a1a">{{$mentor_sum}}</h3>
                </div>
                <div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; background: white; border-radius: 7px; width: 20vw; height: 7vw; padding-left: 15px; padding-right: 20px">
                    <div>
                        <h4 style="text-align: center; color: #1a1a1a">Jumlah Student</h4>
                        <p style="padding: 0; margin: 0"><a href="/admin/student" style="text-decoration: underline; color: #1a1a1a; font-weight: bold">See Detail</a></p>
                    </div>
                    <h3 style="text-align: center; font-size: xxx-large; color: #1a1a1a">{{$student_sum}}</h3>
                </div>
                <div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; background: white; border-radius: 7px; width: 20vw; height: 7vw; padding-left: 15px; padding-right: 20px">
                    <div>
                        <h4 style="text-align: center; color: #1a1a1a">Jumlah Counseling</h4>
                        <p style="padding: 0; margin: 0"><a href="/admin/counseling" style="text-decoration: underline; color: #1a1a1a; font-weight: bold">See Detail</a></p>
                    </div>
                    <h3 style="text-align: center; font-size: xxx-large; color: #1a1a1a">{{$counseling_sum}}</h3>
                </div>

{{--                <div style="background: #1a202c; width: 13vw; height: 7vw"></div>--}}
            </div>
        </div>
        <div style="overflow: auto; width: 80vw; height: 66vh; display: flex; flex-direction: column; justify-content: start; padding: 10px 10px 0 15px; background: #f7f7f7; border-radius: 7px">
            <h4 style="background: white; padding: 10px 7px; margin: 0; border-top-left-radius: 7px; border-top-right-radius: 7px">Recent Counseling</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Major</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                @foreach($counseling as $key => $counselings)
                    <tr>
                        <th scope="row">{{$no++}}</th>
                        <td>{{$counselings->Student->name}}</td>
                        <td>{{$counselings->Grade->grade_name}}</td>
                        <td>{{\Carbon\Carbon::parse($counselings->counseling_date)->format('F d, Y')}}</td>
                        <td>{{$counselings->Status->status}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
