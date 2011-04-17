var http = require("http"),
    fs	 = require("fs");  
 
// we create a server with automatically binding
// to a server request listener
http.createServer(function(request, response) {
	checkFile(request, response);
}).listen(8124);
 
function checkFile(request, response)
{
	var date = new Date();
	if (date-request.socket._idleStart.getTime() > 59999) {
		response.writeHead(200, {
			'Content-Type'   : 'text/plain',
			'Access-Control-Allow-Origin' : '*'
		});
 
		// return response
		response.write('OK', 'utf8');
		response.end();
	}
 
	// we check the information from the file, especially
	// to know when it was changed for the last time
	fs.stat('/var/www/dev.prgmrbill.com/public_html/sandbox/OnlineUsers/lib/data.txt', function(err, stats) {
		// if the file is changed
		if (stats.mtime.getTime() > request.socket._idleStart.getTime()) {
			// read it
			fs.readFile('filepath', 'utf8', function(err, data) {
				// return the contents
				response.writeHead(200, {
					'Content-Type'   : 'text/plain',
					'Access-Control-Allow-Origin' : '*'
				});
 
				// return response
				response.write(data, 'utf8');
				response.end();
 
				// return
				return false;
			});
		}
	});	
 
	setTimeout(function() { checkFile(request, response) }, 10000);
};