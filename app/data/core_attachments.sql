/*
Navicat MySQL Data Transfer

Source Server         : Local
Source Server Version : 50619
Source Host           : localhost:3306
Source Database       : activity

Target Server Type    : MYSQL
Target Server Version : 50619
File Encoding         : 65001

Date: 2014-10-18 17:33:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `core_attachments`
-- ----------------------------
DROP TABLE IF EXISTS `core_attachments`;
CREATE TABLE `core_attachments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `module` varchar(32) DEFAULT NULL,
  `userId` int(11) unsigned NOT NULL,
  `nickname` varchar(90) DEFAULT NULL,
  `dir` varchar(64) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `thumbPath` varchar(255) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `size` bigint(20) NOT NULL DEFAULT '0',
  `type` varchar(90) DEFAULT NULL,
  `isImage` tinyint(4) NOT NULL DEFAULT '0',
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `createTime` int(10) NOT NULL,
  `updateTime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of core_attachments
-- ----------------------------
