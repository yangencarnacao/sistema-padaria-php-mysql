-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 16/08/2024 às 20:06
-- Versão do servidor: 8.3.0
-- Versão do PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `padaria`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoria` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `categoria`, `preco`) VALUES
(1, 'Pão Francês', 'Pães', 2.50),
(2, 'Pão Integral', 'Pães', 3.50),
(3, 'Pacote de Pão de Forma', 'Pães', 8.00),
(4, 'Pão de Centeio', 'Pães', 5.50),
(5, 'Broa de milho', 'Doces', 3.50),
(6, 'Bolo de Chocolate', 'Doces', 18.00),
(7, 'Tortinha de Limão', 'Doces', 8.50),
(8, 'Brigadeiro', 'Doces', 3.00),
(9, 'Quindim', 'Doces', 5.00),
(10, 'Pastel', 'Salgados', 6.50),
(11, 'Empada de Frango', 'Salgados', 4.00),
(12, 'Empadão', 'Salgados', 6.50),
(13, 'Quiche de Queijo', 'Salgados', 10.50),
(14, 'Esfiha', 'Salgados', 4.00);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
