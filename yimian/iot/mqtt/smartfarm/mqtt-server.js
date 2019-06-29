const mosca = require('mosca');
const mysql = require('mysql');
const fs = require('fs');

var settings = {
    port: 30032
};

var server = new mosca.Server(settings);

var connection = mysql.createConnection({     
  host     : 'cn.db.yimian.xyz',       
  user     : 'smartfarm',              
  password : fs.readFileSync("smartfarm.db.key").toString().replace(/\s+/g,""),
  port: '3306',                   
  database: 'smartfarm' 
}); 

connection.connect();
 


server.on('published', function (packet, client) {
    switch (packet.topic) {
        case 'res/node0/status':
            console.log(packet.payload.toString());
            break;

    }
});

var node0PackageCache = {
    status: null,
    batteryLevel: null,
    waterSwitch: null,
    temperature: null,
    humidity: null,
    BeginTime: null,
    EndTime: null,
}



var node0Package = function(t, s){

    if(node0PackageCache.every(function(r){
	
	return !r;
    })) console.log('sss');
}();

var sql = 'SELECT * FROM api';

connection.query(sql,function (err, result) {
        if(err){
          console.log('[SELECT ERROR] - ',err.message);
          return;
        }
    console.log(result);
});


