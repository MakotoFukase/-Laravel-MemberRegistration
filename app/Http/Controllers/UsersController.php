<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\User;

class UsersController extends Controller
{
    // トップ画面
    public function index(Request $request) 
    {
        // 外部結合
        // 【TODO】EloquentのRelationshipにできないか
        $users = \DB::table('users')
        ->leftJoin('reasons', 'users.reason_id', '=', 'reasons.reason_id')
        ->leftJoin('notices', 'users.notice_id', '=', 'notices.notice_id')
        ->orderBy('users.id', 'asc')
        ->get();
        return view('users.index', ['users'=>$users]);
    }


    // 登録画面
    public function input(Request $request) 
    {
        return view('users.input');
    }


    // DBへ登録
    public function create(Request $request)
    {
        $param = [
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => $request->password,
            'birthday'  => $request->birthday,
            'age'       => $request->age,
            'reason_id' => $request->reason_id,
            'comment'   => $request->comment,
            'notice_id' => $request->notice_id,
        ];
        DB::table('users')->insert($param);
        return redirect ('/input/conf');
    }


    // 確認画面
    public function conf() 
    {
        $data = [
            'msg'=>'登録確認画面',
        ];
        return view('users.conf', $data);
    }


    // 完了画面
    public function complete() 
    {
        $data = [
            'msg'=>'登録確認画面',
        ];
        return view('users.complete', $data);
    }


    // DBのリレーション
    public function reasons()
    {
        return $this->hasMany('App\Reasons');
    }
}