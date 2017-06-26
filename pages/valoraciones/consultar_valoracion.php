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
            <li id="consultar"><span class="glyphicon glyphicon-search" aria-hidden="true"></span><a title='acceder a consultar la base de datos' tabindex='1' href="../consultar_bbdd.php">Consultar/Modificar</a></li>
            <li><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span><a title='acceder a valoraciones' tabindex='1' href="../valoracion.php">Valoraciones</a>
              <ul class="list-unstyled" id="submenu_valoracion">
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceder a añadir una valoración' tabindex='1' href="../valoraciones/add_valoracion.php">Añadir Valoración</a></li>
                <li class="destacar"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceder a consultar una valoracón' tabindex='1' href="../valoraciones/consultar_valoracion.php">Consultar Valoración</a></li>
              </ul>
            </li>
            <li id="add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span><a title='acceder a añadir a la base de datos' tabindex='1' href="../add_bbdd.php">Añadir BBDD</a>
              <ul style="display:none" class="list-unstyled" id="submenu">
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceder a añadir yacimientos' href="../anadir/yacimiento.php">Yacimiento</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceder a añadir especies' href="../anadir/especie.php">Especie</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceder a añadir excavaciones' href="../anadir/excavacion.php">Excavación</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceder a añadir publicacion' href="../anadir/publicacion.php">Publicación</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceder a añadir deposito' href="../anadir/deposito.php">Depósito</a></li>
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
                <p tabindex='2'>¿Está seguro que desea cerrar sesión?</p>
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
          <!--Yacimiento-->
          <div class="row">
            <div class="col-lg-offset-0 col-lg-10">
              <h2  tabindex='2' class="titulos">Consultar Valoración</h2>
              <p tabindex='2'>A continuación, podrá consultar o modificar la valoración de un yacimiento.</p>
                <div class="row">
                  <div class="col-lg-5 form-group">
                    <select tabindex='2' name="Yacimientos_Valoracion" id="Yacimientos_Valoracion" class="form-control" onchange="yacimientovaloracion(this.value)">
                      <option disabled selected>YACIMIENTOS</option>
                      <?php
                        $consulta_yacimiento="SELECT yacimiento
                                              FROM yacimiento NATURAL JOIN valoracion_cientifica
                                              ORDER BY yacimiento ASC;";
                        $resultado=pg_query($link,$consulta_yacimiento);
                        echo pg_last_error();
                        while($resultado2 = pg_fetch_assoc($resultado)){
                          $aux = $resultado2['yacimiento'];
                          echo "<option  value='$aux' >$aux</option>";
                        }

                      ?>
                     </select>
                   </div>
                   <input type="hidden" name="yacimiento" id="yacimiento">
                </div>
                <div class="row">
                  <div class="col-lg-2 col-md-3 col-xs-12 col-sm-3">
                    <button tabindex='2' type="submit" class="btn btn-success" onclick="consultar()">Buscar</button>
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
                    <div class='col-lg-8 form-group'>
                      <p tabindex='2'>El yacimiento consultado es: <b>$yacimiento</b></p>
                    </div>
                  </div>
                  <div class='row'>
                    <div class='col-lg-3 form-group'>
                      <p tabindex='2'>Valoracion Total: <b>$valoracion</b></p>
                    </div>
                  </div>
                  ";

                  echo "
                  <!-- Valoracion cientifica-->
                  <form  action='modificar_valoracion.php' method='post'>
                  <input type='hidden' name='yacimiento_consulta' id='yacimiento_yacimiento' value='$yacimiento'>
                    <div class='row'>
                      <div class='col-lg-3'>
                        <h4 tabindex='2'>Valoración Científica</h4>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-lg-4 form-group'>
                        <select tabindex='2'   class='form-control' onchange='tipofosiles(this.value)'>
                          <option disabled selected>TIPO FÓSILES: $tipo_fosiles</option>
                          <option  value='0' >Fósiles comunes y/o no endémicos</option>
                          <option  value='1' >Hasta el 30% de fósiles raros y/o especies endémicas</option>
                          <option  value='2' >Entre 30% y 60% de fósiles raros y/o especies endémicas</option>
                          <option  value='3' >Más del 60% de fósiles raros y/o de especies endémicas</option>
                        </select>
                      </div>
                      <input type='hidden' name='tipo_fosiles' id='tipo_fosiles' value='$tipo_fosiles'>

                      <div class='col-lg-4 form-group'>
                        <select tabindex='2'   class='form-control' onchange='diversidadtaxones(this.value)'>
                          <option disabled selected>DIVERSIDAD DE TAXONES: $taxones</option>
                          <option  value='0' >Solo un taxón</option>
                          <option  value='1' >Más de una especie de invertebrados o vertebrados o plantas</option>
                          <option  value='2' >Invertebrados+vertebrados o plantas</option>
                          <option  value='3' >Invertebrados+vertebrado+plantas</option>
                        </select>
                      </div>
                      <input type='hidden' name='taxones' id='taxones' value='$taxones'>

                      <div class='col-lg-4 form-group'>
                        <select tabindex='2'   class='form-control' onchange='edadyacimiento(this.value)'>
                          <option disabled selected>EDAD YACIMIENTO: $edad</option>
                          <option  value='0' >Más de 10 yacimientos de una detemrinada edad</option>
                          <option  value='1' >Entre 10-5 yacimientos de una determinada edad</option>
                          <option  value='2' >5-2 yacimientos de una determinada edad</option>
                          <option  value='3' >1 yacimientos de una determinada edad</option>
                        </select>
                      </div>
                      <input type='hidden' name='edad' id='edad' value='$edad'>
                    </div>

                    <div class='row'>
                      <div class='col-lg-4 form-group'>
                        <select tabindex='2'   class='form-control' onchange='localidadtipo(this.value)'>
                          <option disabled selected>LOCALIDAD TIPO: $localidad</option>
                          <option  value='0' >No</option>
                          <option  value='3' >Si se ha descrito una especie por primera vez en esa localidad</option>
                        </select>
                      </div>
                      <input type='hidden' name='localidad' id='localidad' value='$localidad'>

                     <div class='col-lg-4 form-group'>
                       <select tabindex='2'   class='form-control' onchange='estadoconservacion(this.value)'>
                         <option disabled selected>EST. CONSERVACIÓN FÓSILES: $conservacionfosiles</option>
                         <option  value='0' >Todos los restos fragmentados</option>
                         <option  value='1' >Esqueletos completos con alteraciones tafonómicas</option>
                         <option  value='2' >Esqueletos completos sin alteraciones</option>
                         <option  value='3' >Partes blandas (piel,etc)</option>
                       </select>
                     </div>
                     <input type='hidden' name='conservacionfosiles' id='conservacionfosiles' value='$conservacionfosiles'>

                     <div class='col-lg-4 form-group'>
                       <select tabindex='2'   class='form-control' onchange='informaciontafonomica(this.value)'>
                         <option disabled selected>INFORMACIÓN TAFONÓMICA: $tafonomica</option>
                         <option  value='0' >Se conoce la zona de procedencia de los fósiles</option>
                         <option  value='1' >Se conoce la capa/nivel</option>
                         <option  value='2' >Se conoce el lugar exacto</option>
                         <option  value='3' >Los fósiles proceden de una excavación metódica</option>
                       </select>
                     </div>
                     <input type='hidden' name='tafonomica' id='tafonomica' value='$tafonomica'>
                   </div>

                   <div class='row'>
                     <div class='col-lg-4 form-group'>
                       <select tabindex='2'   class='form-control' onchange='infobioestatigrafica(this.value)'>
                         <option disabled selected>INFO. BIOESTATIGRÁFICA: $bioestatigrafica</option>
                         <option  value='0' >Sin fósiles zonadores</option>
                         <option  value='1' >Con fósiles zonadores para correlacionar a nivel local (una isla)</option>
                         <option  value='2' >Con fósiles zonadores para correlacionar a nivel regional (entre islas)</option>
                         <option  value='3' >Con fósiles zonadores para correlacionar a nivel global(Canarias/Mediterráneo)</option>
                       </select>
                     </div>
                     <input type='hidden' name='bioestatigrafica' id='bioestatigrafica' value='$bioestatigrafica'>

                     <div class='col-lg-4 form-group'>
                       <select tabindex='2'   class='form-control' onchange='interesgeologico(this.value)'>
                         <option disabled selected>INTERÉS GEOLÓGICO: $geologico</option>
                         <option  value='0' >Sin interés especial</option>
                         <option  value='1' >Importancia vulcanoestratigráfica o tecntónica o geodiversidad alta</option>
                         <option  value='2' >Dos de las propiedades anteriores</option>
                         <option  value='3' >Importancia vulcanoestratigráfica+tectónica+geodiversidad</option>
                       </select>
                     </div>
                     <input type='hidden' name='geologico' id='geologico' value='$geologico'>


                     <div class='col-lg-4 form-group'>
                       <select tabindex='2'   class='form-control' onchange='interespaleoclimatico(this.value)'>
                         <option disabled selected>INTERÉS PALEOCLIMÁTICO: $paleoclimatico</option>
                         <option  value='0' >No se puede reconstruir ningún evento climático</option>
                         <option  value='1' >Reconstrucción de un evento climático</option>
                         <option  value='2' >Reconstrucción de un ciclo climático(más de un evento)</option>
                         <option  value='3' >Reconstrucción de más de un ciclo climático</option>
                       </select>
                     </div>
                     <input type='hidden' name='paleoclimatico' id='paleoclimatico' value='$paleoclimatico'>
                   </div>
                   <div class='row'>
                     <div class='col-lg-4 form-group'>
                       <select tabindex='2'   class='form-control' onchange='valorgeomorfologico(this.value)'>
                         <option disabled selected>VALOR GEOMORFOLÓGICO: $geomorfologico</option>
                         <option  value='0' >Sin interés</option>
                         <option  value='1' >Asociado a un ámbito de la geomorfología</option>
                         <option  value='2' >Asociado a dos ámbitos de la geomorfología</option>
                         <option  value='3' >Asociado a tres ámbitos de la geomorfología(estructural,dinámica y climática)</option>
                       </select>
                     </div>
                     <input type='hidden' name='geomorfologico' id='geomorfologico' value='$geomorfologico'>
                     <div class='col-lg-4 form-group'>
                       <select tabindex='2'   class='form-control' onchange='abundanciayacimiento(this.value)'>
                         <option disabled selected>ABUNDANCIA DE YACIMIENTOS: $abuyacimiento</option>
                         <option  value='0' >Más de 10 en la isla</option>
                         <option  value='1' >Entre 10-5 en la isla</option>
                         <option  value='2' >Entre 5-2 en la isla</option>
                         <option  value='3' >1 yacimiento en la isla</option>
                       </select>
                     </div>
                     <input type='hidden' name='abuyacimiento' id='abuyacimiento' value='$abuyacimiento'>

                     <div class='col-lg-4 form-group'>
                       <select tabindex='2'   class='form-control' onchange='tipoyacimiento(this.value)'>
                         <option disabled selected>TIPO DE YACIMIENTO: $tiyacimiento</option>
                         <option  value='0' >Más de 10 en la isla</option>
                         <option  value='1' >Entre 10-5 en la isla</option>
                         <option  value='2' >Entre 5-2 en la isla</option>
                         <option  value='3' >1 yacimiento de un determinado tipo en la isla</option>
                       </select>
                     </div>
                     <input type='hidden' name='tiyacimiento' id='tiyacimiento' value='$tiyacimiento'>
                   </div>

                   <div class='row'>
                     <div class='col-lg-4 form-group'>
                       <select tabindex='2'   class='form-control' onchange='tipodatacion(this.value)'>
                         <option disabled selected>TIPO DATACIÓN: $datacion</option>
                         <option  value='0' >Sin datos</option>
                         <option  value='1' >Fauna</option>
                         <option  value='2' >Datación radiométrica</option>
                         <option  value='3' >Fauna y datación radiométrica</option>
                       </select>
                     </div>
                     <input type='hidden' name='datacion' id='datacion' value='$datacion'>

                     <div class='col-lg-4 form-group'>
                       <select tabindex='2'   class='form-control' onchange='restosarqueologicos(this.value)'>
                         <option disabled selected>ASOCIACIÓN RESTOS ARQUEOLÓGICOS: $arqueologicos</option>
                         <option  value='0' >No</option>
                         <option  value='1' >Con restos de animales domésticos y/o plantas que acompañan al hombre</option>
                         <option  value='2' >Además con restos de cerámica y otras manifestaciones culturales</option>
                         <option  value='3' >Además con los restos de los hombres</option>
                       </select>
                     </div>
                     <input type='hidden' name='arqueologicos' id='arqueologicos' value='$arqueologicos'>
                   </div>
                    <!--fin Valoracion cientifica-->


                    <!-- Valoracion socio cultural-->
                    <div class='row'>
                      <div class='col-lg-3'>
                        <h4 tabindex='2'>Valoración Socio Cultural</h4>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-lg-4 form-group'>
                        <select tabindex='2'   class='form-control' onchange='interesdidactico(this.value)'>
                          <option disabled selected>INTERÉS DIDÁCTICO: $didactico</option>
                          <option  value='0' >No</option>
                          <option  value='1' >Se ve el medio sedimentario</option>
                          <option  value='2' >Se reconocen los fósiles sin dificultad</option>
                          <option  value='3' >Se puede interpretar el paleoambiente</option>
                        </select>
                      </div>
                      <input type='hidden' name='didactico' id='didactico' value='$didactico'>

                      <div class='col-lg-4 form-group'>
                        <select tabindex='2'   class='form-control' onchange='situaciongeografica(this.value)'>
                          <option disabled selected>SITUACIÓN GEOGRÁFICA: $geografica</option>
                          <option  value='0' >A más de 50 km de una población</option>
                          <option  value='1' >Entre 50 y 20 km  de una población</option>
                          <option  value='2' >Entre 0 y 20 km de una población</option>
                          <option  value='3' >Incluida en el casco de una población</option>
                        </select>
                      </div>
                      <input type='hidden' name='geografica' id='geografica' value='$geografica'>
                      <div class='col-lg-4 form-group'>
                        <select tabindex='2'   class='form-control' onchange='valorhistorico(this.value)'>
                          <option disabled selected>VALOR HISTÓRICO: $historico</option>
                          <option  value='0' >Siglo XXI</option>
                          <option  value='1' >Después de 1990</option>
                          <option  value='2' >1900-1990</option>
                          <option  value='3' >Siglo XIX o anterior</option>
                        </select>
                      </div>
                      <input type='hidden' name='historico' id='historico' value='$historico'>
                    </div>

                    <div class='row'>
                      <div class='col-lg-4 form-group'>
                        <select tabindex='2'   class='form-control' onchange='nivelconocimiento(this.value)'>
                          <option disabled selected>NIVEL DE CONOCIMIENTO: $conocimiento</option>
                          <option  value='0' >Ninguno</option>
                          <option  value='1' >Pequeña colección</option>
                          <option  value='2' >Collección en Museo</option>
                          <option  value='3' >Varias referencias</option>
                        </select>
                      </div>
                      <input type='hidden' name='conocimiento' id='conocimiento' value='$conocimiento'>

                      <div class='col-lg-4 form-group'>
                        <select tabindex='2'   class='form-control' onchange='valorcomplementario(this.value)'>
                          <option disabled selected>VALOR COMPLEMENTARIO: $valor</option>
                          <option  value='0' >No incluido en ninguna figura de protección</option>
                          <option  value='1' >Incluido en Parques(naturales o rurales)</option>
                          <option  value='2' >Incluido en Reservas Naturales(Integrales y especiales, Monumento natural, Paisajes protegidos y sitios de interés científico)</option>
                          <option  value='3' >Incluido en un Parque Nacional</option>
                        </select>
                      </div>
                      <input type='hidden' name='valor' id='valor' value='$valor'>
                      <div class='col-lg-4 form-group'>
                        <select tabindex='2'   class='form-control' onchange='figuraproteccion(this.value)'>
                          <option disabled selected>FIGURA DE PROTECCIÓN: $proteccion</option>
                          <option  value='0' >No se ha aplicado ninguna protección de ley de patrimonio histórico</option>
                          <option  value='3' >Se ha aplicacdo alguna protección de ley de patrimonio histórico</option>
                        </select>
                      </div>
                      <input type='hidden' name='proteccion' id='proteccion' value='$proteccion'>
                    </div>

                    <!--fin Valoracion socio cultural-->

                    <!-- Valoracion socio enconmica-->
                    <div class='row'>
                      <div class='col-lg-3'>
                        <h4 tabindex='2'>Valoración Socio Económica</h4>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-lg-4 form-group'>
                        <select tabindex='2'   class='form-control' onchange='potencialturistico(this.value)'>
                          <option disabled selected>POTENCIAL TURÍSTICO: $turistico</option>
                          <option  value='0' >No</option>
                          <option  value='1' >Solo especialistas</option>
                          <option  value='2' >Turismo científico</option>
                          <option  value='3' >Visita instructiva</option>
                        </select>
                      </div>
                      <input type='hidden' name='turistico' id='turistico' value='$turistico'>
                    </div>
                    <!--fin Valoracion socio economica-->

                    <!-- Riesgo de deterioro-->
                    <div class='row'>
                      <div class='col-lg-3'>
                        <h4 tabindex='2'>Riesgo de deterioro</h4>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-lg-4 form-group'>
                        <select tabindex='2'   class='form-control' onchange='fragilidaddeldeposito(this.value)'>
                          <option disabled selected>FRAGILIDAD DEL DEPOSITO: $fragilidad</option>
                          <option  value='0' >Mayor de 150m</option>
                          <option  value='1' >Entre 100m y 150m</option>
                          <option  value='2' >Entre 50m y 100m</option>
                          <option  value='3' >Entre 1m y 50m</option>
                        </select>
                      </div>
                      <input type='hidden' name='fragilidad' id='fragilidad' value='$fragilidad'>

                      <div class='col-lg-4 form-group'>
                        <select tabindex='2'   class='form-control' onchange='situacionaccesibilidad(this.value)'>
                          <option disabled selected>SITUACIÓN GEOGRÁFICA: $accesibilidad</option>
                          <option  value='0' >Sin localizar</option>
                          <option  value='1' >Inaccesible</option>
                          <option  value='2' >Difícil acceso</option>
                          <option  value='3' >Accesible</option>
                        </select>
                      </div>
                      <input type='hidden' name='accesibilidad' id='accesibilidad' value='$accesibilidad'>
                      <div class='col-lg-4 form-group'>
                        <select tabindex='2'   class='form-control' onchange='edificaciones(this.value)'>
                          <option disabled selected>EDIFICACIONES: $edificacion</option>
                          <option  value='0' >Inexistentes o lejanas</option>
                          <option  value='1' >Proyectadas o potencialmente urbanizable</option>
                          <option  value='2' >Obras iniciadas</option>
                          <option  value='3' >Afectación</option>
                        </select>
                      </div>
                      <input type='hidden' name='edificacion' id='edificacion' value='$edificacion'>
                    </div>
                    <div class='row'>
                      <div class='col-lg-4 form-group'>
                        <select tabindex='2'   class='form-control' onchange='valorminero(this.value)'>
                          <option disabled selected>VALOR MINERO/CANTERAS: $cantera</option>
                          <option  value='0' >Inexistentes o lejanas</option>
                          <option  value='1' >Proyectadas o potencialmente urbanizable</option>
                          <option  value='2' >Obras iniciadas</option>
                          <option  value='3' >Afectación</option>
                        </select>
                      </div>
                      <input type='hidden' name='cantera' id='cantera' value='$cantera'>

                      <div class='col-lg-4 form-group'>
                        <select tabindex='2'   class='form-control' onchange='viascomunicacion(this.value)'>
                          <option disabled selected>VÍAS DE COMUNICACIÓN: $vias</option>
                          <option  value='0' >Inexistentes o lejanas</option>
                          <option  value='1' >Proyectadas o potencialmente urbanizable</option>
                          <option  value='2' >Obras iniciadas</option>
                          <option  value='3' >Afectación</option>
                        </select>
                      </div>
                      <input type='hidden' name='vias' id='vias' value='$vias'>

                      <div class='col-lg-4 form-group'>
                        <select tabindex='2'   class='form-control' onchange='vertederos(this.value)'>
                          <option disabled selected>VERTEDEROS: $vertedero</option>
                          <option  value='0' >Inexistentes o lejanas</option>
                          <option  value='1' >Proyectadas o potencialmente urbanizable</option>
                          <option  value='2' >Obras iniciadas</option>
                          <option  value='3' >Afectación</option>
                        </select>
                      </div>
                      <input type='hidden' name='vertedero' id='vertedero' value='$vertedero'>
                    </div>
                    <div class='row'>
                      <div class='col-lg-4 form-group'>
                        <select tabindex='2'   class='form-control' onchange='saqueo(this.value)'>
                          <option disabled selected>COLECCIONISMO/COMERCIO: $comercio</option>
                          <option  value='0' >Nunca</option>
                          <option  value='1' >Eventual</option>
                          <option  value='2' >Frecuente</option>
                          <option  value='3' >Sistemático</option>
                        </select>
                      </div>
                      <input type='hidden' name='comercio' id='comercio' value='$comercio'>

                      <div class='col-lg-4 form-group'>
                        <select tabindex='2'   class='form-control' onchange='erosionnatural(this.value)'>
                          <option disabled selected>EROSIÓN NATURAL: $erosion</option>
                          <option  value='0' >Riesgo de futuro</option>
                          <option  value='1' >Activa y débil</option>
                          <option  value='2' >Activa y moderada</option>
                          <option  value='3' >Activa y severa</option>
                        </select>
                      </div>
                      <input type='hidden' name='erosion' id='erosion' value='$erosion'>
                    </div>
                    <!-- fin riesgo de deterioro-->

                    <div class='row'>
                      <div class='col-lg-1 col-md-10 col-xs-3 col-sm-3'>
                        <!--<button type='submit' class='btn btn-info' name='modificar'>Modificar</button>-->
                        <button tabindex='2' type='button' class='btn btn-info' data-toggle='modal' data-target='#modal_modificar'>Modificar</button>
                      </div>
                    </div>

                    <div id='modal_modificar' class='modal fade' role='dialog'>
                      <div class='modal-dialog'>
                        <!-- Modal content-->
                        <div class='modal-content'>
                          <div class='modal-header'>
                            <button  tabindex='3' type='button' class='close' data-dismiss='modal'>&times;</button>
                            <h4  tabindex='2' class='modal-title'>Modificar valoración</h4>
                          </div>
                          <div class='modal-body'>
                            <p tabindex='3' >¿Está seguro que desea modificar la valoración del yacimiento <b>$yacimiento</b>?</p>
                          </div>
                          <div class='modal-footer'>
                              <button  tabindex='3' type='submit' class='btn btn-info boton' name='modificar'>Modificar</button><br>
                          </div>
                        </div>
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
    <div class="navbar navbar-inverse navbar-fixed-bottom" role='contentinfo'>
      <div class="container">
        <p tabindex='3' class="navbar-text pull-left">© 2017 Alexander Cole Mora
          <a title='Acceder a la página web de la Universidad de La Laguna' tabindex='3' href="https://www.ull.es/" target="_blank" >Universidad de La Laguna</a>
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
