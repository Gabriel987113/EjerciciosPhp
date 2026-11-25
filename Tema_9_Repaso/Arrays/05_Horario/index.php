<?php
$horario = [
 "Lunes"=>["PHP","Bases de datos","Inglés"],
 "Martes"=>["JavaScript","PHP"],
 "Miércoles"=>["Inglés","Sistemas","JavaScript"],
 "Jueves"=>["Bases de datos"],
 "Viernes"=>["PHP","Sistemas"]
];
$dia = $_GET["dia"] ?? ""; $mensaje = "";
if ($dia !== "") {
    if (isset($horario[$dia])) {
        $huecos = 3 - count($horario[$dia]);
        $mensaje = $huecos > 0 ? "Tiene $huecos hueco(s) libre(s)." : "Día completo.";
    } else $mensaje = "Día no encontrado.";
}
?>
<!doctype html><html lang="es"><meta charset="utf-8"><body><h1>Horario</h1>
<form><select name="dia"><option value="">Elige día</option>
<?php foreach (array_keys($horario) as $d): ?><option value="<?= $d ?>"><?= $d ?></option><?php endforeach; ?>
</select><button>Consultar</button></form>
<?php if (isset($horario[$dia])): ?><ul><?php foreach ($horario[$dia] as $clase): ?><li><?= htmlspecialchars($clase) ?></li><?php endforeach; ?></ul><?php endif; ?>
<p><?= htmlspecialchars($mensaje) ?></p></body></html>