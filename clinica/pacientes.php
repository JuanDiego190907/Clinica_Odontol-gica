<?php
include "encabezado.php";
$lista = $conexion->query("SELECT * FROM pacientes ORDER BY nombre");
?>
<h3>Pacientes</h3>
<div class="card mb-4">
  <div class="card-header" id="titulo">Registrar paciente</div>
  <div class="card-body">
    <form id="formulario" class="row g-2">
      <input type="hidden" name="id" id="id">
      <div class="col-md-3"><input name="documento" class="form-control" placeholder="Documento" required></div>
      <div class="col-md-4"><input name="nombre" class="form-control" placeholder="Nombre completo" required></div>
      <div class="col-md-2"><input name="telefono" class="form-control" placeholder="Teléfono"></div>
      <div class="col-md-3"><label class="form-label small mb-0">Fecha de nacimiento</label><input name="fecha_nacimiento" type="date" class="form-control"></div>
      <div class="col-md-9"><input name="alergias" class="form-control" placeholder="Alergias"></div>
      <div class="col-md-3"><button class="btn btn-primary w-100">Guardar</button></div>
    </form>
  </div>
</div>
<table class="table table-striped bg-white">
  <tr><th>Documento</th><th>Nombre</th><th>Teléfono</th><th></th></tr>
  <?php while ($p = $lista->fetch_assoc()) { ?>
  <tr>
    <td><?= htmlspecialchars($p["documento"]) ?></td>
    <td><?= htmlspecialchars($p["nombre"]) ?></td>
    <td><?= htmlspecialchars($p["telefono"]) ?></td>
    <td class="text-end">
      <a class="btn btn-sm btn-success" href="historia.php?id=<?= $p["id"] ?>">Historia clínica</a>
      <button class="btn btn-sm btn-warning editar"
        data-id="<?= $p["id"] ?>"
        data-documento="<?= htmlspecialchars($p["documento"]) ?>"
        data-nombre="<?= htmlspecialchars($p["nombre"]) ?>"
        data-telefono="<?= htmlspecialchars($p["telefono"]) ?>"
        data-fecha="<?= $p["fecha_nacimiento"] ?>"
        data-alergias="<?= htmlspecialchars($p["alergias"]) ?>">Editar</button>
      <button class="btn btn-sm btn-danger eliminar" data-id="<?= $p["id"] ?>">Eliminar</button>
    </td>
  </tr>
  <?php } ?>
</table>
<?php include "pie.php"; ?>
<script>
$("#formulario").submit(function (e) {
  e.preventDefault();
  $.post("guardar_paciente.php", $(this).serialize(), function (respuesta) {
    alert(respuesta);
    location.reload();
  });
});
$(".editar").click(function () {
  var b = $(this);
  $("#id").val(b.data("id"));
  $("[name=documento]").val(b.data("documento"));
  $("[name=nombre]").val(b.data("nombre"));
  $("[name=telefono]").val(b.data("telefono"));
  $("[name=fecha_nacimiento]").val(b.data("fecha"));
  $("[name=alergias]").val(b.data("alergias"));
  $("#titulo").text("Editar paciente");
  window.scrollTo(0, 0);
});
$(".eliminar").click(function () {
  if (confirm("¿Eliminar el paciente y toda su historia clínica?")) {
    $.post("eliminar_paciente.php", { id: $(this).data("id") }, function (respuesta) {
      alert(respuesta);
      location.reload();
    });
  }
});
</script>
</body></html>
