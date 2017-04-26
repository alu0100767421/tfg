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

    <title>Sistema Geográfico de Paleontología de Canarias</title>

    <link rel="icon" type="/image/png" href="../images/logoULL/logotipo-secundario-ULL.png" />
    <link type="text/css" rel="stylesheet" href="../bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../css/administracion.css"/>
    <link type="text/css" rel="stylesheet" href="../bootstrap-3.3.7-dist/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>


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




      <!--MENU LATERAL-->
      <div class="row">
        <div class="col-lg-2 col-md-4 col-xs-8 col-sm-6 ">
          <ul class="list-unstyled panel">
            <li><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span><a href="administracion.php">&nbsp Inicio</a></li>
            <li><span class="glyphicon glyphicon-search" aria-hidden="true"></span><a href="#">&nbsp Consultar BBDD</a></li>
            <li><span class="glyphicon glyphicon-plus" aria-hidden="true"></span><a href="add_bbdd.php">&nbsp Añadir BBDD</a></li>
            <?php
              //echo "Este es el usuario $username";
              if ($username == "admin") {
                echo "<li><span class='glyphicon glyphicon-user' aria-hidden='true'></span><a href='gestion_usuarios.php'>&nbsp Gestión Usuarios</a></li>";
              }
             ?>
          </ul>

          <div class="row">
            <form action="cerrar_sesion.php" method="post">
              <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <button type="submit" class="btn btn-danger boton">Cerrar Sesión</button><br>
              </div>
            </form>
          </div>
        </div>
        <!--FIN MENU LATERAL-->
        <div class="col-lg-10 col-md-8 col-xs-12 col-sm-6 contenido">
          <h2>Añadir datos</h2>

          <!--Yacimiento-->
          <div class="row">
            <div class="col-lg-12">
              <h4>Yacimiento</h4>
              <form class="" action="" method="post">
                <div class="row">
                  <div class="col-lg-2 form-group">
                    <select name="Islas" id="Islas" class="form-control" onchange="isla(this.value)">
                      <option disabled selected>ISLA</option>
                      <option type='text' value='LA PALMA' name='LA PALMA'>LA PALMA</option>
                      <option type='text' value='LA GOMERA' name='LA GOMERA'>LA GOMERA</option>
                      <option type='text' value='EL HIERRO' name='EL HIERRO'>EL HIERRO</option>
                      <option type='text' value='TENERIFE' name='TENERIFE'>TENERIFE</option>
                      <option type='text' value='GRAN CANARIA' name='GRAN CANARIA'>GRAN CANARIA</option>
                      <option type='text' value='FUERTEVENTURA' name='FUERTEVENTURA'>FUERTEVENTURA</option>
                      <option type='text' value='LANZAROTE' name='LANZAROTE'>LANZAROTE</option>
                    </select>
                  </div>
                  <!-- MUNICIPIOS DE LA PALMA-->
                  <div style="display:none" id="municipioslapalma" class="col-lg-2 form-group">
                    <select name="MunicipiosLaPalma" id="MunicipiosLaPalma" class="form-control" onchange="municipio(this.value)">
                      <option disabled selected>MUNICIPIOS</option>
                      <option type='text' value='BARLOVENTO' name='BARLOVENTO'>BARLOVENTO</option>
                      <option type='text' value='BRENA ALTA' name='BRENA ALTA'>BREÑA ALTA</option>
                      <option type='text' value='BRENA BAJA' name='BRENA BAJA'>BREÑA BAJA</option>
                      <option type='text' value='FUENCALIENTE' name='FUENCALIENTE'>FUENCALIENTE</option>
                      <option type='text' value='GARAFÍA' name='GARAFÍA'>GARAFÍA</option>
                      <option type='text' value='LOS LLANOS DE ARIDANE' name='LOS LLANOS DE ARIDANE'>LOS LLANOS DE ARIDANE</option>
                      <option type='text' value='EL PASO' name='EL PASO'>EL PASO</option>
                      <option type='text' value='PUNTA GORDA' name='PUNTA GORDA'>PUNTA GORDA</option>
                      <option type='text' value='PUNTALLANA' name='PUNTALLANA'>PUNTALLANA</option>
                      <option type='text' value='SAN ANDRES Y SAUCES' name='SAN ANDRES Y SAUCES'>SAN ANDRÉS Y SAUCES</option>
                      <option type='text' value='SANTA CRUZ DE LA PALMA' name='SANTA CRUZ DE LA PALMA'>SANTA CRUZ DE LA PALMA</option>
                      <option type='text' value='TAZACORTE' name='TAZACORTE'>TAZACORTE</option>
                      <option type='text' value='TIJARAFE' name='TIJARAFE'>TIJARAFE</option>
                      <option type='text' value='VILLA DE MAZO' name='VILLA DE MAZO'>VILLA DE MAZO</option>
                    </select>
                  </div>
                  <!-- MUNICIPIOS DE LA GOMERA-->
                  <div style="display:none" id="municipioslagomera" class="col-lg-2 form-group">
                    <select name="MunicipiosLaGomera" id="MunicipiosLaGomera" class="form-control" onchange="municipio(this.value)">
                      <option disabled selected>MUNICIPIOS</option>
                      <option type='text' value='AGULO' name='AGULO'>AGULO</option>
                      <option type='text' value='ALAJERO' name='ALAJERO'>ALAJERÓ</option>
                      <option type='text' value='HERMIGUA' name='HERMIGUA'>HERMIGUA</option>
                      <option type='text' value='SAN SEBASTIAN DE LA GOMERA' name='SAN SEBASTIAN DE LA GOMERA'>SAN SEBASTIÁN DE LA GOMERA</option>
                      <option type='text' value='VALLEHERMOSO' name='VALLEHERMOSO'>VALLEHERMOSO</option>
                      <option type='text' value='VALLE GRAN REY' name='VALLE GRAN REY'>VALLE GRAN REY</option>
                    </select>
                  </div>
                  <!-- MUNICIPIOS DE EL HIERRO-->
                  <div style="display:none" id="municipioselhierro" class="col-lg-2 form-group">
                    <select name="MunicipiosElHierro" id="MunicipiosElHierro" class="form-control" onchange="municipio(this.value)">
                      <option disabled selected>MUNICIPIOS</option>
                      <option type='text' value='EL PINAR' name='EL PINAR'>EL PINAR</option>
                      <option type='text' value='FRONTERA' name='FRONTERA'>FRONTERA</option>
                      <option type='text' value='VALVERDE' name='VALVERDE'>VALVERVE</option>
                    </select>
                  </div>
                  <!-- MUNICIPIOS DE TENERIFE-->
                  <div style="display:none" id="municipiostenerife" class="col-lg-2 form-group">
                    <select name="MunicipiosTenerife" id="MunicipiosTenerife" class="form-control" onchange="municipio(this.value)">
                      <option disabled selected>MUNICIPIOS</option>
                      <option type='text' value='ADEJE' name='ADEJE'>ADEJE</option>
                      <option type='text' value='ARAFO' name='ARAFO'>ARAFO</option>
                      <option type='text' value='ARICO' name='ARICO'>ARICO</option>
                      <option type='text' value='ARONA' name='ARONA'>ARONA</option>
                      <option type='text' value='BUENAVISTA DEL NORTE' name='BUENAVISTA DEL NORTE'>BUENAVISTA DEL NORTE</option>
                      <option type='text' value='CANDELARIA' name='CANDELARIA'>CANDELARIA</option>
                      <option type='text' value='EL ROSARIO' name='EL ROSARIO'>EL ROSARIO</option>
                      <option type='text' value='EL SAUZAL' name='EL SAUZAL'>EL SAUZAL</option>
                      <option type='text' value='EL TANQUE' name='EL TANQUE'>EL TANQUE</option>
                      <option type='text' value='FASNIA' name='FASNIA'>FASNIA</option>
                      <option type='text' value='GARACHICO' name='GARACHICO'>GARACHICO</option>
                      <option type='text' value='GRANADILLA DE ABONA' name='GRANADILLA DE ABONA'>GRANADILLA DE ABONA</option>
                      <option type='text' value='GUIMAR' name='GUIMAR'>GÜIMAR</option>
                      <option type='text' value='GUIA DE ISORA' name='GUIA DE ISORA'>GUÍA DE ISORA</option>
                      <option type='text' value='ICOD DE LOS VINOS' name='ICOD DE LOS VINOS'>ICOD DE LOS VINOS</option>
                      <option type='text' value='LA GUANCHA' name='LA GUANCHA'>LA GUANCHA</option>
                      <option type='text' value='LA MATANZA DE ACENTEJO' name='LA MATANZA DE ACENTEJO'>LA MATANZA DE ACENTEJO</option>
                      <option type='text' value='LA OROTAVA' name='LA OROTAVA'>LA OROTAVA</option>
                      <option type='text' value='LA VICTORIA DE ACENTEJO' name='LA VICTORIA DE ACENTEJO'>LA VICTORIA DE ACENTEJO</option>
                      <option type='text' value='LOS REALEJOS' name='LOS REALEJOS'>LOS REALEJOS</option>
                      <option type='text' value='LOS SILOS' name='LOS SILOS'>LOS SILOS</option>
                      <option type='text' value='PUERTO DE LA CRUZ' name='PUERTO DE LA CRUZ'>PUERTO DE LA CRUZ</option>
                      <option type='text' value='SAN CRISTOBAL DE LA LAGUNA' name='SAN CRISTOBAL DE LA LAGUNA'>SAN CRISTÓBAL DE LA LAGUNA</option>
                      <option type='text' value='SAN JUAN DE LA RAMBLA' name='SAN JUAN DE LA RAMBLA'>SAN JUAN DE LA RAMBLA</option>
                      <option type='text' value='SAN MIGUEL DE ABONA' name='SAN MIGUEL DE ABONA'>SAN MIGUEL DE ABONA</option>
                      <option type='text' value='SANTA CRUZ DE TENERIFE' name='SANTA CRUZ DE TENERIFE'>SANTA CRUZ DE TENERIFE</option>
                      <option type='text' value='SANTA URSULA' name='SANTA URSULA'>SANTA ÚRSULA</option>
                      <option type='text' value='SANTIAGO DEL TEIDE' name='SANTIAGO DEL TEIDE'>SANTIAGO DEL TEIDE</option>
                      <option type='text' value='TACORONTE' name='TACORONTE'>TACORONTE</option>
                      <option type='text' value='TEGUESTE' name='TEGUESTE'>TEGUESTE</option>
                      <option type='text' value='VILAFLOR' name='VILAFLOR'>VILAFLOR</option>
                    </select>
                  </div>
                  <!-- MUNICIPIOS DE GRAN CANARIA-->
                  <div style="display:none" id="municipiosgrancanaria" class="col-lg-2 form-group">
                    <select name="MunicipiosGranCanaria" id="MunicipiosGranCanaria" class="form-control" onchange="municipio(this.value)">
                      <option disabled selected>MUNICIPIOS</option>
                      <option type='text' value='AGAETE' name='AGAETE'>AGAETE</option>
                      <option type='text' value='AGUINES' name='AGUINES'>AGÜINES</option>
                      <option type='text' value='LA ALDEA DE SAN NICOLAS' name='LA ALDEA DE SAN NICOLAS'>LA ALDEA DE SAN NICOLÁS</option>
                      <option type='text' value='ARTENARA' name='ARTENARA'>ARTENARA</option>
                      <option type='text' value='ARUCAS' name='ARUCAS'>ARUCAS</option>
                      <option type='text' value='FIRGAS' name='FIRGAS'>FIRGAS</option>
                      <option type='text' value='GALDAR' name='GALDAR'>GÁLDAR</option>
                      <option type='text' value='INGENIO' name='INGENIO'>INGENIO</option>
                      <option type='text' value='MOGAN' name='MOGAN'>MOGÁN</option>
                      <option type='text' value='MOYA' name='MOYA'>MOYA</option>
                      <option type='text' value='LAS PALMAS DE GRAN CANARIA' name='LAS PALMAS DE GRAN CANARIA'>LAS PALMAS DE GRAN CANARIA</option>
                      <option type='text' value='SAN BARTOLOME DE TIRAJANA' name='SAN BARTOLOME DE TIRAJANA'>SAN BARTOLOMÉ DE TIRAJANA</option>
                      <option type='text' value='SANTA BRIGIDA' name='SANTA BRIGIDA'>SANTA BRÍGIDA</option>
                      <option type='text' value='SANTA LUCIA DE TIRAJANA' name='SANTA LUCIA DE TIRAJANA'>SANTA LUCÍA DE TIRAJANA</option>
                      <option type='text' value='SANTA MARIA DE GUIA DE GRAN CANARIA' name='SANTA MARIA DE GUIA DE GRAN CANARIA'>SANTA MARÍA DE GUÍA DE GRAN CANARIA</option>
                      <option type='text' value='TEJEDA' name='TEJEDA'>TEJEDA</option>
                      <option type='text' value='TELDE' name='TELDE'>TELDE</option>
                      <option type='text' value='TEROR' name='TEROR'>TEROR</option>
                      <option type='text' value='VALLESECO' name='VALLESECO'>VALLESECO</option>
                      <option type='text' value='VALSEQUILLO DE GRAN CANARIA' name='VALSEQUILLO DE GRAN CANARIA'>VALSEQUILLO DE GRAN CANARIA</option>
                      <option type='text' value='VEGA DE SAN MATEO' name='VEGA DE SAN MATEO'>VEGA DE SAN MATEO</option>
                    </select>
                  </div>

                  <!-- MUNICIPIOS DE FUERTEVENTURA-->
                  <div style="display:none" id="municipiosfuerteventura" class="col-lg-2 form-group">
                    <select name="MunicipiosFuerteventura" id="MunicipiosFuerteventura" class="form-control" onchange="municipio(this.value)">
                      <option disabled selected>MUNICIPIOS</option>
                      <option type='text' value='ANTIGUA' name='ANTIGUA'>ANTIGUA</option>
                      <option type='text' value='BETANCURIA' name='BETANCURIA'>BETANCURIA</option>
                      <option type='text' value='LA OLIVA' name='LA OLIVA'>LA OLIVA</option>
                      <option type='text' value='PAJARA' name='PAJARA'>PÁJARA</option>
                      <option type='text' value='PUERTO DEL ROSARIO' name='PUERTO DEL ROSARIO'>PUERTO DEL ROSARIO</option>
                      <option type='text' value='TUINEJE' name='TUINEJE'>TUINEJE</option>
                    </select>
                  </div>

                  <!-- MUNICIPIOS DE LANZAROTE-->
                  <div style="display:none" id="municipioslanzarote" class="col-lg-2 form-group">
                    <select name="MunicipiosLanzarote" id="MunicipiosLanzarote" class="form-control" onchange="municipio(this.value)">
                      <option disabled selected>MUNICIPIOS</option>
                      <option type='text' value='ARECIFE' name='ARECIFE'>ARECIFE</option>
                      <option type='text' value='HARIA' name='HARIA'>HARÍA</option>
                      <option type='text' value='SAN BARTOLOME' name='SAN BARTOLOME'>SAN BARTOLOMÉ</option>
                      <option type='text' value='TEGUISE' name='TEGUISE'>TEGUISE</option>
                      <option type='text' value='TIAS' name='TIAS'>TÍAS</option>
                      <option type='text' value='TINAJO' name='TINAJO'>TINAJO</option>
                      <option type='text' value='YAIZA' name='YAIZA'>YAIZA</option>
                    </select>
                  </div>
                  <div style="display:none" id="localidad" class="col-lg-2 form-group">
                    <input type="text" class="form-control" id="Localidad" name="localidad" placeholder="LOCALIDAD">
                  </div>
                </div>
                <div class="row">
                  <div style="display:none" id="nombre_yacimiento" class="col-lg-2 form-group">
                    <input type="text" class="form-control" id="Nombre_yacimiento" name="nombre_yacimiento" placeholder="NOMBRE YACIMIENTO">
                  </div>
                  <div style="display:none" id="coordenada" class="col-lg-2 form-group">
                    <input type="text" class="form-control" id="Coordenada" name="coordenada" placeholder="COORDENADA">
                  </div>
                  <div style="display:none" class="col-lg-2 form-group" id="edad">
                    <input type="text" class="form-control" id="Edad" name="edad" placeholder="EDAD">
                  </div>
                </div>

                <div class="row">
                  <div style="display:none" class="col-lg-2 form-group" id="altura">
                    <input type="text" class="form-control" id="Altura" name="altura" placeholder="ALTURA">
                  </div>
                  <div style="display:none" class="col-lg-2 form-group" id="tipo_y">
                    <input type="text" class="form-control" id="Tipo_y" name="tipo_y" placeholder="TIPO">
                  </div>
                  <div style="display:none" class="col-lg-2 form-group" id="estado_conservacion">
                    <input type="text" class="form-control" id="Estado_conservacion" name="estado_conservacion" placeholder="ESTADO CONSERVACIÓN">
                  </div>
                </div>

                <div class="row">
                  <div style="display:none" class="col-lg-6 form-group" id="observaciones_y">
                    <textarea class="form-control" rows="1" id="observaciones_y" name="observaciones_y" placeholder="OBSERVACIONES"></textarea>
                    <!--
                    <input type="text" class="form-control" id="observaciones" name="observaciones" placeholder="OBSERVACIONES">
                    -->
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-2 col-md-3 col-xs-12 col-sm-3">
                    <button type="submit" class="btn btn-success">Enviar</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!--Fin de Yacimiento-->
          <!--Especies-->
          <div class="row">
            <div class="col-lg-12">
              <br><h4>Especies</h4>
              <form class="" action="" method="post">
                <div class="row">
                  <div class="col-lg-2 form-group">
                    <input type="text" class="form-control" id="nombre_especie" name="nombre_especie" placeholder="NOMBRE">
                  </div>
                  <div class="col-lg-2 form-group">
                    <input type="text" class="form-control" id="tipo_especie" name="tipo_especie" placeholder="TIPO">
                  </div>
                  <div class="col-lg-2 form-group">
                    <input type="text" class="form-control" id="yacimiento_especie" name="yacimiento_especie" placeholder="YACIMIENTO">
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-2 form-group">
                    <select name="Museo" class="form-control">
                      <option disabled selected>MUSEO</option>
                      <option type='text' value='si' name=''>SÍ</option>
                      <option type='text' value='no' name=''>NO</option>
                    </select>
                  </div>
                  <div class="col-lg-4 form-group" id="observaciones_es">
                    <textarea class="form-control" rows="1" id="observaciones_es" name="observaciones_es" placeholder="OBSERVACIONES"></textarea>
                    <!--
                    <input type="text" class="form-control" id="observaciones" name="observaciones" placeholder="OBSERVACIONES">
                    -->
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-2 col-md-3 col-xs-12 col-sm-3">
                    <button type="submit" class="btn btn-success">Enviar</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!--Fin de Especies-->
          <!--Excavaciones-->
          <div class="row">
            <div class="col-lg-12">
              <br><h4>Excavaciones</h4>
              <form class="" action="" method="post">
                <div class="row">
                  <div class="col-lg-2 form-group">
                    <input type="text" class="form-control" id="responsable" name="responsable" placeholder="RESPONSABLE">
                  </div>
                  <div class="col-lg-2 form-group">
                    <input type="text" class="form-control" id="financiacion" name="financiacion" placeholder="FINANCIACION">
                  </div>
                  <div class="col-lg-2 form-group">
                    <input type="text" class="form-control" id="yacimiento_ex" name="yacimiento_ex" placeholder="YACIMIENTO">
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-2 form-group" id="data-container">
                    <input id="fecha_inicio_ex" type="text" class="form-control" placeholder="FECHA INICIAL">
                  </div>
                  <div class="col-lg-2 form-group" id="data-container">
                    <input id="fecha_final_ex" type="text" class="form-control" placeholder="FECHA FINAL">
                  </div>
                  <div class="col-lg-2 form-group">
                    <textarea class="form-control" rows="1" id="observaciones_ex" name="observaciones_ex" placeholder="OBSERVACIONES"></textarea>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-2 col-md-3 col-xs-12 col-sm-3">
                    <button type="submit" class="btn btn-success">Enviar</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!--Fin de Excavaciones-->
          <!--Publicaciones-->
          <div class="row">
            <div class="col-lg-12">
              <br><h4>Publicaciones</h4>
              <form class="" action="" method="post">
                <div class="row">
                  <div class="col-lg-2 form-group">
                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="TITULO">
                  </div>
                  <div class="col-lg-2 form-group">
                    <input type="text" class="form-control" id="autor" name="autor" placeholder="AUTOR">
                  </div>
                  <div class="col-lg-2 form-group">
                    <input type="text" class="form-control" id="yacimiento_publi" name="yacimiento_publi" placeholder="YACIMIENTO">
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-2 form-group" id="data-container">
                    <input id="fecha_publi" type="text" class="form-control" placeholder="FECHA INICIAL">
                  </div>
                  <div class="col-lg-4 form-group">
                    <textarea class="form-control" rows="1" id="observaciones_publi" name="observaciones_publi" placeholder="OBSERVACIONES"></textarea>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-2 col-md-3 col-xs-12 col-sm-3">
                    <button type="submit" class="btn btn-success">Enviar</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!--Fin de Publicaciones-->
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
  <script type="text/javascript" src="../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../bootstrap-3.3.7-dist/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
  <script type="text/javascript" src="../bootstrap-3.3.7-dist/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js"></script>
  <script type="text/javascript" src="../js/administracion.js"></script>
  </body>
</html>

<?php
   }else {
       header("Location: ../index.php");
   }
?>
