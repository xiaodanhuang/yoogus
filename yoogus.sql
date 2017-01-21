CREATE TABLE `yoo_user`(
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`unionid` VARCHAR(28) NOT NULL UNIQUE DEFAULT '',
`openid` VARCHAR(28) NOT NULL DEFAULT '',
`type` TINYINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '默认普通用户为1 预留字段',
`nickname` VARCHAR(64) NOT NULL DEFAULT '' COMMENT '用户的微信昵称',
`sex` TINYINT NOT NULL DEFAULT 0 COMMENT '性别 1：男 2：女',
`language` VARCHAR(16) NOT NULL DEFAULT '' COMMENT '用户的默认语言',
`city` VARCHAR(64) NOT NULL DEFAULT '' COMMENT '用户所属城市',
`province` VARCHAR(64) NOT NULL DEFAULT '' COMMENT '所属省份',
`country` VARCHAR(64) NOT NULL DEFAULT '' COMMENT '国籍',
`headimgurl` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '用户头像的url 七牛上的全目录',
`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
`updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新时间',
`deleted_at` TIMESTAMP NULL DEFAULT NULL,
`status` TINYINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '状态 1：正常 0：不正常',
PRIMARY KEY (`id`)
)CHARSET = UTF8 ENGINE = INNODB COMMENT '移动端用户基础信息表';

CREATE TABLE `yoo_assist`(
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `unionid` VARCHAR(28) NOT NULL DEFAULT '',
  `content` TEXT NOT NULL COMMENT '寻饰启事的文字描述',
  `level` TINYINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '紧急等级 1：A 2：B',
  `num_comment` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '评论的条数',
  `status` TINYINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '1:正常 2：被屏蔽',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL ,
  PRIMARY KEY (`id`),
  INDEX (`unionid`)
)CHARSET = UTF8 ENGINE = INNODB COMMENT '朋友圈->寻饰启事的基础表';

CREATE TABLE `yoo_assist_comment`(
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `assist_id` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT 'assist寻饰启事的id',
  `unionid` VARCHAR(28) NOT NULL DEFAULT '' ,
  `content` TEXT NOT NULL COMMENT '用户对寻饰启事的评论',
  `status` TINYINT NOT NULL DEFAULT 0 COMMENT '0:无效 1：正常情况',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX (`assist_id`),
  INDEX (`unionid`)
)CHARSET = UTF8 ENGINE = INNODB COMMENT 'assist寻饰启事的评论表';

CREATE TABLE `yoo_assist_img`(
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `assist_id` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT 'assist寻饰启事的id',
  `url` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '图片的相对目录',
  `status` TINYINT NOT NULL DEFAULT 0 COMMENT '0:被屏蔽 1：正常显示',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX (`assist_id`)
)CHARSET = UTF8 ENGINE = INNODB COMMENT 'assist寻饰启事的图片表';

CREATE TABLE `yoo_story`(
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `unionid` VARCHAR(28) NOT NULL DEFAULT '',
  `title` VARCHAR(255) NOT NULL DEFAULT '',
  `content` TEXT NOT NULL COMMENT '饰品故事的文字描述',
  `num_comment` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '评论的条数',
  `num_like` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '点赞的条数',
  `status` TINYINT NOT NULL DEFAULT 0 COMMENT '0:无效、被屏蔽 1：正常',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX (`unionid`)
)CHARSET = UTF8 ENGINE = INNODB COMMENT '朋友圈->饰品故事的基础表';

CREATE TABLE `yoo_story_comment`(
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `story_id` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT 'story 饰品故事的id',
  `unionid` VARCHAR(28) NOT NULL DEFAULT '',
  `content` TEXT NOT NULL COMMENT '用户对饰品故事的评论',
  `status` TINYINT NOT NULL DEFAULT 0 COMMENT '0:无效、被屏蔽 1：正常',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX (`story_id`),
  INDEX (`unionid`)
)CHARSET = UTF8 ENGINE = INNODB COMMENT 'story饰品故事的评论表';

CREATE TABLE `yoo_story_like`(
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `story_id` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT 'store 饰品故事的id',
  `unionid` VARCHAR(28) NOT NULL DEFAULT '',
  `status` TINYINT NOT NULL DEFAULT 0 COMMENT '0:无效 1：点赞',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX (`story_id`,`unionid`)
)CHARSET = UTF8 ENGINE = INNODB COMMENT 'story饰品故事的点赞表';

CREATE TABLE `yoo_trader`(
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `unionid` VARCHAR(28) NOT NULL DEFAULT '',
  `type` TINYINT NOT NULL DEFAULT 0 COMMENT '商家类型 1:最高管理员',
  `store_id` INT NOT NULL DEFAULT 0 COMMENT '管理的店铺的id,为客服等账号管理做铺垫',
  `account` VARCHAR(64) NOT NULL UNIQUE DEFAULT '' COMMENT '账号',
  `password` VARCHAR(32) NOT NULL DEFAULT '' COMMENT 'md5加密密码',
  `name` VARCHAR(48) NOT NULL DEFAULT '' COMMENT '掌柜的名字',
  `sex` TINYINT NOT NULL DEFAULT 0 COMMENT '1：男 2：女 0：未知',
  `phone` VARCHAR(11) NOT NULL DEFAULT '' COMMENT '手机',
  `id_card` VARCHAR(18) NOT NULL DEFAULT '' COMMENT '身份证',
  `email` VARCHAR(32) NOT NULL DEFAULT '' COMMENT 'email',
  `birthday` TIMESTAMP NOT NULL DEFAULT current_timestamp COMMENT '出生日期',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新时间',
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  `status` TINYINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '状态 1：正常 0：不正常',
  PRIMARY KEY (`id`)
)CHARSET = UTF8 ENGINE = INNODB COMMENT '商家信息基础表';

CREATE TABLE `yoo_store`(
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `unionid` VARCHAR(28) NOT NULL DEFAULT '',
  `type` TINYINT NOT NULL DEFAULT 0 COMMENT '1:实体店铺 2：个人商家',
  `name` VARCHAR(64) NOT NULL DEFAULT '' COMMENT '店铺名字',
  `address` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '店铺地址',
  `logo_url` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'logo的url',
  `description` TEXT NOT NULL COMMENT '店铺的介绍',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新时间',
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  `status` TINYINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '状态 1：正常 0：不正常',
  PRIMARY KEY (`id`)
)CHARSET = UTF8 ENGINE = INNODB COMMENT '店铺信息表';

CREATE TABLE `yoo_store_like`(
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `store_id` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT 'store 店铺的id',
  `unionid` VARCHAR(28) NOT NULL DEFAULT '',
  `status` TINYINT NOT NULL DEFAULT 0 COMMENT '0:无效 1：点赞',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX (`store_id`,`unionid`)
)CHARSET = UTF8 ENGINE = INNODB COMMENT '店铺收藏表';

CREATE TABLE `yoo_goods`(
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `store_id` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT 'store 店铺',
  `store_name` VARCHAR(64) NOT NULL COMMENT'店铺名称',
  `logo_url` VARCHAR(64) NOT NULL COMMENT'店铺头像',
  `name` VARCHAR(10) NOT NULL DEFAULT '' COMMENT '商品名称(关键字)',
  `description` VARCHAR(64) NOT NULL COMMENT '商品简要描述',
  `style` JSON NOT NULL COMMENT '商品风格标签的json数组',
  `category` JSON NOT NULL COMMENT '商品的类目',
  `purpose` JSON NOT NULL COMMENT '商品的用途',
  `count` INT(10) NOT NULL COMMENT'商品库存',
  `price` FLOAT(8,2) UNSIGNED NOT NULL COMMENT'商品价格',
  `num_like` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '收藏数',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新时间',
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  `status` TINYINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '状态 1：正常 0：不正常',
  PRIMARY KEY (`id`),
  INDEX (`store_id`)
)CHARSET = UTF8 ENGINE = INNODB COMMENT '商品表';

CREATE TABLE `yoo_goods_comment`(
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `goods_id` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT 'story 商品的id',
  `unionid` VARCHAR(28) NOT NULL DEFAULT '',
  `content` TEXT NOT NULL COMMENT '用户对饰品故事的评论',
  `status` TINYINT NOT NULL DEFAULT 0 COMMENT '0:无效、被屏蔽 1：正常',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX (`goods_id`),
  INDEX (`unionid`)
)CHARSET = UTF8 ENGINE = INNODB COMMENT '商品的评论表';

CREATE TABLE `yoo_goods_comment_comment`(
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `comment_id` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT 'story 商品评论的id',
  `type` TINYINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '1:表示 买家回复 2：店家回复',
  `unionid` VARCHAR(28) NOT NULL DEFAULT '' COMMENT'买家回复的时候用',
  `account` VARCHAR(32) NOT NULL DEFAULT '' COMMENT'卖家回复的时候用',
  `content` TEXT NOT NULL COMMENT '用户对饰品故事的评论',
  `status` TINYINT NOT NULL DEFAULT 0 COMMENT '0:无效、被屏蔽 1：正常',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX (`comment_id`),
  INDEX (`unionid`)
)CHARSET = UTF8 ENGINE = INNODB COMMENT '商品评论表的评论表';

CREATE TABLE `yoo_goods_img`(
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `goods_id` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT 'goods的id',
  `url` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '图片的相对目录',
  `infor` TEXT NOT NULL COMMENT'图片对应的描述',
  `status` TINYINT NOT NULL DEFAULT 0 COMMENT '0:被屏蔽 1：正常显示',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX (`goods_id`)
)CHARSET = UTF8 ENGINE = INNODB COMMENT 'goods的图片表';

CREATE TABLE `yoo_goods_like`(
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `goods_id` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT 'goods的id',
  `unionid` VARCHAR(28) NOT NULL DEFAULT '' ,
  `status` TINYINT NOT NULL DEFAULT 0 COMMENT '0:被屏蔽 1：收藏 2：不收藏',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX (`goods_id`)
)CHARSET = UTF8 ENGINE = INNODB COMMENT 'goods的收藏表';

CREATE TABLE `yoo_order`(
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `goods_id` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT 'goods的id',
  `unionid` VARCHAR(28) NOT NULL DEFAULT '' COMMENT'买家unionid' ,
  `store_id` INT UNSIGNED NOT NULL COMMENT'店铺的id',
  `count` INT(4) NOT NULL COMMENT'购买数量',
  `price` FLOAT (10,2) NOT NULL COMMENT'商品单价',
  `address` TEXT NOT NULL COMMENT'用户收货地址',
  `phone` INT(11) NOT NULL COMMENT'用户联系方式',
  `message` TEXT COMMENT'买家留言',
  `status` TINYINT NOT NULL DEFAULT 0 COMMENT '0:被屏蔽 1：待发货 2：已发货 3:已收货',
  `autoaccept` TIMESTAMP NOT NULL COMMENT'自动收货时间',
  `delay` INT(2) NOT NULL DEFAULT 0 COMMENT'0不延时收货，1延时收货',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX (`goods_id`)
)CHARSET = UTF8 ENGINE = INNODB COMMENT '订单表';

CREATE TABLE `yoo_cart`(
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `goods_id` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT 'goods的id',
  `unionid` VARCHAR(28) NOT NULL DEFAULT '' COMMENT'买家unionid' ,
  `count` INT(4) NOT NULL COMMENT'购买数量',
  `status` TINYINT NOT NULL DEFAULT 0 COMMENT '0:被屏蔽 1：有效 2：用户主动删除3：处于确认订单状态 4：已付款',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX (`goods_id`)
)CHARSET = UTF8 ENGINE = INNODB COMMENT '购物车表';

CREATE TABLE `yoo_user_addr`(
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `unionid` VARCHAR(28) NOT NULL DEFAULT '' COMMENT'买家unionid' ,
  `addr` VARCHAR(255) NOT NULL DEFAULT '' COMMENT'收货地址',
  `phone` INT(11) NOT NULL DEFAULT 0 COMMENT'联系方式',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX (`goods_id`)
)CHARSET = UTF8 ENGINE = INNODB COMMENT '买家收货地址';

