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

    if(isset($_POST['edad_consultado']))
     $edad = $_POST['edad_consultado'];
     if($edad!="")
        $edad=Mayuscula_con_tilde($edad);
     else
        $edad="DESCONOCIDO";

    if(isset($_POST['altura_consultado']))
      $altura = $_POST['altura_consultado'];
      if($altura!="")
         $altura=Mayuscula_con_tilde($altura);
      else
         $altura="-1";

    if(isset($_POST['yacimiento_consultado']))
     $yacimiento = $_POST['yacimiento_consultado'];
     if($yacimiento!="")
        $yacimiento=Mayuscula_con_tilde($yacimiento);
     else
        $yacimiento="DESCONOCIDO";

    if(isset($_POST['tipo_consultado']))
     $tipo = $_POST['tipo_consultado'];
     if($tipo!="")
        $tipo=Mayuscula_con_tilde($tipo);
     else
       $tipo="DESCONOCIDO";

    if(isset($_POST['observacion_consultado']))
    $observacion= $_POST['observacion_consultado'];
      if($observacion!="")
         $observacion=Mayuscula_con_tilde($observacion);
      else
        $observacion="SIN OBSERVACIÓN";



    echo "
    Los datos introducidos son:
    Id: $id_yacimiento
    edad: $edad
    Altura: $altura
    Yacimiento:$yacimiento
    Tipo:$tipo
    Observacion: $observacion
    \n";

    if(isset($_POST['modificar'])){
       $consulta="UPDATE yacimiento
                  SET yacimiento='".$yacimiento."', edad='".$edad."', altura='".$altura."', tipo_yacimiento='".$tipo."', observacion_yacimiento='".$observacion."'
                  WHERE idyacimiento='".$id_yacimiento."';";
       $mensaje=pg_query($link,$consulta);
       echo pg_last_error();

       if($mensaje)
        header("Location: ../consultar_bbdd.php?mensaje=ok&contenido=Yacimiento modificado correctamente");
       else
        header("Location: ../consultar_bbdd.php?mensaje=error&contenido=Yacimiento modificado incorrectamente");
    }

    elseif(isset($_POST['eliminar'])){
       $consulta_eliminar="DELETE FROM yacimiento
                           WHERE idyacimiento='".$id_yacimiento."';";
       $mensaje=pg_query($link,$consulta_eliminar);
       echo pg_last_error();
       if($mensaje)
        header("Location: ../consultar_bbdd.php?mensaje=ok&contenido=Yacimiento eliminado correctamente");
       else
        header("Location: ../consultar_bbdd.php?mensaje=error&contenido=Yacimiento eliminado incorrectamente");
     }
     else{
       echo "Sin cambios\n";
     }


     //header("Location: ../consultar_bbdd.php");

 }
 else {
   header("Location: ../../index.php");
 }
?>
