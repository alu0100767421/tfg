<?php
 session_start();
 $link = require("../connect_bbdd.php");

 header("Content-type: text/plain");

 if(isset($_SESSION['nombre'])) {
   $username = $_SESSION['nombre'];

     if(isset($_POST['deposito']))
       $deposito = $_POST['deposito'];

     if(isset($_POST['pais']))
       $pais = $_POST['pais'];

     echo "
     Los datos introducidos son:
     Deposito:$deposito
     Pais:$pais\n";

     if($deposito!="" && $pais!=""){

       //comprobamos si la especie ya existe, en caso contrario de añade a la tabla
       $consulta_comprobacion="SELECT deposito
                               FROM deposito
                               WHERE deposito='".$deposito."';";
       $aux=pg_query($link,$consulta_comprobacion);
       $row=pg_num_rows($aux);
       echo "Filas:$row\n";
       if($row == 0){
         $consulta_insertar_deposito="INSERT INTO deposito(deposito,pais)
                    VALUES('".$deposito."','".$pais."');";
         pg_query($link,$consulta_insertar_deposito);
         echo pg_last_error();
       }


     }
     else{
       echo "no ha introducido ningun pais o deposito\n";
     }


     header("Location: ../anadir/deposito.php");






 }
 else {
   header("Location: ../../index.php");
 }
?>
