<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Counseling\EditCounselingRequest;
use App\Models\Counseling;
use Illuminate\Http\Request;

class CounselingStatusController extends Controller
{
    public function acceptCounseling($id)
    {
        $counseling = Counseling::find($id);

        if (!$counseling) {
            return response()->json([
                'message' => 'Data Counseling tidak ditemukan'
            ]);
        }

        $counseling->update([
            'counseling_status_id' => 2
        ]);

        return response()->json([
            'message' => 'Status Counseling berhasil diubah',
            'data' => $counseling
        ]);
    }

    public function rescheduleCounseling(EditCounselingRequest $request, $id)
    {
        $counseling = Counseling::find($id);

        if (!$counseling) {
            return response()->json([
                'message' => 'Data Counseling tidak ditemukan'
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

        $counseling->update([
            'counseling_date' => $request->counseling_date,
            'time' => $request->time,
            'counseling_status_id' => 3
        ]);

        if ($request->expired == true) {
            return response()->json([
                'message' => 'Data Counseling sudah expired',
                'data' => $counseling
            ]);
        }

        return response()->json([
            'message' => 'Data Counseling berhasil diubah',
            'data' => $counseling
        ]);
    }

    public function onGoingCounseling($id)
    {
        $counseling = Counseling::find($id);

        if (!$counseling){
            return response()->json([
                'message' => 'Data Counseling tidak ditemukan'
            ]);
        }

        $counseling->update([
            'counseliing_status_id' => 4
        ]);

        return response()->json([
            'message' => 'Status Counseling berhasil diubah',
            'data' => $counseling
        ]);
    }

    public function cancelCounseling($id)
    {
        $counseling = Counseling::find($id);

        if (!$counseling) {
            return response()->json([
                'message' => 'Data Counseling tidak ditemukan'
            ]);
        }

        $counseling->update([
            'counseling_status_id' => 6
        ]);

        return response()->json([
            'message' => 'Status Counseling berhasil diubah',
            'data' => $counseling
        ]);
    }

    public function completeCounseling($id)
    {
        $counseling = Counseling::find($id);

        if (!$counseling) {
            return response()->json([
                'message' => 'Data Counseling tidak ditemukan'
            ]);
        }

        $counseling->update([
            'counseling_status_id' => 5
        ]);

        return response()->json([
            'message' => 'Data Counseling berhasil diubah',
            'data' => $counseling
        ]);
    }

    public function history()
    {
        if (!auth()->check()) {
            return response()->json([
                'message' => 'Authentication is required'
            ]);
        }

        $counseling = Counseling::where('student_id', auth()->user()->id)
            ->whereIn('counseling_status_id', [5, 6, 7])
            ->get();

        return response()->json([
            'message' => 'History Counseling berhasil diambil',
            'data' => $counseling
        ]);
    }

    public function showByStatus($status_id)
    {
        if (!auth()->check()) {
            return response()->json([
                'message' => 'Authentication is required'
            ]);
        }

        $counseling = Counseling::where('student_id', auth()->user()->id)
            ->where('counseling_status_id', $status_id)
            ->get();

        return response()->json([
            'message' => 'History Counseling berhasil diambil',
            'data' => $counseling
        ]);
    }

    public function count()
    {
        if (!auth()->check()) {
            return response()->json([
                'message' => 'Authentication is required'
            ]);
        }

        $pending = Counseling::where('student_id', auth()->user()->id)
            ->where('counseling_status_id', 1)
            ->count();

        $coming_soon = Counseling::where('student_id', auth()->user()->id)
            ->where('counseling_status_id', 2)
            ->count();

        $reschedule = Counseling::where('student_id', auth()->user()->id)
            ->where('counseling_status_id', 3)
            ->count();

        $completed = Counseling::where('student_id', auth()->user()->id)
            ->where('counseling_status_id', 4)
            ->count();

        $cancel = Counseling::where('student_id', auth()->user()->id)
            ->where('counseling_status_id', 5)
            ->count();

        $not_attending = Counseling::where('student_id', auth()->user()->id)
            ->where('counseling_status_id', 6)
            ->count();

        $counseling = [
            'pending' => $pending,
            'coming_soon' => $coming_soon,
            'reschedule' => $reschedule,
            'complete' => $completed,
            'cancel' => $cancel,
            'not_attending' => $not_attending
        ];

        return response()->json([
            'message' => 'Jumlah Counseling berhasil diambil',
            'data' => $counseling
        ]);
    }
}
