<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mentor\EditMentorRequest;
use App\Http\Requests\Mentor\MentorRequest;
use App\Models\Mentor;
use Illuminate\Support\Facades\Date;

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

        $mentorAge = date_diff(date_create($request->birth_date), date_create(Date::now()))->y;

        $mentor = [
            'name' => $request->name,
            'grade_id' => $request->grade_id,
            'birth_date' => $request->birth_date,
            'age' => $mentorAge,
            'gender' => $request->gender,
            'experience' => $request->experience,
            'last_education' => $request->last_education,
            'last_university' => $request->last_university,
            'phone_number' => $request->phone_number,
            'user_id' => $request->user_id,
            'about_me' => $request->about_me,
        ];

        $mentors = Mentor::create($mentor);

        return response()->json([
            'message' => 'Data Mentor berhasil ditambahkan',
            'data' => $mentors
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

        $data = $request->all();

        $mentorAge = date_diff(date_create($data['birth_date']), date_create(Date::now()))->y;

        $mentor->name = $data['name'];
        $mentor->grade_id = $data['grade_id'];
        $mentor->birth_date = $data['birth_date'];
        $mentor->age = $mentorAge;
        $mentor->gender = $data['gender'];
        $mentor->experience = $data['experience'];
        $mentor->last_education = $data['last_education'];
        $mentor->last_university = $data['last_university'];
        $mentor->phone_number = $data['phone_number'];
        $mentor->user_id = $data['user_id'];
        $mentor->about_me = $data['about_me'];

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
