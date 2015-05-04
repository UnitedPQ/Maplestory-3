# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.6.17)
# Database: activity
# Generation Time: 2014-11-08 15:57:27 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table qmtd_constellation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `qmtd_constellation`;

CREATE TABLE `qmtd_constellation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(16) NOT NULL,
  `label` varchar(10) NOT NULL,
  `start` char(4) NOT NULL,
  `end` char(4) NOT NULL,
  `tips` varchar(255) DEFAULT NULL,
  `createTime` int(10) NOT NULL,
  `updateTime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `start_end` (`start`,`end`) USING BTREE,
  KEY `start` (`start`),
  KEY `end` (`end`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

LOCK TABLES `qmtd_constellation` WRITE;
/*!40000 ALTER TABLE `qmtd_constellation` DISABLE KEYS */;

INSERT INTO `qmtd_constellation` (`id`, `name`, `label`, `start`, `end`, `tips`, `createTime`, `updateTime`)
VALUES
	(1,'capricorn','摩羯座','1222','0119','最完美的星座，没有之一（哈哈哈）',1415073902,1415073902),
	(2,'aquarius','水瓶座','0120','0218','水瓶怪蜀黍，请参照厂（陈）花（坤）啦~',1415073902,1415073902),
	(3,'pisces','双鱼座','0219','0320','这么多愁善感，真的好吗？',1415073902,1415073902),
	(4,'aries','白羊座','0321','0419','爱自由，有冒险精神的小羊棒棒哒。',1415073902,1415073902),
	(5,'taurus','金牛座','0420','0520','有主见、意志坚定的大牛牛。谁在说我爱钱就请我吃饭。',1415073902,1415073902),
	(6,'gemini','双子座','0521','0621','多才多艺的双子是不是每天都在和内心的小人儿做斗争（呵呵呵）',1415073902,1415073902),
	(7,'gancer','巨蟹座','0622','0722','简直是居家必备，手动点赞。',1415073902,1415073902),
	(8,'leo','狮子座','0723','0822','极富领导力的大狮子简直和vivo手机一样霸气呢。',1415073902,1415073902),
	(9,'virgo','处女座','0823','0922','嗯，此处省略一万字！',1415073902,1415073902),
	(10,'libra','天秤座','0923','1023','手机这么多，到底用那部嘛~勇敢的跟随内心咯。',1415073902,1415073902),
	(11,'scorpio','天蝎座','1024','1122','得罪不起的星座（你过来，我保证不……）',1415073902,1415073902),
	(12,'sagittarius','射手座','1123','1221','你被伤了心，怪我咯！',1415073902,1415073902);

/*!40000 ALTER TABLE `qmtd_constellation` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table qmtd_imei
# ------------------------------------------------------------

CREATE TABLE `qmtd_imei` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `nickname` varchar(90) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `imei` varchar(20) DEFAULT NULL,
  `sn` varchar(20) DEFAULT NULL,
  `machine` varchar(20) DEFAULT NULL,
  `productionTime` int(10) NOT NULL,
  `data` text,
  `constellationId` int(11) NOT NULL,
  `date` varchar(10) DEFAULT NULL,
  `ipAddress` varchar(40) DEFAULT NULL,
  `userAgent` varchar(255) DEFAULT NULL,
  `createTime` int(10) NOT NULL,
  `updateTime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  KEY `imei` (`imei`),
  KEY `gender_constellationId` (`gender`,`constellationId`) USING BTREE,
  KEY `userId_imei` (`userId`,`imei`) USING BTREE,
  KEY `userId_date` (`userId`,`date`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;



# Dump of table qmtd_matches
# ------------------------------------------------------------

DROP TABLE IF EXISTS `qmtd_matches`;

CREATE TABLE `qmtd_matches` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sourceId` int(11) NOT NULL,
  `destId` int(11) NOT NULL,
  `sort` tinyint(4) NOT NULL,
  `score` smallint(6) NOT NULL DEFAULT '0',
  `title` varchar(16) NOT NULL,
  `description` varchar(255) NOT NULL,
  `createTime` int(10) NOT NULL,
  `updateTime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sourceId` (`sourceId`),
  KEY `destId` (`destId`),
  KEY `sourceId_destId` (`sourceId`,`destId`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

LOCK TABLES `qmtd_matches` WRITE;
/*!40000 ALTER TABLE `qmtd_matches` DISABLE KEYS */;

INSERT INTO `qmtd_matches` (`id`, `sourceId`, `destId`, `sort`, `score`, `title`, `description`, `createTime`, `updateTime`)
VALUES
	(1,4,8,1,100,'天生一对','同属火象星座的白羊及狮子， 就像手机没电遇到插座电源；想你的时候你正好来电。简直是命中注定的一对。',1415288242,1415288242),
	(2,4,4,2,80,'理想一半','同是白羊座的人，就像两款同样的X5手机，彼此的观念、想法、作法都一样，很容易产生共鸣投缘的感觉。',1415288242,1415288242),
	(3,4,5,3,70,'相生相克','就像你喜欢玩游戏，但我想看剧。虽然都同属一个载体但却不能同时实现。所以，凑合着过呗。',1415288242,1415288242),
	(4,5,9,1,100,'命中注定','爱情还是要相信的，万一遇到了呢。大金牛与处女座追求极致完美的精神不谋而合。真的不是在陷害大牛牛呢。',1415288242,1415288242),
	(5,5,1,2,90,'天生一对','同属土象星座的两只，就像手机开启了省电管理，喜欢细水长流，是很理想的组合。',1415288242,1415288242),
	(6,5,7,3,90,'理想一对','巨蟹座待人真挚，跟大牛牛一样，手机一定会设密码，注重安全感，也很善于手机理财。',1415288242,1415288242),
	(7,6,2,1,100,'天生一对','同属风象星座， 就像手机没电遇到插座电源；想你的时候你正好来电，容易相知相惜。',1415288242,1415288242),
	(8,6,10,2,100,'天生一对','同属风象星座，就像Wi-Fi热点，密码不改就会自动链接。心底的默契很容易一见如故，互相敞开心扉。',1415288242,1415288242),
	(9,6,12,3,60,'相生相克','就像你喜欢玩游戏，但我想看剧。虽然都同属一个载体但却不能同时实现。所以，凑合着过呗。',1415288242,1415288242),
	(10,7,3,1,100,'天生一对','同属水象星座，就像Wi-Fi热点，密码不改就会自动链接。心底的默契很容易一见如故，互相敞开心扉。',1415288242,1415288242),
	(11,7,11,2,90,'天生一对','巨蟹和天蝎，就像手机输入法，总会记得我们曾经的习惯和喜好；相知相惜的默契，会随著进一步的交往而更见浓烈。',1415288242,1415288242),
	(12,7,1,3,60,'互相吸引又互相排斥','就像你喜欢玩游戏，但我想看剧。虽然都同属一个载体但却不能同时实现。所以，爱咋咋地。',1415288242,1415288242),
	(13,8,12,1,98,'天生一对','两个同属火象星座，就像Wi-Fi热点，没有密码就会自动链接。是一见锺情式、健康开朗的组合。',1415288242,1415288242),
	(14,8,4,2,91,'理想组合','就像他会秒回你的信息，对于你的热情，他会加倍奉还。狮子与白羊，天生就有超强的吸引力。',1415288242,1415288242),
	(15,8,2,3,85,'还不错','我可以下载无穷的app，和他在一起充满新鲜感。瓶子的智慧、想像力与化繁为简的能力，会深深吸引狮子。',1415288242,1415288242),
	(16,9,1,1,100,'天生一对','同是土象星座，走实际路线的摩羯与处女，无论性格、思想都有很多共通点。',1415288242,1415288242),
	(17,9,5,2,90,'理想组合','在他面前你无须装饰。可以不用带手机壳，也不需要额外的装饰。两个同属土象星座的在本原中稳定成长。',1415288242,1415288242),
	(18,9,3,3,60,'互相吸引又互相排斥','不要问我原因，我也不造啊TAT。',1415288242,1415288242),
	(19,10,6,1,100,'天生一对','你们都是充满现代感、知性的星座，交际运也不错，可以愉悦的交往。',1415288242,1415288242),
	(20,10,2,2,90,'理想组合','属风象的水瓶座或者天秤座，因为不安所以开启同病相怜、互相慰藉的和谐模式。',1415288242,1415288242),
	(21,10,8,3,80,'不错的一对','霸道总裁承包鱼塘的故事，总而言之，就是你是风儿我是沙咯。',1415288242,1415288242),
	(22,11,3,1,100,'天生一对','古藤老树昏鸦，小桥流水人家，WiFi手机西瓜，夕阳西下，你貌美如花，我挣钱养家。天生一对！',1415288242,1415288242),
	(23,11,9,2,90,'理想组合','天蝎座的你会享受他对你无微不至的叮咛，不求轰轰烈烈，但求今生无悔，简直是偶像剧剧情嘛。',1415288242,1415288242),
	(24,11,12,3,60,'互相吸引又互相排斥','就像你喜欢玩游戏，但我想看剧。虽然都同属一个载体但却不能同时实现。所以，怪我咯。',1415288242,1415288242),
	(25,12,4,1,100,'天生一对','一起享受生活的组合，所以，请一起开心的打怪兽吧！',1415288242,1415288242),
	(26,12,8,2,90,'理想组合','同属火象星座，就像手机没电遇到插座电源；想你的时候你正好来电，很容易被对方的气质吸引。',1415288242,1415288242),
	(27,12,6,3,60,'互相吸引又互相排斥','就像你喜欢玩游戏，但我想看剧。虽然都同属一个载体但却不能同时实现。所以，你开心就好。',1415288242,1415288242),
	(28,1,5,1,100,'天生一对','都属于土象星座，就像手机开启了省电管理，喜欢细水长流，性格上简直是天生一对呢！',1415288242,1415288242),
	(29,1,9,2,90,'理想组合','就像手机没电遇到插座电源；想你的时候你正好来电，走实际路线的摩羯座和处女座，不论性格、思想都有很多共通和互补。',1415288242,1415288242),
	(30,1,3,3,85,'还不错的一对','摩羯座与鱼儿都属阴性星座，在星座个性上一强一弱、比重上又一弱一强，搭档起来挺速配的。',1415288242,1415288242),
	(31,2,10,1,100,'天生一对','就算他总为别人撑伞,你也会为他等在雨中。就是这样！',1415288242,1415288242),
	(32,2,6,2,95,'最佳伴侣','同是风象星座，简直就是你是风儿我是沙，我是牛粪她是花的最佳情侣档。',1415288242,1415288242),
	(33,2,8,3,60,'互相吸引又互相排斥','就像你喜欢玩游戏，但我想看剧。虽然都同属一个载体但却不能同时实现。所以，怪我咯。',1415288242,1415288242),
	(34,3,11,1,100,'天生一对','同属水象星座， 就像手机没电遇到插座电源；想你的时候你正好来电。简直是命中注定的一对。',1415288242,1415288242),
	(35,3,7,2,95,'理想组合','同属水象星座，在个性及思考模式方面都很类似。蟹子重视安稳与实际的爱情，鱼儿要求全心全意的爱恋与照顾，双方都缺乏安全感。',1415288242,1415288242),
	(36,3,1,3,80,'还不错的一对','他思虑谨慎，就像Wi-Fi热点，不改密码等你自动链接。心底的默契很容易在一起，互相敞开心扉。',1415288242,1415288242);

/*!40000 ALTER TABLE `qmtd_matches` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table qmtd_stat
# ------------------------------------------------------------

CREATE TABLE `qmtd_stat` (
  `userId` int(11) unsigned NOT NULL,
  `drawTotal` int(11) unsigned NOT NULL DEFAULT '0',
  `drawLeft` int(11) unsigned NOT NULL DEFAULT '0',
  `gender` char(1) DEFAULT NULL,
  `imeiId` int(11) DEFAULT NULL,
  `imei` varchar(20) DEFAULT NULL,
  `constellationId` int(11) DEFAULT NULL,
  `createTime` int(10) NOT NULL,
  `updateTime` int(10) NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
