const mosca = require('mosca');

var settings = {
    port: 30032
};

var server = new mosca.Server(settings);

//server.on();
