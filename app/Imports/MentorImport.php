<?php

namespace App\Imports;

use App\Models\Mentor;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class MentorImport implements ToModel
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

        return new Mentor([
            'name' => $row[0],
            'username' => $row[1],
            'grade_id' => $gradeList[$row[2]],
            'birth_place' => $row[3],
            'birth_date' => $row[4],
            'gender' => $row[5],
            'experience' => $row[6],
            'last_education' => $row[7],
            'phone_number' => '0'.$row[8],
            'password' => Hash::make($row[9]),
        ]);
    }
}
