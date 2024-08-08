@extends('layout.main')
@section('container')
    <div style="height: 100vh; width: 80vw;display: flex;flex-direction: column; justify-content: start; overflow: auto; white-space: nowrap; margin-top: 10vh;">
        <div style="width: 77vw; height: 7.5vh; padding: 15px 10px 0 15px">
            <form action="/student/edit/{{$student->id}}" method="post">
                @csrf
                @method('post')
                <div class="form-group">
                    <label for="name">Full Name:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $student->name) }}">
                </div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" class="form-control" value="{{ old('username', $student->username) }}" required>
                </div>
                <div class="form-group">
                    <label for="username">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $student->email) }}">
                </div>
                <div class="form-group">
                    <label for="phone">No Telp:</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('email', $student->phone_number) }}">
                </div>
                <div class="form-group">
                    <label for="tempat_lahir">Birth Place:</label>
                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="{{ old('birth_place', $student->birth_place) }}" required>
                </div>
                <div class="form-group">
                    @php
                        $birth_date = $student->birth_date;
                        $format = 'd-m-Y';

                        // Check if the date is already in 'Y-m-d' format
                        if (preg_match('/\d{4}-\d{2}-\d{2}/', $birth_date)) {
                            $format = 'Y-m-d';
                        }

                        $birth_date = \Carbon\Carbon::createFromFormat($format, $birth_date)->format('Y-m-d');
                    @endphp

                    <label for="birth_date">Birthdate:</label>
                    <input type="date" name="birth_date" id="birth_date" class="form-control" value="{{ old('birth_date', $birth_date)}}" required>
                </div>
                <div class="form-group">
                    <label for="grade_id">Major:</label>
                    <select class="form-select" name="grade_id" id="grade_id">
                        @foreach($grades as $grade)
                            <option value="{{ $grade->id }}" {{ $student->grade_id == $grade->id ? 'selected' : '' }}>
                                {{ $grade->grade_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
{{--                <div class="form-group">--}}
{{--                    <label for="last_education">Last Education:</label>--}}
{{--                    <input type="text" name="last_education" id="last_education" class="form-control" value="{{ old('last_education', $mentor->last_education) }}" required>--}}
{{--                </div>--}}
{{--                <div class="form-group">--}}
{{--                    <label for="last_university">Last University:</label>--}}
{{--                    <input type="text" name="last_university" id="last_university" class="form-control" value="{{ old('last_university', $mentor->last_university) }}" required>--}}
{{--                </div>--}}
{{--                <div class="form-group">--}}
{{--                    <label for="about_me">About Me:</label>--}}
{{--                    <input type="text" name="about_me" id="about_me" class="form-control" value="{{ old('about_me', $mentor->about_me) }}" required>--}}
{{--                </div>--}}
                <button type="submit" class="btn btn-primary" style="margin-top: 15px; margin-bottom: 20px">Update student data</button>
            </form>
        </div>
    </div>
@endsection
