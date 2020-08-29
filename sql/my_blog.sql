/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50647
Source Host           : localhost:3306
Source Database       : my_blog_uat

Target Server Type    : MYSQL
Target Server Version : 50647
File Encoding         : 65001

Date: 2020-08-29 16:41:06
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `article`
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `viewCount` int(11) DEFAULT '0',
  `createdAt` varchar(50) NOT NULL,
  `updatedAt` varchar(50) NOT NULL,
  `public` varchar(10) NOT NULL,
  `aLike` int(11) DEFAULT '0' COMMENT '点赞数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article
-- ----------------------------

-- ----------------------------
-- Table structure for `blogdata`
-- ----------------------------
DROP TABLE IF EXISTS `blogdata`;
CREATE TABLE `blogdata` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `dailyVistor` int(11) DEFAULT '0' COMMENT '新增访客',
  `dailyLike` int(11) DEFAULT '0' COMMENT '新增点赞',
  `totalVistor` int(11) DEFAULT '0' COMMENT '总访客数',
  `totalLike` int(11) DEFAULT '0' COMMENT '总点赞',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blogdata
-- ----------------------------

-- ----------------------------
-- Table structure for `category`
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category
-- ----------------------------

-- ----------------------------
-- Table structure for `category_links`
-- ----------------------------
DROP TABLE IF EXISTS `category_links`;
CREATE TABLE `category_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`article_id`,`category_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category_links
-- ----------------------------

-- ----------------------------
-- Table structure for `comment`
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `articleId` int(11) NOT NULL,
  `content` text,
  `createdAt` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comment
-- ----------------------------

-- ----------------------------
-- Table structure for `friendly_link`
-- ----------------------------
DROP TABLE IF EXISTS `friendly_link`;
CREATE TABLE `friendly_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `link` text,
  `avatar_link` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of friendly_link
-- ----------------------------

-- ----------------------------
-- Table structure for `github_user`
-- ----------------------------
DROP TABLE IF EXISTS `github_user`;
CREATE TABLE `github_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(55) NOT NULL COMMENT 'github用户固定唯一的id',
  `login` varchar(55) DEFAULT NULL COMMENT '用户github账号',
  `avatar_url` text COMMENT 'github头像地址',
  `html_url` text COMMENT 'github地址',
  `name` text COMMENT 'github用户名',
  `company` text COMMENT '用户公司名称',
  `blog` text COMMENT '用户博客地址',
  `location` text COMMENT '用户所在地',
  `email` varchar(55) DEFAULT NULL COMMENT '用户邮箱',
  `bio` text COMMENT '用户自我介绍',
  `last_time` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`uid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of github_user
-- ----------------------------

-- ----------------------------
-- Table structure for `message`
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `createdAt` varchar(50) DEFAULT NULL,
  `content` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of message
-- ----------------------------

-- ----------------------------
-- Table structure for `qq_user`
-- ----------------------------
DROP TABLE IF EXISTS `qq_user`;
CREATE TABLE `qq_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `openid` varchar(50) DEFAULT NULL,
  `name` text COMMENT 'qq名称',
  `gender` varchar(50) DEFAULT NULL COMMENT '性别',
  `province` text COMMENT '省份',
  `city` text COMMENT '城市',
  `year` varchar(50) DEFAULT NULL COMMENT 'qq的出生年份',
  `figureurl` text COMMENT '30*30 头像地址',
  `last_time` varchar(50) DEFAULT NULL COMMENT '最后一次登录时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`openid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of qq_user
-- ----------------------------

-- ----------------------------
-- Table structure for `tag`
-- ----------------------------
DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tag
-- ----------------------------

-- ----------------------------
-- Table structure for `tag_links`
-- ----------------------------
DROP TABLE IF EXISTS `tag_links`;
CREATE TABLE `tag_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`article_id`,`tag_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tag_links
-- ----------------------------

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `role` varchar(10) DEFAULT '0',
  `createdAt` varchar(50) NOT NULL,
  `uid` varchar(50) DEFAULT NULL COMMENT '用户微博uid',
  `openid` varchar(50) DEFAULT NULL COMMENT '用户qq的openid',
  `gid` varchar(50) DEFAULT NULL COMMENT '用户github的唯一id',
  `token` varchar(55) DEFAULT NULL,
  `last_time` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', '1', '2019-11-19 09:35:15', '', '5A625B72B49C8B834AC2025BFD0B3817', '', 'ZTBkZDQ3NmY1YmY4OTY1MWNjMDUyNjEwMTM5MzQ5ZTgy', '2020-08-28 22:48:47');

-- ----------------------------
-- Table structure for `weibo_user`
-- ----------------------------
DROP TABLE IF EXISTS `weibo_user`;
CREATE TABLE `weibo_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(55) NOT NULL COMMENT '用户唯一id',
  `name` text COMMENT '友好显示名称',
  `screen_name` text COMMENT '用户昵称',
  `location` text COMMENT '用户所在地',
  `avatar_hd` text COMMENT '微博头像地址',
  `gender` varchar(50) DEFAULT NULL COMMENT '性别，m：男、f：女、n：未知',
  `description` text COMMENT '用户个人描述',
  `followers_count` varchar(55) DEFAULT NULL COMMENT '粉丝数',
  `friends_count` varchar(55) DEFAULT NULL COMMENT '关注数',
  `last_time` varchar(55) DEFAULT '最后一次登录时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`uid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of weibo_user
-- ----------------------------
