<?php
  session_start();
  $link = require("../connect_bbdd.php");

  if(isset($_SESSION['nombre'])) {
    $username = $_SESSION['nombre'];

?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sistema Geográfico de Paleontología de Canarias</title>

    <link rel="icon" type="/image/png" href="../../images/logoULL/logotipo-secundario-ULL.png" />
    <link type="text/css" rel="stylesheet" href="../../bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../../css/administracion.css"/>
    <link type="text/css" rel="stylesheet" href="../../bootstrap-3.3.7-dist/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>


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
          <a class="navbar-brand" href="https://www.ull.es/"><img class="imagen-menu" alt="Universidad de La Laguna" title="Universidad de La Laguna"src="../../images/logoULL/logotipo-principal-recortada.png"></a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="../../index.php">Inicio</a></li>
            <li><a href="../mapa.php">Mapa</a></li>
          </ul>
        </div>

      </div>
    </nav>




      <!--MENU LATERAL-->
      <div class="row">
        <div class="col-lg-2 col-md-4 col-xs-8 col-sm-6 ">
          <ul class="list-unstyled panel">
            <li><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span><a href="../administracion.php">Inicio</a></li>
            <li><span class="glyphicon glyphicon-search" aria-hidden="true"></span><a href="../consultar_bbdd.php">Consultar BBDD</a></li>
            <li id="valoracion"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span><a href="../valoracion.php">Valoraciones</a>
              <ul style="display:none" class="list-unstyled" id="submenu_valoracion">
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a href="../valoraciones/add_valoracion.php">Añadir Valoración</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a href="../valoraciones/consultar_valoracion.php">Consultar Valoración</a></li>
              </ul>
            </li>
            <li><span class="glyphicon glyphicon-plus" aria-hidden="true"></span><a href="../add_bbdd.php">Añadir BBDD</a>
              <ul class="list-unstyled" id="submenu">
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a href="yacimiento.php">Yacimiento</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a href="especie.php">Especie</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a href="excavacion.php">Excavación</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a href="publicacion.php">Publicación</a></li>
                <li class="destacar2"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a href="deposito.php">Depósito</a></li>
              </ul>
            </li>
            <?php
              //echo "Este es el usuario $username";
              if ($username == "admin") {
                echo "<li><span class='glyphicon glyphicon-user' aria-hidden='true'></span><a href='../gestion_usuarios.php'>Gestión Usuarios</a></li>";
              }
             ?>
          </ul>

          <div class="row">
            <form action="../cerrar_sesion.php" method="post">
              <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <button type="submit" class="btn btn-danger boton">Cerrar Sesión</button><br>
              </div>
            </form>
          </div>
        </div>
        <!--FIN MENU LATERAL-->
        <div class="col-lg-10 col-md-8 col-xs-12 col-sm-6 contenido">
          <!--Excavacion-->
          <div class="row">
            <div class="col-lg-offset-0 col-lg-10">
              <h2 class="titulos">Añadir Depósito</h2>
              <p>A continuación, podrá añadir a la base de datos un <b>nuevo depósito</b>, teniendo en cuenta algunas de sus características.</p>
              <form class="" action="../add_bbdd/add_deposito.php" method="post">
                <div class="row">
                  <div class="col-lg-4 form-group">
                    <input type="text" class="form-control" id="deposito" name="deposito" placeholder="NOMBRE">
                  </div>
                  <div class="col-lg-4 form-group">
                    <input type="text" class="form-control" id="pais" name="pais" placeholder="PAIS">
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-2 col-md-3 col-xs-12 col-sm-3">
                    <button type="submit" class="btn btn-success">Enviar</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!--Fin de Excavacion-->

        </div>
      </div>

    <!-- FOOTER-->
    <br><br><br><br><br>
    <div class="navbar navbar-inverse navbar-fixed-bottom">
      <div class="container">
        <p class="navbar-text pull-left">© 2017 Alexander Cole Mora
          <a href="https://www.ull.es/" target="_blank" >Universidad de La Laguna</a>
        </p>
      </div>
    </div>



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script type="text/javascript" src="../../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../../bootstrap-3.3.7-dist/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
  <script type="text/javascript" src="../../bootstrap-3.3.7-dist/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js"></script>
  <script type="text/javascript" src="../../js/administracion.js"></script>
  <script type="text/javascript" src="../../js/anadir/deposito.js"></script>
  </body>
</html>

<?php
   }else {
       header("Location: ../index.php");
   }
?>
