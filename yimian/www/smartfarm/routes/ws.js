var express = require('express');
var expressWs = require('express-ws');
var router = express.Router();
var redis = require('redis');
var mqtt = require('mqtt');
var mysql = require('mysql');
var fs = require('fs');


/* redis start */
var rc = new redis.createClient();
var rc2 = new redis.createClient();
rc.subscribe('sf/channel/node0');
rc.subscribe('sf/channel/node1');
rc.subscribe('sf/channel/waterSys');
rc.subscribe('sf/channel/station');


expressWs(router);

router
  .ws('/', function (ws, req){
     rc.on('message', function(channel, msg) {
      var o = {
        type: channel.substring(11),
        data: {}
      }

      rc2.hkeys('sf/'+o.type, function(err, keys){
        if(!err){

          keys.forEach(function(key, i){
            rc2.hget('sf/'+o.type, key, function(err2, val){
              if(!err2){
                o.data[key] = val;
                if(i == keys.length - 1){
                  ws.send(JSON.stringify(o));
                }
              }
            })
          });
        }
      });

      });
      ws.on('message', function (msg) {
        
      })
   })

module.exports = router;