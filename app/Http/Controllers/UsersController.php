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
        // 【TODO】EloquentのRelationshipにできないか
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
        $name = Session::get('name', '');
        $email = Session::get('email', '');
        return view('users.input',
            ['name' => $name],
            ['email' => $email]
        );
        //return redirect('/input');
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
            'reason_id' => $request->reason_id,
            'comment'   => $request->comment,
            'notice_id' => $request->notice_id,
        ];
        DB::table('users')->insert($param);
        return redirect ('/input/conf');
    }


    // 確認画面
    public function conf() 
    {
        $data = [
            'msg'=>'登録確認画面',
        ];
        return view('users.conf');
    }


    // 完了画面
    public function complete() 
    {
        $data = [
            'msg'=>'登録確認画面',
        ];
        return view('users.complete', $data);
    }


    // DBのリレーション
    /*public function reasons()
    {
        return $this->hasMany('App\Reasons');
    }*/

    // セッション利用
    /*public function ses_get(Request $request)
    {
        //$name = $request->session()->get('name');
        $name = session('name');
        $email = session('email');
        $comment = session('comment');
        return view('users.input',
            ['name' => $name,],
            ['email' => $email],
            ['comment' => $comment]
        );
    }*/
    public function ses_put(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        //$comment = $request->comment;
        $request->session()->put('name', $name);
        $request->session()->put('email', $email);
        /*session()->put(
            ['name' => $name],
            ['email' => $email],
            ['comment' => $comment]
        );*/
        //return view('users.conf');
        //return redirect('/input/conf');
        /*return view('users.conf',
        ['name' => $name,],
        ['email' => $email]*/
        //['comment' => $comment]
        //);
        //return view('users.conf', compact('name', 'email'));
        return view('users.conf')->with(compact('name', 'email'));

    }
}