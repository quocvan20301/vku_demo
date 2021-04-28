/*
 Navicat Premium Data Transfer

 Source Server         : Mysql_DB
 Source Server Type    : MySQL
 Source Server Version : 100417
 Source Host           : localhost:3306
 Source Schema         : demovku

 Target Server Type    : MySQL
 Target Server Version : 100417
 File Encoding         : 65001

 Date: 28/04/2021 09:21:19
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for table_trongso_lhp
-- ----------------------------
DROP TABLE IF EXISTS `table_trongso_lhp`;
CREATE TABLE `table_trongso_lhp`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_lhp` int NOT NULL,
  `id_trongso` int NOT NULL,
  `trongso` double(11, 2) NULL DEFAULT NULL,
  `trangthai` tinyint(1) NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6050 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of table_trongso_lhp
-- ----------------------------
INSERT INTO `table_trongso_lhp` VALUES (6011, 111, 1, 0.10, 0, NULL, NULL, NULL);
INSERT INTO `table_trongso_lhp` VALUES (6012, 111, 2, 0.20, 0, NULL, NULL, NULL);
INSERT INTO `table_trongso_lhp` VALUES (6013, 111, 3, 0.20, 0, NULL, NULL, NULL);
INSERT INTO `table_trongso_lhp` VALUES (6014, 111, 4, 0.50, 0, NULL, NULL, NULL);
INSERT INTO `table_trongso_lhp` VALUES (6019, 85, 1, 0.10, 0, NULL, NULL, NULL);
INSERT INTO `table_trongso_lhp` VALUES (6020, 85, 2, 0.20, 0, NULL, NULL, NULL);
INSERT INTO `table_trongso_lhp` VALUES (6021, 85, 3, 0.20, 0, NULL, NULL, NULL);
INSERT INTO `table_trongso_lhp` VALUES (6022, 85, 4, 0.50, 0, NULL, NULL, NULL);
INSERT INTO `table_trongso_lhp` VALUES (6023, 112, 2, 0.20, 0, NULL, NULL, NULL);
INSERT INTO `table_trongso_lhp` VALUES (6024, 112, 3, 0.20, 0, NULL, NULL, NULL);
INSERT INTO `table_trongso_lhp` VALUES (6025, 112, 4, 0.60, 0, NULL, NULL, NULL);
INSERT INTO `table_trongso_lhp` VALUES (6026, 91, 1, 0.10, 0, NULL, NULL, NULL);
INSERT INTO `table_trongso_lhp` VALUES (6027, 91, 2, 0.20, 0, NULL, NULL, NULL);
INSERT INTO `table_trongso_lhp` VALUES (6028, 91, 3, 0.20, 0, NULL, NULL, NULL);
INSERT INTO `table_trongso_lhp` VALUES (6029, 91, 4, 0.50, 0, NULL, NULL, NULL);
INSERT INTO `table_trongso_lhp` VALUES (6030, 114, 1, 0.10, 0, NULL, NULL, NULL);
INSERT INTO `table_trongso_lhp` VALUES (6031, 114, 2, 0.20, 0, NULL, NULL, NULL);
INSERT INTO `table_trongso_lhp` VALUES (6032, 114, 3, 0.20, 0, NULL, NULL, NULL);
INSERT INTO `table_trongso_lhp` VALUES (6033, 114, 4, 0.50, 0, NULL, NULL, NULL);
INSERT INTO `table_trongso_lhp` VALUES (6034, 47, 1, 0.10, 0, NULL, NULL, NULL);
INSERT INTO `table_trongso_lhp` VALUES (6035, 47, 2, 0.10, 0, NULL, NULL, NULL);
INSERT INTO `table_trongso_lhp` VALUES (6036, 47, 3, 0.20, 0, NULL, NULL, NULL);
INSERT INTO `table_trongso_lhp` VALUES (6037, 47, 4, 0.60, 0, NULL, NULL, NULL);
INSERT INTO `table_trongso_lhp` VALUES (6038, 21, 1, 0.10, 0, NULL, NULL, NULL);
INSERT INTO `table_trongso_lhp` VALUES (6039, 21, 2, 0.20, 0, NULL, NULL, NULL);
INSERT INTO `table_trongso_lhp` VALUES (6040, 21, 3, 0.20, 0, NULL, NULL, NULL);
INSERT INTO `table_trongso_lhp` VALUES (6041, 21, 4, 0.50, 0, NULL, NULL, NULL);
INSERT INTO `table_trongso_lhp` VALUES (6042, 19, 1, 0.10, 0, NULL, NULL, NULL);
INSERT INTO `table_trongso_lhp` VALUES (6043, 19, 2, 0.20, 0, NULL, NULL, NULL);
INSERT INTO `table_trongso_lhp` VALUES (6044, 19, 3, 0.20, 0, NULL, NULL, NULL);
INSERT INTO `table_trongso_lhp` VALUES (6045, 19, 4, 0.50, 0, NULL, NULL, NULL);
INSERT INTO `table_trongso_lhp` VALUES (6046, 51, 1, 0.10, 0, NULL, NULL, NULL);
INSERT INTO `table_trongso_lhp` VALUES (6047, 51, 2, 0.20, 0, NULL, NULL, NULL);
INSERT INTO `table_trongso_lhp` VALUES (6048, 51, 3, 0.20, 0, NULL, NULL, NULL);
INSERT INTO `table_trongso_lhp` VALUES (6049, 51, 4, 0.50, 0, NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
