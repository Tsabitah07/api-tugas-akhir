<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CounselingRequset;
use App\Models\Counseling;
use Illuminate\Http\Request;

class CounselingController extends Controller
{
    public function index()
    {
        $counseling = Counseling::all();

        return response()->json([
            'message' => 'Data Counseling berhasil diambil',
            'data' => $counseling
        ]);
    }

    public function store(CounselingRequset $request)
    {
        $counseling = [
            'grade_id' => $request->grade_id,
            'student_id' => $request->student_id,
            'counseling_date' => $request->counseling_date,
            'service' => $request->service,
            'subject' => $request->subject
        ];

        $counselings = Counseling::create($counseling);

        return response()->json([
            'message' => 'Data Counseling berhasil ditambahkan',
            'data' => $counselings
        ]);
    }

    public function edit(CounselingRequset $request, $id)
    {
        $counseling = Counseling::find($id);

        if (!$counseling) {
            return response()->json([
                'message' => 'Data Counseling tidak ditemukan'
            ]);
        }

        $counseling->update($request->all());

        return response()->json([
            'message' => 'Data Counseling berhasil diubah',
            'data' => $counseling
        ]);
    }

    public function detail(CounselingRequset $request, $id)
    {
        $counseling = Counseling::find($id);

        if (!$counseling) {
            return response()->json([
                'message' => 'Data Counseling tidak ditemukan'
            ]);
        }

        return response()->json([
            'message' => 'Data Counseling berhasil diambil',
            'data' => $counseling
        ]);
    }

    public function delete(CounselingRequset $request, $id)
    {
        $counseling = Counseling::find($id);

        if (!$counseling) {
            return response()->json([
                'message' => 'Data Counseling tidak ditemukan'
            ]);
        }

        $counseling->delete();

        return response()->json([
            'message' => 'Data Counseling berhasil dihapus'
        ]);
    }

    public function showByUser($id)
    {
        $counseling = Counseling::whereStudentId($id)->latest()->get();

        return response()->json([
            'message' => 'Data Counseling berhasil diambil',
            'data' => $counseling
        ]);
    }

    public function showByGrade($id)
    {
        $counseling = Counseling::whereGradeId($id)->latest()->get();

        return response()->json([
            'message' => 'Data Counseling berhasil diambil',
            'data' => $counseling
        ]);
    }
}
