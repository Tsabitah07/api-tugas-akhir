<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Counseling\CheckAvailabilityRequest;
use App\Http\Requests\Counseling\CounselingRequest;
use App\Http\Requests\Counseling\EditCounselingRequest;
use App\Mail\CounselingNotification;
use App\Models\Counseling;
use App\Models\CounselingSession;
use App\Models\Inbox;
use App\Models\Mentor;
use App\Models\Student;
use App\Notifications\ConsultationNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class CounselingController extends Controller
{
    public function index()
    {
        $counseling = Counseling::latest()->get();

        return response()->json([
            'message' => 'Data Counseling berhasil diambil',
            'data' => $counseling
        ]);
    }

    public function store(CounselingRequest $request)
    {
        //date validation
        if ($request->counseling_date <= now()) {
            return response()->json([
                'message' => 'Tanggal konseling tidak boleh kurang dari atau sama dengan hari ini'
            ]);
        }

        if ($request->counseling_date > now()->addDays(14)) {
            return response()->json([
                'message' => 'Waktu konseling tidak boleh lebih dari 14 hari dari hari ini'
            ]);
        }

        if (Carbon::parse($request->counseling_date)->format('l') == 'Sunday') {
            return response()->json([
                'message' => 'Tanggal konseling tidak boleh di hari Minggu'
            ]);
        }

        //time
//        $date = Counseling::where('counseling_date', $request->counseling_date)->first();
        $session = CounselingSession::find($request->session_id);

        $student = Student::find(auth()->user()->id);

        $counseling = Counseling::where('counseling_date', $request->counseling_date)
            ->where('session_id', $request->session_id)
            ->where('grade_id', $student->grade_id)
            ->first();

        if ($counseling) {
            return response()->json([
                'message' => 'Tanggal dan waktu konseling tidak tersedia untuk konselor ini'
            ]);
        }

        //auth validation
        if (!auth()->user()) {
            return response()->json([
                'message' => 'User not authenticated'
            ]);
        }

        if (!$student) {
            return response()->json([
                'message' => 'Student not found'
            ]);
        }

        $counselings = Counseling::create([
            'grade_id' => $student->grade_id,
            'student_id' => $student->id,
            'counseling_date' => $request->counseling_date,
            'session_id' => $request->session_id,
            'expired' => false,
            'service' => $request->service,
            'subject' => $request->subject,
            'counseling_status_id' => 1,
            'mentor_id' => $request->mentor_id,
        ]);

        $mentor = Mentor::where('grade_id', $counselings['grade_id'])->first();

        $inbox = Inbox::create([
            'student_id' => $counselings->student_id,
            'mentor_id' => $mentor->id,
            'receiver_id' => $mentor->id,
            'counseling_id' => $counselings->id,
            'title' => 'Ajuan Konseling Baru',
            'receiver' => 'Halo, '.$mentor->name,
            'subject' => 'Ajuan konsultasi baru dari siswa '. $counselings->Student->name,
            'message' => 'Ada ajuan konsultasi baru dari siswa '. $counselings->Student->name. ' untuk tanggal '. $counselings->counseling_date->format('d F Y'). ' jam '. $session->start_time. ' - '. $session->end_time,
            'sender' => $counselings->Student->name,
            'is_read' => false
        ]);

        $detail = [
            'subject' => 'Ajuan Konseling Baru',
            'receiver' => $inbox->receiver,
            'message' => $inbox->message,
        ];

        Notification::send($mentor, new ConsultationNotification($detail));

        return response()->json([
            'message' => 'Data Counseling berhasil ditambahkan',
            'data' => $counselings,
            'inbox' => $inbox
        ]);
    }

    public function checkAvailability()
    {
        $mentor = Mentor::find(auth()->user()->id);

        if (!$mentor) {
            return response()->json([
                'message' => 'Mentor not found'
            ]);
        }

        $today = Carbon::tomorrow();
        $twoWeeksLater = Carbon::tomorrow()->addWeeks(2);

        $existingCounselings = Counseling::where('grade_id', $mentor->grade_id)
            ->whereBetween('counseling_date', [$today, $twoWeeksLater])
            ->get();

        $availability = [];

        $currentDate = $today->copy();
        while ($currentDate->lte($twoWeeksLater)) {
            $sessions = [
                1 => true,
                2 => true,
                3 => true,
                4 => true,
                5 => true,
                6 => true
            ];

            $counselingsOnDate = $existingCounselings->filter(function ($counseling) use ($currentDate) {
                return $counseling->counseling_date->format('Y-m-d') == $currentDate->format('Y-m-d');
            });

            foreach ($counselingsOnDate as $counseling) {
                if (isset($sessions[$counseling->session_id])) {
                    $sessions[$counseling->session_id] = false;
                }
            }

            $availability[] = [
                'counseling_date' => $currentDate->format('Y-m-d'),
                'session' => [
                    'session 1' => $sessions[1],
                    'session 2' => $sessions[2],
                    'session 3' => $sessions[3],
                    'session 4' => $sessions[4],
                    'session 5' => $sessions[5],
                    'session 6' => $sessions[6],
                ]
            ];

            $currentDate->addDay();
        }

        return response()->json([
            'grade_id' => $mentor->grade_id,
            'availability' => $availability
        ]);
    }

    public function checkAvailabilityStudent()
    {
        $student = Student::find(auth()->user()->id);

        if (!$student) {
            return response()->json([
                'message' => 'Student not found'
            ]);
        }

        $today = Carbon::tomorrow();
        $twoWeeksLater = Carbon::tomorrow()->addWeeks(2);

        $existingCounselings = Counseling::where('grade_id', $student->grade_id)
            ->whereBetween('counseling_date', [$today, $twoWeeksLater])
            ->get();

        $availability = [];

        $currentDate = $today->copy();
        while ($currentDate->lte($twoWeeksLater)) {
            $sessions = [
                1 => true,
                2 => true,
                3 => true,
                4 => true,
                5 => true,
                6 => true
            ];

            $counselingsOnDate = $existingCounselings->filter(function ($counseling) use ($currentDate) {
                return $counseling->counseling_date->format('Y-m-d') == $currentDate->format('Y-m-d');
            });

            foreach ($counselingsOnDate as $counseling) {
                if (isset($sessions[$counseling->session_id])) {
                    $sessions[$counseling->session_id] = false;
                }
            }

            $availability[] = [
                'counseling_date' => $currentDate->format('Y-m-d'),
                'session' => [
                    'session 1' => $sessions[1],
                    'session 2' => $sessions[2],
                    'session 3' => $sessions[3],
                    'session 4' => $sessions[4],
                    'session 5' => $sessions[5],
                    'session 6' => $sessions[6],
                ]
            ];

            $currentDate->addDay();
        }

        return response()->json([
            'grade_id' => $student->grade_id,
            'availability' => $availability
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
