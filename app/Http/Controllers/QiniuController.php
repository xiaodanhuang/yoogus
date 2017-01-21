<?php

namespace App\Http\Controllers;

use App\Models\Good;
use DB;
use Illuminate\Http\Request;
use zgldh\QiniuStorage\QiniuStorage;

class QiniuController extends Controller
{
    /**
     * 获取图片上传token内部方法
     * @param string $key
     * @return bool
     */
    public function getQiniuToken(Request $request)
    {
        $path = $request->input('path');
        $disk = QiniuStorage::disk('qiniu');
        $key = $path.'/'.md5(uniqid());
//        session(['filename'=>$key]);
        $token = $disk->uploadToken($key);
//         return $token;
       return response()->json(['error'=>0,'uptoken'=>$token ,'key'=>$key]) ;
    }

    public function uploadImgDemo()
    {
        $token = $this->getQiniuToken('tokentest');
        return view('qiniu.uploadImgDemo',['token'=>$token]);
    }

    public function getName(Request $request){
        $type = $request->input('type');
//        $filename = "/images/".uniqid().$type;
        $filename = session('filename');
        return response()->json(['error'=>0,'data'=>$filename]);
    }

}
