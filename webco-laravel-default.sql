/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50141
Source Host           : 192.168.0.2:3306
Source Database       : laravel

Target Server Type    : MYSQL
Target Server Version : 50141
File Encoding         : 65001

Date: 2013-01-16 11:16:32
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `banners`
-- ----------------------------
DROP TABLE IF EXISTS `banners`;
CREATE TABLE `banners` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(200) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `programado` char(1) NOT NULL DEFAULT 'N',
  `data_limite` date DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `views` bigint(20) unsigned NOT NULL DEFAULT '0',
  `stat` char(1) NOT NULL DEFAULT 'A' COMMENT 'A => Ativo, I => Inativo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of banners
-- ----------------------------

-- ----------------------------
-- Table structure for `categorias`
-- ----------------------------
DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) DEFAULT NULL,
  `tipo` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of categorias
-- ----------------------------

-- ----------------------------
-- Table structure for `produtos`
-- ----------------------------
DROP TABLE IF EXISTS `produtos`;
CREATE TABLE `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_id` int(11) NOT NULL,
  `subcategoria_id` int(11) NOT NULL,
  `fabricante_id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `codigo_int` varchar(200) NOT NULL,
  `descricao` text NOT NULL,
  `preco` decimal(15,2) NOT NULL,
  `preco_outsourcing` decimal(15,2) unsigned DEFAULT NULL,
  `preco_promo` decimal(15,2) DEFAULT NULL,
  `novidade` char(1) DEFAULT NULL,
  `destaque` char(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `ativo` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0=> Inativo, 1=> Ativo, 2=> Em falta, 3=> Não mostrar no site',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of produtos
-- ----------------------------

-- ----------------------------
-- Table structure for `produtos_fotos`
-- ----------------------------
DROP TABLE IF EXISTS `produtos_fotos`;
CREATE TABLE `produtos_fotos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `produto_id` int(11) DEFAULT NULL,
  `foto` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of produtos_fotos
-- ----------------------------

-- ----------------------------
-- Table structure for `subcategorias`
-- ----------------------------
DROP TABLE IF EXISTS `subcategorias`;
CREATE TABLE `subcategorias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `categoria_id` int(10) unsigned NOT NULL,
  `nome` varchar(200) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_rcw_subcategoria_categoria` (`categoria_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of subcategorias
-- ----------------------------

-- ----------------------------
-- Table structure for `usuarios`
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `ativo` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES ('2', 'Administrador', 'teste@teste.com.br', 'admin', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'S');
INSERT INTO `usuarios` VALUES ('8', 'Ramon', 'rsanches@webcompany.com.br', 'ramonsanches', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'S');
