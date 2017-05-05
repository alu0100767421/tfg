 <?php
  session_start();
  $link = require("../connect_bbdd.php");


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

      if(isset($_POST['coordenada']))
        $coordenada = $_POST['coordenada'];

      if(isset($_POST['edad']))
        $edad = $_POST['edad'];

      if(isset($_POST['altura']))
        $altura = $_POST['altura'];

      if(isset($_POST['tipo_y']))
        $tipo = $_POST['tipo_y'];

      if(isset($_POST['estado_conservacion']))
        $conservacion = $_POST['estado_conservacion'];

      if(isset($_POST['observaciones_y']))
        $observacion = $_POST['observaciones_y'];



      echo "Los datos introducidos son: Isla:$isla Municipio:$municipio Localidad:$localidad
       Yacimiento:$yacimiento Coordenada:$coordenada Edad:$edad
       Altura:$altura Tipo:$tipo Conservacion:$conservacion
       Observacion:$observacion";
    }




  }
  else {
    header("Location: ../../index.php");
  }
?>
