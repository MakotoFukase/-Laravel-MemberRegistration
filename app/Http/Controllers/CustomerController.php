<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\User;


class CustomerController extends Controller
{
    // トップ画面
    public function list(Request $request) 
    {
        $customers = DB::table('dtb_customer')->get();
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
        DB::table('dtb_customer')->insert($param);
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
    // ↓いろいろ試した結果
    public function export()
    {
        return  new StreamedResponse(
            function () {
        $customers = DB::table('dtb_customer')->get()->toArray();
        //$csvHeader = ['1', '2', '3', '4', '5', '6', '7', '8', '9'];
        //array_unshift($customers, $csvHeader);
        $create_date = date("His");
        
        $stream = fopen('php://output', 'w+');
        foreach ($customers as $customer) {
            fputcsv($stream, (array)$customer);
        }
        fclose($stream);
    },
    200,
    [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename=customer.csv',
    ]
    );
}

        /*// ファイルポイントの位置を先頭に戻す
        rewind($stream);
        // 検索文字列に一致したすべての文字列を置換
        // $streamの中の「PHP_EOL」を「\r\n」に置換
        $csv = str_replace(PHP_EOL, "\r\n", stream_get_contents($stream));
        // 文字エンコーディングを、「UTF-8」から「SJIS-win」へ変換
        $csv = mb_convert_encoding($csv, 'SJIS-win', 'UTF-8');

        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="customers.csv"',
        );
        //return redirect ('/list');
        return Response::make($csv, 200, $headers);
}    */

// ↑いろいろ試した結果
        
}