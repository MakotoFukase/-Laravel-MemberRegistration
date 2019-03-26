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
    public function export(Request $request)
    {
        // ファイル名
        $now = date("YmdHis");
        $create_date = "customer_$now.csv";

        return  new StreamedResponse(
            function () {
                $customers = DB::table('dtb_customer')->get()->toArray();
                // CSVヘッダー
                $csvHeader = ['id', 'name', 'email', 'password', 'birthday', 'age', 'reason', 'comment', 'notice'];
                array_unshift($customers, $csvHeader);        
                $stream = fopen('php://output', 'w+');
                foreach ($customers as $customer) {
                    mb_convert_variables('SJIS-win', 'UTF-8', $customer); //文字化け対策
                    fputcsv($stream, (array)$customer);
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
}