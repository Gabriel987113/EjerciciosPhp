CREATE DATABASE IF NOT EXISTS cursos_exam;
USE cursos_exam;

DROP TABLE IF EXISTS matriculas;
DROP TABLE IF EXISTS cursos;
DROP TABLE IF EXISTS alumnos;

CREATE TABLE alumnos (
    cod_alumno VARCHAR(10) PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

CREATE TABLE cursos (
    cod_curso VARCHAR(10) PRIMARY KEY,
    nombre_curso VARCHAR(60) NOT NULL,
    plazas_max INT NOT NULL,
    plazas_ocupadas INT NOT NULL
);

CREATE TABLE matriculas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cod_alumno VARCHAR(10) NOT NULL,
    cod_curso VARCHAR(10) NOT NULL,
    fecha DATE NOT NULL,
    UNIQUE (cod_alumno, cod_curso),
    FOREIGN KEY (cod_alumno) REFERENCES alumnos(cod_alumno),
    FOREIGN KEY (cod_curso) REFERENCES cursos(cod_curso)
);

INSERT INTO alumnos VALUES ('A001','MARTA LÓPEZ'),('A002','PEDRO RUIZ');
INSERT INTO cursos VALUES
('C01','PHP y PDO',3,2), ('C02','JavaScript',2,2), ('C03','SQL',5,0);
INSERT INTO matriculas (cod_alumno,cod_curso,fecha) VALUES ('A002','C01',CURDATE()),('A001','C02',CURDATE());
