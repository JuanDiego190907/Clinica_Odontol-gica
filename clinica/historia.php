<?php
include "encabezado.php";
$id = (int)$_GET["id"];
$paciente = $conexion->query("SELECT * FROM pacientes WHERE id=$id")->fetch_assoc();
if (!$paciente) exit("Paciente no encontrado");
$procs = $conexion->query("SELECT * FROM procedimientos ORDER BY nombre");
$historia = $conexion->query("SELECT h.*, p.nombre AS procedimiento, p.precio
  FROM historia h JOIN procedimientos p ON p.id = h.procedimiento_id
  WHERE h.paciente_id=$id ORDER BY h.fecha DESC");
?>
<div class="d-flex justify-content-between">
  <h3>Historia clínica</h3>
  <button class="btn btn-danger" onclick="generarPDF()">Generar PDF</button>
</div>

<div class="card my-3">
  <div class="card-header" id="titulo">Registrar procedimiento realizado</div>
  <div class="card-body">
    <form id="formulario" class="row g-2">
      <input type="hidden" name="paciente_id" value="<?= $id ?>">
      <input type="hidden" name="id" id="id">
      <div class="col-md-3"><input name="fecha" type="date" class="form-control" value="<?= date("Y-m-d") ?>" required></div>
      <div class="col-md-4">
        <select name="procedimiento_id" class="form-select">
          <?php while ($p = $procs->fetch_assoc()) echo "<option value='{$p["id"]}'>" . htmlspecialchars($p["nombre"]) . "</option>"; ?>
        </select>
      </div>
      <div class="col-md-2"><input name="diente" class="form-control" placeholder="Diente"></div>
      <div class="col-md-3"><button class="btn btn-primary w-100">Guardar</button></div>
      <div class="col-12"><input name="observaciones" class="form-control" placeholder="Observaciones"></div>
    </form>
  </div>
</div>

<div id="historia" class="bg-white p-4">
  <h4 class="text-center">Historia Clínica Odontológica</h4>
  <p>
    <b>Paciente:</b> <?= htmlspecialchars($paciente["nombre"]) ?><br>
    <b>Documento:</b> <?= htmlspecialchars($paciente["documento"]) ?><br>
    <b>Teléfono:</b> <?= htmlspecialchars($paciente["telefono"]) ?><br>
    <b>Fecha de nacimiento:</b> <?= $paciente["fecha_nacimiento"] ?><br>
    <b>Alergias:</b> <?= htmlspecialchars($paciente["alergias"]) ?: "Ninguna" ?>
  </p>
  <table class="table table-bordered">
    <tr><th>Fecha</th><th>Procedimiento</th><th>Diente</th><th>Observaciones</th><th>Precio</th><th data-html2canvas-ignore="true"></th></tr>
    <?php while ($h = $historia->fetch_assoc()) { ?>
    <tr>
      <td><?= $h["fecha"] ?></td>
      <td><?= htmlspecialchars($h["procedimiento"]) ?></td>
      <td><?= htmlspecialchars($h["diente"]) ?></td>
      <td><?= htmlspecialchars($h["observaciones"]) ?></td>
      <td>$<?= number_format($h["precio"], 0, ",", ".") ?></td>
      <td data-html2canvas-ignore="true" class="text-nowrap">
        <button class="btn btn-sm btn-warning editar"
          data-id="<?= $h["id"] ?>"
          data-fecha="<?= $h["fecha"] ?>"
          data-proc="<?= $h["procedimiento_id"] ?>"
          data-diente="<?= htmlspecialchars($h["diente"]) ?>"
          data-obs="<?= htmlspecialchars($h["observaciones"]) ?>">Editar</button>
        <button class="btn btn-sm btn-danger eliminar" data-id="<?= $h["id"] ?>">Eliminar</button>
      </td>
    </tr>
    <?php } ?>
  </table>
</div>

<?php include "pie.php"; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
$("#formulario").submit(function (e) {
  e.preventDefault();
  $.post("guardar_historia.php", $(this).serialize(), function (respuesta) {
    alert(respuesta);
    location.reload();
  });
});
$(".editar").click(function () {
  var b = $(this);
  $("#id").val(b.data("id"));
  $("[name=fecha]").val(b.data("fecha"));
  $("[name=procedimiento_id]").val(b.data("proc"));
  $("[name=diente]").val(b.data("diente"));
  $("[name=observaciones]").val(b.data("obs"));
  $("#titulo").text("Editar registro");
  window.scrollTo(0, 0);
});
$(".eliminar").click(function () {
  if (confirm("¿Eliminar este registro de la historia clínica?")) {
    $.post("eliminar_historia.php", { id: $(this).data("id") }, function (respuesta) {
      alert(respuesta);
      location.reload();
    });
  }
});
function generarPDF() {
  html2pdf().from(document.getElementById("historia")).save("historia_clinica.pdf");
}
</script>
</body></html>
