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

    <title>Portal de administración del servicio</title>

    <link rel="icon" type="image/png" href="../images/logoULL/logotipo-secundario-ULL.png" />
    <link type="text/css" rel="stylesheet" href="../bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../css/administracion.css"/>

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
            <li class="destacar"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><a title='¿cómo funciona la apliación?' tabindex='1' href="usar_aplicacion.php">¿Cómo funciona?</a></li>

            <li id="consultar"><span class="glyphicon glyphicon-search" aria-hidden="true"></span><a title='acceder a consultar base de datos' tabindex='1' href="consultar_bbdd.php">Consultar/Modificar</a></li>
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
        <div class="col-lg-offset-0 col-lg-9 col-md-offset-1 col-md-7 col-xs-offset-0 col-xs-12 col-sm-offset-0 col-sm-12">
          <h2>¿Cómo funciona la aplicación?</h2>
          <div class="row">
            <div class="col-lg-8 col-md-8 col-xs-12  col-sm-12">
              <h5>En esta sección explicaremos como usar correctamente esta aplicación. En primer lugar,
                hay que entender qué se puede hacer. Tenemos la posibilidad de añadir yacimentos, especies,
                publicaciones, excavaciones y depósitos. Del mismo modo, podemos consultar, modificar y eliminar cada uno de los
                datos que introduzcamos.</h5>
            </div>

          </div>
          <hr class='linea'>
          <div class="row">
            <div class="col-lg-4 col-md-8 col-xs-12  col-sm-12">
              <h3>Añadir datos</h3>
              <h5 align=justify>Explicaremos a continuación qué se puede añadir a la base de datos, teniendo en cuenta que en la sección de consultar podemos modificar
                  los datos si no los hemos puesto o hemos cometido algún error. Es importante destacar, es que algunos casos hay que introducir algunos campos
                  para que se puedan añadir sin ningún problema.</h5>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4 col-md-8 col-xs-12  col-sm-12">
              <h4><b>Yacimientos</b></h4>
              <h5 align=justify>Como requisito mínimo en este caso, vamos a tener que <b>introducir un nombre al yacimiento</b>,
                  el resto se podrá modificar luego en las consultas. Destacar que las coordenas de latidud
                  y longitud solo se pondrán usando el mapa de Google Maps para ser lo más preciso posible y
                  facilitar su localización.
              </h5>
            </div>
            <div class="col-lg-4 col-md-8 col-xs-12  col-sm-12">
              <h4><b>Especies</b></h4>
              <h5 align=justify>Para añadir especies, podemos añadir un nombre, un tipo, un yacimiento o un depósito.
                Hay que tener claro, que como <b>mínimo debemos poner el nombre de la especie</b>. Si por ejemplo,
                una misma especie está en varios yacimientos, solo hay que introducir su nombre y el yacimiento en
                el que esté. Igualmente pasará con los depósitos.
              </h5>
            </div>
            <div class="col-lg-4 col-md-8 col-xs-12  col-sm-12">
              <h4><b>Excavación</b></h4>
              <h5 align=justify>Para añadir excavaciones, podemos añadir un responsable, un organización que la financie, un yacimiento, fecha de inicio y final, un depósito
                y una observación.Hay que tener claro, que como <b>mínimo debemos poner un yacimineto y una fecha inicial y de fin</b> para que se añada.

              </h5>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4 col-md-8 col-xs-12  col-sm-12">
              <h4><b>Publicación</b></h4>
              <h5 align=justify>Como requisito mínimo en este caso, vamos a tener que <b>introducir un nombre a la publicación</b>,
                  el resto se podrá modificar luego en las consultas.
              </h5>
            </div>
            <div class="col-lg-4 col-md-8 col-xs-12  col-sm-12">
              <h4><b>Depósito</b></h4>
              <h5 align=justify>Como requisito mínimo en este caso, vamos a tener que <b>introducir un nombre al depósito</b>,
                  el país se podrá modificar luego en las consultas.
              </h5>
            </div>
            <div class="col-lg-4 col-md-8 col-xs-12  col-sm-12">
              <h4><b>Valoración</b></h4>
              <h5 align=justify>Para añadir valoraciones, debemos acudir a <i>Valoraciones/Añadir Valoración</i>. Solo nos aparecerá
                  los yacimientos a los cuales no se le haya asignado una valoración. No es necesario poner
                  algún valor en ningún campo, en ese caso, su valoración será 0.

              </h5>
            </div>
          </div>
          <hr class='linea'>


          <div class="row">
            <div class="col-lg-4 col-md-8 col-xs-12  col-sm-12">
              <h3>Consultar datos</h3>
              <h5 align=justify>Explicaremos a continuación cómo consultar datos a la base de datos. Vamos a poder
                                modificar y eliminar datos en cada sección.</h5>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4 col-md-8 col-xs-12  col-sm-12">
              <h4><b>Yacimientos</b></h4>
              <h5 align=justify>Vamos a poder consultar yacimientos, por isla, municipio, un yacimiento en concreto
                                o por tipo, edad y altura. Nunca se va a poder seleccionar una convinación de estas tres últimas
                                (por ejemplo tipo-edad o edad-altura), pero si yacimientos de una isla o municipio de un tipo, edad o altura
                                . En el caso de la altura, al poner un número, por ejemplo
                                300, se nos mostrarán los yacimientos con una altura entre ese número y 50 más (300-350).
                                En cualquier caso, podemos modificar todos los valores permitidos excepto la cantidad de publicaciones,
                                que es un valor automático. <b>Aquí es donde podremos eliminar un yacimiento</b>

              </h5>
            </div>
            <div class="col-lg-4 col-md-8 col-xs-12  col-sm-12">
              <h4><b>Ubicación</b></h4>
              <h5 align=justify>Vamos a poder buscar por yacimiento. Se podrán cambiar los datos relacionados con la ubicación del yacimiento.
              </h5>
            </div>
            <div class="col-lg-4 col-md-8 col-xs-12  col-sm-12">
              <h4><b>Especies</b></h4>
              <h5 align=justify>Vamos a poder buscar por nombre, tipo, nombre y tipo, yacimiento o depósito. Si cosultamos sin poner nada se mostrarán todas las
                                especies que existan. Ninguna otra combinación está permitida.
                                Para modificar una especie, solo se podrá hacer cuando no se busquen de un yacimiento o depósito. En estos dos casos
                                solo se podrán eliminar las especies del propio yacimiento o depósito.
              </h5>
            </div>

          </div>
          <div class="row">
            <div class="col-lg-4 col-md-8 col-xs-12  col-sm-12">
              <h4><b>Excavación</b></h4>
              <h5 align=justify>Vamos a poder buscar por responable, financiacion, responsable y financiacion, yacimiento en concreto,
                                una fecha exacta de inicio, o un intervalo de fechas. Si no se pone nada, se mostrarán todas las excavaciones.
                                Se podrán modificar todos los valores y eliminar la excavación.

              </h5>
            </div>
            <div class="col-lg-4 col-md-8 col-xs-12  col-sm-12">
              <h4><b>Publicación</b></h4>
              <h5 align=justify>Vamos a poder buscar por título, autor, yacimiento en concreto,
                                una fecha exacta de publicación, o un intervalo de fechas. Si no se pone nada, se mostrarán todas las excavaciones.
                                Se podrán modificar todos los valores y eliminar la publicación.
              </h5>
            </div>
            <div class="col-lg-4 col-md-8 col-xs-12  col-sm-12">
              <h4><b>Depósito</b></h4>
              <h5 align=justify>Podremos buscar por nombre, país, nombre y país. También se pondrán modificar y eliminar.
              </h5>
            </div>

          </div>
          <div class="row">
            <div class="col-lg-4 col-md-8 col-xs-12  col-sm-12">
              <h4><b>Valoración</b></h4>
              <h5 align=justify>En el apartado de valoraciones, se podrán consultar las valoraciones de los yacimientos que tengan una valoracion.
                                No se podrán eliminar, pero si modificar cambiando sus valores y dándole a modificar.

              </h5>
            </div>

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

    <!-- FOOTER-->
    <br><br><br><br><br>
    <div class="navbar navbar-inverse navbar-fixed-bottom" role='contentinfo'>
      <div class="container">
        <p tabindex='3' class="navbar-text pull-left">© 2017 Alexander Cole Mora
          <a title='acceder a la página de la Universidad de La Laguna' tabindex='3' href="https://www.ull.es/" target="_blank" >Universidad de La Laguna</a>
        </p>
      </div>
    </div>



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script type="text/javascript" src="../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../js/administracion.js"></script>
  </body>
</html>

<?php
   }else {
       header("Location: ../index.php");
   }
?>
