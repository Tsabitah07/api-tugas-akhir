<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Shortselfcare;
use Illuminate\Http\Request;

class ShortSelfcareController extends Controller
{
    public function index()
    {
        $short = ShortSelfcare::all();

        return response()->json([
            'message' => 'Data Short Selfcare berhasil diambil',
            'data' => $short
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required|string|max:255'
        ]);

        $short = ShortSelfcare::create($request->all());

        return response()->json([
            'message' => 'Data Short Selfcare berhasil ditambahkan',
            'data' => $short
        ]);
    }

    public function show($id)
    {
        $short = ShortSelfcare::find($id);

        if (!$short) {
            return response()->json([
                'message' => 'Data Short Selfcare tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'message' => 'Data Short Selfcare berhasil diambil',
            'data' => $short
        ]);
    }

    public function update(Request $request, $id)
    {
        $short = ShortSelfcare::find($id);

        if (!$short) {
            return response()->json([
                'message' => 'Data Short Selfcare tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'text' => 'required|string|max:255'
        ]);

        $short->update($request->all());

        return response()->json([
            'message' => 'Data Short Selfcare berhasil diubah',
            'data' => $short
        ]);
    }

    public function destroy($id)
    {
        $short = ShortSelfcare::find($id);

        if (!$short) {
            return response()->json([
                'message' => 'Data Short Selfcare tidak ditemukan'
            ], 404);
        }

        $short->delete();

        return response()->json([
            'message' => 'Data Short Selfcare berhasil dihapus'
        ]);
    }
}
