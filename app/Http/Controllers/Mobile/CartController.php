<?php

namespace App\Http\Controllers\Mobile;

use App\Models\Cart;
use App\Models\Good;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;


class CartController extends Controller
{

    /**
     * 显示确认订单页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showConfirm(){
        return view('mobile.order_confirm');
    }

    public function settle(Request $request){
        $validator = Validator::make($request->all(), [
            'goods_id' => 'required',
//            'storeid' => 'required | numeric',
//            'title' => 'required|max:10',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => 40201, 'msg' => "参数有误"]);
        }
        $unionid = session('unionid');
        $goods_id = $request->input('goods_id');
        $next_url = "cart/showconfirm";
        return response()->json(['unionid'=>$unionid,'goods_id'=>$goods_id,'next_url'=>$next_url]);
//        foreach ($goods_id as $v){
//            $goods = Cart::where('goods_id',$v)->where('unionid',$unionid)->first();
//            $goods->status = 3;
//            $goods->save();
//        }
//        return redirect('cart/showconfirm');

//        return response()->json(['error'=>0,'nexturl'=>$next_url]);

    }

    /**
     * 订单确认页面接口post
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function confirmOrder(Request $request){
        $validator = Validator::make($request->all(), [
//            'content' => 'required',
//            'storeid' => 'required | numeric',
//            'title' => 'required|max:10',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => 40201, 'msg' => "参数有误"]);
        }

        $unionid = session('unionid');
        $cart = Cart::where('unionid',$unionid)->where('status',3)->get();
        if($cart->count()==0){
            return response()->json(['error'=>50001,'msg'=>'订单数据有误，请到购物车重新下单']);

        }
        foreach ($cart as $k=>$v){
            $goods[$k] = Good::where('id',$v->goods_id)->select('id','store_name','logo_url','description','price')->first();
            $goods[$k]->count = $v->count;
            $img = Good::FindOrFail($v->goods_id)->img()->first();
            $goods[$k]->img = $img->url;
        }
        return response()->json(['error'=>0,'data'=>$goods]);
    }

    /**
     * 购物车页面get
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('mobile.cart_index');
    }

    /**
     * 向购物车添加商品
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'goods_id' => 'required|numeric',
            'type' =>'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 40200, 'msg' => "参数有误"]);
        }

        //$openid = $request->session()->get('openid');
        $unionid = $request->session()->get('unionid');
        $goods_id = $request->input('goods_id');

        $tmp = Good::find($goods_id);
        if(!$tmp){
            return response()->json(['error' => 40020,'msg'=>"商品编号错误"]);
        }

        $cart = Cart::where('goods_id',$goods_id)->where('unionid',$unionid)->first();
        if($cart){
            $cart->count++;
        }else{
            $cart=new Cart;
            $cart->goods_id = $goods_id;
            $cart->unionid = $unionid;
            $cart->count = 1;
            $cart->status = 1;
        }
            $cart->save();

        $type = $request->input('type');
        if(1==$type){
            return response()->json(['error' => 0,'msg'=>"success"]);
        }elseif (2==$type){
            return response()->json(['error' => 0,'msg'=>"success",'next_url'=>'cart/showconfirm']);
        }
    }


    public function getCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'page' => 'required|numeric',
            'per_page' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 40200, 'msg' => "参数有误"]);
        }

        //$openid = $request->session()->get('openid');
        $head_url = $request->session()->get('head_url');
        $nickname = $request->session()->get('nickname');
        $unionid = $request->session()->get('unionid');
        $unionid="aaaaa";

        $page = $request->input('page');
        $per_page = $request->input('per_page');



        $arr=Cart::where('cart.unionid',$unionid)
            ->where('cart.status',1)
          //  ->join('goods','goods.id','=','cart.goods_id')
            ->select('cart.goods_id')
          //  ->where('goods.status',1)
            ->forPage($page,$per_page)
            ->get();

        $reply=$this->doCartData($arr);

        return response()->json(['error' => 0, 'data' => $reply]);
    }

    public function addcountCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'goods_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 40200, 'msg' => "参数有误"]);
        }

        //$openid = $request->session()->get('openid');
        $head_url = $request->session()->get('head_url');
        $nickname = $request->session()->get('nickname');
        $unionid = $request->session()->get('unionid');
//        $unionid="windsleeve";

        $goods_id=$request->input('goods_id');

        $arr=Cart::where('unionid', $unionid)
            ->where('goods_id',$goods_id)
            ->increment('count',1);


        return response()->json(['error' => 0, 'msg' => "success"]);
    }

    public function deccountCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'goods_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 40200, 'msg' => "参数有误"]);
        }

        //$openid = $request->session()->get('openid');
        $head_url = $request->session()->get('head_url');
        $nickname = $request->session()->get('nickname');
        $unionid = $request->session()->get('unionid');
//        $unionid="windsleeve";

        $goods_id=$request->input('goods_id');

        $arr=Cart::where('unionid', $unionid)
            ->where('goods_id',$goods_id)
            ->decrement('count',1);


        return response()->json(['error' => 0, 'msg' => "success"]);
    }

    public function deleteCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'goods_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 40200, 'msg' => "参数有误"]);
        }

        //$openid = $request->session()->get('openid');
        $head_url = $request->session()->get('head_url');
        $nickname = $request->session()->get('nickname');
        $unionid = $request->session()->get('unionid');
       // $unionid="windsleeve";

        $goods_id=$request->input('goods_id');

        $arr=Cart::where('unionid', $unionid)
            ->where('goods_id',$goods_id)
            ->update(['status'=>2]);


        return response()->json(['error' => 0, 'msg' => "success"]);
    }

    private function doCartData($arr)
    {
        $reply = [];
        foreach ($arr as $value) {
            // $tmp = $value->toArray();

            $tmp = $value
                ->join('goods_img','goods_img.goods_id','=','cart.goods_id')
                ->join('goods','goods.id','=','cart.goods_id')
                ->where('goods.id',$value['goods_id'])
                ->where('goods_img.goods_id',$value['goods_id'])
                ->select('goods_img.url as goodsimg','goods.logo_url as storeimg','goods.description','goods.store_name', 'goods.price','cart.count','goods.id as goods_id')
                ->first();
                if(!empty($tmp))
                {
                    $tmp->toArray();
                }


            // $tmp = array_merge($tmp, $good);
            //$tmp['date'] = $value->updated_at->format('y-m-d');

            $reply[] = $tmp;
        }
        return $reply;
    }
}
