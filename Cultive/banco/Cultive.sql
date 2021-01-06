-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06-Jan-2021 às 02:03
-- Versão do servidor: 10.4.13-MariaDB
-- versão do PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cultive`
--
CREATE DATABASE IF NOT EXISTS `cultive` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cultive`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ambiente`
--

CREATE TABLE `ambiente` (
  `codigoAmbiente` int(11) NOT NULL,
  `nomeAmbiente` varchar(30) NOT NULL,
  `descricaoAmbiente` varchar(500) DEFAULT NULL,
  `localizacaoAmbiente` varchar(100) DEFAULT NULL,
  `dimensaoAmbiente` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ambiente`
--

INSERT INTO `ambiente` (`codigoAmbiente`, `nomeAmbiente`, `descricaoAmbiente`, `localizacaoAmbiente`, `dimensaoAmbiente`) VALUES
(9, 'Cultive amizades', 'Horta de especiarias', 'Entre a cozinha e o estacionamento', '2m²'),
(10, 'Cultive especiarias', 'Horta', 'Ao lado da quadra', '2m²');

-- --------------------------------------------------------

--
-- Estrutura da tabela `atendenecessidade`
--

CREATE TABLE `atendenecessidade` (
  `codigoNecessidade` int(11) NOT NULL,
  `codigoUsuario` int(11) NOT NULL,
  `data` date DEFAULT NULL,
  `horario` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `atendenecessidade`
--

INSERT INTO `atendenecessidade` (`codigoNecessidade`, `codigoUsuario`, `data`, `horario`) VALUES
(47, 1, '2021-01-04', '01:19:33'),
(48, 11, '2021-01-04', '01:20:15'),
(49, 11, '2021-01-06', '01:21:29'),
(50, 11, '2021-01-06', '01:22:08'),
(51, 1, '2021-01-06', '01:24:38'),
(52, 11, '2021-01-06', '01:42:17');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cuidado`
--

CREATE TABLE `cuidado` (
  `codigoCuidado` int(11) NOT NULL,
  `descricaoCuidado` varchar(500) NOT NULL,
  `pontuacaoCuidado` int(11) NOT NULL,
  `periodicidadeCuidado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cuidado`
--

INSERT INTO `cuidado` (`codigoCuidado`, `descricaoCuidado`, `pontuacaoCuidado`, `periodicidadeCuidado`) VALUES
(9, 'Regar', 30, NULL),
(10, 'Adubar', 50, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cuidadomaterial`
--

CREATE TABLE `cuidadomaterial` (
  `codigoCuidado` int(11) NOT NULL,
  `codigoMaterial` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cuidadomaterial`
--

INSERT INTO `cuidadomaterial` (`codigoCuidado`, `codigoMaterial`) VALUES
(10, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `denunciaambiente`
--

CREATE TABLE `denunciaambiente` (
  `codigoDenunciaAmbiente` int(11) NOT NULL,
  `codigoAmbiente` int(11) NOT NULL,
  `codigoUsuario` int(11) NOT NULL,
  `dataDenunciaAmbiente` date NOT NULL,
  `descricaoDenunciaAmbiente` varchar(500) NOT NULL,
  `descricaoAcaoDenunciaAmbiente` varchar(500) DEFAULT NULL,
  `situacaoDenunciaAmbiente` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `denunciaambiente`
--

INSERT INTO `denunciaambiente` (`codigoDenunciaAmbiente`, `codigoAmbiente`, `codigoUsuario`, `dataDenunciaAmbiente`, `descricaoDenunciaAmbiente`, `descricaoAcaoDenunciaAmbiente`, `situacaoDenunciaAmbiente`) VALUES
(3, 10, 11, '2020-12-17', 'aaaaa', 'aaaaaaaa', 'aaaaaaaaaa');

-- --------------------------------------------------------

--
-- Estrutura da tabela `denunciaitem`
--

CREATE TABLE `denunciaitem` (
  `codigoDenunciaItem` int(11) NOT NULL,
  `codigoItem` int(11) NOT NULL,
  `codigoUsuario` int(11) NOT NULL,
  `dataDenunciaItem` date NOT NULL,
  `descricaoDenunciaItem` varchar(500) NOT NULL,
  `descricaoAcaoDenunciaItem` varchar(500) DEFAULT NULL,
  `situacaoDenunciaItem` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `item`
--

CREATE TABLE `item` (
  `codigoItem` int(11) NOT NULL,
  `codigoAmbiente` int(11) NOT NULL,
  `nomeItem` varchar(30) DEFAULT NULL,
  `descricaoItem` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `item`
--

INSERT INTO `item` (`codigoItem`, `codigoAmbiente`, `nomeItem`, `descricaoItem`) VALUES
(3, 9, 'Parreira', 'Uva'),
(4, 10, 'Mangueira', 'manga');

-- --------------------------------------------------------

--
-- Estrutura da tabela `itemambienteprecisacuidado`
--

CREATE TABLE `itemambienteprecisacuidado` (
  `codigoCuidado` int(11) NOT NULL,
  `codigoItem` int(11) NOT NULL,
  `codigoAmbiente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `itemambienteprecisacuidado`
--

INSERT INTO `itemambienteprecisacuidado` (`codigoCuidado`, `codigoItem`, `codigoAmbiente`) VALUES
(10, 3, 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `material`
--

CREATE TABLE `material` (
  `codigoMaterial` int(11) NOT NULL,
  `nomeMaterial` varchar(30) NOT NULL,
  `descricaoMaterial` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `material`
--

INSERT INTO `material` (`codigoMaterial`, `nomeMaterial`, `descricaoMaterial`) VALUES
(3, 'Mangueira', 'Para rega');

-- --------------------------------------------------------

--
-- Estrutura da tabela `necessidade`
--

CREATE TABLE `necessidade` (
  `codigoNecessidade` int(11) NOT NULL,
  `codigoItem` int(11) NOT NULL,
  `codigoSensor` int(11) NOT NULL,
  `codigoCuidado` int(11) NOT NULL,
  `statusNecessidade` tinyint(1) NOT NULL,
  `dataNecessidade` date NOT NULL,
  `horarioNecessidade` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `necessidade`
--

INSERT INTO `necessidade` (`codigoNecessidade`, `codigoItem`, `codigoSensor`, `codigoCuidado`, `statusNecessidade`, `dataNecessidade`, `horarioNecessidade`) VALUES
(47, 4, 3, 9, 1, '2021-01-04', '01:19:13'),
(48, 4, 3, 9, 1, '2021-01-04', '01:20:04'),
(49, 4, 3, 9, 1, '2021-01-06', '01:21:19'),
(50, 3, 3, 9, 1, '2021-01-06', '01:21:58'),
(51, 4, 3, 9, 1, '2021-01-06', '01:24:33'),
(52, 4, 3, 10, 1, '2021-01-06', '01:42:02');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sensor`
--

CREATE TABLE `sensor` (
  `codigoSensor` int(11) NOT NULL,
  `urlSensor` varchar(100) NOT NULL,
  `descricaoSensor` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `sensor`
--

INSERT INTO `sensor` (`codigoSensor`, `urlSensor`, `descricaoSensor`) VALUES
(3, 'www.url.com', 'aaaaaaaaaaaa'),
(4, 'www.url.com', 'bbbbbbbbb');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sensoremitealertanecessidade`
--

CREATE TABLE `sensoremitealertanecessidade` (
  `codigoSensor` int(11) NOT NULL,
  `codigoNecessidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `sensoremitealertanecessidade`
--

INSERT INTO `sensoremitealertanecessidade` (`codigoSensor`, `codigoNecessidade`) VALUES
(3, 47),
(3, 48),
(3, 49),
(3, 50),
(3, 51),
(3, 52);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabela_imagens`
--

CREATE TABLE `tabela_imagens` (
  `codigoUsuario` int(11) NOT NULL,
  `codigo` int(10) NOT NULL,
  `evento` varchar(50) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `nome_imagem` varchar(25) NOT NULL,
  `tamanho_imagem` varchar(25) NOT NULL,
  `tipo_imagem` varchar(25) NOT NULL,
  `imagem` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `codigoUsuario` int(11) NOT NULL,
  `nomeUsuario` varchar(30) NOT NULL,
  `prontuarioUsuario` varchar(10) NOT NULL,
  `emailUsuario` varchar(40) NOT NULL,
  `senhaUsuario` varchar(32) NOT NULL,
  `pontuacao` int(11) NOT NULL,
  `biografiaUsuario` varchar(2000) DEFAULT NULL,
  `fotoUsuario` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`codigoUsuario`, `nomeUsuario`, `prontuarioUsuario`, `emailUsuario`, `senhaUsuario`, `pontuacao`, `biografiaUsuario`, `fotoUsuario`) VALUES
(1, 'adm', '1', 'admin@admin.com', 'admin123', 90, NULL, NULL),
(11, 'Amanda', '123', 'amanda@gmail.com', '202cb962ac59075b964b07152d234b70', 130, NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `ambiente`
--
ALTER TABLE `ambiente`
  ADD PRIMARY KEY (`codigoAmbiente`);

--
-- Índices para tabela `atendenecessidade`
--
ALTER TABLE `atendenecessidade`
  ADD PRIMARY KEY (`codigoNecessidade`,`codigoUsuario`),
  ADD KEY `codigoUsuario` (`codigoUsuario`);

--
-- Índices para tabela `cuidado`
--
ALTER TABLE `cuidado`
  ADD PRIMARY KEY (`codigoCuidado`);

--
-- Índices para tabela `cuidadomaterial`
--
ALTER TABLE `cuidadomaterial`
  ADD PRIMARY KEY (`codigoCuidado`,`codigoMaterial`),
  ADD KEY `codigoMaterial` (`codigoMaterial`);

--
-- Índices para tabela `denunciaambiente`
--
ALTER TABLE `denunciaambiente`
  ADD PRIMARY KEY (`codigoDenunciaAmbiente`),
  ADD KEY `codigoAmbiente` (`codigoAmbiente`),
  ADD KEY `codigoUsuario` (`codigoUsuario`);

--
-- Índices para tabela `denunciaitem`
--
ALTER TABLE `denunciaitem`
  ADD PRIMARY KEY (`codigoDenunciaItem`),
  ADD KEY `codigoItem` (`codigoItem`),
  ADD KEY `codigoUsuario` (`codigoUsuario`);

--
-- Índices para tabela `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`codigoItem`,`codigoAmbiente`),
  ADD KEY `codigoAmbiente` (`codigoAmbiente`);

--
-- Índices para tabela `itemambienteprecisacuidado`
--
ALTER TABLE `itemambienteprecisacuidado`
  ADD PRIMARY KEY (`codigoAmbiente`,`codigoItem`,`codigoCuidado`),
  ADD KEY `codigoItem` (`codigoItem`),
  ADD KEY `codigoCuidado` (`codigoCuidado`);

--
-- Índices para tabela `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`codigoMaterial`);

--
-- Índices para tabela `necessidade`
--
ALTER TABLE `necessidade`
  ADD PRIMARY KEY (`codigoNecessidade`,`codigoSensor`,`codigoItem`),
  ADD KEY `codigoItem` (`codigoItem`),
  ADD KEY `codigoSensor` (`codigoSensor`),
  ADD KEY `codigoCuidado` (`codigoCuidado`);

--
-- Índices para tabela `sensor`
--
ALTER TABLE `sensor`
  ADD PRIMARY KEY (`codigoSensor`);

--
-- Índices para tabela `sensoremitealertanecessidade`
--
ALTER TABLE `sensoremitealertanecessidade`
  ADD PRIMARY KEY (`codigoSensor`,`codigoNecessidade`),
  ADD KEY `codigoNecessidade` (`codigoNecessidade`);

--
-- Índices para tabela `tabela_imagens`
--
ALTER TABLE `tabela_imagens`
  ADD PRIMARY KEY (`codigoUsuario`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`codigoUsuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `ambiente`
--
ALTER TABLE `ambiente`
  MODIFY `codigoAmbiente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `cuidado`
--
ALTER TABLE `cuidado`
  MODIFY `codigoCuidado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `denunciaambiente`
--
ALTER TABLE `denunciaambiente`
  MODIFY `codigoDenunciaAmbiente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `denunciaitem`
--
ALTER TABLE `denunciaitem`
  MODIFY `codigoDenunciaItem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `item`
--
ALTER TABLE `item`
  MODIFY `codigoItem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `material`
--
ALTER TABLE `material`
  MODIFY `codigoMaterial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `necessidade`
--
ALTER TABLE `necessidade`
  MODIFY `codigoNecessidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de tabela `sensor`
--
ALTER TABLE `sensor`
  MODIFY `codigoSensor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `codigoUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `atendenecessidade`
--
ALTER TABLE `atendenecessidade`
  ADD CONSTRAINT `atendenecessidade_ibfk_1` FOREIGN KEY (`codigoUsuario`) REFERENCES `usuario` (`codigoUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `atendenecessidade_ibfk_2` FOREIGN KEY (`codigoNecessidade`) REFERENCES `necessidade` (`codigoNecessidade`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `cuidadomaterial`
--
ALTER TABLE `cuidadomaterial`
  ADD CONSTRAINT `cuidadomaterial_ibfk_1` FOREIGN KEY (`codigoCuidado`) REFERENCES `cuidado` (`codigoCuidado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cuidadomaterial_ibfk_2` FOREIGN KEY (`codigoMaterial`) REFERENCES `material` (`codigoMaterial`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `denunciaambiente`
--
ALTER TABLE `denunciaambiente`
  ADD CONSTRAINT `denunciaambiente_ibfk_1` FOREIGN KEY (`codigoAmbiente`) REFERENCES `ambiente` (`codigoAmbiente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `denunciaambiente_ibfk_2` FOREIGN KEY (`codigoUsuario`) REFERENCES `usuario` (`codigoUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `denunciaitem`
--
ALTER TABLE `denunciaitem`
  ADD CONSTRAINT `denunciaitem_ibfk_1` FOREIGN KEY (`codigoItem`) REFERENCES `item` (`codigoItem`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `denunciaitem_ibfk_2` FOREIGN KEY (`codigoUsuario`) REFERENCES `usuario` (`codigoUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`codigoAmbiente`) REFERENCES `ambiente` (`codigoAmbiente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `itemambienteprecisacuidado`
--
ALTER TABLE `itemambienteprecisacuidado`
  ADD CONSTRAINT `itemambienteprecisacuidado_ibfk_1` FOREIGN KEY (`codigoAmbiente`) REFERENCES `ambiente` (`codigoAmbiente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `itemambienteprecisacuidado_ibfk_2` FOREIGN KEY (`codigoItem`) REFERENCES `item` (`codigoItem`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `itemambienteprecisacuidado_ibfk_3` FOREIGN KEY (`codigoCuidado`) REFERENCES `cuidado` (`codigoCuidado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `necessidade`
--
ALTER TABLE `necessidade`
  ADD CONSTRAINT `necessidade_ibfk_1` FOREIGN KEY (`codigoItem`) REFERENCES `item` (`codigoItem`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `necessidade_ibfk_2` FOREIGN KEY (`codigoSensor`) REFERENCES `sensor` (`codigoSensor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `necessidade_ibfk_3` FOREIGN KEY (`codigoCuidado`) REFERENCES `cuidado` (`codigoCuidado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `sensoremitealertanecessidade`
--
ALTER TABLE `sensoremitealertanecessidade`
  ADD CONSTRAINT `sensoremitealertanecessidade_ibfk_1` FOREIGN KEY (`codigoSensor`) REFERENCES `sensor` (`codigoSensor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sensoremitealertanecessidade_ibfk_2` FOREIGN KEY (`codigoNecessidade`) REFERENCES `necessidade` (`codigoNecessidade`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tabela_imagens`
--
ALTER TABLE `tabela_imagens`
  ADD CONSTRAINT `tabela_imagens_ibfk_1` FOREIGN KEY (`codigoUsuario`) REFERENCES `usuario` (`codigoUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
