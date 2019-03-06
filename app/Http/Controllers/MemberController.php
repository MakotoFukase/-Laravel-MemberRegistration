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