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

  /*   if(isset($_POST['modificar']))
       $numero = $_POST['numero'];*/

     if(isset($_POST['deposito_consultado']))
       $deposito = $_POST['deposito_consultado'];
       if($deposito!="")
          $deposito=Mayuscula_con_tilde($deposito);

     if(isset($_POST['deposit']))
       $deposito_viejo = $_POST['deposit'];
       if($deposito_viejo!="")
          $deposito_viejo=Mayuscula_con_tilde($deposito_viejo);

     if(isset($_POST['pais_consultado']))
       $pais = $_POST['pais_consultado'];
       if($pais!="")
          $pais=Mayuscula_con_tilde($pais);

     if(isset($_POST['country']))
       $pais_viejo = $_POST['country'];
       if($pais_viejo!="")
          $pais_viejo=Mayuscula_con_tilde($pais_viejo);



     echo "
     Los datos introducidos son:
     Numero: $numero
     Deposito:$deposito
     Pais:$pais
     Deposito Viejo:$deposito_viejo
     Pais Viejo:$pais_viejo\n";

     if(isset($_POST['modificar'])){
       if($deposito!="" && $pais!=""){

         $consulta_modificacion="UPDATE deposito
                                 SET deposito='".$deposito."', pais='".$pais."'
                                 WHERE deposito='".$deposito_viejo."' AND pais='".$pais_viejo."';";
         pg_query($link,$consulta_modificacion);
         echo pg_last_error();

       }
       else{
         echo "no ha introducido ningun pais o deposito\n";
       }
     }

     if(isset($_POST['eliminar'])){
       if($deposito!="" && $pais!=""){

         $consulta_modificacion="DELETE FROM deposito
                                 WHERE deposito='".$deposito_viejo."' AND pais='".$pais_viejo."';";
         pg_query($link,$consulta_modificacion);
         echo pg_last_error();

       }
       else{
         echo "no ha introducido ningun pais o deposito\n";
       }
     }

     //header("Location: ../consultar_bbdd.php");

 }
 else {
   header("Location: ../../index.php");
 }
?>
