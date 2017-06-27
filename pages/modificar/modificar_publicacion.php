<?php
 session_start();
 $link = require("../connect_bbdd.php");

 header("Content-type: text/plain");

 function Mayuscula_con_tilde($aux) {
   $aux = strtr(strtoupper($aux),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ");
   return $aux;
 }

  if(isset($_SESSION['nombre'])) {
    $username = $_SESSION['nombre'];


    if(isset($_POST['titulo_consultado']))
     $titulo = $_POST['titulo_consultado'];
     if($titulo!="")
        $titulo=Mayuscula_con_tilde($titulo);
     else
        $titulo="DESCONOCIDO";

    if(isset($_POST['id_publicacion']))
      $id_publicacion = $_POST['id_publicacion'];

    if(isset($_POST['autor_consultado']))
     $autor = $_POST['autor_consultado'];
     if($autor!="")
        $autor=Mayuscula_con_tilde($autor);
     else
        $autor="DESCONOCIDO";

    if(isset($_POST['yacimiento_publi_consultado']))
     $yacimiento = $_POST['yacimiento_publi_consultado'];
     if($yacimiento!="")
        $yacimiento=Mayuscula_con_tilde($yacimiento);
     else
        $yacimiento="DESCONOCIDO";

    if(isset($_POST['yacimiento_viejo']))
     $yacimiento_viejo = $_POST['yacimiento_viejo'];


    if(isset($_POST['fecha_publi_consultado']))
     $fecha = $_POST['fecha_publi_consultado'];
     if($fecha==""){
       $fecha='2000-01-01';
     }

     if(isset($_POST['pdf_consultado']))
      $pdf = $_POST['pdf_consultado'];
      if($pdf==""){
        $pdf='DESCONOCIDO';
      }


    echo "
    Los datos introducidos son:
    Id: $id_publicacion
    Titulo: $titulo
    Autor:$autor
    Yacimiento:$yacimiento
    Yacimiento_viejo:$yacimiento_viejo
    PDF:$pdf;
    Fecha viejo:$fecha


    \n";

    if(isset($_POST['modificar'])){
      if($yacimiento!="DESCONOCIDO"){
        if($yacimiento_viejo==$yacimiento){
          $consulta="UPDATE publicacion
                     SET titulo='".$titulo."', autor='".$autor."', fecha='".$fecha."', pdf='".$pdf."'
                     WHERE idpublicaciones='".$id_publicacion."';";
        }
        else {
          if($yacimiento_viejo!="NO CORRESPONDE A NINGÚN YACIMIENTO"){
            $consulta_id_y="SELECT idyacimiento
                          FROM yacimiento
                          WHERE yacimiento='".$yacimiento_viejo."';";
            $id_y=pg_query($link,$consulta_id_y);
            echo pg_last_error();
            $valor_id_y=pg_fetch_assoc($id_y);
            $id_yacimiento_viejo=$valor_id_y['idyacimiento'];
            echo "id del yacimiento VIEJO: $id_yacimiento_viejo
            Yacimiento:$yacimiento\n";

            $consulta_comprobar_yacimiento_nuevo="SELECT idyacimiento
                                                  FROM yacimiento
                                                  WHERE yacimiento='".$yacimiento."';";
            $id_y_nuevo=pg_query($link,$consulta_comprobar_yacimiento_nuevo);
            if(pg_num_rows($id_y_nuevo)>0){
              $valor_id_y=pg_fetch_assoc($id_y_nuevo);
              $id_yacimiento_nuevo=$valor_id_y['idyacimiento'];
              echo "id del yacimiento nuevo: $id_yacimiento_nuevo\n";
              $consulta="UPDATE yacimiento_has_publicacion
                            SET idyacimiento='".$id_yacimiento_nuevo."'
                            WHERE idyacimiento='".$id_yacimiento_viejo."' AND idpublicaciones='".$id_publicacion."';";

              $consulta2="UPDATE yacimiento
                         SET cant_publicaciones=cant_publicaciones+1
                         WHERE idyacimiento='".$id_yacimiento_nuevo."';";
              pg_query($link,$consulta2);
              echo pg_last_error()."\n";
              $consulta2="UPDATE yacimiento
                         SET cant_publicaciones=cant_publicaciones-1
                         WHERE idyacimiento='".$id_yacimiento_viejo."';";
              pg_query($link,$consulta2);
              echo pg_last_error()."\n";
            }

          }
          else{
            $consulta_comprobar_yacimiento_nuevo="SELECT idyacimiento
                                                  FROM yacimiento
                                                  WHERE yacimiento='".$yacimiento."';";
            $id_y_nuevo=pg_query($link,$consulta_comprobar_yacimiento_nuevo);
            if(pg_num_rows($id_y_nuevo)>0){
              $valor_id_y=pg_fetch_assoc($id_y_nuevo);
              $id_yacimiento_nuevo=$valor_id_y['idyacimiento'];
              echo "id del yacimiento nuevo: $id_yacimiento_nuevo\n";
              $consulta="INSERT INTO yacimiento_has_publicacion
                         VALUES('".$id_yacimiento_nuevo."','".$id_publicacion."');";

               $consulta2="UPDATE yacimiento
                          SET cant_publicaciones=cant_publicaciones+1
                          WHERE idyacimiento='".$id_yacimiento_nuevo."';";
               pg_query($link,$consulta2);
               echo pg_last_error()."\n";
            }

          }
        }
      }
     else{

       $consulta_id_y="SELECT idyacimiento
                     FROM yacimiento
                     WHERE yacimiento='".$yacimiento_viejo."';";
       $id_y=pg_query($link,$consulta_id_y);
       echo pg_last_error();
       $valor_id_y=pg_fetch_assoc($id_y);
       $id_yacimiento_viejo=$valor_id_y['idyacimiento'];
       echo "id del yacimiento: $id_yacimiento_viejo\n";
       $consulta="DELETE FROM yacimiento_has_publicacion
                  WHERE idyacimiento='".$id_yacimiento_viejo."' AND idpublicaciones='".$id_publicacion."';";

     }
     $mensaje=pg_query($link,$consulta);
     echo pg_last_error();
     if($mensaje)
      header("Location: ../consultar_bbdd.php?mensaje=ok&contenido=Publicación modificada correctamente");

     else
      header("Location: ../consultar_bbdd.php?mensaje=error&contenido=Publicación modificada incorrectamente. Compruebe que el yacimiento existe.");

    }

    elseif(isset($_POST['eliminar'])){

       $consulta_eliminar_publicacion="DELETE FROM publicacion
                                            WHERE idpublicaciones='".$id_publicacion."';";
       $mensaje=pg_query($link,$consulta_eliminar_publicacion);
       echo pg_last_error();
       if($mensaje)
        header("Location: ../consultar_bbdd.php?mensaje=ok&contenido=Publicación eliminada correctamente");
       else
        header("Location: ../consultar_bbdd.php?mensaje=error&contenido=Publicación eliminada incorrectamente");
     }
     else{
       echo "Sin cambios\n";
     }


     //header("Location: ../consultar_bbdd.php");

 }
 else {
   header("Location: ../../index.php");
 }
?>
