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

    <title>Sección de consulta de infromación de la base de datos</title>

    <link rel="icon" type="image/png" href="../images/logoULL/logotipo-secundario-ULL.png" />
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
          <a tabindex='1' class="navbar-brand" href="https://www.ull.es/"><img class="imagen-menu" alt="Universidad de La Laguna" title="Universidad de La Laguna" src="../images/logoULL/logotipo-principal-recortada.png"></a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li><a tabindex='1' title='acceder a inicio' href="../index.php">Inicio</a></li>
            <li><a tabindex='1' title='acceder al mapa' href="mapa.php">Mapa</a></li>
          </ul>
        </div>

      </div>
    </nav>





      <!--MENU LATERAL-->
      <div class="row">
        <div class="col-lg-2 col-md-4 col-xs-8 col-sm-6 ">
          <ul class="list-unstyled panel">
            <li ><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span><a title='acceder a inicio' tabindex='1' href="administracion.php">Inicio</a></li>
            <li><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><a title='¿cómo funciona la apliación?' tabindex='1' href="usar_aplicacion.php">¿Cómo funciona?</a></li>
            <li class="destacar" id="consultar"><span class="glyphicon glyphicon-search" aria-hidden="true"></span><a title='acceder a consultar base de datos' tabindex='1' href="consultar_bbdd.php">Consultar/Modificar</a></li>
            <li id="valoracion"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span><a title='acceder a valoraciones' tabindex='1' href="valoracion.php">Valoraciones</a>
              <ul style="display:none" class="list-unstyled" id="submenu_valoracion">
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceder a añadir una valoracion' href="valoraciones/add_valoracion.php">Añadir Valoración</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceder a consultar una valoracion' href="valoraciones/consultar_valoracion.php">Consultar Valoración</a></li>
              </ul>
            </li>
            <li id="add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span><a title='acceder a añadir a la base de datos' tabindex='1' href="add_bbdd.php">Añadir BBDD</a>
              <ul style="display:none" class="list-unstyled" id="submenu">
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceder a añadir yacimientos' href="anadir/yacimiento.php">Yacimiento</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceder a añadir especies' href="anadir/especie.php">Especie</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceder a añadir excavación' href="anadir/excavacion.php">Excavación</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceder a añadir publicación' href="anadir/publicacion.php">Publicación</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a title='acceder a añadir depósito' href="anadir/deposito.php">Depósito</a></li>
              </ul>

            </li>
            <?php
              //echo "Este es el usuario $username";
              if ($username == "admin") {
                echo "<li><span class='glyphicon glyphicon-user' aria-hidden='true'></span><a title='acceder a gestión de usuarios' tabindex='1' href='gestion_usuarios.php'>Gestión Usuarios</a></li>";
              }
             ?>
          </ul>

      <!--FIN MENU LATERAL-->
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
                <button tabindex='2' type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 tabindex='1' class="modal-title">Cierre de sesión</h4>
              </div>
              <div class="modal-body">
                <p tabindex='2'>¿Está seguro que desea cerrar sesión?</p>
              </div>
              <div class="modal-footer">
                <form action="cerrar_sesion.php" method="post">
                  <button tabindex='2' type="submit" class="btn btn-danger boton">Cerrar Sesión</button><br>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!--FIN MENU LATERAL-->
        <div class="col-lg-10 col-md-8 col-xs-12 col-sm-6 contenido">
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

          <h2 tabindex='2'>Consultar datos</h2>
          <div class="row">
            <div class="col-lg-12">
              <!-- <form class="" action="" method="post"> -->
                <div class="row">
                  <div id="consulta_seleccionada" class="col-lg-2 form-group">
                    <h5 tabindex='2'>CONSULTAR SOBRE:</h5>
                    <select tabindex='2' name="Consulta" id="Consulta" class="form-control" onchange="consulta(this.value)">
                      <option disabled selected>CONSULTA</option>
                      <option  value='YACIMIENTO' >YACIMIENTO</option>
                      <option  value='UBICACION' >UBICACIÓN</option>
                      <option  value='ESPECIE' >ESPECIE</option>
                      <option  value='EXCAVACIONES' >EXCAVACIONES</option>
                      <option  value='PUBLICACIONES' >PUBLICACIONES</option>
                      <option  value='DEPOSITO' >DEPÓSITO</option>
                    </select>
                    <input type="hidden" name="tipo_consulta" id="tipo_consulta">
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-2 form-group">
                    <h5 tabindex='2'>PARÁMETROS DE BÚSQUEDA:</h5>
                  </div>
                </div>
                <!--Yacimiento-->
                <div style="display:none" class="row" id="consulta_yacimiento">
                  <div class="col-lg-2 form-group">
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

                  <div id="municipiosvacio" class="col-lg-2 form-group">
                    <select tabindex='2' name="MunicipiosVacio" id="MunicipiosVacio" class="form-control">
                      <option disabled selected>MUNICIPIOS</option>
                    </select>
                  </div>
                  <!-- MUNICIPIOS DE LA PALMA-->
                  <div style="display:none" id="municipioslapalma" class="col-lg-2 form-group">
                    <select tabindex='2' name="MunicipiosLaPalma" id="MunicipiosLaPalma" class="form-control" onchange="">
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
                  <div style="display:none" id="municipioslagomera" class="col-lg-2 form-group">
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
                  <div style="display:none" id="municipioselhierro" class="col-lg-2 form-group">
                    <select tabindex='2' name="MunicipiosElHierro" id="MunicipiosElHierro" class="form-control" onchange="municipio(this.value)">
                      <option disabled selected>MUNICIPIOS</option>
                      <option  value='EL PINAR' >EL PINAR</option>
                      <option  value='FRONTERA' >FRONTERA</option>
                      <option  value='VALVERDE' >VALVERVE</option>
                    </select>
                  </div>
                  <!-- MUNICIPIOS DE TENERIFE-->
                  <div style="display:none" id="municipiostenerife" class="col-lg-2 form-group">
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
                  <div style="display:none" id="municipiosgrancanaria" class="col-lg-2 form-group">
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
                  <div style="display:none" id="municipiosfuerteventura" class="col-lg-2 form-group">
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
                  <div style="display:none" id="municipioslanzarote" class="col-lg-2 form-group">
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
                  <div class="col-lg-2 form-group">
                    <select tabindex='2' name="Yacimientos_Yacimiento" id="Yacimientos_Yacimiento" class="form-control" onchange="yacimiento(this.value)">
                      <option disabled selected>YACIMIENTOS</option>
                      <option  value='NINGUNO' >NINGUNO</option>
                      <?php
                        $consulta_yacimiento="SELECT yacimiento
                                              FROM yacimiento
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
                  <input type="hidden" name="yacimiento_yacimiento" id="yacimiento_yacimiento">
                  <div class="col-lg-2 form-group" id="edad">
                    <input tabindex='2' type="text" class="form-control" id="Edad" name="edad" placeholder="EDAD">
                  </div>
                  <div class="col-lg-2 form-group" id="tipo_y">
                    <input tabindex='2' type="text" class="form-control" id="Tipo_y" name="tipo_y" placeholder="TIPO">
                  </div>
                  <div class="col-lg-1 form-group" id="altura">
                    <input tabindex='2' title='Recuerde que solo debe introducir un número' type="number" class="form-control" id="Altura" name="altura" placeholder="ALTURA">
                  </div>
                </div>
                <!--Fin de Yacimiento-->

                <!--ubicacion-->
                <div style="display:none" id="consulta_ubicacion" class="row">
                  <div class="col-lg-2 form-group">
                    <select tabindex='2' name="Yacimientos_Ubicacion" id="Yacimientos_Ubicacion" class="form-control" onchange="ubicacion(this.value)">
                      <option disabled selected>YACIMIENTOS</option>
                      <option  value='NINGUNO' >NINGUNO</option>
                      <?php
                        $consulta_yacimiento="SELECT yacimiento
                                              FROM yacimiento
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
                  <input type="hidden" name="yacimiento_ubicacion" id="yacimiento_ubicacion">
                </div>
                <!--Fin de ubicacion-->

                <!--Especie-->
                <div style="display:none" id="consulta_especie" class="row">
                  <div class="col-lg-2 form-group">
                    <input tabindex='2' type="text" class="form-control" id="nombre_especie" name="nombre_especie" placeholder="NOMBRE">
                  </div>
                  <div class="col-lg-2 form-group">
                    <input tabindex='2' type="text" class="form-control" id="tipo_especie" name="tipo_especie" placeholder="TIPO">
                  </div>
                  <div class="col-lg-2 form-group">
                    <select tabindex='2' name="Yacimientos_Especie" id="Yacimientos_Especie" class="form-control" onchange="especie(this.value)">
                      <option disabled selected>YACIMIENTOS</option>
                      <option  value='NINGUNO' >NINGUNO</option>
                      <?php
                        $consulta_yacimiento="SELECT yacimiento
                                              FROM yacimiento
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
                  <input type="hidden" name="yacimiento_especie" id="yacimiento_especie">

                  <div class="col-lg-2 form-group">
                    <select tabindex='2' name="Deposito" class="form-control" onchange="deposito(this.value)">
                      <option disabled selected>DEPÓSITO</option>
                      <option  value='NINGUNO' >NINGUNO</option>
                      <?php
                        $consulta_yacimiento="SELECT deposito
                                              FROM deposito;";
                        $resultado=pg_query($link,$consulta_yacimiento);
                        echo pg_last_error();
                        while($resultado2 = pg_fetch_assoc($resultado)){
                          $aux = $resultado2['deposito'];
                          echo "<option  value='$aux' >$aux</option>";
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
                    <input tabindex='2' type="text" class="form-control" id="responsable" name="responsable" placeholder="RESPONSABLE">
                  </div>
                  <div class="col-lg-2 form-group">
                    <input tabindex='2' type="text" class="form-control" id="financiacion" name="financiacion" placeholder="FINANCIACION">
                  </div>
                  <div class="col-lg-2 form-group">
                    <select tabindex='2' name="Yacimientos_Excavacion" id="Yacimientos_Excavacion" class="form-control" onchange="excavacion(this.value)">
                      <option disabled selected>YACIMIENTOS</option>
                      <option  value='NINGUNO' >NINGUNO</option>
                      <?php
                        $consulta_yacimiento="SELECT yacimiento
                                              FROM yacimiento
                                              ORDER BY yacimiento ASC;";
                        $resultado=pg_query($link,$consulta_yacimiento);
                        echo pg_last_error();
                        while($resultado2 = pg_fetch_assoc($resultado)){
                          $aux = $resultado2['yacimiento'];
                          echo "<option  value='$aux'>$aux</option>";
                        }

                      ?>
                     </select>
                  </div>
                  <input type="hidden" name="yacimiento_excavacion" id="yacimiento_excavacion">
                  <div class="col-lg-2 form-group data-container" >
                    <input tabindex='2' id="fecha_inicio_ex" type="text" class="form-control" name="fecha_inicio_ex" placeholder="FECHA INICIAL">
                  </div>
                  <div class="col-lg-2 form-group data-container" >
                    <input tabindex='2' id="fecha_final_ex" type="text" class="form-control" name="fecha_final_ex" placeholder="FECHA FINAL">
                  </div>
                </div>
                <!--Fin de excavaciones-->

                <!--Publicaciones-->
                <div style="display:none" class="row" id="consulta_publicacion">
                  <div class="col-lg-2 form-group">
                    <input tabindex='2' type="text" class="form-control" id="titulo" name="titulo" placeholder="TITULO">
                  </div>
                  <div class="col-lg-2 form-group">
                    <input tabindex='2' type="text" class="form-control" id="autor" name="autor" placeholder="AUTOR">
                  </div>
                  <div class="col-lg-2 form-group">
                    <select tabindex='2' name="Yacimientos_Publicacion" id="Yacimientos_Publicacion" class="form-control" onchange="publicacion(this.value)">
                      <option disabled selected>YACIMIENTOS</option>
                      <option  value='NINGUNO' >NINGUNO</option>
                      <?php
                        $consulta_yacimiento="SELECT yacimiento
                                              FROM yacimiento
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
                  <input type="hidden" name="yacimiento_publicacion" id="yacimiento_publicacion">
                  <div class="col-lg-2 form-group data-container" >
                    <input tabindex='2' id="fecha_publi_ini" type="text" class="form-control" name="fecha_publi_ini" placeholder="FECHA DESDE">
                  </div>
                  <div class="col-lg-2 form-group data-container" >
                    <input tabindex='2' id="fecha_publi_fin" type="text" class="form-control" name="fecha_publi_fin" placeholder="FECHA HASTA">
                  </div>
                </div>
                <!--Fin de Publicaciones-->

                <!--Publicaciones-->
                <div style="display:none" class="row" id="consulta_deposito">
                  <div class="col-lg-4 form-group">
                    <input tabindex='2' type="text" class="form-control" id="deposito" name="deposito" placeholder="NOMBRE">
                  </div>
                  <div class="col-lg-4 form-group">
                    <input tabindex='2' type="text" class="form-control" id="pais" name="pais" placeholder="PAIS">
                  </div>
                </div>
                <!--Fin de Publicaciones-->

                <div class="row">
                  <div class="col-lg-1 col-md-3 col-xs-12 col-sm-3">
                    <button tabindex='2' title='Realizar la consulta' type="submit" class="btn btn-success" onclick="consultas()">Consultar</button>
                  </div>
                  <div class="col-lg-1 col-md-3 col-xs-12 col-sm-3">
                    <button tabindex='2' title='Limpiar las consultas' type="submit" class="btn btn-danger" onclick="limpiar_cookie()">Limpiar</button>
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
              //CONSULTAS SOBRE YACIMIENTO







              if($consulta=="YACIMIENTO"){

                if(isset($_COOKIE['isla'])){
                  $isla=$_COOKIE['isla'];
                }
                if(isset($_COOKIE['municipio'])){
                  $municipio=$_COOKIE['municipio'];
                }
                if(isset($_COOKIE['yacimiento_yacimiento'])){
                  $yacimiento=$_COOKIE['yacimiento_yacimiento'];
                }
                if(isset($_COOKIE['edad'])){
                  $edad=$_COOKIE['edad'];
                  $edad= Mayuscula_con_tilde($edad);
                }
                if(isset($_COOKIE['tipo_yacimiento'])){
                  $tipo=$_COOKIE['tipo_yacimiento'];
                  $tipo= Mayuscula_con_tilde($tipo);
                }
                if(isset($_COOKIE['altura'])){
                  $altura=$_COOKIE['altura'];
                }
              /*  echo " El isla es: $isla";
                echo " El municipio es: $municipio";
                echo " El yacimiento es: $yacimiento";
                echo " El edad es: $edad";
                echo " El tipo es: $tipo";
                echo " El altura es: $altura";*/

                if($yacimiento!=""){
                  $consulta="SELECT *
                             FROM yacimiento
                             WHERE yacimiento='".$yacimiento."';";

                }
                elseif($isla!="" && $municipio==""){
                  if($edad=="" && $altura=="" && $tipo==""){
                    $consulta="SELECT idyacimiento,idubicacion,yacimiento,edad,altura,tipo_yacimiento,cant_publicaciones,observacion_yacimiento, isla,municipio,localidad,latitud,longitud
                               FROM yacimiento NATURAL JOIN ubicacion
                               WHERE isla='".$isla."';";
                  }
                  else{
                    if($edad!=""){
                      $consulta="SELECT idyacimiento,idubicacion,yacimiento,edad,altura,tipo_yacimiento,cant_publicaciones,observacion_yacimiento, isla,municipio,localidad,latitud,longitud
                                 FROM yacimiento NATURAL JOIN ubicacion
                                 WHERE isla='".$isla."' AND edad='".$edad."';";
                    }
                    if($altura!=""){
                      $consulta="SELECT idyacimiento,idubicacion,yacimiento,edad,altura,tipo_yacimiento,cant_publicaciones,observacion_yacimiento, isla,municipio,localidad,latitud,longitud
                                 FROM yacimiento NATURAL JOIN ubicacion
                                 WHERE isla='".$isla."' AND altura>='".$altura."' AND altura<='".$altura."'+50 ;";
                    }
                    if($tipo!=""){
                      $consulta="SELECT idyacimiento,idubicacion,yacimiento,edad,altura,tipo_yacimiento,cant_publicaciones,observacion_yacimiento, isla,municipio,localidad,latitud,longitud
                                 FROM yacimiento NATURAL JOIN ubicacion
                                 WHERE isla='".$isla."' AND tipo_yacimiento='".$tipo."';";
                    }
                  }

                }
                elseif ($municipio!="") {
                  if($edad=="" && $altura=="" && $tipo==""){
                    $consulta="SELECT idyacimiento,idubicacion,yacimiento,edad,altura,tipo_yacimiento,cant_publicaciones,observacion_yacimiento, isla,municipio,localidad,latitud,longitud
                               FROM yacimiento NATURAL JOIN ubicacion
                               WHERE isla='".$isla."' AND municipio='".$municipio."';";
                  }
                  else{
                    if($edad!=""){
                      $consulta="SELECT idyacimiento,idubicacion,yacimiento,edad,altura,tipo_yacimiento,cant_publicaciones,observacion_yacimiento, isla,municipio,localidad,latitud,longitud
                                 FROM yacimiento NATURAL JOIN ubicacion
                                 WHERE isla='".$isla."' AND edad='".$edad."' AND municipio='".$municipio."';";
                    }
                    if($altura!=""){
                      $consulta="SELECT idyacimiento,idubicacion,yacimiento,edad,altura,tipo_yacimiento,cant_publicaciones,observacion_yacimiento, isla,municipio,localidad,latitud,longitud
                                 FROM yacimiento NATURAL JOIN ubicacion
                                 WHERE isla='".$isla."' AND altura>='".$altura."' AND altura<='".$altura."'+50 AND municipio='".$municipio."';";
                    }
                    if($tipo!=""){
                      $consulta="SELECT idyacimiento,idubicacion,yacimiento,edad,altura,tipo_yacimiento,cant_publicaciones,observacion_yacimiento, isla,municipio,localidad,latitud,longitud
                                 FROM yacimiento NATURAL JOIN ubicacion
                                 WHERE isla='".$isla."' AND tipo_yacimiento='".$tipo."' AND municipio='".$municipio."';";
                    }
                  }
                }

                elseif($edad!=""){
                  $consulta="SELECT idyacimiento,idubicacion,yacimiento,edad,altura,tipo_yacimiento,cant_publicaciones,observacion_yacimiento, isla,municipio,localidad,latitud,longitud
                             FROM yacimiento NATURAL JOIN ubicacion
                             WHERE edad='".$edad."';";
                }
                elseif($altura!=""){
                  $consulta="SELECT idyacimiento,idubicacion,yacimiento,edad,altura,tipo_yacimiento,cant_publicaciones,observacion_yacimiento, isla,municipio,localidad,latitud,longitud
                             FROM yacimiento NATURAL JOIN ubicacion
                             WHERE altura>='".$altura."' AND altura<='".$altura."'+50;";
                }
                elseif($tipo!=""){
                  $consulta="SELECT idyacimiento,idubicacion,yacimiento,edad,altura,tipo_yacimiento,cant_publicaciones,observacion_yacimiento, isla,municipio,localidad,latitud,longitud
                             FROM yacimiento NATURAL JOIN ubicacion
                             WHERE tipo_yacimiento='".$tipo."';";
                }

                function mostrar_informacion_yacimiento(){
                  echo"
                  <hr class='linea'>
                  <div class='row'>
                    <div class='col-lg-2 col-md-10 col-sm-4 col-xs-4 form-group'>
                      <h5><b>YACIMIENTO</b></h5>
                    </div>
                    <div class='col-lg-2 col-md-10 col-sm-4 col-xs-4 form-group'>
                      <h5><b>EDAD</b></h5>
                    </div>
                    <div class='col-lg-1 col-md-10 col-sm-4 col-xs-4 form-group'>
                      <h5><b>ALTURA</b></h5>
                    </div>
                    <div class='col-lg-2 col-md-10 col-sm-4 col-xs-4 form-group'>
                      <h5><b>TIPO</b></h5>
                    </div>
                    <div class='col-lg-1 col-md-10 col-sm-4 col-xs-4 form-group'>
                      <h5><b>PUBLICACIÓN</b></h5>
                    </div>
                    <div class='col-lg-2 col-md-10 col-sm-4 col-xs-4 form-group'>
                      <h5><b>OBSERVACION</b></h5>
                    </div>
                  </div>";


                }

                $resolucion=pg_query($link,$consulta);
                //echo pg_last_error();
                $aux=0;
                if(pg_num_rows($resolucion)>0){
                  //echo "  Éxito de consulta";
                  mostrar_informacion_yacimiento();
                  while($resultado=pg_fetch_assoc($resolucion)){
                    $id_ubicacion=$resultado['idubicacion'];
                    $id_yacimiento=$resultado['idyacimiento'];
                    $yacimiento=$resultado['yacimiento'];
                    $edad=$resultado['edad'];
                    $altura=$resultado['altura'];
                    $tipo=$resultado['tipo_yacimiento'];
                    $publicaciones=$resultado['cant_publicaciones'];
                    $observacion=$resultado['observacion_yacimiento'];


                    echo"

                    <form class='' action='modificar/modificar_yacimiento.php' method='post'>
                      <div class='row'>

                        <input type='hidden'  name='id_yacimiento' value='$id_yacimiento'>
                        <div class='col-lg-2 col-md-10 col-sm-11 col-xs-10 form-group'>
                          <input type='text' title='$yacimiento' class='form-control input_consulta'  name='yacimiento_consultado' value='$yacimiento'>
                        </div>
                        <div class='col-lg-2 col-md-10 col-sm-11 col-xs-10 form-group'>
                          <input type='text' title='$edad' class='form-control input_consulta'  name='edad_consultado' value='$edad'>
                        </div>
                        <div class='col-lg-1 col-md-10 col-sm-11 col-xs-10 form-group'>
                          <input type='number' title='Si va a modicar la altura, recuerde que solo debe introducir un número' class='form-control input_consulta'  name='altura_consultado' value='$altura'>
                        </div>
                        <div class='col-lg-2 col-md-10 col-sm-11 col-xs-10 form-group'>
                          <input type='text' title='$tipo' class='form-control input_consulta'  name='tipo_consultado' value='$tipo'>
                        </div>
                        <div class='col-lg-1 col-md-10 col-sm-11 col-xs-10 form-group'>
                          <input type='text' title='Este valor se calcula automáticamente' readonly='readonly' class='form-control input_consulta'  name='publicaciones_consultado' value='$publicaciones'>
                        </div>
                        <div class='col-lg-2 col-md-10 col-sm-11 col-xs-10 form-group'>
                          <input type='text' title='$observacion' class='form-control input_consulta'  name='observacion_consultado' value='$observacion'>
                        </div>
                        <div class='col-lg-1 col-md-10 col-xs-3 col-sm-3'>
                          <!--<button type='submit' class='btn btn-info' name='modificar'>Modificar</button>-->
                          <button type='button' title='Puede modificar todos los valores del yacimiento, incluído su nombre' class='btn btn-info' data-toggle='modal' data-target='#modal_modificar$aux'>Modificar</button>
                        </div>
                        <div class='col-lg-1 col-md-10 col-xs-1 col-sm-1'>
                          <!--<button type='submit' class='btn btn-danger' name='eliminar'>Eliminar</button>-->
                          <button type='button' title='Va a eliminar el yacimiento' class='btn btn-danger' data-toggle='modal' data-target='#modal_eliminar$aux'>Eliminar</button>
                        </div>
                      </div>

                      <div id='modal_modificar$aux' class='modal fade' role='dialog'>
                        <div class='modal-dialog'>
                          <!-- Modal content-->
                          <div class='modal-content'>
                            <div class='modal-header'>
                              <button type='button' class='close' data-dismiss='modal'>&times;</button>
                              <h4 class='modal-title'>Modificar yacimiento</h4>
                            </div>
                            <div class='modal-body'>
                              <p>¿Está seguro que desea modificar el yacimiento <b>$yacimiento</b>?</p>
                            </div>
                            <div class='modal-footer'>
                                <button type='submit' class='btn btn-info boton' name='modificar'>Modificar</button><br>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div id='modal_eliminar$aux' class='modal fade' role='dialog'>
                        <div class='modal-dialog'>
                          <!-- Modal content-->
                          <div class='modal-content'>
                            <div class='modal-header'>
                              <button type='button' class='close' data-dismiss='modal'>&times;</button>
                              <h4 class='modal-title'>Eliminar yacimiento</h4>
                            </div>
                            <div class='modal-body'>
                              <p>¿Está seguro que desea eliminar el yacimiento <b>$yacimiento</b>?</p>
                            </div>
                            <div class='modal-footer'>
                                <button type='submit' class='btn btn-danger boton' name='eliminar'>Eliminar</button><br>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>


                    ";
                    $aux++;
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

              }

              /////////////////////////////////////////////////////////////////////
              /////////////////////////////////////////////////////////////////////
              /////////////////////////////////////////////////////////////////////
              /////////////////////////////////////////////////////////////////////
              //CONSULTAS SOBRE UBICACION
              if($consulta=="UBICACION"){
                if(isset($_COOKIE['yacimiento_ubicacion'])){
                  $yacimiento=$_COOKIE['yacimiento_ubicacion'];
                }

                //echo "$yacimiento";

                $consulta="SELECT idyacimiento,idubicacion,yacimiento,isla,municipio,localidad,latitud,longitud
                           FROM yacimiento NATURAL JOIN ubicacion
                           WHERE yacimiento='".$yacimiento."';";


                 function mostrar_informacion_yacimiento(){
                   echo"
                   <hr class='linea'>
                   <div class='row'>
                     <div class='col-lg-2 col-md-10 col-sm-4 col-xs-4 form-group'>
                       <h5><b>YACIMIENTO</b></h5>
                     </div>
                     <div class='col-lg-2 col-md-10 col-sm-4 col-xs-4 form-group'>
                       <h5><b>ISLA</b></h5>
                     </div>
                     <div class='col-lg-2 col-md-10 col-sm-4 col-xs-4 form-group'>
                       <h5><b>MUNICIPIO</b></h5>
                     </div>
                     <div class='col-lg-2 col-md-10 col-sm-4 col-xs-4 form-group'>
                       <h5><b>LOCALIDAD</b></h5>
                     </div>
                     <div class='col-lg-1 col-md-10 col-sm-4 col-xs-4 form-group'>
                       <h5><b>LATITUD</b></h5>
                     </div>
                     <div class='col-lg-1 col-md-10 col-sm-4 col-xs-4 form-group'>
                       <h5><b>LONGITUD</b></h5>
                     </div>
                   </div>

                   ";


                 }
                 $resolucion=pg_query($link,$consulta);

                 //echo pg_last_error();
                 if(pg_num_rows($resolucion)>0){
                   //echo "  Éxito de consulta";
                   mostrar_informacion_yacimiento();
                   while($resultado=pg_fetch_assoc($resolucion)){
                     $id_ubicacion=$resultado['idubicacion'];
                     $id_yacimiento=$resultado['idyacimiento'];
                     $yacimiento=$resultado['yacimiento'];
                     $isla=$resultado['isla'];
                     $municipio=$resultado['municipio'];
                     $localidad=$resultado['localidad'];
                     $latitud=$resultado['latitud'];
                     $longitud=$resultado['longitud'];

                     echo"

                     <form class='' action='modificar/modificar_ubicacion.php' method='post'>
                       <div class='row'>
                        <input type='hidden'  name='id_yacimiento' value='$id_yacimiento'>
                        <input type='hidden'  name='id_ubicacion' value='$id_ubicacion'>
                         <div class='col-lg-2 col-md-10 col-sm-11 col-xs-10 form-group'>
                           <input type='text' title='$yacimiento' readonly='readonly' class='form-control input_consulta'  name='yacimiento_consultado' value='$yacimiento'>
                         </div>
                         <div class='col-lg-2 col-md-10 col-sm-11 col-xs-10 form-group'>
                           <input type='text' title='$isla' class='form-control input_consulta'  name='isla_consultado' value='$isla'>
                         </div>
                         <div class='col-lg-2 col-md-10 col-sm-11 col-xs-10 form-group'>
                           <input type='text' title='$municipio' class='form-control input_consulta'  name='municipio_consultado' value='$municipio'>
                         </div>
                         <div class='col-lg-2 col-md-10 col-sm-11 col-xs-10 form-group'>
                           <input type='text' title='$localidad' class='form-control input_consulta'  name='localidad_consultado' value='$localidad'>
                         </div>
                         <div class='col-lg-1 col-md-10 col-sm-11 col-xs-10 form-group'>
                           <input type='text' readonly='readonly' title='Recuerde que este valor se establece con el mapa de abajo: $latitud' class='form-control input_consulta' id='Latitud' name='latitud_consultado' value='$latitud'>
                         </div>
                         <div class='col-lg-1 col-md-10 col-sm-11 col-xs-10 form-group'>
                           <input type='text' readonly='readonly' title='Recuerde que este valor se establece con el mapa de abajo: $longitud' class='form-control input_consulta' id='Longitud' name='longitud_consultado' value='$longitud'>
                         </div>
                         <div class='col-lg-1 col-md-10 col-xs-3 col-sm-3'>
                           <!--<button type='submit' class='btn btn-info' name='modificar'>Modificar</button>-->
                           <button type='button' title='Solo podrá modificar los datos relacionados con la ubicación del yacimiento $yacimiento' class='btn btn-info' data-toggle='modal' data-target='#modal_modificar'>Modificar</button>
                         </div>
                       </div>
                       <div id='modal_modificar' class='modal fade' role='dialog'>
                         <div class='modal-dialog'>
                           <!-- Modal content-->
                           <div class='modal-content'>
                             <div class='modal-header'>
                               <button type='button' class='close' data-dismiss='modal'>&times;</button>
                               <h4 class='modal-title'>Modificar ubicación</h4>
                             </div>
                             <div class='modal-body'>
                               <p>¿Está seguro que desea modificar la ubicación del yacimiento <b>$yacimiento</b>?</p>
                             </div>
                             <div class='modal-footer'>
                                 <button type='submit' class='btn btn-info boton' name='modificar'>Modificar</button><br>
                             </div>
                           </div>
                         </div>
                       </div>

                     </form>
                     <div class='row'>
                       <div class='col-lg-6' class='mapa_google' id='map'>
                       </div>
                     </div>
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


              }


              /////////////////////////////////////////////////////////////////////
              /////////////////////////////////////////////////////////////////////
              /////////////////////////////////////////////////////////////////////
              /////////////////////////////////////////////////////////////////////
              //CONSULTAS SOBRE ESPECIES
              if($consulta=="ESPECIE"){
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
                /*echo " El especie es: $especie";
                echo " El tipo es: $tipo_especie";
                echo " El yacimiento es: $yacimiento_especie";
                echo " El deposito es: $deposito_especie";*/

                if($especie=="" && $tipo_especie=="" && ($yacimiento_especie=="" || $yacimiento_especie=="NINGUNO") && ($deposito_especie=="" || $deposito_especie=="NINGUNO")){
                  $consulta="SELECT *
                             FROM especie
                             ORDER BY especie ASC;";
                  $aux=1;
                }
                elseif($especie!="" && ($yacimiento_especie=="" || $yacimiento_especie=="NINGUNO") && ($deposito_especie=="" || $deposito_especie=="NINGUNO")){
                  if($tipo_especie==""){
                    $consulta="SELECT *
                               FROM especie
                               WHERE especie LIKE'".$especie."%'
                               ORDER BY especie ASC;";
                  }
                  else {
                    $consulta="SELECT *
                               FROM especie
                               WHERE especie LIKE '".$especie."%' AND tipo_especie LIKE '".$tipo_especie."%'
                               ORDER BY especie ASC;";
                  }
                  $aux=1;
                }
                elseif ($tipo_especie!="" && ($yacimiento_especie=="" || $yacimiento_especie=="NINGUNO") && ($deposito_especie=="" || $deposito_especie=="NINGUNO")) {
                  $consulta="SELECT *
                             FROM especie
                             WHERE tipo_especie LIKE'".$tipo_especie."%'
                             ORDER BY especie ASC;";
                  $aux=1;
                }

                elseif (($yacimiento_especie=="" || $yacimiento_especie=="NINGUNO") && ($deposito_especie!="" || $deposito_especie!="NINGUNO")) {

                  $consulta="SELECT idespecie, especie, tipo_especie, iddeposito, deposito
                             FROM especie NATURAL JOIN especie_has_deposito NATURAL JOIN deposito
                             WHERE deposito='".$deposito_especie."';";

                  $aux=2;
                }

                elseif (($yacimiento_especie!="" || $yacimiento_especie!="NINGUNO")) {

                  //if($deposito_especie=="" || $deposito_especie=="NINGUNO"){
                    $consulta="SELECT idespecie, especie, tipo_especie, idyacimiento, yacimiento
                               FROM especie NATURAL JOIN yacimiento_has_especie NATURAL JOIN yacimiento
                               WHERE yacimiento='".$yacimiento_especie."';";
                    $aux=3;

                  //}
                  /*
                  else {

                    $consulta="SELECT idespecie, especie, tipo_especie, idyacimiento, yacimiento, iddeposito, deposito
                               FROM especie NATURAL JOIN yacimiento_has_especie NATURAL JOIN yacimiento NATURAL JOIN especie_has_deposito NATURAL JOIN deposito
                               WHERE yacimiento='".$yacimiento_especie."' AND deposito='".$deposito_especie."';";
                  }*/

                }




                $resolucion=pg_query($link,$consulta);
                $contador=0;
                //echo pg_last_error();
                if($aux==1){
                  if(pg_num_rows($resolucion)>0){
                    //echo "  Éxito de consulta";
                    echo "
                    <hr class='linea'>
                    <div class='row'>
                      <div class='col-lg-4 col-md-10 col-sm-4 col-xs-4 form-group'>
                        <h5><b>ESPECIE</b></h5>
                      </div>
                      <div class='col-lg-4 col-md-10 col-sm-4 col-xs-4 form-group'>
                        <h5><b>TIPO</b></h5>
                      </div>
                    </div>
                    ";
                    while($resultado=pg_fetch_assoc($resolucion)){
                      $id_especie=$resultado['idespecie'];
                      $especie=$resultado['especie'];
                      $tipo_especie=$resultado['tipo_especie'];

                      echo"
                      <form class='' action='modificar/modificar_especie.php' method='post'>
                        <div class='row'>
                          <input type='hidden'  name='id_especie' value='$id_especie'>
                          <div class='col-lg-4 col-md-10 col-sm-11 col-xs-10 form-group'>
                            <input type='text' class='form-control input_consulta' id='especie_consultado' name='especie_consultado' value='$especie'>
                          </div>
                          <div class='col-lg-4 col-md-10 col-sm-11 col-xs-10 form-group'>
                            <input type='text' class='form-control input_consulta' id='tipo_especie_consultado' name='tipo_especie_consultado' value='$tipo_especie'>
                          </div>

                        <div class='col-lg-1 col-md-10 col-xs-3 col-sm-3'>
                          <!--<button type='submit' class='btn btn-info' name='modificar'>Modificar</button>-->
                          <button type='button' title='Modica el nombre o el tipo de la especie' class='btn btn-info' data-toggle='modal' data-target='#modal_modificar$contador'>Modificar</button>
                        </div>
                        <div class='col-lg-1 col-md-10 col-xs-1 col-sm-1'>
                          <!--<button type='submit' class='btn btn-danger' name='eliminar'>Eliminar</button>-->
                          <button type='button' title='Borra definitivamente la especie de la base de datos' class='btn btn-danger' data-toggle='modal' data-target='#modal_eliminar$contador'>Eliminar</button>
                        </div>
                      </div>

                      <div id='modal_modificar$contador' class='modal fade' role='dialog'>
                        <div class='modal-dialog'>
                          <!-- Modal content-->
                          <div class='modal-content'>
                            <div class='modal-header'>
                              <button type='button' class='close' data-dismiss='modal'>&times;</button>
                              <h4 class='modal-title'>Modificar especie</h4>
                            </div>
                            <div class='modal-body'>
                              <p>¿Está seguro que desea modificar la especie <b>$especie</b>?</p>
                            </div>
                            <div class='modal-footer'>
                                <button type='submit' class='btn btn-info boton' name='modificar'>Modificar</button><br>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div id='modal_eliminar$contador' class='modal fade' role='dialog'>
                        <div class='modal-dialog'>
                          <!-- Modal content-->
                          <div class='modal-content'>
                            <div class='modal-header'>
                              <button type='button' class='close' data-dismiss='modal'>&times;</button>
                              <h4 class='modal-title'>Eliminar especie</h4>
                            </div>
                            <div class='modal-body'>
                              <p>¿Está seguro que desea eliminar la especie <b>$especie</b>?</p>
                            </div>
                            <div class='modal-footer'>
                                <button type='submit' class='btn btn-danger boton' name='eliminar'>Eliminar</button><br>
                            </div>
                          </div>
                        </div>
                      </div>
                      </form>
                      ";
                      $contador++;
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

                }//fin de si aux es igual a 1

                if($aux==2){
                  if(pg_num_rows($resolucion)>0){
                    //echo "  Éxito de consulta";
                    echo "
                    <hr class='linea'>
                    <div class='row'>
                      <div class='col-lg-12 col-md-10 col-sm-4 col-xs-4 form-group'>
                        <h5>Éstas son las especies del depósito <b>$deposito_especie</b></h5>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-lg-4 col-md-10 col-sm-4 col-xs-4 form-group'>
                        <h5><b>ESPECIE</b></h5>
                      </div>
                      <div class='col-lg-4 col-md-10 col-sm-4 col-xs-4 form-group'>
                        <h5><b>TIPO</b></h5>
                      </div>
                    </div>
                    ";
                    while($resultado=pg_fetch_assoc($resolucion)){
                      $id_especie=$resultado['idespecie'];
                      $id_deposito=$resultado['iddeposito'];
                      $especie=$resultado['especie'];
                      $tipo_especie=$resultado['tipo_especie'];

                      echo"
                      <form class='' action='modificar/modificar_especie_deposito.php' method='post'>
                        <div class='row'>
                          <input type='hidden'  name='id_especie' value='$id_especie'>
                          <input type='hidden'  name='id_deposito' value='$id_deposito'>
                          <div class='col-lg-4 col-md-10 col-sm-11 col-xs-10 form-group'>
                            <input type='text' readonly='readonly' title='Si desea modificar la especie búsquela por su nombre' class='form-control input_consulta' id='especie_consultado' name='especie_consultado' value='$especie'>
                          </div>
                          <div class='col-lg-4 col-md-10 col-sm-11 col-xs-10 form-group'>
                            <input type='text' readonly='readonly' title='Si desea modificar la especie búsquela por su nombre' class='form-control input_consulta' id='tipo_especie_consultado' name='tipo_especie_consultado' value='$tipo_especie'>
                          </div>

                        <div class='col-lg-1 col-md-10 col-xs-1 col-sm-1'>
                          <!--<button type='submit' class='btn btn-danger' name='eliminar'>Eliminar</button>-->
                          <button type='button' title='Borra la especie del depósito' class='btn btn-danger' data-toggle='modal' data-target='#modal_eliminar$contador'>Eliminar del depósito</button>
                        </div>
                      </div>


                      <div id='modal_eliminar$contador' class='modal fade' role='dialog'>
                        <div class='modal-dialog'>
                          <!-- Modal content-->
                          <div class='modal-content'>
                            <div class='modal-header'>
                              <button type='button' class='close' data-dismiss='modal'>&times;</button>
                              <h4 class='modal-title'>Eliminar especie del depósito</h4>
                            </div>
                            <div class='modal-body'>
                              <p>¿Está seguro que desea eliminar la especie <b>$especie</b> del depósito <b>$deposito_especie</b>?</p>
                            </div>
                            <div class='modal-footer'>
                                <button type='submit' class='btn btn-danger boton' name='eliminar'>Eliminar</button><br>
                            </div>
                          </div>
                        </div>
                      </div>
                      </form>
                      ";
                      $contador++;
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

                }//fin de si aux es igual a 2

                if($aux==3){
                  if(pg_num_rows($resolucion)>0){
                    //echo "  Éxito de consulta";
                    echo "
                    <hr class='linea'>
                    <div class='row'>
                      <div class='col-lg-12 col-md-10 col-sm-4 col-xs-4 form-group'>
                        <h5>Éstas son las especies del yacimiento <b>$yacimiento_especie</b></h5>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-lg-4 col-md-10 col-sm-4 col-xs-4 form-group'>
                        <h5><b>ESPECIE</b></h5>
                      </div>
                      <div class='col-lg-4 col-md-10 col-sm-4 col-xs-4 form-group'>
                        <h5><b>TIPO</b></h5>
                      </div>
                    </div>
                    ";
                    while($resultado=pg_fetch_assoc($resolucion)){
                      $id_especie=$resultado['idespecie'];
                      $id_yacimiento=$resultado['idyacimiento'];
                      $especie=$resultado['especie'];
                      $tipo_especie=$resultado['tipo_especie'];




                      echo"
                      <form class='' action='modificar/modificar_especie_yacimiento.php' method='post'>
                        <div class='row'>
                          <input type='hidden'  name='id_especie' value='$id_especie'>
                          <input type='hidden'  name='id_yacimiento' value='$id_yacimiento'>
                          <div class='col-lg-4 col-md-10 col-sm-11 col-xs-10 form-group'>
                            <input type='text' readonly='readonly' title='Si desea modificar la especie búsquela por su nombre' class='form-control input_consulta' id='especie_consultado' name='especie_consultado' value='$especie'>
                          </div>
                          <div class='col-lg-4 col-md-10 col-sm-11 col-xs-10 form-group'>
                            <input type='text' readonly='readonly' title='Si desea modificar la especie búsquela por su nombre' class='form-control input_consulta' id='tipo_especie_consultado' name='tipo_especie_consultado' value='$tipo_especie'>
                          </div>

                        <div class='col-lg-1 col-md-10 col-xs-1 col-sm-1'>
                          <!--<button type='submit' class='btn btn-danger' name='eliminar'>Eliminar</button>-->
                          <button type='button' title='Borra la especie del yacimiento' class='btn btn-danger' data-toggle='modal' data-target='#modal_eliminar$contador'>Eliminar del yacimiento</button>
                        </div>
                      </div>


                      <div id='modal_eliminar$contador' class='modal fade' role='dialog'>
                        <div class='modal-dialog'>
                          <!-- Modal content-->
                          <div class='modal-content'>
                            <div class='modal-header'>
                              <button type='button' class='close' data-dismiss='modal'>&times;</button>
                              <h4 class='modal-title'>Eliminar especie del yacimiento</h4>
                            </div>
                            <div class='modal-body'>
                              <p>¿Está seguro que desea eliminar la especie <b>$especie</b> del yacimiento <b>$yacimiento_especie</b>?</p>
                            </div>
                            <div class='modal-footer'>
                                <button type='submit' class='btn btn-danger boton' name='eliminar'>Eliminar</button><br>
                            </div>
                          </div>
                        </div>
                      </div>
                      </form>
                      ";
                      $contador++;
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

                }//fin de si aux es igual a 3
                /*if(pg_num_rows($resolucion)>0){
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
                      $id_yacimiento=$resultado['idyacimiento'];
                      $id_deposito=$resultado['iddeposito'];
                      $yacimiento=$resultado['yacimiento'];
                      $deposito=$resultado['deposito'];

                    }

                    echo"
                    <form class='' action='modificar/modificar_especie.php' method='post'>
                      <div class='row'>
                        <input type='hidden'  name='id_especie' value='$id_especie'>
                        <div class='col-lg-2 col-md-10 col-sm-11 col-xs-10 form-group'>
                          <input type='text' class='form-control input_consulta' id='especie_consultado' name='especie_consultado' value='$especie'>
                        </div>
                        <div class='col-lg-2 col-md-10 col-sm-11 col-xs-10 form-group'>
                          <input type='text' class='form-control input_consulta' id='tipo_especie_consultado' name='tipo_especie_consultado' value='$tipo_especie'>
                        </div>
                    ";
                    if($aux!=1){
                      echo "
                      <input type='hidden'  name='id_yacimiento' value='$id_yacimiento'>
                      <input type='hidden'  name='id_deposito' value='$id_deposito'>
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
                        <!--<button type='submit' class='btn btn-info' name='modificar'>Modificar</button>-->
                        <button type='button' class='btn btn-info' data-toggle='modal' data-target='#modal_modificar$contador'>Modificar</button>
                      </div>
                      <div class='col-lg-1 col-md-10 col-xs-1 col-sm-1'>
                        <!--<button type='submit' class='btn btn-danger' name='eliminar'>Eliminar</button>-->
                        <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#modal_eliminar$contador'>Eliminar</button>
                      </div>
                    </div>

                    <div id='modal_modificar$contador' class='modal fade' role='dialog'>
                      <div class='modal-dialog'>
                        <!-- Modal content-->
                        <div class='modal-content'>
                          <div class='modal-header'>
                            <button type='button' class='close' data-dismiss='modal'>&times;</button>
                            <h4 class='modal-title'>Modificar especie</h4>
                          </div>
                          <div class='modal-body'>
                            <p>¿Está seguro que desea modificar la especie?</p>
                          </div>
                          <div class='modal-footer'>
                              <button type='submit' class='btn btn-info boton' name='modificar'>Modificar</button><br>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div id='modal_eliminar$contador' class='modal fade' role='dialog'>
                      <div class='modal-dialog'>
                        <!-- Modal content-->
                        <div class='modal-content'>
                          <div class='modal-header'>
                            <button type='button' class='close' data-dismiss='modal'>&times;</button>
                            <h4 class='modal-title'>Eliminar especie</h4>
                          </div>
                          <div class='modal-body'>
                            <p>¿Está seguro que desea eliminar la especie?</p>
                          </div>
                          <div class='modal-footer'>
                              <button type='submit' class='btn btn-danger boton' name='eliminar'>Eliminar</button><br>
                          </div>
                        </div>
                      </div>
                    </div>
                    </form>
                    ";
                    $contador++;
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
                }*/


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
                             WHERE responsable LIKE '".$responsable."%';";

                }
                elseif ($financiacion!="" && $responsable=="") {
                  $consulta="SELECT idexcavaciones,responsable,financiacion,yacimiento,fecha_inicial,fecha_final,observacion_excavacion,deposito
                             FROM excavacion NATURAL JOIN yacimiento
                             WHERE financiacion LIKE '".$financiacion."%';";
                }
                elseif ($financiacion!="" && $responsable!="") {
                  $consulta="SELECT idexcavaciones,responsable,financiacion,yacimiento,fecha_inicial,fecha_final,observacion_excavacion,deposito
                             FROM excavacion NATURAL JOIN yacimiento
                             WHERE financiacion LIKE '".$financiacion."%' AND responsable LIKE '".$responsable."%';";
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
                elseif($yacimiento_excavacion!="") {
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

                    echo"
                    <form class='' action='modificar/modificar_excavacion.php' method='post'>
                      <div class='row'>
                        <input type='hidden'  name='id_excavacion' value='$id_excavacion'>
                        <div class='col-lg-2 col-md-10 col-sm-11 col-xs-10 form-group'>
                          <input type='text' title='$responsable' class='form-control input_consulta' id='responsable_consultado' name='responsable_consultado' value='$responsable'>
                        </div>
                        <div class='col-lg-2 col-md-10 col-sm-11 col-xs-10 form-group'>
                          <input type='text' title='$financiacion' class='form-control input_consulta' id='financiacion_consultado' name='financiacion_consultado' value='$financiacion'>
                        </div>
                        <div class='col-lg-1 col-md-10 col-sm-11 col-xs-10 form-group'>
                          <input type='text' readonly='readonly' title='$yacimiento. Si desea cambiar el yacimiento, tendrá que eliminar y añadir de nuevo la excavación' class='form-control input_consulta' id='yacimiento_ex_consultado' name='yacimiento_ex_consultado' value='$yacimiento'>
                        </div>
                        <div class='col-lg-1 col-md-10 col-sm-11 col-xs-10 form-group data-container' >
                          <input type='text' title='$fecha_inicial' class='form-control input_consulta' id='fecha_ex_consultado' name='fecha_ex_consultado' value='$fecha_inicial'>
                        </div>
                        <div class='col-lg-1 col-md-10 col-sm-11 col-xs-10 form-group data-container' >
                          <input type='text' title='$fecha_final' class='form-control input_consulta' id='fecha_ex_fin_consultado' name='fecha_ex_fin_consultado' value='$fecha_final'>
                        </div>
                        <div class='col-lg-1 col-md-10 col-sm-11 col-xs-10 form-group'>
                          <input type='text' title='$deposito' class='form-control input_consulta' id='deposito_consultado' name='deposito_consultado' value='$deposito'>
                        </div>
                        <div class='col-lg-2 col-md-10 col-sm-11 col-xs-10 form-group'>
                          <input type='text' title='$observacion_excavacion' class='form-control input_consulta' id='observacion_excavacion' name='observacion_excavacion_consultado' value='$observacion_excavacion'>
                        </div>
                        <div class='col-lg-1 col-md-10 col-xs-3 col-sm-3'>
                          <!--<button type='submit' class='btn btn-info' name='modificar'>Modificar</button>-->
                          <button type='button' title='Puede modificar cualquier campo de esta excavación' class='btn btn-info' data-toggle='modal' data-target='#modal_modificar$aux'>Modificar</button>
                        </div>
                        <div class='col-lg-1 col-md-10 col-xs-1 col-sm-1'>
                          <!--<button type='submit' class='btn btn-danger' name='eliminar'>Eliminar</button>-->
                          <button type='button' title='Va a eliminar esta excavación' class='btn btn-danger' data-toggle='modal' data-target='#modal_eliminar$aux'>Eliminar</button>
                        </div>
                      </div>

                      <div id='modal_modificar$aux' class='modal fade' role='dialog'>
                        <div class='modal-dialog'>
                          <!-- Modal content-->
                          <div class='modal-content'>
                            <div class='modal-header'>
                              <button type='button' class='close' data-dismiss='modal'>&times;</button>
                              <h4 class='modal-title'>Modificar excavación</h4>
                            </div>
                            <div class='modal-body'>
                              <p>¿Está seguro que desea modificar la siguiente excavación? Responsable: <b>$responsable</b>, Financiación: <b>$financiacion</b>, Yacimiento: <b>$yacimiento</b></p>
                            </div>
                            <div class='modal-footer'>
                                <button type='submit' class='btn btn-info boton' name='modificar'>Modificar</button><br>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div id='modal_eliminar$aux' class='modal fade' role='dialog'>
                        <div class='modal-dialog'>
                          <!-- Modal content-->
                          <div class='modal-content'>
                            <div class='modal-header'>
                              <button type='button' class='close' data-dismiss='modal'>&times;</button>
                              <h4 class='modal-title'>Eliminar excavación</h4>
                            </div>
                            <div class='modal-body'>
                              <p>¿Está seguro que desea eliminar la siguiente excavación? Responsable: <b>$responsable</b>, Financiación: <b>$financiacion</b>, Yacimiento: <b>$yacimiento</b></p>
                            </div>
                            <div class='modal-footer'>
                                <button type='submit' class='btn btn-danger boton' name='eliminar'>Eliminar</button><br>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                    ";
                    $aux++;
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

                function mostrar_indice_tabla(){
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
                      <h5><b>PDF</b></h5>
                    </div>
                    <div class='col-lg-2 col-md-4 col-sm-4 col-xs-4 form-group'>
                      <h5><b>FECHA</b></h5>
                    </div>
                  </div>
                  ";
                }

                $aux=false;
                $no_resultado=false;
                $poner_algo_yacimiento=false;
                $mostrar_informacion=false;
                //si se elige un titulo
                if($titulo!=""){
                  $aux=true;

                  $consulta="SELECT idpublicaciones,yacimiento,titulo,fecha,autor,pdf
                             FROM yacimiento NATURAL JOIN yacimiento_has_publicacion NATURAL JOIN publicacion
                             WHERE titulo LIKE '".$titulo."%';";
                  $consulta2="SELECT idpublicaciones,titulo,fecha,autor,pdf
                              FROM publicacion
                              WHERE titulo LIKE '".$titulo."%'
                              EXCEPT
                              SELECT idpublicaciones,titulo,fecha,autor,pdf
                              FROM publicacion NATURAL JOIN yacimiento NATURAL JOIN yacimiento_has_publicacion
                              WHERE titulo LIKE '".$titulo."%';";
                }
                //fin si se elige un titulo
                //si mete un autor
                elseif ($autor!="") {
                  $aux=true;
                  if($yacimiento_publicacion==""){

                    $consulta="SELECT idpublicaciones,yacimiento,titulo,fecha,autor,pdf
                               FROM yacimiento NATURAL JOIN yacimiento_has_publicacion NATURAL JOIN publicacion
                               WHERE autor LIKE '".$autor."%'
                               ORDER BY fecha DESC;";

                    $consulta2="SELECT idpublicaciones,titulo,fecha,autor,pdf
                                FROM publicacion
                                WHERE autor LIKE '".$autor."%'
                                EXCEPT
                                SELECT idpublicaciones,titulo,fecha,autor,pdf
                                FROM publicacion NATURAL JOIN yacimiento NATURAL JOIN yacimiento_has_publicacion
                                WHERE autor LIKE '".$autor."%'
                                ORDER BY fecha DESC;";
                  }
                  else{
                    if($yacimiento_publicacion!="NINGUNO"){

                      $consulta="SELECT idpublicaciones,yacimiento,titulo,fecha,autor,pdf
                                 FROM yacimiento NATURAL JOIN yacimiento_has_publicacion NATURAL JOIN publicacion
                                 WHERE autor LIKE '".$autor."%' AND yacimiento='".$yacimiento_publicacion."'
                                 ORDER BY fecha DESC;";
                    }
                    else{
                      $consulta2="SELECT idpublicaciones,titulo,fecha,autor,pdf
                                  FROM publicacion
                                  WHERE autor LIKE '".$autor."%'
                                  EXCEPT
                                  SELECT idpublicaciones,titulo,fecha,autor,pdf
                                  FROM publicacion NATURAL JOIN yacimiento NATURAL JOIN yacimiento_has_publicacion
                                  WHERE autor LIKE '".$autor."%'
                                  ORDER BY fecha DESC;";
                    }

                  }
                }
                //fin si mete un autor
                //si mete un yacimiento
                elseif ($yacimiento_publicacion!="") {
                  $aux=true;
                  if($yacimiento_publicacion!="NINGUNO"){
                    $consulta="SELECT idpublicaciones,yacimiento,titulo,fecha,autor,pdf
                               FROM yacimiento NATURAL JOIN yacimiento_has_publicacion NATURAL JOIN publicacion
                               WHERE yacimiento='".$yacimiento_publicacion."'
                               ORDER BY fecha DESC;";
                  }
                  else{
                    $poner_algo_yacimiento=true;
                    $consulta="SELECT idpublicaciones,titulo,fecha,autor,pdf
                                FROM publicacion
                                EXCEPT
                                SELECT idpublicaciones,titulo,fecha,autor,pdf
                                FROM publicacion NATURAL JOIN yacimiento NATURAL JOIN yacimiento_has_publicacion
                                ORDER BY fecha DESC;";
                  }
                }
                //fin si mete un yacimiento

                //si mete un fecha
                elseif ($fecha_publi_ini!="") {
                  $aux=true;
                  if($fecha_publi_fin==""){
                    $consulta="SELECT idpublicaciones,yacimiento,titulo,fecha,autor,pdf
                               FROM yacimiento NATURAL JOIN yacimiento_has_publicacion NATURAL JOIN publicacion
                               WHERE fecha='".$fecha_publi_ini."'
                               ORDER BY fecha DESC;";

                     $consulta2="SELECT idpublicaciones,titulo,fecha,autor,pdf
                                 FROM publicacion
                                 WHERE fecha='".$fecha_publi_ini."'
                                 EXCEPT
                                 SELECT idpublicaciones,titulo,fecha,autor,pdf
                                 FROM publicacion NATURAL JOIN yacimiento NATURAL JOIN yacimiento_has_publicacion
                                 WHERE fecha='".$fecha_publi_ini."'
                                 ORDER BY fecha DESC;";
                  }
                  else{

                    $consulta="SELECT idpublicaciones,yacimiento,titulo,fecha,autor,pdf
                               FROM yacimiento NATURAL JOIN yacimiento_has_publicacion NATURAL JOIN publicacion
                               WHERE fecha BETWEEN '".$fecha_publi_ini."' AND '".$fecha_publi_fin."'
                               ORDER BY fecha DESC;";

                    $consulta2="SELECT idpublicaciones,titulo,fecha,autor,pdf
                                 FROM publicacion
                                 WHERE fecha BETWEEN '".$fecha_publi_ini."' AND '".$fecha_publi_fin."'
                                 EXCEPT
                                 SELECT idpublicaciones,titulo,fecha,autor,pdf
                                 FROM publicacion NATURAL JOIN yacimiento NATURAL JOIN yacimiento_has_publicacion
                                 WHERE fecha BETWEEN '".$fecha_publi_ini."' AND '".$fecha_publi_fin."'
                                 ORDER BY fecha DESC;";
                  }

                }
                //fin si mete un fecha

                elseif ($titulo=="" && $autor=="" && ($yacimiento_publicacion=="" || $yacimiento_publicacion=="NINGUNO") && $fecha_publi_ini=="") {
                  $aux=true;
                  $consulta="SELECT idpublicaciones,yacimiento,titulo,fecha,autor,pdf
                             FROM publicacion NATURAL JOIN yacimiento NATURAL JOIN yacimiento_has_publicacion
                             ORDER BY fecha DESC;";


                  $consulta2="SELECT idpublicaciones,titulo,fecha,autor,pdf
                              FROM publicacion
                              EXCEPT
                              SELECT idpublicaciones,titulo,fecha,autor,pdf
                              FROM publicacion NATURAL JOIN yacimiento NATURAL JOIN yacimiento_has_publicacion
                              ORDER BY fecha DESC;";
                }
                $contador=0;
                $resolucion=pg_query($link,$consulta);
                if(pg_num_rows($resolucion)>0){
                  $no_resultado=true;
                  //echo "  Éxito de consulta";
                  mostrar_indice_tabla();

                  while($resultado=pg_fetch_assoc($resolucion)){

                    $id_publicacion=$resultado['idpublicaciones'];
                    $yacimiento=$resultado['yacimiento'];
                    if($poner_algo_yacimiento==true)
                      $yacimiento="NO CORRESPONDE A NINGÚN YACIMIENTO";
                    $title=$resultado['titulo'];
                    $autor=$resultado['autor'];
                    $fecha=$resultado['fecha'];
                    $pdf=$resultado['pdf'];


                    echo"
                    <form class='' action='modificar/modificar_publicacion.php' method='post'>
                      <div class='row'>
                        <input type='hidden'  name='id_publicacion' value='$id_publicacion'>
                        <input type='hidden'  name='yacimiento_viejo' value='$yacimiento'>
                        <div class='col-lg-2 col-md-4 col-sm-11 col-xs-10 form-group'>
                          <input type='text' title='$title' class='form-control input_consulta' id='titulo_consultado' name='titulo_consultado' value='$title'>
                        </div>
                        <div class='col-lg-2 col-md-4 col-sm-11 col-xs-10 form-group'>
                          <input type='text' title='$autor' class='form-control input_consulta' id='autor_consultado' name='autor_consultado' value='$autor'>
                        </div>
                        <div class='col-lg-2 col-md-4 col-sm-11 col-xs-10 form-group'>
                          <input type='text' title='$yacimiento' class='form-control input_consulta' id='yacimiento_publi_consultado' name='yacimiento_publi_consultado' value='$yacimiento'>
                        </div>
                        <div class='col-lg-2 col-md-4 col-sm-11 col-xs-10 form-group'>
                          <input type='text' title='$pdf' class='form-control input_consulta' id='pdf_consultado' name='pdf_consultado' value='$pdf'>
                        </div>
                        <div class='col-lg-2 col-md-4 col-sm-11 col-xs-10 form-group data-container' >
                          <input type='text' class='form-control input_consulta' id='fecha_publi_consultado' name='fecha_publi_consultado' value='$fecha'>
                        </div>
                        <div class='col-lg-1 col-md-10 col-xs-3 col-sm-3'>
                          <!--<button type='submit' class='btn btn-info' name='modificar'>Modificar</button>-->
                          <button type='button' title='Puede modificar todos los campos de la publicación' class='btn btn-info' data-toggle='modal' data-target='#modal_modificar$contador'>Modificar</button>
                        </div>
                        <div class='col-lg-1 col-md-10 col-xs-1 col-sm-1'>
                          <!--<button type='submit' class='btn btn-danger' name='eliminar'>Eliminar</button>-->
                          <button type='button' title='Va a eliminar esta publicación' class='btn btn-danger' data-toggle='modal' data-target='#modal_eliminar$contador'>Eliminar</button>
                        </div>
                      </div>

                      <div id='modal_modificar$contador' class='modal fade' role='dialog'>
                        <div class='modal-dialog'>
                          <!-- Modal content-->
                          <div class='modal-content'>
                            <div class='modal-header'>
                              <button type='button' class='close' data-dismiss='modal'>&times;</button>
                              <h4 class='modal-title'>Modificar publicación</h4>
                            </div>
                            <div class='modal-body'>
                              <p>¿Está seguro que desea modificar la siguiente publicación? Título: <b>$title</b>, Autor: <b>$autor</b></p>
                            </div>
                            <div class='modal-footer'>
                                <button type='submit' class='btn btn-info boton' name='modificar'>Modificar</button><br>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div id='modal_eliminar$contador' class='modal fade' role='dialog'>
                        <div class='modal-dialog'>
                          <!-- Modal content-->
                          <div class='modal-content'>
                            <div class='modal-header'>
                              <button type='button' class='close' data-dismiss='modal'>&times;</button>
                              <h4 class='modal-title'>Eliminar publicación</h4>
                            </div>
                            <div class='modal-body'>
                              <p>¿Está seguro que desea eliminar la siguiente publicación? <b>$title</b>, Autor: <b>$autor</b></p>
                            </div>
                            <div class='modal-footer'>
                                <button type='submit' class='btn btn-danger boton' name='eliminar'>Eliminar</button><br>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                    ";
                    $contador++;
                  }
                  //echo"$deposit y $country";
                }
                else{
                  $mostrar_informacion=true;
                }

                if($aux==true){

                  $resolucion=pg_query($link,$consulta2);
                  if(pg_num_rows($resolucion)>0){
                    $no_resultado=true;
                    if($mostrar_informacion==true){
                      mostrar_indice_tabla();
                    }
                    while($resultado=pg_fetch_assoc($resolucion)){
                      $id_publicacion=$resultado['idpublicaciones'];
                      $yacimiento="NO CORRESPONDE A NINGÚN YACIMIENTO";
                      $title=$resultado['titulo'];
                      $autor=$resultado['autor'];
                      $fecha=$resultado['fecha'];
                      $pdf=$resultado['pdf'];

                      echo"
                      <form class='' action='modificar/modificar_publicacion.php' method='post'>
                        <div class='row'>
                          <input type='hidden'  name='id_publicacion' value='$id_publicacion'>
                          <input type='hidden'  name='yacimiento_viejo' value='$yacimiento'>
                          <div class='col-lg-2 col-md-4 col-sm-11 col-xs-10 form-group'>
                            <input type='text' title='$title' class='form-control input_consulta' id='titulo_consultado' name='titulo_consultado' value='$title'>
                          </div>
                          <div class='col-lg-2 col-md-4 col-sm-11 col-xs-10 form-group'>
                            <input type='text' title='$autor' class='form-control input_consulta' id='autor_consultado' name='autor_consultado' value='$autor'>
                          </div>
                          <div class='col-lg-2 col-md-4 col-sm-11 col-xs-10 form-group'>
                            <input type='text' title='$yacimiento' class='form-control input_consulta' id='yacimiento_publi_consultado' name='yacimiento_publi_consultado' value='$yacimiento'>
                          </div>
                          <div class='col-lg-2 col-md-4 col-sm-11 col-xs-10 form-group'>
                            <input type='text' title='$pdf' class='form-control input_consulta' id='pdf_consultado' name='pdf_consultado' value='$pdf'>
                          </div>
                          <div class='col-lg-2 col-md-4 col-sm-11 col-xs-10 form-group data-container' >
                            <input type='text' class='form-control input_consulta' id='fecha_publi_consultado' name='fecha_publi_consultado' value='$fecha'>
                          </div>

                          <div class='col-lg-1 col-md-10 col-xs-3 col-sm-3'>
                            <!--<button type='submit' class='btn btn-info' name='modificar'>Modificar</button>-->
                            <button type='button' title='Puede modificar todos los campos de la publicación' class='btn btn-info' data-toggle='modal' data-target='#modal_modificar$contador'>Modificar</button>
                          </div>
                          <div class='col-lg-1 col-md-10 col-xs-1 col-sm-1'>
                            <!--<button type='submit' class='btn btn-danger' name='eliminar'>Eliminar</button>-->
                            <button type='button' title='Va a eliminar esta publicación' class='btn btn-danger' data-toggle='modal' data-target='#modal_eliminar$contador'>Eliminar</button>
                          </div>
                        </div>

                        <div id='modal_modificar$contador' class='modal fade' role='dialog'>
                          <div class='modal-dialog'>
                            <!-- Modal content-->
                            <div class='modal-content'>
                              <div class='modal-header'>
                                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                <h4 class='modal-title'>Modificar publicación</h4>
                              </div>
                              <div class='modal-body'>
                                <p>¿Está seguro que desea modificar la siguiente publicación? <b>$title</b>, Autor: <b>$autor</b></p>
                              </div>
                              <div class='modal-footer'>
                                  <button type='submit' class='btn btn-info boton' name='modificar'>Modificar</button><br>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div id='modal_eliminar$contador' class='modal fade' role='dialog'>
                          <div class='modal-dialog'>
                            <!-- Modal content-->
                            <div class='modal-content'>
                              <div class='modal-header'>
                                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                <h4 class='modal-title'>Eliminar publicación</h4>
                              </div>
                              <div class='modal-body'>
                                <p>¿Está seguro que desea eliminar la siguinete publicación? <b>$title</b>, Autor: <b>$autor</b></p>
                              </div>
                              <div class='modal-footer'>
                                  <button type='submit' class='btn btn-danger boton' name='eliminar'>Eliminar</button><br>
                              </div>
                            </div>
                          </div>
                        </div>
                        </form>
                      ";
                      $contador++;
                    }
                    //echo"$deposit y $country";
                  }
                }

                if($no_resultado==false){
                  echo "
                  <hr class='linea'>
                  <div class='row'>
                    <div class='col-lg-10 col-md-4 col-sm-4 col-xs-4 form-group'>
                      <h5><b>No se ha encontrado datos en esta consulta</b></h5>
                    </div>
                  </div>
                  ";
                }
                if($aux==true){

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
                             WHERE deposito LIKE '".$deposito."%' AND pais LIKE '".$pais."%';";
                }
                //fin si ha introducio pais y deposito
                //if pais y deposito están vacios se hace una consulta de todos
                elseif ($deposito=="" && $pais=="") {
                  $consulta="SELECT *
                             FROM deposito
                             ORDER BY pais;";
                }
                //fin de hacer la consulta de todos
                //if pais es vacío
                elseif($pais==""){
                  $consulta="SELECT *
                             FROM deposito
                             WHERE deposito LIKE '".$deposito."%';";

                }
                //fin de si pais es vacio
                //si no elige un deposito
                elseif ($deposito=="") {
                  $consulta="SELECT *
                             FROM deposito
                             WHERE pais LIKE '".$pais."%';";
                }
                //if no se elige un deposito
                $deposito=pg_query($link,$consulta);
                if(pg_num_rows($deposito)>0){
                  //echo "  Éxito de consulta";
                  echo "
                    <hr class='linea'>
                    <div class='row'>
                      <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4 form-group'>
                        <h5><b>DEPÓSITO</b></h5>
                      </div>
                      <div class='col-lg-4 col-md-4 col-sm-4 col-xs-4 form-group'>
                        <h5><b>PAÍS</b></h5>
                      </div>
                    </div>
                  ";
                  $contador=0;

                  while($resultado=pg_fetch_assoc($deposito)){
                    $id_deposito=$resultado['iddeposito'];
                    $deposit=$resultado['deposito'];
                    $country=$resultado['pais'];

                    //echo "$aux";
                    /*$deposit_aux="deposit" . $aux;
                    $country_aux="country" .$aux;
                    $modificar="modificar" .$aux;
                    $eliminar="eliminar" .$aux;*/
                    $contador++;
                    echo"
                     <form class='' action='modificar/modificar_deposito.php' method='post'>
                        <div class='row'>
                          <input type='hidden'  name='id_deposito' value='$id_deposito'>
                          <div class='col-lg-4 col-md-4 col-sm-11 col-xs-10 form-group'>
                            <input type='text' title='$deposit' class='form-control input_consulta' id='deposito_consultado' name='deposito_consultado' value='$deposit'>
                          </div>
                          <div class='col-lg-4 col-md-4 col-sm-11 col-xs-10 form-group'>
                            <input type='text' title='$country' class='form-control input_consulta' id='pais_consultado' name='pais_consultado' value='$country'>
                          </div>
                          <div class='col-lg-1 col-md-10 col-xs-3 col-sm-3'>
                            <!--<button type='submit' class='btn btn-info' name='modificar'>Modificar</button>-->
                            <button type='button' title='Va a modificar el nombre o el país de este depósito' class='btn btn-info' data-toggle='modal' data-target='#modal_modificar$contador'>Modificar</button>
                          </div>
                          <div class='col-lg-1 col-md-10 col-xs-1 col-sm-1'>
                            <!--<button type='submit' class='btn btn-danger' name='eliminar'>Eliminar</button>-->
                            <button type='button' title='Va a eliminar este depósito' class='btn btn-danger' data-toggle='modal' data-target='#modal_eliminar$contador'>Eliminar</button>
                          </div>
                        </div>

                        <div id='modal_modificar$contador' class='modal fade' role='dialog'>
                          <div class='modal-dialog'>
                            <!-- Modal content-->
                            <div class='modal-content'>
                              <div class='modal-header'>
                                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                <h4 class='modal-title'>Modificar depósito</h4>
                              </div>
                              <div class='modal-body'>
                                <p>¿Está seguro que desea modificar el depósito <b>$deposit</b>?</p>
                              </div>
                              <div class='modal-footer'>
                                  <button type='submit' class='btn btn-info boton' name='modificar'>Modificar</button><br>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div id='modal_eliminar$contador' class='modal fade' role='dialog'>
                          <div class='modal-dialog'>
                            <!-- Modal content-->
                            <div class='modal-content'>
                              <div class='modal-header'>
                                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                <h4 class='modal-title'>Eliminar depósito</h4>
                              </div>
                              <div class='modal-body'>
                                <p>¿Está seguro que desea eliminar el depósito <b>$deposit</b>?</p>
                              </div>
                              <div class='modal-footer'>
                                  <button type='submit' class='btn btn-danger boton' name='eliminar'>Eliminar</button><br>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                    ";
                    $contador++;
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
    <div class="navbar navbar-inverse navbar-fixed-bottom" role='contentinfo'>
      <div class="container">
        <p class="navbar-text pull-left">© 2017 Alexander Cole Mora
          <a title='acceder a la página de la Universidad de La Laguna' href="https://www.ull.es/" target="_blank" >Universidad de La Laguna</a>
        </p>
      </div>
    </div>


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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../bootstrap-3.3.7-dist/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="../bootstrap-3.3.7-dist/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKWnhtTV-INFvymm3mjHJboLaY3dZzhwA&callback=initMap"
    async defer></script>
    <script type="text/javascript" src="../js/administracion.js"></script>
    <script type="text/javascript" src="../js/consulta.js"></script>
    <script type="text/javascript" src="../js/mapa_google.js"></script>
  </body>
</html>

<?php
   }else {
       header("Location: ../index.php");
   }
?>
