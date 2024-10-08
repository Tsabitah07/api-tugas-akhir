<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SelfcareRequest;
use App\Models\Selfcare;
use Illuminate\Support\Facades\Storage;

class SelfcareController extends Controller
{
    public function store(SelfcareRequest $request)
    {
        $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image')->storePublicly('selfcare', 'public');
            $imageUrl = Storage::url($image);
        } else {
            $imageUrl = null;
        }

        $selfcare = [
            'title' => $request->title,
            'description' => $request->description,
            'slug' => $request->slug,
            'link' => $request->link,
            'image' => $imageUrl,
        ];

        $data = Selfcare::create($selfcare);

        return response()->json([
            'message' => 'Data Selfcare berhasil ditambahkan',
            'data' => $data
        ]);
    }

    public function index()
    {
        $selfcare = Selfcare::all();

        return response()->json([
            'message' => 'Data Selfcare berhasil diambil',
            'data' => $selfcare
        ]);
    }

    public function show($slug)
    {
        $selfcare = Selfcare::where('slug', $slug)->first();

        if (!$selfcare) {
            return response()->json([
                'message' => 'Data Selfcare tidak ditemukan'
            ]);
        }

        return response()->json([
            'message' => 'Data Selfcare berhasil diambil',
            'data' => $selfcare
        ]);
    }

    public function update(SelfcareRequest $request, $id)
    {
        $request->validated();

        $selfcare = Selfcare::find($id);

        if ($request->hasFile('image')) {
            $delete = Storage::delete('public/selfcare/' . $selfcare->image);
            if ($delete) {
                $image = $request->file('image')->storePublicly('selfcare', 'public');
                $imageUrl = Storage::url($image);
            }
        }

        if (!$selfcare) {
            return response()->json([
                'message' => 'Data Selfcare tidak ditemukan'
            ]);
        }

        $selfcare->update([
            'title' => $request->title,
            'description' => $request->description,
            'slug' => $request->slug,
            'link' => $request->link,
            'image' => $imageUrl,
        ]);

        $selfcare->save();

        return response()->json([
            'message' => 'Data Selfcare berhasil diubah',
            'data' => $selfcare
        ]);
    }

    public function destroy($id)
    {
        $selfcare = Selfcare::find($id);

        if (!$selfcare) {
            return response()->json([
                'message' => 'Data Selfcare tidak ditemukan'
            ]);
        }

        $selfcare->delete();

        return response()->json([
            'message' => 'Data Selfcare berhasil dihapus'
        ]);
    }
}
