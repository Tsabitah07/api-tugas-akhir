<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Counseling\CounselingRequset;
use App\Http\Requests\Counseling\EditCounselingRequest;
use App\Models\Counseling;

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
        if ($request->counseling_status_id != null) {
            $counseling_status = $request->counseling_status_id;
        } else {
            $counseling_status = 1;
        }

        if ($request->counseling_date < now()) {
            return response()->json([
                'message' => 'Tanggal konseling tidak boleh kurang dari hari ini'
            ]);
        }

        $counsel = Counseling::where('counseling_date', $request->counseling_date)
            ->where('time', $request->time)
            ->first();

        if ($counsel) {
            return response()->json([
                'message' => 'Tanggal dan waktu konseling tidak tersedia'
            ]);
        }

        $counseling = [
            'grade_id' => $request->grade_id,
            'student_id' => $request->student_id,
            'counseling_date' => $request->counseling_date,
            'time' => $request->time,
            'expired' => $request->expired = false,
            'service' => $request->service,
            'subject' => $request->subject,
            'counseling_status_id' => $counseling_status
        ];

        $counselings = Counseling::create($counseling);

        return response()->json([
            'message' => 'Data Counseling berhasil ditambahkan',
            'data' => $counselings
        ]);
    }

    public function edit(EditCounselingRequest $request, $id)
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

    public function detail($id)
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

    public function delete($id)
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

    public function showByUser()
    {
        $counseling = Counseling::where('student_id',  auth()->user()->id)->latest()->get();

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
