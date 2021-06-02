-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02-Jun-2021 às 19:22
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `atas`
--

CREATE TABLE `atas` (
  `id` int(11) NOT NULL,
  `id_material` int(11) NOT NULL,
  `nome_congresso` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `atas`
--

INSERT INTO `atas` (`id`, `id_material`, `nome_congresso`) VALUES
(1, 3, 'Primeira Sessão Extraordinária');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cartoes_associados`
--

CREATE TABLE `cartoes_associados` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `bi` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cartoes_associados`
--

INSERT INTO `cartoes_associados` (`id`, `id_usuario`, `nome`, `bi`, `endereco`) VALUES
(1, 1, 'teste completo', '11111111111111', 'teste'),
(2, 2, 'demo full', '0000000000', 'demo address'),
(3, 3, 'teste foi', '0024232324232', 'eded'),
(4, 4, 'ola', '235235', 'bg'),
(5, 5, 'fali', '0989', 'av. ng'),
(6, 6, 'fake', '214', 'fakradd');

-- --------------------------------------------------------

--
-- Estrutura da tabela `emprestimos`
--

CREATE TABLE `emprestimos` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `emprestimos`
--

INSERT INTO `emprestimos` (`id`, `id_pedido`) VALUES
(9, 6),
(10, 14);

-- --------------------------------------------------------

--
-- Estrutura da tabela `frequencias_publicacoes_revistas`
--

CREATE TABLE `frequencias_publicacoes_revistas` (
  `id` int(11) NOT NULL,
  `frequencia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `frequencias_publicacoes_revistas`
--

INSERT INTO `frequencias_publicacoes_revistas` (`id`, `frequencia`) VALUES
(1, 'trimestral'),
(2, 'semestral'),
(3, 'anual');

-- --------------------------------------------------------

--
-- Estrutura da tabela `generos_livros`
--

CREATE TABLE `generos_livros` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `generos_livros`
--

INSERT INTO `generos_livros` (`id`, `nome`) VALUES
(1, 'crianças'),
(2, 'ficção científica'),
(3, 'história antiga');

-- --------------------------------------------------------

--
-- Estrutura da tabela `livros`
--

CREATE TABLE `livros` (
  `id` int(11) NOT NULL,
  `id_material` int(11) NOT NULL,
  `id_genero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `livros`
--

INSERT INTO `livros` (`id`, `id_material`, `id_genero`) VALUES
(1, 1, 2),
(4, 10, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `materiais`
--

CREATE TABLE `materiais` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `ano_publicacao` year(4) NOT NULL,
  `ano_chegada` year(4) NOT NULL,
  `editorial` varchar(255) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco` float(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `materiais`
--

INSERT INTO `materiais` (`id`, `titulo`, `autor`, `ano_publicacao`, `ano_chegada`, `editorial`, `quantidade`, `preco`, `created_at`, `updated_at`) VALUES
(1, 'Primeiro Livro', 'Eu', 2020, 2021, 'ISPTEC', 5, 0.60, '2021-06-01 04:28:04', '2021-06-01 04:28:04'),
(2, 'Primeira Revista', 'Eu', 2020, 2021, 'ISPTEC', 10, 1.33, '2021-06-01 04:28:39', '2021-06-01 04:28:39'),
(3, 'Primeira Ata', 'Aline', 2020, 2021, 'ISPTEC', 1, 1.00, '2021-06-01 04:30:56', '2021-06-02 03:19:51'),
(10, 'Exemplo', 'John Doe', 2018, 2021, 'Colum', 10, 1.20, '2021-06-02 16:19:04', '2021-06-02 16:19:04'),
(11, 'Ultima Revista', 'Capri', 2004, 2004, 'Flemim', 8, 1.44, '2021-06-02 17:55:09', '2021-06-02 17:55:09');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `id_cartao_associado` int(11) NOT NULL,
  `id_material` int(11) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_cartao_associado`, `id_material`, `estado`, `created_at`, `updated_at`) VALUES
(5, 4, 2, 'Confirmado', '2021-06-02 15:45:22', '2021-06-02 16:09:38'),
(6, 4, 1, 'Entregue', '2021-06-02 16:00:22', '2021-06-02 18:10:55'),
(8, 5, 2, 'Confirmado', '2021-06-02 17:13:53', '2021-06-02 18:11:03'),
(10, 2, 2, 'Em processamento', '2021-06-02 17:53:08', '2021-06-02 17:53:08'),
(11, 2, 11, 'Em processamento', '2021-06-02 18:09:17', '2021-06-02 18:09:17'),
(14, 2, 3, 'Entregue', '2021-06-02 18:16:41', '2021-06-02 18:16:51');

-- --------------------------------------------------------

--
-- Estrutura da tabela `revistas`
--

CREATE TABLE `revistas` (
  `id` int(11) NOT NULL,
  `id_material` int(11) NOT NULL,
  `id_frequencia_publicacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `revistas`
--

INSERT INTO `revistas` (`id`, `id_material`, `id_frequencia_publicacao`) VALUES
(1, 2, 2),
(5, 11, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `senha`, `created_at`, `updated_at`) VALUES
(1, 'teste', '$2y$10$/F736fGqoOw8frGZXZS92O2rGJW51iA8lIn9ikP0EmLbL8hJPsnq.', '2021-05-31 03:14:44', '2021-05-31 03:14:44'),
(2, 'demo', '$2y$10$SoNTEoJE03eTOWlJj37Mz.ByyTEqfDOdVJkv.V0LaJVmkDmdCE7pW', '2021-05-31 03:24:29', '2021-05-31 03:24:29'),
(3, 'foi', '$2y$10$CzdP7bgDdayetJWoOxIxBO.Efe7rblrevpejaCpQAcOjWB8.dS4ue', '2021-05-31 03:34:37', '2021-05-31 03:34:37'),
(4, 'fake', '$2y$10$3M611ai5g.PAU5FwhrT8IeNRzaBDq1hr3gqc8Snw9.BoB4ez/TYU2', '2021-05-31 23:01:19', '2021-05-31 23:01:19'),
(5, 'fali', '$2y$10$SZ7NlUaZJ.OHhlYL1Th7KeHqnpGNCXh/PWUW6FaO1A/a/KhoiSLfC', '2021-05-31 23:01:47', '2021-05-31 23:01:47'),
(6, 'fakename', '$2y$10$koHtqaoE4HPDKOBVGn5HUufaLBVOJJaNdPCroa14j6O1wpMsntQZ2', '2021-05-31 23:03:22', '2021-05-31 23:03:22');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `atas`
--
ALTER TABLE `atas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_material_minutes` (`id_material`);

--
-- Índices para tabela `cartoes_associados`
--
ALTER TABLE `cartoes_associados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario_cartao_associado` (`id_usuario`);

--
-- Índices para tabela `emprestimos`
--
ALTER TABLE `emprestimos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pedido_emprestimo` (`id_pedido`);

--
-- Índices para tabela `frequencias_publicacoes_revistas`
--
ALTER TABLE `frequencias_publicacoes_revistas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `generos_livros`
--
ALTER TABLE `generos_livros`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `livros`
--
ALTER TABLE `livros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_material_livro` (`id_material`),
  ADD KEY `id_genero_livro` (`id_genero`);

--
-- Índices para tabela `materiais`
--
ALTER TABLE `materiais`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cartao_associado_pedido` (`id_cartao_associado`),
  ADD KEY `id_material_pedido` (`id_material`);

--
-- Índices para tabela `revistas`
--
ALTER TABLE `revistas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_material_revista` (`id_material`),
  ADD KEY `id_frequencia_publicacao_revista` (`id_frequencia_publicacao`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `atas`
--
ALTER TABLE `atas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `cartoes_associados`
--
ALTER TABLE `cartoes_associados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `emprestimos`
--
ALTER TABLE `emprestimos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `frequencias_publicacoes_revistas`
--
ALTER TABLE `frequencias_publicacoes_revistas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `generos_livros`
--
ALTER TABLE `generos_livros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `livros`
--
ALTER TABLE `livros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `materiais`
--
ALTER TABLE `materiais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `revistas`
--
ALTER TABLE `revistas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `atas`
--
ALTER TABLE `atas`
  ADD CONSTRAINT `id_material_minutes` FOREIGN KEY (`id_material`) REFERENCES `materiais` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `cartoes_associados`
--
ALTER TABLE `cartoes_associados`
  ADD CONSTRAINT `id_usuario_cartao_associado` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limitadores para a tabela `emprestimos`
--
ALTER TABLE `emprestimos`
  ADD CONSTRAINT `id_pedido_emprestimo` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limitadores para a tabela `livros`
--
ALTER TABLE `livros`
  ADD CONSTRAINT `id_genero_livro` FOREIGN KEY (`id_genero`) REFERENCES `generos_livros` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `id_material_livro` FOREIGN KEY (`id_material`) REFERENCES `materiais` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `id_cartao_associado_pedido` FOREIGN KEY (`id_cartao_associado`) REFERENCES `cartoes_associados` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `id_material_pedido` FOREIGN KEY (`id_material`) REFERENCES `materiais` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `revistas`
--
ALTER TABLE `revistas`
  ADD CONSTRAINT `id_frequencia_publicacao_revista` FOREIGN KEY (`id_frequencia_publicacao`) REFERENCES `frequencias_publicacoes_revistas` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `id_material_revista` FOREIGN KEY (`id_material`) REFERENCES `materiais` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
