var http = require("http"), 
    io = require('socket.io/socket.io.js'),
 
// we create a server with automatically binding
// to a server request listener
server = http.createServer(function(request, response) {
	// your normal server code
    res.writeHead(200, {'Content-Type': 'text/html'});
    res.end('<h1>Hello world</h1>');
});
 
// socket.io, I choose you
var socket = io.listen(server);

socket.on('connection', function(client){
  // new client is here!
  client.on('message', function(){ 
    console.log('someone is here'); 
  });
  
  client.on('disconnect', function(){ 
    console.log('someone left.'); 
  })
});