var express = require('express');
var expressWs = require('express-ws');
var router = express.Router();
var redis = require('redis');


/* redis start */
var rc = new redis.createClient();


expressWs(router);

router
  .ws('/', function (ws, req){
     if(req.query.fp.length == 8){
	var fp = req.query.fp;
     }else{
	ws.close();
     }
      ws.on('message', function (msg) {
        if(msg == 'get'){
           var o = {};
           rc.hkeys('session/'+fp, function(err, keys){
           if(!err){

             keys.forEach(function(key, i){
               rc.hget('session/'+fp, key, function(err2, val){
                 if(!err2){
                   o[key] = val;
                   if(i == keys.length - 1){
                     ws.send(JSON.stringify(o));
                   }
                 }
               })
             });
           }
         });
        }else if(isJson(msg)){
            obj = JSON.parse(msg);
            if(obj.key && obj.val){
               rc.hset('session/'+fp, obj.key, obj.val);
               rc.hset('session/'+fp, 'LastOperateTime', (new Date()).valueOf());
            }
        }
      })
   })

module.exports = router;


function isJson(str) {
        try {
            if (typeof JSON.parse(str) == "object") {
                return true;
            }
        } catch(e) {
        }
        return false;
}
