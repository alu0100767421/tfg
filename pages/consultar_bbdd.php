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
          <a class="navbar-brand" href="https://www.ull.es/"><img class="imagen-menu" alt="Universidad de La Laguna" title="Universidad de La Laguna" src="../images/logoULL/logotipo-principal-recortada.png"></a>
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
            <li><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span><a href="administracion.php">Inicio</a></li>
            <li id="consultar"  class="destacar"><span class="glyphicon glyphicon-search" aria-hidden="true"></span><a href="consultar_bbdd.php">Consultar BBDD</a></li>
            <li id="add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span><a href="add_bbdd.php">Añadir BBDD</a>
              <ul style="display:none" class="list-unstyled" id="submenu">
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a href="anadir/yacimiento.php">Yacimiento</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a href="anadir/especie.php">Especie</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a href="anadir/excavacion.php">Excavación</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a href="anadir/publicacion.php">Publicación</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a href="anadir/deposito.php">Depósito</a></li>
              </ul>

            </li>
            <?php
              //echo "Este es el usuario $username";
              if ($username == "admin") {
                echo "<li><span class='glyphicon glyphicon-user' aria-hidden='true'></span><a href='gestion_usuarios.php'>Gestión Usuarios</a></li>";
              }
             ?>
          </ul>
      <!--FIN MENU LATERAL-->
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
          <h2>Consultar datos</h2>
          <div class="row">
            <div class="col-lg-12">
              <!-- <form class="" action="" method="post"> -->
                <div class="row">
                  <div id="consulta_seleccionada" name="consulta_seleccionada" class="col-lg-2 form-group">
                    <h5>CONSULTAR SOBRE:</h5>
                    <select name="Consulta" id="Consulta" class="form-control" onchange="consulta(this.value)">
                      <option disabled selected>CONSULTA</option>
                      <option type='text' value='YACIMIENTO' name='YACIMIENTO'>YACIMIENTO</option>
                      <option type='text' value='ESPECIE' name='ESPECIE'>ESPECIE</option>
                      <option type='text' value='EXCAVACIONES' name='EXCAVACIONES'>EXCAVACIONES</option>
                      <option type='text' value='PUBLICACIONES' name='PUBLICACIONES'>PUBLICACIONES</option>
                      <option type='text' value='DEPOSITO' name='DEPOSITO'>DEPÓSITO</option>
                    </select>
                    <input type="hidden" name="tipo_consulta" id="tipo_consulta">
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-2 form-group">
                    <h5>PARÁMETROS DE BÚSQUEDA:</h5>
                  </div>
                </div>
                <!--Yacimiento-->
                <div style="display:none" class="row" id="consulta_yacimiento">
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
                    <input type="hidden" name="isla_seleccionada" id="isla_seleccionada">
                  </div>

                  <div id="municipiosvacio" class="col-lg-2 form-group">
                    <select name="MunicipiosVacio" id="MunicipiosVacio" class="form-control">
                      <option disabled selected>MUNICIPIOS</option>
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
                  <input type="hidden" name="municipio_seleccionado" id="municipio_seleccionado">
                  <div class="col-lg-2 form-group" id="edad">
                    <input type="text" class="form-control" id="Edad" name="edad" placeholder="EDAD">
                  </div>
                  <div class="col-lg-2 form-group" id="tipo_y">
                    <input type="text" class="form-control" id="Tipo_y" name="tipo_y" placeholder="TIPO">
                  </div>
                </div>
                <!--Fin de Yacimiento-->

                <!--Especie-->
                <div style="display:none" id="consulta_especie" class="row">
                  <div class="col-lg-2 form-group">
                    <input type="text" class="form-control" id="nombre_especie" name="nombre_especie" placeholder="NOMBRE">
                  </div>
                  <div class="col-lg-2 form-group">
                    <input type="text" class="form-control" id="tipo_especie" name="tipo_especie" placeholder="TIPO">
                  </div>
                  <div class="col-lg-2 form-group">
                    <select name="Yacimientos_Especie" id="Yacimientos_Especie" class="form-control" onchange="especie(this.value)">
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
                  <input type="hidden" name="yacimiento_especie" id="yacimiento_especie">

                  <div class="col-lg-2 form-group">
                    <select name="Deposito" class="form-control" onchange="deposito(this.value)">
                      <option disabled selected>DEPÓSITO</option>
                      <option type='text' value='NINGUNO' name='NINGUNO'>NINGUNO</option>
                      <?php
                        $consulta_yacimiento="SELECT deposito
                                              FROM deposito;";
                        $resultado=pg_query($link,$consulta_yacimiento);
                        echo pg_last_error();
                        while($resultado2 = pg_fetch_assoc($resultado)){
                          $aux = $resultado2['deposito'];
                          echo "<option type='text' value='$aux' name='$aux'>$aux</option>";
                        }
                      ?>
                    </select>
                  </div>
                  <input type="hidden" name="deposito_especie" id="deposito_especie">
                </div>
                <!--Fin de Especie-->

                <!--Excavaciones-->
                <div style="display:none" class="row" id="consulta_excavacion">
                  <div class="col-lg-2 form-group">
                    <input type="text" class="form-control" id="responsable" name="responsable" placeholder="RESPONSABLE">
                  </div>
                  <div class="col-lg-2 form-group">
                    <input type="text" class="form-control" id="financiacion" name="financiacion" placeholder="FINANCIACION">
                  </div>
                  <div class="col-lg-2 form-group">
                    <select name="Yacimientos_Excavacion" id="Yacimientos_Excavacion" class="form-control" onchange="excavacion(this.value)">
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
                  <input type="hidden" name="yacimiento_excavacion" id="yacimiento_excavacion">
                  <div class="col-lg-2 form-group" id="data-container">
                    <input id="fecha_inicio_ex" type="text" class="form-control" name="fecha_inicio_ex" placeholder="FECHA INICIAL">
                  </div>
                  <div class="col-lg-2 form-group" id="data-container">
                    <input id="fecha_final_ex" type="text" class="form-control" name="fecha_final_ex" placeholder="FECHA FINAL">
                  </div>
                </div>
                <!--Fin de excavaciones-->

                <!--Publicaciones-->
                <div style="display:none" class="row" id="consulta_publicacion">
                  <div class="col-lg-2 form-group">
                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="TITULO">
                  </div>
                  <div class="col-lg-2 form-group">
                    <input type="text" class="form-control" id="autor" name="autor" placeholder="AUTOR">
                  </div>
                  <div class="col-lg-2 form-group">
                    <select name="Yacimientos_Publicacion" id="Yacimientos_Publicacion" class="form-control" onchange="publicacion(this.value)">
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
                  <input type="hidden" name="yacimiento_publicacion" id="yacimiento_publicacion">
                  <div class="col-lg-2 form-group" id="data-container">
                    <input id="fecha_publi_ini" type="text" class="form-control" name="fecha_publi_ini" placeholder="FECHA DESDE">
                  </div>
                  <div class="col-lg-2 form-group" id="data-container">
                    <input id="fecha_publi_fin" type="text" class="form-control" name="fecha_publi_fin" placeholder="FECHA HASTA">
                  </div>
                </div>
                <!--Fin de Publicaciones-->

                <!--Publicaciones-->
                <div style="display:none" class="row" id="consulta_deposito">
                  <div class="col-lg-2 form-group">
                    <input type="text" class="form-control" id="deposito" name="deposito" placeholder="NOMBRE">
                  </div>
                  <div class="col-lg-2 form-group">
                    <input type="text" class="form-control" id="pais" name="pais" placeholder="PAIS">
                  </div>
                </div>
                <!--Fin de Publicaciones-->

                <div class="row">
                  <div class="col-lg-1 col-md-3 col-xs-12 col-sm-3">
                    <button type="submit" class="btn btn-success" onclick="consultas()">Consultar</button>
                  </div>
                  <div class="col-lg-1 col-md-3 col-xs-12 col-sm-3">
                    <button type="submit" class="btn btn-danger" onclick="limpiar_cookie()">Limpiar</button>
                  </div>
                </div>
              <!--</form>-->
            </div>
          </div>
          <!-- AQUÍ EMPIEZAN LAS CONSULTAS-->

          <?php
            $link = require("connect_bbdd.php");

            function Mayuscula_con_tilde($aux) {
              $aux = strtr(strtoupper($aux),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ");
              return $aux;
            }


            if(isset($_COOKIE['consulta'])){
              $consulta=$_COOKIE['consulta'];
              //echo "La consulta es de tipo: $consulta";
            }

            if($consulta==""){
              setcookie("consulta", "", time() - 3600);
            }
            else {

              /////////////////////////////////////////////////////////////////////
              /////////////////////////////////////////////////////////////////////
              /////////////////////////////////////////////////////////////////////
              /////////////////////////////////////////////////////////////////////
              //CONSULTAS SOBRE ESPECIES
              if($consulta="ESPECIE"){
                $aux=0;
                if(isset($_COOKIE['especie'])){
                  $especie=$_COOKIE['especie'];
                  $especie=Mayuscula_con_tilde($especie);
                }
                if(isset($_COOKIE['tipo_especie'])){
                  $tipo_especie=$_COOKIE['tipo_especie'];
                  $tipo_especie= Mayuscula_con_tilde($tipo_especie);
                }
                if(isset($_COOKIE['yacimiento_especie'])){
                  $yacimiento_especie=$_COOKIE['yacimiento_especie'];
                  $yacimiento_especie= Mayuscula_con_tilde($yacimiento_especie);
                }
                if(isset($_COOKIE['deposito_especie'])){
                  $deposito_especie=$_COOKIE['deposito_especie'];
                  $deposito_especie= Mayuscula_con_tilde($deposito_especie);
                }
                echo " El especie es: $especie";
                echo " El tipo es: $tipo_especie";
                echo " El yacimiento es: $yacimiento_especie";
                echo " El deposito es: $deposito_especie";

                if($especie=="" && $tipo_especie=="" && ($yacimiento_especie=="" || $yacimiento_especie=="NINGUNO") && ($deposito_especie=="" || $deposito_especie=="NINGUNO")){
                  $consulta="SELECT *
                             FROM especie;";
                  $aux=1;
                }
                elseif($especie!="" && ($yacimiento_especie=="" || $yacimiento_especie=="NINGUNO") && ($deposito_especie=="" || $deposito_especie=="NINGUNO")){
                  if($tipo_especie==""){
                    $consulta="SELECT *
                               FROM especie
                               WHERE especie='".$especie."';";
                  }
                  else {
                    $consulta="SELECT *
                               FROM especie
                               WHERE especie='".$especie."' AND tipo_especie='".$tipo_especie."';";
                  }
                  $aux=1;
                }
                elseif ($tipo_especie!="" && ($yacimiento_especie=="" || $yacimiento_especie=="NINGUNO") && ($deposito_especie=="" || $deposito_especie=="NINGUNO")) {
                  $consulta="SELECT *
                             FROM especie
                             WHERE tipo_especie='".$tipo_especie."';";
                  $aux=1;
                }
                elseif (($yacimiento_especie=="" || $yacimiento_especie=="NINGUNO") && ($deposito_especie!="" || $deposito_especie!="NINGUNO")) {
                  echo "aqui";
                  $consulta="SELECT idespecie,especie, tipo_especie, yacimiento, deposito
                             FROM especie NATURAL JOIN yacimiento_has_especie NATURAL JOIN yacimiento NATURAL JOIN especie_has_deposito NATURAL JOIN deposito
                             WHERE deposito='".$deposito_especie."';";
                }
                
                elseif (($yacimiento_especie!="" || $yacimiento_especie!="NINGUNO")) {
                  if($deposito_especie=="" || $deposito_especie=="NINGUNO"){
                    $consulta="SELECT idespecie,especie, tipo_especie, yacimiento, deposito
                               FROM especie NATURAL JOIN yacimiento_has_especie NATURAL JOIN yacimiento NATURAL JOIN especie_has_deposito NATURAL JOIN deposito
                               WHERE yacimiento='".$yacimiento_especie."';";

                  }
                  else {

                    $consulta="SELECT idespecie,especie, tipo_especie, yacimiento, deposito
                               FROM especie NATURAL JOIN yacimiento_has_especie NATURAL JOIN yacimiento NATURAL JOIN especie_has_deposito NATURAL JOIN deposito
                               WHERE yacimiento='".$yacimiento_especie."' AND deposito='".$deposito_especie."';";
                  }

                }




                $resolucion=pg_query($link,$consulta);
                //echo pg_last_error();
                if(pg_num_rows($resolucion)>0){
                  //echo "  Éxito de consulta";
                  echo "
                  <hr class='linea'>
                  <div class='row'>
                    <div class='col-lg-2 col-md-10 col-sm-4 col-xs-4 form-group'>
                      <h5><b>ESPECIE</b></h5>
                    </div>
                    <div class='col-lg-2 col-md-10 col-sm-4 col-xs-4 form-group'>
                      <h5><b>TIPO</b></h5>
                    </div>
                  ";
                    if($aux!=1){
                    echo"
                      <div class='col-lg-2 col-md-10 col-sm-4 col-xs-4 form-group'>
                        <h5><b>YACIMIENTO</b></h5>
                      </div>
                      <div class='col-lg-2 col-md-10 col-sm-4 col-xs-4 form-group'>
                        <h5><b>DEPOSITO</b></h5>
                      </div>
                    </div>
                    ";
                    }
                    else {
                      echo "
                    </div>";
                    }
                  while($resultado=pg_fetch_assoc($resolucion)){
                    $id_especie=$resultado['idespecie'];
                    $especie=$resultado['especie'];
                    $tipo_especie=$resultado['tipo_especie'];
                    if($aux!=1){
                      $yacimiento=$resultado['yacimiento'];
                      $deposito=$resultado['deposito'];

                    }

                    echo"
                    <form class='' action='modificar/modificar_excavacion.php' method='post'>
                      <div class='row'>
                        <input type='hidden' id='' name='id_especie' value='$id_especie'>
                        <div class='col-lg-2 col-md-10 col-sm-11 col-xs-10 form-group'>
                          <input type='text' class='form-control input_consulta' id='especie_consultado' name='respecie_consultado' value='$especie'>
                        </div>
                        <div class='col-lg-2 col-md-10 col-sm-11 col-xs-10 form-group'>
                          <input type='text' class='form-control input_consulta' id='tipo_especie_consultado' name='tipo_especie_consultado' value='$tipo_especie'>
                        </div>
                    ";
                    if($aux!=1){
                      echo "
                          <div class='col-lg-2 col-md-10 col-sm-11 col-xs-10 form-group'>
                            <input type='text' class='form-control input_consulta' id='yacimiento_es_consultado' name='yacimiento_es_consultado' value='$yacimiento'>
                          </div>
                          <div class='col-lg-2 col-md-10 col-sm-11 col-xs-10 form-group'>
                            <input type='text' class='form-control input_consulta' id='deposito_consultado' name='deposito_consultado' value='$deposito'>
                          </div>
                      ";
                    }

                    echo "
                        <div class='col-lg-1 col-md-10 col-xs-3 col-sm-3'>
                          <button type='submit' class='btn btn-info' name='modificar'>Modificar</button>
                        </div>
                        <div class='col-lg-1 col-md-10 col-xs-1 col-sm-1'>
                          <button type='submit' class='btn btn-danger' name='eliminar'>Eliminar</button>
                        </div>
                      </div>
                    </form>
                    ";
                  }
                }
                else {
                  echo "
                  <hr class='linea'>
                  <div class='row'>
                    <div class='col-lg-10 col-md-4 col-sm-4 col-xs-4 form-group'>
                      <h5><b>No se ha encontrado datos en esta consulta</b></h5>
                    </div>
                  </div>
                  ";
                }


              }//FIN DE CONSULTAS DE ESPECIE




              /////////////////////////////////////////////////////////////////////
              /////////////////////////////////////////////////////////////////////
              /////////////////////////////////////////////////////////////////////
              /////////////////////////////////////////////////////////////////////
              //CONSULTAS SOBRE EXCAVACIONES
              if($consulta=="EXCAVACIONES"){

                if(isset($_COOKIE['responsable'])){
                  $responsable=$_COOKIE['responsable'];
                  $responsable=Mayuscula_con_tilde($responsable);
                }
                if(isset($_COOKIE['financiacion'])){
                  $financiacion=$_COOKIE['financiacion'];
                  $financiacion= Mayuscula_con_tilde($financiacion);
                }
                if(isset($_COOKIE['yacimiento_excavacion'])){
                  $yacimiento_excavacion=$_COOKIE['yacimiento_excavacion'];
                  $yacimiento_excavacion= Mayuscula_con_tilde($yacimiento_excavacion);
                }
                if(isset($_COOKIE['fecha_inicio_ex'])){
                  $fecha_ex_ini=$_COOKIE['fecha_inicio_ex'];
                  $fecha_ex_ini= Mayuscula_con_tilde($fecha_ex_ini);
                }
                if(isset($_COOKIE['fecha_final_ex'])){
                  $fecha_ex_fin=$_COOKIE['fecha_final_ex'];
                  $fecha_ex_fin= Mayuscula_con_tilde($fecha_ex_fin);
                }
                /*echo " El responsable es: $responsable";
                echo " El financiacion es: $financiacion";
                echo " El yacimiento es: $yacimiento_excavacion";
                echo " La fecha de inicio es: $fecha_ex_ini";
                echo " La fecha de fin es: $fecha_ex_fin";*/

                if($responsable=="" && $financiacion=="" && ($yacimiento_excavacion=="" || $yacimiento_excavacion=="NINGUNO") && $fecha_ex_ini=="" && $fecha_ex_fin=="") {

                  $consulta="SELECT idexcavaciones,responsable,financiacion,yacimiento,fecha_inicial,fecha_final,observacion_excavacion,deposito
                             FROM excavacion NATURAL JOIN yacimiento;";
                }
                elseif($responsable!="" && $financiacion==""){
                  $consulta="SELECT idexcavaciones,responsable,financiacion,yacimiento,fecha_inicial,fecha_final,observacion_excavacion,deposito
                             FROM excavacion NATURAL JOIN yacimiento
                             WHERE responsable='".$responsable."';";

                }
                elseif ($financiacion!="" && $responsable=="") {
                  $consulta="SELECT idexcavaciones,responsable,financiacion,yacimiento,fecha_inicial,fecha_final,observacion_excavacion,deposito
                             FROM excavacion NATURAL JOIN yacimiento
                             WHERE financiacion='".$financiacion."';";
                }
                elseif ($financiacion!="" && $responsable!="") {
                  $consulta="SELECT idexcavaciones,responsable,financiacion,yacimiento,fecha_inicial,fecha_final,observacion_excavacion,deposito
                             FROM excavacion NATURAL JOIN yacimiento
                             WHERE financiacion='".$financiacion."' AND responsable='".$responsable."';";
                }
                elseif($fecha_ex_ini!="") {

                  if($fecha_ex_fin!=""){
                    $consulta="SELECT idexcavaciones,responsable,financiacion,yacimiento,fecha_inicial,fecha_final,observacion_excavacion,deposito
                               FROM excavacion NATURAL JOIN yacimiento
                               WHERE fecha_inicial BETWEEN '".$fecha_ex_ini."' AND '".$fecha_ex_fin."';";
                  }
                  else {
                    $consulta="SELECT idexcavaciones,responsable,financiacion,yacimiento,fecha_inicial,fecha_final,observacion_excavacion,deposito
                               FROM excavacion NATURAL JOIN yacimiento
                               WHERE fecha_inicial='".$fecha_ex_ini."';";
                  }

                }
                elseif($yacimiento_excavacion!="" || $yacimiento_excavacion!="NINGUNO") {
                  $consulta="SELECT responsable,financiacion,yacimiento,fecha_inicial,fecha_final,observacion_excavacion,deposito
                             FROM excavacion NATURAL JOIN yacimiento
                             WHERE yacimiento='".$yacimiento_excavacion."';";
                }



                $resolucion=pg_query($link,$consulta);
                if(pg_num_rows($resolucion)>0){
                  //echo "  Éxito de consulta";
                  echo "
                  <hr class='linea'>
                  <div class='row'>
                    <div class='col-lg-2 col-md-10 col-sm-4 col-xs-4 form-group'>
                      <h5><b>RESPONSABLE</b></h5>
                    </div>
                    <div class='col-lg-2 col-md-10 col-sm-4 col-xs-4 form-group'>
                      <h5><b>FINANCIACION</b></h5>
                    </div>
                    <div class='col-lg-1 col-md-10 col-sm-4 col-xs-4 form-group'>
                      <h5><b>YACIMIENTO</b></h5>
                    </div>
                    <div class='col-lg-1 col-md-10 col-sm-4 col-xs-4 form-group'>
                      <h5><b>FECHA INICIO</b></h5>
                    </div>
                    <div class='col-lg-1 col-md-10 col-sm-4 col-xs-4 form-group'>
                      <h5><b>FECHA FIN</b></h5>
                    </div>
                    <div class='col-lg-1 col-md-10 col-sm-4 col-xs-4 form-group'>
                      <h5><b>DEPOSITO</b></h5>
                    </div>
                    <div class='col-lg-2 col-md-10 col-sm-4 col-xs-4 form-group'>
                      <h5><b>OBSERVACION</b></h5>
                    </div>
                  </div>
                  ";
                  $aux=0;

                  while($resultado=pg_fetch_assoc($resolucion)){
                    $id_excavacion=$resultado['idexcavaciones'];
                    $responsable=$resultado['responsable'];
                    $financiacion=$resultado['financiacion'];
                    $yacimiento=$resultado['yacimiento'];
                    $fecha_inicial=$resultado['fecha_inicial'];
                    $fecha_final=$resultado['fecha_final'];
                    $deposito=$resultado['deposito'];
                    $observacion_excavacion=$resultado['observacion_excavacion'];

                    //echo "$aux";
                    /*$deposit_aux="deposit" . $aux;
                    $country_aux="country" .$aux;
                    $modificar="modificar" .$aux;
                    $eliminar="eliminar" .$aux;*/
                    $aux++;
                    echo"
                    <form class='' action='modificar/modificar_excavacion.php' method='post'>
                      <div class='row'>
                        <input type='hidden' id='' name='id_excavacion' value='$id_excavacion'>
                        <div class='col-lg-2 col-md-10 col-sm-11 col-xs-10 form-group'>
                          <input type='text' class='form-control input_consulta' id='responsable_consultado' name='responsable_consultado' value='$responsable'>
                        </div>
                        <div class='col-lg-2 col-md-10 col-sm-11 col-xs-10 form-group'>
                          <input type='text' class='form-control input_consulta' id='financiacion_consultado' name='financiacion_consultado' value='$financiacion'>
                        </div>
                        <div class='col-lg-1 col-md-10 col-sm-11 col-xs-10 form-group'>
                          <input type='text' class='form-control input_consulta' id='yacimiento_ex_consultado' name='yacimiento_ex_consultado' value='$yacimiento'>
                        </div>
                        <div class='col-lg-1 col-md-10 col-sm-11 col-xs-10 form-group' id='data-container'>
                          <input type='text' class='form-control input_consulta' id='fecha_ex_consultado' name='fecha_ex_consultado' value='$fecha_inicial'>
                        </div>
                        <div class='col-lg-1 col-md-10 col-sm-11 col-xs-10 form-group' id='data-container'>
                          <input type='text' class='form-control input_consulta' id='fecha_ex_fin_consultado' name='fecha_ex_fin_consultado' value='$fecha_final'>
                        </div>
                        <div class='col-lg-1 col-md-10 col-sm-11 col-xs-10 form-group'>
                          <input type='text' class='form-control input_consulta' id='deposito_consultado' name='deposito_consultado' value='$deposito'>
                        </div>
                        <div class='col-lg-2 col-md-10 col-sm-11 col-xs-10 form-group'>
                          <input type='text' class='form-control input_consulta' id='observacion_excavacion' name='observacion_excavacion_consultado' value='$observacion_excavacion'>
                        </div>
                        <div class='col-lg-1 col-md-10 col-xs-3 col-sm-3'>
                          <button type='submit' class='btn btn-info' name='modificar'>Modificar</button>
                        </div>
                        <div class='col-lg-1 col-md-10 col-xs-1 col-sm-1'>
                          <button type='submit' class='btn btn-danger' name='eliminar'>Eliminar</button>
                        </div>
                      </div>
                    </form>
                    ";
                  }
                  //echo"$deposit y $country";
                }
                else{
                  echo "
                  <hr class='linea'>
                  <div class='row'>
                    <div class='col-lg-10 col-md-4 col-sm-4 col-xs-4 form-group'>
                      <h5><b>No se ha encontrado datos en esta consulta</b></h5>
                    </div>
                  </div>
                  ";
                }

              }//FIN CONSULTAS DE EXCAVACIONES

/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
              //CONSULTAS SOBRE PUBLICACIONES
              if($consulta=="PUBLICACIONES"){

                if(isset($_COOKIE['titulo'])){
                  $titulo=$_COOKIE['titulo'];
                  $titulo=Mayuscula_con_tilde($titulo);
                }
                if(isset($_COOKIE['autor'])){
                  $autor=$_COOKIE['autor'];
                  $autor= Mayuscula_con_tilde($autor);
                }
                if(isset($_COOKIE['yacimiento_publicacion'])){
                  $yacimiento_publicacion=$_COOKIE['yacimiento_publicacion'];
                  $yacimiento_publicacion= Mayuscula_con_tilde($yacimiento_publicacion);
                }
                if(isset($_COOKIE['fecha_publi_ini'])){
                  $fecha_publi_ini=$_COOKIE['fecha_publi_ini'];
                  $fecha_publi_ini= Mayuscula_con_tilde($fecha_publi_ini);
                }
                if(isset($_COOKIE['fecha_publi_fin'])){
                  $fecha_publi_fin=$_COOKIE['fecha_publi_fin'];
                  $fecha_publi_fin= Mayuscula_con_tilde($fecha_publi_fin);
                }
                /*echo " El titulo es: $titulo";
                echo " El autor es: $autor";
                echo " El yacimiento es: $yacimiento_publicacion";
                echo " La fecha de inicio es: $fecha_publi_ini";
                echo " La fecha de fin es: $fecha_publi_fin";*/

                $aux=0;
                //si se elige un titulo
                if($titulo!=""){
                  $consulta="SELECT idpublicaciones,yacimiento,titulo,fecha,autor
                             FROM yacimiento NATURAL JOIN yacimiento_has_publicacion NATURAL JOIN publicacion
                             WHERE titulo='".$titulo."';";
                }
                //fin si se elige un titulo
                //si mete un autor
                elseif ($autor!="") {
                  if($yacimiento_publicacion=="" || $yacimiento_publicacion=="NINGUNO"){
                    $consulta="SELECT idpublicaciones,yacimiento,titulo,fecha,autor
                               FROM yacimiento NATURAL JOIN yacimiento_has_publicacion NATURAL JOIN publicacion
                               WHERE autor='".$autor."';";
                  }
                  else{
                    $consulta="SELECT idpublicaciones,yacimiento,titulo,fecha,autor
                               FROM yacimiento NATURAL JOIN yacimiento_has_publicacion NATURAL JOIN publicacion
                               WHERE autor='".$autor."' AND yacimiento='".$yacimiento_publicacion."';";
                  }
                }
                //fin si mete un autor
                //si mete un yacimiento
                elseif ($yacimiento_publicacion!="") {

                  $consulta="SELECT idpublicaciones,yacimiento,titulo,fecha,autor
                             FROM yacimiento NATURAL JOIN yacimiento_has_publicacion NATURAL JOIN publicacion
                             WHERE yacimiento='".$yacimiento_publicacion."';";
                }
                //fin si mete un yacimiento

                //si mete un fecha
                elseif ($fecha_publi_ini!="") {
                  if($fecha_publi_fin==""){
                    $consulta="SELECT idpublicaciones,yacimiento,titulo,fecha,autor
                               FROM yacimiento NATURAL JOIN yacimiento_has_publicacion NATURAL JOIN publicacion
                               WHERE fecha='".$fecha_publi_ini."';";
                  }
                  else{
                    $consulta="SELECT idpublicaciones,yacimiento,titulo,fecha,autor
                               FROM yacimiento NATURAL JOIN yacimiento_has_publicacion NATURAL JOIN publicacion
                               WHERE fecha BETWEEN '".$fecha_publi_ini."' AND '".$fecha_publi_fin."';";
                  }

                }
                //fin si mete un fecha
                elseif ($titulo=="" && $autor=="" && ($yacimiento_publicacion=="" || $yacimiento_publicacion=="NINGUNO") && $fecha_publi_ini=="") {
                  $consulta="SELECT *
                             FROM publicacion;";
                  $aux=1;
                }

                $resolucion=pg_query($link,$consulta);
                if(pg_num_rows($resolucion)>0){
                  //echo "  Éxito de consulta";
                  echo "
                  <hr class='linea'>
                  <div class='row'>
                    <div class='col-lg-2 col-md-4 col-sm-4 col-xs-4 form-group'>
                      <h5><b>TITULO</b></h5>
                    </div>
                    <div class='col-lg-2 col-md-4 col-sm-4 col-xs-4 form-group'>
                      <h5><b>AUTOR</b></h5>
                    </div>
                    <div class='col-lg-2 col-md-4 col-sm-4 col-xs-4 form-group'>
                      <h5><b>YACIMIENTO</b></h5>
                    </div>
                    <div class='col-lg-2 col-md-4 col-sm-4 col-xs-4 form-group'>
                      <h5><b>FECHA</b></h5>
                    </div>
                  </div>
                  ";


                  while($resultado=pg_fetch_assoc($resolucion)){
                    $id_publicacion=$resultado['idpublicaciones'];
                    if($aux==0)
                      $yacimiento=$resultado['yacimiento'];
                    else
                      $yacimiento="NO DISPONIBLE EN ESTA CONSULTA";
                    $title=$resultado['titulo'];
                    $autor=$resultado['autor'];
                    $fecha=$resultado['fecha'];

                    //echo "$aux";
                    /*$deposit_aux="deposit" . $aux;
                    $country_aux="country" .$aux;
                    $modificar="modificar" .$aux;
                    $eliminar="eliminar" .$aux;*/

                    echo"
                    <form class='' action='modificar/modificar_publicacion.php' method='post'>
                      <div class='row'>
                        <input type='hidden' id='' name='id_publicacion' value='$id_publicacion'>
                        <div class='col-lg-2 col-md-4 col-sm-11 col-xs-10 form-group'>
                          <input type='text' class='form-control input_consulta' id='titulo_consultado' name='titulo_consultado' value='$title'>
                        </div>
                        <div class='col-lg-2 col-md-4 col-sm-11 col-xs-10 form-group'>
                          <input type='text' class='form-control input_consulta' id='autor_consultado' name='autor_consultado' value='$autor'>
                        </div>
                        <div class='col-lg-2 col-md-4 col-sm-11 col-xs-10 form-group'>
                          <input type='text' class='form-control input_consulta' id='yacimiento_publi_consultado' name='yacimiento_publi_consultado' value='$yacimiento'>
                        </div>
                        <div class='col-lg-2 col-md-4 col-sm-11 col-xs-10 form-group' id='data-container'>
                          <input type='text' class='form-control input_consulta' id='fecha_publi_consultado' name='fecha_publi_consultado' value='$fecha'>
                        </div>
                        <div class='col-lg-1 col-md-2 col-xs-3 col-sm-3'>
                          <button type='submit' class='btn btn-info' name='modificar'>Modificar</button>
                        </div>
                        <div class='col-lg-1 col-md-1 col-xs-1 col-sm-1'>
                          <button type='submit' class='btn btn-danger' name='eliminar'>Eliminar</button>
                        </div>
                      </div>
                    </form>
                    ";
                  }
                  //echo"$deposit y $country";
                }
                else{
                  echo "
                  <hr class='linea'>
                  <div class='row'>
                    <div class='col-lg-10 col-md-4 col-sm-4 col-xs-4 form-group'>
                      <h5><b>No se ha encontrado datos en esta consulta</b></h5>
                    </div>
                  </div>
                  ";
                }

              }//FIN DE LAS CONSULTAS DE PUBLICACIONES



              ///////////////////////////////////////////////////////////////////////////////////////
              ///////////////////////////////////////////////////////////////////////////////////////
              ///////////////////////////////////////////////////////////////////////////////////////
              ///////////////////////////////////////////////////////////////////////////////////////
              ///////////////////////////////////////////////////////////////////////////////////////
              ///////////////////////////////////////////////////////////////////////////////////////
              //CONSULTAS SOBRE DEPOSITO
              if($consulta=="DEPOSITO"){

                if(isset($_COOKIE['deposito'])){
                  $deposito=$_COOKIE['deposito'];
                  $deposito=Mayuscula_con_tilde($deposito);
                }
                if(isset($_COOKIE['pais'])){
                  $pais=$_COOKIE['pais'];
                  $pais= Mayuscula_con_tilde($pais);
                }

                //echo " El deposito es: $deposito";
                //echo " El pais es: $pais";

                //si ha introducio pais y deposito
                if($deposito!="" && $pais!=""){

                  $consulta="SELECT *
                             FROM deposito
                             WHERE deposito='".$deposito."' AND pais='".$pais."';";
                }
                //fin si ha introducio pais y deposito
                //if pais y deposito están vacios se hace una consulta de todos
                elseif ($deposito=="" && $pais=="") {
                  $consulta="SELECT *
                             FROM deposito;";
                }
                //fin de hacer la consulta de todos
                //if pais es vacío
                elseif($pais==""){
                  $consulta="SELECT *
                             FROM deposito
                             WHERE deposito='".$deposito."';";

                }
                //fin de si pais es vacio
                //si no elige un deposito
                elseif ($deposito=="") {
                  $consulta="SELECT *
                             FROM deposito
                             WHERE pais='".$pais."';";
                }
                //if no se elige un deposito
                $deposito=pg_query($link,$consulta);
                if(pg_num_rows($deposito)>0){
                  //echo "  Éxito de consulta";
                  echo "
                    <hr class='linea'>
                    <div class='row'>
                      <div class='col-lg-2 col-md-4 col-sm-4 col-xs-4 form-group'>
                        <h5><b>DEPÓSITO</b></h5>
                      </div>
                      <div class='col-lg-2 col-md-4 col-sm-4 col-xs-4 form-group'>
                        <h5><b>PAÍS</b></h5>
                      </div>
                    </div>
                  ";
                  $aux=0;

                  while($resultado=pg_fetch_assoc($deposito)){
                    $id_deposito=$resultado['iddeposito'];
                    $deposit=$resultado['deposito'];
                    $country=$resultado['pais'];

                    //echo "$aux";
                    /*$deposit_aux="deposit" . $aux;
                    $country_aux="country" .$aux;
                    $modificar="modificar" .$aux;
                    $eliminar="eliminar" .$aux;*/
                    $aux++;
                    echo"
                     <form class='' action='modificar/modificar_deposito.php' method='post'>
                        <div class='row'>
                          <input type='hidden' id='' name='id_deposito' value='$id_deposito'>
                          <div class='col-lg-2 col-md-4 col-sm-11 col-xs-10 form-group'>
                            <input type='text' class='form-control input_consulta' id='deposito_consultado' name='deposito_consultado' value='$deposit'>
                          </div>
                          <div class='col-lg-2 col-md-4 col-sm-11 col-xs-10 form-group'>
                            <input type='text' class='form-control input_consulta' id='pais_consultado' name='pais_consultado' value='$country'>
                          </div>
                          <div class='col-lg-1 col-md-2 col-xs-3 col-sm-3'>
                            <button type='submit' class='btn btn-info' name='modificar'>Modificar</button>
                          </div>
                          <div class='col-lg-1 col-md-1 col-xs-1 col-sm-1'>
                            <button type='submit' class='btn btn-danger' name='eliminar'>Eliminar</button>
                          </div>
                        </div>
                      </form>
                    ";
                  }
                  //echo"$deposit y $country";
                }
                else{
                  echo "
                  <hr class='linea'>
                  <div class='row'>
                    <div class='col-lg-10 col-md-4 col-sm-4 col-xs-4 form-group'>
                      <h5><b>No se ha encontrado datos en esta consulta</b></h5>
                    </div>
                  </div>
                  ";
                }
              }//TERMINA LAS CONSULTAS DE DEPOSITO
            }
          ?>




        <!--AQUÍ DEBEN DE TERMINAR LAS CONSULTAS-->
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
    <script type="text/javascript" src="../js/consulta.js"></script>
  </body>
</html>

<?php
   }else {
       header("Location: ../index.php");
   }
?>
