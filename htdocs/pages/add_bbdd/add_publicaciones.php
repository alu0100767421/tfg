<?php
 session_start();
 $link = require("../connect_bbdd.php");


 if(isset($_SESSION['nombre'])) {
   $username = $_SESSION['nombre'];


     if(isset($_POST['titulo']))
       $titulo = $_POST['titulo'];

     if(isset($_POST['autor']))
       $autor = $_POST['autor'];

     if(isset($_POST['yacimiento_publi']))
       $yacimiento = $_POST['yacimiento_publi'];

     if(isset($_POST['fecha_publi']))
       $fecha_publi = $_POST['fecha_publi'];

     if(isset($_POST['observaciones_publi']))
       $observacion = $_POST['observaciones_publi'];



     echo "Los datos introducidos son: Titulo:$titulo Autor:$autor Yacimineto:$yacimiento
        Fecha Publicacion:$fecha_publi Observacion:$observacion";




 }
 else {
   header("Location: ../../index.php");
 }
?>
