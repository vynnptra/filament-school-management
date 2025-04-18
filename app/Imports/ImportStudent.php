<?php

namespace App\Imports;

use App\Models\Student;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportStudent implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $birthday = $this->parseDate($row[3]);
        return new Student([
            'nis' => $row[0],
            'name' => $row[1],
            'gender' => $row[2],
            'birthday' => $birthday,
            'religion' => in_array($row[4], ['Islam', 'Katolik', 'Protestan', 'Hindu', 'Buddha', 'Khonghucu']) ? $row[4] : 'Islam',
            'contact' => $row[5],
        ]);
    }

    private function parseDate($date)
    {
        $translated = str_ireplace(
            ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            $date
        );

        // Gunakan Carbon untuk parsing
        return Carbon::parse($translated)->format('Y-m-d');
    }
}
