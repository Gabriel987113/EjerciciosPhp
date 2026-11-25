CREATE DATABASE IF NOT EXISTS parking_exam;
USE parking_exam;

DROP TABLE IF EXISTS tickets;

CREATE TABLE tickets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    matricula VARCHAR(12) NOT NULL,
    tipo VARCHAR(10) NOT NULL,
    horas INT NOT NULL,
    importe DECIMAL(7,2) NOT NULL,
    fecha DATETIME NOT NULL
);
