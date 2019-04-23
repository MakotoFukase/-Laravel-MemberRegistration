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
        $users = User::all();
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
            'reason'    => $request->reason,
            'comment'   => $request->comment,
            'notice'    => $request->notice,
        ];
        DB::table('users')->insert($param);
        return redirect ('/input/complete');
    }


    // 完了画面
    public function complete() 
    {
        $data = [
            'msg'=>'登録確認画面',
        ];
        return view('users.complete', $data);
    }
}