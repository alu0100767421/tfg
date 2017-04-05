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
        <div class="col-lg-2 col-md-4 col-xs-6 col-sm-6 ">
          <ul class="list-unstyled panel">
            <li><a href="administracion.php">Inicio</a></li>
            <li><a href="#">Consultar BBDD</a></li>
            <li><a href="#">Añadir BBDD</a></li>
            <li><a href="gestion_usuarios.php">Gestión Usuarios</a></li>
          </ul>
          <div class="row">
            <form action="cerrar_sesion.php" method="post">
              <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <button type="submit" class="btn btn-danger boton">Cerrar Sesión</button><br>
              </div>
            </form>
          </div>
        </div>
        <div class=" col-lg-10 col-md-8 col-xs-12 col-sm-12 contenido">
          <div class="row">

            <!--Añadir usuario-->
            <div class="col-lg-3 col-md-3 col-xs-12 col-sm-12">
              <h3>Añadir usuario</h3>
              <form role="form" action="gestion_usuarios/add_user.php" method="post">
                <div class="form-group">
                  <label>Nombre de usuario</label>
                  <input class="form-control" placeholder="Introduce usuario" name="usuario">
                </div>
                <div class="form-group">
                  <label >Contraseña</label>
                  <input type="password" class="form-control" placeholder="Contraseña" name="password">
                </div>
                <button type="submit" class="btn btn-success">Añadir usuario</button>
              </form>
            </div>

            <!--Modificar usuario-->
            <div class="col-lg-offset-1 col-lg-3 col-md-4 col-xs-12 col-sm-12">
              <h3>Modificar usuario</h3>
              <form role="form" action="gestion_usuarios/modi_user.php" method="post">
                <div class="form-group">
                  <label>Nombre de usuario</label>
                  <select name="users[]" class="form-control">
                    <option disabled selected>Elija su usuario</option>
                    <?php
                      while($usu = pg_fetch_assoc($users)){
                        $user = $usu['nombre'];
                        echo "<option type='text' value='$user' name='$user'>$user</option>";
                      }
                     ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Nueva contraseña</label>
                  <input type="password" class="form-control"  placeholder="Contraseña" name="password">
                </div>
                <button type="submit" class="btn btn-primary">Modicar usuario</button>
              </form>
            </div>

            <!--Borrar usuario-->
            <div class="col-lg-offset-1 col-lg-3 col-md-4 col-xs-12 col-sm-12">
              <h3>Borrar usuario</h3>
              <form role="form" action="gestion_usuarios/borrar_user.php" method="post">
                <div class="form-group">
                  <label>Nombre de usuario</label>
                  <select name="users[]" class="form-control">
                    <option disabled selected>Elija su usuario</option>
                    <?php
                      while($usu2 = pg_fetch_assoc($users2)){
                        $user2 = $usu2['nombre'];
                        echo "<option type='text' value='$user2' name='$user2'>$user2</option>";
                      }
                     ?>
                  </select>
                </div>
                <button type="submit" class="btn btn-danger">Eliminar usuario</button>
              </form>
            </div>
          </div>

        </div>
      </div>

    </div>

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
