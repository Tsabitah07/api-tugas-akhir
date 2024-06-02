<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\DataRequest;
use App\Models\DataCategory;
use App\Models\DataService;
use Illuminate\Http\Request;

class DisplayDataController extends Controller
{
    public function addService(DataRequest $request)
    {
        $request->validated();

        $data = [
            'name' => $request->name,
            'description' => $request->description,
        ];

        $data = DataService::create($data);

        return response()->json([
            'message' => 'Data berhasil ditambahkan',
            'data' => $data
        ]);
    }

    public function editService(DataRequest $request, $id)
    {
        $data = DataService::find($id);

        if (!$data) {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ]);
        }

        $data->save($request->all());

        return response()->json([
            'message' => 'Data berhasil diubah',
            'data' => $data
        ]);
    }

    public function service()
    {
        $data = DataService::all();

        return response()->json([
            'message' => 'Data berhasil diambil',
            'data' => $data
        ]);
    }

    public function addCategory(DataRequest $request)
    {
        $request->validated();

        $data = [
            'name' => $request->name,
            'description' => $request->description,
        ];

        $data = DataCategory::create($data);

        return response()->json([
            'message' => 'Data berhasil ditambahkan',
            'data' => $data
        ]);
    }

    public function editCategory(DataRequest $request, $id)
    {
        $data = DataCategory::find($id);

        if (!$data) {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ]);
        }

        $data->save($request->all());

        return response()->json([
            'message' => 'Data berhasil diubah',
            'data' => $data
        ]);
    }

    public function category()
    {
        $data = DataCategory::all();

        return response()->json([
            'message' => 'Data berhasil diambil',
            'data' => $data
        ]);
    }
}
