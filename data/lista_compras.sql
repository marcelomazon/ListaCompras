-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Tempo de geração: 11/08/2016 às 16:49
-- Versão do servidor: 5.6.15-log
-- Versão do PHP: 5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `compras`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `lista`
--

CREATE TABLE IF NOT EXISTS `lista` (
  `cd_lista` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `nm_lista` varchar(50) NOT NULL,
  `dt_cadastro` datetime NOT NULL,
  PRIMARY KEY (`cd_lista`),
  UNIQUE KEY `nm_lista` (`nm_lista`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='listas de compras' AUTO_INCREMENT=5 ;

--
-- Fazendo dump de dados para tabela `lista`
--

INSERT INTO `lista` (`cd_lista`, `nm_lista`, `dt_cadastro`) VALUES
(1, 'Mercado', '2016-08-10 14:54:47'),
(2, 'Farmácia', '2016-08-10 14:55:05'),
(3, 'Teste1', '2016-08-10 15:18:14');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE IF NOT EXISTS `produto` (
  `cd_produto` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `cd_lista` int(5) unsigned NOT NULL,
  `nm_produto` varchar(50) NOT NULL,
  `qt_produto` int(3) unsigned NOT NULL,
  `vl_produto` decimal(10,2) NOT NULL,
  `id_cesta` smallint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cd_produto`),
  KEY `cd_lista` (`cd_lista`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='produtos para compras' AUTO_INCREMENT=17 ;

--
-- Fazendo dump de dados para tabela `produto`
--

INSERT INTO `produto` (`cd_produto`, `cd_lista`, `nm_produto`, `qt_produto`, `vl_produto`, `id_cesta`) VALUES
(1, 1, 'pão', 1, '2.00', 0),
(2, 1, 'arroz', 2, '4.50', 0),
(3, 1, 'macarrão', 1, '10.50', 0),
(4, 1, 'vinho', 3, '27.90', 0),
(5, 2, 'chá', 1, '3.20', 0),
(6, 3, 'teste1', 5, '7.00', 0),
(7, 3, 'teste10', 6, '35.90', 0),
(8, 3, 'teste11', 6, '11.80', 0),
(9, 3, 'teste2', 10, '6.00', 0),
(10, 3, 'teste3', 19, '13.00', 0),
(11, 3, 'teste4', 18, '13.00', 0),
(12, 3, 'teste5', 45, '6.00', 0),
(13, 3, 'teste6', 7, '32.00', 0),
(14, 3, 'teste7', 5, '10.00', 0),
(15, 3, 'teste8', 7, '3.00', 0),
(16, 3, 'teste9', 59, '10.00', 0);

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `fk_lista_produto` FOREIGN KEY (`cd_lista`) REFERENCES `lista` (`cd_lista`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;