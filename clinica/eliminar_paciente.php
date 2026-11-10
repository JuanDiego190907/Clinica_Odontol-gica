<?php
include "conexion.php";
if (!isset($_SESSION["usuario"])) exit("Sin permiso");
$id = (int)$_POST["id"];
$conexion->query("DELETE FROM historia WHERE paciente_id=$id");
$conexion->query("DELETE FROM pacientes WHERE id=$id");
echo "Paciente eliminado";
