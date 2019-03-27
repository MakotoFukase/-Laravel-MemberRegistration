<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'id'        => $row[0],
            'name'      => $row[1],
            'email'     => $row[2],
            'password'  => $row[3],
            'birthday'  => $row[4],
            'age'       => $row[5],
            'reason'    => $row[6],
            'comment'   => $row[7],
            'notice'    => $row[8],
        ]);
    }
}
