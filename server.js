var express = require("express");
var port = process.env.PORT || 8080;
var path = require("path");

var app = express();

app.set(port);

app.use(express.static(__dirname ));

app.get('/', function(req, res) {
    res.sendFile(path.join(__dirname + '/html/index.html'));
});


app.listen(port, function ()
 {
   console.log("Escuchando por el puerto "+ port);
});
