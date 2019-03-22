<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CustomerController extends Controller
{
    public function list_display(Request $request) 
    {
        $customers = DB::select('select * from dtb_customer');
        return view('customer.list', ['customers'=>$customers]);
    }

    public function input(Request $request) 
    {
        return view('customer.input');
    }

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

    public function complete() 
    {
        $data = [
            'msg'=>'登録確認画面',
        ];
        return view('customer.complete', $data);
    }
}