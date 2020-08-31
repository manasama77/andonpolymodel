/*
 Navicat Premium Data Transfer

 Source Server         : Mysql Local
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : localhost:3306
 Source Schema         : andon_polymodel

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 01/09/2020 01:13:23
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `remember` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cookies` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES (1, 'Oasis', '$2y$10$X/5Cxy86eBNig0ik5DetHO9lRMceGSIDKGKrPTjVrQM/L6IjTTBr2', '1', '617fhtEjyZRb4MDpqM5N32Q2gIiShYf0Ha8qY0VxOxJPBC8QwZc9CvsdKvAkLFnE');
INSERT INTO `admin` VALUES (2, 'kikukawa', '$2y$10$ho3LpsPLKFLy4tXK3LV4COvC7cznO68MOCsEaJ7vy4AeBlocSlVey', NULL, NULL);
INSERT INTO `admin` VALUES (3, 'ncb3', '$2y$10$yvp1kweawuGlmy0OcIxjwOusnEXQykN6s1XDdFpWbFYFfFudTztdq', NULL, NULL);
INSERT INTO `admin` VALUES (4, 'ncb6', '$2y$10$3naEhi.C2Q/XrPxQKRtpuOkJunvFzZeKaSCx8YIeafOtgFTk0agsO', NULL, NULL);

-- ----------------------------
-- Table structure for kikukawa
-- ----------------------------
DROP TABLE IF EXISTS `kikukawa`;
CREATE TABLE `kikukawa`  (
  `date` date NOT NULL,
  `cutting` bigint(20) NOT NULL DEFAULT 0,
  `alarm` bigint(20) NOT NULL DEFAULT 0,
  `dandori` bigint(20) NOT NULL DEFAULT 0,
  `man` bigint(20) NOT NULL DEFAULT 0,
  `idle` bigint(20) NOT NULL DEFAULT 0,
  `eff` decimal(5, 2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`date`) USING BTREE,
  UNIQUE INDEX `date`(`date`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kikukawa
-- ----------------------------
INSERT INTO `kikukawa` VALUES ('2020-06-30', 0, 0, 0, 0, 0, 0.00);
INSERT INTO `kikukawa` VALUES ('2020-07-04', 2000, 4357, 4355, 4346, 4354, 89.60);
INSERT INTO `kikukawa` VALUES ('2020-07-05', 3269, 3267, 3268, 3267, 3256, 9.56);
INSERT INTO `kikukawa` VALUES ('2020-07-06', 4478, 4472, 4469, 4466, 4476, 16.59);
INSERT INTO `kikukawa` VALUES ('2020-07-07', 4525, 4528, 4527, 4526, 4524, 16.76);
INSERT INTO `kikukawa` VALUES ('2020-07-10', 559, 558, 570, 562, 566, 100.00);
INSERT INTO `kikukawa` VALUES ('2020-07-13', 4509, 4514, 4508, 4507, 4505, 16.70);
INSERT INTO `kikukawa` VALUES ('2020-08-30', 1331, 1343, 1342, 1340, 1340, 100.00);
INSERT INTO `kikukawa` VALUES ('2020-08-31', 152, 148, 148, 150, 149, 100.00);

-- ----------------------------
-- Table structure for monthly
-- ----------------------------
DROP TABLE IF EXISTS `monthly`;
CREATE TABLE `monthly`  (
  `date` date NOT NULL,
  `kikukawa` decimal(4, 2) NULL DEFAULT 0.00,
  `ncb3` decimal(4, 2) NULL DEFAULT 0.00,
  `ncb6` decimal(4, 2) NULL DEFAULT 0.00,
  PRIMARY KEY (`date`) USING BTREE,
  UNIQUE INDEX `date`(`date`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of monthly
-- ----------------------------
INSERT INTO `monthly` VALUES ('2020-06-01', 0.00, 0.00, 0.00);
INSERT INTO `monthly` VALUES ('2020-07-01', 14.33, 15.07, 14.68);
INSERT INTO `monthly` VALUES ('2020-08-01', 0.00, 0.00, 0.00);

-- ----------------------------
-- Table structure for ncb3
-- ----------------------------
DROP TABLE IF EXISTS `ncb3`;
CREATE TABLE `ncb3`  (
  `date` date NOT NULL,
  `cutting` bigint(20) NOT NULL DEFAULT 0,
  `alarm` bigint(20) NOT NULL DEFAULT 0,
  `dandori` bigint(20) NOT NULL DEFAULT 0,
  `man` bigint(20) NOT NULL DEFAULT 0,
  `idle` bigint(20) NOT NULL DEFAULT 0,
  `eff` decimal(4, 1) NOT NULL DEFAULT 0.0,
  PRIMARY KEY (`date`) USING BTREE,
  UNIQUE INDEX `date`(`date`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ncb3
-- ----------------------------
INSERT INTO `ncb3` VALUES ('2020-06-30', 0, 0, 0, 0, 0, 0.0);
INSERT INTO `ncb3` VALUES ('2020-07-04', 3545, 3537, 3525, 3532, 3529, 6.6);
INSERT INTO `ncb3` VALUES ('2020-07-05', 3269, 3266, 3268, 3268, 3256, 9.6);
INSERT INTO `ncb3` VALUES ('2020-07-06', 4478, 4471, 4469, 4465, 4476, 16.6);
INSERT INTO `ncb3` VALUES ('2020-07-07', 4525, 4528, 4528, 4525, 4524, 16.8);
INSERT INTO `ncb3` VALUES ('2020-07-10', 559, 559, 570, 562, 566, 100.0);
INSERT INTO `ncb3` VALUES ('2020-07-13', 4509, 4515, 4506, 4507, 4506, 14.7);
INSERT INTO `ncb3` VALUES ('2020-08-30', 1331, 1343, 1342, 1340, 1339, 100.0);
INSERT INTO `ncb3` VALUES ('2020-08-31', 152, 148, 148, 150, 149, 100.0);

-- ----------------------------
-- Table structure for ncb6
-- ----------------------------
DROP TABLE IF EXISTS `ncb6`;
CREATE TABLE `ncb6`  (
  `date` date NOT NULL,
  `cutting` bigint(20) NOT NULL DEFAULT 0,
  `alarm` bigint(20) NOT NULL DEFAULT 0,
  `dandori` bigint(20) NOT NULL DEFAULT 0,
  `man` bigint(20) NOT NULL DEFAULT 0,
  `idle` bigint(20) NOT NULL DEFAULT 0,
  `eff` decimal(4, 1) NOT NULL DEFAULT 0.0,
  PRIMARY KEY (`date`) USING BTREE,
  UNIQUE INDEX `date`(`date`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ncb6
-- ----------------------------
INSERT INTO `ncb6` VALUES ('2020-06-30', 0, 0, 0, 0, 0, 0.0);
INSERT INTO `ncb6` VALUES ('2020-07-04', 3540, 3537, 3524, 3534, 3529, 6.6);
INSERT INTO `ncb6` VALUES ('2020-07-05', 3268, 3267, 3269, 3267, 3255, 9.6);
INSERT INTO `ncb6` VALUES ('2020-07-06', 4478, 4471, 4470, 4464, 4476, 16.6);
INSERT INTO `ncb6` VALUES ('2020-07-07', 4525, 4527, 4528, 4524, 4524, 16.8);
INSERT INTO `ncb6` VALUES ('2020-07-10', 560, 559, 569, 562, 566, 100.0);
INSERT INTO `ncb6` VALUES ('2020-07-13', 4508, 4515, 4508, 4507, 4505, 13.2);
INSERT INTO `ncb6` VALUES ('2020-08-30', 1331, 1342, 1342, 1340, 1339, 100.0);
INSERT INTO `ncb6` VALUES ('2020-08-31', 152, 148, 148, 150, 149, 100.0);

-- ----------------------------
-- Table structure for planning_kikukawa
-- ----------------------------
DROP TABLE IF EXISTS `planning_kikukawa`;
CREATE TABLE `planning_kikukawa`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NULL DEFAULT NULL,
  `time` time(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of planning_kikukawa
-- ----------------------------
INSERT INTO `planning_kikukawa` VALUES (1, '2020-07-03', '07:30:00');
INSERT INTO `planning_kikukawa` VALUES (2, '2020-07-04', '07:30:00');
INSERT INTO `planning_kikukawa` VALUES (3, '2020-07-05', '07:30:00');
INSERT INTO `planning_kikukawa` VALUES (4, '2020-07-06', '07:30:00');
INSERT INTO `planning_kikukawa` VALUES (5, '2020-07-07', '07:30:00');
INSERT INTO `planning_kikukawa` VALUES (6, '2020-07-08', '08:30:00');
INSERT INTO `planning_kikukawa` VALUES (7, '2020-07-11', '07:30:00');
INSERT INTO `planning_kikukawa` VALUES (8, '2020-07-12', '07:30:00');
INSERT INTO `planning_kikukawa` VALUES (9, '2020-07-13', '07:30:00');
INSERT INTO `planning_kikukawa` VALUES (10, '2020-07-14', '07:30:00');
INSERT INTO `planning_kikukawa` VALUES (11, '2020-07-15', '07:30:00');
INSERT INTO `planning_kikukawa` VALUES (12, '2020-06-30', '07:30:00');
INSERT INTO `planning_kikukawa` VALUES (13, '2020-07-16', '07:30:00');

-- ----------------------------
-- Table structure for planning_ncb3
-- ----------------------------
DROP TABLE IF EXISTS `planning_ncb3`;
CREATE TABLE `planning_ncb3`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NULL DEFAULT NULL,
  `time` time(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of planning_ncb3
-- ----------------------------
INSERT INTO `planning_ncb3` VALUES (1, '2020-07-03', '07:30:00');
INSERT INTO `planning_ncb3` VALUES (2, '2020-07-04', '07:30:00');
INSERT INTO `planning_ncb3` VALUES (3, '2020-07-05', '07:30:00');
INSERT INTO `planning_ncb3` VALUES (4, '2020-07-06', '07:30:00');
INSERT INTO `planning_ncb3` VALUES (5, '2020-07-07', '07:30:00');
INSERT INTO `planning_ncb3` VALUES (6, '2020-07-08', '08:30:00');
INSERT INTO `planning_ncb3` VALUES (7, '2020-07-12', '08:30:00');
INSERT INTO `planning_ncb3` VALUES (8, '2020-07-13', '08:30:00');
INSERT INTO `planning_ncb3` VALUES (9, '2020-07-14', '08:30:00');
INSERT INTO `planning_ncb3` VALUES (10, '2020-06-30', '07:30:00');
INSERT INTO `planning_ncb3` VALUES (11, '2020-07-15', '08:30:00');
INSERT INTO `planning_ncb3` VALUES (12, '2020-07-16', '08:30:00');

-- ----------------------------
-- Table structure for planning_ncb6
-- ----------------------------
DROP TABLE IF EXISTS `planning_ncb6`;
CREATE TABLE `planning_ncb6`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NULL DEFAULT NULL,
  `time` time(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of planning_ncb6
-- ----------------------------
INSERT INTO `planning_ncb6` VALUES (1, '2020-07-03', '07:30:00');
INSERT INTO `planning_ncb6` VALUES (2, '2020-07-04', '07:30:00');
INSERT INTO `planning_ncb6` VALUES (3, '2020-07-05', '07:30:00');
INSERT INTO `planning_ncb6` VALUES (4, '2020-07-06', '07:30:00');
INSERT INTO `planning_ncb6` VALUES (5, '2020-07-07', '07:30:00');
INSERT INTO `planning_ncb6` VALUES (6, '2020-07-08', '08:30:00');
INSERT INTO `planning_ncb6` VALUES (7, '2020-07-12', '09:30:00');
INSERT INTO `planning_ncb6` VALUES (8, '2020-07-13', '09:30:00');
INSERT INTO `planning_ncb6` VALUES (9, '2020-07-14', '09:30:00');
INSERT INTO `planning_ncb6` VALUES (10, '2020-06-30', '07:30:00');
INSERT INTO `planning_ncb6` VALUES (11, '2020-07-15', '09:30:00');
INSERT INTO `planning_ncb6` VALUES (12, '2020-07-16', '09:30:00');

-- ----------------------------
-- Table structure for slide_ext
-- ----------------------------
DROP TABLE IF EXISTS `slide_ext`;
CREATE TABLE `slide_ext`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of slide_ext
-- ----------------------------
INSERT INTO `slide_ext` VALUES (3, '557ea73fabcf758c21ea2cef099a6086.jpg');
INSERT INTO `slide_ext` VALUES (4, '20e3089c57fbaec2cf3e09b9058b75d5.jpg');

SET FOREIGN_KEY_CHECKS = 1;
