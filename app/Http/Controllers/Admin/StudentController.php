<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExcelRequest;
use App\Http\Requests\Student\EditStudentRequest;
use App\Http\Requests\Student\StudentRequest;
use App\Imports\StudentImport;
use App\Models\Counseling;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Excel;

class StudentController extends Controller
{
    protected $excel;

    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }

    public function index()
    {
        $students = Student::latest()->get();

        $years = Student::select('year_of_entry')->distinct()->pluck('year_of_entry');
        $counts = [];

        foreach ($years as $year) {
            $counts[$year] = Student::where('year_of_entry', $year)->count();
        }

        return view('student', [
            'title' => 'Students',
            'no' => 1,
            'students' => $students,
            'years' => $years,
            'counts' => $counts,
        ]);
    }

    public function detail($id)
    {
        $student = Student::find($id);

        if ($student->image == null){
            $student->image = 'https://www.svgrepo.com/show/381886/user-profile-person.svg';
        }

        return view('student.detail',[
            'title' => 'Student Detail',
            'student' => $student,
        ]);
    }

    public function create()
    {
        $grades = Grade::all();
        return view('student.add',[
            'title' => 'Create Student',
            'grades' => $grades,
        ]);
    }

    public function import()
    {
        return view('student.import',[
            'title' => 'Import Student',
        ]);
    }

    public function store(  Request $request)
    {
        $student = $request->all();

        $student['password'] = Hash::make($request->password);

        $students = [
            'name' => $student['name'],
            'nis' => $student['nis'],
            'email' => $student['email'],
            'username' => $student['username'],
            'grade_id' => $student['grade_id'],
            'year_of_entry' => $student['year_of_entry'],
            'phone_number' => $student['phone_number'],
            'birth_place' => $student['birth_place'],
            'birth_date' => $student['birth_date'],
            'password' => $student['password'],
        ];

        Student::create($students);

        return redirect('/admin/student');
    }

    public function importExcel(ExcelRequest $request)
    {
        $this->excel->import(new StudentImport, $request->file('file'));

        return redirect('/admin/student')->with('success', 'Import success');
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
        $data = $request->all();
        $student = Student::find($id);

        $student->update($data);

        return redirect('/admin/student')->with('success', 'Mentor updated!');
    }


    public function destroy($id)
    {
        $student = Student::find($id);
        $counselings = Counseling::where('student_id', $id)->get();

        $student->delete();
        foreach ($counselings as $counseling) {
            $counseling->delete();
        }

        return redirect('/admin/student')->with('success', 'Student deleted!');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $students = Student::where('name', 'like', '%'.$search.'%')
            ->orWhere('nis', 'like', '%'.$search.'%')
            ->orWhere('year_of_entry', 'like', '%'.$search.'%')
            ->orWhereHas('Grade', function ($query) use ($search) {
                $query->where('grade_name', 'like', '%'.$search.'%');
            })
            ->get();

        // Fetch years and counts
        $years = Student::select('year_of_entry')->distinct()->pluck('year_of_entry');
        $counts = [];
        foreach ($years as $year) {
            $counts[$year] = Student::where('year_of_entry', $year)->count();
        }

        return view('student', [
            'title' => 'Students',
            'students' => $students,
            'no' => 1,
            'years' => $years,
            'counts' => $counts,
        ]);
    }
}
