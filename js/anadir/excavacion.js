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


function excavacion(val){
  document.getElementById('yacimiento_excavacion').value=val;

}

function deposito(val){
    document.getElementById('deposito_excavacion').value=val;

}
