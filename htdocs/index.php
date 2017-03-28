<?php

  /*$link = require("pages/connect_bbdd.php");

  $consulta = 'SELECT USUARIOS FROM USUARIOS;';
  $users = pg_query($link, $consulta) or die(pg_error($link));
*/

?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sistema Geográfico de Paleontología de Canarias</title>

    <link rel="icon" type="/image/png" href="images/logoULL/logotipo-secundario-ULL.png" />
    <link type="text/css" rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="css/index.css"/>

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
          <a class="navbar-brand" href="https://www.ull.es/"><img id="imagen-menu" alt="ULL" src="images/logoULL/logotipo-principal-recortada.png"></a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="pages/mapa.php">Mapa</a></li>
          </ul>
        </div>

      </div>
    </nav>
    <!--FIN DE MENU-->
    <div class="cuerpo">
      <div class="row">
        <div class="col-lg-2 col-md-4 col-xs-2 col-sm-2 titulo">
          <h1>Sistema Geográfico de Paleontología de Canarias</h1>
        </div>
      </div>

      <div class="row ">
        <div class="col-lg-3 col-md-6 col-xs-12 col-sm-12 formulario">
          <form>
            <div class="row">
              <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <h4>Acceso Administración</h4>
              </div>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Usuario</label>
              <select class="form-control">
                <option disabled selected>Elija su usuario</option>

                <?php
                  while($usu = pg_fetch_assoc($users)){
                    $user = $usu['usuario'];
                    echo "<option type='text' value='$user' name='$user'>$user</option>";
                  }
                  pg_free_result($users);
                 ?>

              </select>

              <!--<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Usuario">-->
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Contraseña</label>
              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña">
            </div>
            <div class="row botones-formulario">
              <div class="col-lg-3 col-md-3 col-xs-12 col-sm-3">
                <button type="submit" class="btn btn-success">Enviar</button><br>
              </div>
              <div class=" col-lg-3 col-md-3 col-xs-12 col-sm-3">
                <a class="btn btn-info" href="pages/mapa.php" role="button">Acceso libre al mapa</a>
              </div>
            </div>
          </form>
        </div>



      </div>
    </div>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script type="text/javascript" src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/index.js"></script>
  </body>
</html>
