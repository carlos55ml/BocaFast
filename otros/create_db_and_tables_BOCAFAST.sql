-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.27-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for bocafast
DROP DATABASE IF EXISTS `bocafast`;
CREATE DATABASE IF NOT EXISTS `bocafast` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `bocafast`;

-- Dumping structure for table bocafast.complementos
DROP TABLE IF EXISTS `complementos`;
CREATE TABLE IF NOT EXISTS `complementos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL DEFAULT '',
  `cantidad` int(11) NOT NULL DEFAULT 0,
  `imagen` varchar(100) NOT NULL DEFAULT '0',
  `precio_unidad` float NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bocafast.complementos: ~0 rows (approximately)
/*!40000 ALTER TABLE `complementos` DISABLE KEYS */;
INSERT INTO `complementos` (`id`, `nombre`, `cantidad`, `imagen`, `precio_unidad`) VALUES
	(1, 'Coca Cola', 10, '0', 1.2);
/*!40000 ALTER TABLE `complementos` ENABLE KEYS */;

-- Dumping structure for table bocafast.ingredientes
DROP TABLE IF EXISTS `ingredientes`;
CREATE TABLE IF NOT EXISTS `ingredientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL DEFAULT '',
  `cantidad` int(11) NOT NULL DEFAULT 0,
  `imagen` varchar(50) NOT NULL DEFAULT '0',
  `precio_unidad` float NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bocafast.ingredientes: ~3 rows (approximately)
/*!40000 ALTER TABLE `ingredientes` DISABLE KEYS */;
INSERT INTO `ingredientes` (`id`, `nombre`, `cantidad`, `imagen`, `precio_unidad`) VALUES
	(1, 'lechuga', 14, '0', 0.3),
	(2, 'tomate', 20, '0', 0.2),
	(3, 'tomate', 20, '0', 0.2);
/*!40000 ALTER TABLE `ingredientes` ENABLE KEYS */;

-- Dumping structure for table bocafast.pedidos
DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `precio_total` float NOT NULL DEFAULT 0,
  `estado` enum('recibido','cancelado','en proceso','terminado') NOT NULL DEFAULT 'recibido',
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_usuario` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `id_usuario_pedido` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bocafast.pedidos: ~2 rows (approximately)
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` (`id`, `precio_total`, `estado`, `fecha`, `id_usuario`) VALUES
	(2, 12, 'recibido', '2023-05-13 19:00:00', 1),
	(3, 10, 'en proceso', '2023-05-13 19:00:33', 1);
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;

-- Dumping structure for table bocafast.pedido_tiene_complemento
DROP TABLE IF EXISTS `pedido_tiene_complemento`;
CREATE TABLE IF NOT EXISTS `pedido_tiene_complemento` (
  `id_pedido` int(11) DEFAULT NULL,
  `id_complemento` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  KEY `id_pedido` (`id_pedido`),
  KEY `id_complemento` (`id_complemento`),
  CONSTRAINT `id_complemento` FOREIGN KEY (`id_complemento`) REFERENCES `complementos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_pedido` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bocafast.pedido_tiene_complemento: ~0 rows (approximately)
/*!40000 ALTER TABLE `pedido_tiene_complemento` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedido_tiene_complemento` ENABLE KEYS */;

-- Dumping structure for table bocafast.pedido_tiene_piezas
DROP TABLE IF EXISTS `pedido_tiene_piezas`;
CREATE TABLE IF NOT EXISTS `pedido_tiene_piezas` (
  `precio` float NOT NULL DEFAULT 0,
  `cantidad` int(11) NOT NULL DEFAULT 0,
  `id_pieza` int(11) NOT NULL DEFAULT 0,
  `id_pedido` int(11) NOT NULL DEFAULT 0,
  KEY `id_pedido` (`id_pedido`),
  KEY `id_pieza` (`id_pieza`),
  CONSTRAINT `id_pedido_pertenece` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_pieza_tiene` FOREIGN KEY (`id_pieza`) REFERENCES `piezas_definidas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bocafast.pedido_tiene_piezas: ~0 rows (approximately)
/*!40000 ALTER TABLE `pedido_tiene_piezas` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedido_tiene_piezas` ENABLE KEYS */;

-- Dumping structure for table bocafast.piezas_definidas
DROP TABLE IF EXISTS `piezas_definidas`;
CREATE TABLE IF NOT EXISTS `piezas_definidas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL DEFAULT '',
  `ingredientes` longtext NOT NULL,
  `precio` float NOT NULL DEFAULT 0,
  `imagen` varchar(50) DEFAULT NULL,
  `descripcion` varchar(240) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bocafast.piezas_definidas: ~0 rows (approximately)
/*!40000 ALTER TABLE `piezas_definidas` DISABLE KEYS */;
/*!40000 ALTER TABLE `piezas_definidas` ENABLE KEYS */;

-- Dumping structure for table bocafast.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT concat('user',floor(rand() * (999 - 100) + 100)),
  `passwd` varchar(255) NOT NULL DEFAULT 'changeme',
  `is_admin` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bocafast.users: ~1 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `passwd`, `is_admin`) VALUES
	(1, 'carlos', 'changeme', 1),
	(3, 'carlos2', 'changeme', 0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
