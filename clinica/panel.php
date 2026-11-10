<?php
include "encabezado.php";
$pacientes = $conexion->query("SELECT COUNT(*) FROM pacientes")->fetch_row()[0];
$procs = $conexion->query("SELECT COUNT(*) FROM procedimientos")->fetch_row()[0];
$atenciones = $conexion->query("SELECT COUNT(*) FROM historia")->fetch_row()[0];
?>
<h3>Panel principal</h3>
<p>Bienvenido, <?= htmlspecialchars($_SESSION["usuario"]) ?></p>
<div class="row text-center">
  <div class="col-md-4"><div class="card"><div class="card-body"><h2><?= $pacientes ?></h2>Pacientes</div></div></div>
  <div class="col-md-4"><div class="card"><div class="card-body"><h2><?= $procs ?></h2>Procedimientos</div></div></div>
  <div class="col-md-4"><div class="card"><div class="card-body"><h2><?= $atenciones ?></h2>Atenciones registradas</div></div></div>
</div>
<?php include "pie.php"; ?>
</body></html>
