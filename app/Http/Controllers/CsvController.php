<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CsvController extends Controller
{
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
        $upload_file = $request->file('file')->store('import');
        $file_path = $upload_file->getRealPath();

        $file = new SplFileObject($file_path);
        $file->setFlags(SplFileObject::READ_CSV);

        $rows = $reader->toArray();

        foreach ($rows as $row){
            $recode = $this->user->updateOrCreate(['id' => $row['id']]);
        }
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
