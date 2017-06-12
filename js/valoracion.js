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


var aux="yacimiento";
var select=obtenerCookie(aux);
if(select!==""){
  //console.log(select);
  document.getElementById('yacimiento').value=select;
  $('#Yacimientos_Valoracion').find("option[value='"+select+"']").attr("selected",true);
}


function yacimientovaloracion(val){
  document.getElementById('yacimiento').value=val;

}

//valoracion cientifica
function tipofosiles(val){
  document.getElementById('tipo_fosiles').value=val;

}
function diversidadtaxones(val){
  document.getElementById('taxones').value=val;

}

function edadyacimiento(val){
  document.getElementById('edad').value=val;

}

function localidadtipo(val){
  document.getElementById('localidad').value=val;

}

function estadoconservacion(val){
  document.getElementById('conservacionfosiles').value=val;

}

function informaciontafonomica(val){
  document.getElementById('tafonomica').value=val;

}

function infobioestatigrafica(val){
  document.getElementById('bioestatigrafica').value=val;

}

function interesgeologico(val){
  document.getElementById('geologico').value=val;

}

function interespaleoclimatico(val){
  document.getElementById('paleoclimatico').value=val;

}

function valorgeomorfologico(val){
  document.getElementById('geomorfologico').value=val;

}

function abundanciayacimiento(val){
  document.getElementById('abuyacimiento').value=val;

}

function tipoyacimiento(val){
  document.getElementById('tiyacimiento').value=val;

}

function tipodatacion(val){
  document.getElementById('datacion').value=val;

}
function restosarqueologicos(val){
  document.getElementById('arqueologicos').value=val;

}



//situacion socio cultural
function interesdidactico(val){
  document.getElementById('didactico').value=val;

}
function situaciongeografica(val){
  document.getElementById('geografica').value=val;

}
function valorhistorico(val){
  document.getElementById('historico').value=val;

}
function nivelconocimiento(val){
  document.getElementById('conocimiento').value=val;

}
function valorcomplementario(val){
  document.getElementById('valor').value=val;

}
function figuraproteccion(val){
  document.getElementById('proteccion').value=val;

}
//situacion socio economica
function potencialturistico(val){
  document.getElementById('turistico').value=val;

}

//riesgo de deterioro

function fragilidaddeldeposito(val){
  document.getElementById('fragilidad').value=val;

}

function situacionaccesibilidad(val){
  document.getElementById('accesibilidad').value=val;

}

function edificaciones(val){
  document.getElementById('edificacion').value=val;

}
function valorminero(val){
  document.getElementById('cantera').value=val;

}
function viascomunicacion(val){
  document.getElementById('vias').value=val;

}
function vertederos(val){
  document.getElementById('vertedero').value=val;

}
function saqueo(val){
  document.getElementById('comercio').value=val;

}
function erosionnatural(val){
  document.getElementById('erosion').value=val;

}



function consultar(){
  var yacimiento=document.getElementById('yacimiento').value;
  if(yacimiento!=="" && yacimiento!=="NINGUNO")
    document.cookie='yacimiento='+yacimiento;
  else {
    document.cookie='yacimiento=;expires=Thu, 01 Jan 1970 00:00:00 UTC';
  }

  window.location='consultar_valoracion.php';
}
