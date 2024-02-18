-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07/12/2023 às 12:03
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
-- Banco de dados: `tcc`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `adm`
--

CREATE TABLE `adm` (
  `codAdm` int(11) NOT NULL,
  `nome` varchar(150) DEFAULT NULL,
  `dn` date DEFAULT NULL,
  `endereco` varchar(50) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cep` varchar(9) DEFAULT NULL,
  `uf` char(2) DEFAULT NULL,
  `cidade` varchar(100) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `celular` varchar(11) DEFAULT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `data_cad` timestamp NULL DEFAULT current_timestamp(),
  `senha` varchar(50) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `adm`
--

INSERT INTO `adm` (`codAdm`, `nome`, `dn`, `endereco`, `bairro`, `cep`, `uf`, `cidade`, `email`, `celular`, `cpf`, `data_cad`, `senha`, `status`) VALUES
(1, 'Marcela de Sá Pinheiro', '2004-04-15', '1054 Avenida Paraná', 'Centro', '87480-000', 'PR', 'Maria Helena', 'marceladesa04@gmail.com', '(44)92001-7', '094.025.679', '2023-11-27 12:10:02', '12345', 1),
(2, 'Pamela Abreu', '2004-06-15', 'Rua Tajuba 1230', 'Centro', '87538-000', 'PR', 'Umuarama', 'vitoria201547@gmail.com', '(44)98454-6', '143.502.989', '2023-11-27 12:14:29', 'euamogatos', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `codCarrinho` int(11) NOT NULL,
  `data_compra` timestamp NULL DEFAULT current_timestamp(),
  `valor` double DEFAULT NULL,
  `sessao_id` varchar(100) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `codigoProduto` int(11) DEFAULT NULL,
  `codigoCliente` int(11) DEFAULT NULL,
  `valor_total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `carrinho`
--

INSERT INTO `carrinho` (`codCarrinho`, `data_compra`, `valor`, `sessao_id`, `quantidade`, `codigoProduto`, `codigoCliente`, `valor_total`) VALUES
(6, '2023-11-28 17:48:09', 403, 'tqg0eqmm6juvjr275qtg9vnhom', 1, 5, 1, 0),
(38, '2023-11-28 18:57:23', 403, 'tqg0eqmm6juvjr275qtg9vnhom', 3, 5, 1, 0),
(39, '2023-11-28 18:59:53', 403, 'tqg0eqmm6juvjr275qtg9vnhom', 3, 5, 1, 0),
(40, '2023-11-29 11:20:06', 209, 'md5ppbjv38m3dmokn9s7f25sp1', 2, 1, 2, 0),
(45, '2023-11-29 12:26:05', 201, 'md5ppbjv38m3dmokn9s7f25sp1', 2, 2, 2, 0),
(46, '2023-11-29 12:27:21', 201, 'md5ppbjv38m3dmokn9s7f25sp1', 2, 2, 2, 0),
(47, '2023-11-29 12:29:06', 209, 'md5ppbjv38m3dmokn9s7f25sp1', 1, 1, 2, 0),
(48, '2023-11-29 12:40:55', 209, 'md5ppbjv38m3dmokn9s7f25sp1', 1, 1, 2, 0),
(49, '2023-12-01 23:53:10', 201, 'lkcvkgh9a8l9sphsu1gj65ph23', 2, 2, 1, 0),
(50, '2023-12-01 23:53:17', 201, 'lkcvkgh9a8l9sphsu1gj65ph23', 2, 2, 1, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categoria`
--

INSERT INTO `categoria` (`id`, `nome`) VALUES
(1, 'Cama'),
(2, 'Travesseiros'),
(3, 'Toalhas'),
(4, 'Almofadas'),
(5, 'Mesa');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `codCliente` int(11) NOT NULL,
  `nome` varchar(150) DEFAULT NULL,
  `dn` date DEFAULT NULL,
  `endereco` varchar(50) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cep` varchar(9) DEFAULT NULL,
  `uf` varchar(2) DEFAULT NULL,
  `cidade` varchar(100) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `celular` varchar(14) DEFAULT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `data_cad` timestamp NULL DEFAULT current_timestamp(),
  `senha` varchar(30) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`codCliente`, `nome`, `dn`, `endereco`, `bairro`, `cep`, `uf`, `cidade`, `email`, `celular`, `cpf`, `data_cad`, `senha`, `status`) VALUES
(1, 'Julia', '2002-06-15', 'Rua Tajuba 1230', 'Centro', '87538-000', 'CE', 'Abaiara', 'julia@gmail.com', '(44)98454-6776', '143.502.989', '2023-11-28 17:44:51', '34567', 1),
(2, 'Gabrielle Bonini', '2003-09-10', 'Rua tajubá', 'Centro', '87538-000', 'AL', 'Água Branca', 'bonini@gmail.com', '(44)98454-6776', '143.502.989', '2023-11-29 11:11:09', 'boniniemoca', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `itensvenda`
--

CREATE TABLE `itensvenda` (
  `codigo` int(11) NOT NULL,
  `vendaCod` int(11) NOT NULL,
  `produtoCod` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valorUnit` double(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `marca_produto`
--

CREATE TABLE `marca_produto` (
  `codMarcaProd` int(11) NOT NULL,
  `nomeMarcaProd` varchar(50) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `marca_produto`
--

INSERT INTO `marca_produto` (`codMarcaProd`, `nomeMarcaProd`, `status`) VALUES
(1, 'Rubi', 1),
(2, 'Flora', 1),
(3, 'Umaflex', 1),
(4, 'Bella', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `codProd` int(11) NOT NULL,
  `nomeProd` varchar(100) DEFAULT NULL,
  `descricao` varchar(1000) DEFAULT NULL,
  `cuidado` varchar(2000) NOT NULL,
  `med_casal` varchar(100) NOT NULL,
  `med_queen` varchar(100) NOT NULL,
  `med_superKing` varchar(100) NOT NULL,
  `med_solteiro` varchar(100) NOT NULL,
  `valor` double NOT NULL,
  `qntd` int(11) DEFAULT NULL,
  `arquivo` varchar(100) DEFAULT NULL,
  `arquivo2` varchar(100) NOT NULL,
  `marca_produto_cod` int(11) DEFAULT NULL,
  `tipo_produto_cod` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`codProd`, `nomeProd`, `descricao`, `cuidado`, `med_casal`, `med_queen`, `med_superKing`, `med_solteiro`, `valor`, `qntd`, `arquivo`, `arquivo2`, `marca_produto_cod`, `tipo_produto_cod`, `status`) VALUES
(1, 'Edredom Malha Esther 1 Peça 100% Algodão Fio 30.1 Penteado', 'Edredom perfeito para as noites frias. A lavagem na máquina deve ser ser no tempo médio e é recomendado lavá-lo sozinho na máquina em razão do seu peso.', 'Os cuidados são importantes para manter sua peça sempre bonita e agradável ao toque. Abaixo algumas dicas que irão fazer sua peça durar ainda mais. Sempre lavar com água morna ou fria. Utilizar ciclo moderado ou baixo da sua máquina de lavar. Lavar separadamente de outras peças. Não lavar a seco. Proibido usar água sanitária ou cloro. Não usar amaciante. Não centrifugar. Não torcer. Secar à sombra. Evitar uso de secadora. Manter sempre em local seco e arejado.', '01 Edredom 2,20 X 2,40', '01 Edredom 2,60 X 2,40', '01 Edredom 2,80 X 2,50', '01 Edredom 1,60 X 2,40', 209, 6, 'edredom-esther-carousel.png', 'edredom-esther-card.png', 4, 1, 1),
(2, 'Cobre Leito Juliette 3 Peças 100% Algodão Fio 30.1 Penteado', 'O Cobre Leito Malha proporciona conforto e sofisticação que você precisa. É confeccionado a partir da malha 100% algodão e o fio 30/1 penteado. Feito com matéria prima de alta qualidade que impede a formação de bolinhas. Seu cobre leito com cara de novo sempre. Possui tecido maleável que se adapta perfeitamente ao seu colchão, deixando seu quarto mais alinhado e organizado. O Cobre Leito chama atenção pela sua versatilidade, com diversas cores e estampas charmosas que irão oferecer sofisticação e qualidade o para seu quarto.', 'Os cuidados são importantes para manter sua peça sempre bonita e agradável ao toque. Abaixo algumas dicas que irão fazer sua peça durar ainda mais. Sempre lavar com água morna ou fria. Utilizar ciclo moderado ou baixo da sua máquina de lavar. Lavar separadamente de outras peças. Não lavar a seco. Proibido usar água sanitária ou cloro. Não usar amaciante. Não centrifugar. Não torcer. Secar à sombra. Evitar uso de secadora. Manter sempre em local seco e arejado.', '01 Cobre leito 2,20 X 2,40 02 Fronhas 0,50 X 0,70', '01 Cobre leito 2,60 X 2,40 02 Fronhas 0,50 X 0,70', '01 Cobre leito 2,80 X 2,50 02 Fronhas 0,50 X 0,70', '01 Cobre Leito 1,60 X 2,40 01 Fronha 0,50 X 0,70', 201, 5, 'cobre-leito-juliette-carousel.png', 'cobre-leito-juliette-card.png', 4, 2, 1),
(3, 'Cobre Leito Oslo 3 Peças 100% Algodão Fio 30.1 Penteado', 'O Cobre Leito Malha proporciona conforto e sofisticação que você precisa. É confeccionado a partir da malha 100% algodão e o fio 30/1 penteado. Feito com matéria prima de alta qualidade que impede a formação de bolinhas. Seu cobre leito com cara de novo sempre. Possui tecido maleável que se adapta perfeitamente ao seu colchão, deixando seu quarto mais alinhado e organizado. O Cobre Leito chama atenção pela sua versatilidade, com diversas cores e estampas charmosas que irão oferecer sofisticação e qualidade o para seu quarto.', 'Os cuidados são importantes para manter sua peça sempre bonita e agradável ao toque. Abaixo algumas dicas que irão fazer sua peça durar ainda mais. Sempre lavar com água morna ou fria. Utilizar ciclo moderado ou baixo da sua máquina de lavar. Lavar separadamente de outras peças. Não lavar a seco. Proibido usar água sanitária ou cloro. Não usar amaciante. Não centrifugar. Não torcer. Secar à sombra. Evitar uso de secadora. Manter sempre em local seco e arejado.', '01 Cobre leito 2,20 X 2,40 02 Fronhas 0,50 X 0,70', '01 Cobre leito 2,60 X 2,40 02 Fronhas 0,50 X 0,70', '01 Cobre leito 2,80 X 2,50 02 Fronhas 0,50 X 0,70', '01 Cobre Leito 1,60 X 2,40 01 Fronha 0,50 X 0,70', 201, 3, 'cobre-leito-oslo.png', 'cobre-leito-oslo-card.png', 4, 2, 1),
(5, 'Cobre Leito Malha Sofia 3 Peças 100% Algodão Fio 30.1 Penteado', 'O Cobre Leito Malha proporciona conforto e sofisticação que você precisa. É confeccionado a partir da malha 100% algodão e o fio 30/1 penteado.\r\nFeito com matéria prima de alta qualidade que impede a formação de bolinhas. Seu cobre leito com cara de novo sempre.\r\nPossui tecido maleável que se adapta perfeitamente ao seu colchão, deixando seu quarto mais alinhado e organizado.\r\nO Cobre Leito chama atenção pela sua versatilidade, com diversas cores e estampas charmosas que irão oferecer sofisticação e qualidade o para seu quarto.\r\n', 'Os cuidados são importantes para manter sua peça sempre bonita e agradável ao toque.\r\nAbaixo algumas dicas que irão fazer sua peça durar ainda mais.\r\nSempre lavar com água morna ou fria.\r\nUtilizar ciclo moderado ou baixo da sua máquina de lavar.\r\nLavar separadamente de outras peças.\r\nNão lavar a seco.\r\nProibido usar água sanitária ou cloro.\r\nNão usar amaciante.\r\nNão centrifugar.\r\nNão torcer.\r\nSecar à sombra.\r\nEvitar uso de secadora.\r\nManter sempre em local seco e arejado.', '01 Cobre leito 2,20 X 2,40 02 Fronhas 0,50 X 0,70', '01 Cobre leito 2,60 X 2,40 02 Fronhas 0,50 X 0,70', '01 Cobre leito 2,80 X 2,50 02 Fronhas 0,50 X 0,70', '01 Cobre Leito 1,60 X 2,40 01 Fronha 0,50 X 0,70', 323, 9, 'cobre-leito-malha-sofia.png', 'cobre_leito_malha_sofia_card.webp', 4, 2, 1),
(6, 'Travesseiro Aconchego 600 gramas - Perfil Médio Alto', 'Confeccionado com materiais de alta qualidade, este travesseiro proporciona um equilíbrio perfeito entre maciez e sustentação para uma noite de sono reparadora. \r\nA densidade do enchimento proporciona a sensação de aconchego, criando um ambiente propício para o relaxamento. Desfrute do toque suave e acolhedor do Travesseiro Aconchego, transformando suas noites em momentos de puro descanso e bem-estar.\r\n\r\n \r\n\r\nDormir em um Travesseiro que proporcione um sono profundo e relaxante e que melhor acomode a pessoa, sem dúvida alguma é um grande privilégio. O Travesseiro da Lehe vem para proporcionar tudo isso! \r\n\r\nO revestimento do Travesseiro é composto por Malha 100% algodão, tornando seu toque ainda mais macio. ', '', '', '', '', '', 59, 7, 'travesseiro-600g.png', 'travesseiro-600g-card.png', 2, 3, 1),
(7, 'Travesseiro Serena 700 gramas - Perfil Alto', 'Confeccionado com materiais de alta qualidade, este travesseiro proporciona um equilíbrio perfeito entre maciez e sustentação para uma noite de sono reparadora. \r\nA densidade do enchimento proporciona a sensação de aconchego, criando um ambiente propício para o relaxamento. Desfrute do toque suave e acolhedor do Travesseiro Aconchego, transformando suas noites em momentos de puro descanso e bem-estar.\r\nDormir em um Travesseiro que proporcione um sono profundo e relaxante e que melhor acomode a pessoa, sem dúvida alguma é um grande privilégio. O Travesseiro da Lehe vem para proporcionar tudo isso! \r\nO revestimento do Travesseiro é composto por Malha 100% algodão, tornando seu toque ainda mais macio. ', '', '', '', '', '', 69, 6, 'travesseiro-700g.png', 'travesseiro-700g-card.png', 2, 3, 1),
(8, 'Jogo de Toalha Garden 2 Peças 100% Algodão', 'O Jogo de Toalha Garden, composto por duas peças, é uma opção encantadora para elevar a experiência no seu banheiro. Confeccionadas inteiramente com 100% algodão, essas toalhas oferecem uma suavidade ao toque e uma absorção eficiente. O design do Jogo de Toalhas Garden apresenta detalhes delicados e contemporâneos, adicionando um toque de elegância ao ambiente.\r\nAlém de sua funcionalidade, essas toalhas proporcionam um toque de luxo ao seu ritual diário de cuidados pessoais. A alta qualidade do algodão garante a durabilidade do conjunto, tornando-o uma escolha prática e esteticamente agradável para o seu banheiro.', '', '', '', '', '', 61, 2, 'toalha-garden-card.png', 'toalha-garden-rosa.png', 1, 4, 1),
(9, 'Jogo de Toalhas Nina 4 Peças 100% Algodão Gramatura: 300g/m² ', 'Cada toalha é confeccionada minuciosamente com 100% algodão, oferecendo uma suavidade irresistível ao toque e uma absorção eficiente, garantindo uma sensação de frescor após cada uso.\r\nO design clássico e atemporal reflete a elegância, enquanto a durabilidade do algodão assegura que essas toalhas mantenham sua qualidade mesmo após lavagens frequentes.\r\nO Jogo de Toalhas Nina não é apenas funcional, mas também um elemento de decoração, elevando o visual do seu banheiro. Transforme o ritual diário de autocuidado em uma experiência luxuosa e sofisticada com este conjunto de toalhas que combina estilo, conforto e durabilidade.', '', '', '', '', '', 89, 1, 'jogo_de_toalhas_nina_4_pecas_100_algodao_gramatura_1.png', 'jogo_de_toalhas_nina_4_pecas_100_algodao_gramatura_card_1.png', 3, 4, 1),
(10, 'Kit com 6 Panos de Copa Matilda 100% Algodão', 'Confeccionados com 100% algodão, esses panos oferecem uma combinação irresistível de suavidade e absorção eficiente. O design contemporâneo dos panos Matilda adiciona um toque de charme à sua cozinha, transformando-os em não apenas itens funcionais, mas também em elementos decorativos.\r\nA alta qualidade do algodão garante durabilidade e resistência, tornando esses panos ideais para enfrentar as demandas diárias da cozinha. Com o conjunto de seis unidades, você terá praticidade em abundância, proporcionando um toque de requinte e praticidade ao seu espaço culinário, combinando estilo, funcionalidade e qualidade.', '', '', '', '', '', 99, 4, 'kit_com_6_panos_de_copa_matilda_100_algodao_sortidas.png', 'kit_com_6_panos_de_copa_matilda_100_algodao_sortidas_card.png', 1, 7, 1),
(12, 'Tapete de Piso Para Banheiro Ariel 1 Peça 100% Algodão', 'O Tapete de Piso para Banheiro Ariel, em uma única peça e confeccionado com 100% algodão, é a escolha perfeita para adicionar conforto e estilo ao seu banheiro. Com um toque suave e absorvente, este tapete não apenas cumpre sua função prática, mas também complementa a estética do ambiente. A qualidade do algodão garante durabilidade, tornando-o ideal para enfrentar o uso diário. Renove seu banheiro com o Tapete de Piso Ariel, proporcionando um toque de suavidade e elegância a cada passo.', 'Deixe seu banheiro ainda mais bonito com as Toalhas de Piso.\r\n\r\nAs Toalhas de Piso, conhecidas como toalhas para os pés, são importantes para a absorção da água após o banho, evitando deixar o banheiro todo molhado. Além disso, as Toalha de Piso servem para proteger os pés após o banho.', '', '', '', '', 31, 11, 'toalha-ariel.png', 'toalha-ariel-card.png', 4, 8, 1),
(13, 'Kit com 6 Tapetes de Piso para Banheiro Ariel 100% Algodão 600g/m²', 'O Kit com 6 Panos de Copa Matilda é a escolha perfeita para elevar a praticidade e a elegância na sua cozinha. Confeccionados com 100% algodão, esses panos oferecem uma combinação irresistível de suavidade e absorção eficiente. O design contemporâneo dos panos Matilda adiciona um toque de charme à sua cozinha, transformando-os em não apenas itens funcionais, mas também em elementos decorativos.\r\n\r\nA alta qualidade do algodão garante durabilidade e resistência, tornando esses panos ideais para enfrentar as demandas diárias da cozinha. Com o conjunto de seis unidades, você terá praticidade em abundância, proporcionando um toque de requinte e praticidade ao seu espaço culinário. Renove a sua cozinha com o Kit de Panos de Copa Matilda, combinando estilo, funcionalidade e qualidade.', '', '', '', '', '', 191, 9, 'toalha-ariel.png', 'toalha-ariel-card.png', 4, 8, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipo_produto`
--

CREATE TABLE `tipo_produto` (
  `codTipoProd` int(11) NOT NULL,
  `nomeTipoProd` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `categoria_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tipo_produto`
--

INSERT INTO `tipo_produto` (`codTipoProd`, `nomeTipoProd`, `status`, `categoria_id`) VALUES
(1, 'Edredom Malha', 1, 1),
(2, 'Cobre Leito Malha', 1, 1),
(3, 'Travesseiro', 1, 2),
(4, 'Toalha de Rosto e Corpo', 1, 3),
(5, 'Almofada', 1, 4),
(6, 'Cortina', 1, 4),
(7, 'Mesa', 1, 5),
(8, 'Toalha Piso', 1, 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `venda`
--

CREATE TABLE `venda` (
  `codVenda` int(11) NOT NULL,
  `codCli` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `formaPag` int(11) NOT NULL,
  `valorTotal` double(11,2) NOT NULL,
  `dataCad` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `adm`
--
ALTER TABLE `adm`
  ADD PRIMARY KEY (`codAdm`);

--
-- Índices de tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`codCarrinho`),
  ADD KEY `codigoProduto` (`codigoProduto`),
  ADD KEY `codigoCliente` (`codigoCliente`);

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`codCliente`);

--
-- Índices de tabela `itensvenda`
--
ALTER TABLE `itensvenda`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `vendaCod` (`vendaCod`),
  ADD KEY `produtoCod` (`produtoCod`);

--
-- Índices de tabela `marca_produto`
--
ALTER TABLE `marca_produto`
  ADD PRIMARY KEY (`codMarcaProd`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`codProd`),
  ADD KEY `marca_produto_cod` (`marca_produto_cod`),
  ADD KEY `tipo_produto_cod` (`tipo_produto_cod`);

--
-- Índices de tabela `tipo_produto`
--
ALTER TABLE `tipo_produto`
  ADD PRIMARY KEY (`codTipoProd`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Índices de tabela `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`codVenda`),
  ADD KEY `codCli` (`codCli`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `adm`
--
ALTER TABLE `adm`
  MODIFY `codAdm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `codCarrinho` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `codCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `itensvenda`
--
ALTER TABLE `itensvenda`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `marca_produto`
--
ALTER TABLE `marca_produto`
  MODIFY `codMarcaProd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `codProd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `tipo_produto`
--
ALTER TABLE `tipo_produto`
  MODIFY `codTipoProd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `venda`
--
ALTER TABLE `venda`
  MODIFY `codVenda` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `carrinho`
--
ALTER TABLE `carrinho`
  ADD CONSTRAINT `carrinho_ibfk_1` FOREIGN KEY (`codigoProduto`) REFERENCES `produto` (`codProd`),
  ADD CONSTRAINT `carrinho_ibfk_2` FOREIGN KEY (`codigoCliente`) REFERENCES `cliente` (`codCliente`);

--
-- Restrições para tabelas `itensvenda`
--
ALTER TABLE `itensvenda`
  ADD CONSTRAINT `itensvenda_ibfk_1` FOREIGN KEY (`vendaCod`) REFERENCES `venda` (`codVenda`),
  ADD CONSTRAINT `itensvenda_ibfk_2` FOREIGN KEY (`produtoCod`) REFERENCES `produto` (`codProd`);

--
-- Restrições para tabelas `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `produto_ibfk_1` FOREIGN KEY (`marca_produto_cod`) REFERENCES `marca_produto` (`codMarcaProd`),
  ADD CONSTRAINT `produto_ibfk_2` FOREIGN KEY (`tipo_produto_cod`) REFERENCES `tipo_produto` (`codTipoProd`);

--
-- Restrições para tabelas `tipo_produto`
--
ALTER TABLE `tipo_produto`
  ADD CONSTRAINT `tipo_produto_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`);

--
-- Restrições para tabelas `venda`
--
ALTER TABLE `venda`
  ADD CONSTRAINT `venda_ibfk_1` FOREIGN KEY (`codCli`) REFERENCES `cliente` (`codCliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
