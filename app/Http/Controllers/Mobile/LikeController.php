<?php

namespace App\Http\Controllers\Mobile;

use App\Models\Good;
use App\Models\GoodLike;
use App\Models\Story;
use App\Models\StoryLike;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class LikeController extends Controller
{
    public function likeStory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'story_id' => 'required | numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 40401, 'msg' => "参数有误"]);
        }
        $story_id = $request->input('story_id');
        $unionid = session('unionid');

        $story = Story::where('id', $story_id)->first();
        if (is_null($story)) {
            return response()->json(['error' => 40402, 'msg' => "story_id参数有误"]);
        }

        $story_like = StoryLike::firstOrNew(['story_id' => $story_id, 'unionid' => $unionid]);

        if ($story_like->status === 1) {
            $story->num_like--;
            $story->save();

            $story_like->status = 2;
            $story_like->save();

            $reply = ['is_like' => 2];
        } else{
            $story->num_like++;
            $story->save();

            $story_like->status = 1;
            $story_like->save();

            $reply = ['is_like' => 1];
        }

        return response()->json(['error' => 0, 'data' => $reply, 'msg' => 'is_like 1表示 现在是收藏的状态 2表示是取消收藏的状态']);
    }
    /**
     * 商品收藏/取消收藏
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function likeGoods(Request $request){
        $validator = Validator::make($request->all(), [
            'goods_id' => 'required | numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 40401, 'msg' => "参数有误"]);
        }

        $goods_id = $request->input('goods_id');
        $unionid = session('unionid');

        $goods = Good::findOrFail($goods_id);
        if(is_null($goods)){
            return response()->json(['error' => 40402, 'msg' => "商品ID参数有误"]);
        }

        $goods_like = GoodLike::firstOrNew(['goods_id'=>$goods_id,'unionid'=>$unionid]);
        if ($goods_like->status ==1 ){
            $goods->num_like--;
            $num_like = $goods->num_like;
            $goods->save();

            $goods_like->status = 2;
            $goods_like->save();

            $data = ['status'=>2];
        }else{
            $goods->num_like++;
            $num_like = $goods->num_like;
            $goods->save();

            $goods_like->status = 1;
            $goods_like->save();

            $data = ['status'=>1];
        }
        return response()->json(['error' => 0, 'data' => $data, 'num_like'=>$num_like]);

    }
}
