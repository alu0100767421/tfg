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

     if(isset($_POST['id_deposito']))
       $id_deposito = $_POST['id_deposito'];

     if(isset($_POST['deposito_consultado']))
       $deposito = $_POST['deposito_consultado'];
       if($deposito!="")
          $deposito=Mayuscula_con_tilde($deposito);

     if(isset($_POST['pais_consultado']))
       $pais = $_POST['pais_consultado'];
       if($pais!="")
          $pais=Mayuscula_con_tilde($pais);


     echo "
     Los datos introducidos son:
     ID:$id_deposito
     Deposito:$deposito
     Pais:$pais
     \n";

     if(isset($_POST['modificar'])){
       if($deposito!="" && $pais!=""){

         $consulta_modificacion="UPDATE deposito
                                 SET deposito='".$deposito."', pais='".$pais."'
                                 WHERE iddeposito='".$id_deposito."';";
         pg_query($link,$consulta_modificacion);
         echo pg_last_error();

       }
       else{
         echo "no ha introducido ningun pais o deposito\n";
       }
     }

     if(isset($_POST['eliminar'])){
       if($deposito!="" && $pais!=""){

         $consulta_eliminar_deposito="DELETE FROM deposito
                                 WHERE iddeposito='".$id_deposito."';";
         pg_query($link,$consulta_eliminar_deposito);
         echo pg_last_error();

       }
       else{
         echo "no ha introducido ningun pais o deposito\n";
       }
     }

     header("Location: ../consultar_bbdd.php");

 }
 else {
   header("Location: ../../index.php");
 }
?>
