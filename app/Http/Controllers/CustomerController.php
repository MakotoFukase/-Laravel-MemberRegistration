<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\User;


class CustomerController extends Controller
{
    // トップ画面
    public function list(Request $request) 
    {
        $customers = DB::select('select * from dtb_customer');
        return view('customer.list', ['customers'=>$customers]);
    }

    // 登録画面
    public function input(Request $request) 
    {
        return view('customer.input');
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
        DB::insert('insert into dtb_customer (name, email, password, birthday, age, reason, comment, notice) 
            values (:name, :email, :password, :birthday, :age, :reason, :comment, :notice)', $param);
        return redirect ('/list/input/complete');
    }

    // 完了画面
    public function complete() 
    {
        $data = [
            'msg'=>'登録確認画面',
        ];
        return view('customer.complete', $data);
    }

    // CSV出力
        
        
}