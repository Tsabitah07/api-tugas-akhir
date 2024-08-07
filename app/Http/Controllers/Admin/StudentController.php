<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return view('student',[
            'title' => 'Students',
        ]);
    }

    public function detail($id)
    {
        return view('student-detail',[
            'title' => 'Student Detail',
            'id' => $id,
        ]);
    }
}
