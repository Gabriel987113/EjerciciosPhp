<?php
$productos = [
 "A10"=>["nombre"=>"Cuaderno","precio"=>2.5,"stock"=>12],
 "B20"=>["nombre"=>"Mochila","precio"=>24,"stock"=>4],
 "C30"=>["nombre"=>"Bolígrafo","precio"=>1.2,"stock"=>30]
];
$codigo = $_GET["codigo"] ?? ""; $mensaje = "";
if ($codigo !== "") {
    if (isset($productos[$codigo])) {
        $productos[$codigo]["stock"] += 5;
        $mensaje = "Se han añadido 5 unidades a ".$productos[$codigo]["nombre"];
    } else $mensaje = "Código no encontrado.";
}
?>
<!doctype html><html lang="es"><meta charset="utf-8"><body><h1>Inventario</h1>
<form><input name="codigo" placeholder="Código de producto"><button>Reponer 5 unidades</button></form>
<p><?= htmlspecialchars($mensaje) ?></p><table border="1"><tr><th>Código</th><th>Producto</th><th>Precio</th><th>Stock</th></tr>
<?php foreach ($productos as $cod=>$p): ?><tr><td><?= $cod ?></td><td><?= $p["nombre"] ?></td><td><?= $p["precio"] ?></td><td><?= $p["stock"] ?></td></tr><?php endforeach; ?>
</table></body></html>