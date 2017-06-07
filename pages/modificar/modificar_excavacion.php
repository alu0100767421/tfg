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

    if(isset($_POST['observacion_excavacion_consultado']))
    $observacion= $_POST['observacion_excavacion_consultado'];
    if($observacion!="")
       $observacion=Mayuscula_con_tilde($observacion);















//viejos
   if(isset($_POST['responsable_viejo']))
    $esponsable_viejo = $_POST['responsable_viejo'];
    if($responsable_viejo!="")
       $responsable_viejo=Mayuscula_con_tilde($responsable_viejo);
    else
       $responsable_viejo="DESCONOCIDO";

   if(isset($_POST['financiacion_viejo']))
     $financiacion_viejo = $_POST['financiacion_viejo'];
     if($financiacion_viejo!="")
        $financiacion_viejo=Mayuscula_con_tilde($financiacion_viejo);
     else
        $financiacion="DESCONOCIDO";

   if(isset($_POST['yaci_ex_viejo']))
    $yacimiento_viejo = $_POST['yaci_ex_viejo'];
    if($yacimiento_viejo!="")
       $yacimiento_viejo=Mayuscula_con_tilde($yacimiento_viejo);
    else
       $yacimiento_viejo="DESCONOCIDO";

   if(isset($_POST['fecha_ex_viejo']))
    $fecha_viejo = $_POST['fecha_ex_viejo'];

   if(isset($_POST['fecha_ex_fin_viejo']))
    $fecha_fin_viejo = $_POST['fecha_ex_fin_viejo'];


   if(isset($_POST['deposito_viejo']))
   $deposito_viejo = $_POST['deposito_viejo'];
   if($deposito_viejo!="")
      $deposito_viejo=Mayuscula_con_tilde($deposito_viejo);

   if(isset($_POST['observacion_excavacion_viejo']))
   $observacion_viejo= $_POST['observacion_excavacion_viejo'];
   if($observacion_viejo!="")
      $observacion_viejo=Mayuscula_con_tilde($observacion_viejo);



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

    Responsable viejo: $responsable_viejo
    Financiacion viejo: $financiacion_viejo
    Yacimiento viejo:$yacimiento_viejo
    Fecha viejo:$fecha_viejo
    Fecha final viejo: $fecha_fin_viejo
    Deposito viejo: $deposito_viejo
    Observacion viejo: $observacion_viejo
    \n";

    if(isset($_POST['modificar'])){
       $consulta="UPDATE excavacion
                  SET responsable='".$responsable."', financiacion='".$financiacion."', fecha_inicial='".$fecha."', fecha_final='".$fecha_fin."', deposito='".$deposito."', observacion_excavacion='".$observacion."'
                  WHERE idexcavaciones='".$id_excavacion."';";
       pg_query($link,$consulta);
       echo pg_last_error();

    }
    
    elseif(isset($_POST['eliminar'])){
       $consulta_eliminar="DELETE FROM excavacion
                           WHERE idexcavaciones='".$id_excavacion."';";
       pg_query($link,$consulta_eliminar);
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
