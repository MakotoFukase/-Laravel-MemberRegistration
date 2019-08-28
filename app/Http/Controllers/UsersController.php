<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\User;
use Session;

class UsersController extends Controller
{
    // トップ画面
    public function index(Request $request) 
    {
        // 外部結合
        // 【TODO】EloquentのRelationshipにできないか検討
        $users = \DB::table('users')
        ->leftJoin('reasons', 'users.reason_id', '=', 'reasons.reason_id')
        ->leftJoin('notices', 'users.notice_id', '=', 'notices.notice_id')
        ->orderBy('users.id', 'asc')
        ->get();
        return view('users.index', ['users'=>$users]);
    }


    // 登録画面
    public function input(Request $request) 
    {
        // セッションに値が存在した場合、その値を登録画面へ表示
        $name       = Session::get('name', '');
        $email      = Session::get('email', '');
        $password   = Session::get('password', '');
        $birthday   = Session::get('birthday', '');
        $age        = Session::get('age', '');
        $reason_id  = Session::get('reason_id', '');
        $comment    = Session::get('comment', '');
        $notice_id  = Session::get('notice_id', '');
        return view('users.input',
            ['name' => $name],
            ['email' => $email],
            ['password' => $password],
            ['birthday' => $birthday],
            ['age' => $age],
            ['reason_id' => $reason_id],
            ['comment' => $comment],
            ['notice_id' => $notice_id]
        );
    }
    

    public function ses_put(Request $request)
    {
        // セッションに値を置いている
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $birthday = $request->birthday;
        $age = $request->age;
        $reason_id = $request->reason_id;
        $comment = $request->comment;
        $notice_id = $request->notice_id;
        //$comment = $request->comment;
        // 【TODO】書き方変更できないか検討
        $request->session()->put('name', $name);
        $request->session()->put('email', $email);
        $request->session()->put('password', $password);
        $request->session()->put('birthday', $birthday);
        $request->session()->put('age', $age);
        $request->session()->put('reason_id', $reason_id);
        $request->session()->put('comment', $comment);
        $request->session()->put('notice_id', $notice_id);        
        /*session()->put(
            ['name' => $name],
            ['email' => $email],
            ['comment' => $comment]
        );*/
        return view('users.conf')
            // 複数の変数を、確認画面へ送信
            ->with(compact(
                'name',
                'email',
                'password',
                'birthday',
                'age',
                'reason_id',
                'comment',
                'notice_id'
            ));

    }


    // 確認画面
    public function conf() 
    {
        return view('users.conf');
    }


    // DBへ登録
    public function complete(Request $request)
    {
        $param = [
            //'name'      => $request->name,
            //'email'     => $request->email,
            'name'      => Session::get('name'),
            'email'     => Session::get('email'),
            'password'  => Session::get('password'),
            'birthday'  => Session::get('birthday'),
            'age'       => Session::get('age'),
            'reason_id' => Session::get('reason_id'),
            'comment'   => Session::get('comment'),
            'notice_id' => Session::get('notice_id'),
        ];
        DB::table('users')->insert($param);
        // セッションから全データ削除
        Session::flush();
        return view ('users.complete');
    }
}