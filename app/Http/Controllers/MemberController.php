<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class MemberController extends Controller
{
    public function list_display() 
    {
        $data = [
            'members'=>'山田太郎',
        ];
        return view('member.member_list', $data);
    }

    public function registration() 
    {
        $data = [
            'reg'=>'登録画面',
        ];
        return view('member.registration', $data);
    }

    public function confirm() 
    {
        $data = [
            'msg'=>'登録確認画面',
        ];
        return view('member.confirm', $data);
    }
}