-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2020 at 01:01 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `callsys`
--

-- --------------------------------------------------------

--
-- Table structure for table `equipamento`
--

CREATE TABLE `equipamento` (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL,
  `nome` varchar(50) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `data_hora_cadastro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `equipamento`
--

INSERT INTO `equipamento` (`id`, `nome`, `ativo`, `data_hora_cadastro`) VALUES
(0000000001, 'Mouse', 1, '2020-09-09 12:26:03'),
(0000000002, 'aaaaaaaa', 0, '2020-09-11 22:07:41'),
(0000000003, 'aaaaaaaa', 0, '2020-09-11 22:07:56'),
(0000000004, 'cad', 0, '2020-09-11 22:09:16'),
(0000000005, 'aaaaaaaa', 1, '2020-09-11 22:09:54'),
(0000000006, 'aaaaaaaaaa', 0, '2020-09-11 22:09:57'),
(0000000007, '1', 1, '2020-09-12 12:14:23'),
(0000000008, '1', 1, '2020-09-12 14:53:05');

-- --------------------------------------------------------

--
-- Table structure for table `equipamento_solicitacao`
--

CREATE TABLE `equipamento_solicitacao` (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL,
  `id_solicitacao` int(10) UNSIGNED ZEROFILL NOT NULL,
  `id_equipamento` int(10) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `equipamento_solicitacao`
--

INSERT INTO `equipamento_solicitacao` (`id`, `id_solicitacao`, `id_equipamento`) VALUES
(0000000001, 0000000001, 0000000001);

-- --------------------------------------------------------

--
-- Table structure for table `funcao`
--

CREATE TABLE `funcao` (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL,
  `nome` varchar(50) NOT NULL,
  `ativo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `funcao`
--

INSERT INTO `funcao` (`id`, `nome`, `ativo`) VALUES
(0000000001, 'Desenvolvedor', 1),
(0000000002, 'gregergreger', 1),
(0000000003, 'trgerggtrggr', 0),
(0000000004, 'qqqqqqqqq', 1),
(0000000005, 'qqqqqqqqqq', 0),
(0000000006, 'aaaaaaaaaaaaaaaaaaaa', 1),
(0000000007, 'aaaaaaaaaaaaaaaaaaaa', 0),
(0000000008, 'funcao teste nrernernree', 0),
(0000000009, 'funcao teste nrernernree', 0),
(0000000010, 'funcao teste nrernernree', 0),
(0000000011, 'batata', 0),
(0000000012, 'aaaaaaaaa', 1),
(0000000013, 'aaaaaaaaa', 0),
(0000000014, 'wwwwww', 1),
(0000000015, 'wwwwwwww', 0),
(0000000016, 'aaaaaaaaa', 1),
(0000000017, 'aaaaaaaaa', 0),
(0000000018, 'aaaaaaaaaa', 0),
(0000000019, 'aaaaaaaaaa', 0),
(0000000020, '1', 1),
(0000000021, '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nivel_acesso`
--

CREATE TABLE `nivel_acesso` (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL,
  `nome` varchar(50) NOT NULL,
  `ativo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nivel_acesso`
--

INSERT INTO `nivel_acesso` (`id`, `nome`, `ativo`) VALUES
(0000000001, 'Desenvolvedor', 1),
(0000000002, 'gergregreger', 1),
(0000000003, 'gregregrreg', 0),
(0000000004, 'aaaaaaaaaaaaaaaa', 1),
(0000000005, 'aaaaaaaaaaaaaaaaaaa', 0),
(0000000006, 'bbbbbbb', 1),
(0000000007, 'bbbbbbbbb', 0),
(0000000008, 'wwwww', 1),
(0000000009, 'wwwwww', 0),
(0000000010, 'aaaaaaaa', 1),
(0000000011, 'aaaaaaaa', 0),
(0000000012, 'aaaaaaaaaa', 0),
(0000000013, 'aaaaaaaa', 0),
(0000000014, '1', 1),
(0000000015, '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `setor`
--

CREATE TABLE `setor` (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL,
  `nome` varchar(50) NOT NULL,
  `ativo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setor`
--

INSERT INTO `setor` (`id`, `nome`, `ativo`) VALUES
(0000000001, 'Setor Desenvolvimento', 1),
(0000000002, 'adsa', 1),
(0000000003, 'adsa', 1),
(0000000004, 'adsa', 1),
(0000000005, 'adsa', 1),
(0000000006, 'adsa', 1),
(0000000007, 'ffwewfw', 1),
(0000000008, 'ffwewfw', 1),
(0000000009, 'fefewfewfefwe', 1),
(0000000010, 'fefewfewfefwe', 1),
(0000000011, 'fefewfewfefwe', 1),
(0000000012, 'Setor Teste', 1),
(0000000013, 'ferfefew', 1),
(0000000014, 'Setor 111111', 1),
(0000000015, 'fefwefewefwefew', 1),
(0000000016, 'regreger', 1),
(0000000017, 'setor', 1),
(0000000018, 'setor nao ativo', 1),
(0000000019, 'adsafewfewf', 1),
(0000000020, 'efwefew', 1),
(0000000021, 'efwefew', 0),
(0000000022, 'efwefew', 0),
(0000000023, 'gregregreergerge', 1),
(0000000024, 'thrthtr', 0),
(0000000025, 'fewfwewefwe', 1),
(0000000026, 'vazio', 0),
(0000000027, 'vazio', 0),
(0000000028, 'nao vazio', 1),
(0000000029, 'setor ativo 1', 1),
(0000000030, 'setor inativo 1', 0),
(0000000031, 'ewfwefewf', 1),
(0000000032, 'fwefewfwe', 0),
(0000000033, 'aaaaaaaaaaaaaaaaaaa', 1),
(0000000034, 'bbbbbbbbb', 0),
(0000000035, 'gergrege', 0),
(0000000036, 'gergree', 1),
(0000000037, 'aaaaaaaaaaaaaa', 1),
(0000000038, 'aaaaaaaaaaaaaa', 1),
(0000000039, 'aaaaaaaaaaaaaa', 1),
(0000000040, 'aaaaaaaaaaaaaa', 1),
(0000000041, 'aaaaaaaaaaaaaa', 1),
(0000000042, 'aaaaaaaaaaaaaa', 1),
(0000000043, 'aaaaaaaaaaaaaa', 1),
(0000000044, 'aaaaaaaaaaaaaa', 1),
(0000000045, 'aaaaaaaaaaaaaa', 1),
(0000000046, 'aaaaaaaaa', 0),
(0000000047, 'aaaaaaaaaaa', 1),
(0000000048, 'wwwwwww', 1),
(0000000049, 'wwwwww', 0),
(0000000050, 'aaaaaaaaaaa', 1),
(0000000051, 'aaaaaaaaa', 0),
(0000000052, 'aaaaaaa', 0),
(0000000053, 'aaaaaaaaaaa', 0),
(0000000054, '1', 1),
(0000000055, '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `solicitacao`
--

CREATE TABLE `solicitacao` (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL,
  `id_usuario` int(10) UNSIGNED ZEROFILL NOT NULL,
  `estado` int(10) UNSIGNED NOT NULL,
  `descricao_problema` varchar(1000) DEFAULT NULL,
  `data_hora_solicitacao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `solicitacao`
--

INSERT INTO `solicitacao` (`id`, `id_usuario`, `estado`, `descricao_problema`, `data_hora_solicitacao`) VALUES
(0000000001, 0000000001, 1, 'Mouse com defeito', '2020-09-09 12:26:27');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL,
  `id_setor` int(10) UNSIGNED ZEROFILL NOT NULL,
  `id_funcao` int(10) UNSIGNED ZEROFILL NOT NULL,
  `id_nivel_acesso` int(10) UNSIGNED ZEROFILL NOT NULL,
  `nome` varchar(100) NOT NULL,
  `usuario` varchar(10) NOT NULL,
  `senha` varchar(10) NOT NULL,
  `ativo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `id_setor`, `id_funcao`, `id_nivel_acesso`, `nome`, `usuario`, `senha`, `ativo`) VALUES
(0000000001, 0000000001, 0000000001, 0000000001, 'Administrador', 'a', 'a', 1),
(0000000002, 0000000001, 0000000001, 0000000001, 'q', 'q', 'q', 1),
(0000000003, 0000000001, 0000000001, 0000000001, 'z', 'z', 'z', 1),
(0000000004, 0000000001, 0000000001, 0000000001, 'w', 'w', 'w', 1),
(0000000005, 0000000001, 0000000001, 0000000001, 'd', 'd', 'd', 0),
(0000000006, 0000000001, 0000000001, 0000000001, 'aaa', 'aaa', 'aaa', 1),
(0000000007, 0000000001, 0000000001, 0000000001, 'aaaa', 'aaaa', 'aaaa', 0),
(0000000008, 0000000001, 0000000001, 0000000001, 'aaaaaaaa', 'aaaaaaaaaa', 'aaaaaaaaaa', 0),
(0000000009, 0000000001, 0000000001, 0000000001, 'adadaad', 'dadadad', 'dadadaad', 1),
(0000000010, 0000000001, 0000000001, 0000000001, '1', '1', '1', 1),
(0000000012, 0000000001, 0000000001, 0000000001, '111', '111', '111', 1),
(0000000013, 0000000001, 0000000001, 0000000001, '1', '1', '1', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `equipamento`
--
ALTER TABLE `equipamento`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipamento_solicitacao`
--
ALTER TABLE `equipamento_solicitacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_solicitacao` (`id_solicitacao`),
  ADD KEY `id_equipamento` (`id_equipamento`);

--
-- Indexes for table `funcao`
--
ALTER TABLE `funcao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nivel_acesso`
--
ALTER TABLE `nivel_acesso`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setor`
--
ALTER TABLE `setor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `solicitacao`
--
ALTER TABLE `solicitacao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_setor` (`id_setor`),
  ADD KEY `id_funcao` (`id_funcao`),
  ADD KEY `id_nivel_acesso` (`id_nivel_acesso`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `equipamento`
--
ALTER TABLE `equipamento`
  MODIFY `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `equipamento_solicitacao`
--
ALTER TABLE `equipamento_solicitacao`
  MODIFY `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `funcao`
--
ALTER TABLE `funcao`
  MODIFY `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `nivel_acesso`
--
ALTER TABLE `nivel_acesso`
  MODIFY `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `setor`
--
ALTER TABLE `setor`
  MODIFY `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `solicitacao`
--
ALTER TABLE `solicitacao`
  MODIFY `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `equipamento_solicitacao`
--
ALTER TABLE `equipamento_solicitacao`
  ADD CONSTRAINT `equipamento_solicitacao_ibfk_1` FOREIGN KEY (`id_solicitacao`) REFERENCES `solicitacao` (`id`),
  ADD CONSTRAINT `equipamento_solicitacao_ibfk_2` FOREIGN KEY (`id_equipamento`) REFERENCES `equipamento` (`id`);

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_setor`) REFERENCES `setor` (`id`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`id_funcao`) REFERENCES `funcao` (`id`),
  ADD CONSTRAINT `usuario_ibfk_3` FOREIGN KEY (`id_nivel_acesso`) REFERENCES `nivel_acesso` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
