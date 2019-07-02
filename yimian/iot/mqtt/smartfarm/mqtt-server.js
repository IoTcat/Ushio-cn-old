




var mqtt_server = function (o_params) {
    var o = {
        MaxWaitTime: 4000,
        port: 30031,
        portSSL: 30032,
        SECURE_CERT: '/home/yimian/ssl/star.yimian.xyz.ssl/star.yimian.xyz.crt',
        SECURE_KEY: '/home/yimian/ssl/star.yimian.xyz.ssl/star.yimian.xyz.key',
        sql: {
            host: '192.168.0.90',
            user: 'smartfarm',
            password: null,
            port: '3306',
            database: 'smartfarm'
        },
        debug: false,
        intervalTime: 50000,
        CheckMinTime: 1000,
        MaxTryTimes: 3,

    };

    /* merge paras */
    Object.assign(o, o_params);

    /* require packages */
    const mosca = require('mosca');
    const mysql = require('mysql');
    const fs = require('fs');
    const redis = require('redis');

    /* tmp global var */
    var timer = null;
    var fStatus = {
        node0: 'disconnect',
        node1: 'disconnect',
        station: 'disconnect',
        waterSys: 'disconnect'
    };
    var cache = {
        node0: {
            status: null,
            batteryLevel: null,
            waterSwitch: null,
            temperature: null,
            humidity: null,
            BeginTime: null,
            EndTime: null,
            qos: null,
        },
        node1: {
            status: null,
            batteryLevel: null,
            waterSwitch: null,
            temperature: null,
            humidity: null,
            BeginTime: null,
            EndTime: null,
            qos: null,
        },
        station: {
            status: null,
            batteryLevel: null,
            light: null,
            temperature: null,
            humidity: null,
            rainfall: null,
            CO: null,
            NH3: null,
            airPressure: null,
            BeginTime: null,
            EndTime: null,
            qos: null,
        },
        waterSys: {
            status: null,
            pump0: null,
            pump1: null,
            BeginTime: null,
            EndTime: null,
            qos: null,
        }
    }

    /* mqtt ini */
    var mqtt_broker = new mosca.Server({
        port: o.port,
        secure: {
            port: o.portSSL,
            keyPath: o.SECURE_KEY,
            certPath: o.SECURE_CERT,
        }
    });

    /* mysql ini */
    var sqlCnt = mysql.createConnection({     
      host     : o.sql.host,       
      user     : o.sql.user,              
      password : o.sql.password || fs.readFileSync("/home/yimian/conf/dbKeys/smartfarm.db.key").toString().replace(/\s+/g,""),
      port: o.sql.port,                   
      database: o.sql.database 
    }); 
    sqlCnt.connect();

    /* redis ini */
    var rc = redis.createClient();
    rc.on("error", function (err) {
        console.log("Redis Error " + err);
    });


    /* mqtt events */
    mqtt_broker.on('ready', function(){
        console.log((new Date((new Date()).getTime())).toLocaleString()+' - mqtt broker ready at port '+o.port);
        console.log((new Date((new Date()).getTime())).toLocaleString()+' - mqtt broker ready at SSL port '+o.portSSL);
    });
    mqtt_broker.on('published', function (packet, client) {
        switch (packet.topic) {
            /* node0 */
            case 'res/node0/status':
                tools.cache.push('status', packet.payload.toString(), 'node0');
                break;
            case 'res/node0/batteryLevel':
                tools.cache.push('batteryLevel', packet.payload.toString(), 'node0');
                break;
            case 'res/node0/waterSwitch':
                tools.cache.push('waterSwitch', packet.payload.toString(), 'node0');
                break;
            case 'res/node0/temperature':
                tools.cache.push('temperature', packet.payload.toString(), 'node0');
                break;
            case 'res/node0/humidity':
                tools.cache.push('humidity', packet.payload.toString(), 'node0');
                break;
            case 'qos/node0':
                tools.cache.push('qos', packet.payload.toString(), 'node0');
                break;

            /* node 1*/
            case 'res/node1/status':
                tools.cache.push('status', packet.payload.toString(), 'node1');
                break;
            case 'res/node1/batteryLevel':
                tools.cache.push('batteryLevel', packet.payload.toString(), 'node1');
                break;
            case 'res/node1/waterSwitch':
                tools.cache.push('waterSwitch', packet.payload.toString(), 'node1');
                break;

            case 'res/node1/temperature':
                tools.cache.push('temperature', packet.payload.toString(), 'node1');
                break;
            case 'res/node1/humidity':
                tools.cache.push('humidity', packet.payload.toString(), 'node1');
                break;
            case 'qos/node1':
                tools.cache.push('qos', packet.payload.toString(), 'node1');
                break;


            /* station*/
            case 'res/station/status':
                tools.cache.push('status', packet.payload.toString(), 'station');
                break;
            case 'res/station/batteryLevel':
                tools.cache.push('batteryLevel', packet.payload.toString(), 'station');
                break;
            case 'res/station/light':
                tools.cache.push('light', packet.payload.toString(), 'station');
                break;
            case 'res/station/temperature':
                tools.cache.push('temperature', packet.payload.toString(), 'station');
                break;
            case 'res/station/humidity':
                tools.cache.push('humidity', packet.payload.toString(), 'station');
                break;
            case 'res/station/rainfall':
                tools.cache.push('rainfall', packet.payload.toString(), 'station');
                break;
            case 'res/station/CO':
                tools.cache.push('CO', packet.payload.toString(), 'station');
                break;
            case 'res/station/NH3':
                tools.cache.push('NH3', packet.payload.toString(), 'station');
                break;
            case 'res/station/airPressure':
                tools.cache.push('airPressure', packet.payload.toString(), 'station');
                break;
            case 'qos/station':
                tools.cache.push('qos', packet.payload.toString(), 'station');
                break;
        
            /* waterSys*/
            case 'res/waterSys/status':
                tools.cache.push('status', packet.payload.toString(), 'waterSys');
                break;
            case 'res/waterSys/pump0':
                tools.cache.push('pump0', packet.payload.toString(), 'waterSys');
                break;
            case 'res/waterSys/pump1':
                tools.cache.push('pump1', packet.payload.toString(), 'waterSys');
                break;
            case 'qos/waterSys':
                tools.cache.push('qos', packet.payload.toString(), 'waterSys');
                break;

        }
    });


    /* tools */
    var tools = {

        cache:{
            push: function(t, s, name){

                var f = tools.sql[name].push;
                if(t != 'qos') rc.hset('sf/'+name, t, s);
                rc.hset('sf/LastConnectTime', name, (new Date()).valueOf());
                if(cache[name].BeginTime && (new Date()).valueOf() - cache[name].BeginTime > o.MaxWaitTime) tools.obj.reset(cache[name]);

                if(tools.obj.getNum(cache[name], null) == Object.keys(cache[name]).length){
                    cache[name].BeginTime = (new Date()).valueOf();
                    rc.hset('sf/'+name, 'BeginTime', cache[name].BeginTime);
                }

                if(t == 'qos'){
                    rc.hset('sf/clientStatus', name, 'connect');
                    if(s == -1){
                        rc.hset("sf/"+name, 'qos', '-1');
                        cache[name].qos = -1;
                    }else{
                        rc.get('sf/sync/'+s, function(err, res){
                            if(err){
                                rc.hset("sf/"+name, 'qos', '-1');
                                cache[name].qos = -1;
                            }else{
                                rc.hset("sf/"+name, 'qos', (new Date()).valueOf() - res);
                                cache[name].qos = (new Date()).valueOf() - res;
                            }
                            if(tools.obj.getNum(cache[name], null) == 1){
                                cache[name].EndTime = (new Date()).valueOf();
                                rc.hset('sf/'+name, 'EndTime', cache[name].EndTime);
                                rc.publish('sf/channel/'+name, 'ok');
                                if(o.debug) console.log(cache[name]);
                                if(o.debug && false){
                                    rc.hkeys("sf/"+name, function (err, replies) {
                                        console.log(replies.length + " replies:");
                                        replies.forEach(function (reply, i) {
                                            rc.hget("sf/"+name, reply, function(err, res){
                                                console.log(reply+': '+res);
                                            });
                                        });
                                    });
                                }
                                f(cache[name]);
                                tools.obj.reset(cache[name]);
                            }
                        });
                    }
                }

                else if(cache[name].hasOwnProperty(t))  cache[name][t] = s;

                if(tools.obj.getNum(cache[name], null) == 1){
                    cache[name].EndTime = (new Date()).valueOf();
                    rc.hset('sf/'+name, 'EndTime', cache[name].EndTime);
                    rc.publish('sf/channel/'+name, 'ok');
                    if(o.debug) console.log(cache[name]);
                    if(o.debug && false){
                        rc.hkeys("sf/"+name, function (err, replies) {
                            console.log(replies.length + " replies:");
                            replies.forEach(function (reply, i) {
                                rc.hget("sf/"+name, reply, function(err, res){
                                    console.log(reply+': '+res);
                                });
                            });
                        });
                    }
                    f(cache[name]);
                    tools.obj.reset(cache[name]);
                }
            },
        },
        obj: {
            reset: function(obj){
                for(i in obj){
                    obj[i] = null;
                }
            },
            getNum: function(obj, t){
                var c = 0;
                for(i in obj){
                    if(obj[i] == t) c ++;
                }
                return c;
            },
        },
        sql: {
            node0:{
                push: (obj)=>{tools.sql.node.push(0, obj)},
            },
            node1:{
                push: (obj)=>{tools.sql.node.push(1, obj)},
            },
            node:{
                push: function(id, obj){
                    var  addSql = 'INSERT INTO node(timestamp,id,status,qos,batterylevel,waterswitch,temperature,humidity) VALUES(?,?,?,?,?,?,?,?)';
                    var  addSqlParams = [new Date(obj.BeginTime).toISOString().slice(0, 19).replace('T', ' '), id, obj.status, obj.qos, obj.batteryLevel, obj.waterSwitch, obj.temperature, obj.humidity];
                    sqlCnt.query(addSql,addSqlParams,function (err, result) {
                        if(err){
                            console.log('[INSERT ERROR] - ',err.message);
                           return;
                        }
                    });
                },
            },
            station:{
                push: function(obj){
                    var  addSql = 'INSERT INTO station(timestamp,status,qos,batterylevel,light,temperature,humidity,rainfall,co,nh3,airpressure) VALUES(?,?,?,?,?,?,?,?,?,?,?)';
                    var  addSqlParams = [new Date(obj.BeginTime).toISOString().slice(0, 19).replace('T', ' '), obj.status, obj.qos, obj.batteryLevel, obj.light, obj.temperature, obj.humidity, obj.rainfall, obj.CO, obj.NH3, obj.airPressure];
                    sqlCnt.query(addSql,addSqlParams,function (err, result) {
                        if(err){
                            console.log('[INSERT ERROR] - ',err.message);
                           return;
                        }
                    });
                },
            },
            waterSys:{
                push: function(obj){
                    var  addSql = 'INSERT INTO watersys(timestamp,status,qos,pump0,pump1) VALUES(?,?,?,?,?)';
                    var  addSqlParams = [new Date(obj.BeginTime).toISOString().slice(0, 19).replace('T', ' '), obj.status, obj.qos, obj.pump0, obj.pump1];
                    sqlCnt.query(addSql,addSqlParams,function (err, result) {
                        if(err){
                            console.log('[INSERT ERROR] - ',err.message);
                           return;
                        }
                    });
                },
            },
            mqttLog:{
                push: function(obj){
                    var  addSql = 'INSERT INTO mqtt_log(timestamp,client,event,delay) VALUES(?,?,?,?)';
                    var  addSqlParams = [(new Date()).toISOString().slice(0, 19).replace('T', ' '), obj.client, obj.event, obj.delay];
                    sqlCnt.query(addSql,addSqlParams,function (err, result) {
                        if(err){
                            console.log('[INSERT ERROR] - ',err.message);
                           return;
                        }
                    });
                },
            },
        },
    }



    /* timer */
    timer = function(){
        return setInterval(function(){
            var key = Math.floor(Math.random()*100);
            rc.set('sf/sync/'+key, (new Date()).valueOf());
            mqtt_broker.publish({ topic:'qos/sync', payload: key.toString()});
        }, o.intervalTime);
    }();

    setInterval(function(){
        rc.hkeys('sf/LastConnectTime', function(err, keys){
            if(!err){
                keys.forEach(function(key, i){
                    rc.hget('sf/clientStatus', key, function(err3, clientStatus){
                        if(!err3){
                            if(clientStatus != 'disconnect'){
                                rc.hget('sf/LastConnectTime', key, function(err2, val){
                                    if(!err2){
                                        if((new Date()).valueOf() - val > o.MaxWaitTime + o.MaxTryTimes * o.intervalTime){
                                            rc.hset('sf/clientStatus', key, 'disconnect');
                                        }
                                    }
                                });
                            }
                        }
                    });
                });
            }
        });
        rc.hkeys('sf/clientStatus', function(err, keys){
            if(!err){
                keys.forEach(function(key, i){
                    rc.hget('sf/clientStatus', key, function(err2, val){
                        if(!err2){
                            if(val != fStatus[key]){
                                rc.hget('sf/'+key, 'qos', function(err3, qos){
                                    if(!err3){
                                        tools.sql.mqttLog.push({
                                            client: key,
                                            event: val,
                                            delay: qos
                                        });
                                        fStatus[key] = val;
                                        console.log((new Date((new Date()).getTime())).toLocaleString()+' - '+key+': '+val);
                                    }
                                });
                            }
                        }
                    });
                });
            }
        })
    }, o.CheckMinTime);



    return o;
};




/* exports */
exports.broker = mqtt_server;

