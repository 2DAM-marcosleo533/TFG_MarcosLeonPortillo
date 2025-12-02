CREATE DATABASE LeonShopScript;
USING LeonShopScript;

-- USERS (propio de Laravel, solo añadimos campos)
ALTER TABLE users
    ADD saldo DECIMAL(12,2) DEFAULT 0,
    ADD vip BOOLEAN DEFAULT FALSE;


-- MARCA
CREATE TABLE marca (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL UNIQUE
);


-- PRODUCTO
CREATE TABLE producto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vip BOOLEAN DEFAULT FALSE,
    precio DECIMAL(12,2) NOT NULL,
    unidades INT UNSIGNED NOT NULL,
    modelo VARCHAR(30) NOT NULL,
    nombre VARCHAR(30) NOT NULL,
    marca_id INT NOT NULL,
    FOREIGN KEY (marca_id) REFERENCES marca(id) ON DELETE CASCADE,
    UNIQUE (marca_id, modelo)
);


-- DIRECCION
CREATE TABLE direccion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    direccion_envio TEXT NOT NULL,
    direccion_facturacion TEXT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);


-- COMPRA
CREATE TABLE compra (
    id INT AUTO_INCREMENT PRIMARY KEY,
    producto_id INT NOT NULL,
    user_id INT NOT NULL,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    unidades INT NOT NULL,
    importe DECIMAL(12,2) NOT NULL,
    iva DECIMAL(12,2) DEFAULT 0.21,
    FOREIGN KEY (producto_id) REFERENCES producto(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE (fecha, producto_id, user_id)
);


-- COMENTARIO
CREATE TABLE comentario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    producto_id INT NOT NULL,
    texto TEXT NOT NULL,
    valoracion INT NOT NULL CHECK (valoracion BETWEEN 1 AND 5),
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (producto_id) REFERENCES producto(id) ON DELETE CASCADE
);
