<?php

  $link = require("connect_bbdd.php");
  echo pg_last_error();

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Sistema Geográfico de Paleontología de Canarias</title>

  <link rel="icon" type="/image/png" href="../images/logoULL/logotipo-secundario.jpg" />
  <link type="text/css" rel="stylesheet" href="../css/mapa.css"/>

</head>

<body>
<script src="http://d3js.org/d3.v3.min.js"></script>
  <nav>
    <h1>aqui va un menu</h1>
  </nav>
  <div class="columna1" id="#mapa">
    <h3>Islas Canarias</h3>
  </div>

  <div class="columna2">
    <h3>Sistema Paleontológico</h3>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script type="text/javascript" src="../js/mapa.js"></script>

</body>
</html>
