<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
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
            'name'      => $row['name'],
            'email'     => $row['email'],
            'password'  => $row['password'],
            'birthday'  => $row['birthday'],
            'age'       => $row['age'],
            'reason'    => $row['reason'],
            'comment'   => $row['comment'],
            'notice'    => $row['notice'],
        ]);
    }
}
