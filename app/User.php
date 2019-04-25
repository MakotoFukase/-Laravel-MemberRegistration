<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\Notice;

/* 最初からあったよくわからないやつ
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /*protected $fillable = [
        'name', 'email', 'password',
    ];*/

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    /*protected $hidden = [
        'password', 'remember_token',
    ];
}*/

class User extends Model
{
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'birthday',
        'age',
        'reason_id',
        'comment',
        'notice_id'
    ];

    public function notice()
    {
        return $this->belongsTo('App\Notice');
    }
}
