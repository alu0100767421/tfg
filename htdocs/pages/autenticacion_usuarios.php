<?php
  session_start(); //Iniciamos la sesión

  $link = require("connect_bbdd.php");
  $username = $_POST['users'][0];
  $pass_encrypt = crypt($_POST['password'],'$6$rounds=5000$paddingseguridad$');
  $consulta = "SELECT * FROM usuarios
    WHERE nombre='". $username ."' AND password='". $pass_encrypt ."';";
  $query_autentification = pg_query($link, $consulta) or die(pg_last_error());
  $row_cnt = pg_num_rows($query_autentification);

  if($row_cnt == 1){
    //CREAMOS LAS SESIONES PARA LOS USUARIOS
    $_SESSION['nombre'] = $username;
    header("Location: administracion.php");
    // USUARIO AUTENTIFICADO.
    pg_free_result($query_autentification);
  }
  else{
    //USUARIO NO AUTENTIFICADO.
    pg_free_result($query_autentification);
    pg_close($link);
    echo "Ha habido un error en la autenticacion: " . pg_last_error();
  }
 ?>
