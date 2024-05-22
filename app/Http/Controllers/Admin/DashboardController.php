<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index($id)
    {
        return view('dashboard.index',[
            'title' => 'Dashboard',
            'id' => User::find($id)
        ]);
    }
}
