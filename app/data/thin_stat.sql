/*
Navicat MySQL Data Transfer

Source Server         : Localhost
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : activity

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2014-11-25 17:24:57
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for thin_stat
-- ----------------------------
DROP TABLE IF EXISTS `thin_stat`;
CREATE TABLE `thin_stat` (
  `userId` int(11) unsigned NOT NULL,
  `drawTotal` int(11) unsigned NOT NULL DEFAULT '0',
  `drawLeft` int(11) unsigned NOT NULL DEFAULT '0',
  `weiboDate` varchar(10) DEFAULT NULL,
  `shareDate` varchar(10) DEFAULT NULL,
  `createTime` int(10) NOT NULL,
  `updateTime` int(10) NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for thin_works
-- ----------------------------
DROP TABLE IF EXISTS `thin_works`;
CREATE TABLE `thin_works` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(11) unsigned NOT NULL,
  `nickname` varchar(90) DEFAULT NULL,
  `a` smallint(6) DEFAULT '1',
  `b` smallint(6) DEFAULT '1',
  `c` smallint(6) DEFAULT '1',
  `d` smallint(6) DEFAULT '1',
  `e` smallint(6) DEFAULT '1',
  `thickness` double(5,2) DEFAULT NULL,
  `ko` double(5,2) DEFAULT NULL,
  `text1` varchar(255) DEFAULT NULL,
  `text2` varchar(255) DEFAULT NULL,
  `weibo` text,
  `date` varchar(10) DEFAULT NULL,
  `createTime` int(10) NOT NULL,
  `updateTime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `thickness` (`thickness`),
  KEY `userId_createTime` (`userId`,`createTime`) USING BTREE,
  KEY `userId_date` (`userId`,`date`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

INSERT INTO `core_prize` (`module`, `activityId`, `level`, `name`, `unit`, `image`, `count`, `total`, `weight`, `isLuck`, `isMobile`, `isCoupon`, `extra`, `sort`, `createTime`, `updateTime`) VALUES ('thin', '0', '0', 'vivo X5', '台', null, '0', '0', '1', '1', '1', '0', '{\"result\":1}', '4', '1416900814', '1416900814');
INSERT INTO `core_prize` (`module`, `activityId`, `level`, `name`, `unit`, `image`, `count`, `total`, `weight`, `isLuck`, `isMobile`, `isCoupon`, `extra`, `sort`, `createTime`, `updateTime`) VALUES ('thin', '0', '0', '移动电源', '个', null, '0', '15', '200', '1', '0', '0', '{\"result\":2}', '3', '1416900814', '1416900814');
INSERT INTO `core_prize` (`module`, `activityId`, `level`, `name`, `unit`, `image`, `count`, `total`, `weight`, `isLuck`, `isMobile`, `isCoupon`, `extra`, `sort`, `createTime`, `updateTime`) VALUES ('thin', '0', '0', '再接再厉', null, null, '0', '0', '100000', '0', '0', '0', '{\"result\":3}', '2', '1416900814', '1416900814');
INSERT INTO `core_prize` (`module`, `activityId`, `level`, `name`, `unit`, `image`, `count`, `total`, `weight`, `isLuck`, `isMobile`, `isCoupon`, `extra`, `sort`, `createTime`, `updateTime`) VALUES ('thin', '0', '0', '高品质耳机', '条', null, '0', '30', '500', '1', '0', '0', '{\"result\":4}', '1', '1416900814', '1416900814');