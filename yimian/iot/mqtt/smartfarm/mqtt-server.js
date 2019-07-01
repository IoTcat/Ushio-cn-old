




var mqtt_server = function (o_params) {
    var o = {
        MaxWaitTime: 10000,
        port: 30032,
        sql: {
            host: 'cn.db.yimian.xyz',
            user: 'smartfarm',
            password: null,
            port: '3306',
            database: 'smartfarm'
        },
        debug: true,

    };

    /* merge paras */
    Object.assign(o, o_params);

    /* require packages */
    const mosca = require('mosca');
    const mysql = require('mysql');
    const fs = require('fs');
    const redis = require('redis');

    /* tmp global var */
    var cache = {
        node0: {
            status: null,
            batteryLevel: null,
            waterSwitch: null,
            temperature: null,
            humidity: null,
            BeginTime: null,
            EndTime: null
        },
        node1: {
            status: null,
            batteryLevel: null,
            waterSwitch: null,
            temperature: null,
            humidity: null,
            BeginTime: null,
            EndTime: null
        },
        station: {
            status: null,
            batteryLevel: null,
            waterSwitch: null,
            temperature: null,
            humidity: null,
            BeginTime: null,
            EndTime: null
        },
        waterSys: {
            status: null,
            batteryLevel: null,
            waterSwitch: null,
            temperature: null,
            humidity: null,
            BeginTime: null,
            EndTime: null
        }
    }

    /* mqtt ini */
    var mqtt_broker = new mosca.Server({port: o.port});

    /* mysql ini */
    var sqlCnt = mysql.createConnection({     
      host     : o.sql.host,       
      user     : o.sql.user,              
      password : o.sql.password || fs.readFileSync("smartfarm.db.key").toString().replace(/\s+/g,""),
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

        }
    });


    /* tools */
    var tools = {

        cache:{
            push: function(t, s, name){
                var obj = cache[name];
                var f = tools.sql[name].push;
                rc.hset('sf/'+name, t, s);
                if(obj.BeginTime && (new Date()).valueOf() - obj.BeginTime > o.MaxWaitTime) tools.obj.reset(o);

                if(tools.obj.getNum(obj, null) == Object.keys(obj).length){
                    obj.BeginTime = (new Date()).valueOf();
                    rc.hset('sf/'+name, 'BeginTime', obj.BeginTime);
                }

                if(obj.hasOwnProperty(t))  obj[t] = s;

                if(tools.obj.getNum(obj, null) == 1){
                    obj.EndTime = (new Date()).valueOf();
                    rc.hset('sf/'+name, 'EndTime', obj.EndTime);
                    rc.publish('sf/chnnel/'+name, 'ok');
                    console.log(obj);
                    if(o.debug){
                        rc.hkeys("sf/"+name, function (err, replies) {
                            console.log(replies.length + " replies:");
                            replies.forEach(function (reply, i) {
                                rc.hget("sf/"+name, reply, function(err, res){
                                    console.log(reply+': '+res);
                                });
                            });
                        });
                    }
                    f(obj);
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
                    var  addSqlParams = [new Date(obj.BeginTime).toISOString().slice(0, 19).replace('T', ' '), id, obj.status, 1, obj.batteryLevel, obj.waterSwitch, obj.temperature, obj.humidity];
                    sqlCnt.query(addSql,addSqlParams,function (err, result) {
                        tools.obj.reset(obj);
                        if(err){
                            console.log('[INSERT ERROR] - ',err.message);
                           return;
                        }
                    });
                },
            },
        },
    }
    return o;
};




/* exports */
exports.broker = mqtt_server;

