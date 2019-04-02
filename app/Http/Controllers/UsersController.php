<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\User;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Response;

//use Rap2hpoutre\FastExcel\FastExcel;


class UsersController extends Controller
{
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


   // CSV出力
   public function export()
   {
       $now = date("YmdHis");
       $users = DB::table('users')->get()->toArray();
       $csvHeader = [
           'id', 
           'name', 
           'email', 
           'password', 
           'birthday', 
           'age', 
           'reason', 
           'comment', 
           'notice',
           'created_at',
           'updated_at'
       ];
       array_unshift($users, $csvHeader);        
       $stream = fopen('php://temp', 'r+b');
       foreach ($users as $user) {
           fputcsv($stream, (array)$user);
       }
       rewind($stream);
       $csv = str_replace(PHP_EOL, "\r\n", stream_get_contents($stream));
       $csv = mb_convert_encoding($csv, 'SJIS-win', 'UTF-8');
       $headers = array(
           'Content-Type' => 'text/csv',
           'Content-Disposition' => "attachment; filename=users_$now.csv"
       );
       return Response::make($csv, 200, $headers);
    }
    
    // CSV出力_Excelクラス使用
    // 「.csv」だと文字化け不可避
    /*public function export()
    {
        $now = date("YmdHis");
        return Excel::download(new UsersExport, "users_$now.xlsx");
    }*/

    
    // CSV入力
    public function import(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new UsersImport, $file);
        return redirect ('/list');

        //return view('users.test', ['file'=>$file]);
    }
}