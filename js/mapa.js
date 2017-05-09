
d3.select(window).on('resize', resize);


//Creamos unas dimensiones específicas para el mapa
  var viewportWidth = $("#mapa").width();
  var viewportHeight = $("#mapa").height()/2;
  var width = viewportWidth * 0.97;
  var height = width/1.85;


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
});


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

    aa = [-16.79612159729004, 28.236800677752584];
  	bb = [-16.718788146972656, 28.229389972499913];

    // add circles to svg
     svg.selectAll("circle")
     .data([aa,bb]).enter()
     .append("circle")
     .attr("cx", function (d) { console.log(projection(d)); return projection(d)[0]; })
     .attr("cy", function (d) { return projection(d)[1]; })
     .attr("r", "3px")
     .attr("fill", "black");
  } else {
    x = width / 2;
    y = height / 2;
    k = 1;
    centered = null;
  }

/*var latitude = -16.79612159729004;
var longitude = 28.236800677752584;
-16.718788146972656,
          28.229389972499913

-16.783504486083984,
28.209121334521924*/



  features.selectAll("path")
      .classed("highlighted",function(d) {
          return d === centered;
      })
      .style("stroke-width", 1 / k + "px");

  features
      //.transition()
      //.duration(500)
      .attr("transform","translate(" + width / 2 + "," + height / 2 + ")scale(" + k + ")translate(" + -x + "," + -y + ")");
}

var tooltipOffset = {x: 5, y: -25};
var municipio_seleccionado;
function showTooltip(d) {

  municipio_seleccionado=d.properties.NAMEUNIT;
  document.getElementById('Municipio').value=municipio_seleccionado;
}
