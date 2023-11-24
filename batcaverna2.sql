-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.28-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para batcaverna2
CREATE DATABASE IF NOT EXISTS `batcaverna2` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `batcaverna2`;

-- Copiando estrutura para tabela batcaverna2.diarios
CREATE TABLE IF NOT EXISTS `diarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` int(11) DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `link` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `turmas_id` int(11) NOT NULL,
  `professores_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_diarios_professores` (`professores_id`),
  KEY `FK_diarios_turmas` (`turmas_id`),
  CONSTRAINT `FK_diarios_professores` FOREIGN KEY (`professores_id`) REFERENCES `professores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_diarios_turmas` FOREIGN KEY (`turmas_id`) REFERENCES `turmas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela batcaverna2.diarios: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela batcaverna2.professores
CREATE TABLE IF NOT EXISTS `professores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `siape` int(11) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_professores_users` (`users_id`),
  CONSTRAINT `FK_professores_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela batcaverna2.professores: ~44 rows (aproximadamente)
INSERT INTO `professores` (`id`, `siape`, `nome`, `email`, `created`, `modified`, `users_id`) VALUES
	(1, 1228722, 'Aecio da Silva Martins', 'aecio.martins@ifma.edu.br', '2023-06-03 22:19:58', '2023-06-03 22:20:44', 3),
	(2, 2271969, 'Alanny Silva Luz', 'alanny.luz@ifma.edu.br', '2023-06-03 22:19:59', '2023-06-03 22:20:44', NULL),
	(3, 3004022, 'Ana Caroline Meireles Soares', 'ana.soares@ifma.edu.br', '2023-06-03 22:20:00', '2023-06-03 22:20:42', NULL),
	(4, 1993705, 'Ana Rayonara de Sousa Albuquerque', 'rayonara.albuquerque@ifma.edu.br', '2023-06-03 22:19:59', '2023-06-03 22:20:42', NULL),
	(5, 1963721, 'Anderson Oliveira da Silva', 'anderson.silva@ifma.edu.br', '2023-06-03 22:20:01', '2023-06-03 22:20:40', NULL),
	(6, 1964083, 'Andrea Lima Barros', 'andrea.barros@ifma.edu.br', '2023-06-03 22:20:00', '2023-06-03 22:20:41', NULL),
	(7, 2342485, 'Andre Wallas da Silva Sousa', 'andre.wallas@ifma.edu.br', '2023-06-03 22:20:01', '2023-06-03 22:20:40', NULL),
	(8, 1620844, 'Annaya Assuncao Pereira Ribeiro', 'annaya.assuncao@ifma.edu.br', '2023-06-03 22:20:15', '2023-06-03 22:20:39', NULL),
	(9, 1226388, 'Bruno Vicente Alves de Lima', 'brunovicente.lima@ifma.edu.br', '2023-06-03 22:20:14', '2023-06-03 22:20:39', 1),
	(10, 2339684, 'Clarissa Maria Brito Lima', 'brunnovicente@hotmail.com', '2023-06-03 22:20:14', '2023-07-27 17:56:03', NULL),
	(11, 1951613, 'Daisy Damasceno Araujo', 'daisy.araujo@ifma.edu.br', '2023-06-03 22:20:13', '2023-06-03 22:20:38', NULL),
	(12, 1266884, 'Daniel Barroso de Carvalho Ribeiro', 'daniel.barroso@ifma.edu.br', '2023-06-03 22:20:16', '2023-06-03 22:20:38', NULL),
	(13, 1836367, 'Diego Roberto Rodrigues Orsano', 'diego.rodrigues@ifma.edu.br', '2023-06-03 22:20:13', '2023-06-03 22:20:37', NULL),
	(14, 1132172, 'Diogo Vinicius de Sousa Silva', 'diogo.silva@ifma.edu.br', '2023-06-03 22:20:12', '2023-06-03 22:20:36', NULL),
	(15, 2345177, 'Douglas dos Santos Silva', 'brunnovicente@gmail.com', '2023-06-03 22:20:12', '2023-06-03 22:20:36', 2),
	(16, 1860969, 'Elcio Daniel Sousa Barros', 'elcio.barros@ifma.edu.br', '2023-06-03 22:20:11', '2023-06-03 22:20:35', NULL),
	(17, 2329587, 'Fabrizio Soares Caldas', 'fabrizio.caldas@ifma.edu.br', '2023-06-03 22:20:11', '2023-06-03 22:20:35', NULL),
	(18, 2571587, 'Francicleia Vieira Ribeiro de Oliveira', 'francicleia.ribeiro@ifma.edu.br', '2023-06-03 22:20:02', '2023-06-03 22:20:34', NULL),
	(19, 1508992, 'Francilio Benicio Santos de Moraes Trindade', 'fbenicio@ifma.edu.br', '2023-06-03 22:20:10', '2023-06-03 22:20:34', NULL),
	(20, 1963983, 'Francisca Marcia Costa de Souza', 'francisca.souza@ifma.edu.br', '2023-06-03 22:20:09', '2023-06-03 22:20:33', NULL),
	(21, 2331838, 'Francisco Alan de Oliveira Santos', 'franciscoalan.santos@ifma.edu.br', '2023-06-03 22:20:03', '2023-06-03 22:20:32', NULL),
	(22, 2408251, 'Fredson Anderson Brito de Castro', 'fredson.castro@ifma.edu.br', '2023-06-03 22:20:09', '2023-06-03 22:20:32', NULL),
	(23, 1258500, 'Gielson Vitor Oliveira Veras', 'gielson.veras@ifma.edu.br', '2023-06-03 22:20:08', '2023-06-03 22:20:31', NULL),
	(24, 2342286, 'Hosana Maria da Silva Sousa', 'hosana.sousa@ifma.edu.br', '2023-06-03 22:20:07', '2023-06-03 22:20:31', NULL),
	(25, 2282550, 'Joao Paulo Marques Silva', 'joao.marques@ifma.edu.br', '2023-06-03 22:20:07', '2023-06-03 22:20:31', NULL),
	(26, 2331959, 'Jose Jeovane Reges Cordeiro', 'jose.cordeiro@ifma.edu.br', '2023-06-03 22:20:03', '2023-06-03 22:20:30', NULL),
	(27, 1145981, 'Josimar Hendrio Ferraz Borges', 'josimar.borges@ifma.edu.br', '2023-06-03 22:20:06', '2023-06-03 22:20:30', NULL),
	(28, 1886837, 'Jussie Soares da Rocha', 'jussie.rocha@ifma.edu.br', '2023-06-03 22:20:06', '2023-06-03 22:20:29', NULL),
	(29, 2272520, 'Luciane Norberto Menezes de Araujo', 'luciane.araujo@ifma.edu.br', '2023-06-03 22:20:05', '2023-06-03 22:20:29', NULL),
	(30, 3077773, 'Mardoqueu Sousa Telvina', 'mardoqueu.telvina@ifma.edu.br', '2023-06-03 22:20:05', '2023-06-03 22:20:28', NULL),
	(31, 1903931, 'Maria do Socorro Ribeiro da Silva', 'socorro.ribeiro@ifma.edu.br', '2023-06-03 22:20:17', '2023-06-03 22:20:27', NULL),
	(32, 1699038, 'Pablo Silva Imperio', 'pablo.imperio@ifma.edu.br', '2023-06-03 22:20:05', '2023-06-03 22:20:27', NULL),
	(33, 3337865, 'Paulo Henrique Sousa Dantas', 'pdantas@ifma.edu.br', '2023-06-03 22:20:04', '2023-06-03 22:20:26', NULL),
	(34, 2020069, 'Rivania da Silva Lira', 'rivania.lira@ifma.edu.br', '2023-06-03 22:20:18', '2023-06-03 22:20:24', NULL),
	(35, 1921426, 'Robert Charles Moreira Caland', 'robertcaland@ifma.edu.br', '2023-06-03 22:20:04', '2023-06-03 22:20:25', NULL),
	(36, 1236780, 'Roberto Pereira da Silva', 'roberto.pereira@ifma.edu.br', '2023-06-03 22:20:18', '2023-06-03 22:20:26', NULL),
	(37, 2311281, 'Robert Silva Lima', 'robert.lima@ifma.edu.br', '2023-06-03 22:20:19', '2023-06-03 22:20:23', NULL),
	(38, 1293499, 'Susana Kelly Gomes Oliveira', 'susana.oliveira@ifma.edu.br', '2023-06-03 22:20:19', '2023-06-03 22:20:23', NULL),
	(39, 1837473, 'Thalita Vitoria Castelo Branco Nunes Silva', 'thalita.silva@ifma.edu.br', '2023-06-03 22:20:21', '2023-06-03 22:20:22', NULL),
	(40, 1877101, 'Willams da Silva Lima', 'willams.lima@ifma.edu.br', '2023-06-03 22:20:21', '2023-06-03 22:20:22', NULL),
	(41, 743817, 'Gerardo Soares da Silva Junior', 'gerardo.silva@ifma.edu.br', '2023-06-04 13:15:42', '2023-06-04 13:15:43', NULL),
	(42, 1111111, 'Professor Virtual', 'brunnovicente@gmail.com', '2023-06-04 13:21:59', '2023-07-13 16:50:18', NULL),
	(43, 3345023, 'Analine Daiany Costa Andrade', 'analine.andrade@ifma.edu.br', '2023-07-11 19:48:41', '2023-07-11 19:48:41', NULL),
	(44, 3344988, 'Denilson Nunes Mota', 'denilsonmota@ifma.edu.br', '2023-07-11 19:51:33', '2023-07-11 19:51:33', NULL);

-- Copiando estrutura para tabela batcaverna2.solicitacoes
CREATE TABLE IF NOT EXISTS `solicitacoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` date DEFAULT NULL,
  `dia` varchar(45) DEFAULT NULL,
  `horarios` varchar(45) DEFAULT NULL,
  `justificativa` varchar(250) DEFAULT NULL,
  `tipo` varchar(20) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `registro` int(11) DEFAULT NULL,
  `diarios_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_solicitacoes_diarios` (`diarios_id`),
  CONSTRAINT `FK_solicitacoes_diarios` FOREIGN KEY (`diarios_id`) REFERENCES `diarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela batcaverna2.solicitacoes: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela batcaverna2.turmas
CREATE TABLE IF NOT EXISTS `turmas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) DEFAULT NULL,
  `ano` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela batcaverna2.turmas: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela batcaverna2.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `categoria` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela batcaverna2.users: ~3 rows (aproximadamente)
INSERT INTO `users` (`id`, `username`, `password`, `categoria`, `created`, `modified`, `status`) VALUES
	(1, '1226388', '$2y$10$Eypv0Xp0EVd.YCOHhLlO8enQLJtMNQeDljd8n0TxsS8FfbenSWYLm', 'SUPREMO', '2023-11-19 21:52:08', '2023-11-19 21:52:10', 1),
	(2, '2345177', '$2y$10$Eypv0Xp0EVd.YCOHhLlO8enQLJtMNQeDljd8n0TxsS8FfbenSWYLm', 'COORDENADOR', '2023-11-20 14:12:13', '2023-11-20 14:12:13', 1),
	(3, '1228722', '$2y$10$Eypv0Xp0EVd.YCOHhLlO8enQLJtMNQeDljd8n0TxsS8FfbenSWYLm', 'PROFESSOR', '2023-11-22 22:28:29', '2023-11-22 22:28:29', 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
