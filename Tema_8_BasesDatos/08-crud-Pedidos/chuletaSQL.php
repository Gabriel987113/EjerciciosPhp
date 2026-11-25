<?php
/*
-- Seleccionar todos los campos
SELECT * FROM clientes;

-- Seleccionar campos concretos
SELECT nombre, clave FROM clientes;

-- Buscar por una condición
SELECT * FROM clientes WHERE cod_cliente = 1002;

-- Buscar por dos condiciones (AND)
SELECT * FROM clientes WHERE nombre = 'eva' AND clave = 'secretoeva';

-- Buscar por una condición u otra (OR)
SELECT * FROM clientes WHERE nombre = 'eva' OR nombre = 'luis33';

-- Ordenar de menor a mayor
SELECT * FROM pedidos ORDER BY precio ASC;

-- Ordenar de mayor a menor
SELECT * FROM pedidos ORDER BY precio DESC;

-- Buscar valores que contengan un texto
SELECT * FROM clientes WHERE nombre LIKE '%eva%';

-- Buscar valores mayores o menores
SELECT * FROM pedidos WHERE precio > 20;
SELECT * FROM pedidos WHERE precio < 30;

-- Buscar valores dentro de un rango
SELECT * FROM pedidos WHERE precio BETWEEN 10 AND 30;

-- Buscar valores que estén dentro de una lista
SELECT * FROM clientes WHERE cod_cliente IN (1001, 1002, 1003);

-- Comprobar valores nulos
SELECT * FROM clientes WHERE clave IS NULL;
SELECT * FROM clientes WHERE clave IS NOT NULL;

2. INSERT – Insertar datos
-- Insertar un registro
INSERT INTO clientes (cod_cliente, nombre, clave, veces)
VALUES (1005, 'ana', '1234', 0);

-- Insertar varios registros
INSERT INTO clientes (cod_cliente, nombre, clave, veces)
VALUES
(1005, 'ana', '1234', 0),
(1006, 'pedro', '5678', 0);

3. UPDATE – Modificar datos
-- Modificar un campo
UPDATE clientes
SET nombre = 'ana'
WHERE cod_cliente = 1001;

-- Modificar varios campos
UPDATE clientes
SET nombre = 'ana', clave = '1234'
WHERE cod_cliente = 1001;

-- Incrementar un campo en 1
UPDATE clientes
SET veces = veces + 1
WHERE cod_cliente = 1002;

-- Decrementar un campo en 1
UPDATE clientes
SET veces = veces - 1
WHERE cod_cliente = 1002;

-- Multiplicar un campo
UPDATE pedidos
SET precio = precio * 2
WHERE numped = 1;

-- Actualizar todos los registros
UPDATE clientes
SET veces = 0;

4. DELETE – Eliminar datos---------------------------------------
-- Eliminar un registro concreto
DELETE FROM clientes
WHERE cod_cliente = 1001;

-- Eliminar todos los registros
DELETE FROM clientes;

-- Eliminar pedidos de un cliente concreto
DELETE FROM pedidos
WHERE cod_cliente = 1002;

5. COUNT, SUM, AVG, MAX y MIN – Funciones de cálculo---------------------
-- Contar registros
SELECT COUNT(*) FROM clientes;

-- Sumar todos los precios
SELECT SUM(precio) FROM pedidos;

-- Calcular la media
SELECT AVG(precio) FROM pedidos;

-- Obtener el precio máximo
SELECT MAX(precio) FROM pedidos;

-- Obtener el precio mínimo
SELECT MIN(precio) FROM pedidos;

7. GROUP BY y HAVING – Agrupar resultados---------------------------
-- Agrupar pedidos por cliente
SELECT cod_cliente, COUNT(*)
FROM pedidos
GROUP BY cod_cliente;

-- Sumar el importe de los pedidos de cada cliente
SELECT cod_cliente, SUM(precio)
FROM pedidos
GROUP BY cod_cliente;

-- Mostrar clientes cuyo importe total supera 50
SELECT cod_cliente, SUM(precio)
FROM pedidos
GROUP BY cod_cliente
HAVING SUM(precio) > 50;

JOIN-------------------------------------------------------
SELECT *
FROM clientes, pedidos
WHERE clientes.cod_cliente = pedidos.cod_cliente
AND clientes.nombre = 'eva';

SELECT *
FROM clientes, pedidos
WHERE clientes.cod_cliente = pedidos.cod_cliente
AND pedidos.precio > 20
AND clientes.nombre = 'eva';

*/


?>