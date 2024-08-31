<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PsychologyRequest;
use App\Models\Psychology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PsychologyController extends Controller
{
    public function index()
    {
        $psychologies = Psychology::all();

        return view('psychology.index', [
            'title' => 'Tes Mengenal Diri',
            'psychology' => $psychologies
        ]);
    }

    public function show($id)
    {
        $psychology = Psychology::find($id);

        return view('psychology.detail', [
            'title' => 'Tes Mengenal Diri',
            'psychology' => $psychology
        ]);
    }

    public function create()
    {
        return view('psychology.add', [
            'title' => 'Tes Mengenal Diri'
        ]);
    }

    public function store(PsychologyRequest $request)
    {
        $request->all();

        if ($request->hasFile('image')) {
            $imgUrl = Storage::url($request->file('image')->store('images/psychology', 'public'));
        }

        Psychology::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imgUrl,
            'link' => $request->link
        ]);

        return redirect('/admin/psychology');
    }

    public function editView($id)
    {
        $psychology = Psychology::find($id);

        return view('psychology.edit', [
            'title' => 'Tes Mengenal Diri',
            'psychology' => $psychology
        ]);
    }

    public function edit(Request $request, $id)
    {
        $data = $request->all();

        $psychology = Psychology::find($id);

        if ($request->hasFile('image')) {
            $imgUrl = Storage::url($request->file('image')->store('public/psychology', 'public'));
            $data['image'] = $imgUrl;
        } else {
            $data['image'] = $psychology->image;
        }

        $psychology->update($data);

        return redirect('/admin/psychology');
    }

    public function destroy($id)
    {
        $psychology = Psychology::find($id);
        $psychology->delete();

        return redirect('/admin/psychology');
    }

    public function search(Request $request)
    {
        $psychologies = Psychology::where('title', 'like', '%'.$request->search.'%')->get();

        return view('psychology.index', [
            'title' => 'Tes Mengenal Diri',
            'psychology' => $psychologies
        ]);
    }
}
