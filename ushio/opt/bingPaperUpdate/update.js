let request = require("request");
let fs = require("fs");
const { exec } = require('child_process');

Date.prototype.format = function(format)
{
 var o = {
 "M+" : this.getMonth()+1, //month
 "d+" : this.getDate(),    //day
 "h+" : this.getHours(),   //hour
 "m+" : this.getMinutes(), //minute
 "s+" : this.getSeconds(), //second
 "q+" : Math.floor((this.getMonth()+3)/3),  //quarter
 "S" : this.getMilliseconds() //millisecond
 }
 if(/(y+)/.test(format)) format=format.replace(RegExp.$1,
 (this.getFullYear()+"").substr(4 - RegExp.$1.length));
 for(var k in o)if(new RegExp("("+ k +")").test(format))
 format = format.replace(RegExp.$1,
 RegExp.$1.length==1 ? o[k] :
 ("00"+ o[k]).substr((""+ o[k]).length));
 return format;
}

 
class Ut {
  /**
 * 	 * 下载网络图片
 * 	 	 * @param {object} opts 
 * 	 	 	 */
  static downImg(opts = {}, path = '') {
    return new Promise((resolve, reject) => {
      request
        .get(opts)
        .on('response', (response) => {
          console.log("img type:", response.headers['content-type'])
        })
        .pipe(fs.createWriteStream(path))
        .on("error", (e) => {
          console.log("pipe error", e)
          resolve('');
        })
        .on("finish", () => {
          console.log("finish");
          resolve("ok");
        })
        .on("close", () => {
          console.log("close");
        })
 
    })
  };
}
 

(async () => {
  try {

  request('https://cn.bing.com/HPImageArchive.aspx?format=js&idx=0&n=1&mkt=zh-CN',function (error, response, data) {
   
    data = JSON.parse(data);
    var url = 'https://cn.bing.com' + data.images[0].url;
    
    let opts = {
      url: url,
    };
    var date = new Date();
    let path = "/home/ushio/opt/bingPaperUpdate/wallpaper/img_" + date.format('yyyy-MM-dd') + "_1920x1080_96_background_normal.jpg";
    let r1 = Ut.downImg(opts, path);
    console.log(r1);
    setTimeout(function(){
        exec('obs cp /home/ushio/opt/bingPaperUpdate/wallpaper/ obs://yimian-image/ -r -f', function(){
            exec('rm -rf /home/ushio/opt/bingPaperUpdate/wallpaper/*');
        });
    }, 1000);
  });


  }
  catch (e) {
    console.log(e);
  }
})()
