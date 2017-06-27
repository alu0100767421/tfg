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

    if(isset($_POST['id_yacimiento']))
      $id_yacimiento = $_POST['id_yacimiento'];

    if(isset($_POST['especie_consultado']))
     $especie = $_POST['especie_consultado'];
     if($especie!="")
        $especie=Mayuscula_con_tilde($especie);
     else
        $especie="DESCONOCIDO";

    if(isset($_POST['tipo_especie_consultado']))
      $tipo_especie = $_POST['tipo_especie_consultado'];
      if($tipo_especie!="")
         $tipo_especie=Mayuscula_con_tilde($tipo_especie);
      else
         $tipo_especie="DESCONOCIDO";

    if(isset($_POST['yacimiento_es_consultado']))
     $yacimiento = $_POST['yacimiento_es_consultado'];
     if($yacimiento!="")
        $yacimiento=Mayuscula_con_tilde($yacimiento);

    if(isset($_POST['deposito_consultado']))
    $deposito = $_POST['deposito_consultado'];
    if($deposito!="")
       $deposito=Mayuscula_con_tilde($deposito);



    echo "
    Los datos introducidos son:
    Id especie: $id_especie
    Id yacimiento: $id_yacimiento
    Id deposito: $id_deposito
    Especie: $especie
    Tipo: $tipo_especie
    Yacimiento:$yacimiento
    Deposito: $deposito

    \n";

    if(isset($_POST['modificar'])){
        $consulta="UPDATE especie
                   SET especie='".$especie."', tipo_especie='".$tipo_especie."'
                   WHERE idespecie='".$id_especie."';";
       $mensaje=pg_query($link,$consulta);
       echo pg_last_error();
       if($mensaje)
        header("Location: ../consultar_bbdd.php?mensaje=ok&contenido=Especie modificada correctamente");
       else
        header("Location: ../consultar_bbdd.php?mensaje=error&contenido=Especie modificada incorrectamente.");

    }

    elseif(isset($_POST['eliminar'])){
      $consulta="DELETE FROM yacimiento_has_especie
                 WHERE idespecie='".$id_especie."';";
      pg_query($link,$consulta);
      echo pg_last_error();

      $consulta="DELETE FROM especie_has_deposito
                 WHERE idespecie='".$id_especie."';";
      pg_query($link,$consulta);
      echo pg_last_error();

      $consulta="DELETE FROM especie
                 WHERE idespecie='".$id_especie."';";
      $mensaje=pg_query($link,$consulta);
      echo pg_last_error();
      if($mensaje)
       header("Location: ../consultar_bbdd.php?mensaje=ok&contenido=Especie eliminada correctamente");
      else
       header("Location: ../consultar_bbdd.php?mensaje=error&contenido=Especie eliminada incorrectamente");
     }
     else{
       echo "Sin cambios\n";
     }


     //header("Location: ../consultar_bbdd.php");

 }
 else {
   header("Location: ../../index.php");
 }
?>
