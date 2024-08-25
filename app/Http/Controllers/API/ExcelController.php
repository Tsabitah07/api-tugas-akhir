<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExcelRequest;
use App\Imports\MentorImport;
use App\Imports\StudentImport;
use Maatwebsite\Excel\Excel;

class ExcelController extends Controller
{
    protected $excel;

    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }

    public function import(ExcelRequest $request)
    {
        $this->excel->import(new StudentImport, $request->file('file'));

        return response()->json([
            'message' => 'Import success'
        ]);
    }

    public function importMentor(ExcelRequest $request)
    {
        $this->excel->import(new MentorImport, $request->file('file'));

        return response()->json([
            'message' => 'Import success'
        ]);
    }
}
