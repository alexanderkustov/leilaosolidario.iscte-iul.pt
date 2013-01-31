-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 18, 2013 at 04:11 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `leilao`
--

-- --------------------------------------------------------

--
-- Table structure for table `licitacao`
--

CREATE TABLE IF NOT EXISTS `licitacao` (
  `id_licitacao` int(11) NOT NULL AUTO_INCREMENT,
  `nome` text NOT NULL,
  `email` text NOT NULL,
  `nif` int(11) NOT NULL,
  `morada` text NOT NULL,
  `localidade` text NOT NULL,
  `codpostal` text NOT NULL,
  `relacao` text NOT NULL,
  `valor` double NOT NULL,
  `id_quadro` int(11) NOT NULL,
  PRIMARY KEY (`id_licitacao`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `quadros`
--

CREATE TABLE IF NOT EXISTS `quadros` (
  `id_quadro` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) CHARACTER SET utf8 NOT NULL,
  `info` text NOT NULL,
  `preco_actual` int(11) NOT NULL,
  `img_url` text NOT NULL,
  PRIMARY KEY (`id_quadro`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `quadros`
--

INSERT INTO `quadros` (`id_quadro`, `nome`, `info`, `preco_actual`, `img_url`) VALUES
(3, 'Nem Toda a pressão pode ser contida', 'Margarida Malheiro - Acrílico/Vieux-Chiene/Casca De Ovo/Cola Branca/Laca S/Tela - (50 cm X 60 cm)\r\n', 50, 'img/photo-4.JPG'),
(4, 'Sem Título', 'Dina Moura - Técnica Mista (Aguarela E Guache Sobre Papel) - (60 cm X 45 cm)\r\n', 50, 'img/photo-5.JPG'),
(5, 'Here They Come', 'Paulo Afonso - Acrílico Sobre Tela - (90 cm X 90 cm)', 50, 'img/photo-2.JPG'),
(6, 'N.º3 Da Série Rupestre', 'Lucrécia Alves - Tríptico Acrílico Sobre Tela', 50, 'img/photo-1.JPG');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
