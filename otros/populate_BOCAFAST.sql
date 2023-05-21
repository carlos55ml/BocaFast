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

-- Dumping data for table bocafast.pedidos: ~0 rows (approximately)
DELETE FROM `pedidos`;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` (`id`, `precio_total`, `estado`, `fecha`, `id_usuario`) VALUES
	(6, 10, 'recibido', '2023-05-21 23:28:32', 4),
	(7, 8, 'recibido', '2023-05-21 23:28:38', 3),
	(8, 16, 'recibido', '2023-05-21 23:28:47', 4),
	(9, 6, 'recibido', '2023-05-21 23:28:55', 3);
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;

-- Dumping data for table bocafast.pedido_tiene_piezas: ~0 rows (approximately)
DELETE FROM `pedido_tiene_piezas`;
/*!40000 ALTER TABLE `pedido_tiene_piezas` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedido_tiene_piezas` ENABLE KEYS */;

-- Dumping data for table bocafast.piezas_definidas: ~4 rows (approximately)
DELETE FROM `piezas_definidas`;
/*!40000 ALTER TABLE `piezas_definidas` DISABLE KEYS */;
INSERT INTO `piezas_definidas` (`id`, `nombre`, `ingredientes`, `precio`, `imagen`, `descripcion`) VALUES
	(1, 'Levante', 'alioli, queso jamon york', 5, 'https://i.imgur.com/m7nR948.png', 'Autoctono de levante'),
	(2, 'Canario', 'queso edam, queso, jamon york', 7, 'https://i.imgur.com/qOQOaGZ.png', 'Una hora menos'),
	(10, 'Murciano', 'pimiento, queso, aceitunas', 7, 'https://i.imgur.com/qOQOaGZ.png', 'No da para mas'),
	(11, 'Valenciano', 'gambas, mayonesa, aguacate', 7, 'https://i.imgur.com/qOQOaGZ.png', 'Solo entienden de paella'),
	(12, 'Sevilla', 'aceitunas, naranja, vainilla', 7, 'https://i.imgur.com/qOQOaGZ.png', 'Huele a triana');
/*!40000 ALTER TABLE `piezas_definidas` ENABLE KEYS */;

-- Dumping data for table bocafast.users: ~3 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `passwd`, `is_admin`) VALUES
	(1, 'carlos', 'carlos', 1),
	(3, 'manu', 'manu', 0),
	(4, 'javi', 'javi', 0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
