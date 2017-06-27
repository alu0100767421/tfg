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

    if(isset($_POST['id_excavacion']))
     $id_excavacion = $_POST['id_excavacion'];

    if(isset($_POST['responsable_consultado']))
     $responsable = $_POST['responsable_consultado'];
     if($responsable!="")
        $responsable=Mayuscula_con_tilde($responsable);
     else
        $responsable="DESCONOCIDO";

    if(isset($_POST['financiacion_consultado']))
      $financiacion = $_POST['financiacion_consultado'];
      if($financiacion!="")
         $financiacion=Mayuscula_con_tilde($financiacion);
      else
         $financiacion="DESCONOCIDO";

    if(isset($_POST['yacimiento_ex_consultado']))
     $yacimiento = $_POST['yacimiento_ex_consultado'];
     if($yacimiento!="")
        $yacimiento=Mayuscula_con_tilde($yacimiento);
     else
        $yacimiento="DESCONOCIDO";

    if(isset($_POST['fecha_ex_consultado']))
     $fecha = $_POST['fecha_ex_consultado'];

    if(isset($_POST['fecha_ex_fin_consultado']))
     $fecha_fin = $_POST['fecha_ex_fin_consultado'];


    if(isset($_POST['deposito_consultado']))
    $deposito = $_POST['deposito_consultado'];
    if($deposito!="")
       $deposito=Mayuscula_con_tilde($deposito);
    else {
       $deposito="DESCONOCIDO";
    }

    if(isset($_POST['observacion_excavacion_consultado']))
    $observacion= $_POST['observacion_excavacion_consultado'];
    if($observacion!="")
       $observacion=Mayuscula_con_tilde($observacion);


    echo "
    Los datos introducidos son:
    Id: $id_excavacion
    Responsable: $responsable
    Financiacion: $financiacion
    Yacimiento:$yacimiento
    Fecha:$fecha
    Fecha final: $fecha_fin
    Deposito: $deposito
    Observacion: $observacion
    \n";

    if(isset($_POST['modificar'])){
       $consulta="UPDATE excavacion
                  SET responsable='".$responsable."', financiacion='".$financiacion."', fecha_inicial='".$fecha."', fecha_final='".$fecha_fin."', deposito='".$deposito."', observacion_excavacion='".$observacion."'
                  WHERE idexcavaciones='".$id_excavacion."';";
       $mensaje=pg_query($link,$consulta);
       echo pg_last_error();
       if($mensaje)
        header("Location: ../consultar_bbdd.php?mensaje=ok&contenido=Excavación modificada correctamente");
       else
        header("Location: ../consultar_bbdd.php?mensaje=error&contenido=Excavación modificada incorrectamente.");
    }

    elseif(isset($_POST['eliminar'])){
       $consulta_eliminar="DELETE FROM excavacion
                           WHERE idexcavaciones='".$id_excavacion."';";
       $mensaje=pg_query($link,$consulta_eliminar);
       echo pg_last_error();
       if($mensaje)
        header("Location: ../consultar_bbdd.php?mensaje=ok&contenido=Excavación eliminada correctamente");
       else
        header("Location: ../consultar_bbdd.php?mensaje=error&contenido=Excavación eliminada incorrectamente");
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
