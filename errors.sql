/*
Navicat MySQL Data Transfer

Source Server         : error_handling
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : error_handling

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2014-05-28 10:54:39
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `errors`
-- ----------------------------
DROP TABLE IF EXISTS `errors`;
CREATE TABLE `errors` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code` int(11) NOT NULL,
  `message` varchar(255) DEFAULT NULL,
  `file` varchar(255) NOT NULL,
  `line` smallint(4) NOT NULL,
  `uri` varchar(255) DEFAULT NULL,
  `referrer` varchar(255) DEFAULT NULL,
  `logtime` datetime DEFAULT NULL,
  `ip` varchar(15) NOT NULL,
  `request_method` enum('DELETE','PUT','POST','GET') NOT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `post_data` text,
  `browser` varchar(255) DEFAULT NULL,
  `traces` text,
  PRIMARY KEY (`id`),
  KEY `line` (`line`,`file`),
  KEY `line_2` (`line`,`request_method`,`file`,`uri`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8;