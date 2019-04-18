<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use Response;
use SplFileObject;

class CsvController extends Controller
{
    protected $user = null;
    // construct：初期化
    public function __construct(User $user)
    {
        $this->user = $user;
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
    
    // CSV入力
    public function import(Request $request)
    {
        // ロケールを設定(日本語に設定)
        setlocale(LC_ALL, 'ja_JP.UTF-8');

        // storeメゾット：アップロードファイルの保存
        $now = date("YmdHis");
        $file_name = $request->file('file')->storeAs('import', "$now.csv");
        $file_path = storage_path("app/$file_name");

        // 読み込んだデータをUTF-8に変換して保存
        file_put_contents($file_path, mb_convert_encoding(file_get_contents($file_path), 'UTF-8'));
        $file = new SplFileObject($file_path, "r+b");
        $file->setFlags(SplFileObject::READ_CSV);

        // $existing_id でDB内のidを取得
        $existing_id = DB::table('users')->orderBy('id', 'desc')->first()->id;

        $row_count = 1;
        foreach ($file as $key => $row){
            // 最終行
            //if ($row === [null]) continue; 

            if ($file->key() == null) {
                continue;
            }
            elseif ($file->key() > 0) {
                // CSVに入っているidがDBに入っているidより大きければ、無効にする
                if ($row[0] > $existing_id) {
                    $row[0] = null;
                }
                
                // birthdayをdate型へ変換
                if ($row[4] == null) {
                    $birthday = null;
                }
                else {
                    $date = date('Y-m-d', strtotime($row[4]));
                }

                User::updateOrCreate(
                    ['id' => (int)$row[0]],
                    [
                        'name'      => $row[1], 
                        'email'     => $row[2], 
                        'password'  => $row[3], 
                        'birthday'  => $birthday,
                        'age'       => (int)$row[5],
                        'reason'    => (int)$row[6],
                        'comment'   => $row[7],
                        'notice'    => (int)$row[8],
                    ]
                );
            }
        }
        //return view('users.test', ['existing_id'=>$existing_id]);
        return redirect ('/list');
    }
}