<?php

namespace App\Http\Controllers\Mobile;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserAddr;
use Validator;
class UserAddrController extends Controller
{
    /**
     * 获取用户地址
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(){
        $unionid = session('unionid');
        $addr = UserAddr::where('unionid',$unionid)->first();
        return response()->json(['error'=>0,'data'=>$addr]);
    }

    /**
     * 修改/添加用户收货地址
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function submit(Request $request){
        $validator = Validator::make($request->all(), [
            'addr' => 'required',
            'phone' => 'required|numeric',
            'name'=>'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 40101, 'msg' => "参数有误"]);
        }
        $name = $request->input('name');
        $addr = $request->input('addr');
        $phone = $request->input('phone');
        $unionid = session('unionid');

        $user_addr = UserAddr::where('unionid',$unionid)->first();
        if(is_null($user_addr)){
            $user_addr = new UserAddr;
        }
        $user_addr->name = $name;
        $user_addr->addr = $addr;
        $user_addr->phone = $phone;
        $user_addr->unionid = $unionid;
        $user_addr->save();
        return response()->json(['error'=>0,'msg'=>'地址添加/修改成功']);
    }
}
