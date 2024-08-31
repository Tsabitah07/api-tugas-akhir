<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Counseling\CounselingRequest;
use App\Http\Requests\Counseling\EditCounselingRequest;
use App\Models\Counseling;
use App\Models\Inbox;
use App\Models\Mentor;
use App\Models\Student;

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

    public function store(CounselingRequest $request)
{
    if ($request->counseling_date < now()) {
        return response()->json([
            'message' => 'Tanggal konseling tidak boleh kurang dari hari ini'
        ]);
    }

    //time
    $counsel = Counseling::where('counseling_date', $request->counseling_date)
        ->where('time', $request->time)
        ->first();

    $student = Student::where('id', auth()->user()->id)->first();

    if ($counsel && $counsel->grade_id == $student->grade_id) {
        return response()->json([
            'message' => 'Tanggal dan waktu konseling tidak tersedia untuk mentor ini'
        ]);
    }

    //auth
    $user = auth()->user();
    if (!$user) {
        return response()->json([
            'message' => 'User not authenticated'
        ]);
    }

    $student = Student::where('id', $user->id)->first();
    if (!$student) {
        return response()->json([
            'message' => 'Student not found'
        ]);
    }

    $counseling = [
        'grade_id' => $student->grade_id,
        'student_id' => $student->id,
        'counseling_date' => $request->counseling_date,
        'time' => $request->time,
        'expired' => false,
        'service' => $request->service,
        'subject' => $request->subject,
        'counseling_status_id' => 1,
        'mentor_id' => $request->mentor_id,
    ];

    $counselings = Counseling::create($counseling);

    $mentor = Mentor::where('grade_id', $counselings['grade_id'])->first();

    $inbox = Inbox::create([
        'student_id' => $counselings->student_id,
        'mentor_id' => $mentor->id,
        'receiver_id' => $mentor->id,
        'counseling_id' => $counselings->id,
        'title' => 'Ajuan Konseling Baru',
        'receiver' => 'Halo, '.$mentor->name,
        'subject' => 'Ajuan konsultasi baru dari siswa '. $counselings->Student->name,
        'message' => 'Ada ajuan konsultasi baru dari siswa '. $counselings->Student->name. ' untuk tanggal '. $counselings->counseling_date->format('Y-m-d'). ' jam '. $counselings->time,
        'sender' => $counselings->Student->name,
        'is_read' => false
    ]);

    return response()->json([
        'message' => 'Data Counseling berhasil ditambahkan',
        'data' => $counselings,
        'inbox' => $inbox
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

    public function showByGrade()
    {
        $mentor = Mentor::where('id', auth()->user()->id)->first();

        $grade = $mentor->grade_id;

        $counseling = Counseling::where('grade_id', $grade)->latest()->get();

        return response()->json([
            'message' => 'Data Counseling berhasil diambil',
            'data' => $counseling
        ]);
    }
}
