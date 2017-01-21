<?php

namespace App\Http\Controllers\Mobile;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Log;

class OauthController extends Controller
{
    /**
     * 引导用户静默授权 获取用户openid
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index()
    {
        $redirect_uri = route("baseinfo");
        $url = $this->getOauthUrl($redirect_uri);
        return redirect($url);
    }


    /**
     * 静默获取 的回调地址
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function getBaseInfo(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
        ]);
        $code = $request->input('code');
        $data_access_token = $this->getAccessToken($code);
        $access_token = $data_access_token['access_token'];
        $openid = $data_access_token['openid'];
        $data = $this->getUserInfoByToken($access_token, $openid);
        if (empty($data['unionid'])) {
            Log::error("获取不到用户的unionid");
        }
        $user = User::where('unionid', $data['unionid'])->first();
        if (empty($user)) {
            $user = new User;
            $user->unionid = $data['unionid'];
            $user->openid = $openid;
            $user->type = 1;
            $user->nickname = $data['nickname'];
            $user->sex = $data['sex'];
            $user->language = $data['language'];
            $user->city = $data['city'];
            $user->province = $data['province'];
            $user->country = $data['country'];
            $user->headimgurl = $data['headimgurl'];
            $user->status = 1;
            $user->save();
        }
        //将openid unionid存入session
        session(['openid' => $openid, 'unionid' => $data['unionid']]);
        $redirect_url = session('tmp_redirect_url', route('mobile_index'));
        return redirect($redirect_url);
    }

    /**
     * 获取 引导用户授权的url
     *
     * @param string $scope
     * @param string $redirect_uri
     * @param string $state
     * @return string
     */
    private function getOauthUrl($redirect_uri = "", $scope = "snsapi_base", $state = "")
    {
        $redirect_uri = urlencode($redirect_uri);
        $appid = env("WECHAT_APPID");
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri={$redirect_uri}&response_type=code&scope={$scope}&state={$state}#wechat_redirect";
        return $url;
    }

    /**
     * 通过code换取access_token
     *
     * @param $code
     * @return mixed
     */
    private function getAccessToken($code)
    {
        $appid = env("WECHAT_APPID");
        $appsecret = env("WECHAT_APPSECRET");
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$appid}&secret={$appsecret}&code={$code}&grant_type=authorization_code";
        $result = file_get_contents($url);
        $data = json_decode($result, 1);
        if (isset($data['errcode'])) {
            $msg = "40100 获取用户access_token错误" . $result;
            Log::error($msg);
            abort(403, "服务器崩溃了，请刷新再试");
            return false;
        }
        return $data;
    }

    /**
     * 通过access_token 和 openid获取用户信息
     *
     * @param $access_token
     * @param $openid
     * @return bool|mixed
     */
    private function getUserInfoByToken($access_token, $openid)
    {
        $url = "https://api.weixin.qq.com/sns/userinfo?access_token={$access_token}&openid={$openid}&lang=zh_CN";
        $result = file_get_contents($url);
        $data = json_decode($result, 1);
        if (isset($data['errcode'])) {
            $msg = "40100 获取用户信息错误" . $result;
            Log::error($msg);
            abort(403, "服务器崩溃了，请刷新再试");
            return false;
        }
        return $data;
    }
}
