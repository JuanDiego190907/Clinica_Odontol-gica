<?php
include "conexion.php";
if (!isset($_SESSION["usuario"])) exit("Sin permiso");
$id = (int)$_POST["id"];
$conexion->query("DELETE FROM historia WHERE id=$id");
echo "Registro eliminado";
