/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : borui

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-02-21 14:47:40
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for a_relation
-- ----------------------------
DROP TABLE IF EXISTS `a_relation`;
CREATE TABLE `a_relation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT '0' COMMENT '家长id',
  `active_id` int(10) unsigned DEFAULT '0' COMMENT '活动id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='家长活动关联表';

-- ----------------------------
-- Records of a_relation
-- ----------------------------

-- ----------------------------
-- Table structure for active
-- ----------------------------
DROP TABLE IF EXISTS `active`;
CREATE TABLE `active` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `no` varchar(18) DEFAULT '' COMMENT '活动编号',
  `remark` varchar(255) DEFAULT '' COMMENT '活动描述',
  `begin_at` int(11) unsigned DEFAULT '0' COMMENT '活动开始时间',
  `end_at` int(11) unsigned DEFAULT '0' COMMENT '活动结束时间',
  `limit` int(5) unsigned DEFAULT '0' COMMENT '人数限制',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='活动表';

-- ----------------------------
-- Records of active
-- ----------------------------
INSERT INTO `active` VALUES ('1', 'A2019022011228113', '123123', '1550678400', '1551110400', '123123');
INSERT INTO `active` VALUES ('2', 'A2019022013154802', '123123', '1550592000', '1551196800', '22');

-- ----------------------------
-- Table structure for job
-- ----------------------------
DROP TABLE IF EXISTS `job`;
CREATE TABLE `job` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `job` varchar(30) DEFAULT '' COMMENT '职位名',
  `last` int(11) unsigned DEFAULT '0' COMMENT '上级',
  `powers` varchar(1000) DEFAULT '' COMMENT '拥有权限',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户职位表';

-- ----------------------------
-- Records of job
-- ----------------------------

-- ----------------------------
-- Table structure for member
-- ----------------------------
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT '' COMMENT '用户名',
  `tel` varchar(11) DEFAULT '' COMMENT '手机号',
  `password` varchar(80) DEFAULT '' COMMENT '密码',
  `job_id` int(10) unsigned DEFAULT '0' COMMENT '职位id',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '状态 1启用 2禁用',
  `created_at` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='后台用户表';

-- ----------------------------
-- Records of member
-- ----------------------------
INSERT INTO `member` VALUES ('1', 'root', '18683509267', '$2y$13$qEyIWPMnYyoxSXzgYy8mseoL/bS/HDPB8iYSGcBiIWJSfCMPyhZku', '0', '1', '1539588593');

-- ----------------------------
-- Table structure for power
-- ----------------------------
DROP TABLE IF EXISTS `power`;
CREATE TABLE `power` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `last` int(11) unsigned DEFAULT '0' COMMENT '上级id',
  `no` varchar(8) DEFAULT '' COMMENT '权限标识',
  `type` tinyint(1) unsigned DEFAULT '1' COMMENT '权限类型 1菜单2按钮3接口',
  `name` varchar(30) DEFAULT '' COMMENT '权限名',
  `url` varchar(100) DEFAULT '' COMMENT '权限路由',
  `sort` int(10) unsigned DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='用户权限表';

-- ----------------------------
-- Records of power
-- ----------------------------
INSERT INTO `power` VALUES ('1', '0', '353varQx', '1', '组织架构', '/job', '0');
INSERT INTO `power` VALUES ('2', '1', 'a89l9knd', '1', '职位管理', '/job/job/list', '0');
INSERT INTO `power` VALUES ('3', '1', 'x8oblwsw', '1', '用户管理', '/member/member/list', '1');
INSERT INTO `power` VALUES ('4', '0', '6zmmoeds', '1', '活动管理', '/active', '1');
INSERT INTO `power` VALUES ('5', '4', 'nkbd4vcg', '1', '活动列表', '/active/active/list', '0');
INSERT INTO `power` VALUES ('6', '0', 'smwuogyb', '1', '会员管理', '/user', '2');
INSERT INTO `power` VALUES ('7', '6', 'xux9fu61', '1', '会员列表', '/user/user/list', '0');
INSERT INTO `power` VALUES ('8', '0', '1u5ippng', '1', '票券管理', '/volume', '3');
INSERT INTO `power` VALUES ('9', '8', 'iot8u2u9', '1', '票券列表', '/volume/volume/list', '0');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auth` varchar(80) DEFAULT '' COMMENT '用户标识',
  `tel` varchar(11) DEFAULT '' COMMENT '用户电话',
  `wechat` varchar(80) DEFAULT '' COMMENT '微信ID',
  `name` varchar(20) DEFAULT '' COMMENT '家长姓名',
  `child_name` varchar(20) DEFAULT '' COMMENT '学生姓名',
  `child_sex` tinyint(1) unsigned DEFAULT '0' COMMENT '学生性别0男1女',
  `child_age` int(3) unsigned DEFAULT '0' COMMENT '学生姓名',
  `class` varchar(20) DEFAULT '' COMMENT '班级',
  `status` tinyint(1) unsigned DEFAULT '0' COMMENT '账号状态0在使用1已禁用',
  `created` int(11) unsigned DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='普通用户表';

-- ----------------------------
-- Records of user
-- ----------------------------

-- ----------------------------
-- Table structure for v_relation
-- ----------------------------
DROP TABLE IF EXISTS `v_relation`;
CREATE TABLE `v_relation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT '0' COMMENT '家长id',
  `volume_id` int(10) unsigned DEFAULT '0' COMMENT '活动券id',
  `status` tinyint(1) unsigned DEFAULT '0' COMMENT '活动券使用状态0未使用1已使用2已禁用',
  `updated_at` int(11) unsigned DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='家长活动券关系表';

-- ----------------------------
-- Records of v_relation
-- ----------------------------

-- ----------------------------
-- Table structure for volume
-- ----------------------------
DROP TABLE IF EXISTS `volume`;
CREATE TABLE `volume` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `no` varchar(18) DEFAULT '' COMMENT '编号',
  `type` tinyint(2) unsigned DEFAULT '0' COMMENT '活动券类型0活动报名凭证1活动优惠券',
  `money` varchar(10) DEFAULT '0' COMMENT '金额',
  `created_at` int(11) unsigned DEFAULT '0' COMMENT '创建时间',
  `begin_at` int(11) unsigned DEFAULT '0' COMMENT '开始时间',
  `end_at` int(11) unsigned DEFAULT '0' COMMENT '截止时间',
  `remark` varchar(255) DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='活动卷表';

-- ----------------------------
-- Records of volume
-- ----------------------------
