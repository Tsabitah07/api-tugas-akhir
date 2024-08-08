@extends('layout.main')
@section('container')
    <div style="height: 100vh; width: 80vw;display: flex;flex-direction: column; justify-content: start; overflow: auto; white-space: nowrap; margin-top: 10vh;">
        <div style="width: 80vw; height: 7.5vh; padding: 15px 10px 0 15px">
            <a href="/admin/student" style="text-decoration: none; color: #1a202c">
                <h5 style="margin: 0; padding: 0">Back to List</h5>
            </a>
        </div>
        <div style="display: flex; flex-direction: row; width: 80vw; height: 82.5vh">
            <div style="width: 20vw; display: flex; flex-direction: column; justify-content: start; align-items: center;">
                <img src="@env('APP_URL') @endenv{{$student->image}}" style="width: 18vw; height: 24vw">
            </div>

            <div style="display: flex; flex-direction: column">
                <div style="width: 59vw; height: 27vh; padding-left: 10px; display: flex; flex-direction: column">
                    <h3 style="border-bottom: #1a202c 1px solid">{{$student->name}}</h3>

                    <div style="display: flex; flex-direction: row; justify-content: space-between; margin-top: 7px">
                        <div style="background: white; display: flex; flex-direction: row; width: 27vw; height: 19vh">
                            <div style="width: 8vw; height: 19vh; display: flex; flex-direction: column; justify-content: space-between; font-size: large">
                                <p style="margin: 0; padding: 0">NIS</p>
                                <p style="margin: 0; padding: 0">Email</p>
                                <p style="margin: 0; padding: 0">Major</p>
                                <p style="margin: 0; padding: 0">Entry Year</p>
                            </div>

                            <div style="width: 16.5vw; height: 19vh; display: flex; flex-direction: column; justify-content: space-between; font-size: large">
                                <p style="margin: 0; padding: 0">: {{$student->nis}}</p>
                                <p style="margin: 0; padding: 0">: {{$student->email}}</p>
                                <p style="margin: 0; padding: 0">: {{$student->Grade->grade_name}}</p>
                                <p style="margin: 0; padding: 0">: {{$student->year_of_entry}}</p>
                            </div>
                        </div>

                        <div style="background: white; display: flex; flex-direction: row; width: 30vw; height: 19vh">
                            <div style="width: 8vw; height: 19vh; display: flex; flex-direction: column; justify-content: space-between; font-size: large">
                                <p style="margin: 0; padding: 0">Username</p>
                                <p style="margin: 0; padding: 0">Phone Number</p>
                                <p style="margin: 0; padding: 0">Birth Place</p>
                                <p style="margin: 0; padding: 0">Birthdate</p>
                            </div>

                            <div style="width: 16.5vw; height: 19vh; display: flex; flex-direction: column; justify-content: space-between; font-size: large">
                                <p style="margin: 0; padding: 0">: {{$student->username}}</p>
                                <p style="margin: 0; padding: 0">: {{$student->phone_number}}</p>
                                <p style="margin: 0; padding: 0">: {{$student->birth_place}}</p>
                                <p style="margin: 0; padding: 0">: {{\Carbon\Carbon::parse($student->birth_date)->format('F m, Y')}}</p>
                            </div>
                        </div>
                    </div>
                </div>

{{--                <div style="width: 59vw; height: 15vh; display: flex; flex-direction: column; padding: 10px 0 0 10px">--}}
{{--                    <h5 style="border-bottom: #1a202c 1px solid">Study & Experience</h5>--}}

{{--                    <div style="display: flex; flex-direction: row; justify-content: space-between">--}}
{{--                        <div style="display: flex; flex-direction: row; width: 27vw; height: 8vh">--}}
{{--                            <div style="width: 8vw; height: 8vh; display: flex; flex-direction: column; justify-content: space-between; font-size: large">--}}
{{--                                <p style="margin: 0; padding: 0">Last Education</p>--}}
{{--                                <p style="margin: 0; padding: 0">University</p>--}}
{{--                            </div>--}}

{{--                            <div style="width: 16.5vw; height: 8vh; display: flex; flex-direction: column; justify-content: space-between; font-size: large">--}}
{{--                                <p style="margin: 0; padding: 0">: {{$mentor->last_education}}</p>--}}
{{--                                <p style="margin: 0; padding: 0">: {{$mentor->last_university}}</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div style="display: flex; flex-direction: row; width: 30vw; height: 8vh">--}}
{{--                            <div style="width: 8vw; height: 8vh; display: flex; flex-direction: column; justify-content: space-between; font-size: large">--}}
{{--                                <p style="margin: 0; padding: 0">Experience</p>--}}
{{--                                --}}{{--                                <p style="margin: 0; padding: 0">Birthdate</p>--}}
{{--                            </div>--}}

{{--                            <div style="width: 16.5vw; height: 8vh; display: flex; flex-direction: column; justify-content: space-between; font-size: large">--}}
{{--                                <p style="margin: 0; padding: 0">: {{$mentor->birth_place}}</p>--}}
{{--                                --}}{{--                                <p style="margin: 0; padding: 0">: {{\Carbon\Carbon::parse($mentor->birth_date)->format('F m, Y')}}</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div style="width: 59vw; height: 20vh; display: flex; flex-direction: column; padding-left: 10px; padding-top: 10px">--}}
{{--                    <h5 style="border-bottom: #1a202c 1px solid">About Me</h5>--}}
{{--                    <p style="width: 58vw; height: 20vh; overflow: auto">{{$mentor->about_me}}</p>--}}
{{--                </div>--}}

                {{--                <div style="width: 59vw; height: 6vh; display: flex; flex-direction: row; justify-content: space-around; align-items: center; font-size: large;">--}}
                {{--                    <p style="padding: 0; margin: 0">Linkedin</p>--}}
                {{--                    <p style="padding: 0; margin: 0">Facebook</p>--}}
                {{--                    <p style="padding: 0; margin: 0">Instagram</p>--}}
                {{--                    <p style="padding: 0; margin: 0">Twitter</p>--}}
                {{--                </div>--}}
            </div>
        </div>
    </div>
@endsection
