<?php

  $link = pg_connect("host=localhost dbname=paleontologia user=postgres password=postgres");
  if(!$link){
    printf("Error: No se puede establecer la conexión con la base de datos.\n");
    exit;
  }
  else{
    return $link;
  }
 ?>
