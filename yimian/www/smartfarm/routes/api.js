var express = require('express');
var router = express.Router();
var redis = require('redis');
var mqtt = require('mqtt');
var mysql = require('mysql');
var fs = require('fs');

/* mqtt start */
var mqtt_client  = mqtt.connect('mqtt://127.0.0.1:30032');
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
      password : fs.readFileSync("/home/yimian/www/smartfarm/smartfarm.db.key").toString().replace(/\s+/g,""),
      port: 3306,
      database: "smartfarm",
      dateStrings:true,
    });
sqlCnt.connect();

var o = {
  code: 500,
  msg: "Unknown error!!",
  data: {},
}



/* GET home page. */
router.get('/', function(req, res, next) {
  //res.render('index', { title: 'Express' });
  


  if(req.query.type == 'station'){

    if(req.query.num == undefined){
      req.query.num = 1;
    }
    getLastData('station', req.query.num, o, res);
    if(!req.query.num || req.query.num == 1){

    }
    return;
  }

  if(!req.query.type){
    o.msg = "No type was specified!!";
    res.send(o);
    return;
  }

});


function getLastData(table, num, o, res){
  var sql = "SELECT * FROM " + table + " order by timestamp DESC limit " + num;
  sqlCnt.query(sql, function(err, dbdata){
      if(dbdata.length){
        o.data = dbdata;
        o.code = 200;
        o.msg = "Found " + dbdata.length + " items!!";
      }else{
        o.code = 404;
        o.msg = "Found 0 items!! Please check your params!!";
      }
      res.send(o);
      reset();
  });
}


function getDataByDatetime(table, datetime1, datatime2, o, res){
  var sql = "SELECT * FROM " + table + " where timestamp between  '" + datetime1 + "'  and '" + datatime2 + "'";
  sqlCnt.query(sql, function(err, dbdata){
      if(dbdata.length){
        o.data = dbdata;
        o.code = 200;
        o.msg = "Found " + dbdata.length + " items!!";
      }else{
        o.code = 404;
        o.msg = "Found 0 items!! Please check your params!!";
      }
      res.send(o);
      reset();
  });
}

function reset(){
    o = {
    code: 500,
    msg: "Unknown error!!",
    data: {},
  }
}

module.exports = router;
