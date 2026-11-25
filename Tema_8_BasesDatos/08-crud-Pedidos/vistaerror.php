<?php
/*
vistapedidos.php será la vista que mostrará
toda la información del cliente después de iniciar sesión correctamente.
*/
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Error de acceso</title>
</head>
<body>

    <h2>Error de acceso</h2>

    <p><?php echo $mensaje; ?></p>

    <p>Volviendo al formulario de acceso...</p>

    <meta http-equiv="refresh" content="4;url=acceso.html">

</body>
</html>
