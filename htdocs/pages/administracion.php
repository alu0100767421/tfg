<?php
  session_start();
  $link = require("connect_bbdd.php");

  if(isset($_SESSION['nombre'])) {
    $username = $_SESSION['nombre'];

?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sistema Geográfico de Paleontología de Canarias</title>

    <link rel="icon" type="/image/png" href="../images/logoULL/logotipo-secundario-ULL.png" />
    <link type="text/css" rel="stylesheet" href="../bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../css/administracion.css"/>

  </head>
  <body>

    <!--INICIO DE MENU-->
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
            <li><a href="mapa.php">Mapa</a></li>
          </ul>
        </div>

      </div>
    </nav>

    <div class="containter">
      <!--MENU LATERAL -->
      <div class="row">
        <div class="col-lg-2 col-md-4 col-xs-12 col-sm-12 panel">
          <ul class="list-unstyled">
            <li><a href="administracion.php">Inicio</a></li>
            <li><a href="#">Consultar BBDD</a></li>
            <li><a href="#">Añadir BBDD</a></li>
            <li><a href="#">Gestión Usuarios</a></li>
          </ul>

        </div>
        <div class="col-lg-9 col-md-8 col-xs-12 col-sm-12 contenido">
          <h2>Contenido</h2>
        </div>
      </div>
      <div class="row">
        <form action="cerrar_sesion.php" method="post">
          <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
            <button type="submit" class="btn btn-danger boton">Cerrar Sesión</button><br>
          </div>
        </form>
      </div>
    </div>





  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script type="text/javascript" src="../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../js/administracion.js"></script>
  </body>
</html>

<?php
   }else {
       header("Location: ../index.php");
   }
?>
