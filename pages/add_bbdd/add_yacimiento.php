 <?php
  session_start();
  $link = require("../connect_bbdd.php");

  header('Content-type: text/plain');
  if(isset($_SESSION['nombre'])) {
    $username = $_SESSION['nombre'];

    //si se escoge una isla se va a introducir un yacimiento
    if(isset($_POST['isla_seleccionada'])){
      $isla = $_POST['isla_seleccionada'];

      if(isset($_POST['municipio_seleccionado']))
        $municipio = $_POST['municipio_seleccionado'];

      if(isset($_POST['localidad']))
        $localidad = $_POST['localidad'];

      if(isset($_POST['nombre_yacimiento']))
        $yacimiento = $_POST['nombre_yacimiento'];

      if(isset($_POST['latitud']))
        $latitud = $_POST['latitud'];
        if($latitud=="")
          $latitud='0';

      if(isset($_POST['longitud']))
        $longitud = $_POST['longitud'];
        if($longitud=="")
          $longitud='0';

      if(isset($_POST['edad']))
        $edad = $_POST['edad'];
        /*if($edad=="")
          $edad=NULL;*/

      if(isset($_POST['altura']))
        $altura = $_POST['altura'];
        if($altura=="")
          $altura='-1';

      if(isset($_POST['tipo_y']))
        $tipo = $_POST['tipo_y'];
        /*if($tipo=="")
          $tipo=NULL;*/

      if(isset($_POST['observaciones_y']))
        $observacion = $_POST['observaciones_y'];
        /*if($observacion=="")
          $observacion=NULL;*/



      echo "
       Los datos introducidos son:
       Isla:$isla
       Municipio:$municipio
       Localidad:$localidad
       Yacimiento:$yacimiento
       latitud:$latitud
       longitud:$longitud
       Edad:$edad
       Altura:$altura
       Tipo:$tipo
       Observacion:$observacion \r\n";
    }

    if($yacimiento!=""){
      //insertamos el yacimiento en la tabla
      $insertar_yacimiento="INSERT INTO yacimiento(yacimiento,edad,altura,tipo_yacimiento,observacion_yacimiento)
                            VALUES('".$yacimiento."','".$edad."','".$altura."','".$tipo."','".$observacion."');";

      pg_query($link,$insertar_yacimiento);
      echo pg_last_error();


      //if hay una ubicacion
      if($isla!="" && $municipio!="" && $localidad!=""){
        //hayamos el id del yacimiento
        $consulta_id="SELECT idyacimiento
                      FROM yacimiento
                      WHERE yacimiento='".$yacimiento."';";
        $id_y=pg_query($link,$consulta_id);
        $valor_id_y=pg_fetch_assoc($id_y);
        $id=$valor_id_y['idyacimiento'];
        echo "id del yacimiento $id";

        $insertar_ubicacion="INSERT INTO ubicacion(yacimiento_idyacimiento,isla,municipio,localidad,latitud,longitud)
                             VALUES('".$id."','".$isla."','".$municipio."','".$localidad."','".$latitud."','".$longitud."');";
        pg_query($link,$insertar_ubicacion);
        echo pg_last_error();
      }
      else{
        echo "le ha faltado algún dato de ubicacion por especificar\n";
      }

    }
    else{
      echo "No ha introducido ningun nombre al yacimiento\n";
    }


    header("Location: ../anadir/yacimiento.php");
  }
  else {
    header("Location: ../../index.php");
  }
?>
