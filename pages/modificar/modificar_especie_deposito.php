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

    if(isset($_POST['id_deposito']))
      $id_deposito = $_POST['id_deposito'];

    echo "
    Los datos introducidos son:
    Id especie: $id_especie
    Id deposito: $id_deposito
    \n";



    if(isset($_POST['eliminar'])){

      $consulta="DELETE FROM especie_has_deposito
                 WHERE idespecie='".$id_especie."' AND iddeposito='".$id_deposito."';";
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
