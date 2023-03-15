-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 30/01/2023 às 20:50
-- Versão do servidor: 10.5.16-MariaDB-cll-lve
-- Versão do PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `u831868453_temcorte`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `scheduling`
--

CREATE TABLE `scheduling` (
  `id` int(10) UNSIGNED NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL,
  `fk_service` int(10) UNSIGNED NOT NULL,
  `fk_client` int(10) UNSIGNED NOT NULL,
  `fk_employee` int(10) UNSIGNED NOT NULL,
  `fk_city` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `scheduling`
--

INSERT INTO `scheduling` (`id`, `start`, `end`, `created`, `modified`, `fk_service`, `fk_client`, `fk_employee`, `fk_city`) VALUES
(1, '2023-01-25 08:00:00', '2023-01-25 08:30:00', '2023-01-30 20:49:33', NULL, 1, 3, 2, 1),
(2, '2023-01-25 09:00:00', '2023-01-25 09:30:00', '2023-01-30 20:49:39', NULL, 1, 3, 2, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `scheduling`
--
ALTER TABLE `scheduling`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_service` (`fk_service`),
  ADD KEY `fk_client` (`fk_client`),
  ADD KEY `fk_employee` (`fk_employee`),
  ADD KEY `fk_city` (`fk_city`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `scheduling`
--
ALTER TABLE `scheduling`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `scheduling`
--
ALTER TABLE `scheduling`
  ADD CONSTRAINT `scheduling_ibfk_1` FOREIGN KEY (`fk_service`) REFERENCES `service` (`id`),
  ADD CONSTRAINT `scheduling_ibfk_2` FOREIGN KEY (`fk_client`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `scheduling_ibfk_3` FOREIGN KEY (`fk_employee`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `scheduling_ibfk_4` FOREIGN KEY (`fk_city`) REFERENCES `city` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
