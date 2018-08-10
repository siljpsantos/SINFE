-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 15-Set-2016 às 12:14
-- Versão do servidor: 5.6.13
-- versão do PHP: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `db_enquete`
--
CREATE DATABASE IF NOT EXISTS `db_enquete` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_enquete`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_jogador`
--

CREATE TABLE IF NOT EXISTS `tab_jogador` (
  `id_jogador` int(11) NOT NULL AUTO_INCREMENT,
  `nome_jogador` varchar(200) DEFAULT NULL,
  `posicao_jogador` varchar(100) DEFAULT NULL,
  `escola_jogador` varchar(200) DEFAULT NULL,
  `num_votos_jogador` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_jogador`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `tab_jogador`
--

INSERT INTO `tab_jogador` (`id_jogador`, `nome_jogador`, `posicao_jogador`, `escola_jogador`, `num_votos_jogador`) VALUES
(1, 'Silvio Santos', 'Goleiro', 'escola 1', 13);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
