/*
Navicat MySQL Data Transfer

Source Server         : Localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : 4boot_test

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-11-26 17:39:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for approvals
-- ----------------------------
DROP TABLE IF EXISTS `approvals`;
CREATE TABLE `approvals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `company_id` int(10) unsigned NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `approvals_user_id_foreign` (`user_id`),
  KEY `approvals_company_id_foreign` (`company_id`),
  CONSTRAINT `approvals_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  CONSTRAINT `approvals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of approvals
-- ----------------------------
INSERT INTO `approvals` VALUES ('1', '1', '2', '1', '2018-09-06 22:58:22', '2018-09-06 22:58:22');
INSERT INTO `approvals` VALUES ('2', '1', '1', '1', '2018-09-19 01:57:13', '2018-09-19 01:57:13');

-- ----------------------------
-- Table structure for clients
-- ----------------------------
DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `company_id` int(10) unsigned NOT NULL,
  `textpassword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clients_company_id_foreign` (`company_id`),
  CONSTRAINT `clients_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of clients
-- ----------------------------
INSERT INTO `clients` VALUES ('1', 'c81e728d9d4c2f636f067f89cc14862c', '$2y$12$01RXJwZ.z3Bjoi4UqcxRp.9TuU022Vu2Ph9l54KOKCFsrm3ZMLPda', 'VdGVUPqLKXi2MzDlrZGI3D6J8iOD5EZCqUO4jSJ4856K9ypV3GgFa6bbMsDo', null, '2018-09-06 18:46:19', '2018-09-06 18:46:19', '2', null);
INSERT INTO `clients` VALUES ('4', 'c81e728d9d4c2f636f067f89cc14862c', '$2y$10$NlpLwSbBvolzQJRPDMmmKuFOdidxqp9YprlCWUdhF.RL4iQR/XlNC', null, null, '2018-09-06 23:35:39', '2018-09-06 23:35:39', '2', '$2y$10$z1vKaxzo7dmgp1tXWg4viO7UZfxvnOCBsfsAp9pCfoAo7iF1WlB92');
INSERT INTO `clients` VALUES ('10', 'c4ca4238a0b923820dcc509a6f75849b', '$2y$10$frZGDNs35qHe.AzLKCYkHu.XW/xDzR.6nIC4i03wMOaJkYUPP8DnS', 'HWM9nvU1qD8koldSTmbMKWLD7bE4No5XfPzPjH8mWDdf8rkoeNA3yakmA5N5', null, '2018-09-13 23:39:35', '2018-09-13 23:39:35', '1', '$2y$10$frZGDNs35qHe.AzLKCYkHu.XW/xDzR.6nIC4i03wMOaJkYUPP8DnS');
INSERT INTO `clients` VALUES ('13', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '$2y$10$gDhOHuDw0GQ22tXbWeIxT.yBvXKvtQ33nbKmPldlNAtCQxhA/zroG', '', null, '2018-09-27 23:00:17', '2018-09-27 23:00:17', '3', '$2y$10$gDhOHuDw0GQ22tXbWeIxT.yBvXKvtQ33nbKmPldlNAtCQxhA/zroG');
INSERT INTO `clients` VALUES ('14', '6566', 'sdfgfdsa', null, '2018-10-17 00:27:22', '2018-01-05 19:33:58', '2018-10-17 00:27:22', '3', null);

-- ----------------------------
-- Table structure for companies
-- ----------------------------
DROP TABLE IF EXISTS `companies`;
CREATE TABLE `companies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identity` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catalogo_path` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_type_id` int(10) unsigned NOT NULL,
  `status` enum('ESPERA','EN-PROCESO','APROBADA','RECHAZADA') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ESPERA',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `companies_company_type_id_foreign` (`company_type_id`),
  CONSTRAINT `companies_company_type_id_foreign` FOREIGN KEY (`company_type_id`) REFERENCES `company_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of companies
-- ----------------------------
INSERT INTO `companies` VALUES ('1', 'ghdfdj', '54654654', 'fkffjkfhkf', '45645', 'edwar004.eg@gmail.com', 'public/companies/ecb5Xw0f94tdLRWROnxsXjkj6xIG42JH29DikbIr.pdf', '2', 'EN-PROCESO', null, '2018-09-03 23:56:37', '2018-09-27 00:44:52');
INSERT INTO `companies` VALUES ('2', 'SupPlus', '21586353', 'ahgsjgskj', '04124548844', 'plusplus@gmail.com', 'public/companies/THI2o0TboUBntlXZqay0xSMATZvM2WPoOG8uUrL4.pdf', '2', 'EN-PROCESO', null, '2018-09-06 18:28:25', '2018-09-27 00:30:14');
INSERT INTO `companies` VALUES ('3', 'Factory', '54654654', 'Guacara', '04267479556', 'teeest@gmail.com', 'public/companies/a6FLxbfmSbBJi9jwWp1328iag07xLSybkMBnl73O.pdf', '4', 'APROBADA', '2018-10-17 00:27:22', '2018-09-27 22:49:25', '2018-10-17 00:27:22');
INSERT INTO `companies` VALUES ('6', 'jkkljl', '5456465', 'akjslksjls', '21321321', 'kkjalkaj@gmail.com', 'public/companies/3GdEUoiuv39w6VYhOhDMKF5WMl2R4UNsGxam7dXg.pdf', '3', 'ESPERA', null, '2018-09-30 02:25:40', '2018-09-30 02:25:40');

-- ----------------------------
-- Table structure for company_types
-- ----------------------------
DROP TABLE IF EXISTS `company_types`;
CREATE TABLE `company_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `company_types_type_deleted_at_unique` (`type`,`deleted_at`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of company_types
-- ----------------------------
INSERT INTO `company_types` VALUES ('1', 'Vigilancia', null, null, '2018-09-19 02:43:57');
INSERT INTO `company_types` VALUES ('2', 'Mantenimiento tipo B', null, null, '2018-09-24 22:04:25');
INSERT INTO `company_types` VALUES ('3', 'Transporte', null, null, '2018-09-06 18:54:41');
INSERT INTO `company_types` VALUES ('4', 'Limpieza', null, null, '2018-09-06 18:54:07');
INSERT INTO `company_types` VALUES ('5', 'Mantenimiento tipo A', null, '2018-09-06 18:55:08', '2018-09-06 18:55:08');
INSERT INTO `company_types` VALUES ('6', 'Mantenimiento tipo C', null, '2018-09-06 18:56:12', '2018-09-06 18:56:12');
INSERT INTO `company_types` VALUES ('7', 'Proveedores', null, '2018-09-06 18:57:27', '2018-09-06 18:57:27');

-- ----------------------------
-- Table structure for company_type_requeriment
-- ----------------------------
DROP TABLE IF EXISTS `company_type_requeriment`;
CREATE TABLE `company_type_requeriment` (
  `requeriment_id` int(10) unsigned NOT NULL,
  `company_type_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`requeriment_id`,`company_type_id`),
  KEY `company_type_requeriment_company_type_id_foreign` (`company_type_id`),
  CONSTRAINT `company_type_requeriment_company_type_id_foreign` FOREIGN KEY (`company_type_id`) REFERENCES `company_types` (`id`),
  CONSTRAINT `company_type_requeriment_requeriment_id_foreign` FOREIGN KEY (`requeriment_id`) REFERENCES `requeriments` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of company_type_requeriment
-- ----------------------------
INSERT INTO `company_type_requeriment` VALUES ('1', '1');
INSERT INTO `company_type_requeriment` VALUES ('1', '2');
INSERT INTO `company_type_requeriment` VALUES ('1', '3');
INSERT INTO `company_type_requeriment` VALUES ('1', '4');
INSERT INTO `company_type_requeriment` VALUES ('1', '5');
INSERT INTO `company_type_requeriment` VALUES ('1', '6');
INSERT INTO `company_type_requeriment` VALUES ('2', '2');
INSERT INTO `company_type_requeriment` VALUES ('2', '3');
INSERT INTO `company_type_requeriment` VALUES ('2', '4');
INSERT INTO `company_type_requeriment` VALUES ('2', '5');
INSERT INTO `company_type_requeriment` VALUES ('2', '6');
INSERT INTO `company_type_requeriment` VALUES ('3', '1');
INSERT INTO `company_type_requeriment` VALUES ('3', '2');
INSERT INTO `company_type_requeriment` VALUES ('3', '3');
INSERT INTO `company_type_requeriment` VALUES ('3', '4');
INSERT INTO `company_type_requeriment` VALUES ('3', '5');
INSERT INTO `company_type_requeriment` VALUES ('3', '6');
INSERT INTO `company_type_requeriment` VALUES ('3', '7');
INSERT INTO `company_type_requeriment` VALUES ('4', '1');
INSERT INTO `company_type_requeriment` VALUES ('4', '2');
INSERT INTO `company_type_requeriment` VALUES ('4', '3');
INSERT INTO `company_type_requeriment` VALUES ('4', '4');
INSERT INTO `company_type_requeriment` VALUES ('4', '5');
INSERT INTO `company_type_requeriment` VALUES ('4', '6');
INSERT INTO `company_type_requeriment` VALUES ('4', '7');
INSERT INTO `company_type_requeriment` VALUES ('5', '1');
INSERT INTO `company_type_requeriment` VALUES ('5', '2');
INSERT INTO `company_type_requeriment` VALUES ('5', '3');
INSERT INTO `company_type_requeriment` VALUES ('5', '4');
INSERT INTO `company_type_requeriment` VALUES ('5', '5');
INSERT INTO `company_type_requeriment` VALUES ('6', '1');
INSERT INTO `company_type_requeriment` VALUES ('6', '2');
INSERT INTO `company_type_requeriment` VALUES ('6', '3');
INSERT INTO `company_type_requeriment` VALUES ('6', '4');
INSERT INTO `company_type_requeriment` VALUES ('6', '5');
INSERT INTO `company_type_requeriment` VALUES ('7', '1');
INSERT INTO `company_type_requeriment` VALUES ('7', '2');
INSERT INTO `company_type_requeriment` VALUES ('7', '3');
INSERT INTO `company_type_requeriment` VALUES ('7', '4');
INSERT INTO `company_type_requeriment` VALUES ('7', '5');
INSERT INTO `company_type_requeriment` VALUES ('7', '6');

-- ----------------------------
-- Table structure for configurations
-- ----------------------------
DROP TABLE IF EXISTS `configurations`;
CREATE TABLE `configurations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aprobation_count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of configurations
-- ----------------------------

-- ----------------------------
-- Table structure for customer_companies
-- ----------------------------
DROP TABLE IF EXISTS `customer_companies`;
CREATE TABLE `customer_companies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_companies_company_id_foreign` (`company_id`),
  CONSTRAINT `customer_companies_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of customer_companies
-- ----------------------------
INSERT INTO `customer_companies` VALUES ('1', 'hdhdf', '56465', '1', '2018-09-03 23:56:38', '2018-09-03 23:56:38');
INSERT INTO `customer_companies` VALUES ('2', 'Luis', 'luis@gmail.com', '2', '2018-09-06 18:28:26', '2018-09-06 18:28:26');
INSERT INTO `customer_companies` VALUES ('4', 'hgjhgj', 'asslskj@gmail.com', '6', '2018-09-30 02:25:40', '2018-09-30 02:25:40');

-- ----------------------------
-- Table structure for dates
-- ----------------------------
DROP TABLE IF EXISTS `dates`;
CREATE TABLE `dates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_by` int(11) NOT NULL,
  `company` int(11) NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attendant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attendant_mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attendant_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of dates
-- ----------------------------
INSERT INTO `dates` VALUES ('1', '1', '1', '2018-10-12', '024454', 'pedrito@gmail.com', '024', '2018-09-27 00:37:49', '2018-09-30 00:09:22', null);
INSERT INTO `dates` VALUES ('2', '1', '1', '2018-10-12', 'Pedrito', 'pedrito@gmail.com', '024', '2018-09-27 00:41:12', '2018-09-27 00:41:12', null);
INSERT INTO `dates` VALUES ('3', '1', '1', '2018-10-12', 'Pedrito', 'pedrito@gmail.com', '024', '2018-09-27 00:42:06', '2018-09-27 00:42:06', null);
INSERT INTO `dates` VALUES ('4', '1', '1', '2018-10-12', 'Pedrito', 'pedrito@gmail.com', '024', '2018-09-27 00:42:32', '2018-09-27 00:42:32', null);
INSERT INTO `dates` VALUES ('5', '1', '1', '2018-10-12', 'Mariscooooo', 'mariscoo@gmail.commm', '0426747955666', '2018-09-27 00:48:53', '2018-09-30 00:18:19', null);
INSERT INTO `dates` VALUES ('6', '1', '3', '2018-10-05', 'Juan Perez', 'juanperez@gmail.com', '04267479556', '2018-09-27 23:07:13', '2018-09-29 23:03:35', null);

-- ----------------------------
-- Table structure for documents
-- ----------------------------
DROP TABLE IF EXISTS `documents`;
CREATE TABLE `documents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_type_id` int(10) unsigned NOT NULL,
  `status` enum('PENDIENTE','ACEPTADO','RECHAZADO') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDIENTE',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `owner_id` int(10) unsigned NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requeriment_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `documents_document_type_id_foreign` (`document_type_id`),
  KEY `documents_owner_id_foreign` (`owner_id`),
  KEY `documents_requeriment_id_foreign` (`requeriment_id`),
  CONSTRAINT `documents_document_type_id_foreign` FOREIGN KEY (`document_type_id`) REFERENCES `document_types` (`id`),
  CONSTRAINT `documents_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `documents_requeriment_id_foreign` FOREIGN KEY (`requeriment_id`) REFERENCES `requeriments` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of documents
-- ----------------------------
INSERT INTO `documents` VALUES ('1', 'asd.pdf', '1', 'ACEPTADO', null, '2018-09-06 19:23:25', '2018-09-08 17:19:00', '1', 'storage/companies/IBVY8lugyqNRpD8D6vlD4FX3pmMUrYxZGW1kfNT9.pdf', '1');
INSERT INTO `documents` VALUES ('2', 'asd.pdf', '1', 'RECHAZADO', null, '2018-09-06 19:23:43', '2018-09-08 17:58:45', '1', 'storage/companies/dBzTFal3ofslDpWiuR6c2G2L8NXAofbp9C7O4u9i.pdf', '2');
INSERT INTO `documents` VALUES ('3', 'planilla del rif.pdf', '1', 'ACEPTADO', null, '2018-09-06 19:42:00', '2018-09-08 20:46:48', '1', 'storage/companies/pHLgk318P6IjJHuMKGbI2dMoL8NDWvcqtaA2OUB5.pdf', '1');
INSERT INTO `documents` VALUES ('4', 'planilla del rif2.pdf', '1', 'ACEPTADO', null, '2018-09-06 22:03:35', '2018-09-08 17:19:00', '1', 'storage/companies/o2QQFZJ8T7yUvAxJLyb1dLQqE5rfmYcuUsj2vRYa.pdf', '1');
INSERT INTO `documents` VALUES ('5', 'asd.pdf', '1', 'PENDIENTE', null, '2018-09-06 22:23:05', '2018-09-06 22:23:05', '1', 'storage/companies/zsvaPtsFxOkOY2vhXlWQIN5SMziyxSyAjZ947WwO.pdf', '7');
INSERT INTO `documents` VALUES ('6', 'planilla del rif2.pdf', '1', 'PENDIENTE', '2018-10-17 00:27:22', '2018-09-08 20:38:53', '2018-10-17 00:27:22', '14', 'storage/companies/2y8ieFB74kGGeh4cUSzj0h5Za4ei5x5K66HAxfEp.pdf', '4');
INSERT INTO `documents` VALUES ('7', 'asd.pdf', '1', 'RECHAZADO', null, '2018-09-11 00:58:46', '2018-09-11 00:59:11', '1', 'storage/companies/vxsrXkY7ukSmPDFIc2z3Da9wuyMYXQLf9SDDKTua.pdf', '5');
INSERT INTO `documents` VALUES ('8', 'planilla del rif2.pdf', '1', 'RECHAZADO', null, '2018-09-18 02:01:58', '2018-09-19 01:54:56', '10', 'storage/companies/Rq1oJXqIpvPAAG0Ck674r40k1ZA0X20P2sO7rEaA.pdf', '2');
INSERT INTO `documents` VALUES ('9', 'asd.pdf', '1', 'ACEPTADO', null, '2018-09-19 01:47:54', '2018-09-19 01:54:23', '10', 'storage/companies/5fY30tTSx0pv9mYdlqoLhtHambCbNQ8v0gUbSiUJ.pdf', '3');
INSERT INTO `documents` VALUES ('10', 'planilla del rif2.pdf', '1', 'ACEPTADO', null, '2018-09-27 23:01:37', '2018-09-27 23:02:37', '13', 'storage/companies/nRDDmJqwlnmB7LII8M1bpAcXX1PCa6PutNrZCeJx.pdf', '3');
INSERT INTO `documents` VALUES ('11', 'asd.pdf', '1', 'RECHAZADO', null, '2018-09-27 23:01:57', '2018-09-27 23:03:37', '13', 'storage/companies/NaATXPB1f70ClTTQ5Er0KkFusRwPWuWihSaohvx8.pdf', '7');

-- ----------------------------
-- Table structure for document_types
-- ----------------------------
DROP TABLE IF EXISTS `document_types`;
CREATE TABLE `document_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `document_types_type_deleted_at_unique` (`type`,`deleted_at`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of document_types
-- ----------------------------
INSERT INTO `document_types` VALUES ('1', 'Incidencia1', '2018-09-06 18:38:02', '2018-09-06 18:35:55', '2018-09-06 18:38:02');
INSERT INTO `document_types` VALUES ('2', 'Incidencia123', '2018-09-06 18:37:59', '2018-09-06 18:37:46', '2018-09-06 18:37:59');
INSERT INTO `document_types` VALUES ('3', 'asda', null, '2018-09-06 19:10:46', '2018-09-06 19:10:46');

-- ----------------------------
-- Table structure for incidences
-- ----------------------------
DROP TABLE IF EXISTS `incidences`;
CREATE TABLE `incidences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `incidence_type_id` int(10) unsigned NOT NULL,
  `document_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `incidences_incidence_type_id_foreign` (`incidence_type_id`),
  KEY `incidences_document_id_foreign` (`document_id`),
  KEY `incidences_user_id_foreign` (`user_id`),
  CONSTRAINT `incidences_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`),
  CONSTRAINT `incidences_incidence_type_id_foreign` FOREIGN KEY (`incidence_type_id`) REFERENCES `incidence_types` (`id`),
  CONSTRAINT `incidences_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of incidences
-- ----------------------------
INSERT INTO `incidences` VALUES ('1', 'Error de visualización', '1', '1', '1', null, null, null);
INSERT INTO `incidences` VALUES ('3', 'Marico no se ve', '1', '5', '1', null, '2018-09-08 18:29:44', '2018-09-08 18:29:44');
INSERT INTO `incidences` VALUES ('4', 'Este se ve un pelo mal', '1', '1', '1', null, '2018-09-09 21:45:46', '2018-09-09 21:45:46');
INSERT INTO `incidences` VALUES ('8', 'Ahi va mas o menos', '2', '5', '1', null, '2018-09-09 22:03:14', '2018-09-09 22:03:14');
INSERT INTO `incidences` VALUES ('9', 'No se ve', '1', '9', '1', null, '2018-09-19 01:51:15', '2018-09-19 01:51:15');
INSERT INTO `incidences` VALUES ('10', 'No se ve bien', '3', '11', '1', null, '2018-09-27 23:03:27', '2018-09-27 23:03:27');

-- ----------------------------
-- Table structure for incidence_types
-- ----------------------------
DROP TABLE IF EXISTS `incidence_types`;
CREATE TABLE `incidence_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `incidence_types_type_deleted_at_unique` (`type`,`deleted_at`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of incidence_types
-- ----------------------------
INSERT INTO `incidence_types` VALUES ('1', 'Error', null, null, null);
INSERT INTO `incidence_types` VALUES ('2', 'Incidencia11', null, '2018-09-09 21:58:57', '2018-09-09 21:58:57');
INSERT INTO `incidence_types` VALUES ('3', 'Visualización', null, '2018-09-19 02:16:56', '2018-09-19 02:16:56');
INSERT INTO `incidence_types` VALUES ('4', 'Visualización', null, '2018-09-19 02:16:57', '2018-09-19 02:16:57');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2016_06_01_000001_create_oauth_auth_codes_table', '1');
INSERT INTO `migrations` VALUES ('4', '2016_06_01_000002_create_oauth_access_tokens_table', '1');
INSERT INTO `migrations` VALUES ('5', '2016_06_01_000003_create_oauth_refresh_tokens_table', '1');
INSERT INTO `migrations` VALUES ('6', '2016_06_01_000004_create_oauth_clients_table', '1');
INSERT INTO `migrations` VALUES ('7', '2016_06_01_000005_create_oauth_personal_access_clients_table', '1');
INSERT INTO `migrations` VALUES ('8', '2018_06_23_123458_create_operations_table', '1');
INSERT INTO `migrations` VALUES ('9', '2018_06_23_123513_create_roles_table', '1');
INSERT INTO `migrations` VALUES ('10', '2018_06_23_123541_create_operation_role_table', '1');
INSERT INTO `migrations` VALUES ('11', '2018_06_23_123613_add_role_to_user', '1');
INSERT INTO `migrations` VALUES ('12', '2018_06_23_135329_create_document_types_table', '1');
INSERT INTO `migrations` VALUES ('13', '2018_06_23_135334_create_documents_table', '1');
INSERT INTO `migrations` VALUES ('14', '2018_06_23_135414_create_clients_table', '1');
INSERT INTO `migrations` VALUES ('15', '2018_06_23_135515_add_client_to_document', '1');
INSERT INTO `migrations` VALUES ('16', '2018_06_23_135941_create_questions_table', '1');
INSERT INTO `migrations` VALUES ('17', '2018_06_23_140005_create_replies_table', '1');
INSERT INTO `migrations` VALUES ('18', '2018_06_23_145917_create_configurations_table', '1');
INSERT INTO `migrations` VALUES ('19', '2018_06_23_150004_create_company_types_table', '1');
INSERT INTO `migrations` VALUES ('20', '2018_06_23_150009_create_companies_table', '1');
INSERT INTO `migrations` VALUES ('21', '2018_06_23_150020_create_people_table', '1');
INSERT INTO `migrations` VALUES ('22', '2018_06_23_150128_create_customer_companies_table', '1');
INSERT INTO `migrations` VALUES ('23', '2018_06_23_154333_create_requeriment_types_table', '1');
INSERT INTO `migrations` VALUES ('24', '2018_06_23_154349_create_requeriments_table', '1');
INSERT INTO `migrations` VALUES ('25', '2018_06_23_154406_create_type_company_requeriments_table', '1');
INSERT INTO `migrations` VALUES ('26', '2018_06_23_155603_create_incidence_types_table', '1');
INSERT INTO `migrations` VALUES ('27', '2018_06_23_160210_create_requeriment_companies_table', '1');
INSERT INTO `migrations` VALUES ('28', '2018_06_23_165341_add_company_to_client', '1');
INSERT INTO `migrations` VALUES ('29', '2018_06_23_165633_create_incidences_table', '1');
INSERT INTO `migrations` VALUES ('30', '2018_06_23_170259_create_reviews_table', '1');
INSERT INTO `migrations` VALUES ('31', '2018_07_21_001512_add_file_path_to_document', '1');
INSERT INTO `migrations` VALUES ('32', '2018_07_21_012453_add_requeriment_id_to_document', '1');
INSERT INTO `migrations` VALUES ('33', '2018_07_30_023745_remove_requeriment_company_to_incidence', '1');
INSERT INTO `migrations` VALUES ('34', '2018_08_13_033401_create_approvals_table', '1');
INSERT INTO `migrations` VALUES ('35', '2018_08_27_032326_add_text_password_to_client', '2');
INSERT INTO `migrations` VALUES ('36', '2018_09_17_230550_add_charge_field', '3');
INSERT INTO `migrations` VALUES ('37', '2018_09_25_012206_create_dates_table', '4');

-- ----------------------------
-- Table structure for oauth_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of oauth_access_tokens
-- ----------------------------
INSERT INTO `oauth_access_tokens` VALUES ('0ac7640d9a48ed39e9d4d12617b81f73700cbbac07ad7dc8a5bcd6778c9c63f05750e74050d3306d', '3', '5', '4boot', '[]', '0', '2018-09-24 21:59:41', '2018-09-24 21:59:41', '2019-09-24 21:59:41');
INSERT INTO `oauth_access_tokens` VALUES ('0e6c2732735e864a48a79b2d5acec48755b4e6d69303f168004ceccd29e265a2326d383968b4136f', '3', '5', '4boot', '[]', '1', '2018-09-24 21:59:41', '2018-09-24 21:59:41', '2019-09-24 21:59:41');
INSERT INTO `oauth_access_tokens` VALUES ('18b2add36ab774f3f7fbde510f5e411418a29e9caa1eec4e854f51f760b261fddf200c012dd858c6', '1', '5', '4boot', '[]', '0', '2018-09-24 22:03:39', '2018-09-24 22:03:39', '2019-09-24 22:03:39');
INSERT INTO `oauth_access_tokens` VALUES ('1e3ee2b741ee1201b204be1273bff64c4c263aab30265aba735f54f83c6f8c881b1a24f145ca45f4', '1', '5', '4boot', '[]', '1', '2018-09-30 02:32:30', '2018-09-30 02:32:30', '2019-09-30 02:32:30');
INSERT INTO `oauth_access_tokens` VALUES ('1f950583251a0e7335091b7852838b0f7f2074d05baef782024f990b7eb9f1db4e82039926cbc779', '1', '3', '4boot', '[]', '1', '2018-09-13 23:49:41', '2018-09-13 23:49:41', '2019-09-13 23:49:41');
INSERT INTO `oauth_access_tokens` VALUES ('32c9aabdf329a14b4c4b2e65e901e5ff7712fbefee09293c68093ca3f22d8707db6536afba21fdf4', '2', '5', '4boot', '[]', '1', '2018-09-30 02:29:30', '2018-09-30 02:29:30', '2019-09-30 02:29:30');
INSERT INTO `oauth_access_tokens` VALUES ('4920d42fb0cac6a199d88867d74f6b7d203fa4aab930a77dd183d9b6c8915daba68850b3e08d125e', '3', '5', '4boot', '[]', '0', '2018-09-24 21:59:41', '2018-09-24 21:59:41', '2019-09-24 21:59:41');
INSERT INTO `oauth_access_tokens` VALUES ('4a5d26e86ff09072e643e9e3452f6a4e2cdf3316d0560f53a25eb44c08f15c0bd66afcab82976488', '2', '5', '4boot', '[]', '0', '2018-11-19 22:09:00', '2018-11-19 22:09:00', '2019-11-19 22:09:00');
INSERT INTO `oauth_access_tokens` VALUES ('8b5230b8709d13808536826ff5b0ea069ef0d8521d72e44d09a75e39b92b02b8025939d018a6eff6', '3', '5', '4boot', '[]', '1', '2018-09-30 02:31:22', '2018-09-30 02:31:22', '2019-09-30 02:31:22');
INSERT INTO `oauth_access_tokens` VALUES ('8bdd9f15682dda62e8913d625b5ab3afa555a0c74c012247a8add4021e8ab56e50246d5b80e88230', '2', '5', '4boot', '[]', '0', '2018-11-19 22:09:00', '2018-11-19 22:09:00', '2019-11-19 22:09:00');
INSERT INTO `oauth_access_tokens` VALUES ('8dc00e4c166799e33106f464571569bddbe0fb172bb21d56add9546925cb3f2988127f9d1793007a', '1', '5', '4boot', '[]', '0', '2018-09-20 23:22:24', '2018-09-20 23:22:24', '2019-09-20 23:22:24');
INSERT INTO `oauth_access_tokens` VALUES ('8df5f5973cf371e239a42d7e8c3b7b5e9e0db1a26296c25149a21d1c86fb897622043627dd0c5b5b', '4', '3', '4boot', '[]', '1', '2018-09-19 02:06:12', '2018-09-19 02:06:12', '2019-09-19 02:06:12');
INSERT INTO `oauth_access_tokens` VALUES ('aca6a6e647de3efce928d901c0a7a81930d6f7722ced049c0d75ea8b47712a106e5058b458235880', '1', '5', '4boot', '[]', '1', '2018-09-30 02:28:05', '2018-09-30 02:28:05', '2019-09-30 02:28:05');
INSERT INTO `oauth_access_tokens` VALUES ('b23e6ed7a777b6f4f1478bad2e5dff1cc6da16b6f62b0974df796b404f2de3d4617e7f74a3611864', '1', '5', '4boot', '[]', '0', '2018-11-19 22:10:51', '2018-11-19 22:10:51', '2019-11-19 22:10:51');
INSERT INTO `oauth_access_tokens` VALUES ('b3896e4dd099c809156f02982edb22ed0c849ae56bee548d13f8f53395d86e2f4a93e4fa74552aa2', '2', '5', '4boot', '[]', '0', '2018-09-30 02:31:36', '2018-09-30 02:31:36', '2019-09-30 02:31:36');
INSERT INTO `oauth_access_tokens` VALUES ('b4a6a6a41793be81e7441569d6bd8ca519ffff88def8e440d014be0e3fa38825ba010d4bf267bc81', '1', '3', '4boot', '[]', '1', '2018-09-06 18:07:16', '2018-09-06 18:07:16', '2019-09-06 18:07:16');
INSERT INTO `oauth_access_tokens` VALUES ('b9aef60c6f1fd7f31b57afd0c7790730f856c86dd8e549d996b0b810374489dfd8fd2c8418777770', '1', '5', '4boot', '[]', '1', '2018-09-24 22:03:47', '2018-09-24 22:03:47', '2019-09-24 22:03:47');
INSERT INTO `oauth_access_tokens` VALUES ('d042ae70f312cdcd86a8d4bf82db434c9ddd3e14795c9df6423fc79af57bcffc75a7ecf1f427e937', '1', '5', '4boot', '[]', '1', '2018-09-24 20:52:55', '2018-09-24 20:52:55', '2019-09-24 20:52:55');
INSERT INTO `oauth_access_tokens` VALUES ('dbadeb13e8e85069ae8701ace8fadf832f3410cda3cbc75e17713e5dc43c7b078e75066b0ad71379', '1', '3', '4boot', '[]', '1', '2018-09-03 23:05:02', '2018-09-03 23:05:02', '2019-09-03 23:05:02');
INSERT INTO `oauth_access_tokens` VALUES ('f2139ef31a6cc7dbffda6392809e7c37114614ebcf56ef393c44b7ad32559e83a0172d6adad61f28', '1', '5', '4boot', '[]', '0', '2018-11-19 22:11:04', '2018-11-19 22:11:04', '2019-11-19 22:11:04');
INSERT INTO `oauth_access_tokens` VALUES ('f446b3a96af5639b793930c38fe358c8d22318165f339df839f77f40331208d2cd55ade716f4d38d', '3', '5', '4boot', '[]', '1', '2018-09-30 02:32:18', '2018-09-30 02:32:18', '2019-09-30 02:32:18');

-- ----------------------------
-- Table structure for oauth_auth_codes
-- ----------------------------
DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of oauth_auth_codes
-- ----------------------------

-- ----------------------------
-- Table structure for oauth_clients
-- ----------------------------
DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE `oauth_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of oauth_clients
-- ----------------------------
INSERT INTO `oauth_clients` VALUES ('1', null, 'Laravel Personal Access Client', 'y9PnfYURMiLhdg18AP89e4TcPQt3hOpnw160tE4s', 'http://localhost', '1', '0', '0', '2018-09-03 23:04:31', '2018-09-03 23:04:31');
INSERT INTO `oauth_clients` VALUES ('2', null, 'Laravel Password Grant Client', 'm62upfBhszYF89yo9tYtK7pfMW0VboTG7JaPJNO5', 'http://localhost', '0', '1', '0', '2018-09-03 23:04:32', '2018-09-03 23:04:32');
INSERT INTO `oauth_clients` VALUES ('3', null, 'Laravel Personal Access Client', 'HcLXEG49EDogkCxCtmKP9IAAocSHPjua8GjBXtQ3', 'http://localhost', '1', '0', '0', '2018-09-03 23:04:50', '2018-09-03 23:04:50');
INSERT INTO `oauth_clients` VALUES ('4', null, 'Laravel Password Grant Client', '1E7GlvhqLwivKPU7F1ocxn49s6ErFRdPlWKdyoAS', 'http://localhost', '0', '1', '0', '2018-09-03 23:04:50', '2018-09-03 23:04:50');
INSERT INTO `oauth_clients` VALUES ('5', null, 'Laravel Personal Access Client', 'ndZSh5pQ4eVqERoD9J3Z9Iwqai1JMHiUsvUBSs1z', 'http://localhost', '1', '0', '0', '2018-09-20 23:19:33', '2018-09-20 23:19:33');
INSERT INTO `oauth_clients` VALUES ('6', null, 'Laravel Password Grant Client', 'pF8WeWELzRiQdCphYOaXliQlvz1tkbSexsRRQ2zq', 'http://localhost', '0', '1', '0', '2018-09-20 23:19:34', '2018-09-20 23:19:34');

-- ----------------------------
-- Table structure for oauth_personal_access_clients
-- ----------------------------
DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of oauth_personal_access_clients
-- ----------------------------
INSERT INTO `oauth_personal_access_clients` VALUES ('1', '1', '2018-09-03 23:04:32', '2018-09-03 23:04:32');
INSERT INTO `oauth_personal_access_clients` VALUES ('2', '3', '2018-09-03 23:04:50', '2018-09-03 23:04:50');
INSERT INTO `oauth_personal_access_clients` VALUES ('3', '5', '2018-09-20 23:19:34', '2018-09-20 23:19:34');

-- ----------------------------
-- Table structure for oauth_refresh_tokens
-- ----------------------------
DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of oauth_refresh_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for operations
-- ----------------------------
DROP TABLE IF EXISTS `operations`;
CREATE TABLE `operations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `operation` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `operations_operation_group_unique` (`operation`,`group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of operations
-- ----------------------------

-- ----------------------------
-- Table structure for operation_role
-- ----------------------------
DROP TABLE IF EXISTS `operation_role`;
CREATE TABLE `operation_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `operation_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `operation_role_operation_id_foreign` (`operation_id`),
  KEY `operation_role_role_id_foreign` (`role_id`),
  CONSTRAINT `operation_role_operation_id_foreign` FOREIGN KEY (`operation_id`) REFERENCES `operations` (`id`),
  CONSTRAINT `operation_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of operation_role
-- ----------------------------

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for people
-- ----------------------------
DROP TABLE IF EXISTS `people`;
CREATE TABLE `people` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `people_company_id_foreign` (`company_id`),
  CONSTRAINT `people_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of people
-- ----------------------------
INSERT INTO `people` VALUES ('1', 'gdhjd', 'fdf', 'dsds', 'sa', '1', '2018-09-03 23:56:38', '2018-09-03 23:56:38');
INSERT INTO `people` VALUES ('2', 'Pedro', 'Perezp@gmail.co,', '456465465465', 'CEO', '2', '2018-09-06 18:28:25', '2018-09-06 18:28:25');
INSERT INTO `people` VALUES ('3', 'Pedro', 'pedrito@gmail.com', '04267479556', 'CEO', '3', '2018-09-27 22:49:25', '2018-09-27 22:49:25');
INSERT INTO `people` VALUES ('6', 'skjldñj', 'sklsjlñsk@gmail.com', '231321321', 'ajhkaj', '6', '2018-09-30 02:25:40', '2018-09-30 02:25:40');

-- ----------------------------
-- Table structure for questions
-- ----------------------------
DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `status` enum('pendiente','procesada') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendiente',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `questions_client_id_foreign` (`client_id`),
  CONSTRAINT `questions_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of questions
-- ----------------------------
INSERT INTO `questions` VALUES ('1', 'Por qué ha sido rechazado mi documento?', '1', 'procesada', null, '2018-09-08 21:48:27', '2018-09-08 21:48:51');
INSERT INTO `questions` VALUES ('2', 'Como comienzo?', '10', 'pendiente', null, '2018-09-17 22:24:14', '2018-09-17 22:24:14');
INSERT INTO `questions` VALUES ('3', 'hggggggjkh?', '10', 'pendiente', null, '2018-09-19 01:58:43', '2018-09-19 01:58:43');
INSERT INTO `questions` VALUES ('4', 'Maricoo', '10', 'pendiente', null, '2018-09-19 23:30:37', '2018-09-19 23:30:37');
INSERT INTO `questions` VALUES ('5', 'pOR QUE MI ULTIMA DECLARACION SOBRE LA RENTA NO SE VE BIEN?', '13', 'procesada', null, '2018-09-27 23:05:17', '2018-09-27 23:05:50');

-- ----------------------------
-- Table structure for replies
-- ----------------------------
DROP TABLE IF EXISTS `replies`;
CREATE TABLE `replies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reply` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `replies_question_id_foreign` (`question_id`),
  KEY `replies_user_id_foreign` (`user_id`),
  CONSTRAINT `replies_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`),
  CONSTRAINT `replies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of replies
-- ----------------------------
INSERT INTO `replies` VALUES ('1', 'Debido a que no es visible la información', '1', '1', null, '2018-09-08 21:48:51', '2018-09-08 21:48:51');
INSERT INTO `replies` VALUES ('2', 'Esa vaina no sirve, pon una mejor.', '5', '1', null, '2018-09-27 23:05:50', '2018-09-27 23:05:50');

-- ----------------------------
-- Table structure for requeriments
-- ----------------------------
DROP TABLE IF EXISTS `requeriments`;
CREATE TABLE `requeriments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '1',
  `requeriment_type_id` int(10) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `requeriments_requeriment_type_id_foreign` (`requeriment_type_id`),
  CONSTRAINT `requeriments_requeriment_type_id_foreign` FOREIGN KEY (`requeriment_type_id`) REFERENCES `requeriment_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of requeriments
-- ----------------------------
INSERT INTO `requeriments` VALUES ('1', 'Acta Constitutiva y Estatutaria con su respectiva publicación', 'L.1', '1', '1', null, null, '2018-09-06 18:59:24');
INSERT INTO `requeriments` VALUES ('2', 'Copia Vigente del RIF', 'L.4', '1', '1', null, '2018-09-06 19:00:13', '2018-09-19 02:12:45');
INSERT INTO `requeriments` VALUES ('3', 'Carta de Presentación de la Empresa', 'C.4', '1', '4', null, '2018-09-06 19:01:41', '2018-09-06 19:01:41');
INSERT INTO `requeriments` VALUES ('4', 'carta de cuenta Bancaria (Emitida por el proveedor)', 'C.5', '1', '4', null, '2018-09-06 19:02:16', '2018-09-06 19:02:16');
INSERT INTO `requeriments` VALUES ('5', 'Copia de Cedula de identidad de cada Trabajador', 'S.3', '1', '3', null, '2018-09-06 19:02:51', '2018-09-06 19:02:51');
INSERT INTO `requeriments` VALUES ('6', 'Copia de planilla de inscripción del IVSS (14-02) de cada trabajador', 'S.2', '1', '3', null, '2018-09-06 19:03:33', '2018-09-06 19:03:33');
INSERT INTO `requeriments` VALUES ('7', 'Ultima declaración de ISLR', 'F.1', '1', '2', null, '2018-09-06 19:04:04', '2018-09-06 19:04:04');
INSERT INTO `requeriments` VALUES ('8', 'Pasaporte', 'P.P', '1', '1', null, '2018-09-19 02:10:28', '2018-09-19 02:10:28');

-- ----------------------------
-- Table structure for requeriment_companies
-- ----------------------------
DROP TABLE IF EXISTS `requeriment_companies`;
CREATE TABLE `requeriment_companies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `requeriment_id` int(10) unsigned NOT NULL,
  `company_id` int(10) unsigned NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `requeriment_companies_requeriment_id_foreign` (`requeriment_id`),
  KEY `requeriment_companies_company_id_foreign` (`company_id`),
  CONSTRAINT `requeriment_companies_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  CONSTRAINT `requeriment_companies_requeriment_id_foreign` FOREIGN KEY (`requeriment_id`) REFERENCES `requeriments` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of requeriment_companies
-- ----------------------------

-- ----------------------------
-- Table structure for requeriment_types
-- ----------------------------
DROP TABLE IF EXISTS `requeriment_types`;
CREATE TABLE `requeriment_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `requeriment_types_type_deleted_at_unique` (`type`,`deleted_at`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of requeriment_types
-- ----------------------------
INSERT INTO `requeriment_types` VALUES ('1', 'Legal', null, null, '2018-09-06 18:58:04');
INSERT INTO `requeriment_types` VALUES ('2', 'Finanzas', null, '2018-09-06 19:00:30', '2018-09-06 19:00:30');
INSERT INTO `requeriment_types` VALUES ('3', 'Seguridad y Salud Laboral', null, '2018-09-06 19:00:48', '2018-09-06 19:00:48');
INSERT INTO `requeriment_types` VALUES ('4', 'Compras', null, '2018-09-06 19:00:59', '2018-09-06 19:00:59');
INSERT INTO `requeriment_types` VALUES ('5', 'Desconocidos', null, '2018-09-19 02:08:48', '2018-09-19 02:42:40');

-- ----------------------------
-- Table structure for reviews
-- ----------------------------
DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `document_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_document_id_foreign` (`document_id`),
  KEY `reviews_user_id_foreign` (`user_id`),
  CONSTRAINT `reviews_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`),
  CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of reviews
-- ----------------------------
INSERT INTO `reviews` VALUES ('1', '7', '1', '0', null, '2018-09-11 00:59:11', '2018-09-11 00:59:11');
INSERT INTO `reviews` VALUES ('2', '9', '1', '1', null, '2018-09-19 01:54:23', '2018-09-19 01:54:23');
INSERT INTO `reviews` VALUES ('3', '8', '1', '0', null, '2018-09-19 01:54:56', '2018-09-19 01:54:56');
INSERT INTO `reviews` VALUES ('4', '10', '1', '1', null, '2018-09-27 23:02:37', '2018-09-27 23:02:37');
INSERT INTO `reviews` VALUES ('5', '11', '1', '0', null, '2018-09-27 23:03:37', '2018-09-27 23:03:37');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `charge` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_role_unique` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'Administrador', null, null, null, '0');
INSERT INTO `roles` VALUES ('2', 'Finanzas', null, null, '2018-09-19 01:33:36', '2');
INSERT INTO `roles` VALUES ('3', 'Seguridad', '2018-09-18 01:53:35', '2018-09-18 01:38:50', '2018-09-18 01:53:35', '3');
INSERT INTO `roles` VALUES ('4', 'Legal', null, '2018-09-19 02:01:36', '2018-09-19 02:01:36', '1');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Rhonal', 'Rhonal', 'KraftHeinzVzlaProveedores@gmail.com', '$2y$10$JoT06PC3zcza4GpoSaJwzOMeU6gwlz.Wn7HRuP/arhZG5RP8Rkq6u', null, null, null, null, '1');
INSERT INTO `users` VALUES ('2', 'Edwar', 'garcía', 'edwar004.eg@gmail.com', '$2y$10$LME/mPrQd/M0pDwngmviEuTibzV22to8nqBsouHq/rhfR4IaBoaRW', null, null, '2018-09-19 01:01:03', '2018-09-19 01:20:43', '1');
INSERT INTO `users` VALUES ('3', 'Pedro', 'Perez', 'pedroperez@hormail.com', '$2y$10$LME/mPrQd/M0pDwngmviEuTibzV22to8nqBsouHq/rhfR4IaBoaRW', null, null, '2018-09-19 01:37:04', '2018-09-19 01:37:12', '2');
INSERT INTO `users` VALUES ('4', 'Maria', 'Auditoria', 'audit@gmail.com', '$2y$10$dNscfuZ.HQXxhyFyqX1o7.kQNyDEAyKBVd1jTf4Z4N.1fdotoZUq6', null, null, '2018-09-19 02:05:50', '2018-09-19 02:05:50', '2');
