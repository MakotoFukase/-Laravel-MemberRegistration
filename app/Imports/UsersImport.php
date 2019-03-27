<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    //protected $guarded = ['id'];

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'name'      => $row[0],
            'email'     => $row[1],
            'password'  => $row[2],
            'birthday'  => $row[3],
            'age'       => $row[4],
            'reason'    => $row[5],
            'comment'   => $row[6],
            'notice'    => $row[7],
        ]);
    }
}
