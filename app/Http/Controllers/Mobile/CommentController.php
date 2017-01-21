<?php

namespace App\Http\Controllers\Mobile;

use App\Models\Assist;
use App\Models\AssistComment;
use App\Models\GoodComment;
use App\Models\GoodCommentComment;
use App\Models\Story;
use App\Models\StoryComment;
use App\Models\Good;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class CommentController extends Controller
{
    /**
     * 添加寻饰启事的评论
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addAssistComment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'assist_id' => 'required|numeric',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 40101, 'msg' => "参数有误"]);
        }

        $assist_id = $request->input('assist_id');
        $content = $request->input('content');
        $unionid = session('unionid');

        //assist表里的num_comment++
        $assist = Assist::where('id', $assist_id)->first();
        if (is_null($assist)) {
            return response()->json(['error' => 40102, 'msg' => "id参数有误"]);
        }
        $assist->num_comment++;
        $assist->save();

        $assist_comment = new AssistComment;
        $assist_comment->content = $content;
        $assist_comment->assist_id = $assist_id;
        $assist_comment->status = 1;
        $assist_comment->unionid = $unionid;
        $assist_comment->save();

        return response()->json(['error' => 0, 'msg' => "评论成功"]);
    }
    /**
     * 加载单个寻饰启事的评论
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAssistComment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'page' => 'required|numeric',
            'per_page' => 'required|numeric',
            'assist_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 40100, 'msg' => "参数有误"]);
        }

        $page = $request->input('page');
        $per_page = $request->input('per_page');
        $assist_id = $request->input('assist_id');

        $comments = AssistComment::join('user', 'user.unionid', '=', 'assist_comment.unionid')
            ->where([['assist_comment.assist_id', $assist_id], ['assist_comment.status', 1]])
            ->select('assist_comment.content', 'assist_comment.created_at', 'user.nickname as nickname')
            ->forPage($page, $per_page)
            ->orderBy('assist_comment.created_at', 'asc')
            ->get();
        $reply = [];
        foreach ($comments as &$value){
            $tmp = $value->toArray();
            $tmp['date'] = $value->created_at->format('m-d H:i');
            $reply[] = $tmp;
        }
        return response()->json(['error' => 0, 'data' => $reply]);
    }

    /**
     * 添加饰品故事的评论 接口
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addStoryComment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'story_id' => 'required|numeric',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 40103, 'msg' => "参数有误"]);
        }

        $story_id = $request->input('story_id');
        $content = $request->input('content');
        $unionid = session('unionid');

        //assist表里的num_comment++
        $story = Story::where('id', $story_id)->first();
        if (is_null($story)) {
            return response()->json(['error' => 40102, 'msg' => "id参数有误"]);
        }
        $story->num_comment++;
        $story->save();

        $story_comment = new StoryComment;
        $story_comment->content = $content;
        $story_comment->story_id = $story_id;
        $story_comment->status = 1;
        $story_comment->unionid = $unionid;
        $story_comment->save();

        return response()->json(['error' => 0, 'msg' => "评论成功"]);
    }

    /**
     * 加载单个饰品故事评论 的接口
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStoryComment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'page' => 'required|numeric',
            'per_page' => 'required|numeric',
            'story_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 40100, 'msg' => "参数有误"]);
        }

        $page = $request->input('page');
        $per_page = $request->input('per_page');
        $story_id = $request->input('story_id');

        $collections = StoryComment::select(
            'user.nickname',
            'user.headimgurl',
            'story_comment.content',
            'story_comment.id as comment_id',
            'story_comment.created_at'
        )->join('user', 'user.unionid', '=', 'story_comment.unionid')
            ->where([['story_comment.status',1]])
            ->forPage($page, $per_page)
            ->orderBy('story_comment.created_at', 'asc')
            ->get();
        foreach ($collections as &$value){
            $value->date = $value->created_at->format('m-d H:i');
        }
        $reply = $collections->toArray();
        return response()->json(['error' => 0, 'data' => $reply]);
    }


    /**
     * 添加商品评论
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addGoodsComment(Request $request){
        $validator = Validator::make($request->all(), [
            'goods_id' => 'required|numeric',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 40103, 'msg' => "参数有误"]);
        }
        $goods_id = $request->input('goods_id');
        $unionid = $request->input('unionid'); //之后改成从session里取
        $content = $request->input('content');

        $goods = Good::findOrFail($goods_id);
        if (is_null($goods)) {
            return response()->json(['error' => 40102, 'msg' => "商品id参数有误"]);
        }

        $goods_comment = new GoodComment;
        $goods_comment->goods_id = $goods_id;
        $goods_comment->unionid = $unionid;
        $goods_comment->content = $content;
        $goods_comment->status = 1;
        $goods_comment->save();

        return response()->json(['error'=>0,'msg'=>'评论添加成功']);
    }

    /**
     * 添加商品评论的评论
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addComment(Request $request){
        $validator = Validator::make($request->all(), [
            'comment_id' => 'required|numeric',
            'content' => 'required',
            'type' =>'numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 40103, 'msg' => "参数有误"]);
        }

        $comment_id = $request->input('comment_id');
        $content = $request->input('content');
        $type = $request->input('type');

        $comment = new GoodCommentComment;
        $comment->comment_id = $comment_id;
        $comment->content = $content;
        $comment->status = 1;
        $comment->type = $type;

        if($type==1) {
            $unionid = session('unionid');
            $comment->unionid = $unionid;
            $comment->save();
        }elseif ($type==2){
            $account = $request->input('account');
            $comment->account = $account;
            $comment->save();
        }
        return response()->json(['error'=>0,'msg'=>'评论添加成功']);
    }

    /**
     * 获取商品评论
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getGoodsComment(Request $request){
        $validator = Validator::make($request->all(), [
            'page' => 'required|numeric',
            'per_page' => 'required|numeric',
            'goods_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 40100, 'msg' => "参数有误"]);
        }

        $page = $request->input('page');
        $per_page = $request->input('per_page');
        $goods_id = $request->input('goods_id');

        $data = GoodComment::select(
            'user.nickname',
            'user.headimgurl',
            'goods_comment.content',
            'goods_comment.id as comment_id',
            'goods_comment.created_at'
        )->join('user', 'user.unionid', '=', 'goods_comment.unionid')
            ->where([['goods_comment.status',1],['goods_id',$goods_id]])
            ->forPage($page, $per_page)
            ->orderBy('goods_comment.created_at', 'desc')
            ->get();
        foreach ($data as &$value){
            $value->date = $value->created_at->format('Y-m-d H:i:s');
        }
//
        foreach($data as $v){
            $v->commentreply = GoodCommentComment::where('comment_id',$v->comment_id)->get();
//            $v->commentreply = 1;
        }
//        $v = GoodCommentComment::where('comment_id',1)->get();
        $reply = $data->toArray();
//        $reply = $v->toArray();
        return response()->json(['error' => 0, 'data' => $reply]);
    }
}
