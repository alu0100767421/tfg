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




      <!--MENU LATERAL-->
      <div class="row">
        <div class="col-lg-2 col-md-4 col-xs-8 col-sm-6 ">
          <ul class="list-unstyled panel">
            <li><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span><a href="administracion.php">&nbsp Inicio</a></li>
            <li><span class="glyphicon glyphicon-search" aria-hidden="true"></span><a href="#">&nbsp Consultar BBDD</a></li>
            <li><span class="glyphicon glyphicon-plus" aria-hidden="true"></span><a href="add_bbdd.php">&nbsp Añadir BBDD</a></li>
            <?php
              //echo "Este es el usuario $username";
              if ($username == "admin") {
                echo "<li><span class='glyphicon glyphicon-user' aria-hidden='true'></span><a href='gestion_usuarios.php'>&nbsp Gestión Usuarios</a></li>";
              }
             ?>
          </ul>

          <div class="row">
            <form action="cerrar_sesion.php" method="post">
              <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <button type="submit" class="btn btn-danger boton">Cerrar Sesión</button><br>
              </div>
            </form>
          </div>
        </div>
        <!--FIN MENU LATERAL-->
        <div class="col-lg-10 col-md-8 col-xs-12 col-sm-6 contenido">
          <h2>Añadir datos</h2>

          <!--Yacimiento-->
          <div class="row">
            <div class="col-lg-12">
              <h4>Yacimiento</h4>
              <form class="" action="" method="post">
                <div class="row">
                  <div class="col-lg-2 form-group">
                    <select name="Islas" class="form-control">
                      <option disabled selected>ISLA</option>
                      <option type='text' value='LA PALMA' name='La Palma'>LA PALMA</option>
                      <option type='text' value='La Gomera' name='La Gomera'>LA GOMERA</option>
                      <option type='text' value='El Hierro' name='El Hierro'>EL HIERRO</option>
                      <option type='text' value='Tenerife' name='Tenerife'>TENERIFE</option>
                      <option type='text' value='Gran Canaria' name='Gran Canaria'>GRAN CANARIA</option>
                      <option type='text' value='Fuerteventura' name='Fuerteventura'>FUERTEVENTURA</option>
                      <option type='text' value='Lanzarote' name='Lanzarote'>LANZAROTE</option>
                      <option type='text' value='La Graciosa' name='La Graciosa'>LA GRACIOSA</option>
                      <option type='text' value='Lobos' name='Lobos'>LOBOS</option>
                    </select>
                  </div>
                  <div class="col-lg-2 form-group">
                    <select name="Municipios" class="form-control">
                      <option disabled selected>MUNICIPIOS</option>
                      <option type='text' value='GUIA DE ISORA' name='GUIA DE ISORA'>GUÍA DE ISORA</option>
                    </select>
                  </div>
                  <div class="col-lg-2 form-group">
                    <select name="Localidad" class="form-control">
                      <option disabled selected>LOCALIDAD</option>
                      <option type='text' value='CHIO' name='CHIO'>CHÍO</option>
                    </select>
                  </div>
                  <div class="col-lg-2 form-group">
                    <input type="text" class="form-control" id="nombre_yacimiento" name="nombre_yacimiento" placeholder="NOMBRE YACIMIENTO">
                  </div>
                  <div class="col-lg-2 form-group">
                    <input type="text" class="form-control" id="coordenada" name="coordenada" placeholder="COORDENADA">
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-2 form-group">
                    <input type="text" class="form-control" id="edad" name="edad" placeholder="EDAD">
                  </div>
                  <div class="col-lg-2 form-group">
                    <input type="text" class="form-control" id="altura" name="altura" placeholder="ALTURA">
                  </div>
                  <div class="col-lg-2 form-group">
                    <input type="text" class="form-control" id="tipo" name="tipo" placeholder="TIPO">
                  </div>
                  <div class="col-lg-2 form-group">
                    <input type="text" class="form-control" id="paleologia" name="paleologia" placeholder="PALEOLOGÍA">
                  </div>
                  <div class="col-lg-2 form-group">
                    <input type="text" class="form-control" id="estado_conservacion" name="estado_conservacion" placeholder="ESTADO CONSERVACIÓN">
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-2 form-group">
                    <input type="text" class="form-control" id="excavaciones" name="excavaciones" placeholder="EXCAVACIONES">
                  </div>
                  <div class="col-lg-2 form-group">
                    <input type="text" class="form-control" id="especies_dominantes" name="especies_dominantes" placeholder="ESPECIES DOMINANTES">
                  </div>
                  <div class="col-lg-3 form-group">
                    <input type="text" class="form-control" id="observaciones" name="observaciones" placeholder="OBSERVACIONES">
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
          <!--Fin de Yacimiento-->
          <!--Especies-->
          <div class="row">
            <div class="col-lg-12">
              <br><br><br><h4>Especies</h4>
              <form class="" action="" method="post">
                <div class="row">
                  <div class="col-lg-2 form-group">
                    <input type="text" class="form-control" id="nombre_especie" name="nombre_especie" placeholder="NOMBRE">
                  </div>
                  <div class="col-lg-2 form-group">
                    <input type="text" class="form-control" id="yacimiento_especie" name="yacimiento_especie" placeholder="YACIMIENTO">
                  </div>
                  <div class="col-lg-2 form-group">
                    <select name="Museo" class="form-control">
                      <option disabled selected>MUSEO</option>
                      <option type='text' value='si' name=''>SÍ</option>
                      <option type='text' value='no' name=''>NO</option>
                    </select>
                  </div>
                  <div class="col-lg-3 form-group">
                    <input type="text" class="form-control" id="observaciones_especie" name="observaciones_especie" placeholder="OBSERVACIONES">
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
          <!--Fin de Especies-->
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
  <script type="text/javascript" src="../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../js/administracion.js"></script>
  </body>
</html>

<?php
   }else {
       header("Location: ../index.php");
   }
?>
