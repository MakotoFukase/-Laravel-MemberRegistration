<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ModelController extends Controller
{
    public function index(Request $request)
    {
        $items = User::all();
        return view('user.index',['items' => $items]);
    }
}
