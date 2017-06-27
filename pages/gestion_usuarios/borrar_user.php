<?php
  $link = require("../connect_bbdd.php");
  $usuario = $_POST['users'][0];
  $consulta = "DELETE FROM usuarios WHERE nombre ='". $usuario ."';";
  if($usuario != 'admin'){
    $users = pg_query($link, $consulta);
    pg_free_result($users);
    if($users){
      header("Location: ../gestion_usuarios.php?mensaje=ok&contenido=El usuario se ha borrado correctamente");
    }
    else
      header("Location: ../gestion_usuarios.php?mensaje=error&contenido=El usuario no se ha borrado correctamente");
  }else{
    pg_close($link);
    header("Location: ../gestion_usuarios.php?mensaje=error&contenido=No se puede eliminar el usuario admin");
  }
 ?>
