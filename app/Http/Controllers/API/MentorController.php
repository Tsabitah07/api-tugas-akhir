<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\MentorRequest;
use Illuminate\Http\Request;
use App\Models\Mentor;

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
        $mentor = [
            'name' => $request->name,
            'profile_image' => $request->profile_image,
            'major' => $request->major,
            'birth_date' => $request->birth_date,
            'age' => $request->age,
            'experience' => $request->experience,
            'last_education' => $request->last_education,
            'phone_number' => $request->phone_number,
            'user_id' => $request->user_id
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

        $mentor->update($request->all());

        return response()->json([
            'message' => 'Data Mentor berhasil diubah',
            'data' => $mentor
        ]);
    }
}
