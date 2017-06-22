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

    <title>Añadir yacimientos a la base de datos</title>

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
            <li><span class="glyphicon glyphicon-search" aria-hidden="true"></span><a title='acceder a consultar la base de datos' tabindex='1' href="../consultar_bbdd.php">Consultar/Modificar</a></li>
            <li id="valoracion"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span><a title='acceder a valoraciones' tabindex='1' href="../valoracion.php">Valoraciones</a>
              <ul style="display:none" class="list-unstyled" id="submenu_valoracion">
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceder a añadir una valoración' href="../valoraciones/add_valoracion.php">Añadir Valoración</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceder a consultar una valoracón' href="../valoraciones/consultar_valoracion.php">Consultar Valoración</a></li>
              </ul>
            </li>
            <li><span class="glyphicon glyphicon-plus" aria-hidden="true"></span><a title='acceder a añadir a la base de datos' tabindex='1' href="../add_bbdd.php">Añadir BBDD</a>
              <ul class="list-unstyled" id="submenu">
                <li class="destacar2"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceder a añadir yacimientos' tabindex='1' href="yacimiento.php">Yacimiento</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceder a añadir especies' tabindex='1' href="especie.php">Especie</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceder a añadir excavaciones' tabindex='1' href="excavacion.php">Excavación</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceder a añadir publicacion' tabindex='1' href="publicacion.php">Publicación</a></li>
                <li ><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceder a añadir deposito' tabindex='1' href="deposito.php">Depósito</a></li>
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
          <!--Yacimiento-->
          <div class="row">
            <div class="col-lg-offset-0 col-lg-10">
              <h2  tabindex='2' class="titulos">Añadir Yacimientos</h2>
              <p tabindex='2'>A continuación, podrá añadir a la base de datos un nuevo yacimiento, teniendo en cuenta algunas de sus características y su ubicación.</p>
              <form class="" action="../add_bbdd/add_yacimiento.php" method="post">
                <div class="row">
                  <div class="col-lg-3 form-group">
                    <select tabindex='2' name="Islas" id="Islas" class="form-control" onchange="isla(this.value)">
                      <option disabled selected>ISLA</option>
                      <option  value='LA PALMA' >LA PALMA</option>
                      <option  value='LA GOMERA' >LA GOMERA</option>
                      <option  value='EL HIERRO' >EL HIERRO</option>
                      <option  value='TENERIFE' >TENERIFE</option>
                      <option  value='GRAN CANARIA' >GRAN CANARIA</option>
                      <option  value='FUERTEVENTURA' >FUERTEVENTURA</option>
                      <option  value='LANZAROTE' >LANZAROTE</option>
                    </select>
                    <input type="hidden" name="isla_seleccionada" id="isla_seleccionada">
                  </div>

                  <div id="municipiosvacio" class="col-lg-3 form-group">
                    <select tabindex='2' name="MunicipiosVacio" id="MunicipiosVacio" class="form-control">
                      <option disabled selected>MUNICIPIOS</option>
                    </select>
                  </div>
                  <!-- MUNICIPIOS DE LA PALMA-->
                  <div style="display:none" id="municipioslapalma" class="col-lg-3 form-group">
                    <select tabindex='2' name="MunicipiosLaPalma" id="MunicipiosLaPalma" class="form-control" onchange="municipio(this.value)">
                      <option disabled selected>MUNICIPIOS</option>
                      <option  value='BARLOVENTO' >BARLOVENTO</option>
                      <option  value='BREÑA ALTA' >BREÑA ALTA</option>
                      <option  value='BREÑA BAJA' >BREÑA BAJA</option>
                      <option  value='FUENCALIENTE' >FUENCALIENTE</option>
                      <option  value='GARAFÍA' >GARAFÍA</option>
                      <option  value='LOS LLANOS DE ARIDANE'>LOS LLANOS DE ARIDANE</option>
                      <option  value='EL PASO' >EL PASO</option>
                      <option  value='PUNTA GORDA' >PUNTA GORDA</option>
                      <option  value='PUNTALLANA' >PUNTALLANA</option>
                      <option  value='SAN ANDRÉS Y SAUCES' >SAN ANDRÉS Y SAUCES</option>
                      <option  value='SANTA CRUZ DE LA PALMA' >SANTA CRUZ DE LA PALMA</option>
                      <option  value='TAZACORTE' >TAZACORTE</option>
                      <option  value='TIJARAFE' >TIJARAFE</option>
                      <option  value='VILLA DE MAZO'>VILLA DE MAZO</option>
                    </select>
                  </div>
                  <!-- MUNICIPIOS DE LA GOMERA-->
                  <div style="display:none" id="municipioslagomera" class="col-lg-3 form-group">
                    <select tabindex='2' name="MunicipiosLaGomera" id="MunicipiosLaGomera" class="form-control" onchange="municipio(this.value)">
                      <option disabled selected>MUNICIPIOS</option>
                      <option  value='AGULO' >AGULO</option>
                      <option  value='ALAJERÓ' >ALAJERÓ</option>
                      <option  value='HERMIGUA' >HERMIGUA</option>
                      <option  value='SAN SEBASTIÁN DE LA GOMERA' >SAN SEBASTIÁN DE LA GOMERA</option>
                      <option  value='VALLEHERMOSO' >VALLEHERMOSO</option>
                      <option  value='VALLE GRAN REY'>VALLE GRAN REY</option>
                    </select>
                  </div>
                  <!-- MUNICIPIOS DE EL HIERRO-->
                  <div style="display:none" id="municipioselhierro" class="col-lg-3 form-group">
                    <select tabindex='2' name="MunicipiosElHierro" id="MunicipiosElHierro" class="form-control" onchange="municipio(this.value)">
                      <option disabled selected>MUNICIPIOS</option>
                      <option  value='EL PINAR' >EL PINAR</option>
                      <option  value='FRONTERA' >FRONTERA</option>
                      <option  value='VALVERDE' >VALVERVE</option>
                    </select>
                  </div>
                  <!-- MUNICIPIOS DE TENERIFE-->
                  <div style="display:none" id="municipiostenerife" class="col-lg-3 form-group">
                    <select tabindex='2' name="MunicipiosTenerife" id="MunicipiosTenerife" class="form-control" onchange="municipio(this.value)">
                      <option disabled selected>MUNICIPIOS</option>
                      <option  value='ADEJE' >ADEJE</option>
                      <option  value='ARAFO' >ARAFO</option>
                      <option  value='ARICO' >ARICO</option>
                      <option  value='ARONA' >ARONA</option>
                      <option  value='BUENAVISTA DEL NORTE' >BUENAVISTA DEL NORTE</option>
                      <option  value='CANDELARIA' >CANDELARIA</option>
                      <option  value='EL ROSARIO' >EL ROSARIO</option>
                      <option  value='EL SAUZAL' >EL SAUZAL</option>
                      <option  value='EL TANQUE' >EL TANQUE</option>
                      <option  value='FASNIA' >FASNIA</option>
                      <option  value='GARACHICO' >GARACHICO</option>
                      <option  value='GRANADILLA DE ABONA' >GRANADILLA DE ABONA</option>
                      <option  value='GÜIMAR' >GÜIMAR</option>
                      <option  value='GUÍA DE ISORA' >GUÍA DE ISORA</option>
                      <option  value='ICOD DE LOS VINOS' >ICOD DE LOS VINOS</option>
                      <option  value='LA GUANCHA' >LA GUANCHA</option>
                      <option  value='LA MATANZA DE ACENTEJO'>LA MATANZA DE ACENTEJO</option>
                      <option  value='LA OROTAVA' >LA OROTAVA</option>
                      <option  value='LA VICTORIA DE ACENTEJO' >LA VICTORIA DE ACENTEJO</option>
                      <option  value='LOS REALEJOS' >LOS REALEJOS</option>
                      <option  value='LOS SILOS' >LOS SILOS</option>
                      <option  value='PUERTO DE LA CRUZ' >PUERTO DE LA CRUZ</option>
                      <option  value='SAN CRISTÓBAL DE LA LAGUNA' >SAN CRISTÓBAL DE LA LAGUNA</option>
                      <option  value='SAN JUAN DE LA RAMBLA' >SAN JUAN DE LA RAMBLA</option>
                      <option  value='SAN MIGUEL DE ABONA' >SAN MIGUEL DE ABONA</option>
                      <option  value='SANTA CRUZ DE TENERIFE' >SANTA CRUZ DE TENERIFE</option>
                      <option  value='SANTA ÚRSULA' >SANTA ÚRSULA</option>
                      <option  value='SANTIAGO DEL TEIDE' >SANTIAGO DEL TEIDE</option>
                      <option  value='TACORONTE' >TACORONTE</option>
                      <option  value='TEGUESTE' >TEGUESTE</option>
                      <option  value='VILAFLOR' >VILAFLOR</option>
                    </select>
                  </div>
                  <!-- MUNICIPIOS DE GRAN CANARIA-->
                  <div style="display:none" id="municipiosgrancanaria" class="col-lg-3 form-group">
                    <select tabindex='2' name="MunicipiosGranCanaria" id="MunicipiosGranCanaria" class="form-control" onchange="municipio(this.value)">
                      <option disabled selected>MUNICIPIOS</option>
                      <option  value='AGAETE' >AGAETE</option>
                      <option  value='AGÜINES' >AGÜINES</option>
                      <option  value='LA ALDEA DE SAN NICOLÁS' >LA ALDEA DE SAN NICOLÁS</option>
                      <option  value='ARTENARA' >ARTENARA</option>
                      <option  value='ARUCAS' >ARUCAS</option>
                      <option  value='FIRGAS' >FIRGAS</option>
                      <option  value='GÁLDAR' >GÁLDAR</option>
                      <option  value='INGENIO' >INGENIO</option>
                      <option  value='MOGÁN' >MOGÁN</option>
                      <option  value='MOYA' >MOYA</option>
                      <option  value='LAS PALMAS DE GRAN CANARIA' >LAS PALMAS DE GRAN CANARIA</option>
                      <option  value='SAN BARTOLOMÉ DE TIRAJANA' >SAN BARTOLOMÉ DE TIRAJANA</option>
                      <option  value='SANTA BRÍGIDA' >SANTA BRÍGIDA</option>
                      <option  value='SANTA LUCÍA DE TIRAJANA' >SANTA LUCÍA DE TIRAJANA</option>
                      <option  value='SANTA MARÍA DE GUÍA DE GRAN CANARIA' >SANTA MARÍA DE GUÍA DE GRAN CANARIA</option>
                      <option  value='TEJEDA' >TEJEDA</option>
                      <option  value='TELDE'>TELDE</option>
                      <option  value='TEROR' >TEROR</option>
                      <option  value='VALLESECO'>VALLESECO</option>
                      <option  value='VALSEQUILLO DE GRAN CANARIA' >VALSEQUILLO DE GRAN CANARIA</option>
                      <option  value='VEGA DE SAN MATEO' >VEGA DE SAN MATEO</option>
                    </select>
                  </div>

                  <!-- MUNICIPIOS DE FUERTEVENTURA-->
                  <div style="display:none" id="municipiosfuerteventura" class="col-lg-3 form-group">
                    <select tabindex='2' name="MunicipiosFuerteventura" id="MunicipiosFuerteventura" class="form-control" onchange="municipio(this.value)">
                      <option disabled selected>MUNICIPIOS</option>
                      <option  value='ANTIGUA' >ANTIGUA</option>
                      <option  value='BETANCURIA' >BETANCURIA</option>
                      <option  value='LA OLIVA' >LA OLIVA</option>
                      <option  value='PÁJARA'>PÁJARA</option>
                      <option  value='PUERTO DEL ROSARIO' >PUERTO DEL ROSARIO</option>
                      <option  value='TUINEJE' >TUINEJE</option>
                    </select>
                  </div>

                  <!-- MUNICIPIOS DE LANZAROTE-->
                  <div style="display:none" id="municipioslanzarote" class="col-lg-3 form-group">
                    <select tabindex='2' name="MunicipiosLanzarote" id="MunicipiosLanzarote" class="form-control" onchange="municipio(this.value)">
                      <option disabled selected>MUNICIPIOS</option>
                      <option  value='ARECIFE' >ARECIFE</option>
                      <option  value='HARÍA' >HARÍA</option>
                      <option  value='SAN BARTOLOMÉ' >SAN BARTOLOMÉ</option>
                      <option  value='TEGUISE'>TEGUISE</option>
                      <option  value='TÍAS' >TÍAS</option>
                      <option  value='TINAJO' >TINAJO</option>
                      <option  value='YAIZA' >YAIZA</option>
                    </select>
                  </div>
                  <input type="hidden" name="municipio_seleccionado" id="municipio_seleccionado">

                  <div id="localidad" class="col-lg-3 form-group">
                    <input tabindex='2' type="text" class="form-control" id="Localidad" name="localidad" placeholder="LOCALIDAD">
                  </div>
                  <div  id="nombre_yacimiento" class="col-lg-3 form-group">
                    <input tabindex='2' type="text" class="form-control" id="Nombre_yacimiento" name="nombre_yacimiento" placeholder="NOMBRE YACIMIENTO">
                  </div>
                </div>
                <div class="row">
                  <div  id="latitud" class="col-lg-3 form-group">
                    <input tabindex='2' type="text" class="form-control" id="Latitud" name="latitud" placeholder="LATITUD">
                  </div>
                  <div  id="longitud" class="col-lg-3 form-group">
                    <input tabindex='2' type="text" class="form-control" id="Longitud" name="longitud" placeholder="LONGITUD">
                  </div>
                  <div class="col-lg-3 form-group" id="altura">
                    <input tabindex='2' type="number" class="form-control" id="Altura" name="altura" placeholder="ALTURA">
                  </div>
                  <div class="col-lg-3 form-group" id="edad">
                    <input tabindex='2' type="text" class="form-control" id="Edad" name="edad" placeholder="EDAD">
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-3 form-group" id="tipo_y">
                    <input tabindex='2' type="text" class="form-control" id="Tipo_y" name="tipo_y" placeholder="TIPO">
                  </div>
                  <div class="col-lg-9 form-group" id="observaciones_ya">
                    <textarea tabindex='2' class="form-control" rows="1" id="observaciones_y" name="observaciones_y" placeholder="OBSERVACIONES"></textarea>
                  </div>
                </div>

                <div class="row">
                  <div tabindex='2' class="col-lg-6 mapa_google" id="map">
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
          <!--Fin de Yacimiento-->

        </div>
      </div>

    <!-- FOOTER-->
    <br><br><br><br><br>
    <div class="navbar navbar-inverse navbar-fixed-bottom">
      <div class="container">
        <p tabindex='2' class="navbar-text pull-left">© 2017 Alexander Cole Mora
          <a title='Acceder a la página web de la Universidad de La Laguna' tabindex='2' href="https://www.ull.es/" target="_blank" >Universidad de La Laguna</a>
        </p>
      </div>
    </div>



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script type="text/javascript" src="../../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKWnhtTV-INFvymm3mjHJboLaY3dZzhwA&callback=initMap"
  async defer></script>
  <script type="text/javascript" src="../../js/administracion.js"></script>
  <script type="text/javascript" src="../../js/anadir/yacimiento.js"></script>
  <script type="text/javascript" src="../../js/mapa_google.js"></script>
  </body>
</html>

<?php
   }else {
       header("Location: ../index.php");
   }
?>
