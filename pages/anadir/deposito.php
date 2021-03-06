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

    <title>Añadir depósitos a la base de datos</title>

    <link rel="icon" type="image/png" href="../../images/logoULL/logotipo-secundario-ULL.png" />
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
            <li><a title='Acceder a inicio' tabindex='1' href="../../index.php">Inicio</a></li>
            <li><a title='acceder al mapa' tabindex='1' href="../mapa.php">Mapa</a></li>
          </ul>
        </div>

      </div>
    </nav>




      <!--MENU LATERAL-->
      <div class="row">
        <div class="col-lg-2 col-md-4 col-xs-8 col-sm-6 ">
          <ul class="list-unstyled panel">
            <li><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span><a title='acceder a inicio' tabindex='1' href="../administracion.php">Inicio</a></li>
            <li><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><a title='¿cómo funciona la apliación?' tabindex='1' href="../usar_aplicacion.php">¿Cómo funciona?</a></li>
            <li><span class="glyphicon glyphicon-search" aria-hidden="true"></span><a title='acceder a consultar la base de datos' tabindex='1' href="../consultar_bbdd.php">Consultar/Modificar</a></li>
            <li id="valoracion"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span><a title='acceder a valoraciones' tabindex='1' href="../valoracion.php">Valoraciones</a>
              <ul style="display:none" class="list-unstyled" id="submenu_valoracion">
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceder a añadir una valoración' href="../valoraciones/add_valoracion.php">Añadir Valoración</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceder a consultar una valoracón' href="../valoraciones/consultar_valoracion.php">Consultar Valoración</a></li>
              </ul>
            </li>
            <li><span class="glyphicon glyphicon-plus" aria-hidden="true"></span><a title='acceder a añadir a la base de datos' tabindex='1' href="../add_bbdd.php">Añadir BBDD</a>
              <ul class="list-unstyled" id="submenu">
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceder a añadir yacimientos' tabindex='1' href="yacimiento.php">Yacimiento</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceder a añadir especies' tabindex='1' href="especie.php">Especie</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceder a añadir excavaciones' tabindex='1' href="excavacion.php">Excavación</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceder a añadir publicacion' tabindex='1' href="publicacion.php">Publicación</a></li>
                <li class="destacar2"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceder a añadir deposito' tabindex='1' href="deposito.php">Depósito</a></li>
              </ul>
            </li>
            <?php
              //echo "Este es el usuario $username";
              if ($username == "admin") {
                echo "<li><span class='glyphicon glyphicon-user' aria-hidden='true'></span><a title='acceder a la gestión de usuarios' tabindex='1' href='../gestion_usuarios.php'>Gestión Usuarios</a></li>";
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
                <button  tabindex='2' type="button" class="close" data-dismiss="modal">&times;</button>
                <h4  tabindex='1' class="modal-title">Cierre de sesión</h4>
              </div>
              <div class="modal-body">
                <p tabindex='2' >¿Está seguro que desea cerrar sesión?</p>
              </div>
              <div class="modal-footer">
                <form action="../cerrar_sesion.php" method="post">
                  <button  tabindex='2' type="submit" class="btn btn-danger boton">Cerrar Sesión</button><br>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!--FIN MENU LATERAL-->
        <div class="col-lg-10 col-md-8 col-xs-12 col-sm-6 contenido">
          <!--deposito-->
          <div class='row'>
            <div class='col-lg-11'>
              <div style="display:none" id='correcto' class="correcto">
                <p id='mostrar_mensaje_ok'></p>
              </div>

              <div style="display:none" id='incorrecto' class="incorrecto">
                <p id='mostrar_mensaje_error'></p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-offset-0 col-lg-10">
              <h2  tabindex='2' class="titulos">Añadir Depósito</h2>
              <p tabindex='2'>A continuación, podrá añadir a la base de datos un <b>nuevo depósito</b>, teniendo en cuenta algunas de sus características.</p>
              <form class="" action="../add_bbdd/add_deposito.php" method="post">
                <div class="row">
                  <div class="col-lg-5 form-group">
                    <input tabindex='2' type="text" class="form-control" id="deposito" name="deposito" placeholder="NOMBRE">
                  </div>
                  <div class="col-lg-5 form-group">
                    <input tabindex='2' type="text" class="form-control" id="pais" name="pais" placeholder="PAIS">
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-2 col-md-3 col-xs-12 col-sm-3">
                    <button tabindex='2' type="submit" class="btn btn-success">Enviar</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!--Fin de deposito-->

        </div>
      </div>

    <!-- FOOTER-->
    <br><br><br><br><br>
    <div class="navbar navbar-inverse navbar-fixed-bottom" role='contentinfo'>
      <div class="container">
        <p tabindex='2' class="navbar-text pull-left">© 2017 Alexander Cole Mora
          <a title='Acceder a la página web de la Universidad de La Laguna' tabindex='2' href="https://www.ull.es/" target="_blank" >Universidad de La Laguna</a>
        </p>
      </div>
    </div>

    <?php
        if($_GET['mensaje']=='ok'){
          $contenido= $_GET['contenido'];
          //echo $contenido;
          echo "<script type='text/javascript'>
          document.getElementById('correcto').style.display='block';
          document.getElementById('mostrar_mensaje_ok').innerHTML = '".$contenido."' ;
          </script>";

          $_GET['mensaje']='';
        }
        if($_GET['mensaje']=='error'){
          $contenido= $_GET['contenido'];
          echo "<script type='text/javascript'>
          document.getElementById('incorrecto').style.display='block';
          document.getElementById('mostrar_mensaje_error').innerHTML = '".$contenido."' ;

          </script>";
          $_GET['mensaje']='';
        }
     ?>

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
