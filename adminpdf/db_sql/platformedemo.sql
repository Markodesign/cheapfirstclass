/*
Navicat MySQL Data Transfer

Source Server         : _LIVE_platform-pos.com_platformedemo
Source Server Version : 50141
Source Host           : localhost:3306
Source Database       : platformedemo

Target Server Type    : MYSQL
Target Server Version : 50141
File Encoding         : 65001

Date: 2013-02-14 13:31:09
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `about`
-- ----------------------------
DROP TABLE IF EXISTS `about`;
CREATE TABLE `about` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state_province` varchar(255) NOT NULL,
  `zip_postal_code` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of about
-- ----------------------------

-- ----------------------------
-- Table structure for `admins`
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(255) DEFAULT NULL,
  `pass` varchar(32) DEFAULT NULL,
  `lang` enum('ua','fr','en') DEFAULT 'en',
  `access_type` enum('user','admin') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `login` (`login`,`pass`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES ('14', 'admin', '2a317f1a277d94b5e16e9e0cf794d07a', 'en', 'admin');

-- ----------------------------
-- Table structure for `categories`
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `processing` enum('No','Yes') NOT NULL DEFAULT 'Yes',
  `taxes` enum('No','Yes') NOT NULL DEFAULT 'Yes',
  `sort` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of categories
-- ----------------------------

-- ----------------------------
-- Table structure for `devices_id`
-- ----------------------------
DROP TABLE IF EXISTS `devices_id`;
CREATE TABLE `devices_id` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `device_name` varchar(255) NOT NULL,
  `device_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of devices_id
-- ----------------------------

-- ----------------------------
-- Table structure for `item_options`
-- ----------------------------
DROP TABLE IF EXISTS `item_options`;
CREATE TABLE `item_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_item` smallint(6) NOT NULL,
  `id_option` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1723 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of item_options
-- ----------------------------

-- ----------------------------
-- Table structure for `items`
-- ----------------------------
DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `status` enum('Inactive','Active') NOT NULL DEFAULT 'Active',
  `category_id` int(6) NOT NULL,
  `name` varchar(250) NOT NULL,
  `price` float(6,2) NOT NULL,
  `mandatory_options` enum('1','0') NOT NULL DEFAULT '0',
  `sort` smallint(6) NOT NULL,
  `deleted` enum('no','yes') DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=273 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of items
-- ----------------------------

-- ----------------------------
-- Table structure for `options`
-- ----------------------------
DROP TABLE IF EXISTS `options`;
CREATE TABLE `options` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `price` float(6,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=83 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of options
-- ----------------------------

-- ----------------------------
-- Table structure for `order_item_options`
-- ----------------------------
DROP TABLE IF EXISTS `order_item_options`;
CREATE TABLE `order_item_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_item_id` int(11) NOT NULL,
  `option_id` smallint(5) NOT NULL,
  `option_name` varchar(50) DEFAULT NULL,
  `option_price` float(7,2) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1080 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order_item_options
-- ----------------------------

-- ----------------------------
-- Table structure for `orders`
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `gst_total` float NOT NULL,
  `tvq_total` float NOT NULL,
  `order_total_tax_yes` float(14,2) NOT NULL,
  `order_total_tax_no` float NOT NULL,
  `total_sales_of_items_without_tax` float(14,2) NOT NULL,
  `total_sales_of_items_with_tax` float(14,2) NOT NULL,
  `master_order_total` float NOT NULL,
  `payment_type` varchar(10) NOT NULL,
  `device` enum('master','rover') NOT NULL,
  `time` datetime NOT NULL,
  `state` enum('processed','paid','created','completed','cancelled') NOT NULL,
  `number` smallint(5) unsigned NOT NULL,
  `refund` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7803 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orders
-- ----------------------------

-- ----------------------------
-- Table structure for `orders_items`
-- ----------------------------
DROP TABLE IF EXISTS `orders_items`;
CREATE TABLE `orders_items` (
  `id` int(13) NOT NULL AUTO_INCREMENT,
  `order_id` int(12) NOT NULL,
  `item_id` int(6) NOT NULL,
  `quantity` tinyint(3) unsigned NOT NULL,
  `note` varchar(100) DEFAULT NULL,
  `to_go` tinyint(3) unsigned DEFAULT NULL,
  `strikes` tinyint(3) unsigned NOT NULL,
  `item_price` float(7,2) DEFAULT NULL,
  `item_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15117 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orders_items
-- ----------------------------

-- ----------------------------
-- Table structure for `pin`
-- ----------------------------
DROP TABLE IF EXISTS `pin`;
CREATE TABLE `pin` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `pin` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pin
-- ----------------------------
INSERT INTO `pin` VALUES ('6', '0');

-- ----------------------------
-- Table structure for `reset_counter`
-- ----------------------------
DROP TABLE IF EXISTS `reset_counter`;
CREATE TABLE `reset_counter` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of reset_counter
-- ----------------------------

-- ----------------------------
-- Table structure for `settings`
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `settings` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of settings
-- ----------------------------

-- ----------------------------
-- Table structure for `shop_categories`
-- ----------------------------
DROP TABLE IF EXISTS `shop_categories`;
CREATE TABLE `shop_categories` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `image_ext` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_categories
-- ----------------------------

-- ----------------------------
-- Table structure for `shop_items`
-- ----------------------------
DROP TABLE IF EXISTS `shop_items`;
CREATE TABLE `shop_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` enum('Active','Inactive') DEFAULT 'Inactive',
  `product_name` varchar(255) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `size_weight` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image_ext` varchar(255) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_items
-- ----------------------------

-- ----------------------------
-- Table structure for `shop_items_categories`
-- ----------------------------
DROP TABLE IF EXISTS `shop_items_categories`;
CREATE TABLE `shop_items_categories` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `shop_item_id` int(11) NOT NULL,
  `categories_id` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_items_categories
-- ----------------------------

-- ----------------------------
-- Table structure for `shop_postal_code`
-- ----------------------------
DROP TABLE IF EXISTS `shop_postal_code`;
CREATE TABLE `shop_postal_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postal_code` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_postal_code
-- ----------------------------

-- ----------------------------
-- Table structure for `table_status`
-- ----------------------------
DROP TABLE IF EXISTS `table_status`;
CREATE TABLE `table_status` (
  `date` datetime NOT NULL,
  `status` varchar(255) NOT NULL,
  `id` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of table_status
-- ----------------------------

-- ----------------------------
-- Table structure for `taxes`
-- ----------------------------
DROP TABLE IF EXISTS `taxes`;
CREATE TABLE `taxes` (
  `id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `gst` float(10,5) NOT NULL,
  `tvq` float(10,5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of taxes
-- ----------------------------
INSERT INTO `taxes` VALUES ('1', '0.00000', '0.00000');
