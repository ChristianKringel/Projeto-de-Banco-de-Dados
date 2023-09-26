-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 26-Set-2023 às 03:12
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `testefinal`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `album`
--

DROP TABLE IF EXISTS `album`;
CREATE TABLE IF NOT EXISTS `album` (
  `codigoAlbum` int NOT NULL AUTO_INCREMENT,
  `nomeAlbum` varchar(30) DEFAULT NULL,
  `nroFaixas` int DEFAULT NULL,
  `dataLancamento` date DEFAULT NULL,
  PRIMARY KEY (`codigoAlbum`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `album`
--

INSERT INTO `album` (`codigoAlbum`, `nomeAlbum`, `nroFaixas`, `dataLancamento`) VALUES
(1, 'Álbum Pop', 12, '2023-01-10'),
(2, 'Álbum Rock', 10, '2023-02-15'),
(3, 'Álbum Sertanejo', 14, '2023-03-20'),
(10, 'Master of Puppets', 8, '0000-00-00'),
(12, 'teste23', 23, '0000-00-00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `artista`
--

DROP TABLE IF EXISTS `artista`;
CREATE TABLE IF NOT EXISTS `artista` (
  `codigoArtista` int NOT NULL AUTO_INCREMENT,
  `anoInicio` int DEFAULT NULL,
  `codigoGenero` int DEFAULT NULL,
  `numeroISWC` int DEFAULT NULL,
  PRIMARY KEY (`codigoArtista`),
  KEY `fk_codigoGenero` (`codigoGenero`),
  KEY `fk_numeroISWC` (`numeroISWC`)
) ENGINE=MyISAM AUTO_INCREMENT=2009 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `artista`
--

INSERT INTO `artista` (`codigoArtista`, `anoInicio`, `codigoGenero`, `numeroISWC`) VALUES
(1001, 2010, 1, NULL),
(1002, 2005, 1, NULL),
(1003, 2015, 3, NULL),
(2000, 1981, 1, 2000),
(2001, 2005, NULL, NULL),
(2002, 2020, NULL, NULL),
(2003, 2023, NULL, NULL),
(2004, 2023, NULL, NULL),
(2005, 2023, 0, NULL),
(2006, 90, 32, NULL),
(2007, 1880, 33, 0),
(2008, 1770, 31, 2009);

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacao`
--

DROP TABLE IF EXISTS `avaliacao`;
CREATE TABLE IF NOT EXISTS `avaliacao` (
  `cpf` bigint NOT NULL,
  `codigoMusica` int NOT NULL,
  `numeroLikes` int DEFAULT NULL,
  PRIMARY KEY (`cpf`,`codigoMusica`),
  KEY `codigoMusica` (`codigoMusica`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `avaliacao`
--

INSERT INTO `avaliacao` (`cpf`, `codigoMusica`, `numeroLikes`) VALUES
(11111111104, 1, 10),
(22222222205, 2, 15),
(33333333306, 3, 20),
(666666666, 5, NULL),
(666666666, 1, NULL),
(666666666, 4, NULL),
(666666666, 3, NULL),
(666666666, 6, NULL),
(666666666, 8, NULL),
(666666666, 10, NULL),
(666666666, 11, NULL),
(666666666, 12, NULL),
(666666666, 566, NULL),
(666666666, 567, NULL),
(123321, 4, NULL),
(123321, 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `codigoartista`
--

DROP TABLE IF EXISTS `codigoartista`;
CREATE TABLE IF NOT EXISTS `codigoartista` (
  `numeroISWC` int NOT NULL AUTO_INCREMENT,
  `dataCriacao` date DEFAULT NULL,
  `dataVerificacao` date DEFAULT NULL,
  `cpf` bigint DEFAULT NULL,
  PRIMARY KEY (`numeroISWC`),
  KEY `cpf` (`cpf`)
) ENGINE=MyISAM AUTO_INCREMENT=2010 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `codigoartista`
--

INSERT INTO `codigoartista` (`numeroISWC`, `dataCriacao`, `dataVerificacao`, `cpf`) VALUES
(1001, '2023-01-15', '2023-02-01', 12345678901),
(1002, '2023-02-20', '2023-03-10', 98765432102),
(1003, '2023-03-05', '2023-04-02', 55555555503),
(2000, '0000-00-00', '2023-09-01', 666666666),
(2001, '0000-00-00', '0000-00-00', 4048774000),
(2002, '2023-09-23', '2023-09-23', 1121),
(2003, '2020-01-01', '2023-09-23', 222),
(2004, '2023-09-23', '2023-09-23', 22),
(2005, '2023-02-02', '2023-09-23', 1),
(2006, '2023-09-09', '2023-09-25', 20202),
(2007, '0000-00-00', '2023-09-25', 2277),
(2008, '0000-00-00', '2023-09-25', 123321),
(2009, '0000-00-00', '2023-09-25', 2232);

-- --------------------------------------------------------

--
-- Estrutura da tabela `conta`
--

DROP TABLE IF EXISTS `conta`;
CREATE TABLE IF NOT EXISTS `conta` (
  `nome` varchar(30) DEFAULT NULL,
  `telefone` bigint DEFAULT NULL,
  `cpf` bigint NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `endereco` varchar(50) DEFAULT NULL,
  `senha` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`cpf`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `conta`
--

INSERT INTO `conta` (`nome`, `telefone`, `cpf`, `email`, `endereco`, `senha`) VALUES
('João Silva', 1234567890, 12345678901, 'joao@email.com', 'Rua A, 123', 'senhajoao'),
('Maria Santos', 9876543210, 98765432102, 'maria@email.com', 'Avenida B, 456', 'senhamaria'),
('Carlos Oliveira', 5555555555, 55555555503, 'carlos@email.com', 'Rua C, 789', 'senhacarlos'),
('Vine', 22, 22, 'vine@gmail.com', 'Vine', 'vine'),
('James Hetfield', 666666666, 666666666, 'james@email.com', 'Master Masterrrr', 'metallica'),
('Pedro', 1, 1, 'Pedro@gmail.com', 'PedroRosa', 'pedro'),
('teste1', 2232, 2232, 'teste1', 'teste1', 'teste1'),
('teste', 123321, 123321, 'teste', 'teste', 'teste');

-- --------------------------------------------------------

--
-- Estrutura da tabela `criadorconteudo`
--

DROP TABLE IF EXISTS `criadorconteudo`;
CREATE TABLE IF NOT EXISTS `criadorconteudo` (
  `nacionalidadeArtista` varchar(50) DEFAULT 'Brasileiro',
  `descricao` varchar(100) DEFAULT 'Artista sem descrição',
  `nomeArtistico` varchar(50) NOT NULL,
  `cpfCriador` bigint NOT NULL,
  PRIMARY KEY (`cpfCriador`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `criadorconteudo`
--

INSERT INTO `criadorconteudo` (`nacionalidadeArtista`, `descricao`, `nomeArtistico`, `cpfCriador`) VALUES
('Brasileiro', 'Artista de música pop', 'PopStar', 12345678901),
('Brasileiro', 'Artista de rock alternativo', 'RockStar', 98765432102),
('Brasileiro', 'Cantor de música sertaneja', 'SertanejoStar', 55555555503),
('Brasileiro', 'Um exímio trompetista e músico', 'Alemão', 4048774000),
('Estrangeiro', 'Banda de heavy metal', 'Metallica', 666666666),
('Argentino', 'novo 1 desc', 'novo 1 artista', 1121),
('Brasileira', 'Um guitarrista média baixa', 'Rosa', 1),
('Brasileiro', 'Um horrivel suporte', 'Maionese', 22),
('brasilll', 'teste dos guri', 'teste1', 20202),
('testeGenero', 'testeGenero', 'testeGenero', 2277),
('teste', 'teste', 'teste', 123321);

-- --------------------------------------------------------

--
-- Estrutura da tabela `generoartista`
--

DROP TABLE IF EXISTS `generoartista`;
CREATE TABLE IF NOT EXISTS `generoartista` (
  `codigoGenero` int NOT NULL,
  `categoria` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`codigoGenero`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `generoartista`
--

INSERT INTO `generoartista` (`codigoGenero`, `categoria`) VALUES
(31, 'Pop'),
(30, 'Rock'),
(32, 'Sertanejo'),
(33, 'Gaucha'),
(34, 'Eletronica');

-- --------------------------------------------------------

--
-- Estrutura da tabela `grava`
--

DROP TABLE IF EXISTS `grava`;
CREATE TABLE IF NOT EXISTS `grava` (
  `codigoArtista` int NOT NULL,
  `codigoAlbum` int NOT NULL,
  KEY `codigoAlbum` (`codigoAlbum`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `grava`
--

INSERT INTO `grava` (`codigoArtista`, `codigoAlbum`) VALUES
(1001, 1),
(1002, 2),
(1003, 3),
(2000, 0),
(2000, 0),
(2000, 20);

-- --------------------------------------------------------

--
-- Estrutura da tabela `musica`
--

DROP TABLE IF EXISTS `musica`;
CREATE TABLE IF NOT EXISTS `musica` (
  `codigoMusica` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(30) DEFAULT NULL,
  `duracao` double DEFAULT NULL,
  `codigoAlbum` int DEFAULT NULL,
  PRIMARY KEY (`codigoMusica`),
  KEY `codigoAlbum` (`codigoAlbum`)
) ENGINE=MyISAM AUTO_INCREMENT=570 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `musica`
--

INSERT INTO `musica` (`codigoMusica`, `titulo`, `duracao`, `codigoAlbum`) VALUES
(1, 'Música Pop 1', 3.5, 1),
(2, 'Música Rock 1', 4.2, 2),
(3, 'Música Sertaneja 1', 3.8, 3),
(4, 'Música Pop 2', 4, 1),
(5, 'Música Rock 2', 3.9, 2),
(6, 'Música Sertaneja 2', 3.7, 3),
(8, 'Musica teste', 4, 3),
(10, 'Battery', 5.12, 10),
(11, 'Master of Puppets', 8.35, 10),
(12, 'The Thing That Should Not Be', 6.36, 10),
(20, 'Enter Sandman', 5.38, 0),
(555, 'Rock', 2.59, 0),
(556, 'Leper Messiah', 5.4, 10),
(557, 'Disposable Heroes', 8.17, 10),
(558, 'Welcome Home (Sanitarium)', 6.27, 10),
(561, 'Orion', 8.12, 10),
(569, 'testando', 2, 2),
(567, 'teste22', 56, 10),
(568, 'TestandoArtista', 2.2, 10),
(566, 'testeeee', 2, 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `possui`
--

DROP TABLE IF EXISTS `possui`;
CREATE TABLE IF NOT EXISTS `possui` (
  `codigoArtista` int NOT NULL,
  `codigoMusica` int NOT NULL,
  PRIMARY KEY (`codigoArtista`,`codigoMusica`),
  KEY `codigoMusica` (`codigoMusica`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `possui`
--

INSERT INTO `possui` (`codigoArtista`, `codigoMusica`) VALUES
(1, 563),
(1001, 1),
(1001, 4),
(1001, 5),
(1002, 2),
(1003, 3),
(1003, 6),
(1003, 8),
(2000, 10),
(2000, 11),
(2000, 12),
(2000, 566),
(2000, 567),
(2000, 568),
(2000, 569);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuariocomum`
--

DROP TABLE IF EXISTS `usuariocomum`;
CREATE TABLE IF NOT EXISTS `usuariocomum` (
  `nickname` varchar(50) DEFAULT NULL,
  `cpfComum` bigint NOT NULL,
  PRIMARY KEY (`cpfComum`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `usuariocomum`
--

INSERT INTO `usuariocomum` (`nickname`, `cpfComum`) VALUES
('user1', 11111111104),
('user2', 22222222205),
('user3', 33333333306),
('user5', 55555555503),
('UserTeste1', 12345678901),
('UserTeste2', 98765432102);

-- --------------------------------------------------------

--
-- Estrutura da tabela `visualizaartista`
--

DROP TABLE IF EXISTS `visualizaartista`;
CREATE TABLE IF NOT EXISTS `visualizaartista` (
  `cpf` bigint NOT NULL,
  `codigoArtista` int NOT NULL,
  `qntAcesso` int DEFAULT NULL,
  `localizacaoVisualizador` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`cpf`,`codigoArtista`),
  KEY `codigoArtista` (`codigoArtista`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `visualizaartista`
--

INSERT INTO `visualizaartista` (`cpf`, `codigoArtista`, `qntAcesso`, `localizacaoVisualizador`) VALUES
(11111111104, 1001, 100, 'Brasil'),
(22222222205, 1002, 80, 'EUA'),
(33333333306, 1003, 70, 'Brasil'),
(55555555503, 1001, 200, 'Alemanha');

-- --------------------------------------------------------

--
-- Estrutura da tabela `visualizamusica`
--

DROP TABLE IF EXISTS `visualizamusica`;
CREATE TABLE IF NOT EXISTS `visualizamusica` (
  `cpf` bigint DEFAULT NULL,
  `codigoMusica` int DEFAULT NULL,
  `qntAcessos` int DEFAULT NULL,
  `localizacaoVisualizador` varchar(30) DEFAULT NULL,
  KEY `cpf` (`cpf`),
  KEY `codigoMusica` (`codigoMusica`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `visualizamusica`
--

INSERT INTO `visualizamusica` (`cpf`, `codigoMusica`, `qntAcessos`, `localizacaoVisualizador`) VALUES
(11111111104, 1, 50, 'Brasil'),
(22222222205, 2, 45, 'EUA'),
(33333333306, 3, 30, 'Brasil');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
