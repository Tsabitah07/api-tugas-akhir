<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SelfcareRequest;
use App\Models\Selfcare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SelfcareController extends Controller
{
    public function index()
    {
        $selfcare = Selfcare::all();

        return view('selfcare.index', [
            'title' => 'Selfcare',
            'selfcare' => $selfcare
        ]);
    }

    public function show($id)
    {
        $selfcare = Selfcare::find($id);

        return view('selfcare.show', [
            'title' => 'Selfcare',
            'selfcare' => $selfcare
        ]);
    }

    public function create()
    {
        return view('selfcare.add', [
            'title' => 'Selfcare'
        ]);
    }

    public function store(SelfcareRequest $request)
    {
        $request->all();

        if ($request->hasFile('image')) {
            $imageUrl = Storage::url($request->file('image')->store('images/selfcare', 'public'));
        }

        Selfcare::create([
            'title' => $request->title,
            'description' => $request->description,
            'link' => $request->link,
            'image' => $imageUrl
        ]);

        return redirect('/admin/selfcare');
    }

    public function edit($id)
    {
        $selfcare = Selfcare::find($id);

        return view('selfcare.edit', [
            'title' => 'Selfcare',
            'selfcare' => $selfcare
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->all();

        $selfcare = Selfcare::find($id);

        if ($request->hasFile('image')) {
            $imageUrl = Storage::url($request->file('image')->store('images/selfcare', 'public'));
        } else {
            $imageUrl = $selfcare->image;
        }

        $selfcare->update([
            'title' => $request->title,
            'description' => $request->description,
            'link' => $request->link,
            'image' => $imageUrl
        ]);

        return redirect('/admin/selfcare');
    }

    public function destroy($id)
    {
        $selfcare = Selfcare::find($id);
        $selfcare->delete();

        return redirect('/admin/selfcare');
    }

    public function search(Request $request)
    {
        $selfcare = Selfcare::where('title', 'like', '%'.$request->search.'%')->get();

        return view('selfcare.index', [
            'title' => 'Selfcare',
            'selfcare' => $selfcare
        ]);
    }
}
