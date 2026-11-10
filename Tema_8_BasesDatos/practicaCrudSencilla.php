```php
<?php

// ==================================================
// 1. CLASE MODELO (Entidad)
// ==================================================

// Creamos la clase Producto.
// Esta clase representa un producto de nuestra tienda.
class Producto {

    // Propiedades que tendrá cada producto.
    // Corresponden a las columnas de la tabla productos.
    public $id;
    public $nombre;
    public $precio;
    public $stock;

    // Método que devuelve la información del producto.
    public function info() {

        // $this hace referencia al objeto que está utilizando el método.
        // Devolvemos sus propiedades en forma de texto.
        return "[ID: {$this->id}] {$this->nombre} - Precio: {$this->precio}$ (Stock: {$this->stock})";
    }
}


// ==================================================
// 2. CLASE REPOSITORIO (Maneja la lógica PDO)
// ==================================================

// Esta clase contiene los métodos que realizan las consultas a la BD.
class ProductoRepository {

    // Variable privada donde guardaremos la conexión PDO.
    private $pdo;

    // Constructor: se ejecuta automáticamente al crear un objeto.
    // Recibe una conexión PDO como parámetro.
    public function __construct(PDO $pdo) {

        // Guardamos la conexión recibida dentro de la propiedad $pdo.
        // $this->pdo = propiedad de este objeto.
        // $pdo = conexión que hemos recibido.
        $this->pdo = $pdo;
    }


    // --------------------------------------------------
    // CREATE: INSERTAR UN PRODUCTO
    // --------------------------------------------------

    // Recibe un objeto completo de la clase Producto.
    public function crear(Producto $producto) {

        // INSERT INTO = insertar un nuevo registro en la tabla.
        // Indicamos las columnas y los parámetros que recibirán los valores.
        $sql = "INSERT INTO productos (nombre, precio, stock)
                VALUES (:nombre, :precio, :stock)";

        // prepare() prepara la consulta SQL.
        // Se utiliza cuando tenemos parámetros o valores variables.
        $stmt = $this->pdo->prepare($sql);

        // bindValue() relaciona cada parámetro SQL con su valor.
        // Obtenemos los valores de las propiedades del objeto recibido.
        $stmt->bindValue(':nombre', $producto->nombre);
        $stmt->bindValue(':precio', $producto->precio);
        $stmt->bindValue(':stock', $producto->stock);

        // execute() ejecuta la consulta preparada.
        $stmt->execute();

        // lastInsertId() obtiene el ID que MySQL ha generado automáticamente.
        // Lo guardamos dentro de la propiedad id del objeto Producto.
        $producto->id = $this->pdo->lastInsertId();

        // Devolvemos solamente el ID generado.
        return $producto->id;
    }


    // --------------------------------------------------
    // READ: OBTENER TODOS LOS PRODUCTOS
    // --------------------------------------------------

    public function obtenerTodos() {

        // SELECT * = seleccionar todas las columnas.
        // FROM productos = obtener los datos de la tabla productos.
        $sql = "SELECT * FROM productos";

        // query() ejecuta directamente una consulta sin parámetros variables.
        $stmt = $this->pdo->query($sql);

        // fetchAll() recupera todos los registros encontrados.
        // PDO::FETCH_CLASS convierte cada registro en un objeto.
        // 'Producto' indica la clase que se utilizará para crear esos objetos.
        // Devuelve un array con todos los objetos Producto.
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Producto');
    }


    // --------------------------------------------------
    // READ: OBTENER UN PRODUCTO POR SU ID
    // --------------------------------------------------

    // Recibe el ID del producto que queremos buscar.
    public function obtenerPorId($id) {

        // SELECT * = seleccionar todas las columnas.
        // WHERE id = :id = buscar el producto cuyo ID coincida.
        $sql = "SELECT * FROM productos WHERE id = :id";

        // prepare() prepara la consulta porque tenemos un parámetro variable.
        $stmt = $this->pdo->prepare($sql);

        // bindValue() relaciona el parámetro :id con la variable $id.
        // PDO::PARAM_INT indica que el valor es un número entero.
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        // execute() ejecuta la consulta preparada.
        $stmt->execute();

        // setFetchMode() indica cómo queremos recuperar el resultado.
        // PDO::FETCH_CLASS convierte el registro en un objeto Producto.
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Producto');

        // fetch() recupera un único registro.
        // Devuelve un objeto Producto o false si no encuentra ninguno.
        return $stmt->fetch();
    }


    // --------------------------------------------------
    // UPDATE: ACTUALIZAR UN PRODUCTO
    // --------------------------------------------------

    // Recibe el objeto Producto completo que queremos modificar.
    public function actualizar(Producto $producto) {

        // UPDATE = modificar un registro de la tabla.
        // SET = indicar los nuevos valores de las columnas.
        // WHERE = indicar qué producto queremos modificar mediante su ID.
        $sql = "UPDATE productos
                SET nombre = :nombre, precio = :precio, stock = :stock
                WHERE id = :id";

        // prepare() prepara la consulta con sus parámetros.
        $stmt = $this->pdo->prepare($sql);

        // Relacionamos cada parámetro SQL con la propiedad correspondiente.
        $stmt->bindValue(':nombre', $producto->nombre);
        $stmt->bindValue(':precio', $producto->precio);
        $stmt->bindValue(':stock', $producto->stock);
        $stmt->bindValue(':id', $producto->id);

        // execute() ejecuta la actualización.
        // Devuelve true si se ejecuta correctamente o false si falla.
        return $stmt->execute();
    }


    // --------------------------------------------------
    // DELETE: ELIMINAR UN PRODUCTO
    // --------------------------------------------------

    // Recibe solamente el ID del producto que queremos eliminar.
    public function eliminar($id) {

        // DELETE FROM = eliminar un registro de la tabla.
        // WHERE id = :id = indica qué producto queremos borrar.
        $sql = "DELETE FROM productos WHERE id = :id";

        // prepare() prepara la consulta con el parámetro :id.
        $stmt = $this->pdo->prepare($sql);

        // Relacionamos :id con el ID recibido.
        // PDO::PARAM_INT indica que es un número entero.
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        // execute() ejecuta el borrado.
        $stmt->execute();

        // rowCount() devuelve el número de filas afectadas.
        // En este caso, indica cuántos productos se han eliminado.
        return $stmt->rowCount();
    }
}


// ==================================================
// 3. SCRIPT PRINCIPAL
// ==================================================

// --------------------------------------------------
// A. CONFIGURACIÓN Y CONEXIÓN
// --------------------------------------------------

// DSN = indica el tipo de base de datos, servidor,
// nombre de la base de datos y codificación.
$dsn = 'mysql:host=localhost;dbname=tienda_demo;charset=utf8mb4';

// Usuario y contraseña de MySQL.
$user = 'root';
$pass = '';

try {

    // new PDO() crea la conexión entre PHP y MySQL.
    // Le pasamos el DSN, el usuario y la contraseña.
    $pdo = new PDO($dsn, $user, $pass);

    // Configuramos PDO para que lance excepciones si ocurre un error.
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Creamos un objeto de la clase ProductoRepository.
    // Le pasamos la conexión PDO para que pueda realizar consultas.
    $repo = new ProductoRepository($pdo);


    // --------------------------------------------------
    // B. CREATE: CREAR UN PRODUCTO
    // --------------------------------------------------

    // Creamos un objeto nuevo de la clase Producto.
    $nuevoProd = new Producto();

    // Asignamos valores a las propiedades del objeto.
    $nuevoProd->nombre = "Teclado Mecánico";
    $nuevoProd->precio = 59.99;
    $nuevoProd->stock = 10;

    // Llamamos al método crear() y le pasamos el objeto completo.
    // El método inserta sus datos en la tabla.
    // Devuelve el ID generado automáticamente.
    // Guardamos ese ID en la variable $idGenerado.
    $idGenerado = $repo->crear($nuevoProd);

    // Mostramos el inicio del ejercicio.
    echo "--- Inicio del CRUD ---<br><br>";

    // Llamamos al método info() para mostrar los datos del producto.
    echo "Producto creado: " . $nuevoProd->info() . "<br><br>";


    // --------------------------------------------------
    // C. READ: LISTAR TODOS LOS PRODUCTOS
    // --------------------------------------------------

    // Llamamos a obtenerTodos().
    // Devuelve un array con todos los objetos Producto de la BD.
    $lista = $repo->obtenerTodos();

    // Mostramos el título de la lista.
    echo "<strong>Lista de productos:</strong><br>";

    // foreach recorre el array de productos.
    // $p representa cada objeto Producto en cada vuelta.
    foreach ($lista as $p) {

        // Mostramos la información del producto actual.
        echo "- " . $p->info() . "<br>";
    }

    echo "<br>";


    // --------------------------------------------------
    // D. UPDATE: MODIFICAR UN PRODUCTO
    // --------------------------------------------------

    // Buscamos el producto utilizando el ID que guardamos antes.
    // obtenerPorId() devuelve el objeto Producto completo.
    $prodParaEditar = $repo->obtenerPorId($idGenerado);

    // Comprobamos que el producto exista.
    if ($prodParaEditar) {

        // Modificamos las propiedades del objeto.
        $prodParaEditar->precio = 45.00;
        $prodParaEditar->stock = 9;

        // Pasamos el objeto completo al método actualizar().
        // Este método guarda los nuevos valores en la base de datos.
        $repo->actualizar($prodParaEditar);

        // Mostramos un mensaje de confirmación.
        echo "Producto actualizado (Nuevo precio: 45.00$).<br>";
    }


    // --------------------------------------------------
    // E. READ: COMPROBAR LA MODIFICACIÓN
    // --------------------------------------------------

    // Volvemos a buscar el producto por su ID.
    // Así recuperamos los datos que están guardados en la BD.
    $prodVerificado = $repo->obtenerPorId($idGenerado);

    // Mostramos la información actualizada.
    echo "Verificación: " . $prodVerificado->info() . "<br><br>";


    // --------------------------------------------------
    // F. DELETE: ELIMINAR EL PRODUCTO
    // --------------------------------------------------

    // Llamamos al método eliminar() y le pasamos solamente el ID.
    // El método elimina el registro completo que coincide con ese ID.
    // Devuelve el número de filas eliminadas.
    $filas = $repo->eliminar($idGenerado);

    // Comprobamos si se ha eliminado algún registro.
    if ($filas > 0) {

        // Si se ha eliminado al menos una fila, mostramos el mensaje.
        echo "Producto eliminado correctamente.";
    }


} catch (PDOException $e) {

    // Si ocurre un error relacionado con PDO,
    // se ejecuta este bloque en lugar de detener el programa.
    // getMessage() obtiene la descripción del error.
    echo "Error Grave: " . $e->getMessage();
}


// Cerramos la conexión liberando la referencia al objeto PDO.
$pdo = null;

?>
```