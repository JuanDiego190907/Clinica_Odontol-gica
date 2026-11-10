<?php
include "conexion.php";
if (!isset($_SESSION["usuario"])) exit("Sin permiso");
$fecha = $_POST["fecha_nacimiento"] ?: null;
if ($_POST["id"] != "") {
    $stmt = $conexion->prepare("UPDATE pacientes SET documento=?, nombre=?, telefono=?, fecha_nacimiento=?, alergias=? WHERE id=?");
    $stmt->bind_param("sssssi", $_POST["documento"], $_POST["nombre"], $_POST["telefono"], $fecha, $_POST["alergias"], $_POST["id"]);
    $stmt->execute();
    echo "Paciente actualizado";
} else {
    $stmt = $conexion->prepare("INSERT INTO pacientes (documento, nombre, telefono, fecha_nacimiento, alergias) VALUES (?,?,?,?,?)");
    $stmt->bind_param("sssss", $_POST["documento"], $_POST["nombre"], $_POST["telefono"], $fecha, $_POST["alergias"]);
    $stmt->execute();
    echo "Paciente guardado";
}
