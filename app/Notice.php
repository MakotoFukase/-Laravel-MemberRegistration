<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $fillable = [
        'notice_id',
        'notice',
    ];

    // primarykeyの変更
    protected $primaryKey = "notice_id";

    // hasMany設定
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
