<?php
include "encabezado.php";
$lista = $conexion->query("SELECT * FROM procedimientos ORDER BY nombre");
?>
<h3>Procedimientos odontológicos</h3>
<div class="card mb-4">
  <div class="card-header">Registrar procedimiento</div>
  <div class="card-body">
    <form id="formulario" class="row g-2">
      <div class="col-md-6"><input name="nombre" class="form-control" placeholder="Nombre del procedimiento" required></div>
      <div class="col-md-4"><input name="precio" type="number" class="form-control" placeholder="Precio" required></div>
      <div class="col-md-2"><button class="btn btn-primary w-100">Guardar</button></div>
    </form>
  </div>
</div>
<table class="table table-striped bg-white">
  <tr><th>Procedimiento</th><th>Precio</th></tr>
  <?php while ($p = $lista->fetch_assoc()) { ?>
  <tr><td><?= htmlspecialchars($p["nombre"]) ?></td><td>$<?= number_format($p["precio"], 0, ",", ".") ?></td></tr>
  <?php } ?>
</table>
<?php include "pie.php"; ?>
<script>
$("#formulario").submit(function (e) {
  e.preventDefault();
  $.post("guardar_procedimiento.php", $(this).serialize(), function (respuesta) {
    alert(respuesta);
    location.reload();
  });
});
</script>
</body></html>
