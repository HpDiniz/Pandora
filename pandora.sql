-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 02-Jul-2018 às 01:06
-- Versão do servidor: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pandora`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

DROP TABLE IF EXISTS `disciplina`;
CREATE TABLE IF NOT EXISTS `disciplina` (
  `Codigo` varchar(10) NOT NULL,
  `Nome` varchar(100) NOT NULL,
  `RecomendacaoP` int(11) NOT NULL,
  `RecomendacaoN` int(11) NOT NULL,
  `TotalDeAvaliacoes` int(11) NOT NULL,
  `SomaNotaUtilidade` int(11) NOT NULL,
  `SomaNotaFacilidade` int(11) NOT NULL,
  PRIMARY KEY (`Codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `disciplina`
--

INSERT INTO `disciplina` (`Codigo`, `Nome`, `RecomendacaoP`, `RecomendacaoN`, `TotalDeAvaliacoes`, `SomaNotaUtilidade`, `SomaNotaFacilidade`) VALUES
('EST106', 'Estatistica 1', 1, 0, 1, 1, 1),
('FIS201', 'Fisica 1', 0, 0, 0, 0, 0),
('FIS203', 'Fisica 3', 9, 0, 9, 2, 2),
('INF220', 'Banco de Dados', 1, 0, 1, 1, 1),
('INF280', 'Pesquisa Operacional', 0, 0, 0, 0, 0),
('MAT140', 'Calculo 1', 8, 0, 8, 7, 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplinasugerida`
--

DROP TABLE IF EXISTS `disciplinasugerida`;
CREATE TABLE IF NOT EXISTS `disciplinasugerida` (
  `IdSugestao` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `IDusuarioSugeriu` int(11) NOT NULL,
  PRIMARY KEY (`IdSugestao`),
  KEY `usuario_fk` (`IDusuarioSugeriu`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

DROP TABLE IF EXISTS `pessoa`;
CREATE TABLE IF NOT EXISTS `pessoa` (
  `Nome` varchar(100) NOT NULL,
  `Curso` varchar(100) NOT NULL,
  `DataCadastro` date NOT NULL,
  `idpessoa` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idpessoa`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`Nome`, `Curso`, `DataCadastro`, `idpessoa`) VALUES
('Henrique', 'Ciencia da Computacao', '2018-07-01', 1),
('Lucas ', 'Ciencia da Computacao', '2018-07-01', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoaavaliadisciplina`
--

DROP TABLE IF EXISTS `pessoaavaliadisciplina`;
CREATE TABLE IF NOT EXISTS `pessoaavaliadisciplina` (
  `IdAvaliacao` int(11) NOT NULL AUTO_INCREMENT,
  `Utilidade` tinyint(1) NOT NULL,
  `Facilidade` tinyint(1) NOT NULL,
  `Recomenda` tinyint(1) NOT NULL,
  `Professor` varchar(100) NOT NULL,
  `Comentario` varchar(255) NOT NULL,
  `ReacoesNegativas` int(11) NOT NULL,
  `CodigoDisc` varchar(10) NOT NULL,
  `IdPessoa` int(11) NOT NULL,
  PRIMARY KEY (`IdAvaliacao`),
  KEY `usuario_fk` (`IdPessoa`),
  KEY `discplinafk` (`CodigoDisc`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pessoaavaliadisciplina`
--

INSERT INTO `pessoaavaliadisciplina` (`IdAvaliacao`, `Utilidade`, `Facilidade`, `Recomenda`, `Professor`, `Comentario`, `ReacoesNegativas`, `CodigoDisc`, `IdPessoa`) VALUES
(1, 1, 1, 1, 'Joelson', 'Amei', 0, 'MAT140', 1),
(4, 1, 1, 1, 'Braz', 'A disciplina foi muito boa, o professor entÃ£o nem se fala!', 0, 'MAT140', 1),
(5, 1, 0, 1, 'Fernanda', 'Foi uma porra', 0, 'MAT140', 1),
(6, 1, 1, 1, 'Lilian', 'Gostei bastante', 0, 'MAT140', 1),
(7, 1, 1, 1, 'Lilian', 'Nao gostei', 0, 'MAT140', 1),
(8, 1, 1, 1, 'Alvaro', 'Foi muito facil', 0, 'FIS203', 1),
(9, 1, 1, 1, 'Alvaro', 'Mole demais', 0, 'FIS203', 1),
(10, 0, 0, 1, 'Alvaro', 'Ridiculo', 0, 'FIS203', 1),
(11, 1, 1, 1, 'Camila', 'Eu gostei bastante, a aula era muito boa, e a disciplina foi bem legal tambem!', 0, 'EST106', 1),
(12, 0, 0, 1, 'Renato', 'Achei excelente', 0, 'FIS203', 1),
(13, 0, 0, 1, 'Pedro', 'Professor mitou', 0, 'FIS203', 1),
(14, 0, 0, 1, 'Leopoldo', 'Gostei bastante dessa materia', 0, 'FIS203', 1),
(15, 0, 0, 1, 'Alvaro', 'Aprendi tudo sobre a quarta dimensao', 0, 'FIS203', 1),
(16, 0, 0, 1, 'Carlos Osorio', 'Foi incrivel demais', 0, 'FIS203', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoareageavaliacao`
--

DROP TABLE IF EXISTS `pessoareageavaliacao`;
CREATE TABLE IF NOT EXISTS `pessoareageavaliacao` (
  `idreacao` int(11) NOT NULL AUTO_INCREMENT,
  `reacao` tinyint(1) NOT NULL,
  `idpessoareagiu` int(11) NOT NULL,
  `IDavaliacaoReagida` int(11) NOT NULL,
  PRIMARY KEY (`idreacao`),
  KEY `pessoa_fk` (`idpessoareagiu`) USING BTREE,
  KEY `avaliacaofk` (`IDavaliacaoReagida`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `disciplinasugerida`
--
ALTER TABLE `disciplinasugerida`
  ADD CONSTRAINT `IDusuarioSugeriu` FOREIGN KEY (`IDusuarioSugeriu`) REFERENCES `pessoa` (`idpessoa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `pessoaavaliadisciplina`
--
ALTER TABLE `pessoaavaliadisciplina`
  ADD CONSTRAINT `CodigoDisc` FOREIGN KEY (`CodigoDisc`) REFERENCES `disciplina` (`Codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `IdPessoa` FOREIGN KEY (`IdPessoa`) REFERENCES `pessoa` (`idpessoa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `pessoareageavaliacao`
--
ALTER TABLE `pessoareageavaliacao`
  ADD CONSTRAINT `IDavaliacaoReagida` FOREIGN KEY (`IDavaliacaoReagida`) REFERENCES `pessoaavaliadisciplina` (`IdAvaliacao`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idpessoareagiu` FOREIGN KEY (`idpessoareagiu`) REFERENCES `pessoa` (`idpessoa`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
