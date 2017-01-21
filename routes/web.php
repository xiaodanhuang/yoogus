<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 *
 *uniond 相关
 *
 */
/** oauth获取用户openid首页 */
Route::get('oauth/', 'Mobile\OauthController@index')->name('oauth');

/** 静默授权回调地址 */
Route::get('oauth/baseinfo', 'Mobile\OauthController@getBaseInfo')->name('baseinfo');



/**
 *
 * 饰品淘优页面
 *
 */

/** 移动端首页 */
Route::get('/', 'Mobile\IndexController@index')->name("mobile_index");

/**商品详情页面*/
Route::get('detail/goods/{goods_id}','Mobile\IndexController@detail')->middleware('checkUnionid');



/**
 * 朋友圈
 *
 */

/** 朋友圈首页 */
Route::get('moments/', 'Mobile\MomentsController@index')->middleware('checkUnionid');

Route::get('moments/share', 'Mobile\MomentsController@share')->middleware('checkUnionid');

/** 发布评论 -两个一起 */
Route::get('moments/submit', 'Mobile\MomentsController@submitshow')->middleware('checkUnionid');

/** 发布饰品故事 */
Route::get('moments/submit/story', 'Mobile\MomentsController@submitStory')->middleware('checkUnionid');

/** 发布寻饰启事 */
Route::get('moments/submit/assist', 'Mobile\MomentsController@submitAssist')->middleware('checkUnionid');

/** 加载饰品故事接口 */
Route::post('moments/story', 'Mobile\MomentsController@getStoryBasic')->middleware('checkUnionid');

/** 添加饰品故事的接口 */
Route::post('moments/story/add', 'Mobile\MomentsController@addStoryBasic')->middleware('checkUnionid');

/** 加载寻饰启事接口 */
Route::post('moments/assist', 'Mobile\MomentsController@getAssistBasic')->middleware('checkUnionid');

/** 添加寻饰启事的接口 */
Route::post('moments/assist/add', 'Mobile\MomentsController@addAssistBasic')->middleware('checkUnionid');

/** 订单详情 */
Route::get('mine/index', 'Mobile\MineController@index')->middleware('checkUnionid');

/** 个人中心->故事盒接口*/
Route::post('mine/getStory','Mobile\MineController@getStory')->middleware('checkUnionid');

/** 个人中心->饰品袋接口*/
Route::post('mine/getAccBags','Mobile\MineController@getAccBags')->middleware('checkUnionid');

/** 个人中心->关注掌柜接口*/
Route::post('mine/getStore','Mobile\MineController@getStore')->middleware('checkUnionid');

/** 个人中心->基本信息接口*/
Route::post('mine/head','Mobile\MineController@head')->middleware('checkUnionid');

/**个人中心主页**/
Route::get('mine/index','Mobile\MineController@index');

/**
 *  七牛相关
 *
 */

/** 七牛上传图片DEMO */
Route::get('qiniu/', 'QiniuController@uploadImgDemo');

/** 获取七牛的token */
Route::post('qiniu/token', 'QiniuController@getQiniuToken');

/**获取文件名*/
Route::post('qiniu/getname','QiniuController@getName');

/**
 * 评论接口
 *
 */

/** 加载寻饰启事评论的接口 */
Route::post('comment/assist', 'Mobile\CommentController@getAssistComment')->middleware('checkUnionid');

/** 添加寻饰启事评论 的接口 */
Route::post('comment/assist/add', 'Mobile\CommentController@addAssistComment')->middleware('checkUnionid');

/** 加载饰品故事评论的接口 */
Route::post('comment/story', 'Mobile\CommentController@getStoryComment')->middleware('checkUnionid');

/** 添加饰品故事评论的接口 */
Route::post('comment/story/add', 'Mobile\CommentController@addStoryComment')->middleware('checkUnionid');

/**添加商品评论*/
Route::post('comment/goods/add','Mobile\CommentController@addGoodsComment')->middleware('checkUnionid');

/**获取单件商品评论*/
Route::post('comment/goods','Mobile\CommentController@getGoodsComment')->middleware('checkUnionid');

/**添加商品评论的评论*/
Route::post('comment/comment','Mobile\CommentController@addComment')->middleware('checkUnionid');

/**
 * 收藏\点赞接口
 *
 */

/** 点赞饰品故事接口 */

Route::post('like/story', 'Mobile\LikeController@likeStory')->middleware('checkUnionid');

/**收藏某件商品*/
Route::post('like/goods','Mobile\LikeController@likeGoods')->middleware('checkUnionid');

/**
 *  商品接口
 *
 *
 */

/**添加商品的接口*/
Route::post('goods/add','Mobile\GoodController@addGoods');

/**修改商品的接口*/
Route::post('goods/change','Mobile\GoodController@changeGoods');

/**删除商品接口*/
Route::post('goods/delete','Mobile\GoodController@delGoods');

/**商家查询已发布商品的接口*/
Route::post('goods/tradergoods','Mobile\GoodController@traderGoods');

/**处理商家修改商品的接口*/
Route::post('goods/changefrom','Mobile\GoodController@changeFrom');

/**获取商品详情*/
Route::post('goods/detail','Mobile\GoodController@detail')->middleware('checkUnionid');

/**按照一定条件查询商品*/
Route::post('goods/index','Mobile\GoodController@index')->middleware('checkUnionid');


/**
 * 商家接口
 */

/**后台商家首页*/
Route::get('trader/index','Mobile\TraderController@index')->middleware('checkUnionid');

/**商家发布商品页面*/
Route::get('trader/create','Mobile\TraderController@create')->middleware('checkUnionid');

/**商家修改商品页面 */
Route::get('trader/change/{goods_id}','Mobile\TraderController@changefrom');


/**
 * 购物车接口
 *
 */
/**显示确认订单页面*/
Route::get('cart/showconfirm','Mobile\CartController@showConfirm');

/**确认订单页面获取购物车信息*/
Route::post('cart/confirm','Mobile\CartController@confirmOrder')->middleware('checkUnionid');

/**显示购物车页面*/
Route::get('cart/index','Mobile\CartController@index');

/** 显示个人购物车信息接口*/
Route::post('cart/getcart','Mobile\CartController@getCart')->middleware('checkUnionid');

/**添加购物车数据接口*/
Route::post('cart/addcart','Mobile\CartController@addCart')->middleware('checkUnionid');

/**添加购物车goods count数据接口*/
Route::post('cart/addcountcart','Mobile\CartController@addCountCart')->middleware('checkUnionid');

/**减去购物车goods count数据接口*/
Route::post('cart/deccountcart','Mobile\CartController@decCountCart')->middleware('checkUnionid');

/**删除购物车goods数据接口*/
Route::post('cart/deletecart','Mobile\CartController@deleteCart')->middleware('checkUnionid');

/**结算按钮接口*/
Route::post('cart/settle','Mobile\CartController@settle')->middleware('checkUnionid');

/**添加购物车接口*/
//Route::post('cart/');

/**
 * 个人中心 -> 我的 -> 订单查询
 * author HeartSky
 */
/** 确认收货接口 */
Route::post('orders/check','Mobile\OrdersController@check');

/** 展示订单查询页面 */
Route::post('orders/show','Mobile\OrdersController@show');

/** 延期收货接口 */
Route::post('orders/delay','Mobile\OrdersController@delay');

/**
 * 用户地址接口
 */
/**获取用户收货地址*/
Route::post('addr/get','Mobile\UserAddrController@get')->middleware('checkUnionid');

/**修改或添加用户收货地址*/
Route::post('addr/submit','Mobile\UserAddrController@submit')->middleware('checkUnionid');