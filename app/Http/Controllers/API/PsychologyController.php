<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PsychologyRequest;
use App\Models\Psychology;
use Illuminate\Support\Facades\Storage;

class PsychologyController extends Controller
{
    public function index()
    {
        $psychologies = Psychology::latest()->get();

        return response()->json([
            'message' => 'success',
            'data' => $psychologies,
        ]);
    }

    public function store(PsychologyRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $imageName = time() . $request->file('image')->getClientOriginalName();
            $imagePath = $request->file('image')->storeAs('public/psychology', $imageName);
            $imageUrl = Storage::url($imagePath);
        } else {
            $imageUrl = null;
        }

        $data['image'] = $imageUrl;

        $psychology = Psychology::create($data);

        return response()->json([
            'message' => 'success',
            'data' => $psychology,
        ]);
    }

    public function detail($slug)
    {
        $psychology = Psychology::where('slug', $slug)->latest()->first();

        if (!$psychology){
            return response()->json([
                'message' => 'Data Psychology tidak ditemukan'
            ]);
        }

        return response()->json([
            'message' => 'Data Psychology berhasil diambil',
            'data' => $psychology
        ]);
    }

    public function edit(PsychologyRequest $request, $id)
    {
        $request->validated();

        $psychology = Psychology::where('id', $id)->first();

        if ($request->hasFile('image')) {
            $delete = Storage::delete('public/psychology/' . $psychology->image);
            if ($delete) {
                $imageName = time() . $request->file('image')->getClientOriginalName();
                $imagePath = $request->file('image')->storeAs('public/psychology', $imageName);
                $imageUrl = Storage::url($imagePath);
            }
        }

        if (!$psychology) {
            return response()->json([
                'message' => 'Data Psychology tidak ditemukan'
            ]);
        }

        $psychology->image = $imageUrl;

        $psychology->update($request->all());

        return response()->json([
            'message' => 'Data Psychology berhasil diubah',
            'data' => $psychology
        ]);
    }

    public function delete($id)
    {
        $psychology = Psychology::find($id);

        if (!$psychology) {
            return response()->json([
                'message' => 'Data Psychology tidak ditemukan'
            ]);
        }

        $psychology->delete();

        return response()->json([
            'message' => 'Data Psychology berhasil dihapus'
        ]);
    }
}
