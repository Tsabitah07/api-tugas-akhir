<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SelfcareRequest;
use App\Models\Selfcare;

class SelfcareController extends Controller
{
    public function store(SelfcareRequest $request)
    {
        $request->validated();

        $selfcare = [
            'title' => $request->title,
            'description' => $request->description,
            'tutorial' => $request->tutorial,
            'steps' => [
                'one' => $request->text,
                'two' => $request->text2,
                'three' => $request->text3,
                'four' => $request->text4,
                'five' => $request->text5
            ]
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

    public function show($id)
    {
        $selfcare = Selfcare::find($id);

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

        if (!$selfcare) {
            return response()->json([
                'message' => 'Data Selfcare tidak ditemukan'
            ]);
        }

        $selfcare->update([
            'title' => $request->title,
            'description' => $request->description,
            'tutorial' => $request->tutorial,
            'steps' => [
                'one' => $request->text,
                'two' => $request->text2,
                'three' => $request->text3,
                'four' => $request->text4,
                'five' => $request->text5
            ]
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
