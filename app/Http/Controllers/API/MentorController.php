<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\MentorRequest;
use Illuminate\Http\Request;
use App\Models\Mentor;
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

        $mentor = [
            'name' => $request->name,
            'grade_id' => $request->grade_id,
            'birth_date' => $request->birth_date,
            'age' => $request->age,
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

    public function edit(MentorRequest $request, $id)
    {
        $mentor = Mentor::find($id);

        if (!$mentor) {
            return response()->json([
                'message' => 'Data Mentor tidak ditemukan'
            ]);
        }

        $mentor->save($request->all());

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
