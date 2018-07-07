-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 07-Jul-2018 às 23:42
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
-- Estrutura da tabela `departamento`
--

DROP TABLE IF EXISTS `departamento`;
CREATE TABLE IF NOT EXISTS `departamento` (
  `Departamento` varchar(10) NOT NULL,
  `Centro` varchar(10) NOT NULL,
  PRIMARY KEY (`Departamento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `departamento`
--

INSERT INTO `departamento` (`Departamento`, `Centro`) VALUES
('DAU', 'CCE'),
('DEA', 'CCA'),
('DEC', 'CCE'),
('DEF', 'CCA'),
('DEL', 'CCE'),
('DEP', 'CCE'),
('DEQ', 'CCE'),
('DER', 'CCA'),
('DET', 'CCE'),
('DFP', 'CCA'),
('DFT', 'CCA'),
('DMA', 'CCE'),
('DPF', 'CCE'),
('DPI', 'CCE'),
('DPS', 'CCA'),
('DTA', 'CCE'),
('DZO', 'CCA');

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

DROP TABLE IF EXISTS `disciplina`;
CREATE TABLE IF NOT EXISTS `disciplina` (
  `Codigo` varchar(10) NOT NULL,
  `Nome` varchar(100) NOT NULL,
  `Departamento` varchar(10) NOT NULL,
  `RecomendacaoP` int(11) NOT NULL,
  `RecomendacaoN` int(11) NOT NULL,
  `TotalDeAvaliacoes` int(11) NOT NULL,
  `SomaNotaUtilidade` int(11) NOT NULL,
  `SomaNotaFacilidade` int(11) NOT NULL,
  PRIMARY KEY (`Codigo`),
  KEY `dep_fk` (`Departamento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `disciplina`
--

INSERT INTO `disciplina` (`Codigo`, `Nome`, `Departamento`, `RecomendacaoP`, `RecomendacaoN`, `TotalDeAvaliacoes`, `SomaNotaUtilidade`, `SomaNotaFacilidade`) VALUES
('INF213', 'Estruturas de Dados', 'DPI', 2, 0, 2, 6, 6),
('INF220', 'Banco de Dados 1', 'DPI', 0, 0, 0, 0, 0),
('INF280', 'Pesquisa Operacional 1', 'DPI', 0, 0, 0, 0, 0),
('INF322', 'Banco de Dados 2', 'DPI', 0, 0, 0, 0, 0),
('INF452', 'Redes de Computadores', 'DPI', 0, 0, 0, 0, 0),
('MAT140', 'Calculo 1', 'DMA', 0, 0, 0, 0, 0),
('MAT147', 'Calculo 2', 'DMA', 0, 0, 0, 0, 0),
('MAT241', 'Calculo 3', 'DMA', 0, 0, 0, 0, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`Nome`, `Curso`, `DataCadastro`, `idpessoa`) VALUES
('Anonimo', '', '2018-07-01', 1),
('Lucas ', 'Ciencia da Computacao', '2018-07-01', 2),
('Henrique', 'Ciencia da Computacao', '2018-07-01', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoaavaliadisciplina`
--

DROP TABLE IF EXISTS `pessoaavaliadisciplina`;
CREATE TABLE IF NOT EXISTS `pessoaavaliadisciplina` (
  `IdAvaliacao` int(11) NOT NULL AUTO_INCREMENT,
  `Utilidade` int(11) NOT NULL,
  `Facilidade` int(11) NOT NULL,
  `Recomenda` tinyint(1) NOT NULL,
  `Professor` varchar(100) NOT NULL,
  `Comentario` varchar(255) NOT NULL,
  `ReacoesNegativas` int(11) NOT NULL,
  `CodigoDisc` varchar(10) NOT NULL,
  `IdPessoa` int(11) NOT NULL,
  PRIMARY KEY (`IdAvaliacao`),
  KEY `usuario_fk` (`IdPessoa`),
  KEY `discplinafk` (`CodigoDisc`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pessoaavaliadisciplina`
--

INSERT INTO `pessoaavaliadisciplina` (`IdAvaliacao`, `Utilidade`, `Facilidade`, `Recomenda`, `Professor`, `Comentario`, `ReacoesNegativas`, `CodigoDisc`, `IdPessoa`) VALUES
(51, 4, 3, 1, '', '', 0, 'INF213', 1),
(52, 5, 3, 1, 'Marcus Vinicius', '', 0, 'INF213', 2);

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `professores`
--

DROP TABLE IF EXISTS `professores`;
CREATE TABLE IF NOT EXISTS `professores` (
  `docente` varchar(100) NOT NULL,
  `dep` varchar(10) NOT NULL,
  PRIMARY KEY (`docente`),
  KEY `dep_fk` (`dep`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `professores`
--

INSERT INTO `professores` (`docente`, `dep`) VALUES
('Abílio Lemos', 'DMA'),
('Ady Cambraia', 'DMA'),
('Alexandre Miranda', 'DMA'),
('Allan de Oliveira', 'DMA'),
('Amarisio da Silva', 'DMA'),
('Anderson Luis', 'DMA'),
('Anderson Tiago', 'DMA'),
('Andre Junqueira', 'DMA'),
('Ariane Piovezan', 'DMA'),
('Bhavinkumar Kishor', 'DMA'),
('Braz Mouro', 'DMA'),
('Bulmer Mejia', 'DMA'),
('Caroline Mendes', 'DMA'),
('Catarina Mendes', 'DMA'),
('Cristiane Botelho', 'DMA'),
('Diogo da Silva', 'DMA'),
('Edir Junior', 'DMA'),
('Edson José', 'DMA'),
('Enoch Humberto', 'DMA'),
('Fernanda Moura', 'DMA'),
('Gláucia Aparecida', 'DMA'),
('Jéssyca Lange', 'DMA'),
('Lana Mara', 'DMA'),
('Lia Feital', 'DMA'),
('Lilian Neves', 'DMA'),
('Luciana Maria', 'DMA'),
('Margareth da Silva', 'DMA'),
('Marinês Guerreiro', 'DMA'),
('Marli Duffles', 'DMA'),
('Mercio Botelho Faria', 'DMA'),
('Oscar Alexander', 'DMA'),
('Pouya Mehdipour', 'DMA'),
('Rogério Carvalho', 'DMA'),
('Rosane Soares', 'DMA'),
('Sandro Vieira', 'DMA'),
('Sonia Fernandes', 'DMA'),
('Walter Vargas', 'DMA'),
('Alcione de Paiva', 'DPI'),
('Andre Gustavo', 'DPI'),
('Carlos de Castro', 'DPI'),
('Giovanni Ventorim', 'DPI'),
('Jose Elias Arroyo', 'DPI'),
('Jugurta Lisboa', 'DPI'),
('Leacir Nogueira', 'DPI'),
('Levi Henrique', 'DPI'),
('Lucas Francisco', 'DPI'),
('Luiz Carlos', 'DPI'),
('Marcos Henrique', 'DPI'),
('Marcus Vinicius', 'DPI'),
('Mauro Nacif', 'DPI'),
('Ricardo dos Santos', 'DPI'),
('Sabrina de Azevedo', 'DPI'),
('Salles Viana', 'DPI'),
('Vitor Barbosa', 'DPI'),
('Vladimir Oliveira', 'DPI');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD CONSTRAINT `dep_fk` FOREIGN KEY (`Departamento`) REFERENCES `departamento` (`Departamento`) ON DELETE NO ACTION ON UPDATE CASCADE;

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

--
-- Limitadores para a tabela `professores`
--
ALTER TABLE `professores`
  ADD CONSTRAINT `dep` FOREIGN KEY (`dep`) REFERENCES `departamento` (`Departamento`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
