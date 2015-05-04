CREATE TABLE `newyear_msg` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(11) unsigned NOT NULL,
  `nickname` varchar(90) DEFAULT NULL,
  `name` varchar(32) DEFAULT NULL,
  `lyricNo` smallint(6) DEFAULT NULL,
  `createTime` int(11) NOT NULL,
  `updateTime` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

CREATE TABLE `newyear_stat` (
  `userId` int(11) unsigned NOT NULL,
  `drawTotal` int(11) unsigned NOT NULL DEFAULT '0',
  `drawLeft` int(11) unsigned NOT NULL DEFAULT '0',
  `lastDate` char(10) DEFAULT NULL,
  `createTime` int(10) NOT NULL,
  `updateTime` int(10) NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `activity`.`core_prize` (`module`, `activityId`, `level`, `name`, `unit`, `image`, `count`, `total`, `weight`, `isLuck`, `isMobile`, `isCoupon`, `extra`, `sort`, `createTime`, `updateTime`) VALUES ('newyear', '0', '0', '再接再厉', NULL, NULL, '0', '99999999', '50000', '0', '0', '0', '{\"angle\": 0, \"itemId\": 0, \"title\": \"\"}', '4', '1425454268', '1425454268');
INSERT INTO `activity`.`core_prize` (`module`, `activityId`, `level`, `name`, `unit`, `image`, `count`, `total`, `weight`, `isLuck`, `isMobile`, `isCoupon`, `extra`, `sort`, `createTime`, `updateTime`) VALUES ('newyear', '0', '0', 'vivo X5Max', '台', NULL, '0', '5', '1', '1', '1', '0', '{\"angle\": 90, \"itemId\": 1, \"title\": \"<span>vivo</span><span>X5Max</span>\"}', '3', '1425454268', '1425454268');
INSERT INTO `activity`.`core_prize` (`module`, `activityId`, `level`, `name`, `unit`, `image`, `count`, `total`, `weight`, `isLuck`, `isMobile`, `isCoupon`, `extra`, `sort`, `createTime`, `updateTime`) VALUES ('newyear', '0', '0', '高品质耳机', '条', NULL, '0', '20', '10', '1', '0', '0', '{\"angle\": 180, \"itemId\": 2, \"title\": \"<span>vivo</span><span class=\\\"small\\\">高品质耳机</span>\"}', '2', '1425454268', '1425454268');
INSERT INTO `activity`.`core_prize` (`module`, `activityId`, `level`, `name`, `unit`, `image`, `count`, `total`, `weight`, `isLuck`, `isMobile`, `isCoupon`, `extra`, `sort`, `createTime`, `updateTime`) VALUES ('newyear', '0', '0', 'vivo原装移动电源', '个', NULL, '0', '20', '10', '1', '0', '0', '{\"angle\": 270, \"itemId\": 3, \"title\": \"<span>vivo</span><span>移动电源</span>\"}', '1', '1425454268', '1425454268');
