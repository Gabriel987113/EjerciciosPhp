CREATE DATABASE IF NOT EXISTS citas_exam;
USE citas_exam;

DROP TABLE IF EXISTS citas;
DROP TABLE IF EXISTS medicos;
DROP TABLE IF EXISTS pacientes;

CREATE TABLE pacientes (
    cod_paciente VARCHAR(10) PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

CREATE TABLE medicos (
    cod_medico VARCHAR(10) PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

CREATE TABLE citas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cod_paciente VARCHAR(10) NOT NULL,
    cod_medico VARCHAR(10) NOT NULL,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    UNIQUE (cod_medico, fecha, hora),
    FOREIGN KEY (cod_paciente) REFERENCES pacientes(cod_paciente),
    FOREIGN KEY (cod_medico) REFERENCES medicos(cod_medico)
);

INSERT INTO pacientes VALUES ('P001','ELENA MARTÍN'),('P002','JORGE SÁNCHEZ');
INSERT INTO medicos VALUES ('M001','DRA. PÉREZ'),('M002','DR. GÓMEZ');
INSERT INTO citas (cod_paciente,cod_medico,fecha,hora)
VALUES ('P002','M001','2026-12-01','10:00:00');
