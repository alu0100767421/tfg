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







    if(isset($_POST['id_yacimiento']))
     $id_yacimiento = $_POST['id_yacimiento'];

   if(isset($_POST['id_ubicacion']))
    $id_ubicacion = $_POST['id_ubicacion'];

    if(isset($_POST['isla_consultado']))
     $isla = $_POST['isla_consultado'];
     if($isla!="")
        $isla=Mayuscula_con_tilde($isla);
     else
        $isla="DESCONOCIDO";

    if(isset($_POST['municipio_consultado']))
      $municipio = $_POST['municipio_consultado'];
      if($municipio!="")
         $municipio=Mayuscula_con_tilde($municipio);
      else
         $municipio="DESCONOCIDO";

    if(isset($_POST['localidad_consultado']))
     $localidad = $_POST['localidad_consultado'];
     if($localidad!="")
        $localidad=Mayuscula_con_tilde($localidad);
     else
       $localidad="DESCONOCIDO";

    if(isset($_POST['latitud_consultado']))
    $latitud= $_POST['latitud_consultado'];
      if($latitud=="")
        $latitud="0";

    if(isset($_POST['longitud_consultado']))
    $longitud= $_POST['longitud_consultado'];
      if($longitud=="")
        $longitud="0";



    echo "
    Los datos introducidos son:
    Id yacimineto: $id_yacimiento
    Id ubicacion: $id_ubicacion
    $isla
    $municipio
    $localidad
    $latitud
    $longitud

    \n";

    if(isset($_POST['modificar'])){
       $consulta="UPDATE ubicacion
                  SET isla='".$isla."', municipio='".$municipio."', localidad='".$localidad."', latitud='".$latitud."', longitud='".$longitud."'
                  WHERE idubicacion='".$id_ubicacion."';";
       pg_query($link,$consulta);
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
