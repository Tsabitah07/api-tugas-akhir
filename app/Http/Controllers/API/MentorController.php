<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginMentorRequest;
use App\Http\Requests\Mentor\EditMentorRequest;
use App\Http\Requests\Mentor\MentorRequest;
use App\Models\Mentor;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MentorController extends Controller
{
    public function index()
    {
        $mentor = Mentor::all();

        return response()->json([
            'message' => 'Data Mentor berhasil diambil',
            'data' => $mentor
        ]);
    }

    public function store(MentorRequest $request)
    {
        $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image')->storePublicly('profile_mentor', 'public');
            $imageUrl = Storage::url($image);
        }

        $mentorAge = date_diff(date_create($request->birth_date), date_create(Date::now()))->y;

        $mentor = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role_id' => $request->role_id = 2,
            'grade_id' => $request->grade_id,
            'birth_place' => $request->birth_place,
            'birth_date' => $request->birth_date,
            'age' => $mentorAge,
            'gender' => $request->gender,
            'experience' => $request->experience,
            'last_education' => $request->last_education,
            'last_university' => $request->last_university,
            'phone_number' => $request->phone_number,
//            'user_id' => $request->user_id,
            'about_me' => $request->about_me,
            'linkedin' => $request->linkedin,
            'instagram' => $request->instagram,
            'twitter' => $request->twitter,
            'facebook' => $request->facebook,
            'image' => $imageUrl,
            'password' => Hash::make($request->password)
        ];

        $mentors = Mentor::create($mentor);

        return response()->json([
            'message' => 'Data Mentor berhasil ditambahkan',
            'data' => $mentors
        ]);
    }

    public function loginMentor(LoginMentorRequest $request)
    {
        $credentials = $request->validated();

        $mentor = Mentor::where('username', $credentials['username'])->first();

        if (!$mentor || !Hash::check($credentials['password'], $mentor->password)) {
            return response()->json([
                'message' => 'Email atau Password salah'
            ]);
        }

        $token = $mentor->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil',
            'token' => $token,
            'data' => $mentor
        ]);
    }

    public function edit(EditMentorRequest $request, $id)
    {
        $request->validated();
        $mentor = Mentor::find($id);

        if (!$mentor) {
            return response()->json([
                'message' => 'Data Mentor tidak ditemukan'
            ]);
        }

        if ($request->hasFile('image')) {
            $delete = Storage::delete('public/profile_mentor/' . $mentor->image);
            if ($delete) {
                $image = $request->file('image')->storePublicly('profile_mentor', 'public');
                $imageUrl = Storage::url($image);
            }
        }

        $data = $request->all();

        $mentorAge = date_diff(date_create($data['birth_date']), date_create(Date::now()))->y;

        $mentor->name = $data['name'];
        $mentor->username = $data['username'];
        $mentor->email = $data['email'];
        $mentor->role_id = $data['role_id'];
        $mentor->grade_id = $data['grade_id'];
        $mentor->birth_place = $data['birth_place'];
        $mentor->birth_date = $data['birth_date'];
        $mentor->age = $mentorAge;
        $mentor->gender = $data['gender'];
        $mentor->experience = $data['experience'];
        $mentor->last_education = $data['last_education'];
        $mentor->last_university = $data['last_university'];
        $mentor->phone_number = $data['phone_number'];
//        $mentor->user_id = $data['user_id'];
        $mentor->about_me = $data['about_me'];
        $mentor->linkedin = $data['linkedin'];
        $mentor->instagram = $data['instagram'];
        $mentor->twitter = $data['twitter'];
        $mentor->facebook = $data['facebook'];
        $mentor->image = $imageUrl;
        $mentor->password = Hash::make($data['password']);

        $mentor->save($data);

        return response()->json([
            'message' => 'Data Mentor berhasil diubah',
            'data' => $mentor
        ]);
    }

    public function detail($id)
    {
        $mentor = Mentor::find($id);

        if (!$mentor) {
            return response()->json([
                'message' => 'Data Mentor tidak ditemukan'
            ]);
        }

        return response()->json([
            'message' => 'Data Mentor berhasil diambil',
            'data' => $mentor
        ]);
    }

    public function delete($id)
    {
        $mentor = Mentor::find($id);

        if (!$mentor) {
            return response()->json([
                'message' => 'Data Mentor tidak ditemukan'
            ]);
        }

        $mentor->delete();

        return response()->json([
            'message' => 'Data Mentor berhasil dihapus'
        ]);
    }
}
