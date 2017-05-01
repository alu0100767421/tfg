<?php
 session_start();
 $link = require("../connect_bbdd.php");


 if(isset($_SESSION['nombre'])) {
   $username = $_SESSION['nombre'];


     if(isset($_POST['responsable']))
       $responsable = $_POST['responsable'];

     if(isset($_POST['financiacion']))
       $financiacion = $_POST['financiacion'];

     if(isset($_POST['yacimiento_ex']))
       $yacimiento = $_POST['yacimiento_ex'];

     if(isset($_POST['fecha_inicio_ex']))
       $fecha_inicio = $_POST['fecha_inicio_ex'];

     if(isset($_POST['fecha_final_ex']))
       $fecha_final = $_POST['fecha_final_ex'];

     if(isset($_POST['observaciones_ex']))
       $observacion = $_POST['observaciones_ex'];



     echo "Los datos introducidos son: Responsable:$responsable Financiacion:$financiacion Yacimineto:$yacimiento
        Fecha Inicio:$fecha_inicio Fecha Final:$fecha_final Observacion:$observacion";




 }
 else {
   header("Location: ../../index.php");
 }
?>
