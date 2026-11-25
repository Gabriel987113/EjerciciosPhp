CREATE DATABASE IF NOT EXISTS notas_exam;
USE notas_exam;

DROP TABLE IF EXISTS notas;
DROP TABLE IF EXISTS alumnos;

CREATE TABLE alumnos (
    cod_alumno VARCHAR(10) PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

CREATE TABLE notas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cod_alumno VARCHAR(10) NOT NULL,
    asignatura VARCHAR(40) NOT NULL,
    nota DECIMAL(4,2) NOT NULL,
    FOREIGN KEY (cod_alumno) REFERENCES alumnos(cod_alumno)
);

INSERT INTO alumnos VALUES ('A001','MARTA LÓPEZ'),('A002','PEDRO RUIZ');
INSERT INTO notas (cod_alumno,asignatura,nota) VALUES
('A001','PHP',7.5),('A001','JavaScript',8),('A002','PHP',4.5);
