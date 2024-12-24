USE brokentimemachine;
-- Tabela de Produtos
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `descricao` TEXT,
  `preco` DECIMAL(10, 2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
-- Inserir Produtos na Tabela
INSERT INTO produtos (nome, descricao, preco)
VALUES 
  ('Gorro', 'Gorro de inverno', 35.00),
  ('Boné', 'Boné de alta qualidade', 30.00),
  ('EP - Call Me by My Name', 'EP musical Call Me by My Name', 20.00);

-- Tabela de Pedidos 
CREATE TABLE IF NOT EXISTS pedidos (
  id INT NOT NULL AUTO_INCREMENT,
  nome_cliente VARCHAR(255) NOT NULL,
  email_cliente VARCHAR(255) NOT NULL,
  telemovel_cliente VARCHAR(15),
  endereco_entrega TEXT NOT NULL,
  preco_total DECIMAL(10, 2) NOT NULl,
  metodo_pagamento VARCHAR(50) NOT NULL,
  data_pedido DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- Tabela de Itens do Pedido (incluindo preco_total_item)
CREATE TABLE IF NOT EXISTS `produtos_pedidos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `pedido_id` INT NOT NULL,
  `produto_id` INT NOT NULL,
  `quantidade` INT NOT NULL,
  `preco_unitario` DECIMAL(10, 2) NOT NULL,
  `preco_total_produto` DECIMAL(10, 2) NOT NULL DEFAULT 0.00,  -- Adicionando a coluna para armazenar o preço total por item
  PRIMARY KEY (`id`),
  KEY `FK_produtos_pedidos_pedidos` (`pedido_id`),
  KEY `FK_produtos_pedidos_produtos` (`produto_id`),
  CONSTRAINT `FK_produtos_pedidos_pedidos` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  CONSTRAINT `FK_produtos_pedidos_produtos` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Tabela de Comentários
CREATE TABLE IF NOT EXISTS `comentarios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `media_id` INT NOT NULL,
  `comentario` TEXT NOT NULL,
  `data_comentario` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_comentarios_media` (`media_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Tabela de Mensagens de Contacto
CREATE TABLE IF NOT EXISTS `mensagens_contacto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `assunto` VARCHAR(255) NOT NULL,
  `mensagem` TEXT NOT NULL,
  `data_envio` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

