<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Inbox;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    public function index()
    {
        $inbox = Inbox::latest()->get();

        return response()->json([
            'message' => 'Data Inbox berhasil diambil',
            'data' => $inbox
        ]);
    }

    public function inbox()
    {
        if (!auth()->user()){
            return response()->json([
                'message' => 'User not authenticated'
            ]);
        }

        $inbox = Inbox::where('receiver_id', auth()->user()->id)->latest()->get();

        return response()->json([
            'message' => 'Data Inbox Student berhasil diambil',
            'data' => $inbox
        ]);
    }

    public function show($id)
    {
        if (!auth()->user()){
            return response()->json([
                'message' => 'User not authenticated'
            ], 401);
        }

        $inbox = Inbox::where('receiver_id', auth()->user()->id)
            ->find($id);

        if (!$inbox) {
            return response()->json([
                'message' => 'Data Inbox Student tidak ditemukan'
            ],404);
        }

        $inbox->update([
            'is_read' => true
        ]);

        return response()->json([
            'message' => 'Detail data Inbox Student berhasil diambil',
            'data' => $inbox
        ]);
    }
}
