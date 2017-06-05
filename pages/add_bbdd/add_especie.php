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

     if(isset($_POST['nombre_especie']))
       $especie = $_POST['nombre_especie'];
       if($especie!="")
          $especie=Mayuscula_con_tilde($especie);

     if(isset($_POST['tipo_especie']))
       $tipo = $_POST['tipo_especie'];
       if($tipo !="")
          $tipo=Mayuscula_con_tilde($tipo);
       else {
         $tipo="DESCONOCIDO";
       }

     if(isset($_POST['yacimiento_especie']))
       $yacimiento = $_POST['yacimiento_especie'];

     if(isset($_POST['deposito_especie']))
       $deposito = $_POST['deposito_especie'];


     echo "
     Los datos introducidos son:
     Especie:$especie
     Tipo:$tipo
     Yacimineto:$yacimiento
     Deposito:$deposito\n";

     if($especie!=""){

       //comprobamos si la especie ya existe, en caso contrario de añade a la tabla
       $consulta_comprobacion="SELECT especie
                               FROM especie WHERE especie='".$especie."';";
       $aux=pg_query($link,$consulta_comprobacion);
       $row=pg_num_rows($aux);
       echo "Filas:$row\n";
       if($row == 0){
         $consulta_insertar_especie="INSERT INTO especie(especie,tipo_especie)
                    VALUES('".$especie."','".$tipo."');";
         pg_query($link,$consulta_insertar_especie);
         echo pg_last_error();
       }

       //ahora vamos a relacionar la tabla yacimiento_has_especie
       //si yacimiento es diferente a NINGUNO
       if($yacimiento!="NINGUNO" && $yacimiento!=""){
         //obtenemos el id del yacimiento
         $consulta_id_y="SELECT idyacimiento
                       FROM yacimiento
                       WHERE yacimiento='".$yacimiento."';";
         $id_y=pg_query($link,$consulta_id_y);
         echo pg_last_error();
         $valor_id_y=pg_fetch_assoc($id_y);
         $id_yacimiento=$valor_id_y['idyacimiento'];
         echo "id del yacimiento: $id_yacimiento\n";

         //obtenemos el id de la especie
         $consulta_id_e="SELECT idespecie
                       FROM especie
                       WHERE especie='".$especie."';";
         $id_e=pg_query($link,$consulta_id_e);
         echo pg_last_error();
         $valor_id_e=pg_fetch_assoc($id_e);
         $id_especie=$valor_id_e['idespecie'];
         echo "id del especie: $id_especie\n";

         //insertamos en yacimiento_has_especie
         $consulta_insertar_yacimiento_has_especie="INSERT INTO yacimiento_has_especie
                                                    VALUES('".$id_yacimiento."','".$id_especie."');";
         pg_query($link,$consulta_insertar_yacimiento_has_especie);
         echo pg_last_error()."\n";

       }
       else{
         echo "no ha introducido ningun yacimiento\n";
       }

       //ahora vamos a relacionar la tabla especie_has_deposito
       //si deposito es diferente a NINGUNO

       if($deposito!="NINGUNO" && $deposito!=""){
         $consulta_id_d="SELECT iddeposito
                       FROM deposito
                       WHERE deposito='".$deposito."';";
         $id_d=pg_query($link,$consulta_id_d);
         echo pg_last_error();
         $valor_id_d=pg_fetch_assoc($id_d);
         $id_deposito=$valor_id_d['iddeposito'];
         echo "id del deposito: $id_deposito\n";

         $consulta_insertar_especie_has_deposito="INSERT INTO especie_has_deposito
                                                    VALUES('".$id_especie."','".$id_deposito."');";
         pg_query($link,$consulta_insertar_especie_has_deposito);
         echo pg_last_error()."\n";
       }
       else{
         echo "no ha introducido ningun deposito\n";
       }
     }
     else{
       echo "no ha introducido nunguna especie\n";
     }


     header("Location: ../anadir/especie.php");






 }
 else {
   header("Location: ../../index.php");
 }
?>
