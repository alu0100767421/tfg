var express = require("express");
var port = process.env.PORT || 8080;


var app = express();

app.set(port);
app.use(express.static(__dirname + '/html/'));

app.get('/', function(request, response){
  response.sendFile('mapa.html');
});



app.listen(port, function ()
 {
   console.log("Escuchando por el puerto "+ port)
})
