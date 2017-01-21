<?php

namespace App\Http\Controllers\Mobile;

use App\Models\Assist;
use App\Models\AssistImg;
use App\Models\Story;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class MomentsController extends Controller
{
    /**
     * 朋友圈的首页
     *
     */
    public function index()
    {
        return view("mobile.moments_index");
    }

    /**
     * 分享页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function share()
    {
        return view('mobile.moments_share');
    }

    /**
     * 评论页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function submitshow()
    {
        return view('mobile.moments_submit');
    }

    /**
     * 发布饰品故事
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function submitStory()
    {
        return view('mobile.moments_story_submit');
    }

    /**
     * 发布寻饰启事
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function submitAssist()
    {
        return view('mobile.moments_assist_submit');
    }

    /**
     * 添加寻思启事的接口
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addAssistBasic(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required',
            'level' => 'required | numeric',
            'img' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 40201, 'msg' => "参数有误"]);
        }

        $content = $request->input('content');
        $level = $request->input('level');
        $img = $request->input('img');
        $unionid = session('unionid');

        $assist = new Assist;
        $assist->content = $content;
        $assist->level = $level;
        $assist->unionid = $unionid;
        $assist->status = 1;
        $assist->save();
        $assist_id = $assist->id;
        foreach ($img as $value) {
            $assist_img_data = [
                'assist_id' => $assist_id,
                'status' => 1,
                'url' => $value,
            ];
            AssistImg::create($assist_img_data);
        }

        return response()->json(['error' => 0, 'msg' => '添加成功']);
    }

    /**
     * 获取寻饰启事数据 的接口
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAssistBasic(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'page' => 'required|numeric',
            'per_page' => 'required|numeric',
            'type' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 40200, 'msg' => "参数有误"]);
        }

        $page = $request->input('page');
        $per_page = $request->input('per_page');
        $type = $request->input('type');

        // 不同排序
        if ($type == '1') {
            $assist_collection = Assist::where([['status', 1]])
                ->forPage($page, $per_page)
                ->orderBy('created_at', 'desc')
                ->get();
        } elseif ($type == '2') {
            $assist_collection = Assist::where([['status', 1]])
                ->forPage($page, $per_page)
                ->orderBy('level', 'asc')
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            return response()->json(['error' => 40201, 'msg' => "参数有误"]);
        }

        //判断查询结果是否为空
        if (is_null($assist_collection)) {
            return response()->json(['error' => 0, "data" => []]);
        }

        $reply = $this->doAssistBasicData($assist_collection);
        return response()->json(['error' => 0, 'data' => $reply]);
    }

    /**
     * 处理寻饰启事的collection数据
     *
     * @param $collections
     * @return array
     */
    private function doAssistBasicData($collections)
    {
        $reply = [];
        foreach ($collections as $value) {
            $tmp = $value->toArray();
            //个人昵称 头像
            $user = $value->user()->select('nickname', 'headimgurl')->first()->toArray();
            $tmp = array_merge($tmp, $user);
            //图片
            $img = $value->img()->select('url')->get()->toArray();
            $tmp['img'] = $img;
            $tmp['date'] = $value->created_at->format('y-m-d');
            $tmp['assist_id'] = $value->id;
            $reply[] = $tmp;
        }
        return $reply;
    }

    public function addStoryBasic(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 40209, 'msg' => "参数有误"]);
        }

        $content = $request->input('content');
        $unionid = session('unionid');

        $story = new Story;
        $story->content = $content;
        $story->unionid = $unionid;
        $story->status = 1;
        $story->save();

        return response()->json(['error' => 0, 'msg' => '添加成功']);
    }
    /**
     * 获取饰品故事的接口
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStoryBasic(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'page' => 'required|numeric',
            'per_page' => 'required|numeric',
            'type' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 40200, 'msg' => "参数有误"]);
        }

        $page = $request->input('page');
        $per_page = $request->input('per_page');
        $type = $request->input('type');
        $unionid = session('unionid');
        $story = Story::select(
            "story.content",
            "story.num_comment",
            "story.num_like",
            "story.created_at",
            "story.id",
            "user.nickname",
            "user.headimgurl",
            "story_like.status as like_status"
        )->join('user', "user.unionid", "=", "story.unionid")
            ->leftJoin('story_like', function ($join) use ($unionid) {
                $join->on("story_like.story_id", "=", "story.id")
                    ->where('story_like.unionid', $unionid);
            })
            ->where([['story.status', 1]])
            ->forPage($page, $per_page);
        if ($type == 1) {
            $collections = (clone $story)->orderBy('created_at', 'desc')->get();
        } elseif ($type == 2) {
            $collections = (clone $story)->orderBy('num_like', 'desc')->orderBy('created_at', 'desc')->get();
        }else{
            $collections = null;
        }

        //判断查询结果是否为空
        if (is_null($collections)) {
            return response()->json(['error' => 0, "data" => []]);
        }
        $reply = $this->doStoryBasicData($collections);
        return response()->json(['error' => 0, "data" => $reply]);
    }

    /**
     * 处理饰品故事的数据集合
     *
     * @param \Illuminate\Database\Eloquent\Collection $collections
     * @return array
     */
    public function doStoryBasicData($collections)
    {
        foreach ($collections as &$collection) {
            $collection->date = $collection->created_at->format('m-d H:i');
            if ($collection->like_status === 1) {
                $collection->is_like = 1;
            } else {
                $collection->is_like = 2;
            }
            $collection->story_id = $collection->id;
        }
        return $collections->toArray();
    }
}
