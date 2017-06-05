$(document).ready(function(){
  $('#data-container input').datepicker({
    todayBtn: true,
    language: "es",
    format: "yyyy-mm-dd",
    autoclose: true,
    clearBtn: true,
    todayHighlight: true
  });
});

console.log('hola');

function consulta(val){
  if(val!==""){
    if(val=="YACIMIENTO"){
      document.getElementById('consulta_yacimiento').style.display="block";
      document.getElementById('consulta_especie').style.display="none";
      document.getElementById('consulta_excavacion').style.display="none";
      document.getElementById('consulta_publicacion').style.display="none";
      document.getElementById('consulta_deposito').style.display="none";
      document.getElementById('tipo_consulta').value=val;

    }
    else if(val=="ESPECIE"){
      document.getElementById('consulta_yacimiento').style.display="none";
      document.getElementById('consulta_especie').style.display="block";
      document.getElementById('consulta_excavacion').style.display="none";
      document.getElementById('consulta_publicacion').style.display="none";
      document.getElementById('consulta_deposito').style.display="none";
      document.getElementById('tipo_consulta').value=val;

    }
    else if(val=="EXCAVACIONES"){
      document.getElementById('consulta_yacimiento').style.display="none";
      document.getElementById('consulta_especie').style.display="none";
      document.getElementById('consulta_excavacion').style.display="block";
      document.getElementById('consulta_publicacion').style.display="none";
      document.getElementById('consulta_deposito').style.display="none";
      document.getElementById('tipo_consulta').value=val;

    }
    else if(val=="PUBLICACIONES"){
      document.getElementById('consulta_yacimiento').style.display="none";
      document.getElementById('consulta_especie').style.display="none";
      document.getElementById('consulta_excavacion').style.display="none";
      document.getElementById('consulta_publicacion').style.display="block";
      document.getElementById('consulta_deposito').style.display="none";
      document.getElementById('tipo_consulta').value=val;

    }
    else if (val=="DEPOSITO") {
      document.getElementById('consulta_yacimiento').style.display="none";
      document.getElementById('consulta_especie').style.display="none";
      document.getElementById('consulta_excavacion').style.display="none";
      document.getElementById('consulta_publicacion').style.display="none";
      document.getElementById('consulta_deposito').style.display="block";
      document.getElementById('tipo_consulta').value=val;

    }
    else{
      document.getElementById('consulta_yacimiento').style.display="none";
      document.getElementById('consulta_especie').style.display="none";
      document.getElementById('consulta_excavacion').style.display="none";
      document.getElementById('consulta_publicacion').style.display="none";
      document.getElementById('consulta_deposito').style.display="none";
      document.getElementById('tipo_consulta').value=val;

    }
  }
}


function isla(val) {
  if(val=="LA PALMA"){
    document.getElementById('municipiosvacio').style.display="none";
    document.getElementById('municipioslapalma').style.display="block";
    document.getElementById('municipioslagomera').style.display="none";
    document.getElementById('municipioselhierro').style.display="none";
    document.getElementById('municipiostenerife').style.display="none";
    document.getElementById('municipiosgrancanaria').style.display="none";
    document.getElementById('municipiosfuerteventura').style.display="none";
    document.getElementById('municipioslanzarote').style.display="none";
    document.getElementById('isla_seleccionada').value=val;
  }

  if(val=="LA GOMERA"){
    document.getElementById('municipiosvacio').style.display="none";
    document.getElementById('municipioslapalma').style.display="none";
    document.getElementById('municipioslagomera').style.display="block";
    document.getElementById('municipioselhierro').style.display="none";
    document.getElementById('municipiostenerife').style.display="none";
    document.getElementById('municipiosgrancanaria').style.display="none";
    document.getElementById('municipiosfuerteventura').style.display="none";
    document.getElementById('municipioslanzarote').style.display="none";
    document.getElementById('isla_seleccionada').value=val;
  }

  if(val=="EL HIERRO"){
    document.getElementById('municipiosvacio').style.display="none";
    document.getElementById('municipioslagomera').style.display="none";
    document.getElementById('municipioslapalma').style.display="none";
    document.getElementById('municipioselhierro').style.display="block";
    document.getElementById('municipiostenerife').style.display="none";
    document.getElementById('municipiosgrancanaria').style.display="none";
    document.getElementById('municipiosfuerteventura').style.display="none";
    document.getElementById('municipioslanzarote').style.display="none";
    document.getElementById('isla_seleccionada').value=val;
  }

  if(val=="TENERIFE"){
    document.getElementById('municipiosvacio').style.display="none";
    document.getElementById('municipioslagomera').style.display="none";
    document.getElementById('municipioslapalma').style.display="none";
    document.getElementById('municipioselhierro').style.display="none";
    document.getElementById('municipiostenerife').style.display="block";
    document.getElementById('municipiosgrancanaria').style.display="none";
    document.getElementById('municipiosfuerteventura').style.display="none";
    document.getElementById('municipioslanzarote').style.display="none";
    document.getElementById('isla_seleccionada').value=val;
  }
  if(val=="GRAN CANARIA"){
    document.getElementById('municipiosvacio').style.display="none";
    document.getElementById('municipioslagomera').style.display="none";
    document.getElementById('municipioslapalma').style.display="none";
    document.getElementById('municipioselhierro').style.display="none";
    document.getElementById('municipiostenerife').style.display="none";
    document.getElementById('municipiosgrancanaria').style.display="block";
    document.getElementById('municipiosfuerteventura').style.display="none";
    document.getElementById('municipioslanzarote').style.display="none";
    document.getElementById('isla_seleccionada').value=val;
  }
  if(val=="FUERTEVENTURA"){
    document.getElementById('municipiosvacio').style.display="none";
    document.getElementById('municipioslagomera').style.display="none";
    document.getElementById('municipioslapalma').style.display="none";
    document.getElementById('municipioselhierro').style.display="none";
    document.getElementById('municipiostenerife').style.display="none";
    document.getElementById('municipiosgrancanaria').style.display="none";
    document.getElementById('municipiosfuerteventura').style.display="block";
    document.getElementById('municipioslanzarote').style.display="none";
    document.getElementById('isla_seleccionada').value=val;
  }

  if(val=="LANZAROTE"){
    document.getElementById('municipiosvacio').style.display="none";
    document.getElementById('municipioslagomera').style.display="none";
    document.getElementById('municipioslapalma').style.display="none";
    document.getElementById('municipioselhierro').style.display="none";
    document.getElementById('municipiostenerife').style.display="none";
    document.getElementById('municipiosgrancanaria').style.display="none";
    document.getElementById('municipiosfuerteventura').style.display="none";
    document.getElementById('municipioslanzarote').style.display="block";
    document.getElementById('isla_seleccionada').value=val;
  }

}

function municipio(val){
  document.getElementById('municipio_seleccionado').value=val;
  if(val!==""){
    document.getElementById('localidad').style.display="block";
    document.getElementById('nombre_yacimiento').style.display="block";
    document.getElementById('coordenada').style.display="block";
    document.getElementById('edad').style.display="block";
    document.getElementById('altura').style.display="block";
    document.getElementById('tipo_y').style.display="block";
    document.getElementById('estado_conservacion').style.display="block";
    document.getElementById('observaciones_y').style.display="block";
  }
  else{
    document.getElementById('localidad').style.display="none";
    document.getElementById('nombre_yacimiento').style.display="none";
    document.getElementById('coordenada').style.display="none";
    document.getElementById('edad').style.display="none";
    document.getElementById('altura').style.display="none";
    document.getElementById('tipo_y').style.display="none";
    document.getElementById('estado_conservacion').style.display="none";
    document.getElementById('observaciones_y').style.display="none";
  }
}


function consultas(){
  var consulta = document.getElementById('tipo_consulta').value;
  console.log('Consulta:'+consulta);
  //comprobamos si se ha introducido algún tipo de consulta a realizar
  //en todos los casos, se asigna a la cookie 'consulta' el tipo de consulta elegido
  //luego creacremos nuevas cookies con las opciones elegidas en casa caso para hacer las consultas

  if(consulta=="DEPOSITO"){
    document.cookie='consulta='+consulta;

    var deposito = document.getElementById('deposito').value;
    var pais = document.getElementById('pais').value;

    if(deposito!=="")
      document.cookie='deposito='+deposito;
    else
      document.cookie='deposito=""';

    if(pais!=="")
      document.cookie='pais='+pais;
    else
      document.cookie='pais=""';

    console.log('Deposito='+deposito+' Pais='+pais);
  }

  else{
    document.cookie='consulta=;expires=Thu, 01 Jan 1970 00:00:00 UTC';



    //cookies de deposito
    document.cookie='deposito=;expires=Thu, 01 Jan 1970 00:00:00 UTC';
    document.cookie='pais=;expires=Thu, 01 Jan 1970 00:00:00 UTC';
  }

  window.location='../pages/consultar_bbdd.php';

}

function limpiar_cookie(){
  document.cookie='consulta=;expires=Thu, 01 Jan 1970 00:00:00 UTC';




  //cookies de deposito
  document.cookie='deposito=;expires=Thu, 01 Jan 1970 00:00:00 UTC';
  document.cookie='pais=;expires=Thu, 01 Jan 1970 00:00:00 UTC';

  window.location='../pages/consultar_bbdd.php';
}
