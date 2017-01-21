<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //oauth授权
        'oauth/',
        'oauth/baseinfo',
        //local 测试
//        'moments/assist',

//        'comment/assist',
//        'moments/story',
//        'moments/story/add',
//        'moments/assist/add',
//        'comment/story',
//        'comment/story/add',
//        'comment/assist/add',
        'comment/goods/add',
        'comment/goods',
        'comment/comment',
        'qiniu/token',
        'qiniu/getname',
        'mine/getStory',
        'mine/getAccBags',
        'mine/getStore',
        'mine/head',
        'mine/index',
        'cart/getcart',
        'cart/addcart',
        'cart/addcountcart',
        'cart/deccountcart',
        'cart/deletecart',
        'cart/confirm',
        'cart/settle',
//        'like/story',
        'like/goods',
        'goods/add',
        'goods/delete',
        'goods/change',
        'goods/tradergoods',
        'goods/detail',
        'goods/changefrom',
        'goods/index',
        'orders/index',
        'orders/check',
        'orders/show',
        'orders/delay',
        'addr/get',
        'addr/submit'

    ];
}
