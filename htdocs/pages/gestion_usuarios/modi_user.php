<?php
  $link = require("../connect_bbdd.php");
  $usuario = $_POST['users'][0];
  $pass= $_POST['password'];
  
  $new_pass= crypt($_POST['password'], '$6$rounds=5000$paddingseguridad$');
  $consulta = "UPDATE usuarios SET password='". $new_pass ."' WHERE nombre='".$usuario."';";

  if($usuario != 'admin'){
    $mod = pg_query($link, $consulta);
    header("Location: ../gestion_usuarios.php");
  }else{
    pg_close($link);
    header("Location: ../gestion_usuarios.php");
  }
 ?>
