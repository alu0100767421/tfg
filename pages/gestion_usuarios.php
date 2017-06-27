<?php
  session_start();
  $link = require("connect_bbdd.php");
  $consulta = "SELECT nombre FROM usuarios;";
  $users = pg_query($link, $consulta);
  $users2= pg_query($link,$consulta);

  if(isset($_SESSION['nombre'])) {
    $username = $_SESSION['nombre'];


?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sección de gestión de usuarios</title>

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
            <li><a tabindex='1' title='acceso al inicio' href="../index.php">Inicio</a></li>
            <li><a tabindex='1' title='acceso al mapa' href="mapa.php">Mapa</a></li>
          </ul>
        </div>

      </div>
    </nav>


      <!--MENU LATERAL -->
      <div class="row">
        <div class="col-lg-2 col-md-4 col-xs-8 col-sm-6 ">
          <ul class="list-unstyled panel">
            <li><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span><a title='acceso a administracion' tabindex='1' href="administracion.php">Inicio</a></li>
            <li><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><a title='¿cómo funciona la apliación?' tabindex='1' href="usar_aplicacion.php">¿Cómo funciona?</a></li>
            <li><span class="glyphicon glyphicon-search" aria-hidden="true"></span><a title='acceso a consultar la base de datos' tabindex='1' href="consultar_bbdd.php">Consultar/Modificar</a></li>
            <li id="valoracion"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span><a title='acceso valoraciones' tabindex='1' href="valoracion.php">Valoraciones</a>
              <ul style="display:none" class="list-unstyled" id="submenu_valoracion">
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceso a añadir valoracion' href="valoraciones/add_valoracion.php">Añadir Valoración</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceso a consultar valoracion' href="valoraciones/consultar_valoracion.php">Consultar Valoración</a></li>
              </ul>
            </li>
            <li id="add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span><a title='acceso a añadir a la base datos' tabindex='1' href="add_bbdd.php">Añadir BBDD</a>
              <ul style="display:none" class="list-unstyled" id="submenu">
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceso a añadir yacimientos' href="anadir/yacimiento.php">Yacimiento</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceso a añadir especies' href="anadir/especie.php">Especie</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceso a añadir excavaciones' href="anadir/excavacion.php">Excavación</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceso a añadir publicaciones' href="anadir/publicacion.php">Publicación</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceso a añadir depositos' href="anadir/deposito.php">Depósito</a></li>
              </ul>
            </li>
            <?php
              //echo "Este es el usuario $username";
              if ($username == "admin") {
                echo "<li class='destacar'><span class='glyphicon glyphicon-user' aria-hidden='true'></span><a title='acceso a gestión de usuarios' tabindex='1' href='gestion_usuarios.php'>Gestión Usuarios</a></li>";
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
                <form action="cerrar_sesion.php" method="post">
                  <button  tabindex='2' type="submit" class="btn btn-danger boton">Cerrar Sesión</button><br>
                </form>
              </div>
            </div>
          </div>
        </div>

        <div class=" col-lg-10 col-md-8 col-xs-12 col-sm-12">
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

            <!--Añadir usuario-->
            <div class="col-lg-3 col-md-4 col-xs-12 col-sm-12">
              <h3 tabindex='2'>Añadir usuario</h3>
              <form  action="gestion_usuarios/add_user.php" method="post">
                <div class="form-group">
                  <label tabindex='2'>Nombre de usuario</label>
                  <input tabindex='2' class="form-control" placeholder="Introduce usuario" name="usuario">
                </div>
                <div class="form-group">
                  <label  tabindex='2'>Contraseña</label>
                  <input tabindex='2' type="password" class="form-control" placeholder="Contraseña" name="password">
                </div>

                <!--<button type='submit' class='btn btn-info' name='modificar'>Modificar</button>-->
                <button tabindex='2' type='button' class='btn btn-success' data-toggle='modal' data-target='#modal_anadir_usuario'>Añadir usuario</button>


                <div id='modal_anadir_usuario' class='modal fade' role='dialog'>
                  <div class='modal-dialog'>
                    <!-- Modal content-->
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <button  tabindex='3' type='button' class='close' data-dismiss='modal'>&times;</button>
                        <h4  tabindex='2' class='modal-title'>Añadir usuario</h4>
                      </div>
                      <div class='modal-body'>
                        <p tabindex='3'>¿Está seguro que desea añadir un usuario?</p>
                      </div>
                      <div class='modal-footer'>
                          <button  tabindex='3' type='submit' class='btn btn-success boton' name='modificar'>Añadir</button><br>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>

            <!--Modificar usuario-->
            <div class="col-lg-offset-1 col-lg-3 col-md-4 col-xs-12 col-sm-12">
              <h3 tabindex='3'>Modificar usuario</h3>
              <form  action="gestion_usuarios/modi_user.php" method="post">
                <div class="form-group">
                  <label tabindex='3' >Nombre de usuario</label>
                  <select tabindex='3' name="users[]" class="form-control">
                    <option disabled selected>Elija su usuario</option>
                    <?php
                      while($usu = pg_fetch_assoc($users)){
                        $user = $usu['nombre'];
                        echo "<option  value='$user'>$user</option>";
                      }
                     ?>
                  </select>
                </div>
                <div class="form-group">
                  <label tabindex='3' >Nueva contraseña</label>
                  <input tabindex='3' type="password" class="form-control"  placeholder="Contraseña" name="password">
                </div>

                <button tabindex='3' type='button' class='btn btn-primary' data-toggle='modal' data-target='#modal_modificar_usuario'>Modificar usuario</button>

                <div id='modal_modificar_usuario' class='modal fade' role='dialog'>
                  <div class='modal-dialog'>
                    <!-- Modal content-->
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <button  tabindex='4' type='button' class='close' data-dismiss='modal'>&times;</button>
                        <h4  tabindex='3' class='modal-title'>Modificar usuario</h4>
                      </div>
                      <div class='modal-body'>
                        <p tabindex='4' >¿Está seguro que desea modificar un usuario?</p>
                      </div>
                      <div class='modal-footer'>
                          <button  tabindex='4' type='submit' class='btn btn-primary boton' name='modificar'>Modificar</button><br>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>

            <!--Borrar usuario-->
            <div class="col-lg-offset-1 col-lg-3 col-md-4 col-xs-12 col-sm-12">
              <h3 tabindex='4'>Borrar usuario</h3>
              <form action="gestion_usuarios/borrar_user.php" method="post">
                <div class="form-group">
                  <label tabindex='4' >Nombre de usuario</label>
                  <select  tabindex='4' name="users[]" class="form-control">
                    <option disabled selected>Elija su usuario</option>
                    <?php
                      while($usu2 = pg_fetch_assoc($users2)){
                        $user2 = $usu2['nombre'];
                        echo "<option  value='$user2' >$user2</option>";
                      }
                     ?>
                  </select>
                </div>

                <button tabindex='4'  type='button' class='btn btn-danger' data-toggle='modal' data-target='#modal_eliminar_usuario'>Eliminar usuario</button>

                <div id='modal_eliminar_usuario' class='modal fade' role='dialog'>
                  <div class='modal-dialog'>
                    <!-- Modal content-->
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <button  tabindex='5' type='button' class='close' data-dismiss='modal'>&times;</button>
                        <h4  tabindex='4' class='modal-title'>Eliminar usuario</h4>
                      </div>
                      <div class='modal-body'>
                        <p tabindex='5' >¿Está seguro que desea eliminar un usuario?</p>
                      </div>
                      <div class='modal-footer'>
                          <button  tabindex='5' type='submit' class='btn btn-danger boton' name='modificar'>Eliminar</button><br>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>

        </div>
      </div>

    <!--Footer-->
    <br><br><br><br><br>
    <div class="navbar navbar-inverse navbar-fixed-bottom" role='contentinfo'>
      <div class="container">
        <p tabindex='5' class="navbar-text pull-left">© 2017 Alexander Cole Mora
          <a title='Acceder a la página web de laUniversidad de La Laguna' tabindex='5' href="https://www.ull.es/" target="_blank" >Universidad de La Laguna</a>
        </p>
      </div>
    </div>



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script type="text/javascript" src="../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../js/administracion.js"></script>

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
  </body>
</html>

<?php
   }else {
       header("Location: ../index.php");
   }
?>
