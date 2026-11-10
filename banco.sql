CREATE DATABASE IF NOT EXISTS RESTAURANT;

USE RESTAURANT;

CREATE TABLE ACCOUNT (
    ID_ACCOUNT INT AUTO_INCREMENT PRIMARY KEY,
    NAME_ACCOUNT VARCHAR(100)  NULL,
    EMAIL_ACCOUNT VARCHAR(200) NULL ,
    PASSWORD_ACCOUNT VARCHAR(255) NULL,
    TYPE_ACCOUNT ENUM ('WORKER', 'CLIENT') NOT NULL DEFAULT 'CLIENT'
);

CREATE TABLE CLIENT (
    ID_CLIENT INT AUTO_INCREMENT PRIMARY KEY,
    NAME_CLIENT VARCHAR(100) NULL,
    CPF_CLIENT VARCHAR(11) NULL,
    NUMBER_CLIENT VARCHAR(11) NULL,
    PHOTO_CLIENT VARCHAR(255) NULL,  
    ID_ACCOUNT_FK INT, 
    FOREIGN KEY (ID_ACCOUNT_FK) REFERENCES ACCOUNT (ID_ACCOUNT) ON DELETE CASCADE
);

CREATE TABLE WORKER (
    ID_WORKER INT AUTO_INCREMENT PRIMARY KEY,
    NAME_WORKER VARCHAR(100) NULL,
    REGISTRATION_WORKER VARCHAR(6) NULL,
    ROLE_WORKER VARCHAR(100) NULL,
    PHOTO_WORKER VARCHAR(255) NULL,
    ID_ACCOUNT_FK INT, 
    FOREIGN KEY (ID_ACCOUNT_FK) REFERENCES ACCOUNT (ID_ACCOUNT) ON DELETE CASCADE
);

CREATE TABLE CATEGORY (
    ID_CATEGORY INT AUTO_INCREMENT PRIMARY KEY,
    NAME_CATEGORY VARCHAR(100) NOT NULL
);

CREATE TABLE PRODUCT (
    ID_PRODUCT INT AUTO_INCREMENT PRIMARY KEY,
    NAME_PRODUCT VARCHAR(100) NOT NULL,
    DESCRIPTION_PRODUCT VARCHAR(100) NOT NULL,
    PRICE_PRODUCT DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    PHOTO_PRODUCT VARCHAR(255) NOT NULL,
    STOCK_PRODUCT INT NOT NULL DEFAULT 0,
    ID_CATEGORY_FK INT,
    FOREIGN KEY (ID_CATEGORY_FK) REFERENCES CATEGORY (ID_CATEGORY) 
   
);


-- ARRAY DE CATEGORIAS 

INSERT INTO CATEGORY(NAME_CATEGORY) VALUES 
('Bebidas'),      -- 1
('Entradas'),   -- 2
('Pratos'), -- 3
('Para comer de galera'), -- 4
('Lanches'), -- 5
("Sobremesas"); 


-- ARRAY DE PRODUTOS INICIAIS PARA NÃO COMEÇAR O SISTEMA COMO O MENU VAZIO

INSERT INTO PRODUCT
(NAME_PRODUCT, DESCRIPTION_PRODUCT, PRICE_PRODUCT, PHOTO_PRODUCT, ID_CATEGORY_FK)
VALUES
-- 1. BEBIDAS
('Suco de Fruta Tradicional', 'Suco Natural de : Abacaxi, Laranja, Limão. Maracujá ou Morango', 15.00, 'assets/images/products/suco.jpg', 1),
('Suco de Cajá', 'Suco natural de cajá servido gelado.', 9.00, 'assets/images/products/suco-caja.jpg', 1),
('Suco de Graviola', 'Suco natural e cremoso de graviola.', 10.00, 'assets/images/products/suco-graviola.jpg', 1),
('Caldo de Cana', 'Caldo de cana natural e refrescante.', 7.00, 'assets/images/products/caldo-cana.jpg', 1),
('Água de Coco', 'Água de coco natural.', 8.00, 'assets/images/products/agua-coco.jpg', 1),
('Refrigerante', 'Refrigerante em lata de 350ml.', 6.00, 'assets/images/products/refrigerante.jpg', 1),

-- 2. ENTRADAS
('Macaxeira Frita', 'Macaxeira frita crocante por fora.', 22.00, 'assets/images/products/mandioca.jpg', 2),
('Dadinho de Tapioca', 'Dadinho de tapioca com queijo coalho.', 26.00, 'assets/images/products/dadinho.jpg', 2),
('Queijo Coalho', 'Espetinhos de queijo coalho grelhados.', 20.00, 'assets/images/products/queijo.jpg', 2),
('Bolinho de Macaxeira', 'Bolinho de macaxeira com carne de sol.', 25.00, 'assets/images/products/bolinho.jpg', 2),
('Calabresa Acebolada', 'Calabresa frita com cebola.', 28.00, 'assets/images/products/linguica.jpg', 2),

-- 3. PRATOS
('Baião de Dois', 'Arroz, feijão-de-corda e queijo coalho.', 32.00, 'assets/images/products/baião.jpg', 3),
('Carne de Sol Completa', 'Carne de sol, macaxeira e baião de dois.', 45.00, 'assets/images/products/carne-sol.webp', 3),
('Escondidinho', 'Purê de macaxeira com carne de sol.', 36.00, 'assets/images/products/escondidinho.jpg', 3),
('Arrumadinho', 'Feijão-verde, carne de sol e farofa.', 38.00, 'assets/images/products/arrumadinho.jpg', 3),
('Rubacão', 'Arroz, feijão-verde, queijo coalho e nata.', 35.00, 'assets/images/products/rubacão.webp', 3),
('Moqueca de Peixe', 'Peixe ao leite de coco e azeite de dendê.', 48.00, 'assets/images/products/moqueca.jpg', 3),

-- 4. PARA COMER DE GALERA
('Combo Nordestino', 'Carne de sol, macaxeira e queijo coalho.', 65.00, 'assets/images/products/combonordestino.jpg', 4),
('Porção de Carne de Sol', 'Carne de sol acebolada para compartilhar.', 55.00, 'assets/images/products/carne-sol.webp', 4),
('Porção de Pastéis', 'Pastéis variados com recheios regionais.', 35.00, 'assets/images/products/PorcaoPastel.webp', 4),
('Porção Mista', 'Macaxeira, calabresa e queijo coalho.', 48.00, 'assets/images/products/mista.jpg', 4),

-- 5. LANCHES
('X-Burguer Nordestino', 'Hambúrguer com queijo coalho e carne de sol.', 28.00, 'assets/images/products/xnordeste.jpg', 5),
('Sanduíche de Carne de Sol', 'Carne de sol desfiada com queijo coalho.', 25.00, 'assets/images/products/sanduicheCarneSeca.jpg', 5),
('Cuscuz Recheado', 'Cuscuz nordestino recheado com carne de sol.', 22.00, 'assets/images/products/cuscuz.jpg', 5),
('Tapioca de Queijo', 'Tapioca recheada com queijo coalho.', 16.00, 'assets/images/products/tapioca.jpg', 5),

-- 6. SOBREMESAS
('Cartola', 'Banana frita, queijo coalho e canela.', 18.00, 'assets/images/products/cartola.jpg', 6),
('Bolo de Rolo', 'Bolo pernambucano recheado com goiabada.', 14.00, 'assets/images/products/boloRolo.webp', 6),
('Cocada Cremosa', 'Doce cremoso de coco.', 12.00, 'assets/images/products/cocada.jpg', 6),
('Pudim de Tapioca', 'Pudim de tapioca com calda de caramelo.', 16.00, 'assets/images/products/pudimTapioca.webp', 6),
('Mousse de Maracujá', 'Mousse cremosa de maracujá.', 13.00, 'assets/images/products/Mousse.webp', 6);



