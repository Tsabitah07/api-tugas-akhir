<?php

namespace App\Imports;

use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $gradeList = [
            'PPLG' => 1,
            'Animasi 3D' => 2,
            'Animasi 2D' => 3,
            'Design Grafis' => 4,
            'Teknik Grafika' => 5,
        ];

        return new Student([
            'nis' => $row[0],
            'email' => $row[1],
            'username' => $row[2],
            'name' => $row[3],
            'grade_id' => $gradeList[$row[4]],
            'phone_number' => '0'.$row[5],
            'birth_place' => $row[6],
            'birth_date' => $row[7],
            'year_of_entry' => $row[8],
            'password' => Hash::make($row[9]),
        ]);
    }
}
