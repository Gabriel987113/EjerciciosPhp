
<?php
include_once "Usuario.php";
include_once "config.php";

/*
 * Acceso a datos con BD Usuarios y Patrón Singleton.
 * Un único objeto para la clase.
 */
class AccesoDatos
{
    private static $modelo = null;
    private $conexion = null;

    public static function getModelo()
    {
        if (self::$modelo == null) {
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }

    // Constructor privado: Patrón Singleton.
    private function __construct()
    {
        try {
            $dsn = "mysql:host=" . SERVER_DB . ";dbname=usuariosctl;charset=utf8";

            $this->conexion = new PDO($dsn, "root", "");
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error de conexión " . $e->getMessage();
            exit();
        }
    }

    // Cierra la conexión y elimina el objeto Singleton.
    public static function closeModelo()
    {
        if (self::$modelo != null) {
            self::$modelo->conexion = null;
            self::$modelo = null;
        }
    }

    // 1. Devuelve todos los usuarios.
    public function getUsuarios(): array
    {
        // Preparamos la consulta para obtener todos los usuarios.
        $consultaUsuarios = "SELECT * FROM Usuarios";

        $buscarUsuarios = $this->conexion->prepare($consultaUsuarios);

        // Ejecutamos la consulta.
        $buscarUsuarios->execute();

        // Recogemos todas las filas como arrays asociativos.
        $resultados = $buscarUsuarios->fetchAll(PDO::FETCH_ASSOC);

        // Creamos un array vacío para guardar los objetos Usuario.
        $usuarios = [];

        // Recorremos todas las filas encontradas.
        foreach ($resultados as $fila) {

            // Creamos un objeto Usuario con los datos de esa fila.
            $usuario = new Usuario(
                $fila["nombre"],
                $fila["login"],
                $fila["password"],
                $fila["comentario"],
                $fila["bloqueo"],
                $fila["saldo"]
            );

            // Guardamos el objeto en el array.
            $usuarios[] = $usuario;
        }

        // Devolvemos el array de usuarios.
        return $usuarios;
    }

    // 2. Devuelve un usuario según su login.
    public function getUsuario($login)
    {
        // Preparamos la consulta para buscar un usuario.
        $consultaUsuario = "SELECT * FROM Usuarios WHERE login = :login";

        $buscarUsuario = $this->conexion->prepare($consultaUsuario);

        // Sustituimos :login por el login recibido.
        $buscarUsuario->execute([
            ':login' => $login
        ]);

        // Recogemos la fila encontrada.
        $fila = $buscarUsuario->fetch(PDO::FETCH_ASSOC);

        // Si no existe el usuario, devolvemos false.
        if ($fila == false) {
            return false;
        }

        // Creamos el objeto Usuario.
        $usuario = new Usuario(
            $fila["nombre"],
            $fila["login"],
            $fila["password"],
            $fila["comentario"],
            $fila["bloqueo"],
            $fila["saldo"]
        );

        return $usuario;
    }

    // 3. Modifica un usuario.
    public function modUsuario($user): bool
    {
        // Preparamos la consulta UPDATE.
        $consultaModificar = "UPDATE Usuarios
        SET nombre = :nombre,
            password = :password,
            comentario = :comentario,
            bloqueo = :bloqueo,
            saldo = :saldo
        WHERE login = :login";

        $modificarUsuario = $this->conexion->prepare($consultaModificar);

        // Sustituimos los parámetros por los datos del usuario.
        $modificarUsuario->execute([
            ':nombre' => $user->nombre,
            ':password' => $user->password,
            ':comentario' => $user->comentario,
            ':bloqueo' => $user->bloqueo,
            ':saldo' => $user->saldo,
            ':login' => $user->login
        ]);

        // Comprobamos si se ha modificado alguna fila.
        // Comprobamos si se ha modificado exactamente una fila.
        if ($modificarUsuario->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }

   // 4. Inserta un usuario nuevo.
public function addUsuario($user): bool
{
    // Preparamos la consulta INSERT.
    $consultaCrear = "INSERT INTO Usuarios
    (login, nombre, password, comentario, bloqueo, saldo)
    VALUES (:login, :nombre, :password, :comentario, :bloqueo, :saldo)";

    $crearUsuario = $this->conexion->prepare($consultaCrear);

    // Sustituimos los parámetros por los datos del usuario.
    $crearUsuario->execute([
        ':login' => $user->login,
        ':nombre' => $user->nombre,
        ':password' => $user->password,
        ':comentario' => $user->comentario,
        ':bloqueo' => $user->bloqueo,
        ':saldo' => $user->saldo
    ]);

    // Comprobamos si se ha insertado una fila.
    if ($crearUsuario->rowCount() == 1) {
        return true;
    } else {
        return false;
    }
}

    // 5. Elimina un usuario según su login.
    public function borrarUsuario($login): bool
    {
        // Preparamos la consulta DELETE.
        $consultaBorrar = "DELETE FROM Usuarios WHERE login = :login";

        $borrarUsuario = $this->conexion->prepare($consultaBorrar);

        // Sustituimos :login por el login recibido.
        $borrarUsuario->execute([
            ':login' => $login
        ]);

        // Comprobamos si se ha eliminado una fila.
        $resultado = ($borrarUsuario->rowCount() == 1);

        return $resultado;
    }

    // 6 . INCREMENTAR SALDO UN 10% DE LOS USUARIOS MARCADOS
    public function incrementarSaldo($login)
    {

        $consultaIncrementarSaldo = "UPDATE Usuarios
    SET saldo = saldo + (saldo*0.10)
    WHERE login = :login";

        $aumentarSaldo = $this->conexion->prepare($consultaIncrementarSaldo);

        $aumentarSaldo->execute([
            ':login' => $login
        ]);
        if ($aumentarSaldo->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function actualizarBloqueos($login)
    {

        $consultaBloquearUsuario = "UPDATE Usuarios
    SET BLOQUEO=1 - bloqueo
    WHERE login = :login";

        $actualizarBloqueos = $this->conexion->prepare($consultaBloquearUsuario);

        $actualizarBloqueos->execute([
            ':login' => $login
        ]);

        // Comprobamos si se ha actualizado una fila.
        if ($actualizarBloqueos->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }


    // Evitamos que se pueda clonar el objeto Singleton.
    public function __clone()
    {
        trigger_error('La clonación no permitida', E_USER_ERROR);
    }
}
