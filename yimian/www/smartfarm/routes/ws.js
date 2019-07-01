var express = require('express');
var expressWs = require('express-ws');
var router = express.Router();
var redis = require('redis');
var mqtt = require('mqtt');
var mysql = require('mysql');
var fs = require('fs');


/* redis start */
var rc = redis.createClient();
rc.subscribe('sf/channel/node0');
rc.subscribe('sf/channel/node1');
rc.subscribe('sf/channel/waterSys');
rc.subscribe('sf/channel/station');

expressWs(router);

router
  .ws('/', function (ws, req){
     rc.on('message', function(channel, msg) {
        ws.send(channel + ' ' + msg);
      });
      ws.on('message', function (msg) {
        
      })
   })

module.exports = router;