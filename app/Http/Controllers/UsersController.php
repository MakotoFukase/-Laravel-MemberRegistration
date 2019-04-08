<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\User;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Response;
use SplFileObject;

//use Rap2hpoutre\FastExcel\FastExcel;


class UsersController extends Controller
{
    protected $user = null;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    // トップ画面
    public function list(Request $request) 
    {
        $users = User::all();
        return view('users.list', ['users'=>$users]);
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
        return redirect ('/list/input/complete');
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