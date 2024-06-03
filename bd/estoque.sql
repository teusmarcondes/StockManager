-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 31/05/2024 às 21:00
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `estoque`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `data_registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `id_fornecedor_produto` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `id_fornecedor` int(11) NOT NULL,
  `data_registro` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categorias`
--

INSERT INTO `categorias` (`id_fornecedor_produto`, `id_produto`, `id_fornecedor`, `data_registro`) VALUES
(3, 0, 0, '2024-05-28 13:32:05'),
(4, 2, 2, '2024-05-28 13:32:05'),
(5, 5, 3, '2024-05-28 13:32:05'),
(6, 6, 4, '2024-05-28 13:32:05'),
(7, 7, 6, '2024-05-28 13:32:05'),
(8, 0, 0, '2024-05-28 13:32:05'),
(9, 0, 0, '2024-05-29 12:08:45'),
(10, 1, 1, '2024-05-29 12:08:56');

-- --------------------------------------------------------

--
-- Estrutura para tabela `fornecedores`
--

CREATE TABLE `fornecedores` (
  `id_fornecedor` int(11) NOT NULL,
  `id_produto` varchar(50) NOT NULL,
  `nome_fornecedor` varchar(30) NOT NULL,
  `contato` varchar(20) NOT NULL,
  `data_registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `fornecedores`
--

INSERT INTO `fornecedores` (`id_fornecedor`, `id_produto`, `nome_fornecedor`, `contato`, `data_registro`) VALUES
(1, '2', 'Fornecedor 1', '(41) 90000-0001', '2024-04-15 08:51:20'),
(4, '2', 'Fornecedor 4', '(41) 90000-0004', '2024-04-15 08:52:18'),
(6, '1', 'Forcedora 1', '(41) 90000-0000', '2024-05-27 16:07:29'),
(9, '1', 'Mateus', '00', '2024-05-29 12:42:18'),
(10, '7', 'Mathias', '01', '2024-05-31 09:28:58'),
(11, ' 1 ', 'a', 'a', '2024-05-31 09:33:02');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id_produto` int(11) NOT NULL,
  `data` date NOT NULL,
  `codigo` int(11) NOT NULL,
  `nome_produto` varchar(50) NOT NULL,
  `entradas` float NOT NULL,
  `saidas` float NOT NULL,
  `data_registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id_produto`, `data`, `codigo`, `nome_produto`, `entradas`, `saidas`, `data_registro`) VALUES
(1, '2024-03-15', 1, 'Produto 1', 10, 10, '2024-05-28 13:33:30'),
(2, '2024-03-25', 2, 'Produto 2', 4, 5, '2024-05-28 13:33:30'),
(5, '2024-03-27', 3, 'Produto 3', 15, 0, '2024-05-28 13:33:30'),
(6, '2024-04-04', 4, 'Produto 4', 20, 5, '2024-05-28 13:33:30'),
(7, '2024-04-01', 5, 'Produto 5', 100, 95, '2024-05-28 13:33:30');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `senha` varchar(30) NOT NULL,
  `confsenha` varchar(30) NOT NULL,
  `nivel` varchar(6) NOT NULL,
  `data_registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `usuario`, `senha`, `confsenha`, `nivel`, `data_registro`) VALUES
(1, 'Mateus', 'user1', '123', '123', 'padrao', '2024-03-13 11:36:07'),
(2, 'Renata', 'user2', '321', '321', 'admin', '2024-03-14 10:21:51'),
(3, 'Thiago', 'user3', '231', '231', 'padrao', '2024-03-15 09:53:53'),
(4, 'Bruna', 'user4', '123', '123', 'admin', '2024-05-28 08:59:05'),
(24, 'a', 'a', '123', '123', '', '2024-05-28 15:49:11'),
(25, 'b', 'b', '123', '123', '', '2024-05-28 15:51:31');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_fornecedor_produto`);

--
-- Índices de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  ADD PRIMARY KEY (`id_fornecedor`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id_produto`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_fornecedor_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `id_fornecedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
