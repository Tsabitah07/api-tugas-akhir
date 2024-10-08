<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Counseling\CancelCounselingRequest;
use App\Http\Requests\Counseling\EditCounselingRequest;
use App\Models\Counseling;
use App\Models\CounselingSession;
use App\Models\Inbox;
use App\Models\Mentor;
use App\Models\Student;
use App\Notifications\ConsultationNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class CounselingStatusController extends Controller
{
    public function acceptCounseling(EditCounselingRequest $request, $id)
    {
        $counseling = Counseling::find($id);

        if (!$counseling) {
            return response()->json([
                'message' => 'Data Counseling tidak ditemukan'
            ]);
        }

        $counseling->update([
            'place' => $request->place,
            'counseling_status_id' => 2
        ]);

        $mentor = Mentor::where('id', auth()->user()->id)->first();
        $student = Student::where('id', $counseling->student_id)->first();
        $session = CounselingSession::where('id', $counseling->session_id)->first();

        if ($counseling->grade_id != $mentor->grade_id) {
            return response()->json([
                'message' => 'Unauthorized'
            ]);
        }

        $inbox = Inbox::create([
           'student_id' => $counseling->student_id,
            'mentor_id' => $mentor->id,
            'receiver_id' => $counseling->student_id,
            'counseling_id' => $counseling->id,
            'title' => 'Konseling Diterima',
            'receiver' => 'Dear, '.$counseling->Student->name,
            'subject' => 'Konseling anda telah diterima',
            'message' => 'Konseling anda pada tanggal '. $counseling->counseling_date->format('d F Y'). ' jam '. $session->start_time.' - '.$session->end_time. ' telah di terima dan akan bertempat di '.$counseling->place,
            'sender' => $mentor->name,
            'is_read' => false
        ]);

        $detail = [
            'subject' => $inbox->title,
            'receiver' => $inbox->receiver,
            'message' => $inbox->message,
        ];

        Notification::send($student, new ConsultationNotification($detail));

        return response()->json([
            'message' => 'Status Counseling berhasil diubah',
            'data' => $counseling,
//            'inbox' => $inbox
        ]);
    }

    public function acceptCounselingStudent($id)
    {
        $counseling = Counseling::find($id);
        $student = Student::where('id', auth()->user()->id)->first();

        if (!$counseling) {
            return response()->json([
                'message' => 'Data Counseling tidak ditemukan'
            ]);
        }

        if ($counseling->grade_id != $student->grade_id) {
            return response()->json([
                'message' => 'Unauthorized'
            ]);
        }

        $counseling->update([
            'counseling_status_id' => 2
        ]);

        $mentor = Mentor::where('grade_id', $counseling->grade_id)->first();
        $session = CounselingSession::where('id', $counseling->session_id)->first();

        $inbox = Inbox::create([
           'student_id' => $counseling->student_id,
            'mentor_id' => $mentor->id,
            'receiver_id' => $mentor->id,
            'counseling_id' => $counseling->id,
            'title' => 'Konseling Diterima',
            'receiver' => 'Dear, '.$mentor->name,
            'subject' => 'Konseling yang dijadwalkan ulang telah diterima',
            'message' => 'Konseling yang dijadwalkan ulang menjadi tanggal '. $counseling->counseling_date->format('d F Y'). ' jam '. $session->start_time.' - '.$session->end_time. ' dan bertempat di '.$counseling->place.' telah diterima',
            'sender' => $counseling->Student->name,
            'is_read' => false
        ]);

        $detail = [
            'subject' => $inbox->title,
            'receiver' => $inbox->receiver,
            'message' => $inbox->message,
        ];

        Notification::send($mentor, new ConsultationNotification($detail));

        return response()->json([
            'message' => 'Status Counseling berhasil diubah',
            'data' => $counseling,
//            'inbox' => $inbox
        ]);
    }

    public function rescheduleCounseling(EditCounselingRequest $request, $id)
    {
        $counseling = Counseling::find($id);
        $student = Student::where('id', $counseling->student_id)->first();

        if (!$counseling) {
            return response()->json([
                'message' => 'Data Counseling tidak ditemukan'
            ]);
        }

        if ($counseling->counseling_status_id == 4) {
            return response()->json([
                'message' => 'Data Counseling sudah selesai'
            ]);
        }

        if ($counseling->counseling_status_id == 5) {
            return response()->json([
                'message' => 'Data Counseling sudah dibatalkan'
            ]);
        }

        if ($counseling->counseling_status_id == 6) {
            return response()->json([
                'message' => 'Data Counseling sudah terlewat'
            ]);
        }

        $mentor = Mentor::where('grade_id', $counseling->grade_id)->first();
        $session = CounselingSession::where('id', $counseling->session_id)->first();

        $counsel = Counseling::where('counseling_date', $request->counseling_date)
            ->where('session_id', $request->session_id)
            ->where('grade_id', $student->grade_id)
            ->first();

        if ($counseling->grade_id != $mentor->grade_id) {
            return response()->json([
                'message' => 'Unauthorized'
            ]);
        }

        if ($counsel) {
            return response()->json([
                'message' => 'Tanggal dan waktu konseling tidak tersedia untuk mentor ini'
            ]);
        }

        if ($request->counseling_date < now()) {
            return response()->json([
                'message' => 'Tanggal konseling tidak boleh kurang dari hari ini'
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

        $counseling->update([
            'counseling_date' => $request->counseling_date,
            'session_id' => $request->session_id,
            'place' => $request->place,
            'counseling_status_id' => 3
        ]);

        $inbox = Inbox::create([
            'student_id' => $counseling->student_id,
            'mentor_id' => $mentor->id,
            'receiver_id' => $counseling->student_id,
            'counseling_id' => $counseling->id,
            'title' => 'Jadwal Konseling Diubah',
            'receiver' => 'Dear, '.$counseling->Student->name,
            'subject' => 'Jadwal konseling anda telah diubah',
            'message' => 'Konseling yang anda ajukan diubah menjadi tanggal '. $counseling->counseling_date->format('d F Y'). ' jam '. $session->start_time.' - '.$session->end_time.' dan bertempat di '.$counseling->place,
            'sender' => $mentor->name,
            'is_read' => false
        ]);

        $detail = [
            'subject' => $inbox->title,
            'receiver' => $inbox->receiver,
            'message' => $inbox->message,
        ];

        Notification::send($student, new ConsultationNotification($detail));

        return response()->json([
            'message' => 'Data Counseling berhasil diubah',
            'data' => $counseling,
//            'inbox' => $inbox
        ]);
    }

    public function cancelCounseling(CancelCounselingRequest $request, $id)
    {
        $counseling = Counseling::find($id);

        if (auth()->user()->id != $counseling->student_id) {
            return response()->json([
                'message' => 'Unauthorized'
            ]);
        }

        if (!$counseling) {
            return response()->json([
                'message' => 'Data Counseling tidak ditemukan'
            ]);
        }

        $counseling->update([
            'counseling_status_id' => 5,
            'note' => 'Dibatalkan karena '.$request->message
        ]);

        $student = Student::where('id', auth()->user()->id)->first();

        $mentor = Mentor::where('grade_id', $counseling->grade_id)->first();

        $inbox = Inbox::create([
            'student_id' => $counseling->student_id,
            'mentor_id' => $mentor->id,
            'receiver_id' => $mentor->id,
            'counseling_id' => $counseling->id,
            'title' => 'Konseling Dibatalkan',
            'receiver' => 'Dear, '.$mentor->name,
            'subject' => 'Konseling telah dibatalkan',
            'message' => 'Alasan konseling dibatalkan karena '.$request->message,
            'sender' => $student->name,
            'is_read' => false
        ]);

        $session = CounselingSession::where('id', $counseling->session_id)->first();

        $detail = [
            'subject' => $inbox->title,
            'receiver' => $inbox->receiver,
            'message' => 'Jadwal konseling anda dengan '.$student->name.' pada tanggal '.$counseling->counseling_date.' jam '.$session->start_time.' telah dibatalkan. '.$inbox->message,
        ];

        Notification::send($mentor, new ConsultationNotification($detail));

        return response()->json([
            'message' => 'Status Counseling berhasil diubah',
            'data' => $counseling,
//            'inbox' => $inbox
        ]);
    }

    public function completeCounseling(EditCounselingRequest $request, $id)
    {
        $counseling = Counseling::find($id);

        if (!$counseling) {
            return response()->json([
                'message' => 'Data Counseling tidak ditemukan'
            ]);
        }

        if ($counseling->counseling_status_id == 5) {
            return response()->json([
                'message' => 'Konseling telah dibatalkan'
            ]);
        }

        if ($counseling->counseling_status_id == 6) {
            return response()->json([
                'message' => 'Konseling telah terlewat'
            ]);
        }

        $counsel = Counseling::where('counseling_date', $request->counseling_date)->first();

        $session = CounselingSession::where('id', $counseling->session_id)->first();

        if ($counsel < now() && $session->start_time < now()) {
            return response()->json([
                'message' => 'Konseling belum dilakukan. Silahkan melakukan konseling terlebih dahulu'
            ]);
        }

        $counseling->update([
            'counseling_status_id' => 4,
            'note' => $request->note
        ]);

        $mentor = Mentor::where('grade_id', $counseling->grade_id)->first();
        $student = Student::where('id', $counseling->student_id)->first();

        if ($counseling->grade_id != $mentor->grade_id) {
            return response()->json([
                'message' => 'Unauthorized'
            ]);
        }

        $inbox = Inbox::create([
            'student_id' => $counseling->student_id,
            'mentor_id' => $mentor->id,
            'receiver_id' => $counseling->student_id,
            'counseling_id' => $counseling->id,
            'title' => 'Konseling Selesai',
            'receiver' => 'Dear, '.$counseling->Student->name,
            'subject' => 'Konseling telah selesai',
            'message' => 'Konseling anda pada tanggal '. $counseling->counseling_date->format('Y-m-d'). ' telah selesai dengan catatan '. $counseling->note,
            'sender' => $mentor->name,
            'is_read' => false
        ]);

        $detail = [
            'subject' => $inbox->title,
            'receiver' => $inbox->receiver,
            'message' => $inbox->message,
        ];

        Notification::send($student, new ConsultationNotification($detail));

        return response()->json([
            'message' => 'Data Counseling berhasil diubah',
            'data' => $counseling,
//            'inbox' => $inbox
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
            ->whereIn('counseling_status_id', [4, 5, 6])
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

    public function showByStatusMentor($status_id)
    {
        if (!auth()->check()) {
            return response()->json([
                'message' => 'Authentication is required'
            ]);
        }

        $mentor = Mentor::where('id', auth()->user()->id)->first();

        $grade = $mentor->grade_id;

        $counseling = Counseling::where('grade_id', $grade)
            ->where('counseling_status_id', $status_id)
            ->get();

        return response()->json([
            'message' => 'History Counseling berhasil diambil',
            'data' => $counseling
        ]);
    }

    public function historyMentor()
    {
        if (!auth()->check()) {
            return response()->json([
                'message' => 'Authentication is required'
            ]);
        }

        $mentor = Mentor::where('id', auth()->user()->id)->first();

        $grade = $mentor->grade_id;

        $counseling = Counseling::where('grade_id', $grade)
            ->whereIn('counseling_status_id', [4, 5, 6])
            ->get();

        return response()->json([
            'message' => 'History Counseling berhasil diambil',
            'data' => $counseling
        ]);
    }

    public function countMentor()
    {
        if (!auth()->check()) {
            return response()->json([
                'message' => 'Authentication is required'
            ]);
        }

        $mentor = Mentor::where('id', auth()->user()->id)->first();

        $grade = $mentor->grade_id;

        $pending = Counseling::where('grade_id', $grade)
            ->where('counseling_status_id', 1)
            ->count();

        $coming_soon = Counseling::where('grade_id', $grade)
            ->where('counseling_status_id', 2)
            ->count();

        $reschedule = Counseling::where('grade_id', $grade)
            ->where('counseling_status_id', 3)
            ->count();

        $completed = Counseling::where('grade_id', $grade)
            ->where('counseling_status_id', 4)
            ->count();

        $cancel = Counseling::where('grade_id', $grade)
            ->where('counseling_status_id', 5)
            ->count();

        $not_attending = Counseling::where('grade_id', $grade)
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
