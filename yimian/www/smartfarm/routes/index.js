var express = require('express');
var router = express.Router();

/* GET home page. */
router.get('/', function(req, res, next) {
  //res.redirect(302, "https://doc.smartfarm.yimian.xyz");
  //res.render('index', { title: 'temp page' });
  res.send();
});

module.exports = router;
