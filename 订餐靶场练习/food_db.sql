/*
SQLyog Ultimate v12.08 (64 bit)
MySQL - 5.7.26 : Database - food_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`food_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `food_db`;

/*Table structure for table `collection` */

DROP TABLE IF EXISTS `collection`;

CREATE TABLE `collection` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL COMMENT '用户id',
  `res_id` int(10) unsigned NOT NULL COMMENT '店铺id',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1：有效 0：无效',
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '最后一次更新时间',
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '插入时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `member_id` (`member_id`,`res_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

/*Data for the table `collection` */

insert  into `collection`(`id`,`member_id`,`res_id`,`status`,`updated_time`,`created_time`) values (13,6,1,1,'2022-02-23 22:34:02','2022-02-23 22:34:02'),(10,4,1,1,'2022-02-21 22:16:01','2022-02-21 22:16:01'),(14,6,2,1,'2022-02-23 22:34:10','2022-02-23 22:34:10');

/*Table structure for table `food` */

DROP TABLE IF EXISTS `food`;

CREATE TABLE `food` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `res_id` int(11) NOT NULL DEFAULT '0' COMMENT '餐厅id',
  `cat_id` int(11) NOT NULL COMMENT '类别id',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '食物名称',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '售卖金额',
  `main_image` varchar(100) NOT NULL DEFAULT '' COMMENT '主图',
  `summary` varchar(10000) NOT NULL DEFAULT '' COMMENT '描述',
  `stock` int(11) NOT NULL DEFAULT '0' COMMENT '库存量',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1：有效 0：无效',
  `total_count` int(11) NOT NULL DEFAULT '0' COMMENT '总销售量',
  `view_count` int(11) NOT NULL DEFAULT '0' COMMENT '总浏览次数',
  `comment_count` int(11) NOT NULL DEFAULT '0' COMMENT '总评论量',
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '最后更新时间',
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '最后插入时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COMMENT='食品表';

/*Data for the table `food` */

insert  into `food`(`id`,`res_id`,`cat_id`,`name`,`price`,`main_image`,`summary`,`stock`,`status`,`total_count`,`view_count`,`comment_count`,`updated_time`,`created_time`) values (1,2,2,'鱼香肉丝','10.00','food/7d6b640108b047a1997616ebebdbc916.jpg','<p>鱼香肉丝是川菜中的一道名品，主要是用鲫鱼腌制的泡辣椒炒制猪里脊肉丝而成，以此将肉丝炒出鱼香味，故而叫鱼香肉丝。</p>',1142,1,208,0,0,'2022-02-23 22:31:27','2020-05-05 08:46:34'),(2,2,2,'水煮肉片','15.00','food/68c608acf57a42d19d6b9814e454bf1a.jpg','<p>水煮肉片是一道地方新创名菜，起源于自贡，发扬于西南，属于川菜中著名的家常菜。因肉片未经划油，以水煮熟故名水煮肉片。</p>',1148,1,102,0,0,'2022-02-20 17:25:41','2020-05-05 08:48:37'),(3,1,1,'农家小炒肉','10.00','food/19c25a1b46054ad2828b02f31ddebb6c.jpg','<p>小炒肉是湖南省一道常见的特色传统名菜，属于湘菜系。麻辣鲜香，口味滑嫩。制作原料主要是五花肉和青椒、红椒等。</p>',1186,1,361,0,0,'2022-02-23 22:16:44','2020-05-05 08:50:37'),(4,1,1,'剁椒鱼头','20.00','food/9fb52ddd5b4746038394fe743fce5cce.jpg','<p>剁椒鱼头是湖南省的传统名菜，属于湘菜系。通常以鳙鱼鱼头、剁椒为主料，配以豉油、姜、葱、蒜等辅料蒸制而成。菜品色泽红亮、味浓、肉质细嫩。肥而不腻、口感软糯、鲜辣适口。</p>',1127,1,249,0,0,'2022-02-23 20:54:19','2020-05-05 08:53:03'),(5,3,3,'白切鸡','10.00','food/4bb33aca1e4d4935ac03fda7ee2ab409.jpg','<p>白切鸡又叫白斩鸡，是中国八大菜之一粤菜系鸡肴中的一种，始于清代的民间酒店。</p><p>白切鸡通常选用细骨农家鸡与沙姜、蒜茸等食材，慢火煮浸后，晾干切块。</p><p>成菜后，色洁白带油黄，皮爽肉滑骨香，清淡鲜美。</p><p><br/></p>',1137,1,148,0,0,'2022-02-23 22:32:24','2020-05-05 08:55:40'),(6,3,3,'木瓜炖雪蛤','20.00','food/433d50e061f54c469083ade89205f2b1.jpg','<p>木瓜炖雪蛤是一道美味可口的传统名点，属于粤菜系。以木瓜和雪蛤为主要食材，属粤式甜品，润肤养颜，营养价值丰富。主要材料有木瓜、雪蛤油、鲜奶、水等。</p>',1120,1,68,0,0,'2022-02-20 17:25:41','2020-05-05 08:57:31'),(7,4,4,'飞龙汤','15.00','food/fe26d84de2a84c1fa286924fcc1297dc.jpg','<p>飞龙又名榛鸡是黑龙江省的名菜之一，属于龙江菜系，产于兴安岭。飞龙汤是将榛鸡脱毛去掉内脏后，用高汤煮熟即可，汤中不需放任何调料以保持汤原汁原味。飞龙汤肉质鲜美，营养丰富，适合用作滋补汤品。</p>',1126,1,99,0,0,'2022-02-20 17:01:57','2020-05-05 08:59:53'),(8,5,5,'糖醋鲤鱼','15.00','food/620858717a704b5d8bfb950f5036a68a.jpg','<p>店长推荐<br/></p>',1150,1,231,0,0,'2020-05-15 16:30:26','2020-05-15 16:30:26');

/*Table structure for table `food_cat` */

DROP TABLE IF EXISTS `food_cat`;

CREATE TABLE `food_cat` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '类别名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1：有效 0：无效',
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '最后一次更新时间',
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '插入时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_name` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COMMENT='食品分类';

/*Data for the table `food_cat` */

insert  into `food_cat`(`id`,`name`,`status`,`updated_time`,`created_time`) values (1,'湘菜',1,'2020-05-05 08:40:15','2020-05-05 08:40:15'),(2,'川菜',1,'2020-05-05 08:40:28','2020-05-05 08:40:28'),(3,'粤菜',1,'2020-05-05 08:40:43','2020-05-05 08:40:43'),(4,'东北菜',1,'2020-05-05 08:40:56','2020-05-05 08:40:56'),(5,'鲁菜',1,'2020-05-15 16:28:20','2020-05-15 16:28:20');

/*Table structure for table `images` */

DROP TABLE IF EXISTS `images`;

CREATE TABLE `images` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `file_key` varchar(60) NOT NULL DEFAULT '' COMMENT '文件名',
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '插入时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

/*Data for the table `images` */

insert  into `images`(`id`,`file_key`,`created_time`) values (1,'20200505/7d6b640108b047a1997616ebebdbc916.jpg','2020-05-05 08:44:32'),(2,'20200505/68c608acf57a42d19d6b9814e454bf1a.jpg','2020-05-05 08:47:57'),(3,'20200505/19c25a1b46054ad2828b02f31ddebb6c.jpg','2020-05-05 08:49:57'),(4,'20200505/9fb52ddd5b4746038394fe743fce5cce.jpg','2020-05-05 08:52:13'),(5,'20200505/4bb33aca1e4d4935ac03fda7ee2ab409.jpg','2020-05-05 08:55:37'),(6,'20200505/433d50e061f54c469083ade89205f2b1.jpg','2020-05-05 08:57:27'),(7,'20200505/fe26d84de2a84c1fa286924fcc1297dc.jpg','2020-05-05 08:59:10'),(8,'20200515/620858717a704b5d8bfb950f5036a68a.jpg','2020-05-15 16:29:29'),(9,'20220104/4bdc048563d6431ab775319d5651f3af.jpg','2022-01-04 11:41:07');

/*Table structure for table `member` */

DROP TABLE IF EXISTS `member`;

CREATE TABLE `member` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nickname` varchar(100) NOT NULL DEFAULT '' COMMENT '会员名',
  `password` varchar(13) NOT NULL COMMENT '会员密码',
  `mobile` varchar(11) NOT NULL DEFAULT '' COMMENT '会员手机号码',
  `email` varchar(100) NOT NULL DEFAULT '' COMMENT '会员邮箱',
  `avatar` varchar(200) NOT NULL DEFAULT 'testuser.jpg' COMMENT '会员头像',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1：有效 0：无效',
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '最后一次更新时间',
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '插入时间',
  `last_login_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '最后登录时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nickname` (`nickname`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COMMENT='会员表';

/*Data for the table `member` */

insert  into `member`(`id`,`nickname`,`password`,`mobile`,`email`,`avatar`,`status`,`updated_time`,`created_time`,`last_login_time`) values (3,'a11111','a11111','17680640995','1628789905@qq.com','2022/02/23/1645587883.jpg',1,'2022-02-23 11:44:43','2022-02-14 13:26:59','2022-02-23 21:59:32'),(4,'neko123','qwer123','18984080846','1628789905@qq.com','testuser.jpg',1,'2022-02-21 22:06:37','2022-02-21 22:06:37','2022-02-23 22:16:25'),(5,'a123456','qwer1234','18984080846','1628789905@qq.com','testuser.jpg',1,'2022-02-22 14:41:25','2022-02-22 14:41:25','2022-02-22 14:41:36'),(6,'aaaaaa','aaaaaa','17680640995','1628789905@qq.com','testuser.jpg',1,'2022-02-23 22:27:03','2022-02-23 22:27:03','2022-02-23 22:27:11');

/*Table structure for table `member_address` */

DROP TABLE IF EXISTS `member_address`;

CREATE TABLE `member_address` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL DEFAULT '0' COMMENT '会员id',
  `nickname` varchar(20) NOT NULL DEFAULT '' COMMENT '收货人姓名',
  `mobile` varchar(11) NOT NULL DEFAULT '' COMMENT '收货人手机号码',
  `province` varchar(50) NOT NULL DEFAULT '' COMMENT '省名称',
  `city` varchar(50) NOT NULL DEFAULT '' COMMENT '市名称',
  `county` varchar(50) NOT NULL DEFAULT '' COMMENT '县区名称',
  `address` varchar(100) NOT NULL DEFAULT '' COMMENT '详细地址',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否有效 1：有效 0：无效',
  `is_default` tinyint(1) NOT NULL DEFAULT '0' COMMENT '默认地址',
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '最后一次更新时间',
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '插入时间',
  PRIMARY KEY (`id`),
  KEY `idx_member_id_status` (`member_id`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COMMENT='会员收货地址';

/*Data for the table `member_address` */

insert  into `member_address`(`id`,`member_id`,`nickname`,`mobile`,`province`,`city`,`county`,`address`,`status`,`is_default`,`updated_time`,`created_time`) values (4,3,'老谭','18984080846','四川省','成都市','成华区','成华大道二仙桥',0,0,'2022-02-23 21:19:04','2022-02-15 15:30:32'),(5,3,'yellow','17680640987','四川省','成都市','武侯区','高新青年公寓',0,0,'2022-02-23 21:19:05','2022-02-15 18:28:25'),(6,3,'123','18984080846','河南省','信阳市','城关镇','sdafsafsa',1,0,'2022-02-18 15:26:49','2022-02-15 18:52:22'),(7,3,'555','17680640987','湖南省','长沙市','芙蓉区','湖南农业大学',1,0,'2022-02-20 17:10:36','2022-02-15 18:56:56'),(8,3,'yellow','18984080846','四川省','广安市','岳池县','123456',1,0,'2022-02-23 21:19:05','2022-02-21 16:44:22'),(9,4,'123','18984080846','四川省','成都市','武侯区','123456',1,0,'2022-02-21 22:16:54','2022-02-21 22:16:54'),(10,5,'老谭','18984080846','四川省','成都市','成华区','成华大道二仙桥',1,0,'2022-02-22 14:45:21','2022-02-22 14:43:57'),(11,6,'123','18984080846','重庆市','重庆市','大渡口区','123456',1,0,'2022-02-23 22:31:08','2022-02-23 22:31:08');

/*Table structure for table `member_cart` */

DROP TABLE IF EXISTS `member_cart`;

CREATE TABLE `member_cart` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` bigint(20) NOT NULL DEFAULT '0' COMMENT '会员id',
  `food_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品id',
  `quantity` int(11) NOT NULL DEFAULT '0' COMMENT '数量',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1：有效 0：无效',
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '最后一次更新时间',
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '插入时间',
  PRIMARY KEY (`id`),
  KEY `idx_member_id` (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COMMENT='购物车';

/*Data for the table `member_cart` */

insert  into `member_cart`(`id`,`member_id`,`food_id`,`quantity`,`status`,`updated_time`,`created_time`) values (1,3,3,1,0,'2022-02-17 16:18:10','2022-02-16 15:51:28'),(2,3,3,1,0,'2022-02-16 16:03:01','2022-02-16 16:03:01'),(3,3,3,1,0,'2022-02-16 16:35:38','2022-02-16 16:35:38'),(4,3,4,1,0,'2022-02-17 16:18:10','2022-02-17 11:00:55'),(5,3,1,1,0,'2022-02-17 16:57:34','2022-02-17 16:57:18'),(6,3,1,1,0,'2022-02-17 16:58:16','2022-02-17 16:58:04'),(7,3,3,1,0,'2022-02-18 14:52:40','2022-02-18 14:22:58'),(8,3,1,1,0,'2022-02-18 14:52:45','2022-02-18 14:27:17'),(9,3,1,1,0,'2022-02-20 14:28:38','2022-02-18 14:50:08'),(10,3,1,2,0,'2022-02-20 14:28:39','2022-02-18 15:03:12'),(11,3,1,1,0,'2022-02-20 14:28:37','2022-02-20 14:28:31'),(12,3,3,1,0,'2022-02-20 16:37:01','2022-02-20 16:36:40'),(13,3,6,1,0,'2022-02-20 16:40:12','2022-02-20 16:40:06'),(14,3,6,1,0,'2022-02-20 16:45:18','2022-02-20 16:41:46'),(15,3,5,1,0,'2022-02-20 16:45:18','2022-02-20 16:41:57'),(16,3,4,1,0,'2022-02-20 16:46:50','2022-02-20 16:46:42'),(17,3,7,1,0,'2022-02-20 17:00:33','2022-02-20 16:47:42'),(18,3,7,1,0,'2022-02-20 17:00:33','2022-02-20 16:48:32'),(19,3,7,1,0,'2022-02-20 17:01:58','2022-02-20 17:01:51'),(20,3,3,4,0,'2022-02-20 17:24:01','2022-02-20 17:23:51'),(21,3,1,2,0,'2022-02-20 17:25:41','2022-02-20 17:24:43'),(22,3,2,2,0,'2022-02-20 17:25:42','2022-02-20 17:24:49'),(23,3,3,2,0,'2022-02-20 17:25:42','2022-02-20 17:24:57'),(24,3,4,2,0,'2022-02-20 17:25:42','2022-02-20 17:25:05'),(25,3,5,1,0,'2022-02-20 17:25:42','2022-02-20 17:25:09'),(26,3,6,5,0,'2022-02-20 17:25:42','2022-02-20 17:25:16'),(27,3,3,1,0,'2022-02-21 20:23:01','2022-02-21 11:27:37'),(28,3,3,1,0,'2022-02-21 20:23:02','2022-02-21 11:27:42'),(29,4,3,2,0,'2022-02-21 22:17:38','2022-02-21 22:16:09'),(30,3,1,2,0,'2022-02-22 13:03:39','2022-02-22 13:03:21'),(31,5,1,2,0,'2022-02-22 14:44:16','2022-02-22 14:43:11'),(32,3,3,1,0,'2022-02-22 14:49:41','2022-02-22 14:49:38'),(33,3,3,1,0,'2022-02-23 20:54:19','2022-02-23 16:13:47'),(34,3,4,1,0,'2022-02-23 20:54:19','2022-02-23 18:16:48'),(35,3,3,1,0,'2022-02-23 22:00:52','2022-02-23 21:18:30'),(36,4,3,1,0,'2022-02-23 22:16:45','2022-02-23 22:16:37'),(37,6,1,2,0,'2022-02-23 22:31:27','2022-02-23 22:27:28'),(38,6,5,2,0,'2022-02-23 22:32:24','2022-02-23 22:32:15');

/*Table structure for table `member_comments` */

DROP TABLE IF EXISTS `member_comments`;

CREATE TABLE `member_comments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL DEFAULT '0' COMMENT '会员id',
  `food_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品id',
  `pay_order_id` int(11) NOT NULL DEFAULT '0' COMMENT '订单id',
  `score` tinyint(4) NOT NULL DEFAULT '0' COMMENT '评分',
  `content` varchar(200) NOT NULL DEFAULT '' COMMENT '评论内容',
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '插入时间',
  PRIMARY KEY (`id`),
  KEY `idx_member_id` (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COMMENT='会员评论表';

/*Data for the table `member_comments` */

insert  into `member_comments`(`id`,`member_id`,`food_id`,`pay_order_id`,`score`,`content`,`created_time`) values (12,3,1,16,0,'味道好，速度快','2022-02-21 18:51:03'),(13,3,2,16,0,'味道好，速度快','2022-02-21 18:51:03'),(14,3,3,16,0,'味道好，速度快','2022-02-21 18:51:04'),(15,3,4,16,0,'味道好，速度快','2022-02-21 18:51:04'),(16,3,5,16,0,'味道好，速度快','2022-02-21 18:51:04'),(17,3,6,16,0,'味道好，速度快','2022-02-21 18:51:04'),(18,3,1,5,0,'1234567','2022-02-21 19:04:38'),(19,4,3,17,0,'5555555555555','2022-02-21 22:18:56'),(20,5,1,19,0,'味道好，速度快','2022-02-22 14:46:45'),(21,4,3,22,0,'味道好，速度快','2022-02-23 22:17:52');

/*Table structure for table `pay_order` */

DROP TABLE IF EXISTS `pay_order`;

CREATE TABLE `pay_order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_sn` varchar(40) NOT NULL DEFAULT '' COMMENT '随机订单号',
  `member_id` bigint(11) NOT NULL DEFAULT '0' COMMENT '会员id',
  `total_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '订单应付金额',
  `yun_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '运费金额',
  `pay_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '订单实付金额',
  `pay_select` varchar(128) NOT NULL DEFAULT '' COMMENT '支付选择方式',
  `prepay_id` varchar(128) NOT NULL DEFAULT '' COMMENT '第三方预付id',
  `note` text NOT NULL COMMENT '备注信息',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1：支付完成 0 无效 -1 申请退款 -2 退款中 -9 退款成功  -8 待支付  -7 完成支付待确认',
  `express_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '快递状态，-8 待支付 -7 已付款待发货 1：确认收货 0：失败',
  `express_address_id` int(11) NOT NULL DEFAULT '0' COMMENT '快递地址id',
  `express_info` varchar(1000) NOT NULL DEFAULT '' COMMENT '快递信息',
  `comment_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '评论状态',
  `pay_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '付款到账时间',
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '最近一次更新时间',
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '插入时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_order_sn` (`order_sn`),
  KEY `idx_member_id_status` (`member_id`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COMMENT='在线购买订单表';

/*Data for the table `pay_order` */

insert  into `pay_order`(`id`,`order_sn`,`member_id`,`total_price`,`yun_price`,`pay_price`,`pay_select`,`prepay_id`,`note`,`status`,`express_status`,`express_address_id`,`express_info`,`comment_status`,`pay_time`,`updated_time`,`created_time`) values (4,'2022021716181055593',3,'0.00','0.00','30.00','alipay','','防火',0,0,4,'',0,'2022-02-17 16:18:10','2022-02-18 17:00:57','2022-02-17 16:18:10'),(5,'2022021716573498426',3,'0.00','0.00','10.00','alipay','','2222',1,1,5,'',1,'2022-02-17 16:57:34','2022-02-17 16:57:34','2022-02-17 16:57:34'),(6,'2022021716581659180',3,'0.00','0.00','10.00','alipay','','3333',0,0,7,'',0,'2022-02-17 16:58:16','2022-02-20 16:50:55','2022-02-17 16:58:16'),(7,'2022022016370196726',3,'0.00','0.00','10.00','alipay','','',0,0,4,'',0,'2022-02-20 16:37:01','2022-02-20 16:50:45','2022-02-20 16:37:01'),(8,'2022022016401263712',3,'0.00','0.00','20.00','alipay','','',0,0,5,'',0,'2022-02-20 16:40:12','2022-02-20 16:50:46','2022-02-20 16:40:12'),(9,'2022022016421044304',3,'0.00','0.00','30.00','alipay','','',0,0,5,'',0,'2022-02-20 16:42:10','2022-02-20 16:50:48','2022-02-20 16:42:10'),(10,'2022022016425276384',3,'0.00','0.00','30.00','alipay','','',0,0,5,'',0,'2022-02-20 16:42:52','2022-02-20 16:50:49','2022-02-20 16:42:52'),(11,'2022022016451878030',3,'0.00','0.00','30.00','alipay','','',0,0,5,'',0,'2022-02-20 16:45:18','2022-02-20 16:50:50','2022-02-20 16:45:18'),(12,'2022022016464936043',3,'0.00','0.00','20.00','alipay','','',1,1,5,'',0,'2022-02-20 16:46:49','2022-02-20 16:50:50','2022-02-20 16:46:49'),(13,'2022022017003388376',3,'0.00','0.00','30.00','alipay','','',1,1,5,'',0,'2022-02-20 17:00:33','2022-02-20 17:01:34','2022-02-20 17:00:33'),(14,'2022022017015831612',3,'0.00','0.00','15.00','alipay','','',0,0,5,'',0,'2022-02-20 17:01:58','2022-02-23 22:10:42','2022-02-20 17:01:58'),(15,'2022022017240038070',3,'0.00','0.00','40.00','alipay','','',0,0,5,'',0,'2022-02-20 17:24:00','2022-02-23 22:10:41','2022-02-20 17:24:00'),(16,'2022022017254154538',3,'0.00','0.00','220.00','alipay','','',1,1,5,'',1,'2022-02-20 17:25:41','2022-02-20 17:25:41','2022-02-20 17:25:41'),(17,'2022022122173897462',4,'0.00','0.00','20.00','alipay','','123457',1,1,9,'',1,'2022-02-21 22:17:38','2022-02-21 22:17:38','2022-02-21 22:17:38'),(18,'2022022213033861556',3,'0.00','0.00','20.00','alipay','','1111',0,0,4,'',0,'2022-02-22 13:03:38','2022-02-22 14:49:23','2022-02-22 13:03:38'),(19,'2022022214441690194',5,'0.00','0.00','20.00','alipay','','1111',1,1,10,'',1,'2022-02-22 14:44:16','2022-02-22 14:45:21','2022-02-22 14:44:16'),(20,'2022022320541994754',3,'0.00','0.00','30.00','alipay','','',0,0,4,'',0,'2022-02-23 20:54:19','2022-02-23 22:10:43','2022-02-23 20:54:19'),(21,'2022022322005210576',3,'0.00','0.00','10.00','alipay','','',1,1,7,'',0,'2022-02-23 22:00:52','2022-02-23 22:16:00','2022-02-23 22:00:52'),(22,'2022022322164485374',4,'0.00','0.00','10.00','alipay','','123457',1,1,9,'',1,'2022-02-23 22:16:44','2022-02-23 22:17:38','2022-02-23 22:16:44'),(23,'2022022322312724642',6,'0.00','0.00','20.00','alipay','','123457',1,1,11,'',0,'2022-02-23 22:31:27','2022-02-23 22:32:04','2022-02-23 22:31:27'),(24,'2022022322322459465',6,'0.00','0.00','20.00','alipay','','3333',1,1,11,'',0,'2022-02-23 22:32:24','2022-02-23 22:32:51','2022-02-23 22:32:24');

/*Table structure for table `pay_order_item` */

DROP TABLE IF EXISTS `pay_order_item`;

CREATE TABLE `pay_order_item` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pay_order_id` int(11) NOT NULL DEFAULT '0' COMMENT '订单id',
  `member_id` bigint(11) NOT NULL DEFAULT '0' COMMENT '会员id',
  `quantities` varchar(1000) NOT NULL DEFAULT '' COMMENT '每个美食的数量',
  `prices` varchar(1000) NOT NULL DEFAULT '' COMMENT '每个美食的价格',
  `food_ids` varchar(1000) NOT NULL DEFAULT '' COMMENT '每个美食的id',
  `note` text NOT NULL COMMENT '备注信息',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1：成功 0 失败',
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '最近一次更新时间',
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '插入时间',
  PRIMARY KEY (`id`),
  KEY `id_order_id` (`pay_order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COMMENT='订单详情表';

/*Data for the table `pay_order_item` */

insert  into `pay_order_item`(`id`,`pay_order_id`,`member_id`,`quantities`,`prices`,`food_ids`,`note`,`status`,`updated_time`,`created_time`) values (4,4,3,'1,1','10.00,20.00','3,4','防火',1,'2022-02-18 10:00:46','2022-02-17 16:18:10'),(5,5,3,'1','10.00','1','2222',1,'2022-02-17 16:57:34','2022-02-17 16:57:34'),(6,6,3,'1','10.00','1','3333',1,'2022-02-18 18:01:53','2022-02-17 16:58:16'),(7,7,3,'1','10.00','3','',1,'2022-02-20 16:37:01','2022-02-20 16:37:01'),(8,8,3,'1','20.00','6','',1,'2022-02-20 16:40:12','2022-02-20 16:40:12'),(9,9,3,'1,1','20.00,10.00','6,5','',1,'2022-02-20 16:42:10','2022-02-20 16:42:10'),(10,10,3,'1,1','20.00,10.00','6,5','',1,'2022-02-20 16:42:52','2022-02-20 16:42:52'),(11,11,3,'1,1','20.00,10.00','6,5','',1,'2022-02-20 16:45:18','2022-02-20 16:45:18'),(12,12,3,'1','20.00','4','',1,'2022-02-20 16:46:50','2022-02-20 16:46:50'),(13,13,3,'1,1','15.00,15.00','7,7','',1,'2022-02-20 17:00:33','2022-02-20 17:00:33'),(14,14,3,'1','15.00','7','',1,'2022-02-20 17:01:58','2022-02-20 17:01:58'),(15,15,3,'4','10.00','3','',1,'2022-02-20 17:24:01','2022-02-20 17:24:01'),(16,16,3,'2,2,2,2,1,5','10.00,15.00,10.00,20.00,10.00,20.00','1,2,3,4,5,6','',1,'2022-02-20 17:25:41','2022-02-20 17:25:41'),(17,17,4,'2','10.00','3','123457',1,'2022-02-21 22:17:38','2022-02-21 22:17:38'),(18,18,3,'2','10.00','1','1111',1,'2022-02-22 13:03:38','2022-02-22 13:03:38'),(19,19,5,'2','10.00','1','1111',1,'2022-02-22 14:45:21','2022-02-22 14:44:16'),(20,20,3,'1,1','10.00,20.00','3,4','',1,'2022-02-23 20:54:19','2022-02-23 20:54:19'),(21,21,3,'1','10.00','3','',1,'2022-02-23 22:00:52','2022-02-23 22:00:52'),(22,22,4,'1','10.00','3','123457',1,'2022-02-23 22:16:44','2022-02-23 22:16:44'),(23,23,6,'2','10.00','1','123457',1,'2022-02-23 22:31:27','2022-02-23 22:31:27'),(24,24,6,'2','10.00','5','3333',1,'2022-02-23 22:32:24','2022-02-23 22:32:24');

/*Table structure for table `restaurant` */

DROP TABLE IF EXISTS `restaurant`;

CREATE TABLE `restaurant` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '餐厅名称',
  `main_image` varchar(200) NOT NULL DEFAULT 'testres' COMMENT '餐厅主图',
  `res_image` varchar(200) NOT NULL DEFAULT 'cc.jpg' COMMENT '餐厅图片',
  `address` varchar(50) NOT NULL DEFAULT '' COMMENT '餐厅地址',
  `mobile` varchar(20) NOT NULL DEFAULT '' COMMENT '餐厅电话',
  `opening` varchar(20) NOT NULL DEFAULT '09:00~22:00' COMMENT '营业时间',
  `summary` varchar(1000) NOT NULL DEFAULT '' COMMENT '餐厅介绍',
  `coll_count` int(11) NOT NULL DEFAULT '0' COMMENT '收藏数',
  `weight` tinyint(4) NOT NULL DEFAULT '1' COMMENT '权重',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1：有效 0：无效',
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '最后一次更新时间',
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '插入时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_name` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COMMENT='餐厅';

/*Data for the table `restaurant` */

insert  into `restaurant`(`id`,`name`,`main_image`,`res_image`,`address`,`mobile`,`opening`,`summary`,`coll_count`,`weight`,`status`,`updated_time`,`created_time`) values (1,'湘菜馆','res/xiang.jpg','cc.jpg','四川省成都市双流区','029-11111111','09:00~23:30','湘菜',3,5,1,'2022-02-23 22:34:02','2020-05-05 08:40:15'),(2,'川菜馆','res/chuan.jpg','dd.jpg','四川省成都市武侯区','029-22222222','08:00~23:00','川菜',1,10,1,'2022-02-23 22:34:10','2020-05-05 08:40:28'),(3,'粤菜馆','res/yue.jpg','ee.jpg','四川省成都市金牛区','029-33333333','07:00~24:00','粤菜',0,3,1,'2022-02-23 22:36:11','2020-05-05 08:40:43'),(4,'东北菜馆','res/dongbei.jpg','cc.jpg','四川省成都市锦江区','029-44444444','08:30~22:30','东北菜',0,4,1,'2020-05-05 08:40:56','2020-05-05 08:40:56'),(5,'鲁菜馆','res/lu.jpg','dd.jpg','四川省成都市成华区','029-55555555','09:30~21:00','鲁菜馆',0,3,1,'2020-05-15 16:28:20','2020-05-15 16:28:20');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
