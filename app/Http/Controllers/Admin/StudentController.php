<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExcelRequest;
use App\Http\Requests\Student\EditStudentRequest;
use App\Imports\StudentImport;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;
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

    public function store(Request $request)
    {
        $student = $request->all();

        Student::create($student);

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

    public function search(Request $request)
    {
        $search = $request->input('search');
        $students = Student::where('name', 'like', '%'.$search.'%')
            ->orWhere('nis', 'like', '%'.$search.'%')
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
