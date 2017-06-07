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

var aux="seleccion";
var select=obtenerCookie(aux);
if(select!==""){
  $("#Consulta option[value="+ select +"]").attr("selected",true);
  //console.log(select);
  document.getElementById('tipo_consulta').value=select;
  consulta();
}


function consulta(val){
  if(val!=="" || select!==""){

    if(val=="YACIMIENTO" || select=="YACIMIENTO"){

      document.getElementById('consulta_yacimiento').style.display="block";
      document.getElementById('consulta_especie').style.display="none";
      document.getElementById('consulta_excavacion').style.display="none";
      document.getElementById('consulta_publicacion').style.display="none";
      document.getElementById('consulta_deposito').style.display="none";
      if(val===undefined)
        document.getElementById('tipo_consulta').value=select;
      else
        document.getElementById('tipo_consulta').value=val;

    }
    else if(val=="ESPECIE" || select=="ESPECIE"){
      document.getElementById('consulta_yacimiento').style.display="none";
      document.getElementById('consulta_especie').style.display="block";
      document.getElementById('consulta_excavacion').style.display="none";
      document.getElementById('consulta_publicacion').style.display="none";
      document.getElementById('consulta_deposito').style.display="none";
      if(val===undefined)
        document.getElementById('tipo_consulta').value=select;
      else
        document.getElementById('tipo_consulta').value=val;

    }
    else if(val=="EXCAVACIONES" || select=="EXCAVACIONES"){

      document.getElementById('consulta_yacimiento').style.display="none";
      document.getElementById('consulta_especie').style.display="none";
      document.getElementById('consulta_excavacion').style.display="block";
      document.getElementById('consulta_publicacion').style.display="none";
      document.getElementById('consulta_deposito').style.display="none";
      if(val===undefined)
        document.getElementById('tipo_consulta').value=select;
      else
        document.getElementById('tipo_consulta').value=val;

    }
    else if(val=="PUBLICACIONES" || select=="PUBLICACIONES"){

      document.getElementById('consulta_yacimiento').style.display="none";
      document.getElementById('consulta_especie').style.display="none";
      document.getElementById('consulta_excavacion').style.display="none";
      document.getElementById('consulta_publicacion').style.display="block";
      document.getElementById('consulta_deposito').style.display="none";
      if(val===undefined)
        document.getElementById('tipo_consulta').value=select;
      else
        document.getElementById('tipo_consulta').value=val;

    }
    else if (val=="DEPOSITO" || select=="DEPOSITO") {

      document.getElementById('consulta_yacimiento').style.display="none";
      document.getElementById('consulta_especie').style.display="none";
      document.getElementById('consulta_excavacion').style.display="none";
      document.getElementById('consulta_publicacion').style.display="none";
      document.getElementById('consulta_deposito').style.display="block";
      if(val===undefined)
        document.getElementById('tipo_consulta').value=select;
      else
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

  if(consulta=="EXCAVACIONES"){
    document.cookie='consulta='+consulta;
    document.cookie='seleccion='+consulta;

    var responsable= document.getElementById('responsable').value;
    var financiacion=document.getElementById('financiacion').value;
    var yacimiento_excavacion= document.getElementById('yacimiento_excavacion').value;
    var fecha_inicio_ex= document.getElementById('fecha_inicio_ex').value;
    var fecha_final_ex= document.getElementById('fecha_final_ex').value;

    if(responsable!=="")
      document.cookie='responsable='+responsable;
    else
      document.cookie='responsable=';

    if(financiacion!=="")
      document.cookie='financiacion='+financiacion;
    else
      document.cookie='financiacion=';

    if(yacimiento_excavacion!=="")
      document.cookie='yacimiento_excavacion='+yacimiento_excavacion;
    else
      document.cookie='yacimiento_excavacion=';

    if(fecha_inicio_ex!=="")
      document.cookie='fecha_inicio_ex='+fecha_inicio_ex;
    else
      document.cookie='fecha_inicio_ex=';

    if(fecha_final_ex!=="")
      document.cookie='fecha_final_ex='+fecha_final_ex;
    else
      document.cookie='fecha_final_ex=';

    console.log('responsable='+responsable+' financiacion='+financiacion+' yacimiento='+yacimiento_excavacion+' fecha inicio='+fecha_inicio_ex+' fecha fin='+fecha_final_ex);
  }

  else if(consulta=="PUBLICACIONES"){
    document.cookie='consulta='+consulta;
    document.cookie='seleccion='+consulta;

    var titulo= document.getElementById('titulo').value;
    var autor=document.getElementById('autor').value;
    var yacimiento_publicacion= document.getElementById('yacimiento_publicacion').value;
    var fecha_publi_ini= document.getElementById('fecha_publi_ini').value;
    var fecha_publi_fin= document.getElementById('fecha_publi_fin').value;

    if(titulo!=="")
      document.cookie='titulo='+titulo;
    else
      document.cookie='titulo=';

    if(autor!=="")
      document.cookie='autor='+autor;
    else
      document.cookie='autor=';

    if(yacimiento_publicacion!=="")
      document.cookie='yacimiento_publicacion='+yacimiento_publicacion;
    else
      document.cookie='yacimiento_publicacion=';

    if(fecha_publi_ini!=="")
      document.cookie='fecha_publi_ini='+fecha_publi_ini;
    else
      document.cookie='fecha_publi_ini=';

    if(fecha_publi_fin!=="")
      document.cookie='fecha_publi_fin='+fecha_publi_fin;
    else
      document.cookie='fecha_publi_fin=';

    console.log('Titulo='+titulo+' autor='+autor+' yacimiento='+yacimiento_publicacion+' fecha inicio='+fecha_publi_ini+' fecha fin='+fecha_publi_fin);
  }

  else if(consulta=="DEPOSITO"){
    document.cookie='consulta='+consulta;
    document.cookie='seleccion='+consulta;

    var deposito = document.getElementById('deposito').value;
    var pais = document.getElementById('pais').value;

    if(deposito!=="")
      document.cookie='deposito='+deposito;
    else
      document.cookie='deposito=';

    if(pais!=="")
      document.cookie='pais='+pais;
    else
      document.cookie='pais=';

    console.log('Deposito='+deposito+' Pais='+pais);
  }

  else{
    limpiar_cookie();
  }

  window.location='../pages/consultar_bbdd.php';

}



function limpiar_cookie(){
  document.cookie='consulta=;expires=Thu, 01 Jan 1970 00:00:00 UTC';
  document.cookie='seleccion=;expires=Thu, 01 Jan 1970 00:00:00 UTC';


  //cookies de excavaciones
  document.cookie='responsable=;expires=Thu, 01 Jan 1970 00:00:00 UTC';
  document.cookie='financiacion=;expires=Thu, 01 Jan 1970 00:00:00 UTC';
  document.cookie='yacimiento_excavacion=;expires=Thu, 01 Jan 1970 00:00:00 UTC';
  document.cookie='fecha_inicio_ex=;expires=Thu, 01 Jan 1970 00:00:00 UTC';
  document.cookie='fecha_final_ex=;expires=Thu, 01 Jan 1970 00:00:00 UTC';

  //cookies de PUBLICACIONES
  document.cookie='titulo=;expires=Thu, 01 Jan 1970 00:00:00 UTC';
  document.cookie='autor=;expires=Thu, 01 Jan 1970 00:00:00 UTC';
  document.cookie='yacimiento_publicacion=;expires=Thu, 01 Jan 1970 00:00:00 UTC';
  document.cookie='fecha_publi_ini=;expires=Thu, 01 Jan 1970 00:00:00 UTC';
  document.cookie='fecha_publi_fin=;expires=Thu, 01 Jan 1970 00:00:00 UTC';

  //cookies de deposito
  document.cookie='deposito=;expires=Thu, 01 Jan 1970 00:00:00 UTC';
  document.cookie='pais=;expires=Thu, 01 Jan 1970 00:00:00 UTC';

  window.location='../pages/consultar_bbdd.php';
}


function publicacion(val){
  document.getElementById('yacimiento_publicacion').value=val;

}
function excavacion(val){
  document.getElementById('yacimiento_excavacion').value=val;

}

function obtenerCookie(clave) {
    var name = clave + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) === 0) return c.substring(name.length,c.length);
    }
    return "";
}
