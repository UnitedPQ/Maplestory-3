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
);

DROP TABLE IF EXISTS `core_data_bag`;
CREATE TABLE `core_data_bag` (
  `module` varchar(32) NOT NULL DEFAULT 'core',
  `name` varchar(32) NOT NULL,
  `value` text,
  `createTime` int(10) NOT NULL,
  `updateTime` int(10) NOT NULL,
  PRIMARY KEY (`module`,`name`)
);

DROP TABLE IF EXISTS `core_draw_results`;
CREATE TABLE `core_draw_results` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `module` varchar(40) DEFAULT NULL,
  `activityId` int(11) NOT NULL DEFAULT '0',
  `userId` int(11) NOT NULL,
  `nickname` varchar(90) NOT NULL,
  `date` varchar(8) NOT NULL,
  `prizeId` int(11) unsigned NOT NULL,
  `isLuck` tinyint(4) NOT NULL DEFAULT '0',
  `isMobile` tinyint(4) NOT NULL DEFAULT '0',
  `isCoupon` tinyint(4) NOT NULL,
  `exchange` tinyint(4) NOT NULL DEFAULT '0',
  `exchangeTime` int(10) DEFAULT NULL,
  `deadline` int(10) NOT NULL DEFAULT '0',
  `couponId` bigint(20) DEFAULT NULL,
  `createTime` int(10) NOT NULL,
  `updateTime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`) USING BTREE,
  KEY `module_activityId` (`module`,`activityId`) USING BTREE,
  KEY `module_activityId_userId` (`module`,`activityId`,`userId`) USING BTREE,
  KEY `deadline` (`deadline`) USING BTREE
);

DROP TABLE IF EXISTS `core_exchange`;
CREATE TABLE `core_exchange` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `module` varchar(90) DEFAULT NULL,
  `activityId` int(11) NOT NULL DEFAULT '0',
  `userId` int(11) unsigned NOT NULL,
  `nickname` varchar(90) DEFAULT NULL,
  `resultId` bigint(20) unsigned NOT NULL,
  `prizeId` int(11) unsigned NOT NULL,
  `name` varchar(90) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `idcard` varchar(36) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `note` text,
  `extra` text,
  `ipAddress` varchar(40) DEFAULT NULL,
  `userAgent` varchar(255) DEFAULT NULL,
  `createTime` int(10) NOT NULL,
  `updateTime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `module_activityId` (`module`,`activityId`) USING BTREE
);

DROP TABLE IF EXISTS `core_module_login`;
CREATE TABLE `core_module_login` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(11) unsigned NOT NULL,
  `nickname` varchar(90) DEFAULT NULL,
  `module` varchar(16) DEFAULT NULL,
  `createTime` int(10) NOT NULL,
  `updateTime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userId_module` (`userId`,`module`) USING BTREE
);

DROP TABLE IF EXISTS `core_prize`;
CREATE TABLE `core_prize` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `module` varchar(40) DEFAULT NULL,
  `activityId` int(11) NOT NULL DEFAULT '0',
  `level` smallint(6) NOT NULL DEFAULT '0',
  `name` varchar(90) NOT NULL,
  `unit` varchar(4) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  `total` int(11) NOT NULL DEFAULT '0',
  `weight` int(11) NOT NULL DEFAULT '0',
  `isLuck` tinyint(4) NOT NULL DEFAULT '0',
  `isMobile` tinyint(4) NOT NULL DEFAULT '0',
  `isCoupon` tinyint(4) NOT NULL DEFAULT '0',
  `extra` text,
  `sort` int(11) NOT NULL DEFAULT '0',
  `createTime` int(10) NOT NULL,
  `updateTime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `module_activityId` (`module`,`activityId`) USING BTREE
);

-- ----------------------------
-- Table structure for core_sessions
-- ----------------------------
DROP TABLE IF EXISTS `core_sessions`;
CREATE TABLE `core_sessions` (
  `id` varchar(36) NOT NULL,
  `data` text NOT NULL,
  `createTime` int(15) unsigned NOT NULL,
  `updateTime` int(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `createTime` (`createTime`) USING BTREE,
  KEY `updateTime` (`updateTime`) USING BTREE
);

-- ----------------------------
-- Table structure for core_share
-- ----------------------------
DROP TABLE IF EXISTS `core_share`;
CREATE TABLE `core_share` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `nickname` varchar(90) DEFAULT NULL,
  `module` varchar(32) DEFAULT NULL,
  `date` varchar(8) DEFAULT NULL,
  `type` varchar(16) DEFAULT NULL,
  `data` text,
  `createTime` int(10) NOT NULL,
  `updateTime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`) USING BTREE,
  KEY `userId_date` (`userId`,`date`) USING BTREE,
  KEY `userId_module_date` (`userId`,`module`,`date`) USING BTREE
);

-- ----------------------------
-- Table structure for core_tasks
-- ----------------------------
DROP TABLE IF EXISTS `core_tasks`;
CREATE TABLE `core_tasks` (
  `name` varchar(32) NOT NULL,
  `lockTime` int(10) NOT NULL,
  `expire` int(11) NOT NULL DEFAULT '0',
  `createTime` int(10) NOT NULL,
  `updateTime` int(10) NOT NULL,
  PRIMARY KEY (`name`)
);

-- ----------------------------
-- Table structure for core_users
-- ----------------------------
DROP TABLE IF EXISTS `core_users`;
CREATE TABLE `core_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `openId` varchar(90) NOT NULL DEFAULT '',
  `nickname` varchar(90) DEFAULT NULL,
  `type` varchar(12) NOT NULL DEFAULT '',
  `avatar` varchar(255) DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `country` varchar(32) DEFAULT NULL,
  `province` varchar(32) DEFAULT NULL,
  `city` varchar(32) DEFAULT NULL,
  `accessToken` varchar(255) DEFAULT NULL,
  `unionId` varchar(90) DEFAULT NULL,
  `data` text,
  `weiboId` varchar(90) DEFAULT NULL,
  `createTime` int(10) NOT NULL,
  `updateTime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `openId` (`openId`) USING BTREE,
  KEY `nickname` (`nickname`) USING BTREE
);

-- ----------------------------
-- Table structure for core_user_status
-- ----------------------------
DROP TABLE IF EXISTS `core_user_status`;
CREATE TABLE `core_user_status` (
  `userId` int(11) unsigned NOT NULL,
  `createTime` int(10) NOT NULL,
  `updateTime` int(10) NOT NULL,
  PRIMARY KEY (`userId`)
);

-- ----------------------------
-- Table structure for core_view_logs
-- ----------------------------
DROP TABLE IF EXISTS `core_view_logs`;
CREATE TABLE `core_view_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(11) unsigned DEFAULT NULL,
  `nickname` varchar(90) DEFAULT NULL,
  `module` varchar(40) NOT NULL,
  `page` varchar(120) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `ipAddress` varchar(40) DEFAULT NULL,
  `userAgent` varchar(255) DEFAULT NULL,
  `createTime` int(10) NOT NULL,
  `updateTime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`) USING BTREE
);

-- ----------------------------
-- Table structure for karaoke_likes
-- ----------------------------
DROP TABLE IF EXISTS `karaoke_likes`;
CREATE TABLE `karaoke_likes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sId` int(11) unsigned NOT NULL,
  `userId` int(11) unsigned NOT NULL,
  `nickname` varchar(90) DEFAULT NULL,
  `ipAddress` varchar(40) DEFAULT NULL,
  `userAgent` varchar(255) DEFAULT NULL,
  `createTime` int(10) NOT NULL,
  `updateTime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sId_userId` (`sId`,`userId`) USING BTREE,
  KEY `sId` (`sId`) USING BTREE
);

-- ----------------------------
-- Table structure for karaoke_statuses
-- ----------------------------
DROP TABLE IF EXISTS `karaoke_statuses`;
CREATE TABLE `karaoke_statuses` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `statusId` varchar(20) NOT NULL,
  `mId` varchar(20) DEFAULT NULL,
  `openId` varchar(90) DEFAULT NULL,
  `nickname` varchar(90) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `urlKey` varchar(32) DEFAULT NULL,
  `videoUrl` varchar(255) DEFAULT NULL,
  `videoType` varchar(10) DEFAULT NULL,
  `videoImg` varchar(255) DEFAULT NULL,
  `videoId` varchar(255) DEFAULT NULL,
  `player` varchar(255) DEFAULT NULL,
  `flashVars` varchar(255) DEFAULT NULL,
  `mp4Url` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `statusData` text,
  `statusTime` int(10) NOT NULL,
  `likeTotal` int(11) NOT NULL DEFAULT '0',
  `syncTime` int(10) NOT NULL DEFAULT '0',
  `createTime` int(10) NOT NULL,
  `updateTime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `statusId` (`statusId`) USING BTREE,
  UNIQUE KEY `videoId` (`videoId`) USING BTREE,
  UNIQUE KEY `videoType_videoId` (`videoType`,`videoId`) USING BTREE,
  UNIQUE KEY `urlKey` (`urlKey`) USING BTREE
);

-- ----------------------------
-- Table structure for qmtd_constellation
-- ----------------------------
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
  KEY `start` (`start`) USING BTREE,
  KEY `end` (`end`) USING BTREE
);

-- ----------------------------
-- Table structure for qmtd_imei
-- ----------------------------
DROP TABLE IF EXISTS `qmtd_imei`;
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
  KEY `userId` (`userId`) USING BTREE,
  KEY `imei` (`imei`) USING BTREE,
  KEY `gender_constellationId` (`gender`,`constellationId`) USING BTREE,
  KEY `userId_imei` (`userId`,`imei`) USING BTREE,
  KEY `userId_date` (`userId`,`date`) USING BTREE
);

-- ----------------------------
-- Table structure for qmtd_matches
-- ----------------------------
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
  KEY `sourceId` (`sourceId`) USING BTREE,
  KEY `destId` (`destId`) USING BTREE,
  KEY `sourceId_destId` (`sourceId`,`destId`) USING BTREE
);

-- ----------------------------
-- Table structure for qmtd_stat
-- ----------------------------
DROP TABLE IF EXISTS `qmtd_stat`;
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
);

-- ----------------------------
-- Table structure for qmtd_weibo
-- ----------------------------
DROP TABLE IF EXISTS `qmtd_weibo`;
CREATE TABLE `qmtd_weibo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(11) unsigned NOT NULL,
  `nickname` varchar(90) DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `response` text,
  `createTime` int(10) NOT NULL,
  `updateTime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `createTime` (`createTime`) USING BTREE,
  KEY `cityId_createTime` (`createTime`) USING BTREE,
  KEY `userId_date` (`userId`,`date`) USING BTREE
);

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
);

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
);

-- ----------------------------
-- Table structure for vivox5max_signin
-- ----------------------------
DROP TABLE IF EXISTS `vivox5max_signin`;
CREATE TABLE `vivox5max_signin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `nickname` varchar(90) DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL,
  `createTime` int(10) NOT NULL,
  `updateTime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userId_date` (`userId`,`date`) USING BTREE
);

-- ----------------------------
-- Table structure for vivox5max_stat
-- ----------------------------
DROP TABLE IF EXISTS `vivox5max_stat`;
CREATE TABLE `vivox5max_stat` (
  `userId` int(11) unsigned NOT NULL,
  `drawTotal` int(11) unsigned NOT NULL DEFAULT '0',
  `drawLeft` int(11) unsigned NOT NULL DEFAULT '0',
  `createTime` int(10) NOT NULL,
  `updateTime` int(10) NOT NULL,
  PRIMARY KEY (`userId`)
);

-- ----------------------------
-- Table structure for x5tour_city
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
  KEY `startTime` (`startTime`) USING BTREE,
  KEY `endTime` (`endTime`) USING BTREE
);

-- ----------------------------
-- Table structure for x5tour_stat
-- ----------------------------
DROP TABLE IF EXISTS `x5tour_stat`;
CREATE TABLE `x5tour_stat` (
  `userId` int(11) unsigned NOT NULL,
  `drawTotal` int(11) unsigned NOT NULL DEFAULT '0',
  `drawLeft` int(11) unsigned NOT NULL DEFAULT '0',
  `createTime` int(10) NOT NULL,
  `updateTime` int(10) NOT NULL,
  PRIMARY KEY (`userId`)
);

-- ----------------------------
-- Table structure for x5tour_weibo
-- ----------------------------
DROP TABLE IF EXISTS `x5tour_weibo`;
CREATE TABLE `x5tour_weibo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cityId` int(11) unsigned NOT NULL,
  `userId` int(11) unsigned NOT NULL,
  `nickname` varchar(90) DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL,
  `statusId` varchar(90) DEFAULT NULL,
  `mId` varchar(90) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `response` text,
  `createTime` int(10) NOT NULL,
  `updateTime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cityId` (`cityId`) USING BTREE,
  KEY `createTime` (`createTime`) USING BTREE,
  KEY `cityId_createTime` (`cityId`,`createTime`) USING BTREE,
  KEY `userId_date` (`userId`,`date`) USING BTREE
);

-- ----------------------------
-- Table structure for xianglepai_signin
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
);

-- ----------------------------
-- Table structure for xianglepai_stat
-- ----------------------------
DROP TABLE IF EXISTS `xianglepai_stat`;
CREATE TABLE `xianglepai_stat` (
  `userId` int(11) unsigned NOT NULL,
  `drawTotal` int(11) unsigned NOT NULL DEFAULT '0',
  `drawLeft` int(11) unsigned NOT NULL DEFAULT '0',
  `createTime` int(10) NOT NULL,
  `updateTime` int(10) NOT NULL,
  PRIMARY KEY (`userId`)
);

-- ----------------------------
-- Table structure for xshot_photo
-- ----------------------------
DROP TABLE IF EXISTS `xshot_photo`;
CREATE TABLE `xshot_photo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(64) NOT NULL,
  `author` varchar(64) DEFAULT NULL,
  `make` varchar(128) DEFAULT NULL,
  `model` varchar(128) DEFAULT NULL,
  `exposureTime` varchar(16) DEFAULT NULL,
  `iso` int(11) DEFAULT NULL,
  `fNumber` varchar(16) DEFAULT NULL,
  `exposureBiasValue` int(11) DEFAULT NULL,
  `exif` text,
  `sort` int(11) NOT NULL DEFAULT '0',
  `createTime` int(10) NOT NULL,
  `updateTime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `filename` (`filename`) USING BTREE
);
