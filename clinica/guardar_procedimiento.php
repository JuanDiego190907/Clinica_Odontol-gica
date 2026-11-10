<?php
include "conexion.php";
if (!isset($_SESSION["usuario"])) exit("Sin permiso");
$stmt = $conexion->prepare("INSERT INTO procedimientos (nombre, precio) VALUES (?,?)");
$stmt->bind_param("sd", $_POST["nombre"], $_POST["precio"]);
$stmt->execute();
echo "Procedimiento guardado";
