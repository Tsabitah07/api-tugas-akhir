<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\EditStudentRequest;
use App\Http\Requests\Student\StudentRequest;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;

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
            $imageName = time() . $request->file('id_card_image')->getClientOriginalName();
            $imagePath = $request->file('id_card_image')->storeAs('public/id_card', $imageName);
            $imageUrl = Storage::url($imagePath);
        }

        $student = [
            'user_id' => $request->user_id,
            'nis' => $request->nis,
            'name' => $request->name,
            'grade_id' => $request->grade_id,
            'phone_number' => $request->phone_number,
            'birth_date' => $request->birth_date,
            'id_card_image' => $imageUrl,
        ];

        $students = Student::create($student);
        return response()->json([
            'message' => 'Data Student berhasil ditambahkan',
            'data' => $students
        ]);
    }

    public function edit(EditStudentRequest $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Data Student tidak ditemukan'
            ]);
        }

        if ($request->hasFile('id_card_image')) {
            $delete = Storage::delete('public/id_card/' . $student->id_card_image);
            if ($delete) {
                $imageName = time() . $request->file('id_card_image')->getClientOriginalName();
                $imagePath = $request->file('id_card_image')->storeAs('public/id_card', $imageName);
                $imageUrl = Storage::url($imagePath);
            }
//            $imageName = time() . $request->file('id_card_image')->getClientOriginalName();
//            $imagePath = $request->file('image')->storeAs('public/studentId', $imageName);
//            $imageUrl = Storage::url($imagePath);
        }

        $data = $request->all();
        $student->nis = $data['nis'];
        $student->name = $data['name'];
        $student->grade_id = $data['grade_id'];
        $student->phone_number = $data['phone_number'];
        $student->birth_date = $data['birth_date'];
        $student->id_card_image = $data['id_card_image'] = $imageUrl;

        $student->save($data);

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
