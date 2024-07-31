<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Student\EditStudentRequest;
use App\Http\Requests\Student\StudentRequest;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

        if ($request->hasFile('image')) {
            $image = $request->file('image')->storePublicly('profile', 'public');
            $imageUrl = Storage::url($image);
        }

        $student = [
//            'user_id' => $request->user_id,
            'nis' => $request->nis,
            'email' => $request->email,
            'name' => $request->name,
            'role_id' => $request->role_id = 3,
            'grade_id' => $request->grade_id,
            'phone_number' => $request->phone_number,
            'birth_place' => $request->birth_place,
            'birth_date' => $request->birth_date,
            'password' => Hash::make($request->password),
            'image' => $imageUrl,
//            'id_card_image' => $imageUrl,
        ];

        $students = Student::create($student);
        return response()->json([
            'message' => 'Data Student berhasil ditambahkan',
            'data' => $students
        ]);
    }

    public function loginStudent(LoginRequest $request)
    {
        $credentials = $request->validated();

        $student = Student::where('nis', $credentials['nis_or_email'])->orWhere('email', $credentials['nis_or_email'])->first();

        if (!$student || !Hash::check($credentials['password'], $student->password)) {
            return response()->json([
                'message' => 'NIS / email atau Password salah'
            ]);
        }

        $token = $student->createToken('authToken')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil',
            'token' => $token,
            'data' => $student
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

        if ($request->hasFile('image')) {
            $delete = Storage::delete('public/profile/' . $student->image);
            if ($delete) {
                $imageName = time() . $request->file('image')->getClientOriginalName();
                $imagePath = $request->file('image')->storeAs('public/profile', $imageName);
                $imageUrl = Storage::url($imagePath);
            }
        }

        $data = $request->all();
        $student->nis = $data['nis'];
        $student->email = $data['email'];
        $student->name = $data['name'];
        $student->role_id = $data['role_id'];
        $student->grade_id = $data['grade_id'];
        $student->phone_number = $data['phone_number'];
        $student->birth_place = $data['birth_place'];
        $student->birth_date = $data['birth_date'];
        $student->password = Hash::make($data['password']);
        $student->image = $data['image'] = $imageUrl;

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
