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
            <li><span class="glyphicon glyphicon-search" aria-hidden="true"></span><a href="../consultar_bbdd.php">Consultar BBDD</a></li>
            <li id="valoracion"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span><a href="../valoracion.php">Valoraciones</a>
              <ul style="display:none" class="list-unstyled" id="submenu_valoracion">
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a href="../valoraciones/add_valoracion.php">Añadir Valoración</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a href="../valoraciones/consultar_valoracion.php">Consultar Valoración</a></li>
              </ul>
            </li>
            <li><span class="glyphicon glyphicon-plus" aria-hidden="true"></span><a href="../add_bbdd.php">Añadir BBDD</a>
              <ul class="list-unstyled" id="submenu">
                <li class="destacar2"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a href="yacimiento.php">Yacimiento</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a href="especie.php">Especie</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a href="excavacion.php">Excavación</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a href="publicacion.php">Publicación</a></li>
                <li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span><a href="deposito.php">Depósito</a></li>
              </ul>
            </li>
            <?php
              //echo "Este es el usuario $username";
              if ($username == "admin") {
                echo "<li><span class='glyphicon glyphicon-user' aria-hidden='true'></span><a href='../gestion_usuarios.php'>Gestión Usuarios</a></li>";
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
              <h2 class="titulos">Añadir Valoración</h2>
              <p>A continuación, podrá añadir una valoración a yacimiento, teniendo en cuenta los criterios estipulados.</p>
              <form class="" action="add_bbdd_valoracion.php" method="post">
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
                <!-- Valoracion cientifica-->
                <div class="row">
                  <div class="col-lg-3">
                    <h4>Valoración Científica</h4>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-2 form-group">
                    <select name="" id="" class="form-control" onchange="tipofosiles(this.value)">
                      <option disabled selected>TIPO FÓSILES</option>
                      <option type='text' value='0' name=''>Fósiles comunes y/o no endémicos</option>
                      <option type='text' value='1' name=''>Hasta el 30% de fósiles raros y/o especies endémicas</option>
                      <option type='text' value='2' name=''>Entre 30% y 60% de fósiles raros y/o especies endémicas</option>
                      <option type='text' value='3' name=''>Más del 60% de fósiles raros y/o de especies endémicas</option>
                    </select>
                  </div>
                  <input type="hidden" name="tipo_fosiles" id="tipo_fosiles">

                  <div class="col-lg-3 form-group">
                    <select name="" id="" class="form-control" onchange="diversidadtaxones(this.value)">
                      <option disabled selected>DIVERSIDAD DE TAXONES</option>
                      <option type='text' value='0' name=''>Solo un taxón</option>
                      <option type='text' value='1' name=''>Más de una especie de invertebrados o vertebrados o plantas</option>
                      <option type='text' value='2' name=''>Invertebrados+vertebrados o plantas</option>
                      <option type='text' value='3' name=''>Invertebrados+vertebrado+plantas</option>
                    </select>
                  </div>
                  <input type="hidden" name="taxones" id="taxones">

                  <div class="col-lg-2 form-group">
                    <select name="" id="" class="form-control" onchange="edadyacimiento(this.value)">
                      <option disabled selected>EDAD YACIMIENTO</option>
                      <option type='text' value='0' name=''>Más de 10 yacimientos de una detemrinada edad</option>
                      <option type='text' value='1' name=''>Entre 10-5 yacimientos de una determinada edad</option>
                      <option type='text' value='2' name=''>5-2 yacimientos de una determinada edad</option>
                      <option type='text' value='3' name=''>1 yacimientos de una determinada edad</option>
                    </select>
                  </div>
                  <input type="hidden" name="edad" id="edad">

                  <div class="col-lg-2 form-group">
                    <select name="" id="" class="form-control" onchange="localidadtipo(this.value)">
                      <option disabled selected>LOCALIDAD TIPO</option>
                      <option type='text' value='0' name=''>No</option>
                      <option type='text' value='3' name=''>Si se ha descrito una especie por primera vez en esa localidad</option>
                    </select>
                  </div>
                  <input type="hidden" name="localidad" id="localidad">

                  <div class="col-lg-3 form-group">
                    <select name="" id="" class="form-control" onchange="estadoconservacion(this.value)">
                      <option disabled selected>ESTADO CONSERVACIÓN FÓSILES</option>
                      <option type='text' value='0' name=''>Todos los restos fragmentados</option>
                      <option type='text' value='1' name=''>Esqueletos completos con alteraciones tafonómicas</option>
                      <option type='text' value='2' name=''>Esqueletos completos sin alteraciones</option>
                      <option type='text' value='3' name=''>Partes blandas (piel,etc)</option>
                    </select>
                  </div>
                  <input type="hidden" name="conservacionfosiles" id="conservacionfolsiles">

               </div>
               <div class="row">
                 <div class="col-lg-3 form-group">
                   <select name="" id="" class="form-control" onchange="informaciontafonomica(this.value)">
                     <option disabled selected>INFORMACIÓN TAFONÓMICA</option>
                     <option type='text' value='0' name=''>Se conoce la zona de procedencia de los fósiles</option>
                     <option type='text' value='1' name=''>Se conoce la capa/nivel</option>
                     <option type='text' value='2' name=''>Se conoce el lugar exacto</option>
                     <option type='text' value='3' name=''>Los fósiles proceden de una excavación metódica</option>
                   </select>
                 </div>
                 <input type="hidden" name="tafonomica" id="tafonomica">
                 <div class="col-lg-2 form-group">
                   <select name="" id="" class="form-control" onchange="infobioestatigrafica(this.value)">
                     <option disabled selected>INFORMACIÓN BIOESTATIGRÁFICA</option>
                     <option type='text' value='0' name=''>Sin fósiles zonadores</option>
                     <option type='text' value='1' name=''>Con fósiles zonadores para correlacionar a nivel local (una isla)</option>
                     <option type='text' value='2' name=''>Con fósiles zonadores para correlacionar a nivel regional (entre islas)</option>
                     <option type='text' value='3' name=''>Con fósiles zonadores para correlacionar a nivel global(Canarias/Mediterráneo)</option>
                   </select>
                 </div>
                 <input type="hidden" name="bioestatigrafica" id="bioestatigrafica">

                 <div class="col-lg-2 form-group">
                   <select name="" id="" class="form-control" onchange="(this.value)">
                     <option disabled selected></option>
                     <option type='text' value='0' name=''></option>
                     <option type='text' value='1' name=''></option>
                     <option type='text' value='2' name=''></option>
                     <option type='text' value='3' name=''></option>
                   </select>
                 </div>
                 <input type="hidden" name="" id="">

                 <div class="col-lg-2 form-group">
                   <select name="" id="" class="form-control" onchange="(this.value)">
                     <option disabled selected></option>
                     <option type='text' value='0' name=''></option>
                     <option type='text' value='1' name=''></option>
                     <option type='text' value='2' name=''></option>
                     <option type='text' value='3' name=''></option>
                   </select>
                 </div>
                 <input type="hidden" name="" id="">
               </div>

               <div class="row">
                 <div class="col-lg-2 form-group">
                   <select name="" id="" class="form-control" onchange="(this.value)">
                     <option disabled selected></option>
                     <option type='text' value='0' name=''></option>
                     <option type='text' value='1' name=''></option>
                     <option type='text' value='2' name=''></option>
                     <option type='text' value='3' name=''></option>
                   </select>
                 </div>
                 <input type="hidden" name="" id="">
                 <div class="col-lg-2 form-group">
                   <select name="" id="" class="form-control" onchange="(this.value)">
                     <option disabled selected></option>
                     <option type='text' value='0' name=''></option>
                     <option type='text' value='1' name=''></option>
                     <option type='text' value='2' name=''></option>
                     <option type='text' value='3' name=''></option>
                   </select>
                 </div>
                 <input type="hidden" name="" id="">

                 <div class="col-lg-2 form-group">
                   <select name="" id="" class="form-control" onchange="(this.value)">
                     <option disabled selected></option>
                     <option type='text' value='0' name=''></option>
                     <option type='text' value='1' name=''></option>
                     <option type='text' value='2' name=''></option>
                     <option type='text' value='3' name=''></option>
                   </select>
                 </div>
                 <input type="hidden" name="" id="">

                 <div class="col-lg-2 form-group">
                   <select name="" id="" class="form-control" onchange="(this.value)">
                     <option disabled selected></option>
                     <option type='text' value='0' name=''></option>
                     <option type='text' value='1' name=''></option>
                     <option type='text' value='2' name=''></option>
                     <option type='text' value='3' name=''></option>
                   </select>
                 </div>
                 <input type="hidden" name="" id="">
               </div>



                </div>
                <!--fin Valoracion cientifica-->
                <!-- Valoracion socio cultural-->
                <div class="row">
                  <div class="col-lg-3">
                    <h4>Valoración Socio Cultural</h4>
                  </div>
                </div>
                <!--fin Valoracion socio cultural-->
                <!-- Valoracion socio enconmica-->
                <div class="row">
                  <div class="col-lg-3">
                    <h4>Valoración Socio Económica</h4>
                  </div>
                </div>
                <!--fin Valoracion socio economica-->
                <!-- Riesgo de deterioro-->
                <div class="row">
                  <div class="col-lg-3">
                    <h4>Riesgo de deterioro</h4>
                  </div>
                </div>
                <!-- fin riesgo de deterioro-->



                <div class="row">

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
