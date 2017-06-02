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

      if(isset($_POST['longitud']))
        $longitud = $_POST['longitud'];https://www.youtube.com/watch?v=VkB-tsWI1Ls&t=16s

      if(isset($_POST['edad']))
        $edad = $_POST['edad'];

      if(isset($_POST['altura']))
        $altura = $_POST['altura'];

      if(isset($_POST['tipo_y']))
        $tipo = $_POST['tipo_y'];

      if(isset($_POST['observaciones_y']))
        $observacion = $_POST['observaciones_y'];



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


    $insertar_yacimiento="INSERT INTO yacimiento(yacimiento,edad,altura,tipo_yacimiento,observacion_yacimiento)
                          VALUES('".$yacimiento."','".$edad."','".$altura."','".$tipo."','".$observacion."');";

    pg_query($link,$insertar_yacimiento);
    echo pg_last_error();

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
    header("Location: ../add_bbdd.php");
  }
  else {
    header("Location: ../../index.php");
  }
?>
