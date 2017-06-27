<?php

  $link = require("../connect_bbdd.php");
  $pass_encrypt = crypt($_POST['password'], '$6$rounds=5000$paddingseguridad$');
  $usuario = $_POST['usuario'];

  $consulta = "SELECT nombre FROM usuarios;";
  $users = pg_query($link, $consulta);
  $repetido = FALSE;

  while($usu = pg_fetch_assoc($users)){
    $user = $usu['usuario'];
    if($user == $usuario){
      $repetido = TRUE;
    }
  }
  pg_free_result($users);
  if($repetido == FALSE && $usuario != 'admin' && $_POST['password']!=''){
    $consulta = "INSERT INTO usuarios (nombre, pass) VALUES ('". $usuario ."', '". $pass_encrypt ."');";
    $insertar = pg_query($link, $consulta);
    if($insertar){
      header("Location: ../gestion_usuarios.php?mensaje=ok&contenido=Usario añadido correctamente");
    }
    else
      header("Location: ../gestion_usuarios.php?mensaje=error&contenido=Error al añadir el usuario");

  }else {
    echo "error";
    pg_close($link);
    header("Location: ../gestion_usuarios.php?mensaje=error&contenido=Error al añadir el usuario");
  }





 ?>
