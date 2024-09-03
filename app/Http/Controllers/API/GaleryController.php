<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\GaleryRequest;
use App\Models\Galery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleryController extends Controller
{
    public function index()
    {
        $galery = Galery::all();

        return response()->json([
            'status' => 'success',
            'data' => $galery
        ]);
    }

    public function store(GaleryRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = Storage::url($request->file('image')->store('galery', 'public'));
        } else {
            $data['image'] = null;
        }

        if ($request->has('tags')) {
            $data['tags'] = json_encode($request->tags);
        }

        $galery = Galery::create($data);

        return response()->json([
            'status' => 'success',
            'data' => $galery
        ]);
    }

    public function edit(GaleryRequest $request, $id)
    {
        $galery = Galery::find($id);

        if (!$galery) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Galery not found'
            ]);
        }

        if ($request->hasFile('image')) {
            $delete = Storage::delete('public/' . $galery->image);
            if ($delete) {
                $galery->update([
                    'image' => Storage::url($request->file('image')->store('galery', 'public'))
                ]);
            }
        }

        $data = $request->all();

        if ($request->has('tags')) {
            $data['tags'] = json_encode($request->tags);
        }

        $galery->update($data);

        return response()->json([
            'status' => 'success',
            'data' => $galery
        ]);
    }

    public function detail($id)
    {
        $galery = Galery::find($id);

        if (!$galery) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Galery not found'
            ]);
        }

        return response()->json([
            'status' => 'success',
            'data' => $galery
        ]);
    }

    public function delete($id)
    {
        $galery = Galery::find($id);

        if (!$galery) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Galery not found'
            ]);
        }

        $delete = Storage::delete('public/' . $galery->image);

        if ($delete) {
            $galery->delete();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Galery deleted'
        ]);
    }
}
