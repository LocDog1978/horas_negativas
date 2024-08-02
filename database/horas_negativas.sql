-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02/08/2024 às 15:59
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `horas_negativas`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `horas_negativas`
--

CREATE TABLE `horas_negativas` (
  `id` int(11) NOT NULL,
  `fk_local` int(11) NOT NULL,
  `diurno` int(11) DEFAULT NULL,
  `noturno` int(11) DEFAULT NULL,
  `data` date NOT NULL,
  `justificativa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `horas_negativas`
--

INSERT INTO `horas_negativas` (`id`, `fk_local`, `diurno`, `noturno`, `data`, `justificativa`) VALUES
(1, 7, 12, NULL, '2024-01-25', ''),
(2, 7, NULL, NULL, '2024-01-26', ''),
(3, 7, NULL, NULL, '2024-01-27', ''),
(4, 7, NULL, NULL, '2024-01-28', ''),
(5, 7, NULL, NULL, '2024-01-29', ''),
(6, 7, NULL, NULL, '2024-01-30', ''),
(7, 7, NULL, NULL, '2024-01-31', ''),
(8, 7, NULL, NULL, '2024-02-01', ''),
(9, 7, NULL, NULL, '2024-02-02', ''),
(10, 7, NULL, NULL, '2024-02-03', ''),
(11, 7, NULL, NULL, '2024-02-04', ''),
(12, 7, NULL, NULL, '2024-02-05', ''),
(13, 7, NULL, NULL, '2024-02-06', ''),
(14, 7, NULL, NULL, '2024-02-07', ''),
(15, 7, NULL, NULL, '2024-02-08', ''),
(16, 7, NULL, NULL, '2024-02-09', ''),
(17, 7, NULL, NULL, '2024-02-10', ''),
(18, 7, NULL, NULL, '2024-02-11', ''),
(19, 7, NULL, NULL, '2024-02-12', ''),
(20, 7, NULL, NULL, '2024-02-13', ''),
(21, 7, NULL, NULL, '2024-02-14', ''),
(22, 7, NULL, NULL, '2024-02-15', ''),
(23, 7, NULL, NULL, '2024-02-16', ''),
(24, 7, NULL, NULL, '2024-02-17', ''),
(25, 7, NULL, NULL, '2024-02-18', ''),
(26, 7, NULL, NULL, '2024-02-19', ''),
(27, 7, NULL, NULL, '2024-02-20', ''),
(28, 7, NULL, NULL, '2024-02-21', ''),
(29, 7, NULL, NULL, '2024-02-22', ''),
(30, 7, NULL, NULL, '2024-02-23', ''),
(31, 7, NULL, NULL, '2024-02-24', ''),
(32, 1, 4, 1, '2024-01-25', 'caleidoscópio'),
(33, 1, 2, 42, '2024-01-26', 'lamartine babo alegrete'),
(34, 1, 4, NULL, '2024-01-27', 'estava vazio'),
(35, 1, 7, 20, '2024-01-28', 'bilubilubilu tetéia'),
(36, 1, 1, 2, '2024-01-29', 'cu de faraó'),
(37, 1, NULL, NULL, '2024-01-30', ''),
(38, 1, NULL, NULL, '2024-01-31', ''),
(39, 1, NULL, NULL, '2024-02-01', ''),
(40, 1, NULL, NULL, '2024-02-02', ''),
(41, 1, NULL, NULL, '2024-02-03', ''),
(42, 1, NULL, NULL, '2024-02-04', ''),
(43, 1, NULL, NULL, '2024-02-05', ''),
(44, 1, NULL, NULL, '2024-02-06', ''),
(45, 1, NULL, NULL, '2024-02-07', ''),
(46, 1, NULL, NULL, '2024-02-08', ''),
(47, 1, NULL, NULL, '2024-02-09', ''),
(48, 1, NULL, NULL, '2024-02-10', ''),
(49, 1, NULL, NULL, '2024-02-11', ''),
(50, 1, NULL, NULL, '2024-02-12', ''),
(51, 1, NULL, NULL, '2024-02-13', ''),
(52, 1, NULL, NULL, '2024-02-14', ''),
(53, 1, NULL, NULL, '2024-02-15', ''),
(54, 1, NULL, NULL, '2024-02-16', ''),
(55, 1, NULL, NULL, '2024-02-17', ''),
(56, 1, NULL, NULL, '2024-02-18', ''),
(57, 1, NULL, NULL, '2024-02-19', ''),
(58, 1, NULL, NULL, '2024-02-20', ''),
(59, 1, NULL, NULL, '2024-02-21', ''),
(60, 1, NULL, NULL, '2024-02-22', ''),
(61, 1, NULL, NULL, '2024-02-23', ''),
(62, 1, NULL, NULL, '2024-02-24', 'last number '),
(63, 1, 7, NULL, '2024-02-25', ''),
(64, 1, NULL, NULL, '2024-02-26', ''),
(65, 1, NULL, NULL, '2024-02-27', ''),
(66, 1, NULL, NULL, '2024-02-28', ''),
(67, 1, NULL, NULL, '2024-02-29', ''),
(68, 1, NULL, NULL, '2024-03-01', ''),
(69, 1, NULL, NULL, '2024-03-02', ''),
(70, 1, NULL, NULL, '2024-03-03', ''),
(71, 1, NULL, NULL, '2024-03-04', ''),
(72, 1, NULL, NULL, '2024-03-05', ''),
(73, 1, NULL, NULL, '2024-03-06', ''),
(74, 1, NULL, NULL, '2024-03-07', ''),
(75, 1, NULL, NULL, '2024-03-08', ''),
(76, 1, NULL, NULL, '2024-03-09', ''),
(77, 1, NULL, NULL, '2024-03-10', ''),
(78, 1, NULL, NULL, '2024-03-11', ''),
(79, 1, NULL, NULL, '2024-03-12', ''),
(80, 1, NULL, NULL, '2024-03-13', ''),
(81, 1, NULL, NULL, '2024-03-14', ''),
(82, 1, NULL, NULL, '2024-03-15', ''),
(83, 1, NULL, NULL, '2024-03-16', ''),
(84, 1, NULL, NULL, '2024-03-17', ''),
(85, 1, NULL, NULL, '2024-03-18', ''),
(86, 1, NULL, NULL, '2024-03-19', ''),
(87, 1, NULL, NULL, '2024-03-20', ''),
(88, 1, NULL, NULL, '2024-03-21', ''),
(89, 1, NULL, NULL, '2024-03-22', ''),
(90, 1, NULL, NULL, '2024-03-23', ''),
(91, 1, NULL, NULL, '2024-03-24', ''),
(92, 1, 42, 42, '2024-06-25', ''),
(93, 1, NULL, NULL, '2024-06-26', ''),
(94, 1, 7, 2, '2024-06-27', ''),
(95, 1, NULL, NULL, '2024-06-28', ''),
(96, 1, NULL, NULL, '2024-06-29', ''),
(97, 1, NULL, NULL, '2024-06-30', ''),
(98, 1, NULL, NULL, '2024-07-01', ''),
(99, 1, NULL, NULL, '2024-07-02', ''),
(100, 1, NULL, NULL, '2024-07-03', ''),
(101, 1, NULL, NULL, '2024-07-04', ''),
(102, 1, NULL, NULL, '2024-07-05', ''),
(103, 1, NULL, NULL, '2024-07-06', ''),
(104, 1, NULL, NULL, '2024-07-07', ''),
(105, 1, NULL, NULL, '2024-07-08', ''),
(106, 1, NULL, NULL, '2024-07-09', ''),
(107, 1, NULL, NULL, '2024-07-10', ''),
(108, 1, NULL, NULL, '2024-07-11', ''),
(109, 1, NULL, NULL, '2024-07-12', ''),
(110, 1, 12, 36, '2024-07-13', ''),
(111, 1, NULL, NULL, '2024-07-14', ''),
(112, 1, NULL, NULL, '2024-07-15', ''),
(113, 1, NULL, NULL, '2024-07-16', ''),
(114, 1, NULL, NULL, '2024-07-17', ''),
(115, 1, NULL, NULL, '2024-07-18', ''),
(116, 1, NULL, NULL, '2024-07-19', ''),
(117, 1, NULL, NULL, '2024-07-20', ''),
(118, 1, NULL, NULL, '2024-07-21', ''),
(119, 1, NULL, NULL, '2024-07-22', ''),
(120, 1, NULL, NULL, '2024-07-23', ''),
(121, 1, NULL, NULL, '2024-07-24', ''),
(122, 12, 1000, NULL, '2024-06-25', ''),
(123, 12, NULL, NULL, '2024-06-26', ''),
(124, 12, NULL, NULL, '2024-06-27', ''),
(125, 12, NULL, NULL, '2024-06-28', ''),
(126, 12, NULL, NULL, '2024-06-29', ''),
(127, 12, NULL, NULL, '2024-06-30', ''),
(128, 12, NULL, NULL, '2024-07-01', ''),
(129, 12, NULL, NULL, '2024-07-02', ''),
(130, 12, NULL, NULL, '2024-07-03', ''),
(131, 12, NULL, NULL, '2024-07-04', ''),
(132, 12, NULL, NULL, '2024-07-05', ''),
(133, 12, NULL, NULL, '2024-07-06', ''),
(134, 12, NULL, NULL, '2024-07-07', ''),
(135, 12, NULL, NULL, '2024-07-08', ''),
(136, 12, NULL, NULL, '2024-07-09', ''),
(137, 12, NULL, NULL, '2024-07-10', ''),
(138, 12, NULL, NULL, '2024-07-11', ''),
(139, 12, NULL, NULL, '2024-07-12', ''),
(140, 12, NULL, NULL, '2024-07-13', ''),
(141, 12, NULL, NULL, '2024-07-14', ''),
(142, 12, NULL, NULL, '2024-07-15', ''),
(143, 12, NULL, NULL, '2024-07-16', ''),
(144, 12, NULL, NULL, '2024-07-17', ''),
(145, 12, NULL, NULL, '2024-07-18', ''),
(146, 12, NULL, NULL, '2024-07-19', ''),
(147, 12, NULL, NULL, '2024-07-20', ''),
(148, 12, NULL, NULL, '2024-07-21', ''),
(149, 12, NULL, NULL, '2024-07-22', ''),
(150, 12, NULL, NULL, '2024-07-23', ''),
(151, 12, NULL, NULL, '2024-07-24', ''),
(152, 2, NULL, NULL, '2024-06-25', ''),
(153, 2, NULL, NULL, '2024-06-26', ''),
(154, 2, NULL, NULL, '2024-06-27', ''),
(155, 2, NULL, NULL, '2024-06-28', ''),
(156, 2, NULL, NULL, '2024-06-29', ''),
(157, 2, 400, 500, '2024-06-30', ''),
(158, 2, NULL, NULL, '2024-07-01', ''),
(159, 2, NULL, NULL, '2024-07-02', ''),
(160, 2, NULL, NULL, '2024-07-03', ''),
(161, 2, NULL, NULL, '2024-07-04', ''),
(162, 2, NULL, NULL, '2024-07-05', ''),
(163, 2, NULL, NULL, '2024-07-06', ''),
(164, 2, NULL, NULL, '2024-07-07', ''),
(165, 2, NULL, NULL, '2024-07-08', ''),
(166, 2, NULL, NULL, '2024-07-09', ''),
(167, 2, NULL, NULL, '2024-07-10', ''),
(168, 2, NULL, NULL, '2024-07-11', ''),
(169, 2, NULL, NULL, '2024-07-12', ''),
(170, 2, NULL, NULL, '2024-07-13', ''),
(171, 2, NULL, NULL, '2024-07-14', ''),
(172, 2, NULL, NULL, '2024-07-15', ''),
(173, 2, NULL, NULL, '2024-07-16', ''),
(174, 2, NULL, NULL, '2024-07-17', ''),
(175, 2, NULL, NULL, '2024-07-18', ''),
(176, 2, NULL, NULL, '2024-07-19', ''),
(177, 2, NULL, NULL, '2024-07-20', ''),
(178, 2, NULL, NULL, '2024-07-21', ''),
(179, 2, NULL, NULL, '2024-07-22', ''),
(180, 2, NULL, NULL, '2024-07-23', ''),
(181, 2, NULL, NULL, '2024-07-24', ''),
(182, 4, NULL, NULL, '2024-03-25', ''),
(183, 4, NULL, NULL, '2024-03-26', ''),
(184, 4, NULL, NULL, '2024-03-27', ''),
(185, 4, NULL, NULL, '2024-03-28', ''),
(186, 4, NULL, NULL, '2024-03-29', ''),
(187, 4, NULL, NULL, '2024-03-30', ''),
(188, 4, NULL, NULL, '2024-03-31', ''),
(189, 4, NULL, NULL, '2024-04-01', ''),
(190, 4, NULL, NULL, '2024-04-02', ''),
(191, 4, NULL, NULL, '2024-04-03', ''),
(192, 4, NULL, NULL, '2024-04-04', ''),
(193, 4, NULL, NULL, '2024-04-05', ''),
(194, 4, NULL, NULL, '2024-04-06', ''),
(195, 4, 99, 12, '2024-04-07', ''),
(196, 4, NULL, NULL, '2024-04-08', ''),
(197, 4, NULL, NULL, '2024-04-09', ''),
(198, 4, NULL, NULL, '2024-04-10', ''),
(199, 4, NULL, NULL, '2024-04-11', ''),
(200, 4, NULL, NULL, '2024-04-12', ''),
(201, 4, NULL, NULL, '2024-04-13', ''),
(202, 4, NULL, NULL, '2024-04-14', ''),
(203, 4, NULL, NULL, '2024-04-15', ''),
(204, 4, NULL, NULL, '2024-04-16', ''),
(205, 4, NULL, NULL, '2024-04-17', ''),
(206, 4, NULL, NULL, '2024-04-18', ''),
(207, 4, NULL, NULL, '2024-04-19', ''),
(208, 4, NULL, NULL, '2024-04-20', ''),
(209, 4, NULL, NULL, '2024-04-21', ''),
(210, 4, NULL, NULL, '2024-04-22', ''),
(211, 4, NULL, NULL, '2024-04-23', ''),
(212, 4, NULL, NULL, '2024-04-24', ''),
(213, 5, 12, 24, '2024-06-25', ''),
(214, 5, NULL, NULL, '2024-06-26', ''),
(215, 5, NULL, NULL, '2024-06-27', ''),
(216, 5, NULL, NULL, '2024-06-28', ''),
(217, 5, NULL, NULL, '2024-06-29', ''),
(218, 5, NULL, NULL, '2024-06-30', ''),
(219, 5, NULL, NULL, '2024-07-01', ''),
(220, 5, NULL, NULL, '2024-07-02', ''),
(221, 5, NULL, NULL, '2024-07-03', ''),
(222, 5, NULL, NULL, '2024-07-04', ''),
(223, 5, NULL, NULL, '2024-07-05', ''),
(224, 5, NULL, NULL, '2024-07-06', ''),
(225, 5, NULL, NULL, '2024-07-07', ''),
(226, 5, NULL, NULL, '2024-07-08', ''),
(227, 5, NULL, NULL, '2024-07-09', ''),
(228, 5, NULL, NULL, '2024-07-10', ''),
(229, 5, NULL, NULL, '2024-07-11', ''),
(230, 5, NULL, NULL, '2024-07-12', ''),
(231, 5, NULL, NULL, '2024-07-13', ''),
(232, 5, NULL, NULL, '2024-07-14', ''),
(233, 5, NULL, NULL, '2024-07-15', ''),
(234, 5, NULL, NULL, '2024-07-16', ''),
(235, 5, NULL, NULL, '2024-07-17', ''),
(236, 5, NULL, NULL, '2024-07-18', ''),
(237, 5, NULL, NULL, '2024-07-19', ''),
(238, 5, NULL, NULL, '2024-07-20', ''),
(239, 5, NULL, NULL, '2024-07-21', ''),
(240, 5, NULL, NULL, '2024-07-22', ''),
(241, 5, NULL, NULL, '2024-07-23', ''),
(242, 5, NULL, NULL, '2024-07-24', ''),
(243, 1, NULL, NULL, '2024-03-25', ''),
(244, 1, NULL, NULL, '2024-03-26', ''),
(245, 1, NULL, NULL, '2024-03-27', ''),
(246, 1, NULL, NULL, '2024-03-28', ''),
(247, 1, NULL, NULL, '2024-03-29', ''),
(248, 1, NULL, NULL, '2024-03-30', ''),
(249, 1, NULL, NULL, '2024-03-31', ''),
(250, 1, NULL, NULL, '2024-04-01', ''),
(251, 1, NULL, NULL, '2024-04-02', ''),
(252, 1, NULL, NULL, '2024-04-03', ''),
(253, 1, NULL, NULL, '2024-04-04', ''),
(254, 1, NULL, NULL, '2024-04-05', ''),
(255, 1, NULL, NULL, '2024-04-06', ''),
(256, 1, NULL, NULL, '2024-04-07', ''),
(257, 1, NULL, NULL, '2024-04-08', ''),
(258, 1, NULL, NULL, '2024-04-09', ''),
(259, 1, NULL, NULL, '2024-04-10', ''),
(260, 1, NULL, NULL, '2024-04-11', ''),
(261, 1, NULL, NULL, '2024-04-12', ''),
(262, 1, NULL, NULL, '2024-04-13', ''),
(263, 1, NULL, NULL, '2024-04-14', ''),
(264, 1, NULL, NULL, '2024-04-15', ''),
(265, 1, NULL, NULL, '2024-04-16', ''),
(266, 1, NULL, NULL, '2024-04-17', ''),
(267, 1, NULL, NULL, '2024-04-18', ''),
(268, 1, NULL, NULL, '2024-04-19', ''),
(269, 1, NULL, NULL, '2024-04-20', ''),
(270, 1, NULL, NULL, '2024-04-21', ''),
(271, 1, NULL, NULL, '2024-04-22', ''),
(272, 1, NULL, NULL, '2024-04-23', ''),
(273, 1, NULL, NULL, '2024-04-24', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `log_alteracoes`
--

CREATE TABLE `log_alteracoes` (
  `id` int(11) NOT NULL,
  `tabela` varchar(100) NOT NULL,
  `info` varchar(255) NOT NULL,
  `acao` varchar(30) NOT NULL,
  `data_hora` datetime NOT NULL,
  `usuario` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `log_alteracoes`
--

INSERT INTO `log_alteracoes` (`id`, `tabela`, `info`, `acao`, `data_hora`, `usuario`) VALUES
(1, 'usuarios', 'zaphod', 'Atualizou', '2024-07-14 19:35:59', 'diogosvicente'),
(2, 'usuarios', 'joao', 'Cadastrou', '2024-07-14 19:36:25', 'diogosvicente'),
(3, 'usuarios', 'joao', 'Atualizou', '2024-07-14 19:43:38', 'diogosvicente'),
(4, 'usuarios', 'joao', 'Atualizou', '2024-07-14 19:48:18', 'diogosvicente'),
(5, 'usuarios', 'joao', 'Atualizou', '2024-07-14 19:49:08', 'diogosvicente'),
(6, 'usuarios', 'joao', 'Atualizou', '2024-07-14 19:49:59', 'diogosvicente'),
(7, 'usuarios', 'joao', 'Atualizou', '2024-07-14 21:55:58', 'diogosvicente'),
(8, 'usuarios', 'joao', 'Atualizou', '2024-07-14 21:56:32', 'diogosvicente'),
(9, 'usuarios', 'joao', 'Atualizou', '2024-07-14 21:57:17', 'diogosvicente'),
(10, 'usuarios', 'joao', 'Atualizou', '2024-07-14 21:57:29', 'diogosvicente'),
(11, 'usuarios', 'joao', 'Atualizou', '2024-07-14 21:57:47', 'diogosvicente'),
(12, 'usuarios', 'joao', 'Atualizou', '2024-07-14 21:58:08', 'diogosvicente'),
(13, 'usuarios', 'joao', 'Atualizou', '2024-07-14 21:58:25', 'diogosvicente'),
(14, 'usuarios', 'joao', 'Atualizou', '2024-07-14 22:06:27', 'diogosvicente'),
(15, 'usuarios', 'odair', 'Cadastrou', '2024-07-14 22:07:21', 'diogosvicente'),
(16, 'usuarios', 'odair', 'Lixo', '2024-07-14 22:07:29', 'diogosvicente'),
(17, 'usuarios', 'odair', 'Restaurou', '2024-07-14 22:07:41', 'diogosvicente'),
(18, 'usuarios', 'zaphod', 'Atualizou', '2024-07-14 22:18:45', 'diogosvicente');

-- --------------------------------------------------------

--
-- Estrutura para tabela `posto`
--

CREATE TABLE `posto` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `posto`
--

INSERT INTO `posto` (`id`, `nome`) VALUES
(1, 'UERJ MARACANÃ'),
(2, 'FONSECA TELLES'),
(4, 'CAP CARRESCIA'),
(5, 'FFP'),
(6, 'RESENDE'),
(7, 'GRAJAÚ'),
(8, 'ILHA GRANDE'),
(10, 'UEZO ZONA OESTE'),
(11, 'ESDI LAPA'),
(12, 'FEBF'),
(13, 'VAZ LOBO'),
(14, 'H. VALADARES'),
(15, 'CAXIAS'),
(16, 'CATETE'),
(17, 'PETRÓPOLIS BARÃO'),
(18, 'PETRÓPOLIS YPIRANGA'),
(19, 'BOTAFOGO - CS. DIRCE'),
(20, 'BOTAFOGO - IESP'),
(21, 'NOVA FRIBURGO OLIFAS'),
(22, 'NOVA FRIBURGO IPRJ');

-- --------------------------------------------------------

--
-- Estrutura para tabela `somatorio_periodo`
--

CREATE TABLE `somatorio_periodo` (
  `id` int(11) NOT NULL,
  `fk_local` int(11) NOT NULL,
  `turno` int(1) NOT NULL,
  `total_horas` time NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipos_niveis_usuario`
--

CREATE TABLE `tipos_niveis_usuario` (
  `id` int(11) NOT NULL,
  `nivel` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tipos_niveis_usuario`
--

INSERT INTO `tipos_niveis_usuario` (`id`, `nivel`, `descricao`) VALUES
(1, 1, 'Desenvolvedor'),
(2, 2, 'Administrador'),
(3, 3, 'Colaborador');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `login` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `fk_nivel` int(11) NOT NULL,
  `ativo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `sobrenome`, `login`, `senha`, `fk_nivel`, `ativo`) VALUES
(1, 'Diogo', 'Vicente', 'diogosvicente', '$2y$10$XurGmtH/WakBFHImWx2FLevhkq0Q1.w6sZT.L8VSNwr2piYcCzeKK', 1, 1),
(2, 'Leandro', 'Carlos', 'leandrocarlos', '$2y$10$se9iKprO8kqDK/y4pcsl8OYKYwpY4wFhqqwjkiTJta6eX8mdTdSRq', 2, 1),
(6, 'Zaphod', 'Beeblebrox', 'zaphod', '$2y$10$SLs6sDnLlkmo/7y71YE7Buq1S.w3oNFU6mI2/OXK1DUT1358L1NX2', 3, 1),
(7, 'Joao', 'Felix', 'joao', '$2y$10$k7HzARRZnm5Rk2dLGs8zwe9/jpNgUJ5OjRvsCp/JlAuUaZrgsSh8i', 3, 1),
(8, 'Odair', 'Helman', 'odair', '$2y$10$27PMIk9QDhcHl4Op0Fu3HOiGOcBjFxMaBbs9r3yLz4gi7m3nY6pwi', 3, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `horas_negativas`
--
ALTER TABLE `horas_negativas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `log_alteracoes`
--
ALTER TABLE `log_alteracoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `posto`
--
ALTER TABLE `posto`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `somatorio_periodo`
--
ALTER TABLE `somatorio_periodo`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tipos_niveis_usuario`
--
ALTER TABLE `tipos_niveis_usuario`
  ADD UNIQUE KEY `id` (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `horas_negativas`
--
ALTER TABLE `horas_negativas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=274;

--
-- AUTO_INCREMENT de tabela `log_alteracoes`
--
ALTER TABLE `log_alteracoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `posto`
--
ALTER TABLE `posto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `somatorio_periodo`
--
ALTER TABLE `somatorio_periodo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tipos_niveis_usuario`
--
ALTER TABLE `tipos_niveis_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
