<?php
 session_start();
 $link = require("../connect_bbdd.php");

 header("Content-type: text/plain");

 if(isset($_SESSION['nombre'])) {
   $username = $_SESSION['nombre'];


     if(isset($_POST['titulo']))
       $titulo = $_POST['titulo'];

     if(isset($_POST['autor']))
       $autor = $_POST['autor'];
       if($autor=="")
          $autor="NULL";

     if(isset($_POST['yacimiento_publicacion']))
       $yacimiento = $_POST['yacimiento_publicacion'];

     if(isset($_POST['fecha_publi']))
       $fecha = $_POST['fecha_publi'];
       if($fecha=="")
          $fecha="NULL";


     echo "
     Los datos introducidos son:
     Titulo:$titulo
     Autor:$autor
     Yacimineto:$yacimiento
     Fecha Publicacion:$fecha\n";

     if($titulo!="" && $yacimiento!="" && $yacimeinto!="NINGUNO"){
       //insertamos en la tabla publicacion
       $consulta_insertar_publicacion="INSERT INTO publicacion(titulo,fecha,autor)
                                       VALUES('".$titulo."','".$fecha."','".$autor."')";

       pg_query($link,$consulta_insertar_publicacion);
       echo pg_last_error();

       //hallamos el id del yacimiento
       $consulta_id_y="SELECT idyacimiento
                     FROM yacimiento
                     WHERE yacimiento='".$yacimiento."';";
       $id_y=pg_query($link,$consulta_id_y);
       echo pg_last_error();
       $valor_id_y=pg_fetch_assoc($id_y);
       $id_yacimiento=$valor_id_y['idyacimiento'];
       echo "id del yacimiento: $id_yacimiento\n";

       //hallamos el ide de la publicacion
       $consulta_id_p="SELECT idpublicaciones
                     FROM publicacion
                     WHERE titulo='".$titulo."';";
       $id_p=pg_query($link,$consulta_id_p);
       echo pg_last_error();
       $valor_id_p=pg_fetch_assoc($id_p);
       $id_publicacion=$valor_id_p['idpublicaciones'];
       echo "id de la publicacion: $id_publicacion\n";

       //insertamos en la tabla yacimiento_has_publicacion
       $consulta_insertar_yacimiento_has_publicacion="INSERT INTO yacimiento_has_publicacion
                                                  VALUES('".$id_yacimiento."','".$id_publicacion."');";
       pg_query($link,$consulta_insertar_yacimiento_has_publicacion);
       echo pg_last_error()."\n";
     }
     else{
       echo "No ha introducido un titulo o yacimiento\n";
     }
     header("Location: ../anadir/publicacion.php");

 }
 else {
   header("Location: ../../index.php");
 }
?>
