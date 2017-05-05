<?php
  $link = require("../connect_bbdd.php");
  $usuario = $_POST['users'][0];
  $consulta = "DELETE FROM usuarios WHERE nombre ='". $usuario ."';";
  if($usuario != 'admin'){
    $users = pg_query($link, $consulta);
    pg_free_result($users);
    header("Location: ../gestion_usuarios.php");
  }else{
    pg_close($link);
    header("Location: ../gestion_usuarios.php");
  }
 ?>
