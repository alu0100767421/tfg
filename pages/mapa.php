<?php

  $link = require("connect_bbdd.php");
  echo pg_last_error();

  $consulta="SELECT idyacimiento,yacimiento,latitud,longitud
             FROM yacimiento NATURAL JOIN ubicacion
             WHERE latitud!=0 and longitud!=0;";
  $resultado=pg_query($link,$consulta);
  $array_puntos_PHP=array();
  while($resolucion=pg_fetch_array($resultado)){
    //$array_puntos_PHP[$i]= $resolucion
    array_push($array_puntos_PHP,$resolucion);
    /*echo "
      <p>".$resolucion['yacimiento']."</p>
      <p>".$resolucion['latitud']."</p>
      <p>".$resolucion['longitud']."</p>

    ";*/
  }

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Mapa del servicio Sistema Geográfico de Paleontología de Canarias</title>

  <link rel="icon" type="image/png" href="../images/logoULL/logotipo-secundario-ULL.png" />
  <link type="text/css" rel="stylesheet" href="../bootstrap-3.3.7-dist/css/bootstrap.min.css">
  <link type="text/css" rel="stylesheet" href="../css/mapa.css"/>
</head>

<body>
<script src="http://d3js.org/d3.v3.min.js"></script>
  <nav class="navbar navbar-default">
    <div class="container-fluid">

      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a tabindex="1" class="navbar-brand" href="https://www.ull.es/"><img class="imagen-menu" alt="Universidad de La Laguna" title="Universidad de La Laguna" src="../images/logoULL/logotipo-principal-recortada.png"></a>
      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <li><a tabindex="1" title='acceso al inicio' href="administracion.php">Inicio</a></li>
          <li><a tabindex="1" title='acceso al mapa' href="mapa.php">Mapa</a></li>
        </ul>
      </div>

    </div>
  </nav>
  <div class="row">
    <div class="col-sm-12 col-md-12 col-lg-8" >
      <h3 tabindex="1" class="margen_izquierdo">Mapa Geográfico de Paleontología de las Islas Canarias</h3>
      <hr class="linea margen_izquierdo">
      <div class="row">
        <div  class="col-lg-1 form-group">
          <h5 tabindex="1" class="margen_izquierdo">Municipio:</h5>
        </div>
        <div id="municipio" class="col-xs-7 col-sm-6 col-md-4 col-lg-3 form-group">
          <input tabindex="1" type="text" class="form-control margen_izquierdo input_municipio" id="Municipio" name="Municipio" placeholder="Seleccione un municipio">
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 mapa" id="mapa" tabindex="1">
          <article>
          </article>
        </div>
      </div>
    </div>


    <div class="col-sm-12 col-md-12 col-lg-4">
      <h3 tabindex="1" class="">Yacimiento Consultado</h3>
      <hr class="linea">
      <div class="row">
        <?php
          $link= require('connect_bbdd.php');
          if (isset($_COOKIE['yacimiento'])) {
            $yacimiento=$_COOKIE['yacimiento'];
          }
          if($yacimiento!=""){
            //consulta sobre la ubicacion
            $consulta="SELECT idyacimiento,yacimiento,isla,municipio,localidad,tipo_yacimiento,altura,edad,observacion_yacimiento
                       FROM yacimiento NATURAL JOIN ubicacion
                       WHERE yacimiento='".$yacimiento."';";
            $resolucion=pg_query($link,$consulta);
            if(pg_num_rows($resolucion)>0){
              $resultado=pg_fetch_assoc($resolucion);
              $idyacimiento=$resultado['idyacimiento'];
              $isla=$resultado['isla'];
              $municipio=$resultado['municipio'];
              $localidad=$resultado['localidad'];
              $tipo=$resultado['tipo_yacimiento'];
              $altura=$resultado['altura'];
              if($altura==-999)
                $altura="DESCONOCIDO";
              $edad=$resultado['edad'];
              $observacion=$resultado['observacion_yacimiento'];

              echo "
              <div class='row'>
                <div class='col-sm-12 col-md-6 col-lg-10 margen_izquierdo'>
                  <h5 tabindex='1'><b>Yacimiento</B>: $yacimiento</h5>
                </div>
              </div>
              <div class='row'>
                <div class='col-sm-12 col-md-6 col-lg-10 margen_izquierdo'>
                  <h5 tabindex='1'><b>Isla</B>: $isla</h5>
                </div>
              </div>
              <div class='row'>
                <div class='col-sm-12 col-md-6 col-lg-10 margen_izquierdo'>
                  <h5 tabindex='1'><b>Municipio</B>: $municipio</h5>
                </div>
              </div>
              <div class='row'>
                <div class='col-sm-12 col-md-6 col-lg-10 margen_izquierdo'>
                  <h5 tabindex='1'><b>Localidad</B>: $localidad</h5>
                </div>
              </div>
              <div class='row'>
                <div class='col-sm-12 col-md-6 col-lg-10 margen_izquierdo'>
                  <h5 tabindex='1'><b>Tipo</B>: $tipo</h5>
                </div>
              </div>
              <div class='row'>
                <div class='col-sm-12 col-md-6 col-lg-10 margen_izquierdo'>
                  <h5 tabindex='1'><b>Altura</B>: $altura</h5>
                </div>
              </div>
              <div class='row'>
                <div class='col-sm-12 col-md-6 col-lg-10 margen_izquierdo'>
                  <h5 tabindex='1'><b>Edad</B>: $edad</h5>
                </div>
              </div>
              <div class='row'>
                <div class='col-sm-12 col-md-6 col-lg-10 margen_izquierdo'>
                  <h5 tabindex='1'><b>Observación</B>: $observacion</h5>
                </div>
              </div>
              ";
            }
            $consulta="SELECT especie
                       FROM yacimiento NATURAL JOIN especie has NATURAL JOIN yacimiento_has_especie
                       WHERE yacimiento='".$yacimiento."';";
            $resolucion=pg_query($link,$consulta);
            if(pg_num_rows($resolucion)>0){
              echo "
              <div class='row'>
                <div class='col-sm-12 col-md-6 col-lg-10 margen_izquierdo'>
                  <h5 tabindex='1'><b>Especies</B>:
              ";

              while($resultado=pg_fetch_assoc($resolucion)){
                $especie=$resultado['especie'];
                echo "$especie; ";
              }

              echo "
                  </h5>
                </div>
              </div>
              ";

            }


          }
          /*echo "$yacimiento";
          echo $idyacimiento;*/

         ?>

      </div>
    </div>
  </div>



  <!--Footer-->
  <br><br><br><br><br>
  <div class="navbar navbar-inverse navbar-fixed-bottom footer">
    <div class="container">
      <p tabindex="1" class="navbar-text pull-left">© 2017 Alexander Cole Mora
        <a title='acceso a la página web de la Universidad de La Laguna' tabindex="1" href="https://www.ull.es/" target="_blank" >Universidad de La Laguna</a>
      </p>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script type="text/javascript" src="../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  <script type="text/javascript">var array_puntos =<?php echo json_encode($array_puntos_PHP); ?>;</script>
  <script type="text/javascript" src="../js/mapa.js"></script>



</body>
</html>
