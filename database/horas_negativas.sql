-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02/08/2024 às 19:31
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
  `justificativa` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `horas_negativas`
--

INSERT INTO `horas_negativas` (`id`, `fk_local`, `diurno`, `noturno`, `data`, `justificativa`) VALUES
(1, 1, 1, 2, '2024-01-25', 'caleidospoio'),
(2, 1, 1, 22, '2024-01-26', NULL),
(3, 1, NULL, NULL, '2024-01-27', 'aquilo era um boneco'),
(4, 1, NULL, NULL, '2024-01-28', NULL),
(5, 1, NULL, NULL, '2024-01-29', NULL),
(6, 1, NULL, NULL, '2024-01-30', NULL),
(7, 1, NULL, NULL, '2024-01-31', NULL),
(8, 1, NULL, NULL, '2024-02-01', NULL),
(9, 1, NULL, NULL, '2024-02-02', NULL),
(10, 1, NULL, NULL, '2024-02-03', NULL),
(11, 1, NULL, NULL, '2024-02-04', NULL),
(12, 1, NULL, NULL, '2024-02-05', NULL),
(13, 1, NULL, NULL, '2024-02-06', NULL),
(14, 1, NULL, NULL, '2024-02-07', NULL),
(15, 1, NULL, NULL, '2024-02-08', NULL),
(16, 1, NULL, NULL, '2024-02-09', NULL),
(17, 1, NULL, NULL, '2024-02-10', NULL),
(18, 1, NULL, NULL, '2024-02-11', NULL),
(19, 1, NULL, NULL, '2024-02-12', NULL),
(20, 1, NULL, NULL, '2024-02-13', NULL),
(21, 1, NULL, NULL, '2024-02-14', NULL),
(22, 1, NULL, NULL, '2024-02-15', NULL),
(23, 1, NULL, NULL, '2024-02-16', NULL),
(24, 1, NULL, NULL, '2024-02-17', NULL),
(25, 1, NULL, NULL, '2024-02-18', NULL),
(26, 1, NULL, NULL, '2024-02-19', NULL),
(27, 1, NULL, NULL, '2024-02-20', NULL),
(28, 1, NULL, NULL, '2024-02-21', NULL),
(29, 1, NULL, NULL, '2024-02-22', NULL),
(30, 1, NULL, NULL, '2024-02-23', NULL),
(31, 1, NULL, NULL, '2024-02-24', NULL),
(32, 11, 20, 10, '2024-01-25', 'deu merda no plantao, maluco veio doidao e nao quis trabalhar'),
(33, 11, NULL, NULL, '2024-01-26', NULL),
(34, 11, 1, 12, '2024-01-27', 'sadfsadfsdafs'),
(35, 11, NULL, NULL, '2024-01-28', NULL),
(36, 11, NULL, NULL, '2024-01-29', NULL),
(37, 11, NULL, NULL, '2024-01-30', NULL),
(38, 11, NULL, NULL, '2024-01-31', NULL),
(39, 11, NULL, NULL, '2024-02-01', NULL),
(40, 11, NULL, NULL, '2024-02-02', NULL),
(41, 11, NULL, NULL, '2024-02-03', NULL),
(42, 11, NULL, NULL, '2024-02-04', NULL),
(43, 11, NULL, NULL, '2024-02-05', NULL),
(44, 11, NULL, NULL, '2024-02-06', NULL),
(45, 11, NULL, NULL, '2024-02-07', NULL),
(46, 11, NULL, NULL, '2024-02-08', NULL),
(47, 11, NULL, NULL, '2024-02-09', NULL),
(48, 11, NULL, NULL, '2024-02-10', NULL),
(49, 11, NULL, NULL, '2024-02-11', NULL),
(50, 11, NULL, NULL, '2024-02-12', NULL),
(51, 11, NULL, NULL, '2024-02-13', NULL),
(52, 11, NULL, NULL, '2024-02-14', NULL),
(53, 11, NULL, NULL, '2024-02-15', NULL),
(54, 11, NULL, NULL, '2024-02-16', NULL),
(55, 11, NULL, NULL, '2024-02-17', NULL),
(56, 11, NULL, NULL, '2024-02-18', NULL),
(57, 11, NULL, NULL, '2024-02-19', NULL),
(58, 11, NULL, NULL, '2024-02-20', NULL),
(59, 11, NULL, NULL, '2024-02-21', NULL),
(60, 11, NULL, NULL, '2024-02-22', NULL),
(61, 11, NULL, NULL, '2024-02-23', NULL),
(62, 11, NULL, NULL, '2024-02-24', NULL),
(63, 21, NULL, NULL, '2024-01-25', 'Ronald Golias mamou o bonde'),
(64, 21, NULL, NULL, '2024-01-26', NULL),
(65, 21, NULL, NULL, '2024-01-27', NULL),
(66, 21, NULL, NULL, '2024-01-28', NULL),
(67, 21, NULL, NULL, '2024-01-29', NULL),
(68, 21, NULL, NULL, '2024-01-30', NULL),
(69, 21, NULL, NULL, '2024-01-31', NULL),
(70, 21, NULL, NULL, '2024-02-01', NULL),
(71, 21, NULL, NULL, '2024-02-02', NULL),
(72, 21, NULL, NULL, '2024-02-03', NULL),
(73, 21, NULL, NULL, '2024-02-04', NULL),
(74, 21, NULL, NULL, '2024-02-05', NULL),
(75, 21, NULL, NULL, '2024-02-06', NULL),
(76, 21, NULL, NULL, '2024-02-07', NULL),
(77, 21, NULL, NULL, '2024-02-08', NULL),
(78, 21, NULL, NULL, '2024-02-09', NULL),
(79, 21, NULL, NULL, '2024-02-10', NULL),
(80, 21, NULL, NULL, '2024-02-11', NULL),
(81, 21, NULL, NULL, '2024-02-12', NULL),
(82, 21, NULL, NULL, '2024-02-13', NULL),
(83, 21, NULL, NULL, '2024-02-14', NULL),
(84, 21, NULL, NULL, '2024-02-15', NULL),
(85, 21, NULL, NULL, '2024-02-16', NULL),
(86, 21, NULL, NULL, '2024-02-17', NULL),
(87, 21, NULL, NULL, '2024-02-18', NULL),
(88, 21, NULL, NULL, '2024-02-19', NULL),
(89, 21, NULL, NULL, '2024-02-20', NULL),
(90, 21, NULL, NULL, '2024-02-21', NULL),
(91, 21, NULL, NULL, '2024-02-22', NULL),
(92, 21, NULL, NULL, '2024-02-23', NULL),
(93, 21, NULL, NULL, '2024-02-24', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

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
