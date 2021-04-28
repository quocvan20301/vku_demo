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

 Date: 28/04/2021 09:21:10
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for table_thanhphandanhgia
-- ----------------------------
DROP TABLE IF EXISTS `table_thanhphandanhgia`;
CREATE TABLE `table_thanhphandanhgia`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `ten_thanhphandanhgia` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_baidanhgia` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of table_thanhphandanhgia
-- ----------------------------
INSERT INTO `table_thanhphandanhgia` VALUES (1, 'Đánh giá quá trình', 0);
INSERT INTO `table_thanhphandanhgia` VALUES (2, 'Đánh giá bài tập', 0);
INSERT INTO `table_thanhphandanhgia` VALUES (3, 'Đánh giá giữa kì', 0);
INSERT INTO `table_thanhphandanhgia` VALUES (4, 'Đánh giá cuối kì', 0);
INSERT INTO `table_thanhphandanhgia` VALUES (5, 'Điểm danh', 1);
INSERT INTO `table_thanhphandanhgia` VALUES (6, 'Bài tập trên lớp ', 2);
INSERT INTO `table_thanhphandanhgia` VALUES (7, 'Báo cáo mô tả bài tập nhóm', 2);
INSERT INTO `table_thanhphandanhgia` VALUES (8, 'Kiểm tra giữa kì ', 3);
INSERT INTO `table_thanhphandanhgia` VALUES (9, 'Thi cuối kì', 4);
INSERT INTO `table_thanhphandanhgia` VALUES (10, 'Thực hành/Thí nghiệm', 4);

SET FOREIGN_KEY_CHECKS = 1;
