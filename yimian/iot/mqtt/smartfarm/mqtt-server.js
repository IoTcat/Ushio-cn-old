const mosca = require('mosca');
const mysql = require('mysql');
const fs = require('fs');


var g_MaxWaitTime = 10000

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
            //console.log(packet.payload.toString());
            pushElement('status', packet.payload.toString(), node0Cache, storeNode0Data);
            break;
        case 'res/node0/batteryLevel':
            //console.log(packet.payload.toString());
            pushElement('batteryLevel', packet.payload.toString(), node0Cache, storeNode0Data);
            break;
        case 'res/node0/waterSwitch':
            //console.log(packet.payload.toString());
            pushElement('waterSwitch', packet.payload.toString(), node0Cache, storeNode0Data);
            break;

        case 'res/node0/temperature':
            //console.log(packet.payload.toString());
            pushElement('temperature', packet.payload.toString(), node0Cache, storeNode0Data);
            break;
        case 'res/node0/humidity':
            //console.log(packet.payload.toString());
            pushElement('humidity', packet.payload.toString(), node0Cache, storeNode0Data);
            break;

        case 'res/node1/status':
            //console.log(packet.payload.toString());
            pushElement('status', packet.payload.toString(), node1Cache, storeNode1Data);
            break;
        case 'res/node1/batteryLevel':
            //console.log(packet.payload.toString());
            pushElement('batteryLevel', packet.payload.toString(), node1Cache, storeNode1Data);
            break;
        case 'res/node1/waterSwitch':
            //console.log(packet.payload.toString());
            pushElement('waterSwitch', packet.payload.toString(), node1Cache, storeNode1Data);
            break;

        case 'res/node1/temperature':
            //console.log(packet.payload.toString());
            pushElement('temperature', packet.payload.toString(), node1Cache, storeNode1Data);
            break;
        case 'res/node1/humidity':
            //console.log(packet.payload.toString());
            pushElement('humidity', packet.payload.toString(), node1Cache, storeNode1Data);
            break;
 
    }
});

var node0Cache = {
    status: null,
    batteryLevel: null,
    waterSwitch: null,
    temperature: null,
    humidity: null,
    BeginTime: null,
    EndTime: null,
}

var node1Cache = {
    status: null,
    batteryLevel: null,
    waterSwitch: null,
    temperature: null,
    humidity: null,
    BeginTime: null,
    EndTime: null,
}




var pushElement = function(t, s, o, f){
    if(o.BeginTime && Date.parse(new Date()) - o.BeginTime > g_MaxWaitTime) objReset(o);

    if(getNumInObj(o, null) == Object.keys(o).length){
        o.BeginTime = Date.parse(new Date());
    }

    if(o.hasOwnProperty(t))  o[t] = s;

    if(getNumInObj(o, null) == 1){
        o.EndTime = Date.parse(new Date());
        console.log(o);
	f(o);
    }

};

var objReset = function(o){

    for(i in o){

        o[i] = null;
    }
}


var getNumInObj = function(o, t){
    var c = 0;
    for(i in o){

        if(o[i] == t) c ++;
    }
    return c;
}

var sql = 'SELECT * FROM api';

connection.query(sql,function (err, result) {
        if(err){
          console.log('[SELECT ERROR] - ',err.message);
          return;
        }
    console.log(result);
});

var storeNode0Data = (o)=>{storeNodeData(0, o)};
var storeNode1Data = (o)=>{storeNodeData(1, o)};

var storeNodeData = function(id, o){
	
var  addSql = 'INSERT INTO node(timestamp,id,status,qos,batterylevel,waterswitch,temperature,humidity) VALUES(?,?,?,?,?,?,?,?)';
	var  addSqlParams = [new Date(o.BeginTime).toISOString().slice(0, 19).replace('T', ' '), id, o.status, 1, o.batteryLevel, o.waterSwitch, o.temperature, o.humidity];

	connection.query(addSql,addSqlParams,function (err, result) {
	        objReset(o);
		if(err){
	         console.log('[INSERT ERROR] - ',err.message);
	         return;
	        }
	});
}
