<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function index()
    {
        $student = Student::all();
        return response()->json([
            'message' => 'Data Student berhasil diambil',
            'data' => $student
        ]);
    }

    public function store(StudentRequest $request)
    {
        $request->validated();

        if ($request->hasFile('id_card_image')) {
            $idImage = $request->file('id_card_image')->storeAs('public/images');
            Storage::url($idImage);
        }

        $student = [
            'nis' => $request->nis,
            'name' => $request->name,
            'grade_id' => $request->grade_id,
            'phone_number' => $request->phone_number,
            'birth_date' => $request->birth_date,
            'id_card_image' => $request->$idImage,
        ];

        $students = Student::create($student);
        return response()->json([
            'message' => 'Data Student berhasil ditambahkan',
            'data' => $students
        ]);
    }

    public function edit(StudentRequest $request, $id)
    {
        $student = Student::find($id);

        if ($request->hasFile('profile_image')) {
            Storage::delete('public/images/' . $student->profile_image);
            $idImage = $request->file('id_card_image')->storeAs('public/images');
            Storage::url($idImage);
        }

        if (!$student) {
            return response()->json([
                'message' => 'Data Student tidak ditemukan'
            ]);
        }

        $student->save($request->all());

        return response()->json([
            'message' => 'Data Student berhasil diubah',
            'data' => $student
        ]);
    }

    public function detail($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Data Student tidak ditemukan'
            ]);
        }

        return response()->json([
            'message' => 'Data Student berhasil diambil',
            'data' => $student
        ]);
    }

    public function delete($id)
    {
        $student = Student::find($id);
        $student->delete();

        return response()->json([
            'message' => 'Data Student berhasil dihapus'
        ]);
    }
}
