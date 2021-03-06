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

    <title>Portal de administración del servicio</title>

    <link rel="icon" type="image/png" href="../images/logoULL/logotipo-secundario-ULL.png" />
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
          <a tabindex='1' class="navbar-brand" href="https://www.ull.es/"><img class="imagen-menu" alt="Universidad de La Laguna" title="Universidad de La Laguna" src="../images/logoULL/logotipo-principal-recortada.png"></a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li><a tabindex='1' title='acceder a inicio' href="../index.php">Inicio</a></li>
            <li><a tabindex='1' title='acceder al mapa' href="mapa.php">Mapa</a></li>
          </ul>
        </div>

      </div>
    </nav>




      <!--MENU LATERAL-->
      <div class="row">
        <div class="col-lg-2 col-md-4 col-xs-8 col-sm-6 ">
          <ul class="list-unstyled panel">
            <li class="destacar"><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span><a title='acceder a inicio' tabindex='1' href="administracion.php">Inicio</a></li>
            <li><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><a title='¿cómo funciona la apliación?' tabindex='1' href="usar_aplicacion.php">¿Cómo funciona?</a></li>
            <li id="consultar"><span class="glyphicon glyphicon-search" aria-hidden="true"></span><a title='acceder a consultar base de datos' tabindex='1' href="consultar_bbdd.php">Consultar/Modificar</a></li>
            <li id="valoracion"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span><a title='acceder a valoraciones' tabindex='1' href="valoracion.php">Valoraciones</a>
              <ul style="display:none" class="list-unstyled" id="submenu_valoracion">
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceder a añadir una valoracion' href="valoraciones/add_valoracion.php">Añadir Valoración</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceder a consultar una valoracion' href="valoraciones/consultar_valoracion.php">Consultar Valoración</a></li>
              </ul>
            </li>
            <li id="add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span><a title='acceder a añadir a la base de datos' tabindex='1' href="add_bbdd.php">Añadir BBDD</a>
              <ul style="display:none" class="list-unstyled" id="submenu">
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceder a añadir yacimientos' href="anadir/yacimiento.php">Yacimiento</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceder a añadir especies' href="anadir/especie.php">Especie</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceder a añadir excavación' href="anadir/excavacion.php">Excavación</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceder a añadir publicación' href="anadir/publicacion.php">Publicación</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceder a añadir depósito' href="anadir/deposito.php">Depósito</a></li>
              </ul>

            </li>
            <?php
              //echo "Este es el usuario $username";
              if ($username == "admin") {
                echo "<li><span class='glyphicon glyphicon-user' aria-hidden='true'></span><a title='acceder a gestión de usuarios' tabindex='1' href='gestion_usuarios.php'>Gestión Usuarios</a></li>";
              }
             ?>
          </ul>
      <!--FIN MENU LATERAL-->
          <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
              <button tabindex='1' type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal_cerrar_sesion">Cerrar Sesión</button>
            </div>
          </div>
        </div>
        <div class="col-lg-offset-3 col-lg-7 col-md-offset-1 col-md-7 col-xs-offset-0 col-xs-12 col-sm-offset-0 col-sm-12">
          <img tabindex='3' src="../images/logoULL/logotipo-secundario.jpg" alt="Universidad de La Laguna" title="Universidad de La Laguna" class="imagen-fondo">
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
            <form action="cerrar_sesion.php" method="post">
              <button tabindex='2' type="submit" class="btn btn-danger boton">Cerrar Sesión</button><br>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- FOOTER-->
    <br><br><br><br><br>
    <div class="navbar navbar-inverse navbar-fixed-bottom" role='contentinfo'>
      <div class="container">
        <p tabindex='3' class="navbar-text pull-left">© 2017 Alexander Cole Mora
          <a title='acceder a la página de la Universidad de La Laguna' tabindex='3' href="https://www.ull.es/" target="_blank" >Universidad de La Laguna</a>
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
