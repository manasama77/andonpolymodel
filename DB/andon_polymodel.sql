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

 Date: 07/07/2020 03:16:11
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
INSERT INTO `admin` VALUES (1, 'office', '$2y$10$0HMBloLRr8tITd2UdCPVf.Pmm8hCRLhIqH1fGYQmepI/kZDtXMyaG', '1', 'rv73zQFd9JrRcno1T1hDO5ECwNecuRpoNxBIYjiSM6PZ2VUTugsbUlw4nIytL83V');
INSERT INTO `admin` VALUES (2, 'm1', '$2y$10$5hdOvhQR/LGEp5uzP31PV.HEuz6D7KeHZeEBySI0xu1KGAVghmzgq', '1', 'Cufaql5BryseZ0naoKMGek7gvLG4WyNSzoQsJEEbJ64AIS2HB9Nbtnm8QVFXPp6w');
INSERT INTO `admin` VALUES (3, 'm2', '$2y$10$hgyodvELSQh4hJsD7lOHBuULsdmLdh70z8XxzM4ycVYqUSRo2UWcm', NULL, NULL);
INSERT INTO `admin` VALUES (4, 'm3', '$2y$10$6peqdjxRkvIM2HDWdaNi4ObDQ8.RFe19.mUHVdNoJhdjjPOqMKPCq', NULL, NULL);

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
INSERT INTO `kikukawa` VALUES ('2020-07-04', 2000, 4357, 4355, 4346, 4354, 89.60);
INSERT INTO `kikukawa` VALUES ('2020-07-05', 3269, 3267, 3268, 3267, 3256, 9.56);
INSERT INTO `kikukawa` VALUES ('2020-07-06', 4108, 4109, 4099, 4099, 4107, 15.21);

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
INSERT INTO `monthly` VALUES ('2020-07-01', 11.58, 13.48, 13.48);

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
INSERT INTO `ncb3` VALUES ('2020-07-04', 3545, 3537, 3525, 3532, 3529, 6.6);
INSERT INTO `ncb3` VALUES ('2020-07-05', 3269, 3266, 3268, 3268, 3256, 9.6);
INSERT INTO `ncb3` VALUES ('2020-07-06', 4108, 4109, 4099, 4098, 4107, 15.2);

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
INSERT INTO `ncb6` VALUES ('2020-07-04', 3540, 3537, 3524, 3534, 3529, 6.6);
INSERT INTO `ncb6` VALUES ('2020-07-05', 3268, 3267, 3269, 3267, 3255, 9.6);
INSERT INTO `ncb6` VALUES ('2020-07-06', 4108, 4109, 4100, 4097, 4107, 15.2);

-- ----------------------------
-- Table structure for planning
-- ----------------------------
DROP TABLE IF EXISTS `planning`;
CREATE TABLE `planning`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NULL DEFAULT NULL,
  `time` time(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of planning
-- ----------------------------
INSERT INTO `planning` VALUES (1, '2020-07-03', '07:30:00');
INSERT INTO `planning` VALUES (2, '2020-07-04', '07:30:00');
INSERT INTO `planning` VALUES (3, '2020-07-05', '07:30:00');
INSERT INTO `planning` VALUES (4, '2020-07-06', '07:30:00');
INSERT INTO `planning` VALUES (5, '2020-07-07', '07:30:00');

SET FOREIGN_KEY_CHECKS = 1;
