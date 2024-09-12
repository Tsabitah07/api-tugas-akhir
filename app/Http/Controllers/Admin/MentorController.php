<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mentor\EditMentorRequest;
use App\Http\Requests\Mentor\MentorRequest;
use App\Models\Grade;
use App\Models\Mentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MentorController extends Controller
{
    public function index()
    {
        $mentors = Mentor::latest()->get();

        foreach ($mentors as $mentor) {
            if ($mentor->image == null){
                $mentor->image = 'https://www.svgrepo.com/show/381886/user-profile-person.svg';
            }
        }

        return view('mentor',[
            'title' => 'Konselor',
            'mentors' => $mentors
        ]);
    }

    public function show($id)
    {
        $mentor = Mentor::find($id);

        if ($mentor->image == null){
            $mentor->image = 'https://www.svgrepo.com/show/381886/user-profile-person.svg';
        }

        return view('mentor.detail',[
            'title' => 'Konselor Detail',
            'mentor' => $mentor
        ]);
    }

    public function create()
    {
        $grade = Grade::all();

        return view('mentor.add',[
            'title' => 'Create Konselor',
            'grades' => $grade
        ]);
    }

    public function store(MentorRequest $request)
    {
        $data = $request->all();

        if ($request->birth_date != null) {
            $data['age'] = date('Y') - date('Y', strtotime($request->birth_date));
        }

        if ($request->password == null) {
            if ($request->grade_id == 1) {
                $data['password'] = Hash::make('mentor123');
            }
        }

        if ($request->hasFile('image')) {
            $data['image'] =Storage::url($request->file('image')->store('images/profile_mentor', 'public'));
        }

        Mentor::create($data);

        return redirect('/admin/mentor')->with('success', 'Mentor added!');
    }

    public function editView($id)
    {
        $mentor = Mentor::find($id);
        $grade = Grade::all();

        return view('mentor.edit',[
            'title' => 'Edit Konselor',
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

        if ($request->hasFile('image')) {
            $data['image'] = Storage::url($request->file('image')->store('images/profile_mentor', 'public'));
        } else {
            $data['image'] = $mentor->image;
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
            'title' => 'Konselor',
            'mentors' => $mentors
        ]);
    }
}
