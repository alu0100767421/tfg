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
          <a tabindex='1' class="navbar-brand" href="https://www.ull.es/"><img class="imagen-menu" alt="Universidad de La Laguna" title="Universidad de La Laguna" src="../../images/logoULL/logotipo-principal-recortada.png"></a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li><a tabindex='1' href="../../index.php">Inicio</a></li>
            <li><a tabindex='1' href="../mapa.php">Mapa</a></li>
          </ul>
        </div>

      </div>
    </nav>




      <!--MENU LATERAL-->
      <div class="row">
        <div class="col-lg-2 col-md-4 col-xs-8 col-sm-6 ">
          <ul class="list-unstyled panel">
            <li><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span><a tabindex='1' href="../administracion.php">Inicio</a></li>
            <li><span class="glyphicon glyphicon-search" aria-hidden="true"></span><a tabindex='1' href="../consultar_bbdd.php">Consultar/Modificar</a></li>
            <li id="valoracion"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span><a tabindex='1' href="../valoracion.php">Valoraciones</a>
              <ul style="display:none" class="list-unstyled" id="submenu_valoracion">
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a href="../valoraciones/add_valoracion.php">Añadir Valoración</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a href="../valoraciones/consultar_valoracion.php">Consultar Valoración</a></li>
              </ul>
            </li>
            <li><span class="glyphicon glyphicon-plus" aria-hidden="true"></span><a tabindex='1' href="../add_bbdd.php">Añadir BBDD</a>
              <ul class="list-unstyled" id="submenu">
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a tabindex='1' href="yacimiento.php">Yacimiento</a></li>
                <li class="destacar2"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a tabindex='1' href="especie.php">Especie</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a tabindex='1' href="excavacion.php">Excavación</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a tabindex='1' href="publicacion.php">Publicación</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a tabindex='1' href="deposito.php">Depósito</a></li>
              </ul>
            </li>
            <?php
              //echo "Este es el usuario $username";
              if ($username == "admin") {
                echo "<li><span class='glyphicon glyphicon-user' aria-hidden='true'></span><a tabindex='1' href='../gestion_usuarios.php'>Gestión Usuarios</a></li>";
              }
             ?>
          </ul>

          <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
              <button tabindex='1' type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal_cerrar_sesion">Cerrar Sesión</button>
            </div>
          </div>
        </div>
        <!-- Modal -->
        <div id="modal_cerrar_sesion" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button tabindex='2' type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 tabindex='1' class="modal-title">Cierre de sesión</h4>
              </div>
              <div class="modal-body">
                <p tabindex='2'>¿Está seguro que desea cerrar sesión?</p>
              </div>
              <div class="modal-footer">
                <form action="../cerrar_sesion.php" method="post">
                  <button tabindex='2' type="submit" class="btn btn-danger boton">Cerrar Sesión</button><br>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!--FIN MENU LATERAL-->
        <div class="col-lg-10 col-md-8 col-xs-12 col-sm-6 contenido">
          <!--Yacimiento-->
          <div class="row">
            <div class="col-lg-offset-0 col-lg-10">
              <h2  tabindex='2' class="titulos">Añadir Especies</h2>
              <p tabindex='2' >A continuación, podrá añadir a la base de datos una nueva especie, teniendo en cuenta algunas de sus características.</p>
              <form class="" action="../add_bbdd/add_especie.php" method="post">
                <div class="row">
                  <div class="col-lg-5 form-group">
                    <input  tabindex='2' type="text" class="form-control" id="nombre_especie" name="nombre_especie" placeholder="NOMBRE">
                  </div>
                  <div class="col-lg-5 form-group">
                    <input  tabindex='2' type="text" class="form-control" id="tipo_especie" name="tipo_especie" placeholder="TIPO">
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-5 form-group">
                    <select  tabindex='2' name="Yacimientos_Especie" id="Yacimientos_Especie" class="form-control" onchange="especie(this.value)">
                      <option disabled selected>YACIMIENTOS</option>
                      <option type='text' value='NINGUNO' name='NINGUNO'>NINGUNO</option>
                      <?php
                        $consulta_yacimiento="SELECT yacimiento
                                              FROM yacimiento
                                              ORDER BY yacimiento ASC;";
                        $resultado=pg_query($link,$consulta_yacimiento);
                        echo pg_last_error();
                        while($resultado2 = pg_fetch_assoc($resultado)){
                          $aux = $resultado2['yacimiento'];
                          echo "<option type='text' value='$aux' name='$aux'>$aux</option>";
                        }

                      ?>
                     </select>
                  </div>
                  <input type="hidden" name="yacimiento_especie" id="yacimiento_especie">

                  <div class="col-lg-5 form-group">
                    <select  tabindex='2' name="Deposito" class="form-control" onchange="deposito(this.value)">
                      <option disabled selected>DEPÓSITO</option>
                      <option type='text' value='NINGUNO' name='NINGUNO'>NINGUNO</option>
                      <?php
                        $consulta_yacimiento="SELECT deposito
                                              FROM deposito;";
                        $resultado=pg_query($link,$consulta_yacimiento);
                        echo pg_last_error();
                        while($resultado2 = pg_fetch_assoc($resultado)){
                          $aux = $resultado2['deposito'];
                          echo "<option type='text' value='$aux' name='$aux'>$aux</option>";
                        }
                      ?>
                    </select>
                  </div>
                  <input type="hidden" name="deposito_especie" id="deposito_especie">
                </div>

                <div class="row">
                  <div class="col-lg-2 col-md-3 col-xs-12 col-sm-3">
                    <button  tabindex='2' type="submit" class="btn btn-success">Enviar</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!--Fin de Yacimiento-->

        </div>
      </div>

    <!-- FOOTER-->
    <br><br><br><br><br>
    <div class="navbar navbar-inverse navbar-fixed-bottom">
      <div class="container">
        <p tabindex='2' class="navbar-text pull-left">© 2017 Alexander Cole Mora
          <a tabindex='2' href="https://www.ull.es/" target="_blank" >Universidad de La Laguna</a>
        </p>
      </div>
    </div>



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script type="text/javascript" src="../../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../../js/administracion.js"></script>
  <script type="text/javascript" src="../../js/anadir/especie.js"></script>
  </body>
</html>

<?php
   }else {
       header("Location: ../index.php");
   }
?>
