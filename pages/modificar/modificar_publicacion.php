//CONSULTAS SOBRE DEPOSITO
if($consulta=="DEPOSITO"){

  if(isset($_COOKIE['deposito'])){
    $deposito=$_COOKIE['deposito'];
    $deposito=Mayuscula_con_tilde($deposito);
  }
  if(isset($_COOKIE['pais'])){
    $pais=$_COOKIE['pais'];
    $pais= Mayuscula_con_tilde($pais);
  }

  //echo " El deposito es: $deposito";
  //echo " El pais es: $pais";

  //si ha introducio pais y deposito
  if($deposito!="" && $pais!=""){

    $consulta="SELECT *
               FROM deposito
               WHERE deposito='".$deposito."' AND pais='".$pais."';";
    $deposito=pg_query($link,$consulta);
    if(pg_num_rows($deposito)>0){
      //echo "  Éxito de consulta";
      while($resultado=pg_fetch_assoc($deposito)){
        $deposit=$resultado['deposito'];
        $country=$resultado['pais'];
      }
      //echo"$deposit y $country";
      echo"
      <hr>
      <div class='row'>
        <div class='col-lg-2 col-md-4 col-sm-4 col-xs-4 form-group'>
          <h5><b>DEPÓSITO</b></h5>
        </div>
        <div class='col-lg-2 col-md-4 col-sm-4 col-xs-4 form-group'>
          <h5><b>PAÍS</b></h5>
        </div>
      </div>
      <form class='' action='modificar/modificar_deposito.php' method='post'>
        <div class='row'>
          <div class='col-lg-2 col-md-4 col-sm-11 col-xs-10 form-group'>
            <input type='text' class='form-control input_consulta' id='deposito_consultado' name='deposito_consultado' value='$deposit'>
            <input type='hidden' id='' name='deposit' value='$deposit'>
          </div>
          <div class='col-lg-2 col-md-4 col-sm-11 col-xs-10 form-group'>
            <input type='text' class='form-control input_consulta' id='pais_consultado' name='pais_consultado' value='$country'>
            <input type='hidden' id='' name='country' value='$country'>
          </div>
          <div class='col-lg-1 col-md-2 col-xs-3 col-sm-3'>
            <button type='submit' class='btn btn-info' name='modificar'>Modificar</button>
          </div>
          <div class='col-lg-1 col-md-1 col-xs-1 col-sm-1'>
            <button type='submit' class='btn btn-danger' name='eliminar'>Eliminar</button>
          </div>
        </div>
      </form>
      ";
      }
    else{
      echo "
      <hr>
      <div class='row'>
        <div class='col-lg-10 col-md-4 col-sm-4 col-xs-4 form-group'>
          <h5><b>No se ha encontrado datos en esta consulta</b></h5>
        </div>
      </div>
      ";
    }
  }
  //fin si ha introducio pais y deposito

  //if pais y deposito están vacios se hace una consulta de todos
  elseif ($deposito=="" && $pais=="") {
    $consulta="SELECT *
               FROM deposito;";
    $deposito=pg_query($link,$consulta);
    if(pg_num_rows($deposito)>0){
      //echo "  Éxito de consulta";
      echo "
        <hr>
        <div class='row'>
          <div class='col-lg-2 col-md-4 col-sm-4 col-xs-4 form-group'>
            <h5><b>DEPÓSITO</b></h5>
          </div>
          <div class='col-lg-2 col-md-4 col-sm-4 col-xs-4 form-group'>
            <h5><b>PAÍS</b></h5>
          </div>
        </div>
      ";
      $aux=0;

      while($resultado=pg_fetch_assoc($deposito)){
        $deposit=$resultado['deposito'];
        $country=$resultado['pais'];

        //echo "$aux";
        /*$deposit_aux="deposit" . $aux;
        $country_aux="country" .$aux;
        $modificar="modificar" .$aux;
        $eliminar="eliminar" .$aux;*/
        $aux++;
        echo"
         <form class='' action='modificar/modificar_deposito.php' method='post'>
            <div class='row'>
              <div class='col-lg-2 col-md-4 col-sm-11 col-xs-10 form-group'>
                <input type='text' class='form-control input_consulta' id='deposito_consultado' name='deposito_consultado' value='$deposit'>
                <input type='hidden' id='' name='deposit' value='$deposit'>
              </div>
              <div class='col-lg-2 col-md-4 col-sm-11 col-xs-10 form-group'>
                <input type='text' class='form-control input_consulta' id='pais_consultado' name='pais_consultado' value='$country'>
                <input type='hidden' id='' name='country' value='$country'>
              </div>
              <div class='col-lg-1 col-md-2 col-xs-3 col-sm-3'>
                <button type='submit' class='btn btn-info' name='modificar'>Modificar</button>
              </div>
              <div class='col-lg-1 col-md-1 col-xs-1 col-sm-1'>
                <button type='submit' class='btn btn-danger' name='eliminar'>Eliminar</button>
              </div>
            </div>
          </form>
        ";
      }
      //echo"$deposit y $country";
    }
    else{
      echo "
      <hr>
      <div class='row'>
        <div class='col-lg-10 col-md-4 col-sm-4 col-xs-4 form-group'>
          <h5><b>No se ha encontrado datos en esta consulta</b></h5>
        </div>
      </div>
      ";
    }
  }
  //fin de hacer la consulta de todos

  //if pais es vacío
  elseif($pais==""){
    $consulta="SELECT *
               FROM deposito
               WHERE deposito='".$deposito."';";
    $deposito=pg_query($link,$consulta);
    if(pg_num_rows($deposito)>0){
      //echo "  Éxito de consulta";
      while($resultado=pg_fetch_assoc($deposito)){
        $deposit=$resultado['deposito'];
        $country=$resultado['pais'];
      }
      //echo"$deposit y $country";
      echo"
      <hr>
      <div class='row'>
        <div class='col-lg-2 col-md-4 col-sm-4 col-xs-4 form-group'>
          <h5><b>DEPÓSITO</b></h5>
        </div>
        <div class='col-lg-2 col-md-4 col-sm-4 col-xs-4 form-group'>
          <h5><b>PAÍS</b></h5>
        </div>
      </div>
      <form class='' action='modificar/modificar_deposito.php' method='post'>
        <div class='row'>
          <div class='col-lg-2 col-md-4 col-sm-11 col-xs-10 form-group'>
            <input type='text' class='form-control input_consulta' id='deposito_consultado' name='deposito_consultado' value='$deposit'>
            <input type='hidden' id='' name='deposit' value='$deposit'>
          </div>
          <div class='col-lg-2 col-md-4 col-sm-11 col-xs-10 form-group'>
            <input type='text' class='form-control input_consulta' id='pais_consultado' name='pais_consultado' value='$country'>
            <input type='hidden' id='' name='country' value='$country'>
          </div>
          <div class='col-lg-1 col-md-2 col-xs-3 col-sm-3'>
            <button type='submit' class='btn btn-info' name='modificar'>Modificar</button>
          </div>
          <div class='col-lg-1 col-md-1 col-xs-1 col-sm-1'>
            <button type='submit' class='btn btn-danger' name='eliminar'>Eliminar</button>
          </div>
        </div>
      </form>
      ";
    }
    else{
      echo "
      <hr>
      <div class='row'>
        <div class='col-lg-10 col-md-4 col-sm-4 col-xs-4 form-group'>
          <h5><b>No se ha encontrado datos en esta consulta</b></h5>
        </div>
      </div>
      ";
    }
  }
  //fin de si pais es vacio
  elseif ($deposito=="") {
    $consulta="SELECT *
               FROM deposito
               WHERE pais='".$pais."';";
    $deposito=pg_query($link,$consulta);
    if(pg_num_rows($deposito)>0){
      //echo "  Éxito de consulta";
      echo "
        <hr>
        <div class='row'>
          <div class='col-lg-2 col-md-4 col-sm-4 col-xs-4 form-group'>
            <h5><b>DEPÓSITO</b></h5>
          </div>
          <div class='col-lg-2 col-md-4 col-sm-4 col-xs-4 form-group'>
            <h5><b>PAÍS</b></h5>
          </div>
        </div>
      ";
      while($resultado=pg_fetch_assoc($deposito)){
        $deposit=$resultado['deposito'];
        $country=$resultado['pais'];
        echo"
        <form class='' action='modificar/modificar_deposito.php' method='post'>
          <div class='row'>
            <div class='col-lg-2 col-md-4 col-sm-11 col-xs-10 form-group'>
              <input type='text' class='form-control input_consulta' id='deposito_consultado' name='deposito_consultado' value='$deposit'>
              <input type='hidden' id='' name='deposit' value='$deposit'>
            </div>
            <div class='col-lg-2 col-md-4 col-sm-11 col-xs-10 form-group'>
              <input type='text' class='form-control input_consulta' id='pais_consultado' name='pais_consultado' value='$country'>
              <input type='hidden' id='' name='country' value='$country'>
            </div>
            <div class='col-lg-1 col-md-2 col-xs-3 col-sm-3'>
              <button type='submit' class='btn btn-info' name='modificar'>Modificar</button>
            </div>
            <div class='col-lg-1 col-md-1 col-xs-1 col-sm-1'>
              <button type='submit' class='btn btn-danger' name='eliminar'>Eliminar</button>
            </div>
        </div>
        </form>
        ";
      }
      //echo"$deposit y $country";
    }
    else{
      echo "
      <hr>
      <div class='row'>
        <div class='col-lg-10 col-md-4 col-sm-4 col-xs-4 form-group'>
          <h5><b>No se ha encontrado datos en esta consulta</b></h5>
        </div>
      </div>
      ";
    }
  }
  //if no se elige un deposito


}//TERMINA LAS CONSULTAS DE DEPOSITO
