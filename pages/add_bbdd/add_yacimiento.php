 <?php
  session_start();
  $link = require("../connect_bbdd.php");

  header('Content-type: text/plain');
  if(isset($_SESSION['nombre'])) {
    $username = $_SESSION['nombre'];

    function Mayuscula_con_tilde($aux) {
      $aux = strtr(strtoupper($aux),"àèìòùáéíóúçñäëïöü","ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ");
      return $aux;
    }

    //si se escoge una isla se va a introducir un yacimiento
    if(isset($_POST['isla_seleccionada'])){
      $isla = $_POST['isla_seleccionada'];
      if($isla=="")
        $isla="DESCONOCIDO";

      if(isset($_POST['municipio_seleccionado']))
        $municipio = $_POST['municipio_seleccionado'];
        if($municipio=="")
          $municipio="DESCONOCIDO";

      if(isset($_POST['localidad']))
        $localidad = $_POST['localidad'];
        if($localidad!="")
          $localidad= Mayuscula_con_tilde($localidad);
        else
          $localidad="DESCONOCIDO";

      if(isset($_POST['nombre_yacimiento']))
        $yacimiento = $_POST['nombre_yacimiento'];
        if($yacimiento!="")
          $yacimiento=Mayuscula_con_tilde($yacimiento);

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
        if($edad!="")
          $edad=Mayuscula_con_tilde($edad);
        else {
          $edad="DESCONOCIDO";
        }

      if(isset($_POST['altura']))
        $altura = $_POST['altura'];
        if($altura=="")
          $altura='-999';

      if(isset($_POST['tipo_y']))
        $tipo = $_POST['tipo_y'];
        if($tipo!="")
          $tipo=Mayuscula_con_tilde($tipo);
        else {
          $tipo="DESCONOCIDO";
        }

      if(isset($_POST['observaciones_y']))
        $observacion = $_POST['observaciones_y'];
        if($observacion!="")
          $observacion=Mayuscula_con_tilde($observacion);
        else {
          $observacion="SIN OBSERVACIÓN";
        }



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
      //hayamos el id del yacimiento
      $consulta_id="SELECT idyacimiento
                    FROM yacimiento
                    WHERE yacimiento='".$yacimiento."';";
      $id_y=pg_query($link,$consulta_id);
      $valor_id_y=pg_fetch_assoc($id_y);
      $id=$valor_id_y['idyacimiento'];
      echo "id del yacimiento $id";

      $insertar_ubicacion="INSERT INTO ubicacion(idyacimiento,isla,municipio,localidad,latitud,longitud)
                           VALUES('".$id."','".$isla."','".$municipio."','".$localidad."','".$latitud."','".$longitud."');";
      pg_query($link,$insertar_ubicacion);
      echo pg_last_error();

      $insertar_valor="INSERT INTO valoracion(idyacimiento,valor)
                       VALUES('".$id."',0);";
      pg_query($link,$insertar_valor);
      echo pg_last_error();


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
