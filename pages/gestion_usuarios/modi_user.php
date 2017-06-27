<?php
  $link = require("../connect_bbdd.php");
  $usuario = $_POST['users'][0];
  $pass= $_POST['password'];

  $new_pass= crypt($_POST['password'], '$6$rounds=5000$paddingseguridad$');
  $consulta = "UPDATE usuarios SET pass='". $new_pass ."' WHERE nombre='".$usuario."';";

  if($usuario != 'admin'){
    $mod = pg_query($link, $consulta);
    if($mod){
      header("Location: ../gestion_usuarios.php?mensaje=ok&contenido=El usuario se ha modificado correctamente");
    }
    else
      header("Location: ../gestion_usuarios.php?mensaje=error&contenido=El usuario no se ha modificado correctamente");
  }else{
    pg_close($link);
    header("Location: ../gestion_usuarios.php?mensaje=error&contenido=No se puede modificar desde este portal el usuario admin");
  }
 ?>
