<?php
session_start();
if(isset($_SESSION['nombre'])){
  session_destroy();
  header("Location: ../index.php");
}
else{
  echo "Fallo al cerrar sesión";
}
 ?>
