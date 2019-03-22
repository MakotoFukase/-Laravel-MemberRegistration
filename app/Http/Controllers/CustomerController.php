<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
    public function export()
    {
        $users = array(
            array("名前", "年齢", "血液型"),
            array("太郎", "21", "O"),
            array("ジョン", "23", "A"),
            array("ニキータ", "32", "AB"),
            array("次郎", "22", "B")
           );
           $csvHeader = ['名前', '年齢', '血液型'];
           return CSV::download($users, $csvHeader, 'user_list.csv');
    }

}