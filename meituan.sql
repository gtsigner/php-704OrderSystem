# Host: 127.0.0.1  (Version 5.5.47)
# Date: 2016-11-19 14:37:39
# Generator: MySQL-Front 5.4  (Build 1.20)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "tb_admin"
#

CREATE TABLE `tb_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(30) DEFAULT NULL,
  `password` char(32) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "tb_admin"
#

INSERT INTO `tb_admin` VALUES (1,'admin','admin');

#
# Structure for table "tb_foods"
#

CREATE TABLE `tb_foods` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL COMMENT '菜名',
  `price` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT '该菜价格',
  `mark` varchar(50) DEFAULT NULL COMMENT '该菜可选择的口味',
  `sort` int(11) DEFAULT NULL COMMENT '销量排序',
  `status` tinyint(3) NOT NULL DEFAULT '0' COMMENT '0：不可用 1：可用',
  `img_path` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='菜单信息表';

#
# Data for table "tb_foods"
#

INSERT INTO `tb_foods` VALUES (8,'芹菜凉拌藕',26.00,'　芹菜和藕都是当季最适吃的食材，今天小编就为大家带来了一道，由芹菜和莲藕组成的凉拌菜——芹菜凉拌藕。',NULL,0,'./Public/uploads/2016-11-19/582fdb3a53c28.jpg'),(9,'锅包肉',10.00,'　说道酸甜口菜品，不由想起了锅包肉。它的做法极其简单，肉片油炸后上酱，外脆里嫩，酸甜口感，和咕咾肉有',NULL,0,'./Public/uploads/2016-11-19/582fdb5c5e39b.jpg'),(10,'黄瓜小炒肉',12.00,'　 黄瓜是我们生活中常见的蔬菜，因其清香鲜嫩、口感也比较清脆爽口所以深受大众人群喜爱，秋季吃黄瓜还能',NULL,0,'./Public/uploads/2016-11-19/582fdb9343975.jpg'),(11,'大盘鸭',20.00,'新疆的大盘系列菜品风味别具一格，是新疆的特色菜品，今天这道大盘鸭也是根据大盘鸡改良而成，味道不输大盘',NULL,0,'./Public/uploads/2016-11-19/582fdbd07f23d.jpg'),(12,'酸子姜焖青头鸭',16.00,'　夏天到了，最适合吃青头鸭，今天为大家带来的是一道酸子姜焖青头鸭，酸辣的口感配合鲜美的鸭肉，吃了还想',NULL,0,'./Public/uploads/2016-11-19/582fdc012f21e.jpg');

#
# Structure for table "tb_order"
#

CREATE TABLE `tb_order` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `order_no` varchar(20) DEFAULT NULL COMMENT '订单号',
  `user_name` varchar(255) DEFAULT NULL COMMENT '客户名字',
  `waiter_id` int(11) NOT NULL DEFAULT '0',
  `table_id` int(11) DEFAULT NULL COMMENT '桌号',
  `menus` text COMMENT '已点菜菜名',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `create_time` int(11) DEFAULT '0',
  `end_time` int(11) DEFAULT '0',
  `status` tinyint(3) DEFAULT '0' COMMENT '0:未支付，1:已经支付',
  PRIMARY KEY (`id`),
  KEY `order_no` (`order_no`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='订单信息表';

#
# Data for table "tb_order"
#

INSERT INTO `tb_order` VALUES (19,'G201611191311B193161',NULL,8,3,'[{\"count\":\"1\",\"id\":\"11\",\"mark\":\"新疆的大盘系列菜品风味别具一格，是新疆的特色菜品，今天这道大盘鸭也是根据大盘鸡改良而成，味道不输大盘\",\"name\":\"大盘鸭\"},{\"count\":\"2\",\"id\":\"9\",\"mark\":\"　说道酸甜口菜品，不由想起了锅包肉。它的做法极其简单，肉片油炸后上酱，外脆里嫩，酸甜口感，和咕咾肉有\",\"name\":\"锅包肉\"},{\"count\":\"1\",\"id\":\"10\",\"mark\":\"　 黄瓜是我们生活中常见的蔬菜，因其清香鲜嫩、口感也比较清脆爽口所以深受大众人群喜爱，秋季吃黄瓜还能\",\"name\":\"黄瓜小炒肉\"}]',52.00,1479531611,0,0),(20,'G201611191311B193197',NULL,8,4,'[{\"count\":\"2\",\"id\":\"9\",\"mark\":\"　说道酸甜口菜品，不由想起了锅包肉。它的做法极其简单，肉片油炸后上酱，外脆里嫩，酸甜口感，和咕咾肉有\",\"name\":\"锅包肉\"},{\"count\":\"1\",\"id\":\"8\",\"mark\":\"　芹菜和藕都是当季最适吃的食材，今天小编就为大家带来了一道，由芹菜和莲藕组成的凉拌菜——芹菜凉拌藕。\",\"name\":\"芹菜凉拌藕\"}]',46.00,1479531973,1479532813,1),(21,'G201611191311B193274',NULL,9,5,'[{\"count\":\"1\",\"id\":\"9\",\"mark\":\"　说道酸甜口菜品，不由想起了锅包肉。它的做法极其简单，肉片油炸后上酱，外脆里嫩，酸甜口感，和咕咾肉有\",\"name\":\"锅包肉\"},{\"count\":\"1\",\"id\":\"8\",\"mark\":\"　芹菜和藕都是当季最适吃的食材，今天小编就为大家带来了一道，由芹菜和莲藕组成的凉拌菜——芹菜凉拌藕。\",\"name\":\"芹菜凉拌藕\"}]',36.00,1479532748,1479534675,1),(22,'G201611191311B193420',NULL,8,27,'[{\"count\":\"2\",\"id\":\"9\",\"mark\":\"　说道酸甜口菜品，不由想起了锅包肉。它的做法极其简单，肉片油炸后上酱，外脆里嫩，酸甜口感，和咕咾肉有\",\"name\":\"锅包肉\"},{\"count\":\"2\",\"id\":\"8\",\"mark\":\"　芹菜和藕都是当季最适吃的食材，今天小编就为大家带来了一道，由芹菜和莲藕组成的凉拌菜——芹菜凉拌藕。\",\"name\":\"芹菜凉拌藕\"}]',72.00,1479534203,0,0),(23,'G201611191311B193467',NULL,9,4,'[{\"count\":\"2\",\"id\":\"9\",\"mark\":\"　说道酸甜口菜品，不由想起了锅包肉。它的做法极其简单，肉片油炸后上酱，外脆里嫩，酸甜口感，和咕咾肉有\",\"name\":\"锅包肉\"},{\"count\":\"2\",\"id\":\"10\",\"mark\":\"　 黄瓜是我们生活中常见的蔬菜，因其清香鲜嫩、口感也比较清脆爽口所以深受大众人群喜爱，秋季吃黄瓜还能\",\"name\":\"黄瓜小炒肉\"}]',44.00,1479534671,0,0);

#
# Structure for table "tb_table"
#

CREATE TABLE `tb_table` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `table_id` tinyint(3) DEFAULT NULL COMMENT '桌号',
  `mark` varchar(50) DEFAULT NULL COMMENT '备注',
  `status` tinyint(3) NOT NULL DEFAULT '1' COMMENT '0：不可用 1：可用',
  PRIMARY KEY (`id`),
  UNIQUE KEY `table_id` (`table_id`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8 COMMENT='餐桌信息表';

#
# Data for table "tb_table"
#

INSERT INTO `tb_table` VALUES (87,1,'5人桌',0),(88,2,'5人桌',0),(89,3,'5人桌',0),(90,4,'5人桌',0),(91,5,'5人桌',1),(92,6,'5人桌',1),(93,7,'5人桌',1),(94,8,'5人桌',1),(95,9,'5人桌',1),(96,10,'5人桌',1),(97,11,'5人桌',1),(98,12,'5人桌',1),(99,13,'5人桌',1),(100,14,'5人桌',1),(101,15,'5人桌',0),(102,16,'5人桌',1),(103,17,'5人桌',1),(104,18,'5人桌',1),(105,19,'5人桌',1),(106,20,'5人桌',1),(107,21,'5人桌',1),(108,22,'5人桌',1),(109,23,'5人桌',1),(110,24,'5人桌',1),(111,25,'5人桌',1),(112,26,'5人桌',1),(113,27,'5人桌',0),(114,28,'5人桌',1),(115,29,'5人桌',1);

#
# Structure for table "tb_table_seat"
#

CREATE TABLE `tb_table_seat` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `table_id` tinyint(3) DEFAULT NULL COMMENT '桌号',
  `mark` varchar(50) DEFAULT NULL COMMENT '备注',
  `status` tinyint(3) NOT NULL DEFAULT '1' COMMENT '0：不可用 1：可用',
  PRIMARY KEY (`id`),
  KEY `table_id` (`table_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='餐桌信息表';

#
# Data for table "tb_table_seat"
#


#
# Structure for table "tb_waiter"
#

CREATE TABLE `tb_waiter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(10) NOT NULL DEFAULT '' COMMENT '服务员姓名',
  `user_phone` varchar(11) DEFAULT NULL COMMENT '服务员联系电话',
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT '0：离职 1：在职',
  `username` char(30) DEFAULT '',
  `password` char(32) DEFAULT NULL,
  `token` char(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='服务员信息表';

#
# Data for table "tb_waiter"
#

INSERT INTO `tb_waiter` VALUES (8,'赵军','1545454545','1','zhaojun','zhaojun','77411e390c52822c61319df44e950dcd'),(9,'test','1545455555','1','123','123','e7a65316e44abc26bfc628bff01c355d');
