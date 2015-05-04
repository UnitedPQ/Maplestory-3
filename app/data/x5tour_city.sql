/*
Navicat MySQL Data Transfer

Source Server         : Local
Source Server Version : 50619
Source Host           : localhost:3306
Source Database       : activity

Target Server Type    : MYSQL
Target Server Version : 50619
File Encoding         : 65001

Date: 2014-10-15 15:29:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `x5tour_city`
-- ----------------------------
DROP TABLE IF EXISTS `x5tour_city`;
CREATE TABLE `x5tour_city` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `label` varchar(10) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `startTime` int(10) DEFAULT NULL,
  `endTime` int(10) DEFAULT NULL,
  `eventTime` int(10) DEFAULT NULL,
  `sort` smallint(6) NOT NULL DEFAULT '0',
  `blankMsg` varchar(255) DEFAULT NULL,
  `weibo` varchar(255) DEFAULT NULL,
  `regUrl` varchar(255) DEFAULT NULL,
  `createTime` int(10) NOT NULL,
  `updateTime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `startTime` (`startTime`),
  KEY `endTime` (`endTime`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of x5tour_city
-- ----------------------------
INSERT INTO `x5tour_city` VALUES ('1', 'chengdu', '成都', '3', '1412870400', '1413129599', '1413043200', '6', '你最拿手的歌是什么？', 'Hi-Fi #K歌之王X5#口袋里的K歌之王。我爱K歌，我参加了X5新品体验之旅，我在KTV必点的一首歌是：{TEXT}。你在KTV必点哪首歌呢？参加X5新品体验之旅，赢取X5手机大奖吧 {URL}', 'http://bbs.vivo.com.cn/thread-1582895-1-1.html', '1412821134', '1412821134');
INSERT INTO `x5tour_city` VALUES ('2', 'shenzhen', '深圳', '1', '1413129600', '1413647999', '1413561600', '5', 'vivo X5最吸引你的是什么？', 'Hi-Fi#K歌之王X5#搭载8种经典音效，专业实时耳返。我最喜欢X5的是{TEXT}。快来说出你最喜欢X5的地方，赢取手机大奖。 {URL}', 'http://bbs.vivo.com.cn/thread-1582912-1-1.html', '1412821134', '1412821134');
INSERT INTO `x5tour_city` VALUES ('3', 'chongqing', '重庆', '1', '1413129600', '1413647999', '1413561600', '4', 'K歌众生相，你是属于哪一种？', 'Hi-Fi#K歌之王X5#首次在智能终端设备上搭载全球专业级卡拉OK数字环绕声信号处理芯片YAMAHA YSS205X，绝佳的音乐体验由此产生，让我无处不OK。我是{TEXT}，K歌众生相，你是哪一种？来参加X5新品体验之旅，赢取X5手机等大奖。 {URL}', 'http://bbs.vivo.com.cn/thread-1582908-1-1.html', '1412821134', '1412821134');
INSERT INTO `x5tour_city` VALUES ('4', 'nanjing', '南京', '0', '1413648000', '1414252799', '1414166400', '3', '请上传你的K歌囧照吧！', 'Hi-Fi#K歌之王X5#实时消除手机中歌曲原音部分，让我“唱”通无阻，这个feel倍儿爽。独乐乐不如众乐乐，快来和我一起晒K歌囧照，惊喜大奖等你拿！ {URL}', 'http://bbs.vivo.com.cn/thread-1582917-1-1.html', '1412821134', '1412821134');
INSERT INTO `x5tour_city` VALUES ('5', 'tianjin', '天津', '0', '1413648000', '1414252799', '1414166400', '2', '哪句歌词最能描述你现在的生活状态？', 'Hi-Fi#K歌之王X5#连上音箱，手机瞬间变身麦克风，随时随地停不下来。我要用X5表达我现在的生活状态{TEXT}。分享爱，赢手机。 {URL}', 'http://bbs.vivo.com.cn/thread-1582923-1-1.html', '1412821134', '1412821134');
INSERT INTO `x5tour_city` VALUES ('6', 'haerbin', '哈尔滨', '0', '1413648000', '1414252799', '1414166400', '1', '你喜欢5年以上的偶像是哪一个？', 'Hi-Fi#K歌之王X5#搭配定制版本CS4398 DAC，极致Hi-Fi，回味无穷经典。我参加了X5新品体验之旅，用X5向我最爱的{TEXT}致敬。你也来参加赢手机大奖 {URL}', 'http://bbs.vivo.com.cn/thread-1582926-1-1.html', '1412821134', '1412821134');
