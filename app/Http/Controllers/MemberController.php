<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class MemberController extends Controller
{
    public function list_display(Request $request) 
    {
        $members = DB::select('select * from dtb_customer');
        return view('member.member_list', ['members'=>$members]);
    }

    public function register(Request $request) 
    {
        return view('member.register');
    }

    public function create(Request $request)
    {
        $param = [
            'id'        => $request->input('id', ''),
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => $request->password,
            'birthday'  => $request->birthday,
            'age'       => $request->age,
            'reason'    => $request->reason,
            'comment'   => $request->comment,
            'notice'    => $request->notice,
        ];
        DB::insert('insert into dtb_customer (id, name, email, password, birthday, age, reason, comment, notice) 
            values (:id, :name, :email, :password, :birthday, :age, :reason, :comment, :notice)', $param);
        return redirect ('/member_list/register/confirm');
    }

    public function confirm() 
    {
        $data = [
            'msg'=>'登録確認画面',
        ];
        return view('member.confirm', $data);
    }
}