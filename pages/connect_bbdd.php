<?php

  $link = pg_connect("host=localhost dbname=paleontologia2 user=alex password=alex");
  if(!$link){
    printf("Error: No se puede establecer la conexión con la base de datos.\n");
    exit;
  }
  else{
    return $link;
  }
 ?>
