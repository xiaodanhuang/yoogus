<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Good;
use App\Models\Goodsimg;
use App\Models\GoodLike;
use App\Models\Store;
use App\Models\StoreLike;
use Illuminate\Support\Facades\DB;
use Validator;
/*商品接口*/
class GoodController extends Controller
{
    /**
     * 添加商品接口
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addGoods(Request $request){
        $validator = Validator::make($request->all(), [
//            'content' => 'required',
//            'storeid' => 'required | numeric',
            'title' => 'required|max:10',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 40201, 'msg' => "参数有误"]);
        }

        $pic = $request->input('pic');
        $infor = $request->input('infor');
        $picnum = count($pic);
        $infornum = count($infor);
        if($picnum != $infornum){
            return response()->json(['error'=>40001,'msg'=>"图片与描述个数不符"]);
        }

        $goods = new Good;
//        $goods->store_id= $request->input('storeid');                         //店铺ID
//        $goods->store_name = $request->input('stroename');                               //店铺名称
        $goods->store_id= 1;                         //店铺ID
        $goods->store_name = "优咕官方店";                               //店铺名称
        $goods->logo_url = 'trader/logourl/yoogus.jpg';
        $goods->name = $request->input('title');                            //商品关键字
        $goods->description = $request->input('description');               //商品描述
        $goods->style = json_encode($request->input('style'));              //商品风格标签
        $goods->category = json_encode($request->input('category'));        //商品类别
        $goods->purpose = json_encode($request->input('purpose'));               //商品用途
        $goods->count = $request->input('count');                            //商品库存
        $goods->price = $request->input('price');
        $goods->status = 1;
        $goods->save();
        $good_id = $goods->id;

        for ($i=0;$i<$picnum;$i++){
            $goods_img = [
                'goods_id'=> $good_id,
                'url'=>$pic[$i],
                'infor'=>$infor[$i],
                'status'=>1,
            ];

            Goodsimg::create($goods_img);
        }
        $next_url = "cart/showconfirm";
        return response()->json(['error'=>0,'msg'=>"发布成功",'nexturl'=>$next_url]);
    }

    /**
     * 删除商品接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delGoods(Request $request){
        $operating = $request->input('operating');
        if($operating!='delete'){
            return response()->json(['error'=>40002,'msg'=>'请求参数错误']);
        }
        $goods_id = $request->input('gid');
        Good::findOrFail($goods_id)->delete();
        Goodsimg::where('goods_id',$goods_id)->delete();

        return response()->json(['error'=>0,'msg'=>"删除成功"]);

    }

    /**
     * 获取修改商品页面的详细内容
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeFrom(Request $request){
        $goods_id = $request->input('goods_id');
        $data = Good::findOrFail($goods_id);
        $data->img = Good::findOrFail($goods_id)->img;
        return response()->json(['error'=>0,'data'=>$data]);
    }

    /**
     * 修改商品接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeGoods(Request $request){
        $pic = $request->input('pic');
        $infor = $request->input('infor');
        $picnum = count($pic);
        $infornum = count($infor);
        if($picnum != $infornum){
            return response()->json(['error'=>40001,'msg'=>"图片与描述个数不符"]);
        }

        $id = $request->input('id');
        $goods = Good::findOrFail($id);
        $goods->name = $request->input('title');                            //商品关键字
        $goods->description = $request->input('description');               //商品描述
        $goods->style = json_encode($request->input('style'));              //商品风格标签
        $goods->category = json_encode($request->input('category'));        //商品类别
        $goods->purpose = json_encode($request->input('purpose'));               //商品用途
        $goods->count = $request->input('count');                            //商品库存
        $goods->status = 1;
        $goods->save();
        $good_id = $goods->id;
        //先把图片都删掉，再重新生成一次
        Goodsimg::where('goods_id',$good_id)->delete();
        for ($i=0;$i<$picnum;$i++){
            $goods_img = [
                'goods_id'=> $good_id,
                'url'=>$pic[$i],
                'infor'=>$infor[$i],
                'status'=>1,
            ];
            Goodsimg::create($goods_img);
        }

        return response()->json(['error'=>0,'msg'=>"修改成功"]);

    }

    /**
     * 网站首页查询商品接口可按时间或好评切换
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request){
            $validator = Validator::make($request->all(), [
//            'content' => 'required',
//            'storeid' => 'required | numeric',
//            'title' => 'required|max:10',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => 40201, 'msg' => "参数有误"]);
            }
        $style = $request->input('style');
        $category = $request->input('category');
        $purpose = $request->input('purpose');
        $price = explode('-',$request->input('price'));
        $timeorhot = $request->input('timeorhot');
        $begin = $request->input('begin'); //从几号开始

        $many = $request->input('many');   //加载几条商品
        $unionid = session('unionid');

        if($timeorhot==1){
            $goods = DB::select(
                'select id,store_id,store_name,name,description,price,num_like,count,logo_url
                from yoo_goods 
                where status=1
                AND count>0
                AND deleted_at IS NULL
                AND JSON_SEARCH(style, \'all\', ?) IS NOT NULL 
                AND JSON_SEARCH(category, \'all\', ?) IS NOT NULL 
                AND JSON_SEARCH(purpose, \'all\', ?) IS NOT NULL
                AND price >= ?
                AND price <= ?
                ORDER BY created_at desc
                limit ?,?',
            [$style,$category,$purpose,$price[0],$price[1],$begin,$begin+$many]
            );
        }elseif ($timeorhot==2){
            $goods = DB::select(
                'select id,store_id,store_name,name,description,price,num_like,count,logo_url
                from yoo_goods 
                where status=1
                AND count>0
                AND deleted_at IS NULL
                AND JSON_SEARCH(style, \'all\', ?) IS NOT NULL 
                AND JSON_SEARCH(category, \'all\', ?) IS NOT NULL 
                AND JSON_SEARCH(purpose, \'all\', ?) IS NOT NULL
                AND price >= ?
                AND price <= ?
                ORDER BY num_like DESC,created_at DESC
                limit ?,?',
                [$style,$category,$purpose,$price[0],$price[1],$begin,$begin+$many]
            );
        }
        if(empty($goods)){
            return response()->json(['error'=>40003,'msg'=>"没有数据了"]);
        }

        foreach($goods as $v){
            $v->logo_url = "http://qiniu.yoogus.com/".$v->logo_url;
            $tmp = Goodsimg::select('url')->where('goods_id',$v->id)->first();
            $v->img = $tmp['url'];
            $iflike = GoodLike::select('status')->where('goods_id',$v->id)->where('unionid',$unionid)->first();
            if(is_null($iflike)){
                $v->iflike = 2;
            }else{
                $v->iflike = $iflike->status;
            }

            $salltype = Store::select('type')->where('id',$v->store_id)->first();
            if($salltype->type==1){
                $v->salltype = "店铺";
            }else{
                $v->salltype = "咕粉";
            }
        }


        $goodsnum = count($goods);
        $begin+=$goodsnum;

        return response()->json(['error'=>0,'data'=>$goods,'begin'=>$begin]);

    }

    /**
     * 商家查询发布过的商品 只能查询ID为1的商家
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function traderGoods(Request $request){
//        $store_id = $request->input('store_id');
        $store_id = 1;
        $data = Good::select('id','store_name','description','num_like')->where([['store_id',$store_id],['status',1]])->get();

        foreach($data as $k=>$v){
            $img = Goodsimg::select('url')->where('goods_id',$v->id)->first();
            $data[$k]['img'] = $img['url'];
        }
        return response()->json(['error'=>0,'data'=>$data]);
    }

    /**
     * 网站首页查询商品详情
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function detail(Request $request){
        $goods_id = $request->input('goodsid');
        $data = Good::findOrFail($goods_id);
        $data->logo_url = "http://qiniu.yoogus.com/".$data->logo_url;
        $data->img = Good::findOrFail($goods_id)->img->where('status',1);

        $goodsnum = Good::where('store_id',$data->store_id)->get();
        $data->goodsnum = $goodsnum->count();

        $likenum = StoreLike::where('store_id',$data->store_id)->get();
        $data->attennum = $likenum->count();
        return response()->json(['error'=>0,'data'=>$data]);
    }
}
