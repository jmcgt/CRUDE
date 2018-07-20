-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 20-Jul-2018 às 00:47
-- Versão do servidor: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crude`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_pessoa` (IN `p_id` INT)  BEGIN
 UPDATE pessoas SET status = 2 where id = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_pessoa` (IN `p_nome` VARCHAR(150), IN `p_email` VARCHAR(50))  BEGIN
	INSERT INTO pessoas (nome, email, status) values (p_nome, p_email, 1);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_pessoa` (IN `p_nome` VARCHAR(150), IN `p_email` VARCHAR(50), IN `p_id` INT)  BEGIN
	UPDATE pessoas SET nome = p_nome, email = p_email WHERE id = p_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoas`
--

CREATE TABLE `pessoas` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pessoas`
--

INSERT INTO `pessoas` (`id`, `nome`, `email`, `status`) VALUES
(1, 'João', 'Marcos', 2),
(2, 'oi', 'lalalala@lalala.com', 2),
(3, 'nome tal', 'laralralra@laalrla.com', 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_ps`
-- (See below for the actual view)
--
CREATE TABLE `v_ps` (
`id` int(11)
,`nome` varchar(150)
,`email` varchar(50)
,`status` int(11)
);

-- --------------------------------------------------------

--
-- Structure for view `v_ps`
--
DROP TABLE IF EXISTS `v_ps`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_ps`  AS  select `pessoas`.`id` AS `id`,`pessoas`.`nome` AS `nome`,`pessoas`.`email` AS `email`,`pessoas`.`status` AS `status` from `pessoas` where (`pessoas`.`status` = 1) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pessoas`
--
ALTER TABLE `pessoas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pessoas`
--
ALTER TABLE `pessoas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
