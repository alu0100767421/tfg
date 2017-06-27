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


     if(isset($_POST['responsable']))
       $responsable = $_POST['responsable'];
       if($responsable=="")
          $responsable="DESCONOCIDO";
        else
          $responsable=Mayuscula_con_tilde($responsable);


     if(isset($_POST['financiacion']))
       $financiacion = $_POST['financiacion'];
       if($financiacion=="")
          $financiacion="DESCONOCIDO";
       else
         $financiacion=Mayuscula_con_tilde($financiacion);


     if(isset($_POST['yacimiento_excavacion']))
       $yacimiento = $_POST['yacimiento_excavacion'];

     if(isset($_POST['fecha_inicio_ex']))
       $fecha_inicio = $_POST['fecha_inicio_ex'];

     if(isset($_POST['fecha_final_ex']))
       $fecha_final = $_POST['fecha_final_ex'];

     if(isset($_POST['deposito_excavacion']))
       $deposito = $_POST['deposito_excavacion'];
       if($deposito=="NINGUNO" || $deposito=="")
          $deposito="DESCONOCIDO";

     if(isset($_POST['observaciones_ex']))
       $observacion = $_POST['observaciones_ex'];
       if($observacion=="")
          $observacion="SIN OBSERVACIÓN";
       else {
         $observacion=Mayuscula_con_tilde($observacion);
       }


     echo "
     Los datos introducidos son:
     Responsable:$responsable
     Financiacion:$financiacion
     Yacimineto:$yacimiento
     Fecha Inicio:$fecha_inicio
     Fecha Final:$fecha_final
     Deposito:$deposito
     Observacion:$observacion\n";

     if($yacimiento!="NINGUNO" && $yacimiento!="" && $fecha_inicio!="" && $fecha_final!=""){
       $consulta_id_y="SELECT idyacimiento
                     FROM yacimiento
                     WHERE yacimiento='".$yacimiento."';";
       $id_y=pg_query($link,$consulta_id_y);
       echo pg_last_error();
       $valor_id_y=pg_fetch_assoc($id_y);
       $id_yacimiento=$valor_id_y['idyacimiento'];
       echo "id del yacimiento: $id_yacimiento\n";

       $consulta_insertar_excavacion="INSERT INTO excavacion(idyacimiento,fecha_inicial,fecha_final,responsable,financiacion,deposito,observacion_excavacion)
                                      VALUES('".$id_yacimiento."','".$fecha_inicio."','".$fecha_final."','".$responsable."','".$financiacion."','".$deposito."','".$observacion."');";
       $mensaje=pg_query($link,$consulta_insertar_excavacion);
       //echo pg_last_error();
       if($mensaje)
          header("Location: ../anadir/excavacion.php?mensaje=ok&contenido=Excavación añadida correctamente");
       else
          header("Location: ../anadir/excavacion.php?mensaje=error&contenido=Excavación añadida incorrectamente. No ha introducido algún dato importante (nombre,yacimiento, fecha inicio y fecha final)");
     }
     else{
       header("Location: ../anadir/excavacion.php?mensaje=error&contenido=Excavación añadida incorrectamente. No ha introducido algún dato importante (nombre,yacimiento, fecha inicio y fecha final)");
     }

     //header("Location: ../anadir/excavacion.php");


 }
 else {
   header("Location: ../../index.php");
 }
?>
