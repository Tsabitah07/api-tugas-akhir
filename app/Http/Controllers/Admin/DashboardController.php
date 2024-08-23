<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Counseling;
use App\Models\CounselingStatus;
use App\Models\Mentor;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $student_sum = Student::all()->count();
        $mentor_sum = Mentor::all()->count();
        $counseling_sum = Counseling::all()->count();

        $counseling = Counseling::latest()->take(9)->get();

        return view('dashboard',[
            'title' => 'Dashboard',
            'no' => 1,
            'counseling' => $counseling,
            'student_sum' => $student_sum,
            'mentor_sum' => $mentor_sum,
            'counseling_sum' => $counseling_sum
        ]);
    }

    public function status()
    {
        $status = CounselingStatus::all();

        $counseling = Counseling::where('counseling_status_id', $status->id);
    }
}
