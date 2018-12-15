/*
Navicat MySQL Data Transfer

Source Server         : 192.168.1.155_3306
Source Server Version : 50554
Source Host           : 192.168.1.155:3306
Source Database       : teeshop

Target Server Type    : MYSQL
Target Server Version : 50554
File Encoding         : 65001

Date: 2018-12-12 19:25:18
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for agent_inventory
-- ----------------------------
DROP TABLE IF EXISTS `agent_inventory`;
CREATE TABLE `agent_inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL COMMENT '商品id',
  `member_id` int(11) DEFAULT NULL COMMENT '会员id',
  `name` varchar(50) DEFAULT NULL COMMENT '会员真实姓名',
  `inventory_num` int(11) DEFAULT NULL COMMENT '库存数',
  `create_time` varchar(100) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of agent_inventory
-- ----------------------------

-- ----------------------------
-- Table structure for cashback_percentage
-- ----------------------------
DROP TABLE IF EXISTS `cashback_percentage`;
CREATE TABLE `cashback_percentage` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `level` int(10) DEFAULT NULL,
  `cashback_percentage` varchar(255) DEFAULT NULL COMMENT '返现比例',
  `cashback_price` int(50) DEFAULT NULL COMMENT '返现金额(普通会员专用)',
  `operation` varchar(50) DEFAULT NULL COMMENT '操作人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of cashback_percentage
-- ----------------------------
INSERT INTO `cashback_percentage` VALUES ('1', '2', '0.15', '0', null);
INSERT INTO `cashback_percentage` VALUES ('2', '3', '0.3', null, null);
INSERT INTO `cashback_percentage` VALUES ('3', '4', '0.3', '0', null);
INSERT INTO `cashback_percentage` VALUES ('4', '1', '0', '100', '超级管理员');

-- ----------------------------
-- Table structure for cash_month_record
-- ----------------------------
DROP TABLE IF EXISTS `cash_month_record`;
CREATE TABLE `cash_month_record` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `cash_price` varchar(255) DEFAULT NULL COMMENT '当月应返现金额',
  `cash_time` varchar(255) DEFAULT NULL COMMENT '返现时间(年/月)',
  `cash_id` int(50) NOT NULL COMMENT '返现人id',
  `status` varchar(5) DEFAULT '2' COMMENT '返现状态（1是2否）',
  `operation` varchar(50) DEFAULT NULL COMMENT '操作人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of cash_month_record
-- ----------------------------

-- ----------------------------
-- Table structure for cash_record
-- ----------------------------
DROP TABLE IF EXISTS `cash_record`;
CREATE TABLE `cash_record` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `member_id` int(50) NOT NULL COMMENT '会员id',
  `commodity_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '商品名称',
  `referee_id` int(50) NOT NULL COMMENT '推荐人id',
  `member_name` varchar(255) DEFAULT NULL COMMENT '上级名称',
  `member_level` varchar(255) DEFAULT NULL COMMENT '会员等级',
  `referee_name` varchar(255) DEFAULT NULL COMMENT '下级名称',
  `referee_level` varchar(255) DEFAULT NULL COMMENT '推荐人等级',
  `member_price` varchar(255) DEFAULT NULL COMMENT '会员注册价格',
  `cashback_percentage` varchar(255) DEFAULT NULL COMMENT '返现比例',
  `final_cashback_amount` varchar(255) DEFAULT NULL COMMENT '最终返现金额',
  `same_month` varchar(255) DEFAULT NULL COMMENT '当月应返现',
  `next_month` varchar(255) DEFAULT NULL COMMENT '下月结余',
  `registration_date` varchar(255) DEFAULT NULL COMMENT '下级注册时间或商品订单下单时间',
  `record_date` varchar(255) DEFAULT NULL COMMENT '记录时间',
  `type` varchar(255) DEFAULT NULL COMMENT '记录来源类型',
  `order_price` varchar(255) DEFAULT '0' COMMENT '订单金额',
  `order_id` int(50) DEFAULT NULL COMMENT '订单id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of cash_record
-- ----------------------------

-- ----------------------------
-- Table structure for company_profile
-- ----------------------------
DROP TABLE IF EXISTS `company_profile`;
CREATE TABLE `company_profile` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `addtime` datetime DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL COMMENT '1发布2禁用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of company_profile
-- ----------------------------
INSERT INTO `company_profile` VALUES ('23', '公司简介', '<p>十多个可接受的考虑过代码呢</p><div class=\"media-wrap image-wrap\"><img src=\"http://192.168.10.102/Public/upload/image/test31542097347.jpg\"/></div><p>东风浩荡和东方红东方红挂号费国际化房管局过好几个号就高合金钢好几个号规划局规划局规划局规划局规划局</p><div class=\"media-wrap image-wrap\"><img src=\"http://192.168.10.102/Public/upload/image/test41542097362.jpg\"/></div><p>规划局规划局开个会开个会更何况工行卡和晶科技黄金客户铝合金结课了</p><div class=\"media-wrap image-wrap\"><img src=\"http://192.168.10.102/Public/upload/image/test51542097375.jpg\"/></div><p>回家了含金量和结婚六角恐龙结课了结课了</p>', '2018-11-13 16:23:01', '1');

-- ----------------------------
-- Table structure for members_level
-- ----------------------------
DROP TABLE IF EXISTS `members_level`;
CREATE TABLE `members_level` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `level_name` varchar(50) CHARACTER SET utf8mb4 NOT NULL DEFAULT '',
  `english_name` varchar(50) DEFAULT NULL,
  `level_price` varchar(10) NOT NULL,
  `level` varchar(1) NOT NULL,
  PRIMARY KEY (`id`,`level_name`,`level_price`,`level`) USING BTREE,
  KEY `level` (`level`),
  KEY `level_name` (`level_name`),
  KEY `level_price` (`level_price`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of members_level
-- ----------------------------
INSERT INTO `members_level` VALUES ('1', '普通会员', 'Average', '0', '1');
INSERT INTO `members_level` VALUES ('2', '创客', 'Entrepreneur', '0.01', '2');
INSERT INTO `members_level` VALUES ('3', '盟主', 'Alliance', '0.02', '3');
INSERT INTO `members_level` VALUES ('4', '合伙人', 'Collaborator', '0.03', '4');

-- ----------------------------
-- Table structure for member_order
-- ----------------------------
DROP TABLE IF EXISTS `member_order`;
CREATE TABLE `member_order` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(20) DEFAULT NULL COMMENT '订单号',
  `openid` varchar(50) DEFAULT NULL,
  `wx_num` varchar(50) DEFAULT NULL COMMENT '微信号',
  `nick_name` varchar(100) DEFAULT NULL COMMENT '微信昵称',
  `head_portrait` varchar(255) DEFAULT NULL COMMENT '微信头像地址',
  `name` varchar(50) DEFAULT NULL COMMENT '会员姓名',
  `idcard` varchar(18) DEFAULT NULL COMMENT '身份证号',
  `phone` varchar(11) DEFAULT NULL COMMENT '会员手机号',
  `level` int(1) DEFAULT NULL COMMENT '会员等级',
  `level_info` varchar(50) DEFAULT NULL COMMENT '会员等级名称',
  `level_price` varchar(10) DEFAULT NULL COMMENT '会员价格',
  `pay` bit(1) DEFAULT NULL COMMENT '支付状态（1已支付，0未支付）',
  `referee_phone` varchar(11) DEFAULT NULL COMMENT '推荐人手机号',
  `create_time` varchar(25) DEFAULT NULL COMMENT '订单创建时间',
  `updatedAt` varchar(25) DEFAULT NULL COMMENT '订单更新时间',
  `payment` varchar(10) DEFAULT NULL COMMENT '已支付金额',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=211 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of member_order
-- ----------------------------
INSERT INTO `member_order` VALUES ('209', 'IB305898275458d', 'oNBwv5bP-8pZ3kjDODFuto2h3qC8', 'asgagl', 'Vue', 'https://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83epiczXDOxnOO3ytp0dU3oZiaicmxHCA3l9pvgE83bjgjD0Kte5tpu0ZXSmtrwIa6WqoibbuaVzpf7CHRA/132', 'wangxin', '142227199409050017', '18235440687', '4', '合伙人', '0.03', '\0', '', '2018-11-30 14:23:02', null, null);
INSERT INTO `member_order` VALUES ('210', 'IB306057049640d', 'oNBwv5bP-8pZ3kjDODFuto2h3qC8', 'wx', 'Vue', 'https://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83epiczXDOxnOO3ytp0dU3oZiaicmxHCA3l9pvgE83bjgjD0Kte5tpu0ZXSmtrwIa6WqoibbuaVzpf7CHRA/132', '王鑫', '142227199409050017', '18235440687', '4', '合伙人', '0.03', '\0', '', '2018-11-30 14:49:30', null, '0.02');

-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `imgurl` varchar(255) DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL COMMENT '1发布2停用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES ('32', '第一篇新闻', '<p>卖好东西了，最假的进口仿真燕窝</p><div class=\"media-wrap image-wrap\"><img src=\"http://192.168.10.102/Public/upload/image/test31542097469.jpg\"/></div><p></p>', '/image/test31542097430.jpg', '2018-11-13 16:24:31', '1');

-- ----------------------------
-- Table structure for product_banner
-- ----------------------------
DROP TABLE IF EXISTS `product_banner`;
CREATE TABLE `product_banner` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `path` varchar(100) NOT NULL COMMENT '图片路径',
  `is_use` int(1) NOT NULL COMMENT '图片展示位置（1首页2产品页）',
  `create_time` varchar(25) NOT NULL COMMENT '上传时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of product_banner
-- ----------------------------
INSERT INTO `product_banner` VALUES ('10', '/image/test31542095217.jpg', '1', '2018-11-13 15:46:59');
INSERT INTO `product_banner` VALUES ('11', '/image/test41542095223.jpg', '1', '2018-11-13 15:47:04');
INSERT INTO `product_banner` VALUES ('12', '/image/test51542095228.jpg', '1', '2018-11-13 15:47:09');
INSERT INTO `product_banner` VALUES ('13', '/image/test31542095251.jpg', '2', '2018-11-13 15:47:35');
INSERT INTO `product_banner` VALUES ('14', '/image/test41542095259.jpg', '2', '2018-11-13 15:47:40');
INSERT INTO `product_banner` VALUES ('15', '/image/test51542095263.jpg', '2', '2018-11-13 15:47:45');

-- ----------------------------
-- Table structure for security_code
-- ----------------------------
DROP TABLE IF EXISTS `security_code`;
CREATE TABLE `security_code` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `securitycode` varchar(255) DEFAULT NULL,
  `generatetime` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of security_code
-- ----------------------------

-- ----------------------------
-- Table structure for shop_banner
-- ----------------------------
DROP TABLE IF EXISTS `shop_banner`;
CREATE TABLE `shop_banner` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) DEFAULT NULL COMMENT '图片路径',
  `is_use` char(10) DEFAULT '0' COMMENT '是否使用(0未使用,1已使用)不用',
  `create_time` varchar(100) DEFAULT NULL COMMENT '创建时间',
  `product_id` int(11) DEFAULT NULL COMMENT '商品id',
  `linkType` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1169 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of shop_banner
-- ----------------------------
INSERT INTO `shop_banner` VALUES ('1167', '/image/vip11544594346.jpg', '1', '2018-12-12 13:59:07', null, null, null);
INSERT INTO `shop_banner` VALUES ('1168', '/image/vip21544594355.jpg', '1', '2018-12-12 13:59:17', null, null, null);

-- ----------------------------
-- Table structure for shop_city
-- ----------------------------
DROP TABLE IF EXISTS `shop_city`;
CREATE TABLE `shop_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wx_code` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=375 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of shop_city
-- ----------------------------
INSERT INTO `shop_city` VALUES ('1', '110100', '北京市');
INSERT INTO `shop_city` VALUES ('2', '120100', '天津市');
INSERT INTO `shop_city` VALUES ('3', '130100', '石家庄市');
INSERT INTO `shop_city` VALUES ('4', '130200', '唐山市');
INSERT INTO `shop_city` VALUES ('5', '130300', '秦皇岛市');
INSERT INTO `shop_city` VALUES ('6', '130400', '邯郸市');
INSERT INTO `shop_city` VALUES ('7', '130500', '邢台市');
INSERT INTO `shop_city` VALUES ('8', '130600', '保定市');
INSERT INTO `shop_city` VALUES ('9', '130700', '张家口市');
INSERT INTO `shop_city` VALUES ('10', '130800', '承德市');
INSERT INTO `shop_city` VALUES ('11', '130900', '沧州市');
INSERT INTO `shop_city` VALUES ('12', '131000', '廊坊市');
INSERT INTO `shop_city` VALUES ('13', '131100', '衡水市');
INSERT INTO `shop_city` VALUES ('14', '139000', '省直辖县');
INSERT INTO `shop_city` VALUES ('15', '140100', '太原市');
INSERT INTO `shop_city` VALUES ('16', '140200', '大同市');
INSERT INTO `shop_city` VALUES ('17', '140300', '阳泉市');
INSERT INTO `shop_city` VALUES ('18', '140400', '长治市');
INSERT INTO `shop_city` VALUES ('19', '140500', '晋城市');
INSERT INTO `shop_city` VALUES ('20', '140600', '朔州市');
INSERT INTO `shop_city` VALUES ('21', '140700', '晋中市');
INSERT INTO `shop_city` VALUES ('22', '140800', '运城市');
INSERT INTO `shop_city` VALUES ('23', '140900', '忻州市');
INSERT INTO `shop_city` VALUES ('24', '141000', '临汾市');
INSERT INTO `shop_city` VALUES ('25', '141100', '吕梁市');
INSERT INTO `shop_city` VALUES ('26', '150100', '呼和浩特市');
INSERT INTO `shop_city` VALUES ('27', '150200', '包头市');
INSERT INTO `shop_city` VALUES ('28', '150300', '乌海市');
INSERT INTO `shop_city` VALUES ('29', '150400', '赤峰市');
INSERT INTO `shop_city` VALUES ('30', '150500', '通辽市');
INSERT INTO `shop_city` VALUES ('31', '150600', '鄂尔多斯市');
INSERT INTO `shop_city` VALUES ('32', '150700', '呼伦贝尔市');
INSERT INTO `shop_city` VALUES ('33', '150800', '巴彦淖尔市');
INSERT INTO `shop_city` VALUES ('34', '150900', '乌兰察布市');
INSERT INTO `shop_city` VALUES ('35', '152200', '兴安盟');
INSERT INTO `shop_city` VALUES ('36', '152500', '锡林郭勒盟');
INSERT INTO `shop_city` VALUES ('37', '152900', '阿拉善盟');
INSERT INTO `shop_city` VALUES ('38', '210100', '沈阳市');
INSERT INTO `shop_city` VALUES ('39', '210200', '大连市');
INSERT INTO `shop_city` VALUES ('40', '210300', '鞍山市');
INSERT INTO `shop_city` VALUES ('41', '210400', '抚顺市');
INSERT INTO `shop_city` VALUES ('42', '210500', '本溪市');
INSERT INTO `shop_city` VALUES ('43', '210600', '丹东市');
INSERT INTO `shop_city` VALUES ('44', '210700', '锦州市');
INSERT INTO `shop_city` VALUES ('45', '210800', '营口市');
INSERT INTO `shop_city` VALUES ('46', '210900', '阜新市');
INSERT INTO `shop_city` VALUES ('47', '211000', '辽阳市');
INSERT INTO `shop_city` VALUES ('48', '211100', '盘锦市');
INSERT INTO `shop_city` VALUES ('49', '211200', '铁岭市');
INSERT INTO `shop_city` VALUES ('50', '211300', '朝阳市');
INSERT INTO `shop_city` VALUES ('51', '211400', '葫芦岛市');
INSERT INTO `shop_city` VALUES ('52', '220100', '长春市');
INSERT INTO `shop_city` VALUES ('53', '220200', '吉林市');
INSERT INTO `shop_city` VALUES ('54', '220300', '四平市');
INSERT INTO `shop_city` VALUES ('55', '220400', '辽源市');
INSERT INTO `shop_city` VALUES ('56', '220500', '通化市');
INSERT INTO `shop_city` VALUES ('57', '220600', '白山市');
INSERT INTO `shop_city` VALUES ('58', '220700', '松原市');
INSERT INTO `shop_city` VALUES ('59', '220800', '白城市');
INSERT INTO `shop_city` VALUES ('60', '222400', '延边朝鲜族自治州');
INSERT INTO `shop_city` VALUES ('61', '230100', '哈尔滨市');
INSERT INTO `shop_city` VALUES ('62', '230200', '齐齐哈尔市');
INSERT INTO `shop_city` VALUES ('63', '230300', '鸡西市');
INSERT INTO `shop_city` VALUES ('64', '230400', '鹤岗市');
INSERT INTO `shop_city` VALUES ('65', '230500', '双鸭山市');
INSERT INTO `shop_city` VALUES ('66', '230600', '大庆市');
INSERT INTO `shop_city` VALUES ('67', '230700', '伊春市');
INSERT INTO `shop_city` VALUES ('68', '230800', '佳木斯市');
INSERT INTO `shop_city` VALUES ('69', '230900', '七台河市');
INSERT INTO `shop_city` VALUES ('70', '231000', '牡丹江市');
INSERT INTO `shop_city` VALUES ('71', '231100', '黑河市');
INSERT INTO `shop_city` VALUES ('72', '231200', '绥化市');
INSERT INTO `shop_city` VALUES ('73', '232700', '大兴安岭地区');
INSERT INTO `shop_city` VALUES ('74', '310100', '上海市');
INSERT INTO `shop_city` VALUES ('75', '320100', '南京市');
INSERT INTO `shop_city` VALUES ('76', '320200', '无锡市');
INSERT INTO `shop_city` VALUES ('77', '320300', '徐州市');
INSERT INTO `shop_city` VALUES ('78', '320400', '常州市');
INSERT INTO `shop_city` VALUES ('79', '320500', '苏州市');
INSERT INTO `shop_city` VALUES ('80', '320600', '南通市');
INSERT INTO `shop_city` VALUES ('81', '320700', '连云港市');
INSERT INTO `shop_city` VALUES ('82', '320800', '淮安市');
INSERT INTO `shop_city` VALUES ('83', '320900', '盐城市');
INSERT INTO `shop_city` VALUES ('84', '321000', '扬州市');
INSERT INTO `shop_city` VALUES ('85', '321100', '镇江市');
INSERT INTO `shop_city` VALUES ('86', '321200', '泰州市');
INSERT INTO `shop_city` VALUES ('87', '321300', '宿迁市');
INSERT INTO `shop_city` VALUES ('88', '330100', '杭州市');
INSERT INTO `shop_city` VALUES ('89', '330200', '宁波市');
INSERT INTO `shop_city` VALUES ('90', '330300', '温州市');
INSERT INTO `shop_city` VALUES ('91', '330400', '嘉兴市');
INSERT INTO `shop_city` VALUES ('92', '330500', '湖州市');
INSERT INTO `shop_city` VALUES ('93', '330600', '绍兴市');
INSERT INTO `shop_city` VALUES ('94', '330700', '金华市');
INSERT INTO `shop_city` VALUES ('95', '330800', '衢州市');
INSERT INTO `shop_city` VALUES ('96', '330900', '舟山市');
INSERT INTO `shop_city` VALUES ('97', '331000', '台州市');
INSERT INTO `shop_city` VALUES ('98', '331100', '丽水市');
INSERT INTO `shop_city` VALUES ('99', '340100', '合肥市');
INSERT INTO `shop_city` VALUES ('100', '340200', '芜湖市');
INSERT INTO `shop_city` VALUES ('101', '340300', '蚌埠市');
INSERT INTO `shop_city` VALUES ('102', '340400', '淮南市');
INSERT INTO `shop_city` VALUES ('103', '340500', '马鞍山市');
INSERT INTO `shop_city` VALUES ('104', '340600', '淮北市');
INSERT INTO `shop_city` VALUES ('105', '340700', '铜陵市');
INSERT INTO `shop_city` VALUES ('106', '340800', '安庆市');
INSERT INTO `shop_city` VALUES ('107', '341000', '黄山市');
INSERT INTO `shop_city` VALUES ('108', '341100', '滁州市');
INSERT INTO `shop_city` VALUES ('109', '341200', '阜阳市');
INSERT INTO `shop_city` VALUES ('110', '341300', '宿州市');
INSERT INTO `shop_city` VALUES ('111', '341500', '六安市');
INSERT INTO `shop_city` VALUES ('112', '341600', '亳州市');
INSERT INTO `shop_city` VALUES ('113', '341700', '池州市');
INSERT INTO `shop_city` VALUES ('114', '341800', '宣城市');
INSERT INTO `shop_city` VALUES ('115', '350100', '福州市');
INSERT INTO `shop_city` VALUES ('116', '350200', '厦门市');
INSERT INTO `shop_city` VALUES ('117', '350300', '莆田市');
INSERT INTO `shop_city` VALUES ('118', '350400', '三明市');
INSERT INTO `shop_city` VALUES ('119', '350500', '泉州市');
INSERT INTO `shop_city` VALUES ('120', '350600', '漳州市');
INSERT INTO `shop_city` VALUES ('121', '350700', '南平市');
INSERT INTO `shop_city` VALUES ('122', '350800', '龙岩市');
INSERT INTO `shop_city` VALUES ('123', '350900', '宁德市');
INSERT INTO `shop_city` VALUES ('124', '360100', '南昌市');
INSERT INTO `shop_city` VALUES ('125', '360200', '景德镇市');
INSERT INTO `shop_city` VALUES ('126', '360300', '萍乡市');
INSERT INTO `shop_city` VALUES ('127', '360400', '九江市');
INSERT INTO `shop_city` VALUES ('128', '360500', '新余市');
INSERT INTO `shop_city` VALUES ('129', '360600', '鹰潭市');
INSERT INTO `shop_city` VALUES ('130', '360700', '赣州市');
INSERT INTO `shop_city` VALUES ('131', '360800', '吉安市');
INSERT INTO `shop_city` VALUES ('132', '360900', '宜春市');
INSERT INTO `shop_city` VALUES ('133', '361000', '抚州市');
INSERT INTO `shop_city` VALUES ('134', '361100', '上饶市');
INSERT INTO `shop_city` VALUES ('135', '370100', '济南市');
INSERT INTO `shop_city` VALUES ('136', '370200', '青岛市');
INSERT INTO `shop_city` VALUES ('137', '370300', '淄博市');
INSERT INTO `shop_city` VALUES ('138', '370400', '枣庄市');
INSERT INTO `shop_city` VALUES ('139', '370500', '东营市');
INSERT INTO `shop_city` VALUES ('140', '370600', '烟台市');
INSERT INTO `shop_city` VALUES ('141', '370700', '潍坊市');
INSERT INTO `shop_city` VALUES ('142', '370800', '济宁市');
INSERT INTO `shop_city` VALUES ('143', '370900', '泰安市');
INSERT INTO `shop_city` VALUES ('144', '371000', '威海市');
INSERT INTO `shop_city` VALUES ('145', '371100', '日照市');
INSERT INTO `shop_city` VALUES ('146', '371200', '莱芜市');
INSERT INTO `shop_city` VALUES ('147', '371300', '临沂市');
INSERT INTO `shop_city` VALUES ('148', '371400', '德州市');
INSERT INTO `shop_city` VALUES ('149', '371500', '聊城市');
INSERT INTO `shop_city` VALUES ('150', '371600', '滨州市');
INSERT INTO `shop_city` VALUES ('151', '371700', '菏泽市');
INSERT INTO `shop_city` VALUES ('152', '410100', '郑州市');
INSERT INTO `shop_city` VALUES ('153', '410200', '开封市');
INSERT INTO `shop_city` VALUES ('154', '410300', '洛阳市');
INSERT INTO `shop_city` VALUES ('155', '410400', '平顶山市');
INSERT INTO `shop_city` VALUES ('156', '410500', '安阳市');
INSERT INTO `shop_city` VALUES ('157', '410600', '鹤壁市');
INSERT INTO `shop_city` VALUES ('158', '410700', '新乡市');
INSERT INTO `shop_city` VALUES ('159', '410800', '焦作市');
INSERT INTO `shop_city` VALUES ('160', '410900', '濮阳市');
INSERT INTO `shop_city` VALUES ('161', '411000', '许昌市');
INSERT INTO `shop_city` VALUES ('162', '411100', '漯河市');
INSERT INTO `shop_city` VALUES ('163', '411200', '三门峡市');
INSERT INTO `shop_city` VALUES ('164', '411300', '南阳市');
INSERT INTO `shop_city` VALUES ('165', '411400', '商丘市');
INSERT INTO `shop_city` VALUES ('166', '411500', '信阳市');
INSERT INTO `shop_city` VALUES ('167', '411600', '周口市');
INSERT INTO `shop_city` VALUES ('168', '411700', '驻马店市');
INSERT INTO `shop_city` VALUES ('169', '419000', '省直辖县');
INSERT INTO `shop_city` VALUES ('170', '420100', '武汉市');
INSERT INTO `shop_city` VALUES ('171', '420200', '黄石市');
INSERT INTO `shop_city` VALUES ('172', '420300', '十堰市');
INSERT INTO `shop_city` VALUES ('173', '420500', '宜昌市');
INSERT INTO `shop_city` VALUES ('174', '420600', '襄阳市');
INSERT INTO `shop_city` VALUES ('175', '420700', '鄂州市');
INSERT INTO `shop_city` VALUES ('176', '420800', '荆门市');
INSERT INTO `shop_city` VALUES ('177', '420900', '孝感市');
INSERT INTO `shop_city` VALUES ('178', '421000', '荆州市');
INSERT INTO `shop_city` VALUES ('179', '421100', '黄冈市');
INSERT INTO `shop_city` VALUES ('180', '421200', '咸宁市');
INSERT INTO `shop_city` VALUES ('181', '421300', '随州市');
INSERT INTO `shop_city` VALUES ('182', '422800', '恩施土家族苗族自治州');
INSERT INTO `shop_city` VALUES ('183', '429000', '省直辖县');
INSERT INTO `shop_city` VALUES ('184', '430100', '长沙市');
INSERT INTO `shop_city` VALUES ('185', '430200', '株洲市');
INSERT INTO `shop_city` VALUES ('186', '430300', '湘潭市');
INSERT INTO `shop_city` VALUES ('187', '430400', '衡阳市');
INSERT INTO `shop_city` VALUES ('188', '430500', '邵阳市');
INSERT INTO `shop_city` VALUES ('189', '430600', '岳阳市');
INSERT INTO `shop_city` VALUES ('190', '430700', '常德市');
INSERT INTO `shop_city` VALUES ('191', '430800', '张家界市');
INSERT INTO `shop_city` VALUES ('192', '430900', '益阳市');
INSERT INTO `shop_city` VALUES ('193', '431000', '郴州市');
INSERT INTO `shop_city` VALUES ('194', '431100', '永州市');
INSERT INTO `shop_city` VALUES ('195', '431200', '怀化市');
INSERT INTO `shop_city` VALUES ('196', '431300', '娄底市');
INSERT INTO `shop_city` VALUES ('197', '433100', '湘西土家族苗族自治州');
INSERT INTO `shop_city` VALUES ('198', '440100', '广州市');
INSERT INTO `shop_city` VALUES ('199', '440200', '韶关市');
INSERT INTO `shop_city` VALUES ('200', '440300', '深圳市');
INSERT INTO `shop_city` VALUES ('201', '440400', '珠海市');
INSERT INTO `shop_city` VALUES ('202', '440500', '汕头市');
INSERT INTO `shop_city` VALUES ('203', '440600', '佛山市');
INSERT INTO `shop_city` VALUES ('204', '440700', '江门市');
INSERT INTO `shop_city` VALUES ('205', '440800', '湛江市');
INSERT INTO `shop_city` VALUES ('206', '440900', '茂名市');
INSERT INTO `shop_city` VALUES ('207', '441200', '肇庆市');
INSERT INTO `shop_city` VALUES ('208', '441300', '惠州市');
INSERT INTO `shop_city` VALUES ('209', '441400', '梅州市');
INSERT INTO `shop_city` VALUES ('210', '441500', '汕尾市');
INSERT INTO `shop_city` VALUES ('211', '441600', '河源市');
INSERT INTO `shop_city` VALUES ('212', '441700', '阳江市');
INSERT INTO `shop_city` VALUES ('213', '441800', '清远市');
INSERT INTO `shop_city` VALUES ('214', '441900', '东莞市');
INSERT INTO `shop_city` VALUES ('215', '442000', '中山市');
INSERT INTO `shop_city` VALUES ('216', '445100', '潮州市');
INSERT INTO `shop_city` VALUES ('217', '445200', '揭阳市');
INSERT INTO `shop_city` VALUES ('218', '445300', '云浮市');
INSERT INTO `shop_city` VALUES ('219', '450100', '南宁市');
INSERT INTO `shop_city` VALUES ('220', '450200', '柳州市');
INSERT INTO `shop_city` VALUES ('221', '450300', '桂林市');
INSERT INTO `shop_city` VALUES ('222', '450400', '梧州市');
INSERT INTO `shop_city` VALUES ('223', '450500', '北海市');
INSERT INTO `shop_city` VALUES ('224', '450600', '防城港市');
INSERT INTO `shop_city` VALUES ('225', '450700', '钦州市');
INSERT INTO `shop_city` VALUES ('226', '450800', '贵港市');
INSERT INTO `shop_city` VALUES ('227', '450900', '玉林市');
INSERT INTO `shop_city` VALUES ('228', '451000', '百色市');
INSERT INTO `shop_city` VALUES ('229', '451100', '贺州市');
INSERT INTO `shop_city` VALUES ('230', '451200', '河池市');
INSERT INTO `shop_city` VALUES ('231', '451300', '来宾市');
INSERT INTO `shop_city` VALUES ('232', '451400', '崇左市');
INSERT INTO `shop_city` VALUES ('233', '460100', '海口市');
INSERT INTO `shop_city` VALUES ('234', '460200', '三亚市');
INSERT INTO `shop_city` VALUES ('235', '460300', '三沙市');
INSERT INTO `shop_city` VALUES ('236', '460400', '儋州市');
INSERT INTO `shop_city` VALUES ('237', '469000', '省直辖县');
INSERT INTO `shop_city` VALUES ('238', '500100', '重庆市');
INSERT INTO `shop_city` VALUES ('239', '500200', '县');
INSERT INTO `shop_city` VALUES ('240', '510100', '成都市');
INSERT INTO `shop_city` VALUES ('241', '510300', '自贡市');
INSERT INTO `shop_city` VALUES ('242', '510400', '攀枝花市');
INSERT INTO `shop_city` VALUES ('243', '510500', '泸州市');
INSERT INTO `shop_city` VALUES ('244', '510600', '德阳市');
INSERT INTO `shop_city` VALUES ('245', '510700', '绵阳市');
INSERT INTO `shop_city` VALUES ('246', '510800', '广元市');
INSERT INTO `shop_city` VALUES ('247', '510900', '遂宁市');
INSERT INTO `shop_city` VALUES ('248', '511000', '内江市');
INSERT INTO `shop_city` VALUES ('249', '511100', '乐山市');
INSERT INTO `shop_city` VALUES ('250', '511300', '南充市');
INSERT INTO `shop_city` VALUES ('251', '511400', '眉山市');
INSERT INTO `shop_city` VALUES ('252', '511500', '宜宾市');
INSERT INTO `shop_city` VALUES ('253', '511600', '广安市');
INSERT INTO `shop_city` VALUES ('254', '511700', '达州市');
INSERT INTO `shop_city` VALUES ('255', '511800', '雅安市');
INSERT INTO `shop_city` VALUES ('256', '511900', '巴中市');
INSERT INTO `shop_city` VALUES ('257', '512000', '资阳市');
INSERT INTO `shop_city` VALUES ('258', '513200', '阿坝藏族羌族自治州');
INSERT INTO `shop_city` VALUES ('259', '513300', '甘孜藏族自治州');
INSERT INTO `shop_city` VALUES ('260', '513400', '凉山彝族自治州');
INSERT INTO `shop_city` VALUES ('261', '520100', '贵阳市');
INSERT INTO `shop_city` VALUES ('262', '520200', '六盘水市');
INSERT INTO `shop_city` VALUES ('263', '520300', '遵义市');
INSERT INTO `shop_city` VALUES ('264', '520400', '安顺市');
INSERT INTO `shop_city` VALUES ('265', '520500', '毕节市');
INSERT INTO `shop_city` VALUES ('266', '520600', '铜仁市');
INSERT INTO `shop_city` VALUES ('267', '522300', '黔西南布依族苗族自治州');
INSERT INTO `shop_city` VALUES ('268', '522600', '黔东南苗族侗族自治州');
INSERT INTO `shop_city` VALUES ('269', '522700', '黔南布依族苗族自治州');
INSERT INTO `shop_city` VALUES ('270', '530100', '昆明市');
INSERT INTO `shop_city` VALUES ('271', '530300', '曲靖市');
INSERT INTO `shop_city` VALUES ('272', '530400', '玉溪市');
INSERT INTO `shop_city` VALUES ('273', '530500', '保山市');
INSERT INTO `shop_city` VALUES ('274', '530600', '昭通市');
INSERT INTO `shop_city` VALUES ('275', '530700', '丽江市');
INSERT INTO `shop_city` VALUES ('276', '530800', '普洱市');
INSERT INTO `shop_city` VALUES ('277', '530900', '临沧市');
INSERT INTO `shop_city` VALUES ('278', '532300', '楚雄彝族自治州');
INSERT INTO `shop_city` VALUES ('279', '532500', '红河哈尼族彝族自治州');
INSERT INTO `shop_city` VALUES ('280', '532600', '文山壮族苗族自治州');
INSERT INTO `shop_city` VALUES ('281', '532800', '西双版纳傣族自治州');
INSERT INTO `shop_city` VALUES ('282', '532900', '大理白族自治州');
INSERT INTO `shop_city` VALUES ('283', '533100', '德宏傣族景颇族自治州');
INSERT INTO `shop_city` VALUES ('284', '533300', '怒江傈僳族自治州');
INSERT INTO `shop_city` VALUES ('285', '533400', '迪庆藏族自治州');
INSERT INTO `shop_city` VALUES ('286', '540100', '拉萨市');
INSERT INTO `shop_city` VALUES ('287', '540200', '日喀则市');
INSERT INTO `shop_city` VALUES ('288', '540300', '昌都市');
INSERT INTO `shop_city` VALUES ('289', '540400', '林芝市');
INSERT INTO `shop_city` VALUES ('290', '540500', '山南市');
INSERT INTO `shop_city` VALUES ('291', '540600', '那曲市');
INSERT INTO `shop_city` VALUES ('292', '542500', '阿里地区');
INSERT INTO `shop_city` VALUES ('293', '610100', '西安市');
INSERT INTO `shop_city` VALUES ('294', '610200', '铜川市');
INSERT INTO `shop_city` VALUES ('295', '610300', '宝鸡市');
INSERT INTO `shop_city` VALUES ('296', '610400', '咸阳市');
INSERT INTO `shop_city` VALUES ('297', '610500', '渭南市');
INSERT INTO `shop_city` VALUES ('298', '610600', '延安市');
INSERT INTO `shop_city` VALUES ('299', '610700', '汉中市');
INSERT INTO `shop_city` VALUES ('300', '610800', '榆林市');
INSERT INTO `shop_city` VALUES ('301', '610900', '安康市');
INSERT INTO `shop_city` VALUES ('302', '611000', '商洛市');
INSERT INTO `shop_city` VALUES ('303', '620100', '兰州市');
INSERT INTO `shop_city` VALUES ('304', '620200', '嘉峪关市');
INSERT INTO `shop_city` VALUES ('305', '620300', '金昌市');
INSERT INTO `shop_city` VALUES ('306', '620400', '白银市');
INSERT INTO `shop_city` VALUES ('307', '620500', '天水市');
INSERT INTO `shop_city` VALUES ('308', '620600', '武威市');
INSERT INTO `shop_city` VALUES ('309', '620700', '张掖市');
INSERT INTO `shop_city` VALUES ('310', '620800', '平凉市');
INSERT INTO `shop_city` VALUES ('311', '620900', '酒泉市');
INSERT INTO `shop_city` VALUES ('312', '621000', '庆阳市');
INSERT INTO `shop_city` VALUES ('313', '621100', '定西市');
INSERT INTO `shop_city` VALUES ('314', '621200', '陇南市');
INSERT INTO `shop_city` VALUES ('315', '622900', '临夏回族自治州');
INSERT INTO `shop_city` VALUES ('316', '623000', '甘南藏族自治州');
INSERT INTO `shop_city` VALUES ('317', '630100', '西宁市');
INSERT INTO `shop_city` VALUES ('318', '630200', '海东市');
INSERT INTO `shop_city` VALUES ('319', '632200', '海北藏族自治州');
INSERT INTO `shop_city` VALUES ('320', '632300', '黄南藏族自治州');
INSERT INTO `shop_city` VALUES ('321', '632500', '海南藏族自治州');
INSERT INTO `shop_city` VALUES ('322', '632600', '果洛藏族自治州');
INSERT INTO `shop_city` VALUES ('323', '632700', '玉树藏族自治州');
INSERT INTO `shop_city` VALUES ('324', '632800', '海西蒙古族藏族自治州');
INSERT INTO `shop_city` VALUES ('325', '640100', '银川市');
INSERT INTO `shop_city` VALUES ('326', '640200', '石嘴山市');
INSERT INTO `shop_city` VALUES ('327', '640300', '吴忠市');
INSERT INTO `shop_city` VALUES ('328', '640400', '固原市');
INSERT INTO `shop_city` VALUES ('329', '640500', '中卫市');
INSERT INTO `shop_city` VALUES ('330', '650100', '乌鲁木齐市');
INSERT INTO `shop_city` VALUES ('331', '650200', '克拉玛依市');
INSERT INTO `shop_city` VALUES ('332', '650400', '吐鲁番市');
INSERT INTO `shop_city` VALUES ('333', '650500', '哈密市');
INSERT INTO `shop_city` VALUES ('334', '652300', '昌吉回族自治州');
INSERT INTO `shop_city` VALUES ('335', '652700', '博尔塔拉蒙古自治州');
INSERT INTO `shop_city` VALUES ('336', '652800', '巴音郭楞蒙古自治州');
INSERT INTO `shop_city` VALUES ('337', '652900', '阿克苏地区');
INSERT INTO `shop_city` VALUES ('338', '653000', '克孜勒苏柯尔克孜自治州');
INSERT INTO `shop_city` VALUES ('339', '653100', '喀什地区');
INSERT INTO `shop_city` VALUES ('340', '653200', '和田地区');
INSERT INTO `shop_city` VALUES ('341', '654000', '伊犁哈萨克自治州');
INSERT INTO `shop_city` VALUES ('342', '654200', '塔城地区');
INSERT INTO `shop_city` VALUES ('343', '654300', '阿勒泰地区');
INSERT INTO `shop_city` VALUES ('344', '659000', '自治区直辖县级行政区划');
INSERT INTO `shop_city` VALUES ('345', '710100', '台北市');
INSERT INTO `shop_city` VALUES ('346', '710200', '高雄市');
INSERT INTO `shop_city` VALUES ('347', '710300', '台南市');
INSERT INTO `shop_city` VALUES ('348', '710400', '台中市');
INSERT INTO `shop_city` VALUES ('349', '710500', '金门县');
INSERT INTO `shop_city` VALUES ('350', '710600', '南投县');
INSERT INTO `shop_city` VALUES ('351', '710700', '基隆市');
INSERT INTO `shop_city` VALUES ('352', '710800', '新竹市');
INSERT INTO `shop_city` VALUES ('353', '710900', '嘉义市');
INSERT INTO `shop_city` VALUES ('354', '711100', '新北市');
INSERT INTO `shop_city` VALUES ('355', '711200', '宜兰县');
INSERT INTO `shop_city` VALUES ('356', '711300', '新竹县');
INSERT INTO `shop_city` VALUES ('357', '711400', '桃园县');
INSERT INTO `shop_city` VALUES ('358', '711500', '苗栗县');
INSERT INTO `shop_city` VALUES ('359', '711700', '彰化县');
INSERT INTO `shop_city` VALUES ('360', '711900', '嘉义县');
INSERT INTO `shop_city` VALUES ('361', '712100', '云林县');
INSERT INTO `shop_city` VALUES ('362', '712400', '屏东县');
INSERT INTO `shop_city` VALUES ('363', '712500', '台东县');
INSERT INTO `shop_city` VALUES ('364', '712600', '花莲县');
INSERT INTO `shop_city` VALUES ('365', '712700', '澎湖县');
INSERT INTO `shop_city` VALUES ('366', '712800', '连江县');
INSERT INTO `shop_city` VALUES ('367', '810100', '香港岛');
INSERT INTO `shop_city` VALUES ('368', '810200', '九龙');
INSERT INTO `shop_city` VALUES ('369', '810300', '新界');
INSERT INTO `shop_city` VALUES ('370', '820100', '澳门半岛');
INSERT INTO `shop_city` VALUES ('371', '820200', '离岛');

-- ----------------------------
-- Table structure for shop_county
-- ----------------------------
DROP TABLE IF EXISTS `shop_county`;
CREATE TABLE `shop_county` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wx_code` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3368 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of shop_county
-- ----------------------------
INSERT INTO `shop_county` VALUES ('1', '110101', '东城区');
INSERT INTO `shop_county` VALUES ('2', '110102', '西城区');
INSERT INTO `shop_county` VALUES ('3', '110105', '朝阳区');
INSERT INTO `shop_county` VALUES ('4', '110106', '丰台区');
INSERT INTO `shop_county` VALUES ('5', '110107', '石景山区');
INSERT INTO `shop_county` VALUES ('6', '110108', '海淀区');
INSERT INTO `shop_county` VALUES ('7', '110109', '门头沟区');
INSERT INTO `shop_county` VALUES ('8', '110111', '房山区');
INSERT INTO `shop_county` VALUES ('9', '110112', '通州区');
INSERT INTO `shop_county` VALUES ('10', '110113', '顺义区');
INSERT INTO `shop_county` VALUES ('11', '110114', '昌平区');
INSERT INTO `shop_county` VALUES ('12', '110115', '大兴区');
INSERT INTO `shop_county` VALUES ('13', '110116', '怀柔区');
INSERT INTO `shop_county` VALUES ('14', '110117', '平谷区');
INSERT INTO `shop_county` VALUES ('15', '110118', '密云区');
INSERT INTO `shop_county` VALUES ('16', '110119', '延庆区');
INSERT INTO `shop_county` VALUES ('17', '120101', '和平区');
INSERT INTO `shop_county` VALUES ('18', '120102', '河东区');
INSERT INTO `shop_county` VALUES ('19', '120103', '河西区');
INSERT INTO `shop_county` VALUES ('20', '120104', '南开区');
INSERT INTO `shop_county` VALUES ('21', '120105', '河北区');
INSERT INTO `shop_county` VALUES ('22', '120106', '红桥区');
INSERT INTO `shop_county` VALUES ('23', '120110', '东丽区');
INSERT INTO `shop_county` VALUES ('24', '120111', '西青区');
INSERT INTO `shop_county` VALUES ('25', '120112', '津南区');
INSERT INTO `shop_county` VALUES ('26', '120113', '北辰区');
INSERT INTO `shop_county` VALUES ('27', '120114', '武清区');
INSERT INTO `shop_county` VALUES ('28', '120115', '宝坻区');
INSERT INTO `shop_county` VALUES ('29', '120116', '滨海新区');
INSERT INTO `shop_county` VALUES ('30', '120117', '宁河区');
INSERT INTO `shop_county` VALUES ('31', '120118', '静海区');
INSERT INTO `shop_county` VALUES ('32', '120119', '蓟州区');
INSERT INTO `shop_county` VALUES ('33', '130102', '长安区');
INSERT INTO `shop_county` VALUES ('34', '130104', '桥西区');
INSERT INTO `shop_county` VALUES ('35', '130105', '新华区');
INSERT INTO `shop_county` VALUES ('36', '130107', '井陉矿区');
INSERT INTO `shop_county` VALUES ('37', '130108', '裕华区');
INSERT INTO `shop_county` VALUES ('38', '130109', '藁城区');
INSERT INTO `shop_county` VALUES ('39', '130110', '鹿泉区');
INSERT INTO `shop_county` VALUES ('40', '130111', '栾城区');
INSERT INTO `shop_county` VALUES ('41', '130121', '井陉县');
INSERT INTO `shop_county` VALUES ('42', '130123', '正定县');
INSERT INTO `shop_county` VALUES ('43', '130125', '行唐县');
INSERT INTO `shop_county` VALUES ('44', '130126', '灵寿县');
INSERT INTO `shop_county` VALUES ('45', '130127', '高邑县');
INSERT INTO `shop_county` VALUES ('46', '130128', '深泽县');
INSERT INTO `shop_county` VALUES ('47', '130129', '赞皇县');
INSERT INTO `shop_county` VALUES ('48', '130130', '无极县');
INSERT INTO `shop_county` VALUES ('49', '130131', '平山县');
INSERT INTO `shop_county` VALUES ('50', '130132', '元氏县');
INSERT INTO `shop_county` VALUES ('51', '130133', '赵县');
INSERT INTO `shop_county` VALUES ('52', '130181', '辛集市');
INSERT INTO `shop_county` VALUES ('53', '130183', '晋州市');
INSERT INTO `shop_county` VALUES ('54', '130184', '新乐市');
INSERT INTO `shop_county` VALUES ('55', '130202', '路南区');
INSERT INTO `shop_county` VALUES ('56', '130203', '路北区');
INSERT INTO `shop_county` VALUES ('57', '130204', '古冶区');
INSERT INTO `shop_county` VALUES ('58', '130205', '开平区');
INSERT INTO `shop_county` VALUES ('59', '130207', '丰南区');
INSERT INTO `shop_county` VALUES ('60', '130208', '丰润区');
INSERT INTO `shop_county` VALUES ('61', '130209', '曹妃甸区');
INSERT INTO `shop_county` VALUES ('62', '130223', '滦县');
INSERT INTO `shop_county` VALUES ('63', '130224', '滦南县');
INSERT INTO `shop_county` VALUES ('64', '130225', '乐亭县');
INSERT INTO `shop_county` VALUES ('65', '130227', '迁西县');
INSERT INTO `shop_county` VALUES ('66', '130229', '玉田县');
INSERT INTO `shop_county` VALUES ('67', '130281', '遵化市');
INSERT INTO `shop_county` VALUES ('68', '130283', '迁安市');
INSERT INTO `shop_county` VALUES ('69', '130302', '海港区');
INSERT INTO `shop_county` VALUES ('70', '130303', '山海关区');
INSERT INTO `shop_county` VALUES ('71', '130304', '北戴河区');
INSERT INTO `shop_county` VALUES ('72', '130306', '抚宁区');
INSERT INTO `shop_county` VALUES ('73', '130321', '青龙满族自治县');
INSERT INTO `shop_county` VALUES ('74', '130322', '昌黎县');
INSERT INTO `shop_county` VALUES ('75', '130324', '卢龙县');
INSERT INTO `shop_county` VALUES ('76', '130390', '经济技术开发区');
INSERT INTO `shop_county` VALUES ('77', '130402', '邯山区');
INSERT INTO `shop_county` VALUES ('78', '130403', '丛台区');
INSERT INTO `shop_county` VALUES ('79', '130404', '复兴区');
INSERT INTO `shop_county` VALUES ('80', '130406', '峰峰矿区');
INSERT INTO `shop_county` VALUES ('81', '130407', '肥乡区');
INSERT INTO `shop_county` VALUES ('82', '130408', '永年区');
INSERT INTO `shop_county` VALUES ('83', '130423', '临漳县');
INSERT INTO `shop_county` VALUES ('84', '130424', '成安县');
INSERT INTO `shop_county` VALUES ('85', '130425', '大名县');
INSERT INTO `shop_county` VALUES ('86', '130426', '涉县');
INSERT INTO `shop_county` VALUES ('87', '130427', '磁县');
INSERT INTO `shop_county` VALUES ('88', '130430', '邱县');
INSERT INTO `shop_county` VALUES ('89', '130431', '鸡泽县');
INSERT INTO `shop_county` VALUES ('90', '130432', '广平县');
INSERT INTO `shop_county` VALUES ('91', '130433', '馆陶县');
INSERT INTO `shop_county` VALUES ('92', '130434', '魏县');
INSERT INTO `shop_county` VALUES ('93', '130435', '曲周县');
INSERT INTO `shop_county` VALUES ('94', '130481', '武安市');
INSERT INTO `shop_county` VALUES ('95', '130502', '桥东区');
INSERT INTO `shop_county` VALUES ('96', '130503', '桥西区');
INSERT INTO `shop_county` VALUES ('97', '130521', '邢台县');
INSERT INTO `shop_county` VALUES ('98', '130522', '临城县');
INSERT INTO `shop_county` VALUES ('99', '130523', '内丘县');
INSERT INTO `shop_county` VALUES ('100', '130524', '柏乡县');
INSERT INTO `shop_county` VALUES ('101', '130525', '隆尧县');
INSERT INTO `shop_county` VALUES ('102', '130526', '任县');
INSERT INTO `shop_county` VALUES ('103', '130527', '南和县');
INSERT INTO `shop_county` VALUES ('104', '130528', '宁晋县');
INSERT INTO `shop_county` VALUES ('105', '130529', '巨鹿县');
INSERT INTO `shop_county` VALUES ('106', '130530', '新河县');
INSERT INTO `shop_county` VALUES ('107', '130531', '广宗县');
INSERT INTO `shop_county` VALUES ('108', '130532', '平乡县');
INSERT INTO `shop_county` VALUES ('109', '130533', '威县');
INSERT INTO `shop_county` VALUES ('110', '130534', '清河县');
INSERT INTO `shop_county` VALUES ('111', '130535', '临西县');
INSERT INTO `shop_county` VALUES ('112', '130581', '南宫市');
INSERT INTO `shop_county` VALUES ('113', '130582', '沙河市');
INSERT INTO `shop_county` VALUES ('114', '130602', '竞秀区');
INSERT INTO `shop_county` VALUES ('115', '130606', '莲池区');
INSERT INTO `shop_county` VALUES ('116', '130607', '满城区');
INSERT INTO `shop_county` VALUES ('117', '130608', '清苑区');
INSERT INTO `shop_county` VALUES ('118', '130609', '徐水区');
INSERT INTO `shop_county` VALUES ('119', '130623', '涞水县');
INSERT INTO `shop_county` VALUES ('120', '130624', '阜平县');
INSERT INTO `shop_county` VALUES ('121', '130626', '定兴县');
INSERT INTO `shop_county` VALUES ('122', '130627', '唐县');
INSERT INTO `shop_county` VALUES ('123', '130628', '高阳县');
INSERT INTO `shop_county` VALUES ('124', '130629', '容城县');
INSERT INTO `shop_county` VALUES ('125', '130630', '涞源县');
INSERT INTO `shop_county` VALUES ('126', '130631', '望都县');
INSERT INTO `shop_county` VALUES ('127', '130632', '安新县');
INSERT INTO `shop_county` VALUES ('128', '130633', '易县');
INSERT INTO `shop_county` VALUES ('129', '130634', '曲阳县');
INSERT INTO `shop_county` VALUES ('130', '130635', '蠡县');
INSERT INTO `shop_county` VALUES ('131', '130636', '顺平县');
INSERT INTO `shop_county` VALUES ('132', '130637', '博野县');
INSERT INTO `shop_county` VALUES ('133', '130638', '雄县');
INSERT INTO `shop_county` VALUES ('134', '130681', '涿州市');
INSERT INTO `shop_county` VALUES ('135', '130682', '定州市');
INSERT INTO `shop_county` VALUES ('136', '130683', '安国市');
INSERT INTO `shop_county` VALUES ('137', '130684', '高碑店市');
INSERT INTO `shop_county` VALUES ('138', '130702', '桥东区');
INSERT INTO `shop_county` VALUES ('139', '130703', '桥西区');
INSERT INTO `shop_county` VALUES ('140', '130705', '宣化区');
INSERT INTO `shop_county` VALUES ('141', '130706', '下花园区');
INSERT INTO `shop_county` VALUES ('142', '130708', '万全区');
INSERT INTO `shop_county` VALUES ('143', '130709', '崇礼区');
INSERT INTO `shop_county` VALUES ('144', '130722', '张北县');
INSERT INTO `shop_county` VALUES ('145', '130723', '康保县');
INSERT INTO `shop_county` VALUES ('146', '130724', '沽源县');
INSERT INTO `shop_county` VALUES ('147', '130725', '尚义县');
INSERT INTO `shop_county` VALUES ('148', '130726', '蔚县');
INSERT INTO `shop_county` VALUES ('149', '130727', '阳原县');
INSERT INTO `shop_county` VALUES ('150', '130728', '怀安县');
INSERT INTO `shop_county` VALUES ('151', '130730', '怀来县');
INSERT INTO `shop_county` VALUES ('152', '130731', '涿鹿县');
INSERT INTO `shop_county` VALUES ('153', '130732', '赤城县');
INSERT INTO `shop_county` VALUES ('154', '130802', '双桥区');
INSERT INTO `shop_county` VALUES ('155', '130803', '双滦区');
INSERT INTO `shop_county` VALUES ('156', '130804', '鹰手营子矿区');
INSERT INTO `shop_county` VALUES ('157', '130821', '承德县');
INSERT INTO `shop_county` VALUES ('158', '130822', '兴隆县');
INSERT INTO `shop_county` VALUES ('159', '130824', '滦平县');
INSERT INTO `shop_county` VALUES ('160', '130825', '隆化县');
INSERT INTO `shop_county` VALUES ('161', '130826', '丰宁满族自治县');
INSERT INTO `shop_county` VALUES ('162', '130827', '宽城满族自治县');
INSERT INTO `shop_county` VALUES ('163', '130828', '围场满族蒙古族自治县');
INSERT INTO `shop_county` VALUES ('164', '130881', '平泉市');
INSERT INTO `shop_county` VALUES ('165', '130902', '新华区');
INSERT INTO `shop_county` VALUES ('166', '130903', '运河区');
INSERT INTO `shop_county` VALUES ('167', '130921', '沧县');
INSERT INTO `shop_county` VALUES ('168', '130922', '青县');
INSERT INTO `shop_county` VALUES ('169', '130923', '东光县');
INSERT INTO `shop_county` VALUES ('170', '130924', '海兴县');
INSERT INTO `shop_county` VALUES ('171', '130925', '盐山县');
INSERT INTO `shop_county` VALUES ('172', '130926', '肃宁县');
INSERT INTO `shop_county` VALUES ('173', '130927', '南皮县');
INSERT INTO `shop_county` VALUES ('174', '130928', '吴桥县');
INSERT INTO `shop_county` VALUES ('175', '130929', '献县');
INSERT INTO `shop_county` VALUES ('176', '130930', '孟村回族自治县');
INSERT INTO `shop_county` VALUES ('177', '130981', '泊头市');
INSERT INTO `shop_county` VALUES ('178', '130982', '任丘市');
INSERT INTO `shop_county` VALUES ('179', '130983', '黄骅市');
INSERT INTO `shop_county` VALUES ('180', '130984', '河间市');
INSERT INTO `shop_county` VALUES ('181', '131002', '安次区');
INSERT INTO `shop_county` VALUES ('182', '131003', '广阳区');
INSERT INTO `shop_county` VALUES ('183', '131022', '固安县');
INSERT INTO `shop_county` VALUES ('184', '131023', '永清县');
INSERT INTO `shop_county` VALUES ('185', '131024', '香河县');
INSERT INTO `shop_county` VALUES ('186', '131025', '大城县');
INSERT INTO `shop_county` VALUES ('187', '131026', '文安县');
INSERT INTO `shop_county` VALUES ('188', '131028', '大厂回族自治县');
INSERT INTO `shop_county` VALUES ('189', '131081', '霸州市');
INSERT INTO `shop_county` VALUES ('190', '131082', '三河市');
INSERT INTO `shop_county` VALUES ('191', '131090', '开发区');
INSERT INTO `shop_county` VALUES ('192', '131102', '桃城区');
INSERT INTO `shop_county` VALUES ('193', '131103', '冀州区');
INSERT INTO `shop_county` VALUES ('194', '131121', '枣强县');
INSERT INTO `shop_county` VALUES ('195', '131122', '武邑县');
INSERT INTO `shop_county` VALUES ('196', '131123', '武强县');
INSERT INTO `shop_county` VALUES ('197', '131124', '饶阳县');
INSERT INTO `shop_county` VALUES ('198', '131125', '安平县');
INSERT INTO `shop_county` VALUES ('199', '131126', '故城县');
INSERT INTO `shop_county` VALUES ('200', '131127', '景县');
INSERT INTO `shop_county` VALUES ('201', '131128', '阜城县');
INSERT INTO `shop_county` VALUES ('202', '131182', '深州市');
INSERT INTO `shop_county` VALUES ('203', '140105', '小店区');
INSERT INTO `shop_county` VALUES ('204', '140106', '迎泽区');
INSERT INTO `shop_county` VALUES ('205', '140107', '杏花岭区');
INSERT INTO `shop_county` VALUES ('206', '140108', '尖草坪区');
INSERT INTO `shop_county` VALUES ('207', '140109', '万柏林区');
INSERT INTO `shop_county` VALUES ('208', '140110', '晋源区');
INSERT INTO `shop_county` VALUES ('209', '140121', '清徐县');
INSERT INTO `shop_county` VALUES ('210', '140122', '阳曲县');
INSERT INTO `shop_county` VALUES ('211', '140123', '娄烦县');
INSERT INTO `shop_county` VALUES ('212', '140181', '古交市');
INSERT INTO `shop_county` VALUES ('213', '140202', '城区');
INSERT INTO `shop_county` VALUES ('214', '140203', '矿区');
INSERT INTO `shop_county` VALUES ('215', '140211', '南郊区');
INSERT INTO `shop_county` VALUES ('216', '140212', '新荣区');
INSERT INTO `shop_county` VALUES ('217', '140221', '阳高县');
INSERT INTO `shop_county` VALUES ('218', '140222', '天镇县');
INSERT INTO `shop_county` VALUES ('219', '140223', '广灵县');
INSERT INTO `shop_county` VALUES ('220', '140224', '灵丘县');
INSERT INTO `shop_county` VALUES ('221', '140225', '浑源县');
INSERT INTO `shop_county` VALUES ('222', '140226', '左云县');
INSERT INTO `shop_county` VALUES ('223', '140227', '大同县');
INSERT INTO `shop_county` VALUES ('224', '140302', '城区');
INSERT INTO `shop_county` VALUES ('225', '140303', '矿区');
INSERT INTO `shop_county` VALUES ('226', '140311', '郊区');
INSERT INTO `shop_county` VALUES ('227', '140321', '平定县');
INSERT INTO `shop_county` VALUES ('228', '140322', '盂县');
INSERT INTO `shop_county` VALUES ('229', '140402', '城区');
INSERT INTO `shop_county` VALUES ('230', '140411', '郊区');
INSERT INTO `shop_county` VALUES ('231', '140421', '长治县');
INSERT INTO `shop_county` VALUES ('232', '140423', '襄垣县');
INSERT INTO `shop_county` VALUES ('233', '140424', '屯留县');
INSERT INTO `shop_county` VALUES ('234', '140425', '平顺县');
INSERT INTO `shop_county` VALUES ('235', '140426', '黎城县');
INSERT INTO `shop_county` VALUES ('236', '140427', '壶关县');
INSERT INTO `shop_county` VALUES ('237', '140428', '长子县');
INSERT INTO `shop_county` VALUES ('238', '140429', '武乡县');
INSERT INTO `shop_county` VALUES ('239', '140430', '沁县');
INSERT INTO `shop_county` VALUES ('240', '140431', '沁源县');
INSERT INTO `shop_county` VALUES ('241', '140481', '潞城市');
INSERT INTO `shop_county` VALUES ('242', '140502', '城区');
INSERT INTO `shop_county` VALUES ('243', '140521', '沁水县');
INSERT INTO `shop_county` VALUES ('244', '140522', '阳城县');
INSERT INTO `shop_county` VALUES ('245', '140524', '陵川县');
INSERT INTO `shop_county` VALUES ('246', '140525', '泽州县');
INSERT INTO `shop_county` VALUES ('247', '140581', '高平市');
INSERT INTO `shop_county` VALUES ('248', '140602', '朔城区');
INSERT INTO `shop_county` VALUES ('249', '140603', '平鲁区');
INSERT INTO `shop_county` VALUES ('250', '140621', '山阴县');
INSERT INTO `shop_county` VALUES ('251', '140622', '应县');
INSERT INTO `shop_county` VALUES ('252', '140623', '右玉县');
INSERT INTO `shop_county` VALUES ('253', '140624', '怀仁县');
INSERT INTO `shop_county` VALUES ('254', '140702', '榆次区');
INSERT INTO `shop_county` VALUES ('255', '140721', '榆社县');
INSERT INTO `shop_county` VALUES ('256', '140722', '左权县');
INSERT INTO `shop_county` VALUES ('257', '140723', '和顺县');
INSERT INTO `shop_county` VALUES ('258', '140724', '昔阳县');
INSERT INTO `shop_county` VALUES ('259', '140725', '寿阳县');
INSERT INTO `shop_county` VALUES ('260', '140726', '太谷县');
INSERT INTO `shop_county` VALUES ('261', '140727', '祁县');
INSERT INTO `shop_county` VALUES ('262', '140728', '平遥县');
INSERT INTO `shop_county` VALUES ('263', '140729', '灵石县');
INSERT INTO `shop_county` VALUES ('264', '140781', '介休市');
INSERT INTO `shop_county` VALUES ('265', '140802', '盐湖区');
INSERT INTO `shop_county` VALUES ('266', '140821', '临猗县');
INSERT INTO `shop_county` VALUES ('267', '140822', '万荣县');
INSERT INTO `shop_county` VALUES ('268', '140823', '闻喜县');
INSERT INTO `shop_county` VALUES ('269', '140824', '稷山县');
INSERT INTO `shop_county` VALUES ('270', '140825', '新绛县');
INSERT INTO `shop_county` VALUES ('271', '140826', '绛县');
INSERT INTO `shop_county` VALUES ('272', '140827', '垣曲县');
INSERT INTO `shop_county` VALUES ('273', '140828', '夏县');
INSERT INTO `shop_county` VALUES ('274', '140829', '平陆县');
INSERT INTO `shop_county` VALUES ('275', '140830', '芮城县');
INSERT INTO `shop_county` VALUES ('276', '140881', '永济市');
INSERT INTO `shop_county` VALUES ('277', '140882', '河津市');
INSERT INTO `shop_county` VALUES ('278', '140902', '忻府区');
INSERT INTO `shop_county` VALUES ('279', '140921', '定襄县');
INSERT INTO `shop_county` VALUES ('280', '140922', '五台县');
INSERT INTO `shop_county` VALUES ('281', '140923', '代县');
INSERT INTO `shop_county` VALUES ('282', '140924', '繁峙县');
INSERT INTO `shop_county` VALUES ('283', '140925', '宁武县');
INSERT INTO `shop_county` VALUES ('284', '140926', '静乐县');
INSERT INTO `shop_county` VALUES ('285', '140927', '神池县');
INSERT INTO `shop_county` VALUES ('286', '140928', '五寨县');
INSERT INTO `shop_county` VALUES ('287', '140929', '岢岚县');
INSERT INTO `shop_county` VALUES ('288', '140930', '河曲县');
INSERT INTO `shop_county` VALUES ('289', '140931', '保德县');
INSERT INTO `shop_county` VALUES ('290', '140932', '偏关县');
INSERT INTO `shop_county` VALUES ('291', '140981', '原平市');
INSERT INTO `shop_county` VALUES ('292', '141002', '尧都区');
INSERT INTO `shop_county` VALUES ('293', '141021', '曲沃县');
INSERT INTO `shop_county` VALUES ('294', '141022', '翼城县');
INSERT INTO `shop_county` VALUES ('295', '141023', '襄汾县');
INSERT INTO `shop_county` VALUES ('296', '141024', '洪洞县');
INSERT INTO `shop_county` VALUES ('297', '141025', '古县');
INSERT INTO `shop_county` VALUES ('298', '141026', '安泽县');
INSERT INTO `shop_county` VALUES ('299', '141027', '浮山县');
INSERT INTO `shop_county` VALUES ('300', '141028', '吉县');
INSERT INTO `shop_county` VALUES ('301', '141029', '乡宁县');
INSERT INTO `shop_county` VALUES ('302', '141030', '大宁县');
INSERT INTO `shop_county` VALUES ('303', '141031', '隰县');
INSERT INTO `shop_county` VALUES ('304', '141032', '永和县');
INSERT INTO `shop_county` VALUES ('305', '141033', '蒲县');
INSERT INTO `shop_county` VALUES ('306', '141034', '汾西县');
INSERT INTO `shop_county` VALUES ('307', '141081', '侯马市');
INSERT INTO `shop_county` VALUES ('308', '141082', '霍州市');
INSERT INTO `shop_county` VALUES ('309', '141102', '离石区');
INSERT INTO `shop_county` VALUES ('310', '141121', '文水县');
INSERT INTO `shop_county` VALUES ('311', '141122', '交城县');
INSERT INTO `shop_county` VALUES ('312', '141123', '兴县');
INSERT INTO `shop_county` VALUES ('313', '141124', '临县');
INSERT INTO `shop_county` VALUES ('314', '141125', '柳林县');
INSERT INTO `shop_county` VALUES ('315', '141126', '石楼县');
INSERT INTO `shop_county` VALUES ('316', '141127', '岚县');
INSERT INTO `shop_county` VALUES ('317', '141128', '方山县');
INSERT INTO `shop_county` VALUES ('318', '141129', '中阳县');
INSERT INTO `shop_county` VALUES ('319', '141130', '交口县');
INSERT INTO `shop_county` VALUES ('320', '141181', '孝义市');
INSERT INTO `shop_county` VALUES ('321', '141182', '汾阳市');
INSERT INTO `shop_county` VALUES ('322', '150102', '新城区');
INSERT INTO `shop_county` VALUES ('323', '150103', '回民区');
INSERT INTO `shop_county` VALUES ('324', '150104', '玉泉区');
INSERT INTO `shop_county` VALUES ('325', '150105', '赛罕区');
INSERT INTO `shop_county` VALUES ('326', '150121', '土默特左旗');
INSERT INTO `shop_county` VALUES ('327', '150122', '托克托县');
INSERT INTO `shop_county` VALUES ('328', '150123', '和林格尔县');
INSERT INTO `shop_county` VALUES ('329', '150124', '清水河县');
INSERT INTO `shop_county` VALUES ('330', '150125', '武川县');
INSERT INTO `shop_county` VALUES ('331', '150202', '东河区');
INSERT INTO `shop_county` VALUES ('332', '150203', '昆都仑区');
INSERT INTO `shop_county` VALUES ('333', '150204', '青山区');
INSERT INTO `shop_county` VALUES ('334', '150205', '石拐区');
INSERT INTO `shop_county` VALUES ('335', '150206', '白云鄂博矿区');
INSERT INTO `shop_county` VALUES ('336', '150207', '九原区');
INSERT INTO `shop_county` VALUES ('337', '150221', '土默特右旗');
INSERT INTO `shop_county` VALUES ('338', '150222', '固阳县');
INSERT INTO `shop_county` VALUES ('339', '150223', '达尔罕茂明安联合旗');
INSERT INTO `shop_county` VALUES ('340', '150302', '海勃湾区');
INSERT INTO `shop_county` VALUES ('341', '150303', '海南区');
INSERT INTO `shop_county` VALUES ('342', '150304', '乌达区');
INSERT INTO `shop_county` VALUES ('343', '150402', '红山区');
INSERT INTO `shop_county` VALUES ('344', '150403', '元宝山区');
INSERT INTO `shop_county` VALUES ('345', '150404', '松山区');
INSERT INTO `shop_county` VALUES ('346', '150421', '阿鲁科尔沁旗');
INSERT INTO `shop_county` VALUES ('347', '150422', '巴林左旗');
INSERT INTO `shop_county` VALUES ('348', '150423', '巴林右旗');
INSERT INTO `shop_county` VALUES ('349', '150424', '林西县');
INSERT INTO `shop_county` VALUES ('350', '150425', '克什克腾旗');
INSERT INTO `shop_county` VALUES ('351', '150426', '翁牛特旗');
INSERT INTO `shop_county` VALUES ('352', '150428', '喀喇沁旗');
INSERT INTO `shop_county` VALUES ('353', '150429', '宁城县');
INSERT INTO `shop_county` VALUES ('354', '150430', '敖汉旗');
INSERT INTO `shop_county` VALUES ('355', '150502', '科尔沁区');
INSERT INTO `shop_county` VALUES ('356', '150521', '科尔沁左翼中旗');
INSERT INTO `shop_county` VALUES ('357', '150522', '科尔沁左翼后旗');
INSERT INTO `shop_county` VALUES ('358', '150523', '开鲁县');
INSERT INTO `shop_county` VALUES ('359', '150524', '库伦旗');
INSERT INTO `shop_county` VALUES ('360', '150525', '奈曼旗');
INSERT INTO `shop_county` VALUES ('361', '150526', '扎鲁特旗');
INSERT INTO `shop_county` VALUES ('362', '150581', '霍林郭勒市');
INSERT INTO `shop_county` VALUES ('363', '150602', '东胜区');
INSERT INTO `shop_county` VALUES ('364', '150603', '康巴什区');
INSERT INTO `shop_county` VALUES ('365', '150621', '达拉特旗');
INSERT INTO `shop_county` VALUES ('366', '150622', '准格尔旗');
INSERT INTO `shop_county` VALUES ('367', '150623', '鄂托克前旗');
INSERT INTO `shop_county` VALUES ('368', '150624', '鄂托克旗');
INSERT INTO `shop_county` VALUES ('369', '150625', '杭锦旗');
INSERT INTO `shop_county` VALUES ('370', '150626', '乌审旗');
INSERT INTO `shop_county` VALUES ('371', '150627', '伊金霍洛旗');
INSERT INTO `shop_county` VALUES ('372', '150702', '海拉尔区');
INSERT INTO `shop_county` VALUES ('373', '150703', '扎赉诺尔区');
INSERT INTO `shop_county` VALUES ('374', '150721', '阿荣旗');
INSERT INTO `shop_county` VALUES ('375', '150722', '莫力达瓦达斡尔族自治旗');
INSERT INTO `shop_county` VALUES ('376', '150723', '鄂伦春自治旗');
INSERT INTO `shop_county` VALUES ('377', '150724', '鄂温克族自治旗');
INSERT INTO `shop_county` VALUES ('378', '150725', '陈巴尔虎旗');
INSERT INTO `shop_county` VALUES ('379', '150726', '新巴尔虎左旗');
INSERT INTO `shop_county` VALUES ('380', '150727', '新巴尔虎右旗');
INSERT INTO `shop_county` VALUES ('381', '150781', '满洲里市');
INSERT INTO `shop_county` VALUES ('382', '150782', '牙克石市');
INSERT INTO `shop_county` VALUES ('383', '150783', '扎兰屯市');
INSERT INTO `shop_county` VALUES ('384', '150784', '额尔古纳市');
INSERT INTO `shop_county` VALUES ('385', '150785', '根河市');
INSERT INTO `shop_county` VALUES ('386', '150802', '临河区');
INSERT INTO `shop_county` VALUES ('387', '150821', '五原县');
INSERT INTO `shop_county` VALUES ('388', '150822', '磴口县');
INSERT INTO `shop_county` VALUES ('389', '150823', '乌拉特前旗');
INSERT INTO `shop_county` VALUES ('390', '150824', '乌拉特中旗');
INSERT INTO `shop_county` VALUES ('391', '150825', '乌拉特后旗');
INSERT INTO `shop_county` VALUES ('392', '150826', '杭锦后旗');
INSERT INTO `shop_county` VALUES ('393', '150902', '集宁区');
INSERT INTO `shop_county` VALUES ('394', '150921', '卓资县');
INSERT INTO `shop_county` VALUES ('395', '150922', '化德县');
INSERT INTO `shop_county` VALUES ('396', '150923', '商都县');
INSERT INTO `shop_county` VALUES ('397', '150924', '兴和县');
INSERT INTO `shop_county` VALUES ('398', '150925', '凉城县');
INSERT INTO `shop_county` VALUES ('399', '150926', '察哈尔右翼前旗');
INSERT INTO `shop_county` VALUES ('400', '150927', '察哈尔右翼中旗');
INSERT INTO `shop_county` VALUES ('401', '150928', '察哈尔右翼后旗');
INSERT INTO `shop_county` VALUES ('402', '150929', '四子王旗');
INSERT INTO `shop_county` VALUES ('403', '150981', '丰镇市');
INSERT INTO `shop_county` VALUES ('404', '152201', '乌兰浩特市');
INSERT INTO `shop_county` VALUES ('405', '152202', '阿尔山市');
INSERT INTO `shop_county` VALUES ('406', '152221', '科尔沁右翼前旗');
INSERT INTO `shop_county` VALUES ('407', '152222', '科尔沁右翼中旗');
INSERT INTO `shop_county` VALUES ('408', '152223', '扎赉特旗');
INSERT INTO `shop_county` VALUES ('409', '152224', '突泉县');
INSERT INTO `shop_county` VALUES ('410', '152501', '二连浩特市');
INSERT INTO `shop_county` VALUES ('411', '152502', '锡林浩特市');
INSERT INTO `shop_county` VALUES ('412', '152522', '阿巴嘎旗');
INSERT INTO `shop_county` VALUES ('413', '152523', '苏尼特左旗');
INSERT INTO `shop_county` VALUES ('414', '152524', '苏尼特右旗');
INSERT INTO `shop_county` VALUES ('415', '152525', '东乌珠穆沁旗');
INSERT INTO `shop_county` VALUES ('416', '152526', '西乌珠穆沁旗');
INSERT INTO `shop_county` VALUES ('417', '152527', '太仆寺旗');
INSERT INTO `shop_county` VALUES ('418', '152528', '镶黄旗');
INSERT INTO `shop_county` VALUES ('419', '152529', '正镶白旗');
INSERT INTO `shop_county` VALUES ('420', '152530', '正蓝旗');
INSERT INTO `shop_county` VALUES ('421', '152531', '多伦县');
INSERT INTO `shop_county` VALUES ('422', '152921', '阿拉善左旗');
INSERT INTO `shop_county` VALUES ('423', '152922', '阿拉善右旗');
INSERT INTO `shop_county` VALUES ('424', '152923', '额济纳旗');
INSERT INTO `shop_county` VALUES ('425', '210102', '和平区');
INSERT INTO `shop_county` VALUES ('426', '210103', '沈河区');
INSERT INTO `shop_county` VALUES ('427', '210104', '大东区');
INSERT INTO `shop_county` VALUES ('428', '210105', '皇姑区');
INSERT INTO `shop_county` VALUES ('429', '210106', '铁西区');
INSERT INTO `shop_county` VALUES ('430', '210111', '苏家屯区');
INSERT INTO `shop_county` VALUES ('431', '210112', '浑南区');
INSERT INTO `shop_county` VALUES ('432', '210113', '沈北新区');
INSERT INTO `shop_county` VALUES ('433', '210114', '于洪区');
INSERT INTO `shop_county` VALUES ('434', '210115', '辽中区');
INSERT INTO `shop_county` VALUES ('435', '210123', '康平县');
INSERT INTO `shop_county` VALUES ('436', '210124', '法库县');
INSERT INTO `shop_county` VALUES ('437', '210181', '新民市');
INSERT INTO `shop_county` VALUES ('438', '210190', '经济技术开发区');
INSERT INTO `shop_county` VALUES ('439', '210202', '中山区');
INSERT INTO `shop_county` VALUES ('440', '210203', '西岗区');
INSERT INTO `shop_county` VALUES ('441', '210204', '沙河口区');
INSERT INTO `shop_county` VALUES ('442', '210211', '甘井子区');
INSERT INTO `shop_county` VALUES ('443', '210212', '旅顺口区');
INSERT INTO `shop_county` VALUES ('444', '210213', '金州区');
INSERT INTO `shop_county` VALUES ('445', '210214', '普兰店区');
INSERT INTO `shop_county` VALUES ('446', '210224', '长海县');
INSERT INTO `shop_county` VALUES ('447', '210281', '瓦房店市');
INSERT INTO `shop_county` VALUES ('448', '210283', '庄河市');
INSERT INTO `shop_county` VALUES ('449', '210302', '铁东区');
INSERT INTO `shop_county` VALUES ('450', '210303', '铁西区');
INSERT INTO `shop_county` VALUES ('451', '210304', '立山区');
INSERT INTO `shop_county` VALUES ('452', '210311', '千山区');
INSERT INTO `shop_county` VALUES ('453', '210321', '台安县');
INSERT INTO `shop_county` VALUES ('454', '210323', '岫岩满族自治县');
INSERT INTO `shop_county` VALUES ('455', '210381', '海城市');
INSERT INTO `shop_county` VALUES ('456', '210390', '高新区');
INSERT INTO `shop_county` VALUES ('457', '210402', '新抚区');
INSERT INTO `shop_county` VALUES ('458', '210403', '东洲区');
INSERT INTO `shop_county` VALUES ('459', '210404', '望花区');
INSERT INTO `shop_county` VALUES ('460', '210411', '顺城区');
INSERT INTO `shop_county` VALUES ('461', '210421', '抚顺县');
INSERT INTO `shop_county` VALUES ('462', '210422', '新宾满族自治县');
INSERT INTO `shop_county` VALUES ('463', '210423', '清原满族自治县');
INSERT INTO `shop_county` VALUES ('464', '210502', '平山区');
INSERT INTO `shop_county` VALUES ('465', '210503', '溪湖区');
INSERT INTO `shop_county` VALUES ('466', '210504', '明山区');
INSERT INTO `shop_county` VALUES ('467', '210505', '南芬区');
INSERT INTO `shop_county` VALUES ('468', '210521', '本溪满族自治县');
INSERT INTO `shop_county` VALUES ('469', '210522', '桓仁满族自治县');
INSERT INTO `shop_county` VALUES ('470', '210602', '元宝区');
INSERT INTO `shop_county` VALUES ('471', '210603', '振兴区');
INSERT INTO `shop_county` VALUES ('472', '210604', '振安区');
INSERT INTO `shop_county` VALUES ('473', '210624', '宽甸满族自治县');
INSERT INTO `shop_county` VALUES ('474', '210681', '东港市');
INSERT INTO `shop_county` VALUES ('475', '210682', '凤城市');
INSERT INTO `shop_county` VALUES ('476', '210702', '古塔区');
INSERT INTO `shop_county` VALUES ('477', '210703', '凌河区');
INSERT INTO `shop_county` VALUES ('478', '210711', '太和区');
INSERT INTO `shop_county` VALUES ('479', '210726', '黑山县');
INSERT INTO `shop_county` VALUES ('480', '210727', '义县');
INSERT INTO `shop_county` VALUES ('481', '210781', '凌海市');
INSERT INTO `shop_county` VALUES ('482', '210782', '北镇市');
INSERT INTO `shop_county` VALUES ('483', '210793', '经济技术开发区');
INSERT INTO `shop_county` VALUES ('484', '210802', '站前区');
INSERT INTO `shop_county` VALUES ('485', '210803', '西市区');
INSERT INTO `shop_county` VALUES ('486', '210804', '鲅鱼圈区');
INSERT INTO `shop_county` VALUES ('487', '210811', '老边区');
INSERT INTO `shop_county` VALUES ('488', '210881', '盖州市');
INSERT INTO `shop_county` VALUES ('489', '210882', '大石桥市');
INSERT INTO `shop_county` VALUES ('490', '210902', '海州区');
INSERT INTO `shop_county` VALUES ('491', '210903', '新邱区');
INSERT INTO `shop_county` VALUES ('492', '210904', '太平区');
INSERT INTO `shop_county` VALUES ('493', '210905', '清河门区');
INSERT INTO `shop_county` VALUES ('494', '210911', '细河区');
INSERT INTO `shop_county` VALUES ('495', '210921', '阜新蒙古族自治县');
INSERT INTO `shop_county` VALUES ('496', '210922', '彰武县');
INSERT INTO `shop_county` VALUES ('497', '211002', '白塔区');
INSERT INTO `shop_county` VALUES ('498', '211003', '文圣区');
INSERT INTO `shop_county` VALUES ('499', '211004', '宏伟区');
INSERT INTO `shop_county` VALUES ('500', '211005', '弓长岭区');
INSERT INTO `shop_county` VALUES ('501', '211011', '太子河区');
INSERT INTO `shop_county` VALUES ('502', '211021', '辽阳县');
INSERT INTO `shop_county` VALUES ('503', '211081', '灯塔市');
INSERT INTO `shop_county` VALUES ('504', '211102', '双台子区');
INSERT INTO `shop_county` VALUES ('505', '211103', '兴隆台区');
INSERT INTO `shop_county` VALUES ('506', '211104', '大洼区');
INSERT INTO `shop_county` VALUES ('507', '211122', '盘山县');
INSERT INTO `shop_county` VALUES ('508', '211202', '银州区');
INSERT INTO `shop_county` VALUES ('509', '211204', '清河区');
INSERT INTO `shop_county` VALUES ('510', '211221', '铁岭县');
INSERT INTO `shop_county` VALUES ('511', '211223', '西丰县');
INSERT INTO `shop_county` VALUES ('512', '211224', '昌图县');
INSERT INTO `shop_county` VALUES ('513', '211281', '调兵山市');
INSERT INTO `shop_county` VALUES ('514', '211282', '开原市');
INSERT INTO `shop_county` VALUES ('515', '211302', '双塔区');
INSERT INTO `shop_county` VALUES ('516', '211303', '龙城区');
INSERT INTO `shop_county` VALUES ('517', '211321', '朝阳县');
INSERT INTO `shop_county` VALUES ('518', '211322', '建平县');
INSERT INTO `shop_county` VALUES ('519', '211324', '喀喇沁左翼蒙古族自治县');
INSERT INTO `shop_county` VALUES ('520', '211381', '北票市');
INSERT INTO `shop_county` VALUES ('521', '211382', '凌源市');
INSERT INTO `shop_county` VALUES ('522', '211402', '连山区');
INSERT INTO `shop_county` VALUES ('523', '211403', '龙港区');
INSERT INTO `shop_county` VALUES ('524', '211404', '南票区');
INSERT INTO `shop_county` VALUES ('525', '211421', '绥中县');
INSERT INTO `shop_county` VALUES ('526', '211422', '建昌县');
INSERT INTO `shop_county` VALUES ('527', '211481', '兴城市');
INSERT INTO `shop_county` VALUES ('528', '215090', '工业园区');
INSERT INTO `shop_county` VALUES ('529', '220102', '南关区');
INSERT INTO `shop_county` VALUES ('530', '220103', '宽城区');
INSERT INTO `shop_county` VALUES ('531', '220104', '朝阳区');
INSERT INTO `shop_county` VALUES ('532', '220105', '二道区');
INSERT INTO `shop_county` VALUES ('533', '220106', '绿园区');
INSERT INTO `shop_county` VALUES ('534', '220112', '双阳区');
INSERT INTO `shop_county` VALUES ('535', '220113', '九台区');
INSERT INTO `shop_county` VALUES ('536', '220122', '农安县');
INSERT INTO `shop_county` VALUES ('537', '220182', '榆树市');
INSERT INTO `shop_county` VALUES ('538', '220183', '德惠市');
INSERT INTO `shop_county` VALUES ('539', '220192', '经济技术开发区');
INSERT INTO `shop_county` VALUES ('540', '220202', '昌邑区');
INSERT INTO `shop_county` VALUES ('541', '220203', '龙潭区');
INSERT INTO `shop_county` VALUES ('542', '220204', '船营区');
INSERT INTO `shop_county` VALUES ('543', '220211', '丰满区');
INSERT INTO `shop_county` VALUES ('544', '220221', '永吉县');
INSERT INTO `shop_county` VALUES ('545', '220281', '蛟河市');
INSERT INTO `shop_county` VALUES ('546', '220282', '桦甸市');
INSERT INTO `shop_county` VALUES ('547', '220283', '舒兰市');
INSERT INTO `shop_county` VALUES ('548', '220284', '磐石市');
INSERT INTO `shop_county` VALUES ('549', '220302', '铁西区');
INSERT INTO `shop_county` VALUES ('550', '220303', '铁东区');
INSERT INTO `shop_county` VALUES ('551', '220322', '梨树县');
INSERT INTO `shop_county` VALUES ('552', '220323', '伊通满族自治县');
INSERT INTO `shop_county` VALUES ('553', '220381', '公主岭市');
INSERT INTO `shop_county` VALUES ('554', '220382', '双辽市');
INSERT INTO `shop_county` VALUES ('555', '220402', '龙山区');
INSERT INTO `shop_county` VALUES ('556', '220403', '西安区');
INSERT INTO `shop_county` VALUES ('557', '220421', '东丰县');
INSERT INTO `shop_county` VALUES ('558', '220422', '东辽县');
INSERT INTO `shop_county` VALUES ('559', '220502', '东昌区');
INSERT INTO `shop_county` VALUES ('560', '220503', '二道江区');
INSERT INTO `shop_county` VALUES ('561', '220521', '通化县');
INSERT INTO `shop_county` VALUES ('562', '220523', '辉南县');
INSERT INTO `shop_county` VALUES ('563', '220524', '柳河县');
INSERT INTO `shop_county` VALUES ('564', '220581', '梅河口市');
INSERT INTO `shop_county` VALUES ('565', '220582', '集安市');
INSERT INTO `shop_county` VALUES ('566', '220602', '浑江区');
INSERT INTO `shop_county` VALUES ('567', '220605', '江源区');
INSERT INTO `shop_county` VALUES ('568', '220621', '抚松县');
INSERT INTO `shop_county` VALUES ('569', '220622', '靖宇县');
INSERT INTO `shop_county` VALUES ('570', '220623', '长白朝鲜族自治县');
INSERT INTO `shop_county` VALUES ('571', '220681', '临江市');
INSERT INTO `shop_county` VALUES ('572', '220702', '宁江区');
INSERT INTO `shop_county` VALUES ('573', '220721', '前郭尔罗斯蒙古族自治县');
INSERT INTO `shop_county` VALUES ('574', '220722', '长岭县');
INSERT INTO `shop_county` VALUES ('575', '220723', '乾安县');
INSERT INTO `shop_county` VALUES ('576', '220781', '扶余市');
INSERT INTO `shop_county` VALUES ('577', '220802', '洮北区');
INSERT INTO `shop_county` VALUES ('578', '220821', '镇赉县');
INSERT INTO `shop_county` VALUES ('579', '220822', '通榆县');
INSERT INTO `shop_county` VALUES ('580', '220881', '洮南市');
INSERT INTO `shop_county` VALUES ('581', '220882', '大安市');
INSERT INTO `shop_county` VALUES ('582', '221090', '工业园区');
INSERT INTO `shop_county` VALUES ('583', '222401', '延吉市');
INSERT INTO `shop_county` VALUES ('584', '222402', '图们市');
INSERT INTO `shop_county` VALUES ('585', '222403', '敦化市');
INSERT INTO `shop_county` VALUES ('586', '222404', '珲春市');
INSERT INTO `shop_county` VALUES ('587', '222405', '龙井市');
INSERT INTO `shop_county` VALUES ('588', '222406', '和龙市');
INSERT INTO `shop_county` VALUES ('589', '222424', '汪清县');
INSERT INTO `shop_county` VALUES ('590', '222426', '安图县');
INSERT INTO `shop_county` VALUES ('591', '230102', '道里区');
INSERT INTO `shop_county` VALUES ('592', '230103', '南岗区');
INSERT INTO `shop_county` VALUES ('593', '230104', '道外区');
INSERT INTO `shop_county` VALUES ('594', '230108', '平房区');
INSERT INTO `shop_county` VALUES ('595', '230109', '松北区');
INSERT INTO `shop_county` VALUES ('596', '230110', '香坊区');
INSERT INTO `shop_county` VALUES ('597', '230111', '呼兰区');
INSERT INTO `shop_county` VALUES ('598', '230112', '阿城区');
INSERT INTO `shop_county` VALUES ('599', '230113', '双城区');
INSERT INTO `shop_county` VALUES ('600', '230123', '依兰县');
INSERT INTO `shop_county` VALUES ('601', '230124', '方正县');
INSERT INTO `shop_county` VALUES ('602', '230125', '宾县');
INSERT INTO `shop_county` VALUES ('603', '230126', '巴彦县');
INSERT INTO `shop_county` VALUES ('604', '230127', '木兰县');
INSERT INTO `shop_county` VALUES ('605', '230128', '通河县');
INSERT INTO `shop_county` VALUES ('606', '230129', '延寿县');
INSERT INTO `shop_county` VALUES ('607', '230183', '尚志市');
INSERT INTO `shop_county` VALUES ('608', '230184', '五常市');
INSERT INTO `shop_county` VALUES ('609', '230202', '龙沙区');
INSERT INTO `shop_county` VALUES ('610', '230203', '建华区');
INSERT INTO `shop_county` VALUES ('611', '230204', '铁锋区');
INSERT INTO `shop_county` VALUES ('612', '230205', '昂昂溪区');
INSERT INTO `shop_county` VALUES ('613', '230206', '富拉尔基区');
INSERT INTO `shop_county` VALUES ('614', '230207', '碾子山区');
INSERT INTO `shop_county` VALUES ('615', '230208', '梅里斯达斡尔族区');
INSERT INTO `shop_county` VALUES ('616', '230221', '龙江县');
INSERT INTO `shop_county` VALUES ('617', '230223', '依安县');
INSERT INTO `shop_county` VALUES ('618', '230224', '泰来县');
INSERT INTO `shop_county` VALUES ('619', '230225', '甘南县');
INSERT INTO `shop_county` VALUES ('620', '230227', '富裕县');
INSERT INTO `shop_county` VALUES ('621', '230229', '克山县');
INSERT INTO `shop_county` VALUES ('622', '230230', '克东县');
INSERT INTO `shop_county` VALUES ('623', '230231', '拜泉县');
INSERT INTO `shop_county` VALUES ('624', '230281', '讷河市');
INSERT INTO `shop_county` VALUES ('625', '230302', '鸡冠区');
INSERT INTO `shop_county` VALUES ('626', '230303', '恒山区');
INSERT INTO `shop_county` VALUES ('627', '230304', '滴道区');
INSERT INTO `shop_county` VALUES ('628', '230305', '梨树区');
INSERT INTO `shop_county` VALUES ('629', '230306', '城子河区');
INSERT INTO `shop_county` VALUES ('630', '230307', '麻山区');
INSERT INTO `shop_county` VALUES ('631', '230321', '鸡东县');
INSERT INTO `shop_county` VALUES ('632', '230381', '虎林市');
INSERT INTO `shop_county` VALUES ('633', '230382', '密山市');
INSERT INTO `shop_county` VALUES ('634', '230402', '向阳区');
INSERT INTO `shop_county` VALUES ('635', '230403', '工农区');
INSERT INTO `shop_county` VALUES ('636', '230404', '南山区');
INSERT INTO `shop_county` VALUES ('637', '230405', '兴安区');
INSERT INTO `shop_county` VALUES ('638', '230406', '东山区');
INSERT INTO `shop_county` VALUES ('639', '230407', '兴山区');
INSERT INTO `shop_county` VALUES ('640', '230421', '萝北县');
INSERT INTO `shop_county` VALUES ('641', '230422', '绥滨县');
INSERT INTO `shop_county` VALUES ('642', '230502', '尖山区');
INSERT INTO `shop_county` VALUES ('643', '230503', '岭东区');
INSERT INTO `shop_county` VALUES ('644', '230505', '四方台区');
INSERT INTO `shop_county` VALUES ('645', '230506', '宝山区');
INSERT INTO `shop_county` VALUES ('646', '230521', '集贤县');
INSERT INTO `shop_county` VALUES ('647', '230522', '友谊县');
INSERT INTO `shop_county` VALUES ('648', '230523', '宝清县');
INSERT INTO `shop_county` VALUES ('649', '230524', '饶河县');
INSERT INTO `shop_county` VALUES ('650', '230602', '萨尔图区');
INSERT INTO `shop_county` VALUES ('651', '230603', '龙凤区');
INSERT INTO `shop_county` VALUES ('652', '230604', '让胡路区');
INSERT INTO `shop_county` VALUES ('653', '230605', '红岗区');
INSERT INTO `shop_county` VALUES ('654', '230606', '大同区');
INSERT INTO `shop_county` VALUES ('655', '230621', '肇州县');
INSERT INTO `shop_county` VALUES ('656', '230622', '肇源县');
INSERT INTO `shop_county` VALUES ('657', '230623', '林甸县');
INSERT INTO `shop_county` VALUES ('658', '230624', '杜尔伯特蒙古族自治县');
INSERT INTO `shop_county` VALUES ('659', '230702', '伊春区');
INSERT INTO `shop_county` VALUES ('660', '230703', '南岔区');
INSERT INTO `shop_county` VALUES ('661', '230704', '友好区');
INSERT INTO `shop_county` VALUES ('662', '230705', '西林区');
INSERT INTO `shop_county` VALUES ('663', '230706', '翠峦区');
INSERT INTO `shop_county` VALUES ('664', '230707', '新青区');
INSERT INTO `shop_county` VALUES ('665', '230708', '美溪区');
INSERT INTO `shop_county` VALUES ('666', '230709', '金山屯区');
INSERT INTO `shop_county` VALUES ('667', '230710', '五营区');
INSERT INTO `shop_county` VALUES ('668', '230711', '乌马河区');
INSERT INTO `shop_county` VALUES ('669', '230712', '汤旺河区');
INSERT INTO `shop_county` VALUES ('670', '230713', '带岭区');
INSERT INTO `shop_county` VALUES ('671', '230714', '乌伊岭区');
INSERT INTO `shop_county` VALUES ('672', '230715', '红星区');
INSERT INTO `shop_county` VALUES ('673', '230716', '上甘岭区');
INSERT INTO `shop_county` VALUES ('674', '230722', '嘉荫县');
INSERT INTO `shop_county` VALUES ('675', '230781', '铁力市');
INSERT INTO `shop_county` VALUES ('676', '230803', '向阳区');
INSERT INTO `shop_county` VALUES ('677', '230804', '前进区');
INSERT INTO `shop_county` VALUES ('678', '230805', '东风区');
INSERT INTO `shop_county` VALUES ('679', '230811', '郊区');
INSERT INTO `shop_county` VALUES ('680', '230822', '桦南县');
INSERT INTO `shop_county` VALUES ('681', '230826', '桦川县');
INSERT INTO `shop_county` VALUES ('682', '230828', '汤原县');
INSERT INTO `shop_county` VALUES ('683', '230881', '同江市');
INSERT INTO `shop_county` VALUES ('684', '230882', '富锦市');
INSERT INTO `shop_county` VALUES ('685', '230883', '抚远市');
INSERT INTO `shop_county` VALUES ('686', '230902', '新兴区');
INSERT INTO `shop_county` VALUES ('687', '230903', '桃山区');
INSERT INTO `shop_county` VALUES ('688', '230904', '茄子河区');
INSERT INTO `shop_county` VALUES ('689', '230921', '勃利县');
INSERT INTO `shop_county` VALUES ('690', '231002', '东安区');
INSERT INTO `shop_county` VALUES ('691', '231003', '阳明区');
INSERT INTO `shop_county` VALUES ('692', '231004', '爱民区');
INSERT INTO `shop_county` VALUES ('693', '231005', '西安区');
INSERT INTO `shop_county` VALUES ('694', '231025', '林口县');
INSERT INTO `shop_county` VALUES ('695', '231081', '绥芬河市');
INSERT INTO `shop_county` VALUES ('696', '231083', '海林市');
INSERT INTO `shop_county` VALUES ('697', '231084', '宁安市');
INSERT INTO `shop_county` VALUES ('698', '231085', '穆棱市');
INSERT INTO `shop_county` VALUES ('699', '231086', '东宁市');
INSERT INTO `shop_county` VALUES ('700', '231102', '爱辉区');
INSERT INTO `shop_county` VALUES ('701', '231121', '嫩江县');
INSERT INTO `shop_county` VALUES ('702', '231123', '逊克县');
INSERT INTO `shop_county` VALUES ('703', '231124', '孙吴县');
INSERT INTO `shop_county` VALUES ('704', '231181', '北安市');
INSERT INTO `shop_county` VALUES ('705', '231182', '五大连池市');
INSERT INTO `shop_county` VALUES ('706', '231202', '北林区');
INSERT INTO `shop_county` VALUES ('707', '231221', '望奎县');
INSERT INTO `shop_county` VALUES ('708', '231222', '兰西县');
INSERT INTO `shop_county` VALUES ('709', '231223', '青冈县');
INSERT INTO `shop_county` VALUES ('710', '231224', '庆安县');
INSERT INTO `shop_county` VALUES ('711', '231225', '明水县');
INSERT INTO `shop_county` VALUES ('712', '231226', '绥棱县');
INSERT INTO `shop_county` VALUES ('713', '231281', '安达市');
INSERT INTO `shop_county` VALUES ('714', '231282', '肇东市');
INSERT INTO `shop_county` VALUES ('715', '231283', '海伦市');
INSERT INTO `shop_county` VALUES ('716', '232721', '呼玛县');
INSERT INTO `shop_county` VALUES ('717', '232722', '塔河县');
INSERT INTO `shop_county` VALUES ('718', '232723', '漠河县');
INSERT INTO `shop_county` VALUES ('719', '232790', '松岭区');
INSERT INTO `shop_county` VALUES ('720', '232791', '呼中区');
INSERT INTO `shop_county` VALUES ('721', '232792', '加格达奇区');
INSERT INTO `shop_county` VALUES ('722', '232793', '新林区');
INSERT INTO `shop_county` VALUES ('723', '310101', '黄浦区');
INSERT INTO `shop_county` VALUES ('724', '310104', '徐汇区');
INSERT INTO `shop_county` VALUES ('725', '310105', '长宁区');
INSERT INTO `shop_county` VALUES ('726', '310106', '静安区');
INSERT INTO `shop_county` VALUES ('727', '310107', '普陀区');
INSERT INTO `shop_county` VALUES ('728', '310109', '虹口区');
INSERT INTO `shop_county` VALUES ('729', '310110', '杨浦区');
INSERT INTO `shop_county` VALUES ('730', '310112', '闵行区');
INSERT INTO `shop_county` VALUES ('731', '310113', '宝山区');
INSERT INTO `shop_county` VALUES ('732', '310114', '嘉定区');
INSERT INTO `shop_county` VALUES ('733', '310115', '浦东新区');
INSERT INTO `shop_county` VALUES ('734', '310116', '金山区');
INSERT INTO `shop_county` VALUES ('735', '310117', '松江区');
INSERT INTO `shop_county` VALUES ('736', '310118', '青浦区');
INSERT INTO `shop_county` VALUES ('737', '310120', '奉贤区');
INSERT INTO `shop_county` VALUES ('738', '310151', '崇明区');
INSERT INTO `shop_county` VALUES ('739', '320102', '玄武区');
INSERT INTO `shop_county` VALUES ('740', '320104', '秦淮区');
INSERT INTO `shop_county` VALUES ('741', '320105', '建邺区');
INSERT INTO `shop_county` VALUES ('742', '320106', '鼓楼区');
INSERT INTO `shop_county` VALUES ('743', '320111', '浦口区');
INSERT INTO `shop_county` VALUES ('744', '320113', '栖霞区');
INSERT INTO `shop_county` VALUES ('745', '320114', '雨花台区');
INSERT INTO `shop_county` VALUES ('746', '320115', '江宁区');
INSERT INTO `shop_county` VALUES ('747', '320116', '六合区');
INSERT INTO `shop_county` VALUES ('748', '320117', '溧水区');
INSERT INTO `shop_county` VALUES ('749', '320118', '高淳区');
INSERT INTO `shop_county` VALUES ('750', '320205', '锡山区');
INSERT INTO `shop_county` VALUES ('751', '320206', '惠山区');
INSERT INTO `shop_county` VALUES ('752', '320211', '滨湖区');
INSERT INTO `shop_county` VALUES ('753', '320213', '梁溪区');
INSERT INTO `shop_county` VALUES ('754', '320214', '新吴区');
INSERT INTO `shop_county` VALUES ('755', '320281', '江阴市');
INSERT INTO `shop_county` VALUES ('756', '320282', '宜兴市');
INSERT INTO `shop_county` VALUES ('757', '320302', '鼓楼区');
INSERT INTO `shop_county` VALUES ('758', '320303', '云龙区');
INSERT INTO `shop_county` VALUES ('759', '320305', '贾汪区');
INSERT INTO `shop_county` VALUES ('760', '320311', '泉山区');
INSERT INTO `shop_county` VALUES ('761', '320312', '铜山区');
INSERT INTO `shop_county` VALUES ('762', '320321', '丰县');
INSERT INTO `shop_county` VALUES ('763', '320322', '沛县');
INSERT INTO `shop_county` VALUES ('764', '320324', '睢宁县');
INSERT INTO `shop_county` VALUES ('765', '320381', '新沂市');
INSERT INTO `shop_county` VALUES ('766', '320382', '邳州市');
INSERT INTO `shop_county` VALUES ('767', '320391', '工业园区');
INSERT INTO `shop_county` VALUES ('768', '320402', '天宁区');
INSERT INTO `shop_county` VALUES ('769', '320404', '钟楼区');
INSERT INTO `shop_county` VALUES ('770', '320411', '新北区');
INSERT INTO `shop_county` VALUES ('771', '320412', '武进区');
INSERT INTO `shop_county` VALUES ('772', '320413', '金坛区');
INSERT INTO `shop_county` VALUES ('773', '320481', '溧阳市');
INSERT INTO `shop_county` VALUES ('774', '320505', '虎丘区');
INSERT INTO `shop_county` VALUES ('775', '320506', '吴中区');
INSERT INTO `shop_county` VALUES ('776', '320507', '相城区');
INSERT INTO `shop_county` VALUES ('777', '320508', '姑苏区');
INSERT INTO `shop_county` VALUES ('778', '320509', '吴江区');
INSERT INTO `shop_county` VALUES ('779', '320581', '常熟市');
INSERT INTO `shop_county` VALUES ('780', '320582', '张家港市');
INSERT INTO `shop_county` VALUES ('781', '320583', '昆山市');
INSERT INTO `shop_county` VALUES ('782', '320585', '太仓市');
INSERT INTO `shop_county` VALUES ('783', '320590', '工业园区');
INSERT INTO `shop_county` VALUES ('784', '320591', '高新区');
INSERT INTO `shop_county` VALUES ('785', '320602', '崇川区');
INSERT INTO `shop_county` VALUES ('786', '320611', '港闸区');
INSERT INTO `shop_county` VALUES ('787', '320612', '通州区');
INSERT INTO `shop_county` VALUES ('788', '320621', '海安县');
INSERT INTO `shop_county` VALUES ('789', '320623', '如东县');
INSERT INTO `shop_county` VALUES ('790', '320681', '启东市');
INSERT INTO `shop_county` VALUES ('791', '320682', '如皋市');
INSERT INTO `shop_county` VALUES ('792', '320684', '海门市');
INSERT INTO `shop_county` VALUES ('793', '320691', '高新区');
INSERT INTO `shop_county` VALUES ('794', '320703', '连云区');
INSERT INTO `shop_county` VALUES ('795', '320706', '海州区');
INSERT INTO `shop_county` VALUES ('796', '320707', '赣榆区');
INSERT INTO `shop_county` VALUES ('797', '320722', '东海县');
INSERT INTO `shop_county` VALUES ('798', '320723', '灌云县');
INSERT INTO `shop_county` VALUES ('799', '320724', '灌南县');
INSERT INTO `shop_county` VALUES ('800', '320803', '淮安区');
INSERT INTO `shop_county` VALUES ('801', '320804', '淮阴区');
INSERT INTO `shop_county` VALUES ('802', '320812', '清江浦区');
INSERT INTO `shop_county` VALUES ('803', '320813', '洪泽区');
INSERT INTO `shop_county` VALUES ('804', '320826', '涟水县');
INSERT INTO `shop_county` VALUES ('805', '320830', '盱眙县');
INSERT INTO `shop_county` VALUES ('806', '320831', '金湖县');
INSERT INTO `shop_county` VALUES ('807', '320890', '经济开发区');
INSERT INTO `shop_county` VALUES ('808', '320902', '亭湖区');
INSERT INTO `shop_county` VALUES ('809', '320903', '盐都区');
INSERT INTO `shop_county` VALUES ('810', '320904', '大丰区');
INSERT INTO `shop_county` VALUES ('811', '320921', '响水县');
INSERT INTO `shop_county` VALUES ('812', '320922', '滨海县');
INSERT INTO `shop_county` VALUES ('813', '320923', '阜宁县');
INSERT INTO `shop_county` VALUES ('814', '320924', '射阳县');
INSERT INTO `shop_county` VALUES ('815', '320925', '建湖县');
INSERT INTO `shop_county` VALUES ('816', '320981', '东台市');
INSERT INTO `shop_county` VALUES ('817', '321002', '广陵区');
INSERT INTO `shop_county` VALUES ('818', '321003', '邗江区');
INSERT INTO `shop_county` VALUES ('819', '321012', '江都区');
INSERT INTO `shop_county` VALUES ('820', '321023', '宝应县');
INSERT INTO `shop_county` VALUES ('821', '321081', '仪征市');
INSERT INTO `shop_county` VALUES ('822', '321084', '高邮市');
INSERT INTO `shop_county` VALUES ('823', '321090', '经济开发区');
INSERT INTO `shop_county` VALUES ('824', '321102', '京口区');
INSERT INTO `shop_county` VALUES ('825', '321111', '润州区');
INSERT INTO `shop_county` VALUES ('826', '321112', '丹徒区');
INSERT INTO `shop_county` VALUES ('827', '321181', '丹阳市');
INSERT INTO `shop_county` VALUES ('828', '321182', '扬中市');
INSERT INTO `shop_county` VALUES ('829', '321183', '句容市');
INSERT INTO `shop_county` VALUES ('830', '321202', '海陵区');
INSERT INTO `shop_county` VALUES ('831', '321203', '高港区');
INSERT INTO `shop_county` VALUES ('832', '321204', '姜堰区');
INSERT INTO `shop_county` VALUES ('833', '321281', '兴化市');
INSERT INTO `shop_county` VALUES ('834', '321282', '靖江市');
INSERT INTO `shop_county` VALUES ('835', '321283', '泰兴市');
INSERT INTO `shop_county` VALUES ('836', '321302', '宿城区');
INSERT INTO `shop_county` VALUES ('837', '321311', '宿豫区');
INSERT INTO `shop_county` VALUES ('838', '321322', '沭阳县');
INSERT INTO `shop_county` VALUES ('839', '321323', '泗阳县');
INSERT INTO `shop_county` VALUES ('840', '321324', '泗洪县');
INSERT INTO `shop_county` VALUES ('841', '330102', '上城区');
INSERT INTO `shop_county` VALUES ('842', '330103', '下城区');
INSERT INTO `shop_county` VALUES ('843', '330104', '江干区');
INSERT INTO `shop_county` VALUES ('844', '330105', '拱墅区');
INSERT INTO `shop_county` VALUES ('845', '330106', '西湖区');
INSERT INTO `shop_county` VALUES ('846', '330108', '滨江区');
INSERT INTO `shop_county` VALUES ('847', '330109', '萧山区');
INSERT INTO `shop_county` VALUES ('848', '330110', '余杭区');
INSERT INTO `shop_county` VALUES ('849', '330111', '富阳区');
INSERT INTO `shop_county` VALUES ('850', '330112', '临安区');
INSERT INTO `shop_county` VALUES ('851', '330122', '桐庐县');
INSERT INTO `shop_county` VALUES ('852', '330127', '淳安县');
INSERT INTO `shop_county` VALUES ('853', '330182', '建德市');
INSERT INTO `shop_county` VALUES ('854', '330203', '海曙区');
INSERT INTO `shop_county` VALUES ('855', '330205', '江北区');
INSERT INTO `shop_county` VALUES ('856', '330206', '北仑区');
INSERT INTO `shop_county` VALUES ('857', '330211', '镇海区');
INSERT INTO `shop_county` VALUES ('858', '330212', '鄞州区');
INSERT INTO `shop_county` VALUES ('859', '330213', '奉化区');
INSERT INTO `shop_county` VALUES ('860', '330225', '象山县');
INSERT INTO `shop_county` VALUES ('861', '330226', '宁海县');
INSERT INTO `shop_county` VALUES ('862', '330281', '余姚市');
INSERT INTO `shop_county` VALUES ('863', '330282', '慈溪市');
INSERT INTO `shop_county` VALUES ('864', '330302', '鹿城区');
INSERT INTO `shop_county` VALUES ('865', '330303', '龙湾区');
INSERT INTO `shop_county` VALUES ('866', '330304', '瓯海区');
INSERT INTO `shop_county` VALUES ('867', '330305', '洞头区');
INSERT INTO `shop_county` VALUES ('868', '330324', '永嘉县');
INSERT INTO `shop_county` VALUES ('869', '330326', '平阳县');
INSERT INTO `shop_county` VALUES ('870', '330327', '苍南县');
INSERT INTO `shop_county` VALUES ('871', '330328', '文成县');
INSERT INTO `shop_county` VALUES ('872', '330329', '泰顺县');
INSERT INTO `shop_county` VALUES ('873', '330381', '瑞安市');
INSERT INTO `shop_county` VALUES ('874', '330382', '乐清市');
INSERT INTO `shop_county` VALUES ('875', '330402', '南湖区');
INSERT INTO `shop_county` VALUES ('876', '330411', '秀洲区');
INSERT INTO `shop_county` VALUES ('877', '330421', '嘉善县');
INSERT INTO `shop_county` VALUES ('878', '330424', '海盐县');
INSERT INTO `shop_county` VALUES ('879', '330481', '海宁市');
INSERT INTO `shop_county` VALUES ('880', '330482', '平湖市');
INSERT INTO `shop_county` VALUES ('881', '330483', '桐乡市');
INSERT INTO `shop_county` VALUES ('882', '330502', '吴兴区');
INSERT INTO `shop_county` VALUES ('883', '330503', '南浔区');
INSERT INTO `shop_county` VALUES ('884', '330521', '德清县');
INSERT INTO `shop_county` VALUES ('885', '330522', '长兴县');
INSERT INTO `shop_county` VALUES ('886', '330523', '安吉县');
INSERT INTO `shop_county` VALUES ('887', '330602', '越城区');
INSERT INTO `shop_county` VALUES ('888', '330603', '柯桥区');
INSERT INTO `shop_county` VALUES ('889', '330604', '上虞区');
INSERT INTO `shop_county` VALUES ('890', '330624', '新昌县');
INSERT INTO `shop_county` VALUES ('891', '330681', '诸暨市');
INSERT INTO `shop_county` VALUES ('892', '330683', '嵊州市');
INSERT INTO `shop_county` VALUES ('893', '330702', '婺城区');
INSERT INTO `shop_county` VALUES ('894', '330703', '金东区');
INSERT INTO `shop_county` VALUES ('895', '330723', '武义县');
INSERT INTO `shop_county` VALUES ('896', '330726', '浦江县');
INSERT INTO `shop_county` VALUES ('897', '330727', '磐安县');
INSERT INTO `shop_county` VALUES ('898', '330781', '兰溪市');
INSERT INTO `shop_county` VALUES ('899', '330782', '义乌市');
INSERT INTO `shop_county` VALUES ('900', '330783', '东阳市');
INSERT INTO `shop_county` VALUES ('901', '330784', '永康市');
INSERT INTO `shop_county` VALUES ('902', '330802', '柯城区');
INSERT INTO `shop_county` VALUES ('903', '330803', '衢江区');
INSERT INTO `shop_county` VALUES ('904', '330822', '常山县');
INSERT INTO `shop_county` VALUES ('905', '330824', '开化县');
INSERT INTO `shop_county` VALUES ('906', '330825', '龙游县');
INSERT INTO `shop_county` VALUES ('907', '330881', '江山市');
INSERT INTO `shop_county` VALUES ('908', '330902', '定海区');
INSERT INTO `shop_county` VALUES ('909', '330903', '普陀区');
INSERT INTO `shop_county` VALUES ('910', '330921', '岱山县');
INSERT INTO `shop_county` VALUES ('911', '330922', '嵊泗县');
INSERT INTO `shop_county` VALUES ('912', '331002', '椒江区');
INSERT INTO `shop_county` VALUES ('913', '331003', '黄岩区');
INSERT INTO `shop_county` VALUES ('914', '331004', '路桥区');
INSERT INTO `shop_county` VALUES ('915', '331022', '三门县');
INSERT INTO `shop_county` VALUES ('916', '331023', '天台县');
INSERT INTO `shop_county` VALUES ('917', '331024', '仙居县');
INSERT INTO `shop_county` VALUES ('918', '331081', '温岭市');
INSERT INTO `shop_county` VALUES ('919', '331082', '临海市');
INSERT INTO `shop_county` VALUES ('920', '331083', '玉环市');
INSERT INTO `shop_county` VALUES ('921', '331102', '莲都区');
INSERT INTO `shop_county` VALUES ('922', '331121', '青田县');
INSERT INTO `shop_county` VALUES ('923', '331122', '缙云县');
INSERT INTO `shop_county` VALUES ('924', '331123', '遂昌县');
INSERT INTO `shop_county` VALUES ('925', '331124', '松阳县');
INSERT INTO `shop_county` VALUES ('926', '331125', '云和县');
INSERT INTO `shop_county` VALUES ('927', '331126', '庆元县');
INSERT INTO `shop_county` VALUES ('928', '331127', '景宁畲族自治县');
INSERT INTO `shop_county` VALUES ('929', '331181', '龙泉市');
INSERT INTO `shop_county` VALUES ('930', '340102', '瑶海区');
INSERT INTO `shop_county` VALUES ('931', '340103', '庐阳区');
INSERT INTO `shop_county` VALUES ('932', '340104', '蜀山区');
INSERT INTO `shop_county` VALUES ('933', '340111', '包河区');
INSERT INTO `shop_county` VALUES ('934', '340121', '长丰县');
INSERT INTO `shop_county` VALUES ('935', '340122', '肥东县');
INSERT INTO `shop_county` VALUES ('936', '340123', '肥西县');
INSERT INTO `shop_county` VALUES ('937', '340124', '庐江县');
INSERT INTO `shop_county` VALUES ('938', '340181', '巢湖市');
INSERT INTO `shop_county` VALUES ('939', '340190', '高新技术开发区');
INSERT INTO `shop_county` VALUES ('940', '340191', '经济技术开发区');
INSERT INTO `shop_county` VALUES ('941', '340202', '镜湖区');
INSERT INTO `shop_county` VALUES ('942', '340203', '弋江区');
INSERT INTO `shop_county` VALUES ('943', '340207', '鸠江区');
INSERT INTO `shop_county` VALUES ('944', '340208', '三山区');
INSERT INTO `shop_county` VALUES ('945', '340221', '芜湖县');
INSERT INTO `shop_county` VALUES ('946', '340222', '繁昌县');
INSERT INTO `shop_county` VALUES ('947', '340223', '南陵县');
INSERT INTO `shop_county` VALUES ('948', '340225', '无为县');
INSERT INTO `shop_county` VALUES ('949', '340302', '龙子湖区');
INSERT INTO `shop_county` VALUES ('950', '340303', '蚌山区');
INSERT INTO `shop_county` VALUES ('951', '340304', '禹会区');
INSERT INTO `shop_county` VALUES ('952', '340311', '淮上区');
INSERT INTO `shop_county` VALUES ('953', '340321', '怀远县');
INSERT INTO `shop_county` VALUES ('954', '340322', '五河县');
INSERT INTO `shop_county` VALUES ('955', '340323', '固镇县');
INSERT INTO `shop_county` VALUES ('956', '340402', '大通区');
INSERT INTO `shop_county` VALUES ('957', '340403', '田家庵区');
INSERT INTO `shop_county` VALUES ('958', '340404', '谢家集区');
INSERT INTO `shop_county` VALUES ('959', '340405', '八公山区');
INSERT INTO `shop_county` VALUES ('960', '340406', '潘集区');
INSERT INTO `shop_county` VALUES ('961', '340421', '凤台县');
INSERT INTO `shop_county` VALUES ('962', '340422', '寿县');
INSERT INTO `shop_county` VALUES ('963', '340503', '花山区');
INSERT INTO `shop_county` VALUES ('964', '340504', '雨山区');
INSERT INTO `shop_county` VALUES ('965', '340506', '博望区');
INSERT INTO `shop_county` VALUES ('966', '340521', '当涂县');
INSERT INTO `shop_county` VALUES ('967', '340522', '含山县');
INSERT INTO `shop_county` VALUES ('968', '340523', '和县');
INSERT INTO `shop_county` VALUES ('969', '340602', '杜集区');
INSERT INTO `shop_county` VALUES ('970', '340603', '相山区');
INSERT INTO `shop_county` VALUES ('971', '340604', '烈山区');
INSERT INTO `shop_county` VALUES ('972', '340621', '濉溪县');
INSERT INTO `shop_county` VALUES ('973', '340705', '铜官区');
INSERT INTO `shop_county` VALUES ('974', '340706', '义安区');
INSERT INTO `shop_county` VALUES ('975', '340711', '郊区');
INSERT INTO `shop_county` VALUES ('976', '340722', '枞阳县');
INSERT INTO `shop_county` VALUES ('977', '340802', '迎江区');
INSERT INTO `shop_county` VALUES ('978', '340803', '大观区');
INSERT INTO `shop_county` VALUES ('979', '340811', '宜秀区');
INSERT INTO `shop_county` VALUES ('980', '340822', '怀宁县');
INSERT INTO `shop_county` VALUES ('981', '340824', '潜山县');
INSERT INTO `shop_county` VALUES ('982', '340825', '太湖县');
INSERT INTO `shop_county` VALUES ('983', '340826', '宿松县');
INSERT INTO `shop_county` VALUES ('984', '340827', '望江县');
INSERT INTO `shop_county` VALUES ('985', '340828', '岳西县');
INSERT INTO `shop_county` VALUES ('986', '340881', '桐城市');
INSERT INTO `shop_county` VALUES ('987', '341002', '屯溪区');
INSERT INTO `shop_county` VALUES ('988', '341003', '黄山区');
INSERT INTO `shop_county` VALUES ('989', '341004', '徽州区');
INSERT INTO `shop_county` VALUES ('990', '341021', '歙县');
INSERT INTO `shop_county` VALUES ('991', '341022', '休宁县');
INSERT INTO `shop_county` VALUES ('992', '341023', '黟县');
INSERT INTO `shop_county` VALUES ('993', '341024', '祁门县');
INSERT INTO `shop_county` VALUES ('994', '341102', '琅琊区');
INSERT INTO `shop_county` VALUES ('995', '341103', '南谯区');
INSERT INTO `shop_county` VALUES ('996', '341122', '来安县');
INSERT INTO `shop_county` VALUES ('997', '341124', '全椒县');
INSERT INTO `shop_county` VALUES ('998', '341125', '定远县');
INSERT INTO `shop_county` VALUES ('999', '341126', '凤阳县');
INSERT INTO `shop_county` VALUES ('1000', '341181', '天长市');
INSERT INTO `shop_county` VALUES ('1001', '341182', '明光市');
INSERT INTO `shop_county` VALUES ('1002', '341202', '颍州区');
INSERT INTO `shop_county` VALUES ('1003', '341203', '颍东区');
INSERT INTO `shop_county` VALUES ('1004', '341204', '颍泉区');
INSERT INTO `shop_county` VALUES ('1005', '341221', '临泉县');
INSERT INTO `shop_county` VALUES ('1006', '341222', '太和县');
INSERT INTO `shop_county` VALUES ('1007', '341225', '阜南县');
INSERT INTO `shop_county` VALUES ('1008', '341226', '颍上县');
INSERT INTO `shop_county` VALUES ('1009', '341282', '界首市');
INSERT INTO `shop_county` VALUES ('1010', '341302', '埇桥区');
INSERT INTO `shop_county` VALUES ('1011', '341321', '砀山县');
INSERT INTO `shop_county` VALUES ('1012', '341322', '萧县');
INSERT INTO `shop_county` VALUES ('1013', '341323', '灵璧县');
INSERT INTO `shop_county` VALUES ('1014', '341324', '泗县');
INSERT INTO `shop_county` VALUES ('1015', '341390', '经济开发区');
INSERT INTO `shop_county` VALUES ('1016', '341502', '金安区');
INSERT INTO `shop_county` VALUES ('1017', '341503', '裕安区');
INSERT INTO `shop_county` VALUES ('1018', '341504', '叶集区');
INSERT INTO `shop_county` VALUES ('1019', '341522', '霍邱县');
INSERT INTO `shop_county` VALUES ('1020', '341523', '舒城县');
INSERT INTO `shop_county` VALUES ('1021', '341524', '金寨县');
INSERT INTO `shop_county` VALUES ('1022', '341525', '霍山县');
INSERT INTO `shop_county` VALUES ('1023', '341602', '谯城区');
INSERT INTO `shop_county` VALUES ('1024', '341621', '涡阳县');
INSERT INTO `shop_county` VALUES ('1025', '341622', '蒙城县');
INSERT INTO `shop_county` VALUES ('1026', '341623', '利辛县');
INSERT INTO `shop_county` VALUES ('1027', '341702', '贵池区');
INSERT INTO `shop_county` VALUES ('1028', '341721', '东至县');
INSERT INTO `shop_county` VALUES ('1029', '341722', '石台县');
INSERT INTO `shop_county` VALUES ('1030', '341723', '青阳县');
INSERT INTO `shop_county` VALUES ('1031', '341802', '宣州区');
INSERT INTO `shop_county` VALUES ('1032', '341821', '郎溪县');
INSERT INTO `shop_county` VALUES ('1033', '341822', '广德县');
INSERT INTO `shop_county` VALUES ('1034', '341823', '泾县');
INSERT INTO `shop_county` VALUES ('1035', '341824', '绩溪县');
INSERT INTO `shop_county` VALUES ('1036', '341825', '旌德县');
INSERT INTO `shop_county` VALUES ('1037', '341881', '宁国市');
INSERT INTO `shop_county` VALUES ('1038', '350102', '鼓楼区');
INSERT INTO `shop_county` VALUES ('1039', '350103', '台江区');
INSERT INTO `shop_county` VALUES ('1040', '350104', '仓山区');
INSERT INTO `shop_county` VALUES ('1041', '350105', '马尾区');
INSERT INTO `shop_county` VALUES ('1042', '350111', '晋安区');
INSERT INTO `shop_county` VALUES ('1043', '350112', '长乐区');
INSERT INTO `shop_county` VALUES ('1044', '350121', '闽侯县');
INSERT INTO `shop_county` VALUES ('1045', '350122', '连江县');
INSERT INTO `shop_county` VALUES ('1046', '350123', '罗源县');
INSERT INTO `shop_county` VALUES ('1047', '350124', '闽清县');
INSERT INTO `shop_county` VALUES ('1048', '350125', '永泰县');
INSERT INTO `shop_county` VALUES ('1049', '350128', '平潭县');
INSERT INTO `shop_county` VALUES ('1050', '350181', '福清市');
INSERT INTO `shop_county` VALUES ('1051', '350203', '思明区');
INSERT INTO `shop_county` VALUES ('1052', '350205', '海沧区');
INSERT INTO `shop_county` VALUES ('1053', '350206', '湖里区');
INSERT INTO `shop_county` VALUES ('1054', '350211', '集美区');
INSERT INTO `shop_county` VALUES ('1055', '350212', '同安区');
INSERT INTO `shop_county` VALUES ('1056', '350213', '翔安区');
INSERT INTO `shop_county` VALUES ('1057', '350302', '城厢区');
INSERT INTO `shop_county` VALUES ('1058', '350303', '涵江区');
INSERT INTO `shop_county` VALUES ('1059', '350304', '荔城区');
INSERT INTO `shop_county` VALUES ('1060', '350305', '秀屿区');
INSERT INTO `shop_county` VALUES ('1061', '350322', '仙游县');
INSERT INTO `shop_county` VALUES ('1062', '350402', '梅列区');
INSERT INTO `shop_county` VALUES ('1063', '350403', '三元区');
INSERT INTO `shop_county` VALUES ('1064', '350421', '明溪县');
INSERT INTO `shop_county` VALUES ('1065', '350423', '清流县');
INSERT INTO `shop_county` VALUES ('1066', '350424', '宁化县');
INSERT INTO `shop_county` VALUES ('1067', '350425', '大田县');
INSERT INTO `shop_county` VALUES ('1068', '350426', '尤溪县');
INSERT INTO `shop_county` VALUES ('1069', '350427', '沙县');
INSERT INTO `shop_county` VALUES ('1070', '350428', '将乐县');
INSERT INTO `shop_county` VALUES ('1071', '350429', '泰宁县');
INSERT INTO `shop_county` VALUES ('1072', '350430', '建宁县');
INSERT INTO `shop_county` VALUES ('1073', '350481', '永安市');
INSERT INTO `shop_county` VALUES ('1074', '350502', '鲤城区');
INSERT INTO `shop_county` VALUES ('1075', '350503', '丰泽区');
INSERT INTO `shop_county` VALUES ('1076', '350504', '洛江区');
INSERT INTO `shop_county` VALUES ('1077', '350505', '泉港区');
INSERT INTO `shop_county` VALUES ('1078', '350521', '惠安县');
INSERT INTO `shop_county` VALUES ('1079', '350524', '安溪县');
INSERT INTO `shop_county` VALUES ('1080', '350525', '永春县');
INSERT INTO `shop_county` VALUES ('1081', '350526', '德化县');
INSERT INTO `shop_county` VALUES ('1082', '350527', '金门县');
INSERT INTO `shop_county` VALUES ('1083', '350581', '石狮市');
INSERT INTO `shop_county` VALUES ('1084', '350582', '晋江市');
INSERT INTO `shop_county` VALUES ('1085', '350583', '南安市');
INSERT INTO `shop_county` VALUES ('1086', '350602', '芗城区');
INSERT INTO `shop_county` VALUES ('1087', '350603', '龙文区');
INSERT INTO `shop_county` VALUES ('1088', '350622', '云霄县');
INSERT INTO `shop_county` VALUES ('1089', '350623', '漳浦县');
INSERT INTO `shop_county` VALUES ('1090', '350624', '诏安县');
INSERT INTO `shop_county` VALUES ('1091', '350625', '长泰县');
INSERT INTO `shop_county` VALUES ('1092', '350626', '东山县');
INSERT INTO `shop_county` VALUES ('1093', '350627', '南靖县');
INSERT INTO `shop_county` VALUES ('1094', '350628', '平和县');
INSERT INTO `shop_county` VALUES ('1095', '350629', '华安县');
INSERT INTO `shop_county` VALUES ('1096', '350681', '龙海市');
INSERT INTO `shop_county` VALUES ('1097', '350702', '延平区');
INSERT INTO `shop_county` VALUES ('1098', '350703', '建阳区');
INSERT INTO `shop_county` VALUES ('1099', '350721', '顺昌县');
INSERT INTO `shop_county` VALUES ('1100', '350722', '浦城县');
INSERT INTO `shop_county` VALUES ('1101', '350723', '光泽县');
INSERT INTO `shop_county` VALUES ('1102', '350724', '松溪县');
INSERT INTO `shop_county` VALUES ('1103', '350725', '政和县');
INSERT INTO `shop_county` VALUES ('1104', '350781', '邵武市');
INSERT INTO `shop_county` VALUES ('1105', '350782', '武夷山市');
INSERT INTO `shop_county` VALUES ('1106', '350783', '建瓯市');
INSERT INTO `shop_county` VALUES ('1107', '350802', '新罗区');
INSERT INTO `shop_county` VALUES ('1108', '350803', '永定区');
INSERT INTO `shop_county` VALUES ('1109', '350821', '长汀县');
INSERT INTO `shop_county` VALUES ('1110', '350823', '上杭县');
INSERT INTO `shop_county` VALUES ('1111', '350824', '武平县');
INSERT INTO `shop_county` VALUES ('1112', '350825', '连城县');
INSERT INTO `shop_county` VALUES ('1113', '350881', '漳平市');
INSERT INTO `shop_county` VALUES ('1114', '350902', '蕉城区');
INSERT INTO `shop_county` VALUES ('1115', '350921', '霞浦县');
INSERT INTO `shop_county` VALUES ('1116', '350922', '古田县');
INSERT INTO `shop_county` VALUES ('1117', '350923', '屏南县');
INSERT INTO `shop_county` VALUES ('1118', '350924', '寿宁县');
INSERT INTO `shop_county` VALUES ('1119', '350925', '周宁县');
INSERT INTO `shop_county` VALUES ('1120', '350926', '柘荣县');
INSERT INTO `shop_county` VALUES ('1121', '350981', '福安市');
INSERT INTO `shop_county` VALUES ('1122', '350982', '福鼎市');
INSERT INTO `shop_county` VALUES ('1123', '360102', '东湖区');
INSERT INTO `shop_county` VALUES ('1124', '360103', '西湖区');
INSERT INTO `shop_county` VALUES ('1125', '360104', '青云谱区');
INSERT INTO `shop_county` VALUES ('1126', '360105', '湾里区');
INSERT INTO `shop_county` VALUES ('1127', '360111', '青山湖区');
INSERT INTO `shop_county` VALUES ('1128', '360112', '新建区');
INSERT INTO `shop_county` VALUES ('1129', '360121', '南昌县');
INSERT INTO `shop_county` VALUES ('1130', '360123', '安义县');
INSERT INTO `shop_county` VALUES ('1131', '360124', '进贤县');
INSERT INTO `shop_county` VALUES ('1132', '360190', '经济技术开发区');
INSERT INTO `shop_county` VALUES ('1133', '360192', '高新区');
INSERT INTO `shop_county` VALUES ('1134', '360202', '昌江区');
INSERT INTO `shop_county` VALUES ('1135', '360203', '珠山区');
INSERT INTO `shop_county` VALUES ('1136', '360222', '浮梁县');
INSERT INTO `shop_county` VALUES ('1137', '360281', '乐平市');
INSERT INTO `shop_county` VALUES ('1138', '360302', '安源区');
INSERT INTO `shop_county` VALUES ('1139', '360313', '湘东区');
INSERT INTO `shop_county` VALUES ('1140', '360321', '莲花县');
INSERT INTO `shop_county` VALUES ('1141', '360322', '上栗县');
INSERT INTO `shop_county` VALUES ('1142', '360323', '芦溪县');
INSERT INTO `shop_county` VALUES ('1143', '360402', '濂溪区');
INSERT INTO `shop_county` VALUES ('1144', '360403', '浔阳区');
INSERT INTO `shop_county` VALUES ('1145', '360404', '柴桑区');
INSERT INTO `shop_county` VALUES ('1146', '360423', '武宁县');
INSERT INTO `shop_county` VALUES ('1147', '360424', '修水县');
INSERT INTO `shop_county` VALUES ('1148', '360425', '永修县');
INSERT INTO `shop_county` VALUES ('1149', '360426', '德安县');
INSERT INTO `shop_county` VALUES ('1150', '360428', '都昌县');
INSERT INTO `shop_county` VALUES ('1151', '360429', '湖口县');
INSERT INTO `shop_county` VALUES ('1152', '360430', '彭泽县');
INSERT INTO `shop_county` VALUES ('1153', '360481', '瑞昌市');
INSERT INTO `shop_county` VALUES ('1154', '360482', '共青城市');
INSERT INTO `shop_county` VALUES ('1155', '360483', '庐山市');
INSERT INTO `shop_county` VALUES ('1156', '360490', '经济技术开发区');
INSERT INTO `shop_county` VALUES ('1157', '360502', '渝水区');
INSERT INTO `shop_county` VALUES ('1158', '360521', '分宜县');
INSERT INTO `shop_county` VALUES ('1159', '360602', '月湖区');
INSERT INTO `shop_county` VALUES ('1160', '360622', '余江县');
INSERT INTO `shop_county` VALUES ('1161', '360681', '贵溪市');
INSERT INTO `shop_county` VALUES ('1162', '360702', '章贡区');
INSERT INTO `shop_county` VALUES ('1163', '360703', '南康区');
INSERT INTO `shop_county` VALUES ('1164', '360704', '赣县区');
INSERT INTO `shop_county` VALUES ('1165', '360722', '信丰县');
INSERT INTO `shop_county` VALUES ('1166', '360723', '大余县');
INSERT INTO `shop_county` VALUES ('1167', '360724', '上犹县');
INSERT INTO `shop_county` VALUES ('1168', '360725', '崇义县');
INSERT INTO `shop_county` VALUES ('1169', '360726', '安远县');
INSERT INTO `shop_county` VALUES ('1170', '360727', '龙南县');
INSERT INTO `shop_county` VALUES ('1171', '360728', '定南县');
INSERT INTO `shop_county` VALUES ('1172', '360729', '全南县');
INSERT INTO `shop_county` VALUES ('1173', '360730', '宁都县');
INSERT INTO `shop_county` VALUES ('1174', '360731', '于都县');
INSERT INTO `shop_county` VALUES ('1175', '360732', '兴国县');
INSERT INTO `shop_county` VALUES ('1176', '360733', '会昌县');
INSERT INTO `shop_county` VALUES ('1177', '360734', '寻乌县');
INSERT INTO `shop_county` VALUES ('1178', '360735', '石城县');
INSERT INTO `shop_county` VALUES ('1179', '360781', '瑞金市');
INSERT INTO `shop_county` VALUES ('1180', '360802', '吉州区');
INSERT INTO `shop_county` VALUES ('1181', '360803', '青原区');
INSERT INTO `shop_county` VALUES ('1182', '360821', '吉安县');
INSERT INTO `shop_county` VALUES ('1183', '360822', '吉水县');
INSERT INTO `shop_county` VALUES ('1184', '360823', '峡江县');
INSERT INTO `shop_county` VALUES ('1185', '360824', '新干县');
INSERT INTO `shop_county` VALUES ('1186', '360825', '永丰县');
INSERT INTO `shop_county` VALUES ('1187', '360826', '泰和县');
INSERT INTO `shop_county` VALUES ('1188', '360827', '遂川县');
INSERT INTO `shop_county` VALUES ('1189', '360828', '万安县');
INSERT INTO `shop_county` VALUES ('1190', '360829', '安福县');
INSERT INTO `shop_county` VALUES ('1191', '360830', '永新县');
INSERT INTO `shop_county` VALUES ('1192', '360881', '井冈山市');
INSERT INTO `shop_county` VALUES ('1193', '360902', '袁州区');
INSERT INTO `shop_county` VALUES ('1194', '360921', '奉新县');
INSERT INTO `shop_county` VALUES ('1195', '360922', '万载县');
INSERT INTO `shop_county` VALUES ('1196', '360923', '上高县');
INSERT INTO `shop_county` VALUES ('1197', '360924', '宜丰县');
INSERT INTO `shop_county` VALUES ('1198', '360925', '靖安县');
INSERT INTO `shop_county` VALUES ('1199', '360926', '铜鼓县');
INSERT INTO `shop_county` VALUES ('1200', '360981', '丰城市');
INSERT INTO `shop_county` VALUES ('1201', '360982', '樟树市');
INSERT INTO `shop_county` VALUES ('1202', '360983', '高安市');
INSERT INTO `shop_county` VALUES ('1203', '361002', '临川区');
INSERT INTO `shop_county` VALUES ('1204', '361003', '东乡区');
INSERT INTO `shop_county` VALUES ('1205', '361021', '南城县');
INSERT INTO `shop_county` VALUES ('1206', '361022', '黎川县');
INSERT INTO `shop_county` VALUES ('1207', '361023', '南丰县');
INSERT INTO `shop_county` VALUES ('1208', '361024', '崇仁县');
INSERT INTO `shop_county` VALUES ('1209', '361025', '乐安县');
INSERT INTO `shop_county` VALUES ('1210', '361026', '宜黄县');
INSERT INTO `shop_county` VALUES ('1211', '361027', '金溪县');
INSERT INTO `shop_county` VALUES ('1212', '361028', '资溪县');
INSERT INTO `shop_county` VALUES ('1213', '361030', '广昌县');
INSERT INTO `shop_county` VALUES ('1214', '361102', '信州区');
INSERT INTO `shop_county` VALUES ('1215', '361103', '广丰区');
INSERT INTO `shop_county` VALUES ('1216', '361121', '上饶县');
INSERT INTO `shop_county` VALUES ('1217', '361123', '玉山县');
INSERT INTO `shop_county` VALUES ('1218', '361124', '铅山县');
INSERT INTO `shop_county` VALUES ('1219', '361125', '横峰县');
INSERT INTO `shop_county` VALUES ('1220', '361126', '弋阳县');
INSERT INTO `shop_county` VALUES ('1221', '361127', '余干县');
INSERT INTO `shop_county` VALUES ('1222', '361128', '鄱阳县');
INSERT INTO `shop_county` VALUES ('1223', '361129', '万年县');
INSERT INTO `shop_county` VALUES ('1224', '361130', '婺源县');
INSERT INTO `shop_county` VALUES ('1225', '361181', '德兴市');
INSERT INTO `shop_county` VALUES ('1226', '370102', '历下区');
INSERT INTO `shop_county` VALUES ('1227', '370103', '市中区');
INSERT INTO `shop_county` VALUES ('1228', '370104', '槐荫区');
INSERT INTO `shop_county` VALUES ('1229', '370105', '天桥区');
INSERT INTO `shop_county` VALUES ('1230', '370112', '历城区');
INSERT INTO `shop_county` VALUES ('1231', '370113', '长清区');
INSERT INTO `shop_county` VALUES ('1232', '370114', '章丘区');
INSERT INTO `shop_county` VALUES ('1233', '370124', '平阴县');
INSERT INTO `shop_county` VALUES ('1234', '370125', '济阳县');
INSERT INTO `shop_county` VALUES ('1235', '370126', '商河县');
INSERT INTO `shop_county` VALUES ('1236', '370190', '高新区');
INSERT INTO `shop_county` VALUES ('1237', '370202', '市南区');
INSERT INTO `shop_county` VALUES ('1238', '370203', '市北区');
INSERT INTO `shop_county` VALUES ('1239', '370211', '黄岛区');
INSERT INTO `shop_county` VALUES ('1240', '370212', '崂山区');
INSERT INTO `shop_county` VALUES ('1241', '370213', '李沧区');
INSERT INTO `shop_county` VALUES ('1242', '370214', '城阳区');
INSERT INTO `shop_county` VALUES ('1243', '370215', '即墨区');
INSERT INTO `shop_county` VALUES ('1244', '370281', '胶州市');
INSERT INTO `shop_county` VALUES ('1245', '370283', '平度市');
INSERT INTO `shop_county` VALUES ('1246', '370285', '莱西市');
INSERT INTO `shop_county` VALUES ('1247', '370290', '开发区');
INSERT INTO `shop_county` VALUES ('1248', '370302', '淄川区');
INSERT INTO `shop_county` VALUES ('1249', '370303', '张店区');
INSERT INTO `shop_county` VALUES ('1250', '370304', '博山区');
INSERT INTO `shop_county` VALUES ('1251', '370305', '临淄区');
INSERT INTO `shop_county` VALUES ('1252', '370306', '周村区');
INSERT INTO `shop_county` VALUES ('1253', '370321', '桓台县');
INSERT INTO `shop_county` VALUES ('1254', '370322', '高青县');
INSERT INTO `shop_county` VALUES ('1255', '370323', '沂源县');
INSERT INTO `shop_county` VALUES ('1256', '370402', '市中区');
INSERT INTO `shop_county` VALUES ('1257', '370403', '薛城区');
INSERT INTO `shop_county` VALUES ('1258', '370404', '峄城区');
INSERT INTO `shop_county` VALUES ('1259', '370405', '台儿庄区');
INSERT INTO `shop_county` VALUES ('1260', '370406', '山亭区');
INSERT INTO `shop_county` VALUES ('1261', '370481', '滕州市');
INSERT INTO `shop_county` VALUES ('1262', '370502', '东营区');
INSERT INTO `shop_county` VALUES ('1263', '370503', '河口区');
INSERT INTO `shop_county` VALUES ('1264', '370505', '垦利区');
INSERT INTO `shop_county` VALUES ('1265', '370522', '利津县');
INSERT INTO `shop_county` VALUES ('1266', '370523', '广饶县');
INSERT INTO `shop_county` VALUES ('1267', '370602', '芝罘区');
INSERT INTO `shop_county` VALUES ('1268', '370611', '福山区');
INSERT INTO `shop_county` VALUES ('1269', '370612', '牟平区');
INSERT INTO `shop_county` VALUES ('1270', '370613', '莱山区');
INSERT INTO `shop_county` VALUES ('1271', '370634', '长岛县');
INSERT INTO `shop_county` VALUES ('1272', '370681', '龙口市');
INSERT INTO `shop_county` VALUES ('1273', '370682', '莱阳市');
INSERT INTO `shop_county` VALUES ('1274', '370683', '莱州市');
INSERT INTO `shop_county` VALUES ('1275', '370684', '蓬莱市');
INSERT INTO `shop_county` VALUES ('1276', '370685', '招远市');
INSERT INTO `shop_county` VALUES ('1277', '370686', '栖霞市');
INSERT INTO `shop_county` VALUES ('1278', '370687', '海阳市');
INSERT INTO `shop_county` VALUES ('1279', '370690', '开发区');
INSERT INTO `shop_county` VALUES ('1280', '370702', '潍城区');
INSERT INTO `shop_county` VALUES ('1281', '370703', '寒亭区');
INSERT INTO `shop_county` VALUES ('1282', '370704', '坊子区');
INSERT INTO `shop_county` VALUES ('1283', '370705', '奎文区');
INSERT INTO `shop_county` VALUES ('1284', '370724', '临朐县');
INSERT INTO `shop_county` VALUES ('1285', '370725', '昌乐县');
INSERT INTO `shop_county` VALUES ('1286', '370781', '青州市');
INSERT INTO `shop_county` VALUES ('1287', '370782', '诸城市');
INSERT INTO `shop_county` VALUES ('1288', '370783', '寿光市');
INSERT INTO `shop_county` VALUES ('1289', '370784', '安丘市');
INSERT INTO `shop_county` VALUES ('1290', '370785', '高密市');
INSERT INTO `shop_county` VALUES ('1291', '370786', '昌邑市');
INSERT INTO `shop_county` VALUES ('1292', '370790', '开发区');
INSERT INTO `shop_county` VALUES ('1293', '370791', '高新区');
INSERT INTO `shop_county` VALUES ('1294', '370811', '任城区');
INSERT INTO `shop_county` VALUES ('1295', '370812', '兖州区');
INSERT INTO `shop_county` VALUES ('1296', '370826', '微山县');
INSERT INTO `shop_county` VALUES ('1297', '370827', '鱼台县');
INSERT INTO `shop_county` VALUES ('1298', '370828', '金乡县');
INSERT INTO `shop_county` VALUES ('1299', '370829', '嘉祥县');
INSERT INTO `shop_county` VALUES ('1300', '370830', '汶上县');
INSERT INTO `shop_county` VALUES ('1301', '370831', '泗水县');
INSERT INTO `shop_county` VALUES ('1302', '370832', '梁山县');
INSERT INTO `shop_county` VALUES ('1303', '370881', '曲阜市');
INSERT INTO `shop_county` VALUES ('1304', '370883', '邹城市');
INSERT INTO `shop_county` VALUES ('1305', '370890', '高新区');
INSERT INTO `shop_county` VALUES ('1306', '370902', '泰山区');
INSERT INTO `shop_county` VALUES ('1307', '370911', '岱岳区');
INSERT INTO `shop_county` VALUES ('1308', '370921', '宁阳县');
INSERT INTO `shop_county` VALUES ('1309', '370923', '东平县');
INSERT INTO `shop_county` VALUES ('1310', '370982', '新泰市');
INSERT INTO `shop_county` VALUES ('1311', '370983', '肥城市');
INSERT INTO `shop_county` VALUES ('1312', '371002', '环翠区');
INSERT INTO `shop_county` VALUES ('1313', '371003', '文登区');
INSERT INTO `shop_county` VALUES ('1314', '371082', '荣成市');
INSERT INTO `shop_county` VALUES ('1315', '371083', '乳山市');
INSERT INTO `shop_county` VALUES ('1316', '371091', '经济技术开发区');
INSERT INTO `shop_county` VALUES ('1317', '371102', '东港区');
INSERT INTO `shop_county` VALUES ('1318', '371103', '岚山区');
INSERT INTO `shop_county` VALUES ('1319', '371121', '五莲县');
INSERT INTO `shop_county` VALUES ('1320', '371122', '莒县');
INSERT INTO `shop_county` VALUES ('1321', '371202', '莱城区');
INSERT INTO `shop_county` VALUES ('1322', '371203', '钢城区');
INSERT INTO `shop_county` VALUES ('1323', '371302', '兰山区');
INSERT INTO `shop_county` VALUES ('1324', '371311', '罗庄区');
INSERT INTO `shop_county` VALUES ('1325', '371312', '河东区');
INSERT INTO `shop_county` VALUES ('1326', '371321', '沂南县');
INSERT INTO `shop_county` VALUES ('1327', '371322', '郯城县');
INSERT INTO `shop_county` VALUES ('1328', '371323', '沂水县');
INSERT INTO `shop_county` VALUES ('1329', '371324', '兰陵县');
INSERT INTO `shop_county` VALUES ('1330', '371325', '费县');
INSERT INTO `shop_county` VALUES ('1331', '371326', '平邑县');
INSERT INTO `shop_county` VALUES ('1332', '371327', '莒南县');
INSERT INTO `shop_county` VALUES ('1333', '371328', '蒙阴县');
INSERT INTO `shop_county` VALUES ('1334', '371329', '临沭县');
INSERT INTO `shop_county` VALUES ('1335', '371402', '德城区');
INSERT INTO `shop_county` VALUES ('1336', '371403', '陵城区');
INSERT INTO `shop_county` VALUES ('1337', '371422', '宁津县');
INSERT INTO `shop_county` VALUES ('1338', '371423', '庆云县');
INSERT INTO `shop_county` VALUES ('1339', '371424', '临邑县');
INSERT INTO `shop_county` VALUES ('1340', '371425', '齐河县');
INSERT INTO `shop_county` VALUES ('1341', '371426', '平原县');
INSERT INTO `shop_county` VALUES ('1342', '371427', '夏津县');
INSERT INTO `shop_county` VALUES ('1343', '371428', '武城县');
INSERT INTO `shop_county` VALUES ('1344', '371481', '乐陵市');
INSERT INTO `shop_county` VALUES ('1345', '371482', '禹城市');
INSERT INTO `shop_county` VALUES ('1346', '371502', '东昌府区');
INSERT INTO `shop_county` VALUES ('1347', '371521', '阳谷县');
INSERT INTO `shop_county` VALUES ('1348', '371522', '莘县');
INSERT INTO `shop_county` VALUES ('1349', '371523', '茌平县');
INSERT INTO `shop_county` VALUES ('1350', '371524', '东阿县');
INSERT INTO `shop_county` VALUES ('1351', '371525', '冠县');
INSERT INTO `shop_county` VALUES ('1352', '371526', '高唐县');
INSERT INTO `shop_county` VALUES ('1353', '371581', '临清市');
INSERT INTO `shop_county` VALUES ('1354', '371602', '滨城区');
INSERT INTO `shop_county` VALUES ('1355', '371603', '沾化区');
INSERT INTO `shop_county` VALUES ('1356', '371621', '惠民县');
INSERT INTO `shop_county` VALUES ('1357', '371622', '阳信县');
INSERT INTO `shop_county` VALUES ('1358', '371623', '无棣县');
INSERT INTO `shop_county` VALUES ('1359', '371625', '博兴县');
INSERT INTO `shop_county` VALUES ('1360', '371626', '邹平县');
INSERT INTO `shop_county` VALUES ('1361', '371702', '牡丹区');
INSERT INTO `shop_county` VALUES ('1362', '371703', '定陶区');
INSERT INTO `shop_county` VALUES ('1363', '371721', '曹县');
INSERT INTO `shop_county` VALUES ('1364', '371722', '单县');
INSERT INTO `shop_county` VALUES ('1365', '371723', '成武县');
INSERT INTO `shop_county` VALUES ('1366', '371724', '巨野县');
INSERT INTO `shop_county` VALUES ('1367', '371725', '郓城县');
INSERT INTO `shop_county` VALUES ('1368', '371726', '鄄城县');
INSERT INTO `shop_county` VALUES ('1369', '371728', '东明县');
INSERT INTO `shop_county` VALUES ('1370', '410102', '中原区');
INSERT INTO `shop_county` VALUES ('1371', '410103', '二七区');
INSERT INTO `shop_county` VALUES ('1372', '410104', '管城回族区');
INSERT INTO `shop_county` VALUES ('1373', '410105', '金水区');
INSERT INTO `shop_county` VALUES ('1374', '410106', '上街区');
INSERT INTO `shop_county` VALUES ('1375', '410108', '惠济区');
INSERT INTO `shop_county` VALUES ('1376', '410122', '中牟县');
INSERT INTO `shop_county` VALUES ('1377', '410181', '巩义市');
INSERT INTO `shop_county` VALUES ('1378', '410182', '荥阳市');
INSERT INTO `shop_county` VALUES ('1379', '410183', '新密市');
INSERT INTO `shop_county` VALUES ('1380', '410184', '新郑市');
INSERT INTO `shop_county` VALUES ('1381', '410185', '登封市');
INSERT INTO `shop_county` VALUES ('1382', '410190', '高新技术开发区');
INSERT INTO `shop_county` VALUES ('1383', '410191', '经济技术开发区');
INSERT INTO `shop_county` VALUES ('1384', '410202', '龙亭区');
INSERT INTO `shop_county` VALUES ('1385', '410203', '顺河回族区');
INSERT INTO `shop_county` VALUES ('1386', '410204', '鼓楼区');
INSERT INTO `shop_county` VALUES ('1387', '410205', '禹王台区');
INSERT INTO `shop_county` VALUES ('1388', '410212', '祥符区');
INSERT INTO `shop_county` VALUES ('1389', '410221', '杞县');
INSERT INTO `shop_county` VALUES ('1390', '410222', '通许县');
INSERT INTO `shop_county` VALUES ('1391', '410223', '尉氏县');
INSERT INTO `shop_county` VALUES ('1392', '410225', '兰考县');
INSERT INTO `shop_county` VALUES ('1393', '410302', '老城区');
INSERT INTO `shop_county` VALUES ('1394', '410303', '西工区');
INSERT INTO `shop_county` VALUES ('1395', '410304', '瀍河回族区');
INSERT INTO `shop_county` VALUES ('1396', '410305', '涧西区');
INSERT INTO `shop_county` VALUES ('1397', '410306', '吉利区');
INSERT INTO `shop_county` VALUES ('1398', '410311', '洛龙区');
INSERT INTO `shop_county` VALUES ('1399', '410322', '孟津县');
INSERT INTO `shop_county` VALUES ('1400', '410323', '新安县');
INSERT INTO `shop_county` VALUES ('1401', '410324', '栾川县');
INSERT INTO `shop_county` VALUES ('1402', '410325', '嵩县');
INSERT INTO `shop_county` VALUES ('1403', '410326', '汝阳县');
INSERT INTO `shop_county` VALUES ('1404', '410327', '宜阳县');
INSERT INTO `shop_county` VALUES ('1405', '410328', '洛宁县');
INSERT INTO `shop_county` VALUES ('1406', '410329', '伊川县');
INSERT INTO `shop_county` VALUES ('1407', '410381', '偃师市');
INSERT INTO `shop_county` VALUES ('1408', '410402', '新华区');
INSERT INTO `shop_county` VALUES ('1409', '410403', '卫东区');
INSERT INTO `shop_county` VALUES ('1410', '410404', '石龙区');
INSERT INTO `shop_county` VALUES ('1411', '410411', '湛河区');
INSERT INTO `shop_county` VALUES ('1412', '410421', '宝丰县');
INSERT INTO `shop_county` VALUES ('1413', '410422', '叶县');
INSERT INTO `shop_county` VALUES ('1414', '410423', '鲁山县');
INSERT INTO `shop_county` VALUES ('1415', '410425', '郏县');
INSERT INTO `shop_county` VALUES ('1416', '410481', '舞钢市');
INSERT INTO `shop_county` VALUES ('1417', '410482', '汝州市');
INSERT INTO `shop_county` VALUES ('1418', '410502', '文峰区');
INSERT INTO `shop_county` VALUES ('1419', '410503', '北关区');
INSERT INTO `shop_county` VALUES ('1420', '410505', '殷都区');
INSERT INTO `shop_county` VALUES ('1421', '410506', '龙安区');
INSERT INTO `shop_county` VALUES ('1422', '410522', '安阳县');
INSERT INTO `shop_county` VALUES ('1423', '410523', '汤阴县');
INSERT INTO `shop_county` VALUES ('1424', '410526', '滑县');
INSERT INTO `shop_county` VALUES ('1425', '410527', '内黄县');
INSERT INTO `shop_county` VALUES ('1426', '410581', '林州市');
INSERT INTO `shop_county` VALUES ('1427', '410590', '开发区');
INSERT INTO `shop_county` VALUES ('1428', '410602', '鹤山区');
INSERT INTO `shop_county` VALUES ('1429', '410603', '山城区');
INSERT INTO `shop_county` VALUES ('1430', '410611', '淇滨区');
INSERT INTO `shop_county` VALUES ('1431', '410621', '浚县');
INSERT INTO `shop_county` VALUES ('1432', '410622', '淇县');
INSERT INTO `shop_county` VALUES ('1433', '410702', '红旗区');
INSERT INTO `shop_county` VALUES ('1434', '410703', '卫滨区');
INSERT INTO `shop_county` VALUES ('1435', '410704', '凤泉区');
INSERT INTO `shop_county` VALUES ('1436', '410711', '牧野区');
INSERT INTO `shop_county` VALUES ('1437', '410721', '新乡县');
INSERT INTO `shop_county` VALUES ('1438', '410724', '获嘉县');
INSERT INTO `shop_county` VALUES ('1439', '410725', '原阳县');
INSERT INTO `shop_county` VALUES ('1440', '410726', '延津县');
INSERT INTO `shop_county` VALUES ('1441', '410727', '封丘县');
INSERT INTO `shop_county` VALUES ('1442', '410728', '长垣县');
INSERT INTO `shop_county` VALUES ('1443', '410781', '卫辉市');
INSERT INTO `shop_county` VALUES ('1444', '410782', '辉县市');
INSERT INTO `shop_county` VALUES ('1445', '410802', '解放区');
INSERT INTO `shop_county` VALUES ('1446', '410803', '中站区');
INSERT INTO `shop_county` VALUES ('1447', '410804', '马村区');
INSERT INTO `shop_county` VALUES ('1448', '410811', '山阳区');
INSERT INTO `shop_county` VALUES ('1449', '410821', '修武县');
INSERT INTO `shop_county` VALUES ('1450', '410822', '博爱县');
INSERT INTO `shop_county` VALUES ('1451', '410823', '武陟县');
INSERT INTO `shop_county` VALUES ('1452', '410825', '温县');
INSERT INTO `shop_county` VALUES ('1453', '410882', '沁阳市');
INSERT INTO `shop_county` VALUES ('1454', '410883', '孟州市');
INSERT INTO `shop_county` VALUES ('1455', '410902', '华龙区');
INSERT INTO `shop_county` VALUES ('1456', '410922', '清丰县');
INSERT INTO `shop_county` VALUES ('1457', '410923', '南乐县');
INSERT INTO `shop_county` VALUES ('1458', '410926', '范县');
INSERT INTO `shop_county` VALUES ('1459', '410927', '台前县');
INSERT INTO `shop_county` VALUES ('1460', '410928', '濮阳县');
INSERT INTO `shop_county` VALUES ('1461', '411002', '魏都区');
INSERT INTO `shop_county` VALUES ('1462', '411003', '建安区');
INSERT INTO `shop_county` VALUES ('1463', '411024', '鄢陵县');
INSERT INTO `shop_county` VALUES ('1464', '411025', '襄城县');
INSERT INTO `shop_county` VALUES ('1465', '411081', '禹州市');
INSERT INTO `shop_county` VALUES ('1466', '411082', '长葛市');
INSERT INTO `shop_county` VALUES ('1467', '411102', '源汇区');
INSERT INTO `shop_county` VALUES ('1468', '411103', '郾城区');
INSERT INTO `shop_county` VALUES ('1469', '411104', '召陵区');
INSERT INTO `shop_county` VALUES ('1470', '411121', '舞阳县');
INSERT INTO `shop_county` VALUES ('1471', '411122', '临颍县');
INSERT INTO `shop_county` VALUES ('1472', '411202', '湖滨区');
INSERT INTO `shop_county` VALUES ('1473', '411203', '陕州区');
INSERT INTO `shop_county` VALUES ('1474', '411221', '渑池县');
INSERT INTO `shop_county` VALUES ('1475', '411224', '卢氏县');
INSERT INTO `shop_county` VALUES ('1476', '411281', '义马市');
INSERT INTO `shop_county` VALUES ('1477', '411282', '灵宝市');
INSERT INTO `shop_county` VALUES ('1478', '411302', '宛城区');
INSERT INTO `shop_county` VALUES ('1479', '411303', '卧龙区');
INSERT INTO `shop_county` VALUES ('1480', '411321', '南召县');
INSERT INTO `shop_county` VALUES ('1481', '411322', '方城县');
INSERT INTO `shop_county` VALUES ('1482', '411323', '西峡县');
INSERT INTO `shop_county` VALUES ('1483', '411324', '镇平县');
INSERT INTO `shop_county` VALUES ('1484', '411325', '内乡县');
INSERT INTO `shop_county` VALUES ('1485', '411326', '淅川县');
INSERT INTO `shop_county` VALUES ('1486', '411327', '社旗县');
INSERT INTO `shop_county` VALUES ('1487', '411328', '唐河县');
INSERT INTO `shop_county` VALUES ('1488', '411329', '新野县');
INSERT INTO `shop_county` VALUES ('1489', '411330', '桐柏县');
INSERT INTO `shop_county` VALUES ('1490', '411381', '邓州市');
INSERT INTO `shop_county` VALUES ('1491', '411402', '梁园区');
INSERT INTO `shop_county` VALUES ('1492', '411403', '睢阳区');
INSERT INTO `shop_county` VALUES ('1493', '411421', '民权县');
INSERT INTO `shop_county` VALUES ('1494', '411422', '睢县');
INSERT INTO `shop_county` VALUES ('1495', '411423', '宁陵县');
INSERT INTO `shop_county` VALUES ('1496', '411424', '柘城县');
INSERT INTO `shop_county` VALUES ('1497', '411425', '虞城县');
INSERT INTO `shop_county` VALUES ('1498', '411426', '夏邑县');
INSERT INTO `shop_county` VALUES ('1499', '411481', '永城市');
INSERT INTO `shop_county` VALUES ('1500', '411502', '浉河区');
INSERT INTO `shop_county` VALUES ('1501', '411503', '平桥区');
INSERT INTO `shop_county` VALUES ('1502', '411521', '罗山县');
INSERT INTO `shop_county` VALUES ('1503', '411522', '光山县');
INSERT INTO `shop_county` VALUES ('1504', '411523', '新县');
INSERT INTO `shop_county` VALUES ('1505', '411524', '商城县');
INSERT INTO `shop_county` VALUES ('1506', '411525', '固始县');
INSERT INTO `shop_county` VALUES ('1507', '411526', '潢川县');
INSERT INTO `shop_county` VALUES ('1508', '411527', '淮滨县');
INSERT INTO `shop_county` VALUES ('1509', '411528', '息县');
INSERT INTO `shop_county` VALUES ('1510', '411602', '川汇区');
INSERT INTO `shop_county` VALUES ('1511', '411621', '扶沟县');
INSERT INTO `shop_county` VALUES ('1512', '411622', '西华县');
INSERT INTO `shop_county` VALUES ('1513', '411623', '商水县');
INSERT INTO `shop_county` VALUES ('1514', '411624', '沈丘县');
INSERT INTO `shop_county` VALUES ('1515', '411625', '郸城县');
INSERT INTO `shop_county` VALUES ('1516', '411626', '淮阳县');
INSERT INTO `shop_county` VALUES ('1517', '411627', '太康县');
INSERT INTO `shop_county` VALUES ('1518', '411628', '鹿邑县');
INSERT INTO `shop_county` VALUES ('1519', '411681', '项城市');
INSERT INTO `shop_county` VALUES ('1520', '411690', '经济开发区');
INSERT INTO `shop_county` VALUES ('1521', '411702', '驿城区');
INSERT INTO `shop_county` VALUES ('1522', '411721', '西平县');
INSERT INTO `shop_county` VALUES ('1523', '411722', '上蔡县');
INSERT INTO `shop_county` VALUES ('1524', '411723', '平舆县');
INSERT INTO `shop_county` VALUES ('1525', '411724', '正阳县');
INSERT INTO `shop_county` VALUES ('1526', '411725', '确山县');
INSERT INTO `shop_county` VALUES ('1527', '411726', '泌阳县');
INSERT INTO `shop_county` VALUES ('1528', '411727', '汝南县');
INSERT INTO `shop_county` VALUES ('1529', '411728', '遂平县');
INSERT INTO `shop_county` VALUES ('1530', '411729', '新蔡县');
INSERT INTO `shop_county` VALUES ('1531', '419001', '济源市');
INSERT INTO `shop_county` VALUES ('1532', '420102', '江岸区');
INSERT INTO `shop_county` VALUES ('1533', '420103', '江汉区');
INSERT INTO `shop_county` VALUES ('1534', '420104', '硚口区');
INSERT INTO `shop_county` VALUES ('1535', '420105', '汉阳区');
INSERT INTO `shop_county` VALUES ('1536', '420106', '武昌区');
INSERT INTO `shop_county` VALUES ('1537', '420107', '青山区');
INSERT INTO `shop_county` VALUES ('1538', '420111', '洪山区');
INSERT INTO `shop_county` VALUES ('1539', '420112', '东西湖区');
INSERT INTO `shop_county` VALUES ('1540', '420113', '汉南区');
INSERT INTO `shop_county` VALUES ('1541', '420114', '蔡甸区');
INSERT INTO `shop_county` VALUES ('1542', '420115', '江夏区');
INSERT INTO `shop_county` VALUES ('1543', '420116', '黄陂区');
INSERT INTO `shop_county` VALUES ('1544', '420117', '新洲区');
INSERT INTO `shop_county` VALUES ('1545', '420202', '黄石港区');
INSERT INTO `shop_county` VALUES ('1546', '420203', '西塞山区');
INSERT INTO `shop_county` VALUES ('1547', '420204', '下陆区');
INSERT INTO `shop_county` VALUES ('1548', '420205', '铁山区');
INSERT INTO `shop_county` VALUES ('1549', '420222', '阳新县');
INSERT INTO `shop_county` VALUES ('1550', '420281', '大冶市');
INSERT INTO `shop_county` VALUES ('1551', '420302', '茅箭区');
INSERT INTO `shop_county` VALUES ('1552', '420303', '张湾区');
INSERT INTO `shop_county` VALUES ('1553', '420304', '郧阳区');
INSERT INTO `shop_county` VALUES ('1554', '420322', '郧西县');
INSERT INTO `shop_county` VALUES ('1555', '420323', '竹山县');
INSERT INTO `shop_county` VALUES ('1556', '420324', '竹溪县');
INSERT INTO `shop_county` VALUES ('1557', '420325', '房县');
INSERT INTO `shop_county` VALUES ('1558', '420381', '丹江口市');
INSERT INTO `shop_county` VALUES ('1559', '420502', '西陵区');
INSERT INTO `shop_county` VALUES ('1560', '420503', '伍家岗区');
INSERT INTO `shop_county` VALUES ('1561', '420504', '点军区');
INSERT INTO `shop_county` VALUES ('1562', '420505', '猇亭区');
INSERT INTO `shop_county` VALUES ('1563', '420506', '夷陵区');
INSERT INTO `shop_county` VALUES ('1564', '420525', '远安县');
INSERT INTO `shop_county` VALUES ('1565', '420526', '兴山县');
INSERT INTO `shop_county` VALUES ('1566', '420527', '秭归县');
INSERT INTO `shop_county` VALUES ('1567', '420528', '长阳土家族自治县');
INSERT INTO `shop_county` VALUES ('1568', '420529', '五峰土家族自治县');
INSERT INTO `shop_county` VALUES ('1569', '420581', '宜都市');
INSERT INTO `shop_county` VALUES ('1570', '420582', '当阳市');
INSERT INTO `shop_county` VALUES ('1571', '420583', '枝江市');
INSERT INTO `shop_county` VALUES ('1572', '420590', '经济开发区');
INSERT INTO `shop_county` VALUES ('1573', '420602', '襄城区');
INSERT INTO `shop_county` VALUES ('1574', '420606', '樊城区');
INSERT INTO `shop_county` VALUES ('1575', '420607', '襄州区');
INSERT INTO `shop_county` VALUES ('1576', '420624', '南漳县');
INSERT INTO `shop_county` VALUES ('1577', '420625', '谷城县');
INSERT INTO `shop_county` VALUES ('1578', '420626', '保康县');
INSERT INTO `shop_county` VALUES ('1579', '420682', '老河口市');
INSERT INTO `shop_county` VALUES ('1580', '420683', '枣阳市');
INSERT INTO `shop_county` VALUES ('1581', '420684', '宜城市');
INSERT INTO `shop_county` VALUES ('1582', '420702', '梁子湖区');
INSERT INTO `shop_county` VALUES ('1583', '420703', '华容区');
INSERT INTO `shop_county` VALUES ('1584', '420704', '鄂城区');
INSERT INTO `shop_county` VALUES ('1585', '420802', '东宝区');
INSERT INTO `shop_county` VALUES ('1586', '420804', '掇刀区');
INSERT INTO `shop_county` VALUES ('1587', '420821', '京山县');
INSERT INTO `shop_county` VALUES ('1588', '420822', '沙洋县');
INSERT INTO `shop_county` VALUES ('1589', '420881', '钟祥市');
INSERT INTO `shop_county` VALUES ('1590', '420902', '孝南区');
INSERT INTO `shop_county` VALUES ('1591', '420921', '孝昌县');
INSERT INTO `shop_county` VALUES ('1592', '420922', '大悟县');
INSERT INTO `shop_county` VALUES ('1593', '420923', '云梦县');
INSERT INTO `shop_county` VALUES ('1594', '420981', '应城市');
INSERT INTO `shop_county` VALUES ('1595', '420982', '安陆市');
INSERT INTO `shop_county` VALUES ('1596', '420984', '汉川市');
INSERT INTO `shop_county` VALUES ('1597', '421002', '沙市区');
INSERT INTO `shop_county` VALUES ('1598', '421003', '荆州区');
INSERT INTO `shop_county` VALUES ('1599', '421022', '公安县');
INSERT INTO `shop_county` VALUES ('1600', '421023', '监利县');
INSERT INTO `shop_county` VALUES ('1601', '421024', '江陵县');
INSERT INTO `shop_county` VALUES ('1602', '421081', '石首市');
INSERT INTO `shop_county` VALUES ('1603', '421083', '洪湖市');
INSERT INTO `shop_county` VALUES ('1604', '421087', '松滋市');
INSERT INTO `shop_county` VALUES ('1605', '421102', '黄州区');
INSERT INTO `shop_county` VALUES ('1606', '421121', '团风县');
INSERT INTO `shop_county` VALUES ('1607', '421122', '红安县');
INSERT INTO `shop_county` VALUES ('1608', '421123', '罗田县');
INSERT INTO `shop_county` VALUES ('1609', '421124', '英山县');
INSERT INTO `shop_county` VALUES ('1610', '421125', '浠水县');
INSERT INTO `shop_county` VALUES ('1611', '421126', '蕲春县');
INSERT INTO `shop_county` VALUES ('1612', '421127', '黄梅县');
INSERT INTO `shop_county` VALUES ('1613', '421181', '麻城市');
INSERT INTO `shop_county` VALUES ('1614', '421182', '武穴市');
INSERT INTO `shop_county` VALUES ('1615', '421202', '咸安区');
INSERT INTO `shop_county` VALUES ('1616', '421221', '嘉鱼县');
INSERT INTO `shop_county` VALUES ('1617', '421222', '通城县');
INSERT INTO `shop_county` VALUES ('1618', '421223', '崇阳县');
INSERT INTO `shop_county` VALUES ('1619', '421224', '通山县');
INSERT INTO `shop_county` VALUES ('1620', '421281', '赤壁市');
INSERT INTO `shop_county` VALUES ('1621', '421303', '曾都区');
INSERT INTO `shop_county` VALUES ('1622', '421321', '随县');
INSERT INTO `shop_county` VALUES ('1623', '421381', '广水市');
INSERT INTO `shop_county` VALUES ('1624', '422801', '恩施市');
INSERT INTO `shop_county` VALUES ('1625', '422802', '利川市');
INSERT INTO `shop_county` VALUES ('1626', '422822', '建始县');
INSERT INTO `shop_county` VALUES ('1627', '422823', '巴东县');
INSERT INTO `shop_county` VALUES ('1628', '422825', '宣恩县');
INSERT INTO `shop_county` VALUES ('1629', '422826', '咸丰县');
INSERT INTO `shop_county` VALUES ('1630', '422827', '来凤县');
INSERT INTO `shop_county` VALUES ('1631', '422828', '鹤峰县');
INSERT INTO `shop_county` VALUES ('1632', '429004', '仙桃市');
INSERT INTO `shop_county` VALUES ('1633', '429005', '潜江市');
INSERT INTO `shop_county` VALUES ('1634', '429006', '天门市');
INSERT INTO `shop_county` VALUES ('1635', '429021', '神农架林区');
INSERT INTO `shop_county` VALUES ('1636', '430102', '芙蓉区');
INSERT INTO `shop_county` VALUES ('1637', '430103', '天心区');
INSERT INTO `shop_county` VALUES ('1638', '430104', '岳麓区');
INSERT INTO `shop_county` VALUES ('1639', '430105', '开福区');
INSERT INTO `shop_county` VALUES ('1640', '430111', '雨花区');
INSERT INTO `shop_county` VALUES ('1641', '430112', '望城区');
INSERT INTO `shop_county` VALUES ('1642', '430121', '长沙县');
INSERT INTO `shop_county` VALUES ('1643', '430181', '浏阳市');
INSERT INTO `shop_county` VALUES ('1644', '430182', '宁乡市');
INSERT INTO `shop_county` VALUES ('1645', '430202', '荷塘区');
INSERT INTO `shop_county` VALUES ('1646', '430203', '芦淞区');
INSERT INTO `shop_county` VALUES ('1647', '430204', '石峰区');
INSERT INTO `shop_county` VALUES ('1648', '430211', '天元区');
INSERT INTO `shop_county` VALUES ('1649', '430221', '株洲县');
INSERT INTO `shop_county` VALUES ('1650', '430223', '攸县');
INSERT INTO `shop_county` VALUES ('1651', '430224', '茶陵县');
INSERT INTO `shop_county` VALUES ('1652', '430225', '炎陵县');
INSERT INTO `shop_county` VALUES ('1653', '430281', '醴陵市');
INSERT INTO `shop_county` VALUES ('1654', '430302', '雨湖区');
INSERT INTO `shop_county` VALUES ('1655', '430304', '岳塘区');
INSERT INTO `shop_county` VALUES ('1656', '430321', '湘潭县');
INSERT INTO `shop_county` VALUES ('1657', '430381', '湘乡市');
INSERT INTO `shop_county` VALUES ('1658', '430382', '韶山市');
INSERT INTO `shop_county` VALUES ('1659', '430405', '珠晖区');
INSERT INTO `shop_county` VALUES ('1660', '430406', '雁峰区');
INSERT INTO `shop_county` VALUES ('1661', '430407', '石鼓区');
INSERT INTO `shop_county` VALUES ('1662', '430408', '蒸湘区');
INSERT INTO `shop_county` VALUES ('1663', '430412', '南岳区');
INSERT INTO `shop_county` VALUES ('1664', '430421', '衡阳县');
INSERT INTO `shop_county` VALUES ('1665', '430422', '衡南县');
INSERT INTO `shop_county` VALUES ('1666', '430423', '衡山县');
INSERT INTO `shop_county` VALUES ('1667', '430424', '衡东县');
INSERT INTO `shop_county` VALUES ('1668', '430426', '祁东县');
INSERT INTO `shop_county` VALUES ('1669', '430481', '耒阳市');
INSERT INTO `shop_county` VALUES ('1670', '430482', '常宁市');
INSERT INTO `shop_county` VALUES ('1671', '430502', '双清区');
INSERT INTO `shop_county` VALUES ('1672', '430503', '大祥区');
INSERT INTO `shop_county` VALUES ('1673', '430511', '北塔区');
INSERT INTO `shop_county` VALUES ('1674', '430521', '邵东县');
INSERT INTO `shop_county` VALUES ('1675', '430522', '新邵县');
INSERT INTO `shop_county` VALUES ('1676', '430523', '邵阳县');
INSERT INTO `shop_county` VALUES ('1677', '430524', '隆回县');
INSERT INTO `shop_county` VALUES ('1678', '430525', '洞口县');
INSERT INTO `shop_county` VALUES ('1679', '430527', '绥宁县');
INSERT INTO `shop_county` VALUES ('1680', '430528', '新宁县');
INSERT INTO `shop_county` VALUES ('1681', '430529', '城步苗族自治县');
INSERT INTO `shop_county` VALUES ('1682', '430581', '武冈市');
INSERT INTO `shop_county` VALUES ('1683', '430602', '岳阳楼区');
INSERT INTO `shop_county` VALUES ('1684', '430603', '云溪区');
INSERT INTO `shop_county` VALUES ('1685', '430611', '君山区');
INSERT INTO `shop_county` VALUES ('1686', '430621', '岳阳县');
INSERT INTO `shop_county` VALUES ('1687', '430623', '华容县');
INSERT INTO `shop_county` VALUES ('1688', '430624', '湘阴县');
INSERT INTO `shop_county` VALUES ('1689', '430626', '平江县');
INSERT INTO `shop_county` VALUES ('1690', '430681', '汨罗市');
INSERT INTO `shop_county` VALUES ('1691', '430682', '临湘市');
INSERT INTO `shop_county` VALUES ('1692', '430702', '武陵区');
INSERT INTO `shop_county` VALUES ('1693', '430703', '鼎城区');
INSERT INTO `shop_county` VALUES ('1694', '430721', '安乡县');
INSERT INTO `shop_county` VALUES ('1695', '430722', '汉寿县');
INSERT INTO `shop_county` VALUES ('1696', '430723', '澧县');
INSERT INTO `shop_county` VALUES ('1697', '430724', '临澧县');
INSERT INTO `shop_county` VALUES ('1698', '430725', '桃源县');
INSERT INTO `shop_county` VALUES ('1699', '430726', '石门县');
INSERT INTO `shop_county` VALUES ('1700', '430781', '津市市');
INSERT INTO `shop_county` VALUES ('1701', '430802', '永定区');
INSERT INTO `shop_county` VALUES ('1702', '430811', '武陵源区');
INSERT INTO `shop_county` VALUES ('1703', '430821', '慈利县');
INSERT INTO `shop_county` VALUES ('1704', '430822', '桑植县');
INSERT INTO `shop_county` VALUES ('1705', '430902', '资阳区');
INSERT INTO `shop_county` VALUES ('1706', '430903', '赫山区');
INSERT INTO `shop_county` VALUES ('1707', '430921', '南县');
INSERT INTO `shop_county` VALUES ('1708', '430922', '桃江县');
INSERT INTO `shop_county` VALUES ('1709', '430923', '安化县');
INSERT INTO `shop_county` VALUES ('1710', '430981', '沅江市');
INSERT INTO `shop_county` VALUES ('1711', '431002', '北湖区');
INSERT INTO `shop_county` VALUES ('1712', '431003', '苏仙区');
INSERT INTO `shop_county` VALUES ('1713', '431021', '桂阳县');
INSERT INTO `shop_county` VALUES ('1714', '431022', '宜章县');
INSERT INTO `shop_county` VALUES ('1715', '431023', '永兴县');
INSERT INTO `shop_county` VALUES ('1716', '431024', '嘉禾县');
INSERT INTO `shop_county` VALUES ('1717', '431025', '临武县');
INSERT INTO `shop_county` VALUES ('1718', '431026', '汝城县');
INSERT INTO `shop_county` VALUES ('1719', '431027', '桂东县');
INSERT INTO `shop_county` VALUES ('1720', '431028', '安仁县');
INSERT INTO `shop_county` VALUES ('1721', '431081', '资兴市');
INSERT INTO `shop_county` VALUES ('1722', '431102', '零陵区');
INSERT INTO `shop_county` VALUES ('1723', '431103', '冷水滩区');
INSERT INTO `shop_county` VALUES ('1724', '431121', '祁阳县');
INSERT INTO `shop_county` VALUES ('1725', '431122', '东安县');
INSERT INTO `shop_county` VALUES ('1726', '431123', '双牌县');
INSERT INTO `shop_county` VALUES ('1727', '431124', '道县');
INSERT INTO `shop_county` VALUES ('1728', '431125', '江永县');
INSERT INTO `shop_county` VALUES ('1729', '431126', '宁远县');
INSERT INTO `shop_county` VALUES ('1730', '431127', '蓝山县');
INSERT INTO `shop_county` VALUES ('1731', '431128', '新田县');
INSERT INTO `shop_county` VALUES ('1732', '431129', '江华瑶族自治县');
INSERT INTO `shop_county` VALUES ('1733', '431202', '鹤城区');
INSERT INTO `shop_county` VALUES ('1734', '431221', '中方县');
INSERT INTO `shop_county` VALUES ('1735', '431222', '沅陵县');
INSERT INTO `shop_county` VALUES ('1736', '431223', '辰溪县');
INSERT INTO `shop_county` VALUES ('1737', '431224', '溆浦县');
INSERT INTO `shop_county` VALUES ('1738', '431225', '会同县');
INSERT INTO `shop_county` VALUES ('1739', '431226', '麻阳苗族自治县');
INSERT INTO `shop_county` VALUES ('1740', '431227', '新晃侗族自治县');
INSERT INTO `shop_county` VALUES ('1741', '431228', '芷江侗族自治县');
INSERT INTO `shop_county` VALUES ('1742', '431229', '靖州苗族侗族自治县');
INSERT INTO `shop_county` VALUES ('1743', '431230', '通道侗族自治县');
INSERT INTO `shop_county` VALUES ('1744', '431281', '洪江市');
INSERT INTO `shop_county` VALUES ('1745', '431302', '娄星区');
INSERT INTO `shop_county` VALUES ('1746', '431321', '双峰县');
INSERT INTO `shop_county` VALUES ('1747', '431322', '新化县');
INSERT INTO `shop_county` VALUES ('1748', '431381', '冷水江市');
INSERT INTO `shop_county` VALUES ('1749', '431382', '涟源市');
INSERT INTO `shop_county` VALUES ('1750', '433101', '吉首市');
INSERT INTO `shop_county` VALUES ('1751', '433122', '泸溪县');
INSERT INTO `shop_county` VALUES ('1752', '433123', '凤凰县');
INSERT INTO `shop_county` VALUES ('1753', '433124', '花垣县');
INSERT INTO `shop_county` VALUES ('1754', '433125', '保靖县');
INSERT INTO `shop_county` VALUES ('1755', '433126', '古丈县');
INSERT INTO `shop_county` VALUES ('1756', '433127', '永顺县');
INSERT INTO `shop_county` VALUES ('1757', '433130', '龙山县');
INSERT INTO `shop_county` VALUES ('1758', '440103', '荔湾区');
INSERT INTO `shop_county` VALUES ('1759', '440104', '越秀区');
INSERT INTO `shop_county` VALUES ('1760', '440105', '海珠区');
INSERT INTO `shop_county` VALUES ('1761', '440106', '天河区');
INSERT INTO `shop_county` VALUES ('1762', '440111', '白云区');
INSERT INTO `shop_county` VALUES ('1763', '440112', '黄埔区');
INSERT INTO `shop_county` VALUES ('1764', '440113', '番禺区');
INSERT INTO `shop_county` VALUES ('1765', '440114', '花都区');
INSERT INTO `shop_county` VALUES ('1766', '440115', '南沙区');
INSERT INTO `shop_county` VALUES ('1767', '440117', '从化区');
INSERT INTO `shop_county` VALUES ('1768', '440118', '增城区');
INSERT INTO `shop_county` VALUES ('1769', '440203', '武江区');
INSERT INTO `shop_county` VALUES ('1770', '440204', '浈江区');
INSERT INTO `shop_county` VALUES ('1771', '440205', '曲江区');
INSERT INTO `shop_county` VALUES ('1772', '440222', '始兴县');
INSERT INTO `shop_county` VALUES ('1773', '440224', '仁化县');
INSERT INTO `shop_county` VALUES ('1774', '440229', '翁源县');
INSERT INTO `shop_county` VALUES ('1775', '440232', '乳源瑶族自治县');
INSERT INTO `shop_county` VALUES ('1776', '440233', '新丰县');
INSERT INTO `shop_county` VALUES ('1777', '440281', '乐昌市');
INSERT INTO `shop_county` VALUES ('1778', '440282', '南雄市');
INSERT INTO `shop_county` VALUES ('1779', '440303', '罗湖区');
INSERT INTO `shop_county` VALUES ('1780', '440304', '福田区');
INSERT INTO `shop_county` VALUES ('1781', '440305', '南山区');
INSERT INTO `shop_county` VALUES ('1782', '440306', '宝安区');
INSERT INTO `shop_county` VALUES ('1783', '440307', '龙岗区');
INSERT INTO `shop_county` VALUES ('1784', '440308', '盐田区');
INSERT INTO `shop_county` VALUES ('1785', '440309', '龙华区');
INSERT INTO `shop_county` VALUES ('1786', '440310', '坪山区');
INSERT INTO `shop_county` VALUES ('1787', '440402', '香洲区');
INSERT INTO `shop_county` VALUES ('1788', '440403', '斗门区');
INSERT INTO `shop_county` VALUES ('1789', '440404', '金湾区');
INSERT INTO `shop_county` VALUES ('1790', '440507', '龙湖区');
INSERT INTO `shop_county` VALUES ('1791', '440511', '金平区');
INSERT INTO `shop_county` VALUES ('1792', '440512', '濠江区');
INSERT INTO `shop_county` VALUES ('1793', '440513', '潮阳区');
INSERT INTO `shop_county` VALUES ('1794', '440514', '潮南区');
INSERT INTO `shop_county` VALUES ('1795', '440515', '澄海区');
INSERT INTO `shop_county` VALUES ('1796', '440523', '南澳县');
INSERT INTO `shop_county` VALUES ('1797', '440604', '禅城区');
INSERT INTO `shop_county` VALUES ('1798', '440605', '南海区');
INSERT INTO `shop_county` VALUES ('1799', '440606', '顺德区');
INSERT INTO `shop_county` VALUES ('1800', '440607', '三水区');
INSERT INTO `shop_county` VALUES ('1801', '440608', '高明区');
INSERT INTO `shop_county` VALUES ('1802', '440703', '蓬江区');
INSERT INTO `shop_county` VALUES ('1803', '440704', '江海区');
INSERT INTO `shop_county` VALUES ('1804', '440705', '新会区');
INSERT INTO `shop_county` VALUES ('1805', '440781', '台山市');
INSERT INTO `shop_county` VALUES ('1806', '440783', '开平市');
INSERT INTO `shop_county` VALUES ('1807', '440784', '鹤山市');
INSERT INTO `shop_county` VALUES ('1808', '440785', '恩平市');
INSERT INTO `shop_county` VALUES ('1809', '440802', '赤坎区');
INSERT INTO `shop_county` VALUES ('1810', '440803', '霞山区');
INSERT INTO `shop_county` VALUES ('1811', '440804', '坡头区');
INSERT INTO `shop_county` VALUES ('1812', '440811', '麻章区');
INSERT INTO `shop_county` VALUES ('1813', '440823', '遂溪县');
INSERT INTO `shop_county` VALUES ('1814', '440825', '徐闻县');
INSERT INTO `shop_county` VALUES ('1815', '440881', '廉江市');
INSERT INTO `shop_county` VALUES ('1816', '440882', '雷州市');
INSERT INTO `shop_county` VALUES ('1817', '440883', '吴川市');
INSERT INTO `shop_county` VALUES ('1818', '440890', '经济技术开发区');
INSERT INTO `shop_county` VALUES ('1819', '440902', '茂南区');
INSERT INTO `shop_county` VALUES ('1820', '440904', '电白区');
INSERT INTO `shop_county` VALUES ('1821', '440981', '高州市');
INSERT INTO `shop_county` VALUES ('1822', '440982', '化州市');
INSERT INTO `shop_county` VALUES ('1823', '440983', '信宜市');
INSERT INTO `shop_county` VALUES ('1824', '441202', '端州区');
INSERT INTO `shop_county` VALUES ('1825', '441203', '鼎湖区');
INSERT INTO `shop_county` VALUES ('1826', '441204', '高要区');
INSERT INTO `shop_county` VALUES ('1827', '441223', '广宁县');
INSERT INTO `shop_county` VALUES ('1828', '441224', '怀集县');
INSERT INTO `shop_county` VALUES ('1829', '441225', '封开县');
INSERT INTO `shop_county` VALUES ('1830', '441226', '德庆县');
INSERT INTO `shop_county` VALUES ('1831', '441284', '四会市');
INSERT INTO `shop_county` VALUES ('1832', '441302', '惠城区');
INSERT INTO `shop_county` VALUES ('1833', '441303', '惠阳区');
INSERT INTO `shop_county` VALUES ('1834', '441322', '博罗县');
INSERT INTO `shop_county` VALUES ('1835', '441323', '惠东县');
INSERT INTO `shop_county` VALUES ('1836', '441324', '龙门县');
INSERT INTO `shop_county` VALUES ('1837', '441402', '梅江区');
INSERT INTO `shop_county` VALUES ('1838', '441403', '梅县区');
INSERT INTO `shop_county` VALUES ('1839', '441422', '大埔县');
INSERT INTO `shop_county` VALUES ('1840', '441423', '丰顺县');
INSERT INTO `shop_county` VALUES ('1841', '441424', '五华县');
INSERT INTO `shop_county` VALUES ('1842', '441426', '平远县');
INSERT INTO `shop_county` VALUES ('1843', '441427', '蕉岭县');
INSERT INTO `shop_county` VALUES ('1844', '441481', '兴宁市');
INSERT INTO `shop_county` VALUES ('1845', '441502', '城区');
INSERT INTO `shop_county` VALUES ('1846', '441521', '海丰县');
INSERT INTO `shop_county` VALUES ('1847', '441523', '陆河县');
INSERT INTO `shop_county` VALUES ('1848', '441581', '陆丰市');
INSERT INTO `shop_county` VALUES ('1849', '441602', '源城区');
INSERT INTO `shop_county` VALUES ('1850', '441621', '紫金县');
INSERT INTO `shop_county` VALUES ('1851', '441622', '龙川县');
INSERT INTO `shop_county` VALUES ('1852', '441623', '连平县');
INSERT INTO `shop_county` VALUES ('1853', '441624', '和平县');
INSERT INTO `shop_county` VALUES ('1854', '441625', '东源县');
INSERT INTO `shop_county` VALUES ('1855', '441702', '江城区');
INSERT INTO `shop_county` VALUES ('1856', '441704', '阳东区');
INSERT INTO `shop_county` VALUES ('1857', '441721', '阳西县');
INSERT INTO `shop_county` VALUES ('1858', '441781', '阳春市');
INSERT INTO `shop_county` VALUES ('1859', '441802', '清城区');
INSERT INTO `shop_county` VALUES ('1860', '441803', '清新区');
INSERT INTO `shop_county` VALUES ('1861', '441821', '佛冈县');
INSERT INTO `shop_county` VALUES ('1862', '441823', '阳山县');
INSERT INTO `shop_county` VALUES ('1863', '441825', '连山壮族瑶族自治县');
INSERT INTO `shop_county` VALUES ('1864', '441826', '连南瑶族自治县');
INSERT INTO `shop_county` VALUES ('1865', '441881', '英德市');
INSERT INTO `shop_county` VALUES ('1866', '441882', '连州市');
INSERT INTO `shop_county` VALUES ('1867', '441901', '中堂镇');
INSERT INTO `shop_county` VALUES ('1868', '441903', '南城区');
INSERT INTO `shop_county` VALUES ('1869', '441904', '长安镇');
INSERT INTO `shop_county` VALUES ('1870', '441905', '东坑镇');
INSERT INTO `shop_county` VALUES ('1871', '441906', '樟木头镇');
INSERT INTO `shop_county` VALUES ('1872', '441907', '莞城区');
INSERT INTO `shop_county` VALUES ('1873', '441908', '石龙镇');
INSERT INTO `shop_county` VALUES ('1874', '441909', '桥头镇');
INSERT INTO `shop_county` VALUES ('1875', '441910', '万江区');
INSERT INTO `shop_county` VALUES ('1876', '441911', '麻涌镇');
INSERT INTO `shop_county` VALUES ('1877', '441912', '虎门镇');
INSERT INTO `shop_county` VALUES ('1878', '441913', '谢岗镇');
INSERT INTO `shop_county` VALUES ('1879', '441914', '石碣镇');
INSERT INTO `shop_county` VALUES ('1880', '441915', '茶山镇');
INSERT INTO `shop_county` VALUES ('1881', '441916', '东城区');
INSERT INTO `shop_county` VALUES ('1882', '441917', '洪梅镇');
INSERT INTO `shop_county` VALUES ('1883', '441918', '道滘镇');
INSERT INTO `shop_county` VALUES ('1884', '441919', '高埗镇');
INSERT INTO `shop_county` VALUES ('1885', '441920', '企石镇');
INSERT INTO `shop_county` VALUES ('1886', '441921', '凤岗镇');
INSERT INTO `shop_county` VALUES ('1887', '441922', '大岭山镇');
INSERT INTO `shop_county` VALUES ('1888', '441923', '松山湖');
INSERT INTO `shop_county` VALUES ('1889', '441924', '清溪镇');
INSERT INTO `shop_county` VALUES ('1890', '441925', '望牛墩镇');
INSERT INTO `shop_county` VALUES ('1891', '441926', '厚街镇');
INSERT INTO `shop_county` VALUES ('1892', '441927', '常平镇');
INSERT INTO `shop_county` VALUES ('1893', '441928', '寮步镇');
INSERT INTO `shop_county` VALUES ('1894', '441929', '石排镇');
INSERT INTO `shop_county` VALUES ('1895', '441930', '横沥镇');
INSERT INTO `shop_county` VALUES ('1896', '441931', '塘厦镇');
INSERT INTO `shop_county` VALUES ('1897', '441932', '黄江镇');
INSERT INTO `shop_county` VALUES ('1898', '441933', '大朗镇');
INSERT INTO `shop_county` VALUES ('1899', '441990', '沙田镇');
INSERT INTO `shop_county` VALUES ('1900', '442001', '南头镇');
INSERT INTO `shop_county` VALUES ('1901', '442002', '神湾镇');
INSERT INTO `shop_county` VALUES ('1902', '442003', '东凤镇');
INSERT INTO `shop_county` VALUES ('1903', '442004', '五桂山镇');
INSERT INTO `shop_county` VALUES ('1904', '442005', '黄圃镇');
INSERT INTO `shop_county` VALUES ('1905', '442006', '小榄镇');
INSERT INTO `shop_county` VALUES ('1906', '442007', '石岐区街道');
INSERT INTO `shop_county` VALUES ('1907', '442008', '横栏镇');
INSERT INTO `shop_county` VALUES ('1908', '442009', '三角镇');
INSERT INTO `shop_county` VALUES ('1909', '442010', '三乡镇');
INSERT INTO `shop_county` VALUES ('1910', '442011', '港口镇');
INSERT INTO `shop_county` VALUES ('1911', '442012', '沙溪镇');
INSERT INTO `shop_county` VALUES ('1912', '442013', '板芙镇');
INSERT INTO `shop_county` VALUES ('1913', '442014', '沙朗镇');
INSERT INTO `shop_county` VALUES ('1914', '442015', '东升镇');
INSERT INTO `shop_county` VALUES ('1915', '442016', '阜沙镇');
INSERT INTO `shop_county` VALUES ('1916', '442017', '民众镇');
INSERT INTO `shop_county` VALUES ('1917', '442018', '东区街道');
INSERT INTO `shop_county` VALUES ('1918', '442019', '火炬开发区');
INSERT INTO `shop_county` VALUES ('1919', '442020', '西区街道');
INSERT INTO `shop_county` VALUES ('1920', '442021', '南区街道');
INSERT INTO `shop_county` VALUES ('1921', '442022', '古镇');
INSERT INTO `shop_county` VALUES ('1922', '442023', '坦洲镇');
INSERT INTO `shop_county` VALUES ('1923', '442024', '大涌镇');
INSERT INTO `shop_county` VALUES ('1924', '442025', '南朗镇');
INSERT INTO `shop_county` VALUES ('1925', '445102', '湘桥区');
INSERT INTO `shop_county` VALUES ('1926', '445103', '潮安区');
INSERT INTO `shop_county` VALUES ('1927', '445122', '饶平县');
INSERT INTO `shop_county` VALUES ('1928', '445202', '榕城区');
INSERT INTO `shop_county` VALUES ('1929', '445203', '揭东区');
INSERT INTO `shop_county` VALUES ('1930', '445222', '揭西县');
INSERT INTO `shop_county` VALUES ('1931', '445224', '惠来县');
INSERT INTO `shop_county` VALUES ('1932', '445281', '普宁市');
INSERT INTO `shop_county` VALUES ('1933', '445302', '云城区');
INSERT INTO `shop_county` VALUES ('1934', '445303', '云安区');
INSERT INTO `shop_county` VALUES ('1935', '445321', '新兴县');
INSERT INTO `shop_county` VALUES ('1936', '445322', '郁南县');
INSERT INTO `shop_county` VALUES ('1937', '445381', '罗定市');
INSERT INTO `shop_county` VALUES ('1938', '450102', '兴宁区');
INSERT INTO `shop_county` VALUES ('1939', '450103', '青秀区');
INSERT INTO `shop_county` VALUES ('1940', '450105', '江南区');
INSERT INTO `shop_county` VALUES ('1941', '450107', '西乡塘区');
INSERT INTO `shop_county` VALUES ('1942', '450108', '良庆区');
INSERT INTO `shop_county` VALUES ('1943', '450109', '邕宁区');
INSERT INTO `shop_county` VALUES ('1944', '450110', '武鸣区');
INSERT INTO `shop_county` VALUES ('1945', '450123', '隆安县');
INSERT INTO `shop_county` VALUES ('1946', '450124', '马山县');
INSERT INTO `shop_county` VALUES ('1947', '450125', '上林县');
INSERT INTO `shop_county` VALUES ('1948', '450126', '宾阳县');
INSERT INTO `shop_county` VALUES ('1949', '450127', '横县');
INSERT INTO `shop_county` VALUES ('1950', '450202', '城中区');
INSERT INTO `shop_county` VALUES ('1951', '450203', '鱼峰区');
INSERT INTO `shop_county` VALUES ('1952', '450204', '柳南区');
INSERT INTO `shop_county` VALUES ('1953', '450205', '柳北区');
INSERT INTO `shop_county` VALUES ('1954', '450206', '柳江区');
INSERT INTO `shop_county` VALUES ('1955', '450222', '柳城县');
INSERT INTO `shop_county` VALUES ('1956', '450223', '鹿寨县');
INSERT INTO `shop_county` VALUES ('1957', '450224', '融安县');
INSERT INTO `shop_county` VALUES ('1958', '450225', '融水苗族自治县');
INSERT INTO `shop_county` VALUES ('1959', '450226', '三江侗族自治县');
INSERT INTO `shop_county` VALUES ('1960', '450302', '秀峰区');
INSERT INTO `shop_county` VALUES ('1961', '450303', '叠彩区');
INSERT INTO `shop_county` VALUES ('1962', '450304', '象山区');
INSERT INTO `shop_county` VALUES ('1963', '450305', '七星区');
INSERT INTO `shop_county` VALUES ('1964', '450311', '雁山区');
INSERT INTO `shop_county` VALUES ('1965', '450312', '临桂区');
INSERT INTO `shop_county` VALUES ('1966', '450321', '阳朔县');
INSERT INTO `shop_county` VALUES ('1967', '450323', '灵川县');
INSERT INTO `shop_county` VALUES ('1968', '450324', '全州县');
INSERT INTO `shop_county` VALUES ('1969', '450325', '兴安县');
INSERT INTO `shop_county` VALUES ('1970', '450326', '永福县');
INSERT INTO `shop_county` VALUES ('1971', '450327', '灌阳县');
INSERT INTO `shop_county` VALUES ('1972', '450328', '龙胜各族自治县');
INSERT INTO `shop_county` VALUES ('1973', '450329', '资源县');
INSERT INTO `shop_county` VALUES ('1974', '450330', '平乐县');
INSERT INTO `shop_county` VALUES ('1975', '450331', '荔浦县');
INSERT INTO `shop_county` VALUES ('1976', '450332', '恭城瑶族自治县');
INSERT INTO `shop_county` VALUES ('1977', '450403', '万秀区');
INSERT INTO `shop_county` VALUES ('1978', '450405', '长洲区');
INSERT INTO `shop_county` VALUES ('1979', '450406', '龙圩区');
INSERT INTO `shop_county` VALUES ('1980', '450421', '苍梧县');
INSERT INTO `shop_county` VALUES ('1981', '450422', '藤县');
INSERT INTO `shop_county` VALUES ('1982', '450423', '蒙山县');
INSERT INTO `shop_county` VALUES ('1983', '450481', '岑溪市');
INSERT INTO `shop_county` VALUES ('1984', '450502', '海城区');
INSERT INTO `shop_county` VALUES ('1985', '450503', '银海区');
INSERT INTO `shop_county` VALUES ('1986', '450512', '铁山港区');
INSERT INTO `shop_county` VALUES ('1987', '450521', '合浦县');
INSERT INTO `shop_county` VALUES ('1988', '450602', '港口区');
INSERT INTO `shop_county` VALUES ('1989', '450603', '防城区');
INSERT INTO `shop_county` VALUES ('1990', '450621', '上思县');
INSERT INTO `shop_county` VALUES ('1991', '450681', '东兴市');
INSERT INTO `shop_county` VALUES ('1992', '450702', '钦南区');
INSERT INTO `shop_county` VALUES ('1993', '450703', '钦北区');
INSERT INTO `shop_county` VALUES ('1994', '450721', '灵山县');
INSERT INTO `shop_county` VALUES ('1995', '450722', '浦北县');
INSERT INTO `shop_county` VALUES ('1996', '450802', '港北区');
INSERT INTO `shop_county` VALUES ('1997', '450803', '港南区');
INSERT INTO `shop_county` VALUES ('1998', '450804', '覃塘区');
INSERT INTO `shop_county` VALUES ('1999', '450821', '平南县');
INSERT INTO `shop_county` VALUES ('2000', '450881', '桂平市');
INSERT INTO `shop_county` VALUES ('2001', '450902', '玉州区');
INSERT INTO `shop_county` VALUES ('2002', '450903', '福绵区');
INSERT INTO `shop_county` VALUES ('2003', '450921', '容县');
INSERT INTO `shop_county` VALUES ('2004', '450922', '陆川县');
INSERT INTO `shop_county` VALUES ('2005', '450923', '博白县');
INSERT INTO `shop_county` VALUES ('2006', '450924', '兴业县');
INSERT INTO `shop_county` VALUES ('2007', '450981', '北流市');
INSERT INTO `shop_county` VALUES ('2008', '451002', '右江区');
INSERT INTO `shop_county` VALUES ('2009', '451021', '田阳县');
INSERT INTO `shop_county` VALUES ('2010', '451022', '田东县');
INSERT INTO `shop_county` VALUES ('2011', '451023', '平果县');
INSERT INTO `shop_county` VALUES ('2012', '451024', '德保县');
INSERT INTO `shop_county` VALUES ('2013', '451026', '那坡县');
INSERT INTO `shop_county` VALUES ('2014', '451027', '凌云县');
INSERT INTO `shop_county` VALUES ('2015', '451028', '乐业县');
INSERT INTO `shop_county` VALUES ('2016', '451029', '田林县');
INSERT INTO `shop_county` VALUES ('2017', '451030', '西林县');
INSERT INTO `shop_county` VALUES ('2018', '451031', '隆林各族自治县');
INSERT INTO `shop_county` VALUES ('2019', '451081', '靖西市');
INSERT INTO `shop_county` VALUES ('2020', '451102', '八步区');
INSERT INTO `shop_county` VALUES ('2021', '451103', '平桂区');
INSERT INTO `shop_county` VALUES ('2022', '451121', '昭平县');
INSERT INTO `shop_county` VALUES ('2023', '451122', '钟山县');
INSERT INTO `shop_county` VALUES ('2024', '451123', '富川瑶族自治县');
INSERT INTO `shop_county` VALUES ('2025', '451202', '金城江区');
INSERT INTO `shop_county` VALUES ('2026', '451203', '宜州区');
INSERT INTO `shop_county` VALUES ('2027', '451221', '南丹县');
INSERT INTO `shop_county` VALUES ('2028', '451222', '天峨县');
INSERT INTO `shop_county` VALUES ('2029', '451223', '凤山县');
INSERT INTO `shop_county` VALUES ('2030', '451224', '东兰县');
INSERT INTO `shop_county` VALUES ('2031', '451225', '罗城仫佬族自治县');
INSERT INTO `shop_county` VALUES ('2032', '451226', '环江毛南族自治县');
INSERT INTO `shop_county` VALUES ('2033', '451227', '巴马瑶族自治县');
INSERT INTO `shop_county` VALUES ('2034', '451228', '都安瑶族自治县');
INSERT INTO `shop_county` VALUES ('2035', '451229', '大化瑶族自治县');
INSERT INTO `shop_county` VALUES ('2036', '451302', '兴宾区');
INSERT INTO `shop_county` VALUES ('2037', '451321', '忻城县');
INSERT INTO `shop_county` VALUES ('2038', '451322', '象州县');
INSERT INTO `shop_county` VALUES ('2039', '451323', '武宣县');
INSERT INTO `shop_county` VALUES ('2040', '451324', '金秀瑶族自治县');
INSERT INTO `shop_county` VALUES ('2041', '451381', '合山市');
INSERT INTO `shop_county` VALUES ('2042', '451402', '江州区');
INSERT INTO `shop_county` VALUES ('2043', '451421', '扶绥县');
INSERT INTO `shop_county` VALUES ('2044', '451422', '宁明县');
INSERT INTO `shop_county` VALUES ('2045', '451423', '龙州县');
INSERT INTO `shop_county` VALUES ('2046', '451424', '大新县');
INSERT INTO `shop_county` VALUES ('2047', '451425', '天等县');
INSERT INTO `shop_county` VALUES ('2048', '451481', '凭祥市');
INSERT INTO `shop_county` VALUES ('2049', '460105', '秀英区');
INSERT INTO `shop_county` VALUES ('2050', '460106', '龙华区');
INSERT INTO `shop_county` VALUES ('2051', '460107', '琼山区');
INSERT INTO `shop_county` VALUES ('2052', '460108', '美兰区');
INSERT INTO `shop_county` VALUES ('2053', '460202', '海棠区');
INSERT INTO `shop_county` VALUES ('2054', '460203', '吉阳区');
INSERT INTO `shop_county` VALUES ('2055', '460204', '天涯区');
INSERT INTO `shop_county` VALUES ('2056', '460205', '崖州区');
INSERT INTO `shop_county` VALUES ('2057', '460321', '西沙群岛');
INSERT INTO `shop_county` VALUES ('2058', '460322', '南沙群岛');
INSERT INTO `shop_county` VALUES ('2059', '460323', '中沙群岛的岛礁及其海域');
INSERT INTO `shop_county` VALUES ('2060', '460401', '那大镇');
INSERT INTO `shop_county` VALUES ('2061', '460402', '和庆镇');
INSERT INTO `shop_county` VALUES ('2062', '460403', '南丰镇');
INSERT INTO `shop_county` VALUES ('2063', '460404', '大成镇');
INSERT INTO `shop_county` VALUES ('2064', '460405', '雅星镇');
INSERT INTO `shop_county` VALUES ('2065', '460406', '兰洋镇');
INSERT INTO `shop_county` VALUES ('2066', '460407', '光村镇');
INSERT INTO `shop_county` VALUES ('2067', '460408', '木棠镇');
INSERT INTO `shop_county` VALUES ('2068', '460409', '海头镇');
INSERT INTO `shop_county` VALUES ('2069', '460410', '峨蔓镇');
INSERT INTO `shop_county` VALUES ('2070', '460411', '王五镇');
INSERT INTO `shop_county` VALUES ('2071', '460412', '白马井镇');
INSERT INTO `shop_county` VALUES ('2072', '460413', '中和镇');
INSERT INTO `shop_county` VALUES ('2073', '460414', '排浦镇');
INSERT INTO `shop_county` VALUES ('2074', '460415', '东成镇');
INSERT INTO `shop_county` VALUES ('2075', '460416', '新州镇');
INSERT INTO `shop_county` VALUES ('2076', '469001', '五指山市');
INSERT INTO `shop_county` VALUES ('2077', '469002', '琼海市');
INSERT INTO `shop_county` VALUES ('2078', '469005', '文昌市');
INSERT INTO `shop_county` VALUES ('2079', '469006', '万宁市');
INSERT INTO `shop_county` VALUES ('2080', '469007', '东方市');
INSERT INTO `shop_county` VALUES ('2081', '469021', '定安县');
INSERT INTO `shop_county` VALUES ('2082', '469022', '屯昌县');
INSERT INTO `shop_county` VALUES ('2083', '469023', '澄迈县');
INSERT INTO `shop_county` VALUES ('2084', '469024', '临高县');
INSERT INTO `shop_county` VALUES ('2085', '469025', '白沙黎族自治县');
INSERT INTO `shop_county` VALUES ('2086', '469026', '昌江黎族自治县');
INSERT INTO `shop_county` VALUES ('2087', '469027', '乐东黎族自治县');
INSERT INTO `shop_county` VALUES ('2088', '469028', '陵水黎族自治县');
INSERT INTO `shop_county` VALUES ('2089', '469029', '保亭黎族苗族自治县');
INSERT INTO `shop_county` VALUES ('2090', '469030', '琼中黎族苗族自治县');
INSERT INTO `shop_county` VALUES ('2091', '500101', '万州区');
INSERT INTO `shop_county` VALUES ('2092', '500102', '涪陵区');
INSERT INTO `shop_county` VALUES ('2093', '500103', '渝中区');
INSERT INTO `shop_county` VALUES ('2094', '500104', '大渡口区');
INSERT INTO `shop_county` VALUES ('2095', '500105', '江北区');
INSERT INTO `shop_county` VALUES ('2096', '500106', '沙坪坝区');
INSERT INTO `shop_county` VALUES ('2097', '500107', '九龙坡区');
INSERT INTO `shop_county` VALUES ('2098', '500108', '南岸区');
INSERT INTO `shop_county` VALUES ('2099', '500109', '北碚区');
INSERT INTO `shop_county` VALUES ('2100', '500110', '綦江区');
INSERT INTO `shop_county` VALUES ('2101', '500111', '大足区');
INSERT INTO `shop_county` VALUES ('2102', '500112', '渝北区');
INSERT INTO `shop_county` VALUES ('2103', '500113', '巴南区');
INSERT INTO `shop_county` VALUES ('2104', '500114', '黔江区');
INSERT INTO `shop_county` VALUES ('2105', '500115', '长寿区');
INSERT INTO `shop_county` VALUES ('2106', '500116', '江津区');
INSERT INTO `shop_county` VALUES ('2107', '500117', '合川区');
INSERT INTO `shop_county` VALUES ('2108', '500118', '永川区');
INSERT INTO `shop_county` VALUES ('2109', '500119', '南川区');
INSERT INTO `shop_county` VALUES ('2110', '500120', '璧山区');
INSERT INTO `shop_county` VALUES ('2111', '500151', '铜梁区');
INSERT INTO `shop_county` VALUES ('2112', '500152', '潼南区');
INSERT INTO `shop_county` VALUES ('2113', '500153', '荣昌区');
INSERT INTO `shop_county` VALUES ('2114', '500154', '开州区');
INSERT INTO `shop_county` VALUES ('2115', '500155', '梁平区');
INSERT INTO `shop_county` VALUES ('2116', '500156', '武隆区');
INSERT INTO `shop_county` VALUES ('2117', '500229', '城口县');
INSERT INTO `shop_county` VALUES ('2118', '500230', '丰都县');
INSERT INTO `shop_county` VALUES ('2119', '500231', '垫江县');
INSERT INTO `shop_county` VALUES ('2120', '500233', '忠县');
INSERT INTO `shop_county` VALUES ('2121', '500235', '云阳县');
INSERT INTO `shop_county` VALUES ('2122', '500236', '奉节县');
INSERT INTO `shop_county` VALUES ('2123', '500237', '巫山县');
INSERT INTO `shop_county` VALUES ('2124', '500238', '巫溪县');
INSERT INTO `shop_county` VALUES ('2125', '500240', '石柱土家族自治县');
INSERT INTO `shop_county` VALUES ('2126', '500241', '秀山土家族苗族自治县');
INSERT INTO `shop_county` VALUES ('2127', '500242', '酉阳土家族苗族自治县');
INSERT INTO `shop_county` VALUES ('2128', '500243', '彭水苗族土家族自治县');
INSERT INTO `shop_county` VALUES ('2129', '510104', '锦江区');
INSERT INTO `shop_county` VALUES ('2130', '510105', '青羊区');
INSERT INTO `shop_county` VALUES ('2131', '510106', '金牛区');
INSERT INTO `shop_county` VALUES ('2132', '510107', '武侯区');
INSERT INTO `shop_county` VALUES ('2133', '510108', '成华区');
INSERT INTO `shop_county` VALUES ('2134', '510112', '龙泉驿区');
INSERT INTO `shop_county` VALUES ('2135', '510113', '青白江区');
INSERT INTO `shop_county` VALUES ('2136', '510114', '新都区');
INSERT INTO `shop_county` VALUES ('2137', '510115', '温江区');
INSERT INTO `shop_county` VALUES ('2138', '510116', '双流区');
INSERT INTO `shop_county` VALUES ('2139', '510117', '郫都区');
INSERT INTO `shop_county` VALUES ('2140', '510121', '金堂县');
INSERT INTO `shop_county` VALUES ('2141', '510129', '大邑县');
INSERT INTO `shop_county` VALUES ('2142', '510131', '蒲江县');
INSERT INTO `shop_county` VALUES ('2143', '510132', '新津县');
INSERT INTO `shop_county` VALUES ('2144', '510181', '都江堰市');
INSERT INTO `shop_county` VALUES ('2145', '510182', '彭州市');
INSERT INTO `shop_county` VALUES ('2146', '510183', '邛崃市');
INSERT INTO `shop_county` VALUES ('2147', '510184', '崇州市');
INSERT INTO `shop_county` VALUES ('2148', '510185', '简阳市');
INSERT INTO `shop_county` VALUES ('2149', '510191', '高新区');
INSERT INTO `shop_county` VALUES ('2150', '510302', '自流井区');
INSERT INTO `shop_county` VALUES ('2151', '510303', '贡井区');
INSERT INTO `shop_county` VALUES ('2152', '510304', '大安区');
INSERT INTO `shop_county` VALUES ('2153', '510311', '沿滩区');
INSERT INTO `shop_county` VALUES ('2154', '510321', '荣县');
INSERT INTO `shop_county` VALUES ('2155', '510322', '富顺县');
INSERT INTO `shop_county` VALUES ('2156', '510402', '东区');
INSERT INTO `shop_county` VALUES ('2157', '510403', '西区');
INSERT INTO `shop_county` VALUES ('2158', '510411', '仁和区');
INSERT INTO `shop_county` VALUES ('2159', '510421', '米易县');
INSERT INTO `shop_county` VALUES ('2160', '510422', '盐边县');
INSERT INTO `shop_county` VALUES ('2161', '510502', '江阳区');
INSERT INTO `shop_county` VALUES ('2162', '510503', '纳溪区');
INSERT INTO `shop_county` VALUES ('2163', '510504', '龙马潭区');
INSERT INTO `shop_county` VALUES ('2164', '510521', '泸县');
INSERT INTO `shop_county` VALUES ('2165', '510522', '合江县');
INSERT INTO `shop_county` VALUES ('2166', '510524', '叙永县');
INSERT INTO `shop_county` VALUES ('2167', '510525', '古蔺县');
INSERT INTO `shop_county` VALUES ('2168', '510603', '旌阳区');
INSERT INTO `shop_county` VALUES ('2169', '510604', '罗江区');
INSERT INTO `shop_county` VALUES ('2170', '510623', '中江县');
INSERT INTO `shop_county` VALUES ('2171', '510681', '广汉市');
INSERT INTO `shop_county` VALUES ('2172', '510682', '什邡市');
INSERT INTO `shop_county` VALUES ('2173', '510683', '绵竹市');
INSERT INTO `shop_county` VALUES ('2174', '510703', '涪城区');
INSERT INTO `shop_county` VALUES ('2175', '510704', '游仙区');
INSERT INTO `shop_county` VALUES ('2176', '510705', '安州区');
INSERT INTO `shop_county` VALUES ('2177', '510722', '三台县');
INSERT INTO `shop_county` VALUES ('2178', '510723', '盐亭县');
INSERT INTO `shop_county` VALUES ('2179', '510725', '梓潼县');
INSERT INTO `shop_county` VALUES ('2180', '510726', '北川羌族自治县');
INSERT INTO `shop_county` VALUES ('2181', '510727', '平武县');
INSERT INTO `shop_county` VALUES ('2182', '510781', '江油市');
INSERT INTO `shop_county` VALUES ('2183', '510791', '高新区');
INSERT INTO `shop_county` VALUES ('2184', '510802', '利州区');
INSERT INTO `shop_county` VALUES ('2185', '510811', '昭化区');
INSERT INTO `shop_county` VALUES ('2186', '510812', '朝天区');
INSERT INTO `shop_county` VALUES ('2187', '510821', '旺苍县');
INSERT INTO `shop_county` VALUES ('2188', '510822', '青川县');
INSERT INTO `shop_county` VALUES ('2189', '510823', '剑阁县');
INSERT INTO `shop_county` VALUES ('2190', '510824', '苍溪县');
INSERT INTO `shop_county` VALUES ('2191', '510903', '船山区');
INSERT INTO `shop_county` VALUES ('2192', '510904', '安居区');
INSERT INTO `shop_county` VALUES ('2193', '510921', '蓬溪县');
INSERT INTO `shop_county` VALUES ('2194', '510922', '射洪县');
INSERT INTO `shop_county` VALUES ('2195', '510923', '大英县');
INSERT INTO `shop_county` VALUES ('2196', '511002', '市中区');
INSERT INTO `shop_county` VALUES ('2197', '511011', '东兴区');
INSERT INTO `shop_county` VALUES ('2198', '511024', '威远县');
INSERT INTO `shop_county` VALUES ('2199', '511025', '资中县');
INSERT INTO `shop_county` VALUES ('2200', '511083', '隆昌市');
INSERT INTO `shop_county` VALUES ('2201', '511102', '市中区');
INSERT INTO `shop_county` VALUES ('2202', '511111', '沙湾区');
INSERT INTO `shop_county` VALUES ('2203', '511112', '五通桥区');
INSERT INTO `shop_county` VALUES ('2204', '511113', '金口河区');
INSERT INTO `shop_county` VALUES ('2205', '511123', '犍为县');
INSERT INTO `shop_county` VALUES ('2206', '511124', '井研县');
INSERT INTO `shop_county` VALUES ('2207', '511126', '夹江县');
INSERT INTO `shop_county` VALUES ('2208', '511129', '沐川县');
INSERT INTO `shop_county` VALUES ('2209', '511132', '峨边彝族自治县');
INSERT INTO `shop_county` VALUES ('2210', '511133', '马边彝族自治县');
INSERT INTO `shop_county` VALUES ('2211', '511181', '峨眉山市');
INSERT INTO `shop_county` VALUES ('2212', '511302', '顺庆区');
INSERT INTO `shop_county` VALUES ('2213', '511303', '高坪区');
INSERT INTO `shop_county` VALUES ('2214', '511304', '嘉陵区');
INSERT INTO `shop_county` VALUES ('2215', '511321', '南部县');
INSERT INTO `shop_county` VALUES ('2216', '511322', '营山县');
INSERT INTO `shop_county` VALUES ('2217', '511323', '蓬安县');
INSERT INTO `shop_county` VALUES ('2218', '511324', '仪陇县');
INSERT INTO `shop_county` VALUES ('2219', '511325', '西充县');
INSERT INTO `shop_county` VALUES ('2220', '511381', '阆中市');
INSERT INTO `shop_county` VALUES ('2221', '511402', '东坡区');
INSERT INTO `shop_county` VALUES ('2222', '511403', '彭山区');
INSERT INTO `shop_county` VALUES ('2223', '511421', '仁寿县');
INSERT INTO `shop_county` VALUES ('2224', '511423', '洪雅县');
INSERT INTO `shop_county` VALUES ('2225', '511424', '丹棱县');
INSERT INTO `shop_county` VALUES ('2226', '511425', '青神县');
INSERT INTO `shop_county` VALUES ('2227', '511502', '翠屏区');
INSERT INTO `shop_county` VALUES ('2228', '511503', '南溪区');
INSERT INTO `shop_county` VALUES ('2229', '511521', '宜宾县');
INSERT INTO `shop_county` VALUES ('2230', '511523', '江安县');
INSERT INTO `shop_county` VALUES ('2231', '511524', '长宁县');
INSERT INTO `shop_county` VALUES ('2232', '511525', '高县');
INSERT INTO `shop_county` VALUES ('2233', '511526', '珙县');
INSERT INTO `shop_county` VALUES ('2234', '511527', '筠连县');
INSERT INTO `shop_county` VALUES ('2235', '511528', '兴文县');
INSERT INTO `shop_county` VALUES ('2236', '511529', '屏山县');
INSERT INTO `shop_county` VALUES ('2237', '511602', '广安区');
INSERT INTO `shop_county` VALUES ('2238', '511603', '前锋区');
INSERT INTO `shop_county` VALUES ('2239', '511621', '岳池县');
INSERT INTO `shop_county` VALUES ('2240', '511622', '武胜县');
INSERT INTO `shop_county` VALUES ('2241', '511623', '邻水县');
INSERT INTO `shop_county` VALUES ('2242', '511681', '华蓥市');
INSERT INTO `shop_county` VALUES ('2243', '511702', '通川区');
INSERT INTO `shop_county` VALUES ('2244', '511703', '达川区');
INSERT INTO `shop_county` VALUES ('2245', '511722', '宣汉县');
INSERT INTO `shop_county` VALUES ('2246', '511723', '开江县');
INSERT INTO `shop_county` VALUES ('2247', '511724', '大竹县');
INSERT INTO `shop_county` VALUES ('2248', '511725', '渠县');
INSERT INTO `shop_county` VALUES ('2249', '511781', '万源市');
INSERT INTO `shop_county` VALUES ('2250', '511802', '雨城区');
INSERT INTO `shop_county` VALUES ('2251', '511803', '名山区');
INSERT INTO `shop_county` VALUES ('2252', '511822', '荥经县');
INSERT INTO `shop_county` VALUES ('2253', '511823', '汉源县');
INSERT INTO `shop_county` VALUES ('2254', '511824', '石棉县');
INSERT INTO `shop_county` VALUES ('2255', '511825', '天全县');
INSERT INTO `shop_county` VALUES ('2256', '511826', '芦山县');
INSERT INTO `shop_county` VALUES ('2257', '511827', '宝兴县');
INSERT INTO `shop_county` VALUES ('2258', '511902', '巴州区');
INSERT INTO `shop_county` VALUES ('2259', '511903', '恩阳区');
INSERT INTO `shop_county` VALUES ('2260', '511921', '通江县');
INSERT INTO `shop_county` VALUES ('2261', '511922', '南江县');
INSERT INTO `shop_county` VALUES ('2262', '511923', '平昌县');
INSERT INTO `shop_county` VALUES ('2263', '512002', '雁江区');
INSERT INTO `shop_county` VALUES ('2264', '512021', '安岳县');
INSERT INTO `shop_county` VALUES ('2265', '512022', '乐至县');
INSERT INTO `shop_county` VALUES ('2266', '513201', '马尔康市');
INSERT INTO `shop_county` VALUES ('2267', '513221', '汶川县');
INSERT INTO `shop_county` VALUES ('2268', '513222', '理县');
INSERT INTO `shop_county` VALUES ('2269', '513223', '茂县');
INSERT INTO `shop_county` VALUES ('2270', '513224', '松潘县');
INSERT INTO `shop_county` VALUES ('2271', '513225', '九寨沟县');
INSERT INTO `shop_county` VALUES ('2272', '513226', '金川县');
INSERT INTO `shop_county` VALUES ('2273', '513227', '小金县');
INSERT INTO `shop_county` VALUES ('2274', '513228', '黑水县');
INSERT INTO `shop_county` VALUES ('2275', '513230', '壤塘县');
INSERT INTO `shop_county` VALUES ('2276', '513231', '阿坝县');
INSERT INTO `shop_county` VALUES ('2277', '513232', '若尔盖县');
INSERT INTO `shop_county` VALUES ('2278', '513233', '红原县');
INSERT INTO `shop_county` VALUES ('2279', '513301', '康定市');
INSERT INTO `shop_county` VALUES ('2280', '513322', '泸定县');
INSERT INTO `shop_county` VALUES ('2281', '513323', '丹巴县');
INSERT INTO `shop_county` VALUES ('2282', '513324', '九龙县');
INSERT INTO `shop_county` VALUES ('2283', '513325', '雅江县');
INSERT INTO `shop_county` VALUES ('2284', '513326', '道孚县');
INSERT INTO `shop_county` VALUES ('2285', '513327', '炉霍县');
INSERT INTO `shop_county` VALUES ('2286', '513328', '甘孜县');
INSERT INTO `shop_county` VALUES ('2287', '513329', '新龙县');
INSERT INTO `shop_county` VALUES ('2288', '513330', '德格县');
INSERT INTO `shop_county` VALUES ('2289', '513331', '白玉县');
INSERT INTO `shop_county` VALUES ('2290', '513332', '石渠县');
INSERT INTO `shop_county` VALUES ('2291', '513333', '色达县');
INSERT INTO `shop_county` VALUES ('2292', '513334', '理塘县');
INSERT INTO `shop_county` VALUES ('2293', '513335', '巴塘县');
INSERT INTO `shop_county` VALUES ('2294', '513336', '乡城县');
INSERT INTO `shop_county` VALUES ('2295', '513337', '稻城县');
INSERT INTO `shop_county` VALUES ('2296', '513338', '得荣县');
INSERT INTO `shop_county` VALUES ('2297', '513401', '西昌市');
INSERT INTO `shop_county` VALUES ('2298', '513422', '木里藏族自治县');
INSERT INTO `shop_county` VALUES ('2299', '513423', '盐源县');
INSERT INTO `shop_county` VALUES ('2300', '513424', '德昌县');
INSERT INTO `shop_county` VALUES ('2301', '513425', '会理县');
INSERT INTO `shop_county` VALUES ('2302', '513426', '会东县');
INSERT INTO `shop_county` VALUES ('2303', '513427', '宁南县');
INSERT INTO `shop_county` VALUES ('2304', '513428', '普格县');
INSERT INTO `shop_county` VALUES ('2305', '513429', '布拖县');
INSERT INTO `shop_county` VALUES ('2306', '513430', '金阳县');
INSERT INTO `shop_county` VALUES ('2307', '513431', '昭觉县');
INSERT INTO `shop_county` VALUES ('2308', '513432', '喜德县');
INSERT INTO `shop_county` VALUES ('2309', '513433', '冕宁县');
INSERT INTO `shop_county` VALUES ('2310', '513434', '越西县');
INSERT INTO `shop_county` VALUES ('2311', '513435', '甘洛县');
INSERT INTO `shop_county` VALUES ('2312', '513436', '美姑县');
INSERT INTO `shop_county` VALUES ('2313', '513437', '雷波县');
INSERT INTO `shop_county` VALUES ('2314', '520102', '南明区');
INSERT INTO `shop_county` VALUES ('2315', '520103', '云岩区');
INSERT INTO `shop_county` VALUES ('2316', '520111', '花溪区');
INSERT INTO `shop_county` VALUES ('2317', '520112', '乌当区');
INSERT INTO `shop_county` VALUES ('2318', '520113', '白云区');
INSERT INTO `shop_county` VALUES ('2319', '520115', '观山湖区');
INSERT INTO `shop_county` VALUES ('2320', '520121', '开阳县');
INSERT INTO `shop_county` VALUES ('2321', '520122', '息烽县');
INSERT INTO `shop_county` VALUES ('2322', '520123', '修文县');
INSERT INTO `shop_county` VALUES ('2323', '520181', '清镇市');
INSERT INTO `shop_county` VALUES ('2324', '520201', '钟山区');
INSERT INTO `shop_county` VALUES ('2325', '520203', '六枝特区');
INSERT INTO `shop_county` VALUES ('2326', '520221', '水城县');
INSERT INTO `shop_county` VALUES ('2327', '520281', '盘州市');
INSERT INTO `shop_county` VALUES ('2328', '520302', '红花岗区');
INSERT INTO `shop_county` VALUES ('2329', '520303', '汇川区');
INSERT INTO `shop_county` VALUES ('2330', '520304', '播州区');
INSERT INTO `shop_county` VALUES ('2331', '520322', '桐梓县');
INSERT INTO `shop_county` VALUES ('2332', '520323', '绥阳县');
INSERT INTO `shop_county` VALUES ('2333', '520324', '正安县');
INSERT INTO `shop_county` VALUES ('2334', '520325', '道真仡佬族苗族自治县');
INSERT INTO `shop_county` VALUES ('2335', '520326', '务川仡佬族苗族自治县');
INSERT INTO `shop_county` VALUES ('2336', '520327', '凤冈县');
INSERT INTO `shop_county` VALUES ('2337', '520328', '湄潭县');
INSERT INTO `shop_county` VALUES ('2338', '520329', '余庆县');
INSERT INTO `shop_county` VALUES ('2339', '520330', '习水县');
INSERT INTO `shop_county` VALUES ('2340', '520381', '赤水市');
INSERT INTO `shop_county` VALUES ('2341', '520382', '仁怀市');
INSERT INTO `shop_county` VALUES ('2342', '520402', '西秀区');
INSERT INTO `shop_county` VALUES ('2343', '520403', '平坝区');
INSERT INTO `shop_county` VALUES ('2344', '520422', '普定县');
INSERT INTO `shop_county` VALUES ('2345', '520423', '镇宁布依族苗族自治县');
INSERT INTO `shop_county` VALUES ('2346', '520424', '关岭布依族苗族自治县');
INSERT INTO `shop_county` VALUES ('2347', '520425', '紫云苗族布依族自治县');
INSERT INTO `shop_county` VALUES ('2348', '520502', '七星关区');
INSERT INTO `shop_county` VALUES ('2349', '520521', '大方县');
INSERT INTO `shop_county` VALUES ('2350', '520522', '黔西县');
INSERT INTO `shop_county` VALUES ('2351', '520523', '金沙县');
INSERT INTO `shop_county` VALUES ('2352', '520524', '织金县');
INSERT INTO `shop_county` VALUES ('2353', '520525', '纳雍县');
INSERT INTO `shop_county` VALUES ('2354', '520526', '威宁彝族回族苗族自治县');
INSERT INTO `shop_county` VALUES ('2355', '520527', '赫章县');
INSERT INTO `shop_county` VALUES ('2356', '520602', '碧江区');
INSERT INTO `shop_county` VALUES ('2357', '520603', '万山区');
INSERT INTO `shop_county` VALUES ('2358', '520621', '江口县');
INSERT INTO `shop_county` VALUES ('2359', '520622', '玉屏侗族自治县');
INSERT INTO `shop_county` VALUES ('2360', '520623', '石阡县');
INSERT INTO `shop_county` VALUES ('2361', '520624', '思南县');
INSERT INTO `shop_county` VALUES ('2362', '520625', '印江土家族苗族自治县');
INSERT INTO `shop_county` VALUES ('2363', '520626', '德江县');
INSERT INTO `shop_county` VALUES ('2364', '520627', '沿河土家族自治县');
INSERT INTO `shop_county` VALUES ('2365', '520628', '松桃苗族自治县');
INSERT INTO `shop_county` VALUES ('2366', '522301', '兴义市');
INSERT INTO `shop_county` VALUES ('2367', '522322', '兴仁县');
INSERT INTO `shop_county` VALUES ('2368', '522323', '普安县');
INSERT INTO `shop_county` VALUES ('2369', '522324', '晴隆县');
INSERT INTO `shop_county` VALUES ('2370', '522325', '贞丰县');
INSERT INTO `shop_county` VALUES ('2371', '522326', '望谟县');
INSERT INTO `shop_county` VALUES ('2372', '522327', '册亨县');
INSERT INTO `shop_county` VALUES ('2373', '522328', '安龙县');
INSERT INTO `shop_county` VALUES ('2374', '522601', '凯里市');
INSERT INTO `shop_county` VALUES ('2375', '522622', '黄平县');
INSERT INTO `shop_county` VALUES ('2376', '522623', '施秉县');
INSERT INTO `shop_county` VALUES ('2377', '522624', '三穗县');
INSERT INTO `shop_county` VALUES ('2378', '522625', '镇远县');
INSERT INTO `shop_county` VALUES ('2379', '522626', '岑巩县');
INSERT INTO `shop_county` VALUES ('2380', '522627', '天柱县');
INSERT INTO `shop_county` VALUES ('2381', '522628', '锦屏县');
INSERT INTO `shop_county` VALUES ('2382', '522629', '剑河县');
INSERT INTO `shop_county` VALUES ('2383', '522630', '台江县');
INSERT INTO `shop_county` VALUES ('2384', '522631', '黎平县');
INSERT INTO `shop_county` VALUES ('2385', '522632', '榕江县');
INSERT INTO `shop_county` VALUES ('2386', '522633', '从江县');
INSERT INTO `shop_county` VALUES ('2387', '522634', '雷山县');
INSERT INTO `shop_county` VALUES ('2388', '522635', '麻江县');
INSERT INTO `shop_county` VALUES ('2389', '522636', '丹寨县');
INSERT INTO `shop_county` VALUES ('2390', '522701', '都匀市');
INSERT INTO `shop_county` VALUES ('2391', '522702', '福泉市');
INSERT INTO `shop_county` VALUES ('2392', '522722', '荔波县');
INSERT INTO `shop_county` VALUES ('2393', '522723', '贵定县');
INSERT INTO `shop_county` VALUES ('2394', '522725', '瓮安县');
INSERT INTO `shop_county` VALUES ('2395', '522726', '独山县');
INSERT INTO `shop_county` VALUES ('2396', '522727', '平塘县');
INSERT INTO `shop_county` VALUES ('2397', '522728', '罗甸县');
INSERT INTO `shop_county` VALUES ('2398', '522729', '长顺县');
INSERT INTO `shop_county` VALUES ('2399', '522730', '龙里县');
INSERT INTO `shop_county` VALUES ('2400', '522731', '惠水县');
INSERT INTO `shop_county` VALUES ('2401', '522732', '三都水族自治县');
INSERT INTO `shop_county` VALUES ('2402', '530102', '五华区');
INSERT INTO `shop_county` VALUES ('2403', '530103', '盘龙区');
INSERT INTO `shop_county` VALUES ('2404', '530111', '官渡区');
INSERT INTO `shop_county` VALUES ('2405', '530112', '西山区');
INSERT INTO `shop_county` VALUES ('2406', '530113', '东川区');
INSERT INTO `shop_county` VALUES ('2407', '530114', '呈贡区');
INSERT INTO `shop_county` VALUES ('2408', '530115', '晋宁区');
INSERT INTO `shop_county` VALUES ('2409', '530124', '富民县');
INSERT INTO `shop_county` VALUES ('2410', '530125', '宜良县');
INSERT INTO `shop_county` VALUES ('2411', '530126', '石林彝族自治县');
INSERT INTO `shop_county` VALUES ('2412', '530127', '嵩明县');
INSERT INTO `shop_county` VALUES ('2413', '530128', '禄劝彝族苗族自治县');
INSERT INTO `shop_county` VALUES ('2414', '530129', '寻甸回族彝族自治县');
INSERT INTO `shop_county` VALUES ('2415', '530181', '安宁市');
INSERT INTO `shop_county` VALUES ('2416', '530302', '麒麟区');
INSERT INTO `shop_county` VALUES ('2417', '530303', '沾益区');
INSERT INTO `shop_county` VALUES ('2418', '530321', '马龙县');
INSERT INTO `shop_county` VALUES ('2419', '530322', '陆良县');
INSERT INTO `shop_county` VALUES ('2420', '530323', '师宗县');
INSERT INTO `shop_county` VALUES ('2421', '530324', '罗平县');
INSERT INTO `shop_county` VALUES ('2422', '530325', '富源县');
INSERT INTO `shop_county` VALUES ('2423', '530326', '会泽县');
INSERT INTO `shop_county` VALUES ('2424', '530381', '宣威市');
INSERT INTO `shop_county` VALUES ('2425', '530402', '红塔区');
INSERT INTO `shop_county` VALUES ('2426', '530403', '江川区');
INSERT INTO `shop_county` VALUES ('2427', '530422', '澄江县');
INSERT INTO `shop_county` VALUES ('2428', '530423', '通海县');
INSERT INTO `shop_county` VALUES ('2429', '530424', '华宁县');
INSERT INTO `shop_county` VALUES ('2430', '530425', '易门县');
INSERT INTO `shop_county` VALUES ('2431', '530426', '峨山彝族自治县');
INSERT INTO `shop_county` VALUES ('2432', '530427', '新平彝族傣族自治县');
INSERT INTO `shop_county` VALUES ('2433', '530428', '元江哈尼族彝族傣族自治县');
INSERT INTO `shop_county` VALUES ('2434', '530502', '隆阳区');
INSERT INTO `shop_county` VALUES ('2435', '530521', '施甸县');
INSERT INTO `shop_county` VALUES ('2436', '530523', '龙陵县');
INSERT INTO `shop_county` VALUES ('2437', '530524', '昌宁县');
INSERT INTO `shop_county` VALUES ('2438', '530581', '腾冲市');
INSERT INTO `shop_county` VALUES ('2439', '530602', '昭阳区');
INSERT INTO `shop_county` VALUES ('2440', '530621', '鲁甸县');
INSERT INTO `shop_county` VALUES ('2441', '530622', '巧家县');
INSERT INTO `shop_county` VALUES ('2442', '530623', '盐津县');
INSERT INTO `shop_county` VALUES ('2443', '530624', '大关县');
INSERT INTO `shop_county` VALUES ('2444', '530625', '永善县');
INSERT INTO `shop_county` VALUES ('2445', '530626', '绥江县');
INSERT INTO `shop_county` VALUES ('2446', '530627', '镇雄县');
INSERT INTO `shop_county` VALUES ('2447', '530628', '彝良县');
INSERT INTO `shop_county` VALUES ('2448', '530629', '威信县');
INSERT INTO `shop_county` VALUES ('2449', '530630', '水富县');
INSERT INTO `shop_county` VALUES ('2450', '530702', '古城区');
INSERT INTO `shop_county` VALUES ('2451', '530721', '玉龙纳西族自治县');
INSERT INTO `shop_county` VALUES ('2452', '530722', '永胜县');
INSERT INTO `shop_county` VALUES ('2453', '530723', '华坪县');
INSERT INTO `shop_county` VALUES ('2454', '530724', '宁蒗彝族自治县');
INSERT INTO `shop_county` VALUES ('2455', '530802', '思茅区');
INSERT INTO `shop_county` VALUES ('2456', '530821', '宁洱哈尼族彝族自治县');
INSERT INTO `shop_county` VALUES ('2457', '530822', '墨江哈尼族自治县');
INSERT INTO `shop_county` VALUES ('2458', '530823', '景东彝族自治县');
INSERT INTO `shop_county` VALUES ('2459', '530824', '景谷傣族彝族自治县');
INSERT INTO `shop_county` VALUES ('2460', '530825', '镇沅彝族哈尼族拉祜族自治县');
INSERT INTO `shop_county` VALUES ('2461', '530826', '江城哈尼族彝族自治县');
INSERT INTO `shop_county` VALUES ('2462', '530827', '孟连傣族拉祜族佤族自治县');
INSERT INTO `shop_county` VALUES ('2463', '530828', '澜沧拉祜族自治县');
INSERT INTO `shop_county` VALUES ('2464', '530829', '西盟佤族自治县');
INSERT INTO `shop_county` VALUES ('2465', '530902', '临翔区');
INSERT INTO `shop_county` VALUES ('2466', '530921', '凤庆县');
INSERT INTO `shop_county` VALUES ('2467', '530922', '云县');
INSERT INTO `shop_county` VALUES ('2468', '530923', '永德县');
INSERT INTO `shop_county` VALUES ('2469', '530924', '镇康县');
INSERT INTO `shop_county` VALUES ('2470', '530925', '双江拉祜族佤族布朗族傣族自治县');
INSERT INTO `shop_county` VALUES ('2471', '530926', '耿马傣族佤族自治县');
INSERT INTO `shop_county` VALUES ('2472', '530927', '沧源佤族自治县');
INSERT INTO `shop_county` VALUES ('2473', '532301', '楚雄市');
INSERT INTO `shop_county` VALUES ('2474', '532322', '双柏县');
INSERT INTO `shop_county` VALUES ('2475', '532323', '牟定县');
INSERT INTO `shop_county` VALUES ('2476', '532324', '南华县');
INSERT INTO `shop_county` VALUES ('2477', '532325', '姚安县');
INSERT INTO `shop_county` VALUES ('2478', '532326', '大姚县');
INSERT INTO `shop_county` VALUES ('2479', '532327', '永仁县');
INSERT INTO `shop_county` VALUES ('2480', '532328', '元谋县');
INSERT INTO `shop_county` VALUES ('2481', '532329', '武定县');
INSERT INTO `shop_county` VALUES ('2482', '532331', '禄丰县');
INSERT INTO `shop_county` VALUES ('2483', '532501', '个旧市');
INSERT INTO `shop_county` VALUES ('2484', '532502', '开远市');
INSERT INTO `shop_county` VALUES ('2485', '532503', '蒙自市');
INSERT INTO `shop_county` VALUES ('2486', '532504', '弥勒市');
INSERT INTO `shop_county` VALUES ('2487', '532523', '屏边苗族自治县');
INSERT INTO `shop_county` VALUES ('2488', '532524', '建水县');
INSERT INTO `shop_county` VALUES ('2489', '532525', '石屏县');
INSERT INTO `shop_county` VALUES ('2490', '532527', '泸西县');
INSERT INTO `shop_county` VALUES ('2491', '532528', '元阳县');
INSERT INTO `shop_county` VALUES ('2492', '532529', '红河县');
INSERT INTO `shop_county` VALUES ('2493', '532530', '金平苗族瑶族傣族自治县');
INSERT INTO `shop_county` VALUES ('2494', '532531', '绿春县');
INSERT INTO `shop_county` VALUES ('2495', '532532', '河口瑶族自治县');
INSERT INTO `shop_county` VALUES ('2496', '532601', '文山市');
INSERT INTO `shop_county` VALUES ('2497', '532622', '砚山县');
INSERT INTO `shop_county` VALUES ('2498', '532623', '西畴县');
INSERT INTO `shop_county` VALUES ('2499', '532624', '麻栗坡县');
INSERT INTO `shop_county` VALUES ('2500', '532625', '马关县');
INSERT INTO `shop_county` VALUES ('2501', '532626', '丘北县');
INSERT INTO `shop_county` VALUES ('2502', '532627', '广南县');
INSERT INTO `shop_county` VALUES ('2503', '532628', '富宁县');
INSERT INTO `shop_county` VALUES ('2504', '532801', '景洪市');
INSERT INTO `shop_county` VALUES ('2505', '532822', '勐海县');
INSERT INTO `shop_county` VALUES ('2506', '532823', '勐腊县');
INSERT INTO `shop_county` VALUES ('2507', '532901', '大理市');
INSERT INTO `shop_county` VALUES ('2508', '532922', '漾濞彝族自治县');
INSERT INTO `shop_county` VALUES ('2509', '532923', '祥云县');
INSERT INTO `shop_county` VALUES ('2510', '532924', '宾川县');
INSERT INTO `shop_county` VALUES ('2511', '532925', '弥渡县');
INSERT INTO `shop_county` VALUES ('2512', '532926', '南涧彝族自治县');
INSERT INTO `shop_county` VALUES ('2513', '532927', '巍山彝族回族自治县');
INSERT INTO `shop_county` VALUES ('2514', '532928', '永平县');
INSERT INTO `shop_county` VALUES ('2515', '532929', '云龙县');
INSERT INTO `shop_county` VALUES ('2516', '532930', '洱源县');
INSERT INTO `shop_county` VALUES ('2517', '532931', '剑川县');
INSERT INTO `shop_county` VALUES ('2518', '532932', '鹤庆县');
INSERT INTO `shop_county` VALUES ('2519', '533102', '瑞丽市');
INSERT INTO `shop_county` VALUES ('2520', '533103', '芒市');
INSERT INTO `shop_county` VALUES ('2521', '533122', '梁河县');
INSERT INTO `shop_county` VALUES ('2522', '533123', '盈江县');
INSERT INTO `shop_county` VALUES ('2523', '533124', '陇川县');
INSERT INTO `shop_county` VALUES ('2524', '533301', '泸水市');
INSERT INTO `shop_county` VALUES ('2525', '533323', '福贡县');
INSERT INTO `shop_county` VALUES ('2526', '533324', '贡山独龙族怒族自治县');
INSERT INTO `shop_county` VALUES ('2527', '533325', '兰坪白族普米族自治县');
INSERT INTO `shop_county` VALUES ('2528', '533401', '香格里拉市');
INSERT INTO `shop_county` VALUES ('2529', '533422', '德钦县');
INSERT INTO `shop_county` VALUES ('2530', '533423', '维西傈僳族自治县');
INSERT INTO `shop_county` VALUES ('2531', '540102', '城关区');
INSERT INTO `shop_county` VALUES ('2532', '540103', '堆龙德庆区');
INSERT INTO `shop_county` VALUES ('2533', '540104', '达孜区');
INSERT INTO `shop_county` VALUES ('2534', '540121', '林周县');
INSERT INTO `shop_county` VALUES ('2535', '540122', '当雄县');
INSERT INTO `shop_county` VALUES ('2536', '540123', '尼木县');
INSERT INTO `shop_county` VALUES ('2537', '540124', '曲水县');
INSERT INTO `shop_county` VALUES ('2538', '540127', '墨竹工卡县');
INSERT INTO `shop_county` VALUES ('2539', '540202', '桑珠孜区');
INSERT INTO `shop_county` VALUES ('2540', '540221', '南木林县');
INSERT INTO `shop_county` VALUES ('2541', '540222', '江孜县');
INSERT INTO `shop_county` VALUES ('2542', '540223', '定日县');
INSERT INTO `shop_county` VALUES ('2543', '540224', '萨迦县');
INSERT INTO `shop_county` VALUES ('2544', '540225', '拉孜县');
INSERT INTO `shop_county` VALUES ('2545', '540226', '昂仁县');
INSERT INTO `shop_county` VALUES ('2546', '540227', '谢通门县');
INSERT INTO `shop_county` VALUES ('2547', '540228', '白朗县');
INSERT INTO `shop_county` VALUES ('2548', '540229', '仁布县');
INSERT INTO `shop_county` VALUES ('2549', '540230', '康马县');
INSERT INTO `shop_county` VALUES ('2550', '540231', '定结县');
INSERT INTO `shop_county` VALUES ('2551', '540232', '仲巴县');
INSERT INTO `shop_county` VALUES ('2552', '540233', '亚东县');
INSERT INTO `shop_county` VALUES ('2553', '540234', '吉隆县');
INSERT INTO `shop_county` VALUES ('2554', '540235', '聂拉木县');
INSERT INTO `shop_county` VALUES ('2555', '540236', '萨嘎县');
INSERT INTO `shop_county` VALUES ('2556', '540237', '岗巴县');
INSERT INTO `shop_county` VALUES ('2557', '540302', '卡若区');
INSERT INTO `shop_county` VALUES ('2558', '540321', '江达县');
INSERT INTO `shop_county` VALUES ('2559', '540322', '贡觉县');
INSERT INTO `shop_county` VALUES ('2560', '540323', '类乌齐县');
INSERT INTO `shop_county` VALUES ('2561', '540324', '丁青县');
INSERT INTO `shop_county` VALUES ('2562', '540325', '察雅县');
INSERT INTO `shop_county` VALUES ('2563', '540326', '八宿县');
INSERT INTO `shop_county` VALUES ('2564', '540327', '左贡县');
INSERT INTO `shop_county` VALUES ('2565', '540328', '芒康县');
INSERT INTO `shop_county` VALUES ('2566', '540329', '洛隆县');
INSERT INTO `shop_county` VALUES ('2567', '540330', '边坝县');
INSERT INTO `shop_county` VALUES ('2568', '540402', '巴宜区');
INSERT INTO `shop_county` VALUES ('2569', '540421', '工布江达县');
INSERT INTO `shop_county` VALUES ('2570', '540422', '米林县');
INSERT INTO `shop_county` VALUES ('2571', '540423', '墨脱县');
INSERT INTO `shop_county` VALUES ('2572', '540424', '波密县');
INSERT INTO `shop_county` VALUES ('2573', '540425', '察隅县');
INSERT INTO `shop_county` VALUES ('2574', '540426', '朗县');
INSERT INTO `shop_county` VALUES ('2575', '540502', '乃东区');
INSERT INTO `shop_county` VALUES ('2576', '540521', '扎囊县');
INSERT INTO `shop_county` VALUES ('2577', '540522', '贡嘎县');
INSERT INTO `shop_county` VALUES ('2578', '540523', '桑日县');
INSERT INTO `shop_county` VALUES ('2579', '540524', '琼结县');
INSERT INTO `shop_county` VALUES ('2580', '540525', '曲松县');
INSERT INTO `shop_county` VALUES ('2581', '540526', '措美县');
INSERT INTO `shop_county` VALUES ('2582', '540527', '洛扎县');
INSERT INTO `shop_county` VALUES ('2583', '540528', '加查县');
INSERT INTO `shop_county` VALUES ('2584', '540529', '隆子县');
INSERT INTO `shop_county` VALUES ('2585', '540530', '错那县');
INSERT INTO `shop_county` VALUES ('2586', '540531', '浪卡子县');
INSERT INTO `shop_county` VALUES ('2587', '540602', '色尼区');
INSERT INTO `shop_county` VALUES ('2588', '542421', '那曲县');
INSERT INTO `shop_county` VALUES ('2589', '542422', '嘉黎县');
INSERT INTO `shop_county` VALUES ('2590', '542423', '比如县');
INSERT INTO `shop_county` VALUES ('2591', '542424', '聂荣县');
INSERT INTO `shop_county` VALUES ('2592', '542425', '安多县');
INSERT INTO `shop_county` VALUES ('2593', '542426', '申扎县');
INSERT INTO `shop_county` VALUES ('2594', '542427', '索县');
INSERT INTO `shop_county` VALUES ('2595', '542428', '班戈县');
INSERT INTO `shop_county` VALUES ('2596', '542429', '巴青县');
INSERT INTO `shop_county` VALUES ('2597', '542430', '尼玛县');
INSERT INTO `shop_county` VALUES ('2598', '542431', '双湖县');
INSERT INTO `shop_county` VALUES ('2599', '542521', '普兰县');
INSERT INTO `shop_county` VALUES ('2600', '542522', '札达县');
INSERT INTO `shop_county` VALUES ('2601', '542523', '噶尔县');
INSERT INTO `shop_county` VALUES ('2602', '542524', '日土县');
INSERT INTO `shop_county` VALUES ('2603', '542525', '革吉县');
INSERT INTO `shop_county` VALUES ('2604', '542526', '改则县');
INSERT INTO `shop_county` VALUES ('2605', '542527', '措勤县');
INSERT INTO `shop_county` VALUES ('2606', '610102', '新城区');
INSERT INTO `shop_county` VALUES ('2607', '610103', '碑林区');
INSERT INTO `shop_county` VALUES ('2608', '610104', '莲湖区');
INSERT INTO `shop_county` VALUES ('2609', '610111', '灞桥区');
INSERT INTO `shop_county` VALUES ('2610', '610112', '未央区');
INSERT INTO `shop_county` VALUES ('2611', '610113', '雁塔区');
INSERT INTO `shop_county` VALUES ('2612', '610114', '阎良区');
INSERT INTO `shop_county` VALUES ('2613', '610115', '临潼区');
INSERT INTO `shop_county` VALUES ('2614', '610116', '长安区');
INSERT INTO `shop_county` VALUES ('2615', '610117', '高陵区');
INSERT INTO `shop_county` VALUES ('2616', '610118', '鄠邑区');
INSERT INTO `shop_county` VALUES ('2617', '610122', '蓝田县');
INSERT INTO `shop_county` VALUES ('2618', '610124', '周至县');
INSERT INTO `shop_county` VALUES ('2619', '610202', '王益区');
INSERT INTO `shop_county` VALUES ('2620', '610203', '印台区');
INSERT INTO `shop_county` VALUES ('2621', '610204', '耀州区');
INSERT INTO `shop_county` VALUES ('2622', '610222', '宜君县');
INSERT INTO `shop_county` VALUES ('2623', '610302', '渭滨区');
INSERT INTO `shop_county` VALUES ('2624', '610303', '金台区');
INSERT INTO `shop_county` VALUES ('2625', '610304', '陈仓区');
INSERT INTO `shop_county` VALUES ('2626', '610322', '凤翔县');
INSERT INTO `shop_county` VALUES ('2627', '610323', '岐山县');
INSERT INTO `shop_county` VALUES ('2628', '610324', '扶风县');
INSERT INTO `shop_county` VALUES ('2629', '610326', '眉县');
INSERT INTO `shop_county` VALUES ('2630', '610327', '陇县');
INSERT INTO `shop_county` VALUES ('2631', '610328', '千阳县');
INSERT INTO `shop_county` VALUES ('2632', '610329', '麟游县');
INSERT INTO `shop_county` VALUES ('2633', '610330', '凤县');
INSERT INTO `shop_county` VALUES ('2634', '610331', '太白县');
INSERT INTO `shop_county` VALUES ('2635', '610402', '秦都区');
INSERT INTO `shop_county` VALUES ('2636', '610403', '杨陵区');
INSERT INTO `shop_county` VALUES ('2637', '610404', '渭城区');
INSERT INTO `shop_county` VALUES ('2638', '610422', '三原县');
INSERT INTO `shop_county` VALUES ('2639', '610423', '泾阳县');
INSERT INTO `shop_county` VALUES ('2640', '610424', '乾县');
INSERT INTO `shop_county` VALUES ('2641', '610425', '礼泉县');
INSERT INTO `shop_county` VALUES ('2642', '610426', '永寿县');
INSERT INTO `shop_county` VALUES ('2643', '610427', '彬县');
INSERT INTO `shop_county` VALUES ('2644', '610428', '长武县');
INSERT INTO `shop_county` VALUES ('2645', '610429', '旬邑县');
INSERT INTO `shop_county` VALUES ('2646', '610430', '淳化县');
INSERT INTO `shop_county` VALUES ('2647', '610431', '武功县');
INSERT INTO `shop_county` VALUES ('2648', '610481', '兴平市');
INSERT INTO `shop_county` VALUES ('2649', '610502', '临渭区');
INSERT INTO `shop_county` VALUES ('2650', '610503', '华州区');
INSERT INTO `shop_county` VALUES ('2651', '610522', '潼关县');
INSERT INTO `shop_county` VALUES ('2652', '610523', '大荔县');
INSERT INTO `shop_county` VALUES ('2653', '610524', '合阳县');
INSERT INTO `shop_county` VALUES ('2654', '610525', '澄城县');
INSERT INTO `shop_county` VALUES ('2655', '610526', '蒲城县');
INSERT INTO `shop_county` VALUES ('2656', '610527', '白水县');
INSERT INTO `shop_county` VALUES ('2657', '610528', '富平县');
INSERT INTO `shop_county` VALUES ('2658', '610581', '韩城市');
INSERT INTO `shop_county` VALUES ('2659', '610582', '华阴市');
INSERT INTO `shop_county` VALUES ('2660', '610602', '宝塔区');
INSERT INTO `shop_county` VALUES ('2661', '610603', '安塞区');
INSERT INTO `shop_county` VALUES ('2662', '610621', '延长县');
INSERT INTO `shop_county` VALUES ('2663', '610622', '延川县');
INSERT INTO `shop_county` VALUES ('2664', '610623', '子长县');
INSERT INTO `shop_county` VALUES ('2665', '610625', '志丹县');
INSERT INTO `shop_county` VALUES ('2666', '610626', '吴起县');
INSERT INTO `shop_county` VALUES ('2667', '610627', '甘泉县');
INSERT INTO `shop_county` VALUES ('2668', '610628', '富县');
INSERT INTO `shop_county` VALUES ('2669', '610629', '洛川县');
INSERT INTO `shop_county` VALUES ('2670', '610630', '宜川县');
INSERT INTO `shop_county` VALUES ('2671', '610631', '黄龙县');
INSERT INTO `shop_county` VALUES ('2672', '610632', '黄陵县');
INSERT INTO `shop_county` VALUES ('2673', '610702', '汉台区');
INSERT INTO `shop_county` VALUES ('2674', '610703', '南郑区');
INSERT INTO `shop_county` VALUES ('2675', '610722', '城固县');
INSERT INTO `shop_county` VALUES ('2676', '610723', '洋县');
INSERT INTO `shop_county` VALUES ('2677', '610724', '西乡县');
INSERT INTO `shop_county` VALUES ('2678', '610725', '勉县');
INSERT INTO `shop_county` VALUES ('2679', '610726', '宁强县');
INSERT INTO `shop_county` VALUES ('2680', '610727', '略阳县');
INSERT INTO `shop_county` VALUES ('2681', '610728', '镇巴县');
INSERT INTO `shop_county` VALUES ('2682', '610729', '留坝县');
INSERT INTO `shop_county` VALUES ('2683', '610730', '佛坪县');
INSERT INTO `shop_county` VALUES ('2684', '610802', '榆阳区');
INSERT INTO `shop_county` VALUES ('2685', '610803', '横山区');
INSERT INTO `shop_county` VALUES ('2686', '610822', '府谷县');
INSERT INTO `shop_county` VALUES ('2687', '610824', '靖边县');
INSERT INTO `shop_county` VALUES ('2688', '610825', '定边县');
INSERT INTO `shop_county` VALUES ('2689', '610826', '绥德县');
INSERT INTO `shop_county` VALUES ('2690', '610827', '米脂县');
INSERT INTO `shop_county` VALUES ('2691', '610828', '佳县');
INSERT INTO `shop_county` VALUES ('2692', '610829', '吴堡县');
INSERT INTO `shop_county` VALUES ('2693', '610830', '清涧县');
INSERT INTO `shop_county` VALUES ('2694', '610831', '子洲县');
INSERT INTO `shop_county` VALUES ('2695', '610881', '神木市');
INSERT INTO `shop_county` VALUES ('2696', '610902', '汉滨区');
INSERT INTO `shop_county` VALUES ('2697', '610921', '汉阴县');
INSERT INTO `shop_county` VALUES ('2698', '610922', '石泉县');
INSERT INTO `shop_county` VALUES ('2699', '610923', '宁陕县');
INSERT INTO `shop_county` VALUES ('2700', '610924', '紫阳县');
INSERT INTO `shop_county` VALUES ('2701', '610925', '岚皋县');
INSERT INTO `shop_county` VALUES ('2702', '610926', '平利县');
INSERT INTO `shop_county` VALUES ('2703', '610927', '镇坪县');
INSERT INTO `shop_county` VALUES ('2704', '610928', '旬阳县');
INSERT INTO `shop_county` VALUES ('2705', '610929', '白河县');
INSERT INTO `shop_county` VALUES ('2706', '611002', '商州区');
INSERT INTO `shop_county` VALUES ('2707', '611021', '洛南县');
INSERT INTO `shop_county` VALUES ('2708', '611022', '丹凤县');
INSERT INTO `shop_county` VALUES ('2709', '611023', '商南县');
INSERT INTO `shop_county` VALUES ('2710', '611024', '山阳县');
INSERT INTO `shop_county` VALUES ('2711', '611025', '镇安县');
INSERT INTO `shop_county` VALUES ('2712', '611026', '柞水县');
INSERT INTO `shop_county` VALUES ('2713', '620102', '城关区');
INSERT INTO `shop_county` VALUES ('2714', '620103', '七里河区');
INSERT INTO `shop_county` VALUES ('2715', '620104', '西固区');
INSERT INTO `shop_county` VALUES ('2716', '620105', '安宁区');
INSERT INTO `shop_county` VALUES ('2717', '620111', '红古区');
INSERT INTO `shop_county` VALUES ('2718', '620121', '永登县');
INSERT INTO `shop_county` VALUES ('2719', '620122', '皋兰县');
INSERT INTO `shop_county` VALUES ('2720', '620123', '榆中县');
INSERT INTO `shop_county` VALUES ('2721', '620201', '市辖区');
INSERT INTO `shop_county` VALUES ('2722', '620290', '雄关区');
INSERT INTO `shop_county` VALUES ('2723', '620291', '长城区');
INSERT INTO `shop_county` VALUES ('2724', '620292', '镜铁区');
INSERT INTO `shop_county` VALUES ('2725', '620293', '新城镇');
INSERT INTO `shop_county` VALUES ('2726', '620294', '峪泉镇');
INSERT INTO `shop_county` VALUES ('2727', '620295', '文殊镇');
INSERT INTO `shop_county` VALUES ('2728', '620302', '金川区');
INSERT INTO `shop_county` VALUES ('2729', '620321', '永昌县');
INSERT INTO `shop_county` VALUES ('2730', '620402', '白银区');
INSERT INTO `shop_county` VALUES ('2731', '620403', '平川区');
INSERT INTO `shop_county` VALUES ('2732', '620421', '靖远县');
INSERT INTO `shop_county` VALUES ('2733', '620422', '会宁县');
INSERT INTO `shop_county` VALUES ('2734', '620423', '景泰县');
INSERT INTO `shop_county` VALUES ('2735', '620502', '秦州区');
INSERT INTO `shop_county` VALUES ('2736', '620503', '麦积区');
INSERT INTO `shop_county` VALUES ('2737', '620521', '清水县');
INSERT INTO `shop_county` VALUES ('2738', '620522', '秦安县');
INSERT INTO `shop_county` VALUES ('2739', '620523', '甘谷县');
INSERT INTO `shop_county` VALUES ('2740', '620524', '武山县');
INSERT INTO `shop_county` VALUES ('2741', '620525', '张家川回族自治县');
INSERT INTO `shop_county` VALUES ('2742', '620602', '凉州区');
INSERT INTO `shop_county` VALUES ('2743', '620621', '民勤县');
INSERT INTO `shop_county` VALUES ('2744', '620622', '古浪县');
INSERT INTO `shop_county` VALUES ('2745', '620623', '天祝藏族自治县');
INSERT INTO `shop_county` VALUES ('2746', '620702', '甘州区');
INSERT INTO `shop_county` VALUES ('2747', '620721', '肃南裕固族自治县');
INSERT INTO `shop_county` VALUES ('2748', '620722', '民乐县');
INSERT INTO `shop_county` VALUES ('2749', '620723', '临泽县');
INSERT INTO `shop_county` VALUES ('2750', '620724', '高台县');
INSERT INTO `shop_county` VALUES ('2751', '620725', '山丹县');
INSERT INTO `shop_county` VALUES ('2752', '620802', '崆峒区');
INSERT INTO `shop_county` VALUES ('2753', '620821', '泾川县');
INSERT INTO `shop_county` VALUES ('2754', '620822', '灵台县');
INSERT INTO `shop_county` VALUES ('2755', '620823', '崇信县');
INSERT INTO `shop_county` VALUES ('2756', '620824', '华亭县');
INSERT INTO `shop_county` VALUES ('2757', '620825', '庄浪县');
INSERT INTO `shop_county` VALUES ('2758', '620826', '静宁县');
INSERT INTO `shop_county` VALUES ('2759', '620902', '肃州区');
INSERT INTO `shop_county` VALUES ('2760', '620921', '金塔县');
INSERT INTO `shop_county` VALUES ('2761', '620922', '瓜州县');
INSERT INTO `shop_county` VALUES ('2762', '620923', '肃北蒙古族自治县');
INSERT INTO `shop_county` VALUES ('2763', '620924', '阿克塞哈萨克族自治县');
INSERT INTO `shop_county` VALUES ('2764', '620981', '玉门市');
INSERT INTO `shop_county` VALUES ('2765', '620982', '敦煌市');
INSERT INTO `shop_county` VALUES ('2766', '621002', '西峰区');
INSERT INTO `shop_county` VALUES ('2767', '621021', '庆城县');
INSERT INTO `shop_county` VALUES ('2768', '621022', '环县');
INSERT INTO `shop_county` VALUES ('2769', '621023', '华池县');
INSERT INTO `shop_county` VALUES ('2770', '621024', '合水县');
INSERT INTO `shop_county` VALUES ('2771', '621025', '正宁县');
INSERT INTO `shop_county` VALUES ('2772', '621026', '宁县');
INSERT INTO `shop_county` VALUES ('2773', '621027', '镇原县');
INSERT INTO `shop_county` VALUES ('2774', '621102', '安定区');
INSERT INTO `shop_county` VALUES ('2775', '621121', '通渭县');
INSERT INTO `shop_county` VALUES ('2776', '621122', '陇西县');
INSERT INTO `shop_county` VALUES ('2777', '621123', '渭源县');
INSERT INTO `shop_county` VALUES ('2778', '621124', '临洮县');
INSERT INTO `shop_county` VALUES ('2779', '621125', '漳县');
INSERT INTO `shop_county` VALUES ('2780', '621126', '岷县');
INSERT INTO `shop_county` VALUES ('2781', '621202', '武都区');
INSERT INTO `shop_county` VALUES ('2782', '621221', '成县');
INSERT INTO `shop_county` VALUES ('2783', '621222', '文县');
INSERT INTO `shop_county` VALUES ('2784', '621223', '宕昌县');
INSERT INTO `shop_county` VALUES ('2785', '621224', '康县');
INSERT INTO `shop_county` VALUES ('2786', '621225', '西和县');
INSERT INTO `shop_county` VALUES ('2787', '621226', '礼县');
INSERT INTO `shop_county` VALUES ('2788', '621227', '徽县');
INSERT INTO `shop_county` VALUES ('2789', '621228', '两当县');
INSERT INTO `shop_county` VALUES ('2790', '622901', '临夏市');
INSERT INTO `shop_county` VALUES ('2791', '622921', '临夏县');
INSERT INTO `shop_county` VALUES ('2792', '622922', '康乐县');
INSERT INTO `shop_county` VALUES ('2793', '622923', '永靖县');
INSERT INTO `shop_county` VALUES ('2794', '622924', '广河县');
INSERT INTO `shop_county` VALUES ('2795', '622925', '和政县');
INSERT INTO `shop_county` VALUES ('2796', '622926', '东乡族自治县');
INSERT INTO `shop_county` VALUES ('2797', '622927', '积石山保安族东乡族撒拉族自治县');
INSERT INTO `shop_county` VALUES ('2798', '623001', '合作市');
INSERT INTO `shop_county` VALUES ('2799', '623021', '临潭县');
INSERT INTO `shop_county` VALUES ('2800', '623022', '卓尼县');
INSERT INTO `shop_county` VALUES ('2801', '623023', '舟曲县');
INSERT INTO `shop_county` VALUES ('2802', '623024', '迭部县');
INSERT INTO `shop_county` VALUES ('2803', '623025', '玛曲县');
INSERT INTO `shop_county` VALUES ('2804', '623026', '碌曲县');
INSERT INTO `shop_county` VALUES ('2805', '623027', '夏河县');
INSERT INTO `shop_county` VALUES ('2806', '630102', '城东区');
INSERT INTO `shop_county` VALUES ('2807', '630103', '城中区');
INSERT INTO `shop_county` VALUES ('2808', '630104', '城西区');
INSERT INTO `shop_county` VALUES ('2809', '630105', '城北区');
INSERT INTO `shop_county` VALUES ('2810', '630121', '大通回族土族自治县');
INSERT INTO `shop_county` VALUES ('2811', '630122', '湟中县');
INSERT INTO `shop_county` VALUES ('2812', '630123', '湟源县');
INSERT INTO `shop_county` VALUES ('2813', '630202', '乐都区');
INSERT INTO `shop_county` VALUES ('2814', '630203', '平安区');
INSERT INTO `shop_county` VALUES ('2815', '630222', '民和回族土族自治县');
INSERT INTO `shop_county` VALUES ('2816', '630223', '互助土族自治县');
INSERT INTO `shop_county` VALUES ('2817', '630224', '化隆回族自治县');
INSERT INTO `shop_county` VALUES ('2818', '630225', '循化撒拉族自治县');
INSERT INTO `shop_county` VALUES ('2819', '632221', '门源回族自治县');
INSERT INTO `shop_county` VALUES ('2820', '632222', '祁连县');
INSERT INTO `shop_county` VALUES ('2821', '632223', '海晏县');
INSERT INTO `shop_county` VALUES ('2822', '632224', '刚察县');
INSERT INTO `shop_county` VALUES ('2823', '632321', '同仁县');
INSERT INTO `shop_county` VALUES ('2824', '632322', '尖扎县');
INSERT INTO `shop_county` VALUES ('2825', '632323', '泽库县');
INSERT INTO `shop_county` VALUES ('2826', '632324', '河南蒙古族自治县');
INSERT INTO `shop_county` VALUES ('2827', '632521', '共和县');
INSERT INTO `shop_county` VALUES ('2828', '632522', '同德县');
INSERT INTO `shop_county` VALUES ('2829', '632523', '贵德县');
INSERT INTO `shop_county` VALUES ('2830', '632524', '兴海县');
INSERT INTO `shop_county` VALUES ('2831', '632525', '贵南县');
INSERT INTO `shop_county` VALUES ('2832', '632621', '玛沁县');
INSERT INTO `shop_county` VALUES ('2833', '632622', '班玛县');
INSERT INTO `shop_county` VALUES ('2834', '632623', '甘德县');
INSERT INTO `shop_county` VALUES ('2835', '632624', '达日县');
INSERT INTO `shop_county` VALUES ('2836', '632625', '久治县');
INSERT INTO `shop_county` VALUES ('2837', '632626', '玛多县');
INSERT INTO `shop_county` VALUES ('2838', '632701', '玉树市');
INSERT INTO `shop_county` VALUES ('2839', '632722', '杂多县');
INSERT INTO `shop_county` VALUES ('2840', '632723', '称多县');
INSERT INTO `shop_county` VALUES ('2841', '632724', '治多县');
INSERT INTO `shop_county` VALUES ('2842', '632725', '囊谦县');
INSERT INTO `shop_county` VALUES ('2843', '632726', '曲麻莱县');
INSERT INTO `shop_county` VALUES ('2844', '632801', '格尔木市');
INSERT INTO `shop_county` VALUES ('2845', '632802', '德令哈市');
INSERT INTO `shop_county` VALUES ('2846', '632821', '乌兰县');
INSERT INTO `shop_county` VALUES ('2847', '632822', '都兰县');
INSERT INTO `shop_county` VALUES ('2848', '632823', '天峻县');
INSERT INTO `shop_county` VALUES ('2849', '640104', '兴庆区');
INSERT INTO `shop_county` VALUES ('2850', '640105', '西夏区');
INSERT INTO `shop_county` VALUES ('2851', '640106', '金凤区');
INSERT INTO `shop_county` VALUES ('2852', '640121', '永宁县');
INSERT INTO `shop_county` VALUES ('2853', '640122', '贺兰县');
INSERT INTO `shop_county` VALUES ('2854', '640181', '灵武市');
INSERT INTO `shop_county` VALUES ('2855', '640202', '大武口区');
INSERT INTO `shop_county` VALUES ('2856', '640205', '惠农区');
INSERT INTO `shop_county` VALUES ('2857', '640221', '平罗县');
INSERT INTO `shop_county` VALUES ('2858', '640302', '利通区');
INSERT INTO `shop_county` VALUES ('2859', '640303', '红寺堡区');
INSERT INTO `shop_county` VALUES ('2860', '640323', '盐池县');
INSERT INTO `shop_county` VALUES ('2861', '640324', '同心县');
INSERT INTO `shop_county` VALUES ('2862', '640381', '青铜峡市');
INSERT INTO `shop_county` VALUES ('2863', '640402', '原州区');
INSERT INTO `shop_county` VALUES ('2864', '640422', '西吉县');
INSERT INTO `shop_county` VALUES ('2865', '640423', '隆德县');
INSERT INTO `shop_county` VALUES ('2866', '640424', '泾源县');
INSERT INTO `shop_county` VALUES ('2867', '640425', '彭阳县');
INSERT INTO `shop_county` VALUES ('2868', '640502', '沙坡头区');
INSERT INTO `shop_county` VALUES ('2869', '640521', '中宁县');
INSERT INTO `shop_county` VALUES ('2870', '640522', '海原县');
INSERT INTO `shop_county` VALUES ('2871', '650102', '天山区');
INSERT INTO `shop_county` VALUES ('2872', '650103', '沙依巴克区');
INSERT INTO `shop_county` VALUES ('2873', '650104', '新市区');
INSERT INTO `shop_county` VALUES ('2874', '650105', '水磨沟区');
INSERT INTO `shop_county` VALUES ('2875', '650106', '头屯河区');
INSERT INTO `shop_county` VALUES ('2876', '650107', '达坂城区');
INSERT INTO `shop_county` VALUES ('2877', '650109', '米东区');
INSERT INTO `shop_county` VALUES ('2878', '650121', '乌鲁木齐县');
INSERT INTO `shop_county` VALUES ('2879', '650202', '独山子区');
INSERT INTO `shop_county` VALUES ('2880', '650203', '克拉玛依区');
INSERT INTO `shop_county` VALUES ('2881', '650204', '白碱滩区');
INSERT INTO `shop_county` VALUES ('2882', '650205', '乌尔禾区');
INSERT INTO `shop_county` VALUES ('2883', '650402', '高昌区');
INSERT INTO `shop_county` VALUES ('2884', '650421', '鄯善县');
INSERT INTO `shop_county` VALUES ('2885', '650422', '托克逊县');
INSERT INTO `shop_county` VALUES ('2886', '650502', '伊州区');
INSERT INTO `shop_county` VALUES ('2887', '650521', '巴里坤哈萨克自治县');
INSERT INTO `shop_county` VALUES ('2888', '650522', '伊吾县');
INSERT INTO `shop_county` VALUES ('2889', '652301', '昌吉市');
INSERT INTO `shop_county` VALUES ('2890', '652302', '阜康市');
INSERT INTO `shop_county` VALUES ('2891', '652323', '呼图壁县');
INSERT INTO `shop_county` VALUES ('2892', '652324', '玛纳斯县');
INSERT INTO `shop_county` VALUES ('2893', '652325', '奇台县');
INSERT INTO `shop_county` VALUES ('2894', '652327', '吉木萨尔县');
INSERT INTO `shop_county` VALUES ('2895', '652328', '木垒哈萨克自治县');
INSERT INTO `shop_county` VALUES ('2896', '652701', '博乐市');
INSERT INTO `shop_county` VALUES ('2897', '652702', '阿拉山口市');
INSERT INTO `shop_county` VALUES ('2898', '652722', '精河县');
INSERT INTO `shop_county` VALUES ('2899', '652723', '温泉县');
INSERT INTO `shop_county` VALUES ('2900', '652801', '库尔勒市');
INSERT INTO `shop_county` VALUES ('2901', '652822', '轮台县');
INSERT INTO `shop_county` VALUES ('2902', '652823', '尉犁县');
INSERT INTO `shop_county` VALUES ('2903', '652824', '若羌县');
INSERT INTO `shop_county` VALUES ('2904', '652825', '且末县');
INSERT INTO `shop_county` VALUES ('2905', '652826', '焉耆回族自治县');
INSERT INTO `shop_county` VALUES ('2906', '652827', '和静县');
INSERT INTO `shop_county` VALUES ('2907', '652828', '和硕县');
INSERT INTO `shop_county` VALUES ('2908', '652829', '博湖县');
INSERT INTO `shop_county` VALUES ('2909', '652901', '阿克苏市');
INSERT INTO `shop_county` VALUES ('2910', '652922', '温宿县');
INSERT INTO `shop_county` VALUES ('2911', '652923', '库车县');
INSERT INTO `shop_county` VALUES ('2912', '652924', '沙雅县');
INSERT INTO `shop_county` VALUES ('2913', '652925', '新和县');
INSERT INTO `shop_county` VALUES ('2914', '652926', '拜城县');
INSERT INTO `shop_county` VALUES ('2915', '652927', '乌什县');
INSERT INTO `shop_county` VALUES ('2916', '652928', '阿瓦提县');
INSERT INTO `shop_county` VALUES ('2917', '652929', '柯坪县');
INSERT INTO `shop_county` VALUES ('2918', '653001', '阿图什市');
INSERT INTO `shop_county` VALUES ('2919', '653022', '阿克陶县');
INSERT INTO `shop_county` VALUES ('2920', '653023', '阿合奇县');
INSERT INTO `shop_county` VALUES ('2921', '653024', '乌恰县');
INSERT INTO `shop_county` VALUES ('2922', '653101', '喀什市');
INSERT INTO `shop_county` VALUES ('2923', '653121', '疏附县');
INSERT INTO `shop_county` VALUES ('2924', '653122', '疏勒县');
INSERT INTO `shop_county` VALUES ('2925', '653123', '英吉沙县');
INSERT INTO `shop_county` VALUES ('2926', '653124', '泽普县');
INSERT INTO `shop_county` VALUES ('2927', '653125', '莎车县');
INSERT INTO `shop_county` VALUES ('2928', '653126', '叶城县');
INSERT INTO `shop_county` VALUES ('2929', '653127', '麦盖提县');
INSERT INTO `shop_county` VALUES ('2930', '653128', '岳普湖县');
INSERT INTO `shop_county` VALUES ('2931', '653129', '伽师县');
INSERT INTO `shop_county` VALUES ('2932', '653130', '巴楚县');
INSERT INTO `shop_county` VALUES ('2933', '653131', '塔什库尔干塔吉克自治县');
INSERT INTO `shop_county` VALUES ('2934', '653201', '和田市');
INSERT INTO `shop_county` VALUES ('2935', '653221', '和田县');
INSERT INTO `shop_county` VALUES ('2936', '653222', '墨玉县');
INSERT INTO `shop_county` VALUES ('2937', '653223', '皮山县');
INSERT INTO `shop_county` VALUES ('2938', '653224', '洛浦县');
INSERT INTO `shop_county` VALUES ('2939', '653225', '策勒县');
INSERT INTO `shop_county` VALUES ('2940', '653226', '于田县');
INSERT INTO `shop_county` VALUES ('2941', '653227', '民丰县');
INSERT INTO `shop_county` VALUES ('2942', '654002', '伊宁市');
INSERT INTO `shop_county` VALUES ('2943', '654003', '奎屯市');
INSERT INTO `shop_county` VALUES ('2944', '654004', '霍尔果斯市');
INSERT INTO `shop_county` VALUES ('2945', '654021', '伊宁县');
INSERT INTO `shop_county` VALUES ('2946', '654022', '察布查尔锡伯自治县');
INSERT INTO `shop_county` VALUES ('2947', '654023', '霍城县');
INSERT INTO `shop_county` VALUES ('2948', '654024', '巩留县');
INSERT INTO `shop_county` VALUES ('2949', '654025', '新源县');
INSERT INTO `shop_county` VALUES ('2950', '654026', '昭苏县');
INSERT INTO `shop_county` VALUES ('2951', '654027', '特克斯县');
INSERT INTO `shop_county` VALUES ('2952', '654028', '尼勒克县');
INSERT INTO `shop_county` VALUES ('2953', '654201', '塔城市');
INSERT INTO `shop_county` VALUES ('2954', '654202', '乌苏市');
INSERT INTO `shop_county` VALUES ('2955', '654221', '额敏县');
INSERT INTO `shop_county` VALUES ('2956', '654223', '沙湾县');
INSERT INTO `shop_county` VALUES ('2957', '654224', '托里县');
INSERT INTO `shop_county` VALUES ('2958', '654225', '裕民县');
INSERT INTO `shop_county` VALUES ('2959', '654226', '和布克赛尔蒙古自治县');
INSERT INTO `shop_county` VALUES ('2960', '654301', '阿勒泰市');
INSERT INTO `shop_county` VALUES ('2961', '654321', '布尔津县');
INSERT INTO `shop_county` VALUES ('2962', '654322', '富蕴县');
INSERT INTO `shop_county` VALUES ('2963', '654323', '福海县');
INSERT INTO `shop_county` VALUES ('2964', '654324', '哈巴河县');
INSERT INTO `shop_county` VALUES ('2965', '654325', '青河县');
INSERT INTO `shop_county` VALUES ('2966', '654326', '吉木乃县');
INSERT INTO `shop_county` VALUES ('2967', '659001', '石河子市');
INSERT INTO `shop_county` VALUES ('2968', '659002', '阿拉尔市');
INSERT INTO `shop_county` VALUES ('2969', '659003', '图木舒克市');
INSERT INTO `shop_county` VALUES ('2970', '659004', '五家渠市');
INSERT INTO `shop_county` VALUES ('2971', '659005', '北屯市');
INSERT INTO `shop_county` VALUES ('2972', '659006', '铁门关市');
INSERT INTO `shop_county` VALUES ('2973', '659007', '双河市');
INSERT INTO `shop_county` VALUES ('2974', '659008', '可克达拉市');
INSERT INTO `shop_county` VALUES ('2975', '659009', '昆玉市');
INSERT INTO `shop_county` VALUES ('2976', '710101', '中正区');
INSERT INTO `shop_county` VALUES ('2977', '710102', '大同区');
INSERT INTO `shop_county` VALUES ('2978', '710103', '中山区');
INSERT INTO `shop_county` VALUES ('2979', '710104', '松山区');
INSERT INTO `shop_county` VALUES ('2980', '710105', '大安区');
INSERT INTO `shop_county` VALUES ('2981', '710106', '万华区');
INSERT INTO `shop_county` VALUES ('2982', '710107', '信义区');
INSERT INTO `shop_county` VALUES ('2983', '710108', '士林区');
INSERT INTO `shop_county` VALUES ('2984', '710109', '北投区');
INSERT INTO `shop_county` VALUES ('2985', '710110', '内湖区');
INSERT INTO `shop_county` VALUES ('2986', '710111', '南港区');
INSERT INTO `shop_county` VALUES ('2987', '710112', '文山区');
INSERT INTO `shop_county` VALUES ('2988', '710199', '其它区');
INSERT INTO `shop_county` VALUES ('2989', '710201', '新兴区');
INSERT INTO `shop_county` VALUES ('2990', '710202', '前金区');
INSERT INTO `shop_county` VALUES ('2991', '710203', '芩雅区');
INSERT INTO `shop_county` VALUES ('2992', '710204', '盐埕区');
INSERT INTO `shop_county` VALUES ('2993', '710205', '鼓山区');
INSERT INTO `shop_county` VALUES ('2994', '710206', '旗津区');
INSERT INTO `shop_county` VALUES ('2995', '710207', '前镇区');
INSERT INTO `shop_county` VALUES ('2996', '710208', '三民区');
INSERT INTO `shop_county` VALUES ('2997', '710209', '左营区');
INSERT INTO `shop_county` VALUES ('2998', '710210', '楠梓区');
INSERT INTO `shop_county` VALUES ('2999', '710211', '小港区');
INSERT INTO `shop_county` VALUES ('3000', '710241', '苓雅区');
INSERT INTO `shop_county` VALUES ('3001', '710242', '仁武区');
INSERT INTO `shop_county` VALUES ('3002', '710243', '大社区');
INSERT INTO `shop_county` VALUES ('3003', '710244', '冈山区');
INSERT INTO `shop_county` VALUES ('3004', '710245', '路竹区');
INSERT INTO `shop_county` VALUES ('3005', '710246', '阿莲区');
INSERT INTO `shop_county` VALUES ('3006', '710247', '田寮区');
INSERT INTO `shop_county` VALUES ('3007', '710248', '燕巢区');
INSERT INTO `shop_county` VALUES ('3008', '710249', '桥头区');
INSERT INTO `shop_county` VALUES ('3009', '710250', '梓官区');
INSERT INTO `shop_county` VALUES ('3010', '710251', '弥陀区');
INSERT INTO `shop_county` VALUES ('3011', '710252', '永安区');
INSERT INTO `shop_county` VALUES ('3012', '710253', '湖内区');
INSERT INTO `shop_county` VALUES ('3013', '710254', '凤山区');
INSERT INTO `shop_county` VALUES ('3014', '710255', '大寮区');
INSERT INTO `shop_county` VALUES ('3015', '710256', '林园区');
INSERT INTO `shop_county` VALUES ('3016', '710257', '鸟松区');
INSERT INTO `shop_county` VALUES ('3017', '710258', '大树区');
INSERT INTO `shop_county` VALUES ('3018', '710259', '旗山区');
INSERT INTO `shop_county` VALUES ('3019', '710260', '美浓区');
INSERT INTO `shop_county` VALUES ('3020', '710261', '六龟区');
INSERT INTO `shop_county` VALUES ('3021', '710262', '内门区');
INSERT INTO `shop_county` VALUES ('3022', '710263', '杉林区');
INSERT INTO `shop_county` VALUES ('3023', '710264', '甲仙区');
INSERT INTO `shop_county` VALUES ('3024', '710265', '桃源区');
INSERT INTO `shop_county` VALUES ('3025', '710266', '那玛夏区');
INSERT INTO `shop_county` VALUES ('3026', '710267', '茂林区');
INSERT INTO `shop_county` VALUES ('3027', '710268', '茄萣区');
INSERT INTO `shop_county` VALUES ('3028', '710299', '其它区');
INSERT INTO `shop_county` VALUES ('3029', '710301', '中西区');
INSERT INTO `shop_county` VALUES ('3030', '710302', '东区');
INSERT INTO `shop_county` VALUES ('3031', '710303', '南区');
INSERT INTO `shop_county` VALUES ('3032', '710304', '北区');
INSERT INTO `shop_county` VALUES ('3033', '710305', '安平区');
INSERT INTO `shop_county` VALUES ('3034', '710306', '安南区');
INSERT INTO `shop_county` VALUES ('3035', '710339', '永康区');
INSERT INTO `shop_county` VALUES ('3036', '710340', '归仁区');
INSERT INTO `shop_county` VALUES ('3037', '710341', '新化区');
INSERT INTO `shop_county` VALUES ('3038', '710342', '左镇区');
INSERT INTO `shop_county` VALUES ('3039', '710343', '玉井区');
INSERT INTO `shop_county` VALUES ('3040', '710344', '楠西区');
INSERT INTO `shop_county` VALUES ('3041', '710345', '南化区');
INSERT INTO `shop_county` VALUES ('3042', '710346', '仁德区');
INSERT INTO `shop_county` VALUES ('3043', '710347', '关庙区');
INSERT INTO `shop_county` VALUES ('3044', '710348', '龙崎区');
INSERT INTO `shop_county` VALUES ('3045', '710349', '官田区');
INSERT INTO `shop_county` VALUES ('3046', '710350', '麻豆区');
INSERT INTO `shop_county` VALUES ('3047', '710351', '佳里区');
INSERT INTO `shop_county` VALUES ('3048', '710352', '西港区');
INSERT INTO `shop_county` VALUES ('3049', '710353', '七股区');
INSERT INTO `shop_county` VALUES ('3050', '710354', '将军区');
INSERT INTO `shop_county` VALUES ('3051', '710355', '学甲区');
INSERT INTO `shop_county` VALUES ('3052', '710356', '北门区');
INSERT INTO `shop_county` VALUES ('3053', '710357', '新营区');
INSERT INTO `shop_county` VALUES ('3054', '710358', '后壁区');
INSERT INTO `shop_county` VALUES ('3055', '710359', '白河区');
INSERT INTO `shop_county` VALUES ('3056', '710360', '东山区');
INSERT INTO `shop_county` VALUES ('3057', '710361', '六甲区');
INSERT INTO `shop_county` VALUES ('3058', '710362', '下营区');
INSERT INTO `shop_county` VALUES ('3059', '710363', '柳营区');
INSERT INTO `shop_county` VALUES ('3060', '710364', '盐水区');
INSERT INTO `shop_county` VALUES ('3061', '710365', '善化区');
INSERT INTO `shop_county` VALUES ('3062', '710366', '大内区');
INSERT INTO `shop_county` VALUES ('3063', '710367', '山上区');
INSERT INTO `shop_county` VALUES ('3064', '710368', '新市区');
INSERT INTO `shop_county` VALUES ('3065', '710369', '安定区');
INSERT INTO `shop_county` VALUES ('3066', '710399', '其它区');
INSERT INTO `shop_county` VALUES ('3067', '710401', '中区');
INSERT INTO `shop_county` VALUES ('3068', '710402', '东区');
INSERT INTO `shop_county` VALUES ('3069', '710403', '南区');
INSERT INTO `shop_county` VALUES ('3070', '710404', '西区');
INSERT INTO `shop_county` VALUES ('3071', '710405', '北区');
INSERT INTO `shop_county` VALUES ('3072', '710406', '北屯区');
INSERT INTO `shop_county` VALUES ('3073', '710407', '西屯区');
INSERT INTO `shop_county` VALUES ('3074', '710408', '南屯区');
INSERT INTO `shop_county` VALUES ('3075', '710431', '太平区');
INSERT INTO `shop_county` VALUES ('3076', '710432', '大里区');
INSERT INTO `shop_county` VALUES ('3077', '710433', '雾峰区');
INSERT INTO `shop_county` VALUES ('3078', '710434', '乌日区');
INSERT INTO `shop_county` VALUES ('3079', '710435', '丰原区');
INSERT INTO `shop_county` VALUES ('3080', '710436', '后里区');
INSERT INTO `shop_county` VALUES ('3081', '710437', '石冈区');
INSERT INTO `shop_county` VALUES ('3082', '710438', '东势区');
INSERT INTO `shop_county` VALUES ('3083', '710439', '和平区');
INSERT INTO `shop_county` VALUES ('3084', '710440', '新社区');
INSERT INTO `shop_county` VALUES ('3085', '710441', '潭子区');
INSERT INTO `shop_county` VALUES ('3086', '710442', '大雅区');
INSERT INTO `shop_county` VALUES ('3087', '710443', '神冈区');
INSERT INTO `shop_county` VALUES ('3088', '710444', '大肚区');
INSERT INTO `shop_county` VALUES ('3089', '710445', '沙鹿区');
INSERT INTO `shop_county` VALUES ('3090', '710446', '龙井区');
INSERT INTO `shop_county` VALUES ('3091', '710447', '梧栖区');
INSERT INTO `shop_county` VALUES ('3092', '710448', '清水区');
INSERT INTO `shop_county` VALUES ('3093', '710449', '大甲区');
INSERT INTO `shop_county` VALUES ('3094', '710450', '外埔区');
INSERT INTO `shop_county` VALUES ('3095', '710451', '大安区');
INSERT INTO `shop_county` VALUES ('3096', '710499', '其它区');
INSERT INTO `shop_county` VALUES ('3097', '710507', '金沙镇');
INSERT INTO `shop_county` VALUES ('3098', '710508', '金湖镇');
INSERT INTO `shop_county` VALUES ('3099', '710509', '金宁乡');
INSERT INTO `shop_county` VALUES ('3100', '710510', '金城镇');
INSERT INTO `shop_county` VALUES ('3101', '710511', '烈屿乡');
INSERT INTO `shop_county` VALUES ('3102', '710512', '乌坵乡');
INSERT INTO `shop_county` VALUES ('3103', '710614', '南投市');
INSERT INTO `shop_county` VALUES ('3104', '710615', '中寮乡');
INSERT INTO `shop_county` VALUES ('3105', '710616', '草屯镇');
INSERT INTO `shop_county` VALUES ('3106', '710617', '国姓乡');
INSERT INTO `shop_county` VALUES ('3107', '710618', '埔里镇');
INSERT INTO `shop_county` VALUES ('3108', '710619', '仁爱乡');
INSERT INTO `shop_county` VALUES ('3109', '710620', '名间乡');
INSERT INTO `shop_county` VALUES ('3110', '710621', '集集镇');
INSERT INTO `shop_county` VALUES ('3111', '710622', '水里乡');
INSERT INTO `shop_county` VALUES ('3112', '710623', '鱼池乡');
INSERT INTO `shop_county` VALUES ('3113', '710624', '信义乡');
INSERT INTO `shop_county` VALUES ('3114', '710625', '竹山镇');
INSERT INTO `shop_county` VALUES ('3115', '710626', '鹿谷乡');
INSERT INTO `shop_county` VALUES ('3116', '710701', '仁爱区');
INSERT INTO `shop_county` VALUES ('3117', '710702', '信义区');
INSERT INTO `shop_county` VALUES ('3118', '710703', '中正区');
INSERT INTO `shop_county` VALUES ('3119', '710704', '中山区');
INSERT INTO `shop_county` VALUES ('3120', '710705', '安乐区');
INSERT INTO `shop_county` VALUES ('3121', '710706', '暖暖区');
INSERT INTO `shop_county` VALUES ('3122', '710707', '七堵区');
INSERT INTO `shop_county` VALUES ('3123', '710799', '其它区');
INSERT INTO `shop_county` VALUES ('3124', '710801', '东区');
INSERT INTO `shop_county` VALUES ('3125', '710802', '北区');
INSERT INTO `shop_county` VALUES ('3126', '710803', '香山区');
INSERT INTO `shop_county` VALUES ('3127', '710899', '其它区');
INSERT INTO `shop_county` VALUES ('3128', '710901', '东区');
INSERT INTO `shop_county` VALUES ('3129', '710902', '西区');
INSERT INTO `shop_county` VALUES ('3130', '710999', '其它区');
INSERT INTO `shop_county` VALUES ('3131', '711130', '万里区');
INSERT INTO `shop_county` VALUES ('3132', '711132', '板桥区');
INSERT INTO `shop_county` VALUES ('3133', '711133', '汐止区');
INSERT INTO `shop_county` VALUES ('3134', '711134', '深坑区');
INSERT INTO `shop_county` VALUES ('3135', '711136', '瑞芳区');
INSERT INTO `shop_county` VALUES ('3136', '711137', '平溪区');
INSERT INTO `shop_county` VALUES ('3137', '711138', '双溪区');
INSERT INTO `shop_county` VALUES ('3138', '711140', '新店区');
INSERT INTO `shop_county` VALUES ('3139', '711141', '坪林区');
INSERT INTO `shop_county` VALUES ('3140', '711142', '乌来区');
INSERT INTO `shop_county` VALUES ('3141', '711143', '永和区');
INSERT INTO `shop_county` VALUES ('3142', '711144', '中和区');
INSERT INTO `shop_county` VALUES ('3143', '711145', '土城区');
INSERT INTO `shop_county` VALUES ('3144', '711146', '三峡区');
INSERT INTO `shop_county` VALUES ('3145', '711147', '树林区');
INSERT INTO `shop_county` VALUES ('3146', '711149', '三重区');
INSERT INTO `shop_county` VALUES ('3147', '711150', '新庄区');
INSERT INTO `shop_county` VALUES ('3148', '711151', '泰山区');
INSERT INTO `shop_county` VALUES ('3149', '711152', '林口区');
INSERT INTO `shop_county` VALUES ('3150', '711154', '五股区');
INSERT INTO `shop_county` VALUES ('3151', '711155', '八里区');
INSERT INTO `shop_county` VALUES ('3152', '711156', '淡水区');
INSERT INTO `shop_county` VALUES ('3153', '711157', '三芝区');
INSERT INTO `shop_county` VALUES ('3154', '711287', '宜兰市');
INSERT INTO `shop_county` VALUES ('3155', '711288', '头城镇');
INSERT INTO `shop_county` VALUES ('3156', '711289', '礁溪乡');
INSERT INTO `shop_county` VALUES ('3157', '711290', '壮围乡');
INSERT INTO `shop_county` VALUES ('3158', '711291', '员山乡');
INSERT INTO `shop_county` VALUES ('3159', '711292', '罗东镇');
INSERT INTO `shop_county` VALUES ('3160', '711293', '三星乡');
INSERT INTO `shop_county` VALUES ('3161', '711294', '大同乡');
INSERT INTO `shop_county` VALUES ('3162', '711295', '五结乡');
INSERT INTO `shop_county` VALUES ('3163', '711296', '冬山乡');
INSERT INTO `shop_county` VALUES ('3164', '711297', '苏澳镇');
INSERT INTO `shop_county` VALUES ('3165', '711298', '南澳乡');
INSERT INTO `shop_county` VALUES ('3166', '711299', '钓鱼台');
INSERT INTO `shop_county` VALUES ('3167', '711387', '竹北市');
INSERT INTO `shop_county` VALUES ('3168', '711388', '湖口乡');
INSERT INTO `shop_county` VALUES ('3169', '711389', '新丰乡');
INSERT INTO `shop_county` VALUES ('3170', '711390', '新埔镇');
INSERT INTO `shop_county` VALUES ('3171', '711391', '关西镇');
INSERT INTO `shop_county` VALUES ('3172', '711392', '芎林乡');
INSERT INTO `shop_county` VALUES ('3173', '711393', '宝山乡');
INSERT INTO `shop_county` VALUES ('3174', '711394', '竹东镇');
INSERT INTO `shop_county` VALUES ('3175', '711395', '五峰乡');
INSERT INTO `shop_county` VALUES ('3176', '711396', '横山乡');
INSERT INTO `shop_county` VALUES ('3177', '711397', '尖石乡');
INSERT INTO `shop_county` VALUES ('3178', '711398', '北埔乡');
INSERT INTO `shop_county` VALUES ('3179', '711399', '峨眉乡');
INSERT INTO `shop_county` VALUES ('3180', '711487', '中坜市');
INSERT INTO `shop_county` VALUES ('3181', '711488', '平镇市');
INSERT INTO `shop_county` VALUES ('3182', '711489', '龙潭乡');
INSERT INTO `shop_county` VALUES ('3183', '711490', '杨梅市');
INSERT INTO `shop_county` VALUES ('3184', '711491', '新屋乡');
INSERT INTO `shop_county` VALUES ('3185', '711492', '观音乡');
INSERT INTO `shop_county` VALUES ('3186', '711493', '桃园市');
INSERT INTO `shop_county` VALUES ('3187', '711494', '龟山乡');
INSERT INTO `shop_county` VALUES ('3188', '711495', '八德市');
INSERT INTO `shop_county` VALUES ('3189', '711496', '大溪镇');
INSERT INTO `shop_county` VALUES ('3190', '711497', '复兴乡');
INSERT INTO `shop_county` VALUES ('3191', '711498', '大园乡');
INSERT INTO `shop_county` VALUES ('3192', '711499', '芦竹乡');
INSERT INTO `shop_county` VALUES ('3193', '711582', '竹南镇');
INSERT INTO `shop_county` VALUES ('3194', '711583', '头份镇');
INSERT INTO `shop_county` VALUES ('3195', '711584', '三湾乡');
INSERT INTO `shop_county` VALUES ('3196', '711585', '南庄乡');
INSERT INTO `shop_county` VALUES ('3197', '711586', '狮潭乡');
INSERT INTO `shop_county` VALUES ('3198', '711587', '后龙镇');
INSERT INTO `shop_county` VALUES ('3199', '711588', '通霄镇');
INSERT INTO `shop_county` VALUES ('3200', '711589', '苑里镇');
INSERT INTO `shop_county` VALUES ('3201', '711590', '苗栗市');
INSERT INTO `shop_county` VALUES ('3202', '711591', '造桥乡');
INSERT INTO `shop_county` VALUES ('3203', '711592', '头屋乡');
INSERT INTO `shop_county` VALUES ('3204', '711593', '公馆乡');
INSERT INTO `shop_county` VALUES ('3205', '711594', '大湖乡');
INSERT INTO `shop_county` VALUES ('3206', '711595', '泰安乡');
INSERT INTO `shop_county` VALUES ('3207', '711596', '铜锣乡');
INSERT INTO `shop_county` VALUES ('3208', '711597', '三义乡');
INSERT INTO `shop_county` VALUES ('3209', '711598', '西湖乡');
INSERT INTO `shop_county` VALUES ('3210', '711599', '卓兰镇');
INSERT INTO `shop_county` VALUES ('3211', '711774', '彰化市');
INSERT INTO `shop_county` VALUES ('3212', '711775', '芬园乡');
INSERT INTO `shop_county` VALUES ('3213', '711776', '花坛乡');
INSERT INTO `shop_county` VALUES ('3214', '711777', '秀水乡');
INSERT INTO `shop_county` VALUES ('3215', '711778', '鹿港镇');
INSERT INTO `shop_county` VALUES ('3216', '711779', '福兴乡');
INSERT INTO `shop_county` VALUES ('3217', '711780', '线西乡');
INSERT INTO `shop_county` VALUES ('3218', '711781', '和美镇');
INSERT INTO `shop_county` VALUES ('3219', '711782', '伸港乡');
INSERT INTO `shop_county` VALUES ('3220', '711783', '员林镇');
INSERT INTO `shop_county` VALUES ('3221', '711784', '社头乡');
INSERT INTO `shop_county` VALUES ('3222', '711785', '永靖乡');
INSERT INTO `shop_county` VALUES ('3223', '711786', '埔心乡');
INSERT INTO `shop_county` VALUES ('3224', '711787', '溪湖镇');
INSERT INTO `shop_county` VALUES ('3225', '711788', '大村乡');
INSERT INTO `shop_county` VALUES ('3226', '711789', '埔盐乡');
INSERT INTO `shop_county` VALUES ('3227', '711790', '田中镇');
INSERT INTO `shop_county` VALUES ('3228', '711791', '北斗镇');
INSERT INTO `shop_county` VALUES ('3229', '711792', '田尾乡');
INSERT INTO `shop_county` VALUES ('3230', '711793', '埤头乡');
INSERT INTO `shop_county` VALUES ('3231', '711794', '溪州乡');
INSERT INTO `shop_county` VALUES ('3232', '711795', '竹塘乡');
INSERT INTO `shop_county` VALUES ('3233', '711796', '二林镇');
INSERT INTO `shop_county` VALUES ('3234', '711797', '大城乡');
INSERT INTO `shop_county` VALUES ('3235', '711798', '芳苑乡');
INSERT INTO `shop_county` VALUES ('3236', '711799', '二水乡');
INSERT INTO `shop_county` VALUES ('3237', '711982', '番路乡');
INSERT INTO `shop_county` VALUES ('3238', '711983', '梅山乡');
INSERT INTO `shop_county` VALUES ('3239', '711984', '竹崎乡');
INSERT INTO `shop_county` VALUES ('3240', '711985', '阿里山乡');
INSERT INTO `shop_county` VALUES ('3241', '711986', '中埔乡');
INSERT INTO `shop_county` VALUES ('3242', '711987', '大埔乡');
INSERT INTO `shop_county` VALUES ('3243', '711988', '水上乡');
INSERT INTO `shop_county` VALUES ('3244', '711989', '鹿草乡');
INSERT INTO `shop_county` VALUES ('3245', '711990', '太保市');
INSERT INTO `shop_county` VALUES ('3246', '711991', '朴子市');
INSERT INTO `shop_county` VALUES ('3247', '711992', '东石乡');
INSERT INTO `shop_county` VALUES ('3248', '711993', '六脚乡');
INSERT INTO `shop_county` VALUES ('3249', '711994', '新港乡');
INSERT INTO `shop_county` VALUES ('3250', '711995', '民雄乡');
INSERT INTO `shop_county` VALUES ('3251', '711996', '大林镇');
INSERT INTO `shop_county` VALUES ('3252', '711997', '溪口乡');
INSERT INTO `shop_county` VALUES ('3253', '711998', '义竹乡');
INSERT INTO `shop_county` VALUES ('3254', '711999', '布袋镇');
INSERT INTO `shop_county` VALUES ('3255', '712180', '斗南镇');
INSERT INTO `shop_county` VALUES ('3256', '712181', '大埤乡');
INSERT INTO `shop_county` VALUES ('3257', '712182', '虎尾镇');
INSERT INTO `shop_county` VALUES ('3258', '712183', '土库镇');
INSERT INTO `shop_county` VALUES ('3259', '712184', '褒忠乡');
INSERT INTO `shop_county` VALUES ('3260', '712185', '东势乡');
INSERT INTO `shop_county` VALUES ('3261', '712186', '台西乡');
INSERT INTO `shop_county` VALUES ('3262', '712187', '仑背乡');
INSERT INTO `shop_county` VALUES ('3263', '712188', '麦寮乡');
INSERT INTO `shop_county` VALUES ('3264', '712189', '斗六市');
INSERT INTO `shop_county` VALUES ('3265', '712190', '林内乡');
INSERT INTO `shop_county` VALUES ('3266', '712191', '古坑乡');
INSERT INTO `shop_county` VALUES ('3267', '712192', '莿桐乡');
INSERT INTO `shop_county` VALUES ('3268', '712193', '西螺镇');
INSERT INTO `shop_county` VALUES ('3269', '712194', '二仑乡');
INSERT INTO `shop_county` VALUES ('3270', '712195', '北港镇');
INSERT INTO `shop_county` VALUES ('3271', '712196', '水林乡');
INSERT INTO `shop_county` VALUES ('3272', '712197', '口湖乡');
INSERT INTO `shop_county` VALUES ('3273', '712198', '四湖乡');
INSERT INTO `shop_county` VALUES ('3274', '712199', '元长乡');
INSERT INTO `shop_county` VALUES ('3275', '712467', '屏东市');
INSERT INTO `shop_county` VALUES ('3276', '712468', '三地门乡');
INSERT INTO `shop_county` VALUES ('3277', '712469', '雾台乡');
INSERT INTO `shop_county` VALUES ('3278', '712470', '玛家乡');
INSERT INTO `shop_county` VALUES ('3279', '712471', '九如乡');
INSERT INTO `shop_county` VALUES ('3280', '712472', '里港乡');
INSERT INTO `shop_county` VALUES ('3281', '712473', '高树乡');
INSERT INTO `shop_county` VALUES ('3282', '712474', '盐埔乡');
INSERT INTO `shop_county` VALUES ('3283', '712475', '长治乡');
INSERT INTO `shop_county` VALUES ('3284', '712476', '麟洛乡');
INSERT INTO `shop_county` VALUES ('3285', '712477', '竹田乡');
INSERT INTO `shop_county` VALUES ('3286', '712478', '内埔乡');
INSERT INTO `shop_county` VALUES ('3287', '712479', '万丹乡');
INSERT INTO `shop_county` VALUES ('3288', '712480', '潮州镇');
INSERT INTO `shop_county` VALUES ('3289', '712481', '泰武乡');
INSERT INTO `shop_county` VALUES ('3290', '712482', '来义乡');
INSERT INTO `shop_county` VALUES ('3291', '712483', '万峦乡');
INSERT INTO `shop_county` VALUES ('3292', '712484', '莰顶乡');
INSERT INTO `shop_county` VALUES ('3293', '712485', '新埤乡');
INSERT INTO `shop_county` VALUES ('3294', '712486', '南州乡');
INSERT INTO `shop_county` VALUES ('3295', '712487', '林边乡');
INSERT INTO `shop_county` VALUES ('3296', '712488', '东港镇');
INSERT INTO `shop_county` VALUES ('3297', '712489', '琉球乡');
INSERT INTO `shop_county` VALUES ('3298', '712490', '佳冬乡');
INSERT INTO `shop_county` VALUES ('3299', '712491', '新园乡');
INSERT INTO `shop_county` VALUES ('3300', '712492', '枋寮乡');
INSERT INTO `shop_county` VALUES ('3301', '712493', '枋山乡');
INSERT INTO `shop_county` VALUES ('3302', '712494', '春日乡');
INSERT INTO `shop_county` VALUES ('3303', '712495', '狮子乡');
INSERT INTO `shop_county` VALUES ('3304', '712496', '车城乡');
INSERT INTO `shop_county` VALUES ('3305', '712497', '牡丹乡');
INSERT INTO `shop_county` VALUES ('3306', '712498', '恒春镇');
INSERT INTO `shop_county` VALUES ('3307', '712499', '满州乡');
INSERT INTO `shop_county` VALUES ('3308', '712584', '台东市');
INSERT INTO `shop_county` VALUES ('3309', '712585', '绿岛乡');
INSERT INTO `shop_county` VALUES ('3310', '712586', '兰屿乡');
INSERT INTO `shop_county` VALUES ('3311', '712587', '延平乡');
INSERT INTO `shop_county` VALUES ('3312', '712588', '卑南乡');
INSERT INTO `shop_county` VALUES ('3313', '712589', '鹿野乡');
INSERT INTO `shop_county` VALUES ('3314', '712590', '关山镇');
INSERT INTO `shop_county` VALUES ('3315', '712591', '海端乡');
INSERT INTO `shop_county` VALUES ('3316', '712592', '池上乡');
INSERT INTO `shop_county` VALUES ('3317', '712593', '东河乡');
INSERT INTO `shop_county` VALUES ('3318', '712594', '成功镇');
INSERT INTO `shop_county` VALUES ('3319', '712595', '长滨乡');
INSERT INTO `shop_county` VALUES ('3320', '712596', '金峰乡');
INSERT INTO `shop_county` VALUES ('3321', '712597', '大武乡');
INSERT INTO `shop_county` VALUES ('3322', '712598', '达仁乡');
INSERT INTO `shop_county` VALUES ('3323', '712599', '太麻里乡');
INSERT INTO `shop_county` VALUES ('3324', '712686', '花莲市');
INSERT INTO `shop_county` VALUES ('3325', '712687', '新城乡');
INSERT INTO `shop_county` VALUES ('3326', '712688', '太鲁阁');
INSERT INTO `shop_county` VALUES ('3327', '712689', '秀林乡');
INSERT INTO `shop_county` VALUES ('3328', '712690', '吉安乡');
INSERT INTO `shop_county` VALUES ('3329', '712691', '寿丰乡');
INSERT INTO `shop_county` VALUES ('3330', '712692', '凤林镇');
INSERT INTO `shop_county` VALUES ('3331', '712693', '光复乡');
INSERT INTO `shop_county` VALUES ('3332', '712694', '丰滨乡');
INSERT INTO `shop_county` VALUES ('3333', '712695', '瑞穗乡');
INSERT INTO `shop_county` VALUES ('3334', '712696', '万荣乡');
INSERT INTO `shop_county` VALUES ('3335', '712697', '玉里镇');
INSERT INTO `shop_county` VALUES ('3336', '712698', '卓溪乡');
INSERT INTO `shop_county` VALUES ('3337', '712699', '富里乡');
INSERT INTO `shop_county` VALUES ('3338', '712794', '马公市');
INSERT INTO `shop_county` VALUES ('3339', '712795', '西屿乡');
INSERT INTO `shop_county` VALUES ('3340', '712796', '望安乡');
INSERT INTO `shop_county` VALUES ('3341', '712797', '七美乡');
INSERT INTO `shop_county` VALUES ('3342', '712798', '白沙乡');
INSERT INTO `shop_county` VALUES ('3343', '712799', '湖西乡');
INSERT INTO `shop_county` VALUES ('3344', '712896', '南竿乡');
INSERT INTO `shop_county` VALUES ('3345', '712897', '北竿乡');
INSERT INTO `shop_county` VALUES ('3346', '712898', '东引乡');
INSERT INTO `shop_county` VALUES ('3347', '712899', '莒光乡');
INSERT INTO `shop_county` VALUES ('3348', '810101', '中西区');
INSERT INTO `shop_county` VALUES ('3349', '810102', '湾仔');
INSERT INTO `shop_county` VALUES ('3350', '810103', '东区');
INSERT INTO `shop_county` VALUES ('3351', '810104', '南区');
INSERT INTO `shop_county` VALUES ('3352', '810201', '九龙城区');
INSERT INTO `shop_county` VALUES ('3353', '810202', '油尖旺区');
INSERT INTO `shop_county` VALUES ('3354', '810203', '深水埗区');
INSERT INTO `shop_county` VALUES ('3355', '810204', '黄大仙区');
INSERT INTO `shop_county` VALUES ('3356', '810205', '观塘区');
INSERT INTO `shop_county` VALUES ('3357', '810301', '北区');
INSERT INTO `shop_county` VALUES ('3358', '810302', '大埔区');
INSERT INTO `shop_county` VALUES ('3359', '810303', '沙田区');
INSERT INTO `shop_county` VALUES ('3360', '810304', '西贡区');
INSERT INTO `shop_county` VALUES ('3361', '810305', '元朗区');
INSERT INTO `shop_county` VALUES ('3362', '810306', '屯门区');
INSERT INTO `shop_county` VALUES ('3363', '810307', '荃湾区');
INSERT INTO `shop_county` VALUES ('3364', '810308', '葵青区');
INSERT INTO `shop_county` VALUES ('3365', '810309', '离岛区');
INSERT INTO `shop_county` VALUES ('3366', '820101', '澳门半岛');
INSERT INTO `shop_county` VALUES ('3367', '820201', '离岛');

-- ----------------------------
-- Table structure for shop_index_layout
-- ----------------------------
DROP TABLE IF EXISTS `shop_index_layout`;
CREATE TABLE `shop_index_layout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) DEFAULT NULL,
  `sort_order` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_index_layout
-- ----------------------------
INSERT INTO `shop_index_layout` VALUES ('2', '2', '12');
INSERT INTO `shop_index_layout` VALUES ('3', '3', '2');
INSERT INTO `shop_index_layout` VALUES ('4', '4', '3');
INSERT INTO `shop_index_layout` VALUES ('5', '5', '4');
INSERT INTO `shop_index_layout` VALUES ('6', '6', '1');

-- ----------------------------
-- Table structure for shop_inventory_record
-- ----------------------------
DROP TABLE IF EXISTS `shop_inventory_record`;
CREATE TABLE `shop_inventory_record` (
  `inventory_record_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `product_id` int(11) DEFAULT NULL COMMENT '商品id',
  `member_id` int(11) DEFAULT NULL COMMENT '会员id',
  `name` varchar(50) DEFAULT NULL COMMENT '会员真实姓名',
  `state` varchar(50) DEFAULT NULL COMMENT '出库，入库(1出库   2入库)',
  `date_added` varchar(100) DEFAULT NULL COMMENT '创建时间',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `before_inventory` int(11) DEFAULT NULL COMMENT '出入库前库存',
  `change_inventory` int(11) DEFAULT NULL COMMENT '改变的库存(出入库数量)',
  `now_inventory` int(11) DEFAULT NULL COMMENT '现在库存',
  `total_state` varchar(50) DEFAULT NULL COMMENT '总部, 代理(1总部   2代理)',
  `userName` varchar(50) DEFAULT NULL COMMENT '操作人用户号',
  `user_name` varchar(50) DEFAULT NULL COMMENT '操作人真实姓名',
  PRIMARY KEY (`inventory_record_id`)
) ENGINE=InnoDB AUTO_INCREMENT=186 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of shop_inventory_record
-- ----------------------------
INSERT INTO `shop_inventory_record` VALUES ('185', '100', null, null, '2', '2018-12-06 14:17:13', '添加总库存', '0', '100', '100', '1', 'admin', '超级管理员');

-- ----------------------------
-- Table structure for shop_members
-- ----------------------------
DROP TABLE IF EXISTS `shop_members`;
CREATE TABLE `shop_members` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(20) DEFAULT NULL COMMENT '订单号',
  `openid` varchar(50) DEFAULT NULL,
  `wx_num` varchar(50) DEFAULT NULL COMMENT '微信号',
  `nick_name` varchar(100) DEFAULT NULL COMMENT '微信昵称',
  `head_portrait` varchar(255) DEFAULT NULL COMMENT '微信头像地址',
  `name` varchar(50) DEFAULT NULL COMMENT '会员名称',
  `idcard` varchar(18) DEFAULT NULL COMMENT '会员身份号',
  `phone` varchar(11) DEFAULT NULL COMMENT '会员手机号',
  `level` int(1) DEFAULT NULL COMMENT '会员等级',
  `level_info` varchar(50) DEFAULT NULL COMMENT '会员等级名称',
  `level_price` varchar(10) DEFAULT NULL COMMENT '会费价格',
  `flag` bit(1) DEFAULT NULL COMMENT '是否支付(有效会员)',
  `referee_phone` varchar(11) DEFAULT NULL COMMENT '推荐人手机号',
  `create_time` varchar(25) DEFAULT NULL COMMENT '订单创建时间',
  `updatedAt` varchar(25) DEFAULT NULL COMMENT '订单支付完成时间',
  `authorization_number` varchar(6) DEFAULT NULL COMMENT '授权编号',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=345 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of shop_members
-- ----------------------------
INSERT INTO `shop_members` VALUES ('342', 'IB305898275458d', 'oNBwv5bP-8pZ3kjDODFuto2h3qC8', 'asgagl', 'Vue', 'https://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83epiczXDOxnOO3ytp0dU3oZiaicmxHCA3l9pvgE83bjgjD0Kte5tpu0ZXSmtrwIa6WqoibbuaVzpf7CHRA/132', 'wangxin', '142227199409050017', '18235440687', '4', '合伙人', '0.03', '\0', '', '2018-11-30 14:23:02', null, '000108');
INSERT INTO `shop_members` VALUES ('343', 'IB306057049640d', 'oNBwv5bP-8pZ3kjDODFuto2h3qC8', 'wx', 'Vue', 'https://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83epiczXDOxnOO3ytp0dU3oZiaicmxHCA3l9pvgE83bjgjD0Kte5tpu0ZXSmtrwIa6WqoibbuaVzpf7CHRA/132', '王鑫', '142227199409050017', '18235440687', '4', '合伙人', '0.03', '', '', '2018-11-30 14:49:30', null, '000108');
INSERT INTO `shop_members` VALUES ('344', 'IC077545354390d', 'o98z64pW-PqX-AV9TyeY-KgGbg1Y', '123', '王强', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIo5lGclegteKj87fytXeKSND4Fbjpk05d7gyu6EDDnVgAVLbcSwhibPgHicyCLF9s5nZgebWTLbDtg/132', '123', '141002199401230057', '18834811593', '1', '普通会员', '0', '', '18235440687', '2018-12-07 17:37:33', '2018-12-07 17:37:33', null);

-- ----------------------------
-- Table structure for shop_member_address
-- ----------------------------
DROP TABLE IF EXISTS `shop_member_address`;
CREATE TABLE `shop_member_address` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `openid` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL COMMENT '详细地址',
  `consignee_name` varchar(50) DEFAULT NULL COMMENT '收货人姓名',
  `consignee_phone` varchar(11) DEFAULT NULL COMMENT '收货人手机号',
  `create_time` varchar(100) DEFAULT NULL COMMENT '创建时间',
  `member_id` int(50) DEFAULT NULL COMMENT '会员id',
  `city` varchar(50) DEFAULT '' COMMENT '市',
  `county` varchar(50) DEFAULT '' COMMENT '区',
  `province` varchar(50) DEFAULT '' COMMENT '省',
  `map_code` varchar(50) DEFAULT NULL COMMENT '地图编码省编码',
  `state` int(5) DEFAULT NULL COMMENT '是否为默认地址(0:不是,1:是)',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of shop_member_address
-- ----------------------------
INSERT INTO `shop_member_address` VALUES ('2', '34qgfdgdsfg', '茂业天地', '李四', '18295742043', '2018-12-10 17:59:21', '1', '太原市', '迎泽区', '山西省', 'SHX', '1');
INSERT INTO `shop_member_address` VALUES ('3', '34qgfdgdsfg', '茂业天地', '张三', '18295742016', '2018-12-10 18:00:40', '1', '太原市', '小店区', '山西省', 'SHX', '0');
INSERT INTO `shop_member_address` VALUES ('4', '34qgfdgdsfg', '茂业天地1', '张三', '18295742016', '2018-12-10 18:07:39', '1', '太原市', '小店区', '山西省', 'SHX', '0');
INSERT INTO `shop_member_address` VALUES ('5', 'dsgsgs124gs42fs', '测试', '王五', '17696068521', '2018-12-11 14:16:16', '2', '运城市', '无', '山西省', 'SHX', '0');
INSERT INTO `shop_member_address` VALUES ('6', 'dsgsgs124gs42fs', '测试', '王五', '17696068521', '2018-12-11 14:16:31', '2', '运城市', '无', '山西省', 'SHX', '0');
INSERT INTO `shop_member_address` VALUES ('7', 'dsgsgs124gs42fs', '测试', '王五', '17696068521', '2018-12-11 14:16:41', '2', '运城市', '无', '山西省', 'SHX', '1');

-- ----------------------------
-- Table structure for shop_module
-- ----------------------------
DROP TABLE IF EXISTS `shop_module`;
CREATE TABLE `shop_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `setting` text,
  `keyword` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_module
-- ----------------------------
INSERT INTO `shop_module` VALUES ('2', '创始人团队', '{\"indexImg\":\"/image/favicon1544518397.png\",\"product\":\"100\"}', 'IndexImage');
INSERT INTO `shop_module` VALUES ('3', '创始人233', '{\"indexImg\":\"/image/vip31544520844.jpg\",\"product\":\"100\"}', 'IndexImage');
INSERT INTO `shop_module` VALUES ('4', '测试一2333', '{\"indexImg\":\"/image/vip21544526995.jpg\",\"product\":\"100\"}', 'IndexImage');
INSERT INTO `shop_module` VALUES ('5', 'oem', '{\"indexImg\":\"/image/vip31544525518.jpg\",\"product\":\"101\"}', 'IndexImage');
INSERT INTO `shop_module` VALUES ('6', '首页单图商品一', '{\"indexImg\":\"/image/31544603350.png\",\"product\":\"100\"}', 'IndexImage');

-- ----------------------------
-- Table structure for shop_payment_record
-- ----------------------------
DROP TABLE IF EXISTS `shop_payment_record`;
CREATE TABLE `shop_payment_record` (
  `payment_record_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `before_balance_pay` varchar(50) CHARACTER SET utf8 DEFAULT NULL COMMENT '支付前余额',
  `balance_pay` varchar(50) CHARACTER SET utf8 DEFAULT NULL COMMENT '余额支付金额',
  `after_balance_pay` varchar(50) CHARACTER SET utf8 DEFAULT NULL COMMENT '支付后剩余余额',
  `member_id` int(11) DEFAULT NULL COMMENT '会员id',
  `total_pay` varchar(50) DEFAULT NULL COMMENT '总支付金额',
  `cash_pay` varchar(50) DEFAULT NULL COMMENT '现金支付金额',
  `product_order_id` int(11) DEFAULT NULL COMMENT '商品订单id',
  `create_time` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT '订单创建时间',
  `remark` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '订单备注',
  `state` varchar(10) CHARACTER SET utf8 DEFAULT NULL COMMENT '是否支付(1:支付,0:未支付)',
  `update_time` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT '支付成功后更新时间',
  PRIMARY KEY (`payment_record_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of shop_payment_record
-- ----------------------------
INSERT INTO `shop_payment_record` VALUES ('13', '0.03', '0.01', '0.020000', null, null, null, null, '2018-11-30 14:23:02', null, '0', null);
INSERT INTO `shop_payment_record` VALUES ('14', '0.03', '0.01', '0.020000', null, null, null, null, '2018-11-30 14:49:30', null, '1', null);
INSERT INTO `shop_payment_record` VALUES ('15', '0.020000', '0.01', '0.010000', null, null, null, null, '2018-11-30 15:07:53', null, '1', null);
INSERT INTO `shop_payment_record` VALUES ('16', '0.010000', '0.01', '0.000000', null, null, null, null, '2018-11-30 15:19:21', null, '0', null);
INSERT INTO `shop_payment_record` VALUES ('17', '0.010000', '0.01', '0.000000', null, null, null, null, '2018-11-30 15:26:38', null, '0', null);
INSERT INTO `shop_payment_record` VALUES ('18', '0.010000', '0.01', '0.000000', null, null, null, null, '2018-11-30 15:38:25', null, '0', null);

-- ----------------------------
-- Table structure for shop_product
-- ----------------------------
DROP TABLE IF EXISTS `shop_product`;
CREATE TABLE `shop_product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand` varchar(200) DEFAULT NULL COMMENT '品牌',
  `name` varchar(200) DEFAULT NULL COMMENT '商品名称',
  `first_picture` varchar(255) DEFAULT NULL COMMENT '首图',
  `intro` text COMMENT '商品简介',
  `detail` text COMMENT '详情图',
  `create_time` varchar(100) DEFAULT NULL COMMENT '创建时间',
  `market_price` decimal(65,2) DEFAULT NULL COMMENT '市场价',
  `num` int(11) DEFAULT NULL COMMENT '实际库存数',
  `brokerage` varchar(50) DEFAULT NULL COMMENT '佣金比率',
  PRIMARY KEY (`product_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of shop_product
-- ----------------------------
INSERT INTO `shop_product` VALUES ('100', '12', '12', '/image/favicon1544077002.png', '12', '<p>123</p>', '2018-12-06 14:16:53', '12.00', '100', '');
INSERT INTO `shop_product` VALUES ('101', '12', '222', '/image/favicon1544077002.png', '12', '<p>123</p>', '2018-12-06 14:16:53', '12.00', '100', null);

-- ----------------------------
-- Table structure for shop_product_banner
-- ----------------------------
DROP TABLE IF EXISTS `shop_product_banner`;
CREATE TABLE `shop_product_banner` (
  `banner_id` int(50) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) DEFAULT NULL COMMENT '图片路径',
  `create_time` varchar(100) DEFAULT NULL COMMENT '创建时间',
  `product_id` int(11) DEFAULT NULL COMMENT '商品id',
  PRIMARY KEY (`banner_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1168 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of shop_product_banner
-- ----------------------------
INSERT INTO `shop_product_banner` VALUES ('1167', '/image/favicon1544077009.png', '2018-12-06 14:16:53', '100');

-- ----------------------------
-- Table structure for shop_product_express
-- ----------------------------
DROP TABLE IF EXISTS `shop_product_express`;
CREATE TABLE `shop_product_express` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL COMMENT '订单id',
  `express_number` varchar(100) DEFAULT NULL COMMENT '快递单号',
  `express_name` varchar(100) DEFAULT NULL COMMENT '快递名称',
  `ship_time` varchar(100) DEFAULT NULL COMMENT '发货时间',
  `ship_num` int(11) DEFAULT NULL COMMENT '发货数量',
  `status` varchar(10) DEFAULT NULL COMMENT '发货状态(0:发货,1:退货)',
  `create_time` varchar(100) DEFAULT NULL COMMENT '创建时间',
  `userName` varchar(50) DEFAULT NULL COMMENT '操作人用户号',
  `user_name` varchar(50) DEFAULT NULL COMMENT '操作人真实姓名',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of shop_product_express
-- ----------------------------

-- ----------------------------
-- Table structure for shop_product_order
-- ----------------------------
DROP TABLE IF EXISTS `shop_product_order`;
CREATE TABLE `shop_product_order` (
  `product_order_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `product_name` varchar(200) DEFAULT NULL COMMENT '商品名',
  `product_price` decimal(65,2) DEFAULT NULL COMMENT '商品价格',
  `product_num` int(11) DEFAULT NULL COMMENT '商品数量',
  `member_id` int(11) DEFAULT NULL COMMENT '会员id',
  `pay` varchar(10) DEFAULT NULL COMMENT '支付状态(0未支付1已支付2待收货3已完成)',
  `create_time` varchar(100) DEFAULT NULL COMMENT '创建时间',
  `openid` varchar(255) DEFAULT NULL,
  `order_id` varchar(100) DEFAULT NULL COMMENT '微信支付编号',
  `updatedAt` varchar(100) DEFAULT NULL COMMENT '支付后更新时间',
  `update_date` int(11) DEFAULT NULL COMMENT '支付后更新时间',
  `shipping_address` varchar(255) DEFAULT NULL COMMENT '收货地址',
  `ship_status` varchar(10) DEFAULT '0' COMMENT '发货状态(0:未发货，1：已发货)',
  `province_code` varchar(50) DEFAULT NULL COMMENT '省编码',
  `province_name` varchar(50) DEFAULT NULL COMMENT '省名',
  `product_id` int(11) DEFAULT NULL COMMENT '商品id',
  `balance_pay` varchar(50) DEFAULT NULL COMMENT '余额支付金额',
  `cash_pay` varchar(50) DEFAULT NULL COMMENT '现金支付金额',
  `status` varchar(10) DEFAULT NULL COMMENT '是否删除(0未删除1删除)',
  PRIMARY KEY (`product_order_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=216 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of shop_product_order
-- ----------------------------
INSERT INTO `shop_product_order` VALUES ('1', '测试', '260.00', '1', '1', '3', null, null, null, null, null, null, '0', null, null, null, null, null, '1');
INSERT INTO `shop_product_order` VALUES ('2', '测试1', '260.00', '1', '1', '1', '', '', '', '', null, '', '0', '', '', null, '', '', '0');

-- ----------------------------
-- Table structure for shop_province
-- ----------------------------
DROP TABLE IF EXISTS `shop_province`;
CREATE TABLE `shop_province` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wx_code` varchar(50) DEFAULT NULL COMMENT '小程序编码',
  `name` varchar(50) DEFAULT NULL COMMENT '省名',
  `map_code` varchar(50) DEFAULT NULL COMMENT '地图编码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of shop_province
-- ----------------------------
INSERT INTO `shop_province` VALUES ('36', '110000', '北京市', 'BEJ');
INSERT INTO `shop_province` VALUES ('37', '120000', '天津市', 'TAJ');
INSERT INTO `shop_province` VALUES ('38', '130000', '河北省', 'HEB');
INSERT INTO `shop_province` VALUES ('39', '140000', '山西省', 'SHX');
INSERT INTO `shop_province` VALUES ('40', '150000', '内蒙古自治区', 'NMG');
INSERT INTO `shop_province` VALUES ('41', '210000', '辽宁省', 'LIA');
INSERT INTO `shop_province` VALUES ('42', '220000', '吉林省', 'JIL');
INSERT INTO `shop_province` VALUES ('43', '230000', '黑龙江', 'HLJ');
INSERT INTO `shop_province` VALUES ('44', '310000', '上海市', 'SHH');
INSERT INTO `shop_province` VALUES ('45', '320000', '江苏省', 'JSU');
INSERT INTO `shop_province` VALUES ('46', '330000', '浙江省', 'ZHJ');
INSERT INTO `shop_province` VALUES ('47', '340000', '安徽省', 'ANH');
INSERT INTO `shop_province` VALUES ('48', '350000', '福建省', 'FUJ');
INSERT INTO `shop_province` VALUES ('49', '360000', '江西省', 'JXI');
INSERT INTO `shop_province` VALUES ('50', '370000', '山东省', 'SHD');
INSERT INTO `shop_province` VALUES ('51', '410000', '河南省', 'HEN');
INSERT INTO `shop_province` VALUES ('52', '420000', '湖北省', 'HUB');
INSERT INTO `shop_province` VALUES ('53', '430000', '湖南省', 'HUN');
INSERT INTO `shop_province` VALUES ('54', '440000', '广东省', 'GUD');
INSERT INTO `shop_province` VALUES ('55', '450000', '广西壮族自治区', 'GXI');
INSERT INTO `shop_province` VALUES ('56', '460000', '海南省', 'HAI');
INSERT INTO `shop_province` VALUES ('57', '500000', '重庆市', 'CHQ');
INSERT INTO `shop_province` VALUES ('58', '510000', '四川省', 'SCH');
INSERT INTO `shop_province` VALUES ('59', '520000', '贵州省', 'GUI');
INSERT INTO `shop_province` VALUES ('60', '530000', '云南省', 'YUN');
INSERT INTO `shop_province` VALUES ('61', '540000', '西藏自治区', 'TIB');
INSERT INTO `shop_province` VALUES ('62', '610000', '陕西省', 'SHA');
INSERT INTO `shop_province` VALUES ('63', '620000', '甘肃省', 'GAN');
INSERT INTO `shop_province` VALUES ('64', '630000', '青海省', 'QIH');
INSERT INTO `shop_province` VALUES ('65', '640000', '宁夏回族自治区', 'NXA');
INSERT INTO `shop_province` VALUES ('66', '650000', '新疆维吾尔自治区', 'XIN');
INSERT INTO `shop_province` VALUES ('67', '810000', '香港特别行政区', 'HKG');
INSERT INTO `shop_province` VALUES ('68', '820000', '澳门特别行政区', 'MAC');

-- ----------------------------
-- Table structure for shop_user
-- ----------------------------
DROP TABLE IF EXISTS `shop_user`;
CREATE TABLE `shop_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(50) NOT NULL COMMENT '用户名',
  `pwd` varchar(255) NOT NULL COMMENT '密码',
  `name` varchar(50) DEFAULT NULL COMMENT '真实姓名',
  `tel` varchar(50) DEFAULT NULL COMMENT '电话',
  `department` varchar(10) DEFAULT NULL COMMENT '所属部门',
  `role` varchar(20) DEFAULT NULL COMMENT '角色',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_user
-- ----------------------------
INSERT INTO `shop_user` VALUES ('1', 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '超级管理员', '11111111111', '1', 'admin');
INSERT INTO `shop_user` VALUES ('11', 'wx', '0f7bfe6859999fd0ee6e4a7b725d466cebebec7ca75ddd7ef0f2e6d648db6d8f', 'wx', '18235440687', null, 'user');
INSERT INTO `shop_user` VALUES ('12', 'w', '6b4a1673b225e8bf5f093b91be8c864427df32ca41b17cc0b82112b8f0185e41', 'www', '18235440687', null, 'user');
INSERT INTO `shop_user` VALUES ('13', 'user', '04f8996da763b7a969b1028ee3007569eaf3a635486ddab211d512c85b9df8fb', '用户', '18595632416', null, 'user');

-- ----------------------------
-- Table structure for shop_wx_bill_record
-- ----------------------------
DROP TABLE IF EXISTS `shop_wx_bill_record`;
CREATE TABLE `shop_wx_bill_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(100) DEFAULT NULL COMMENT '微信支付编号',
  `order_sn_wx` varchar(255) DEFAULT NULL COMMENT '微信订单号',
  `create_time` varchar(100) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of shop_wx_bill_record
-- ----------------------------

-- ----------------------------
-- Table structure for upgrade_record
-- ----------------------------
DROP TABLE IF EXISTS `upgrade_record`;
CREATE TABLE `upgrade_record` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `members_id` varchar(50) DEFAULT NULL COMMENT '会员id(对应members表的id)',
  `openid` varchar(50) DEFAULT NULL,
  `order_id` varchar(20) DEFAULT NULL COMMENT '订单id',
  `before_level` varchar(1) DEFAULT NULL COMMENT '升级之前的等级',
  `up_level` varchar(1) DEFAULT NULL COMMENT '升级等级',
  `up_level_info` varchar(50) DEFAULT NULL COMMENT '升级等级名称',
  `up_price` varchar(10) DEFAULT NULL COMMENT '升级价格',
  `pay` bit(1) DEFAULT NULL COMMENT '支付状态（0未支付1已支付）',
  `create_time` varchar(25) DEFAULT NULL COMMENT '订单创建时间',
  `updatedAt` varchar(25) DEFAULT NULL COMMENT '订单支付时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of upgrade_record
-- ----------------------------
