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

function publicacion(val){
  document.getElementById('yacimiento_publicacion').value=val;

}
