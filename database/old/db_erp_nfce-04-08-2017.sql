-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 04-Ago-2017 às 15:39
-- Versão do servidor: 10.1.21-MariaDB
-- PHP Version: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_erp_nfce`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_adm`
--

CREATE TABLE `tab_adm` (
  `id_adm` int(11) NOT NULL,
  `nome_adm` varchar(100) NOT NULL,
  `login_adm` varchar(20) NOT NULL,
  `senha_adm` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tab_adm`
--

INSERT INTO `tab_adm` (`id_adm`, `nome_adm`, `login_adm`, `senha_adm`) VALUES
(1, 'Administrador', 'admin', 'admin'),
(2, 'Fulano de Tal', 'fulano', 'fulano123'),
(3, 'Siclano de Almeida', 'siclano', 'siclano123');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_cfop`
--

CREATE TABLE `tab_cfop` (
  `id` char(4) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `aplicacao` varchar(530) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tab_cfop`
--

INSERT INTO `tab_cfop` (`id`, `descricao`, `aplicacao`) VALUES
('1000', 'ENTRADAS OU AQUISIÇÕES DE SERVIÇOS DO ESTADO', 'Classificam-se, neste grupo, as operações ou prestações em que o estabelecimento remetente esteja localizado na mesma unidade da Federação do destinatário'),
('1100', 'COMPRAS PARA INDUSTRIALIZAÇÃO, PRODUÇÃO RURAL, COMERCIALIZAÇÃO OU PRESTAÇÃO DE SERVIÇOS', '(NR Ajuste SINIEF 05/2005) (DECRETO Nº 28.868, DE 31/01/2006)\r\n\r\n(Dec. 28.868/2006 – Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('1101', 'Compra para industrialização ou produção rural (NR Ajuste SINIEF 05/2005) (Decreto 28.868/2006)', 'Compra de mercadoria a ser utilizada em processo de industrialização ou produção rural, bem como a entrada de mercadoria em estabelecimento industrial ou produtor rural de cooperativa recebida de seus cooperados ou de estabelecimento de outra cooperativa.\r\n(DECRETO Nº 28.868, DE 31/01/2006-– Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005).'),
('1102', 'Compra para comercialização', 'Classificam-se neste código as compras de mercadorias a serem comercializadas. Também serão classificadas neste código as entradas de mercadorias em estabelecimento comercial de cooperativa recebidas de seus cooperados ou de estabelecimento de outra cooperativa.'),
('1111', 'Compra para industrialização de mercadoria recebida anteriormente em consignação industrial', 'Classificam-se neste código as compras efetivas de mercadorias a serem utilizadas em processo de industrialização, recebidas anteriormente a título de consignação industrial.'),
('1113', 'Compra para comercialização, de mercadoria recebida anteriormente em consignação mercantil', 'Classificam-se neste código as compras efetivas de mercadorias recebidas anteriormente a título de consignação mercantil.'),
('1116', 'Compra para industrialização ou produção rural originada de encomenda para recebimento futuro (NR Ajuste SINIEF 05/2005) (Decreto 28.868/2006)', 'Compra de mercadoria, a ser utilizada em processo de industrialização ou produção rural, quando da entrada real da mercadoria, cuja aquisição tenha sido classificada no código “1.922 – Lançamento efetuado a título de simples faturamento decorrente de compra para recebimento futuro”.\r\n\r\n (DECRETO Nº 28.868, DE 31/01/2006-– Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005).'),
('1117', 'Compra para comercialização originada de encomenda para recebimento futuro', 'Classificam-se neste código as compras de mercadorias a serem comercializadas, quando da entrada real da mercadoria, cuja aquisição tenha sido classificada no código 1.922 - Lançamento efetuado a título de simples faturamento decorrente de compra para recebimento futuro.'),
('1118', 'Compra de mercadoria para comercialização pelo adquirente originário, entregue pelo vendedor remetente ao destinatário, em venda à ordem.', 'Classificam-se neste código as compras de mercadorias já comercializadas, que, sem transitar pelo estabelecimento do adquirente originário, sejam entregues pelo vendedor remetente diretamente ao destinatário, em operação de venda à ordem, cuja venda seja classificada, pelo adquirente originário, no código 5.120 - Venda de mercadoria adquirida ou recebida de terceiros entregue ao destinatário pelo vendedor remetente, em venda à ordem.'),
('1120', 'Compra para industrialização, em venda à ordem, já recebida do vendedor remetente', 'Classificam-se neste código as compras de mercadorias a serem utilizadas em processo de industrialização, em vendas à ordem, já recebidas do vendedor remetente, por ordem do adquirente originário.'),
('1121', 'Compra para comercialização, em venda à ordem, já recebida do vendedor remetente', 'Classificam-se neste código as compras de mercadorias a serem comercializadas, em vendas à ordem, já recebidas do vendedor remetente por ordem do adquirente originário.'),
('1122', 'Compra para industrialização em que a mercadoria foi remetida pelo fornecedor ao industrializador sem transitar pelo estabelecimento adquirente', 'Classificam-se neste código as compras de mercadorias a serem utilizadas em processo de industrialização, remetidas pelo fornecedor para o industrializador sem que a mercadoria tenha transitado pelo estabelecimento do adquirente.'),
('1124', 'Industrialização efetuada por outra empresa', 'Classificam-se neste código as entradas de mercadorias industrializadas por terceiros, compreendendo os valores referentes aos serviços prestados e os das mercadorias de propriedade do industrializador empregadas no processo industrial. Quando a industrialização efetuada se referir a bens do ativo imobilizado ou de mercadorias para uso ou consumo do estabelecimento encomendante, a entrada deverá ser classificada nos códigos 1.551 - Compra de bem para o ativo imobilizado ou 1.556 - Compra de material para uso ou consumo.'),
('1125', 'Industrialização efetuada por outra empresa quando a mercadoria remetida para utilização no processo de industrialização não transitou pelo estabelecimento adquirente da mercadoria', 'Classificam-se neste código as entradas de mercadorias industrializadas por outras empresas, em que as mercadorias remetidas para utilização no processo de industrialização não transitaram pelo estabelecimento do adquirente das mercadorias, compreendendo os valores referentes aos serviços prestados e os das mercadorias de propriedade do industrializador empregadas no processo industrial. Quando a industrialização efetuada se referir a bens do ativo imobilizado ou de mercadorias para uso ou consumo do estabelecimento encomend'),
('1126', 'Compra para utilização na prestação de serviço', 'Classificam-se neste código as entradas de mercadorias a serem utilizadas nas prestações de serviços.'),
('1150', 'TRANSFERÊNCIAS PARA INDUSTRIALIZAÇÃO, PRODUÇÃO RURAL, COMERCIALIZAÇÃO OU PRESTAÇÃO DE SERVIÇOS (NR Ajuste SINIEF 05/2005) (Decreto 28.868/2006)', '(DECRETO Nº 28.868, DE 31/01/2006 -&#x2013; Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005).'),
('1151', 'Transferência para industrialização ou produção rural (NR Ajuste SINIEF 05/2005) (Decreto 28.868/2006)', 'Entrada de mercadoria recebida, em transferência de outro estabelecimento da mesma empresa, para ser utilizada em processo de industrialização ou produção rural.\r\n\r\n(DECRETO Nº 28.868, DE 31/01/2006-– Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005).'),
('1152', 'Transferência para comercialização', 'Classificam-se neste código as entradas de mercadorias recebidas em transferência de outro estabelecimento da mesma empresa, para serem comercializadas.'),
('1153', 'Transferência de energia elétrica para distribuição', 'Classificam-se neste código as entradas de energia elétrica recebida em transferência de outro estabelecimento da mesma empresa, para distribuição.'),
('1154', 'Transferência para utilização na prestação de serviço', 'Classificam-se neste código as entradas de mercadorias recebidas em transferência de outro estabelecimento da mesma empresa, para serem utilizadas nas prestações de serviços.'),
('1200', 'DEVOLUÇÕES DE VENDAS DE PRODUÇÃO DO ESTABELECIMENTO, DE PRODUTOS DE TERCEIROS OU ANULAÇÕES DE VALORES', NULL),
('1201', 'Devolução de venda de produção do estabelecimento', 'Devolução de venda de produto industrializado ou produzido pelo estabelecimento, cuja saída tenha sido classificada como \"Venda de produção do estabelecimento\". (NR Ajuste SINIEF 05/2005) (Decreto 28.868/2006)\r\n\r\n(DECRETO Nº 28.868, DE 31/01/2006-– Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005).'),
('1202', 'Devolução de venda de mercadoria adquirida ou recebida de terceiros', 'Classificam-se neste código as devoluções de vendas de mercadorias adquiridas ou recebidas de terceiros, que não tenham sido objeto de industrialização no estabelecimento, cujas saídas tenham sido classificadas como Venda de mercadoria adquirida ou recebida de terceiros.'),
('1203', 'Devolução de venda de produção do estabelecimento, destinada à Zona Franca de Manaus ou Áreas de Livre Comércio', 'Devolução de venda de produto industrializado ou produzido pelo estabelecimento, cuja saída tenha sido classificada no código \"5.109 – Venda de produção do estabelecimento destinada à Zona Franca de Manaus ou Áreas de Livre Comércio\". (NR Ajuste SINIEF 05/2005) (Decreto 28.868/2006)\r\n\r\n(DECRETO Nº 28.868, DE 31/01/2006-– Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005).'),
('1204', 'Devolução de venda de mercadoria adquirida ou recebida de terceiros, destinada à Zona Franca de Manaus ou Áreas de Livre Comércio', 'Classificam-se neste código as devoluções de vendas de mercadorias adquiridas ou recebidas de terceiros, cujas saídas foram classificadas no código 5.110 - Venda de mercadoria adquirida ou recebida de terceiros, destinada à Zona Franca de Manaus ou Áreas de Livre Comércio.'),
('1205', 'Anulação de valor relativo à prestação de serviço de comunicação', 'Classificam-se neste código as anulações correspondentes a valores faturados indevidamente, decorrentes de prestações de serviços de comunicação.'),
('1206', 'Anulação de valor relativo à prestação de serviço de transporte', 'Classificam-se neste código as anulações correspondentes a valores faturados indevidamente, decorrentes de prestações de serviços de transporte.'),
('1207', 'Anulação de valor relativo à venda de energia elétrica', 'Classificam-se neste código as anulações correspondentes a valores faturados indevidamente, decorrentes de venda de energia elétrica.'),
('1208', 'Devolução de produção do estabelecimento, remetida em transferência', 'Devolução de produto industrializado ou produzido pelo estabelecimento transferido para outro estabelecimento da mesma empresa. (NR Ajuste SINIEF 05/2005) (Decreto 28.868/2006)\r\n\r\n(DECRETO Nº 28.868, DE 31/01/2006-– Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005).'),
('1209', 'Devolução de mercadoria adquirida ou recebida de terceiros, remetida em transferência', 'Classificam-se neste código as devoluções de mercadorias adquiridas ou recebidas de terceiros, transferidas para outros estabelecimentos da mesma empresa.'),
('1250', 'COMPRAS DE ENERGIA ELÉTRICA', NULL),
('1251', 'Compra de energia elétrica para distribuição ou comercialização', 'Classificam-se neste código as compras de energia elétrica utilizada em sistema de distribuição ou comercialização. Também serão classificadas neste código as compras de energia elétrica por cooperativas para distribuição aos seus cooperados.'),
('1252', 'Compra de energia elétrica por estabelecimento industrial', 'Classificam-se neste código as compras de energia elétrica utilizada no processo de industrialização. Também serão classificadas neste código as compras de energia elétrica utilizada por estabelecimento industrial de cooperativa.'),
('1253', 'Compra de energia elétrica por estabelecimento comercial', 'Classificam-se neste código as compras de energia elétrica utilizada por estabelecimento comercial. Também serão classificadas neste código as compras de energia elétrica utilizada por estabelecimento comercial de cooperativa.'),
('1254', 'Compra de energia elétrica por estabelecimento prestador de serviço de transporte', 'Classificam-se neste código as compras de energia elétrica utilizada por estabelecimento prestador de serviços de transporte.'),
('1255', 'Compra de energia elétrica por estabelecimento prestador de serviço de comunicação', 'Classificam-se neste código as compras de energia elétrica utilizada por estabelecimento prestador de serviços de comunicação.'),
('1256', 'Compra de energia elétrica por estabelecimento de produtor rural', 'Classificam-se neste código as compras de energia elétrica utilizada por estabelecimento de produtor rural.'),
('1257', 'Compra de energia elétrica para consumo por demanda contratada', 'Classificam-se neste código as compras de energia elétrica para consumo por demanda contratada, que prevalecerá sobre os demais códigos deste subgrupo.'),
('1300', 'AQUISIÇÕES DE SERVIÇOS DE COMUNICAÇÃO', NULL),
('1301', 'Aquisição de serviço de comunicação para execução de serviço da mesma natureza', 'Classificam-se neste código as aquisições de serviços de comunicação utilizados nas prestações de serviços da mesma natureza.'),
('1302', 'Aquisição de serviço de comunicação por estabelecimento industrial', 'Classificam-se neste código as aquisições de serviços de comunicação utilizados por estabelecimento industrial. Também serão classificadas neste código as aquisições de serviços de comunicação utilizados por estabelecimento industrial de cooperativa.'),
('1303', 'Aquisição de serviço de comunicação por estabelecimento comercial', 'Classificam-se neste código as aquisições de serviços de comunicação utilizados por estabelecimento comercial. Também serão classificadas neste código as aquisições de serviços de comunicação utilizados por estabelecimento comercial de cooperativa.'),
('1304', 'Aquisição de serviço de comunicação por estabelecimento de prestador de serviço de transporte', 'Classificam-se neste código as aquisições de serviços de comunicação utilizados por estabelecimento prestador de serviço de transporte.'),
('1305', 'Aquisição de serviço de comunicação por estabelecimento de geradora ou de distribuidora de energia elétrica', 'Classificam-se neste código as aquisições de serviços de comunicação utilizados por estabelecimento de geradora ou de distribuidora de energia elétrica.'),
('1306', 'Aquisição de serviço de comunicação por estabelecimento de produtor rural', 'Classificam-se neste código as aquisições de serviços de comunicação utilizados por estabelecimento de produtor rural.'),
('1350', 'AQUISIÇÕES DE SERVIÇOS DE TRANSPORTE', NULL),
('1351', 'Aquisição de serviço de transporte para execução de serviço da mesma natureza', 'Classificam-se neste código as aquisições de serviços de transporte utilizados nas prestações de serviços da mesma natureza.'),
('1352', 'Aquisição de serviço de transporte por estabelecimento industrial', 'Classificam-se neste código as aquisições de serviços de transporte utilizados por estabelecimento industrial. Também serão classificadas neste código as aquisições de serviços de transporte utilizados por estabelecimento industrial de cooperativa.'),
('1353', 'Aquisição de serviço de transporte por estabelecimento comercial', 'Classificam-se neste código as aquisições de serviços de transporte utilizados por estabelecimento comercial. Também serão classificadas neste código as aquisições de serviços de transporte utilizados por estabelecimento comercial de cooperativa.'),
('1354', 'Aquisição de serviço de transporte por estabelecimento de prestador de serviço de comunicação', 'Classificam-se neste código as aquisições de serviços de transporte utilizados por estabelecimento prestador de serviços de comunicação.'),
('1355', 'Aquisição de serviço de transporte por estabelecimento de geradora ou de distribuidora de energia elétrica', 'Classificam-se neste código as aquisições de serviços de transporte utilizados por estabelecimento de geradora ou de distribuidora de energia elétrica.'),
('1356', 'Aquisição de serviço de transporte por estabelecimento de produtor rural', 'Classificam-se neste código as aquisições de serviços de transporte utilizados por estabelecimento de produtor rural.'),
('1360', 'Aquisição de serviço de transporte por contribuinte-substituto em relação ao serviço de transporte (ACR) (Ajuste SINIEF 06/2007- Decreto nº 30.861/2007) –– a partir de 01.01.2008', 'Aquisição de serviço de transporte quando o adquirente for contribuinte-substituto em relação ao imposto incidente na prestação dos serviços'),
('1400', 'ENTRADAS DE MERCADORIAS SUJEITAS AO REGIME DE SUBSTITUIÇÃO TRIBUTÁRIA', NULL),
('1401', 'Compra para industrialização ou produção rural de mercadoria sujeita ao regime de substituição tributária (NR Ajuste SINIEF 05/2005) (Decreto 28.868/2006)', 'Compra de mercadoria sujeita ao regime de substituição tributária, a ser utilizada em processo de industrialização ou produção rural, bem como compra, por estabelecimento industrial ou produtor rural de cooperativa, de mercadoria sujeita ao mencionado regime.\r\n\r\n(DECRETO Nº 28.868, DE 31/01/2006-– Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005).'),
('1403', 'Compra para comercialização em operação com mercadoria sujeita ao regime de substituição tributária', 'Classificam-se neste código as compras de mercadorias a serem comercializadas, decorrentes de operações com mercadorias sujeitas ao regime de substituição tributária. Também serão classificadas neste código as compras de mercadorias sujeitas ao regime de substituição tributária em estabelecimento comercial de cooperativa.'),
('1406', 'Compra de bem para o ativo imobilizado cuja mercadoria está sujeita ao regime de substituição tributária', 'Classificam-se neste código as compras de bens destinados ao ativo imobilizado do estabelecimento, em operações com mercadorias sujeitas ao regime de substituição tributária.'),
('1407', 'Compra de mercadoria para uso ou consumo cuja mercadoria está sujeita ao regime de substituição tributária', 'Classificam-se neste código as compras de mercadorias destinadas ao uso ou consumo do estabelecimento, em operações com mercadorias sujeitas ao regime de substituição tributária.'),
('1408', 'Transferência para industrialização ou produção rural de mercadoria sujeita ao regime de substituição tributária (NR Ajuste SINIEF 05/2005) (Decreto 28.868/2006)', 'Mercadoria sujeita ao regime de substituição tributária, recebida em transferência de outro estabelecimento da mesma empresa, para ser industrializada ou consumida na produção rural no estabelecimento.\r\n\r\n(DECRETO Nº 28.868, DE 31/01/2006-– Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005).'),
('1409', 'Transferência para comercialização em operação com mercadoria sujeita ao regime de substituição tributária', 'Classificam-se neste código as mercadorias recebidas em transferência de outro estabelecimento da mesma empresa, para serem comercializadas, decorrentes de operações sujeitas ao regime de substituição tributária.'),
('1410', 'Devolução de venda de mercadoria, de produção do estabelecimento, sujeita ao regime de substituição tributária', 'Devolução de produto industrializado ou produzido pelo estabelecimento, cuja saída tenha sido classificada como \"Venda de mercadoria de produção do estabelecimento sujeita ao regime de substituição tributária\".\r\n\r\n(NR Ajuste SINIEF 05/2005) (DECRETO Nº 28.868, DE 31/01/2006-– Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005).'),
('1411', 'Devolução de venda de mercadoria adquirida ou recebida de terceiros em operação com mercadoria sujeita ao regime de substituição tributária', 'Classificam-se neste código as devoluções de vendas de mercadorias adquiridas ou recebidas de terceiros, cujas saídas tenham sido classificadas como Venda de mercadoria adquirida ou recebida de terceiros em operação com mercadoria sujeita ao regime de substituição tributária.'),
('1414', 'Retorno de mercadoria de produção do estabelecimento, remetida para venda fora do estabelecimento, sujeita ao regime de substituição tributária', 'Entrada, em retorno, de produto industrializado ou produzido pelo próprio estabelecimento, remetido para venda fora do estabelecimento, inclusive por meio de veículo, sujeito ao regime de substituição tributária e não comercializado.\r\n\r\n (NR Ajuste SINIEF 05/2005) (DECRETO Nº 28.868, DE 31/01/2006-– Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005).'),
('1415', 'Retorno de mercadoria adquirida ou recebida de terceiros, remetida para venda fora do estabelecimento em operação com mercadoria sujeita ao regime de substituição tributária', 'Classificam-se neste código as entradas, em retorno, de mercadorias adquiridas ou recebidas de terceiros remetidas para vendas fora do estabelecimento, inclusive por meio de veículos, em operações com mercadorias sujeitas ao regime de substituição tributária, e não comercializadas.'),
('1450', 'SISTEMAS DE INTEGRAÇÃO', NULL),
('1451', 'Retorno de animal do estabelecimento produtor', 'Classificam-se neste código as entradas referentes ao retorno de animais criados pelo produtor no sistema integrado.'),
('1452', 'Retorno de insumo não utilizado na produção', 'Classificam-se neste código o retorno de insumos não utilizados pelo produtor na criação de animais pelo sistema integrado.'),
('1500', 'ENTRADAS DE MERCADORIAS REMETIDAS PARA FORMAÇÃO DE LOTE OU COM FIM ESPECÍFICO DE EXPORTAÇÃO E EVENTUAIS DEVOLUÇÕES (NR Ajuste SINIEF 09/2005)', '(DECRETO Nº 28.868, DE 31/01/2006—(Dec.\r\n28.868/2006 - a sua aplicação será obrigatória em relação aos fatos geradores ocorridos a partir de 01 de julho de 2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de janeiro a 30 de junho de 2006.'),
('1501', 'Entrada de mercadoria recebida com fim específico de exportação', 'Classificam-se neste código as entradas de mercadorias em estabelecimento de trading company, empresa comercial exportadora ou outro estabelecimento do remetente, com fim específico de exportação.'),
('1503', 'Entrada decorrente de devolução de produto, de fabricação do estabelecimento, remetido com fim específico de exportação', 'Devolução de produto industrializado ou produzido pelo estabelecimento, remetido a \"trading company\", a empresa comercial exportadora ou a outro estabelecimento do remetente, com fim específico de exportação, cuja saída tenha sido classificada no código \"5.501 – Remessa de produção do estabelecimento com fim específico de exportação\".\r\n\r\n(NR Ajuste SINIEF 05/2005) (Dec.28.868/2006 - a sua aplicação será obrigatória em relação aos fatos geradores ocorridos a partir de 01 de julho de 2006, ficando facultada ao contribuinte a s'),
('1504', 'Entrada decorrente de devolução de mercadoria remetida com fim específico de exportação, adquirida ou recebida de terceiros', 'Devolução de mercadoria, adquirida ou recebida de terceiro, remetida a trading company, a empresa comercial exportadora ou a outro estabelecimento do remetente, com fim específico de exportação, cuja saída tenha sido classificada no código “5.502 - Remessa de mercadoria adquirida ou recebida de terceiros, com fim específico de exportação”.'),
('1505', 'Entrada decorrente de devolução simbólica de mercadoria remetida para formação de lote de exportação, de produto industrializado ou produzido pelo próprio estabelecimento.', 'Devolução simbólica de mercadoria remetida para formação de lote de exportação, cuja saída tenha sido classificada no código \"5.504 – Remessa de mercadoria para formação de lote de exportação, de produto industrializado ou produzido pelo próprio estabelecimento\".\r\n\r\n (ACR Ajuste SINIEF 09/2005) (Dec.28.868/2006 - a sua aplicação será obrigatória em relação aos fatos geradores ocorridos a partir de 01 de julho de 2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de janeiro a '),
('1506', 'Entrada decorrente de devolução simbólica de mercadoria, adquirida ou recebida de terceiros, remetida para formação de lote de exportação.', 'Devolução simbólica de mercadoria remetida para formação de lote de exportação em armazéns alfandegados, entrepostos aduaneiros ou outros estabelecimentos que venham a ser regulamentados pela legislação tributária de cada Unidade Federada, efetuada pelo estabelecimento depositário, cuja saída tenha sido classificada no código \"5.505 – Remessa de mercadoria, adquirida ou recebida de terceiros, para formação de lote de exportação\".\r\n\r\n (ACR Ajuste SINIEF 09/2005) (NR Ajuste SINIEF 05/2005) (Dec.28.868/2006 - a sua aplicação se'),
('1550', 'OPERAÇÕES COM BENS DE ATIVO IMOBILIZADO E MATERIAIS PARA USO OU CONSUMO', NULL),
('1551', 'Compra de bem para o ativo imobilizado', 'Classificam-se neste código as compras de bens destinados ao ativo imobilizado do estabelecimento.'),
('1552', 'Transferência de bem do ativo imobilizado', 'Classificam-se neste código as entradas de bens destinados ao ativo imobilizado recebidos em transferência de outro estabelecimento da mesma empresa.'),
('1553', 'Devolução de venda de bem do ativo imobilizado', 'Classificam-se neste código as devoluções de vendas de bens do ativo imobilizado, cujas saídas tenham sido classificadas no código 5.551 - Venda de bem do ativo imobilizado.'),
('1554', 'Retorno de bem do ativo imobilizado remetido para uso fora do estabelecimento', 'Classificam-se neste código as entradas por retorno de bens do ativo imobilizado remetidos para uso fora do estabelecimento, cujas saídas tenham sido classificadas no código 5.554 - Remessa de bem do ativo imobilizado para uso fora do estabelecimento.'),
('1555', 'Entrada de bem do ativo imobilizado de terceiro, remetido para uso no estabelecimento', 'Classificam-se neste código as entradas de bens do ativo imobilizado de terceiros, remetidos para uso no estabelecimento.'),
('1556', 'Compra de material para uso ou consumo', 'Classificam-se neste código as compras de mercadorias destinadas ao uso ou consumo do estabelecimento.'),
('1557', 'Transferência de material para uso ou consumo', 'Classificam-se neste código as entradas de materiais para uso ou consumo recebidos em transferência de outro estabelecimento da mesma empresa.'),
('1600', 'CRÉDITOS E RESSARCIMENTOS DE ICMS', NULL),
('1601', 'Recebimento, por transferência, de crédito de ICMS', 'Classificam-se neste código os lançamentos destinados ao registro de créditos de ICMS, recebidos por transferência de outras empresas.'),
('1602', 'Recebimento, por transferência, de saldo credor do ICMS, de outro estabelecimento da mesma empresa, para compensação de saldo devedor do imposto.', 'Lançamento destinado ao registro da transferência de saldo credor do ICMS, recebido de outro estabelecimento da mesma empresa, destinado à compensação do saldo devedor do estabelecimento, inclusive no caso de apuração centralizada do imposto.\r\n\r\n(NR Ajuste SINIEF 9/2003 – a partir 01.01.2004) (Decreto nº 26.174/2003)'),
('1603', 'Ressarcimento de ICMS retido por substituição tributária', 'Lançamento destinado ao registro de ressarcimento de ICMS retido por substituição tributária à contribuinte substituído, efetuado pelo contribuinte substituto, ou, ainda, quando o ressarcimento for apropriado pelo próprio contribuinte substituído, nas hipóteses previstas na legislação aplicável.'),
('1604', 'Lançamento do crédito relativo à compra de bem para o ativo imobilizado', 'Lançamento destinado ao registro da apropriação de crédito de bem do ativo imobilizado. (Dec.25.068/2003-EFEITOS A PARTIR DE 01.01.2003)'),
('1605', 'Recebimento, por transferência, de saldo devedor do ICMS de outro estabelecimento da mesma empresa', 'Lançamento destinado ao registro da transferência de saldo devedor do ICMS, recebido de outro estabelecimento da mesma empresa, para efetivação da apuração centralizada do imposto. (ACR Ajuste SINIEF 03/2004) (DECRETO Nº 26.810/2004) (a partir de 01.01.2005)'),
('1650', 'ENTRADAS DE COMBUSTÍVEIS, DERIVADOS OU NÃO DE PETRÓLEO, E LUBRIFICANTES (ACR Ajuste SINIEF 9/2003 - a partir 01.01.2004)', NULL),
('1651', 'Compra de combustível ou lubrificante para industrialização subseqüente', 'Compra de combustível ou lubrificante a ser utilizados em processo de industrialização do próprio produto. (ACR Ajuste SINIEF 9/2003 - a partir 01.01.2004)'),
('1652', 'Compra de combustível ou lubrificante para comercialização', 'Compra de combustível ou lubrificante a ser comercializados. (ACR Ajuste SINIEF 9/2003 - a partir 01.01.2004)'),
('1653', 'Compra de combustível ou lubrificante por consumidor ou usuário final', 'Compra de combustível ou lubrificante, a ser consumidos em processo de industrialização de outros produtos, na produção rural, na prestação de serviço ou por usuário final.\r\n\r\n(NR Ajuste SINIEF 05/2005) (Dec.28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('1658', 'Transferência de combustível ou lubrificante para industrialização', 'Entrada de combustível ou lubrificante, recebidos em transferência de outro estabelecimento da mesma empresa, para ser utilizados em processo de industrialização do próprio produto.(Decreto 26.174/2003)(efeitos a partir 01.01.2004)'),
('1659', 'Transferência de combustível ou lubrificante para comercialização', 'Entrada de combustível ou lubrificante, recebidos em transferência de outro estabelecimento da mesma empresa, para ser comercializados. .(Decreto 26.174/2003) (efeitos a partir 01.01.2004)'),
('1660', 'Devolução de venda de combustível ou lubrificante destinados à industrialização subseqüente', 'Devolução de venda de combustível ou lubrificante, cuja saída tenha sido classificada como \"Venda de combustível ou lubrificante destinados à industrialização subseqüente\". (Decreto 26.174/2003)(efeitos a partir 01.01.2004)'),
('1661', 'Devolução de venda de combustível ou lubrificante destinados à comercialização', 'Devolução de venda de combustível ou lubrificante, cuja saída tenha sido classificada como \"Venda de combustível ou lubrificante para comercialização\".(Decreto 26.174/2003)(efeitos a partir 01.01.2004).'),
('1662', 'Devolução de venda de combustível ou lubrificante destinados a consumidor ou usuário final', 'Devolução de venda de combustível ou lubrificante, cuja saída tenha sido classificada como \"Venda de combustível ou lubrificante por consumidor ou usuário final\"..(Decreto 26.174/2003)(efeitos a partir 01.01.2004)'),
('1663', 'Entrada de combustível ou lubrificante para armazenagem', 'Entrada de combustível ou lubrificante para armazenagem. .(Decreto 26.174/2003)(efeitos a partir 01.01.2004)'),
('1664', 'Retorno de combustível ou lubrificante remetidos para armazenagem', 'Entrada, ainda que simbólica, por retorno de combustível ou lubrificante, remetidos para armazenagem. .(Decreto 26.174/2003)(efeitos a partir 01.01.2004)'),
('1900', 'OUTRAS ENTRADAS DE MERCADORIAS OU AQUISIÇÕES DE SERVIÇOS', NULL),
('1901', 'Entrada para industrialização por encomenda', 'Classificam-se neste código as entradas de insumos recebidos para industrialização por encomenda de outra empresa ou de outro estabelecimento da mesma empresa.'),
('1902', 'Retorno de mercadoria remetida para industrialização por encomenda', 'Classificam-se neste código o retorno dos insumos remetidos para industrialização por encomenda, incorporados ao produto final pelo estabelecimento industrializador.'),
('1903', 'Entrada de mercadoria remetida para industrialização e não aplicada no referido processo', 'Classificam-se neste código as entradas em devolução de insumos remetidos para industrialização e não aplicados no referido processo.'),
('1904', 'Retorno de remessa para venda fora do estabelecimento', 'Classificam-se neste código as entradas em retorno de mercadorias remetidas para venda fora do estabelecimento, inclusive por meio de veículos, e não comercializadas.'),
('1905', 'Entrada de mercadoria recebida para depósito em depósito fechado ou armazém geral', 'Classificam-se neste código as entradas de mercadorias recebidas para depósito em depósito fechado ou armazém geral.'),
('1906', 'Retorno de mercadoria remetida para depósito fechado ou armazém geral', 'Classificam-se neste código as entradas em retorno de mercadorias remetidas para depósito em depósito fechado ou armazém geral.'),
('1907', 'Retorno simbólico de mercadoria remetida para depósito fechado ou armazém geral', 'Classificam-se neste código as entradas em retorno simbólico de mercadorias remetidas para depósito em depósito fechado ou armazém geral, quando as mercadorias depositadas tenham sido objeto de saída a qualquer título e que não tenham retornado ao estabelecimento depositante.'),
('1908', 'Entrada de bem por conta de contrato de comodato', 'Classificam-se neste código as entradas de bens recebidos em cumprimento de contrato de comodato.'),
('1909', 'Retorno de bem remetido por conta de contrato de comodato', 'Classificam-se neste código as entradas de bens recebidos em devolução após cumprido o contrato de comodato.'),
('1910', 'Entrada de bonificação, doação ou brinde', 'Classificam-se neste código as entradas de mercadorias recebidas a título de bonificação, doação ou brinde.'),
('1911', 'Entrada de amostra grátis', 'Classificam-se neste código as entradas de mercadorias recebidas a título de amostra grátis.'),
('1912', 'Entrada de mercadoria ou bem recebido para demonstração', 'Classificam-se neste código as entradas de mercadorias ou bens recebidos para demonstração.'),
('1913', 'Retorno de mercadoria ou bem remetido para demonstração', 'Classificam-se neste código as entradas em retorno de mercadorias ou bens remetidos para demonstração.'),
('1914', 'Retorno de mercadoria ou bem remetido para exposição ou feira', 'Classificam-se neste código as entradas em retorno de mercadorias ou bens remetidos para exposição ou feira.'),
('1915', 'Entrada de mercadoria ou bem recebido para conserto ou reparo', 'Classificam-se neste código as entradas de mercadorias ou bens recebidos para conserto ou reparo.'),
('1916', 'Retorno de mercadoria ou bem remetido para conserto ou reparo', 'Classificam-se neste código as entradas em retorno de mercadorias ou bens remetidos para conserto ou reparo.'),
('1917', 'Entrada de mercadoria recebida em consignação mercantil ou industrial', 'Classificam-se neste código as entradas de mercadorias recebidas a título de consignação mercantil ou industrial.'),
('1918', 'Devolução de mercadoria remetida em consignação mercantil ou industrial', 'Classificam-se neste código as entradas por devolução de mercadorias remetidas anteriormente a título de consignação mercantil ou industrial.'),
('1919', 'Devolução simbólica de mercadoria vendida ou utilizada em processo industrial, remetida anteriormente em consignação mercantil ou industrial', 'Classificam-se neste código as entradas por devolução simbólica de mercadorias vendidas ou utilizadas em processo industrial, remetidas anteriormente a título de consignação mercantil ou industrial.'),
('1920', 'Entrada de vasilhame ou sacaria', 'Classificam-se neste código as entradas de vasilhame ou sacaria.'),
('1921', 'Retorno de vasilhame ou sacaria', 'Classificam-se neste código as entradas em retorno de vasilhame ou sacaria.'),
('1922', 'Lançamento efetuado a título de simples faturamento decorrente de compra para recebimento futuro', 'Classificam-se neste código os registros efetuados a título de simples faturamento decorrente de compra para recebimento futuro.'),
('1923', 'Entrada de mercadoria recebida do vendedor remetente, em venda à ordem', 'Classificam-se neste código as entradas de mercadorias recebidas do vendedor remetente, em vendas à ordem, cuja compra do adquirente originário, foi classificada nos códigos 1.120 - Compra para industrialização, em venda à ordem, já recebida do vendedor remetente ou 1.121 - Compra para comercialização, em venda à ordem, já recebida do vendedor remetente.'),
('1924', 'Entrada para industrialização por conta e ordem do adquirente da mercadoria, quando esta não transitar pelo estabelecimento do adquirente', 'Classificam-se neste código as entradas de insumos recebidos para serem industrializados por conta e ordem do adquirente, nas hipóteses em que os insumos não tenham transitado pelo estabelecimento do adquirente dos mesmos.'),
('1925', 'Retorno de mercadoria remetida para industrialização por conta e ordem do adquirente da mercadoria, quando esta não transitar pelo estabelecimento do adquirente', 'Classificam-se neste código o retorno dos insumos remetidos por conta e ordem do adquirente, para industrialização e incorporados ao produto final pelo estabelecimento industrializador, nas hipóteses em que os insumos não tenham transitado pelo estabelecimento do adquirente.'),
('1926', 'Lançamento efetuado a título de reclassificação de mercadoria decorrente de formação de kit ou de sua desagregação', 'Classificam-se neste código os registros efetuados a título de reclassificação decorrente de formação de kit de mercadorias ou de sua desagregação.'),
('1931', 'Lançamento efetuado pelo tomador do serviço de transporte, quando a responsabilidade de retenção do imposto for atribuída ao remetente ou alienante da mercadoria, pelo serviço de transporte realizado ', 'Lançamento efetuado pelo tomador do serviço de transporte realizado por transportador autônomo ou por transportador não-inscrito na Unidade da Federação onde se tenha iniciado o serviço, quando a responsabilidade pela retenção do imposto for atribuída ao remetente ou alienante da mercadoria.\r\n\r\n (ACR Ajuste SINIEF 03/2004) (DECRETO Nº 26.810/2004))(efeitos a partir 01.01.2005)'),
('1932', 'Aquisição de serviço de transporte iniciado em Unidade da Federação diversa daquela onde esteja inscrito o prestador', 'Aquisição de serviço de transporte que tenha sido iniciado em Unidade da Federação diversa daquela onde o prestador esteja inscrito como contribuinte. (ACR Ajuste SINIEF 03/2004) (DECRETO Nº 26.810/2004) (efeitos a partir 01.01.2005)'),
('1933', 'Aquisição de serviço tributado pelo Imposto sobre Serviços de Qualquer Natureza (Ajuste SINIEF 06/2005) (NR)', 'Aquisição de serviço, cujo imposto é de competência municipal, desde que informado em Nota Fiscal modelo 1 ou 1-A. (NR Ajuste SINIEF 06/2005) (DECRETO Nº 26.868/2006 - efeitos a partir 01.01.2006)'),
('1949', 'Outra entrada de mercadoria ou prestação de serviço não especificada', 'Classificam-se neste código as outras entradas de mercadorias ou prestações de serviços que não tenham sido especificadas nos códigos anteriores.'),
('2000', 'ENTRADAS OU AQUISIÇÕES DE SERVIÇOS DE OUTROS ESTADOS', 'Classificam-se, neste grupo, as operações ou prestações em que o estabelecimento remetente esteja localizado em unidade da Federação diversa daquela do destinatário'),
('2100', 'COMPRAS PARA INDUSTRIALIZAÇÃO, PRODUÇÃO RURAL, COMERCIALIZAÇÃO OU PRESTAÇÃO DE SERVIÇOS (NR Ajuste SINIEF 05/2005  (Decreto 28.868/2006)', '(NR Ajuste SINIEF 05/2005) (Dec. 28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('2101', 'Compra para industrialização ou produção rural (NR Ajuste SINIEF 05/2005) (Decreto 28.868/2006)', 'Compra de mercadoria a ser utilizada em processo de industrialização ou produção rural, bem como a entrada de mercadoria em estabelecimento industrial ou produtor rural de cooperativa, recebida de seus cooperados ou de estabelecimento de outra cooperativa.\r\n\r\n(NR Ajuste SINIEF 05/2005) (Dec. 28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('2102', 'Compra para comercialização', 'Classificam-se neste código as compras de mercadorias a serem comercializadas. Também serão classificadas neste código as entradas de mercadorias em estabelecimento comercial de cooperativa recebidas de seus cooperados ou de estabelecimento de outra cooperativa.'),
('2111', 'Compra para industrialização de mercadoria recebida anteriormente em consignação industrial', 'Classificam-se neste código as compras efetivas de mercadorias a serem utilizadas em processo de industrialização, recebidas anteriormente a título de consignação industrial.'),
('2113', 'Compra para comercialização, de mercadoria recebida anteriormente em consignação mercantil', 'Classificam-se neste código as compras efetivas de mercadorias recebidas anteriormente a título de consignação mercantil.'),
('2116', 'Compra para industrialização ou produção rural originada de encomenda para recebimento futuro (NR Ajuste SINIEF 05/2005) (Decreto 28.868/2006)', 'Compra de mercadoria a ser utilizada em processo de industrialização ou produção rural, quando da entrada real da mercadoria, cuja aquisição tenha sido classificada no código \"2.922 – Lançamento efetuado a título de simples faturamento decorrente de compra para recebimento futuro\".\r\n\r\n(NR Ajuste SINIEF 05/2005) (Dec. 28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('2117', 'Compra para comercialização originada de encomenda para recebimento futuro', 'Classificam-se neste código as compras de mercadorias a serem comercializadas, quando da entrada real da mercadoria, cuja aquisição tenha sido classificada no código 2.922 - Lançamento efetuado a título de simples faturamento decorrente de compra para recebimento futuro.'),
('2118', 'Compra de mercadoria para comercialização pelo adquirente originário, entregue pelo vendedor remetente ao destinatário, em venda à ordem', 'Classificam-se neste código as compras de mercadorias já comercializadas, que, sem transitar pelo estabelecimento do adquirente originário, sejam entregues pelo vendedor remetente diretamente ao destinatário, em operação de venda à ordem, cuja venda seja classificada, pelo adquirente originário, no código 6.120 - Venda de mercadoria adquirida ou recebida de terceiros entregue ao destinatário pelo vendedor remetente, em venda à ordem.'),
('2120', 'Compra para industrialização, em venda à ordem, já recebida do vendedor remetente', 'Classificam-se neste código as compras de mercadorias a serem utilizadas em processo de industrialização, em vendas à ordem, já recebidas do vendedor remetente, por ordem do adquirente originário.'),
('2121', 'Compra para comercialização, em venda à ordem, já recebida do vendedor remetente', 'Classificam-se neste código as compras de mercadorias a serem comercializadas, em vendas à ordem, já recebidas do vendedor remetente por ordem do adquirente originário.'),
('2122', 'Compra para industrialização em que a mercadoria foi remetida pelo fornecedor ao industrializador sem transitar pelo estabelecimento adquirente', 'Classificam-se neste código as compras de mercadorias a serem utilizadas em processo de industrialização, remetidas pelo fornecedor para o industrializador sem que a mercadoria tenha transitado pelo estabelecimento do adquirente.'),
('2124', 'Industrialização efetuada por outra empresa', 'Classificam-se neste código as entradas de mercadorias industrializadas por terceiros, compreendendo os valores referentes aos serviços prestados e os das mercadorias de propriedade do industrializador empregadas no processo industrial. Quando a industrialização efetuada se referir a bens do ativo imobilizado ou de mercadorias para uso ou consumo do estabelecimento encomendante, a entrada deverá ser classificada nos códigos 2.551 - Compra de bem para o ativo imobilizado ou 2.556 - Compra de material para uso ou consumo.'),
('2125', 'Industrialização efetuada por outra empresa quando a mercadoria remetida para utilização no processo de industrialização não transitou pelo estabelecimento adquirente da mercadoria', 'Classificam-se neste código as entradas de mercadorias industrializadas por outras empresas, em que as mercadorias remetidas para utilização no processo de industrialização não transitaram pelo estabelecimento do adquirente das mercadorias, compreendendo os valores referentes aos serviços prestados e os das mercadorias de propriedade do industrializador empregadas no processo industrial. Quando a industrialização efetuada se referir a bens do ativo imobilizado ou de mercadorias para uso ou consumo do estabelecimento encomend'),
('2126', 'Compra para utilização na prestação de serviço', 'Classificam-se neste código as entradas de mercadorias a serem utilizadas nas prestações de serviços.'),
('2150', 'TRANSFERÊNCIAS PARA INDUSTRIALIZAÇÃO, PRODUÇÃO RURAL, COMERCIALIZAÇÃO OU PRESTAÇÃO DE SERVIÇOS (NR Ajuste SINIEF 05/2005) (Decreto 28.868/2006)', '(NR Ajuste SINIEF 05/2005) (Dec. 28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('2151', 'Transferência para industrialização ou produção rural (NR Ajuste SINIEF 05/2005) (Decreto 28.868/2006)', 'Entrada de mercadoria, recebida em transferência de outro estabelecimento da mesma empresa, para ser utilizada em processo de industrialização ou produção rural.\r\n\r\n(NR Ajuste SINIEF 05/2005) (Dec. 28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('2152', 'Transferência para comercialização', 'Classificam-se neste código as entradas de mercadorias recebidas em transferência de outro estabelecimento da mesma empresa, para serem comercializadas.'),
('2153', 'Transferência de energia elétrica para distribuição', 'Classificam-se neste código as entradas de energia elétrica recebida em transferência de outro estabelecimento da mesma empresa, para distribuição.'),
('2154', 'Transferência para utilização na prestação de serviço', 'Classificam-se neste código as entradas de mercadorias recebidas em transferência de outro estabelecimento da mesma empresa, para serem utilizadas nas prestações de serviços.'),
('2200', 'DEVOLUÇÕES DE VENDAS DE PRODUÇÃO DO ESTABELECIMENTO OU DE TERCEIROS OU ANULAÇÕES DE VALORES', NULL),
('2201', 'Devolução de venda de produção do estabelecimento', 'Devolução de venda de produto industrializado ou produzido pelo estabelecimento, cuja saída tenha sido classificada no código \"6.101 - Venda de produção do estabelecimento\".\r\n\r\n(NR Ajuste SINIEF 05/2005) (Dec. 28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('2202', 'Devolução de venda de mercadoria adquirida ou recebida de terceiros', 'Devolução de vendas de mercadoria, adquirida ou recebida de terceiro, que não tenham sido objeto de industrialização no estabelecimento, cuja saída tenha sido classificada como Venda de mercadoria adquirida ou recebida de terceiros.'),
('2203', 'Devolução de venda de produção do estabelecimento destinada à Zona Franca de Manaus ou Áreas de Livre Comércio', 'Devolução de venda de produto industrializado ou produzido pelo estabelecimento, cuja saída tenha sido classificada no código \"6.109 – Venda de produção do estabelecimento destinada à Zona Franca de Manaus ou Áreas de Livre Comércio\".\r\n\r\n (NR Ajuste SINIEF 05/2005) (Dec. 28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('2204', 'Devolução de venda de mercadoria adquirida ou recebida de terceiros, destinada à Zona Franca de Manaus ou Áreas de Livre Comércio', 'Devolução de venda de mercadoria adquirida ou recebida de terceiro, cuja saída tenha sido classificada no código “6.110 - Venda de mercadoria adquirida ou recebida de terceiros, destinada à Zona Franca de Manaus ou Áreas de Livre Comércio”.'),
('2205', 'Anulação de valor relativo à prestação de serviço de comunicação', 'Anulação correspondente a valor faturado indevidamente, decorrente de prestação de serviço de comunicação.'),
('2206', 'Anulação de valor relativo à prestação de serviço de transporte', 'Anulação correspondente a valor faturado indevidamente, decorrente de prestação de serviço de transporte.'),
('2207', 'Anulação de valor relativo à venda de energia elétrica', 'Anulação correspondente a valor faturado indevidamente, decorrente de venda de energia elétrica.'),
('2208', 'Devolução de produção do estabelecimento, remetida em transferência.', 'Devolução de produto industrializado ou produzido pelo estabelecimento e transferido para outro estabelecimento da mesma empresa.\r\n\r\n(NR Ajuste SINIEF 05/2005) (Dec. 28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('2209', 'Devolução de mercadoria adquirida ou recebida de terceiros e remetida em transferência', 'Devolução de mercadoria adquirida ou recebida de terceiros, transferidas para outros estabelecimentos da mesma empresa.'),
('2250', 'COMPRAS DE ENERGIA ELÉTRICA', NULL),
('2251', 'Compra de energia elétrica para distribuição ou comercialização', 'Classificam-se neste código as compras de energia elétrica utilizada em sistema de distribuição ou comercialização. Também serão classificadas neste código as compras de energia elétrica por cooperativas para distribuição com seus cooperados.');
INSERT INTO `tab_cfop` (`id`, `descricao`, `aplicacao`) VALUES
('2252', 'Compra de energia elétrica por estabelecimento industrial', 'Classificam-se neste código as compras de energia elétrica utilizada no processo de industrialização. Também serão classificadas neste código as compras de energia elétrica utilizada por estabelecimento industrial de cooperativa.'),
('2253', 'Compra de energia elétrica por estabelecimento comercial', 'Classificam-se neste código as compras de energia elétrica utilizada por estabelecimento comercial. Também serão classificadas neste código as compras de energia elétrica utilizada por estabelecimento comercial de cooperativa.'),
('2254', 'Compra de energia elétrica por estabelecimento prestador de serviço de transporte', 'Classificam-se neste código as compras de energia elétrica utilizada por estabelecimento prestador de serviços de transporte.'),
('2255', 'Compra de energia elétrica por estabelecimento prestador de serviço de comunicação', 'Classificam-se neste código as compras de energia elétrica utilizada por estabelecimento prestador de serviços de comunicação.'),
('2256', 'Compra de energia elétrica por estabelecimento de produtor rural', 'Classificam-se neste código as compras de energia elétrica utilizada por estabelecimento de produtor rural.'),
('2257', 'Compra de energia elétrica para consumo por demanda contratada', 'Classificam-se neste código as compras de energia elétrica para consumo por demanda contratada, que prevalecerá sobre os demais códigos deste subgrupo.'),
('2300', 'AQUISIÇÕES DE SERVIÇOS DE COMUNICAÇÃO', NULL),
('2301', 'Aquisição de serviço de comunicação para execução de serviço da mesma natureza', 'Classificam-se neste código as aquisições de serviços de comunicação utilizados nas prestações de serviços da mesma natureza.'),
('2302', 'Aquisição de serviço de comunicação por estabelecimento industrial', 'Classificam-se neste código as aquisições de serviços de comunicação utilizados por estabelecimento industrial. Também serão classificadas neste código as aquisições de serviços de comunicação utilizados por estabelecimento industrial de cooperativa.'),
('2303', 'Aquisição de serviço de comunicação por estabelecimento comercial', 'Classificam-se neste código as aquisições de serviços de comunicação utilizados por estabelecimento comercial. Também serão classificadas neste código as aquisições de serviços de comunicação utilizados por estabelecimento comercial de cooperativa.'),
('2304', 'Aquisição de serviço de comunicação por estabelecimento de prestador de serviço de transporte', 'Classificam-se neste código as aquisições de serviços de comunicação utilizado por estabelecimento prestador de serviço de transporte.'),
('2305', 'Aquisição de serviço de comunicação por estabelecimento de geradora ou de distribuidora de energia elétrica', 'Classificam-se neste código as aquisições de serviços de comunicação utilizados por estabelecimento de geradora ou de distribuidora de energia elétrica.'),
('2306', 'Aquisição de serviço de comunicação por estabelecimento de produtor rural', 'Classificam-se neste código as aquisições de serviços de comunicação utilizados por estabelecimento de produtor rural.'),
('2350', 'AQUISIÇÕES DE SERVIÇOS DE TRANSPORTE', NULL),
('2351', 'Aquisição de serviço de transporte para execução de serviço da mesma natureza', 'Classificam-se neste código as aquisições de serviços de transporte utilizados nas prestações de serviços da mesma natureza.'),
('2352', 'Aquisição de serviço de transporte por estabelecimento industrial', 'Classificam-se neste código as aquisições de serviços de transporte utilizados por estabelecimento industrial. Também serão classificadas neste código as aquisições de serviços de transporte utilizados por estabelecimento industrial de cooperativa.'),
('2353', 'Aquisição de serviço de transporte por estabelecimento comercial', 'Classificam-se neste código as aquisições de serviços de transporte utilizados por estabelecimento comercial. Também serão classificadas neste código as aquisições de serviços de transporte utilizados por estabelecimento comercial de cooperativa.'),
('2354', 'Aquisição de serviço de transporte por estabelecimento de prestador de serviço de comunicação', 'Classificam-se neste código as aquisições de serviços de transporte utilizados por estabelecimento prestador de serviços de comunicação.'),
('2355', 'Aquisição de serviço de transporte por estabelecimento de geradora ou de distribuidora de energia elétrica', 'Classificam-se neste código as aquisições de serviços de transporte utilizados por estabelecimento de geradora ou de distribuidora de energia elétrica.'),
('2356', 'Aquisição de serviço de transporte por estabelecimento de produtor rural', 'Classificam-se neste código as aquisições de serviços de transporte utilizados por estabelecimento de produtor rural.'),
('2400', 'ENTRADAS DE MERCADORIAS SUJEITAS AO REGIME DE SUBSTITUIÇÃO TRIBUTÁRIA', NULL),
('2401', 'Compra para industrialização ou produção rural de mercadoria sujeita ao regime de substituição tributária (NR Ajuste SINIEF 05/2005) (Decreto 28.868/2006)', 'Compra de mercadoria, sujeita ao regime de substituição tributária, a ser utilizada em processo de industrialização ou produção rural, bem como compra, por estabelecimento industrial ou produtor rural de cooperativa, de mercadoria sujeita ao mencionado regime.\n\n(NR Ajuste SINIEF 05/2005) (Dec. 28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('2403', 'Compra para comercialização em operação com mercadoria sujeita ao regime de substituição tributária', 'Classificam-se neste código as compras de mercadorias a serem comercializadas, decorrentes de operações com mercadorias sujeitas ao regime de substituição tributária. Também serão classificadas neste código as compras de mercadorias sujeitas ao regime de substituição tributária em estabelecimento comercial de cooperativa.'),
('2406', 'Compra de bem para o ativo imobilizado cuja mercadoria está sujeita ao regime de substituição tributária', 'Classificam-se neste código as compras de bens destinados ao ativo imobilizado do estabelecimento, em operações com mercadorias sujeitas ao regime de substituição tributária.'),
('2407', 'Compra de mercadoria para uso ou consumo cuja mercadoria está sujeita ao regime de substituição tributária', 'Classificam-se neste código as compras de mercadorias destinadas ao uso ou consumo do estabelecimento, em operações com mercadorias sujeitas ao regime de substituição tributária.'),
('2408', 'Transferência para industrialização ou produção rural de mercadoria sujeita ao regime de substituição tributária (NR Ajuste SINIEF 05/2005) (Decreto 28.868/2006)', 'Entrada de mercadoria, sujeita ao regime de substituição tributária, recebida em transferência de outro estabelecimento da mesma empresa, para ser industrializada ou consumida na produção rural no estabelecimento destinatário.\r\n\r\n(NR Ajuste SINIEF 05/2005) (Dec. 28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('2409', 'Transferência para comercialização em operação com mercadoria sujeita ao regime de substituição tributária', 'Classificam-se neste código as mercadorias recebidas em transferência de outro estabelecimento da mesma empresa, para serem comercializadas, decorrentes de operações sujeitas ao regime de substituição tributária.'),
('2410', 'Devolução de venda de produção do estabelecimento, quando o produto estiver sujeito ao regime de substituição tributária', 'Devolução de produto industrializado ou produzido pelo estabelecimento, cuja saída tenha sido classificada como \"Venda de produção do estabelecimento quando o produto estiver sujeito ao regime de substituição tributária\".\r\n\r\n(NR Ajuste SINIEF 05/2005) (Dec. 28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('2411', 'Devolução de venda de mercadoria adquirida ou recebida de terceiros em operação com mercadoria sujeita ao regime de substituição tributária', 'Devolução de vendas de mercadoria adquirida ou recebida de terceiro, cuja saída tenha sido classificada como “Venda de mercadoria adquirida ou recebida de terceiros em operação com mercadoria sujeita ao regime de substituição tributária”.'),
('2414', 'Retorno de produção do estabelecimento, remetida para venda fora do estabelecimento, quando o produto estiver sujeito ao regime de substituição tributária', 'Entrada, em retorno, de produto industrializado ou produzido pelo estabelecimento sujeito ao regime de substituição tributária, remetido para venda fora do estabelecimento, inclusive por meio de veículo, e não comercializado.\r\n\r\n(NR Ajuste SINIEF 05/2005) (Dec. 28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('2415', 'Retorno de mercadoria adquirida ou recebida de terceiros, remetida para venda fora do estabelecimento em operação com mercadoria sujeita ao regime de substituição tributária', 'Entrada, em retorno, de mercadoria sujeita ao regime de substituição tributária, adquirida ou recebida de terceiro remetida para venda fora do estabelecimento, inclusive por meio de veículo, e não comercializada.'),
('2500', 'ENTRADAS DE MERCADORIAS REMETIDAS PARA FORMAÇÃO DE LOTE OU COM FIM ESPECÍFICO DE EXPORTAÇÃO E EVENTUAIS DEVOLUÇÕES (NR Ajuste SINIEF 09/2005)', '(ACR Ajuste SINIEF 09/2005) (Dec. 28.868/2006 - a sua aplicação será obrigatória em relação aos fatos geradores ocorridos a partir de 01 de julho de 2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de janeiro a 30 de junho de 2006)'),
('2501', 'Entrada de mercadoria recebida com fim específico de exportação', 'Classificam-se neste código as entradas de mercadorias em estabelecimento de trading company, empresa comercial exportadora ou outro estabelecimento do remetente, com fim específico de exportação.'),
('2503', 'Entrada decorrente de devolução de produto industrializado pelo estabelecimento, remetido com fim específico de exportação', 'Devolução de produto industrializado ou produzido pelo estabelecimento, remetido a \"trading company\", a empresa comercial exportadora ou a outro estabelecimento do remetente, com fim específico de exportação, cuja saída tenha sido classificada no código \"6.501 – Remessa de produção do estabelecimento com fim específico de exportação\".\r\n\r\n(NR Ajuste SINIEF 05/2005) (Dec.28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 '),
('2504', 'Entrada decorrente de devolução de mercadoria remetida com fim específico de exportação, adquirida ou recebida de terceiros', 'Classificam-se neste código as devoluções de mercadorias adquiridas ou recebidas de terceiros remetidas a trading company, a empresa comercial exportadora ou a outro estabelecimento do remetente, com fim específico de exportação, cujas saídas tenham sido classificadas no código 6.502 - Remessa de mercadoria adquirida ou recebida de terceiros, com fim específico de exportação.'),
('2505', 'Entrada decorrente de devolução simbólica de mercadoria remetida para formação de lote de exportação, de produto industrializado ou produzido pelo próprio estabelecimento.', 'Devolução simbólica de mercadoria remetida para formação de lote de exportação, cuja saída tenha sido classificada no código \"6.504 – Remessa de mercadoria para formação de lote de exportação, de produto industrializado ou produzido pelo próprio estabelecimento\". (ACR Ajuste SINIEF 09/2005) (Decreto 28.868/2006)\r\n\r\n(ACR Ajuste SINIEF 09/2005) (Dec. 28.868/2006 - a sua aplicação será obrigatória em relação aos fatos geradores ocorridos a partir de 01 de julho de 2006, ficando facultada ao contribuinte a sua adoção para fatos '),
('2506', 'Entrada decorrente de devolução simbólica de mercadoria, adquirida ou recebida de terceiros, remetida para formação de lote de exportação.', 'Devolução simbólica de mercadoria remetida para formação de lote de exportação em armazéns alfandegados, entrepostos aduaneiros ou outros estabelecimentos que venham a ser regulamentados pela legislação tributária de cada Unidade Federada, efetuada pelo estabelecimento depositário, cuja saída tenha sido classificada no código \"6.505 – Remessa de mercadoria, adquirida ou recebida de terceiros, para formação de lote de exportação\".\r\n\r\n(ACR Ajuste SINIEF 09/2005) (Dec. 28.868/2006 - a sua aplicação será obrigatória em relação a'),
('2550', 'OPERAÇÕES COM BENS DE ATIVO IMOBILIZADO E MATERIAIS PARA USO OU CONSUMO', NULL),
('2551', 'Compra de bem para o ativo imobilizado', 'Classificam-se neste código as compras de bens destinados ao ativo imobilizado do estabelecimento.'),
('2552', 'Transferência de bem do ativo imobilizado', 'Classificam-se neste código as entradas de bens destinados ao ativo imobilizado recebidos em transferência de outro estabelecimento da mesma empresa.'),
('2553', 'Devolução de venda de bem do ativo imobilizado', 'Classificam-se neste código as devoluções de vendas de bens do ativo imobilizado, cujas saídas tenham sido classificadas no código 6.551 - Venda de bem do ativo imobilizado.'),
('2554', 'Retorno de bem do ativo imobilizado remetido para uso fora do estabelecimento', 'Classificam-se neste código as entradas por retorno de bens do ativo imobilizado remetidos para uso fora do estabelecimento, cujas saídas tenham sido classificadas no código 6.554 - Remessa de bem do ativo imobilizado para uso fora do estabelecimento.'),
('2555', 'Entrada de bem do ativo imobilizado de terceiro, remetido para uso no estabelecimento', 'Classificam-se neste código as entradas de bens do ativo imobilizado de terceiros, remetidos para uso no estabelecimento.'),
('2556', 'Compra de material para uso ou consumo', 'Classificam-se neste código as compras de mercadorias destinadas ao uso ou consumo do estabelecimento.'),
('2557', 'Transferência de material para uso ou consumo', 'Classificam-se neste código as entradas de materiais para uso ou consumo recebidos em transferência de outro estabelecimento da mesma empresa.'),
('2600', 'CRÉDITOS E RESSARCIMENTOS DE ICMS', NULL),
('2603', 'Ressarcimento de ICMS retido por substituição tributária', 'Classificam-se neste código os lançamentos destinados ao registro de ressarcimento de ICMS retido por substituição tributária a contribuinte substituído, efetuado pelo contribuinte substituto, nas hipóteses previstas na legislação aplicável.'),
('2650', 'ENTRADAS DE COMBUSTÍVEIS, DERIVADOS OU NÃO DE PETRÓLEO, E LUBRIFICANTES (ACR Ajuste SINIEF 9/2003)', '(ACR Ajuste SINIEF 05/2005) (Dec.28.868/2006 )'),
('2651', 'Compra de combustível ou lubrificante para industrialização subseqüente', 'Compra de combustível ou lubrificante a ser utilizados em processo de industrialização do próprio produto. (a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('2652', 'Compra de combustível ou lubrificante para comercialização', 'Compra de combustível ou lubrificante a ser comercializados. (a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('2653', 'Compra de combustível ou lubrificante por consumidor ou usuário final', 'Compra de combustível ou lubrificante, a ser consumidos em processo de industrialização de outros produtos, na produção rural, na prestação de serviço ou por usuário final.\r\n\r\n(NR Ajuste SINIEF 05/2005) (Dec.28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('2658', 'Transferência de combustível ou lubrificante para industrialização', 'Entrada de combustível ou lubrificante, recebidos em transferência de outro estabelecimento da mesma empresa, para ser utilizados em processo de industrialização do próprio produto. (a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('2659', 'Transferência de combustível ou lubrificante para comercialização', 'Entrada de combustível ou lubrificante, recebidos em transferência de outro estabelecimento da mesma empresa, para ser comercializados. (a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('2660', 'Devolução de venda de combustível ou lubrificante destinados à industrialização subseqüente', 'Devolução de venda de combustível ou lubrificante, cuja saída tenha sido classificada como \"Venda de combustível ou lubrificante destinados à industrialização subseqüente\".(a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('2661', 'Devolução de venda de combustível ou lubrificante destinados à comercialização', 'Devolução de venda de combustível ou lubrificante, cuja saída tenha sido classificada como \"Venda de combustível ou lubrificante para comercialização\".(a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('2662', 'Devolução de venda de combustível ou lubrificante destinados a consumidor ou usuário final', 'Devolução de venda de combustível ou lubrificante, cuja saída tenha sido classificada como \"Venda de combustível ou lubrificante por consumidor ou usuário final\".(a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('2663', 'Entrada de combustível ou lubrificante para armazenagem', 'Entrada de combustível ou lubrificante para armazenagem. (a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('2664', 'Retorno de combustível ou lubrificante remetidos para armazenagem', 'Entrada, ainda que simbólica, por retorno de combustível ou lubrificante, remetidos para armazenagem. (a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('2900', 'OUTRAS ENTRADAS DE MERCADORIAS OU AQUISIÇÕES DE SERVIÇOS', NULL),
('2901', 'Entrada para industrialização por encomenda', 'Classificam-se neste código as entradas de insumos recebidos para industrialização por encomenda de outra empresa ou de outro estabelecimento da mesma empresa.'),
('2902', 'Retorno de mercadoria remetida para industrialização por encomenda', 'Classificam-se neste código o retorno dos insumos remetidos para industrialização por encomenda, incorporados ao produto final pelo estabelecimento industrializador.'),
('2903', 'Entrada de mercadoria remetida para industrialização e não aplicada no referido processo', 'Classificam-se neste código as entradas em devolução de insumos remetidos para industrialização e não aplicados no referido processo.'),
('2904', 'Retorno de remessa para venda fora do estabelecimento', 'Classificam-se neste código as entradas em retorno de mercadorias remetidas para venda fora do estabelecimento, inclusive por meio de veículos, e não comercializadas.'),
('2905', 'Entrada de mercadoria recebida para depósito em depósito fechado ou armazém geral', 'Classificam-se neste código as entradas de mercadorias recebidas para depósito em depósito fechado ou armazém geral.'),
('2906', 'Retorno de mercadoria remetida para depósito fechado ou armazém geral', 'Classificam-se neste código as entradas em retorno de mercadorias remetidas para depósito em depósito fechado ou armazém geral.'),
('2907', 'Retorno simbólico de mercadoria remetida para depósito fechado ou armazém geral', 'Classificam-se neste código as entradas em retorno simbólico de mercadorias remetidas para depósito em depósito fechado ou armazém geral, quando as mercadorias depositadas tenham sido objeto de saída a qualquer título e que não tenham retornado ao estabelecimento depositante.'),
('2908', 'Entrada de bem por conta de contrato de comodato', 'Classificam-se neste código as entradas de bens recebidos em cumprimento de contrato de comodato.'),
('2909', 'Retorno de bem remetido por conta de contrato de comodato', 'Classificam-se neste código as entradas de bens recebidos em devolução após cumprido o contrato de comodato.'),
('2910', 'Entrada de bonificação, doação ou brinde', 'Classificam-se neste código as entradas de mercadorias recebidas a título de bonificação, doação ou brinde.'),
('2911', 'Entrada de amostra grátis', 'Classificam-se neste código as entradas de mercadorias recebidas a título de amostra grátis.'),
('2912', 'Entrada de mercadoria ou bem recebido para demonstração', 'Classificam-se neste código as entradas de mercadorias ou bens recebidos para demonstração.'),
('2913', 'Retorno de mercadoria ou bem remetido para demonstração', 'Classificam-se neste código as entradas em retorno de mercadorias ou bens remetidos para demonstração.'),
('2914', 'Retorno de mercadoria ou bem remetido para exposição ou feira', 'Classificam-se neste código as entradas em retorno de mercadorias ou bens remetidos para exposição ou feira.'),
('2915', 'Entrada de mercadoria ou bem recebido para conserto ou reparo', 'Classificam-se neste código as entradas de mercadorias ou bens recebidos para conserto ou reparo.'),
('2916', 'Retorno de mercadoria ou bem remetido para conserto ou reparo', 'Classificam-se neste código as entradas em retorno de mercadorias ou bens remetidos para conserto ou reparo.'),
('2917', 'Entrada de mercadoria recebida em consignação mercantil ou industrial', 'Classificam-se neste código as entradas de mercadorias recebidas a título de consignação mercantil ou industrial.'),
('2918', 'Devolução de mercadoria remetida em consignação mercantil ou industrial', 'Classificam-se neste código as entradas por devolução de mercadorias remetidas anteriormente a título de consignação mercantil ou industrial.'),
('2919', 'Devolução simbólica de mercadoria vendida ou utilizada em processo industrial, remetida anteriormente em consignação mercantil ou industrial', 'Classificam-se neste código as entradas por devolução simbólica de mercadorias vendidas ou utilizadas em processo industrial, remetidas anteriormente a título de consignação mercantil ou industrial.'),
('2920', 'Entrada de vasilhame ou sacaria', 'Classificam-se neste código as entradas de vasilhame ou sacaria.'),
('2921', 'Retorno de vasilhame ou sacaria', 'Classificam-se neste código as entradas em retorno de vasilhame ou sacaria.'),
('2922', 'Lançamento efetuado a título de simples faturamento decorrente de compra para recebimento futuro', 'Classificam-se neste código os registros efetuados a título de simples faturamento decorrente de compra para recebimento futuro.'),
('2923', 'Entrada de mercadoria recebida do vendedor remetente, em venda à ordem', 'Classificam-se neste código as entradas de mercadorias recebidas do vendedor remetente, em vendas à ordem, cuja compra do adquirente originário, foi classificada nos códigos 2.120 - Compra para industrialização, em venda à ordem, já recebida do vendedor remetente ou 2.121 - Compra para comercialização, em venda à ordem, já recebida do vendedor remetente.'),
('2924', 'Entrada para industrialização por conta e ordem do adquirente da mercadoria, quando esta não transitar pelo estabelecimento do adquirente', 'Classificam-se neste código as entradas de insumos recebidos para serem industrializados por conta e ordem do adquirente, nas hipóteses em que os insumos não tenham transitado pelo estabelecimento do adquirente dos mesmos.'),
('2925', 'Retorno de mercadoria remetida para industrialização por conta e ordem do adquirente da mercadoria, quando esta não transitar pelo estabelecimento do adquirente', 'Classificam-se neste código o retorno dos insumos remetidos por conta e ordem do adquirente, para industrialização e incorporados ao produto final pelo estabelecimento industrializador, nas hipóteses em que os insumos não tenham transitado pelo estabelecimento do adquirente.'),
('2931', 'Lançamento efetuado pelo tomador do serviço de transporte, quando a responsabilidade de retenção do imposto for atribuída ao remetente ou alienante da mercadoria, pelo serviço de transporte realizado ', 'Lançamento efetuado pelo tomador do serviço de transporte realizado por transportador autônomo ou por transportador não-inscrito na Unidade da Federação onde se tenha iniciado o serviço, quando a responsabilidade pela retenção do imposto for atribuída ao remetente ou alienante da mercadoria.\r\n\r\n (ACR Ajuste SINIEF 03/2004) (DECRETO Nº 26.810/2004) (a partir de 01.01.2005)'),
('2932', 'Aquisição de serviço de transporte iniciado em Unidade da Federação diversa daquela onde esteja inscrito o prestador', 'Aquisição de serviço de transporte que tenha sido iniciado em Unidade da Federação diversa daquela onde o prestador esteja inscrito como contribuinte. (ACR Ajuste SINIEF 03/2004) (DECRETO Nº 26.810/2004) (a partir de 01.01.2005)'),
('2933', 'Aquisição de serviço tributado pelo Imposto Sobre Serviços de Qualquer Natureza', 'Aquisição de serviço, cujo imposto é de competência municipal, desde que informado em Nota Fiscal modelo 1 e 1-A. (NR Ajuste SINIEF 06/2005) (a partir de 01.01.2006)'),
('2949', 'Outra entrada de mercadoria ou prestação de serviço não especificado', 'Classificam-se neste código as outras entradas de mercadorias ou prestações de serviços que não tenham sido especificados nos códigos anteriores.'),
('3000', 'ENTRADAS OU AQUISIÇÕES DE SERVIÇOS DO EXTERIOR', 'Classificam-se, neste grupo, as entradas de mercadorias oriundas de outro país, inclusive as decorrentes de aquisição por arrematação, concorrência ou qualquer outra forma de alienação promovida pelo poder público, e os serviços iniciados no exterior'),
('3100', 'COMPRAS PARA INDUSTRIALIZAÇÃO, PRODUÇÃO RURAL, COMERCIALIZAÇÃO OU PRESTAÇÃO DE SERVIÇOS (NR Ajuste SINIEF 05/2005) (Decreto 28.868/2006)', '(NR Ajuste SINIEF 05/2005) (Dec.28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('3101', 'Compra para industrialização ou produção rural (NR Ajuste SINIEF 05/2005) (Decreto 28.868/2006)', 'Compra de mercadoria a ser utilizada em processo de industrialização ou produção rural, bem como a entrada de mercadoria em estabelecimento industrial ou produtor rural de cooperativa.\r\n(NR Ajuste SINIEF 05/2005) (Dec.28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('3102', 'Compra para comercialização', 'Classificam-se neste código as compras de mercadorias a serem comercializadas. Também serão classificadas neste código as entradas de mercadorias em estabelecimento comercial de cooperativa.'),
('3126', 'Compra para utilização na prestação de serviço', 'Classificam-se neste código as entradas de mercadorias a serem utilizadas nas prestações de serviços.'),
('3127', 'Compra para industrialização sob o regime de drawback', 'Classificam-se neste código as compras de mercadorias a serem utilizadas em processo de industrialização e posterior exportação do produto resultante, cujas vendas serão classificadas no código 7.127 - Venda de produção do estabelecimento sob o regime de drawback.'),
('3200', 'DEVOLUÇÕES DE VENDAS DE PRODUÇÃO PRÓPRIA, DE TERCEIROS OU ANULAÇÕES DE VALORES', NULL),
('3201', 'Devolução de venda de produção do estabelecimento', 'Devolução de venda de produto industrializado ou produzido pelo próprio estabelecimento, cuja saída tenha sido classificada como \"Venda de produção do estabelecimento\".\r\n\r\n(NR Ajuste SINIEF 05/2005) (Dec.28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('3202', 'Devolução de venda de mercadoria adquirida ou recebida de terceiros', 'Classificam-se neste código as devoluções de vendas de mercadorias adquiridas ou recebidas de terceiros, que não tenham sido objeto de industrialização no estabelecimento, cujas saídas tenham sido classificadas como Venda de mercadoria adquirida ou recebida de terceiros.'),
('3205', 'Anulação de valor relativo à prestação de serviço de comunicação', 'Classificam-se neste código as anulações correspondentes a valores faturados indevidamente, decorrentes de prestações de serviços de comunicação.'),
('3206', 'Anulação de valor relativo à prestação de serviço de transporte', 'Classificam-se neste código as anulações correspondentes a valores faturados indevidamente, decorrentes de prestações de serviços de transporte.'),
('3207', 'Anulação de valor relativo à venda de energia elétrica', 'Classificam-se neste código as anulações correspondentes a valores faturados indevidamente, decorrentes de venda de energia elétrica.'),
('3211', 'Devolução de venda de produção do estabelecimento sob o regime de drawback', 'Classificam-se neste código as devoluções de vendas de produtos industrializados pelo estabelecimento sob o regime de drawback.'),
('3250', 'COMPRAS DE ENERGIA ELÉTRICA', NULL),
('3251', 'Compra de energia elétrica para distribuição ou comercialização', 'Classificam-se neste código as compras de energia elétrica utilizada em sistema de distribuição ou comercialização. Também serão classificadas neste código as compras de energia elétrica por cooperativas para distribuição aos seus cooperados.'),
('3301', 'Aquisição de serviço de comunicação para execução de serviço da mesma natureza', 'Classificam-se neste código as aquisições de serviços de comunicação utilizados nas prestações de serviços da mesma natureza.'),
('3350', 'AQUISIÇÕES DE SERVIÇOS DE TRANSPORTE', NULL),
('3351', 'Aquisição de serviço de transporte para execução de serviço da mesma natureza', 'Classificam-se neste código as aquisições de serviços de transporte utilizados nas prestações de serviços da mesma natureza.'),
('3352', 'Aquisição de serviço de transporte por estabelecimento industrial', 'Classificam-se neste código as aquisições de serviços de transporte utilizados por estabelecimento industrial. Também serão classificadas neste código as aquisições de serviços de transporte utilizados por estabelecimento industrial de cooperativa.'),
('3353', 'Aquisição de serviço de transporte por estabelecimento comercial', 'Classificam-se neste código as aquisições de serviços de transporte utilizados por estabelecimento comercial. Também serão classificadas neste código as aquisições de serviços de transporte utilizados por estabelecimento comercial de cooperativa.'),
('3354', 'Aquisição de serviço de transporte por estabelecimento de prestador de serviço de comunicação', 'Classificam-se neste código as aquisições de serviços de transporte utilizados por estabelecimento prestador de serviços de comunicação.'),
('3355', 'Aquisição de serviço de transporte por estabelecimento de geradora ou de distribuidora de energia elétrica', 'Classificam-se neste código as aquisições de serviços de transporte utilizados por estabelecimento de geradora ou de distribuidora de energia elétrica.'),
('3356', 'Aquisição de serviço de transporte por estabelecimento de produtor rural', 'Classificam-se neste código as aquisições de serviços de transporte utilizados por estabelecimento de produtor rural.'),
('3500', 'ENTRADAS DE MERCADORIAS REMETIDAS COM FIM ESPECÍFICO DE EXPORTAÇÃO E EVENTUAIS DEVOLUÇÕES', NULL),
('3503', 'Devolução de mercadoria exportada que tenha sido recebida com fim específico de exportação', 'Classificam-se neste código as devoluções de mercadorias exportadas por trading company, empresa comercial exportadora ou outro estabelecimento do remetente, recebidas com fim específico de exportação, cujas saídas tenham sido classificadas no código 7.501 - Exportação de mercadorias recebidas com fim específico de exportação.'),
('3550', 'OPERAÇÕES COM BENS DE ATIVO IMOBILIZADO E MATERIAIS PARA USO OU CONSUMO', NULL),
('3551', 'Compra de bem para o ativo imobilizado', 'Classificam-se neste código as compras de bens destinados ao ativo imobilizado do estabelecimento.'),
('3553', 'Devolução de venda de bem do ativo imobilizado', 'Classificam-se neste código as devoluções de vendas de bens do ativo imobilizado, cujas saídas tenham sido classificadas no código 7.551 - Venda de bem do ativo imobilizado.'),
('3556', 'Compra de material para uso ou consumo', 'Classificam-se neste código as compras de mercadorias destinadas ao uso ou consumo do estabelecimento.'),
('3650', 'ENTRADAS DE COMBUSTÍVEIS, DERIVADOS OU NÃO DE PETRÓLEO, E LUBRIFICANTES', '(ACR Ajuste SINIEF 9/2003 - a partir 01.01.2004) (Decreto Nº 26.174 de 26/11/2003)'),
('3651', 'Compra de combustível ou lubrificante para industrialização subseqüente', 'Compra de combustível ou lubrificante a ser utilizados em processo de industrialização do próprio produto. (a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('3652', 'Compra de combustível ou lubrificante para comercialização', 'Compra de combustível ou lubrificante a ser comercializados. (a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('3653', 'Compra de combustível ou lubrificante por consumidor ou usuário final', 'Compra de combustível ou lubrificante, a ser consumidos em processo de industrialização de outros produtos, na produção rural, na prestação de serviço ou por usuário final.\r\n\r\n(NR Ajuste SINIEF 05/2005) (Dec.28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('3900', 'OUTRAS ENTRADAS DE MERCADORIAS OU AQUISIÇÕES DE SERVIÇOS', NULL),
('3930', 'Lançamento efetuado a título de entrada de bem sob amparo de regime especial aduaneiro de admissão temporária', 'Lançamento efetuado a título de entrada de bem amparada por regime especial aduaneiro de admissão temporária. – (Decreto Nº 26.174 de 26/11/2003). a partir 01.01.2004   '),
('3949', 'Outra entrada de mercadoria ou prestação de serviço não especificado', 'Outra entrada de mercadoria ou prestação de serviço que não tenham sido especificada nos códigos anteriores. – (Decreto Nº 26.174 de 26/11/2003). a partir 01.01.2004  '),
('5000', 'SAÍDAS OU PRESTAÇÕES DE SERVIÇOS PARA O ESTADO', 'Classificam-se, neste grupo, as operações ou prestações em que o estabelecimento remetente esteja localizado na mesma unidade da Federação do destinatário.'),
('5100', 'VENDAS DE PRODUÇÃO PRÓPRIA OU DE TERCEIROS', NULL),
('5101', 'Venda de produção do estabelecimento', 'Venda de produto industrializado ou produzido pelo estabelecimento, bem como a de mercadoria por estabelecimento industrial ou produtor rural de cooperativa destinada a seus cooperados ou a estabelecimento de outra cooperativa.\n\n(NR Ajuste SINIEF 05/2005) (Dec.28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('5102', 'Venda de mercadoria adquirida ou recebida de terceiros', 'Classificam-se neste código as vendas de mercadorias adquiridas ou recebidas de terceiros para industrialização ou comercialização, que não tenham sido objeto de qualquer processo industrial no estabelecimento. Também serão classificadas neste código as vendas de mercadorias por estabelecimento comercial de cooperativa destinadas a seus cooperados ou estabelecimento de outra cooperativa.'),
('5103', 'Venda de produção do estabelecimento efetuada fora do estabelecimento', 'Venda efetuada fora do estabelecimento, inclusive por meio de veículo, de produto industrializado ou produzido no estabelecimento.\r\n\r\n(NR Ajuste SINIEF 05/2005) (Dec.28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('5104', 'Venda de mercadoria adquirida ou recebida de terceiros, efetuada fora do estabelecimento', 'Classificam-se neste código as vendas efetuadas fora do estabelecimento, inclusive por meio de veículo, de mercadorias adquiridas ou recebidas de terceiros para industrialização ou comercialização, que não tenham sido objeto de qualquer processo industrial no estabelecimento.'),
('5105', 'Venda de produção do estabelecimento que não deva por ele transitar', 'Classificam-se neste código as vendas de produtos industrializados no estabelecimento, armazenados em depósito fechado, armazém geral ou outro sem que haja retorno ao estabelecimento depositante.'),
('5106', 'Venda de mercadoria adquirida ou recebida de terceiros, que não deva por ele transitar', 'Classificam-se neste código as vendas de mercadorias adquiridas ou recebidas de terceiros para industrialização ou comercialização, armazenadas em depósito fechado, armazém geral ou outro, que não tenham sido objeto de qualquer processo industrial no estabelecimento sem que haja retorno ao estabelecimento depositante. Também serão classificadas neste código as vendas de mercadorias importadas, cuja saída ocorra do recinto alfandegado ou da repartição alfandegária onde se processou o desembaraço aduaneiro, com destino ao esta'),
('5109', 'Venda de produção do estabelecimento destinada à Zona Franca de Manaus ou Áreas de Livre Comércio', 'Venda de produto industrializado ou produzido pelo estabelecimento destinado à Zona Franca de Manaus ou Áreas de Livre Comércio.\r\n\r\n(NR Ajuste SINIEF 05/2005) (Dec.28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('5110', 'Venda de mercadoria, adquirida ou recebida de terceiros, destinada à Zona Franca de Manaus ou Áreas de Livre Comercio, de que trata o Anexo do Convênio SINIEF s/n, de 15 de dezembro de 1970, que dispõ', 'Venda de mercadoria, adquirida ou recebida de terceiros, destinada à Zona Franca de Manaus ou Áreas de Livre Comércio, desde que alcançada pelos benefícios fiscais de que tratam o Decreto-Lei nº 288, de 28 de fevereiro de 1967, o Convênio ICM 65/88, de 06 de dezembro de 1988, o Convênio ICMS 36/97, de 23 de maio de 1997, e o Convênio ICMS 37/97, de 23 de maio de 1997. (NR Ajuste SINIEF 09/2004) (Decreto nº 26.955/2004) RETROAGINDO SEUS EFEITOS A 24.06.2004.'),
('5111', 'Venda de produção do estabelecimento remetida anteriormente em consignação industrial', 'Classificam-se neste código as vendas efetivas de produtos industrializados no estabelecimento remetidos anteriormente a título de consignação industrial.'),
('5112', 'Venda de mercadoria adquirida ou recebida de terceiros remetida anteriormente em consignação industrial', 'Classificam-se neste código as vendas efetivas de mercadorias adquiridas ou recebidas de terceiros, que não tenham sido objeto de qualquer processo industrial no estabelecimento, remetidas anteriormente a título de consignação industrial.'),
('5113', 'Venda de produção do estabelecimento remetida anteriormente em consignação mercantil', 'Classificam-se neste código as vendas efetivas de produtos industrializados no estabelecimento remetidos anteriormente a título de consignação mercantil.'),
('5114', 'Venda de mercadoria adquirida ou recebida de terceiros remetida anteriormente em consignação mercantil', 'Classificam-se neste código as vendas efetivas de mercadorias adquiridas ou recebidas de terceiros, que não tenham sido objeto de qualquer processo industrial no estabelecimento, remetidas anteriormente a título de consignação mercantil.'),
('5115', 'Venda de mercadoria adquirida ou recebida de terceiros, recebida anteriormente em consignação mercantil', 'Classificam-se neste código as vendas de mercadorias adquiridas ou recebidas de terceiros, recebidas anteriormente a título de consignação mercantil.'),
('5116', 'Venda de produção do estabelecimento originada de encomenda para entrega futura', 'Venda de produto industrializado ou produzido pelo estabelecimento, quando da saída real do produto, cujo faturamento tenha sido classificado no código \"5.922 – Lançamento efetuado a título de simples faturamento decorrente de venda para entrega futura\".\r\n\r\n(NR Ajuste SINIEF 05/2005) (Dec.28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('5118', 'Venda de produção do estabelecimento entregue ao destinatário por conta e ordem do adquirente originário, em venda à ordem', 'Classificam-se neste código as vendas à ordem de produtos industrializados pelo estabelecimento, entregues ao destinatário por conta e ordem do adquirente originário.'),
('5119', 'Venda de mercadoria adquirida ou recebida de terceiros entregue ao destinatário por conta e ordem do adquirente originário, em venda à ordem', 'Classificam-se neste código as vendas à ordem de mercadorias adquiridas ou recebidas de terceiros, que não tenham sido objeto de qualquer processo industrial no estabelecimento, entregues ao destinatário por conta e ordem do adquirente originário.'),
('5120', 'Venda de mercadoria adquirida ou recebida de terceiros entregue ao destinatário pelo vendedor remetente, em venda à ordem', 'Classificam-se neste código as vendas à ordem de mercadorias adquiridas ou recebidas de terceiros, que não tenham sido objeto de qualquer processo industrial no estabelecimento, entregues pelo vendedor remetente ao destinatário, cuja compra seja classificada, pelo adquirente originário, no código 1.118 - Compra de mercadoria pelo adquirente originário, entregue pelo vendedor remetente ao destinatário, em venda à ordem.'),
('5122', 'Venda de produção do estabelecimento remetida para industrialização, por conta e ordem do adquirente, sem transitar pelo estabelecimento do adquirente', 'Classificam-se neste código as vendas de produtos industrializados no estabelecimento, remetidos para serem industrializados em outro estabelecimento, por conta e ordem do adquirente, sem que os produtos tenham transitado pelo estabelecimento do adquirente.'),
('5123', 'Venda de mercadoria adquirida ou recebida de terceiros remetida para industrialização, por conta e ordem do adquirente, sem transitar pelo estabelecimento do adquirente', 'Classificam-se neste código as vendas de mercadorias adquiridas ou recebidas de terceiros, que não tenham sido objeto de qualquer processo industrial no estabelecimento, remetidas para serem industrializadas em outro estabelecimento, por conta e ordem do adquirente, sem que as mercadorias tenham transitado pelo estabelecimento do adquirente.'),
('5124', 'Industrialização efetuada para outra empresa', 'Classificam-se neste código as saídas de mercadorias industrializadas para terceiros, compreendendo os valores referentes aos serviços prestados e os das mercadorias de propriedade do industrializador empregadas no processo industrial.'),
('5125', 'Industrialização efetuada para outra empresa quando a mercadoria recebida para utilização no processo de industrialização não transitar pelo estabelecimento adquirente da mercadoria', 'Classificam-se neste código as saídas de mercadorias industrializadas para outras empresas, em que as mercadorias recebidas para utilização no processo de industrialização não tenham transitado pelo estabelecimento do adquirente das mercadorias, compreendendo os valores referentes aos serviços prestados e os das mercadorias de propriedade do industrializador empregadas no processo industrial.'),
('5150', 'TRANSFERÊNCIAS DE PRODUÇÃO PRÓPRIA OU DE TERCEIROS', NULL),
('5151', 'Transferência de produção do estabelecimento', 'Transferência de produto industrializado ou produzido no estabelecimento para outro estabelecimento da mesma empresa.\r\n\r\n(NR Ajuste SINIEF 05/2005) (Dec.28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('5152', 'Transferência de mercadoria adquirida ou recebida de terceiros', 'Mercadoria adquirida ou recebida de terceiros para industrialização, comercialização ou utilização na prestação de serviço e que não tenha sido objeto de qualquer processo industrial no estabelecimento, transferida para outro estabelecimento da mesma empresa. A partir  10 de julho de 2003. (Decreto nº 26.020/2003)'),
('5153', 'Transferência de energia elétrica', 'Classificam-se neste código as transferências de energia elétrica para outro estabelecimento da mesma empresa, para distribuição.'),
('5155', 'Transferência de produção do estabelecimento, que não deva por ele transitar', 'Classificam-se neste código as transferências para outro estabelecimento da mesma empresa, de produtos industrializados no estabelecimento que tenham sido remetidos para armazém geral, depósito fechado ou outro, sem que haja retorno ao estabelecimento depositante.'),
('5156', 'Transferência de mercadoria adquirida ou recebida de terceiros, que não deva por ele transitar', 'Classificam-se neste código as transferências para outro estabelecimento da mesma empresa, de mercadorias adquiridas ou recebidas de terceiros para industrialização ou comercialização, que não tenham sido objeto de qualquer processo industrial, remetidas para armazém geral, depósito fechado ou outro, sem que haja retorno ao estabelecimento depositante.'),
('5200', 'DEVOLUÇÕES DE COMPRAS PARA INDUSTRIALIZAÇÃO, PRODUÇÃO RURAL, COMERCIALIZAÇÃO OU ANULAÇÕES DE VALORES (NR Ajuste SINIEF 05/2005) (Decreto 28.868/2006)', '(NR Ajuste SINIEF 05/2005) (Dec.28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('5201', 'Devolução de compra para industrialização ou produção rural (NR Ajuste SINIEF 05/2005) (Decreto 28.868/2006)', 'Devolução de mercadoria adquirida para ser utilizada em processo de industrialização ou produção rural, cuja entrada tenha sido classificada como \"1.101 - Compra para industrialização ou produção rural\".\r\n\r\n(NR Ajuste SINIEF 05/2005) (Dec.28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('5202', 'Devolução de compra para comercialização', 'Classificam-se neste código as devoluções de mercadorias adquiridas para serem comercializadas, cujas entradas tenham sido classificadas como Compra para comercialização.'),
('5205', 'Anulação de valor relativo a aquisição de serviço de comunicação', 'Classificam-se neste código as anulações correspondentes a valores faturados indevidamente, decorrentes das aquisições de serviços de comunicação.'),
('5206', 'Anulação de valor relativo a aquisição de serviço de transporte', 'Classificam-se neste código as anulações correspondentes a valores faturados indevidamente, decorrentes das aquisições de serviços de transporte.'),
('5207', 'Anulação de valor relativo à compra de energia elétrica', 'Classificam-se neste código as anulações correspondentes a valores faturados indevidamente, decorrentes da compra de energia elétrica.'),
('5208', 'Devolução de mercadoria recebida em transferência para industrialização ou produção rural', 'Devolução de mercadoria recebida em transferência de outro estabelecimento da mesma empresa, para ser utilizada em processo de industrialização ou produção rural.\r\n(NR Ajuste SINIEF 05/2005) (Dec.28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('5209', 'Devolução de mercadoria recebida em transferência para comercialização', 'Classificam-se neste código as devoluções de mercadorias recebidas em transferência de outro estabelecimento da mesma empresa, para serem comercializadas.'),
('5210', 'Devolução de compra para utilização na prestação de serviço', 'Classificam-se neste código as devoluções de mercadorias adquiridas para utilização na prestação de serviços, cujas entradas tenham sido classificadas no código 1.126 - Compra para utilização na prestação de serviço.'),
('5250', 'VENDAS DE ENERGIA ELÉTRICA', NULL),
('5251', 'Venda de energia elétrica para distribuição ou comercialização', 'Classificam-se neste código as vendas de energia elétrica destinada à distribuição ou comercialização. Também serão classificadas neste código as vendas de energia elétrica destinada a cooperativas para distribuição aos seus cooperados.'),
('5252', 'Venda de energia elétrica para estabelecimento industrial', 'Classificam-se neste código as vendas de energia elétrica para consumo por estabelecimento industrial. Também serão classificadas neste código as vendas de energia elétrica destinada a estabelecimento industrial de cooperativa.'),
('5253', 'Venda de energia elétrica para estabelecimento comercial', 'Classificam-se neste código as vendas de energia elétrica para consumo por estabelecimento comercial. Também serão classificadas neste código as vendas de energia elétrica destinada a estabelecimento comercial de cooperativa.'),
('5254', 'Venda de energia elétrica para estabelecimento prestador de serviço de transporte', 'Classificam-se neste código as vendas de energia elétrica para consumo por estabelecimento de prestador de serviços de transporte.'),
('5255', 'Venda de energia elétrica para estabelecimento prestador de serviço de comunicação', 'Classificam-se neste código as vendas de energia elétrica para consumo por estabelecimento de prestador de serviços de comunicação.'),
('5256', 'Venda de energia elétrica para estabelecimento de produtor rural', 'Classificam-se neste código as vendas de energia elétrica para consumo por estabelecimento de produtor rural.'),
('5257', 'Venda de energia elétrica para consumo por demanda contratada', 'Classificam-se neste código as vendas de energia elétrica para consumo por demanda contratada, que prevalecerá sobre os demais códigos deste subgrupo.'),
('5258', 'Venda de energia elétrica a não contribuinte', 'Classificam-se neste código as vendas de energia elétrica a pessoas físicas ou a pessoas jurídicas não indicadas nos códigos anteriores.'),
('5300', 'PRESTAÇÕES DE SERVIÇOS DE COMUNICAÇÃO', NULL);
INSERT INTO `tab_cfop` (`id`, `descricao`, `aplicacao`) VALUES
('5301', 'Prestação de serviço de comunicação para execução de serviço da mesma natureza', 'Classificam-se neste código as prestações de serviços de comunicação destinados às prestações de serviços da mesma natureza.'),
('5302', 'Prestação de serviço de comunicação a estabelecimento industrial', 'Classificam-se neste código as prestações de serviços de comunicação a estabelecimento industrial. Também serão classificados neste código os serviços de comunicação prestados a estabelecimento industrial de cooperativa.'),
('5303', 'Prestação de serviço de comunicação a estabelecimento comercial', 'Classificam-se neste código as prestações de serviços de comunicação a estabelecimento comercial. Também serão classificados neste código os serviços de comunicação prestados a estabelecimento comercial de cooperativa.'),
('5304', 'Prestação de serviço de comunicação a estabelecimento de prestador de serviço de transporte', 'Classificam-se neste código as prestações de serviços de comunicação a estabelecimento prestador de serviço de transporte.'),
('5305', 'Prestação de serviço de comunicação a estabelecimento de geradora ou de distribuidora de energia elétrica', 'Classificam-se neste código as prestações de serviços de comunicação a estabelecimento de geradora ou de distribuidora de energia elétrica.'),
('5306', 'Prestação de serviço de comunicação a estabelecimento de produtor rural', 'Classificam-se neste código as prestações de serviços de comunicação a estabelecimento de produtor rural.'),
('5307', 'Prestação de serviço de comunicação a não contribuinte', 'Classificam-se neste código as prestações de serviços de comunicação a pessoas físicas ou a pessoas jurídicas não indicadas nos códigos anteriores.'),
('5350', 'PRESTAÇÕES DE SERVIÇOS DE TRANSPORTE', NULL),
('5351', 'Prestação de serviço de transporte para execução de serviço da mesma natureza', 'Classificam-se neste código as prestações de serviços de transporte destinados às prestações de serviços da mesma natureza.'),
('5352', 'Prestação de serviço de transporte a estabelecimento industrial', 'Classificam-se neste código as prestações de serviços de transporte a estabelecimento industrial. Também serão classificados neste código os serviços de transporte prestados a estabelecimento industrial de cooperativa.'),
('5353', 'Prestação de serviço de transporte a estabelecimento comercial', 'Classificam-se neste código as prestações de serviços de transporte a estabelecimento comercial. Também serão classificados neste código os serviços de transporte prestados a estabelecimento comercial de cooperativa.'),
('5354', 'Prestação de serviço de transporte a estabelecimento de prestador de serviço de comunicação', 'Classificam-se neste código as prestações de serviços de transporte a estabelecimento prestador de serviços de comunicação.'),
('5355', 'Prestação de serviço de transporte a estabelecimento de geradora ou de distribuidora de energia elétrica', 'Classificam-se neste código as prestações de serviços de transporte a estabelecimento de geradora ou de distribuidora de energia elétrica.'),
('5356', 'Prestação de serviço de transporte a estabelecimento de produtor rural', 'Classificam-se neste código as prestações de serviços de transporte a estabelecimento de produtor rural.'),
('5357', 'Prestação de serviço de transporte a não contribuinte', 'Classificam-se neste código as prestações de serviços de transporte a pessoas físicas ou a pessoas jurídicas não indicadas nos códigos anteriores.'),
('5359', 'Prestação de serviço de transporte a contribuinte ou a não-contribuinte, quando a mercadoria transportada esteja dispensada de emissão de Nota Fiscal ', 'Prestação de serviço de transporte a contribuinte ou a não-contribuinte, quando não existir a obrigação legal de emissão de Nota Fiscal para a mercadoria transportada. (ACR Ajuste SINIEF 03/2004) (DECRETO Nº 26.810, DE 10 DE JUNHO DE 2004) (a partir de 01.01.2005)'),
('5360', 'Prestação de serviço de transporte a contribuinte-substituto em relação ao serviço de transporte (ACR) (Ajuste SINIEF 06/2007- Decreto nº 30.861/2007) – a partir de 01.01.2008', 'Prestação de serviço de transporte a contribuinte a quem tenha sido atribuída a condição de contribuinte-substituto em relação ao imposto incidente na prestação dos serviços.'),
('5400', 'SAÍDAS DE MERCADORIAS SUJEITAS AO REGIME DE SUBSTITUIÇÃO TRIBUTÁRIA', NULL),
('5401', 'Venda de produção do estabelecimento quando o produto esteja sujeito ao regime de substituição tributária', 'Venda de produto industrializado ou produzido pelo estabelecimento, quando o referido produto estiver sujeito ao regime de substituição tributária, bem como a de produto industrializado, por estabelecimento industrial ou produtor rural de cooperativa, sujeito ao regime de substituição tributária.\r\n(NR Ajuste SINIEF 05/2005) (Dec.28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('5402', 'Venda de produção do estabelecimento de produto sujeito ao regime de substituição tributária, em operação entre contribuintes substitutos do mesmo produto', 'Classificam-se neste código as vendas de produtos sujeitos ao regime de substituição tributária industrializados no estabelecimento, em operações entre contribuintes substitutos do mesmo produto'),
('5403', 'Venda de mercadoria, adquirida ou recebida de terceiros, sujeita ao regime de substituição tributária, na condição de contribuinte-substituto', 'Venda de mercadoria, adquirida ou recebida de terceiros, sujeita ao regime de substituição tributária, na condição de contribuinte-substituto.\r\n\r\n– (Decreto Nº 25.068/2003). a partir 01.01.2003'),
('5405', 'Venda de mercadoria, adquirida ou recebida de terceiros, sujeita ao regime de substituição tributária, na condição de contribuinte-substituído', 'Venda de mercadoria, adquirida ou recebida de terceiros, sujeita ao regime de substituição tributária, na condição de contribuinte-substituído.\r\n\r\n– (Decreto Nº 25.068/2003). a partir 01.01.2003'),
('5408', 'Transferência de produção do estabelecimento quando o produto estiver sujeito ao regime de substituição tributária', 'Transferência de produto industrializado ou produzido no estabelecimento, para outro estabelecimento da mesma empresa, quando o produto estiver sujeito ao regime de substituição tributária.\r\n(NR Ajuste SINIEF 05/2005) (Dec.28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('5409', 'Transferência de mercadoria adquirida ou recebida de terceiros em operação com mercadoria sujeita ao regime de substituição tributária', 'Classificam-se neste código as transferências para outro estabelecimento da mesma empresa, de mercadorias adquiridas ou recebidas de terceiros que não tenham sido objeto de qualquer processo industrial no estabelecimento, em operações com mercadorias sujeitas ao regime de substituição tributária.'),
('5410', 'Devolução de compra para industrialização de mercadoria sujeita ao regime de substituição tributária', 'Devolução de mercadoria adquirida para ser utilizada em processo de industrialização ou produção rural, cuja entrada tenha sido classificada como \"Compra para industrialização ou produção rural de mercadoria sujeita ao regime de substituição tributária\".\r\n(NR Ajuste SINIEF 05/2005) (Dec.28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('5411', 'Devolução de compra para comercialização em operação com mercadoria sujeita ao regime de substituição tributária', 'Classificam-se neste código as devoluções de mercadorias adquiridas para serem comercializadas, cujas entradas tenham sido classificadas como Compra para comercialização em operação com mercadoria sujeita ao regime de substituição tributária.'),
('5412', 'Devolução de bem do ativo imobilizado, em operação com mercadoria sujeita ao regime de substituição tributária', 'Classificam-se neste código as devoluções de bens adquiridos para integrar o ativo imobilizado do estabelecimento, cuja entrada tenha sido classificada no código 1.406 - Compra de bem para o ativo imobilizado cuja mercadoria está sujeita ao regime de substituição tributária.'),
('5413', 'Devolução de mercadoria destinada ao uso ou consumo, em operação com mercadoria sujeita ao regime de substituição tributária.', 'Classificam-se neste código as devoluções de mercadorias adquiridas para uso ou consumo do estabelecimento, cuja entrada tenha sido classificada no código 1.407 - Compra de mercadoria para uso ou consumo cuja mercadoria está sujeita ao regime de substituição tributária.'),
('5414', 'Remessa de produção do estabelecimento para venda fora do estabelecimento, quando o produto estiver sujeito ao regime de substituição tributária', 'Remessa de produto industrializado ou produzido pelo estabelecimento para ser vendido fora do estabelecimento, inclusive por meio de veículo, quando o mencionado produto estiver sujeito ao regime de substituição tributária.\r\n\r\n(NR Ajuste SINIEF 05/2005) (Dec.28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('5415', 'Remessa de mercadoria adquirida ou recebida de terceiros para venda fora do estabelecimento, em operação com mercadoria sujeita ao regime de substituição tributária', 'Classificam-se neste código as remessas de mercadorias adquiridas ou recebidas de terceiros para serem vendidas fora do estabelecimento, inclusive por meio de veículos, em operações com mercadorias sujeitas ao regime de substituição tributária.'),
('5450', 'SISTEMAS DE INTEGRAÇÃO', NULL),
('5451', 'Remessa de animal e de insumo para estabelecimento produtor', 'Classificam-se neste código as saídas referentes à remessa de animais e de insumos para criação de animais no sistema integrado, tais como: pintos, leitões, rações e medicamentos.'),
('5500', 'REMESSAS PARA FORMAÇÃO DE LOTE E COM FIM ESPECÍFICO DE EXPORTAÇÃO E EVENTUAIS DEVOLUÇÕES (NR Ajuste SINIEF 09/2005)', '(NR Ajuste SINIEF 09/2005) (Dec. 28.868/2006 - a sua aplicação será obrigatória em relação aos fatos geradores ocorridos a partir de 01 de julho de 2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de janeiro a 30 de junho de 2006)'),
('5501', 'Remessa de produção do estabelecimento, com fim específico de exportação', 'Saída de produto industrializado ou produzido pelo estabelecimento, remetido com fim específico de exportação a \"trading company\", empresa comercial exportadora ou outro estabelecimento do remetente\r\n(NR Ajuste SINIEF 05/2005) (Dec.28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('5502', 'Remessa de mercadoria adquirida ou recebida de terceiros, com fim específico de exportação', 'Classificam-se neste código as saídas de mercadorias adquiridas ou recebidas de terceiros, remetidas com fim específico de exportação a trading company, empresa comercial exportadora ou outro estabelecimento do remetente.'),
('5503', 'Devolução de mercadoria recebida com fim específico de exportação', 'Classificam-se neste código as devoluções efetuadas por trading company, empresa comercial exportadora ou outro estabelecimento do destinatário, de mercadorias recebidas com fim específico de exportação, cujas entradas tenham sido classificadas no código 1.501 - Entrada de mercadoria recebida com fim específico de exportação.'),
('5504', 'Remessa de mercadoria para formação de lote de exportação, de produto industrializado ou produzido pelo próprio estabelecimento.', 'Remessa de mercadoria para formação de lote de exportação, de produto industrializado ou produzido pelo próprio estabelecimento.\r\n\r\n(ACR Ajuste SINIEF 09/2005) (Dec. 28.868/2006 - a sua aplicação será obrigatória em relação aos fatos geradores ocorridos a partir de 01 de julho de 2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de janeiro a 30 de junho de 2006)'),
('5505', 'Remessa de mercadoria, adquirida ou recebida de terceiros, para formação de lote de exportação.', 'Remessa de mercadoria, adquirida ou recebida de terceiros, para formação de lote de exportação.\r\n\r\n(ACR Ajuste SINIEF 09/2005) (Dec. 28.868/2006 - a sua aplicação será obrigatória em relação aos fatos geradores ocorridos a partir de 01 de julho de 2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de janeiro a 30 de junho de 2006)'),
('5550', 'OPERAÇÕES COM BENS DE ATIVO IMOBILIZADO E MATERIAIS PARA USO OU CONSUMO', NULL),
('5551', 'Venda de bem do ativo imobilizado', 'Classificam-se neste código as vendas de bens integrantes do ativo imobilizado do estabelecimento.'),
('5552', 'Transferência de bem do ativo imobilizado', 'Classificam-se neste código os bens do ativo imobilizado transferidos para outro estabelecimento da mesma empresa.'),
('5553', 'Devolução de compra de bem para o ativo imobilizado', 'Classificam-se neste código as devoluções de bens adquiridos para integrar o ativo imobilizado do estabelecimento, cuja entrada foi classificada no código 1.551 - Compra de bem para o ativo imobilizado.'),
('5554', 'Remessa de bem do ativo imobilizado para uso fora do estabelecimento', 'Classificam-se neste código as remessas de bens do ativo imobilizado para uso fora do estabelecimento.'),
('5555', 'Devolução de bem do ativo imobilizado de terceiro, recebido para uso no estabelecimento', 'Classificam-se neste código as saídas em devolução, de bens do ativo imobilizado de terceiros, recebidos para uso no estabelecimento, cuja entrada tenha sido classificada no código 1.555 - Entrada de bem do ativo imobilizado de terceiro, remetido para uso no estabelecimento.'),
('5556', 'Devolução de compra de material de uso ou consumo', 'Classificam-se neste código as devoluções de mercadorias destinadas ao uso ou consumo do estabelecimento, cuja entrada tenha sido classificada no código 1.556 - Compra de material para uso ou consumo.'),
('5557', 'Transferência de material de uso ou consumo', 'Classificam-se neste código os materiais para uso ou consumo transferidos para outro estabelecimento da mesma empresa.'),
('5600', 'CRÉDITOS E RESSARCIMENTOS DE ICMS', NULL),
('5601', 'Transferência de crédito de ICMS acumulado', 'Classificam-se neste código os lançamentos destinados ao registro da transferência de créditos de ICMS para outras empresas.'),
('5602', 'Transferência de saldo credor do ICMS, para outro estabelecimento da mesma empresa, destinado à compensação de saldo devedor do ICMS', 'Lançamento destinado ao registro da transferência de saldo credor do ICMS, para outro estabelecimento da mesma empresa, destinado à compensação do saldo devedor desse estabelecimento, inclusive no caso de apuração centralizada do imposto. (NR Ajuste SINIEF 09/2003 – a partir 01.01.2004)'),
('5603', 'Ressarcimento de ICMS retido por substituição tributária', 'Classificam-se neste código os lançamentos destinados ao registro de ressarcimento de ICMS retido por substituição tributária a contribuinte substituído, efetuado pelo contribuinte substituto, nas hipóteses previstas na legislação aplicável.'),
('5605', 'Transferência de saldo devedor do ICMS de outro estabelecimento da mesma empresa ', 'Lançamento destinado ao registro da transferência de saldo devedor do ICMS para outro estabelecimento da mesma empresa, para efetivação da apuração centralizada do imposto. (ACR Ajuste SINIEF 03/2004) (DECRETO Nº 26.810/2004) (a partir de 01.01.2005)'),
('5606', 'Utilização de saldo credor do ICMS para extinção por compensação de débitos fiscais', 'Lançamento destinado ao registro de utilização de saldo credor do ICMS em conta gráfica para extinção por compensação de débitos fiscais desvinculados de conta gráfica. (ACR Ajuste SINIEF 02/2005 – a partir de 01.01.2006). (DECRETO Nº 27.995 de 06.06.2005) a partir de 01.01.2006'),
('5650', 'SAÍDAS DE COMBUSTÍVEIS, DERIVADOS OU NÃO DE PETRÓLEO, E LUBRIFICANTES', ' (ACR Ajuste SINIEF 9/2003 - a partir 01.01.2004) ( Decreto Nº 26.174 de 26/11/2003)'),
('5651', 'Venda de combustível ou lubrificante de produção do estabelecimento destinados à industrialização subseqüente', 'Venda de combustível ou lubrificante, industrializados no estabelecimento e destinados à industrialização do próprio produto, inclusive aquela decorrente de encomenda para entrega futura, cujo faturamento tenha sido classificado no código 5.922 – \"Lançamento efetuado a título de simples faturamento decorrente de venda para entrega futura\".(a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('5652', 'Venda de combustível ou lubrificante, de produção do estabelecimento, destinados à comercialização', 'Venda de combustível ou lubrificante, industrializados no estabelecimento, destinados à comercialização, inclusive aquela decorrente de encomenda para entrega futura, cujo faturamento tenha sido classificado no código 5.922 – \"Lançamento efetuado a título de simples faturamento decorrente de venda para entrega futura\".(a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('5653', 'Venda de combustível ou lubrificante, de produção do estabelecimento, destinados a consumidor ou usuário final', 'Venda de combustível ou lubrificante, industrializados no estabelecimento, destinados a consumo em processo de industrialização de outro produto, à prestação de serviço ou a usuário final, inclusive aquela decorrente de encomenda para entrega futura, cujo faturamento tenha sido classificado no código 5.922 – \"Lançamento efetuado a título de simples faturamento decorrente de venda para entrega futura\".(a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('5654', 'Venda de combustível ou lubrificante, adquiridos ou recebidos de terceiros, destinados à industrialização subseqüente', 'Venda de combustível ou lubrificante, adquiridos ou recebidos de terceiros, destinados à industrialização do próprio produto, inclusive aquela decorrente de encomenda para entrega futura, cujo faturamento tenha sido classificado no código 5.922 – \"Lançamento efetuado a título de simples faturamento decorrente de venda para entrega futura\".(a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('5655', 'Venda de combustível ou lubrificante, adquiridos ou recebidos de terceiros, destinados à comercialização', 'Venda de combustível ou lubrificante, adquiridos ou recebidos de terceiros, destinados à comercialização, inclusive aquela decorrente de encomenda para entrega futura, cujo faturamento tenha sido classificado no código 5.922 – \"Lançamento efetuado a título de simples faturamento decorrente de venda para entrega futura\".(a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('5656', 'Venda de combustível ou lubrificante, adquiridos ou recebidos de terceiros, destinados a consumidor ou usuário final', 'Venda de combustível ou lubrificante, adquiridos ou recebidos de terceiros, destinados a consumo em processo de industrialização de outro produto, à prestação de serviço ou a usuário final, inclusive aquela decorrente de encomenda para entrega futura, cujo faturamento tenha sido classificado no código 5.922 – \"Lançamento efetuado a título de simples faturamento decorrente de venda para entrega futura\".(a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('5657', 'Remessa de combustível ou lubrificante, adquiridos ou recebidos de terceiros, para venda fora do estabelecimento', 'Remessa de combustível ou lubrificante, adquiridos ou recebidos de terceiros, para ser vendidos fora do estabelecimento, inclusive por meio de veículos. (a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('5658', 'Transferência de combustível ou lubrificante de produção do estabelecimento', 'Transferência de combustível ou lubrificante, industrializados no estabelecimento, para outro estabelecimento da mesma empresa. (a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('5659', 'Transferência de combustível ou lubrificante adquiridos ou recebidos de terceiros', 'Transferência de combustível ou lubrificante, adquiridos ou recebidos de terceiros, para outro estabelecimento da mesma empresa. (a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('5660', 'Devolução de compra de combustível ou lubrificante adquiridos para industrialização subseqüente', 'Devolução de compra de combustível ou lubrificante, adquiridos para industrialização do próprio produto, cuja entrada tenha sido classificada como \"Compra de combustível ou lubrificante para industrialização subseqüente\".(a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('5661', 'Devolução de compra de combustível ou lubrificante adquiridos para comercialização', 'Devolução de compra de combustível ou lubrificante, adquiridos para comercialização, cuja entrada tenha sido classificada como \"Compra de combustível ou lubrificante para comercialização\".(a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('5662', 'Devolução de compra de combustível ou lubrificante adquiridos por consumidor ou usuário final', 'Devolução de compra de combustível ou lubrificante, adquiridos para consumo em processo de industrialização de outro produto, na prestação de serviço ou por usuário final, cuja entrada tenha sido classificada como \"Compra de combustível ou lubrificante por consumidor ou usuário final\".(a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('5663', 'Remessa para armazenagem de combustível ou lubrificante', 'Remessa para armazenagem de combustível ou lubrificante. (a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('5664', 'Retorno de combustível ou lubrificante recebidos para armazenagem', 'Remessa, em devolução, de combustível ou lubrificante, recebidos para armazenagem. (a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('5665', 'Retorno simbólico de combustível ou lubrificante recebidos para armazenagem', 'Retorno simbólico de combustível ou lubrificante, recebidos para armazenagem, quando a mercadoria armazenada tenha sido objeto de saída, a qualquer título, e não deva retornar ao estabelecimento depositante. (a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('5666', 'Remessa, por conta e ordem de terceiros, de combustível ou lubrificante recebidos para armazenagem', 'Saída, por conta e ordem de terceiros, de combustível ou lubrificante, recebidos anteriormente para armazenagem. (a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('5667', 'Venda de combustível ou lubrificante a consumidor ou usuário final estabelecido em outra Unidade da Federação', 'Venda de combustível ou lubrificante a consumidor ou a usuário final estabelecido em outra Unidade da Federação, cujo abastecimento tenha sido efetuado na unidade da Federação do remetente. ACR Ajuste SINIEF 05/2009 – a partir de 01.07.2009)(Decreto nº 34.490/2009)'),
('5900', 'OUTRAS SAÍDAS DE MERCADORIAS OU PRESTAÇÕES DE SERVIÇOS', NULL),
('5901', 'Remessa para industrialização por encomenda', 'Classificam-se neste código as remessas de insumos remetidos para industrialização por encomenda, a ser realizada em outra empresa ou em outro estabelecimento da mesma empresa.'),
('5902', 'Retorno de mercadoria utilizada na industrialização por encomenda', 'Classificam-se neste código as remessas, pelo estabelecimento industrializador, dos insumos recebidos para industrialização e incorporados ao produto final, por encomenda de outra empresa ou de outro estabelecimento da mesma empresa. O valor dos insumos nesta operação deverá ser igual ao valor dos insumos recebidos para industrialização.'),
('5903', 'Retorno de mercadoria recebida para industrialização e não aplicada no referido processo', 'Classificam-se neste código as remessas em devolução de insumos recebidos para industrialização e não aplicados no referido processo.'),
('5904', 'Remessa para venda fora do estabelecimento', 'Classificam-se neste código as remessas de mercadorias para venda fora do estabelecimento, inclusive por meio de veículos.'),
('5905', 'Remessa para depósito fechado ou armazém geral', 'Classificam-se neste código as remessas de mercadorias para depósito em depósito fechado ou armazém geral.'),
('5906', 'Retorno de mercadoria depositada em depósito fechado ou armazém geral', 'Classificam-se neste código os retornos de mercadorias depositadas em depósito fechado ou armazém geral ao estabelecimento depositante.'),
('5907', 'Retorno simbólico de mercadoria depositada em depósito fechado ou armazém geral', 'Classificam-se neste código os retornos simbólicos de mercadorias recebidas para depósito em depósito fechado ou armazém geral, quando as mercadorias depositadas tenham sido objeto de saída a qualquer título e que não devam retornar ao estabelecimento depositante.'),
('5908', 'Remessa de bem por conta de contrato de comodato', 'Classificam-se neste código as remessas de bens para o cumprimento de contrato de comodato.'),
('5909', 'Retorno de bem recebido por conta de contrato de comodato', 'Classificam-se neste código as remessas de bens em devolução após cumprido o contrato de comodato.'),
('5910', 'Remessa em bonificação, doação ou brinde', 'Classificam-se neste código as remessas de mercadorias a título de bonificação, doação ou brinde.'),
('5911', 'Remessa de amostra grátis', 'Classificam-se neste código as remessas de mercadorias a título de amostra grátis.'),
('5912', 'Remessa de mercadoria ou bem para demonstração', 'Classificam-se neste código as remessas de mercadorias ou bens para demonstração.'),
('5913', 'Retorno de mercadoria ou bem recebido para demonstração', 'Classificam-se neste código as remessas em devolução de mercadorias ou bens recebidos para demonstração.'),
('5914', 'Remessa de mercadoria ou bem para exposição ou feira', 'Classificam-se neste código as remessas de mercadorias ou bens para exposição ou feira.'),
('5915', 'Remessa de mercadoria ou bem para conserto ou reparo', 'Classificam-se neste código as remessas de mercadorias ou bens para conserto ou reparo.'),
('5916', 'Retorno de mercadoria ou bem recebido para conserto ou reparo', 'Classificam-se neste código as remessas em devolução de mercadorias ou bens recebidos para conserto ou reparo.'),
('5917', 'Remessa de mercadoria em consignação mercantil ou industrial', 'Classificam-se neste código as remessas de mercadorias a título de consignação mercantil ou industrial.'),
('5918', 'Devolução de mercadoria recebida em consignação mercantil ou industrial', 'Classificam-se neste código as devoluções de mercadorias recebidas anteriormente a título de consignação mercantil ou industrial.'),
('5919', 'Devolução simbólica de mercadoria vendida ou utilizada em processo industrial, recebida anteriormente em consignação mercantil ou industrial', 'Classificam-se neste código as devoluções simbólicas de mercadorias vendidas ou utilizadas em processo industrial, que tenham sido recebidas anteriormente a título de consignação mercantil ou industrial.'),
('5920', 'Remessa de vasilhame ou sacaria', 'Classificam-se neste código as remessas de vasilhame ou sacaria.'),
('5921', 'Devolução de vasilhame ou sacaria', 'Classificam-se neste código as saídas por devolução de vasilhame ou sacaria.'),
('5922', 'Lançamento efetuado a título de simples faturamento decorrente de venda para entrega futura', 'Classificam-se neste código os registros efetuados a título de simples faturamento decorrente de venda para entrega futura.'),
('5923', 'Remessa de mercadoria por conta e ordem de terceiros, em venda à ordem', 'Classificam-se neste código as saídas correspondentes à entrega de mercadorias por conta e ordem de terceiros, em vendas à ordem, cuja venda ao adquirente originário, foi classificada nos códigos 5.118 - Venda de produção do estabelecimento entregue ao destinatário por conta e ordem do adquirente originário, em venda à ordem ou 5.119'),
('5924', 'Remessa para industrialização por conta e ordem do adquirente da mercadoria, quando esta não transitar pelo estabelecimento do adquirente', 'Classificam-se neste código as saídas de insumos com destino a estabelecimento industrializador, para serem industrializados por conta e ordem do adquirente, nas hipóteses em que os insumos não tenham transitado pelo estabelecimento do adquirente dos mesmos.'),
('5925', 'Retorno de mercadoria recebida para industrialização por conta e ordem do adquirente da mercadoria, quando aquela não transitar pelo estabelecimento do adquirente', 'Classificam-se neste código as remessas, pelo estabelecimento industrializador, dos insumos recebidos, por conta e ordem do adquirente, para industrialização e incorporados ao produto final, nas hipóteses em que os insumos não tenham transitado pelo estabelecimento do adquirente. O valor dos insumos nesta operação deverá ser igual ao valor dos insumos recebidos para industrialização.'),
('5926', 'Lançamento efetuado a título de reclassificação de mercadoria decorrente de formação de kit ou de sua desagregação', 'Classificam-se neste código os registros efetuados a título de reclassificação decorrente de formação de kit de mercadorias ou de sua desagregação.'),
('5927', 'Lançamento efetuado a título de baixa de estoque decorrente de perda, roubo ou deterioração', 'Classificam-se neste código os registros efetuados a título de baixa de estoque decorrente de perda, roubou ou deterioração das mercadorias.'),
('5928', 'Lançamento efetuado a título de baixa de estoque decorrente de perda, roubo ou deterioração', 'Classificam-se neste código os registros efetuados a título de baixa de estoque decorrente de perda, roubou ou deterioração das mercadorias.'),
('5929', 'Lançamento efetuado em decorrência de emissão de documento fiscal relativo a operação ou prestação também registrada em equipamento Emissor de Cupom Fiscal - ECF', 'Classificam-se neste código os registros relativos aos documentos fiscais emitidos em operações ou prestações que também tenham sido registradas em equipamento Emissor de Cupom Fiscal - ECF.'),
('5931', 'Lançamento efetuado em decorrência da responsabilidade de retenção do imposto por substituição tributária, atribuída ao remetente ou alienante da mercadoria, pelo serviço de transporte realizado por t', 'Classificam-se neste código exclusivamente os lançamentos efetuados pelo remetente ou alienante da mercadoria quando lhe for atribuída a responsabilidade pelo recolhimento do imposto devido pelo serviço de transporte realizado por transportador autônomo ou por transportador não inscrito na unidade da Federação onde iniciado o serviço.'),
('5932', 'Prestação de serviço de transporte iniciada em unidade da Federação diversa daquela onde inscrito o prestador', 'Classificam-se neste código as prestações de serviço de transporte que tenham sido iniciadas em unidade da Federação diversa daquela onde o prestador está inscrito como contribuinte.'),
('5933', 'Prestação de serviço tributado pelo Imposto Sobre Serviços de Qualquer Natureza', 'Prestação de serviço, cujo imposto é de competência municipal, desde que informado em Nota Fiscal modelo 1 ou 1-A. (NR Ajuste SINIEF 06/2005)a partir de 01/01/2006'),
('5949', 'Outra saída de mercadoria ou prestação de serviço não especificado', 'Classificam-se neste código as outras saídas de mercadorias ou prestações de serviços que não tenham sido especificados nos códigos anteriores.'),
('6000', 'SAÍDAS OU PRESTAÇÕES DE SERVIÇOS PARA OUTROS ESTADOS', 'Classificam-se, neste grupo, as operações ou prestações em que o estabelecimento remetente esteja localizado em unidade da Federação diversa daquela do destinatário'),
('6101', 'Venda de produção do estabelecimento', 'Venda de produto industrializado ou produzido pelo estabelecimento, bem como a de mercadoria por estabelecimento industrial ou produtor rural de cooperativa destinada a seus cooperados ou a estabelecimento de outra cooperativa.\r\n\r\n(NR Ajuste SINIEF 05/2005) (Dec.28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('6102', 'Venda de mercadoria adquirida ou recebida de terceiros', 'Classificam-se neste código as vendas de mercadorias adquiridas ou recebidas de terceiros para industrialização ou comercialização, que não tenham sido objeto de qualquer processo industrial no estabelecimento. Também serão classificadas neste código as vendas de mercadorias por estabelecimento comercial de cooperativa destinadas a seus cooperados ou estabelecimento de outra cooperativa.'),
('6103', 'Venda de produção do estabelecimento, efetuada fora do estabelecimento', 'venda efetuada fora do estabelecimento, inclusive por meio de veículo, de produto industrializado no estabelecimento.\r\n\r\n(NR Ajuste SINIEF 05/2005) (Dec.28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('6104', 'Venda de mercadoria adquirida ou recebida de terceiros, efetuada fora do estabelecimento', 'venda efetuada fora do estabelecimento, inclusive por meio de veículo, de mercadoria adquirida ou recebida de terceiro para industrialização ou comercialização, que não tenha sido objeto de qualquer processo industrial no estabelecimento.'),
('6105', 'Venda de produção do estabelecimento que não deva por ele transitar', 'Classificam-se neste código as vendas de produtos industrializados no estabelecimento, armazenados em depósito fechado, armazém geral ou outro sem que haja retorno ao estabelecimento depositante.'),
('6106', 'Venda de mercadoria adquirida ou recebida de terceiros, que não deva por ele transitar', 'Vendas de mercadoria adquirida ou recebida de terceiro para industrialização ou comercialização, armazenada em depósito fechado, armazém geral ou outro, que não tenha sido objeto de qualquer processo industrial no estabelecimento sem que haja retorno ao estabelecimento depositante. Bem como venda de mercadoria importada, cuja saída ocorra do recinto alfandegado ou da repartição alfandegária onde se processou o desembaraço aduaneiro, com destino ao estabelecimento do comprador, sem que tenha transitado pelo estabelecimento do'),
('6107', 'Venda de produção do estabelecimento, destinada a não contribuinte', 'Vendas de produto industrializado no estabelecimento, ou produzido no estabelecimento do produtor rural, destinada a não contribuinte, bem como qualquer operação de venda destinada a não contribuinte\r\n\r\n (NR Ajuste SINIEF 05/2005) (Dec.28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('6108', 'Venda de mercadoria adquirida ou recebida de terceiros, destinada a não contribuinte', 'Classificam-se neste código as vendas de mercadorias adquiridas ou recebidas de terceiros para industrialização ou comercialização, que não tenham sido objeto de qualquer processo industrial no estabelecimento, destinadas a não contribuintes. Quaisquer operações de venda destinadas a não contribuintes deverão ser classificadas neste código.'),
('6109', 'Venda de produção do estabelecimento destinada à Zona Franca de Manaus ou Áreas de Livre Comércio', 'Venda de produto industrializado ou produzido pelo estabelecimento destinado à Zona Franca de Manaus ou Áreas de Livre Comércio.\r\n\r\n(NR Ajuste SINIEF 05/2005) (Dec.28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('6110', 'Venda de mercadoria, adquirida ou recebida de terceiros, destinada à Zona Franca de Manaus ou Áreas de Livre Comércio, de que trata o Anexo do Convênio SINIEF s/n, de 15 de dezembro de 1970, que dispõ', 'Venda de mercadoria, adquirida ou recebida de terceiros, destinada à Zona Franca de Manaus ou Áreas de Livre Comércio, desde que alcançada pelos benefícios fiscais de que tratam o Decreto-Lei nº 288, de 28 de fevereiro de 1967, o Convênio ICM 65/88, de 06 de dezembro de 1988, o Convênio ICMS 36/97, de 23 de maio de 1997, e o Convênio ICMS 37/97, de 23 de maio de 1997. (NR Ajuste SINIEF 09/2004) (Decreto nº 26.955/2004) RETROAGINDO SEUS EFEITOS A 24.06.2004'),
('6111', 'Venda de produção do estabelecimento remetida anteriormente em consignação industrial', 'Classificam-se neste código as vendas efetivas de produtos industrializados no estabelecimento remetidos anteriormente a título de consignação industrial.'),
('6112', 'Venda de mercadoria adquirida ou recebida de Terceiros remetida anteriormente em consignação industrial', 'Classificam-se neste código as vendas efetivas de mercadorias adquiridas ou recebidas de terceiros, que não tenham sido objeto de qualquer processo industrial no estabelecimento, remetidas anteriormente a título de consignação industrial.'),
('6113', 'Venda de produção do estabelecimento remetida anteriormente em consignação mercantil', 'Classificam-se neste código as vendas efetivas de produtos industrializados no estabelecimento remetidos anteriormente a título de consignação mercantil.'),
('6114', 'Venda de mercadoria adquirida ou recebida de terceiros remetida anteriormente em consignação mercantil', 'Classificam-se neste código as vendas efetivas de mercadorias adquiridas ou recebidas de terceiros, que não tenham sido objeto de qualquer processo industrial no estabelecimento, remetidas anteriormente a título de consignação mercantil.'),
('6115', 'Venda de mercadoria adquirida ou recebida de terceiros, recebida anteriormente em consignação mercantil', 'Classificam-se neste código as vendas de mercadorias adquiridas ou recebidas de terceiros, recebidas anteriormente a título de consignação mercantil.'),
('6116', 'Venda de produção do estabelecimento originada de encomenda para entrega futura', 'Venda de produto industrializado ou produzido pelo estabelecimento, quando da saída real do produto, cujo faturamento tenha sido classificado no código \"5.922 – Lançamento efetuado a título de simples faturamento decorrente de venda para entrega futura\".\r\n\r\n(NR Ajuste SINIEF 05/2005) (Dec.28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('6117', 'Venda de mercadoria adquirida ou recebida de terceiros, originada de encomenda para entrega futura', 'Classificam-se neste código as vendas de mercadorias adquiridas ou recebidas de terceiros, que não tenham sido objeto de qualquer processo industrial no estabelecimento, quando da saída real da mercadoria, cujo faturamento tenha sido classificado no código 6.922 - Lançamento efetuado a título de simples faturamento decorrente de venda para entrega futura.'),
('6118', 'Venda de produção do estabelecimento entregue ao destinatário por conta e ordem do adquirente originário, em venda à ordem', 'Classificam-se neste código as vendas à ordem de produtos industrializados pelo estabelecimento, entregues ao destinatário por conta e ordem do adquirente originário.'),
('6119', 'Venda de mercadoria adquirida ou recebida de terceiros entregue ao destinatário por conta e ordem do adquirente originário, em venda à ordem', 'Classificam-se neste código as vendas à ordem de mercadorias adquiridas ou recebidas de terceiros, que não tenham sido objeto de qualquer processo industrial no estabelecimento, entregues ao destinatário por conta e ordem do adquirente originário.'),
('6120', 'Venda de mercadoria adquirida ou recebida de terceiros entregue ao destinatário pelo vendedor remetente, em venda à ordem', 'Classificam-se neste código as vendas à ordem de mercadorias adquiridas ou recebidas de terceiros, que não tenham sido objeto de qualquer processo industrial no estabelecimento, entregues pelo vendedor remetente ao destinatário, cuja compra seja classificada, pelo adquirente originário, no código 2.118 - Compra de mercadoria pelo adquirente originário, entregue pelo vendedor remetente ao destinatário, em venda à ordem.'),
('6122', 'Venda de produção do estabelecimento remetida para industrialização, por conta e ordem do adquirente, sem transitar pelo estabelecimento do adquirente', 'Classificam-se neste código as vendas de produtos industrializados no estabelecimento, remetidos para serem industrializados em outro estabelecimento, por conta e ordem do adquirente, sem que os produtos tenham transitado pelo estabelecimento do adquirente.'),
('6123', 'Venda de mercadoria adquirida ou recebida de terceiros remetida para industrialização, por conta e ordem do adquirente, sem transitar pelo estabelecimento do adquirente', 'Classificam-se neste código as vendas de mercadorias adquiridas ou recebidas de terceiros, que não tenham sido objeto de qualquer processo industrial no estabelecimento, remetidas para serem industrializadas em outro estabelecimento, por conta e ordem do adquirente, sem que as mercadorias tenham transitado pelo estabelecimento do adquirente.'),
('6124', 'Industrialização efetuada para outra empresa', 'Classificam-se neste código as saídas de mercadorias industrializadas para terceiros, compreendendo os valores referentes aos serviços prestados e os das mercadorias de propriedade do industrializador empregadas no processo industrial.'),
('6125', 'Industrialização efetuada para outra empresa quando a mercadoria recebida para utilização no processo de industrialização não transitar pelo estabelecimento adquirente da mercadoria', 'Classificam-se neste código as saídas de mercadorias industrializadas para outras empresas, em que as mercadorias recebidas para utilização no processo de industrialização não tenham transitado pelo estabelecimento do adquirente das mercadorias, compreendendo os valores referentes aos serviços prestados e os das mercadorias de propriedade do industrializador empregadas no processo industrial.'),
('6150', 'TRANSFERÊNCIAS DE PRODUÇÃO PRÓPRIA OU DE TERCEIROS', NULL),
('6151', 'Transferência de produção do estabelecimento', 'Produtos industrializado ou produzido no estabelecimento e transferido para outro estabelecimento da mesma empresa.\r\n\r\n(NR Ajuste SINIEF 05/2005) (Dec.28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('6152', 'Transferência de mercadoria adquirida ou recebida de terceiros', 'Mercadoria adquirida ou recebida de terceiros para industrialização, comercialização ou utilização na prestação de serviço e que não tenha sido objeto de qualquer processo industrial no estabelecimento, transferida para outro estabelecimento da mesma empresa. A partir  10 de julho de 2003. (Decreto nº 26.020/2003)'),
('6153', 'Transferência de energia elétrica', 'Classificam-se neste código as transferências de energia elétrica para outro estabelecimento da mesma empresa, para distribuição.'),
('6155', 'Transferência de produção do estabelecimento, que não deva por ele transitar', 'Classificam-se neste código as transferências para outro estabelecimento da mesma empresa, de produtos industrializados no estabelecimento que tenham sido remetidos para armazém geral, depósito fechado ou outro, sem que haja retorno ao estabelecimento depositante.'),
('6156', 'Transferência de mercadoria adquirida ou recebida de terceiros, que não deva por ele transitar', 'Classificam-se neste código as transferências para outro estabelecimento da mesma empresa, de mercadorias adquiridas ou recebidas de terceiros para industrialização ou comercialização, que não tenham sido objeto de qualquer processo industrial, remetidas para armazém geral, depósito fechado ou outro, sem que haja retorno ao estabelecimento depositante.'),
('6200', 'DEVOLUÇÕES DE COMPRAS PARA INDUSTRIALIZAÇÃO, COMERCIALIZAÇÃO OU ANULAÇÕES DE VALORES', '(NR Ajuste SINIEF 05/2005) (Dec.28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('6201', 'Devolução de compra para industrialização ou produção rural (NR Ajuste SINIEF 05/2005) (Decreto 28.868/2006)', 'Devolução de mercadoria adquirida para ser utilizada em processo de industrialização ou produção rural, cuja entrada tenha sido classificada como \"1.101 - Compra para industrialização ou produção rural\".\r\n\r\n(NR Ajuste SINIEF 05/2005) (Dec.28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('6202', 'Devolução de compra para comercialização', 'Classificam-se neste código as devoluções de mercadorias adquiridas para serem comercializadas, cujas entradas tenham sido classificadas como Compra para comercialização.'),
('6205', 'Anulação de valor relativo a aquisição de serviço de comunicação', 'Classificam-se neste código as anulações correspondentes a valores faturados indevidamente, decorrentes das aquisições de serviços de comunicação.'),
('6206', 'Anulação de valor relativo a aquisição de serviço de transporte', 'Classificam-se neste código as anulações correspondentes a valores faturados indevidamente, decorrentes das aquisições de serviços de transporte.'),
('6207', 'Anulação de valor relativo à compra de energia elétrica', 'Classificam-se neste código as anulações correspondentes a valores faturados indevidamente, decorrentes da compra de energia elétrica.'),
('6208', 'Devolução de mercadoria recebida em transferência para industrialização ou produção rural', 'Devolução de mercadoria recebida em transferência de outro estabelecimento da mesma empresa, para ser utilizada em processo de industrialização ou produção rural.\r\n\r\n(NR Ajuste SINIEF 05/2005) (Dec.28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('6209', 'Devolução de mercadoria recebida em transferência para comercialização', 'Classificam-se neste código as devoluções de mercadorias recebidas em transferência de outro estabelecimento da mesma empresa, para serem comercializadas.'),
('6210', 'Devolução de compra para utilização na prestação de serviço', 'Classificam-se neste código as devoluções de mercadorias adquiridas para utilização na prestação de serviços, cujas entradas tenham sido classificadas no código 2.126 - Compra para utilização na prestação de serviço.'),
('6250', 'VENDAS DE ENERGIA ELÉTRICA', NULL),
('6251', 'Venda de energia elétrica para distribuição ou comercialização', 'Classificam-se neste código as vendas de energia elétrica destinada à distribuição ou comercialização. Também serão classificadas neste código as vendas de energia elétrica destinada a cooperativas para distribuição aos seus cooperados.'),
('6252', 'Venda de energia elétrica para estabelecimento industrial', 'Classificam-se neste código as vendas de energia elétrica para consumo por estabelecimento industrial. Também serão classificadas neste código as vendas de energia elétrica destinada a estabelecimento industrial de cooperativa.'),
('6253', 'Venda de energia elétrica para estabelecimento comercial', 'Classificam-se neste código as vendas de energia elétrica para consumo por estabelecimento comercial. Também serão classificadas neste código as vendas de energia elétrica destinada a estabelecimento comercial de cooperativa.'),
('6254', 'Venda de energia elétrica para estabelecimento prestador de serviço de transporte', 'Classificam-se neste código as vendas de energia elétrica para consumo por estabelecimento de prestador de serviços de transporte.'),
('6255', 'Venda de energia elétrica para estabelecimento prestador de serviço de comunicação', 'Classificam-se neste código as vendas de energia elétrica para consumo por estabelecimento de prestador de serviços de comunicação.'),
('6256', 'Venda de energia elétrica para estabelecimento de produtor rural', 'Classificam-se neste código as vendas de energia elétrica para consumo por estabelecimento de produtor rural.'),
('6257', 'Venda de energia elétrica para consumo por demanda contratada', 'Classificam-se neste código as vendas de energia elétrica para consumo por demanda contratada, que prevalecerá sobre os demais códigos deste subgrupo.'),
('6258', 'Venda de energia elétrica a não contribuinte', 'Classificam-se neste código as vendas de energia elétrica a pessoas físicas ou a pessoas jurídicas não indicadas nos códigos anteriores.'),
('6300', 'PRESTAÇÕES DE SERVIÇOS DE COMUNICAÇÃO', NULL),
('6301', 'Prestação de serviço de comunicação para execução de serviço da mesma natureza', 'Classificam-se neste código as prestações de serviços de comunicação destinados às prestações de serviços da mesma natureza.'),
('6302', 'Prestação de serviço de comunicação a estabelecimento industrial', 'Classificam-se neste código as prestações de serviços de comunicação a estabelecimento industrial. Também serão classificados neste código os serviços de comunicação prestados a estabelecimento industrial de cooperativa.'),
('6303', 'Prestação de serviço de comunicação a estabelecimento comercial', 'Classificam-se neste código as prestações de serviços de comunicação a estabelecimento comercial. Também serão classificados neste código os serviços de comunicação prestados a estabelecimento comercial de cooperativa.'),
('6304', 'Prestação de serviço de comunicação a estabelecimento de prestador de serviço de transporte', 'Classificam-se neste código as prestações de serviços de comunicação a estabelecimento prestador de serviço de transporte.');
INSERT INTO `tab_cfop` (`id`, `descricao`, `aplicacao`) VALUES
('6305', 'Prestação de serviço de comunicação a estabelecimento de geradora ou de distribuidora de energia elétrica', 'Classificam-se neste código as prestações de serviços de comunicação a estabelecimento de geradora ou de distribuidora de energia elétrica.'),
('6306', 'Prestação de serviço de comunicação a estabelecimento de produtor rural', 'Classificam-se neste código as prestações de serviços de comunicação a estabelecimento de produtor rural.'),
('6307', 'Prestação de serviço de comunicação a não contribuinte', 'Classificam-se neste código as prestações de serviços de comunicação a pessoas físicas ou a pessoas jurídicas não indicadas nos códigos anteriores.'),
('6350', 'PRESTAÇÕES DE SERVIÇOS DE TRANSPORTE', NULL),
('6351', 'Prestação de serviço de transporte para execução de serviço da mesma natureza', 'Classificam-se neste código as prestações de serviços de transporte destinados às prestações de serviços da mesma natureza.'),
('6352', 'Prestação de serviço de transporte a estabelecimento industrial', 'Classificam-se neste código as prestações de serviços de transporte a estabelecimento industrial. Também serão classificados neste código os serviços de transporte prestados a estabelecimento industrial de cooperativa.'),
('6353', 'Prestação de serviço de transporte a estabelecimento comercial', 'Classificam-se neste código as prestações de serviços de transporte a estabelecimento comercial. Também serão classificados neste código os serviços de transporte prestados a estabelecimento comercial de cooperativa.'),
('6354', 'Prestação de serviço de transporte a estabelecimento de prestador de serviço de comunicação', 'Classificam-se neste código as prestações de serviços de transporte a estabelecimento prestador de serviços de comunicação.'),
('6355', 'Prestação de serviço de transporte a estabelecimento de geradora ou de distribuidora de energia elétrica', 'Classificam-se neste código as prestações de serviços de transporte a estabelecimento de geradora ou de distribuidora de energia elétrica.'),
('6356', 'Prestação de serviço de transporte a estabelecimento de produtor rural', 'Classificam-se neste código as prestações de serviços de transporte a estabelecimento de produtor rural.'),
('6357', 'Prestação de serviço de transporte a não contribuinte', 'Classificam-se neste código as prestações de serviços de transporte a pessoas físicas ou a pessoas jurídicas não indicadas nos códigos anteriores.'),
('6359', 'Prestação de serviço de transporte a contribuinte ou a não-contribuinte, quando a mercadoria transportada esteja dispensada de emissão de Nota Fiscal ', 'Prestação de serviço de transporte a contribuinte ou a não-contribuinte, quando não existir a obrigação legal de emissão de Nota Fiscal para a mercadoria transportada. (ACR Ajuste SINIEF 03/2004) (DECRETO Nº 26.810/2004) (a partir de 01.01.2005)'),
('6360', 'Prestação de serviço de transporte a contribuinte substituto em relação ao serviço de transporte  ', 'Prestação de serviço de transporte a contribuinte a quem tenha sido atribuída a condição de contribuinte-substituto em relação ao imposto incidente na prestação dos serviços. (Ajuste SINIEF 03/2008) (Decreto nº 32.653, de 14.11.2008) a partir de 01.05.2008'),
('6400', 'SAÍDAS DE MERCADORIAS SUJEITAS AO REGIME DE SUBSTITUIÇÃO TRIBUTÁRIA', NULL),
('6401', 'Venda de produção do estabelecimento quando o produto estiver sujeito ao regime de substituição tributária', 'Venda de produto industrializado ou produzido no estabelecimento, quando o produto estiver sujeito ao regime de substituição tributária, bem como a venda de produto industrializado por estabelecimento industrial ou rural de cooperativa, quando o produto estiver sujeito ao referido regime.\r\n\r\n(NR Ajuste SINIEF 05/2005) (Dec.28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('6402', 'Venda de produção do estabelecimento de produto sujeito ao regime de substituição tributária, em operação entre contribuintes substitutos do mesmo produto', 'Classificam-se neste código as vendas de produtos sujeitos ao regime de substituição tributária industrializados no estabelecimento, em operações entre contribuintes substitutos do mesmo produto.'),
('6403', 'Venda de mercadoria adquirida ou recebida de terceiros em operação com mercadoria sujeita ao regime de substituição tributária, na condição de contribuinte substituto', 'Classificam-se neste código as vendas de mercadorias adquiridas ou recebidas de terceiros, na condição de contribuinte substituto, em operação com mercadorias sujeitas ao regime de substituição tributária.'),
('6404', 'Venda de mercadoria sujeita ao regime de substituição tributária, cujo imposto já tenha sido retido anteriormente', 'Classificam-se neste código as vendas de mercadorias sujeitas ao regime de substituição tributária, na condição de substituto tributário, exclusivamente nas hipóteses em que o imposto já tenha sido retido anteriormente.'),
('6408', 'Transferência de produção do estabelecimento quando o produto estiver sujeito ao regime de substituição tributária', 'Transferência de produto industrializado ou produzido no estabelecimento, para outro estabelecimento da mesma empresa, quando o produto estiver sujeito ao regime de substituição tributária.\r\n\r\n(NR Ajuste SINIEF 05/2005) (Dec.28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('6409', 'Transferência de mercadoria adquirida ou recebida de terceiros, sujeita ao regime de substituição tributária', 'Classificam-se neste código as transferências para outro estabelecimento da mesma empresa, de mercadorias adquiridas ou recebidas de terceiros que não tenham sido objeto de qualquer processo industrial no estabelecimento, em operações com mercadorias sujeitas ao regime de substituição tributária.'),
('6410', 'Devolução de compra para industrialização ou ptrodução rural quando a mercadoria sujeita ao regime de substituição tributária', 'Devolução de mercadoria adquirida para ser utilizada em processo de industrialização ou produção rural, cuja entrada tenha sido classificada como \"Compra para industrialização ou produção rural de mercadoria sujeita ao regime de substituição tributária\".\r\n\r\n(NR Ajuste SINIEF 05/2005) (Dec.28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('6411', 'Devolução de compra para comercialização em operação com mercadoria sujeita ao regime de substituição tributária', 'Classificam-se neste código as devoluções de mercadorias adquiridas para serem comercializadas, cujas entradas tenham sido classificadas como Compra para comercialização em operação com mercadoria sujeita ao regime de substituição tributária.'),
('6412', 'Devolução de bem do ativo imobilizado, em operação com mercadoria sujeita ao regime de substituição tributária', 'Classificam-se neste código as devoluções de bens adquiridos para integrar o ativo imobilizado do estabelecimento, cuja entrada tenha sido classificada no código 2.406 - Compra de bem para o ativo imobilizado cuja mercadoria está sujeita ao regime de substituição tributária.'),
('6413', 'Devolução de mercadoria destinada ao uso ou consumo, em operação com mercadoria sujeita ao regime de substituição tributária', 'Classificam-se neste código as devoluções de mercadorias adquiridas para uso ou consumo do estabelecimento, cuja entrada tenha sido classificada no código 2.407 - Compra de mercadoria para uso ou consumo cuja mercadoria está sujeita ao regime de substituição tributária.'),
('6414', 'Remessa de produção do estabelecimento para venda fora do estabelecimento, quando o produto estiver sujeito ao regime de substituição tributária', 'Remessa de produto industrializado ou produzido pelo estabelecimento para ser vendido fora do estabelecimento, inclusive por meio de veículo, quando o mencionado produto estiver sujeito ao regime de substituição tributária.\r\n\r\n(NR Ajuste SINIEF 05/2005) (Dec.28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('6415', 'Remessa de mercadoria adquirida ou recebida de terceiros para venda fora do estabelecimento, quando a referida ração com mercadoria sujeita ao regime de substituição tributária', 'Remessa de mercadoria adquirida ou recebida de terceiro para serem vendida fora do estabelecimento, inclusive por meio de veículo, quando a referida mercadorias estiver sujeita ao regime de substituição tributária.'),
('6500', 'REMESSAS COM FIM ESPECÍFICO DE EXPORTAÇÃO E EVENTUAIS DEVOLUÇÕES', '(NR Ajuste SINIEF 05/2005) (Dec. 28.868/2006 - a sua aplicação será obrigatória em relação aos fatos geradores ocorridos a partir de 01 de julho de 2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de janeiro a 30 de junho de 2006)'),
('6501', 'Remessa de produção do estabelecimento, com fim específico de exportação', 'Saída de produto industrializado ou produzido pelo estabelecimento, remetido com fim específico de exportação a \"trading company\", empresa comercial exportadora ou outro estabelecimento do remetente.\r\n\r\n(NR Ajuste SINIEF 05/2005) (Dec. 28.868/2006 - a sua aplicação será obrigatória em relação aos fatos geradores ocorridos a partir de 01 de julho de 2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de janeiro a 30 de junho de 2006)'),
('6502', 'Remessa de mercadoria adquirida ou recebida de terceiros, com fim específico de exportação', 'Classificam-se neste código as saídas de mercadorias adquiridas ou recebidas de terceiros, remetidas com fim específico de exportação a trading company, empresa comercial exportadora ou outro estabelecimento do remetente.'),
('6503', 'Devolução de mercadoria recebida com fim específico de exportação', 'Classificam-se neste código as devoluções efetuadas por trading company, empresa comercial exportadora ou outro estabelecimento do destinatário, de mercadorias recebidas com fim específico de exportação, cujas entradas tenham sido classificadas no código 2.501 - Entrada de mercadoria recebida com fim específico de exportação.'),
('6504', 'Remessa de mercadoria para formação de lote de exportação, de produto industrializado ou produzido pelo próprio estabelecimento.', 'Remessa de mercadoria para formação de lote de exportação, de produto industrializado ou produzido pelo próprio estabelecimento.\r\n\r\n(ACR Ajuste SINIEF 09/2005) (Dec. 28.868/2006 - a sua aplicação será obrigatória em relação aos fatos geradores ocorridos a partir de 01 de julho de 2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de janeiro a 30 de junho de 2006)'),
('6505', 'Remessa de mercadoria, adquirida ou recebida de terceiros, para formação de lote de exportação.', 'Remessa de mercadoria, adquirida ou recebida de terceiros, para formação de lote de exportação.\r\n\r\n(ACR Ajuste SINIEF 09/2005) (Dec. 28.868/2006 - a sua aplicação será obrigatória em relação aos fatos geradores ocorridos a partir de 01 de julho de 2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de janeiro a 30 de junho de 2006)'),
('6550', 'OPERAÇÕES COM BENS DE ATIVO IMOBILIZADO E MATERIAIS PARA USO OU CONSUMO', NULL),
('6551', 'Venda de bem do ativo imobilizado', 'Vendas de bem integrante do ativo imobilizado do estabelecimento. –a  partir 01.01.2004-  Decreto Nº 26.174 de 26/11/2003'),
('6552', 'Transferência de bem do ativo imobilizado', 'Transferência de bem do ativo imobilizado para outro estabelecimento da mesma empresa. –a  partir 01.01.2004-  Decreto Nº 26.174 de 26/11/2003'),
('6553', 'Devolução de compra de bem para o ativo imobilizado', 'Devolução de bem adquirido para integrar o ativo imobilizado do estabelecimento, cuja entrada foi classificada no código 2.551 - Compra de bem para o ativo imobilizado. –a  partir 01.01.2004-  Decreto Nº 26.174 de 26/11/2003'),
('6554', 'Remessa de bem do ativo imobilizado para uso fora do estabelecimento', 'Remessa de bem do ativo imobilizado para uso fora do estabelecimento. –a  partir 01.01.2004-  Decreto Nº 26.174 de 26/11/2003'),
('6555', 'Devolução de bem do ativo imobilizado de terceiro, recebido para uso no estabelecimento', 'Saída em devolução, de bem do ativo imobilizado de terceiros, recebidos para uso no estabelecimento, cuja entrada tenha sido classificada no código 2.555 - Entrada de bem do ativo imobilizado de terceiro, remetido para uso no estabelecimento. –a  partir 01.01.2004-  Decreto Nº 26.174 de 26/11/2003'),
('6556', 'Devolução de compra de material de uso ou consumo', 'Devolução de mercadoria destinada ao uso ou consumo do estabelecimento, cuja entrada tenha sido classificada no código 2.556 - compra de material para uso ou consumo –a partir 01.01.2004-  Decreto Nº 26.174 de 26/11/2003'),
('6557', 'Transferência de material de uso ou consumo', 'Transferência de material de uso ou consumo para outro estabelecimento da mesma empresa. –a  partir 01.01.2004-  Decreto Nº 26.174 de 26/11/2003'),
('6600', 'CRÉDITOS E RESSARCIMENTOS DE ICMS', NULL),
('6603', 'Ressarcimento de ICMS retido por substituição tributária', 'Classificam-se neste código os lançamentos destinados ao registro de ressarcimento de ICMS retido por substituição tributária a contribuinte substituído, efetuado pelo contribuinte substituto, nas hipóteses previstas na legislação aplicável.'),
('6650', 'SAÍDAS DE COMBUSTÍVEIS, DERIVADOS OU NÃO DE PETRÓLEO, E LUBRIFICANTE', '(ACR Ajuste SINIEF 9/2003 - a partir 01.01.2004) –  Decreto Nº 26.174 de 26/11/2003'),
('6651', 'Venda de combustível ou lubrificante, de produção do estabelecimento, destinados à industrialização subseqüente', 'Venda de combustível ou lubrificante, industrializados no estabelecimento e destinados à industrialização do próprio produto, inclusive aquela decorrente de encomenda para entrega futura, cujo faturamento tenha sido classificado no código 6.922 – \"Lançamento efetuado a título de simples faturamento decorrente de venda para entrega futura\".(a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('6652', 'Venda de combustível ou lubrificante, de produção do estabelecimento, destinados à comercialização', 'Venda de combustível ou lubrificante, industrializados no estabelecimento e destinados à comercialização, inclusive aquela decorrente de encomenda para entrega futura, cujo faturamento tenha sido classificado no código 6.922 – \"Lançamento efetuado a título de simples faturamento decorrente de venda para entrega futura\".(a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('6653', 'Venda de combustível ou lubrificante, de produção do estabelecimento, destinados a consumidor ou usuário final', 'Venda de combustível ou lubrificante, industrializados no estabelecimento e destinados a consumo em processo de industrialização de outro produto, à prestação de serviço ou a usuário final, inclusive aquela decorrente de encomenda para entrega futura, cujo faturamento tenha sido classificado no código 6.922 – \"Lançamento efetuado a título de simples faturamento decorrente de venda para entrega futura\".(a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('6654', 'Venda de combustível ou lubrificante, adquiridos ou recebidos de terceiros, destinados à industrialização subseqüente', 'Venda de combustível ou lubrificante, adquiridos ou recebidos de terceiros, destinados à industrialização do próprio produto, inclusive aquela decorrente de encomenda para entrega futura, cujo faturamento tenha sido classificado no código 5.922 – \"Lançamento efetuado a título de simples faturamento decorrente de venda para entrega futura\".(a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('6655', 'Venda de combustível ou lubrificante, adquiridos ou recebidos de terceiros, destinados à comercialização', 'Venda de combustível ou lubrificante, adquiridos ou recebidos de terceiros, destinados à comercialização, inclusive aquela decorrente de encomenda para entrega futura, cujo faturamento tenha sido classificado no código 5.922 – \"Lançamento efetuado a título de simples faturamento decorrente de venda para entrega futura\".(a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('6656', 'Venda de combustível ou lubrificante, adquiridos ou recebidos de terceiros, destinados a consumidor ou usuário final', 'Venda de combustível ou lubrificante, adquiridos ou recebidos de terceiros, destinados a consumo em processo de industrialização de outro produto, à prestação de serviço ou a usuário final, inclusive aquela decorrente de encomenda para entrega futura, cujo faturamento tenha sido classificado no código 5.922 – \"Lançamento efetuado a título de simples faturamento decorrente de venda para entrega futura\".(a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('6657', 'Remessa de combustível ou lubrificante, adquiridos ou recebidos de terceiros, para venda fora do estabelecimento', 'Remessa de combustível ou lubrificante, adquiridos ou recebidos de terceiros, para ser vendidos fora do estabelecimento, inclusive por meio de veículos. (a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('6658', 'Transferência de combustível ou lubrificante de produção do estabelecimento', 'Transferência de combustível ou lubrificante, industrializados no estabelecimento, para outro estabelecimento da mesma empresa. (a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('6659', 'Transferência de combustível ou lubrificante adquiridos ou recebidos de terceiros', 'Transferência de combustível ou lubrificante, adquiridos ou recebidos de terceiros, para outro estabelecimento da mesma empresa. (a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('6660', 'Devolução de compra de combustível ou lubrificante adquiridos para industrialização subseqüente', 'Devolução de compra de combustível ou lubrificante, adquiridos para industrialização do próprio produto, cuja entrada tenha sido classificada como \"Compra de combustível ou lubrificante para industrialização subseqüente\".(a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('6661', 'Devolução de compra de combustível ou lubrificante adquiridos para comercialização', 'Devolução de compra de combustível ou lubrificante, adquiridos para comercialização, cuja entrada tenha sido classificada como \"Compra de combustível ou lubrificante para comercialização\".(a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('6662', 'Devolução de compra de combustível ou lubrificante adquiridos por consumidor ou usuário final', 'Devolução de compra de combustível ou lubrificante, adquiridos para consumo em processo de industrialização de outro produto, na prestação de serviço ou por usuário final, cuja entrada tenha sido classificada como \"Compra de combustível ou lubrificante por consumidor ou usuário final\".(a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('6663', 'Remessa para armazenagem de combustível ou lubrificante', 'Remessa para armazenagem de combustível ou lubrificante. (a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('6664', 'Retorno de combustível ou lubrificante recebidos para armazenagem', 'Remessa, em devolução, de combustível ou lubrificante, recebidos para armazenagem. (a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('6665', 'Retorno simbólico de combustível ou lubrificante recebidos para armazenagem', 'Retorno simbólico de combustível ou lubrificante, recebidos para armazenagem, quando a mercadoria armazenada tenha sido objeto de saída, a qualquer título, e não deva retornar ao estabelecimento depositante. (a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('6666', 'Remessa, por conta e ordem de terceiros, de combustível ou lubrificante recebidos para armazenagem', 'Saída, por conta e ordem de terceiros, de combustível ou lubrificante, recebidos anteriormente para armazenagem. (a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('6667', 'Venda de combustível ou lubrificante a consumidor ou usuário final estabelecido em outra Unidade da Federação diferente da que ocorrer o consumo', 'Venda de combustível ou lubrificante a consumidor ou a usuário final, cujo abastecimento tenha sido efetuado em Unidade da Federação diferente do remetente e do destinatário. ACR Ajuste SINIEF 05/2009 – a partir de 01.07.2009)(Decreto nº 34.490/2009)'),
('6900', 'OUTRAS SAÍDAS DE MERCADORIAS OU PRESTAÇÕES DE SERVIÇOS', NULL),
('6901', 'Remessa para industrialização por encomenda', 'Classificam-se neste código as remessas de insumos remetidos para industrialização por encomenda, a ser realizada em outra empresa ou em outro estabelecimento da mesma empresa.'),
('6902', 'Retorno de mercadoria utilizada na industrialização por encomenda', 'Classificam-se neste código as remessas, pelo estabelecimento industrializador, dos insumos recebidos para industrialização e incorporados ao produto final, por encomenda de outra empresa ou de outro estabelecimento da mesma empresa. O valor dos insumos nesta operação deverá ser igual ao valor dos insumos recebidos para industrialização.'),
('6903', 'Retorno de mercadoria recebida para industrialização e não aplicada no referido processo', 'Classificam-se neste código as remessas em devolução de insumos recebidos para industrialização e não aplicados no referido processo.'),
('6904', 'Remessa para venda fora do estabelecimento', 'Classificam-se neste código as remessas de mercadorias para venda fora do estabelecimento, inclusive por meio de veículos.'),
('6905', 'Remessa para depósito fechado ou armazém geral', 'Classificam-se neste código as remessas de mercadorias para depósito em depósito fechado ou armazém geral.'),
('6906', 'Retorno de mercadoria depositada em depósito fechado ou armazém geral', 'Classificam-se neste código os retornos de mercadorias depositadas em depósito fechado ou armazém geral ao estabelecimento depositante.'),
('6907', 'Retorno simbólico de mercadoria depositada em depósito fechado ou armazém geral', 'Classificam-se neste código os retornos simbólicos de mercadorias recebidas para depósito em depósito fechado ou armazém geral, quando as mercadorias depositadas tenham sido objeto de saída a qualquer título e que não devam retornar ao estabelecimento depositante.'),
('6908', 'Remessa de bem por conta de contrato de comodato', 'Classificam-se neste código as remessas de bens para o cumprimento de contrato de comodato.'),
('6909', 'Retorno de bem recebido por conta de contrato de comodato', 'Classificam-se neste código as remessas de bens em devolução após cumprido o contrato de comodato.'),
('6910', 'Remessa em bonificação, doação ou brinde', 'Classificam-se neste código as remessas de mercadorias a título de bonificação, doação ou brinde.'),
('6911', 'Remessa de amostra grátis', 'Classificam-se neste código as remessas de mercadorias a título de amostra grátis.'),
('6912', 'Remessa de mercadoria ou bem para demonstração', 'Classificam-se neste código as remessas de mercadorias ou bens para demonstração.'),
('6913', 'Retorno de mercadoria ou bem recebido para demonstração', 'Classificam-se neste código as remessas em devolução de mercadorias ou bens recebidos para demonstração.'),
('6914', 'Remessa de mercadoria ou bem para exposição ou feira', 'Classificam-se neste código as remessas de mercadorias ou bens para exposição ou feira.'),
('6915', 'Remessa de mercadoria ou bem para conserto ou reparo', 'Classificam-se neste código as remessas de mercadorias ou bens para conserto ou reparo.'),
('6916', 'Retorno de mercadoria ou bem recebido para conserto ou reparo', 'Classificam-se neste código as remessas em devolução de mercadorias ou bens recebidos para conserto ou reparo.'),
('6917', 'Remessa de mercadoria em consignação mercantil ou industrial', 'Classificam-se neste código as remessas de mercadorias a título de consignação mercantil ou industrial.'),
('6918', 'Devolução de mercadoria recebida em consignação mercantil ou industrial', 'Classificam-se neste código as devoluções de mercadorias recebidas anteriormente a título de consignação mercantil ou industrial.'),
('6919', 'Devolução simbólica de mercadoria vendida ou utilizada em processo industrial, recebida anteriormente em consignação mercantil ou industrial', 'Classificam-se neste código as devoluções simbólicas de mercadorias vendidas ou utilizadas em processo industrial, que tenham sido recebidas anteriormente a título de consignação mercantil ou industrial.'),
('6920', 'Remessa de vasilhame ou sacaria', 'Classificam-se neste código as remessas de vasilhame ou sacaria.'),
('6921', 'Devolução de vasilhame ou sacaria', 'Classificam-se neste código as saídas por devolução de vasilhame ou sacaria.'),
('6922', 'Lançamento efetuado a título de simples faturamento decorrente de venda para entrega futura', 'Classificam-se neste código os registros efetuados a título de simples faturamento decorrente de venda para entrega futura.'),
('6923', 'Remessa de mercadoria por conta e ordem de terceiros, em venda à ordem', 'Classificam-se neste código as saídas correspondentes à entrega de mercadorias por conta e ordem de terceiros, em vendas à ordem, cuja venda ao adquirente originário, foi classificada nos códigos 6.118 - Venda de produção do estabelecimento entregue ao destinatário por conta e ordem do adquirente originário, em venda à ordem ou 6.119 - Venda de mercadoria adquirida ou recebida de terceiros entregue ao destinatário por conta e ordem do adquirente originário, em venda à ordem.'),
('6924', 'Remessa para industrialização por conta e ordem do adquirente da mercadoria, quando esta não transitar pelo estabelecimento do adquirente', 'Classificam-se neste código as saídas de insumos com destino a estabelecimento industrializador, para serem industrializados por conta e ordem do adquirente, nas hipóteses em que os insumos não tenham transitado pelo estabelecimento do adquirente dos mesmos.'),
('6925', 'Retorno de mercadoria recebida para industrialização por conta e ordem do adquirente da mercadoria, quando aquela não transitar pelo estabelecimento do adquirente', 'Classificam-se neste código as remessas, pelo estabelecimento industrializador, dos insumos recebidos, por conta e ordem do adquirente, para industrialização e incorporados ao produto final, nas hipóteses em que os insumos não tenham transitado pelo estabelecimento do adquirente. O valor dos insumos nesta operação deverá ser igual ao valor dos insumos recebidos para industrialização.'),
('6929', 'Lançamento efetuado em decorrência de emissão de documento fiscal relativo a operação ou prestação também registrada em equipamento Emissor de Cupom Fiscal - ECF', 'Classificam-se neste código os registros relativos aos documentos fiscais emitidos em operações ou prestações que também tenham sido registradas em equipamento Emissor de Cupom Fiscal - ECF.'),
('6931', 'Lançamento efetuado em decorrência da responsabilidade de retenção do imposto por substituição tributária, atribuída ao remetente ou alienante da mercadoria, pelo serviço de transporte realizado por t', 'Classificam-se neste código exclusivamente os lançamentos efetuados pelo remetente ou alienante da mercadoria quando lhe for atribuída a responsabilidade pelo recolhimento do imposto devido pelo serviço de transporte realizado por transportador autônomo ou por transportador não inscrito na unidade da Federação onde iniciado o serviço.'),
('6932', 'Prestação de serviço de transporte iniciada em unidade da Federação diversa daquela onde inscrito o prestador', 'Classificam-se neste código as prestações de serviço de transporte que tenham sido iniciadas em unidade da Federação diversa daquela onde o prestador está inscrito como contribuinte.'),
('6933', 'Prestação de serviço tributado pelo Imposto Sobre Serviços de Qualquer Natureza', 'Prestação de serviço, cujo imposto   é de competência municipal, desde que informado em nota fiscal modelo 1 ou 1-A. (ACR Ajuste SINIEF 03/2004 e Ajuste SINIEF 06/2005) (DECRETO Nº 26.868/2006)'),
('6949', 'Outra saída de mercadoria ou prestação de serviço não especificado', 'Classificam-se neste código as outras saídas de mercadorias ou prestações de serviços que não tenham sido especificados nos códigos anteriores.'),
('7000', 'SAÍDAS OU PRESTAÇÕES DE SERVIÇOS PARA O EXTERIOR', 'Classificam-se, neste grupo, as operações ou prestações em que o destinatário esteja localizado em outro país'),
('7100', 'VENDAS DE PRODUÇÃO PRÓPRIA OU DE TERCEIROS', NULL),
('7101', 'Venda de produção do estabelecimento', 'Venda de produto industrializado ou produzido pelo estabelecimento, bem como a de mercadoria por estabelecimento industrial ou produtor rural de cooperativa destinada a seus cooperados ou a estabelecimento de outra cooperativa.\r\n\r\n(NR Ajuste SINIEF 05/2005) (Dec.28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('7102', 'Venda de mercadoria adquirida ou recebida de terceiros', 'Classificam-se neste código as vendas de mercadorias adquiridas ou recebidas de terceiros para industrialização ou comercialização, que não tenham sido objeto de qualquer processo industrial no estabelecimento. Também serão classificadas neste código as vendas de mercadorias por estabelecimento comercial de cooperativa.'),
('7105', 'Venda de produção do estabelecimento, que não deva por ele transitar', 'Classificam-se neste código as vendas de produtos industrializados no estabelecimento, armazenados em depósito fechado, armazém geral ou outro sem que haja retorno ao estabelecimento depositante.'),
('7106', 'Venda de mercadoria adquirida ou recebida de terceiros, que não deva por ele transitar', 'Classificam-se neste código as vendas de mercadorias adquiridas ou recebidas de terceiros para industrialização ou comercialização, armazenadas em depósito fechado, armazém geral ou outro, que não tenham sido objeto de qualquer processo industrial no estabelecimento sem que haja retorno ao estabelecimento depositante. Também serão classificadas neste código as vendas de mercadorias importadas, cuja saída ocorra do recinto alfandegado ou da repartição alfandegária onde se processou o desembaraço aduaneiro, com destino ao esta'),
('7127', 'Venda de produção do estabelecimento sob o regime de drawback', 'Classificam-se neste código as vendas de produtos industrializados no estabelecimento sob o regime de drawback , cujas compras foram classificadas no código 3.127 - Compra para industrialização sob o regime de drawback.'),
('7200', 'DEVOLUÇÕES DE COMPRAS PARA INDUSTRIALIZAÇÃO, COMERCIALIZAÇÃO OU ANULAÇÕES DE VALORES', '(NR Ajuste SINIEF 05/2005) (Dec.28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('7201', 'Devolução de compra para industrialização ou produção rural (NR Ajuste SINIEF 05/2005) (Decreto 28.868/2006)', 'Devolução de mercadoria adquirida para ser utilizada em processo de industrialização ou produção rural, cuja entrada tenha sido classificada como \"1.101 - Compra para industrialização ou produção rural\".\r\n\r\n(NR Ajuste SINIEF 05/2005) (Dec.28.868/2006 - Efeitos a partir de 01/01/2006, ficando facultada ao contribuinte a sua adoção para fatos geradores ocorridos no período de 01 de novembro a 31 de dezembro de 2005)'),
('7202', 'Devolução de compra para comercialização', 'Classificam-se neste código as devoluções de mercadorias adquiridas para serem comercializadas, cujas entradas tenham sido classificadas como Compra para comercialização.'),
('7205', 'Anulação de valor relativo à aquisição de serviço de comunicação', 'Classificam-se neste código as anulações correspondentes a valores faturados indevidamente, decorrentes das aquisições de serviços de comunicação.'),
('7206', 'Anulação de valor relativo a aquisição de serviço de transporte', 'Classificam-se neste código as anulações correspondentes a valores faturados indevidamente, decorrentes das aquisições de serviços de transporte.'),
('7207', 'Anulação de valor relativo à compra de energia elétrica', 'Classificam-se neste código as anulações correspondentes a valores faturados indevidamente, decorrentes da compra de energia elétrica.'),
('7210', 'Devolução de compra para utilização na prestação de serviço', 'Classificam-se neste código as devoluções de mercadorias adquiridas para utilização na prestação de serviços, cujas entradas tenham sido classificadas no código 3.126 - Compra para utilização na prestação de serviço.'),
('7211', 'Devolução de compras para industrialização sob o regime de drawback', 'Classificam-se neste código as devoluções de mercadorias adquiridas para serem utilizadas em processo de industrialização sob o regime de drawback e não utilizadas no referido processo, cujas entradas tenham sido classificadas no código 3.127 - Compra para industrialização sob o regime de drawback.'),
('7250', 'VENDAS DE ENERGIA ELÉTRICA', NULL),
('7251', 'Venda de energia elétrica para o exterior', 'Classificam-se neste código as vendas de energia elétrica para o exterior.'),
('7300', 'PRESTAÇÕES DE SERVIÇOS DE COMUNICAÇÃO', NULL),
('7301', 'Prestação de serviço de comunicação para execução de serviço da mesma natureza', 'Classificam-se neste código as prestações de serviços de comunicação destinados às prestações de serviços da mesma natureza.'),
('7358', 'Prestação de serviço de transporte', 'Classificam-se neste código as prestações de serviços de transporte destinado a estabelecimento no exterior.'),
('7500', 'EXPORTAÇÃO DE MERCADORIAS RECEBIDAS COM FIM ESPECÍFICO DE EXPORTAÇÃO', NULL),
('7501', 'Exportação de mercadorias recebidas com fim específico de exportação', 'Classificam-se neste código as exportações das mercadorias recebidas anteriormente com finalidade específica de exportação, cujas entradas tenham sido classificadas nos códigos 1.501 - Entrada de mercadoria recebida com fim específico de exportação ou 2.501 - Entrada de mercadoria recebida com fim específico de exportação.'),
('7550', 'OPERAÇÕES COM BENS DE ATIVO IMOBILIZADO E MATERIAIS PARA USO OU CONSUMO', NULL),
('7551', 'Venda de bem do ativo imobilizado', 'Classificam-se neste código as vendas de bens integrantes do ativo imobilizado do estabelecimento.'),
('7553', 'Devolução de compra de bem para o ativo imobilizado', 'Classificam-se neste código as devoluções de bens adquiridos para integrar o ativo imobilizado do estabelecimento, cuja entrada foi classificada no código 3.551 - Compra de bem para o ativo imobilizado.'),
('7556', 'Devolução de compra de material de uso ou consumo', 'Classificam-se neste código as devoluções de mercadorias destinadas ao uso ou consumo do estabelecimento, cuja entrada tenha sido classificada no código 3.556 - Compra de material para uso ou consumo.'),
('7650', 'SAÍDAS DE COMBUSTÍVEIS, DERIVADOS OU NÃO DE PETRÓLEO, E LUBRIFICANTES', '(a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('7651', 'Venda de combustível ou lubrificante de produção do estabelecimento', 'Venda de combustível ou lubrificante industrializados no estabelecimento e destinados ao exterior. (a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('7654', 'Venda de combustível ou lubrificante adquiridos ou recebidos de terceiros', 'Venda de combustível ou lubrificante, adquiridos ou recebidos de terceiros, destinados ao exterior. (a partir 01.01.2004 -  Decreto Nº 26.174 de 26/11/2003)'),
('7667', 'Venda de combustível ou lubrificante a consumidor ou usuário final', 'Venda de combustível ou lubrificante a consumidor ou a usuário final, cuja operação tenha sido equiparada a uma exportação. ACR Ajuste SINIEF 05/2009 – a partir de 01.07.2009)(Decreto nº 34.490/2009)'),
('7900', 'OUTRAS SAIDAS DE MERCADORIA OU PRESTAÇÕES DE SERVIÇOS', NULL),
('7930', 'Lançamento efetuado a título de devolução de bem cuja entrada tenha ocorrido sob amparo de regime especial aduaneiro de admissão temporária', 'Classificam-se neste código os lançamentos efetuados a título de saída em devolução de bens cuja entrada tenha ocorrido sob amparo de regime especial aduaneiro de admissão temporária.'),
('7949', 'Outra saída de mercadoria ou prestação de serviço não especificado', 'Classificam-se neste código as outras saídas de mercadorias ou prestações de serviços que não tenham sido especificados nos códigos anteriores.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_cliente`
--

CREATE TABLE `tab_cliente` (
  `id_cliente` int(11) NOT NULL,
  `cpf_cnpj_cliente` varchar(20) DEFAULT NULL,
  `estrangeiro_cliente` varchar(20) NOT NULL,
  `nome_razao_social_cliente` varchar(60) DEFAULT NULL,
  `logradouro_cliente` varchar(60) DEFAULT NULL,
  `numero_cliente` varchar(60) DEFAULT NULL,
  `complemento_cliente` varchar(60) DEFAULT NULL,
  `bairro_cliente` varchar(60) DEFAULT NULL,
  `cod_municipio_cliente` varchar(7) DEFAULT NULL,
  `municipio_cliente` varchar(60) DEFAULT NULL,
  `uf_cliente` varchar(2) DEFAULT NULL,
  `cep_cliente` varchar(100) DEFAULT NULL,
  `cod_pais_cliente` varchar(4) NOT NULL,
  `pais_cliente` varchar(6) DEFAULT NULL,
  `telefone_cliente` varchar(20) DEFAULT NULL,
  `inscricao_estadual_cliente` varchar(14) DEFAULT NULL,
  `inscricao_suframa_cliente` varchar(9) DEFAULT NULL,
  `email_cliente` varchar(60) DEFAULT NULL,
  `status_cliente` varchar(50) NOT NULL,
  `data_cadastro_cliente` datetime NOT NULL,
  `isento_icms_cliente` varchar(10) DEFAULT NULL,
  `banco_cliente` varchar(100) NOT NULL,
  `agencia_cliente` varchar(100) NOT NULL,
  `conta_cliente` varchar(100) NOT NULL,
  `nome_contato_cliente` varchar(200) NOT NULL,
  `telefone_contato_cliente` varchar(20) NOT NULL,
  `email_contato_cliente` varchar(200) NOT NULL,
  `celular_cliente` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tab_cliente`
--

INSERT INTO `tab_cliente` (`id_cliente`, `cpf_cnpj_cliente`, `estrangeiro_cliente`, `nome_razao_social_cliente`, `logradouro_cliente`, `numero_cliente`, `complemento_cliente`, `bairro_cliente`, `cod_municipio_cliente`, `municipio_cliente`, `uf_cliente`, `cep_cliente`, `cod_pais_cliente`, `pais_cliente`, `telefone_cliente`, `inscricao_estadual_cliente`, `inscricao_suframa_cliente`, `email_cliente`, `status_cliente`, `data_cadastro_cliente`, `isento_icms_cliente`, `banco_cliente`, `agencia_cliente`, `conta_cliente`, `nome_contato_cliente`, `telefone_contato_cliente`, `email_contato_cliente`, `celular_cliente`) VALUES
(1, '218.876.959-74', '', 'FULANO 1', 'RUA TAL', '000', '', 'PAVUNA', '3305109', 'SÃ£o JoÃ£o de Meriti', '33', '21520000', '', 'Brasil', '2199999999', '', '', '', '', '2017-01-18 08:51:55', 'nao', '', '', '', '', '', '', ''),
(2, '47.685.252/000', '', 'FULANO 2', '', '', '', '', '', '', '', '', '', 'Brasil', '2155558888', '', '', '', 'ativo', '2017-07-28 09:08:23', 'nao', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_emitente`
--

CREATE TABLE `tab_emitente` (
  `id_emitente` int(11) NOT NULL,
  `ambiente_nfe_emitente` tinyint(1) NOT NULL,
  `n_nota_emitente` int(11) NOT NULL,
  `n_nfce_emitente` int(11) NOT NULL,
  `padrao_emis_emitente` int(2) NOT NULL,
  `nome_razao_social_emitente` varchar(60) DEFAULT NULL,
  `nome_fantasia_emitente` varchar(60) DEFAULT NULL,
  `logo_emitente` varchar(200) NOT NULL,
  `cnpj_emitente` varchar(14) DEFAULT NULL,
  `inscricao_estadual_emitente` varchar(14) DEFAULT NULL,
  `cnae_fiscal_emitente` varchar(7) DEFAULT NULL,
  `inscricao_municipal_emitente` varchar(15) DEFAULT NULL,
  `inscricao_estadual_trib_emitente` varchar(100) DEFAULT NULL,
  `regime_tributario_emitente` varchar(1) DEFAULT NULL,
  `logradouro_emitente` varchar(60) DEFAULT NULL,
  `numero_emitente` varchar(60) DEFAULT NULL,
  `complemento_emitente` varchar(60) DEFAULT NULL,
  `bairro_emitente` varchar(60) DEFAULT NULL,
  `cep_emitente` varchar(8) DEFAULT NULL,
  `pais_emitente` varchar(6) DEFAULT NULL,
  `cod_pais_emitente` varchar(4) NOT NULL,
  `uf_emitente` varchar(2) DEFAULT NULL,
  `municipio_emitente` varchar(60) DEFAULT NULL,
  `cod_municipio_emitente` varchar(7) DEFAULT NULL,
  `telefone_emitente` varchar(14) DEFAULT NULL,
  `base_pis_emitente` decimal(3,2) NOT NULL,
  `base_cofins_emitente` decimal(3,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tab_emitente`
--

INSERT INTO `tab_emitente` (`id_emitente`, `ambiente_nfe_emitente`, `n_nota_emitente`, `n_nfce_emitente`, `padrao_emis_emitente`, `nome_razao_social_emitente`, `nome_fantasia_emitente`, `logo_emitente`, `cnpj_emitente`, `inscricao_estadual_emitente`, `cnae_fiscal_emitente`, `inscricao_municipal_emitente`, `inscricao_estadual_trib_emitente`, `regime_tributario_emitente`, `logradouro_emitente`, `numero_emitente`, `complemento_emitente`, `bairro_emitente`, `cep_emitente`, `pais_emitente`, `cod_pais_emitente`, `uf_emitente`, `municipio_emitente`, `cod_municipio_emitente`, `telefone_emitente`, `base_pis_emitente`, `base_cofins_emitente`) VALUES
(1, 2, 702, 13, 55, 'JOHNYFER COMERCIO DE FERRO LTDA', 'JOHNYFER', 'imgs/logosinfe.png\r\n', '15224418000150', '77054421', '', '', '', '1', 'Estrada Deputado DarcÃ­lio Ayres Raunheti', '431', 'LOJA A QUADRA B LOTE 19	', 'Parque AmbaÃ­', '26023315', 'Brasil', '55', 'RJ', 'Nova IguaÃ§u', '3303500', '2127961263', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_entrega`
--

CREATE TABLE `tab_entrega` (
  `id_entrega` int(11) NOT NULL,
  `cnpj_entrega` varchar(14) NOT NULL,
  `cpf_entrega` varchar(11) NOT NULL,
  `logradouro_entrega` varchar(60) NOT NULL,
  `numero_entrega` varchar(60) NOT NULL,
  `complemento_entrega` varchar(60) NOT NULL,
  `bairro_entrega` varchar(60) NOT NULL,
  `cod_mun_entrega` varchar(7) NOT NULL,
  `mun_entrega` varchar(60) NOT NULL,
  `uf_entrega` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_fatura`
--

CREATE TABLE `tab_fatura` (
  `id_fatura` int(11) NOT NULL,
  `id_nfe` int(11) NOT NULL,
  `num_fatura` varchar(10) NOT NULL,
  `vencimento_fatura` date NOT NULL,
  `val_fatura` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_item_nfe`
--

CREATE TABLE `tab_item_nfe` (
  `id_item` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `id_nfe` int(11) NOT NULL,
  `qtd_item` int(11) NOT NULL,
  `val_unit` decimal(6,2) NOT NULL,
  `val_total` decimal(6,2) NOT NULL,
  `ind_total_item` tinyint(1) NOT NULL,
  `cfop_item` int(11) NOT NULL,
  `sit_trib_icms` int(3) NOT NULL,
  `origem_icms` tinyint(1) NOT NULL,
  `base_calc_icms` decimal(20,2) DEFAULT NULL,
  `aliq_calc_cred_icms` decimal(10,4) DEFAULT NULL,
  `cred_icms` decimal(20,2) DEFAULT NULL,
  `modbc_icms` tinyint(1) DEFAULT NULL,
  `p_reducao_bc_icms` decimal(10,4) DEFAULT NULL,
  `vbc_icms` decimal(15,2) DEFAULT NULL,
  `aliq_icms` decimal(10,4) DEFAULT NULL,
  `val_op_icms` decimal(15,2) DEFAULT NULL,
  `modbcst_icms` tinyint(1) DEFAULT NULL,
  `p_reducao_bcst_icms` decimal(10,4) DEFAULT NULL,
  `p_m_vast_icms` decimal(10,4) DEFAULT NULL,
  `vbcst_icms` decimal(15,2) DEFAULT NULL,
  `aliq_st_icms` decimal(10,4) DEFAULT NULL,
  `val_st_icms` decimal(15,2) DEFAULT NULL,
  `vbc_ret_ant_st_icms` decimal(15,2) DEFAULT NULL,
  `v_ret_ant_st_icms` decimal(15,2) DEFAULT NULL,
  `val_desc_item` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_log_estoque`
--

CREATE TABLE `tab_log_estoque` (
  `id_log` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `id_op` int(11) NOT NULL,
  `numero_nfe` varchar(100) NOT NULL,
  `serie_nfe` varchar(100) NOT NULL,
  `data_movimento` date NOT NULL,
  `tipo_movimento` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_nfe`
--

CREATE TABLE `tab_nfe` (
  `id_nfe` int(11) NOT NULL,
  `num_nfe` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_retirada` int(11) NOT NULL,
  `id_entrega` int(11) NOT NULL,
  `uf_nfe` int(11) DEFAULT '33',
  `cod_numero_nfe` bigint(8) NOT NULL,
  `nop_nfe` varchar(60) NOT NULL,
  `forma_pagamento` int(11) DEFAULT '0',
  `modelo_nfe` int(11) DEFAULT NULL,
  `serie_nfe` int(11) DEFAULT NULL,
  `data_emis_nfe` datetime DEFAULT NULL,
  `data_hora_saida_entrada_nfe` datetime DEFAULT NULL,
  `tipo_documento_nfe` int(11) DEFAULT '1',
  `destino_operacao_nfe` int(11) DEFAULT '1',
  `cod_municipio_ocorrencia_nfe` varchar(7) DEFAULT '3305109',
  `nfref_nfe` text NOT NULL,
  `formato_danfe_nfe` int(11) NOT NULL DEFAULT '4',
  `forma_emissao_nfe` int(11) DEFAULT '1',
  `cod_dv_nfe` int(11) NOT NULL,
  `ambiente_nfe` int(11) NOT NULL,
  `finalidade_emissao_nfe` int(11) DEFAULT '1',
  `comprador_final_nfe` int(11) NOT NULL DEFAULT '1',
  `presenca_comprador_nfe` int(11) NOT NULL DEFAULT '1',
  `procemi_nfe` int(11) NOT NULL DEFAULT '0',
  `verproc_nfe` varchar(20) NOT NULL DEFAULT '0.5',
  `status_venda_nfe` varchar(50) NOT NULL,
  `val_total_nfe` decimal(6,2) NOT NULL,
  `id_transp_nfe` int(11) NOT NULL,
  `mod_frete` tinyint(1) DEFAULT '9',
  `tipo_doc_transp_nfe` tinyint(1) NOT NULL,
  `cod_antt_nfe` varchar(60) NOT NULL,
  `placa_veic_nfe` varchar(10) NOT NULL,
  `uf_veic_nfe` varchar(2) NOT NULL,
  `qtd_vol_nfe` decimal(16,4) NOT NULL,
  `especie_vol_nfe` varchar(60) NOT NULL,
  `marca_vol_nfe` varchar(60) NOT NULL,
  `num_vol_nfe` int(11) NOT NULL,
  `peso_bruto_nfe` decimal(16,4) NOT NULL,
  `peso_liq_nfe` decimal(16,4) NOT NULL,
  `val_transp_nfe` decimal(15,2) DEFAULT '0.00',
  `tipo_pg_nfe` varchar(2) DEFAULT NULL,
  `val_pg_nfe` decimal(20,2) DEFAULT NULL,
  `cnpj_oper_nfe` varchar(14) DEFAULT NULL,
  `bandeira_pg_nfe` tinyint(2) DEFAULT NULL,
  `cod_aut_pg_nfe` varchar(30) DEFAULT NULL,
  `inf_ad_fisco_nfe` text NOT NULL,
  `inf_ad_compl_nfe` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_nref`
--

CREATE TABLE `tab_nref` (
  `id_nref` int(11) NOT NULL,
  `id_nfe_nref` int(11) NOT NULL,
  `chave_nref` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_op`
--

CREATE TABLE `tab_op` (
  `id_op` int(11) NOT NULL,
  `data_movimento` date NOT NULL,
  `tipo_movimento` varchar(100) NOT NULL,
  `qtd_movimentada` int(11) NOT NULL,
  `val_unit` decimal(6,2) NOT NULL,
  `qtd_saldo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_ordem`
--

CREATE TABLE `tab_ordem` (
  `id_ordem` int(11) NOT NULL,
  `status_ordem` varchar(50) NOT NULL,
  `id_cliente_ordem` int(11) NOT NULL,
  `aberto_por_ordem` varchar(100) NOT NULL,
  `responsavel_ordem` varchar(100) NOT NULL,
  `data_hora_abertura_ordem` datetime NOT NULL,
  `data_hora_fechamento_ordem` datetime NOT NULL,
  `equip_ordem` varchar(200) NOT NULL,
  `serie_equip_ordem` varchar(50) NOT NULL,
  `garantia_yn_ordem` tinyint(1) NOT NULL,
  `contrato_yn_ordem` tinyint(1) NOT NULL,
  `avulso_yn_ordem` tinyint(1) NOT NULL,
  `n_aprov_yn_ordem` tinyint(1) NOT NULL,
  `inviavel_yn_ordem` tinyint(1) NOT NULL,
  `sem_conserto_yn_ordem` tinyint(1) NOT NULL,
  `garantia_ate_ordem` date NOT NULL,
  `val_pg_ordem` decimal(15,2) NOT NULL,
  `forma_pg_ordem` varchar(20) NOT NULL,
  `conserto_yn_ordem` tinyint(1) NOT NULL,
  `orcamento_yn_ordem` tinyint(1) NOT NULL,
  `tecnico_balcao_ordem` varchar(100) NOT NULL,
  `cabo_forca_yn_ordem` tinyint(1) NOT NULL,
  `cabo_video_yn_ordem` tinyint(1) NOT NULL,
  `bandejas_yn_ordem` tinyint(1) NOT NULL,
  `base_yn_ordem` tinyint(1) NOT NULL,
  `toner_yn_ordem` tinyint(1) NOT NULL,
  `cartucho_preto_yn_ordem` tinyint(1) NOT NULL,
  `cartucho_color_yn_ordem` tinyint(1) NOT NULL,
  `fonte_yn_ordem` tinyint(1) NOT NULL,
  `drive_dvd_yn_ordem` tinyint(1) NOT NULL,
  `pendrive_yn_ordem` tinyint(1) NOT NULL,
  `case_yn_ordem` tinyint(1) NOT NULL,
  `outro_ordem` varchar(200) NOT NULL,
  `defeito_rel_ordem` text NOT NULL,
  `defeito_const_ordem` text NOT NULL,
  `solucao_ordem` text NOT NULL,
  `obs_ordem` text NOT NULL,
  `val_a_pg_ordem` decimal(15,2) NOT NULL,
  `compr_ordem` varchar(60) NOT NULL,
  `tempo_exec_ordem` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_produto`
--

CREATE TABLE `tab_produto` (
  `id_produto` int(11) NOT NULL,
  `codigo_produto` varchar(60) DEFAULT NULL,
  `descricao_produto` varchar(120) DEFAULT NULL,
  `ncm_produto` varchar(8) DEFAULT NULL,
  `unid_produto` varchar(6) DEFAULT NULL,
  `valor_produto` decimal(21,10) DEFAULT NULL,
  `val_bruto_produto` decimal(15,2) NOT NULL,
  `qtd_atual_produto` int(11) NOT NULL,
  `qtd_saida_produto` int(11) NOT NULL,
  `classe_ipi_produto` varchar(100) DEFAULT NULL,
  `cod_enquadramento_ipi_produto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tab_produto`
--

INSERT INTO `tab_produto` (`id_produto`, `codigo_produto`, `descricao_produto`, `ncm_produto`, `unid_produto`, `valor_produto`, `val_bruto_produto`, `qtd_atual_produto`, `qtd_saida_produto`, `classe_ipi_produto`, `cod_enquadramento_ipi_produto`) VALUES
(2, '0000', 'produto teste', '12345678', 'PÃ‡', '1001.0000000000', '0.00', 0, 0, '', ''),
(3, '94', 'Coluna 8.0 7x20 6 mt', '73142000', 'PÃ‡', '36.5000000000', '0.00', 0, 0, '', ''),
(4, '92', 'Coluna 6.0 7x20 6 Mt', '73142000', 'PÃ‡', '26.5000000000', '0.00', 0, 0, '', ''),
(5, '91', 'Coluna 10.0 7x20 6MT', '73142000', 'PÃ‡', '65.0000000000', '0.00', 0, 0, '', ''),
(6, '107', 'Sapata 6.0 60x60 ', '73142000', 'PÃ‡', '5.6000000000', '0.00', 0, 0, '', ''),
(7, '108', 'Sapata 6.0 80x80', '73142000', 'PÃ‡', '9.6000000000', '0.00', 0, 0, '', ''),
(8, '868', 'Sapata 8.0 60x60', '73142000', 'PÃ‡', '8.8000000000', '0.00', 0, 0, '', ''),
(9, '605', 'Sapata 8.0 80x80', '73142000', 'PÃ‡', '14.6000000000', '0.00', 0, 0, '', ''),
(10, '100', 'TreliÃ§a 7MT', '73084000', 'PÃ‡', '21.0000000000', '0.00', 0, 0, '', ''),
(11, '821', 'TreliÃ§a 8MT', '73084000', 'PÃ‡', '24.0000000000', '0.00', 0, 0, '', ''),
(12, '920', 'TreliÃ§a 9MT', '73084000', 'PÃ‡', '27.0000000000', '0.00', 0, 0, '', ''),
(13, '95', 'Estribo 7x17 ', '73142000', 'PÃ‡', '0.3500000000', '0.00', 0, 0, '', ''),
(14, '96', 'Estribo 7x20                ', '73142000', 'PÃ‡', '0.4000000000', '0.00', 0, 0, '', ''),
(15, '102', 'Tela soldada 15x15 2x3 Leve', '73142000', 'PÃ‡', '28.0000000000', '0.00', 0, 0, '', ''),
(16, '101', 'Tela soldada 20x20 2x3 Leve', '73142000', 'PÃ‡', '20.0000000000', '0.00', 0, 0, '', ''),
(17, '227', 'Vergalhao 4.2 ', '72131000', 'PÃ‡', '4.0000000000', '0.00', 0, 0, '', ''),
(18, '228', 'Vergalhao 6.3', '72131000', 'PÃ‡', '9.0000000000', '0.00', 0, 0, '', ''),
(19, '226', 'Vergalhao 6.0', '72131000', 'PÃ‡', '9.0000000000', '0.00', 0, 0, '', ''),
(20, '223', 'Vergalhao 8.0 ', '72131000', 'PÃ‡', '15.0000000000', '0.00', 0, 0, '', ''),
(21, '119', 'Vergalhao 10.0', '72131000', 'PÃ‡', '25.0000000000', '0.00', 0, 0, '', ''),
(22, '904', 'Vergalhao 7.5', '72131000', 'PÃ‡', '13.9000000000', '0.00', 0, 0, '', ''),
(23, '424', 'Arame Cozido', '72171090', 'PÃ‡', '7.0000000000', '0.00', 0, 0, '', ''),
(24, '120', 'Barra Chata 1/2x1/8', '72149100', 'PÃ‡', '8.7000000000', '0.00', 0, 0, '', ''),
(25, '121', 'Barra Chata 5/8x1/8', '72149100', 'PÃ‡', '9.8000000000', '0.00', 0, 0, '', ''),
(26, '122', 'Barra Chata 3/4x1/8', '72149100', 'p', '11.5000000000', '0.00', 0, 0, '', ''),
(27, '123', 'Barra Chata 7/8x1/8', '72149100', 'PÃ‡', '13.3000000000', '0.00', 0, 0, '', ''),
(28, '124', 'Barra Chata 1x1/8', '72149100', 'PÃ‡', '14.0000000000', '0.00', 0, 0, '', ''),
(29, '125', 'Barra Chata 1 1/4x1/8', '72149100', 'PÃ‡', '21.0000000000', '0.00', 0, 0, '', ''),
(30, '126', 'Barra Chata 1 1/2x1/8', '72149100', 'PÃ‡', '27.5000000000', '0.00', 0, 0, '', ''),
(31, '127', 'Barra Chata 2x1/8', '72149100', 'PÃ‡', '41.8000000000', '0.00', 0, 0, '', ''),
(32, '128', 'Barra Chata 1/2x3/16', '72149100', 'PÃ‡', '10.7000000000', '0.00', 0, 0, '', ''),
(33, '129', 'Barra Chata 5/8x3/16', '72149100', 'PÃ‡', '13.0000000000', '0.00', 0, 0, '', ''),
(34, '130', 'Barra Chata 3/4x3/16', '72149100', 'PÃ‡', '17.6000000000', '0.00', 0, 0, '', ''),
(35, '131', 'Barra Chata 7/8x3/16', '72149100', 'PÃ‡', '19.5000000000', '0.00', 0, 0, '', ''),
(36, '132', 'Barra Chata 1x3/16', '72149100', 'PÃ‡', '21.0000000000', '0.00', 0, 0, '', ''),
(37, '133', 'Barra Chata 1 1/4x3/16', '72149100', 'PÃ‡', '26.0000000000', '0.00', 0, 0, '', ''),
(38, '134', 'Barra Chata 1 1/2x3/16', '72149100', 'PÃ‡', '30.3000000000', '0.00', 0, 0, '', ''),
(39, '135', 'Barra Chata 2x3/16', '72149100', 'PÃ‡', '35.2000000000', '0.00', 0, 0, '', ''),
(40, '138', 'Barra Chata 3/4x1/4', '72149100', 'PÃ‡', '22.9000000000', '0.00', 0, 0, '', ''),
(41, '139', 'Barra Chata 7/8x1/4', '72149100', 'PÃ‡', '23.1000000000', '0.00', 0, 0, '', ''),
(42, '140', 'Barra Chata 1x1/4', '72149100', 'PÃ‡', '22.0000000000', '0.00', 0, 0, '', ''),
(43, '141', 'Barra Chata 1 1/4x1/4', '72149100', 'PÃ‡', '38.5000000000', '0.00', 0, 0, '', ''),
(44, '142', 'Barra Chata 1 1/2x1/4', '72149100', 'PÃ‡', '43.5000000000', '0.00', 0, 0, '', ''),
(45, '143', 'Barra Chata 2x1/4', '72149100', 'PÃ‡', '49.3000000000', '0.00', 0, 0, '', ''),
(46, '146', 'Barra Chata 1x3/8', '72149100', 'PÃ‡', '50.0000000000', '0.00', 0, 0, '', ''),
(47, '186', 'Barra Chata 1 1/2x1/2', '72149100', 'PÃ‡', '73.9000000000', '0.00', 0, 0, '', ''),
(48, '147', 'Cantoneira 5/8x2,5', '72162100', 'PÃ‡', '13.4000000000', '0.00', 0, 0, '', ''),
(49, '149', 'Cantoneira 3/4x1/8', '72162100', 'PÃ‡', '19.3000000000', '0.00', 0, 0, '', ''),
(50, '150', 'Cantoneira 7/8x1/8', '72162100', 'PÃ‡', '21.0000000000', '0.00', 0, 0, '', ''),
(51, '151', 'Cantoneira 1x1/8', '72162100', 'PÃ‡', '22.0000000000', '0.00', 0, 0, '', ''),
(52, '152', 'Cantoneira 1 1/4xx1/8', '72149100', 'PÃ‡', '28.0000000000', '0.00', 0, 0, '', ''),
(53, '153', 'Cantoneira 1 1/2x1/8', '72162100', 'PÃ‡', '35.1000000000', '0.00', 0, 0, '', ''),
(54, '154', 'Cantoneira 2x1/8', '72162100', 'PÃ‡', '54.0000000000', '0.00', 0, 0, '', ''),
(55, '155', 'Cantoneira 1x3/16', '72162100', 'PÃ‡', '37.1000000000', '0.00', 0, 0, '', ''),
(56, '156', 'Cantoneira 1 1/4x3/16', '72162100', 'PÃ‡', '44.9000000000', '0.00', 0, 0, '', ''),
(57, '157', 'Cantoneira 1 1/2x3/16', '72162100', 'PÃ‡', '54.0000000000', '0.00', 0, 0, '', ''),
(58, '158', 'Cantoneira 2x3/16', '72162100', 'PÃ‡', '71.3000000000', '0.00', 0, 0, '', ''),
(59, '159', 'Cantoneira 1 1/4x1/4', '72162100', 'PÃ‡', '54.5000000000', '0.00', 0, 0, '', ''),
(60, '160', 'Cantoneira 1 1/2x1/4', '72162100', 'PÃ‡', '73.0000000000', '0.00', 0, 0, '', ''),
(61, '161', 'Cantoneira 1 1/2x1/4', '72162100', 'PÃ‡', '94.0000000000', '0.00', 0, 0, '', ''),
(62, '220', 'Ferro Redondo 3/8', '72149910', 'PÃ‡', '12.4000000000', '0.00', 0, 0, '', ''),
(63, '221', 'Ferro Redondo 1/2', '72149910', 'PÃ‡', '19.6000000000', '0.00', 0, 0, '', ''),
(64, '567', 'Ferro Redondo 5/8', '72149910', 'PÃ‡', '34.6000000000', '0.00', 0, 0, '', ''),
(65, '224', 'Ferro Quadrado 3/8', '72149910', 'PÃ‡', '14.9000000000', '0.00', 0, 0, '', ''),
(66, '225', 'Ferro Quadrado 1/2', '72149910', 'PÃ‡', '26.2000000000', '0.00', 0, 0, '', ''),
(67, '162', 'Ferro UDC 2X2', '72169100', 'PÃ‡', '29.2000000000', '0.00', 0, 0, '', ''),
(68, '164', 'Ferro UDC 3X2', '72169100', 'PÃ‡', '48.0000000000', '0.00', 0, 0, '', ''),
(69, '166', 'Ferro UDC 4X2', '72169100', 'PÃ‡', '55.0000000000', '0.00', 0, 0, '', ''),
(70, '739', 'Ferro UDC Errijecido 2x265', '72169100', 'PÃ‡', '41.8000000000', '0.00', 0, 0, '', ''),
(71, '740', 'Ferro UDC Errijecido 3x2', '72169100', 'PÃ‡', '56.0000000000', '0.00', 0, 0, '', ''),
(72, '173', 'Metalon 20x20x18', '73066100', 'PÃ‡', '21.3000000000', '0.00', 0, 0, '', ''),
(73, '174', 'Metalon 20x20x20', '73066100', 'PÃ‡', '16.0000000000', '0.00', 0, 0, '', ''),
(74, '176', 'Metalon 30x20x18', '73066100', 'PÃ‡', '26.5000000000', '0.00', 0, 0, '', ''),
(75, '177', 'Metalon 30x20x20', '73066100', 'PÃ‡', '21.3000000000', '0.00', 0, 0, '', ''),
(76, '179', 'Metalon 30x30x18', '73066100', 'PÃ‡', '28.5000000000', '0.00', 0, 0, '', ''),
(77, '183', 'Metalon 50x30x18', '73066100', 'PÃ‡', '44.5000000000', '0.00', 0, 0, '', ''),
(78, '184', 'Metalon 50x30x20', '73066100', 'PÃ‡', '30.0000000000', '0.00', 0, 0, '', ''),
(79, '522', 'Metalon 40x40x20', '73066100', 'PÃ‡', '30.0000000000', '0.00', 0, 0, '', ''),
(80, '178', 'Metalon 30x20x22', '73066100', 'PÃ‡', '17.0000000000', '0.00', 0, 0, '', ''),
(81, '746', 'Chapa Galv 12x2x1,20', '72104910', 'PÃ‡', '247.4000000000', '0.00', 0, 0, '', ''),
(82, '296', 'Chapa Galv 14x2x1,00', '72104910', 'PÃ‡', '165.0000000000', '0.00', 0, 0, '', ''),
(83, '271', 'Chapa Galv 14x2,20x1,00', '72104910', 'PÃ‡', '197.0000000000', '0.00', 0, 0, '', ''),
(84, '272', 'Chapa Galv 14x2x1,20', '72104910', 'PÃ‡', '196.0000000000', '0.00', 0, 0, '', ''),
(85, '273', 'Chapa Galv 14x3x0,85', '72104910', 'PÃ‡', '222.0000000000', '0.00', 0, 0, '', ''),
(86, '274', 'Chapa Galv 14x3x1,00', '72104910', 'PÃ‡', '227.0000000000', '0.00', 0, 0, '', ''),
(87, '275', 'Chapa Galv 14x3x1,20', '72104910', 'PÃ‡', '236.0000000000', '0.00', 0, 0, '', ''),
(88, '547', 'Chapa Galv 16x2x1', '72104910', 'PÃ‡', '138.0000000000', '0.00', 0, 0, '', ''),
(89, '552', 'Chapa Galv 16x2x1,20', '72104910', 'PÃ‡', '184.0000000000', '0.00', 0, 0, '', ''),
(90, '278', 'Chapa Galv 18x2x1', '72104910', 'PÃ‡', '106.0000000000', '0.00', 0, 0, '', ''),
(91, '279', 'Chapa Galv 18x2x1,20', '72104910', 'PÃ‡', '134.0000000000', '0.00', 0, 0, '', ''),
(92, '280', 'Chapa Galv 20x2x1', '72104910', 'PÃ‡', '75.6000000000', '0.00', 0, 0, '', ''),
(93, '281', 'Chapa Galv 20x2x1,20', '72104910', 'PÃ‡', '102.6000000000', '0.00', 0, 0, '', ''),
(94, '548', 'Chapa Galv 22x2x1', '721049', 'PÃ‡', '64.0000000000', '0.00', 0, 0, '', ''),
(95, '549', 'Chapa Gaalv 22x2x1,20', '72104910', 'PÃ‡', '91.0000000000', '0.00', 0, 0, '', ''),
(96, '282', 'Chapa Galv 24x2x1', '72104910', 'PÃ‡', '59.8000000000', '0.00', 0, 0, '', ''),
(97, '284', 'Chapa Galv 26x2x1', '72104910', 'PÃ‡', '48.2000000000', '0.00', 0, 0, '', ''),
(98, '285', 'Chapa Galv 26x2x1,20', '72104910', 'PÃ‡', '53.0000000000', '0.00', 0, 0, '', ''),
(99, '277', 'Chapa Galv 16x2x110', '72104910', 'PÃ‡', '180.0000000000', '0.00', 0, 0, '', ''),
(100, '902', 'Chapa Lambri 20x2x1,06', '72104910', 'PÃ‡', '81.0000000000', '0.00', 0, 0, '', ''),
(101, '331', 'Telha Galvolume 2MT', '73089090', 'PÃ‡', '37.2000000000', '0.00', 0, 0, '', ''),
(102, '753', 'Telha Galvolume 2,5 MT', '72104910', 'PÃ‡', '46.5000000000', '0.00', 0, 0, '', ''),
(103, '326', 'Telha Galvolume 3MT', '73089090', 'PÃ‡', '55.8000000000', '0.00', 0, 0, '', ''),
(104, '327', 'Telha Galvolume 4MT', '73089090', 'PÃ‡', '74.4000000000', '0.00', 0, 0, '', ''),
(105, '328', 'Telha Galvolume 5MT', '73089090', 'PÃ‡', '93.0000000000', '0.00', 0, 0, '', ''),
(106, '329', 'Telha Galvolume 6MT', '73089090', 'PÃ‡', '111.6000000000', '0.00', 0, 0, '', ''),
(107, '330', 'Telha Galvolume 7MT', '73089090', 'PÃ‡', '130.2000000000', '0.00', 0, 0, '', ''),
(108, '366', 'Telha Amianto 244x110', '68114000', 'PÃ‡', '30.0000000000', '0.00', 0, 0, '', ''),
(109, '462', 'Gonzo 3/8', '8302100', 'PÃ‡', '0.4000000000', '0.00', 0, 0, '', ''),
(110, '463', 'Gonzo 1/2', '8302100', 'PÃ‡', '0.9000000000', '0.00', 0, 0, '', ''),
(111, '464', 'Gonzo 5/8', '8302100', 'PÃ‡', '1.6000000000', '0.00', 0, 0, '', ''),
(112, '465', 'Gonzo 3/4', '8302100', 'PÃ‡', '2.6000000000', '0.00', 0, 0, '', ''),
(113, '466', 'Gonzo 7/8', '8302100', 'PÃ‡', '3.6000000000', '0.00', 0, 0, '', ''),
(114, '467', 'Gonzo 1', '8302100', 'PÃ‡', '6.0000000000', '0.00', 0, 0, '', ''),
(115, '113', 'Roldana 2\"', '83022000', 'PÃ‡', '14.9000000000', '0.00', 0, 0, '', ''),
(116, '111', 'Roldana 2 1/2', '83022000', 'PÃ‡', '15.3000000000', '0.00', 0, 0, '', ''),
(117, '109', 'Roldana 3\"', '83022000', 'PÃ‡', '20.7000000000', '0.00', 0, 0, '', ''),
(118, '108', 'Roldana 4\"', '83022000', 'PÃ‡', '30.0000000000', '0.00', 0, 0, '', ''),
(119, '669', 'Trinco P', '83014000', 'PÃ‡', '2.8000000000', '0.00', 0, 0, '', ''),
(120, '336', 'Trinco G', '83014000', 'PÃ‡', '4.2000000000', '0.00', 0, 0, '', ''),
(121, '104', 'Arame Galv ', '72172090', 'PÃ‡', '14.8000000000', '0.00', 0, 0, '', ''),
(122, '451', 'Serra Starret', '82029100', 'PÃ‡', '5.2000000000', '0.00', 0, 0, '', ''),
(123, '887', 'Silicone Pequeno', '32141010', 'PÃ‡', '3.8000000000', '0.00', 0, 0, '', ''),
(124, '668', 'Silicone Grande', '32141010', 'PÃ‡', '12.9000000000', '0.00', 0, 0, '', ''),
(125, '498', 'MÃ¡scara', '39269090', 'PÃ‡', '28.8000000000', '0.00', 0, 0, '', ''),
(126, '514', 'Trena 5MT', '90178090', 'PÃ‡', '15.0000000000', '0.00', 0, 0, '', ''),
(127, '29', 'Broca AÃ§o Rapido 11/6', '82075011', 'PÃ‡', '5.8500000000', '0.00', 0, 0, '', ''),
(128, '30', 'Broca AÃ§o Rapido 5/68', '82075011', 'PÃ‡', '5.4000000000', '0.00', 0, 0, '', ''),
(129, '770', 'Brocas AÃ§o Rapido 3/32', '82075011', 'PÃ‡', '5.1000000000', '0.00', 0, 0, '', ''),
(130, '42', 'Broca AÃ§o Rapido 7/64', '82075011', 'PÃ‡', '4.7000000000', '0.00', 0, 0, '', ''),
(131, '44', 'Brocaa AÃ§o Rapido 9/64', '82075', 'PÃ‡', '5.4000000000', '0.00', 0, 0, '', ''),
(132, '33', 'Broca AÃ§o Rapido 1/8', '82075011', 'PÃ‡', '5.1000000000', '0.00', 0, 0, '', ''),
(133, '529', 'Broca AÃ§o Rapido 5/32', '82075011', 'PÃ‡', '5.4000000000', '0.00', 0, 0, '', ''),
(134, '530', 'Broca AÃ§o Rapido 11/64', '82075011', 'PÃ‡', '6.9000000000', '0.00', 0, 0, '', ''),
(135, '36', 'Broca AÃ§o Rapido 3/16', '82075011', 'PÃ‡', '6.4000000000', '0.00', 0, 0, '', ''),
(136, '37', 'Broca AÃ§o Rapido 13/64', '82075011', 'PÃ‡', '6.6000000000', '0.00', 0, 0, '', ''),
(137, '39', 'Broca AÃ§o Rapido 7/32', '82075011', 'PÃ‡', '6.8000000000', '0.00', 0, 0, '', ''),
(138, '531', 'Broca AÃ§o Rapido 15/64', '82075011', 'PÃ‡', '9.8000000000', '0.00', 0, 0, '', ''),
(139, '41', 'Broca AÃ§o Rapido 1/4', '82075011', 'PÃ‡', '8.8000000000', '0.00', 0, 0, '', ''),
(140, '38', 'Broca AÃ§o Rapido 17/64', '82075011', 'PÃ‡', '18.8500000000', '0.00', 0, 0, '', ''),
(141, '532', 'Broca AÃ§o Rapido 9/32', '82075011', 'PÃ‡', '14.8000000000', '0.00', 0, 0, '', ''),
(142, '533', 'Broca AÃ§o Rapido 19/64', '82075011', 'PÃ‡', '12.6000000000', '0.00', 0, 0, '', ''),
(143, '45', 'Broca AÃ§o Rapido 5/16', '82075011', 'PÃ‡', '11.7000000000', '0.00', 0, 0, '', ''),
(144, '46', 'Broca AÃ§o Rapido 21/64', '82075011', 'PÃ‡', '19.1000000000', '0.00', 0, 0, '', ''),
(145, '47', 'Broca AÃ§o Rapido 11/32', '82075011', 'PÃ‡', '22.1000000000', '0.00', 0, 0, '', ''),
(146, '48', 'Broca AÃ§o Rapido 23/64', '82075011', 'PÃ‡', '26.3000000000', '0.00', 0, 0, '', ''),
(147, '49', 'Broca AÃ§o Rapido 3/8', '82075011', 'PÃ‡', '26.7000000000', '0.00', 0, 0, '', ''),
(148, '50', 'Broca AÃ§o Rapido 13/32', '82075011', 'PÃ‡', '28.3000000000', '0.00', 0, 0, '', ''),
(149, '51', 'Broca AÃ§o Rapido 17/16', '82075011', 'PÃ‡', '29.6000000000', '0.00', 0, 0, '', ''),
(150, '52', 'Broca AÃ§o Rapido 15/32', '82075011', 'PÃ‡', '26.9000000000', '0.00', 0, 0, '', ''),
(151, '53', 'Broca AÃ§o Rapido 1/2', '82075011', 'PÃ‡', '34.8000000000', '0.00', 0, 0, '', ''),
(152, '54', 'Broca AÃ§o Rapido 3/64', '82075011', 'PÃ‡', '7.6000000000', '0.00', 0, 0, '', ''),
(153, '771', 'Broca AÃ§o Rapido 21/32', '82075011', 'PÃ‡', '187.2000000000', '0.00', 0, 0, '', ''),
(154, '615', 'Agua Raz', '27101230', 'PÃ‡', '10.5000000000', '0.00', 0, 0, '', ''),
(155, '848', 'Torques', '8203010', 'PÃ‡', '20.0000000000', '0.00', 0, 0, '', ''),
(156, '620', 'Cinta Grande', '58063300', 'PÃ‡', '91.0000000000', '0.00', 0, 0, '', ''),
(157, '620', 'Cinta Pequena', '5806300', 'PÃ‡', '49.0000000000', '0.00', 0, 0, '', ''),
(158, '1109', 'Eletrodo 2,5', '8311000', 'PÃ‡', '8.2000000000', '0.00', 0, 0, '', ''),
(159, '1108', 'Eletrodo OK Serralheiro 2,5 ', '83111000', 'PÃ‡', '13.0000000000', '0.00', 0, 0, '', ''),
(160, '495', 'Botina', '64035190', 'PÃ‡', '47.5000000000', '0.00', 0, 0, '', ''),
(161, '499', 'Porta Eletrodo', '85159000', 'PÃ‡', '41.6000000000', '0.00', 0, 0, '', ''),
(162, '877', 'Escova de AÃ§o', '96039000', 'PÃ‡', '3.5000000000', '0.00', 0, 0, '', ''),
(163, '843', 'Fita Isolante', '56061000', 'PÃ‡', '3.0000000000', '0.00', 0, 0, '', ''),
(164, '191', 'Tubo Galv 1x16', '73063000', 'PÃ‡', '31.0000000000', '0.00', 0, 0, '', ''),
(165, '825', 'Tubo Galv 1 1/4x18', '73063000', 'PÃ‡', '31.0000000000', '0.00', 0, 0, '', ''),
(166, '193', 'Tubo Galv 1 1/2x16', '73063000', 'PÃ‡', '47.0000000000', '0.00', 0, 0, '', ''),
(167, '196', 'Tubo Galv 2 1/2x16', '73063000', 'PÃ‡', '72.6000000000', '0.00', 0, 0, '', ''),
(168, '192', 'Tubo Galv 1 1/4x16', '73063000', 'PÃ‡', '38.0000000000', '0.00', 0, 0, '', ''),
(169, '197', 'Tubo Galv 2x16', '73063000', 'PÃ‡', '64.0000000000', '0.00', 0, 0, '', ''),
(170, '835', 'Martelo ', '82052000', 'PÃ‡', '31.4000000000', '0.00', 0, 0, '', ''),
(171, '511', 'Alicate Rebitador', '82032010', 'PÃ‡', '20.0000000000', '0.00', 0, 0, '', ''),
(172, '483', 'Prego 17x27', '73170090', 'PÃ‡', '7.5000000000', '0.00', 0, 0, '', ''),
(173, '288', 'Pino Guia ', '83022000', 'PÃ‡', '11.8000000000', '0.00', 0, 0, '', ''),
(174, '459', 'Estopa', '53050090', 'PÃ‡', '2.1000000000', '0.00', 0, 0, '', ''),
(175, '506', 'Oculos', '9004920', 'PÃ‡', '13.0000000000', '0.00', 0, 0, '', ''),
(176, '483', 'Prego 18x30', '73170090', 'PÃ‡', '7.5000000000', '0.00', 0, 0, '', ''),
(177, '307', 'Chapa Xadrez', '76061290', 'PÃ‡', '160.0000000000', '0.00', 0, 0, '', ''),
(178, '449', 'Alavanca de Ferro ', '83024100', 'PÃ‡', '2.5000000000', '0.00', 0, 0, '', ''),
(179, '901', 'Pistola de Silicone', '82055900', 'PÃ‡', '16.0000000000', '0.00', 0, 0, '', ''),
(180, '443', 'Disco Norton 4 1/2', '82023100', 'PÃ‡', '3.3000000000', '0.00', 0, 0, '', ''),
(181, '442', 'Disco Norton 7\"', '82023100', 'PÃ‡', '5.3000000000', '0.00', 0, 0, '', ''),
(182, '441', 'Disco Norton 10\"', '82023100', 'PÃ‡', '9.0000000000', '0.00', 0, 0, '', ''),
(183, '440', 'Disco Norton 12\"', '82023100', 'PÃ‡', '12.6000000000', '0.00', 0, 0, '', ''),
(184, '446', 'Disco Norton Desbaste 4 1/2', '82023100', 'PÃ‡', '4.1000000000', '0.00', 0, 0, '', ''),
(185, '447', 'Disco Norton Desbaste 7\"', '82023100', 'PÃ‡', '9.4000000000', '0.00', 0, 0, '', ''),
(186, '444', 'Disco Norton AÃ§o Rapido 4  1/2', '82023100', 'PÃ‡', '5.5000000000', '0.00', 0, 0, '', ''),
(187, '671', 'Disco Norton Continuo', '82023100', 'PÃ‡', '14.8000000000', '0.00', 0, 0, '', ''),
(188, '445', 'Disco Norton AÃ§o Rapido 7\"', '82023100', 'PÃ‡', '12.7500000000', '0.00', 0, 0, '', ''),
(189, '717', 'Disco Elite 4 1/2', '82023100', 'PÃ‡', '2.5000000000', '0.00', 0, 0, '', ''),
(190, '680', 'Disco Madeira', '82023100', 'PÃ‡', '13.0000000000', '0.00', 0, 0, '', ''),
(191, '923', 'Chave de Fenda 1/8', '82054000', 'PÃ‡', '4.0000000000', '0.00', 0, 0, '', ''),
(192, '924', 'Chave de Fenda 3/16', '82054000', 'PÃ‡', '4.5000000000', '0.00', 0, 0, '', ''),
(193, '925', 'Chave de Fenda 1/4', '82054000', 'PÃ‡', '5.6000000000', '0.00', 0, 0, '', ''),
(194, '926', 'Chave de Fenda 5/16', '82054000', 'PÃ‡', '9.0000000000', '0.00', 0, 0, '', ''),
(195, '927', 'Chave de Teste', '82054000', 'PÃ‡', '3.1000000000', '0.00', 0, 0, '', ''),
(196, '479', 'Grampo 15cm', '73181900', 'PÃ‡', '0.5000000000', '0.00', 0, 0, '', ''),
(197, '780', 'Grampo 20cm', '73181900', 'PÃ‡', '0.6000000000', '0.00', 0, 0, '', ''),
(198, '539', 'Corda 3mm', '56074900', 'PÃ‡', '0.3000000000', '0.00', 0, 0, '', ''),
(199, '540', 'Corda 4mm', '53050090', 'PÃ‡', '0.4500000000', '0.00', 0, 0, '', ''),
(200, '541', 'Corda 5mm', '56074900', 'PÃ‡', '0.5500000000', '0.00', 0, 0, '', ''),
(201, '542', 'Corda 6mm', '56074900', 'PÃ‡', '0.8000000000', '0.00', 0, 0, '', ''),
(202, '543', 'Corda 8mm', '56074900', 'PÃ‡', '1.2000000000', '0.00', 0, 0, '', ''),
(203, '544', 'Corda 10mm', '56074900', 'PÃ‡', '1.6000000000', '0.00', 0, 0, '', ''),
(204, '545', 'Corda 12mm', '56074900', 'PÃ‡', '2.0000000000', '0.00', 0, 0, '', ''),
(205, '850', 'Tesoura Funileiro', '82033000', 'PÃ‡', '46.0000000000', '0.00', 0, 0, '', ''),
(206, '849', 'Alicate Universal', '82032010', 'PÃ‡', '27.2000000000', '0.00', 0, 0, '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_produto_nota`
--

CREATE TABLE `tab_produto_nota` (
  `id_produto_nota` int(11) NOT NULL,
  `id_nfe` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `qtd_produto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_retirada`
--

CREATE TABLE `tab_retirada` (
  `id_retirada` int(11) NOT NULL,
  `cnpj_retirada` varchar(14) NOT NULL,
  `cpf_retirada` varchar(11) NOT NULL,
  `logradouro_retirada` varchar(60) NOT NULL,
  `numero_retirada` varchar(60) NOT NULL,
  `complemento_retirada` varchar(60) NOT NULL,
  `bairro_retirada` varchar(60) NOT NULL,
  `cod_mun_retirada` varchar(7) NOT NULL,
  `mun_retirada` varchar(60) NOT NULL,
  `uf_retirada` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_transportadora`
--

CREATE TABLE `tab_transportadora` (
  `id_transportadora` int(11) NOT NULL,
  `nome_razao_social_transportadora` varchar(300) DEFAULT NULL,
  `cnpj_transportadora` varchar(100) DEFAULT NULL,
  `inscricao_estadual_transportadora` varchar(100) DEFAULT NULL,
  `isento_icms_transportadora` varchar(100) DEFAULT NULL,
  `logradouro_transportadora` varchar(200) DEFAULT NULL,
  `numero_transportadora` varchar(10) DEFAULT NULL,
  `complemento_transportadora` varchar(100) DEFAULT NULL,
  `bairro_transportadora` varchar(100) DEFAULT NULL,
  `cep_transportadora` varchar(100) DEFAULT NULL,
  `pais_transportadora` varchar(100) DEFAULT NULL,
  `uf_transportadora` varchar(2) DEFAULT NULL,
  `municipio_transportadora` varchar(200) DEFAULT NULL,
  `cod_municipio_transportadora` varchar(100) DEFAULT NULL,
  `telefone_transportadora` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tab_transportadora`
--

INSERT INTO `tab_transportadora` (`id_transportadora`, `nome_razao_social_transportadora`, `cnpj_transportadora`, `inscricao_estadual_transportadora`, `isento_icms_transportadora`, `logradouro_transportadora`, `numero_transportadora`, `complemento_transportadora`, `bairro_transportadora`, `cep_transportadora`, `pais_transportadora`, `uf_transportadora`, `municipio_transportadora`, `cod_municipio_transportadora`, `telefone_transportadora`) VALUES
(1, 'TRANSPORTADORA EXEMPLAR', '36673362000190', '71574520', 'nao', 'RUA Y', '000', 'ALA 1', 'PAVUNA', '', 'Brasil', 'RJ', NULL, '', '2199999999');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_xml`
--

CREATE TABLE `tab_xml` (
  `id_xml` int(11) NOT NULL,
  `id_venda` int(11) NOT NULL,
  `chave_xml` varchar(255) NOT NULL,
  `protocolo_xml` varchar(100) NOT NULL,
  `finalidade_xml` varchar(40) NOT NULL,
  `tipo_xml` varchar(40) NOT NULL,
  `conteudo_xml` text NOT NULL,
  `assinado_xml` tinyint(1) DEFAULT NULL,
  `valido_xml` tinyint(1) NOT NULL,
  `transmitido_xml` tinyint(1) NOT NULL,
  `rejeitado_xml` tinyint(1) NOT NULL,
  `cancelado_xml` tinyint(1) NOT NULL,
  `inutilizado_xml` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tab_adm`
--
ALTER TABLE `tab_adm`
  ADD PRIMARY KEY (`id_adm`);

--
-- Indexes for table `tab_cfop`
--
ALTER TABLE `tab_cfop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tab_cliente`
--
ALTER TABLE `tab_cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indexes for table `tab_emitente`
--
ALTER TABLE `tab_emitente`
  ADD PRIMARY KEY (`id_emitente`);

--
-- Indexes for table `tab_entrega`
--
ALTER TABLE `tab_entrega`
  ADD PRIMARY KEY (`id_entrega`);

--
-- Indexes for table `tab_fatura`
--
ALTER TABLE `tab_fatura`
  ADD PRIMARY KEY (`id_fatura`);

--
-- Indexes for table `tab_item_nfe`
--
ALTER TABLE `tab_item_nfe`
  ADD PRIMARY KEY (`id_item`);

--
-- Indexes for table `tab_log_estoque`
--
ALTER TABLE `tab_log_estoque`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `tab_nfe`
--
ALTER TABLE `tab_nfe`
  ADD PRIMARY KEY (`id_nfe`);

--
-- Indexes for table `tab_nref`
--
ALTER TABLE `tab_nref`
  ADD PRIMARY KEY (`id_nref`);

--
-- Indexes for table `tab_op`
--
ALTER TABLE `tab_op`
  ADD PRIMARY KEY (`id_op`);

--
-- Indexes for table `tab_ordem`
--
ALTER TABLE `tab_ordem`
  ADD PRIMARY KEY (`id_ordem`);

--
-- Indexes for table `tab_produto`
--
ALTER TABLE `tab_produto`
  ADD PRIMARY KEY (`id_produto`);

--
-- Indexes for table `tab_produto_nota`
--
ALTER TABLE `tab_produto_nota`
  ADD PRIMARY KEY (`id_produto_nota`);

--
-- Indexes for table `tab_retirada`
--
ALTER TABLE `tab_retirada`
  ADD PRIMARY KEY (`id_retirada`);

--
-- Indexes for table `tab_transportadora`
--
ALTER TABLE `tab_transportadora`
  ADD PRIMARY KEY (`id_transportadora`),
  ADD KEY `id_transportadora` (`id_transportadora`),
  ADD KEY `id_transportadora_2` (`id_transportadora`),
  ADD KEY `id_transportadora_3` (`id_transportadora`);

--
-- Indexes for table `tab_xml`
--
ALTER TABLE `tab_xml`
  ADD PRIMARY KEY (`id_xml`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tab_adm`
--
ALTER TABLE `tab_adm`
  MODIFY `id_adm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tab_cliente`
--
ALTER TABLE `tab_cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tab_emitente`
--
ALTER TABLE `tab_emitente`
  MODIFY `id_emitente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tab_entrega`
--
ALTER TABLE `tab_entrega`
  MODIFY `id_entrega` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tab_fatura`
--
ALTER TABLE `tab_fatura`
  MODIFY `id_fatura` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tab_item_nfe`
--
ALTER TABLE `tab_item_nfe`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tab_log_estoque`
--
ALTER TABLE `tab_log_estoque`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tab_nfe`
--
ALTER TABLE `tab_nfe`
  MODIFY `id_nfe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tab_nref`
--
ALTER TABLE `tab_nref`
  MODIFY `id_nref` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tab_op`
--
ALTER TABLE `tab_op`
  MODIFY `id_op` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tab_ordem`
--
ALTER TABLE `tab_ordem`
  MODIFY `id_ordem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tab_produto`
--
ALTER TABLE `tab_produto`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;
--
-- AUTO_INCREMENT for table `tab_produto_nota`
--
ALTER TABLE `tab_produto_nota`
  MODIFY `id_produto_nota` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tab_retirada`
--
ALTER TABLE `tab_retirada`
  MODIFY `id_retirada` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tab_transportadora`
--
ALTER TABLE `tab_transportadora`
  MODIFY `id_transportadora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tab_xml`
--
ALTER TABLE `tab_xml`
  MODIFY `id_xml` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
