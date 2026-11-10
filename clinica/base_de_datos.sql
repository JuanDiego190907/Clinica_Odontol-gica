CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario VARCHAR(50),
  clave VARCHAR(100)
);
CREATE TABLE pacientes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  documento VARCHAR(20),
  nombre VARCHAR(100),
  telefono VARCHAR(20),
  fecha_nacimiento DATE,
  alergias TEXT
);
CREATE TABLE procedimientos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100),
  precio DECIMAL(10,2)
);
CREATE TABLE historia (
  id INT AUTO_INCREMENT PRIMARY KEY,
  paciente_id INT,
  procedimiento_id INT,
  fecha DATE,
  diente VARCHAR(20),
  observaciones TEXT
);
-- usuario: admin   clave: admin123
INSERT INTO usuarios (usuario, clave) VALUES ('admin', MD5('admin123'));
INSERT INTO procedimientos (nombre, precio) VALUES
('Limpieza dental', 50000), ('Blanqueamiento', 250000), ('Extracción de muela', 80000),
('Extracción de cordal', 150000), ('Tratamiento de conductos', 300000), ('Calza de muela', 90000);
