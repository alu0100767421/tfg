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
          <a class="navbar-brand" href="https://www.ull.es/"><img class="imagen-menu" alt="Universidad de La Laguna" title="Universidad de La Laguna" src="../../images/logoULL/logotipo-principal-recortada.png"></a>
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
            <li id="consultar"><span class="glyphicon glyphicon-search" aria-hidden="true"></span><a href="../consultar_bbdd.php">Consultar BBDD</a></li>
            <li><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span><a href="../valoracion.php">Valoraciones</a>
              <ul class="list-unstyled" id="submenu_valoracion">
                <li class="destacar"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a href="../valoraciones/add_valoracion.php">Añadir Valoración</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a href="../valoraciones/consultar_valoracion.php">Consultar Valoración</a></li>
              </ul>
            </li>
            <li id="add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span><a href="../add_bbdd.php">Añadir BBDD</a>
              <ul style="display:none" class="list-unstyled" id="submenu">
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a href="../anadir/yacimiento.php">Yacimiento</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a href="../anadir/especie.php">Especie</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a href="../anadir/excavacion.php">Excavación</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a href="../anadir/publicacion.php">Publicación</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a href="../anadir/deposito.php">Depósito</a></li>
              </ul>

            </li>
            <?php
              //echo "Este es el usuario $username";
              if ($username == "admin") {
                echo "<li><span class='glyphicon glyphicon-user' aria-hidden='true'></span><a href='gestion_usuarios.php'>Gestión Usuarios</a></li>";
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
          <!--Yacimiento-->
          <div class="row">
            <div class="col-lg-offset-0 col-lg-10">
              <h2 class="titulos">Consultar Valoración</h2>
              <p>A continuación, podrá consultar o modificar la valoración de un yacimiento.</p>
                <div class="row">
                  <div class="col-lg-2 form-group">
                    <select name="Yacimientos_Valoracion" id="Yacimientos_Valoracion" class="form-control" onchange="yacimientovaloracion(this.value)">
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
                   <input type="hidden" name="yacimiento" id="yacimiento">
                </div>
                <div class="row">
                  <div class="col-lg-2 col-md-3 col-xs-12 col-sm-3">
                    <button type="submit" class="btn btn-success" onclick="consultar()">Enviar</button>
                  </div>
                </div>


                <?php
                $link= require('../connect_bbdd.php');

                if(isset($_COOKIE['yacimiento'])){
                  $yacimiento=$_COOKIE['yacimiento'];
                }

                $consulta_id_y="SELECT idyacimiento
                              FROM yacimiento
                              WHERE yacimiento='".$yacimiento."';";
                $id_y=pg_query($link,$consulta_id_y);
                echo pg_last_error();
                $valor_id_y=pg_fetch_assoc($id_y);
                $id_yacimiento=$valor_id_y['idyacimiento'];
                //echo "id del yacimiento: $id_yacimiento\n";

                $consulta="SELECT idvaloracion,valor
                                 FROM valoracion
                                 WHERE idyacimiento='".$id_yacimiento."'";

                $resultado=pg_query($link,$consulta);
                $resolucion=pg_fetch_assoc($resultado);
                $id_valoracion= $resolucion['idvaloracion'];
                $valoracion= $resolucion['valor'];

                if($yacimiento!="" && $yacimiento!="NINGUNO"){
                  //VALORACION CIENTIFICA
                  $consulta_cientifico="SELECT *
                                        FROM valoracion_cientifica
                                        WHERE idvaloracion='".$id_valoracion."';";
                  $resultado=pg_query($link,$consulta_cientifico);
                  $resolucion=pg_fetch_assoc($resultado);
                  $tipo_fosiles= $resolucion['tipo_fosiles'];
                  $taxones= $resolucion['diversidad_taxones'];
                  $edad= $resolucion['edad_yacimiento'];
                  $localidad= $resolucion['localidad_tipo'];
                  $conservacionfosiles= $resolucion['estado_conservacion_fosiles'];
                  $tafonomica= $resolucion['informacion_tafonomica'];
                  $bioestatigrafica= $resolucion['informacion_bioestratigrafica'];
                  $geologico= $resolucion['interes_geologico'];
                  $paleoclimatico= $resolucion['interes_paleoclimatico'];
                  $geomorfologico= $resolucion['valor_geomorfologico'];
                  $abuyacimiento= $resolucion['abundancia_yacimientos'];
                  $tiyacimiento= $resolucion['tipo_yacimientos'];
                  $datacion= $resolucion['tipo_datacion'];
                  $arqueologicos= $resolucion['asociacion_restos_arqueologicos'];

                  //valoracion SOCIOCULTURAL
                  $consulta_cultural="SELECT *
                                        FROM valoracion_socio_cultural
                                        WHERE idvaloracion='".$id_valoracion."';";
                  $resultado=pg_query($link,$consulta_cultural);
                  $resolucion=pg_fetch_assoc($resultado);
                  $didactico = $resolucion['interes_didactico'];
                  $geografica= $resolucion['situacion_geografica'];
                  $historico= $resolucion['valor_historico'];
                  $conocimiento= $resolucion['nivel_conocimiento'];
                  $valor= $resolucion['valor_complementario'];
                  $proteccion= $resolucion['figura_proteccion'];

                  //valoracion SOCIOECONOMICA
                  $consulta_economica="SELECT *
                                        FROM valoracion_socio_economica
                                        WHERE idvaloracion='".$id_valoracion."';";
                  $resultado=pg_query($link,$consulta_economica);
                  $resolucion=pg_fetch_assoc($resultado);
                  $turistico = $resolucion['potencial_turistico'];

                  //VALORACION CIENTIFICA
                  $consulta_riesgo="SELECT *
                                        FROM riesgo_deterioro
                                        WHERE idvaloracion='".$id_valoracion."';";
                  $resultado=pg_query($link,$consulta_riesgo);
                  $resolucion=pg_fetch_assoc($resultado);
                  $fragilidad= $resolucion['fragilidad_deposito'];
                  $accesibilidad= $resolucion['situacion_geografica'];
                  $edificacion= $resolucion['edificaciones'];
                  $cantera= $resolucion['valor_minero'];
                  $vias= $resolucion['vias_comunicacion'];
                  $vertedero= $resolucion['vertederos'];
                  $comercio= $resolucion['coleccionismo'];
                  $erosion= $resolucion['erosion_natural'];



                  echo "
                  <hr class='linea'>
                  <div class='row'>
                    <div class='col-lg-3 form-group'>
                      <p>El yacimiento consultado es: <b>$yacimiento</b></p>
                    </div>
                  </div>
                  <div class='row'>
                    <div class='col-lg-3 form-group'>
                      <p>Valoracion Total: <b>$valoracion</b></p>
                    </div>
                  </div>
                  ";

                  echo "
                  <!-- Valoracion cientifica-->
                  <form class='' action='valoraciones/modificar_valoracion.php' method='post'>
                    <div class='row'>
                      <div class='col-lg-3'>
                        <h4>Valoración Científica</h4>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-lg-3 form-group'>
                        <select name='' id='' class='form-control' onchange='tipofosiles(this.value)'>
                          <option disabled selected>TIPO FÓSILES: $tipo_fosiles</option>
                          <option type='text' value='0' name=''>Fósiles comunes y/o no endémicos</option>
                          <option type='text' value='1' name=''>Hasta el 30% de fósiles raros y/o especies endémicas</option>
                          <option type='text' value='2' name=''>Entre 30% y 60% de fósiles raros y/o especies endémicas</option>
                          <option type='text' value='3' name=''>Más del 60% de fósiles raros y/o de especies endémicas</option>
                        </select>
                      </div>
                      <input type='hidden' name='tipo_fosiles' id='tipo_fosiles' value='$tipo_fosiles'>

                      <div class='col-lg-3 form-group'>
                        <select name='' id='' class='form-control' onchange='diversidadtaxones(this.value)''>
                          <option disabled selected>DIVERSIDAD DE TAXONES: $taxones</option>
                          <option type='text' value='0' name=''>Solo un taxón</option>
                          <option type='text' value='1' name=''>Más de una especie de invertebrados o vertebrados o plantas</option>
                          <option type='text' value='2' name=''>Invertebrados+vertebrados o plantas</option>
                          <option type='text' value='3' name=''>Invertebrados+vertebrado+plantas</option>
                        </select>
                      </div>
                      <input type='hidden' name='taxones' id='taxones'>

                      <div class='col-lg-3 form-group'>
                        <select name='' id='' class='form-control' onchange='edadyacimiento(this.value)'>
                          <option disabled selected>EDAD YACIMIENTO: $edad</option>
                          <option type='text' value='0' name=''>Más de 10 yacimientos de una detemrinada edad</option>
                          <option type='text' value='1' name=''>Entre 10-5 yacimientos de una determinada edad</option>
                          <option type='text' value='2' name=''>5-2 yacimientos de una determinada edad</option>
                          <option type='text' value='3' name=''>1 yacimientos de una determinada edad</option>
                        </select>
                      </div>
                      <input type='hidden' name='edad' id='edad'>

                      <div class='col-lg-3 form-group'>
                        <select name='' id='' class='form-control' onchange='localidadtipo(this.value)''>
                          <option disabled selected>LOCALIDAD TIPO: $localidad</option>
                          <option type='text' value='0' name=''>No</option>
                          <option type='text' value='3' name=''>Si se ha descrito una especie por primera vez en esa localidad</option>
                        </select>
                      </div>
                      <input type='hidden' name='localidad' id='localidad'>
                   </div>

                   <div class='row'>
                     <div class='col-lg-3 form-group'>
                       <select name='' id='' class='form-control' onchange='estadoconservacion(this.value)''>
                         <option disabled selected>ESTADO CONSERVACIÓN FÓSILES: $conservacionfosiles</option>
                         <option type='text' value='0' name=''>Todos los restos fragmentados</option>
                         <option type='text' value='1' name=''>Esqueletos completos con alteraciones tafonómicas</option>
                         <option type='text' value='2' name=''>Esqueletos completos sin alteraciones</option>
                         <option type='text' value='3' name=''>Partes blandas (piel,etc)</option>
                       </select>
                     </div>
                     <input type='hidden' name='conservacionfosiles' id='conservacionfosiles'>

                     <div class='col-lg-3 form-group'>
                       <select name='' id='' class='form-control' onchange='informaciontafonomica(this.value)''>
                         <option disabled selected>INFORMACIÓN TAFONÓMICA: $tafonomica</option>
                         <option type='text' value='0' name=''>Se conoce la zona de procedencia de los fósiles</option>
                         <option type='text' value='1' name=''>Se conoce la capa/nivel</option>
                         <option type='text' value='2' name=''>Se conoce el lugar exacto</option>
                         <option type='text' value='3' name=''>Los fósiles proceden de una excavación metódica</option>
                       </select>
                     </div>
                     <input type='hidden' name='tafonomica' id='tafonomica'>
                     <div class='col-lg-3 form-group'>
                       <select name='' id='' class='form-control' onchange='infobioestatigrafica(this.value)'>
                         <option disabled selected>INFORMACIÓN BIOESTATIGRÁFICA: $bioestatigrafica</option>
                         <option type='text' value='0' name=''>Sin fósiles zonadores</option>
                         <option type='text' value='1' name=''>Con fósiles zonadores para correlacionar a nivel local (una isla)</option>
                         <option type='text' value='2' name=''>Con fósiles zonadores para correlacionar a nivel regional (entre islas)</option>
                         <option type='text' value='3' name=''>Con fósiles zonadores para correlacionar a nivel global(Canarias/Mediterráneo)</option>
                       </select>
                     </div>
                     <input type='hidden' name='bioestatigrafica' id='bioestatigrafica'>

                     <div class='col-lg-3 form-group'>
                       <select name='' id='' class='form-control' onchange='interesgeologico(this.value)''>
                         <option disabled selected>INTERÉS GEOLÓGICO: $geologico</option>
                         <option type='text' value='0' name=''>Sin interés especial</option>
                         <option type='text' value='1' name=''>Importancia vulcanoestratigráfica o tecntónica o geodiversidad alta</option>
                         <option type='text' value='2' name=''>Dos de las propiedades anteriores</option>
                         <option type='text' value='3' name=''>Importancia vulcanoestratigráfica+tectónica+geodiversidad</option>
                       </select>
                     </div>
                     <input type='hidden' name='geologico' id='geologico'>

                   </div>

                   <div class='row'>
                     <div class='col-lg-3 form-group'>
                       <select name='' id='' class='form-control' onchange='interespaleoclimatico(this.value)''>
                         <option disabled selected>INTERÉS PALEOCLIMÁTICO: $paleoclimatico</option>
                         <option type='text' value='0' name=''>No se puede reconstruir ningún evento climático</option>
                         <option type='text' value='1' name=''>Reconstrucción de un evento climático</option>
                         <option type='text' value='2' name=''>Reconstrucción de un ciclo climático(más de un evento)</option>
                         <option type='text' value='3' name=''>Reconstrucción de más de un ciclo climático</option>
                       </select>
                     </div>
                     <input type='hidden' name='paleoclimatico' id='paleoclimatico'>

                     <div class='col-lg-3 form-group'>
                       <select name='' id='' class='form-control' onchange='valorgeomorfologico(this.value)'>
                         <option disabled selected>VALOR GEOMORFOLÓGICO: $geomorfologico</option>
                         <option type='text' value='0' name=''>Sin interés</option>
                         <option type='text' value='1' name=''>Asociado a un ámbito de la geomorfología</option>
                         <option type='text' value='2' name=''>Asociado a dos ámbitos de la geomorfología</option>
                         <option type='text' value='3' name=''>Asociado a tres ámbitos de la geomorfología(estructural,dinámica y climática)</option>
                       </select>
                     </div>
                     <input type='hidden' name='geomorfologico' id='geomorfologico'>
                     <div class='col-lg-3 form-group'>
                       <select name='' id='' class='form-control' onchange='abundanciayacimiento(this.value)'>
                         <option disabled selected>ABUNDANCIA DE YACIMIENTOS: $abuyacimiento</option>
                         <option type='text' value='0' name=''>Más de 10 en la isla</option>
                         <option type='text' value='1' name=''>Entre 10-5 en la isla</option>
                         <option type='text' value='2' name=''>Entre 5-2 en la isla</option>
                         <option type='text' value='3' name=''>1 yacimiento en la isla</option>
                       </select>
                     </div>
                     <input type='hidden' name='abuyacimiento' id='abuyacimiento'>

                     <div class='col-lg-3 form-grou'>
                       <select name='' id='' class='form-control' onchange='tipoyacimiento(this.value)'>
                         <option disabled selected>TIPO DE YACIMIENTO: $tiyacimiento</option>
                         <option type='text' value='0' name=''>Más de 10 en la isla</option>
                         <option type='text' value='1' name=''>Entre 10-5 en la isla</option>
                         <option type='text' value='2' name=''>Entre 5-2 en la isla</option>
                         <option type='text' value='3' name=''>1 yacimiento de un determinado tipo en la isla</option>
                       </select>
                     </div>
                     <input type='hidden' name='tiyacimiento' id='tiyacimiento'>
                   </div>

                   <div class='row'>
                     <div class='col-lg-3 form-group'>
                       <select name='' id='' class='form-control' onchange='tipodatacion(this.value)'>
                         <option disabled selected>TIPO DATACIÓN: $datacion</option>
                         <option type='text' value='0' name=''>Sin datos</option>
                         <option type='text' value='1' name=''>Fauna</option>
                         <option type='text' value='2' name=''>Datación radiométrica</option>
                         <option type='text' value='3' name=''>Fauna y datación radiométrica</option>
                       </select>
                     </div>
                     <input type='hidden' name='datacion' id='datacion'>
                     <div class='col-lg-4 form-group'>
                       <select name='' id='' class='form-control' onchange='restosarqueologicos(this.value)'>
                         <option disabled selected>ASOCIACIÓN RESTOS ARQUEOLÓGICOS: $arqueologicos</option>
                         <option type='text' value='0' name=''>No</option>
                         <option type='text' value='1' name=''>Con restos de animales domésticos y/o plantas que acompañan al hombre</option>
                         <option type='text' value='2' name=''>Además con restos de cerámica y otras manifestaciones culturales</option>
                         <option type='text' value='3' name=''>Además con los restos de los hombres</option>
                       </select>
                     </div>
                     <input type='hidden' name='arqueologicos' id='arqueologicos'>
                   </div>
                    <!--fin Valoracion cientifica-->


                    <!-- Valoracion socio cultural-->
                    <div class='row'>
                      <div class='col-lg-3'>
                        <h4>Valoración Socio Cultural</h4>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-lg-3 form-group'>
                        <select name='' id='' class='form-control' onchange='interesdidactico(this.value)''>
                          <option disabled selected>INTERÉS DIDÁCTICO: $didactico</option>
                          <option type='text' value='0' name=''>No</option>
                          <option type='text' value='1' name=''>Se ve el medio sedimentario</option>
                          <option type='text' value='2' name=''>Se reconocen los fósiles sin dificultad</option>
                          <option type='text' value='3' name=''>Se puede interpretar el paleoambiente</option>
                        </select>
                      </div>
                      <input type='hidden' name='didactico' id='didactico'>

                      <div class='col-lg-3 form-group'>
                        <select name='' id='' class='form-control' onchange='situaciongeografica(this.value)''>
                          <option disabled selected>SITUACIÓN GEOGRÁFICA: $geografica</option>
                          <option type='text' value='0' name=''>A más de 50 km de una población</option>
                          <option type='text' value='1' name=''>Entre 50 y 20 km  de una población</option>
                          <option type='text' value='2' name=''>Entre 0 y 20 km de una población</option>
                          <option type='text' value='3' name=''>Incluida en el casco de una población</option>
                        </select>
                      </div>
                      <input type='hidden' name='geografica' id='geografica'>
                      <div class='col-lg-3 form-group'>
                        <select name='' id='' class='form-control' onchange='valorhistorico(this.value)'>
                          <option disabled selected>VALOR HISTÓRICO: $historico</option>
                          <option type='text' value='0' name=''>Siglo XXI</option>
                          <option type='text' value='1' name=''>Después de 1990</option>
                          <option type='text' value='2' name=''>1900-1990</option>
                          <option type='text' value='3' name=''>Siglo XIX o anterior</option>
                        </select>
                      </div>
                      <input type='hidden' name='historico' id='historico'>

                      <div class='col-lg-3 form-group'>
                        <select name='' id='' class='form-control' onchange='nivelconocimiento(this.value)''>
                          <option disabled selected>NIVEL DE CONOCIMIENTO: $conocimiento</option>
                          <option type='text' value='0' name=''>Ninguno</option>
                          <option type='text' value='1' name=''>Pequeña colección</option>
                          <option type='text' value='2' name=''>Collección en Museo</option>
                          <option type='text' value='3' name=''>Varias referencias</option>
                        </select>
                      </div>
                      <input type='hidden' name='conocimiento' id='conocimiento'>
                    </div>

                    <div class='row'>
                      <div class='col-lg-3 form-group'>
                        <select name='' id='' class='form-control' onchange='valorcomplementario(this.value)'>
                          <option disabled selected>VALOR COMPLEMENTARIO: $valor</option>
                          <option type='text' value='0' name=''>No incluido en ninguna figura de protección</option>
                          <option type='text' value='1' name=''>Incluido en Parques(naturales o rurales)</option>
                          <option type='text' value='2' name=''>Incluido en Reservas Naturales(Integrales y especiales, Monumento natural, Paisajes protegidos y sitios de interés científico)</option>
                          <option type='text' value='3' name=''>Incluido en un Parque Nacional</option>
                        </select>
                      </div>
                      <input type='hidden' name='valor' id='valor'>
                      <div class='col-lg-3 form-group'>
                        <select name='' id='' class='form-control' onchange='figuraproteccion(this.value)'>
                          <option disabled selected>FIGURA DE PROTECCIÓN: $proteccion</option>
                          <option type='text' value='0' name=''>No se ha aplicado ninguna protección de ley de patrimonio histórico</option>
                          <option type='text' value='3' name=''>Se ha aplicacdo alguna protección de ley de patrimonio histórico</option>
                        </select>
                      </div>
                      <input type='hidden' name='proteccion' id='proteccion'>
                    </div>

                    <!--fin Valoracion socio cultural-->

                    <!-- Valoracion socio enconmica-->
                    <div class='row'>
                      <div class='col-lg-3'>
                        <h4>Valoración Socio Económica</h4>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-lg-3 form-group'>
                        <select name='' id='' class='form-control' onchange='potencialturistico(this.value)'>
                          <option disabled selected>POTENCIAL TURÍSTICO: $turistico</option>
                          <option type='text' value='0' name=''>No</option>
                          <option type='text' value='1' name=''>Solo especialistas</option>
                          <option type='text' value='2' name=''>Turismo científico</option>
                          <option type='text' value='3' name=''>Visita instructiva</option>
                        </select>
                      </div>
                      <input type='hidden' name='turistico' id='turistico'>
                    </div>
                    <!--fin Valoracion socio economica-->

                    <!-- Riesgo de deterioro-->
                    <div class='row'>
                      <div class='col-lg-3'>
                        <h4>Riesgo de deterioro</h4>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-lg-3 form-group'>
                        <select name='' id='' class='form-control' onchange='fragilidaddeldeposito(this.value)'>
                          <option disabled selected>FRAGILIDAD DEL DEPOSITO: $fragilidad</option>
                          <option type='text' value='0' name=''>Mayor de 150m</option>
                          <option type='text' value='1' name=''>Entre 100m y 150m</option>
                          <option type='text' value='2' name=''>Entre 50m y 100m</option>
                          <option type='text' value='3' name=''>Entre 1m y 50m</option>
                        </select>
                      </div>
                      <input type='hidden' name='fragilidad' id='fragilidad'>

                      <div class='col-lg-3 form-group'>
                        <select name='' id='' class='form-control' onchange='situacionaccesibilidad(this.value)'>
                          <option disabled selected>SITUACIÓN GEOGRÁFICA: $accesibilidad</option>
                          <option type='text' value='0' name=''>Sin localizar</option>
                          <option type='text' value='1' name=''>Inaccesible</option>
                          <option type='text' value='2' name=''>Difícil acceso</option>
                          <option type='text' value='3' name=''>Accesible</option>
                        </select>
                      </div>
                      <input type='hidden' name='accesibilidad' id='accesibilidad'>
                      <div class='col-lg-3 form-group'>
                        <select name='' id='' class='form-control' onchange='edificaciones(this.value)'>
                          <option disabled selected>EDIFICACIONES: $edificacion</option>
                          <option type='text' value='0' name=''>Inexistentes o lejanas</option>
                          <option type='text' value='1' name=''>Proyectadas o potencialmente urbanizable</option>
                          <option type='text' value='2' name=''>Obras iniciadas</option>
                          <option type='text' value='3' name=''>Afectación</option>
                        </select>
                      </div>
                      <input type='hidden' name='edificacion' id='edificacion'>

                      <div class='col-lg-3 form-group'>
                        <select name='' id='' class='form-control' onchange='valorminero(this.value)''>
                          <option disabled selected>VALOR MINERO/CANTERAS: $cantera</option>
                          <option type='text' value='0' name=''>Inexistentes o lejanas</option>
                          <option type='text' value='1' name=''>Proyectadas o potencialmente urbanizable</option>
                          <option type='text' value='2' name=''>Obras iniciadas</option>
                          <option type='text' value='3' name=''>Afectación</option>
                        </select>
                      </div>
                      <input type='hidden' name='cantera' id='cantera'>
                    </div>
                    <div class='row'>
                      <div class='col-lg-3 form-group'>
                        <select name='' id='' class='form-control' onchange='viascomunicacion(this.value)'>
                          <option disabled selected>VÍAS DE COMUNICACIÓN: $vias</option>
                          <option type='text' value='0' name=''>Inexistentes o lejanas</option>
                          <option type='text' value='1' name=''>Proyectadas o potencialmente urbanizable</option>
                          <option type='text' value='2' name=''>Obras iniciadas</option>
                          <option type='text' value='3' name=''>Afectación</option>
                        </select>
                      </div>
                      <input type='hidden' name='vias' id='vias'>

                      <div class='col-lg-3 form-group'>
                        <select name='' id='' class='form-control' onchange='vertederos(this.value)'>
                          <option disabled selected>VERTEDEROS: $vertedero</option>
                          <option type='text' value='0' name=''>Inexistentes o lejanas</option>
                          <option type='text' value='1' name=''>Proyectadas o potencialmente urbanizable</option>
                          <option type='text' value='2' name=''>Obras iniciadas</option>
                          <option type='text' value='3' name=''>Afectación</option>
                        </select>
                      </div>
                      <input type='hidden' name'vertedero' id='vertedero'>
                      <div class='col-lg-3 form-group'>
                        <select name='' id='' class='form-control' onchange='saqueo(this.value)'>
                          <option disabled selected>COLECCIONISMO/COMERCIO: $comercio</option>
                          <option type='text' value='0' name=''>Nunca</option>
                          <option type='text' value='1' name=''>Eventual</option>
                          <option type='text' value='2' name=''>Frecuente</option>
                          <option type='text' value='3' name=''>Sistemático</option>
                        </select>
                      </div>
                      <input type='hidden' name='comercio' id='comercio'>

                      <div class='col-lg-3 form-group'>
                        <select name='' id='' class='form-control' onchange='erosionnatural(this.value)'>
                          <option disabled selected>EROSIÓN NATURAL: $erosion</option>
                          <option type='text' value='0' name=''>Riesgo de futuro</option>
                          <option type='text' value='1' name=''>Activa y débil</option>
                          <option type='text' value='2' name=''>Activa y moderada</option>
                          <option type='text' value='3' name=''>Activa y severa</option>
                        </select>
                      </div>
                      <input type='hidden' name='erosion' id='erosion'>
                    </div>
                    <!-- fin riesgo de deterioro-->

                    <div class='row'>
                      <div class='col-lg-1 col-md-10 col-xs-3 col-sm-3'>
                        <button type='submit' class='btn btn-info' name='modificar'>Modificar</button>
                      </div>
                    </div>
                    </form>
                  ";
                }

                ?>
            </div>
          </div>
          <!--Fin de Yacimiento-->

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
  <script type="text/javascript" src="../../js/administracion.js"></script>
  <script type="text/javascript" src="../../js/valoracion.js"></script>
  </body>
</html>

<?php
   }else {
       header("Location: ../index.php");
   }
?>
