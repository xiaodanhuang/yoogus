<?php

namespace App\Http\Controllers\Mobile;

use App\Models\Cart;
use App\Models\GoodLike;
use App\Models\Good;
use App\Models\Order;
use App\Models\StoreLike;
use App\Models\Story;
use App\Models\StoryLike;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;


class MineController extends Controller
{
    public function index()
    {
        return view('mobile.mine_index');
    }

    public function head(Request $request)
    {
        $head_url = $request->session()->get('head_url');
        $nickname = $request->session()->get('nickname');
        $unionid = $request->session()->get('unionid');

        $unionid='larry';
        $goods_num=GoodLike::where('status',1)
                  ->where('unionid',$unionid)
                  ->count();

        $story_num=StoryLike::where('status',1)
                  ->where('unionid',$unionid)
                  ->count();

        $store_num=StoreLike::where('status',1)
                  ->where('unionid',$unionid)
                  ->count();

        $order_num=Order::where('unionid',$unionid)
                  ->whereIn('status',[1,2])
                  ->count();

        $reply=['nickname'=>$nickname,'head_url'=>$head_url,'goods_num'=>$goods_num,'story_num'=>$story_num,'store_num'=>$store_num,'order_num'=>$order_num];

        return response()->json(['error' => 0, 'data' => $reply]);
    }

    public function order()
    {
        return view('mobile.mine_order');
    }

    public function getorder(Request $request)
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

        $page = $request->input('page');
        $per_page = $request->input('per_page');


    }


    public function getStore(Request $request)
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

        $page = $request->input('page');
        $per_page = $request->input('per_page');

        $unionid="larry";
        $nickname='hahahah';
        $head_url="ashdkasf";

        $arr=StoreLike::where('store_like.status',1)
            ->where('store_like.unionid',$unionid)
            ->select('store_like.store_id','store.id')
            ->join('store','store.id','=','store_like.store_id')
            ->where('store.status',1)
            ->forPage($page,$per_page)
            ->get();
//dd($arr->count());
        //dd($arr);
        $reply = $this->doStoreData($arr);
     //   $reply['nickname']=$nickname;
    //    $reply['head_url']=$head_url;

        return response()->json(['error' => 0, 'data' => $reply]);

    }

    public function getAccBags(Request $request)
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

        $page = $request->input('page');
        $per_page = $request->input('per_page');

       $unionid="aaaaa";
//        $nickname='hahahah';
//        $head_url="ashdkasf";

        $arr=GoodLike::where('goods_like.status',1)
            ->where('goods_like.unionid',$unionid)
            ->select('goods_like.goods_id','goods.store_id')
            ->join('goods','goods.id','=','goods_like.goods_id')
            ->where('goods.status',1)
            ->forPage($page,$per_page)
            ->get();

        $reply = $this->doAccBagsData($arr);
      //  $reply['nickname']=$nickname;
       // $reply['head_url']=$head_url;

        return response()->json(['error' => 0, 'data' => $reply]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'page' => 'required|numeric',
            'per_page' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 40200, 'msg' => "参数有误"]);
        }

//        $openid = $request->session()->get('openid');
          $head_url = $request->session()->get('head_url');
          $nickname = $request->session()->get('nickname');
          $unionid = $request->session()->get('unionid');
          $unionid='larry';
//        $nickname='hahahah';
//        $head_url="ashdkasf";
        $page = $request->input('page');
        $per_page = $request->input('per_page');

        $arr=StoryLike::where('story_like.status',1)
            ->where('story_like.unionid',$unionid)
            ->select('story_like.story_id','story.unionid')
            ->join('story','story.id','=','story_like.story_id')
            ->where('story.status',1)
            ->forPage($page,$per_page)
            ->get();

       // $num = Story::where('status',1)->where('id',$like)->count();
//        $arr = Story::where('status',1)->where('unionid',$unionid)
//                  //  ->forPage($page,$per_page)
//                    ->get();

        $reply = $this->doStoryData($arr);
     //   $reply['nickname']=$nickname;
      //  $reply['head_url']=$head_url;

        return response()->json(['error' => 0, 'data' => $reply]);

    }

    private function doStoryData($arr)
    {
        $reply = [];
        foreach ($arr as $value) {
            //$tmp = $value->toArray();

            $tmp = $value
                ->join('story','story.id','=','story_like.story_id')
                ->join('user','user.unionid','=','story.unionid')
                ->where('story.id',$value['story_id'])
                ->where('user.unionid',$value['unionid'])
                ->select('user.nickname','user.headimgurl','story.content', 'story.num_like','story.updated_at as date')
                ->first()
                //->updated_at->format('y-m-d')
                ->toArray();
            //dd($tmp);
            //$tmp['updated_at'] = $tmp['updated_at']->format('y-m-d');

            $reply[] = $tmp;
        }

        return $reply;
    }

    private function doAccBagsData($arr)
    {
        $reply = [];
        //dd($arr);
        foreach ($arr as $value) {
           // $tmp = $value->toArray();

            $tmp = $value
                ->join('goods','goods.id','=','goods_like.goods_id')
                ->join('store','store.id','=','goods.store_id')
                ->join('goods_img','goods_img.goods_id','=','goods.id')
                ->where('goods_img.goods_id',$value['goods_id'])
                ->where('goods.id',$value['goods_id'])
                ->where('store.id',$value['store_id'])
                ->select('store.type','store.name','store.address', 'store.logo_url as store_logourl','goods_img.url as goods_logourl','goods.description','goods.num_like')
                ->first()
                ->toArray();

           // $tmp = array_merge($tmp, $good);
            //$tmp['date'] = $value->updated_at->format('y-m-d');

            $reply[] = $tmp;
        }
        return $reply;
    }
    private function doStoreData($arr)
    {
        $reply = [];
        foreach ($arr as $value) {
            // $tmp = $value->toArray();
              //dd($value);
            $tmp = $value
                ->join('store','store.id','=','store_like.store_id')
                ->where('store.id',$value['store_id'])
                ->select('store.type','store.name','store.address', 'store.logo_url')
                ->first()
                ->toArray();

            // $tmp = array_merge($tmp, $good);
            //$tmp['date'] = $value->updated_at->format('y-m-d');

            $reply[] = $tmp;
        }
        return $reply;
    }


}
