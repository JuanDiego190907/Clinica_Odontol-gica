<?php
include "conexion.php";
$error = "";
if ($_POST) {
    $u = $_POST["usuario"];
    $c = md5($_POST["clave"]);
    $stmt = $conexion->prepare("SELECT id FROM usuarios WHERE usuario=? AND clave=?");
    $stmt->bind_param("ss", $u, $c);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        $_SESSION["usuario"] = $u;
        header("Location: panel.php");
        exit;
    }
    $error = "Usuario o clave incorrectos";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Iniciar sesión</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container" style="max-width:380px; margin-top:100px">
  <div class="card shadow">
    <div class="card-body">
      <h4 class="text-center">Clínica Odontológica</h4>
      <p class="text-center text-muted">Iniciar sesión</p>
      <?php if ($error) echo "<div class='alert alert-danger'>$error</div>"; ?>
      <form method="post">
        <input name="usuario" class="form-control mb-3" placeholder="Usuario" required>
        <input name="clave" type="password" class="form-control mb-3" placeholder="Clave" required>
        <button class="btn btn-primary w-100">Entrar</button>
      </form>
    </div>
  </div>
</div>
</body>
</html>
