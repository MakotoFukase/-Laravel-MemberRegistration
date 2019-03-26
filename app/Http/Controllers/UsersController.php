<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\User;


class UsersController extends Controller
{
    // トップ画面
    public function list(Request $request) 
    {
        $users = DB::table('users')->get();
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


    // CSV出力
    public function export(Request $request)
    {
        // ファイル名
        $now = date("YmdHis");
        $create_date = "users_$now.csv";

        return  new StreamedResponse(
            function () {
                $users = DB::table('users')->get()->toArray();
                // CSVヘッダー
                $csvHeader = [
                    'id', 
                    'name', 
                    'email', 
                    'password', 
                    'birthday', 
                    'age', 
                    'reason', 
                    'comment', 
                    'notice'];
                array_unshift($users, $csvHeader);        
                $stream = fopen('php://output', 'w+');
                foreach ($users as $user) {
                    mb_convert_variables('SJIS-win', 'UTF-8', $user); //文字化け対策
                    fputcsv($stream, (array)$user);
                }
                fclose($stream);
                },
            200,
            [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => "attachment; filename=$create_date",
            ]
        );
    }
    
    
    // CSV入力
    public function inport(Request $request)
    {

    }
}