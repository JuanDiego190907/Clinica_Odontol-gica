<?php
include "conexion.php";
if (!isset($_SESSION["usuario"])) { header("Location: index.php"); exit; }
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Clínica Odontológica</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand navbar-dark bg-primary">
  <div class="container">
    <span class="navbar-brand">Clínica Odontológica</span>
    <ul class="navbar-nav me-auto">
      <li class="nav-item"><a class="nav-link" href="panel.php">Panel</a></li>
      <li class="nav-item"><a class="nav-link" href="pacientes.php">Pacientes</a></li>
      <li class="nav-item"><a class="nav-link" href="procedimientos.php">Procedimientos</a></li>
    </ul>
    <a class="btn btn-light btn-sm" href="salir.php">Salir</a>
  </div>
</nav>
<div class="container mt-4">
