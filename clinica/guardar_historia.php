<?php
include "conexion.php";
if (!isset($_SESSION["usuario"])) exit("Sin permiso");
if ($_POST["id"] != "") {
    $stmt = $conexion->prepare("UPDATE historia SET procedimiento_id=?, fecha=?, diente=?, observaciones=? WHERE id=?");
    $stmt->bind_param("isssi", $_POST["procedimiento_id"], $_POST["fecha"], $_POST["diente"], $_POST["observaciones"], $_POST["id"]);
    $stmt->execute();
    echo "Registro actualizado";
} else {
    $stmt = $conexion->prepare("INSERT INTO historia (paciente_id, procedimiento_id, fecha, diente, observaciones) VALUES (?,?,?,?,?)");
    $stmt->bind_param("iisss", $_POST["paciente_id"], $_POST["procedimiento_id"], $_POST["fecha"], $_POST["diente"], $_POST["observaciones"]);
    $stmt->execute();
    echo "Procedimiento agregado a la historia";
}
