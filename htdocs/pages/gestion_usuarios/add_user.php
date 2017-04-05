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
  if($repetido == FALSE && $usuario != 'admin'){
    $consulta = "INSERT INTO usuarios (nombre, password) VALUES ('". $usuario ."', '". $pass_encrypt ."');";
    $insertar = pg_query($link, $consulta);
    header("Location: ../gestion_usuarios.php");

  }else {
    echo "error";
    pg_close($link);

  }





 ?>
