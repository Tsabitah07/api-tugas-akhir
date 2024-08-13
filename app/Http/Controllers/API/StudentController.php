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

        if ($request->role_id != null) {
            $role = $request->role_id;
        } else {
            $role = 3;
        }

        $student = [
//            'user_id' => $request->user_id,
            'nis' => $request->nis,
            'email' => $request->email,
            'username' => $request->username,
            'name' => $request->name,
            'role_id' => $role,
            'grade_id' => $request->grade_id,
            'phone_number' => $request->phone_number,
            'birth_place' => $request->birth_place,
            'birth_date' => $request->birth_date,
            'year_of_entry' => $request->year_of_entry,
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
            ], 422);
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
                $image = $request->file('image')->storePublicly('profile', 'public');
                $imageUrl = Storage::url($image);
            }
        }

        $data = $request->all();
        $student->nis = $data['nis'];
        $student->email = $data['email'];
        $student->username = $data['username'];
        $student->name = $data['name'];
        $student->role_id = $data['role_id'];
        $student->grade_id = $data['grade_id'];
        $student->phone_number = $data['phone_number'];
        $student->birth_place = $data['birth_place'];
        $student->birth_date = $data['birth_date'];
        $student->year_of_entry = $data['year_of_entry'];
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

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout berhasil'
        ]);
    }

    public function editUsername(EditStudentRequest $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Data Student tidak ditemukan'
            ]);
        }

        if ($request->username == $student->username) {
            return response()->json([
                'message' => 'Username sama dengan sebelumnya'
            ]);
        }

        if (Student::where('username', $request->username)->first()) {
            return response()->json([
                'message' => 'Username sudah digunakan'
            ]);
        }

        $student->username = $request->username;
        $student->save();

        return response()->json([
            'message' => 'Username berhasil diubah',
            'data' => $student
        ]);
    }

    public function editEmail(EditStudentRequest $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Data Student tidak ditemukan'
            ]);
        }

        if ($request->email == $student->email) {
            return response()->json([
                'message' => 'Email sama dengan sebelumnya'
            ]);
        }

        if (Student::where('email', $request->email)->first()) {
            return response()->json([
                'message' => 'Email sudah digunakan'
            ]);
        }

        $student->email = $request->email;
        $student->save();

        return response()->json([
            'message' => 'Email berhasil diubah',
            'data' => $student
        ]);
    }

    public function editPassword(EditStudentRequest $request, $id)
    {
        $student = Student::find($id);
        $student->password = Hash::make($request->password);
        $student->save();

        return response()->json([
            'message' => 'Password berhasil diubah',
            'data' => $student
        ]);
    }

    public function editImage(EditStudentRequest $request, $id)
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
                $image = $request->file('image')->storePublicly('profile', 'public');
                $imageUrl = Storage::url($image);
            }
        }

        $student->image = $imageUrl;
        $student->save();

        return response()->json([
            'message' => 'Image berhasil diubah',
            'data' => $student
        ]);
    }

    public function showByGrade($id)
    {
        $student = Student::whereGradeId($id)->latest()->get();

        return response()->json([
            'message' => 'Data Student berhasil diambil',
            'data' => $student
        ]);
    }

    public function showByEntryYear($year)
    {
        $student = Student::where('year_of_entry', $year)->latest()->get();

        return response()->json([
            'message' => 'Data Student berhasil diambil',
            'data' => $student
        ]);
    }

    public function search($search)
    {
        $student = Student::where('name', 'like', '%' . $search . '%')
            ->orWhere('nis', 'like', '%' . $search . '%')
            ->orWhere('username', 'like', '%' . $search . '%')
            ->get();

        return response()->json([
            'message' => 'Data Student berhasil diambil',
            'data' => $student
        ]);
    }
}
