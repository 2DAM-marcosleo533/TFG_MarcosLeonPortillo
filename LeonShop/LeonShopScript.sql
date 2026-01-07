CREATE DATABASE leonshopscript;
USE leonshopscript;

-- users
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  saldo DECIMAL(10,2) DEFAULT 0.00
);

-- marcas
CREATE TABLE marcas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(255) NOT NULL
);


-- productos
CREATE TABLE productos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(30) NOT NULL,
  modelo VARCHAR(30) NOT NULL,
  descripcion TEXT NOT NULL,
  tipo VARCHAR(50) NOT NULL,
  precio DECIMAL(12,2) NOT NULL,
  unidades INT NOT NULL,
  marca_id INT NOT NULL,
  FOREIGN KEY (marca_id) REFERENCES marcas(id)
);

-- direcciones
CREATE TABLE direcciones (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  direccion_envio TEXT NOT NULL,
  direccion_facturacion TEXT NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);


-- compras
CREATE TABLE compras (
  id INT AUTO_INCREMENT PRIMARY KEY,
  producto_id INT NOT NULL,
  user_id INT NOT NULL,
  direccion_id INT,
  fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
  unidades INT NOT NULL,
  importe DECIMAL(12,2) NOT NULL,
  FOREIGN KEY (producto_id) REFERENCES productos(id) ON DELETE CASCADE,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (direccion_id) REFERENCES direcciones(id)
);


-- comentarios
CREATE TABLE comentarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  producto_id INT NOT NULL,
  texto TEXT NOT NULL,
  valoracion INT NOT NULL,
  fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (producto_id) REFERENCES productos(id) ON DELETE CASCADE
);
