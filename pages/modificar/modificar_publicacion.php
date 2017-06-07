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


    if(isset($_POST['titulo_consultado']))
     $titulo = $_POST['titulo_consultado'];
     if($titulo!="")
        $titulo=Mayuscula_con_tilde($titulo);
     else
        $titulo="DESCONOCIDO";

    if(isset($_POST['id_publicacion']))
      $id_publicacion = $_POST['id_publicacion'];

    if(isset($_POST['autor_consultado']))
     $autor = $_POST['autor_consultado'];
     if($autor!="")
        $autor=Mayuscula_con_tilde($autor);
     else
        $autor="DESCONOCIDO";

    if(isset($_POST['yacimiento_publi_consultado']))
     $yacimiento = $_POST['yacimiento_publi_consultado'];
     if($yacimiento!="")
        $yacimiento=Mayuscula_con_tilde($yacimiento);
     else
        $yacimiento="DESCONOCIDO";

    if(isset($_POST['fecha_publi_consultado']))
     $fecha = $_POST['fecha_publi_consultado'];


    echo "
    Los datos introducidos son:
    Id: $id_publicacion
    Titulo: $titulo
    Autor:$autor
    Yacimiento:$yacimiento
    Fecha viejo:$fecha


    \n";

    if(isset($_POST['modificar'])){


       $consulta_modificacion="UPDATE publicacion
                               SET titulo='".$titulo."', autor='".$autor."', fecha='".$fecha."'
                               WHERE idpublicaciones='".$id_publicacion."';";
       pg_query($link,$consulta_modificacion);
       echo pg_last_error();

    }

    elseif(isset($_POST['eliminar'])){
       $consulta_eliminar_publicacion="DELETE FROM yacimiento_has_publicacion
                                            WHERE idpublicaciones='".$id_publicacion."';";
       pg_query($link,$consulta_eliminar_publicacion);

       $consulta_eliminar_publicacion="DELETE FROM publicacion
                                            WHERE idpublicaciones='".$id_publicacion."';";
       pg_query($link,$consulta_eliminar_publicacion);
       echo pg_last_error();

     }
     else{
       echo "Sin cambios\n";
     }


     header("Location: ../consultar_bbdd.php");

 }
 else {
   header("Location: ../../index.php");
 }
?>
