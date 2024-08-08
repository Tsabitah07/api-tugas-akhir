<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mentor\EditMentorRequest;
use App\Models\Grade;
use App\Models\Mentor;
use Illuminate\Http\Request;

class MentorController extends Controller
{
    public function index()
    {
        $mentors = Mentor::all();
        return view('mentor',[
            'title' => 'Mentor',
            'mentors' => $mentors
        ]);
    }

    public function show($id)
    {
        $mentor = Mentor::find($id);

        return view('mentor.detail',[
            'title' => 'Mentor Detail',
            'mentor' => $mentor
        ]);
    }

    public function create()
    {
        return view('mentor.create',[
            'title' => 'Create Mentor'
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        Mentor::create($data);

        return redirect()->route('mentor.index')->with('success', 'Mentor created!');
    }

    public function editView($id)
    {
        $mentor = Mentor::find($id);
        $grade = Grade::all();

        return view('mentor.edit',[
            'title' => 'Edit Mentor',
            'mentor' => $mentor,
            'grades' => $grade
        ]);
    }

    public function edit(EditMentorRequest $request, $id)
    {
        $data = $request->validated();
        $mentor = Mentor::find($id);

        if ($request->birth_date != null) {
            $data['age'] = date('Y') - date('Y', strtotime($request->birth_date));
        } else {
            $data['age'] = $mentor->age;
        }

        $mentor->update($data);

        return redirect('/admin/mentor')->with('success', 'Mentor updated!');
    }

    public function destroy($id)
    {
        $mentor = Mentor::find($id);
        $mentor->delete();

        return redirect('/admin/mentor')->with('success', 'Mentor deleted!');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $mentors = Mentor::where('name', 'like', '%'.$search.'%')->get();

        return view('mentor',[
            'title' => 'Mentor',
            'mentors' => $mentors
        ]);
    }
}
