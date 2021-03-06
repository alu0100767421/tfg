d3.select(window).on('resize', resize);


//Creamos unas dimensiones específicas para el mapa
  var viewportWidth = $("#mapa").width();
  var viewportHeight = $("#mapa").height()/2;
  var width = viewportWidth * 0.97;
  var height = width/1.85;
  var escala= width*10;
  console.log(escala);
//Projeccion del mapa
var projection = d3.geo.mercator()
    .scale([escala]) //escala
    .center([-15.747476639999999,28.530921143001386])//para que se centre
    .translate([width/2,height/2]);

//Generate paths based on projection
var path = d3.geo.path().projection(projection);


//Creamos el SVG
var svg = d3.select("article").append("svg")
    .attr("width", width)
    .attr("height", height);



//Grupo de características
var features = svg.append("g")
    .attr("class","features");


var tooltip = d3.select("#mapa").append("div").attr("class","tooltip");


var centered;

d3.json("../mapas/mapa_modificado/recintos_municipales_inspire_canarias_wgs84.geojson",function(error,geodata) {
  if (error) return console.log(error);

  features.selectAll("path")
    .data(geodata.features)
    .enter()
    .append("path")
    .attr("d",path)
    .on("mouseover",showTooltip)
    .on("click",clickar);

  puntos();

});


function puntos() {

  // añadir puntos al svg
   svg.selectAll("circle")
   .data(array_puntos)
   .enter()
   .append("circle")
   .attr("id", function(d){ return d.yacimiento; })
   .attr("class","circulos")
   .attr("r", "4px")
   .attr("stroke","black")
   .attr("fill", "orange")
   .on("mouseover", mostrarYacimiento)
   .on("mouseout", quitarYacimiento)
   .on("click",function(d){
     document.cookie='yacimiento='+d.yacimiento;
     window.location="../pages/mapa.php";
   })
   .attr("transform", function(d) {
    return "translate(" + projection([
      d.longitud,
      d.latitud
    ]) + ")";
    });


}

//funcion que nos da el punto en el eje x donde mostrar el texto de los puntos
function punto_x(){
  var x;
    x = width/2.3;
  return(x);
}
//funcion que nos da el punto en el eje y donde mostrar el texto de los puntos
function punto_y(){
  var y;
    y = height / 5;

  return(y);
}



function mostrarYacimiento(d,e) {
  d3.select(this).attr({
    fill: "white",
    r: "8px",
    stroke: "black"
  });



  var x,y;
  //console.log(x);

  x=punto_x();
  y=punto_y();
  //console.log("x:"+x+"y:"+y);
  // Hay que especificar donde debemos de poner el text punto(x,y) y tambien creamo un id para borrarlo luego
  svg.append("text").attr({
     id: "id"+d.idyacimiento,
     x: function() { return x; },
     y: function() { return y; }
  })
  .attr("font-family","monospace")
  .attr("size","10px")
  .attr("fill","black")
  .text(function(){
    return "YACIMIENTO:"+ d.yacimiento; //este seria el valor del texto
  });
}

function quitarYacimiento(d) {
  d3.select(this).attr({
    fill: "orange",
    r: "4px",
    stroke: "black"
  });
  d3.select("#id"+d.idyacimiento).remove();
}




function resize() {
  svg.selectAll("circle").remove();
  width = parseInt(d3.select('article').style('width'));
  width = $('article').width() * 0.97;
  height = width/1.85;

 projection
    .scale([width*10])
    .center([-15.747476639999999,28.530921143001386])//para que se centre
    .translate([width/2,height/2]);


 d3.select("article").attr("width",width).attr("height",height);
 d3.select("svg").attr("width",width).attr("height",height);

 d3.selectAll("path").attr('d', path);

 puntos();
}

var zoomeando=true;
function clickar(){
  //console.log(projection.invert(d3.mouse(this)));
  var lon= projection.invert(d3.mouse(this))[0];
  //console.log(lon);
  var lat= projection.invert(d3.mouse(this))[1];
  //console.log(lat);
  if (zoomeando) {
    svg.selectAll("circle").remove();
    width = parseInt(d3.select('article').style('width'));
    width = $('article').width() * 0.97;
    height = width/1.85;
    escala= width*70;
   projection
      .scale([escala])
      .center([lon,lat])//para que se centre
      .translate([width/2,height/2]);


   d3.select("article").attr("width",width).attr("height",height);
   d3.select("svg").attr("width",width).attr("height",height);

   d3.selectAll("path").attr('d', path);

   puntos();
   zoomeando=false;
  }

  else {
    svg.selectAll("circle").remove();
    width = parseInt(d3.select('article').style('width'));
    width = $('article').width() * 0.97;
    height = width/1.85;
    escala=width*10;
   projection
      .scale([width*10])
      .center([-15.747476639999999,28.530921143001386])//para que se centre
      .translate([width/2,height/2]);


   d3.select("article").attr("width",width).attr("height",height);
   d3.select("svg").attr("width",width).attr("height",height);

   d3.selectAll("path").attr('d', path);

   puntos();
   zoomeando=true;
  }
}


var municipio_seleccionado;
function showTooltip(d) {

  municipio_seleccionado=d.properties.NAMEUNIT;
  document.getElementById('Municipio').value=municipio_seleccionado;
}
