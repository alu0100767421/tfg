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
  <link type="text/css" rel="stylesheet" href="../bootstrap-3.3.7-dist/css/bootstrap.min.css">
  <link type="text/css" rel="stylesheet" href="../css/mapa.css"/>

</head>

<body>
<script src="http://d3js.org/d3.v3.min.js"></script>
  <nav class="navbar navbar-default">
    <div class="container-fluid">

      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="https://www.ull.es/"><img id="imagen-menu" alt="ULL" src="../images/logoULL/logotipo-principal-recortada.png"></a>
      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="../index.php">Inicio</a></li>
          <li><a href="pages/mapa.php">Mapa</a></li>
        </ul>
      </div>

    </div>
  </nav>
  <div class="row">
    <div class="col-sm-12 col-md-8 col-lg-8" >
      <h3>Islas Canarias</h3>
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-8" id="mapa">

        </div>

      </div>
    </div>


    <div class="col-sm-12 col-md-4 col-lg-4">
      <h3>Sistema Paleontológico</h3>
    </div>
  </div>



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script type="text/javascript" src="../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../js/mapa.js"></script>

</body>
</html>