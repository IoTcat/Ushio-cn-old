var express = require('express');
var router = express.Router();
var redis = require('redis');
var mqtt = require('mqtt');
var mysql = require('mysql');
var fs = require('fs');

/* mqtt start */
var mqtt_client  = mqtt.connect('mqtts://mqtt.yimian.xyz:30032');
mqtt_client.on('connect', function () {
  //client.subscribe('qos/sync');
  console.log('Mqtt Connected!');
})

/* redis start */
var rc = redis.createClient();


/* mysql start */
var sqlCnt = mysql.createConnection({
      host     : "192.168.0.90",
      user     : "smartfarm",
      password : fs.readFileSync("/home/yimian/conf/dbKeys/smartfarm.db.key").toString().replace(/\s+/g,""),
      port: 3306,
      database: "smartfarm",
      dateStrings:true,
    });
sqlCnt.connect();

var o = {
  code: 500,
  msg: "Unknown error!!",
  data: [],
}


/* GET home page. */
router.get('/get', function(req, res, next) {
  //res.render('index', { title: 'Express' });
 res.header("Access-Control-Allow-Origin", "*");   
  if(req.query.type != undefined) req.query.type = req.query.type.toLowerCase();

  if(req.query.type == 'station' || req.query.type == 'node'|| req.query.type == 'watersys'){

    if(req.query.num == undefined && (req.query.timestart == undefined || req.query.timeend == undefined)){
      req.query.num = 1;
    }


    if(req.query.num != undefined){
      getLastData(req.query.type, req.query.num, o, res, req.query.sid);
      return;
    }
    
    getDataByDatetime(req.query.type, req.query.timestart, req.query.timeend, o, res, req.query.sid)
    return;
  }

  if(!req.query.type){
    o.msg = "No type was specified!!";
    res.send(o);
    return;
  }

  res.send(o);
});



/* GET home page. */
router.get('/set', function(req, res, next) {
  //res.render('index', { title: 'Express' });
  res.header("Access-Control-Allow-Origin", "*");
  delete o.data;
  if(req.query.type == undefined && req.query.status == 1 || req.query.status == 0){
    if(req.query.sid == 0 || req.query.sid == 1){
      mqtt_client.publish('ctl/node'+req.query.sid +'/waterSwitch', req.query.status.toString(), function(e){
        if(!e) {
          o.code = 200;
          o.msg = "Command published successfully!!";
        }else{
          o.code = 402;
          o.msg = e;
        } 
        res.send(o);
        ctlLog(o.code, 'node'+req.query.sid+'/waterSwitch', req.query.status.toString(), o.msg);
      });
      return;
    }
    if(req.query.pid == 0 || req.query.pid == 1){
      mqtt_client.publish('ctl/waterSys/pump'+req.query.pid, req.query.status.toString(), function(e){
        if(!e) {
          o.code = 200;
          o.msg = "Command published successfully!!";
        }else{
          o.code = 402;
          o.msg = e;
        } 
        res.send(o);
        ctlLog(o.code, 'waterSys/pump'+req.query.pid, req.query.status.toString(), o.msg);
      });
      return;
    }
  }

  if(req.query.type == 'node' || req.query.type == 'waterSys' || req.query.type == 'station'  && req.query.status != undefined && req.query.status >= 0 && req.query.status <= 255){

    if(req.query.type == 'node' && !(req.query.sid >= 0 && req.query.sid <=1)){
      o.msg = "Require legal sid!!!";
      res.send(o);
      reset();
      return;
    }else if(req.query.type == 'node'){
      req.query.type = 'node'+req.query.sid;
    }

      mqtt_client.publish('ctl/'+req.query.type+'/status', req.query.status.toString(), function(e){
        if(!e) {
          o.code = 200;
          o.msg = "Command published successfully!!";
        }else{
          o.code = 402;
          o.msg = e;
        } 
        res.send(o);
        ctlLog(o.code, req.query.type+'/status', req.query.status.toString(), o.msg);
      });
      return;
  }


  res.send(o);
  reset();
});




/* GET home page. */
router.get('/refresh', function(req, res, next) {
  //res.render('index', { title: 'Express' });
  res.header("Access-Control-Allow-Origin", "*");
  refresh();
  
  if(req.query.type != undefined) req.query.type = req.query.type.toLowerCase();

  if(req.query.type == 'station' || req.query.type == 'node'|| req.query.type == 'watersys'){

    if(req.query.num == undefined && (req.query.timestart == undefined || req.query.timeend == undefined)){
      req.query.num = 1;
    }


    if(req.query.num != undefined){
      getLastData(req.query.type, req.query.num, o, res, req.query.sid);
      return;
    }
    
    getDataByDatetime(req.query.type, req.query.timestart, req.query.timeend, o, res, req.query.sid)
    return;
  }

  res.send(o);
});




function getLastData(table, num, o, res, id){
  var sql = "SELECT * FROM " + table + ((id!=undefined)?(" where id = " + id + " "):(" ")) + "order by timestamp DESC limit " + num;
  sqlCnt.query(sql, function(err, dbdata){
    if(err){
      o.code = 505;
      o.msg = err;
    }else{
      if(dbdata.length){
        o.data = dbdata;
        o.code = 200;
        o.msg = "Found " + dbdata.length + " items!!";
        for(i in o.data){
          o.data[i].timestamp = (new Date(o.data[i].timestamp)).valueOf()/1000 + 8 * 3600;
          o.data[i].datetime = timestampToTime(o.data[i].timestamp * 1000);
        }
      }else{
        o.code = 404;
        o.msg = "Found 0 items!! Please check your params!!";
      }
    }
      res.send(o);
      reset();
  });
}


function getDataByDatetime(table, datetime1, datatime2, o, res, id){
  var sql = "SELECT * FROM " + table + " where timestamp between  FROM_UNIXTIME(" + datetime1 + ")  and FROM_UNIXTIME(" + datatime2 + ")" + ((id!=undefined)?(" AND id = " + id):(""));
  sqlCnt.query(sql, function(err, dbdata){
    if(err){
      o.code = 505;
      o.msg = err;
    }else{
      if(dbdata.length){
        o.data = dbdata;
        o.code = 200;
        o.msg = "Found " + dbdata.length + " items!!";
        for(i in o.data){
          o.data[i].timestamp = (new Date(o.data[i].timestamp)).valueOf()/1000 + 8 * 3600;
          o.data[i].datetime = timestampToTime(o.data[i].timestamp * 1000);
        }
      }else{
        o.code = 404;
        o.msg = "Found 0 items!! Please check your params!!";
      }
    }
      res.send(o);
      reset();
  });
}

function ctlLog(status, target, cmd, msg){

  var  addSql = 'INSERT INTO ctl_history(timestamp,status,target,cmd,msg) VALUES(?,?,?,?,?)';
  var  addSqlParams = [(new Date()).toISOString().slice(0, 19).replace('T', ' '), status, target, cmd, msg];
  sqlCnt.query(addSql,addSqlParams,function (err, result) {
      reset();
      if(err){
          console.log('[INSERT ERROR] - ',err.message);
         return;
      }
  });
}


function reset(){
    o = {
    code: 500,
    msg: "Unknown error!!",
    data: [],
  }
}


function refresh(){
  var key = Math.floor(Math.random()*100);
  rc.set('sf/sync/'+key, (new Date()).valueOf());
  mqtt_client.publish('qos/sync', key.toString());
  o.code = 220;
  o.msg = "Refresh command published successfully!!";
}

function timestampToTime(timestamp) {
  var  date = new Date(timestamp);
  var Y = date.getFullYear() + '-';
  var M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
  var D = date.getDate() + ' ';
  var h = date.getHours() + ':';
  var m = date.getMinutes() + ':';
  var s = date.getSeconds();
  return Y+M+((D.length==2)?'0':'')+D+((h.length==2)?'0':'')+h+((m.length==2)?'0':'')+m+((s<10)?'0':'')+s;
}


module.exports = router;
