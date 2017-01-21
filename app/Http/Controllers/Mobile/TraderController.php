<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Good;
/*商家后台控制器*/
class TraderController extends Controller
{
    /*后台商家首页*/
    public function index(){
        //首先获取商家id 去商品表里找对应id的商品
//        $data =
//        $data = Good::all()->toArray();
        return view('mobile.trader_index');

    }

    /*商家发布商品页面*/
    public function create(){
        return view('mobile.trader_present');
    }

    /**
     * 修改商品页面
     * @param $goods_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function changefrom($goods_id){
        $data = Good::findOrFail($goods_id);
        $data->img = Good::findOrFail($goods_id)->img;
        return view('mobile.trader_change',compact('data'));
    }
}
