d3.select(window).on('resize', resize);


//Creamos unas dimensiones específicas para el mapa
  var viewportWidth = $("#mapa").width();
  var viewportHeight = $("#mapa").height()/2;
  var width = viewportWidth * 0.97;
  var height = width/1.85;

  var escala=width*10;
//Projeccion del mapa
var projection = d3.geo.mercator()
    .scale([width*10]) //escala
    .center([-15.747476639999999,28.530921143001386])//para que se centre
    .translate([width/2,height/2]);

//Generate paths based on projection
var path = d3.geo.path().projection(projection);


//Creamos el SVG
var svg = d3.select("#mapa").append("svg")
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
    .on("click",clicked);

  puntos();

});


function puntos() {

  // add circles to svg
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
    x = width / 2;
  return(x);
}
//funcion que nos da el punto en el eje y donde mostrar el texto de los puntos
function punto_y(){
  var y;
    y = height / 2;
  return(y);
}



function mostrarYacimiento(d) {
  d3.select(this).attr({
    fill: "white",
    r: "8px",
    stroke: "black"
  });
  var puntox=punto_x();
  var puntoy=punto_y();
  //console.log("x:"+puntox+"y:"+puntoy);
  // Hay que especificar donde debemos de poner el text punto(x,y) y tambien creamo un id para borrarlo luego
  svg.append("text").attr({
     id: "id"+d.idyacimiento,
     x: function() { return puntox; },
     y: function() { return puntoy; }
  })
  .attr("font-family","monospace")
  .attr("size","10px")
  .attr("fill","black")
  .text(function(){
    return d.yacimiento; //este seri el valor del texto
  });
}

function quitarYacimiento(d) {
  // Use D3 to select element, change color back to normal
  d3.select(this).attr({
    fill: "red",
    r: "4px",
    stroke: "black"
  });

  // Select text by id and then remove
  d3.select("#id"+d.idyacimiento).remove();  // Remove text location
}

function puntos_zoom() {
  /*aa = [-16.79612159729004, 28.236800677752584];
  bb = [-16.718788146972656, 28.229389972499913];

  svg.selectAll("circle")
  .data([aa,bb,cc]).enter()
  .append("circle")
  .attr("cx", function (d) { console.log(projection(d)); return projection(d)[0]; })
  .attr("cy", function (d) { return projection(d)[1]; })
  .attr("r", "3px")
  .attr("fill", "orange");*/
  var municipio= document.getElementById('Municipio').value;

  // add circles to svg

   /*svg.selectAll("circle")
   .data(place)
   .enter()
   .append("circle")
   .attr("r", "3px")
   .attr("fill", "orange")
   .attr("transform", function(d) {
    return "translate(" + projection([
      d.location.longitude,
      d.location.latitude
    ]) + ")";
  });*/
}


function resize() {


  var viewportWidth = $("#mapa").width();
  var viewportHeight = $("#mapa").height()/2;
  var width = viewportWidth * 0.97;
  var height = width/1.85;

   projection
    	.scale([width*10])
      .center([-15.747476639999999,28.530921143001386]) //projection center
   		.translate([width/2,height*2]);


   d3.select("#mapa").attr("width",width).attr("height",height);
   d3.select("svg").attr("width",width).attr("height",height);

   d3.selectAll("path").attr('d', path);
}

// Zoom al clickar
function clicked(d,i) {

  var x, y, k;

  if (d && centered !== d) {
    var centroid = path.centroid(d);
    var b = path.bounds(d);
    x = centroid[0];
    y = centroid[1];
    k = 0.8 / Math.max((b[1][0] - b[0][0]) / width, (b[1][1] - b[0][1]) / height);
    centered = d;

  } else {
    x = width / 2;
    y = height / 2;
    k = 1;
    centered = null;
  }



  features.selectAll("path")
      .classed("highlighted",function(d) {
          return d === centered;
      })
      .style("stroke-width", 1 / k + "px");



  //svg.selectAll("circle").remove();


  features
      .attr("transform","translate(" + width / 2 + "," + height / 2 + ")scale(" + k + ")translate(" + -x + "," + -y + ")");

  if(k!=1){
    svg.selectAll("circle").remove();
    document.getElementById('Municipio').value=municipio_seleccionado;
    puntos_zoom();
    console.log("k="+k);
    console.log("x="+x);
    console.log("y="+y);
    console.log("escala="+escala);
    console.log("width="+ width);
    console.log("height="+ height);
  }
  else{
    puntos();
    console.log("k="+k);
    console.log("x="+x);
    console.log("y="+y);
    console.log("escala="+escala);
    console.log("width="+ width);
    console.log("height="+ height);
    console.log("\n");
  }


}


var municipio_seleccionado;
function showTooltip(d) {

  municipio_seleccionado=d.properties.NAMEUNIT;
  document.getElementById('Municipio').value=municipio_seleccionado;
}
