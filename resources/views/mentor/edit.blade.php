@extends('layout.main')
@section('container')
    <div style="height: 100vh; width: 80vw;display: flex;flex-direction: column; justify-content: start; overflow: auto; white-space: nowrap; margin-top: 10vh;">
        <div style="width: 77vw; height: 7.5vh; padding: 15px 10px 0 15px">
            <a href="/admin/mentor" style="text-decoration: none; color: #1a202c">
                <h5 style="margin-bottom: 15px; padding: 0">< Back to List</h5>
            </a>
            <form action="/mentor/edit/{{$mentor->id}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="form-group">
                    <label for="name">Full Name:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $mentor->name) }}">
                </div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" class="form-control" value="{{ old('username', $mentor->username) }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $mentor->email) }}" nullable>
                </div>
                <div class="form-group">
                    <label for="phone_number">No Telp:</label>
                    <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number', $mentor->phone_number) }}">
                </div>
                <div class="form-group">
                    <label for="birth_place">Birth Place:</label>
                    <input type="text" name="birth_place" id="birth_place" class="form-control" value="{{ old('birth_place', $mentor->birth_place) }}" nullable>
                </div>
                 <div class="form-group">
                     @php
                         $birth_date = $mentor->birth_date;
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
                            <option value="{{ $grade->id }}" {{ $mentor->grade_id == $grade->id ? 'selected' : '' }}>
                                {{ $grade->grade_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="last_education">Last Education:</label>
                    <input type="text" name="last_education" id="last_education" class="form-control" value="{{ old('last_education', $mentor->last_education) }}" required>
                </div>
                <div class="form-group">
                    <label for="last_university">Last University:</label>
                    <input type="text" name="last_university" id="last_university" class="form-control" value="{{ old('last_university', $mentor->last_university) }}" nullable>
                </div>
                <div class="form-group">
                    <label for="about_me">About Me:</label>
                    <input type="text" name="about_me" id="about_me" class="form-control" value="{{ old('about_me', $mentor->about_me) }}" nullable>
                </div>
                <div class="form-group">
                    <label for="image">Profile Image:</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary" style="margin-top: 15px; margin-bottom: 20px">Update konselor data</button>
            </form>
        </div>
    </div>
@endsection
