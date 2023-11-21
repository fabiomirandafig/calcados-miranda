-- Trabalho de INF 321 - WEB
-- Nome: Fábio Miranda Figueiredo
-- Matrícula 92550
-- Script SQL para criação do banco de dados

-- Banco de dados: `calcadosmiranda`

CREATE SEQUENCE public.order_id_seq
  START WITH 1
  INCREMENT BY 1
  NO MINVALUE
  NO MAXVALUE
  CACHE 1;

-- --------------------------------------------------------
-- Definição da tabela `cliente`
CREATE TABLE public.cliente (
  id_cliente integer DEFAULT nextval('public.order_id_seq'::regclass) NOT NULL,
  nome character varying NOT NULL,
  sobrenome character varying NOT NULL,
  CPF character varying NOT NULL,
  email character varying NOT NULL,
  senha character varying NOT NULL,
  celular character varying NOT NULL,
  endereco character varying NOT NULL,
  cidade character varying NOT NULL,
  estado character varying NOT NULL
);

ALTER TABLE ONLY public.cliente
  ADD CONSTRAINT cliente_pkey PRIMARY KEY (id_cliente);

-- Adicionando dados na tabela `cliente`
INSERT INTO cliente (nome, sobrenome, CPF, email, senha, celular, endereco, cidade, estado) VALUES
('Joao', 'Martins', '14834592457','joao@gmail.com', '25f9e794323b453885f5181f1b624d0b', '31943518345', 'Avenida Santa Rita', 'Vicosa', 'Minas Gerais'),
('Filipe', 'Reis','24582904581','filipe@gmail.com','25f9e794323b453885f5181f1b624d0b', '31987964721', 'Avenida Armando Fajardo', 'Joao Monlevade', 'Minas Gerais'),
('Eduarda', 'Miranda','3517489905','duda@gmail.com','25f9e794323b453885f5181f1b624d0b', '31964534581', 'Rua Margarida', 'Belo Horizonte', 'Minas Gerais');

----------------------------------------------------------
-- Definição da tabela `usuario_admin`
CREATE type tipo_ativo as enum('0', '1');

CREATE TABLE public.usuario_admin (
  id_admin integer DEFAULT nextval('public.order_id_seq'::regclass) NOT NULL,
  nome character varying NOT NULL,
  email character varying UNIQUE,
  senha character varying NOT NULL,
  ativo tipo_Ativo NOT NULL DEFAULT '0'
);

ALTER TABLE ONLY public.usuario_admin
  ADD CONSTRAINT usuario_admin_pkey PRIMARY KEY (id_admin);

-- Adicionando dados na tabela `usuario_admin`
INSERT INTO usuario_admin (nome, email, senha, ativo) VALUES
('Fabio', 'fabioadmin@gmail.com', '$2y$10$qZ0OoyX8bhAVxDFM/fx8leZSZwlyq15c1C/KTnaqDLSx6eCDJ0VpC', '0'),
('Alex', 'alexadmin@gmail.com', '$2y$10$YKSDtra7v2wH6ORYfry8Ue9t49pk1AvQvdJGuq4lDvFLEcx.kP6Mq', '0');

----------------------------------------------------------
-- Definição da tabela `marcas`
CREATE TABLE public.marcas (
  marca_id integer DEFAULT nextval('public.order_id_seq'::regclass) NOT NULL,
  nome_marca text NOT NULL
);

ALTER TABLE ONLY public.marcas
  ADD CONSTRAINT marcas_pkey PRIMARY KEY (marca_id); 

-- Adicionando dados na tabela `marcas`
INSERT INTO marcas (nome_marca) VALUES
('Adidas'),
('Nike'),
('Puma'),
('Converse'),
('NewBalance'),
('Vans'),
('Wesco'),
('Grenson'),
('Havaianas'),
('Ipanema'),
('Umbro'),
('Flen'),
('Oxford'),
('Gatza'),
('Arezzo');

-- --------------------------------------------------------
-- Definição da tabela `categorias`
CREATE TABLE public.categorias (
  categoria_id integer DEFAULT nextval('public.order_id_seq'::regclass) NOT NULL,
  nome_categoria text NOT NULL
);

ALTER TABLE ONLY public.categorias
  ADD CONSTRAINT categorias_pkey PRIMARY KEY (categoria_id); 

-- Adicionando dados na tabela `categorias`
INSERT INTO categorias(nome_categoria) VALUES
('Tenis'),
('Tenis esportivo'),
('Chuteira'),
('Bota'),
('Chinelo'),
('Sapato Social');
-- --------------------------------------------------------
-- Definição da tabela `calcado`
CREATE TABLE public.calcado (
  calcado_id integer DEFAULT nextval('public.order_id_seq'::regclass) NOT NULL,
  calcado_categoria integer NOT NULL,
  calcado_marca integer NOT NULL, 
  calcado_nome character varying,
  calcado_preco double precision NOT NULL,
  calcado_quantidade integer NOT NULL, 
  calcado_descricao text NOT NULL,
  calcado_imagem text NOT NULL,
  calcado_palavraschave text NOT NULL
);

ALTER TABLE ONLY public.calcado
  ADD CONSTRAINT calcado_pkey PRIMARY KEY (calcado_id);
  
ALTER TABLE ONLY public.calcado
  ADD CONSTRAINT fk_calcado_categoria FOREIGN KEY (calcado_categoria) REFERENCES public.categorias(categoria_id);

ALTER TABLE ONLY public.calcado
  ADD CONSTRAINT fk_calcado_marca FOREIGN KEY (calcado_marca) REFERENCES public.marcas(marca_id);

-- Adicionando dados na tabela `calcado`
INSERT INTO calcado (calcado_categoria, calcado_marca, calcado_nome, calcado_preco, calcado_quantidade, calcado_descricao, calcado_imagem, calcado_palavraschave) VALUES
(22, 6, 'Tênis Adidas Pureboost 21', 621, 4, 'Tenis Adidas de algodão destinado para adultos, unissex, com cadarço e possui palmilha anti-odor', 'tenis-adidas-pureboost-21-masculino-img.jpg', 'tenis, adidas, pureboost'),
(21, 9, 'Tênis Cano Alto Converse All Star Chuck Taylor', 240, 14, 'Tenis All Star casual feminino de cor amarela, com cadarço e não possui palmilha anti-odor', 'tenis-cano-alto-converse-all-star-chuck-taylor-adulto.jpg', 'tenis, cano, all, star, converse'),
(25, 14, 'Chinelo Star Wars Havaianas', 29, 7, 'Chinelo para crianças e unissex', 'chinelo-star-wars.jpg', 'chinelo, hawaianas'),
(21, 6, 'Tênis Adidas Grand Court Base', 160, 3, 'Tenis Adidas feminino de velcro e com amortecedor de impacto', 'tenis-adidas-branco.jpg', 'tenis, adidas, branco'),
(23, 7, 'Chuteira Campo Nike Superfly 8 Academy', 550, 10, 'Chuteira Nike Mercurial ideal para jogar em campo, masculina, com cadarço e palmilha anti-odor', 'mercurial-nike.jpg', 'chuteira, nike, azul, campo, mercurial'),
(21, 7, 'Tênis Nike Court Vision Mid', 875, 2, 'Tenis Nike masculino ideal para sair a noite, com cadarço e unissex', 'tenis-nike-court-vision-mid-DM.jpg', 'tenis, nike, vision, azul'),
(25, 15, 'Sandália de dedo Ipanema Recria Easy', 23, 13, 'Sandalia de dedo ideal para usar dentro de casa e pequenas caminhadas, feminina e muito confortável', 'chinelo-ipanema.jpg', 'chinelo, ipanema'),
(22, 8, 'Tênis Puma Flyer Runner Bdp', 199, 12, 'Tenis Puma para corrida feito de algodão, masculino, com cadarço, amortecedor de impacto e palmilha anti-odor', 'NWG-2642-128_zoom1.jpg', 'tenis, puma, runner,flyer'),
(23, 16, 'Chuteira Futsal Umbro Class IC', 88, 8, 'Chuteira Futsal Umbro unissex destinada para crianças, de couro, com cadarço e palmilha anti-odor', 'chuteira-futsal-umbro-class-ic-adulto-img.jpg', 'chuteira, umbro, quadra, preta'),
(26, 19, 'Sapato Louise', 215, 14, 'Sapato de luxo Louise feminino de velcro', 'sandalia-louise-2.jpg', 'sapato, social, feminino'),
(26, 17, 'Sapato Derby Marrom', 518, 7, 'Sapato Marrom masculino derby ideal para ocasioes especiais, de couro e velcro', 'sapato-flen.jpg', 'sapato, social, masculino'),
(26, 20, 'Scarpin Couro Salto Bloco Baixo Preto', 334, 5, 'Sapato de luxo, couro, feminino ideal para ocasioes especiais e muito confortavel', 'sapato-arezzo.jpg', 'sapato, social, feminino,arezzo'),
(24, 13, 'Bota Masculina Ken Brown', 412, 9, 'Bota masculina marrom de couro, com cadarço e ideal para sair a noite', 'Brunello-Cucinelli-1024x683.jpg', 'bota, greson, marrom, masculina'),
(24, 12, 'Bota Nanette', 3864, 1, 'Bota de couro de luxo feminina', 'bota-cara.jpg', 'bota, preta, feminina, nanette'),
(21, 11, 'Tênis Ultrarange Rapidweld', 499, 21, 'Tenis casual roxo Vans unissex, com cadarço e palmilha anti-odor', 'roxo-vans.jpg', 'tenis, vans, roxo, casual'),
(21, 10, 'Tênis New Balance Sport', 380, 1, 'Tenis casual New Balance de algodão, unissex, com cadarço, amortecedor de impacto e palmilha anti-odor ', 'new-balance-yellow.jpg', 'tenis, newbalance, amarelo, casual'),
(22, 10, 'Tênis New Balance Ryval', 754, 3, 'Tenis para corrida New Balance ideal para fazer atividades fisicas, unissex e com amortecedor de impacto', 'newbalance-corrida.jpg', 'tenis, newbalance, preto, laranja, corrida');

----------------------------------------------------------
-- Definição da tabela `item_carrinho`
CREATE TABLE public.item_carrinho (
  item_id integer DEFAULT nextval('public.order_id_seq'::regclass) NOT NULL,
  cliente_id integer NOT NULL,
  calcado_id integer NOT NULL,
  quantidade integer NOT NULL,
  trx_id character varying NOT NULL,
  item_status character varying NOT NULL
);

ALTER TABLE ONLY public.item_carrinho
  ADD CONSTRAINT item_carrinho_pkey PRIMARY KEY (item_id);  

-- Adicionando dados na tabela `item_carrinho`
INSERT INTO item_carrinho (cliente_id, calcado_id, quantidade, trx_id, item_status) VALUES
(1, 43, 14, '9L434522M7706801A', 'Completed'),
(3, 48, 10, '9L434522M7706801A', 'Completed'),
(2, 46, 7, '9L434522M7706801A', 'Completed'),
(3, 55, 5, '8AT7125245323433N', 'Completed'),
(2, 58, 21, '8AT7125245323433N', 'Completed'),
(1, 54, 7, '8AT7125245323433N', 'Completed');

----------------------------------------------------------
-- Definição da tabela `carrinho`
CREATE TABLE public.carrinho (
  carrinho_id integer DEFAULT nextval('public.order_id_seq'::regclass) NOT NULL,
  calcado_id integer NOT NULL,
  ip_add character varying NOT NULL,
  cliente_id integer NOT NULL,
  quantidade integer NOT NULL,
  tipo_embalagem character varying NOT NULL
);

ALTER TABLE ONLY public.carrinho
  ADD CONSTRAINT carrinho_pkey PRIMARY KEY (carrinho_id);

-- Adicionando dados na tabela `carrinho`
INSERT INTO carrinho (calcado_id, ip_add, cliente_id, quantidade, tipo_embalagem) VALUES
(46, '::1', 2, 7,'Caixa de papelao'),
(55, '::1', 3, 5,'Embalagem de isopor'),
(45, '::1', 1, 14,'Caixa de papelao'),
(58, '::1', 2, 21,'Emabalagem de plastico');

----------------------------------------------------------
-- Definição da tabela `estoque`
CREATE TABLE public.estoque (
  estoque_id integer DEFAULT nextval('public.order_id_seq'::regclass) NOT NULL,
  calcado_id integer NOT NULL,
  quantidade_estoque integer NOT NULL
);

ALTER TABLE ONLY public.estoque
  ADD CONSTRAINT estoque_pkey PRIMARY KEY (estoque_id); 

-- Adicionando dados na tabela `estoque`
INSERT INTO estoque(calcado_id, quantidade_estoque) VALUES
(53, 5),
(48, 4),
(51, 8),
(43, 3),
(50, 9);

----------------------------------------------------------
-- Definição da tabela `pagamento`
CREATE TABLE public.pagamento (
  pagamento_id integer DEFAULT nextval('public.order_id_seq'::regclass) NOT NULL,
  cliente_id integer NOT NULL,
  descricao text NOT NULL,
  tipo_pagamento character varying NOT NULL,
  valor integer NOT NULL,
  data_transacao date NOT NULL,
  hora_transacao character varying NOT NULL
);

ALTER TABLE ONLY public.pagamento
  ADD CONSTRAINT pagamento_pkey PRIMARY KEY (pagamento_id);   

-- Adicionando dados na tabela `pagamento`
INSERT INTO pagamento(cliente_id, descricao, tipo_pagamento, valor, data_transacao, hora_transacao) VALUES
(1,'Pagamento referente a compra do Tênis Adidas Pureboost 21', 'Cartão de crédito', 621, '2022/03/01','18:54'),
(2,'Pagamento referente a compra do Tênis Cano Alto Converse All Star Chuck Taylor', 'Cartão de crédito', 240, '2022/02/07','10:30'),
(3,'Pagamento referente a compra da Chuteira Campo Nike Superfly 8 Academy', 'Cartão de crédito', 550, '2022/02/10','12:10');
-- --------------------------------------------------------
