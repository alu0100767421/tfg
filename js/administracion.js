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

}

function especie(val){
  document.getElementById('yacimiento_especie').value=val;

}

function deposito(val){

    document.getElementById('deposito_especie').value=val;

}
