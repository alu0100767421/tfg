<?php
 session_start();
 $link = require("../connect_bbdd.php");

 header("Content-type: text/plain");

 if(isset($_SESSION['nombre'])) {
   $username = $_SESSION['nombre'];

    if(isset($_POST['yacimiento_consulta']))
      $yacimiento = $_POST['yacimiento_consulta'];

    ///////////////////////////datos de valoracion científica///////////////////////////////////////////////
    if(isset($_POST['tipo_fosiles']))
      $tipo_fosiles = $_POST['tipo_fosiles'];
    if($tipo_fosiles==""){
      $tipo_fosiles=0;
    }

    if(isset($_POST['taxones']))
      $taxones = $_POST['taxones'];
    if($taxones==""){
      $taxones=0;
    }

    if(isset($_POST['edad']))
      $edad = $_POST['edad'];
    if($edad==""){
      $edad=0;
    }

    if(isset($_POST['localidad']))
      $localidad = $_POST['localidad'];
    if($localidad==""){
      $localidad=0;
    }

    if(isset($_POST['conservacionfosiles']))
      $conservacionfosiles = $_POST['conservacionfosiles'];
    if($conservacionfosiles==""){
      $conservacionfosiles=0;
    }

    if(isset($_POST['tafonomica']))
      $tafonomica = $_POST['tafonomica'];
    if($tafonomica==""){
      $tafonomica=0;
    }

    if(isset($_POST['bioestatigrafica']))
      $bioestatigrafica = $_POST['bioestatigrafica'];
    if($bioestatigrafica==""){
      $bioestatigrafica=0;
    }

    if(isset($_POST['geologico']))
      $geologico = $_POST['geologico'];
    if($geologico==""){
      $geologico=0;
    }

    if(isset($_POST['paleoclimatico']))
      $paleoclimatico = $_POST['paleoclimatico'];
    if($paleoclimatico==""){
      $paleoclimatico=0;
    }

    if(isset($_POST['geomorfologico']))
      $geomorfologico = $_POST['geomorfologico'];
    if($geomorfologico==""){
      $geomorfologico=0;
    }

    if(isset($_POST['abuyacimiento']))
      $abuyacimiento = $_POST['abuyacimiento'];
    if($abuyacimiento==""){
      $abuyacimiento=0;
    }

    if(isset($_POST['tiyacimiento']))
      $tiyacimiento = $_POST['tiyacimiento'];
    if($tiyacimiento==""){
      $tiyacimiento=0;
    }

    if(isset($_POST['datacion']))
      $datacion = $_POST['datacion'];
    if($datacion==""){
      $datacion=0;
    }

    if(isset($_POST['arqueologicos']))
      $arqueologicos = $_POST['arqueologicos'];
    if($arqueologicos==""){
      $arqueologicos=0;
    }

//////////////////////////////////situacion SOCIOCULTURAL////////////////////////////////////
    if(isset($_POST['didactico']))
      $didactico = $_POST['didactico'];
    if($didactico==""){
      $didactico=0;
    }

    if(isset($_POST['geografica']))
      $geografica = $_POST['geografica'];
    if($geografica==""){
      $geografica=0;
    }

    if(isset($_POST['historico']))
      $historico = $_POST['historico'];
    if($historico==""){
      $historico=0;
    }

    if(isset($_POST['conocimiento']))
      $conocimiento = $_POST['conocimiento'];
    if($conocimiento==""){
      $conocimiento=0;
    }

    if(isset($_POST['valor']))
      $valor = $_POST['valor'];
    if($valor==""){
      $valor=0;
    }

    if(isset($_POST['proteccion']))
      $proteccion = $_POST['proteccion'];
    if($proteccion==""){
      $proteccion=0;
    }

//////////////////////////////////situacion SOCIOECONOMICA////////////////////////////////////

    if(isset($_POST['turistico']))
      $turistico = $_POST['turistico'];
    if($turistico==""){
      $turistico=0;
    }


    //////////////////////////////////riesgo de deterioro////////////////////////////////////

    if(isset($_POST['fragilidad']))
      $fragilidad = $_POST['fragilidad'];
    if($fragilidad==""){
      $fragilidad=0;
    }

    if(isset($_POST['accesibilidad']))
      $accesibilidad = $_POST['accesibilidad'];
    if($accesibilidad==""){
      $accesibilidad=0;
    }

    if(isset($_POST['edificacion']))
      $edificacion = $_POST['edificacion'];
    if($edificacion==""){
      $edificacion=0;
    }

    if(isset($_POST['cantera']))
      $cantera = $_POST['cantera'];
    if($cantera==""){
      $cantera=0;
    }

    if(isset($_POST['vias']))
      $vias = $_POST['vias'];
    if($vias==""){
      $vias=0;
    }

    if(isset($_POST['vertedero']))
      $vertedero = $_POST['vertedero'];
      echo "tu madre $vertedero";
    if($vertedero==""){
      $vertedero=0;

    }

    if(isset($_POST['comercio']))
      $comercio = $_POST['comercio'];
    if($comercio==""){
      $comercio=0;
    }

    if(isset($_POST['erosion']))
      $erosion = $_POST['erosion'];
    if($erosion==""){
      $erosion=0;
    }










    $total_cientifico= $tipo_fosiles*1 + $taxones*1 + $edad*1 + $localidad*1 + $conservacionfosiles*1 + $tafonomica*1 +
                      $bioestatigrafica*1 + $geologico*1 + $paleoclimatico*1 + $geomorfologico*1 + $abuyacimiento*1 +
                      $tiyacimiento*1 + $datacion*1 + $arqueologicos*1;

    $total_sociocultural= $didactico*1 + $geografica*1 + $historico*1 + $conocimiento*1 + $valor*1 + $proteccion*1;


    $total_socioeconomico= $turistico*1;

    $total_riesgo= $fragilidad*1 + $accesibilidad*1 + $edificacion*1 + $cantera*1 + $vias*1 + $vertedero*1 +
                  $comercio*1 + $erosion*1;



    $total= $total_cientifico*1 + $total_sociocultural*1 + $total_socioeconomico*1 + $total_riesgo*1;








    echo "
    Los datos introducidos son:
    Yacimiento: $yacimiento
    !!!!!!!!!!!!!!!!!!VALORACION CIENTIFICA!!!!!!!!!!!!!!!
    tipo fosiles: $tipo_fosiles
    taxones: $taxones
    edad: $edad
    localidad: $localidad
    conservacion fosiles: $conservacionfosiles
    tafonomica: $tafonomica
    bioestatigrafica: $bioestatigrafica
    geologico: $geologico
    paleoclimatico: $paleoclimatico
    geomorfologico:$geomorfologico
    abuyacimiento:$abuyacimiento
    tiyacimiento:$tiyacimiento
    datacion:$datacion
    arqueologicos:$arqueologicos
    total: $total_cientifico

    !!!!!!!!!!!!!!!!!!VALORACION SOCIOCULTURAL!!!!!!!!!!!!!!!
    didactico:$didactico
    geografica:$geografica
    historico:$historico
    conocimiento:$conocimiento
    valor:$valor
    proteccion:$proteccion
    total: $total_sociocultural

    !!!!!!!!!!!!!!!!!!VALORACION SOCIOECONOMICA!!!!!!!!!!!!!!!
    turistico: $turistico
    total: $total_socioeconomico

    !!!!!!!!!!!!!!!!!!RIESGO DE DETERIORO!!!!!!!!!!!!!!!
    fragilidad:$fragilidad
    accesibilidad:$accesibilidad
    edificacion:$edificacion
    cantera:$cantera
    vias:$vias
    vertedero:$vertedero
    comercio:$comercio
    erosion:$erosion
    total:$total_riesgo

    TOTAL: $total
    \n";

    if($yacimiento!=""){
      $consulta_id="SELECT idyacimiento
                    FROM yacimiento
                    WHERE yacimiento='".$yacimiento."';";
      $id=pg_query($link,$consulta_id);
      echo pg_last_error();
      $valor_id=pg_fetch_assoc($id);
      $id_yacimiento=$valor_id['idyacimiento'];

      $consulta_id="SELECT idvaloracion
                    FROM valoracion
                    WHERE idyacimiento='".$id_yacimiento."';";
      $id=pg_query($link,$consulta_id);
      echo pg_last_error();
      $valor_id=pg_fetch_assoc($id);
      $id_valoracion=$valor_id['idvaloracion'];

      echo "id del yacimiento: $id_yacimiento\n";
      echo "id de la valoracion: $id_valoracion\n";

      $comprobacion="SELECT *
                     FROM valoracion_cientifica
                     WHERE idvaloracion='".$id_valoracion."'";
      $comprobar=pg_query($link,$comprobacion);
      if(pg_num_rows($comprobar)>0){
        $insertar_cientifico="UPDATE valoracion_cientifica
                              SET tipo_fosiles='".$tipo_fosiles."',diversidad_taxones='".$taxones."',edad_yacimiento='".$edad."',
                              localidad_tipo='".$localidad."',estado_conservacion_fosiles='".$conservacionfosiles."',informacion_tafonomica='".$tafonomica."',
                              informacion_bioestratigrafica='".$bioestatigrafica."',interes_geologico='".$geologico."',
                              interes_paleoclimatico='".$paleoclimatico."',valor_geomorfologico='".$geomorfologico."',abundancia_yacimientos='".$abuyacimiento."',
                              tipo_yacimientos='".$tiyacimiento."',tipo_datacion='".$datacion."',asociacion_restos_arqueologicos='".$arqueologicos."'
                              WHERE idvaloracion='".$id_valoracion."';";

        pg_query($link,$insertar_cientifico);
        echo pg_last_error();

        $insertar_cultural="UPDATE valoracion_socio_cultural
                            SET interes_didactico='".$didactico."',situacion_geografica='".$geografica."',
                            valor_historico='".$historico."',nivel_conocimiento='".$conocimiento."',valor_complementario='".$valor."',figura_proteccion='".$proteccion."'
                            WHERE idvaloracion='".$id_valoracion."';";

        pg_query($link,$insertar_cultural);
        echo pg_last_error();

        $insertar_economico="UPDATE valoracion_socio_economica
                             SET potencial_turistico='".$turistico."'
                             WHERE idvaloracion='".$id_valoracion."';";

        pg_query($link,$insertar_economico);
        echo pg_last_error();

        $insertat_riesgo="UPDATE riesgo_deterioro
                          SET fragilidad_deposito='".$fragilidad."',situacion_geografica='".$accesibilidad."',edificaciones='".$edificacion."',
                          valor_minero='".$cantera."',vias_comunicacion='".$vias."',vertederos='".$vertedero."',coleccionismo='".$comercio."',erosion_natural='".$erosion."'
                          WHERE idvaloracion='".$id_valoracion."';";

        pg_query($link,$insertat_riesgo);
        echo pg_last_error();


        $insertar_valoracion="UPDATE valoracion
                              SET valor='".$total."'
                              WHERE idvaloracion='".$id_valoracion."';";


        pg_query($link,$insertar_valoracion);
        echo pg_last_error();
      }






    }


    header("Location: consultar_valoracion.php");

 }
 else {
   header("Location: ../../index.php");
 }
?>
