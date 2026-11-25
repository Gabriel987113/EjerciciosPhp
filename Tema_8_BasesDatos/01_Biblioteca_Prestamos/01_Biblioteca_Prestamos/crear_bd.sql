CREATE DATABASE IF NOT EXISTS biblioteca_exam;
USE biblioteca_exam;

DROP TABLE IF EXISTS prestamos;
DROP TABLE IF EXISTS libros;
DROP TABLE IF EXISTS socios;

CREATE TABLE socios (
    cod_socio VARCHAR(10) PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

CREATE TABLE libros (
    cod_libro VARCHAR(10) PRIMARY KEY,
    titulo VARCHAR(60) NOT NULL,
    ejemplares INT NOT NULL
);

CREATE TABLE prestamos (
    id_prestamo INT AUTO_INCREMENT PRIMARY KEY,
    cod_socio VARCHAR(10) NOT NULL,
    cod_libro VARCHAR(10) NOT NULL,
    fecha DATE NOT NULL,
    FOREIGN KEY (cod_socio) REFERENCES socios(cod_socio),
    FOREIGN KEY (cod_libro) REFERENCES libros(cod_libro)
);

INSERT INTO socios VALUES
('S001','ANA GARCÍA'), ('S002','LUIS PÉREZ');

INSERT INTO libros VALUES
('L001','PHP básico',2), ('L002','JavaScript',0), ('L003','Bases de datos',1);
