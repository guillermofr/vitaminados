console.log('Iniciado...');

var io = require('socket.io').listen(8080);

io.sockets.on('connection', function (socket) {
  console.log("funciona");
});