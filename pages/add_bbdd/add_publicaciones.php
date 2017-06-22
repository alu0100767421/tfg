<?php
 session_start();
 $link = require("../connect_bbdd.php");

 header("Content-type: text/plain");

 function Mayuscula_con_tilde($aux) {
   $aux = strtr(strtoupper($aux),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ");
   return $aux;
 }

 if(isset($_SESSION['nombre'])) {
   $username = $_SESSION['nombre'];


     if(isset($_POST['titulo']))
       $titulo = $_POST['titulo'];
       if($titulo!="")
          $titulo=Mayuscula_con_tilde($titulo);

     if(isset($_POST['autor']))
       $autor = $_POST['autor'];
       if($autor=="")
          $autor="DESCONOCIDO";
       else {
         $autor=Mayuscula_con_tilde($autor);
       }

     if(isset($_POST['yacimiento_publicacion']))
       $yacimiento = $_POST['yacimiento_publicacion'];
       if($yacimiento=="" || $yacimiento=="NINGUNO")
        $yacimiento="DESCONOCIDO";

    if(isset($_POST['pdf_publi']))
      $pdf = $_POST['pdf_publi'];
      if($pdf=="")
       $pdf="DESCONOCIDO";

     if(isset($_POST['fecha_publi']))
       $fecha = $_POST['fecha_publi'];
       if($fecha=="")
        $fecha='2000-01-01';


     echo "
     Los datos introducidos son:
     Titulo:$titulo
     Autor:$autor
     Yacimineto:$yacimiento
     Fecha Publicacion:$fecha
     PDF:$pdf
     \n";

     if($titulo!="" && $yacimiento!="" && $yacimiento!="DESCONOCIDO"){
       //insertamos en la tabla publicacion
       $consulta_insertar_publicacion="INSERT INTO publicacion(titulo,fecha,autor,pdf)
                                       VALUES('".$titulo."','".$fecha."','".$autor."','".$pdf."')";

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

       $consulta="UPDATE yacimiento
                  SET cant_publicaciones=cant_publicaciones+1
                  WHERE idyacimiento='".$id_yacimiento."';";
       pg_query($link,$consulta);
       echo pg_last_error()."\n";
     }
     else if($titulo!=""){
       //echo "estoy aqui";
       $consulta_insertar_publicacion="INSERT INTO publicacion(titulo,fecha,autor,pdf)
                                       VALUES('".$titulo."','".$fecha."','".$autor."','".$pdf."')";

       pg_query($link,$consulta_insertar_publicacion);
       echo pg_last_error();
     }
     header("Location: ../anadir/publicacion.php");

 }
 else {
   header("Location: ../../index.php");
 }
?>
