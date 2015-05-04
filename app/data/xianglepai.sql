/*
Navicat MySQL Data Transfer

Source Server         : vivo DB Master
Source Server Version : 50535
Source Host           : 192.168.100.105:3306
Source Database       : activity

Target Server Type    : MYSQL
Target Server Version : 50535
File Encoding         : 65001

Date: 2014-10-21 11:20:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `xianglepai_signin`
-- ----------------------------
DROP TABLE IF EXISTS `xianglepai_signin`;
CREATE TABLE `xianglepai_signin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `nickname` varchar(90) DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL,
  `createTime` int(10) NOT NULL,
  `updateTime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userId_date` (`userId`,`date`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xianglepai_signin
-- ----------------------------

-- ----------------------------
-- Table structure for `xianglepai_stat`
-- ----------------------------
DROP TABLE IF EXISTS `xianglepai_stat`;
CREATE TABLE `xianglepai_stat` (
  `userId` int(11) unsigned NOT NULL,
  `drawTotal` int(11) unsigned NOT NULL DEFAULT '0',
  `drawLeft` int(11) unsigned NOT NULL DEFAULT '0',
  `createTime` int(10) NOT NULL,
  `updateTime` int(10) NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of xianglepai_stat
-- ----------------------------
