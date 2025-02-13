<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToppageController extends Controller
{
    // トップページ画面表示
    public function index(){
        // if(\Auth::check()){
        //     return redirect(route("articles.index"));
        // }
        return view('toppage.index');
    }
}
