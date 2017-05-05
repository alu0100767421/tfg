<?php
 session_start();
 $link = require("../connect_bbdd.php");


 if(isset($_SESSION['nombre'])) {
   $username = $_SESSION['nombre'];


     if(isset($_POST['nombre_especie']))
       $especie = $_POST['nombre_especie'];

     if(isset($_POST['tipo_especie']))
       $tipo = $_POST['tipo_especie'];

     if(isset($_POST['yacimiento_especie']))
       $yacimiento = $_POST['yacimiento_especie'];

     if(isset($_POST['museo_especie']))
       $museo = $_POST['museo_especie'];

     if(isset($_POST['observaciones_es']))
       $observacion = $_POST['observaciones_es'];



     echo "Los datos introducidos son: Especie:$especie Tipo:$tipo Yacimineto:$yacimiento
       Museo:$museo Observacion:$observacion";




 }
 else {
   header("Location: ../../index.php");
 }
?>
