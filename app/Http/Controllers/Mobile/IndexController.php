<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view('mobile.index_index');
    }

    public function detail($goods_id){
        return view('mobile.index_goodsdetail',compact('goods_id'));
    }
}
