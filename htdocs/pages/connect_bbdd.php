<?php



  $link = pg_connect("host=localhost dbname=paleontologia");
  if(!$link){
    printf("Error: No se puede establecer la conexión con la base de datos. %s\n", pg_connect_error());
    exit;
  }
  else{
    //pg_select_db($link, "paleontologia");
    return $link;
  }

 ?>
