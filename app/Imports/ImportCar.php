<?php

namespace App\Imports;

use App\Models\Car;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportCar implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $users = [];
    }
}
