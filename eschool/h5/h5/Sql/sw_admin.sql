/*
Navicat MySQL Data Transfer

Source Server         : it
Source Server Version : 50540
Source Host           : 192.168.1.122:3306
Source Database       : db

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2015-12-02 17:43:40
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `sw_admin`
-- ----------------------------
DROP TABLE IF EXISTS `sw_admin`;
CREATE TABLE `sw_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '管理员ID',
  `admin_user` varchar(32) DEFAULT NULL,
  `admin_psd` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of sw_admin
-- ----------------------------
INSERT INTO `sw_admin` VALUES ('1', 'admin', '96e79218965eb72c92a549dd5a330112');

-- ----------------------------
-- Table structure for `sw_auth`
-- ----------------------------
DROP TABLE IF EXISTS `sw_auth`;
CREATE TABLE `sw_auth` (
  `auth_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `auth_name` varchar(20) NOT NULL COMMENT '权限名称',
  `auth_pid` smallint(6) unsigned NOT NULL COMMENT '父id',
  `auth_c` varchar(32) NOT NULL DEFAULT '' COMMENT '控制器',
  `auth_a` varchar(32) NOT NULL DEFAULT '' COMMENT '操作方法',
  `auth_path` varchar(32) NOT NULL COMMENT '全路径',
  `auth_level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '权限级别，从0开始计数',
  PRIMARY KEY (`auth_id`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sw_auth
-- ----------------------------
INSERT INTO `sw_auth` VALUES ('101', '项目管理', '0', '', '', '101', '0');
INSERT INTO `sw_auth` VALUES ('102', '用户管理', '0', '', '', '102', '0');
INSERT INTO `sw_auth` VALUES ('104', '信息列表', '101', 'Userinfo', 'showlist', '101-104', '1');
INSERT INTO `sw_auth` VALUES ('105', '会议列表', '101', 'Meet', 'showlist', '101-105', '1');
INSERT INTO `sw_auth` VALUES ('109', '管理员列表', '102', 'Adminlist', 'showlist', '102-109', '1');
INSERT INTO `sw_auth` VALUES ('110', '角色管理', '102', 'Role', 'showlist', '102-110', '1');
INSERT INTO `sw_auth` VALUES ('111', '权限列表', '102', 'Auth', 'showlist', '102-111', '1');

-- ----------------------------
-- Table structure for `sw_manager`
-- ----------------------------
DROP TABLE IF EXISTS `sw_manager`;
CREATE TABLE `sw_manager` (
  `mg_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mg_name` varchar(32) NOT NULL,
  `mg_pwd` varchar(32) NOT NULL,
  `mg_time` int(10) unsigned NOT NULL COMMENT '时间',
  `mg_role_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '角色id',
  PRIMARY KEY (`mg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sw_manager
-- ----------------------------
INSERT INTO `sw_manager` VALUES ('1', 'admin', '202cb962ac59075b964b07152d234b70', '0', '0');
INSERT INTO `sw_manager` VALUES ('82', 'linken', '202cb962ac59075b964b07152d234b70', '1449042212', '11');
INSERT INTO `sw_manager` VALUES ('84', 'john', '202cb962ac59075b964b07152d234b70', '1449046423', '12');

-- ----------------------------
-- Table structure for `sw_meet`
-- ----------------------------
DROP TABLE IF EXISTS `sw_meet`;
CREATE TABLE `sw_meet` (
  `meet_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` longtext NOT NULL,
  `time` int(10) NOT NULL,
  PRIMARY KEY (`meet_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of sw_meet
-- ----------------------------
INSERT INTO `sw_meet` VALUES ('1', '讨论系能源', '', '0');

-- ----------------------------
-- Table structure for `sw_role`
-- ----------------------------
DROP TABLE IF EXISTS `sw_role`;
CREATE TABLE `sw_role` (
  `role_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(20) NOT NULL COMMENT '角色名称',
  `role_auth_ids` varchar(128) NOT NULL DEFAULT '' COMMENT '权限ids,1,2,5',
  `role_auth_ac` text COMMENT '控制器-操作,控制器-操作,控制器-操作',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sw_role
-- ----------------------------
INSERT INTO `sw_role` VALUES ('10', '经理', '104,109', 'Userinfo-showlist,Adminlist-showlist');
INSERT INTO `sw_role` VALUES ('11', '主管', '101,104,105', 'Userinfo-showlist,Userinfo-xiugai');
INSERT INTO `sw_role` VALUES ('12', '管理员', '101,104,105,102,109,110,111', 'Userinfo-showlist,Meet-showlist,Adminlist-showlist,Role-showlist,Auth-showlist');

-- ----------------------------
-- Table structure for `sw_userinfo`
-- ----------------------------
DROP TABLE IF EXISTS `sw_userinfo`;
CREATE TABLE `sw_userinfo` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增',
  `user_create_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `user_scheme_name` varchar(100) NOT NULL COMMENT '案名',
  `user_tel` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '电话',
  `user_real_name` varchar(22) NOT NULL COMMENT '真名',
  `user_remark` text NOT NULL COMMENT '备注',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sw_userinfo
-- ----------------------------
INSERT INTO `sw_userinfo` VALUES ('1', '2015-12-02 14:17:02', '系能源', '18695826261', '米琼恩', '备注1');
INSERT INTO `sw_userinfo` VALUES ('2', '2015-12-02 14:17:10', '电能源', '18695826262', '奎恩', '备注2');
INSERT INTO `sw_userinfo` VALUES ('3', '2015-12-02 14:17:12', '碧桂园', '18695826263', '乌瑞恩', '备注3');
INSERT INTO `sw_userinfo` VALUES ('5', '2015-12-02 14:17:15', '卜丽媛', '18525826261', '安度因', '备注4');
INSERT INTO `sw_userinfo` VALUES ('6', '2015-12-02 14:17:17', '太能元', '18695826222', '凯恩血蹄', '备注1');
INSERT INTO `sw_userinfo` VALUES ('7', '2015-12-02 14:17:18', '火能源', '18695826211', '劳尔', '备注1');
