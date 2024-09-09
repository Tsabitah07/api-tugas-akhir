<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Counseling;
use App\Models\Grade;
use App\Models\Mentor;
use App\Models\Student;
use Illuminate\Http\Request;

class CounselingController extends Controller
{
    public function index()
    {
        $counseling = Counseling::latest()->simplePaginate(7);
        $grades = Grade::all();

        return view('counseling.index', [
            'title' => 'Counseling',
            'no' => 1,
            'counseling' => $counseling,
            'grades' => $grades
        ]);
    }

    public function show($id)
    {
        $counseling = Counseling::find($id);
        $mentors = Mentor::where('grade_id', $counseling->grade_id)->first();

        return view('counseling.detail', [
            'title' => 'Counseling Detail',
            'counseling' => $counseling,
            'mentors' => $mentors
        ]);
    }

    public function destroy($id)
    {
        $counseling = Counseling::find($id);
        $counseling->delete();

        return redirect('/admin/counseling')->with('success', 'Counseling has been deleted');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        // Assuming 'students' is the related model to 'counselings'
        $counseling = Counseling::whereHas('Student', function ($query) use ($searchTerm) {
            $query->where('name', 'like', '%' . $searchTerm . '%');
        })->get();

        return view('counseling.index', [
            'title' => 'Counseling',
            'no' => 1,
            'counseling' => $counseling,
        ]);
    }
}
