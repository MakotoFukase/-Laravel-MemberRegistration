<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Response;
use SplFileObject;
use Symfony\Component\HttpFoundation\StreamedResponse;

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
        // ロケールを設定(日本語に設定)
        setlocale(LC_ALL, 'ja_JP.UTF-8');

        // storeメゾット：アップロードファイルの保存
        $now = date("YmdHis");
        $file_name = $request->file('file')->storeAs('import', "$now.csv");
        // TODO:フルパス取得するやつに変更
        $file_path = "/home/vagrant/code/Laravel/storage/app/$file_name";

        // 読み込んだデータをUTF-8に変換して保存
        file_put_contents($file_path, mb_convert_encoding(file_get_contents($file_path), 'UTF-8'));
        $file = new SplFileObject($file_path, "r+b");
        $file->setFlags(SplFileObject::READ_CSV);

        // $registerde_id でDB内のidを取得
        $registerde_id = DB::table('users')->get(['id']);//->toArray();
        //$registerde_id = (array) $registerde_id;

        /*foreach ($file as $row){
            User::updateOrCreate(
                ['id' => 1], // $registerde_id でDB内のidを取得する
                [
                    'name' => $row[1], 
                    'email' => $row[2], 
                    'password' => $row[3], 
                    'birthday' => $row[4],
                    'age'       => (int)$row[5],
                    'reason'    => (int)$row[6],
                    'comment'   => $row[7],
                    'notice'    => (int)$row[8],
                ]
            );
        }*/


        //取得したオブジェクトを読み込み
        $row_count = 1;
        foreach ($file as $row)
        {
            // 最終行の処理(最終行が空っぽの場合の対策)
            if ($row === [null]) continue; 

            if ($file->key() > 0){

                // birthdayをdate型へ変換
                if ($row[4] == null) {
                    $date = null;
                }
                else {
                    $date = date('Y-m-d', strtotime($row[4]));
                }
                    

                //1件ずつインポート
                User::insert(array(
                    'name' => $row[1], 
                    'email' => $row[2], 
                    'password' => $row[3], 
                    'birthday' => $date,
                    'age'       => (int)$row[5],
                    'reason'    => (int)$row[6],
                    'comment'   => $row[7],
                    'notice'    => (int)$row[8],
                ));
            }
            
            $row_count++;
        }

        /*foreach ($file as $row) {
            if ($row === [null]) continue; 
            // 行番号を取得し、最初の行のみ除外
            if ($file->key() > 0){
                $date = date('Y-m-d', strtotime($row[4]));
                var_dump($date);
            }
        }*/
        //return view('users.test', ['row'=>$row]);
        return redirect ('/list');
    }






    // 読み込めないエラー発生
    /*public function import(Request $request)
    {
        $path = $request->file('file')->store('import');
        $reader = Excel::load($path);

        $rows = $reader->toArray();

        foreach ($rows as $row){
            $recode = $this->user->updateOrCreate(['id' => $row['id']]);
        }
        return redirect ('/list');
    }*/

    // アップデートできないので却下
    /*public function import(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new UsersImport, $file);
        return redirect ('/list');

        //return view('users.test', ['file'=>$file]);
    }*/
}
