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

    if(isset($_POST['id_especie']))
     $id_especie = $_POST['id_especie'];

    if(isset($_POST['id_yacimiento']))
      $id_yacimiento = $_POST['id_yacimiento'];










    echo "
    Los datos introducidos son:
    Id especie: $id_especie
    Id yacimiento: $id_yacimiento

    \n";



    if(isset($_POST['eliminar'])){
      $consulta="DELETE FROM yacimiento_has_especie
                 WHERE idespecie='".$id_especie."' AND idyacimiento='".$id_yacimiento."';";
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
