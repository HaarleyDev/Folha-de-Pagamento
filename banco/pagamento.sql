-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Jun-2023 às 06:46
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pagamento`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `dep`
--

CREATE TABLE `dep` (
  `id_dep` int(11) NOT NULL,
  `nome_dep` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `dep`
--

INSERT INTO `dep` (`id_dep`, `nome_dep`) VALUES
(6, 'Administrativo'),
(7, 'Marketing'),
(8, 'Financeiro'),
(9, 'Pessoal'),
(10, 'Comercial'),
(11, 'Produção'),
(12, 'Jurídico'),
(13, 'Recursos Humanos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `func`
--

CREATE TABLE `func` (
  `id_f` int(11) NOT NULL,
  `id_d` int(11) DEFAULT NULL,
  `tipo` int(1) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `cpf` varchar(50) NOT NULL,
  `idade` int(3) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefone` varchar(50) NOT NULL,
  `rua` varchar(50) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `func`
--

INSERT INTO `func` (`id_f`, `id_d`, `tipo`, `nome`, `pass`, `cpf`, `idade`, `email`, `telefone`, `rua`, `bairro`, `cidade`, `estado`) VALUES
(32, NULL, 1, 'DevHarley', '123', '647.424.550-61', 21, 'dev@admin.com', '85987939498', '', '', '', ''),
(36, 8, 0, ' Willyene Frotté Vidal Camacho', '777777777777777777777', '724.026.643-55', 36, 'pl4kill7@gmail.com', '(88) 3144-5583', 'Rua São Cristovão', 'Baixada da Cadeia Velha', 'Rio Branco', 'AC'),
(37, 9, 0, ' Adelir De Carvalho Tolentino Pinheiro', '32152356', '745.048.843-48', 39, 'pl4killgamer@gmail.com', '(88) 3712-8844', 'Travessa Y-9A', 'Jardim Floresta', 'Boa Vista', 'RR'),
(38, 11, 0, ' Julia Campos De Lima', '32152356', '112.857.253-28', 29, 'pl4kill1@gmail.com', '(11) 28572-5328', 'Rua Primeiro de Maio', 'Águas Lindas', 'Belém', 'PA'),
(39, 7, 0, 'Maicon Jordan', '32152356$12343Gk', '574.059.710-24', 52, 'a@gmail.com', '(85) 98793-9498', 'Rua Planaltina', 'Planalto Ayrton Senna', 'Fortaleza', 'CE'),
(40, 11, 0, 'Klyer', '2134687/41321', '793.025.993-53', 25, 'b@gmail.com', '(85) 13131-3123', 'Rua Planaltina', 'Planalto Ayrton Senna', 'Fortaleza', 'CE'),
(41, 12, 0, ' Sebastiana Marli Nascimento', 'guilhermeteste3215@#K', '503.570.465-36', 42, 'pl4kill8@gmail.com', '(48) 99261-4474', 'Rua João Batista Darós', 'Bosque do Repouso', 'Criciúma', 'SC'),
(42, 6, 0, ' Guilherme Harlei De Oliveira Lima', '123', '868.248.690-31', 17, 'pl4kill9@gmail.com', '(86) 99457-2676', 'Rua Planaltina', 'Planalto Ayrton Senna', 'Fortaleza', 'CE'),
(43, 7, 0, ' Lavínia Luiza Sabrina Da Silva', '32152356lavinia', '956.558.222-29', 25, 'pl4kill5@gmail.com', '(69) 98540-4178', 'Rua Novo Horizonte', 'Monte Alegre', 'Ariquemes', 'RO'),
(44, 12, 0, ' Guilherme', 'dawdawdwadaw', '717.695.650-27', 17, 'kkkkkk@gmail.com', '(85) 97949-4969', 'Rua Planaltina', 'Planalto Ayrton Senna', 'Fortaleza', 'CE');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pag`
--

CREATE TABLE `pag` (
  `id_p` int(11) NOT NULL,
  `id_f` int(11) NOT NULL,
  `salario_b` varchar(50) NOT NULL,
  `IR` varchar(50) NOT NULL,
  `INSS` varchar(50) NOT NULL,
  `FGTS` varchar(50) NOT NULL,
  `Vale_t` varchar(50) NOT NULL,
  `salario_l` varchar(50) NOT NULL,
  `trabalhadas_h` varchar(50) NOT NULL,
  `valor_h` varchar(50) NOT NULL,
  `data_p` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `pag`
--

INSERT INTO `pag` (`id_p`, `id_f`, `salario_b`, `IR`, `INSS`, `FGTS`, `Vale_t`, `salario_l`, `trabalhadas_h`, `valor_h`, `data_p`) VALUES
(150, 42, '1476', '221.4', '162.36', '118.08', '0', '1092.24', '123', '12', 'Junho de 2023');

-- --------------------------------------------------------

--
-- Estrutura da tabela `recu`
--

CREATE TABLE `recu` (
  `idrecu` int(8) NOT NULL,
  `token` varchar(255) NOT NULL,
  `id_f` int(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `data` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `recu`
--

INSERT INTO `recu` (`idrecu`, `token`, `id_f`, `email`, `data`) VALUES
(70, '5356417', 36, 'pl4kill7@gmail.com', '2023-06-11');

-- --------------------------------------------------------

--
-- Estrutura da tabela `soli`
--

CREATE TABLE `soli` (
  `idsol` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cpf` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(50) NOT NULL,
  `idade` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `rua` varchar(50) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `dep`
--
ALTER TABLE `dep`
  ADD PRIMARY KEY (`id_dep`);

--
-- Índices para tabela `func`
--
ALTER TABLE `func`
  ADD PRIMARY KEY (`id_f`),
  ADD KEY `id_d` (`id_d`);

--
-- Índices para tabela `pag`
--
ALTER TABLE `pag`
  ADD PRIMARY KEY (`id_p`),
  ADD KEY `id_f` (`id_f`);

--
-- Índices para tabela `recu`
--
ALTER TABLE `recu`
  ADD PRIMARY KEY (`idrecu`),
  ADD KEY `recu` (`id_f`);

--
-- Índices para tabela `soli`
--
ALTER TABLE `soli`
  ADD PRIMARY KEY (`idsol`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `dep`
--
ALTER TABLE `dep`
  MODIFY `id_dep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `func`
--
ALTER TABLE `func`
  MODIFY `id_f` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de tabela `pag`
--
ALTER TABLE `pag`
  MODIFY `id_p` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT de tabela `recu`
--
ALTER TABLE `recu`
  MODIFY `idrecu` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de tabela `soli`
--
ALTER TABLE `soli`
  MODIFY `idsol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `func`
--
ALTER TABLE `func`
  ADD CONSTRAINT `id_d` FOREIGN KEY (`id_d`) REFERENCES `dep` (`id_dep`);

--
-- Limitadores para a tabela `recu`
--
ALTER TABLE `recu`
  ADD CONSTRAINT `recu` FOREIGN KEY (`id_f`) REFERENCES `func` (`id_f`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
