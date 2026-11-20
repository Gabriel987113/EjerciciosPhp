

CREATE TABLE productos (
    codigo INT(4) NOT NULL,
    nombre VARCHAR(30) NOT NULL,
    stock INT(5) NOT NULL,
    stock_min INT(5) NOT NULL,
    precio FLOAT NOT NULL,
    PRIMARY KEY (codigo)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO productos (codigo, nombre, stock, stock_min, precio) VALUES
(1001, 'Morcillas', 10, 5, 12),
(1002, 'Chorizo', 30, 5, 12.5),
(1003, 'Chope', 70, 15, 4.5),
(1004, 'Fuet', 5, 25, 2.5),
(1501, 'Lacón', 10, 15, 20.5),
(2001, 'Tocino', 10, 5, 1.5),
(3021, 'Jamón York', 60, 50, 10),
(4201, 'Torreznos', 120, 5, 13.7),
(6001, 'Mortadela', 20, 5, 20.5),
(6002, 'Queso Burgos', 2, 2, 23.15);
