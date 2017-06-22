<?php

  $link = require("pages/connect_bbdd.php");

  $consulta = "SELECT nombre FROM usuarios;";
  $users = pg_query($link, $consulta);
  echo pg_last_error();

?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Página de inicio del Sistema Geográfico de Paleontología de Canarias</title>

    <link rel="icon" type="/image/png" href="images/logoULL/logotipo-secundario-ULL.png" />
    <link type="text/css" rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="css/index.css"/>
    <link type="text/css" rel="stylesheet" href="css/validar_cookie.css"/>

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
          <a tabindex="1" class="navbar-brand" href="https://www.ull.es/"><img class="imagen-menu" alt="Universidad de La Laguna" src="images/logoULL/logotipo-principal-recortada.png"></a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li><a tabindex="1" title='acceso al inicio' href="index.php">Inicio</a></li>
            <li><a tabindex="1" title='acceso al mapa' href="pages/mapa.php">Mapa</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <!--FIN DE MENU-->


    <div class="cuerpo">
      <div class="row">
        <div class="col-lg-2 col-md-4 col-xs-2 col-sm-2 titulo">
          <h1 tabindex="1">Sistema Geográfico de Paleontología de Canarias</h1>
        </div>
      </div>

      <div class="row ">
        <div class="col-lg-5 col-md-8 col-xs-12 col-sm-12 formulario">
          <form action="pages/autenticacion_usuarios.php" method="post">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <h4 tabindex="1">Acceso Administración</h4>
              </div>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1" tabindex="1">Usuario</label>
              <select tabindex="1" name="users[]" class="form-control">
                <option disabled selected>Elija su usuario</option>

                <?php
                  while($usu = pg_fetch_assoc($users)){
                    $user = $usu['nombre'];
                    echo "<option type='text' value='$user' name='$user'>$user</option>";
                  }
                  pg_free_result($users);
                 ?>

              </select>
            </div>
            <div class="form-group">
              <label tabindex="1" for="exampleInputPassword1">Contraseña</label>
              <input tabindex="1" type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Contraseña">
            </div>
            <div class="row botones-formulario">
              <div class="col-lg-1 col-md-3 col-xs-12 col-sm-7">
                <button title='acceso al servicio de administración' tabindex="1" type="submit" class="btn btn-success">Acceder</button><br>
              </div>
              <div class="col-lg-offset-8 col-lg-1 col-md-offset-4 col-md-3 col-xs-offset-0  col-xs-3 col-sm-3">
                <a title='acceso al mapa' tabindex="1" class="btn btn-info" href="pages/mapa.php" role="button">Mapa</a>
              </div>
            </div>
          </form>
        </div>




      </div>
    </div>
    <div class="cookie" id="cookie">
      <div class="cookie_texto">
        <p tabindex="1">Esta web utiliza cookies para el funcionamiento de la navegación de sus usuarios. Si continúas navegando consideramos que aceptas su uso.
        <a title='información sobre las cookies' tabindex="1" href="https://www.google.es/intl/es/policies/technologies/cookies/">Más información</a>
        <a title='Cerrar aviso de cookies' tabindex="1" onclick="aceptar_cookies();">Cerrar</a></p>
      </div>
    </div>

    <!--Footer-->
    <br><br><br><br><br>
    <div class="navbar navbar-inverse navbar-fixed-bottom">
      <div class="container">
        <p tabindex="1" class="navbar-text pull-left">© 2017 Alexander Cole Mora
          <a tabindex="1" title='acceso a la página web de la Universidad de La Laguna' href="https://www.ull.es/" target="_blank" >Universidad de La Laguna</a>
        </p>
      </div>
    </div>



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script type="text/javascript" src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/index.js"></script>
  <script type="text/javascript" src="js/validar_cookies.js"></script>
  </body>
</html>
