
  $("#add").hover(function(){
      document.getElementById('submenu').style.display="block";
  },function(){
    document.getElementById('submenu').style.display="none";
  });

  $("#valoracion").hover(function(){
      document.getElementById('submenu_valoracion').style.display="block";
  },function(){
    document.getElementById('submenu_valoracion').style.display="none";
  });


  $(document).ready(function() {
      setTimeout(function() {
          $("#mostrar_mensaje_ok").fadeOut(1500);
      },3000);
      setTimeout(function() {
          $("#mostrar_mensaje_error").fadeOut(1500);
      },4000);
  });
