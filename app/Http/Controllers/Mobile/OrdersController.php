<?php
/**
 * Created by PhpStorm.
 * User: heartsky
 * Date: 16-12-12
 * Time: 下午4:09
 */

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Validator;

class OrdersController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function check(Request $request)
    {
        $unionid = session('unionid');
        $unionid = 1;
        $id = $request->input('id');
        $id = 1;
        $status = DB::table('order')
            ->where('unionid','=',$unionid)
            ->where('id','=',$id)
            ->update(['status' => 3]);

        return response()->json(['error'=>0,'data'=>$status]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $unionid = session('unionid');
        $unionid = 1;
        $page = $request->input('page');
        $per_page = $request->input('per_page');
        $orders = DB::table('order')
            ->where('unionid','=',$unionid)
            ->orderBy('created_at','desc')
            ->get();
        $len = count($orders);
        for($i = 0; $i < $len; $i++)
        {
            $goods_id = $orders[$i]->goods_id;
            $arr = DB::table('goods')
                ->where('id','=',$goods_id)
                ->select('store_name','logo_url','description')
                ->get();
            $imgs = DB::table('goods_img')
                ->where('goods_id','=',$goods_id)
                ->select('url')
                ->first();
            $orders[$i]->store_name = $arr[0]->store_name;
            $orders[$i]->logo_url = $arr[0]->logo_url;
            $orders[$i]->description = $arr[0]->description;
            $orders[$i]->url = $imgs->url;
        }
        $orders = $orders->forPage($page,$per_page);
        //var_dump($orders);
        return response()->json(['error'=>0,'data'=>$orders]);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function delay(Request $request)
    {
        $unionid = session('unionid');
        $unionid = 1;
        $id = $request->input('id');

        // 检测是否已延时收货
        $delay = DB::table('order')
            ->where('unionid','=',$unionid)
            ->where('id','=',$id)
            ->select('delay')
            ->get()[0]
            ->delay;
        if($delay === 1)
        {
            return response()->json(['error'=>0,'data'=>0]);
            exit;
        }

        // 延长自动收货时间
        $time = DB::table('order')
            ->where('unionid','=',$unionid)
            ->where('id','=',$id)
            ->select('autoaccept')
            ->get()[0]
            ->autoaccept;
        $time = date('Y-m-d H:i:s',strtotime($time) + 60 * 60 * 24 * 5);
        $status = DB::table('order')
            ->where('unionid','=',$unionid)
            ->where('id','=',$id)
            ->update(['autoaccept' => $time]); // 延期五天，且只能延期一次

        // 更改延时收货状态为1(已延时收货)
        DB::table('order')
            ->where('unionid','=',$unionid)
            ->where('id','=',$id)
            ->update(['delay' => 1]);

        return response()->json(['error'=>0,'data'=>$status]);
    }
}