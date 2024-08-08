<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\EditStudentRequest;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::latest()->get();

        return view('student',[
            'title' => 'Students',
            'no' => 1,
            'students' => $students,
        ]);
    }

    public function detail($id)
    {
        $student = Student::find($id);

        return view('student.detail',[
            'title' => 'Student Detail',
            'student' => $student,
        ]);
    }

    public function create()
    {
        return view('student.create',[
            'title' => 'Create Student',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'min:5|unique:students|string',
            'email' => 'email|nullable',
            'username' => 'min:5|unique:students|string|nullable',
            'name' => 'max:255',
            'role_id' => 'nullable|integer',
            'grade_id' => 'required|integer',
            'phone_number' => 'min:10',
            'birth_place' => 'string',
            'birth_date' => 'string',
            'year_of_entry' => 'string',
            'password' => 'min:8',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $student = new Student();
        $student->nis = $request->nis;
        $student->email = $request->email;
        $student->username = $request->username;
        $student->name = $request->name;
        $student->role_id = $request->role_id;
        $student->grade_id = $request->grade_id;
        $student->phone_number = $request->phone_number;
        $student->birth_place = $request->birth_place;
        $student->birth_date = $request->birth_date;
        $student->year_of_entry = $request->year_of_entry;
        $student->password = bcrypt($request->password);
        $student->image = $request->image->store('images');

        $student->save();

        return redirect('/student');
    }

    public function editView($id)
    {
        $student = Student::find($id);
        $grades = Grade::all();

        return view('student.edit',[
            'title' => 'Edit Student',
            'student' => $student,
            'grades' => $grades,
        ]);
    }

    public function edit(EditStudentRequest $request, $id)
    {
        $data = $request->validated();
        $student = Student::find($id);

        $student->update($data);

        return redirect('/admin/student')->with('success', 'Mentor updated!');
    }


    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();

        return redirect('/admin/student')->with('success', 'Student deleted!');
    }
}
